<?php
/**
 * Plugin Name:       Naran GeoIP
 * Plugin URI:        https://github.com/chwnam/naran-geo-ip/
 * Description:       This plugin is abbreviated to 'NGIP'. It helps get country of client by IP address.
 * Version:           1.0.1
 * Requires at least: 5.3.0
 * Requires PHP:      7.4
 * Author:            changwoo
 * Author URI:        https://blog.changwoo.pe.kr/
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       ngip
 * Domain Path:       /languages
 * CPBN Version:      1.1.1
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/vendor/autoload.php';

const NGIP_MAIN_FILE = __FILE__;
const NGIP_VERSION   = '1.0.1';
const NGIP_PRIORITY  = 750;

ngip();
