<?php
/**
 * NGIP: Custom post type reg.
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Reg_Post_Type' ) ) {
	class NGIP_Reg_Post_Type implements NGIP_Reg {
		public  $post_type;

		public  $args;

		public function __construct( string $post_type, array $args ) {
			$this->post_type = $post_type;
			$this->args      = $args;
		}

		public function register( $dispatch = null ) {
			if ( ! post_type_exists( $this->post_type ) ) {
				$return = register_post_type( $this->post_type, $this->args );
				if ( is_wp_error( $return ) ) {
					wp_die( $return );
				}
			}
		}
	}
}
