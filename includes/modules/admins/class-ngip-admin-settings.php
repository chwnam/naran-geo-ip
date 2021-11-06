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
			$this->add_action( 'admin_menu', 'add_admin_menu' );
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
				[ $this, 'output_admin_menu' ]
			);
		}

		/**
		 * Output settings page.
		 */
		public function output_admin_menu() {
			$this->setup_fields();

			$this->render(
				'admins/settings',
				[
					'option_group' => 'ngip_settings',
					'page'         => 'ngip',
				]
			);
		}

		/**
		 * Add sections and fields before render settings.
		 */
		public function setup_fields() {
			add_settings_section(
				'general',
				__( 'General Settings', 'ngip' ),
				'__return_empty_string',
				'ngip'
			);

			add_settings_field(
				'maxmind-license-key',
				__( 'MaxMind License Key', 'ngip' ),
				[ __CLASS__, 'output_generic_input' ],
				'ngip',
				'general',
				[
					'id'          => 'ngip-maxlind-license-key',
					'label_for'   => 'ngip-maxlind-license-key',
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
				'ngip-section-schedule',
				__( 'Cron Schedule', 'ngip' ),
				'__return_empty_string',
				'ngip'
			);

			add_settings_field(
				'ngip-next-db-update',
				__( 'Next DB Update', 'ngip' ),
				[ $this, 'output_next_db_update' ],
				'ngip',
				'ngip-section-schedule',
				[ 'next_sched' => wp_next_scheduled( 'ngip_db_update' ) ]
			);
		}

		/**
		 * Render 'ngip-next-db-update' field
		 *
		 * @param $args 'next_sched' key required.
		 */
		public function output_next_db_update( $args ) {
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
		 * Output <input type="..."> for general purpose.
		 *
		 * @param array $args
		 */
		public static function output_generic_input( array $args ) {
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
				$args['before'] ? wp_kses_post( $args['after'] ) : '',
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