<?php
/**
 * Header Builder - Field Class.
 *
 * @author  Webnus
 */

// don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

if ( ! class_exists( 'WHB_Field' ) ) :

    class WHB_Field {

		/**
		 * Instance of this class.
         *
		 * @since	1.0.0
		 * @access	private
		 * @var		WHB_Field
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

			// if ( is_admin() ) {

				// Load icons
				$this->load_icons();

				// Load all fields
				$this->load_fields();

				// Load styling tab
				$this->load_styling_tab();

			// }

			// if ( ! is_admin() || WHB_Helper::is_frontend_builder() ) {

				// Load styling tab output
				$this->load_styling_tab_output();

			// }

		}

		/**
		 * Load icons.
		 *
		 * @since	1.0.0
		 */
        public function load_icons() {

            include_once WHB_Helper::get_file( 'includes/fields/icons/' . WHB::FILE_PREFIX . 'icons.php' );

        }

		/**
		 * Load all fields.
		 *
		 * @since	1.0.0
		 */
        public function load_fields() {

            foreach ( glob( WHB_Helper::get_file( 'includes/fields/' . WHB::FILE_PREFIX . '*.php' ) ) as $file ) {
                include_once $file;
            }

        }

		/**
		 * Load styling tab.
		 *
		 * @since	1.0.0
		 */
        public function load_styling_tab() {

            include_once WHB_Helper::get_file( 'includes/fields/styling-tab/' . WHB::FILE_PREFIX . 'styling-tab.php' );

        }

		/**
		 * Load styling tab output.
		 *
		 * @since	1.0.0
		 */
        public function load_styling_tab_output() {

            include_once WHB_Helper::get_file( 'includes/fields/styling-tab/' . WHB::FILE_PREFIX . 'styling-tab-output.php' );            

        }

    }

endif;
