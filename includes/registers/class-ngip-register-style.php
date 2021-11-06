<?php
/**
 * NGIP: Style register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Style' ) ) {
	class NGIP_Register_Style extends NGIP_Register_Base_Style {
		public function get_items(): Generator {
			yield; // yield new NGIP_Reg_Style();
		}
	}
}
