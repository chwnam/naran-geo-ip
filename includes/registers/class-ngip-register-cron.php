<?php
/**
 * Naran GeoIP: Cron register
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Cron' ) ) {
	class NGIP_Register_Cron implements NGIP_Register {
		use NGIP_Hooks_Impl;

		public function __construct() {
			$this
				->add_action( 'ngip_activation', 'register' )
				->add_action( 'ngip_deactivation', 'unregister' )
				->add_filter( 'cron_schedules', 'add_cron_schedules' )
			;
		}

		public function register() {
			$this->unregister();
			foreach ( $this->get_items() as $item ) {
				if ( $item instanceof NGIP_Registrable_Cron ) {
					$item->register();
				}
			}
		}

		public function unregister() {
			foreach ( $this->get_items() as $item ) {
				if ( $item instanceof NGIP_Registrable_Cron ) {
					$item->unregister();
				}
			}
		}

		/**
		 * Add our cron schedule.
		 *
		 * @callback
		 * @filter  cron_schedules
		 *
		 * @param array $schedules
		 *
		 * @return array
		 */
		public function add_cron_schedules( array $schedules ): array {
			// Fifteen days, for geo_ip module.
			if ( ! isset( $schedules['fifteendays'] ) ) {
				$schedules['fifteendays'] = [
					'interval' => 1296000,
					'display'  => _x( 'Every 15 Days', 'Cron schedule display text', 'ngip' ),
				];
			}

			return $schedules;
		}

		public function get_items(): Generator {
			// Update maxmind database.
			yield new NGIP_Registrable_Cron( time(), 'fifteendays', 'ngip_update_maxmind_database' );
		}
	}
}
