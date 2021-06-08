<?php
/**
 * Deep Assets.
 *
 * @package Deep
 */

namespace Deep\Assets;

defined( 'ABSPATH' ) || exit;

use Deep\Front as Front;

/**
 * Class Deep_Assets.
 */
class Deep_Assets {

	/**
	 * Instance of this class.
	 *
	 * @since   4.4.0
	 * @access  public
	 * @var     Deep_Assets
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
		add_action( 'init', [$this, 'dyn_styles_dir'] );
		add_action( 'wp_enqueue_scripts', [$this, 'enqueue_scripts'] );
		add_action( 'wp_enqueue_scripts', [$this, 'enqueue_style'], 99  );
	}

    /**
	 * Dynamic styles directory.
	 *
	 * @access public
	 * @since 4.4.0
	 */
	public function dyn_styles_dir() {
        $dyn_dir = DEEP_ASSETS_DIR . 'css/frontend/dynamic-style';

        wp_mkdir_p( $dyn_dir );
    }

	/**
	 * enqueue scripts.
	 *
	 * @access public
	 * @since 4.4.0
	 */
	public function enqueue_scripts() {

        $deep_options = Front\Deep_Front::deep_options();

        /**
         * Smooth Scroll.
         */
		if ( $deep_options['deep_enable_smoothscroll'] == '1' ) {
			wp_enqueue_script( 'deep-smooth-scroll', DEEP_ASSETS_URL . 'js/frontend/plugins/smoothscroll.js', array( 'jquery' ), DEEP_VERSION, true );
		}

        /**
         * Nice Scroll.
         */
		if ( $deep_options['deep_custom_scrollbar'] == '1' ) {
			wp_enqueue_script( 'deep-nicescroll-script', DEEP_ASSETS_URL . 'js/libraries/jquery.nicescroll.js', array( 'jquery' ), null, true );
            wp_enqueue_script( 'deep-custom-scrollbar', DEEP_ASSETS_URL . 'js/frontend/deep-custom-scrollbar.js', array( 'jquery' ), DEEP_VERSION, true );
            wp_enqueue_style( 'deep-custom-scrollbar', DEEP_ASSETS_URL . 'css/frontend/plugins/scrollbar.css', false, DEEP_VERSION );
		}

        /**
         * Fast Contact Form.
         */
        if ( defined( 'WPCF7_PLUGIN' ) && $deep_options['deep_fast_contact_form'] == '1' ) {
            wp_enqueue_script( 'deep-fast-contact', DEEP_ASSETS_URL . 'js/frontend/deep-fast-contact.js', array( 'jquery' ), null, true );
            wp_enqueue_style( 'deep-fast-contact', DEEP_ASSETS_URL . 'css/frontend/contact-form/deep-fast-contact.css' );
        }

        /**
         * Top Bar Toggle.
         */
        if ( $deep_options['deep_toggle_toparea_enable'] == '1' ) {
            wp_enqueue_script( 'deep-top-toggle', DEEP_ASSETS_URL . 'js/frontend/deep-top-toggle.js', array( 'jquery' ), null, true );
        }

        /**
         * Scroll Top.
         */
        if ( $deep_options['deep_backto_top'] == '1' ) {
            wp_enqueue_script( 'deep-scroll-top', DEEP_ASSETS_URL . 'js/frontend/deep-scroll-top.js', array( 'jquery' ), null, true );
            wp_enqueue_style( 'deep-scroll-top', DEEP_ASSETS_URL . 'css/frontend/main-style/scroll-top.css', false, DEEP_VERSION );
        }

        /**
         * Single Gallery.
         */
        if ( defined( 'W_GALLERY_VERSION' ) && is_singular( 'gallery' ) ) {
            wp_enqueue_script( 'deep-grid-single-gallery', DEEP_ASSETS_URL . 'js/frontend/deep-grid-single-gallery.js', array( 'jquery' ), null, true );
            wp_enqueue_style( 'deep-single-gallery', DEEP_ASSETS_URL . 'css/frontend/single-gallery/single-gallery.css', false, DEEP_VERSION );
        }

        /**
         * Nice Select.
         */
		if ( is_plugin_active( 'woocommerce/woocommerce.php' ) || is_plugin_active( 'lifterlms/lifterlms.php' ) || function_exists( 'pll_languages_list' ) ) {
			wp_enqueue_script( 'deep-nice-select', DEEP_ASSETS_URL . 'js/frontend/plugins/niceselect.js', array( 'jquery' ), DEEP_VERSION, true);
            wp_enqueue_style( 'deep-nice-select', DEEP_ASSETS_URL . 'css/frontend/plugins/nice-select.css', false, DEEP_VERSION );
		}

        /**
         * Waypoints.
         */
		if ( is_plugin_active( 'devvn-image-hotspot/devvn-image-hotspot.php' ) ) {
			wp_enqueue_script( 'deep-waypoints', DEEP_ASSETS_URL . 'js/frontend/plugins/waypoints.js', array( 'jquery' ), DEEP_VERSION, true);
			wp_enqueue_script( 'deep-devvn-image-hotspot', DEEP_ASSETS_URL . 'js/frontend/deep-devvn-image-hotspot.js', array( 'jquery' ), DEEP_VERSION, true );
		}

        /**
         * Single Sermons.
         */
		if ( is_singular( 'sermon' ) ) {
			wp_enqueue_script( 'deep-magnific-popup', DEEP_ASSETS_URL . 'js/frontend/plugins/magnific-popup.js', array( 'jquery' ), DEEP_VERSION, true );
			wp_enqueue_script( 'deep-sermons', DEEP_ASSETS_URL . 'js/frontend/sermon.js', array( 'jquery' ), DEEP_VERSION, true );
            wp_enqueue_style( 'deep-single-sermon', DEEP_ASSETS_URL . 'css/frontend/single-sermon/single-sermon.css', false, DEEP_VERSION );
		}

        /**
         * Superfish.
         */
		wp_enqueue_script( 'deep-superfish', DEEP_ASSETS_URL . 'js/frontend/plugins/superfish.js', array( 'jquery' ), DEEP_VERSION, true );

        /**
         * Edge Page.
         */
		if ( rwmb_meta( 'deep_edge_onepage' ) == '1' ) {
            wp_enqueue_style( 'deep-fullpage', DEEP_ASSETS_URL . 'css/frontend/plugins/fullpage.css', false, DEEP_VERSION );
			wp_enqueue_script( 'deep-fullpage', DEEP_ASSETS_URL . 'js/frontend/plugins/fullpage.js', array( 'jquery' ), DEEP_VERSION, true );
			wp_enqueue_script( 'deep-edge-page', DEEP_ASSETS_URL . 'js/frontend/edge-page.js', array( 'jquery' ), DEEP_VERSION, true );
		}

        /**
         * Comment.
         */
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
            wp_enqueue_script( 'deep-comment-form', DEEP_ASSETS_URL . 'js/frontend/deep-comment-form.js', array( 'jquery' ), DEEP_VERSION, true );
        }

