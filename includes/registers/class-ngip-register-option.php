<?php
/**
 * NGIP: Option register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Option' ) ) {
	/**
	 * @property-read NGIP_Reg_Option $settings
	 */
	class NGIP_Register_Option extends NGIP_Register_Base_Option {
		/**
		 * Define items here.
		 *
		 * To use alias, do not forget to return generator as 'key => value' form!
		 *
		 * @return Generator
		 */
		public function get_items(): Generator {
			yield 'settings' => new NGIP_Reg_Option(
				'ngip_settings',
				'ngip_settings',
				[
					'type'              => 'array',
					'description'       => 'NGIP settings array',
					'sanitize_callback' => [ NGIP_Settings::class, 'sanitize' ],
					'show_in_rest'      => false,
					'default'           => NGIP_Settings::get_default(),
					'autoload'          => false,
				]
			);
		}
	}
}
