<?php
/**
 * NGIP: Cron reg.
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Reg_Cron' ) ) {
	class NGIP_Reg_Cron implements NGIP_Reg {
		/** @var int */
		public  $timestamp;

		/** @var string */
		public  $schedule;

		/** @var string */
		public  $hook;

		public  $args;

		public  $wp_error;

		public  $is_single_event;

		public function __construct(
			int $timestamp,
			string $schedule,
			string $hook,
			array $args = [],
			bool $wp_error = false,
			bool $is_single_event = false
		) {
			$this->timestamp       = $timestamp;
			$this->schedule        = $schedule;
			$this->hook            = $hook;
			$this->args            = $args;
			$this->wp_error        = $wp_error;
			$this->is_single_event = $is_single_event;
		}

		public function register( $dispatch = null ) {
			if ( $this->is_single_event ) {
				wp_schedule_single_event( $this->timestamp, $this->hook, $this->args, $this->wp_error );
			} else {
				wp_schedule_event( $this->timestamp, $this->schedule, $this->hook, $this->args, $this->wp_error );
			}
		}

		public function unregister() {
			if ( wp_next_scheduled( $this->hook, $this->args ) ) {
				wp_clear_scheduled_hook( $this->hook, $this->args );
			}
		}
	}
}
