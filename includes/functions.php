<?php
/**
 * Naran GeoIP: functions.php
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'ngip' ) ) {
	/**
	 * Return Naran Geo IP main class.
	 */
	function ngip(): NGIP_Container {
		return NGIP_Container::get_instance();
	}
}

if ( ! function_exists( 'ngip_parse_module' ) ) {
	/**
	 * @param string $module_notation
	 *
	 * @return object|false;
	 */
	function ngip_parse_module( string $module_notation ): object|false {
		static $cache = [];

		if ( class_exists( $module_notation ) ) {
			return new $module_notation();
		} elseif ( $module_notation ) {
			if ( ! isset( $cache[ $module_notation ] ) ) {
				$module = ngip();
				foreach ( explode( '.', $module_notation ) as $crumb ) {
					if ( isset( $module->{$crumb} ) ) {
						$module = $module->{$crumb};
					} else {
						$module = false;
						break;
					}
				}
				$cache[ $module_notation ] = $module;
			}
			return $cache[ $module_notation ];
		}

		return false;
	}
}


if ( ! function_exists( 'ngip_parse_callback' ) ) {
	/**
	 * Parse string as module's callback method.
	 *
	 * @param Closure|array|string $maybe_callback
	 *
	 * @return callable|array|false
	 */
	function ngip_parse_callback( Closure|array|string $maybe_callback ): callable|array|false {
		if ( is_callable( $maybe_callback ) ) {
			return $maybe_callback;
		} elseif ( is_string( $maybe_callback ) && str_contains( $maybe_callback, '@' ) ) {
			[ $module_part, $method ] = explode( '@', $maybe_callback, 2 );

			$module = ngip_parse_module( $module_part );

			if ( $module && method_exists( $module, $method ) ) {
				$callback = [ $module, $method ];
			} else {
				$callback = false;
			}

			return $callback;
		}

		return false;
	}
}