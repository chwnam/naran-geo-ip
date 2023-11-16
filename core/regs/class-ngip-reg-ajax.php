<?php
/**
 * NGIP: AJAX (admin-ajax.php, or wc-ajax) reg.
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Reg_Ajax' ) ) {
	class NGIP_Reg_Ajax implements NGIP_Reg {
		/** @var string */
		public  $action;

		/** @var Closure|array|string */
		public $callback;

		/** @var string|bool */
		public $allow_nopriv;

		public  $is_wc_ajax;

		public  $priority;

		/**
		 * @param string               $action       Action name.
		 * @param Closure|array|string $callback     Callback.
		 * @param string|bool          $allow_nopriv true, false, or 'only_nopriv'.
		 * @param bool                 $is_wc_ajax   Is this for wc-ajax (WooCommerce AJAX)?
		 * @param int|null             $priority     Priority number. Defaults to NGIP_PRIORITY.
		 */
		public function __construct(
			string $action,
			$callback,
			$allow_nopriv = false,
			bool $is_wc_ajax = false,
			?int $priority = null
		) {
			$this->action       = $action;
			$this->callback     = $callback;
			$this->allow_nopriv = $allow_nopriv;
			$this->is_wc_ajax   = $is_wc_ajax;
			$this->priority     = is_null( $priority ) ? ngip()->get_priority() : $priority;
		}

		public function register( $dispatch = null ) {
			if ( $this->action && $this->callback && $dispatch ) {
				if ( $this->is_wc_ajax ) {
					add_action( "wc_ajax_{$this->action}", $dispatch, $this->priority );
				} else {
					if ( 'only_nopriv' !== $this->allow_nopriv ) {
						add_action( "wp_ajax_{$this->action}", $dispatch, $this->priority );
					}
					if ( true === $this->allow_nopriv || 'only_nopriv' === $this->allow_nopriv ) {
						add_action( "wp_ajax_nopriv_{$this->action}", $dispatch, $this->priority );
					}
				}
			}
		}
	}
}
