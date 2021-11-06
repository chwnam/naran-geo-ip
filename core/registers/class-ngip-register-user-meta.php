<?php
/**
 * NGIP: User meta register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_User_Meta' ) ) {
	/**
	 * NOTE: Add 'property-read' phpdoc to make your editor inspect meta items.
	 */
	class NGIP_Register_User_Meta extends NGIP_Reigster_Meta {
		/**
		 * Define items here.
		 *
		 * To use alias, do not forget to return generator as 'key => value' form!
		 *
		 * @return Generator
		 */
		public function get_items(): Generator {
			yield call_user_func( [ NGIP_Registers::class, 'regs_user_meta' ], $this );
		}
	}
}
