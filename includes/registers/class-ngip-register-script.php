<?php
/**
 * Naran GeoIP: Script register
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Script' ) ) {
	class NGIP_Register_Script implements NGIP_Register {
		use NGIP_Hooks_Impl;

		public function __construct() {
			$this->add_action( 'init', 'register' );
		}

		public function register() {
			foreach ( $this->get_items() as $item ) {
				if ( $item instanceof NGIP_Registrable_Script ) {
					$item->register();
				}
			}
		}

		/**
		 * Return JavaScript registrable items.
		 *
		 * @return Generator
		 */
		public function get_items(): Generator {
			yield null;
		}

		/**
		 * @param string $rel_path
		 * @param bool   $replace_min
		 *
		 * @return string
		 */
		private function src_helper( string $rel_path, bool $replace_min = true ): string {
			$rel_path = trim( $rel_path, '\\/' );

			if ( ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) && str_ends_with( $rel_path, '.min.js' ) ) {
				$rel_path = substr( $rel_path, 0, strlen( $rel_path ) - 7 ) . '.js';
			}

			return plugins_url( "assets/js/{$rel_path}", ngip()->get_main_file() );
		}
	}
}
