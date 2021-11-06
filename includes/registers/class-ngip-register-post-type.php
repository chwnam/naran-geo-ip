<?php
/**
 * NGIP: Custom post type register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Post_Type' ) ) {
	class NGIP_Register_Post_Type extends NGIP_Register_Base_Post_Type {
		public function get_items(): Generator {
			yield; // yield new NGIP_Reg_Post_Type();
		}
	}
}
