<?php
/**
 * Deep Preloader.
 *
 * @package Deep
 */

namespace Deep\Preloader;

defined( 'ABSPATH' ) || exit;

use Deep\Front as Front;

/**
 * Class Deep_Preloader.
 */
class Deep_Preloader {

	/**
	 * Instance of this class.
	 *
	 * @since   4.4.0
	 * @access  public
	 * @var     Deep_Preloader
	 */
	public static $instance;

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
    private function load_dependencies() { }

    /**
	 * Hooks.
	 *
	 * @access private
	 * @since 4.4.0
	 */
    private function hooks() {
        add_action( 'wp_footer', [$this, 'deep_preloader'] );
		add_action( 'wp_enqueue_scripts', [$this, 'enqueue_scripts'] );
		add_action( 'wp_enqueue_scripts', [$this, 'enqueue_style'] );
    }


	/**
	 * Deep Preloader.
	 *
	 * @access public
	 * @since 4.4.0
	 */
	public function deep_preloader() {
        $deep_options = Front\Deep_Front::deep_options();
		$enable_preloader = isset( $deep_options['enable_preloader'] ) && $deep_options['enable_preloader'] == '1' ? $deep_options['enable_preloader'] : false;

		if ( $enable_preloader ) {
			wp_enqueue_style( 'deep-preloader-item',  DEEP_ASSETS_URL . 'css/frontend/preloader/preloader-' . esc_attr( $deep_options['preloader_spinkit'] ) . '.css', false, DEEP_VERSION );
			$preloader_logo		= isset( $deep_options['preloader_logo'] ) && !empty($deep_options['preloader_logo']['url']) ? $deep_options['preloader_logo']['url'] : '';
			$preloader_bg_color = isset( $deep_options['preloader_bg_color'] ) ? $deep_options['preloader_bg_color'] : '';
			$preloader_spinkit	= isset( $deep_options['preloader_spinkit'] ) ? $deep_options['preloader_spinkit'] : '7';
			$preloader_bg_timeout = isset( $deep_options['preloader_bg_timeout'] ) ? $deep_options['preloader_bg_timeout'] : '';

			switch ($preloader_spinkit) {
				case '1':
					$loadingHtml = '<div class="sk-spinner sk-spinner-rotating-plane"></div>';
					break;
				case '2':
					$loadingHtml = '
					<div class="sk-spinner sk-spinner-double-bounce">
						<div class="sk-double-bounce1"></div>
						<div class="sk-double-bounce2"></div>
					</div>';
					break;
				case '3':
					$loadingHtml = '
					<div class="sk-spinner sk-spinner-wave">
						<div class="sk-rect1"></div>
						<div class="sk-rect2"></div>
						<div class="sk-rect3"></div>
						<div class="sk-rect4"></div>
						<div class="sk-rect5"></div>
					</div>';
					break;
				case '4':
					$loadingHtml = '
					<div class="sk-spinner sk-spinner-wandering-cubes">
						<div class="sk-cube1"></div>
						<div class="sk-cube2"></div>
					</div>';
					break;
				case '5':
					$loadingHtml = '<div class="sk-spinner sk-spinner-pulse"></div>';
					break;
				case '6':
					$loadingHtml = '
					<div class="sk-spinner sk-spinner-chasing-dots">
						<div class="sk-dot1"></div>
						<div class="sk-dot2"></div>
					</div>';
					break;
				case '7':
					$loadingHtml = '
					<div class="sk-spinner sk-spinner-three-bounce">
						<div class="sk-bounce1"></div>
						<div class="sk-bounce2"></div>
						<div class="sk-bounce3"></div>
					</div>';
					break;
				case '8':
					$loadingHtml = '
					<div class="sk-spinner sk-spinner-circle">
						<div class="sk-circle1 sk-circle"></div>
						<div class="sk-circle2 sk-circle"></div>
						<div class="sk-circle3 sk-circle"></div>
						<div class="sk-circle4 sk-circle"></div>
						<div class="sk-circle5 sk-circle"></div>
						<div class="sk-circle6 sk-circle"></div>
						<div class="sk-circle7 sk-circle"></div>
						<div class="sk-circle8 sk-circle"></div>
						<div class="sk-circle9 sk-circle"></div>
						<div class="sk-circle10 sk-circle"></div>
						<div class="sk-circle11 sk-circle"></div>
						<div class="sk-circle12 sk-circle"></div>
					</div>';
					break;
				case '9':
					$loadingHtml = '
					<div class="sk-spinner sk-spinner-cube-grid">
						<div class="sk-cube"></div>
						<div class="sk-cube"></div>
						<div class="sk-cube"></div>
						<div class="sk-cube"></div>
						<div class="sk-cube"></div>
						<div class="sk-cube"></div>
						<div class="sk-cube"></div>
						<div class="sk-cube"></div>
						<div class="sk-cube"></div>
					</div>';
					break;
				case '10':
					$loadingHtml = '
					<div class="sk-spinner sk-spinner-fading-circle">
						<div class="sk-circle1 sk-circle"></div>
						<div class="sk-circle2 sk-circle"></div>
						<div class="sk-circle3 sk-circle"></div>
						<div class="sk-circle4 sk-circle"></div>
						<div class="sk-circle5 sk-circle"></div>
						<div class="sk-circle6 sk-circle"></div>
						<div class="sk-circle7 sk-circle"></div>
						<div class="sk-circle8 sk-circle"></div>
						<div class="sk-circle9 sk-circle"></div>
						<div class="sk-circle10 sk-circle"></div>
						<div class="sk-circle11 sk-circle"></div>
						<div class="sk-circle12 sk-circle"></div>
					</div>';
					break;
				case '11':
					$loadingHtml = '
						<div class="wn-sd-snt-icon">
							<div class="spinner">
								<div class="right-side"><div class="bar"></div></div>
								<div class="left-side"><div class="bar"></div></div>
							</div>
							<div class="spinner color-2">
								<div class="right-side"><div class="bar"></div></div>
								<div class="left-side"><div class="bar"></div></div>
							</div>
						</div>';
					break;
				case '12':
					$loadingHtml = '
						<div class="slor-loader">
							<div class="loading">
								<div class="bounceball"></div>
								<div class="text">' . __( 'NOW LOADING', 'deep' ) . '</div>
							</div>
						</div>';
					break;
				case '13':
					$loadingHtml = '
						<div class="jetloader">
							<span>
								<span></span>
								<span></span>
								<span></span>
								<span></span>
							</span>
							<div class="base">
								<span></span>
								<div class="face"></div>
							</div>
						</div>
						<div class="longfazers">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
						</div>
						<p class="loading-content">' . __( 'Redirecting', 'deep' ) . '</p>';
					break;
			}
			$preloader_image = !empty( $preloader_logo ) ? '<img alt="preloader-logo" class="pg-loading-logo" src="' . esc_url( $preloader_logo ) . '">' : '';
			$out = '
				<div class="pg-loading-screen" style="background: ' . esc_attr( $preloader_bg_color ) . ';" data-timeout="' . esc_attr( $preloader_bg_timeout ) . '">
					<div class="pg-loading-inner">
						<div class="pg-loading-center-outer">
							<div class="pg-loading-center-middle">
								<div class="pg-loading-logo-header">
									' . $preloader_image . '
								</div>
								<div class="pg-loading-html">
									' . $loadingHtml . '
								</div>
							</div>
						</div>
					</div>
				</div>';
			echo $out;
		}
    }

	/**
	 * enqueue scripts.
	 *
	 * @access public
	 * @since 4.4.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'deep-preloader', DEEP_ASSETS_URL . 'js/libraries/preloader.js', array( 'jquery' ), DEEP_VERSION, true );
	}

	/**
	 * enqueue style.
	 *
	 * @access public
	 * @since 4.4.0
	 */
	public function enqueue_style() {
		wp_enqueue_style( 'deep-preloader',  DEEP_ASSETS_URL . 'css/libraries/preloader.css', false, DEEP_VERSION );
	}

}

Deep_Preloader::get_instance();
