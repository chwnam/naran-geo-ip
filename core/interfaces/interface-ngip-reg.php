<?php
/**
 * NGIP: Registerable interface
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! interface_exists( 'NGIP_Reg' ) ) {
	interface NGIP_Reg {
		public function register( $dispatch = null );
	}
}
