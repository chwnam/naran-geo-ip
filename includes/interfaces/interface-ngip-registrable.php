<?php
/**
 * Naran GeoIP: Registerable interface
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! interface_exists( 'NGIP_Registrable' ) ) {
	interface NGIP_Registrable {
		public function register();
	}
}
