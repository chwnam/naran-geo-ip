<?php
/**
 * NGIP: Custom taxonomy register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Taxonomy' ) ) {
	class NGIP_Register_Taxonomy extends NGIP_Register_Base_Taxonomy {
		public function get_items(): Generator {
			yield; // yield new NGIP_Reg_Taxonomy();
		}
	}
}
