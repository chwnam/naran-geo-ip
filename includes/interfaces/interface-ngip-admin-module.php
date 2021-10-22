<?php
/**
 * Naran GeoIP: Admin Module interface
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! interface_exists( 'NGIP_Admin_Module' ) ) {
	interface NGIP_Admin_Module extends NGIP_Module {
	}
}
