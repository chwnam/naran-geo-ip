<?php
/**
 * NGIP: Custom post type register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Post_Type' ) ) {
	class NGIP_Register_Post_Type implements NGIP_Register {
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

		public function get_items(): Generator {
			yield call_user_func( [ NGIP_Registers::class, 'regs_post_type' ], $this );
		}
	}
}
