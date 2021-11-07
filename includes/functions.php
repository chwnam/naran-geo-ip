<?php
/**
 * NGIP: Functions
 */

/* Skip ABSPATH check for unit testing. */

// Define your functions here.

if ( ! function_exists( 'ngip_settings' ) ) {
	/**
	 * NGIP_Settings alias.
	 *
	 * @return NGIP_Settings
	 */
	function ngip_settings(): NGIP_Settings {
		return ngip()->settings;
	}
}

if ( ! function_exists( 'ngip_query_ip' ) ) {
	/**
	 * NGIP_Query_IP alias.
	 *
	 * @return NGIP_Query_IP
	 */
	function ngip_query_ip(): NGIP_Query_IP {
		return ngip()->query_ip;
	}
}


if ( ! function_exists( 'ngip_updater' ) ) {
	/**
	 * NGIP_Updater alias.
	 *
	 * @return NGIP_Updater
	 */
	function ngip_updater(): NGIP_Updater {
		return ngip()->updater;
	}
}


if ( ! function_exists( 'ngip_get_maxmind_license_key' ) ) {
	/**
	 * Return MaxMind lincese key.
	 *
	 * @return string
	 */
	function ngip_get_maxmind_license_key(): string {
		return ngip_settings()->get_license_key();
	}
}


if ( ! function_exists( 'ngip_get_database_path' ) ) {
	/**
	 * Get MaxMind GeoIP2 database path
	 *
	 * @return string
	 */
	function ngip_get_database_path(): string {
		return ngip_settings()->get_database_path();
	}
}


if ( ! function_exists( 'ngip_get_database_version' ) ) {
	/**
	 * Get MaxMind GeoIP2 database version
	 *
	 * @return string
	 */
	function ngip_get_database_version(): string {
		return ngip_settings()->get_database_version();
	}
}


if ( ! function_exists( 'ngip_get_external_ip' ) ) {
	/**
	 * Return external IP address
	 *
	 * @param bool $cache_local_ip
	 *
	 * @return string
	 */
	function ngip_get_external_ip( bool $cache_local_ip ): string {
		return ngip_query_ip()->get_external_ip( $cache_local_ip );
	}
}


if ( ! function_exists( 'ngip_query_maxmind_database' ) ) {
	/**
	 * Query IP
	 *
	 * @param string $ip
	 *
	 * @return array|WP_Error
	 */
	function ngip_query_maxmind_database( string $ip ) {
		return ngip_query_ip()->query_maxmind_database( $ip );
	}
}


if ( ! function_exists( 'ngip_geolocate_ip' ) ) {
	/**
	 * Get country code from client ip address
	 *
	 * @return array 0th: IP address found, 1st: ISO Coutry code.
	 */
	function ngip_geolocate_ip(): array {
		return ngip_query_ip()->geolocate_ip();
	}
}
