<?php
/**
 * NGIP: Activation register base
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Base_Activation' ) ) {
	abstract class NGIP_Register_Base_Activation implements NGIP_Register {
		public function __construct() {
			register_activation_hook( ngip()->get_main_file(), [ $this, 'register' ] );
		}

		/**
		 * Method name can mislead, but it does activation callback jobs.
		 */
		public function register() {
			foreach ( $this->get_items() as $item ) {
				if ( $item instanceof NGIP_Reg_Activation ) {
					$item->register();
				}
			}
		}
	}
}
