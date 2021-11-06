<?php
/**
 * NGIP: AJAX (admin-ajax.php, or wc-ajax) register.
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Ajax' ) ) {
	class NGIP_Register_Ajax extends NGIP_Register_Base_Ajax {
		public function get_items(): Generator {
			/** @uses NGIP_Admin_Settings::activate_db_schedule() */
			yield new NGIP_Reg_Ajax( 'ngip_activate_db_schedule', 'admins.settings@activate_db_schedule', );
		}
	}
}
