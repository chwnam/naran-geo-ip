<?php
/**
 * Naran GeoIP: Modules trait
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! trait_exists( 'NGIP_Submodules_Impl' ) ) {
	trait NGIP_Submodules_Impl {
		private array $_modules = [];

		/**
		 * Get submodule by name.
		 *
		 * @param string $name
		 *
		 * @return NGIP_Module|null
		 */
		public function __get( string $name ): ?NGIP_Module {
			$module = $this->_modules[ $name ] ?? null;

			if ( $module instanceof Closure ) {
				$this->_modules[ $name ] = $module = $module();
			}

			return $module;
		}

		/**
		 * Check if submodule exists
		 *
		 * @param string $name
		 *
		 * @return bool
		 */
		public function __isset( string $name ): bool {
			return isset( $this->_modules[ $name ] );
		}

		/**
		 * Block __set() magic method.
		 *
		 * @param string $name
		 * @param mixed  $value
		 */
		public function __set( string $name, mixed $value ) {
			throw new RuntimeException( 'Value assign is not allowed.' );
		}

		/**
		 * Assign modules.
		 *
		 * @param array $modules
		 */
		protected function assign_modules( array $modules ) {
			$this->_modules = $modules;

			foreach ( $this->_modules as $idx => $module ) {
				if ( is_string( $module ) && class_exists( $module ) ) {
					$this->_modules[ $idx ] = new $module();
				}
			}
		}
	}
}