        /**
         * Masonry.
         */
        if ( $deep_options['deep_blog_template_layout'] == '2' ) {
            wp_enqueue_script( 'jquery-masonry' );
        }

        /**
         * Deep Ajax.
         */
        wp_enqueue_script( 'deep_custom_script', DEEP_ASSETS_URL . 'js/frontend/webnus-custom.js', array( 'jquery' ), null, true );
        wp_localize_script( 'deep_custom_script' ,  'deep_localize' ,  array(
            'deep_ajax'	=>	admin_url( 'admin-ajax.php' ),
        ));

        /**
         * Google Maps API.
         */
        $api_code = ( isset( $deep_options['deep_google_map_api'] ) && $deep_options['deep_google_map_api'] ) ? 'key=' . $deep_options['deep_google_map_api'] : '';
        $init_query = ( $api_code ) ? '?' : '';

        /**
         * Google Maps API.
         */
        wp_register_script( 'deep-googlemap-api', 'https://maps.googleapis.com/maps/api/js' . $init_query . $api_code, array(), false, false );

        /**
         * Google Maps.
         */
        wp_register_script( 'deep-googlemap', DEEP_ASSETS_URL . 'js/frontend/googlemap.js', array(), null, true );

        /**
         * Slick.
         */
        wp_register_script( 'deep-slick', DEEP_ASSETS_URL . 'js/libraries/slick.js', array('jquery'), false, false );

