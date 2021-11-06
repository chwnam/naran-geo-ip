<?php
/**
 *
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Query_IP' ) ) {
	class NGIP_Query_IP implements NGIP_Module {
		use NGIP_Hook_Impl;

		private ?MaxMind\Db\Reader $reader = null;

		public function __construct() {
			$this->add_action( 'shutdown', 'close_database' );
		}

		public function query_maxmind_database( string $ip ) {
			$database_path = ngip()->updater->get_database_path();

			if ( ! file_exists( $database_path ) ) {
				return '';
			}

			try {
				if ( ! $this->reader ) {
					$this->reader = new MaxMind\Db\Reader( $database_path );
				}
				$data = $this->reader->get( $ip );
				var_dump( $data );
			} catch ( Exception $e ) {
				error_log(
					sprintf(
						'[NGIP] %s: %s (%s:%s)',
						$e->getCode(),
						$e->getMessage(),
						$e->getFile(),
						$e->getLine()
					)
				);
			}
		}

		public function close_database() {
			if ( $this->reader ) {
				try {
					$this->reader->close();;
					$this->reader = null;
				} catch ( Exception $e ) {
				}
			}
		}

	}
}
