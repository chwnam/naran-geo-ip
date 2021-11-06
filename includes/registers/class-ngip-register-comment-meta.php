<?php
/**
 * NGIP: Comment meta register
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Register_Comment_Meta' ) ) {
	/**
	 * NOTE: Add 'property-read' phpdoc to make your editor inspect meta items.
	 */
	class NGIP_Register_Comment_Meta extends NGIP_Reigster_Base_Meta {
		/**
		 * Define items here.
		 *
		 * To use alias, do not forget to return generator as 'key => value' form!
		 *
		 * @return Generator
		 */
		public function get_items(): Generator {
			yield; // yield 'alias' => new NGIP_Reg_Meta();
		}
	}
}
