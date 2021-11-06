<?php
/**
 * NGIP: Submit (admin-post.php) register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Submit' ) ) {
	class NGIP_Register_Submit extends NGIP_Register_Base_Submit {
		public function get_items(): Generator {
			yield; // yield new NGIP_Reg_Submit();
		}
	}
}
