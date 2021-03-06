<?php
/**
 * NGIP: Uninstall register base
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Base_Uninstall' ) ) {
	abstract class NGIP_Register_Base_Uninstall implements NGIP_Register {
		public function __construct() {
			register_uninstall_hook( ngip()->get_main_file(), [ $this, 'register' ] );
		}

		/**
		 * Method name can mislead, but it does uninstall callback jobs.
		 */
		public function register() {
			foreach ( $this->get_items() as $item ) {
				if ( $item instanceof NGIP_Reg_Uninstall ) {
					$item->register();
				}
			}
		}
	}
}
