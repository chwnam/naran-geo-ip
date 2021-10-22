<?php
/**
 * Naran GeoIP: Option register
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class_alias( NGIP_Registrable_Option::class, 'NGIP_Option' );

if ( ! class_exists( 'NGIP_Register_Option' ) ) {
	/**
	 * Class NGIP_Register_Option
	 */
	class NGIP_Register_Option implements NGIP_Register {
		use NGIP_Hooks_Impl;

		/**
		 * @var array<string, string>
		 */
		private array $fields = [];

		public function __construct() {
			$this->add_action( 'init', 'register' );
		}

		public function __get( string $alias ): ?NGIP_Option {
			if ( isset( $this->fields[ $alias ] ) ) {
				return NGIP_Option::factory( $this->fields[ $alias ] );
			} else {
				return null;
			}
		}

		public function register() {
			foreach ( $this->get_items() as $idx => $item ) {
				if ( $item instanceof NGIP_Option ) {
					$item->register();
					$this->fields[ is_int( $idx ) ? $item->get_option_name() : $idx ] = $item->get_option_name();
				}
			}
		}

		/**
		 * @return Generator
		 */
		public function get_items(): Generator {
			yield 'license_key' => new NGIP_Registrable_Option(
				'ngip',
				'ngip_maxmind_license_key',
				false,
				[
					'type'              => 'string',
					'description'       => _x( 'Enter your MaxMind license key. This is required to update GeoIP database.', 'Option description text', 'ngip' ),
					'sanitize_callback' => 'sanitize_text_field',
					'show_in_rest'      => false,
					'default'           => '',
				]
			);
		}
	}
}
