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

		public static function get_default(): array {
			return [
				'maxmind_license_key' => '',
			];
		}

		public static function sanitize( $value ): array {
			$option = self::get_default();

			$option['maxmind_license_key'] = sanitize_text_field( $value['maxmind_license_key'] ?? '' );

			return $option;
		}
	}
}
