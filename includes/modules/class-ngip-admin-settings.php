<?php

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Admin_Settings' ) ) {
	class NGIP_Admin_Settings implements NGIP_Admin_Module {
		use NGIP_Hooks_Impl;
		use NGIP_Render_Impl;

		public function __construct() {
			if ( is_admin() ) {
				$this->add_action( 'admin_menu', 'add_admin_menu' );
			}
		}

		public function add_admin_menu() {
			add_submenu_page(
				'tools.php',
				__( 'Naran GeoIP settings page', 'ngip' ),
				__( 'Naran GeoIP', 'ngip' ),
				'manage_options',
				'ngip',
				[ $this, 'output_admin_menu' ]
			);
		}

		public function output_admin_menu() {
			$this->template( 'admin-settings' );
		}
	}
}
