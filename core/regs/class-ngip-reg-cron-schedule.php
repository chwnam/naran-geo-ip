<?php
/**
 * NGIP: Cron schedule reg.
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Reg_Cron_Schedule' ) ) {
	class NGIP_Reg_Cron_Schedule implements NGIP_Reg {
		public  $name;

		public  $interval;

		public  $display;

		public function __construct(
			string $name,
			int $interval,
			string $display
		) {
			$this->name     = $name;
			$this->interval = $interval;
			$this->display  = $display;
		}

		public function register( $dispatch = null ) {
			// Do nothing.
		}
	}
}
