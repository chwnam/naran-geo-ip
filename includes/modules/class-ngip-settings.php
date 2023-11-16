<?php
/**
 * NGIP Settings
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Settings' ) ) {
	class NGIP_Settings implements NGIP_Module {
		private array $value;

		public function __construct() {
			$this->value = get_option( 'ngip_settings', NGIP_Settings::get_default() );
		}

		public function refresh(): void {
			$this->value = ngip_option()->settings->get_value();
		}

		public function get_license_key(): string {
			return $this->value['maxmind_license_key'] ?? '';
		}

		public function get_database_path(): string {
			return $this->value['database_path'] ?? '';
		}

		public function get_database_version(): string {
			return $this->value['database_version'] ?? '';
		}

		public function update_database_status( string $path, string $version ) {
			$this->value['database_path']    = $path;
			$this->value['database_version'] = $version;

			ngip_option()->settings->update( $this->value );
		}

		public static function get_default(): array {
			return [
				'maxmind_license_key' => '',
				'database_path'       => '',
				'database_version'    => '',
			];
		}

		public static function sanitize( $value ): array {
			$option = self::get_default();

			$option['maxmind_license_key'] = sanitize_text_field( $value['maxmind_license_key'] ?? '' );
			$option['database_path']       = sanitize_text_field( $value['database_path'] ?? '' );
			$option['database_version']    = sanitize_text_field( $value['database_version'] ?? '' );

			return $option;
		}
	}
}
