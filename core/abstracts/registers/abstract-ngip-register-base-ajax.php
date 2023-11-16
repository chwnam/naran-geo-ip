<?php
/**
 * NGIP: AJAX (admin-ajax.php, or wc-ajax) register base
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Base_Ajax' ) ) {
	abstract class NGIP_Register_Base_Ajax implements NGIP_Register {
		use NGIP_Hook_Impl;

		private  $inner_handlers = [];

		public function __construct() {
			$this->add_action( 'init', 'register' );
		}

		/**
		 * @callback
		 * @actin       init
		 */
		public function register() {
			foreach ( $this->get_items() as $item ) {
				if (
					$item instanceof NGIP_Reg_Ajax &&
					$item->action &&
					! isset( $this->inner_handlers[ $item->action ] )
				) {
					$this->inner_handlers[ $item->action ] = $item->callback;
					$item->register( [ $this, 'dispatch' ] );
				}
			}
		}

		public function dispatch() {
			$action = $_REQUEST['action'] ?? '';

			if ( $action && isset( $this->inner_handlers[ $action ] ) ) {
				try {
					$callback = ngip_parse_callback( $this->inner_handlers[ $action ] );
					if ( is_callable( $callback ) ) {
						call_user_func( $callback );
					}
				} catch ( NGIP_Callback_Exception $e ) {
					$error = new WP_Error();
					$error->add(
						'ngip_ajax_error',
						sprintf(
							'AJAX callback handler `%s` is invalid. Please check your AJAX register items.',
							ngip_format_callback( $this->inner_handlers[ $action ] )
						)
					);
					wp_send_json_error( $error, 404 );
				}
			}
		}
	}
}
