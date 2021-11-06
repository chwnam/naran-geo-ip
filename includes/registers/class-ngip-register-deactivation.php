<?php
/**
 * NGIP: Deactivation register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Deactivation' ) ) {
	class NGIP_Register_Deactivation extends NGIP_Register_Base_Deactivation {
		public function get_items(): Generator {
			yield; // yield new NGIP_Reg_Deactivation();
		}
	}
}
