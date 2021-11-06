<?php
/**
 * NGIP: Deactivation register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Deactivation' ) ) {
	class NGIP_Register_Deactivation implements NGIP_Register {
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

		public function get_items(): Generator {
			yield call_user_func( [ NGIP_Registers::class, 'regs_deactivation' ], $this );
		}
	}
}
