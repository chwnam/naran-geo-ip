<?php
/**
 * NGIP: Script register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Script' ) ) {
	class NGIP_Register_Script extends NGIP_Register_Base_Script {
		public function get_items(): Generator {
			yield new NGIP_Reg_Script(
				'ngip-set-next-schedule',
				$this->src_helper( 'set-next-schdule.js' ),
				[ 'jquery' ]
			);
		}
	}
}
