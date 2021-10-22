<?php
/**
 * Naran GeoIP: Style register
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Style' ) ) {
	class NGIP_Register_Style implements NGIP_Register {
		use NGIP_Hooks_Impl;

		public function __construct() {
			$this
				->add_action( 'init', 'register' )
			;
		}

		public function register() {
			foreach ( $this->get_items() as $item ) {
				if ( $item instanceof NGIP_Registrable_Style ) {
					$item->register();
				}
			}
		}

		/**
		 * Return style registrable items.
		 *
		 * @return Generator
		 */
		public function get_items(): Generator {
			// Common items.
			yield null;
		}

		/**
		 * 'src' location helper.
		 *
		 * @param string $rel_path
		 *
		 * @return string
		 */
		private function src_helper( string $rel_path ): string {
			$rel_path = trim( $rel_path, '\\/' );

			if ( ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) && str_ends_with( $rel_path, '.min.css' ) ) {
				$rel_path = substr( $rel_path, 0, strlen( $rel_path ) - 8 ) . '.css';
			}

			return plugins_url( "assets/css/$rel_path", ngip()->get_main_file() );
		}
	}
}
