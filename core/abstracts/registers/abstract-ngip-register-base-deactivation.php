<?php
/**
 * NGIP: Deactivation register base
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Base_Deactivation' ) ) {
	abstract class NGIP_Register_Base_Deactivation implements NGIP_Register {
		public function __construct() {
			register_deactivation_hook( ngip()->get_main_file(), [ $this, 'register' ] );
		}

		/**
		 * Method name can mislead, but it does deactivation callback jobs.
		 */
		public function register() {
			foreach ( $this->get_items() as $item ) {
				if ( $item instanceof NGIP_Reg_Deactivation ) {
					$item->register();
				}
			}
		}
	}
}
