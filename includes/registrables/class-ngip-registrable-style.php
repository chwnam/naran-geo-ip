<?php
/**
 * Naran GeoIP: Style registrable
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Registrable_Style' ) ) {
	class NGIP_Registrable_Style implements NGIP_Registrable {
		public function __construct(
			public string $handle,
			public string $src,
			public array $deps = [],
			public $ver = null,  // null: plugin version. false: no version.
			public $media = 'all'
		) {
			$this->ver = is_null( $ver ) ? ngip()->get_version() : $ver;
		}

		public function register() {
			if ( $this->handle && $this->src ) {
				wp_register_style(
					$this->handle,
					$this->src,
					$this->deps,
					$this->ver ?: null,
					$this->media
				);
			}
		}
	}
}
