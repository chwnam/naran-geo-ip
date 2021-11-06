<?php
/**
 * NGIP: Main class
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Main' ) ) {
	/**
	 * Class NGIP_Main
	 *
	 * @property-read NGIP_Admins    $admins
	 * @property-read NGIP_Registers $registers
	 */
	final class NGIP_Main extends NGIP_Main_Base {
		/**
		 * Return root modules
		 *
		 * @return array
		 *
		 * @used-by NGIP_Main_Base::initialize()
		 */
		protected function get_modules(): array {
			return [
				'admins'    => NGIP_Admins::class,
				'registers' => NGIP_Registers::class,
			];
		}
	}
}
