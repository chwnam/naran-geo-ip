<?php
/**
 * NGIP: Activation reg.
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Reg_Activation' ) ) {
	class NGIP_Reg_Activation implements NGIP_Reg {
		/** @var Closure|array|string */
		public $callback;

		public array $args;

		public bool $error_log;

		/**
		 * @param Closure|array|string $callback
		 * @param array                $args
		 * @param bool                 $error_log
		 */
		public function __construct( $callback, array $args = [], bool $error_log = true ) {
			$this->callback  = $callback;
			$this->args      = $args;
			$this->error_log = $error_log;
		}

		/**
		 * Method name can mislead, but it does its activation callback job.
		 *
		 * @param null $dispatch
		 */
		public function register( $dispatch = null ) {
			try {
				$callback = ngip_parse_callback( $this->callback );
			} catch ( NGIP_Callback_Exception $e ) {
				$error = new WP_Error();
				$error->add(
					'ngip_activation_error',
					sprintf(
						'Activation callback handler `%s` is invalid. Please check your activation register items.',
						ngip_format_callback( $this->callback )
					)
				);
				wp_die( $error );
			}

			if ( $callback ) {
				if ( $this->error_log ) {
					error_log( sprintf( 'Activation callback started: %s', ngip_format_callback( $this->callback ) ) );
				}

				call_user_func_array( $callback, $this->args );

				if ( $this->error_log ) {
					error_log( sprintf( 'Activation callback finished: %s', ngip_format_callback( $this->callback ) ) );
				}
			}
		}
	}
}
