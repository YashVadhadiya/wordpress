<?php

/**
 * Header Builder - Loader Class.
 *
 * @author Webnus
 */

// don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

if ( ! class_exists( 'WHB_Loader' ) ) {

	class WHB_Loader {

		/**
		 * Instance of this class.
         *
		 * @since	1.0.0
		 * @access	private
		 * @var		WHB_Loader
		 */
		private static $instance;

		/**
		 * Provides access to a single instance of a module using the singleton pattern.
		 *
		 * @since	1.0.0
		 * @return	object
		 */
		public static function get_instance() {

			if ( self::$instance === null ) {
				self::$instance = new self();
            }

			return self::$instance;

		}

		/**
		 * Constructor.
		 *
		 * @since	1.0.0
		 */
		protected function __construct() {

			spl_autoload_register( array( $this, 'load_dependencies' ) );

		}

		/**
		 * Loads all the WEBNUS Header Builder dependencies.
		 *
		 * @since	1.0.0
		 */
		private function load_dependencies( $class ) {

			if ( strpos( $class, WHB::CLASS_PREFIX ) !== false ) {

				$classFileName	= WHB::FILE_PREFIX . 'class-' . str_replace( WHB::FILE_PREFIX, '', str_replace( '_', '-', strtolower( $class ) ) ) . '.php';
				$path			= WHB::get_path() . 'includes/' . $classFileName;

				require_once $path;

			}

		}

	}

}
