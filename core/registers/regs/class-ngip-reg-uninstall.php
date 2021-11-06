<?php
/**
 * NGIP: Uninstall reg.
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Reg_Uninstall' ) ) {
	class NGIP_Reg_Uninstall implements NGIP_Reg {
		/** @var Closure|array|string */
		public $callback;

		public array $args;

		public bool $error_log;

		/**
		 * @param Closure|array|string $callback
		 * @param array                $args
		 * @param bool                 $error_log
		 */
		public function __construct( $callback, array $args = [], bool $error_log = false ) {
			$this->callback  = $callback;
			$this->args      = $args;
			$this->error_log = $error_log;
		}

		/**
		 * Method name can mislead, but it does its uninstall callback job.
		 *
		 * @param null $dispatch
		 */
		public function register( $dispatch = null ) {
			try {
				$callback = ngip_parse_callback( $this->callback );
			} catch ( NGIP_Callback_Exception $e ) {
				$error = new WP_Error();
				$error->add(
					'ngip_uninstall_error',
					sprintf(
						'Uninstall callback handler `%s` is invalid. Please check your uninstall register items.',
						$this->callback
					)
				);
				wp_die( $error );
			}

			if ( $callback ) {
				if ( $this->error_log ) {
					error_log( error_log( sprintf( 'Uninstall callback started: %s', $this->callback ) ) );
				}

				call_user_func( $callback, $this->args );

				if ( $this->error_log ) {
					error_log( sprintf( 'Uninstall callback finished: %s', $this->callback ) );
				}
			}
		}
	}
}
