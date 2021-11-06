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
	class NGIP_Admins implements NGIP_Module {
		use NGIP_Submodule_Impl;

		public function __construct() {
			$this->assign_modules(
				[
				]
			);
		}
	}
}
