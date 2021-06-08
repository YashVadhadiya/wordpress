<?php
/**
 * Header Builder - Element Class.
 *
 * @author	Webnus
 */

// don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

if ( ! class_exists( 'WHB_Element' ) ) :

    class WHB_Element {

		/**
		 * Instance of this class.
         *
		 * @since	1.0.0
		 * @access	private
		 * @var		WHB_Element
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
		public function __construct() {

			// Load frontend output
            $this->load_frontend();

		}

		/**
		 * Load frontend.
		 *
		 * @since	1.0.0
		 */
		public function load_frontend() {

			foreach ( glob( WHB_Helper::get_file( 'includes/elements/components/frontend/' . WHB::FILE_PREFIX . '*.php' ) ) as $file ) {
				include_once $file;
            }

        }

    }

endif;
