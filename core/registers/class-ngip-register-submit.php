<?php
/**
 * NGIP: Submit (admin-post.php) register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Submit' ) ) {
	class NGIP_Register_Submit implements NGIP_Register {
		use NGIP_Hook_Impl;

		private array $inner_handlers = [];

		public function __construct() {
			$this->add_action( 'init', 'register' );
		}

		/**
		 * @callback
		 * @actin       init
		 */
		public function register() {
			$dispatch = [ $this, 'dispatch' ];

			foreach ( $this->get_items() as $item ) {
				if (
					$item instanceof NGIP_Reg_Submit &&
					$item->action &&
					! isset( $this->inner_handlers[ $item->action ] )
				) {
					$this->inner_handlers[ $item->action ] = $item->callback;
					$item->register( $dispatch );
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
						'ngip_submit_error',
						sprintf(
							'Submit callback handler `%s` is invalid. Please check your submit register items.',
							ngip_format_callback( $this->inner_handlers[ $action ] )
						)
					);
					wp_die( $error, 404 );
				}
			}
		}

		public function get_items(): Generator {
			yield call_user_func( [ NGIP_Registers::class, 'regs_submit' ], $this );
		}
	}
}
