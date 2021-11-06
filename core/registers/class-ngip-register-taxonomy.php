<?php
/**
 * NGIP: Custom taxonomy register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Taxonomy' ) ) {
	class NGIP_Register_Taxonomy implements NGIP_Register {
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
				if ( $item instanceof NGIP_Reg_Taxonomy ) {
					$item->register();
				}
			}
		}

		public function get_items(): Generator {
			yield call_user_func( [ NGIP_Registers::class, 'regs_taxonomy' ], $this );
		}
	}
}
