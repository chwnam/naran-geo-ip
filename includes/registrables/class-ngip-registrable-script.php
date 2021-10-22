<?php
/**
 * Naran GeoIP: Script registrable
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Registrable_Script' ) ) {
	class NGIP_Registrable_Script implements NGIP_Registrable {
		public function __construct(
			public string $handle,
			public string $src,
			public array $deps = [],
			public string|bool|null $ver = false, // null: plugin version. false: no version.
			public bool $in_footer = false
		) {
			$this->handle    = $handle;
			$this->src       = $src;
			$this->deps      = $deps;
			$this->ver       = is_null( $ver ) ? ngip()->get_version() : $ver;
			$this->in_footer = $in_footer;
		}

		public function register() {
			if ( $this->handle && $this->src ) {
				wp_register_script(
					$this->handle,
					$this->src,
					$this->deps,
					$this->ver ?: null,
					$this->in_footer
				);
			}
		}
	}
}
