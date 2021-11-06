<?php
/**
 * NGIP: Script register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Script' ) ) {
	class NGIP_Register_Script implements NGIP_Register {
		use NGIP_Hook_Impl;

		public function __construct() {
			$this->add_action( 'init', 'register' );
		}

		/**
		 * @callback
		 * @action       init
		 */
		public function register() {
			foreach ( $this->get_items() as $item ) {
				if ( $item instanceof NGIP_Reg_Script ) {
					$item->register();
				}
			}
		}

		public function get_items(): Generator {
			yield from call_user_func( [ NGIP_Registers::class, 'regs_script' ], $this );
		}

		/**
		 * @param string $rel_path
		 * @param bool   $replace_min
		 *
		 * @return string
		 */
		public function src_helper( string $rel_path, bool $replace_min = true ): string {
			$rel_path = trim( $rel_path, '\\/' );

			if ( ngip_script_debug() && $replace_min && substr( $rel_path, - 7 ) === '.min.js' ) {
				$rel_path = substr( $rel_path, 0, strlen( $rel_path ) - 7 ) . '.js';
			}

			return plugin_dir_url( ngip()->get_main_file() ) . "assets/js/{$rel_path}";
		}
	}
}
