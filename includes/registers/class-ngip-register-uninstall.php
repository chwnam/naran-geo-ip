<?php
/**
 * NGIP: Uninstall register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Uninstall' ) ) {
	class NGIP_Register_Uninstall extends NGIP_Register_Base_Uninstall {
		public function get_items(): Generator {
			yield; // yield new NGIP_Reg_Uninstall();
		}
	}
}
