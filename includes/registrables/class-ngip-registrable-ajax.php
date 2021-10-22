<?php
/**
 * Naran GeoIP: AJAX registrable
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Registrable_AJAX' ) ) {
	class NGIP_Registrable_AJAX implements NGIP_Registrable {
		public function __construct(
			public string $action,
			public Closure|array|string $callback,
			public string|bool $allow_nopriv = false,
			public bool $is_wc_ajax = false,
			public ?int $priority = null
		) {
			$this->priority = is_null( $priority ) ? ngip()->get_priority() : $priority;
		}

		public function register() {
			$dispatch = func_get_arg( 0 );

			if ( $this->action && $this->callback ) {
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
