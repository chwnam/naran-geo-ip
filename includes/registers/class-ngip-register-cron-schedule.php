<?php
/**
 * NGIP: Cron schedule register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Cron_Schedule' ) ) {
	class NGIP_Register_Cron_Schedule extends NGIP_Register_Base_Cron_Schedule {
		public function get_items(): Generator {
			yield new NGIP_Reg_Cron_Schedule( 'ngip_15_days', 1296000, __( 'NGIP GeoIP DB Update', 'ngip' ) );
		}
	}
}
