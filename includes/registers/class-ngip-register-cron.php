<?php
/**
 * NGIP: Cron register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Cron' ) ) {
	class NGIP_Register_Cron extends NGIP_Register_Base_Cron {
		public function get_items(): Generator {
			yield new NGIP_Reg_Cron( time(), 'ngip_15_days', 'ngip_db_update' );
		}
	}
}
