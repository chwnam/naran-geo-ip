<?php
/**
 * NGIP: functions.php
 */

/* Skip ABSPATH check for unit testing. */

if ( ! function_exists( 'ngip' ) ) {
	/**
	 * NGIP_Main alias.
	 *
	 * @return NGIP_Main
	 */
	function ngip(): NGIP_Main {
		return NGIP_Main::get_instance();
	}
}


if ( ! function_exists( 'ngip_parse_module' ) ) {
	/**
	 * Retrieve submodule by given string notaion.
	 *
	 * @param string $module_notation
	 *
	 * @return object|false;
	 */
	function ngip_parse_module( string $module_notation ) {
		return ngip()->get_module_by_notation( $module_notation );
	}
}


if ( ! function_exists( 'ngip_parse_callback' ) ) {
	/**
	 * Return submodule's callback method by given string notation.
	 *
	 * @param Closure|array|string $maybe_callback
	 *
	 * @return callable|array|string
	 * @throws NGIP_Callback_Exception
	 * @example foo.bar@baz ---> array( ngip()->foo->bar, 'baz )
	 */
	function ngip_parse_callback( $maybe_callback ) {
		return ngip()->parse_callback( $maybe_callback );
	}
}


if ( ! function_exists( 'ngip_option' ) ) {
	/**
	 * Alias function for option.
	 *
	 * @return NGIP_Register_Option|null
	 */
	function ngip_option(): ?NGIP_Register_Option {
		return ngip()->registers->option;
	}
}


if ( ! function_exists( 'ngip_comment_meta' ) ) {
	/**
	 * Alias function for comment meta.
	 *
	 * @return NGIP_Register_Comment_Meta|null
	 */
	function ngip_comment_meta(): ?NGIP_Register_Comment_Meta {
		return ngip()->registers->comment_meta;
	}
}


if ( ! function_exists( 'ngip_post_meta' ) ) {
	/**
	 * Alias function for post meta.
	 *
	 * @return NGIP_Register_Post_Meta|null
	 */
	function ngip_post_meta(): ?NGIP_Register_Post_Meta {
		return ngip()->registers->post_meta;
	}
}


if ( ! function_exists( 'ngip_term_meta' ) ) {
	/**
	 * Alias function for term meta.
	 *
	 * @return NGIP_Register_Term_Meta|null
	 */
	function ngip_term_meta(): ?NGIP_Register_Term_Meta {
		return ngip()->registers->term_meta;
	}
}


if ( ! function_exists( 'ngip_user_meta' ) ) {
	/**
	 * Alias function for user meta.
	 *
	 * @return NGIP_Register_User_Meta|null
	 */
	function ngip_user_meta(): ?NGIP_Register_User_Meta {
		return ngip()->registers->user_meta;
	}
}


if ( ! function_exists( 'ngip_script_debug' ) ) {
	/**
	 * Return SCRIPT_DEBUG.
	 *
	 * @return bool
	 */
	function ngip_script_debug(): bool {
		return apply_filters( 'ngip_script_debug', defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG );
	}
}


if ( ! function_exists( 'ngip_format_callback' ) ) {
	/**
	 * Format callback method or function.
	 *
	 * This method does not care about $callable is actually callable.
	 *
	 * @param Closure|array|string $callback
	 *
	 * @return string
	 */
	function ngip_format_callback( $callback ): string {
		if ( is_string( $callback ) ) {
			return $callback;
		} elseif (
			( is_array( $callback ) && 2 === count( $callback ) ) &&
			( is_object( $callback[0] ) || is_string( $callback[0] ) ) &&
			is_string( $callback[1] )
		) {
			if ( method_exists( $callback[0], $callback[1] ) ) {
				try {
					$ref = new ReflectionClass( $callback[0] );
					if ( $ref->isAnonymous() ) {
						return "{AnonymousClass}::{$callback[1]}";
					}
				} catch ( ReflectionException $e ) {
				}
			}

			if ( is_string( $callback[0] ) ) {
				return "{$callback[0]}::{$callback[1]}";
			} elseif ( is_object( $callback[0] ) ) {
				return get_class( $callback[0] ) . '::' . $callback[1];
			}
		} elseif ( $callback instanceof Closure ) {
			return '{Closure}';
		}

		return '{Unknown}';
	}
}
