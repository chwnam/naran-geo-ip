<?php
/**
 * NGIP: Admin settings
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Admin_Settings' ) ) {
	class NGIP_Admin_Settings implements NGIP_Admin_Module {
		use NGIP_Hook_Impl;
		use NGIP_Template_Impl;

		public function __construct() {
			$this
				->add_action( 'admin_menu', 'add_admin_menu' )
				->add_action( 'add_option_ngip_settings', 'after_option_add', null, 2 )
				->add_action( 'update_option_ngip_settings', 'after_option_update', null, 4 )
			;
		}

		/**
		 * Add menu page.
		 */
		public function add_admin_menu() {
			add_options_page(
				__( 'Naran GeoIP Settings', 'ngip' ),
				__( 'NGIP', 'ngip' ),
				'manage_options',
				'ngip',
				[ $this, 'render_admin_menu' ]
			);
		}

		/**
		 * Output settings page.
		 */
		public function render_admin_menu() {
			$this
				->setup_fields()
				->enqueue_style( 'ngip-admins-settings' )
				->render(
					'admins/settings',
					[
						'option_group' => 'ngip_settings',
						'page'         => 'ngip',
					]
				)
			;
		}

		public function after_option_add( $option, $value ) {
			$this->after_option_update( '', $value );
		}

		/**
		 * @param mixed $old_value
		 */
		public function after_option_update( $old_value, $new_value ) {
			$old_license = $old_value['maxmind_license_key'] ?? '';
			$new_license = $new_value['maxmind_license_key'] ?? '';

			if ( $new_license && $old_license !== $new_license ) {
				$this->remove_action( 'update_option_ngip_settings', 'after_option_update' );
				ngip_settings()->refresh();
				do_action( 'ngip_db_update' );
				$this->add_action( 'update_option_ngip_settings', 'after_option_update', null, 4 );
			}
		}

		/**
		 * Add sections and fields before render settings.
		 */
		protected function setup_fields(): self {
			add_settings_section(
				'ngip-general',
				__( 'General Settings', 'ngip' ),
				'__return_empty_string',
				'ngip'
			);

			add_settings_field(
				'ngip-field-maxmind-license-key',
				__( 'MaxMind License Key', 'ngip' ),
				[ __CLASS__, 'render_generic_input' ],
				'ngip',
				'ngip-general',
				[
					'id'          => 'ngip_settings-license-key',
					'label_for'   => 'ngip_settings-license-key',
					'name'        => 'ngip_settings[maxmind_license_key]',
					'type'        => 'text',
					'class'       => 'text',
					'value'       => ngip_settings()->get_license_key(),
					'extra_attrs' => [
						'autocomplete' => 'off',
					],
					'description' => sprintf(
					/* translators: MaxMind website URL. */
						__( 'Enter your MaxMind GeoIP2 license key. See <a href="%s" target="_blank">WooCommerce doc page</a> for help.', 'ngip' ),
						'https://woocommerce.com/document/maxmind-geolocation-integration/'
					),
				]
			);

			add_settings_section(
				'ngip-section-db-stat',
				__( 'Database Status', 'ngip' ),
				'__return_empty_string',
				'ngip'
			);

			add_settings_field(
				'ngip-field-db-path',
				__( 'Database Path', 'ngip' ),
				[ $this, 'render_generic_input' ],
				'ngip',
				'ngip-section-db-stat',
				[
					'id'          => 'ngip-database-path',
					'label_for'   => 'ngip-database-path',
					'name'        => 'ngip_settings[database_path]',
					'class'       => 'text large-text',
					'value'       => ngip_get_database_path(),
					'extra_attrs' => [ 'readonly' => '' ],
				]
			);

			add_settings_field(
				'ngip-field-current-version',
				__( 'Database Version', 'ngip' ),
				[ $this, 'render_generic_input' ],
				'ngip',
				'ngip-section-db-stat',
				[
					'id'    => 'ngip-settings-current-version',
					'name'  => 'ngip_settings[current_version]',
					'type'  => 'hidden',
					'value' => ngip_get_database_version(),
					'after' => ngip_get_database_version(),
				]
			);

			add_settings_field(
				'ngip-field-next-db-update',
				__( 'Next DB Update', 'ngip' ),
				[ $this, 'render_next_db_update' ],
				'ngip',
				'ngip-section-db-stat',
				[ 'next_sched' => wp_next_scheduled( 'ngip_db_update' ) ]
			);

			if ( file_exists( ngip_get_database_path() ) ) {
				add_settings_section(
					'ngip-section-ip-tester',
					__( 'Tester', 'ngip' ),
					'__return_empty_string',
					'ngip'
				);

				add_settings_field(
					'ngip-field-yours',
					__( 'Yours', 'ngip' ),
					[ $this, 'render_ip_test_yours' ],
					'ngip',
					'ngip-section-ip-tester'
				);

				add_settings_field(
					'ngip-field-ip-input',
					__( 'IP Address', 'ngip' ),
					[ $this, 'render_ip_test_input' ],
					'ngip',
					'ngip-section-ip-tester',
					[ 'label_for' => 'ngip-test-ip-input' ]
				);

				add_settings_field(
					'ngip-field-test-result',
					__( 'Result', 'ngip' ),
					[ $this, 'render_ip_test_result' ],
					'ngip',
					'ngip-section-ip-tester'
				);

				$this
					->enqueue_script( 'ngip-ip-tester' )
					->localize( [ 'nonce' => wp_create_nonce( 'ngip-ip-tester' ) ] )
					->enqueue_ejs( 'admins/settings-ip-test-ejs' )
				;
			}

			return $this;
		}

		/**
		 * Render 'ngip-next-db-update' field
		 *
		 * @param $args 'next_sched' key required.
		 */
		public function render_next_db_update( $args ) {
			if ( ! empty( $args['next_sched'] ) ) {
				$this->render(
					'admins/settings-next-schedule',
					[
						'iso_datetime' => wp_date( 'c', $args['next_sched'] ),
						'text'         => wp_date(
							get_option( 'date_format' ) . ' ' . get_option( 'time_format' ),
							$args['next_sched']
						),
						'human_diff'   => human_time_diff( $args['next_sched'] ),
					]
				);
			} else {
				$this
					->enqueue_script( 'ngip-set-next-schedule' )
					->localize( [ 'nonce' => wp_create_nonce( 'ngip-set-next-schedule' ) ] )
					->render( 'admins/settings-not-scheduled' )
				;
			}
		}

		public function render_ip_test_yours() {
			$ip   = '';
			$code = '';

			$external_ip = ngip_get_external_ip( false );
			$result      = ngip_query_maxmind_database( $external_ip );

			if ( is_array( $result ) ) {
				$ip   = $external_ip;
				$code = $result['country']['iso_code'] ?? '';
			}

			$this->render(
				'admins/settings-ip-test-yours',
				[
					'ip'           => $ip,
					'country_code' => $code,
				]
			);
		}

		public function render_ip_test_input() {
			$this->render( 'admins/settings-ip-test-input' );
		}

		public function render_ip_test_result() {
			$this->render( 'admins/settings-ip-test-result' );
		}

		/**
		 * AJAX Callback
		 *
		 * @callback
		 * @used-by NGIP_Register_Ajax::get_items()
		 */
		public function query_ip_address() {
			check_ajax_referer( 'ngip-ip-tester', 'nonce' );

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_send_json_error(
					new WP_Error( 'ngip_error', __( 'You are not allowed to do this action.', 'ngip' ) ),
					403
				);
			}

			$ip = sanitize_text_field( wp_unslash( $_REQUEST['ip'] ?? '' ) );

			if ( $ip ) {
				$result = ngip_query_maxmind_database( $ip );

				if ( is_wp_error( $result ) ) {
					wp_send_json_error( $result, 400 );
				} elseif ( empty( $result ) ) {
					$message = sprintf(
					/* translators: ip address string */
						__( 'IP \'%s\' is not found.', 'ngip' ),
						$ip
					);
					wp_send_json_error( new WP_Error( 'ngip_error', $message ) );
				} else {
					wp_send_json_success( $result );
				}
			}
		}

		/**
		 * AJAX callback
		 *
		 * @used-by NGIP_Registers::regs_ajax()
		 */
		public function activate_db_schedule() {
			check_ajax_referer( 'ngip-set-next-schedule', 'nonce' );

			$item = ngip()->registers->cron->get_items()->current();

			if ( $item instanceof NGIP_Reg_Cron && 'ngip_db_update' === $item->hook ) {
				$item->unregister();
				$item->register();

				$sched  = wp_next_scheduled( 'ngip_db_update' );
				$format = get_option( 'date_format' ) . ' ' . get_option( 'time_format' );
				$output = $this->render(
					'admins/settings-next-schedule',
					[
						'iso_datetime' => wp_date( 'c', $sched ),
						'text'         => wp_date( $format, $sched ),
						'human_diff'   => human_time_diff( $sched ),
					],
					'',
					false
				);

				wp_send_json_success( [ 'html' => $output ] );
			}

			wp_send_json_error( new WP_Error( 'Error', __( 'Cron schedule not found.', 'ngip' ) ) );
		}

		/**
		 * Render <input type="..."> for general purpose.
		 *
		 * @param array $args
		 */
		public static function render_generic_input( array $args ) {
			$defaults = [
				'id'          => '',
				'name'        => '',
				'type'        => 'text',
				'class'       => 'text',
				'value'       => '',
				'extra_attrs' => [],
				'description' => '',
				'before'      => '',
				'after'       => '',
			];

			$args = wp_parse_args( $args, $defaults );

			$attrs = [
				'id'    => 'id="' . esc_attr( $args['id'] ) . '"',
				'name'  => 'name="' . $args['name'] . '"',
				'type'  => 'type="' . $args['type'] . '"',
				'class' => 'class="' . self::sanitize_html_class( $args['class'] ) . '"',
				'value' => 'value="' . $args['value'] . '"',
			];

			foreach ( $args['extra_attrs'] as $attr => $value ) {
				$attr  = sanitize_key( $attr );
				$value = esc_attr( $value );
				if ( ! isset( $attrs[ $attr ] ) ) {
					$attrs[ $attr ] = "$attr=\"$value\"";
				}
			}

			printf(
				'%s<input %s>%s',
				$args['before'] ? wp_kses_post( $args['before'] ) : '',
				implode( ' ', $attrs ),
				$args['after'] ? wp_kses_post( $args['after'] ) : '',
			);

			if ( $args['description'] ) {
				printf( '<p class="description">%s</p>', wp_kses_post( $args['description'] ) );
			}
		}

		/**
		 * Santize CSS clsss names
		 *
		 * @param string $intput
		 *
		 * @return string
		 */
		private static function sanitize_html_class( string $intput ): string {
			return implode(
				' ',
				array_unique( array_filter( array_map( 'sanitize_html_class', preg_split( '/\s+/', $intput ) ) ) )
			);
		}
	}
}