<?php
/**
 * NGIP: Activation register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Activation' ) ) {
	class NGIP_Register_Activation extends NGIP_Register_Base_Activation {
		public function get_items(): Generator {
			yield; // yield new NGIP_Reg_Activation();
		}
	}
}
