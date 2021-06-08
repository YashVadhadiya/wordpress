<?php
/**
 * Deep Theme Assets.
 *
 * @package Deep Theme
 */

namespace DeepTheme\Assets;

/**
 * Class Deep_Theme_Assets.
 */
class Deep_Theme_Assets {

	/**
	 * Instance of this class.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     Deep_Theme_Assets
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
	 * Constructor.
	 *
	 * @access private
	 * @since 1.0.0
	 */
	private function __construct() {
        $this->load_dependencies();
        $this->hooks();
	}

    /**
	 * Load the dependencies.
	 *
	 * @access private
	 * @since 1.0.0
	 */
    private function load_dependencies() { }

    /**
	 * Hooks.
	 *
	 * @access private
	 * @since 1.0.0
	 */
    private function hooks() {

		add_action( 'wp_enqueue_scripts', [$this, 'enqueue_scripts'] );
		add_action( 'wp_enqueue_scripts', [$this, 'enqueue_style'] );

	}

	/**
	 * enqueue scripts.
	 *
	 * @access public
	 * @since 1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( 'deep-theme-navigation', DEEP_THEME_URI . '/assets/js/navigation.js', array(), DEEPTHEME, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

    }

	/**
	 * enqueue style.
	 *
	 * @access public
	 * @since 1.0.0
	 */
	public function enqueue_style() {

		wp_style_add_data( 'deep-theme-style', 'rtl', 'replace' );
		wp_enqueue_style( 'deep-theme-style', get_stylesheet_uri(), array(), DEEPTHEME );
        wp_enqueue_style( 'deeptheme-style', DEEP_THEME_URI . '/assets/css/deep-theme-style.css', array(), DEEPTHEME );

    }

}

Deep_Theme_Assets::get_instance();
