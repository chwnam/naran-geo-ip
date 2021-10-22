<?php
/**
 *
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Plugin_Setup' ) ) {
	class NGIP_Plugin_Setup implements NGIP_Module {
		use NGIP_Hooks_Impl;

		public function __construct() {
			register_activation_hook( ngip()->get_main_file(), 'activation' );
			register_deactivation_hook( ngip()->get_main_file(), 'deactivation' );
		}

		public function activation() {
			do_action( 'ngip_activation' );
		}

		public function deactivation() {
			do_action( 'ngip_deactivation' );
		}
	}
}
