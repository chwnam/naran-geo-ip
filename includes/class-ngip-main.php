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
	 * @property-read NGIP_Query_IP  $query_ip
	 * @property-read NGIP_Registers $registers
	 * @property-read NGIP_Settings  $settings
	 * @property-read NGIP_Updater   $updater
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
				'query_ip'  => function () { return new NGIP_Query_IP(); },
				'registers' => NGIP_Registers::class,
				'settings'  => function () { return new NGIP_Settings(); },
				'updater'   => NGIP_Updater::class,
			];
		}
	}
}
// TODO: 최초 라이센스 키를 입력한 경우라면, 데이터베이스 무조건 받게 해야 함.
