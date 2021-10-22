<?php
/**
 * Naran GeoIP: Option registrable
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Registrable_Option' ) ) {
	/**
	 * Class NGIP_Registrable_Option
	 *
	 * @property-read string        $type
	 * @property-read string        $group
	 * @property-read string        $description
	 * @property-read callable|null $sanitize_callback
	 * @property-read bool          $show_in_rest
	 * @property-read mixed         $default
	 */
	class NGIP_Registrable_Option implements NGIP_Registrable {
		private static array $options = [];

		public static function factory( string $option_name ): ?NGIP_Registrable_Option {
			global $wp_registered_settings;

			if ( isset( $wp_registered_settings[ $option_name ] ) ) {
				if ( ! isset( static::$options[ $option_name ] ) ) {
					$args = $wp_registered_settings[ $option_name ];

					static::$options[ $option_name ] = new NGIP_Registrable_Option(
						$args['group'],
						$option_name,
						$args['autoload']
					);
				}

				return static::$options[ $option_name ];
			}

			return null;
		}

		public function __construct(
			public string $option_group,
			public string $option_name,
			public bool $autoload,
			public array $args = []
		) {
			$this->args         = wp_parse_args(
				$args,
				[
					'type'              => 'string',
					'group'             => $this->option_group,
					'description'       => '',
					'sanitize_callback' => null,
					'show_in_rest'      => false,
					'default'           => '',
					'autoload'          => $autoload,
				]
			);
		}

		/**
		 * @param string $prop
		 *
		 * @return mixed|null
		 */
		public function __get( string $prop ) {
			if ( 'group' === $prop ) {
				return $this->option_group;
			}

			return $this->args[ $prop ] ?? null;
		}

		public function register() {
			if ( $this->option_group && $this->option_name ) {
				if ( $this->args['sanitize_callback'] ) {
					$this->args['sanitize_callback'] = ngip_parse_callback( $this->args['sanitize_callback'] );
				}
				register_setting( $this->option_group, $this->option_name, $this->args );
			}
		}

		public function get_option_group(): string {
			return $this->option_group;
		}

		public function get_option_name(): string {
			return $this->option_name;
		}

		public function get_value( $default = false ) {
			if ( func_num_args() > 0 ) {
				return get_option( $this->get_option_name(), $default );
			} else {
				return get_option( $this->get_option_name() );
			}
		}

		public function is_autoload(): bool {
			return $this->args['autoload'];
		}

		public function update( $value ): bool {
			return update_option( $this->get_option_name(), $value, $this->is_autoload() );
		}

		public function update_from_request(): bool {
			if ( isset( $_REQUEST[ $this->get_option_name() ] ) && is_callable( $this->sanitize_callback ) ) {
				return $this->update( $_REQUEST[ $this->get_option_name() ] );
			}

			return false;
		}

		public function delete(): bool {
			return delete_option( $this->get_option_name() );
		}
	}
}
