<?php
/**
 * NGIP: Admin modules group
 *
 * Manage all admin modules
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Admins' ) ) {
	/**
	 * Admin modules sub-container.
	 *
	 * @property-read NGIP_Admin_Settings $settings
	 */
	class NGIP_Admins implements NGIP_Module {
		use NGIP_Submodule_Impl;

		public function __construct() {
			$this->assign_modules(
				[
					'settings' => NGIP_Admin_Settings::class,
				]
			);
		}
	}
}
