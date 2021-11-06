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

		public static function regs_activation( NGIP_Register_Activation $register ): Generator {
			// Define your activation regs for callback.
			yield null;
		}

		public static function regs_ajax( NGIP_Register_Ajax $register ): Generator {
			/** @uses NGIP_Admin_Settings::activate_db_schedule() */
			yield new NGIP_Reg_Ajax( 'ngip_activate_db_schedule', 'admins.settings@activate_db_schedule', );
		}

		public static function regs_comment_meta( NGIP_Register_Comment_Meta $register ): Generator {
			// Define your comment meta regs for callback.
			yield null;
		}

		public static function regs_cron( NGIP_Register_Cron $register ): Generator {
			// Define your cron regs for callback.
			yield new NGIP_Reg_Cron( time(), 'ngip_15_days', 'ngip_db_update' );
		}

		public static function regs_cron_schedule( NGIP_Register_Cron_Schedule $register ): Generator {
			// Define your cron schedule regs for callback.
			yield new NGIP_Reg_Cron_Schedule( 'ngip_15_days', 1296000, __( 'NGIP GeoIP DB Update', 'ngip' ) );
		}

		public static function regs_deactivation( NGIP_Register_Deactivation $register ): Generator {
			// Define your deactivation regs for callback.
			yield null;
		}

		public static function regs_option( NGIP_Register_Option $register ): Generator {
			// Define your option regs for callback.
			yield 'settings' => new NGIP_Reg_Option(
				'ngip_settings',
				'ngip_settings',
				[
					'type'              => 'array',
					'description'       => 'NGIP settings array',
					'sanitize_callback' => [ NGIP_Settings::class, 'sanitize' ],
					'show_in_rest'      => false,
					'default'           => [ NGIP_Settings::class, 'get_default' ],
					'autoload'          => false,
				]
			);
		}

		public static function regs_post_meta( NGIP_Register_Post_Meta $register ): Generator {
			// Define your post meta regs for callback.
			yield null;
		}

		public static function regs_post_type( NGIP_Register_Post_Type $register ): Generator {
			// Define your post type regs for callback.
			yield null;
		}

		public static function regs_script( NGIP_Register_Script $register ): Generator {
			// Define your script regs for callback.
			yield new NGIP_Reg_Script(
				'ngip-set-next-schedule',
				$register->src_helper( 'set-next-schdule.js' ),
				[ 'jquery' ]
			);
		}

		public static function regs_style( NGIP_Register_Style $register ): Generator {
			// Define your style regs for callback.
			yield null;
		}

		public static function regs_submit( NGIP_Register_Submit $register ): Generator {
			// Define your submit regs for callback.
			yield null;
		}

		public static function regs_taxonomy( NGIP_Register_Taxonomy $register ): Generator {
			// Define your taxonomy regs for callback.
			yield null;
		}

		public static function regs_term_meta( NGIP_Register_Term_Meta $register ): Generator {
			// Define your term meta regs for callback.
			yield null;
		}

		public static function regs_user_meta( NGIP_Register_User_Meta $register ): Generator {
			// Define your user meta regs for callback.
			yield null;
		}

		public static function regs_uninstall( NGIP_Register_Uninstall $register ): Generator {
			// Define your user meta regs for callback.
			yield null;
		}
	}
}
