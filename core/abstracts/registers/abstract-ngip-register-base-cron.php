<?php
/**
 * NGIP: Cron register base
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Base_Cron' ) ) {
	abstract class NGIP_Register_Base_Cron implements NGIP_Register {
		use NGIP_Hook_Impl;

		public function __construct() {
			register_activation_hook( ngip()->get_main_file(), [ $this, 'register' ] );
			register_deactivation_hook( ngip()->get_main_file(), [ $this, 'unregister' ] );
		}

		public function register() {
			foreach ( $this->get_items() as $item ) {
				if ( $item instanceof NGIP_Reg_Cron ) {
					$item->register();
				}
			}
		}

		public function unregister() {
			foreach ( $this->get_items() as $item ) {
				if ( $item instanceof NGIP_Reg_Cron ) {
					$item->unregister();
				}
			}
		}
	}
}
