<?php
/**
 * Deep Front.
 *
 * @package Deep
 */

namespace Deep\Front;

defined( 'ABSPATH' ) || exit;

/**
 * Class Deep_Front.
 */
class Deep_Front {

	/**
	 * Instance of this class.
	 *
	 * @since   4.4.0
	 * @access  public
	 * @var     Deep_Front
	 */
	public static $instance;

	/**
	 * Front sections directory path.
	 */
	public const FRONT_SECTIONS = DEEP_INCLUDES_DIR . 'front/front-sections/';

	/**
	 * Front directory path.
	 */
	public const FRONT = DEEP_INCLUDES_DIR . 'front/';

	/**
	 * Provides access to a single instance of a module using the singleton pattern.
	 *
	 * @since   4.4.0
	 * @return  object
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
	 * @access private
	 * @since 4.4.0
	 */
	private function __construct() {
        $this->load_dependencies();
        $this->hooks();
	}

    /**
	 * Load the dependencies.
	 *
	 * @access private
	 * @since 4.4.0
	 */
    private function load_dependencies() {

		// Preloader Class
		if ( self::deep_options()['enable_preloader'] == '1' ) {
			require_once self::FRONT_SECTIONS . 'class-deep-preloader.php';
		}

		// Assets Class
		require_once self::FRONT . 'class-deep-assets.php';

	}

    /**
	 * Hooks.
	 *
	 * @access private
	 * @since 4.4.0
	 */
    private function hooks() { }

	/**
	 * Deep Options.
	 *
	 * @access public
	 * @since 4.4.0
	 */
	public static function deep_options() {
		$deep_options = get_option( 'deep_options' );
		return $deep_options;
	}

}

Deep_Front::get_instance();
