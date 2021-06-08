<?php
/**
 * Header Builder - Main File.
 *
 * @author  Webnus
 */

// don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

if ( ! class_exists( 'Webnus_Header_Builder' ) ) :
	class Webnus_Header_Builder {

		/**
		 * Instance of this class.
		 *
		 * @since   1.0.0
		 * @access  private
		 * @var     Webnus_Header_Builder
		 */
		private static $instance;

		/**
		 * The modules variable holds all modules of the plugin.
		 *
		 * @since   1.0.0
		 * @access  private
		 * @var     object
		 */
		private static $modules = array();

		/**
		 * Main path.
		 *
		 * @since   1.0.0
		 * @access  private
		 * @var     string
		 */
		private static $path;

		/**
		 * Absolute url.
		 *
		 * @since   1.0.0
		 * @access  private
		 * @var     string
		 */
		private static $url;

		/**
		 * The current version of the WEBNUS Header Builder.
		 *
		 * @since    1.0.0
		 */
		const VERSION = '1.0.0';

		/**
		 * The WEBNUS Header Builder prefix to reference classes inside it.
		 *
		 * @since   1.0.0
		 */
		const CLASS_PREFIX = 'WHB_';

		/**
		 * The WEBNUS Header Builder prefix to reference files and prefixes inside it.
		 *
		 * @since   1.0.0
		 */
		const FILE_PREFIX = 'whb-';

		/**
		 * Provides access to a single instance of a module using the singleton pattern.
		 *
		 * @since   1.0.0
		 * @return  object
		 */
		public static function get_instance() {
			if ( self::$instance === null ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Define the core functionality of the WEBNUS Header Builder.
		 *
		 * Load the dependencies.
		 *
		 * @since   1.0.0
		 */
		public function __construct() {
			self::$path = DEEP_CORE_DIR . 'admin/header-builder/';
			self::$url  = DEEP_CORE_URL . 'admin/header-builder/';

			require_once self::$path . 'includes/functions/whb-functions.php';
			require_once self::$path . 'includes/' . self::FILE_PREFIX . 'class-loader.php';

			self::$modules['WHB_Loader'] = WHB_Loader::get_instance();
			self::$modules['WHB_Helper'] = WHB_Helper::get_instance();
			// WHB_Helper::clearHeaderData();
			WHB_Helper::setHeaderDefaultData();
			self::$modules['WHB_Enqueue']          = WHB_Enqueue::get_instance();
			self::$modules['WHB_Multilanguage']    = WHB_Multilanguage::get_instance();
			self::$modules['WHB_Ajax']             = WHB_Ajax::get_instance();
			self::$modules['WHB_Field']            = WHB_Field::get_instance();
			self::$modules['WHB_Element']          = WHB_Element::get_instance();
			self::$modules['WHB_Output']           = WHB_Output::get_instance();
			self::$modules['WHB_Frontend_Builder'] = WHB_Frontend_Builder::get_instance();
		}

		/**
		 * Get the WEBNUS Header Builder absolute path.
		 *
		 * @since   1.0.0
		 */
		public static function get_path() {
			return self::$path;
		}

		/**
		 * Get the WEBNUS Header Builder absolute url.
		 *
		 * @since   1.0.0
		 */
		public static function get_url() {
			return self::$url;
		}

	}

	// Create a simple alias
	class_alias( 'Webnus_Header_Builder', 'WHB' );

	// Run WEBNUS Header Builder
	WHB::get_instance();
endif;
