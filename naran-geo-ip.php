<?php
/**
 * Plugin Name:       Naran GeoIP
 * Description:       Get country of client by IP address.
 * Plugin URI:        https://github.com/chwnam/naran-geo-ip/
 * Author:            changwoo
 * Author URI:        https://blog.changwoo.pe.kr
 * Version:           1.0.0
 * Requires at least:
 * Requires PHP:      8.0
 * Text Domain:       ngip
 * Domain Path:       languages
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/vendor/autoload.php';

const NGIP_MAIN             = __FILE__;
const NGIP_VERSION          = '1.0.0';
const NGIP_DEFAULT_PRIORITY = 750;

ngip();
