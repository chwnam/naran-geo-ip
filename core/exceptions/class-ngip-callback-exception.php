<?php
/**
 * NGIP: Callback exception
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Callback_Exception' ) ) {
	class NGIP_Callback_Exception extends Exception{
	}
}
