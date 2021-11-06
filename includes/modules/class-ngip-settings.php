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
			$this->value = ngip_option()->settings->get_value();
		}

		public function get_license_key(): string {
			return $this->value['maxmind_license_key'] ?? '';
		}

		public function get_current_version(): string {
			return $this->value['current_version'] ?? '';
		}

		public function update_current_version( string $version ) {
			if ( $this->get_current_version() !== $version ) {
				$this->value['current_version'] = $version;

				ngip_option()->settings->update( $this->value );
			}
		}

		public static function get_default(): array {
			return [
				'maxmind_license_key' => '',
				'current_version'     => '',
			];
		}

		public static function sanitize( $value ): array {
			$option = self::get_default();

			$option['maxmind_license_key'] = sanitize_text_field( $value['maxmind_license_key'] ?? '' );
			$option['current_version']     = sanitize_text_field( $value['current_version'] ?? '' );

			return $option;
		}
	}
}
