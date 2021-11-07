<?php
/**
 * NGIP: Option register base
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Base_Option' ) ) {
	abstract class NGIP_Register_Base_Option implements NGIP_Register {
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
	}
}