        /**
         * Tilt.
         */
        wp_register_script( 'deep-tilt-lib', DEEP_ASSETS_URL . 'js/libraries/tilt.js', array('jquery'), false, true );
        wp_register_script( 'deep-tilt', DEEP_ASSETS_URL . 'js/frontend/tiltvc.js', array('jquery'), false, true );

        /**
         * Elementor.
         */
        if ( did_action( 'elementor/loaded' ) ) {
            wp_enqueue_script( 'deep-elementor-container', DEEP_ASSETS_URL . 'js/frontend/deep-elementor-container.js', array( 'jquery' ), DEEP_VERSION, true );
        }

        /**
         * Contact Form7.
         */
        if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
            wp_enqueue_script( 'deep-contact-form7', DEEP_ASSETS_URL . 'js/frontend/deep-contact-form7.js', array( 'jquery' ), DEEP_VERSION, true );
        }

        /**
         * Navigation Active Menu.
         */
        wp_enqueue_script( 'deep-navigation-active-menu', DEEP_ASSETS_URL . 'js/frontend/deep-navigation-active-menu.js', array( 'jquery' ), DEEP_VERSION, true );

        /**
         * Go Pricing.
         */
        if ( class_exists( 'GW_GoPricing' ) ) {
            wp_enqueue_script( 'deep-go-pricing', DEEP_ASSETS_URL . 'js/frontend/deep-go-pricing.js', array( 'jquery' ), DEEP_VERSION, true );
        }

        /**
         * Blog.
         */
        if ( deep_is_blog() ) {
            wp_enqueue_script( 'deep-blog', DEEP_ASSETS_URL . 'js/frontend/blog.js', array( 'jquery' ), DEEP_VERSION, true );
        }

	}

	/**
	 * enqueue style.
	 *
	 * @access public
	 * @since 4.4.0
	 */
	public function enqueue_style() {

        $deep_options = Front\Deep_Front::deep_options();

        /**
         * Header Dynamic Styles.
         */
        wp_enqueue_style( 'header-dyn', DEEP_ASSETS_URL . 'css/frontend/dynamic-style/header.dyn.css', false, wp_rand( 1,100 ) );

        /**
         * Bootstrap.
         */
        wp_enqueue_style( 'deep-bootstrap', DEEP_ASSETS_URL . 'css/frontend/base/bootstrap.css' );

        /**
         * Iconset.
         */
        wp_enqueue_style( 'deep-iconset', DEEP_ASSETS_URL . 'css/frontend/icons/iconset.css' );

        /**
         * Font Awesome Icons.
         */
        wp_enqueue_style( 'deep-font-awesome', DEEP_ASSETS_URL . 'css/frontend/icons/font-awesome.css' );

        /**
         * ET Line Icons.
         */
        wp_enqueue_style( 'deep-et-line', DEEP_ASSETS_URL . 'css/frontend/icons/et-line.css' );

        /**
         * Linea Arrows Icons.
         */
        wp_enqueue_style( 'deep-linea-arrows', DEEP_ASSETS_URL . 'css/frontend/icons/linea-arrows-10.css' );

        /**
         * Linea Basic Icons.
         */
        wp_enqueue_style( 'deep-linea-basic', DEEP_ASSETS_URL . 'css/frontend/icons/linea-basic-10.css' );

        /**
         * Linea Ecommerce Icons.
         */
        wp_enqueue_style( 'deep-linea-ecommerce', DEEP_ASSETS_URL . 'css/frontend/icons/linea-ecommerce-10.css' );

        /**
         * Linea Software Icons.
         */
        wp_enqueue_style( 'deep-linea-software-10', DEEP_ASSETS_URL . 'css/frontend/icons/linea-software-10.css' );

        /**
         * Linecons Icons.
         */
        wp_enqueue_style( 'deep-linecons', DEEP_ASSETS_URL . 'css/frontend/icons/linecons.css' );

        /**
         * Simple Line Icons.
         */
        wp_enqueue_style( 'deep-simple-line-icons', DEEP_ASSETS_URL . 'css/frontend/icons/simple-line-icons.css' );

        /**
         * Themify Icons.
         */
        wp_enqueue_style( 'deep-themify-icons', DEEP_ASSETS_URL . 'css/frontend/icons/themify.css' );

        /**
         * RTL.
         */
        if ( is_rtl() ) {
            wp_enqueue_style( 'deep-core-rtl', DEEP_ASSETS_URL . 'css/frontend/rtl/deep-core-rtl.css' );
        }

        /**
         * Jetpack.
         */
        if ( is_single() && defined( 'JETPACK__VERSION' ) ) {
            wp_enqueue_style( 'wn-deep-jetpack-integration', DEEP_ASSETS_URL . 'css/frontend/jetpack/jetpack.css' );
        }

        /**
         * Single Cause.
         */
        if ( is_single() && defined( 'W_CAUSES_VERSION' ) && 'cause' === get_post_type() ) {
            wp_enqueue_style( 'wn-deep-single-cause', DEEP_ASSETS_URL . 'css/frontend/single-cause/single-cause.css' );
        }

        /**
         * Single Recipe.
         */
        if ( is_single() && defined( 'W_RECIPES_VERSION' ) && 'recipe' === get_post_type() ) {
            wp_enqueue_style( 'wn-deep-single-recipe', DEEP_ASSETS_URL . 'css/frontend/single-recipe/single-recipe.css' );
        }

        /**
         * Single Portfolio.
         */
        if ( is_single() && defined( 'W_PORTFOLIO_VERSION' ) && 'portfolio' === get_post_type() ) {
            wp_enqueue_style( 'wn-deep-single-portfolio', DEEP_ASSETS_URL . 'css/frontend/single-portfolio/single-portfolio.css' );
            wp_enqueue_script( 'deep-portfolio-single', DEEP_ASSETS_URL . 'js/frontend/deep-portfolio-single.js', array( 'jquery' ), DEEP_VERSION, true );
        }

        /**
         * Elementor.
         */
        if ( did_action( 'elementor/loaded' ) ) {
            wp_enqueue_style( 'wn-elementor-elements', DEEP_ASSETS_URL . 'css/frontend/elementor/elementor-elements.css' );
        }

        /**
         * Google Font.
         */
        $deep_options['rm_cs_font'] = isset( $deep_options['rm_cs_font'] ) ? $deep_options['rm_cs_font'] : '';
        if ( $deep_options['rm_cs_font'] == '1' ) {
            wp_enqueue_style( 'deep-google-fonts', deep_google_fonts_url(), array(), null );
        } else {
            wp_dequeue_style( 'redux-google-fonts-deep_options' );
        }

        /**
         * Typekit Font.
         */
        $w_adobe_typekit = ltrim ( isset( $deep_options['deep_typekit_id'] ) ? $deep_options['deep_typekit_id'] : '' );
        $deep_options['deep_adobe_typekit'] = isset( $deep_options['deep_adobe_typekit'] ) ? $deep_options['deep_adobe_typekit'] : '0';
        if ( isset( $w_adobe_typekit ) && !empty( $w_adobe_typekit ) && $deep_options['deep_adobe_typekit'] == '1' ) {
            wp_enqueue_script( 'wn-typekit', 'https://use.typekit.net/'.esc_attr( $w_adobe_typekit ).'.js', array(), '1.0' );
            wp_add_inline_script( 'wn-typekit', 'try{Typekit.load({ async: true });}catch(e){}' );
        }

        /**
         * WHMCS.
         */
        if ( is_plugin_active( 'whmcs-bridge/bridge.php' ) ) {
            wp_enqueue_style( 'deep-whmcs', DEEP_ASSETS_URL . 'css/frontend/whmcs/whmcs.css' );
        }

        /**
         * Deep Theme Style.
         */
        if ( defined( 'DEEPTHEME' ) ) {
            wp_dequeue_style( 'deeptheme-style' );
        }

        /**
         * Prayer Request.
         */
        if ( defined( 'WNPW_VER' ) ) {
            wp_enqueue_style( 'deep-prayer-request', DEEP_ASSETS_URL . 'css/frontend/plugins/prayer-request.css', false, DEEP_VERSION );
        }

        /**
         * Widgets Styles.
         */
        if ( deep_is_active_sidebar() ) {
            wp_enqueue_style( 'deep-wp-widgets', DEEP_ASSETS_URL . 'css/frontend/widgets/deep-widgets.css', false, DEEP_VERSION );

            wp_enqueue_style( 'deep-wp-calendar-widgets', DEEP_ASSETS_URL . 'css/frontend/widgets/wp-calendar.css', false, DEEP_VERSION );

            wp_enqueue_style( 'deep-wp-category-widgets', DEEP_ASSETS_URL . 'css/frontend/widgets/category.css', false, DEEP_VERSION );

            wp_enqueue_style( 'deep-wp-tag-cloud-widget', DEEP_ASSETS_URL . 'css/frontend/widgets/tag-cloud.css', false, DEEP_VERSION );
        }

        /**
         * Toggle Top Area.
         */
        if ( is_active_sidebar( 'top-area-1' ) || is_active_sidebar( 'top-area-2' ) || is_active_sidebar( 'top-area-3' ) || is_active_sidebar( 'top-area-4' ) ) {
            wp_enqueue_style( 'deep-toggle-top-area', DEEP_ASSETS_URL . 'css/frontend/widgets/toggle-top-area.css', false, DEEP_VERSION );
        }

        /**
         * Buddypress Sidebar.
         */
        if ( is_active_sidebar( 'buddypress-sidebar' ) ) {
            wp_enqueue_style( 'deep-buddypress-widgets', DEEP_ASSETS_URL . 'css/frontend/widgets/buddypress.css', false, DEEP_VERSION );
        }

        /**
         * Woocommerce Widgets.
         */
        if ( is_active_sidebar( 'woocommerce_header' ) || is_active_sidebar( 'shop-widget-area' ) ) {
            wp_enqueue_style( 'deep-woocommerce-widgets', DEEP_ASSETS_URL . 'css/frontend/widgets/woocommerce.css', false, DEEP_VERSION );
        }

        /**
         * Magnific Popup.
         */
		if ( is_singular( 'sermon' ) ) {
			wp_enqueue_style( 'deep-magnific-popup', DEEP_ASSETS_URL . 'css/frontend/plugins/magnific-popup.css', false, DEEP_VERSION );
		}

        /**
         * Slick.
         */
        wp_register_style( 'deep-slick', DEEP_ASSETS_URL . 'css/frontend/plugins/slick.css', false, DEEP_VERSION );

        /**
         * Owl Carousel.
         */
        wp_register_style( 'deep-owl-carousel', DEEP_ASSETS_URL . 'css/frontend/plugins/owl-carousel.css', false, DEEP_VERSION );

        /**
         * Ticker.
         */
        wp_register_style( 'deep-ticker', DEEP_ASSETS_URL . 'css/frontend/plugins/ticker.css', false, DEEP_VERSION );

        /**
         * Twentytwenty.
         */
        wp_register_style( 'deep-twentytwenty', DEEP_ASSETS_URL . 'css/frontend/plugins/twentytwenty.css', false, DEEP_VERSION );

        /**
         * Like.
         */
        wp_register_style( 'deep-like', DEEP_ASSETS_URL . 'css/frontend/plugins/like.css', false, DEEP_VERSION );

        /**
         * Circle Side.
         */
        wp_register_style( 'deep-circle-side', DEEP_ASSETS_URL . 'css/frontend/main-style/circle-side.css', false, DEEP_VERSION );

        /**
         * Expandable Section.
         */
        wp_register_style( 'deep-expandable-section', DEEP_ASSETS_URL . 'css/frontend/main-style/expandable-section.css', false, DEEP_VERSION );

        /**
         * Parallax.
         */
        wp_register_style( 'deep-parallax', DEEP_ASSETS_URL . 'css/frontend/main-style/parallax.css', false, DEEP_VERSION );

        /**
         * Shape Divider.
         */
        wp_register_style( 'deep-shape-divider', DEEP_ASSETS_URL . 'css/frontend/main-style/shape-divider.css', false, DEEP_VERSION );

        /**
         * List Widget.
         */
        wp_register_style( 'deep-list-widget', DEEP_ASSETS_URL . 'css/frontend/list/list.css', false, DEEP_VERSION );

        /**
         * Footer Social Bar.
         */
        if ( $deep_options['deep_footer_social_bar'] == '1' ) {
            wp_enqueue_style( 'deep-footer-social-bar', DEEP_ASSETS_URL . 'css/frontend/main-style/footer-social-bar.css', false, DEEP_VERSION );
        }

        /**
         * Footer Subscribe Bar.
         */
        if ( $deep_options['deep_footer_subscribe_bar'] == '1' ) {
            wp_enqueue_style( 'deep-footer-subscribe-bar', DEEP_ASSETS_URL . 'css/frontend/main-style/footer-subscribe-bar.css', false, DEEP_VERSION );
        }

        /**
         * Footer Instagram Bar.
         */
        if ( $deep_options['deep_footer_instagram_bar'] == '1' ) {
            wp_enqueue_style( 'deep-footer-instagram-bar', DEEP_ASSETS_URL . 'css/frontend/main-style/footer-instagram-bar.css', false, DEEP_VERSION );
        }

        /**
         * MEC.
         */
        if ( class_exists( 'MEC' ) ) {
            wp_enqueue_style( 'deep-mec-events-style', DEEP_ASSETS_URL . 'css/frontend/main-style/mec-events-style.css', false, DEEP_VERSION );
        }

        /**
         * Contact Form.
         */
        if ( defined( 'WPCF7_PLUGIN' ) ) {
            wp_enqueue_style( 'deep-deep-wpcf7', DEEP_ASSETS_URL . 'css/frontend/main-style/deep-wpcf7.css', false, DEEP_VERSION );
        }

        /**
         * 404.
         */
        if ( is_404() ) {
            wp_enqueue_style( 'deep-error404', DEEP_ASSETS_URL . 'css/frontend/main-style/error404.css', false, DEEP_VERSION );
        }

        /**
         * Boxed Wrap.
         */
        if ( $deep_options['deep_background_layout'] == 'boxed-wrap' ) {
            wp_enqueue_style( 'deep-boxed-wrap', DEEP_ASSETS_URL . 'css/frontend/main-style/boxed-wrap.css', false, DEEP_VERSION );
        }

        /**
         * Breadcrumbs.
         */
        if ( $deep_options['deep_enable_breadcrumbs'] == '1' ) {
            wp_enqueue_style( 'deep-breadcrumbs', DEEP_ASSETS_URL . 'css/frontend/main-style/breadcrumbs.css', false, DEEP_VERSION );
        }

        /**
         * WP Pagenavi.
         */
        if ( function_exists( 'wp_pagenavi' ) ) {
            wp_enqueue_style( 'deep-wp-pagenavi', DEEP_ASSETS_URL . 'css/frontend/main-style/wp-pagenavi.css', false, DEEP_VERSION );
        }

        /**
         * Active Footer Widgets.
         */
        if ( deep_is_active_footer_widgets() && $deep_options['deep_footer_builder_switch'] == '0' ) {
            wp_enqueue_style( 'deep-footer-widgets', DEEP_ASSETS_URL . 'css/frontend/main-style/footer-widgets.css', false, DEEP_VERSION );
        }

        /**
         * Footer Bottom.
         */
        if ( $deep_options['deep_footer_bottom_enable'] == '1' ) {
            wp_enqueue_style( 'deep-footer-bottom', DEEP_ASSETS_URL . 'css/frontend/main-style/footer-bottom.css', false, DEEP_VERSION );
        }

        /**
         * Vertical Space.
         */
        if ( is_single() || deep_is_blog() ) {
            wp_enqueue_style( 'deep-vertical-space', DEEP_ASSETS_URL . 'css/frontend/main-style/vertical-space.css', false, DEEP_VERSION );
        }

        /**
         * Main Style.
         */
        wp_enqueue_style( 'deep-main-style', DEEP_ASSETS_URL . 'css/frontend/base/main-style.css', false, DEEP_VERSION );

    }

}

Deep_Assets::get_instance();
