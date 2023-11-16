<?php
/**
 * NGIP: Main base
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NGIP_Main_Base' ) ) {
	/**
	 * Class NGIP_Main_Base
	 */
	abstract class NGIP_Main_Base implements NGIP_Module {
		use NGIP_Hook_Impl;
		use NGIP_Submodule_Impl;

		/**
		 * @var NGIP_Main_Base|null
		 */
		private static  $instance = null;

		/**
		 * Free storage for the plugin.
		 *
		 * @var array
		 */
		private  $storage = [];

		/**
		 * Parsed module cache.
		 * Key:   input string notation.
		 * Value: found module, or false.
		 *
		 * @var array
		 */
		private  $parsed_cache = [];

		/**
		 * Get instance method.
		 *
		 * @return NGIP_Main_Base
		 */
		public static function get_instance(): NGIP_Main_Base {
			if ( is_null( self::$instance ) ) {
				self::$instance = new static();
				self::$instance->initialize();
			}
			return self::$instance;
		}

		/**
		 * NGIP_Main_Base constructor.
		 */
		protected function __construct() {
		}

		/**
		 * Return plugin main file.
		 *
		 * @return string
		 */
		public function get_main_file(): string {
			return NGIP_MAIN_FILE;
		}

		/**
		 * Get default priority
		 *
		 * @return int
		 */
		public function get_priority(): int {
			return NGIP_PRIORITY;
		}

		/**
		 * Retrieve submodule by given string notaion.
		 *
		 * @param string $module_notation
		 *
		 * @return object|false
		 */
		public function get_module_by_notation( string $module_notation ) {
			if ( class_exists( $module_notation ) ) {
				return new $module_notation();
			} elseif ( $module_notation ) {
				if ( ! isset( $this->parsed_cache[ $module_notation ] ) ) {
					$module = $this;
					foreach ( explode( '.', $module_notation ) as $crumb ) {
						if ( isset( $module->{$crumb} ) ) {
							$module = $module->{$crumb};
						} else {
							$module = false;
							break;
						}
					}
					$this->parsed_cache[ $module_notation ] = $module;
				}

				return $this->parsed_cache[ $module_notation ];
			}

			return false;
		}

		/**
		 * Return submodule's callback method by given string notation.
		 *
		 * @param Closure|array|string $item
		 *
		 * @return Closure|array|string
		 * @throws NGIP_Callback_Exception
		 * @example foo.bar@baz ---> array( ngip()->foo->bar, 'baz )
		 */
		public function parse_callback( $item ) {
			if ( is_callable( $item ) ) {
				return $item;
			} elseif ( is_string( $item ) && false !== strpos( $item, '@' ) ) {
				[ $module_part, $method ] = explode( '@', $item, 2 );

				$module = $this->get_module_by_notation( $module_part );

				if ( $module && is_callable( [ $module, $method ] ) ) {
					return [ $module, $method ];
				}
			}

			throw new NGIP_Callback_Exception(
				sprintf(
				/* translators: formatted module name. */
					__( '%s is invalid for callback.', 'ngip' ),
					ngip_format_callback( $item )
				),
				100
			);
		}

		/**
		 * Get the theme version
		 *
		 * @return string
		 */
		public function get_version(): string {
			return NGIP_VERSION;
		}

		/**
		 * Get something from storage.
		 */
		public function get( string $key, $default = '' ) {
			return $this->storage[ $key ] ?? $default;
		}

		/**
		 * Set something to storage.
		 */
		public function set( string $key, $value ) {
			$this->storage[ $key ] = $value;
		}

		/**
		 * Initialize conditional modules.
		 *
		 * @return void
		 */
		public function init_conditional_modules() {
		}

		/**
		 * Return root modules
		 *
		 * @return array
		 */
		abstract protected function get_modules(): array;

		protected function initialize() {
			$this->assign_modules( $this->get_modules() );

			$this->add_action( 'wp', 'init_conditional_modules' );

			do_action( 'ngip_initialized' );
		}
	}
}
