<?php
/**
 * NGIP: Registers module
 *
 * Manage all registers
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Registers' ) ) {
	/**
	 * You can remove unused registers.
	 *
	 * @property-read NGIP_Register_Ajax          $ajax
	 * @property-read NGIP_Register_Cron          $cron
	 * @property-read NGIP_Register_Cron_Schedule $cron_schedule
	 * @property-read NGIP_Register_Option        $option
	 * @property-read NGIP_Register_Script        $script
	 * @property-read NGIP_Register_Style         $style
	 */
	class NGIP_Registers implements NGIP_Module {
		use NGIP_Submodule_Impl;

		public function __construct() {
			$this->assign_modules(
				[
					'ajax'          => NGIP_Register_Ajax::class,
					'cron'          => NGIP_Register_Cron::class,
					'cron_schedule' => NGIP_Register_Cron_Schedule::class,
					'option'        => NGIP_Register_Option::class,
					'script'        => NGIP_Register_Script::class,
					'style'         => NGIP_Register_Style::class,
				]
			);
		}
	}
}
