<?php
/**
 *
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Updater' ) ) {
	class NGIP_Updater implements NGIP_Module {
		const URL = 'https://download.maxmind.com/app/geoip_download';

		const EDITION = 'GeoLite2-City';

		const EXT = '.mmdb';

		/**
		 * Update databaase
		 *
		 * @param string $license_key
		 * @param string $current_version
		 *
		 * @return string|WP_Error
		 */
		public function update_database( string $license_key, string $current_version ) {
			$this->create_upload_directory();

			$version = $this->get_latest_version( $license_key );
			if ( $version === $current_version ) {
				return new WP_Error(
					'ngip_already_latest',
					__( 'The current database is already latest version.', 'ngip' )
				);
			}

			$archive = $this->download_database( $license_key );
			if ( is_wp_error( $archive ) ) {
				return $archive;
			}

			$replace = $this->replace_database( $archive );
			if ( is_wp_error( $replace ) ) {
				return $replace;
			}

			return $version;
		}

		public function replace_database( string $tmp_database ) {
			$database_path = $this->get_database_path();
			if ( empty( $database_path ) ) {
				return new WP_Error( 'error', __( 'Database path error.', 'ngip' ) );
			}

			require_once ABSPATH . 'wp-admin/includes/file.php';
			WP_Filesystem();
			global $wp_filesystem;

			if ( $wp_filesystem->exists( $database_path ) ) {
				$wp_filesystem->delete( $database_path );
			}

			$wp_filesystem->move( $tmp_database, $database_path, true );
			$wp_filesystem->delete( dirname( $tmp_database ) );

			return true;
		}

		public function download_database( string $license_key ) {
			if ( ! extension_loaded( 'Phar' ) ) {
				return new WP_Error( 'error', __( 'Phar extension not found.', 'ngip' ) );
			}

			$url = add_query_arg(
				[
					'edition_id'  => self::EDITION,
					'license_key' => urlencode( $license_key ),
					'suffix'      => 'tar.gz'
				],
				self::URL
			);

			if ( ! function_exists( 'download_url' ) ) {
				require_once ABSPATH . 'wp-admin/includes/file.php';
			}

			$archive  = download_url( apply_filters( 'ngip_maxmind_db_url', $url ) );
			$database = '';

			if ( is_wp_error( $archive ) ) {
				$error_data = $archive->get_error_data();
				if ( isset( $error_data['code'] ) ) {
					switch ( $error_data['code'] ) {
						case 401:
							return new WP_Error(
								'error',
								__( 'The MaxMind license key is invalid. If you have recently created this key, you may need to wait for it to become active.', 'ngip' )
							);
					}
				}
				return new WP_Error( 'error', __( 'Failed to download the MaxMind database.', 'ngip' ) );
			}

			try {
				$checksum = $this->download_checksum( $license_key );
				if ( empty( $checksum ) ) {
					return new WP_Error( 'ngip_checksum_failure', __( 'Retrieving file chcksum failed.', 'ngip' ) );
				} elseif ( ! $this->verify_file( $archive, $checksum ) ) {
					return new WP_Error( 'ngip_checksum_failure', __( 'Checksum unmatch.', 'ngip' ) );
				};

				$phar = new PharData( $archive );

				$database = trailingslashit( dirname( $archive ) ) .
				            trailingslashit( $phar->current()->getFilename() ) .
				            self::EDITION . self::EXT;

				$directory = dirname( $archive );
				$file      = trailingslashit( $phar->current()->getFilename() ) . self::EDITION . self::EXT;

				$phar->extractTo( $directory, $file, true );
			} catch ( Exception $exception ) {
				return new WP_Error( 'error', $exception->getMessage() );
			} finally {
				unlink( $archive );
			}

			return $database;
		}

		public function get_latest_version( string $lincense_key ): string {
			$url = add_query_arg(
				[
					'edition_id'  => self::EDITION,
					'license_key' => urlencode( $lincense_key ),
					'suffix'      => 'tar.gz',
				],
				self::URL
			);

			$response = wp_remote_head( $url );
			$status   = wp_remote_retrieve_response_code( $response );

			if ( 200 === $status ) {
				$header = wp_remote_retrieve_header( $response, 'Content-Disposition' );
				$regex  = '/filename=' . self::EDITION . '_(\d{8})\.tar\.gz$/';
				if ( preg_match( $regex, $header, $matches ) ) {
					return $matches[1];
				}
			}

			return '';
		}

		public function download_checksum( string $license_key ): string {
			$url = add_query_arg(
				[
					'edition_id'  => self::EDITION,
					'license_key' => urlencode( $license_key ),
					'suffix'      => 'tar.gz.sha256'
				],
				self::URL
			);

			$response = wp_remote_get( $url );
			$status   = wp_remote_retrieve_response_code( $response );

			if ( 200 === $status ) {
				$body = wp_remote_retrieve_body( $response );

				return $body ? substr( $body, 0, 64 ) : '';
			}

			return '';
		}

		public function verify_file( string $file, string $checksum ): bool {
			if ( file_exists( $file ) && is_file( $file ) && is_readable( $file ) ) {
				return hash_equals( hash_file( 'sha256', $file ), $checksum );
			}
			return false;
		}

		public function create_upload_directory() {
			$path = dirname( $this->get_database_path() );

			if ( ! file_exists( $path ) ) {
				mkdir( $path, 0777, true );
			}

			if ( ! file_exists( $path . '/.htaccess' ) ) {
				file_put_contents( $path . '/.htaccess', 'deny from all' );
			}
		}

		public function get_database_path(): string {
			$upload_dir = wp_upload_dir();

			$database_path = trailingslashit( $upload_dir['basedir'] ) . 'ngip/';
			$database_path .= $this->get_db_prefix() . '-' . self::EDITION . self::EXT;

			return $database_path;
		}

		public function get_db_prefix(): string {
			$prefix = get_option( 'ngip_mmdb_prefix' );

			if ( empty( $prefix ) ) {
				$prefix = wp_generate_password( 32, false );
				update_option( 'ngip_mmdb_prefix', $prefix, 'no' );
			}

			return $prefix;
		}
	}
}
