<?php
/**
 * NGIP: Option register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Option' ) ) {
	/**
	 * NOTE: Add 'property-read' phpdoc to make your editor inspect option items properly.
	 *
	 * @property-read NGIP_Reg_Option $settings
	 */
	class NGIP_Register_Option implements NGIP_Register {
		use NGIP_Hook_Impl;

		/** @var array Key: alias, value: option_name */
		private array $fields = [];

		public function __construct() {
			$this->add_action( 'init', 'register' );
		}

		public function __get( string $alias ): ?NGIP_Reg_Option {
			if ( isset( $this->fields[ $alias ] ) ) {
				return NGIP_Reg_Option::factory( $this->fields[ $alias ] );
			} else {
				return null;
			}
		}

		/**
		 * @callback
		 * @action       init
		 */
		public function register() {
			foreach ( $this->get_items() as $idx => $item ) {
				if ( $item instanceof NGIP_Reg_Option ) {
					$item->register();

					$alias = is_int( $idx ) ? $item->get_option_name() : $idx;

					$this->fields[ $alias ] = $item->get_option_name();
				}
			}
		}

		/**
		 * Define items here.
		 *
		 * To use alias, do not forget to return generator as 'key => value' form!
		 *
		 * @return Generator
		 */
		public function get_items(): Generator {
			yield from call_user_func( [ NGIP_Registers::class, 'regs_option' ], $this );
		}
	}
}
