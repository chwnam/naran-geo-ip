<?php
/**
 * NGIP: EJS enqueue
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_EJS_Queue' ) ) {
	class NGIP_EJS_Queue implements NGIP_Module {
		use NGIP_Template_Impl;

		private array $queue = [];

		public function __construct() {
			if ( is_admin() ) {
				if ( ! has_action( 'admin_print_footer_scripts', [ $this, 'do_template' ] ) ) {
					add_action( 'admin_print_footer_scripts', [ $this, 'do_template' ], ngip()->get_priority() );
				}
			} else {
				if ( ! has_action( 'wp_print_footer_scripts', [ $this, 'do_template' ] ) ) {
					add_action( 'wp_print_footer_scripts', [ $this, 'do_template' ], ngip()->get_priority() );
				}
			}
		}

		public function enqueue( string $relpath, array $data = [] ): void {
			$this->queue[ $relpath ] = $data;
		}

		public function do_template() {
			foreach ( $this->queue as $relpath => $data ) {
				$tmpl_id = 'tmpl-' . pathinfo( wp_basename( $relpath ), PATHINFO_FILENAME );
				$content = $this->render_file(
					$this->locate_file( 'ejs', $relpath, $data['variant'], 'php' ),
					$data['context'],
					false
				);
				$content = preg_replace( '/\s+/', ' ', $content );
				$content = trim( str_replace( '> <', '><', $content ) );

				if ( ! empty( $content ) ) {
					echo "\n<script type='text/template' id='" . esc_attr( $tmpl_id ) . "'>\n";
					echo $content;
					echo "\n</script>\n";
				}
			}
		}
	}
}
