<?php
/**
 * Naran GeoIP: Register interface
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! interface_exists( 'NGIP_Register' ) ) {
	interface NGIP_Register {
		public function get_items(): Generator;

		public function register();
	}
}
