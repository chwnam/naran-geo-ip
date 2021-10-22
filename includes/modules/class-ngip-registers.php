<?php
/**
 * Naran GeoIP: Registers
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Registers' ) ) {
	/**
	 * @property-read NGIP_Register_AJAX   $ajax
	 * @property-read NGIP_Register_Cron   $cron
	 * @property-read NGIP_Register_Option $option
	 * @property-read NGIP_Register_Script $script
	 * @property-read NGIP_Register_Style  $style
	 */
	class NGIP_Registers implements NGIP_Module {
		use NGIP_Submodules_Impl;

		public function __construct() {
			$this->assign_modules(
				[
					'ajax'   => NGIP_Register_AJAX::class,
					'cron'   => NGIP_Register_Cron::class,
					'option' => NGIP_Register_Option::class,
					'script' => NGIP_Register_Script::class,
					'style'  => NGIP_Register_Style::class,
				]
			);
		}
	}
}
