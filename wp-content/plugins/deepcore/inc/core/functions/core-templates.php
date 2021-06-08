<?php
/**
 * Deep Theme.
 *
 * The main theme handler class is responsible for initializing Deep.
 *
 * @since   1.0.0
 * @author  Webnus
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WN_Core_Templates {

	/**
	 * Instance of this class.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     WN_Core_Templates
	 */
	public static $instance;

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
	 * Theme Options array.
	 *
	 * @since   1.0.0
	 * @access  protected
	 * @var     array
	 */
	protected $theme_options;

	/**
	 * Define the core functionality of the theme.
	 *
	 * Load the dependencies.
	 *
	 * @since   1.0.0
	 */
	public function __construct() {
		$this->theme_options = function_exists( 'deep_options' ) ? deep_options() : '';
	}

	/**
	 * Get header template.
	 *
	 * @since   1.0.0
	 */
	public function get_header() {
		get_header();
	}

	/**
	 * Get footer template.
	 *
	 * @since   1.0.0
	 */
	public function get_footer() {
		get_footer();
	}

}
// Run
WN_Core_Templates::get_instance();