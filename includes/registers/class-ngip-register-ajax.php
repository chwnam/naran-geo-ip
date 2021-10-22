<?php
/**
 * Naran GeoIP: AJAX register
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_AJAX' ) ) {
	class NGIP_Register_AJAX implements NGIP_Register {
		use NGIP_Hooks_Impl;

		private array $real_callbacks = [];

		public function __construct() {
			$this->add_action( 'init', 'register' );
		}

		public function register() {
			foreach ( $this->get_items() as $item ) {
				if ( $item instanceof NGIP_Registrable_AJAX ) {
					$this->real_callbacks[ $item->action ] = $item->callback;
					$item->register( [ $this, 'dispatch' ] );
				}
			}
		}

		public function dispatch() {
			$action = $_REQUEST['action'] ?? '';
			if ( $action && isset( $this->real_callbacks[ $action ] ) ) {
				$callback = ngip_parse_callback( $this->real_callbacks[ $action ] );
				if ( is_callable( $callback ) ) {
					call_user_func( $callback );
				}
			}
		}

		public function get_items(): Generator {
			yield null;
		}
	}
}
