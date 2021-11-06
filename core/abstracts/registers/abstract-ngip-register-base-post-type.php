<?php
/**
 * NGIP: Custom post type register base
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Base_Post_Type' ) ) {
	abstract class NGIP_Register_Base_Post_Type implements NGIP_Register {
		use NGIP_Hook_Impl;

		public function __construct() {
			$this->add_filter( 'init', 'register' );
		}

		/**
		 * @callback
		 * @actin       init
		 */
		public function register() {
			foreach ( $this->get_items() as $item ) {
				if ( $item instanceof NGIP_Reg_Post_Type ) {
					$item->register();
				}
			}
		}
	}
}
