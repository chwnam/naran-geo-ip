<?php
/**
 * NGIP: Registers module
 *
 * Manage all registers
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Registers' ) ) {
	/**
	 * You can remove unused registers.
	 *
	 * @property-read NGIP_Register_Activation    $activation
	 * @property-read NGIP_Register_Ajax          $ajax
	 * @property-read NGIP_Register_Comment_Meta  $comment_meta
	 * @property-read NGIP_Register_Cron          $cron
	 * @property-read NGIP_Register_Cron_Schedule $cron_schedule
	 * @property-read NGIP_Register_Deactivation  $deactivation
	 * @property-read NGIP_Register_Option        $option
	 * @property-read NGIP_Register_Post_Meta     $post_meta
	 * @property-read NGIP_Register_Post_Type     $post_type
	 * @property-read NGIP_Register_Script        $script
	 * @property-read NGIP_Register_Style         $style
	 * @property-read NGIP_Register_Submit        $submit
	 * @property-read NGIP_Register_Taxonomy      $taxonomy
	 * @property-read NGIP_Register_Term_Meta     $term_meta
	 * @property-read NGIP_Register_User_Meta     $user_meta
	 */
	class NGIP_Registers implements NGIP_Module {
		use NGIP_Submodule_Impl;

		public function __construct() {
			/**
			 * You can remove unused registers.
			 */
			$this->assign_modules(
				[
//					'activation'    => NGIP_Register_Activation::class,
					'ajax'          => NGIP_Register_Ajax::class,
//					'comment_meta'  => NGIP_Register_Comment_Meta::class,
					'cron'          => NGIP_Register_Cron::class,
					'cron_schedule' => NGIP_Register_Cron_Schedule::class,
//					'deactivation'  => NGIP_Register_Deactivation::class,
					'option'        => NGIP_Register_Option::class,
//					'post_meta'     => NGIP_Register_Post_Meta::class,
//					'post_type'     => NGIP_Register_Post_Type::class,
					'script'        => NGIP_Register_Script::class,
					'style'         => NGIP_Register_Style::class,
//					'submit'        => NGIP_Register_Submit::class,
//					'taxonomy'      => NGIP_Register_Taxonomy::class,
//					'term_meta'     => NGIP_Register_Term_Meta::class,
					// NOTE: 'uninstall' is not a part of registers submodules.
					//       Because it 'uninstall' hook requires static method callback.
//					'user_meta'     => NGIP_Register_User_Meta::class,
				]
			);
		}
	}
}
