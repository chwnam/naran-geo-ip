<?php
/**
 * Naran GeoIP: Container
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Container' ) ) {
	/**
	 * @property-read NGIP_Admin_Settings $admin_settings
	 * @property-read NGIP_Plugin_Setup   $plugin_setup
	 * @property-read NGIP_Registers      $registers
	 */
	final class NGIP_Container {
		use NGIP_Submodules_Impl;

		private static ?NGIP_Container $instance = null;

		private array $store = [];

		private function __construct() {
		}

		public function get_main_file(): string {
			return NGIP_MAIN;
		}

		public function get_version(): string {
			return NGIP_VERSION;
		}

		public function get_priority(): int {
			return NGIP_DEFAULT_PRIORITY;
		}

		public function get( string $key, mixed $default = null ): mixed {
			return $this->store[ $key ] ?? $default;
		}

		public function set( string $key, mixed $value ) {
			$this->store[ $key ] = $value;
		}

		private function initialize() {
			$this->assign_modules(
				[
					'admin_settings' => NGIP_Admin_Settings::class,
					'plugin_setup'   => NGIP_Plugin_Setup::class,
					'registers'      => NGIP_Registers::class,
				]
			);
		}

		public static function get_instance(): NGIP_Container {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
				self::$instance->initialize();
			}
			return self::$instance;
		}
	}
}
