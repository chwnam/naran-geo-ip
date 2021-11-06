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
