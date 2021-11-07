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

		/**
		 * API endpoints for looking up user IP address.
		 *
		 * @var array
		 */
		private static array $ip_lookup_apis = [
			'ipify'             => 'http://api.ipify.org/',
			'ipecho'            => 'http://ipecho.net/plain',
			'ident'             => 'http://ident.me',
			'whatismyipaddress' => 'http://bot.whatismyipaddress.com',
		];

		public function __construct() {
			$this->add_action( 'shutdown', 'close_database' );
		}

		/**
		 * @param string $ip
		 *
		 * @return array|WP_Error
		 */
		public function geolocate_ip( string $ip = '' ) {
			if ( ! $ip ) {
				$ip = $this->get_client_ip();
			}

			$code = $this->get_country_code_from_headers();
			if ( $code ) {
				return [ $ip, $code ];
			}

			$result = $this->query_maxmind_database( $ip );
			if ( empty( $result ) ) {
				$external = $this->get_external_ip();
				if ( '0.0.0.0' !== $external && $ip !== $external ) {
					return $this->geolocate_ip( $external );
				}
			}

			if ( is_wp_error( $result ) ) {
				return $result;
			} else {
				return [ $ip, $result['country']['iso_code'] ?? '' ];
			}
		}

		public function get_client_ip(): string {
			if ( isset( $_SERVER['HTTP_X_REAL_IP'] ) ) {
				return sanitize_text_field( wp_unslash( $_SERVER['HTTP_X_REAL_IP'] ) );
			} elseif ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
				// Proxy servers can send through this header like this: X-Forwarded-For: client1, proxy1, proxy2
				// Make sure we always only send through the first IP in the list which should always be the client IP.
				return (string) rest_is_ip_address( trim( current( preg_split( '/,/', sanitize_text_field( wp_unslash( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) ) ) ) );
			} elseif ( isset( $_SERVER['REMOTE_ADDR'] ) ) {
				return sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) );
			}

			return '';
		}

		/**
		 * @param bool $cache_local_ip
		 *
		 * @return string
		 */
		public function get_external_ip( $cache_local_ip = true ): string {
			$external_ip = '0.0.0.0';
			$client_ip   = $this->get_client_ip();

			if ( $client_ip ) {
				if ( $cache_local_ip ) {
					$transient   = "ngip_external_ip_$client_ip";
					$external_ip = get_transient( $transient );
				}

				if ( false === $external_ip || ! $cache_local_ip ) {
					$services = self::$ip_lookup_apis;
					$keys     = array_keys( $services );
					shuffle( $keys );

					foreach ( $keys as $key ) {
						$service_endpoint = $services[ $key ];
						$response         = wp_safe_remote_get( $service_endpoint, array( 'timeout' => 3 ) );
						if ( ! is_wp_error( $response ) && rest_is_ip_address( $response['body'] ) ) {
							$external_ip = sanitize_text_field( wp_remote_retrieve_body( $response ) );
							break;
						}
					}

					if ( $cache_local_ip && isset( $transient ) ) {
						set_transient( $transient, $external_ip, WEEK_IN_SECONDS );
					}
				}
			}

			return $external_ip;
		}

		private function get_country_code_from_headers(): string {
			$country_code = '';

			$headers = array(
				'MM_COUNTRY_CODE',
				'GEOIP_COUNTRY_CODE',
				'HTTP_CF_IPCOUNTRY',
				'HTTP_X_COUNTRY_CODE',
			);

			foreach ( $headers as $header ) {
				if ( isset( $_SERVER[ $header ] ) ) {
					$country_code = strtoupper( sanitize_text_field( wp_unslash( $_SERVER[ $header ] ) ) );
					break;
				}
			}

			return $country_code;
		}

		/**
		 * Query IP
		 *
		 * @param string $ip
		 *
		 * @return array|WP_Error
		 */
		public function query_maxmind_database( string $ip ) {
			$database_path = ngip_get_database_path();

			if ( ! file_exists( $database_path ) ) {
				return new WP_Error( 'ngip_error', __( 'Database path not found.', 'ngip' ) );
			}

			try {
				if ( ! $this->reader ) {
					$this->reader = new MaxMind\Db\Reader( $database_path );
				}
				return $this->reader->get( $ip );
			} catch ( Exception $e ) {
				return new WP_Error( 'ngip_error', $e->getMessage() );
			}
		}

		public function close_database() {
			try {
				if ( $this->reader ) {
					$this->reader->close();;
					$this->reader = null;
				}
			} catch ( Exception $e ) {
			}
		}
	}
}
