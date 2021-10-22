<?php
/**
 * Naran GeoIP: Cron registrable
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Registrable_Cron' ) ) {
	class NGIP_Registrable_Cron implements NGIP_Registrable {
		public function __construct(
			public int $timestamp,
			public string $schedule,
			public string $hook,
			public array $args = [],
			public bool $wp_error = false,
			public bool $is_single_event = false
		) {
		}

		public function register() {
			if ( $this->is_single_event ) {
				wp_schedule_single_event( $this->timestamp, $this->hook, $this->args, $this->wp_error );
			} else {
				wp_schedule_event( $this->timestamp, $this->schedule, $this->hook, $this->args, $this->wp_error );
			}
		}

		public function unregister() {
			if ( wp_next_scheduled( $this->hook ) ) {
				wp_clear_scheduled_hook( $this->hook );
			}
		}
	}
}
