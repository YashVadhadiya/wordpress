<?php
/**
 * Elementor main file.
 *
 * @since   1.0.0
 */

if ( did_action( 'elementor/loaded' ) )  :

    /**
     * Elementor Category
     * @author Webnus
     * @since   1.0.0
     *
    */
    add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );
    function add_elementor_widget_categories( $elements_manager ) {
        $elements_manager->add_category(
            'webnus',
            [
                'title' => __( 'webnus', 'deep' ),
            ]
        );
    }

    /**
     * Main Elementor Class
     *
     *
     * @since 1.2.5
     */
    final class Webnus_Elementor_Extentions {

        /**
         * Instance
         *
         *
         * @since 1.2.5
         *
         * @access private
         * @static
         *
         * @var Webnus_Elementor_Extentions The single instance of the class.
         */
        private static $_instance = null;

        /**
         * Instance
         * Ensures only one instance of the class is loaded or can be loaded.
         *
         * @since 1.2.5
         *
         * @access public
         * @static
         *
         * @return Webnus_Elementor_Extentions An instance of the class.
         */
        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        /**
         * Webnus Elementor Directory
         * Get Files Directory
         *
         * @since 1.2.5
         *
         * @access public
         * @static
         *
         */
        public $elementor_url = '';

        /**
         * Constructor
         *
         *
         * @since 1.2.5
         *
         * @access public
         */
        public function __construct() {
            // Main Directory
            $this->elementor_url = __DIR__;

            // Init Action
            add_action( 'init', [ $this, 'init' ] );

        }

        /**
         * Check Elementor plugin is activate
         * Fired by `init` action hook.
         *
         * @since 1.2.5
         *
         * @access public
         */
        public function init() {

            /* Disable Main Setting */
            add_option( 'disable_default_fonts', '' );
            add_option( 'disable_default_colors', '' );

            if ( get_option( 'disable_default_fonts' ) == '' ) {
                update_option( 'disable_default_fonts', 'yes' );
                update_option( 'elementor_disable_typography_schemes', 'yes' );
            }

            if ( get_option( 'disable_default_colors' ) == '' ) {
                update_option( 'disable_default_colors', 'yes' );
                update_option( 'elementor_disable_color_schemes', 'yes' );
            }

            /* Add Post types support */
            add_post_type_support( 'mega_menu' , 'elementor' );
            add_post_type_support( 'wbf_footer' , 'elementor' );
            add_post_type_support( 'gallery' , 'elementor' );
            add_post_type_support( 'portfolio' , 'elementor' );
            add_post_type_support( 'hb_room' , 'elementor' );

            // Add Webnus options to elements
            add_action( 'elementor/element/before_section_end', [ $this, 'add_animation_pro_to_elements' ], 1, 3 );

            add_action( 'elementor/element/section/section_background/before_section_start', [ $this, 'add_webnus_options_to_section' ], 10, 2 );
            add_action( 'elementor/element/column/section_style/before_section_start', [ $this, 'add_webnus_options_to_column' ], 10, 2 );

            // Render Webnus Options - Widgets
            add_action( 'elementor/widget/before_render_content', [ $this, 'wn_add_attribute_to_widgets' ] );
            add_action( 'elementor/widget/render_content', [ $this, 'animation_pro_single_image_output' ] , 10, 2 );

            // Render Webnus Options - Section
            add_action( 'elementor/frontend/section/before_render', [ $this, 'wn_section_class' ] );
            add_action( 'elementor/frontend/section/after_render', [ $this, 'wn_section_render' ] );

            // Render Webnus Options - Column
            add_action( 'elementor/frontend/column/before_render', [ $this, 'wn_column_class' ] );
            add_action( 'elementor/frontend/column/after_render', [ $this, 'wn_column_render' ] );

            // Register Widget Action
            add_action( 'elementor/widgets/widgets_registered', [ $this, 'widgets_registered' ] );

            add_action( 'elementor/controls/controls_registered', [ $this, 'wn_Custom_Icons' ] );

            // Theme Location
            add_action( 'elementor/theme/register_locations', [ $this, 'deep_register_elementor_locations' ] );
            add_action( 'elementor/theme/before_do_header', [ $this, 'deep_elementor_before_do_header' ] );
            add_action( 'elementor/theme/after_do_footer', [ $this, 'deep_elementor_after_do_footer' ] );

            // Register Widget Styles
            add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'deep_widget_styles' ] );

            // Register Custom js for each element
            add_action( 'elementor/frontend/after_register_scripts', function() {
                wp_register_script( 'jquery-flipclock',         DEEP_ASSETS_URL . 'js/libraries/jquery.flipclock.js',           [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-countdown',           DEEP_ASSETS_URL . 'js/frontend/countdown.js',                   [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-process-carousel',    DEEP_ASSETS_URL . 'js/frontend/process-carousel.js',            [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'wn-svg',                   DEEP_ASSETS_URL . 'js/frontend/svg.js',                         [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-news-ticker',         DEEP_ASSETS_URL . 'js/libraries/jquery.ticker.js',              [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'wn-google-map-js',         DEEP_ASSETS_URL . 'js/frontend/wn-google-map.js',               [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-latest-from-blog',    DEEP_ASSETS_URL . 'js/frontend/latestfromblog.js',              [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-image-carousel',      DEEP_ASSETS_URL . 'js/frontend/image-carousel.js',              [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'jquery-twentytwenty',      DEEP_ASSETS_URL . 'js/libraries/jquery.twentytwenty.js',        [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-owl-thumb',           DEEP_ASSETS_URL . 'js/libraries/owl.carousel2.thumbs.min.js',   [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-twentytwenty',        DEEP_ASSETS_URL . 'js/frontend/beforeafter.js',                 [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-blog',                DEEP_ASSETS_URL . 'js/frontend/blog.js',                        [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-video-ply-btn',       DEEP_ASSETS_URL . 'js/frontend/video-ply-btn.js',               [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'info-box',                 DEEP_ASSETS_URL . 'js/frontend/info-box.js',                    [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-like-button',         DEEP_ASSETS_URL . 'js/frontend/deep-like-button.js',            [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-postslider',          DEEP_ASSETS_URL . 'js/frontend/postslider.js',                  [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'wn-reservation',           DEEP_ASSETS_URL . 'js/frontend/reservation.js',                 [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-portfolio-carousel',  DEEP_ASSETS_URL . 'js/frontend/portfolio-carousel.js',          [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-testimonial-carousel',DEEP_ASSETS_URL . 'js/frontend/testimonial-carousel.js',        [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-service-carousel',    DEEP_ASSETS_URL . 'js/frontend/service-carousel.js',            [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-our-team',            DEEP_ASSETS_URL . 'js/frontend/our-team.js',                    [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-donate-button',       DEEP_ASSETS_URL . 'js/frontend/donate.js',                      [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'sermon',                   DEEP_ASSETS_URL . 'js/frontend/sermon.js',                      [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'info-box',                 DEEP_ASSETS_URL . 'js/frontend/info-box.js',                    [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-socials',             DEEP_ASSETS_URL . 'js/frontend/socials.js',                     [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'nw-togglebox',             DEEP_ASSETS_URL . 'js/frontend/toggle-box.js',                  [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-our-client',          DEEP_ASSETS_URL . 'js/frontend/our-clients.js',                 [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-testimonial-slider',  DEEP_ASSETS_URL . 'js/frontend/testimonial-slider.js',          [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-instagram',           DEEP_ASSETS_URL . 'js/frontend/instagram-carousel.js',          [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'wn-jquery-stats',          DEEP_ASSETS_URL . 'js/frontend/jquery.stats.min.js',            [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-cat-tab',             DEEP_ASSETS_URL . 'js/frontend/cat-tab.js',                     [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-magazine',            DEEP_ASSETS_URL . 'js/frontend/deep-magazine.js',               [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-simple-pagination',   DEEP_ASSETS_URL . 'js/frontend/deep-simple-pagination.js',      [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-content-carousel',    DEEP_ASSETS_URL . 'js/frontend/content-carousel.js',            [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-content-slider',      DEEP_ASSETS_URL . 'js/frontend/content-slider.js',              [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-testimonial-tabs',    DEEP_ASSETS_URL . 'js/frontend/deep-testimonial-tabs.js',       [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-tabs-widget',         DEEP_ASSETS_URL . 'js/frontend/tabs-widget.js',                 [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'wn-contact-form',          DEEP_ASSETS_URL . 'js/frontend/contact-form.js',                [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'title-builder',            DEEP_ASSETS_URL . 'js/frontend/title-builder.js',               [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-facebook-app-id',     DEEP_ASSETS_URL . 'js/frontend/facebook-app.js',                [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'tab-content',              DEEP_ASSETS_URL . 'js/frontend/tab-content.js',                 [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-gallery',             DEEP_ASSETS_URL . 'js/frontend/deep-gallery.js',                [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-gallery-js',          DEEP_ASSETS_URL . 'js/libraries/lc.lightbox.min.js',            [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'wn-tilt-lib',              DEEP_ASSETS_URL . 'js/libraries/tilt.js',                       [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'wn-tilt',                  DEEP_ASSETS_URL . 'js/frontend/tilt.js',                        [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'food-menu',                DEEP_ASSETS_URL . 'js/frontend/food-menu.js',                   [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-nice-select',         DEEP_ASSETS_URL . 'js/frontend/plugins/niceselect.js',          [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-waypoints',           DEEP_ASSETS_URL . 'js/frontend/plugins/waypoints.js',           [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-content-toggle',      DEEP_ASSETS_URL . 'js/frontend/plugins/content-toggle.js',      [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-vivus',               DEEP_ASSETS_URL . 'js/frontend/plugins/vivus.js',               [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-jquery-visible',      DEEP_ASSETS_URL . 'js/frontend/plugins/jquery-visible.js',      [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-max-counter',         DEEP_ASSETS_URL . 'js/frontend/max-counter.js',                 [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-magnific-popup',      DEEP_ASSETS_URL . 'js/frontend/plugins/magnific-popup.js',      [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-owl-carousel',        DEEP_ASSETS_URL . 'js/frontend/plugins/owl.js',                 [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-gallery-format',      DEEP_ASSETS_URL . 'js/frontend/wp-widgets/gallery-format.js',   [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-alert',               DEEP_ASSETS_URL . 'js/frontend/deep-alert.js',                  [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-social-login',        DEEP_ASSETS_URL . 'js/frontend/deep-social-login.js',           [ 'jquery' ], DEEP_VERSION, true );
                wp_register_script( 'deep-icon-box',            DEEP_ASSETS_URL . 'js/frontend/deep-icon-box.js',               [ 'jquery' ], DEEP_VERSION, true );
            });

            add_action( 'elementor/editor/after_enqueue_styles', function() {
               wp_enqueue_style( 'wn-elementor-icons', DEEP_ASSETS_URL . 'css/backend/elementor-iconfonts.css' );
               wp_enqueue_style( 'wn-elementor-admin', DEEP_ASSETS_URL . 'css/backend/elementor-admin.css' );
            });

            add_action( 'elementor/preview/enqueue_scripts', function() {
                $deep_options	= deep_options();

                // Google Maps
                $api_code       = ( isset( $deep_options['deep_google_map_api'] ) && $deep_options['deep_google_map_api'] ) ? 'key=' . $deep_options['deep_google_map_api'] : '';
                $init_query     = ( $api_code ) ? '?' : '';
                wp_enqueue_script( 'deep-googlemap-api', 'https://maps.googleapis.com/maps/api/js' . $init_query . $api_code, array(), false, false );
            });

            add_action( 'elementor/preview/enqueue_styles', function() {
                wp_enqueue_style( 'wn-elementor-preview', DEEP_ASSETS_URL . 'css/backend/elementor-preview.css' );
                wp_dequeue_script( 'deep-preloader' );
                wp_dequeue_style( 'deep-preloader' );
                // Enqueue all elements
                wp_enqueue_style( 'wn-all-elements', DEEP_ASSETS_URL . 'css/frontend/elementor/all-elements.css' );
            });

        }

        /**
         * widget styles
         * @author Webnus
         * @version 4.2.0
         *
        */
        public function deep_widget_styles() {
            wp_register_style( 'advanced-search', DEEP_ASSETS_URL . 'css/frontend/advanced-search/advanced-search.css' );
            wp_register_style( 'wn-deep-buy-process', DEEP_ASSETS_URL . 'css/frontend/buy-process/buy-process.css' );
            wp_register_style( 'wn-deep-collection', DEEP_ASSETS_URL . 'css/frontend/collection/collection.css' );
            wp_register_style( 'wn-deep-content-carousel', DEEP_ASSETS_URL . 'css/frontend/content-carousel/content-carousel.css' );
            wp_register_style( 'wn-deep-content-slider', DEEP_ASSETS_URL . 'css/frontend/content-slider/content-slider.css' );
            wp_register_style( 'wn-deep-count-down', DEEP_ASSETS_URL . 'css/frontend/count-down/count-down.css' );
            wp_register_style( 'enrolment', DEEP_ASSETS_URL . 'css/frontend/enrolment/enrolment.css' );
            wp_register_style( 'wn-deep-food-menu', DEEP_ASSETS_URL . 'css/frontend/food-menu/food-menu.css' );
            wp_register_style( 'wn-deep-gallery', DEEP_ASSETS_URL . 'css/frontend/deep-gallery/deep-gallery.css' );
            wp_register_style( 'wn-deep-lc-lightbox', DEEP_ASSETS_URL . 'css/frontend/lc-lightbox/lc_lightbox.min.css' );
            wp_register_style( 'wn-deep-icon-divider', DEEP_ASSETS_URL . 'css/frontend/icon-divider/icon-divider.css' );
            wp_register_style( 'wn-deep-image-hotspot', DEEP_ASSETS_URL . 'css/frontend/image-hotspot/image-hotspot.css' );
            wp_register_style( 'img-hotspot', DEEP_ASSETS_URL . 'css/frontend/image-hotspot/img-hotspot.css' );
            wp_register_style( 'wn-deep-info-box', DEEP_ASSETS_URL . 'css/frontend/info-box/info-box.css' );
            wp_register_style( 'wn-deep-login-box', DEEP_ASSETS_URL . 'css/frontend/login-box/login-box.css' );
            wp_register_style( 'wn-deep-magazine', DEEP_ASSETS_URL . 'css/frontend/magazine/magazine.css' );
            wp_register_style( 'wn-deep-our-clients', DEEP_ASSETS_URL . 'css/frontend/our-clients/our-clients.css' );
            wp_register_style( 'wn-deep-portfolio-carousel', DEEP_ASSETS_URL . 'css/frontend/portfolio-carousel/portfolio-carousel.css' );
            wp_register_style( 'wn-deep-post-from-blog', DEEP_ASSETS_URL . 'css/frontend/post-from-blog/post-from-blog.css' );
            wp_register_style( 'deep-process-carousel', DEEP_ASSETS_URL . 'css/frontend/process-carousel/process-carousel.css' );
            wp_register_style( 'wn-deep-max-quote', DEEP_ASSETS_URL . 'css/frontend/max-quote/max-quote.css' );
            wp_register_style( 'wn-deep-recipes', DEEP_ASSETS_URL . 'css/frontend/recipes/recipes.css' );
            wp_register_style( 'wn-deep-reservation', DEEP_ASSETS_URL . 'css/frontend/reservation/reservation.css' );
            wp_register_style( 'wn-deep-road-map', DEEP_ASSETS_URL . 'css/frontend/road-map/road-map.css' );
            wp_register_style( 'wn-deep-schedule', DEEP_ASSETS_URL . 'css/frontend/schedule/schedule.css' );
            wp_register_style( 'wn-deep-our-services-carousel', DEEP_ASSETS_URL . 'css/frontend/our-services-carousel/our-services-carousel.css' );
            wp_register_style( 'wn-deep-subscribe', DEEP_ASSETS_URL . 'css/frontend/subscribe/subscribe.css' );
            wp_register_style( 'wn-deep-testimonial', DEEP_ASSETS_URL . 'css/frontend/testimonial/testimonial.css' );
            wp_register_style( 'wn-deep-testimonial-tab', DEEP_ASSETS_URL . 'css/frontend/testimonial-tab/testimonial-tab.css' );
            wp_register_style( 'wn-deep-toggle-box', DEEP_ASSETS_URL . 'css/frontend/toggle-box/toggle-box.css' );
            wp_register_style( 'wn-deep-tab-content', DEEP_ASSETS_URL . 'css/frontend/tab-content/tab-content.css' );
            wp_register_style( 'wn-deep-tooltip', DEEP_ASSETS_URL . 'css/frontend/tooltip/tooltip.css' );
            wp_register_style( 'wn-deep-contact-form', DEEP_ASSETS_URL . 'css/frontend/contact-form/contact-form.css' );
            wp_register_style( 'wn-deep-instagram', DEEP_ASSETS_URL . 'css/frontend/instagram/instagram.css' );
            wp_register_style( 'wn-deep-donate', DEEP_ASSETS_URL . 'css/frontend/donate/donate.css' );
            wp_register_style( 'wn-deep-causes', DEEP_ASSETS_URL . 'css/frontend/causes/causes.css' );
            wp_register_style( 'wn-deep-speakers', DEEP_ASSETS_URL . 'css/frontend/speakers/speakers.css' );
			wp_register_style( 'wn-deep-sermon-category', DEEP_ASSETS_URL . 'css/frontend/sermon-category/sermon-category.css' );
			wp_register_style( 'wn-deep-asermon', DEEP_ASSETS_URL . 'css/frontend/asermon/asermon.css' );
			wp_register_style( 'wn-deep-sermons', DEEP_ASSETS_URL . 'css/frontend/sermons/sermons.css' );
			wp_register_style( 'deep-category-tab', DEEP_ASSETS_URL . 'css/frontend/category-tab/category-tab.css' );
            wp_register_style( 'wn-deep-twitterfeed', DEEP_ASSETS_URL . 'css/frontend/twitterfeed/twitterfeed.css' );
			wp_register_style( 'wn-deep-block-quote', DEEP_ASSETS_URL . 'css/frontend/block-quote/block-quote.css' );
            wp_register_style( 'wn-deep-video-play-button', DEEP_ASSETS_URL . 'css/frontend/video-play-button/video-play-button.css' );
            wp_register_style( 'wn-deep-lvs', DEEP_ASSETS_URL . 'css/frontend/lvs/lvs.css' );
            wp_register_style( 'deep-blog-main', DEEP_ASSETS_URL . 'css/frontend/base/deep-blog.css' );
            wp_register_style( 'wn-deep-full-card', DEEP_ASSETS_URL . 'css/frontend/full-card/full-card.css' );
            wp_register_style( 'deep-magnific-popup', DEEP_ASSETS_URL . 'css/frontend/plugins/magnific-popup.css' );
            wp_register_style( 'deep-datepicker', DEEP_ASSETS_URL . 'css/frontend/plugins/datepicker.css' );
            wp_register_style( 'deep-nice-select', DEEP_ASSETS_URL . 'css/frontend/plugins/nice-select.css' );
            wp_register_style( 'deep-title-builder', DEEP_ASSETS_URL . 'css/frontend/title-builder/title-builder.css' );
            wp_register_style( 'deep-video-teaser', DEEP_ASSETS_URL . 'css/frontend/video-teaser/video-teaser.css' );
            wp_register_style( 'deep-callout', DEEP_ASSETS_URL . 'css/frontend/callout/callout.css' );
            wp_register_style( 'deep-alert', DEEP_ASSETS_URL . 'css/frontend/alert/alert.css' );
            wp_register_style( 'deep-map', DEEP_ASSETS_URL . 'css/frontend/map/map.css' );
            wp_register_style( 'deep-custom-menu', DEEP_ASSETS_URL . 'css/frontend/custom-menu/custom-menu.css' );
            wp_register_style( 'deep-dropcap', DEEP_ASSETS_URL . 'css/frontend/main-style/dropcap.css' );
            wp_register_style( 'deep-hr-widget', DEEP_ASSETS_URL . 'css/frontend/main-style/line.css' );
            wp_register_style( 'deep-button-widget', DEEP_ASSETS_URL . 'css/frontend/button/button.css' );
            wp_register_style( 'deep-blog-metadata-author', DEEP_ASSETS_URL . 'css/frontend/blog/metadata/author.css' );
            wp_register_style( 'deep-blog-metadata-cat', DEEP_ASSETS_URL . 'css/frontend/blog/metadata/cat.css' );
            wp_register_style( 'deep-blog-metadata-date', DEEP_ASSETS_URL . 'css/frontend/blog/metadata/date.css' );
            wp_register_style( 'deep-blog-social-share-5', DEEP_ASSETS_URL . 'css/frontend/blog/social-share/social-share-5.css' );
        }

        /**
         * Registe Widgets
         *
         *
         * @since 1.2.5
         *
         * @access public
         */
        public function widgets_registered() {

            include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

            // Get all shortcodes files
            $files = glob( $this->elementor_url . '/widgets/*.php' );
            foreach ( $files as $file ) :
                if ( __FILE__ != basename( $file ) ) {
                    require_once $file;
                }
            endforeach;

            // Create Widgets
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Alert() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Teaserbox() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Countdown() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_ProcessCarousel() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Callout() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Icons() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_TitleBuilder() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Iconbox() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_WSVG() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_LatestFromBlog() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Image_Carousel() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Before_After_Image() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Block_Quote() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Blog() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Buy_Process() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Dropcap() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Distance() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Video_Play_Button() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Info_Box() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Reservation() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Post_From_Blog() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Custom_Menu() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Testimonial() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Schedule() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Road_Map() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Pricing_Plan() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Our_Process() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Testimonial_Carousel() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Service_Carousel() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Our_Team() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Donate() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_GoogleMaps() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Icon_Divider() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Like_View_Share() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Line() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Link() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_List() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Login() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Post_Slider() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Tooltip() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Quote() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Socials() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Toggle_Box() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Max_Counter() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Twitter_Feed() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Collection() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Instagram() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Our_Client() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Pricing_Tables() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Food_Menu() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Testimonial_Slider() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Button() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Subscribe() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_VideoTeaser() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_CategoryTab() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Magazine() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Content_Carousel() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Content_Slider() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Testimonial_tabs() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Facebook_Buttons() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Facebook_Page() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Facebook_Comments() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Facebook_Embed() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Featured_Products() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Tabs() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Gallery() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Img_Hotspot() );

            if ( is_plugin_active( 'wp-hotel-booking/wp-hotel-booking.php' ) ) {
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Rooms() );
            }

            if ( is_plugin_active( 'webnus-recipes/webnus-recipes.php' ) ) {
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Recipes() );
            }

            if ( is_plugin_active( 'the-grid/the-grid.php' ) ) {
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_The_Grid() );
            }

            if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_ContactForm7() );
            }

            if ( is_plugin_active( 'revslider/revslider.php' ) ) {
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Slider_Revolution() );
            }

            if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Shop_Products() );
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Special_Offers() );
            }

            if ( is_plugin_active( 'devvn-image-hotspot/devvn-image-hotspot.php' ) ) {
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Image_Hotspot() );
            }

            if ( is_plugin_active( 'webnus-causes/webnus-causes.php' ) ) {
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Causes() );
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Single_Cause() );
            }

            if ( is_plugin_active( 'webnus-portfolio/webnus-portfolio.php' ) ) {
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Portfolio_Carousel() );
            }

            if ( is_plugin_active( 'webnus-goal/webnus-goal.php' ) ) {
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Goal() );
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Single_Goal() );
            }

            if ( is_plugin_active( 'webnus-sermons/webnus-sermons.php' ) ) {
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Sermons() );
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Sermon_Category() );
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Single_Sermon() );
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Speakers() );
            }

            if( class_exists( 'VCW_Constants' ) ) {
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Virtual_Coins() );
            }

            if( is_plugin_active( 'tablepress/tablepress.php' ) ) {
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_WnTablepress() );
            }

            if( is_plugin_active( 'prayer-wall/wp-prayer-wall.php' ) ) {
                // prayer wall
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Prayer_Wall_Form() );
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Prayer_Wall_Items() );
                // review
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Review_Form() );
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Review_Items() );
            }

            if( class_exists( 'HTC_HB' ) ) {
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\HTC_Element_Widgets_Booking_Form() );
            }
            if( is_plugin_active( 'lifterlms/lifterlms.php' ) ) {
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Course_Category() );
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Course_Instructors() );
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Single_Course() );
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Courses() );
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Enrolment() );
                Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Courses_Advanced_Search() );
            }

            // Widgets
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_About_Widget() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Facebook_Widget() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Flicker_Widget() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Latestpost_Widget() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Login_Widget() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Popularpost_Widget() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Social_Widget() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Subscribe_Widget() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Tab_Widget() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Testimonial_Widget() );
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Webnus_Element_Widgets_Youtube_Widget() );

        }

        /**
         * Created plage with elementor
         *
         *
         * @since 1.3.1
         *
         * @access public
         */
        public function elementor_page() {

            $target_class  = 'elementor-page elementor-page-'.get_the_ID();
            $body_classes  = array();

            foreach ( get_body_class() as $value ) {
                $body_classes[$value] = $value;
            }

            if ( array_key_exists( $target_class, $body_classes) ) {

                return true;

            } else {

                return false;

            }

        }

        /**
         * Elementor Pro Activation validation
         *
         *
         * @since 1.3.1
         *
         * @access public
         */
        public function elementor_pro_is_active() {

            if ( function_exists('elementor_pro_load_plugin') ) {

                return true;

            } else {

                return false;

            }

        }

        /**
         * Support Elementor Theme location
         *
         *
         * @since 1.3.1
         *
         * @access public
         */

        public function deep_register_elementor_locations( $elementor_theme_manager ) {

            if ( $this->elementor_pro_is_active() ) {

                $elementor_theme_manager->register_location(
                    'deep-elementor-header',
                    [
                        'label'             => esc_html__( 'Header', 'deep' ),
                        'multiple'          => false,
                        'edit_in_content'   => false,
                    ]
                );
                $elementor_theme_manager->register_location(
                    'deep-elementor-footer',
                    [
                        'label'             => esc_html__( 'Footer', 'deep' ),
                        'multiple'          => false,
                        'edit_in_content'   => false,
                    ]
                );
                $elementor_theme_manager->register_location(
                    'deep-elementor-archive',
                    [
                        'label'             => esc_html__( 'Archive', 'deep' ),
                        'multiple'          => false,
                        'edit_in_content'   => false,
                    ]
                );
                $elementor_theme_manager->register_location(
                    'deep-elementor-single',
                    [
                        'label'             => esc_html__( 'Single', 'deep' ),
                        'multiple'          => false,
                        'edit_in_content'   => false,
                    ]
                );

            }

        }

        /**
         * Start Wrap
         *
         *
         * @since 1.3.1
         *
         * @access public
         */
        public function deep_elementor_before_do_header() {

            $this->theme_options	= deep_options();
            $wrap_class = 'wn-wrap ';

			// Colorskin
			$custom_color_skin	= deep_get_option( $this->theme_options, 'deep_custom_color_skin' );
			$color_skin_color	= deep_get_option( $this->theme_options, 'deep_color_skin', 'e3e3e3' );
			if ( $color_skin_color != 'e3e3e3' || $custom_color_skin ) {
				$wrap_class .= 'colorskin-custom ';
            }
            // Background Layout
			$background_layout	= deep_get_option( $this->theme_options, 'deep_background_layout', 'wide' );
            $wrap_class 		.= ( ( $background_layout == 'boxed-wrap' ) && ( $header_menu_type != 6 ) && ( $header_menu_type != 7 ) ) ? $background_layout . ' ' : '';

            echo '<div id="wrap" class="' . esc_attr( $wrap_class ) . '">'; // Start #wrap

        }

        /**
         * End Wrap
         *
         *
         * @since 1.3.1
         *
         * @access public
         */
        public function deep_elementor_after_do_footer() {
            echo '</div>'; // End #wrap
        }

        /**
         * Add Animation Pro Controller To image and text editor
         *
         *
         * @since 1.2.5
         *
         * @access public
         */
        public function add_animation_pro_to_elements ($element, $section_id ,$args) {

            if ( 'image' === $element->get_name() && 'section_style_image' === $section_id || 'text-editor' === $element->get_name() && 'section_style' === $section_id ) {

                $element->add_control(
                'wn_animation_pro_enable',
                [
                    'label' 		=> __( 'Enable Animation Pro', 'deep' ),
                    'type' 			=> \Elementor\Controls_Manager::SWITCHER,
                    'label_on' 		=> __( 'Enable', 'deep' ),
                    'label_off' 	=> __( 'Disable', 'deep' ),
                    'return_value' 	=> 'on',
                    'default' 		=> 'off',
                ]
            );
            $element->add_control(
                'wn_trigger_hook',
                [
                    'label' 		=> __( 'Effect Start Point', 'deep' ),
                    'type' 			=> \Elementor\Controls_Manager::TEXT,
                    'description'	=> esc_html__( 'Can be a number between 0 and 1 defining the position of the trigger Hook in relation to the viewport.', 'deep' ),
                    'placeholder'   => '0.4',
                    'default'       => '0.4',
                    'condition' 	=> [ //dependency
                        'wn_animation_pro_enable' 	=> [
                            'on',
                        ],
                    ],
                ]
            );

            $element->add_control(
                'wn_duration',
                [
                    'label' 		=> __( 'Effect Length', 'deep' ),
                    'type' 			=> \Elementor\Controls_Manager::TEXT,
                    'description'	=> esc_html__( 'The duration of the scene. If 0 tweens will auto-play when reaching the scene start point, pins will be pinned indefinetly starting at the start position.', 'deep' ),
                    'placeholder'   => '100%',
                    'default'       => '100%',
                    'condition' 	=> [ //dependency
                        'wn_animation_pro_enable' 	=> [
                            'on',
                        ],
                    ],
                ]
            );

            $element->add_control(
                'wn_vertical_movement',
                [
                    'label' 		=> __( 'Vertical Movement', 'deep' ),
                    'type' 			=> \Elementor\Controls_Manager::TEXT,
                    'condition' 	=> [ //dependency
                        'wn_animation_pro_enable' 	=> [
                            'on',
                        ],
                    ],
                ]
            );

            $element->add_control(
                'wn_horizontal_movement',
                [
                    'label' 		=> __( 'Horizontal Movement', 'deep' ),
                    'type' 			=> \Elementor\Controls_Manager::TEXT,
                    'condition' 	=> [ //dependency
                        'wn_animation_pro_enable' 	=> [
                            'on',
                        ],
                    ],
                ]
            );

            $element->add_control(
                'wn_rotation',
                [
                    'label' 		=> __( 'Rotation at End', 'deep' ),
                    'type' 			=> \Elementor\Controls_Manager::TEXT,
                    'condition' 	=> [ //dependency
                        'wn_animation_pro_enable' 	=> [
                            'on',
                        ],
                    ],
                ]
            );

            $element->add_control(
                'wn_opacity',
                [
                    'label' 		=> __( 'Opacity at End', 'deep' ),
                    'type' 			=> \Elementor\Controls_Manager::TEXT,
                    'condition' 	=> [ //dependency
                        'wn_animation_pro_enable' 	=> [
                            'on',
                        ],
                    ],
                ]
            );
            }
        }

        /**
         * Add Animation pro Attributes to image and text editor
         *
         *
         * @since 1.2.5
         *
         * @access public
         */
        public function wn_add_attribute_to_widgets( $element ) {

            if( 'image' === $element->get_name() ) {
                $settings = $element->get_settings();
                $uniqid	  = uniqid();
                if( $settings['wn_animation_pro_enable'] == 'on' ) {

                    $element->add_render_attribute( 'wrapper', 'id', 'wpb_single_image' . $uniqid . '' );
                    $element->add_render_attribute( 'wrapper', 'class', 'wpb_single_image' . $uniqid . '' );

                }
            }

            if( 'text-editor' === $element->get_name() ) {
                $settings = $element->get_settings();
                $uniqid	  = uniqid();
                if( $settings['wn_animation_pro_enable'] == 'on' ) {

                    $element->add_render_attribute( 'editor', 'id', 'wpb_text_column' . $uniqid . '' );
                    $element->add_render_attribute( 'editor', 'class', 'wpb_text_column' . $uniqid . '' );

                }
            }

        }

        /**
         * Animation Pro output
         *
         *
         * @since 1.2.5
         *
         * @access public
         */
        public function animation_pro_single_image_output( $content, $widget ) {

            if ( 'image' === $widget->get_name() ) {
                $settings               = $widget->get_settings();
                $element_id             = $widget->get_id();
                $duration	            = !empty($settings['wn_duration']) ?  $settings['wn_duration'] : '';
                $trigger_hook	        = !empty($settings['wn_trigger_hook']) ?  $settings['wn_trigger_hook'] : '';
                $horizontal_movement	= !empty($settings['wn_horizontal_movement']) ? 'x: "' . $settings['wn_horizontal_movement'] . '",' : '';
                $vertical_movement		= !empty($settings['wn_vertical_movement']) ? 'y: "' . $settings['wn_vertical_movement'] . '",' : '';
                $opacity				= is_numeric( $settings['wn_opacity'] ) ? 'opacity: "' . $settings['wn_opacity'] . '",' : '';
                $rotation				= !empty($settings['wn_rotation']) ? 'rotation: "' . $settings['wn_rotation'] . '",' : '';

                if ( $settings['wn_animation_pro_enable'] == 'on' ) :
                    wp_enqueue_script( 'deep-tween-plugins', DEEP_ASSETS_URL . 'js/frontend/plugins/tween-plugins.js', array( 'jquery' ), DEEP_VERSION, true );
                    wp_enqueue_script( 'deep-scrollmagic', DEEP_ASSETS_URL . 'js/frontend/plugins/scroll-magic.js', array( 'jquery' ), DEEP_VERSION, true );

                    $content .= '<script>
                    ( function( $ ) {
                        $( document ).ready( function() {
                            var attr = ".elementor-widget-image[data-id=' . $element_id . ']",
                                duration = "'.$duration.'",
                                trigger_hook = "'.$trigger_hook.'";
                            if (typeof attr !== typeof undefined && attr !== false) {
                                var controller = new ScrollMagic.Controller();
                                var img_scr = attr + " img";
                                new ScrollMagic.Scene({
                                        triggerElement: attr,
                                        duration: duration,
                                        triggerHook: trigger_hook
                                    })
                                    .setTween( img_scr , {  ' . $opacity . $rotation . $horizontal_movement . $vertical_movement . '  } )
                                    .addTo( controller );
                            }
                        });
                    })( jQuery );</script>';
                endif;
            }

            if ( 'text-editor' === $widget->get_name() ) {
                $settings               = $widget->get_settings();
                $element_id             = $widget->get_id();
                $duration	            = !empty($settings['wn_duration']) ?  $settings['wn_duration'] : '';
                $trigger_hook	        = !empty($settings['wn_trigger_hook']) ?  $settings['wn_trigger_hook'] : '';
                $horizontal_movement	= !empty($settings['wn_horizontal_movement']) ? 'x: "' . $settings['wn_horizontal_movement'] . '",' : '';
                $vertical_movement		= !empty($settings['wn_vertical_movement']) ? 'y: "' . $settings['wn_vertical_movement'] . '",' : '';
                $opacity				= is_numeric( $settings['wn_opacity'] ) ? 'opacity: "' . $settings['wn_opacity'] . '",' : '';
                $rotation				= !empty($settings['wn_rotation']) ? 'rotation: "' . $settings['wn_rotation'] . '",' : '';

                if ( $settings['wn_animation_pro_enable'] == 'on' ) :
                    wp_enqueue_script( 'deep-tween-plugins', DEEP_ASSETS_URL . 'js/frontend/plugins/tween-plugins.js', array( 'jquery' ), DEEP_VERSION, true );
                    wp_enqueue_script( 'deep-scrollmagic', DEEP_ASSETS_URL . 'js/frontend/plugins/scroll-magic.js', array( 'jquery' ), DEEP_VERSION, true );

                    $content .= '<script>
                    ( function( $ ) {
                        $( document ).ready( function() {
                            var attr = ".elementor-widget-text-editor[data-id=' . $element_id . ']",
                                duration = "'.$duration.'",
                                trigger_hook = "'.$trigger_hook.'";
                            if (typeof attr !== typeof undefined && attr !== false) {
                                var controller = new ScrollMagic.Controller();
                                var text = attr + " p";
                                new ScrollMagic.Scene({
                                        triggerElement: attr,
                                        duration: duration,
                                        triggerHook: trigger_hook
                                    })
                                    .setTween( text , {  ' . $opacity . $rotation . $horizontal_movement . $vertical_movement . '  } )
                                    .addTo( controller );
                            }
                        });
                    })( jQuery );</script>';
                endif;
            }

            return $content;
        }


        /**
         * Add Webnus Options to section
         *
         *
         * @since 1.2.5
         *
         * @access public
         */
        public function add_webnus_options_to_section( $element, $args ) {
            $element->start_controls_section(
                'webnus_options',
                [
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'label' => __( 'Webnus Options', 'deep' ),
                ]
            );

            $element->add_control(
                'expandable_row',
                [
                    'label' 		=> __( 'Expandable Section', 'deep' ),
                    'type' 			=> \Elementor\Controls_Manager::SWITCHER,
                    'label_on' 		=> __( 'Enable', 'deep' ),
                    'label_off' 	=> __( 'Disable', 'deep' ),
                    'return_value' 	=> 'on',
                    'default' 		=> 'off',
                ]
            );

            $element->add_control(
                'txt_expandable_row',
                [
                    'label' 		=> __( 'Expand Text', 'deep' ),
                    'type' 			=> \Elementor\Controls_Manager::TEXT,
                    'description'	=> esc_html__( 'Show text above of expand icon button', 'deep' ),
                    'condition' 	=> [ //dependency
                        'expandable_row' 	=> [
                            'on',
                        ],
                    ],
                ]
            );

            $element->add_control(
                'color_expandable_row', //param_name
                [
                    'label' 		=> __( 'Icon Color', 'deep' ), //heading
                    'type' 			=> \Elementor\Controls_Manager::COLOR, //type
                    'selectors' 	=> [
                        '{{WRAPPER}} .wn-expandable-sec i' => 'color: {{VALUE}}',
                    ],
                    'condition' 	=> [ //dependency
                        'expandable_row' 	=> [
                            'on'
                        ],
                    ],
                ]
            );

            $element->add_control(
                'wn_parallax',
                [
                    'label' 		=> __( 'Parallax', 'deep' ),
                    'type' 			=> \Elementor\Controls_Manager::SWITCHER,
                    'label_on' 		=> __( 'Enable', 'deep' ),
                    'label_off' 	=> __( 'Disable', 'deep' ),
                    'return_value' 	=> 'content-moving',
                    'default' 		=> 'off',
                    'condition'     => [
                        'background_background' => [ 'classic', 'gradient', 'video' ],
                    ],
                ]
            );

            $element->add_control(
                'wn_parallax_speed', //param_name
                [
                    'label' 	=> __( 'Parallax Speed', 'deep' ), //heading
                    'type' 		=> \Elementor\Controls_Manager::SELECT, //type
                    'default' 	=> '123',
                    'options' 	=> [ //value
                        '108' => __( 'Very Slow', 'deep' ),
                        '123' => __( 'Slow', 'deep' ),
                        '190' => __( 'Normal', 'deep' ),
                        '225' => __( 'Fast', 'deep' ),
                        '260' => __( 'Very Fast', 'deep' ),
                    ],
                    'condition'     => [
                        'background_background' => [ 'classic', 'gradient', 'video' ],
                        'wn_parallax'           => 'content-moving',
                    ],
                ]
            );

            $element->add_control(
                'responsive_bg_none',
                [
                    'label' 		=> __( 'Background None in Mobile Size?', 'deep' ),
                    'type' 			=> \Elementor\Controls_Manager::SWITCHER,
                    'label_on' 		=> __( 'Enable', 'deep' ),
                    'label_off' 	=> __( 'Disable', 'deep' ),
                    'return_value' 	=> 'none',
                    'default' 		=> '',
                    'description'	=> esc_html__( 'If checked background columns will be disabled in mobile.', 'deep' ),
                    'selectors' 	=> [
                        '(tablet){{WRAPPER}}' => 'background-image: {{VALUE}} !important',
                    ],
                ]
            );

            $element->add_control(
                'layer_animation', //param_name
                [
                    'label' 	=> __( 'Layer Animation', 'deep' ), //heading
                    'type' 		=> \Elementor\Controls_Manager::SELECT, //type
                    'default' 	=> 'none',
                    'options' 	=> [ //value
                        'none'                   => __( 'None', 'deep' ),
                        'wn-layer-anim-bottom'   => __( 'Bottom to Top', 'deep' ),
                        'wn-layer-anim-top'      => __( 'Top to Bottom', 'deep' ),
                        'wn-layer-anim-left'     => __( 'Left to Right', 'deep' ),
                        'wn-layer-anim-right'    => __( 'Right to Left', 'deep' ),
                        'wn-layer-anim-zoom-in'  => __( 'Zoom in', 'deep' ),
                        'wn-layer-anim-zoom-out' => __( 'Zoom out', 'deep' ),
                        'wn-layer-anim-fade'     => __( 'Fade', 'deep' ),
                        'wn-layer-anim-flip'     => __( 'Flip', 'deep' ),
                    ],
                ]
            );

            $element->end_controls_section();
        }


        /**
         * Add Classes to Section element
         *
         *
         * @since 1.2.5
         *
         * @access public
         */
        public function wn_section_class( $element ) {

            $settings = $element->get_settings();

            if( $settings['expandable_row'] == 'on' ) {
                wp_enqueue_style( 'deep-expandable-section' );

                $uniqid = uniqid();
                $element->add_render_attribute( '_wrapper', 'data-expandable', 'wn-section'. $uniqid );
                $element->add_render_attribute( '_wrapper', 'data-id-expandable', $uniqid );
                $element->add_render_attribute( '_wrapper', 'class', 'wn-section'. $uniqid );
            }

            if( $settings['wn_parallax'] == 'content-moving' ) {
                wp_enqueue_style( 'deep-parallax' );
                wp_enqueue_script( 'deep-parallax-section', DEEP_ASSETS_URL . 'js/frontend/deep-parallax-section.js', array( 'jquery' ), DEEP_VERSION, true );
                wp_enqueue_script( 'deep-tween-plugins', DEEP_ASSETS_URL . 'js/frontend/plugins/tween-plugins.js', array( 'jquery' ), DEEP_VERSION, true );
                wp_enqueue_script( 'deep-scrollmagic', DEEP_ASSETS_URL . 'js/frontend/plugins/scroll-magic.js', array( 'jquery' ), DEEP_VERSION, true );

                $element->add_render_attribute( '_wrapper', 'class', 'wn-parallax' );
                $element->add_render_attribute( '_wrapper', 'data-parallax-speed', $settings['wn_parallax_speed'] );
            }

            if( $settings['layer_animation'] != 'none' ) {
                wp_enqueue_script( 'deep-elements-animation', DEEP_ASSETS_URL . 'js/frontend/deep-elements-animation.js', array( 'jquery' ), DEEP_VERSION, true );
                wp_enqueue_style( 'deep-layer-animation', DEEP_ASSETS_URL . 'css/frontend/main-style/layer-animation.css', false, DEEP_VERSION );
                $element->add_render_attribute( '_wrapper', 'class', $settings['layer_animation'] );
            }


        }


        /**
         * Section Output
         *
         *
         * @since 1.2.5
         *
         * @access public
         */
        public function wn_section_render( $element ) {
            $settings    = $element->get_settings();
            $element_id  = $element->get_id();

            if( $settings['expandable_row'] == 'on' ) {
                $expandable_text = !empty( $settings['txt_expandable_row'] ) ? '<div class=\"expandable-sec-text\"> '. $settings['txt_expandable_row'] .' </div>'	: '';
                echo '
                <script>( function( $ ) {
                    $( document ).ready( function() {
                        $("section[class*=\"wn-section\"]").each(function() {
                            var attr = $(this).attr("data-expandable");
                            var id = $(this).attr("data-id-expandable");
                            if (typeof attr !== typeof undefined && attr !== false ) {
                                var data_id = "." + attr;
                                $( data_id ).prepend("<div class=\"wn-expandable-sec\">' . $expandable_text . '<i class=\"sl-plus\" data-clickid=\"0\" ></i></div>");
                                var icon = $(data_id).find(".wn-expandable-sec i");
                                var main_wrap = $(data_id).find(".wn-expandable-sec");
                                var sectorr = data_id + " .wn-expandable-sec i";
                                $(icon).on("click", function() {
                                    $(icon).closest(".elementor-section").find(".elementor-container:first").slideToggle("slow");
                                });
                                $(icon).on("click", function(event) {
                                    if ( main_wrap.hasClass("wn-expanded") ) {
                                        $(this).closest(".wn-expandable-sec").removeClass("wn-expanded");
                                    } else {
                                        $(this).closest(".wn-expandable-sec").addClass("wn-expanded");
                                    }
                                });
                                $(data_id).removeAttr( "data-expandable" );
                            }
                        });
                    }); // end document ready
                })( jQuery );</script>
                ';
            }
            deep_save_dyn_styles('#wrap section[class*="wn-section"] > .elementor-container { display: none; }');
            if( $settings['wn_parallax'] == 'content-moving' ) {
                echo '<script>( function( $ ) {
                    $( document ).ready( function() {
                        $("section[class*=\"wn-parallax\"]").each(function() {
                            var parallax_speed = $(this).attr("data-parallax-speed");
                            if (typeof parallax_speed !== typeof undefined && parallax_speed !== false ) {
                                $(this).prepend("<div class=\"wn-parallax-bg-holder\" data-wnparallax-speed=\"" + parallax_speed + "\"><div class=\"wn-parallax-bg\"></div></div>");
                                $(this).removeAttr( "data-parallax-speed" );
                            }
                        });
                    }); // end document ready
                })( jQuery );</script>';
            }

            if ( !empty( $settings['color_text'] ) ) {
                $custom_color = '#wrap .elementor-element.elementor-element-'.$element_id.' * { color: '.$settings['color_text'].';}';

                deep_save_dyn_styles( $custom_color );

                if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
                    echo '<style>'. $custom_color .'</style>';
                }
            }
        }

        /**
         * Add Webnus Options to Column
         *
         *
         * @since 1.2.5
         *
         * @access public
         */
        public function add_webnus_options_to_column( $element, $args ) {
            $element->start_controls_section(
                'webnus_options',
                [
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'label' => __( 'Webnus Options', 'deep' ),
                ]
            );

            $element->add_control(
                'inner_scroll',
                [
                    'label' 		=> __( 'Inner Scroll', 'deep' ),
                    'type' 			=> \Elementor\Controls_Manager::SWITCHER,
                    'label_on' 		=> __( 'Enable', 'deep' ),
                    'label_off' 	=> __( 'Disable', 'deep' ),
                    'return_value' 	=> 'on',
                    'default' 		=> 'off',
                ]
            );

            $element->add_responsive_control(
                'inner_scroll_height',
                [
                    'label' => __( 'Column Height', 'deep' ),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 3000,
                        ],
                    ],
                    'devices' => [ 'desktop', 'tablet', 'mobile' ],
                    'desktop_default' => [
                        'size' => 700,
                        'unit' => 'px',
                    ],
                    'tablet_default' => [
                        'size' => 400,
                        'unit' => 'px',
                    ],
                    'mobile_default' => [
                        'size' => 200,
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}}' => 'height: {{SIZE}}{{UNIT}};overflow-y: scroll;',
                    ],
                    'condition' 	=> [ //dependency
                        'inner_scroll' 	=> [
                            'on',
                        ],
                    ],
                ]
            );

            $element->add_control(
                'toggle',
                [
                    'label' 		=> __( 'Toggle', 'deep' ),
                    'type' 			=> \Elementor\Controls_Manager::SWITCHER,
                    'label_on' 		=> __( 'Enable', 'deep' ),
                    'label_off' 	=> __( 'Disable', 'deep' ),
                    'return_value' 	=> 'on',
                    'default' 		=> 'off',
                ]
            );

            $element->add_control(
                'toggle_width_open',
                [
                    'label' => __( 'Column Width When Opened', 'deep' ),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 3000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}}' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' 	=> [ //dependency
                        'toggle' 	=> [
                            'on',
                        ],
                    ],
                ]
            );

            $element->add_control(
                'toggle_height_open',
                [
                    'label' => __( 'Column Height When Opened', 'deep' ),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 3000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}}' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' 	=> [ //dependency
                        'toggle' 	=> [
                            'on',
                        ],
                    ],
                ]
            );

            $element->add_control(
                'toggle_width_close',
                [
                    'label' => __( 'Column Width When Closed', 'deep' ),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 3000,
                        ],
                    ],
                    'condition' 	=> [ //dependency
                        'toggle' 	=> [
                            'on',
                        ],
                    ],
                ]
            );

            $element->add_control(
                'toggle_height_close',
                [
                    'label' => __( 'Column Height When Closed', 'deep' ),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 3000,
                        ],
                    ],
                    'condition' 	=> [ //dependency
                        'toggle' 	=> [
                            'on',
                        ],
                    ],
                ]
            );

            $element->end_controls_section();
        }

        /**
         * Add Classes to Column element
         *
         *
         * @since 1.2.5
         *
         * @access public
         */
        public function wn_column_class( $element ) {

            $settings = $element->get_settings();

            if( $settings['toggle'] == 'on' ) {
                $element->add_render_attribute( '_wrapper', 'class', 'wn-toggle-column' );
            }

            if( $settings['inner_scroll'] == 'on' ) {
                wp_enqueue_style( 'deep-inner-scroll-column', DEEP_ASSETS_URL . 'css/frontend/main-style/inner-scroll-column.css', false, DEEP_VERSION );
                $element->add_render_attribute( '_wrapper', 'class', 'wn-inner-scroll-column' );
            }

        }


        /**
         * Column Output
         *
         *
         * @since 1.2.5
         *
         * @access public
         */
        public function wn_column_render( $element ) {

            $settings = $element->get_settings();

            if ( $settings['inner_scroll'] == 'on' ) {
                wp_enqueue_script( 'deep-nicescroll-script', DEEP_ASSETS_URL . 'js/libraries/jquery.nicescroll.js', array( 'jquery' ), null, true );
                wp_enqueue_script( 'deep-scroll-column', DEEP_ASSETS_URL . 'js/frontend/deep-scroll-column.js', array( 'jquery' ), DEEP_VERSION, true );
            }

            if( $settings['toggle'] == 'on' ) {
                wp_enqueue_script( 'deep-toggle-column', DEEP_ASSETS_URL . 'js/frontend/deep-toggle-column.js', array( 'jquery' ), DEEP_VERSION, true );
                wp_enqueue_style( 'deep-toggle-column', DEEP_ASSETS_URL . 'css/frontend/main-style/toggle-column.css', false, DEEP_VERSION );

                $toggle_height_open_out		= $settings['toggle_height_open']['size'] 	? 'data-toggle_height_open		=\"' . $settings['toggle_height_open']['size']	 . '\"'	: '';
                $toggle_width_open_out 		= $settings['toggle_width_open']['size']  	? 'data-toggle_width_open		=\"' . $settings['toggle_width_open']['size']	 . '\"' 	: '';
                $toggle_height_close_out	= $settings['toggle_height_close']['size']	? 'data-toggle_height_close		=\"' . $settings['toggle_height_close']['size']	 . '\"'	: '';
                $toggle_width_close_out		= $settings['toggle_width_close']['size'] 	? 'data-toggle_width_close		=\"' . $settings['toggle_width_close']['size']	 . '\"'	: '';
                echo '
                <script>( function( $ ) {
                    $( document ).ready( function() {
                        $( ".elementor-column" ).each(function() {
                            if ( $(this).hasClass( "wn-toggle-column" ) ) {
                                $(this).prepend("<span class=\"wn-toggle-column-icon\" ' . $toggle_height_open_out . $toggle_width_open_out . $toggle_height_close_out . $toggle_width_close_out  . '><i class=\"icon-arrows-left-double-32\"></i></span>");
                            }
                        });
                    }); // end document ready
                })( jQuery );</script>
                ';
            }

        }



        /**
         * Add Custom Icons
         *
         *
         * @since 1.2.5
         *
         * @access public
         */
        public function wn_Custom_Icons( $controls_registry ) {

            $all_icons = $controls_registry->get_control( 'icon' )->get_settings( 'options', '' );
            $wn_icons = array(
                'wn-fab wn-fa-accessible-icon' => 'accessible-icon',
                'wn-fab wn-fa-accusoft' => 'accusoft',
                'wn-fab wn-fa-adn' => 'adn',
                'wn-fab wn-fa-adversal' => 'adversal',
                'wn-fab wn-fa-affiliatetheme' => 'affiliatetheme',
                'wn-fab wn-fa-algolia' => 'algolia',
                'wn-fab wn-fa-amazon' => 'amazon',
                'wn-fab wn-fa-amazon-pay' => 'amazon-pay',
                'wn-fab wn-fa-amilia' => 'amilia',
                'wn-fab wn-fa-android' => 'android',
                'wn-fab wn-fa-angellist' => 'angellist',
                'wn-fab wn-fa-angrycreative' => 'angrycreative',
                'wn-fab wn-fa-angular' => 'angular',
                'wn-fab wn-fa-app-store' => 'app-store',
                'wn-fab wn-fa-app-store-ios' => 'app-store-ios',
                'wn-fab wn-fa-apper' => 'apper',
                'wn-fab wn-fa-apple' => 'apple',
                'wn-fab wn-fa-apple-pay' => 'apple-pay',
                'wn-fab wn-fa-asymmetrik' => 'asymmetrik',
                'wn-fab wn-fa-audible' => 'audible',
                'wn-fab wn-fa-autoprefixer' => 'autoprefixer',
                'wn-fab wn-fa-avianex' => 'avianex',
                'wn-fab wn-fa-aviato' => 'aviato',
                'wn-fab wn-fa-aws' => 'aws',
                'wn-fab wn-fa-bandcamp' => 'bandcamp',
                'wn-fab wn-fa-behance' => 'behance',
                'wn-fab wn-fa-behance-square' => 'behance-square',
                'wn-fab wn-fa-bimobject' => 'bimobject',
                'wn-fab wn-fa-bitbucket' => 'bitbucket',
                'wn-fab wn-fa-bitcoin' => 'bitcoin',
                'wn-fab wn-fa-bity' => 'bity',
                'wn-fab wn-fa-black-tie' => 'black-tie',
                'wn-fab wn-fa-blackberry' => 'blackberry',
                'wn-fab wn-fa-blogger' => 'blogger',
                'wn-fab wn-fa-blogger-b' => 'blogger-b',
                'wn-fab wn-fa-bluetooth' => 'bluetooth',
                'wn-fab wn-fa-bluetooth-b' => 'bluetooth-b',
                'wn-fab wn-fa-btc' => 'btc',
                'wn-fab wn-fa-buromobelexperte' => 'buromobelexperte',
                'wn-fab wn-fa-buysellads' => 'buysellads',
                'wn-fab wn-fa-cc-amazon-pay' => 'cc-amazon-pay',
                'wn-fab wn-fa-cc-amex' => 'cc-amex',
                'wn-fab wn-fa-cc-apple-pay' => 'cc-apple-pay',
                'wn-fab wn-fa-cc-diners-club' => 'cc-diners-club',
                'wn-fab wn-fa-cc-discover' => 'cc-discover',
                'wn-fab wn-fa-cc-jcb' => 'cc-jcb',
                'wn-fab wn-fa-cc-mastercard' => 'cc-mastercard',
                'wn-fab wn-fa-cc-paypal' => 'cc-paypal',
                'wn-fab wn-fa-cc-stripe' => 'cc-stripe',
                'wn-fab wn-fa-cc-visa' => 'cc-visa',
                'wn-fab wn-fa-centercode' => 'centercode',
                'wn-fab wn-fa-chrome' => 'chrome',
                'wn-fab wn-fa-cloudscale' => 'cloudscale',
                'wn-fab wn-fa-cloudsmith' => 'cloudsmith',
                'wn-fab wn-fa-cloudversify' => 'cloudversify',
                'wn-fab wn-fa-codepen' => 'codepen',
                'wn-fab wn-fa-codiepie' => 'codiepie',
                'wn-fab wn-fa-connectdevelop' => 'connectdevelop',
                'wn-fab wn-fa-contao' => 'contao',
                'wn-fab wn-fa-cpanel' => 'cpanel',
                'wn-fab wn-fa-creative-commons' => 'creative-commons',
                'wn-fab wn-fa-creative-commons-by' => 'creative-commons-by',
                'wn-fab wn-fa-creative-commons-nc' => 'creative-commons-nc',
                'wn-fab wn-fa-creative-commons-nc-eu' => 'creative-commons-nc-eu',
                'wn-fab wn-fa-creative-commons-nc-jp' => 'creative-commons-nc-jp',
                'wn-fab wn-fa-creative-commons-nd' => 'creative-commons-nd',
                'wn-fab wn-fa-creative-commons-pd' => 'creative-commons-pd',
                'wn-fab wn-fa-creative-commons-pd-alt' => 'creative-commons-pd-alt',
                'wn-fab wn-fa-creative-commons-remix' => 'creative-commons-remix',
                'wn-fab wn-fa-creative-commons-sa' => 'creative-commons-sa',
                'wn-fab wn-fa-creative-commons-sampling' => 'creative-commons-sampling',
                'wn-fab wn-fa-creative-commons-sampling-plus' => 'creative-commons-sampling-plus',
                'wn-fab wn-fa-creative-commons-share' => 'creative-commons-share',
                'wn-fab wn-fa-css3' => 'css3',
                'wn-fab wn-fa-css3-alt' => 'css3-alt',
                'wn-fab wn-fa-cuttlefish' => 'cuttlefish',
                'wn-fab wn-fa-d-and-d' => 'd-and-d',
                'wn-fab wn-fa-dashcube' => 'dashcube',
                'wn-fab wn-fa-delicious' => 'delicious',
                'wn-fab wn-fa-deploydog' => 'deploydog',
                'wn-fab wn-fa-deskpro' => 'deskpro',
                'wn-fab wn-fa-deviantart' => 'deviantart',
                'wn-fab wn-fa-digg' => 'digg',
                'wn-fab wn-fa-digital-ocean' => 'digital-ocean',
                'wn-fab wn-fa-discord' => 'discord',
                'wn-fab wn-fa-discourse' => 'discourse',
                'wn-fab wn-fa-dochub' => 'dochub',
                'wn-fab wn-fa-docker' => 'docker',
                'wn-fab wn-fa-draft2digital' => 'draft2digital',
                'wn-fab wn-fa-dribbble' => 'dribbble',
                'wn-fab wn-fa-dribbble-square' => 'dribbble-square',
                'wn-fab wn-fa-dropbox' => 'dropbox',
                'wn-fab wn-fa-drupal' => 'drupal',
                'wn-fab wn-fa-dyalog' => 'dyalog',
                'wn-fab wn-fa-earlybirds' => 'earlybirds',
                'wn-fab wn-fa-ebay' => 'ebay',
                'wn-fab wn-fa-edge' => 'edge',
                'wn-fab wn-fa-elementor' => 'elementor',
                'wn-fab wn-fa-ember' => 'ember',
                'wn-fab wn-fa-empire' => 'empire',
                'wn-fab wn-fa-envira' => 'envira',
                'wn-fab wn-fa-erlang' => 'erlang',
                'wn-fab wn-fa-ethereum' => 'ethereum',
                'wn-fab wn-fa-etsy' => 'etsy',
                'wn-fab wn-fa-expeditedssl' => 'expeditedssl',
                'wn-fab wn-fa-facebook' => 'facebook',
                'wn-icon wn-fab wn-fa-facebook-f' => 'facebook-f',
                'wn-fab wn-fa-facebook-messenger' => 'facebook-messenger',
                'wn-fab wn-fa-facebook-square' => 'facebook-square',
                'wn-fab wn-fa-firefox' => 'firefox',
                'wn-fab wn-fa-first-order' => 'first-order',
                'wn-fab wn-fa-first-order-alt' => 'first-order-alt',
                'wn-fab wn-fa-firstdraft' => 'firstdraft',
                'wn-fab wn-fa-flickr' => 'flickr',
                'wn-fab wn-fa-flipboard' => 'flipboard',
                'wn-fab wn-fa-fly' => 'fly',
                'wn-fab wn-fa-font-awesome' => 'font-awesome',
                'wn-fab wn-fa-font-awesome-alt' => 'font-awesome-alt',
                'wn-fab wn-fa-font-awesome-flag' => 'font-awesome-flag',
                'wn-fab wn-fa-fonticons' => 'fonticons',
                'wn-fab wn-fa-fonticons-fi' => 'fonticons-fi',
                'wn-fab wn-fa-fort-awesome' => 'fort-awesome',
                'wn-fab wn-fa-fort-awesome-alt' => 'fort-awesome-alt',
                'wn-fab wn-fa-forumbee' => 'forumbee',
                'wn-fab wn-fa-foursquare' => 'foursquare',
                'wn-fab wn-fa-free-code-camp' => 'free-code-camp',
                'wn-fab wn-fa-freebsd' => 'freebsd',
                'wn-fab wn-fa-fulcrum' => 'fulcrum',
                'wn-fab wn-fa-galactic-republic' => 'galactic-republic',
                'wn-fab wn-fa-galactic-senate' => 'galactic-senate',
                'wn-fab wn-fa-get-pocket' => 'get-pocket',
                'wn-fab wn-fa-gg' => 'gg',
                'wn-fab wn-fa-gg-circle' => 'gg-circle',
                'wn-fab wn-fa-git' => 'git',
                'wn-fab wn-fa-git-square' => 'git-square',
                'wn-fab wn-fa-github' => 'github',
                'wn-fab wn-fa-github-alt' => 'github-alt',
                'wn-fab wn-fa-github-square' => 'github-square',
                'wn-fab wn-fa-gitkraken' => 'gitkraken',
                'wn-fab wn-fa-gitlab' => 'gitlab',
                'wn-fab wn-fa-gitter' => 'gitter',
                'wn-fab wn-fa-glide' => 'glide',
                'wn-fab wn-fa-glide-g' => 'glide-g',
                'wn-fab wn-fa-gofore' => 'gofore',
                'wn-fab wn-fa-goodreads' => 'goodreads',
                'wn-fab wn-fa-goodreads-g' => 'goodreads-g',
                'wn-fab wn-fa-google' => 'google',
                'wn-fab wn-fa-google-drive' => 'google-drive',
                'wn-fab wn-fa-google-play' => 'google-play',
                'wn-fab wn-fa-google-plus' => 'google-plus',
                'wn-fab wn-fa-google-plus-g' => 'google-plus-g',
                'wn-fab wn-fa-google-plus-square' => 'google-plus-square',
                'wn-fab wn-fa-google-wallet' => 'google-wallet',
                'wn-fab wn-fa-gratipay' => 'gratipay',
                'wn-fab wn-fa-grav' => 'grav',
                'wn-fab wn-fa-gripfire' => 'gripfire',
                'wn-fab wn-fa-grunt' => 'grunt',
                'wn-fab wn-fa-gulp' => 'gulp',
                'wn-fab wn-fa-hacker-news' => 'hacker-news',
                'wn-fab wn-fa-hacker-news-square' => 'hacker-news-square',
                'wn-fab wn-fa-hips' => 'hips',
                'wn-fab wn-fa-hire-a-helper' => 'hire-a-helper',
                'wn-fab wn-fa-hooli' => 'hooli',
                'wn-fab wn-fa-hotjar' => 'hotjar',
                'wn-fab wn-fa-houzz' => 'houzz',
                'wn-fab wn-fa-html5' => 'html5',
                'wn-fab wn-fa-hubspot' => 'hubspot',
                'wn-fab wn-fa-imdb' => 'imdb',
                'wn-fab wn-fa-instagram' => 'instagram',
                'wn-fab wn-fa-internet-explorer' => 'internet-explorer',
                'wn-fab wn-fa-ioxhost' => 'ioxhost',
                'wn-fab wn-fa-itunes' => 'itunes',
                'wn-fab wn-fa-itunes-note' => 'itunes-note',
                'wn-fab wn-fa-java' => 'java',
                'wn-fab wn-fa-jedi-order' => 'jedi-order',
                'wn-fab wn-fa-jenkins' => 'jenkins',
                'wn-fab wn-fa-joget' => 'joget',
                'wn-fab wn-fa-joomla' => 'joomla',
                'wn-fab wn-fa-js' => 'js',
                'wn-fab wn-fa-js-square' => 'js-square',
                'wn-fab wn-fa-jsfiddle' => 'jsfiddle',
                'wn-fab wn-fa-keybase' => 'keybase',
                'wn-fab wn-fa-keycdn' => 'keycdn',
                'wn-fab wn-fa-kickstarter' => 'kickstarter',
                'wn-fab wn-fa-kickstarter-k' => 'kickstarter-k',
                'wn-fab wn-fa-korvue' => 'korvue',
                'wn-fab wn-fa-laravel' => 'laravel',
                'wn-fab wn-fa-lastfm' => 'lastfm',
                'wn-fab wn-fa-lastfm-square' => 'lastfm-square',
                'wn-fab wn-fa-leanpub' => 'leanpub',
                'wn-fab wn-fa-less' => 'less',
                'wn-fab wn-fa-line' => 'line',
                'wn-fab wn-fa-linkedin' => 'linkedin',
                'wn-fab wn-fa-linkedin-in' => 'linkedin-in',
                'wn-fab wn-fa-linode' => 'linode',
                'wn-fab wn-fa-linux' => 'linux',
                'wn-fab wn-fa-lyft' => 'lyft',
                'wn-fab wn-fa-magento' => 'magento',
                'wn-fab wn-fa-mandalorian' => 'mandalorian',
                'wn-fab wn-fa-mastodon' => 'mastodon',
                'wn-fab wn-fa-maxcdn' => 'maxcdn',
                'wn-fab wn-fa-medapps' => 'medapps',
                'wn-fab wn-fa-medium' => 'medium',
                'wn-fab wn-fa-medium-m' => 'medium-m',
                'wn-fab wn-fa-medrt' => 'medrt',
                'wn-fab wn-fa-meetup' => 'meetup',
                'wn-fab wn-fa-microsoft' => 'microsoft',
                'wn-fab wn-fa-mix' => 'mix',
                'wn-fab wn-fa-mixcloud' => 'mixcloud',
                'wn-fab wn-fa-mizuni' => 'mizuni',
                'wn-fab wn-fa-modx' => 'modx',
                'wn-fab wn-fa-monero' => 'monero',
                'wn-fab wn-fa-napster' => 'napster',
                'wn-fab wn-fa-nintendo-switch' => 'nintendo-switch',
                'wn-fab wn-fa-node' => 'node',
                'wn-fab wn-fa-node-js' => 'node-js',
                'wn-fab wn-fa-npm' => 'npm',
                'wn-fab wn-fa-ns8' => 'ns8',
                'wn-fab wn-fa-nutritionix' => 'nutritionix',
                'wn-fab wn-fa-odnoklassniki' => 'odnoklassniki',
                'wn-fab wn-fa-odnoklassniki-square' => 'odnoklassniki-square',
                'wn-fab wn-fa-old-republic' => 'old-republic',
                'wn-fab wn-fa-opencart' => 'opencart',
                'wn-fab wn-fa-openid' => 'openid',
                'wn-fab wn-fa-opera' => 'opera',
                'wn-fab wn-fa-optin-monster' => 'optin-monster',
                'wn-fab wn-fa-osi' => 'osi',
                'wn-fab wn-fa-page4' => 'page4',
                'wn-fab wn-fa-pagelines' => 'pagelines',
                'wn-fab wn-fa-palfed' => 'palfed',
                'wn-fab wn-fa-patreon' => 'patreon',
                'wn-fab wn-fa-paypal' => 'paypal',
                'wn-fab wn-fa-periscope' => 'periscope',
                'wn-fab wn-fa-phabricator' => 'phabricator',
                'wn-fab wn-fa-phoenix-framework' => 'phoenix-framework',
                'wn-fab wn-fa-phoenix-squadron' => 'phoenix-squadron',
                'wn-fab wn-fa-php' => 'php',
                'wn-fab wn-fa-pied-piper' => 'pied-piper',
                'wn-fab wn-fa-pied-piper-alt' => 'pied-piper-alt',
                'wn-fab wn-fa-pied-piper-hat' => 'pied-piper-hat',
                'wn-fab wn-fa-pied-piper-pp' => 'pied-piper-pp',
                'wn-fab wn-fa-pinterest' => 'pinterest',
                'wn-fab wn-fa-pinterest-p' => 'pinterest-p',
                'wn-fab wn-fa-pinterest-square' => 'pinterest-square',
                'wn-fab wn-fa-playstation' => 'playstation',
                'wn-fab wn-fa-product-hunt' => 'product-hunt',
                'wn-fab wn-fa-pushed' => 'pushed',
                'wn-fab wn-fa-python' => 'python',
                'wn-fab wn-fa-qq' => 'qq',
                'wn-fab wn-fa-quinscape' => 'quinscape',
                'wn-fab wn-fa-quora' => 'quora',
                'wn-fab wn-fa-r-project' => 'r-project',
                'wn-fab wn-fa-ravelry' => 'ravelry',
                'wn-fab wn-fa-react' => 'react',
                'wn-fab wn-fa-readme' => 'readme',
                'wn-fab wn-fa-rebel' => 'rebel',
                'wn-fab wn-fa-red-river' => 'red-river',
                'wn-fab wn-fa-reddit' => 'reddit',
                'wn-fab wn-fa-reddit-alien' => 'reddit-alien',
                'wn-fab wn-fa-reddit-square' => 'reddit-square',
                'wn-fab wn-fa-rendact' => 'rendact',
                'wn-fab wn-fa-renren' => 'renren',
                'wn-fab wn-fa-replyd' => 'replyd',
                'wn-fab wn-fa-researchgate' => 'researchgate',
                'wn-fab wn-fa-resolving' => 'resolving',
                'wn-fab wn-fa-rocketchat' => 'rocketchat',
                'wn-fab wn-fa-rockrms' => 'rockrms',
                'wn-fab wn-fa-safari' => 'safari',
                'wn-fab wn-fa-sass' => 'sass',
                'wn-fab wn-fa-schlix' => 'schlix',
                'wn-fab wn-fa-scribd' => 'scribd',
                'wn-fab wn-fa-searchengin' => 'searchengin',
                'wn-fab wn-fa-sellcast' => 'sellcast',
                'wn-fab wn-fa-sellsy' => 'sellsy',
                'wn-fab wn-fa-servicestack' => 'servicestack',
                'wn-fab wn-fa-shirtsinbulk' => 'shirtsinbulk',
                'wn-fab wn-fa-simplybuilt' => 'simplybuilt',
                'wn-fab wn-fa-sistrix' => 'sistrix',
                'wn-fab wn-fa-sith' => 'sith',
                'wn-fab wn-fa-skyatlas' => 'skyatlas',
                'wn-fab wn-fa-skype' => 'skype',
                'wn-fab wn-fa-slack' => 'slack',
                'wn-fab wn-fa-slack-hash' => 'slack-hash',
                'wn-fab wn-fa-slideshare' => 'slideshare',
                'wn-fab wn-fa-snapchat' => 'snapchat',
                'wn-fab wn-fa-snapchat-ghost' => 'snapchat-ghost',
                'wn-fab wn-fa-snapchat-square' => 'snapchat-square',
                'wn-fab wn-fa-soundcloud' => 'soundcloud',
                'wn-fab wn-fa-speakap' => 'speakap',
                'wn-fab wn-fa-spotify' => 'spotify',
                'wn-fab wn-fa-stack-exchange' => 'stack-exchange',
                'wn-fab wn-fa-stack-overflow' => 'stack-overflow',
                'wn-fab wn-fa-staylinked' => 'staylinked',
                'wn-fab wn-fa-steam' => 'steam',
                'wn-fab wn-fa-steam-square' => 'steam-square',
                'wn-fab wn-fa-steam-symbol' => 'steam-symbol',
                'wn-fab wn-fa-sticker-mule' => 'sticker-mule',
                'wn-fab wn-fa-strava' => 'strava',
                'wn-fab wn-fa-stripe' => 'stripe',
                'wn-fab wn-fa-stripe-s' => 'stripe-s',
                'wn-fab wn-fa-studiovinari' => 'studiovinari',
                'wn-fab wn-fa-stumbleupon' => 'stumbleupon',
                'wn-fab wn-fa-stumbleupon-circle' => 'stumbleupon-circle',
                'wn-fab wn-fa-superpowers' => 'superpowers',
                'wn-fab wn-fa-supple' => 'supple',
                'wn-fab wn-fa-teamspeak' => 'teamspeak',
                'wn-fab wn-fa-telegram' => 'telegram',
                'wn-fab wn-fa-telegram-plane' => 'telegram-plane',
                'wn-fab wn-fa-tencent-weibo' => 'tencent-weibo',
                'wn-fab wn-fa-themeisle' => 'themeisle',
                'wn-fab wn-fa-trade-federation' => 'trade-federation',
                'wn-fab wn-fa-trello' => 'trello',
                'wn-fab wn-fa-tripadvisor' => 'tripadvisor',
                'wn-fab wn-fa-tumblr' => 'tumblr',
                'wn-fab wn-fa-tumblr-square' => 'tumblr-square',
                'wn-fab wn-fa-twitch' => 'twitch',
                'wn-fab wn-fa-twitter' => 'twitter',
                'wn-fab wn-fa-twitter-square' => 'twitter-square',
                'wn-fab wn-fa-typo3' => 'typo3',
                'wn-fab wn-fa-uber' => 'uber',
                'wn-fab wn-fa-uikit' => 'uikit',
                'wn-fab wn-fa-uniregistry' => 'uniregistry',
                'wn-fab wn-fa-untappd' => 'untappd',
                'wn-fab wn-fa-usb' => 'usb',
                'wn-fab wn-fa-ussunnah' => 'ussunnah',
                'wn-fab wn-fa-vaadin' => 'vaadin',
                'wn-fab wn-fa-viacoin' => 'viacoin',
                'wn-fab wn-fa-viadeo' => 'viadeo',
                'wn-fab wn-fa-viadeo-square' => 'viadeo-square',
                'wn-fab wn-fa-viber' => 'viber',
                'wn-fab wn-fa-vimeo' => 'vimeo',
                'wn-fab wn-fa-vimeo-square' => 'vimeo-square',
                'wn-fab wn-fa-vimeo-v' => 'vimeo-v',
                'wn-fab wn-fa-vine' => 'vine',
                'wn-fab wn-fa-vk' => 'vk',
                'wn-fab wn-fa-vnv' => 'vnv',
                'wn-fab wn-fa-vuejs' => 'vuejs',
                'wn-fab wn-fa-weibo' => 'weibo',
                'wn-fab wn-fa-weixin' => 'weixin',
                'wn-fab wn-fa-whatsapp' => 'whatsapp',
                'wn-fab wn-fa-whatsapp-square' => 'whatsapp-square',
                'wn-fab wn-fa-whmcs' => 'whmcs',
                'wn-fab wn-fa-wikipedia-w' => 'wikipedia-w',
                'wn-fab wn-fa-windows' => 'windows',
                'wn-fab wn-fa-wolf-pack-battalion' => 'wolf-pack-battalion',
                'wn-fab wn-fa-wordpress' => 'wordpress',
                'wn-fab wn-fa-wordpress-simple' => 'wordpress-simple',
                'wn-fab wn-fa-wpbeginner' => 'wpbeginner',
                'wn-fab wn-fa-wpexplorer' => 'wpexplorer',
                'wn-fab wn-fa-wpforms' => 'wpforms',
                'wn-fab wn-fa-xbox' => 'xbox',
                'wn-fab wn-fa-xing' => 'xing',
                'wn-fab wn-fa-xing-square' => 'xing-square',
                'wn-fab wn-fa-y-combinator' => 'y-combinator',
                'wn-fab wn-fa-yahoo' => 'yahoo',
                'wn-fab wn-fa-yandex' => 'yandex',
                'wn-fab wn-fa-yandex-international' => 'yandex-international',
                'wn-fab wn-fa-yelp' => 'yelp',
                'wn-fab wn-fa-yoast' => 'yoast',
                'wn-fab wn-fa-youtube' => 'youtube',
                'wn-fab wn-fa-youtube-square' => 'youtube-square',
                'wn-fas wn-fa-address-book' => 'address-book',
                'wn-fas wn-fa-address-card' => 'address-card',
                'wn-fas wn-fa-adjust' => 'adjust',
                'wn-fas wn-fa-align-center' => 'align-center',
                'wn-fas wn-fa-align-justify' => 'align-justify',
                'wn-fas wn-fa-align-left' => 'align-left',
                'wn-fas wn-fa-align-right' => 'align-right',
                'wn-fas wn-fa-allergies' => 'allergies',
                'wn-fas wn-fa-ambulance' => 'ambulance',
                'wn-fas wn-fa-american-sign-language-interpreting' => 'american-sign-language-interpreting',
                'wn-fas wn-fa-anchor' => 'anchor',
                'wn-fas wn-fa-angle-double-down' => 'angle-double-down',
                'wn-fas wn-fa-angle-double-left' => 'angle-double-left',
                'wn-fas wn-fa-angle-double-right' => 'angle-double-right',
                'wn-fas wn-fa-angle-double-up' => 'angle-double-up',
                'wn-fas wn-fa-angle-down' => 'angle-down',
                'wn-fas wn-fa-angle-left' => 'angle-left',
                'wn-fas wn-fa-angle-right' => 'angle-right',
                'wn-fas wn-fa-angle-up' => 'angle-up',
                'wn-fas wn-fa-archive' => 'archive',
                'wn-fas wn-fa-arrow-alt-circle-down' => 'arrow-alt-circle-down',
                'wn-fas wn-fa-arrow-alt-circle-left' => 'arrow-alt-circle-left',
                'wn-fas wn-fa-arrow-alt-circle-right' => 'arrow-alt-circle-right',
                'wn-fas wn-fa-arrow-alt-circle-up' => 'arrow-alt-circle-up',
                'wn-fas wn-fa-arrow-circle-down' => 'arrow-circle-down',
                'wn-fas wn-fa-arrow-circle-left' => 'arrow-circle-left',
                'wn-fas wn-fa-arrow-circle-right' => 'arrow-circle-right',
                'wn-fas wn-fa-arrow-circle-up' => 'arrow-circle-up',
                'wn-fas wn-fa-arrow-down' => 'arrow-down',
                'wn-fas wn-fa-arrow-left' => 'arrow-left',
                'wn-fas wn-fa-arrow-right' => 'arrow-right',
                'wn-fas wn-fa-arrow-up' => 'arrow-up',
                'wn-fas wn-fa-arrows-alt' => 'arrows-alt',
                'wn-fas wn-fa-arrows-alt-h' => 'arrows-alt-h',
                'wn-fas wn-fa-arrows-alt-v' => 'arrows-alt-v',
                'wn-fas wn-fa-assistive-listening-systems' => 'assistive-listening-systems',
                'wn-fas wn-fa-asterisk' => 'asterisk',
                'wn-fas wn-fa-at' => 'at',
                'wn-fas wn-fa-audio-description' => 'audio-description',
                'wn-fas wn-fa-backward' => 'backward',
                'wn-fas wn-fa-balance-scale' => 'balance-scale',
                'wn-fas wn-fa-ban' => 'ban',
                'wn-fas wn-fa-band-aid' => 'band-aid',
                'wn-fas wn-fa-barcode' => 'barcode',
                'wn-fas wn-fa-bars' => 'bars',
                'wn-fas wn-fa-baseball-ball' => 'baseball-ball',
                'wn-fas wn-fa-basketball-ball' => 'basketball-ball',
                'wn-fas wn-fa-bath' => 'bath',
                'wn-fas wn-fa-battery-empty' => 'battery-empty',
                'wn-fas wn-fa-battery-full' => 'battery-full',
                'wn-fas wn-fa-battery-half' => 'battery-half',
                'wn-fas wn-fa-battery-quarter' => 'battery-quarter',
                'wn-fas wn-fa-battery-three-quarters' => 'battery-three-quarters',
                'wn-fas wn-fa-bed' => 'bed',
                'wn-fas wn-fa-beer' => 'beer',
                'wn-fas wn-fa-bell' => 'bell',
                'wn-fas wn-fa-bell-slash' => 'bell-slash',
                'wn-fas wn-fa-bicycle' => 'bicycle',
                'wn-fas wn-fa-binoculars' => 'binoculars',
                'wn-fas wn-fa-birthday-cake' => 'birthday-cake',
                'wn-fas wn-fa-blender' => 'blender',
                'wn-fas wn-fa-blind' => 'blind',
                'wn-fas wn-fa-bold' => 'bold',
                'wn-fas wn-fa-bolt' => 'bolt',
                'wn-fas wn-fa-bomb' => 'bomb',
                'wn-fas wn-fa-book' => 'book',
                'wn-fas wn-fa-book-open' => 'book-open',
                'wn-fas wn-fa-bookmark' => 'bookmark',
                'wn-fas wn-fa-bowling-ball' => 'bowling-ball',
                'wn-fas wn-fa-box' => 'box',
                'wn-fas wn-fa-box-open' => 'box-open',
                'wn-fas wn-fa-boxes' => 'boxes',
                'wn-fas wn-fa-braille' => 'braille',
                'wn-fas wn-fa-briefcase' => 'briefcase',
                'wn-fas wn-fa-briefcase-medical' => 'briefcase-medical',
                'wn-fas wn-fa-broadcast-tower' => 'broadcast-tower',
                'wn-fas wn-fa-broom' => 'broom',
                'wn-fas wn-fa-bug' => 'bug',
                'wn-fas wn-fa-building' => 'building',
                'wn-fas wn-fa-bullhorn' => 'bullhorn',
                'wn-fas wn-fa-bullseye' => 'bullseye',
                'wn-fas wn-fa-burn' => 'burn',
                'wn-fas wn-fa-bus' => 'bus',
                'wn-fas wn-fa-calculator' => 'calculator',
                'wn-fas wn-fa-calendar' => 'calendar',
                'wn-fas wn-fa-calendar-alt' => 'calendar-alt',
                'wn-fas wn-fa-calendar-check' => 'calendar-check',
                'wn-fas wn-fa-calendar-minus' => 'calendar-minus',
                'wn-fas wn-fa-calendar-plus' => 'calendar-plus',
                'wn-fas wn-fa-calendar-times' => 'calendar-times',
                'wn-fas wn-fa-camera' => 'camera',
                'wn-fas wn-fa-camera-retro' => 'camera-retro',
                'wn-fas wn-fa-capsules' => 'capsules',
                'wn-fas wn-fa-car' => 'car',
                'wn-fas wn-fa-caret-down' => 'caret-down',
                'wn-fas wn-fa-caret-left' => 'caret-left',
                'wn-fas wn-fa-caret-right' => 'caret-right',
                'wn-fas wn-fa-caret-square-down' => 'caret-square-down',
                'wn-fas wn-fa-caret-square-left' => 'caret-square-left',
                'wn-fas wn-fa-caret-square-right' => 'caret-square-right',
                'wn-fas wn-fa-caret-square-up' => 'caret-square-up',
                'wn-fas wn-fa-caret-up' => 'caret-up',
                'wn-fas wn-fa-cart-arrow-down' => 'cart-arrow-down',
                'wn-fas wn-fa-cart-plus' => 'cart-plus',
                'wn-fas wn-fa-certificate' => 'certificate',
                'wn-fas wn-fa-chalkboard' => 'chalkboard',
                'wn-fas wn-fa-chalkboard-teacher' => 'chalkboard-teacher',
                'wn-fas wn-fa-chart-area' => 'chart-area',
                'wn-fas wn-fa-chart-bar' => 'chart-bar',
                'wn-fas wn-fa-chart-line' => 'chart-line',
                'wn-fas wn-fa-chart-pie' => 'chart-pie',
                'wn-fas wn-fa-check' => 'check',
                'wn-fas wn-fa-check-circle' => 'check-circle',
                'wn-fas wn-fa-check-square' => 'check-square',
                'wn-fas wn-fa-chess' => 'chess',
                'wn-fas wn-fa-chess-bishop' => 'chess-bishop',
                'wn-fas wn-fa-chess-board' => 'chess-board',
                'wn-fas wn-fa-chess-king' => 'chess-king',
                'wn-fas wn-fa-chess-knight' => 'chess-knight',
                'wn-fas wn-fa-chess-pawn' => 'chess-pawn',
                'wn-fas wn-fa-chess-queen' => 'chess-queen',
                'wn-fas wn-fa-chess-rook' => 'chess-rook',
                'wn-fas wn-fa-chevron-circle-down' => 'chevron-circle-down',
                'wn-fas wn-fa-chevron-circle-left' => 'chevron-circle-left',
                'wn-fas wn-fa-chevron-circle-right' => 'chevron-circle-right',
                'wn-fas wn-fa-chevron-circle-up' => 'chevron-circle-up',
                'wn-fas wn-fa-chevron-down' => 'chevron-down',
                'wn-fas wn-fa-chevron-left' => 'chevron-left',
                'wn-fas wn-fa-chevron-right' => 'chevron-right',
                'wn-fas wn-fa-chevron-up' => 'chevron-up',
                'wn-fas wn-fa-child' => 'child',
                'wn-fas wn-fa-church' => 'church',
                'wn-fas wn-fa-circle' => 'circle',
                'wn-fas wn-fa-circle-notch' => 'circle-notch',
                'wn-fas wn-fa-clipboard' => 'clipboard',
                'wn-fas wn-fa-clipboard-check' => 'clipboard-check',
                'wn-fas wn-fa-clipboard-list' => 'clipboard-list',
                'wn-fas wn-fa-clock' => 'clock',
                'wn-fas wn-fa-clone' => 'clone',
                'wn-fas wn-fa-closed-captioning' => 'closed-captioning',
                'wn-fas wn-fa-cloud' => 'cloud',
                'wn-fas wn-fa-cloud-download-alt' => 'cloud-download-alt',
                'wn-fas wn-fa-cloud-upload-alt' => 'cloud-upload-alt',
                'wn-fas wn-fa-code' => 'code',
                'wn-fas wn-fa-code-branch' => 'code-branch',
                'wn-fas wn-fa-coffee' => 'coffee',
                'wn-fas wn-fa-cog' => 'cog',
                'wn-fas wn-fa-cogs' => 'cogs',
                'wn-fas wn-fa-coins' => 'coins',
                'wn-fas wn-fa-columns' => 'columns',
                'wn-fas wn-fa-comment' => 'comment',
                'wn-fas wn-fa-comment-alt' => 'comment-alt',
                'wn-fas wn-fa-comment-dots' => 'comment-dots',
                'wn-fas wn-fa-comment-slash' => 'comment-slash',
                'wn-fas wn-fa-comments' => 'comments',
                'wn-fas wn-fa-compact-disc' => 'compact-disc',
                'wn-fas wn-fa-compass' => 'compass',
                'wn-fas wn-fa-compress' => 'compress',
                'wn-fas wn-fa-copy' => 'copy',
                'wn-fas wn-fa-copyright' => 'copyright',
                'wn-fas wn-fa-couch' => 'couch',
                'wn-fas wn-fa-credit-card' => 'credit-card',
                'wn-fas wn-fa-crop' => 'crop',
                'wn-fas wn-fa-crosshairs' => 'crosshairs',
                'wn-fas wn-fa-crow' => 'crow',
                'wn-fas wn-fa-crown' => 'crown',
                'wn-fas wn-fa-cube' => 'cube',
                'wn-fas wn-fa-cubes' => 'cubes',
                'wn-fas wn-fa-cut' => 'cut',
                'wn-fas wn-fa-database' => 'database',
                'wn-fas wn-fa-deaf' => 'deaf',
                'wn-fas wn-fa-desktop' => 'desktop',
                'wn-fas wn-fa-diagnoses' => 'diagnoses',
                'wn-fas wn-fa-dice' => 'dice',
                'wn-fas wn-fa-dice-five' => 'dice-five',
                'wn-fas wn-fa-dice-four' => 'dice-four',
                'wn-fas wn-fa-dice-one' => 'dice-one',
                'wn-fas wn-fa-dice-six' => 'dice-six',
                'wn-fas wn-fa-dice-three' => 'dice-three',
                'wn-fas wn-fa-dice-two' => 'dice-two',
                'wn-fas wn-fa-divide' => 'divide',
                'wn-fas wn-fa-dna' => 'dna',
                'wn-fas wn-fa-dollar-sign' => 'dollar-sign',
                'wn-fas wn-fa-dolly' => 'dolly',
                'wn-fas wn-fa-dolly-flatbed' => 'dolly-flatbed',
                'wn-fas wn-fa-donate' => 'donate',
                'wn-fas wn-fa-door-closed' => 'door-closed',
                'wn-fas wn-fa-door-open' => 'door-open',
                'wn-fas wn-fa-dot-circle' => 'dot-circle',
                'wn-fas wn-fa-dove' => 'dove',
                'wn-fas wn-fa-download' => 'download',
                'wn-fas wn-fa-dumbbell' => 'dumbbell',
                'wn-fas wn-fa-edit' => 'edit',
                'wn-fas wn-fa-eject' => 'eject',
                'wn-fas wn-fa-ellipsis-h' => 'ellipsis-h',
                'wn-fas wn-fa-ellipsis-v' => 'ellipsis-v',
                'wn-fas wn-fa-envelope' => 'envelope',
                'wn-fas wn-fa-envelope-open' => 'envelope-open',
                'wn-fas wn-fa-envelope-square' => 'envelope-square',
                'wn-fas wn-fa-equals' => 'equals',
                'wn-fas wn-fa-eraser' => 'eraser',
                'wn-fas wn-fa-euro-sign' => 'euro-sign',
                'wn-fas wn-fa-exchange-alt' => 'exchange-alt',
                'wn-fas wn-fa-exclamation' => 'exclamation',
                'wn-fas wn-fa-exclamation-circle' => 'exclamation-circle',
                'wn-fas wn-fa-exclamation-triangle' => 'exclamation-triangle',
                'wn-fas wn-fa-expand' => 'expand',
                'wn-fas wn-fa-expand-arrows-alt' => 'expand-arrows-alt',
                'wn-fas wn-fa-external-link-alt' => 'external-link-alt',
                'wn-fas wn-fa-external-link-square-alt' => 'external-link-square-alt',
                'wn-fas wn-fa-eye' => 'eye',
                'wn-fas wn-fa-eye-dropper' => 'eye-dropper',
                'wn-fas wn-fa-eye-slash' => 'eye-slash',
                'wn-fas wn-fa-fast-backward' => 'fast-backward',
                'wn-fas wn-fa-fast-forward' => 'fast-forward',
                'wn-fas wn-fa-fax' => 'fax',
                'wn-fas wn-fa-feather' => 'feather',
                'wn-fas wn-fa-female' => 'female',
                'wn-fas wn-fa-fighter-jet' => 'fighter-jet',
                'wn-fas wn-fa-file' => 'file',
                'wn-fas wn-fa-file-alt' => 'file-alt',
                'wn-fas wn-fa-file-archive' => 'file-archive',
                'wn-fas wn-fa-file-audio' => 'file-audio',
                'wn-fas wn-fa-file-code' => 'file-code',
                'wn-fas wn-fa-file-excel' => 'file-excel',
                'wn-fas wn-fa-file-image' => 'file-image',
                'wn-fas wn-fa-file-medical' => 'file-medical',
                'wn-fas wn-fa-file-medical-alt' => 'file-medical-alt',
                'wn-fas wn-fa-file-pdf' => 'file-pdf',
                'wn-fas wn-fa-file-powerpoint' => 'file-powerpoint',
                'wn-fas wn-fa-file-video' => 'file-video',
                'wn-fas wn-fa-file-word' => 'file-word',
                'wn-fas wn-fa-film' => 'film',
                'wn-fas wn-fa-filter' => 'filter',
                'wn-fas wn-fa-fire' => 'fire',
                'wn-fas wn-fa-fire-extinguisher' => 'fire-extinguisher',
                'wn-fas wn-fa-first-aid' => 'first-aid',
                'wn-fas wn-fa-flag' => 'flag',
                'wn-fas wn-fa-flag-checkered' => 'flag-checkered',
                'wn-fas wn-fa-flask' => 'flask',
                'wn-fas wn-fa-folder' => 'folder',
                'wn-fas wn-fa-folder-open' => 'folder-open',
                'wn-fas wn-fa-font' => 'font',
                'wn-fas wn-fa-football-ball' => 'football-ball',
                'wn-fas wn-fa-forward' => 'forward',
                'wn-fas wn-fa-frog' => 'frog',
                'wn-fas wn-fa-frown' => 'frown',
                'wn-fas wn-fa-futbol' => 'futbol',
                'wn-fas wn-fa-gamepad' => 'gamepad',
                'wn-fas wn-fa-gas-pump' => 'gas-pump',
                'wn-fas wn-fa-gavel' => 'gavel',
                'wn-fas wn-fa-gem' => 'gem',
                'wn-fas wn-fa-genderless' => 'genderless',
                'wn-fas wn-fa-gift' => 'gift',
                'wn-fas wn-fa-glass-martini' => 'glass-martini',
                'wn-fas wn-fa-glasses' => 'glasses',
                'wn-fas wn-fa-globe' => 'globe',
                'wn-fas wn-fa-golf-ball' => 'golf-ball',
                'wn-fas wn-fa-graduation-cap' => 'graduation-cap',
                'wn-fas wn-fa-greater-than' => 'greater-than',
                'wn-fas wn-fa-greater-than-equal' => 'greater-than-equal',
                'wn-fas wn-fa-h-square' => 'h-square',
                'wn-fas wn-fa-hand-holding' => 'hand-holding',
                'wn-fas wn-fa-hand-holding-heart' => 'hand-holding-heart',
                'wn-fas wn-fa-hand-holding-usd' => 'hand-holding-usd',
                'wn-fas wn-fa-hand-lizard' => 'hand-lizard',
                'wn-fas wn-fa-hand-paper' => 'hand-paper',
                'wn-fas wn-fa-hand-peace' => 'hand-peace',
                'wn-fas wn-fa-hand-point-down' => 'hand-point-down',
                'wn-fas wn-fa-hand-point-left' => 'hand-point-left',
                'wn-fas wn-fa-hand-point-right' => 'hand-point-right',
                'wn-fas wn-fa-hand-point-up' => 'hand-point-up',
                'wn-fas wn-fa-hand-pointer' => 'hand-pointer',
                'wn-fas wn-fa-hand-rock' => 'hand-rock',
                'wn-fas wn-fa-hand-scissors' => 'hand-scissors',
                'wn-fas wn-fa-hand-spock' => 'hand-spock',
                'wn-fas wn-fa-hands' => 'hands',
                'wn-fas wn-fa-hands-helping' => 'hands-helping',
                'wn-fas wn-fa-handshake' => 'handshake',
                'wn-fas wn-fa-hashtag' => 'hashtag',
                'wn-fas wn-fa-hdd' => 'hdd',
                'wn-fas wn-fa-heading' => 'heading',
                'wn-fas wn-fa-headphones' => 'headphones',
                'wn-fas wn-fa-heart' => 'heart',
                'wn-fas wn-fa-heartbeat' => 'heartbeat',
                'wn-fas wn-fa-helicopter' => 'helicopter',
                'wn-fas wn-fa-history' => 'history',
                'wn-fas wn-fa-hockey-puck' => 'hockey-puck',
                'wn-fas wn-fa-home' => 'home',
                'wn-fas wn-fa-hospital' => 'hospital',
                'wn-fas wn-fa-hospital-alt' => 'hospital-alt',
                'wn-fas wn-fa-hospital-symbol' => 'hospital-symbol',
                'wn-fas wn-fa-hourglass' => 'hourglass',
                'wn-fas wn-fa-hourglass-end' => 'hourglass-end',
                'wn-fas wn-fa-hourglass-half' => 'hourglass-half',
                'wn-fas wn-fa-hourglass-start' => 'hourglass-start',
                'wn-fas wn-fa-i-cursor' => 'i-cursor',
                'wn-fas wn-fa-id-badge' => 'id-badge',
                'wn-fas wn-fa-id-card' => 'id-card',
                'wn-fas wn-fa-id-card-alt' => 'id-card-alt',
                'wn-fas wn-fa-image' => 'image',
                'wn-fas wn-fa-images' => 'images',
                'wn-fas wn-fa-inbox' => 'inbox',
                'wn-fas wn-fa-indent' => 'indent',
                'wn-fas wn-fa-industry' => 'industry',
                'wn-fas wn-fa-infinity' => 'infinity',
                'wn-fas wn-fa-info' => 'info',
                'wn-fas wn-fa-info-circle' => 'info-circle',
                'wn-fas wn-fa-italic' => 'italic',
                'wn-fas wn-fa-key' => 'key',
                'wn-fas wn-fa-keyboard' => 'keyboard',
                'wn-fas wn-fa-kiwi-bird' => 'kiwi-bird',
                'wn-fas wn-fa-language' => 'language',
                'wn-fas wn-fa-laptop' => 'laptop',
                'wn-fas wn-fa-leaf' => 'leaf',
                'wn-fas wn-fa-lemon' => 'lemon',
                'wn-fas wn-fa-less-than' => 'less-than',
                'wn-fas wn-fa-less-than-equal' => 'less-than-equal',
                'wn-fas wn-fa-level-down-alt' => 'level-down-alt',
                'wn-fas wn-fa-level-up-alt' => 'level-up-alt',
                'wn-fas wn-fa-life-ring' => 'life-ring',
                'wn-fas wn-fa-lightbulb' => 'lightbulb',
                'wn-fas wn-fa-link' => 'link',
                'wn-fas wn-fa-lira-sign' => 'lira-sign',
                'wn-fas wn-fa-list' => 'list',
                'wn-fas wn-fa-list-alt' => 'list-alt',
                'wn-fas wn-fa-list-ol' => 'list-ol',
                'wn-fas wn-fa-list-ul' => 'list-ul',
                'wn-fas wn-fa-location-arrow' => 'location-arrow',
                'wn-fas wn-fa-lock' => 'lock',
                'wn-fas wn-fa-lock-open' => 'lock-open',
                'wn-fas wn-fa-long-arrow-alt-down' => 'long-arrow-alt-down',
                'wn-fas wn-fa-long-arrow-alt-left' => 'long-arrow-alt-left',
                'wn-fas wn-fa-long-arrow-alt-right' => 'long-arrow-alt-right',
                'wn-fas wn-fa-long-arrow-alt-up' => 'long-arrow-alt-up',
                'wn-fas wn-fa-low-vision' => 'low-vision',
                'wn-fas wn-fa-magic' => 'magic',
                'wn-fas wn-fa-magnet' => 'magnet',
                'wn-fas wn-fa-male' => 'male',
                'wn-fas wn-fa-map' => 'map',
                'wn-fas wn-fa-map-marker' => 'map-marker',
                'wn-fas wn-fa-map-marker-alt' => 'map-marker-alt',
                'wn-fas wn-fa-map-pin' => 'map-pin',
                'wn-fas wn-fa-map-signs' => 'map-signs',
                'wn-fas wn-fa-mars' => 'mars',
                'wn-fas wn-fa-mars-double' => 'mars-double',
                'wn-fas wn-fa-mars-stroke' => 'mars-stroke',
                'wn-fas wn-fa-mars-stroke-h' => 'mars-stroke-h',
                'wn-fas wn-fa-mars-stroke-v' => 'mars-stroke-v',
                'wn-fas wn-fa-medkit' => 'medkit',
                'wn-fas wn-fa-meh' => 'meh',
                'wn-fas wn-fa-memory' => 'memory',
                'wn-fas wn-fa-mercury' => 'mercury',
                'wn-fas wn-fa-microchip' => 'microchip',
                'wn-fas wn-fa-microphone' => 'microphone',
                'wn-fas wn-fa-microphone-alt' => 'microphone-alt',
                'wn-fas wn-fa-microphone-alt-slash' => 'microphone-alt-slash',
                'wn-fas wn-fa-microphone-slash' => 'microphone-slash',
                'wn-fas wn-fa-minus' => 'minus',
                'wn-fas wn-fa-minus-circle' => 'minus-circle',
                'wn-fas wn-fa-minus-square' => 'minus-square',
                'wn-fas wn-fa-mobile' => 'mobile',
                'wn-fas wn-fa-mobile-alt' => 'mobile-alt',
                'wn-fas wn-fa-money-bill' => 'money-bill',
                'wn-fas wn-fa-money-bill-alt' => 'money-bill-alt',
                'wn-fas wn-fa-money-bill-wave' => 'money-bill-wave',
                'wn-fas wn-fa-money-bill-wave-alt' => 'money-bill-wave-alt',
                'wn-fas wn-fa-money-check' => 'money-check',
                'wn-fas wn-fa-money-check-alt' => 'money-check-alt',
                'wn-fas wn-fa-moon' => 'moon',
                'wn-fas wn-fa-motorcycle' => 'motorcycle',
                'wn-fas wn-fa-mouse-pointer' => 'mouse-pointer',
                'wn-fas wn-fa-music' => 'music',
                'wn-fas wn-fa-neuter' => 'neuter',
                'wn-fas wn-fa-newspaper' => 'newspaper',
                'wn-fas wn-fa-not-equal' => 'not-equal',
                'wn-fas wn-fa-notes-medical' => 'notes-medical',
                'wn-fas wn-fa-object-group' => 'object-group',
                'wn-fas wn-fa-object-ungroup' => 'object-ungroup',
                'wn-fas wn-fa-outdent' => 'outdent',
                'wn-fas wn-fa-paint-brush' => 'paint-brush',
                'wn-fas wn-fa-palette' => 'palette',
                'wn-fas wn-fa-pallet' => 'pallet',
                'wn-fas wn-fa-paper-plane' => 'paper-plane',
                'wn-fas wn-fa-paperclip' => 'paperclip',
                'wn-fas wn-fa-parachute-box' => 'parachute-box',
                'wn-fas wn-fa-paragraph' => 'paragraph',
                'wn-fas wn-fa-parking' => 'parking',
                'wn-fas wn-fa-paste' => 'paste',
                'wn-fas wn-fa-pause' => 'pause',
                'wn-fas wn-fa-pause-circle' => 'pause-circle',
                'wn-fas wn-fa-paw' => 'paw',
                'wn-fas wn-fa-pen-square' => 'pen-square',
                'wn-fas wn-fa-pencil-alt' => 'pencil-alt',
                'wn-fas wn-fa-people-carry' => 'people-carry',
                'wn-fas wn-fa-percent' => 'percent',
                'wn-fas wn-fa-percentage' => 'percentage',
                'wn-fas wn-fa-phone' => 'phone',
                'wn-fas wn-fa-phone-slash' => 'phone-slash',
                'wn-fas wn-fa-phone-square' => 'phone-square',
                'wn-fas wn-fa-phone-volume' => 'phone-volume',
                'wn-fas wn-fa-piggy-bank' => 'piggy-bank',
                'wn-fas wn-fa-pills' => 'pills',
                'wn-fas wn-fa-plane' => 'plane',
                'wn-fas wn-fa-play' => 'play',
                'wn-fas wn-fa-play-circle' => 'play-circle',
                'wn-fas wn-fa-plug' => 'plug',
                'wn-fas wn-fa-plus' => 'plus',
                'wn-fas wn-fa-plus-circle' => 'plus-circle',
                'wn-fas wn-fa-plus-square' => 'plus-square',
                'wn-fas wn-fa-podcast' => 'podcast',
                'wn-fas wn-fa-poo' => 'poo',
                'wn-fas wn-fa-portrait' => 'portrait',
                'wn-fas wn-fa-pound-sign' => 'pound-sign',
                'wn-fas wn-fa-power-off' => 'power-off',
                'wn-fas wn-fa-prescription-bottle' => 'prescription-bottle',
                'wn-fas wn-fa-prescription-bottle-alt' => 'prescription-bottle-alt',
                'wn-fas wn-fa-print' => 'print',
                'wn-fas wn-fa-procedures' => 'procedures',
                'wn-fas wn-fa-project-diagram' => 'project-diagram',
                'wn-fas wn-fa-puzzle-piece' => 'puzzle-piece',
                'wn-fas wn-fa-qrcode' => 'qrcode',
                'wn-fas wn-fa-question' => 'question',
                'wn-fas wn-fa-question-circle' => 'question-circle',
                'wn-fas wn-fa-quidditch' => 'quidditch',
                'wn-fas wn-fa-quote-left' => 'quote-left',
                'wn-fas wn-fa-quote-right' => 'quote-right',
                'wn-fas wn-fa-random' => 'random',
                'wn-fas wn-fa-receipt' => 'receipt',
                'wn-fas wn-fa-recycle' => 'recycle',
                'wn-fas wn-fa-redo' => 'redo',
                'wn-fas wn-fa-redo-alt' => 'redo-alt',
                'wn-fas wn-fa-registered' => 'registered',
                'wn-fas wn-fa-reply' => 'reply',
                'wn-fas wn-fa-reply-all' => 'reply-all',
                'wn-fas wn-fa-retweet' => 'retweet',
                'wn-fas wn-fa-ribbon' => 'ribbon',
                'wn-fas wn-fa-road' => 'road',
                'wn-fas wn-fa-robot' => 'robot',
                'wn-fas wn-fa-rocket' => 'rocket',
                'wn-fas wn-fa-rss' => 'rss',
                'wn-fas wn-fa-rss-square' => 'rss-square',
                'wn-fas wn-fa-ruble-sign' => 'ruble-sign',
                'wn-fas wn-fa-ruler' => 'ruler',
                'wn-fas wn-fa-ruler-combined' => 'ruler-combined',
                'wn-fas wn-fa-ruler-horizontal' => 'ruler-horizontal',
                'wn-fas wn-fa-ruler-vertical' => 'ruler-vertical',
                'wn-fas wn-fa-rupee-sign' => 'rupee-sign',
                'wn-fas wn-fa-save' => 'save',
                'wn-fas wn-fa-school' => 'school',
                'wn-fas wn-fa-screwdriver' => 'screwdriver',
                'wn-fas wn-fa-search' => 'search',
                'wn-fas wn-fa-search-minus' => 'search-minus',
                'wn-fas wn-fa-search-plus' => 'search-plus',
                'wn-fas wn-fa-seedling' => 'seedling',
                'wn-fas wn-fa-server' => 'server',
                'wn-fas wn-fa-share' => 'share',
                'wn-fas wn-fa-share-alt' => 'share-alt',
                'wn-fas wn-fa-share-alt-square' => 'share-alt-square',
                'wn-fas wn-fa-share-square' => 'share-square',
                'wn-fas wn-fa-shekel-sign' => 'shekel-sign',
                'wn-fas wn-fa-shield-alt' => 'shield-alt',
                'wn-fas wn-fa-ship' => 'ship',
                'wn-fas wn-fa-shipping-fast' => 'shipping-fast',
                'wn-fas wn-fa-shoe-prints' => 'shoe-prints',
                'wn-fas wn-fa-shopping-bag' => 'shopping-bag',
                'wn-fas wn-fa-shopping-basket' => 'shopping-basket',
                'wn-fas wn-fa-shopping-cart' => 'shopping-cart',
                'wn-fas wn-fa-shower' => 'shower',
                'wn-fas wn-fa-sign' => 'sign',
                'wn-fas wn-fa-sign-in-alt' => 'sign-in-alt',
                'wn-fas wn-fa-sign-language' => 'sign-language',
                'wn-fas wn-fa-sign-out-alt' => 'sign-out-alt',
                'wn-fas wn-fa-signal' => 'signal',
                'wn-fas wn-fa-sitemap' => 'sitemap',
                'wn-fas wn-fa-skull' => 'skull',
                'wn-fas wn-fa-sliders-h' => 'sliders-h',
                'wn-fas wn-fa-smile' => 'smile',
                'wn-fas wn-fa-smoking' => 'smoking',
                'wn-fas wn-fa-smoking-ban' => 'smoking-ban',
                'wn-fas wn-fa-snowflake' => 'snowflake',
                'wn-fas wn-fa-sort' => 'sort',
                'wn-fas wn-fa-sort-alpha-down' => 'sort-alpha-down',
                'wn-fas wn-fa-sort-alpha-up' => 'sort-alpha-up',
                'wn-fas wn-fa-sort-amount-down' => 'sort-amount-down',
                'wn-fas wn-fa-sort-amount-up' => 'sort-amount-up',
                'wn-fas wn-fa-sort-down' => 'sort-down',
                'wn-fas wn-fa-sort-numeric-down' => 'sort-numeric-down',
                'wn-fas wn-fa-sort-numeric-up' => 'sort-numeric-up',
                'wn-fas wn-fa-sort-up' => 'sort-up',
                'wn-fas wn-fa-space-shuttle' => 'space-shuttle',
                'wn-fas wn-fa-spinner' => 'spinner',
                'wn-fas wn-fa-square' => 'square',
                'wn-fas wn-fa-square-full' => 'square-full',
                'wn-fas wn-fa-star' => 'star',
                'wn-fas wn-fa-star-half' => 'star-half',
                'wn-fas wn-fa-step-backward' => 'step-backward',
                'wn-fas wn-fa-step-forward' => 'step-forward',
                'wn-fas wn-fa-stethoscope' => 'stethoscope',
                'wn-fas wn-fa-sticky-note' => 'sticky-note',
                'wn-fas wn-fa-stop' => 'stop',
                'wn-fas wn-fa-stop-circle' => 'stop-circle',
                'wn-fas wn-fa-stopwatch' => 'stopwatch',
                'wn-fas wn-fa-store' => 'store',
                'wn-fas wn-fa-store-alt' => 'store-alt',
                'wn-fas wn-fa-stream' => 'stream',
                'wn-fas wn-fa-street-view' => 'street-view',
                'wn-fas wn-fa-strikethrough' => 'strikethrough',
                'wn-fas wn-fa-stroopwafel' => 'stroopwafel',
                'wn-fas wn-fa-subscript' => 'subscript',
                'wn-fas wn-fa-subway' => 'subway',
                'wn-fas wn-fa-suitcase' => 'suitcase',
                'wn-fas wn-fa-sun' => 'sun',
                'wn-fas wn-fa-superscript' => 'superscript',
                'wn-fas wn-fa-sync' => 'sync',
                'wn-fas wn-fa-sync-alt' => 'sync-alt',
                'wn-fas wn-fa-syringe' => 'syringe',
                'wn-fas wn-fa-table' => 'table',
                'wn-fas wn-fa-table-tennis' => 'table-tennis',
                'wn-fas wn-fa-tablet' => 'tablet',
                'wn-fas wn-fa-tablet-alt' => 'tablet-alt',
                'wn-fas wn-fa-tablets' => 'tablets',
                'wn-fas wn-fa-tachometer-alt' => 'tachometer-alt',
                'wn-fas wn-fa-tag' => 'tag',
                'wn-fas wn-fa-tags' => 'tags',
                'wn-fas wn-fa-tape' => 'tape',
                'wn-fas wn-fa-tasks' => 'tasks',
                'wn-fas wn-fa-taxi' => 'taxi',
                'wn-fas wn-fa-terminal' => 'terminal',
                'wn-fas wn-fa-text-height' => 'text-height',
                'wn-fas wn-fa-text-width' => 'text-width',
                'wn-fas wn-fa-th' => 'th',
                'wn-fas wn-fa-th-large' => 'th-large',
                'wn-fas wn-fa-th-list' => 'th-list',
                'wn-fas wn-fa-thermometer' => 'thermometer',
                'wn-fas wn-fa-thermometer-empty' => 'thermometer-empty',
                'wn-fas wn-fa-thermometer-full' => 'thermometer-full',
                'wn-fas wn-fa-thermometer-half' => 'thermometer-half',
                'wn-fas wn-fa-thermometer-quarter' => 'thermometer-quarter',
                'wn-fas wn-fa-thermometer-three-quarters' => 'thermometer-three-quarters',
                'wn-fas wn-fa-thumbs-down' => 'thumbs-down',
                'wn-fas wn-fa-thumbs-up' => 'thumbs-up',
                'wn-fas wn-fa-thumbtack' => 'thumbtack',
                'wn-fas wn-fa-ticket-alt' => 'ticket-alt',
                'wn-fas wn-fa-times' => 'times',
                'wn-fas wn-fa-times-circle' => 'times-circle',
                'wn-fas wn-fa-tint' => 'tint',
                'wn-fas wn-fa-toggle-off' => 'toggle-off',
                'wn-fas wn-fa-toggle-on' => 'toggle-on',
                'wn-fas wn-fa-toolbox' => 'toolbox',
                'wn-fas wn-fa-trademark' => 'trademark',
                'wn-fas wn-fa-train' => 'train',
                'wn-fas wn-fa-transgender' => 'transgender',
                'wn-fas wn-fa-transgender-alt' => 'transgender-alt',
                'wn-fas wn-fa-trash' => 'trash',
                'wn-fas wn-fa-trash-alt' => 'trash-alt',
                'wn-fas wn-fa-tree' => 'tree',
                'wn-fas wn-fa-trophy' => 'trophy',
                'wn-fas wn-fa-truck' => 'truck',
                'wn-fas wn-fa-truck-loading' => 'truck-loading',
                'wn-fas wn-fa-truck-moving' => 'truck-moving',
                'wn-fas wn-fa-tshirt' => 'tshirt',
                'wn-fas wn-fa-tty' => 'tty',
                'wn-fas wn-fa-tv' => 'tv',
                'wn-fas wn-fa-umbrella' => 'umbrella',
                'wn-fas wn-fa-underline' => 'underline',
                'wn-fas wn-fa-undo' => 'undo',
                'wn-fas wn-fa-undo-alt' => 'undo-alt',
                'wn-fas wn-fa-universal-access' => 'universal-access',
                'wn-fas wn-fa-university' => 'university',
                'wn-fas wn-fa-unlink' => 'unlink',
                'wn-fas wn-fa-unlock' => 'unlock',
                'wn-fas wn-fa-unlock-alt' => 'unlock-alt',
                'wn-fas wn-fa-upload' => 'upload',
                'wn-fas wn-fa-user' => 'user',
                'wn-fas wn-fa-user-alt' => 'user-alt',
                'wn-fas wn-fa-user-alt-slash' => 'user-alt-slash',
                'wn-fas wn-fa-user-astronaut' => 'user-astronaut',
                'wn-fas wn-fa-user-check' => 'user-check',
                'wn-fas wn-fa-user-circle' => 'user-circle',
                'wn-fas wn-fa-user-clock' => 'user-clock',
                'wn-fas wn-fa-user-cog' => 'user-cog',
                'wn-fas wn-fa-user-edit' => 'user-edit',
                'wn-fas wn-fa-user-friends' => 'user-friends',
                'wn-fas wn-fa-user-graduate' => 'user-graduate',
                'wn-fas wn-fa-user-lock' => 'user-lock',
                'wn-fas wn-fa-user-md' => 'user-md',
                'wn-fas wn-fa-user-minus' => 'user-minus',
                'wn-fas wn-fa-user-ninja' => 'user-ninja',
                'wn-fas wn-fa-user-plus' => 'user-plus',
                'wn-fas wn-fa-user-secret' => 'user-secret',
                'wn-fas wn-fa-user-shield' => 'user-shield',
                'wn-fas wn-fa-user-slash' => 'user-slash',
                'wn-fas wn-fa-user-tag' => 'user-tag',
                'wn-fas wn-fa-user-tie' => 'user-tie',
                'wn-fas wn-fa-user-times' => 'user-times',
                'wn-fas wn-fa-users' => 'users',
                'wn-fas wn-fa-users-cog' => 'users-cog',
                'wn-fas wn-fa-utensil-spoon' => 'utensil-spoon',
                'wn-fas wn-fa-utensils' => 'utensils',
                'wn-fas wn-fa-venus' => 'venus',
                'wn-fas wn-fa-venus-double' => 'venus-double',
                'wn-fas wn-fa-venus-mars' => 'venus-mars',
                'wn-fas wn-fa-vial' => 'vial',
                'wn-fas wn-fa-vials' => 'vials',
                'wn-fas wn-fa-video' => 'video',
                'wn-fas wn-fa-video-slash' => 'video-slash',
                'wn-fas wn-fa-volleyball-ball' => 'volleyball-ball',
                'wn-fas wn-fa-volume-down' => 'volume-down',
                'wn-fas wn-fa-volume-off' => 'volume-off',
                'wn-fas wn-fa-volume-up' => 'volume-up',
                'wn-fas wn-fa-walking' => 'walking',
                'wn-fas wn-fa-wallet' => 'wallet',
                'wn-fas wn-fa-warehouse' => 'warehouse',
                'wn-fas wn-fa-weight' => 'weight',
                'wn-fas wn-fa-wheelchair' => 'wheelchair',
                'wn-fas wn-fa-wifi' => 'wifi',
                'wn-fas wn-fa-window-close' => 'window-close',
                'wn-fas wn-fa-window-maximize' => 'window-maximize',
                'wn-fas wn-fa-window-minimize' => 'window-minimize',
                'wn-fas wn-fa-window-restore' => 'window-restore',
                'wn-fas wn-fa-wine-glass' => 'wine-glass',
                'wn-fas wn-fa-won-sign' => 'won-sign',
                'wn-fas wn-fa-wrench' => 'wrench',
                'wn-fas wn-fa-x-ray' => 'x-ray',
                'wn-fas wn-fa-yen-sign' => 'yen-sign',
                'wn-far wn-fa-address-book' => 'address-book',
                'wn-far wn-fa-address-card' => 'address-card',
                'wn-far wn-fa-arrow-alt-circle-down' => 'arrow-alt-circle-down',
                'wn-far wn-fa-arrow-alt-circle-left' => 'arrow-alt-circle-left',
                'wn-far wn-fa-arrow-alt-circle-right' => 'arrow-alt-circle-right',
                'wn-far wn-fa-arrow-alt-circle-up' => 'arrow-alt-circle-up',
                'wn-far wn-fa-bell' => 'bell',
                'wn-far wn-fa-bell-slash' => 'bell-slash',
                'wn-far wn-fa-bookmark' => 'bookmark',
                'wn-far wn-fa-building' => 'building',
                'wn-far wn-fa-calendar' => 'calendar',
                'wn-far wn-fa-calendar-alt' => 'calendar-alt',
                'wn-far wn-fa-calendar-check' => 'calendar-check',
                'wn-far wn-fa-calendar-minus' => 'calendar-minus',
                'wn-far wn-fa-calendar-plus' => 'calendar-plus',
                'wn-far wn-fa-calendar-times' => 'calendar-times',
                'wn-far wn-fa-caret-square-down' => 'caret-square-down',
                'wn-far wn-fa-caret-square-left' => 'caret-square-left',
                'wn-far wn-fa-caret-square-right' => 'caret-square-right',
                'wn-far wn-fa-caret-square-up' => 'caret-square-up',
                'wn-far wn-fa-chart-bar' => 'chart-bar',
                'wn-far wn-fa-check-circle' => 'check-circle',
                'wn-far wn-fa-check-square' => 'check-square',
                'wn-far wn-fa-circle' => 'circle',
                'wn-far wn-fa-clipboard' => 'clipboard',
                'wn-far wn-fa-clock' => 'clock',
                'wn-far wn-fa-clone' => 'clone',
                'wn-far wn-fa-closed-captioning' => 'closed-captioning',
                'wn-far wn-fa-comment' => 'comment',
                'wn-far wn-fa-comment-alt' => 'comment-alt',
                'wn-far wn-fa-comment-dots' => 'comment-dots',
                'wn-far wn-fa-comments' => 'comments',
                'wn-far wn-fa-compass' => 'compass',
                'wn-far wn-fa-copy' => 'copy',
                'wn-far wn-fa-copyright' => 'copyright',
                'wn-far wn-fa-credit-card' => 'credit-card',
                'wn-far wn-fa-dot-circle' => 'dot-circle',
                'wn-far wn-fa-edit' => 'edit',
                'wn-far wn-fa-envelope' => 'envelope',
                'wn-far wn-fa-envelope-open' => 'envelope-open',
                'wn-far wn-fa-eye' => 'eye',
                'wn-far wn-fa-eye-slash' => 'eye-slash',
                'wn-far wn-fa-file' => 'file',
                'wn-far wn-fa-file-alt' => 'file-alt',
                'wn-far wn-fa-file-archive' => 'file-archive',
                'wn-far wn-fa-file-audio' => 'file-audio',
                'wn-far wn-fa-file-code' => 'file-code',
                'wn-far wn-fa-file-excel' => 'file-excel',
                'wn-far wn-fa-file-image' => 'file-image',
                'wn-far wn-fa-file-pdf' => 'file-pdf',
                'wn-far wn-fa-file-powerpoint' => 'file-powerpoint',
                'wn-far wn-fa-file-video' => 'file-video',
                'wn-far wn-fa-file-word' => 'file-word',
                'wn-far wn-fa-flag' => 'flag',
                'wn-far wn-fa-folder' => 'folder',
                'wn-far wn-fa-folder-open' => 'folder-open',
                'wn-far wn-fa-frown' => 'frown',
                'wn-far wn-fa-futbol' => 'futbol',
                'wn-far wn-fa-gem' => 'gem',
                'wn-far wn-fa-hand-lizard' => 'hand-lizard',
                'wn-far wn-fa-hand-paper' => 'hand-paper',
                'wn-far wn-fa-hand-peace' => 'hand-peace',
                'wn-far wn-fa-hand-point-down' => 'hand-point-down',
                'wn-far wn-fa-hand-point-left' => 'hand-point-left',
                'wn-far wn-fa-hand-point-right' => 'hand-point-right',
                'wn-far wn-fa-hand-point-up' => 'hand-point-up',
                'wn-far wn-fa-hand-pointer' => 'hand-pointer',
                'wn-far wn-fa-hand-rock' => 'hand-rock',
                'wn-far wn-fa-hand-scissors' => 'hand-scissors',
                'wn-far wn-fa-hand-spock' => 'hand-spock',
                'wn-far wn-fa-handshake' => 'handshake',
                'wn-far wn-fa-hdd' => 'hdd',
                'wn-far wn-fa-heart' => 'heart',
                'wn-far wn-fa-hospital' => 'hospital',
                'wn-far wn-fa-hourglass' => 'hourglass',
                'wn-far wn-fa-id-badge' => 'id-badge',
                'wn-far wn-fa-id-card' => 'id-card',
                'wn-far wn-fa-image' => 'image',
                'wn-far wn-fa-images' => 'images',
                'wn-far wn-fa-keyboard' => 'keyboard',
                'wn-far wn-fa-lemon' => 'lemon',
                'wn-far wn-fa-life-ring' => 'life-ring',
                'wn-far wn-fa-lightbulb' => 'lightbulb',
                'wn-far wn-fa-list-alt' => 'list-alt',
                'wn-far wn-fa-map' => 'map',
                'wn-far wn-fa-meh' => 'meh',
                'wn-far wn-fa-minus-square' => 'minus-square',
                'wn-far wn-fa-money-bill-alt' => 'money-bill-alt',
                'wn-far wn-fa-moon' => 'moon',
                'wn-far wn-fa-newspaper' => 'newspaper',
                'wn-far wn-fa-object-group' => 'object-group',
                'wn-far wn-fa-object-ungroup' => 'object-ungroup',
                'wn-far wn-fa-paper-plane' => 'paper-plane',
                'wn-far wn-fa-pause-circle' => 'pause-circle',
                'wn-far wn-fa-play-circle' => 'play-circle',
                'wn-far wn-fa-plus-square' => 'plus-square',
                'wn-far wn-fa-question-circle' => 'question-circle',
                'wn-far wn-fa-registered' => 'registered',
                'wn-far wn-fa-save' => 'save',
                'wn-far wn-fa-share-square' => 'share-square',
                'wn-far wn-fa-smile' => 'smile',
                'wn-far wn-fa-snowflake' => 'snowflake',
                'wn-far wn-fa-square' => 'square',
                'wn-far wn-fa-star' => 'star',
                'wn-far wn-fa-star-half' => 'star-half',
                'wn-far wn-fa-sticky-note' => 'sticky-note',
                'wn-far wn-fa-stop-circle' => 'stop-circle',
                'wn-far wn-fa-sun' => 'sun',
                'wn-far wn-fa-thumbs-down' => 'thumbs-down',
                'wn-far wn-fa-thumbs-up' => 'thumbs-up',
                'wn-far wn-fa-times-circle' => 'times-circle',
                'wn-far wn-fa-trash-alt' => 'trash-alt',
                'wn-far wn-fa-user' => 'user',
                'wn-far wn-fa-user-circle' => 'user-circle',
                'wn-far wn-fa-window-close' => 'window-close',
                'wn-far wn-fa-window-maximize' => 'window-maximize',
                'wn-far wn-fa-window-minimize' => 'window-minimize',
                'wn-far wn-fa-window-restore' => 'window-restore',
                'li_heart' => 'heart',
                'li_cloud' => 'cloud',
                'li_star' => 'star',
                'li_tv' => 'tv',
                'li_sound' => 'sound',
                'li_video' => 'video',
                'li_trash' => 'trash',
                'li_user' => 'user',
                'li_key' => 'key',
                'li_search' => 'search',
                'li_settings' => 'settings',
                'li_camera' => 'camera',
                'li_tag' => 'tag',
                'li_lock' => 'lock',
                'li_bulb' => 'bulb',
                'li_pen' => 'pen',
                'li_diamond' => 'diamond',
                'li_display' => 'display',
                'li_location' => 'location',
                'li_eye' => 'eye',
                'li_bubble' => 'bubble',
                'li_stack' => 'stack',
                'li_cup' => 'cup',
                'li_phone' => 'phone',
                'li_news' => 'news',
                'li_mail' => 'mail',
                'li_like' => 'like',
                'li_photo' => 'photo',
                'li_note' => 'note',
                'li_clock' => 'clock',
                'li_paperplane' => 'paperplane',
                'li_params' => 'params',
                'li_banknote' => 'banknote',
                'li_data' => 'data',
                'li_music' => 'music',
                'li_megaphone' => 'megaphone',
                'li_study' => 'study',
                'li_lab' => 'lab',
                'li_food' => 'food',
                'li_t-shirt' => 't-shirt',
                'li_fire' => 'fire',
                'li_clip' => 'clip',
                'li_shop' => 'shop',
                'li_calendar' => 'calendar',
                'li_vallet' => 'vallet',
                'li_vynil' => 'vynil',
                'li_truck' => 'truck',
                'li_world' => 'world',
                'sl-user' => 'user',
                'sl-people' => 'people',
                'sl-user-female' => 'user-female',
                'sl-user-follow' => 'user-follow',
                'sl-user-following' => 'user-following',
                'sl-user-unfollow' => 'user-unfollow',
                'sl-login' => 'login',
                'sl-logout' => 'logout',
                'sl-emotsmile' => 'emotsmile',
                'sl-phone' => 'phone',
                'sl-call-end' => 'call-end',
                'sl-call-in' => 'call-in',
                'sl-call-out' => 'call-out',
                'sl-map' => 'map',
                'sl-location-pin' => 'location-pin',
                'sl-direction' => 'direction',
                'sl-directions' => 'directions',
                'sl-compass' => 'compass',
                'sl-layers' => 'layers',
                'sl-menu' => 'menu',
                'sl-list' => 'list',
                'sl-options-vertical' => 'options-vertical',
                'sl-options' => 'options',
                'sl-arrow-down' => 'arrow-down',
                'sl-arrow-left' => 'arrow-left',
                'sl-arrow-right' => 'arrow-right',
                'sl-arrow-up' => 'arrow-up',
                'sl-arrow-up-circle' => 'arrow-up-circle',
                'sl-arrow-left-circle' => 'arrow-left-circle',
                'sl-arrow-right-circle' => 'arrow-right-circle',
                'sl-arrow-down-circle' => 'arrow-down-circle',
                'sl-check' => 'check',
                'sl-clock' => 'clock',
                'sl-plus' => 'plus',
                'sl-close' => 'close',
                'sl-trophy' => 'trophy',
                'sl-screen-smartphone' => 'screen-smartphone',
                'sl-screen-desktop' => 'screen-desktop',
                'sl-plane' => 'plane',
                'sl-notebook' => 'notebook',
                'sl-mustache' => 'mustache',
                'sl-mouse' => 'mouse',
                'sl-magnet' => 'magnet',
                'sl-energy' => 'energy',
                'sl-disc' => 'disc',
                'sl-cursor' => 'cursor',
                'sl-cursor-move' => 'cursor-move',
                'sl-crop' => 'crop',
                'sl-chemistry' => 'chemistry',
                'sl-speedometer' => 'speedometer',
                'sl-shield' => 'shield',
                'sl-screen-tablet' => 'screen-tablet',
                'sl-magic-wand' => 'magic-wand',
                'sl-hourglass' => 'hourglass',
                'sl-graduation' => 'graduation',
                'sl-ghost' => 'ghost',
                'sl-game-controller' => 'game-controller',
                'sl-fire' => 'fire',
                'sl-eyeglass' => 'eyeglass',
                'sl-envelope-open' => 'envelope-open',
                'sl-envelope-letter' => 'envelope-letter',
                'sl-bell' => 'bell',
                'sl-badge' => 'badge',
                'sl-anchor' => 'anchor',
                'sl-wallet' => 'wallet',
                'sl-vector' => 'vector',
                'sl-speech' => 'speech',
                'sl-puzzle' => 'puzzle',
                'sl-printer' => 'printer',
                'sl-present' => 'present',
                'sl-playlist' => 'playlist',
                'sl-pin' => 'pin',
                'sl-picture' => 'picture',
                'sl-handbag' => 'handbag',
                'sl-globe-alt' => 'globe-alt',
                'sl-globe' => 'globe',
                'sl-folder-alt' => 'folder-alt',
                'sl-folder' => 'folder',
                'sl-film' => 'film',
                'sl-feed' => 'feed',
                'sl-drop' => 'drop',
                'sl-drawer' => 'drawer',
                'sl-minus' => 'minus',
                'sl-event' => 'event',
                'sl-exclamation' => 'exclamation',
                'sl-organization' => 'organization',
                'sl-docs' => 'docs',
                'sl-doc' => 'doc',
                'sl-diamond' => 'diamond',
                'sl-cup' => 'cup',
                'sl-calculator' => 'calculator',
                'sl-bubbles' => 'bubbles',
                'sl-briefcase' => 'briefcase',
                'sl-book-open' => 'book-open',
                'sl-basket-loaded' => 'basket-loaded',
                'sl-basket' => 'basket',
                'sl-bag' => 'bag',
                'sl-action-undo' => 'action-undo',
                'sl-action-redo' => 'action-redo',
                'sl-wrench' => 'wrench',
                'sl-umbrella' => 'umbrella',
                'sl-trash' => 'trash',
                'sl-tag' => 'tag',
                'sl-support' => 'support',
                'sl-frame' => 'frame',
                'sl-size-fullscreen' => 'size-fullscreen',
                'sl-size-actual' => 'size-actual',
                'sl-shuffle' => 'shuffle',
                'sl-share-alt' => 'share-alt',
                'sl-share' => 'share',
                'sl-rocket' => 'rocket',
                'sl-question' => 'question',
                'sl-pie-chart' => 'pie-chart',
                'sl-pencil' => 'pencil',
                'sl-note' => 'note',
                'sl-loop' => 'loop',
                'sl-home' => 'home',
                'sl-grid' => 'grid',
                'sl-graph' => 'graph',
                'sl-microphone' => 'microphone',
                'sl-music-tone-alt' => 'music-tone-alt',
                'sl-music-tone' => 'music-tone',
                'sl-earphones-alt' => 'earphones-alt',
                'sl-earphones' => 'earphones',
                'sl-equalizer' => 'equalizer',
                'sl-like' => 'like',
                'sl-dislike' => 'dislike',
                'sl-control-start' => 'control-start',
                'sl-control-rewind' => 'control-rewind',
                'sl-control-play' => 'control-play',
                'sl-control-pause' => 'control-pause',
                'sl-control-forward' => 'control-forward',
                'sl-control-end' => 'control-end',
                'sl-volume-1' => 'volume-1',
                'sl-volume-2' => 'volume-2',
                'sl-volume-off' => 'volume-off',
                'sl-calendar' => 'calendar',
                'sl-bulb' => 'bulb',
                'sl-chart' => 'chart',
                'sl-ban' => 'ban',
                'sl-bubble' => 'bubble',
                'sl-camrecorder' => 'camrecorder',
                'sl-camera' => 'camera',
                'sl-cloud-download' => 'cloud-download',
                'sl-cloud-upload' => 'cloud-upload',
                'sl-envelope' => 'envelope',
                'sl-eye' => 'eye',
                'sl-flag' => 'flag',
                'sl-heart' => 'heart',
                'sl-info' => 'info',
                'sl-key' => 'key',
                'sl-link' => 'link',
                'sl-lock' => 'lock',
                'sl-lock-open' => 'lock-open',
                'sl-magnifier' => 'magnifier',
                'sl-magnifier-add' => 'magnifier-add',
                'sl-magnifier-remove' => 'magnifier-remove',
                'sl-paper-clip' => 'paper-clip',
                'sl-paper-plane' => 'paper-plane',
                'sl-power' => 'power',
                'sl-refresh' => 'refresh',
                'sl-reload' => 'reload',
                'sl-settings' => 'settings',
                'sl-star' => 'star',
                'sl-symbol-female' => 'symbol-female',
                'sl-symbol-male' => 'symbol-male',
                'sl-target' => 'target',
                'sl-credit-card' => 'credit-card',
                'sl-paypal' => 'paypal',
                'sl-social-tumblr' => 'social-tumblr',
                'sl-social-twitter' => 'social-twitter',
                'sl-social-facebook' => 'social-facebook',
                'sl-social-instagram' => 'social-instagram',
                'sl-social-linkedin' => 'social-linkedin',
                'sl-social-pinterest' => 'social-pinterest',
                'sl-social-github' => 'social-github',
                'sl-social-google' => 'social-google',
                'sl-social-reddit' => 'social-reddit',
                'sl-social-skype' => 'social-skype',
                'sl-social-dribbble' => 'social-dribbble',
                'sl-social-behance' => 'social-behance',
                'sl-social-foursqare' => 'social-foursqare',
                'sl-social-soundcloud' => 'social-soundcloud',
                'sl-social-spotify' => 'social-spotify',
                'sl-social-stumbleupon' => 'social-stumbleupon',
                'sl-social-youtube' => 'social-youtube',
                'sl-social-dropbox' => 'social-dropbox',
                'icon-software-add-vectorpoint' => 'add-vectorpoint',
                'icon-software-box-oval' => 'box-oval',
                'icon-software-box-polygon' => 'box-polygon',
                'icon-software-box-rectangle' => 'box-rectangle',
                'icon-software-box-roundedrectangle' => 'box-roundedrectangle',
                'icon-software-character' => 'character',
                'icon-software-crop' => 'crop',
                'icon-software-eyedropper' => 'eyedropper',
                'icon-software-font-allcaps' => 'font-allcaps',
                'icon-software-font-baseline-shift' => 'font-baseline-shift',
                'icon-software-font-horizontal-scale' => 'font-horizontal-scale',
                'icon-software-font-kerning' => 'font-kerning',
                'icon-software-font-leading' => 'font-leading',
                'icon-software-font-size' => 'font-size',
                'icon-software-font-smallcapital' => 'font-smallcapital',
                'icon-software-font-smallcaps' => 'font-smallcaps',
                'icon-software-font-strikethrough' => 'font-strikethrough',
                'icon-software-font-tracking' => 'font-tracking',
                'icon-software-font-underline' => 'font-underline',
                'icon-software-font-vertical-scale' => 'font-vertical-scale',
                'icon-software-horizontal-align-center' => 'horizontal-align-center',
                'icon-software-horizontal-align-left' => 'horizontal-align-left',
                'icon-software-horizontal-align-right' => 'horizontal-align-right',
                'icon-software-horizontal-distribute-center' => 'horizontal-distribute-center',
                'icon-software-horizontal-distribute-left' => 'horizontal-distribute-left',
                'icon-software-horizontal-distribute-right' => 'horizontal-distribute-right',
                'icon-software-indent-firstline' => 'indent-firstline',
                'icon-software-indent-left' => 'indent-left',
                'icon-software-indent-right' => 'indent-right',
                'icon-software-lasso' => 'lasso',
                'icon-software-layers1' => 'layers1',
                'icon-software-layers2' => 'layers2',
                'icon-software-layout' => 'layout',
                'icon-software-layout-2columns' => 'layout-2columns',
                'icon-software-layout-3columns' => 'layout-3columns',
                'icon-software-layout-4boxes' => 'layout-4boxes',
                'icon-software-layout-4columns' => 'layout-4columns',
                'icon-software-layout-4lines' => 'layout-4lines',
                'icon-software-layout-8boxes' => 'layout-8boxes',
                'icon-software-layout-header' => 'layout-header',
                'icon-software-layout-header-2columns' => 'layout-header-2columns',
                'icon-software-layout-header-3columns' => 'layout-header-3columns',
                'icon-software-layout-header-4boxes' => 'layout-header-4boxes',
                'icon-software-layout-header-4columns' => 'layout-header-4columns',
                'icon-software-layout-header-complex' => 'layout-header-complex',
                'icon-software-layout-header-complex2' => 'layout-header-complex2',
                'icon-software-layout-header-complex3' => 'layout-header-complex3',
                'icon-software-layout-header-complex4' => 'layout-header-complex4',
                'icon-software-layout-header-sideleft' => 'layout-header-sideleft',
                'icon-software-layout-header-sideright' => 'layout-header-sideright',
                'icon-software-layout-sidebar-left' => 'layout-sidebar-left',
                'icon-software-layout-sidebar-right' => 'layout-sidebar-right',
                'icon-software-magnete' => 'magnete',
                'icon-software-pages' => 'pages',
                'icon-software-paintbrush' => 'paintbrush',
                'icon-software-paintbucket' => 'paintbucket',
                'icon-software-paintroller' => 'paintroller',
                'icon-software-paragraph' => 'paragraph',
                'icon-software-paragraph-align-left' => 'paragraph-align-left',
                'icon-software-paragraph-align-right' => 'paragraph-align-right',
                'icon-software-paragraph-center' => 'paragraph-center',
                'icon-software-paragraph-justify-all' => 'paragraph-justify-all',
                'icon-software-paragraph-justify-center' => 'paragraph-justify-center',
                'icon-software-paragraph-justify-left' => 'paragraph-justify-left',
                'icon-software-paragraph-justify-right' => 'paragraph-justify-right',
                'icon-software-paragraph-space-after' => 'paragraph-space-after',
                'icon-software-paragraph-space-before' => 'paragraph-space-before',
                'icon-software-pathfinder-exclude' => 'pathfinder-exclude',
                'icon-software-pathfinder-intersect' => 'pathfinder-intersect',
                'icon-software-pathfinder-subtract' => 'pathfinder-subtract',
                'icon-software-pathfinder-unite' => 'pathfinder-unite',
                'icon-software-pen' => 'pen',
                'icon-software-pen-add' => 'pen-add',
                'icon-software-pen-remove' => 'pen-remove',
                'icon-software-pencil' => 'pencil',
                'icon-software-polygonallasso' => 'polygonallasso',
                'icon-software-reflect-horizontal' => 'reflect-horizontal',
                'icon-software-reflect-vertical' => 'reflect-vertical',
                'icon-software-remove-vectorpoint' => 'remove-vectorpoint',
                'icon-software-scale-expand' => 'scale-expand',
                'icon-software-scale-reduce' => 'scale-reduce',
                'icon-software-selection-oval' => 'selection-oval',
                'icon-software-selection-polygon' => 'selection-polygon',
                'icon-software-selection-rectangle' => 'selection-rectangle',
                'icon-software-selection-roundedrectangle' => 'selection-roundedrectangle',
                'icon-software-shape-oval' => 'shape-oval',
                'icon-software-shape-polygon' => 'shape-polygon',
                'icon-software-shape-rectangle' => 'shape-rectangle',
                'icon-software-shape-roundedrectangle' => 'shape-roundedrectangle',
                'icon-software-slice' => 'slice',
                'icon-software-transform-bezier' => 'transform-bezier',
                'icon-software-vector-box' => 'vector-box',
                'icon-software-vector-composite' => 'vector-composite',
                'icon-software-vector-line' => 'vector-line',
                'icon-software-vertical-align-bottom' => 'vertical-align-bottom',
                'icon-software-vertical-align-center' => 'vertical-align-center',
                'icon-software-vertical-align-top' => 'vertical-align-top',
                'icon-software-vertical-distribute-bottom' => 'vertical-distribute-bottom',
                'icon-software-vertical-distribute-center' => 'vertical-distribute-center',
                'icon-software-vertical-distribute-top' => 'vertical-distribute-top',
                'icon-arrows-anticlockwise' => 'anticlockwise',
                'icon-arrows-anticlockwise-dashed' => 'anticlockwise-dashed',
                'icon-arrows-button-down' => 'button-down',
                'icon-arrows-button-off' => 'button-off',
                'icon-arrows-button-on' => 'button-on',
                'icon-arrows-button-up' => 'button-up',
                'icon-arrows-check' => 'check',
                'icon-arrows-circle-check' => 'circle-check',
                'icon-arrows-circle-down' => 'circle-down',
                'icon-arrows-circle-downleft' => 'circle-downleft',
                'icon-arrows-circle-downright' => 'circle-downright',
                'icon-arrows-circle-left' => 'circle-left',
                'icon-arrows-circle-minus' => 'circle-minus',
                'icon-arrows-circle-plus' => 'circle-plus',
                'icon-arrows-circle-remove' => 'circle-remove',
                'icon-arrows-circle-right' => 'circle-right',
                'icon-arrows-circle-up' => 'circle-up',
                'icon-arrows-circle-upleft' => 'circle-upleft',
                'icon-arrows-circle-upright' => 'circle-upright',
                'icon-arrows-clockwise' => 'clockwise',
                'icon-arrows-clockwise-dashed' => 'clockwise-dashed',
                'icon-arrows-compress' => 'compress',
                'icon-arrows-deny' => 'deny',
                'icon-arrows-diagonal' => 'diagonal',
                'icon-arrows-diagonal2' => 'diagonal2',
                'icon-arrows-down' => 'down',
                'icon-arrows-down-double' => 'down-double',
                'icon-arrows-downleft' => 'downleft',
                'icon-arrows-downright' => 'downright',
                'icon-arrows-drag-down' => 'drag-down',
                'icon-arrows-drag-down-dashed' => 'drag-down-dashed',
                'icon-arrows-drag-horiz' => 'drag-horiz',
                'icon-arrows-drag-left' => 'drag-left',
                'icon-arrows-drag-left-dashed' => 'drag-left-dashed',
                'icon-arrows-drag-right' => 'drag-right',
                'icon-arrows-drag-right-dashed' => 'drag-right-dashed',
                'icon-arrows-drag-up' => 'drag-up',
                'icon-arrows-drag-up-dashed' => 'drag-up-dashed',
                'icon-arrows-drag-vert' => 'drag-vert',
                'icon-arrows-exclamation' => 'exclamation',
                'icon-arrows-expand' => 'expand',
                'icon-arrows-expand-diagonal1' => 'expand-diagonal1',
                'icon-arrows-expand-horizontal1' => 'expand-horizontal1',
                'icon-arrows-expand-vertical1' => 'expand-vertical1',
                'icon-arrows-fit-horizontal' => 'fit-horizontal',
                'icon-arrows-fit-vertical' => 'fit-vertical',
                'icon-arrows-glide' => 'glide',
                'icon-arrows-glide-horizontal' => 'glide-horizontal',
                'icon-arrows-glide-vertical' => 'glide-vertical',
                'icon-arrows-hamburger1' => 'hamburger1',
                'icon-arrows-hamburger-2' => 'hamburger-2',
                'icon-arrows-horizontal' => 'horizontal',
                'icon-arrows-info' => 'info',
                'icon-arrows-keyboard-alt' => 'keyboard-alt',
                'icon-arrows-keyboard-cmd' => 'keyboard-cmd',
                'icon-arrows-keyboard-delete' => 'keyboard-delete',
                'icon-arrows-keyboard-down' => 'keyboard-down',
                'icon-arrows-keyboard-left' => 'keyboard-left',
                'icon-arrows-keyboard-return' => 'keyboard-return',
                'icon-arrows-keyboard-right' => 'keyboard-right',
                'icon-arrows-keyboard-shift' => 'keyboard-shift',
                'icon-arrows-keyboard-tab' => 'keyboard-tab',
                'icon-arrows-keyboard-up' => 'keyboard-up',
                'icon-arrows-left' => 'left',
                'icon-arrows-left-double-32' => 'left-double-32',
                'icon-arrows-minus' => 'minus',
                'icon-arrows-move' => 'move',
                'icon-arrows-move2' => 'move2',
                'icon-arrows-move-bottom' => 'move-bottom',
                'icon-arrows-move-left' => 'move-left',
                'icon-arrows-move-right' => 'move-right',
                'icon-arrows-move-top' => 'move-top',
                'icon-arrows-plus' => 'plus',
                'icon-arrows-question' => 'question',
                'icon-arrows-remove' => 'remove',
                'icon-arrows-right' => 'right',
                'icon-arrows-right-double' => 'right-double',
                'icon-arrows-rotate' => 'rotate',
                'icon-arrows-rotate-anti' => 'rotate-anti',
                'icon-arrows-rotate-anti-dashed' => 'rotate-anti-dashed',
                'icon-arrows-rotate-dashed' => 'rotate-dashed',
                'icon-arrows-shrink' => 'shrink',
                'icon-arrows-shrink-diagonal1' => 'shrink-diagonal1',
                'icon-arrows-shrink-diagonal2' => 'shrink-diagonal2',
                'icon-arrows-shrink-horizonal2' => 'shrink-horizonal2',
                'icon-arrows-shrink-horizontal1' => 'shrink-horizontal1',
                'icon-arrows-shrink-vertical1' => 'shrink-vertical1',
                'icon-arrows-shrink-vertical2' => 'shrink-vertical2',
                'icon-arrows-sign-down' => 'sign-down',
                'icon-arrows-sign-left' => 'sign-left',
                'icon-arrows-sign-right' => 'sign-right',
                'icon-arrows-sign-up' => 'sign-up',
                'icon-arrows-slide-down1' => 'slide-down1',
                'icon-arrows-slide-down2' => 'slide-down2',
                'icon-arrows-slide-left1' => 'slide-left1',
                'icon-arrows-slide-left2' => 'slide-left2',
                'icon-arrows-slide-right1' => 'slide-right1',
                'icon-arrows-slide-right2' => 'slide-right2',
                'icon-arrows-slide-up1' => 'slide-up1',
                'icon-arrows-slide-up2' => 'slide-up2',
                'icon-arrows-slim-down' => 'slim-down',
                'icon-arrows-slim-down-dashed' => 'slim-down-dashed',
                'icon-arrows-slim-left' => 'slim-left',
                'icon-arrows-slim-left-dashed' => 'slim-left-dashed',
                'icon-arrows-slim-right' => 'slim-right',
                'icon-arrows-slim-right-dashed' => 'slim-right-dashed',
                'icon-arrows-slim-up' => 'slim-up',
                'icon-arrows-slim-up-dashed' => 'slim-up-dashed',
                'icon-arrows-square-check' => 'square-check',
                'icon-arrows-square-down' => 'square-down',
                'icon-arrows-square-downleft' => 'square-downleft',
                'icon-arrows-square-downright' => 'square-downright',
                'icon-arrows-square-left' => 'square-left',
                'icon-arrows-square-minus' => 'square-minus',
                'icon-arrows-square-plus' => 'square-plus',
                'icon-arrows-square-remove' => 'square-remove',
                'icon-arrows-square-right' => 'square-right',
                'icon-arrows-square-up' => 'square-up',
                'icon-arrows-square-upleft' => 'square-upleft',
                'icon-arrows-square-upright' => 'square-upright',
                'icon-arrows-squares' => 'squares',
                'icon-arrows-stretch-diagonal1' => 'stretch-diagonal1',
                'icon-arrows-stretch-diagonal2' => 'stretch-diagonal2',
                'icon-arrows-stretch-diagonal3' => 'stretch-diagonal3',
                'icon-arrows-stretch-diagonal4' => 'stretch-diagonal4',
                'icon-arrows-stretch-horizontal1' => 'stretch-horizontal1',
                'icon-arrows-stretch-horizontal2' => 'stretch-horizontal2',
                'icon-arrows-stretch-vertical1' => 'stretch-vertical1',
                'icon-arrows-stretch-vertical2' => 'stretch-vertical2',
                'icon-arrows-switch-horizontal' => 'switch-horizontal',
                'icon-arrows-switch-vertical' => 'switch-vertical',
                'icon-arrows-up' => 'up',
                'icon-arrows-up-double-33' => 'up-double-33',
                'icon-arrows-upleft' => 'upleft',
                'icon-arrows-upright' => 'upright',
                'icon-arrows-vertical' => 'vertical',
                'icon-ecommerce-bag' => 'bag',
                'icon-ecommerce-bag-check' => 'bag-check',
                'icon-ecommerce-bag-cloud' => 'bag-cloud',
                'icon-ecommerce-bag-download' => 'bag-download',
                'icon-ecommerce-bag-minus' => 'bag-minus',
                'icon-ecommerce-bag-plus' => 'bag-plus',
                'icon-ecommerce-bag-refresh' => 'bag-refresh',
                'icon-ecommerce-bag-remove' => 'bag-remove',
                'icon-ecommerce-bag-search' => 'bag-search',
                'icon-ecommerce-bag-upload' => 'bag-upload',
                'icon-ecommerce-banknote' => 'banknote',
                'icon-ecommerce-banknotes' => 'banknotes',
                'icon-ecommerce-basket' => 'basket',
                'icon-ecommerce-basket-check' => 'basket-check',
                'icon-ecommerce-basket-cloud' => 'basket-cloud',
                'icon-ecommerce-basket-download' => 'basket-download',
                'icon-ecommerce-basket-minus' => 'basket-minus',
                'icon-ecommerce-basket-plus' => 'basket-plus',
                'icon-ecommerce-basket-refresh' => 'basket-refresh',
                'icon-ecommerce-basket-remove' => 'basket-remove',
                'icon-ecommerce-basket-search' => 'basket-search',
                'icon-ecommerce-basket-upload' => 'basket-upload',
                'icon-ecommerce-bath' => 'bath',
                'icon-ecommerce-cart' => 'cart',
                'icon-ecommerce-cart-check' => 'cart-check',
                'icon-ecommerce-cart-cloud' => 'cart-cloud',
                'icon-ecommerce-cart-content' => 'cart-content',
                'icon-ecommerce-cart-download' => 'cart-download',
                'icon-ecommerce-cart-minus' => 'cart-minus',
                'icon-ecommerce-cart-plus' => 'cart-plus',
                'icon-ecommerce-cart-refresh' => 'cart-refresh',
                'icon-ecommerce-cart-remove' => 'cart-remove',
                'icon-ecommerce-cart-search' => 'cart-search',
                'icon-ecommerce-cart-upload' => 'cart-upload',
                'icon-ecommerce-cent' => 'cent',
                'icon-ecommerce-colon' => 'colon',
                'icon-ecommerce-creditcard' => 'creditcard',
                'icon-ecommerce-diamond' => 'diamond',
                'icon-ecommerce-dollar' => 'dollar',
                'icon-ecommerce-euro' => 'euro',
                'icon-ecommerce-franc' => 'franc',
                'icon-ecommerce-gift' => 'gift',
                'icon-ecommerce-graph1' => 'graph1',
                'icon-ecommerce-graph2' => 'graph2',
                'icon-ecommerce-graph3' => 'graph3',
                'icon-ecommerce-graph-decrease' => 'graph-decrease',
                'icon-ecommerce-graph-increase' => 'graph-increase',
                'icon-ecommerce-guarani' => 'guarani',
                'icon-ecommerce-kips' => 'kips',
                'icon-ecommerce-lira' => 'lira',
                'icon-ecommerce-megaphone' => 'megaphone',
                'icon-ecommerce-money' => 'money',
                'icon-ecommerce-naira' => 'naira',
                'icon-ecommerce-pesos' => 'pesos',
                'icon-ecommerce-pound' => 'pound',
                'icon-ecommerce-receipt' => 'receipt',
                'icon-ecommerce-receipt-bath' => 'receipt-bath',
                'icon-ecommerce-receipt-cent' => 'receipt-cent',
                'icon-ecommerce-receipt-dollar' => 'receipt-dollar',
                'icon-ecommerce-receipt-euro' => 'receipt-euro',
                'icon-ecommerce-receipt-franc' => 'receipt-franc',
                'icon-ecommerce-receipt-guarani' => 'receipt-guarani',
                'icon-ecommerce-receipt-kips' => 'receipt-kips',
                'icon-ecommerce-receipt-lira' => 'receipt-lira',
                'icon-ecommerce-receipt-naira' => 'receipt-naira',
                'icon-ecommerce-receipt-pesos' => 'receipt-pesos',
                'icon-ecommerce-receipt-pound' => 'receipt-pound',
                'icon-ecommerce-receipt-rublo' => 'receipt-rublo',
                'icon-ecommerce-receipt-rupee' => 'receipt-rupee',
                'icon-ecommerce-receipt-tugrik' => 'receipt-tugrik',
                'icon-ecommerce-receipt-won' => 'receipt-won',
                'icon-ecommerce-receipt-yen' => 'receipt-yen',
                'icon-ecommerce-receipt-yen2' => 'receipt-yen2',
                'icon-ecommerce-recept-colon' => 'recept-colon',
                'icon-ecommerce-rublo' => 'rublo',
                'icon-ecommerce-rupee' => 'rupee',
                'icon-ecommerce-safe' => 'safe',
                'icon-ecommerce-sale' => 'sale',
                'icon-ecommerce-sales' => 'sales',
                'icon-ecommerce-ticket' => 'ticket',
                'icon-ecommerce-tugriks' => 'tugriks',
                'icon-ecommerce-wallet' => 'wallet',
                'icon-ecommerce-won' => 'won',
                'icon-ecommerce-yen' => 'yen',
                'icon-ecommerce-yen2' => 'yen2',
                'icon-basic-accelerator' => 'accelerator',
                'icon-basic-alarm' => 'alarm',
                'icon-basic-anchor' => 'anchor',
                'icon-basic-anticlockwise' => 'anticlockwise',
                'icon-basic-archive' => 'archive',
                'icon-basic-archive-full' => 'archive-full',
                'icon-basic-ban' => 'ban',
                'icon-basic-battery-charge' => 'battery-charge',
                'icon-basic-battery-empty' => 'battery-empty',
                'icon-basic-battery-full' => 'battery-full',
                'icon-basic-battery-half' => 'battery-half',
                'icon-basic-bolt' => 'bolt',
                'icon-basic-book' => 'book',
                'icon-basic-book-pen' => 'book-pen',
                'icon-basic-book-pencil' => 'book-pencil',
                'icon-basic-bookmark' => 'bookmark',
                'icon-basic-calculator' => 'calculator',
                'icon-basic-calendar' => 'calendar',
                'icon-basic-cards-diamonds' => 'cards-diamonds',
                'icon-basic-cards-hearts' => 'cards-hearts',
                'icon-basic-case' => 'case',
                'icon-basic-chronometer' => 'chronometer',
                'icon-basic-clessidre' => 'clessidre',
                'icon-basic-clock' => 'clock',
                'icon-basic-clockwise' => 'clockwise',
                'icon-basic-cloud' => 'cloud',
                'icon-basic-clubs' => 'clubs',
                'icon-basic-compass' => 'compass',
                'icon-basic-cup' => 'cup',
                'icon-basic-diamonds' => 'diamonds',
                'icon-basic-display' => 'display',
                'icon-basic-download' => 'download',
                'icon-basic-exclamation' => 'exclamation',
                'icon-basic-eye' => 'eye',
                'icon-basic-eye-closed' => 'eye-closed',
                'icon-basic-female' => 'female',
                'icon-basic-flag1' => 'flag1',
                'icon-basic-flag2' => 'flag2',
                'icon-basic-floppydisk' => 'floppydisk',
                'icon-basic-folder' => 'folder',
                'icon-basic-folder-multiple' => 'folder-multiple',
                'icon-basic-gear' => 'gear',
                'icon-basic-geolocalize-01' => 'geolocalize-01',
                'icon-basic-geolocalize-05' => 'geolocalize-05',
                'icon-basic-globe' => 'globe',
                'icon-basic-gunsight' => 'gunsight',
                'icon-basic-hammer' => 'hammer',
                'icon-basic-headset' => 'headset',
                'icon-basic-heart' => 'heart',
                'icon-basic-heart-broken' => 'heart-broken',
                'icon-basic-helm' => 'helm',
                'icon-basic-home' => 'home',
                'icon-basic-info' => 'info',
                'icon-basic-ipod' => 'ipod',
                'icon-basic-joypad' => 'joypad',
                'icon-basic-key' => 'key',
                'icon-basic-keyboard' => 'keyboard',
                'icon-basic-laptop' => 'laptop',
                'icon-basic-life-buoy' => 'life-buoy',
                'icon-basic-lightbulb' => 'lightbulb',
                'icon-basic-link' => 'link',
                'icon-basic-lock' => 'lock',
                'icon-basic-lock-open' => 'lock-open',
                'icon-basic-magic-mouse' => 'magic-mouse',
                'icon-basic-magnifier' => 'magnifier',
                'icon-basic-magnifier-minus' => 'magnifier-minus',
                'icon-basic-magnifier-plus' => 'magnifier-plus',
                'icon-basic-mail' => 'mail',
                'icon-basic-mail-multiple' => 'mail-multiple',
                'icon-basic-mail-open' => 'mail-open',
                'icon-basic-mail-open-text' => 'mail-open-text',
                'icon-basic-male' => 'male',
                'icon-basic-map' => 'map',
                'icon-basic-message' => 'message',
                'icon-basic-message-multiple' => 'message-multiple',
                'icon-basic-message-txt' => 'message-txt',
                'icon-basic-mixer2' => 'mixer2',
                'icon-basic-mouse' => 'mouse',
                'icon-basic-notebook' => 'notebook',
                'icon-basic-notebook-pen' => 'notebook-pen',
                'icon-basic-notebook-pencil' => 'notebook-pencil',
                'icon-basic-paperplane' => 'paperplane',
                'icon-basic-pencil-ruler' => 'pencil-ruler',
                'icon-basic-pencil-ruler-pen' => 'pencil-ruler-pen',
                'icon-basic-photo' => 'photo',
                'icon-basic-picture' => 'picture',
                'icon-basic-picture-multiple' => 'picture-multiple',
                'icon-basic-pin1' => 'pin1',
                'icon-basic-pin2' => 'pin2',
                'icon-basic-postcard' => 'postcard',
                'icon-basic-postcard-multiple' => 'postcard-multiple',
                'icon-basic-printer' => 'printer',
                'icon-basic-question' => 'question',
                'icon-basic-rss' => 'rss',
                'icon-basic-server' => 'server',
                'icon-basic-server2' => 'server2',
                'icon-basic-server-cloud' => 'server-cloud',
                'icon-basic-server-download' => 'server-download',
                'icon-basic-server-upload' => 'server-upload',
                'icon-basic-settings' => 'settings',
                'icon-basic-share' => 'share',
                'icon-basic-sheet' => 'sheet',
                'icon-basic-sheet-multiple' => 'sheet-multiple',
                'icon-basic-sheet-pen' => 'sheet-pen',
                'icon-basic-sheet-pencil' => 'sheet-pencil',
                'icon-basic-sheet-txt' => 'sheet-txt',
                'icon-basic-signs' => 'signs',
                'icon-basic-smartphone' => 'smartphone',
                'icon-basic-spades' => 'spades',
                'icon-basic-spread' => 'spread',
                'icon-basic-spread-bookmark' => 'spread-bookmark',
                'icon-basic-spread-text' => 'spread-text',
                'icon-basic-spread-text-bookmark' => 'spread-text-bookmark',
                'icon-basic-star' => 'star',
                'icon-basic-tablet' => 'tablet',
                'icon-basic-target' => 'target',
                'icon-basic-todo' => 'todo',
                'icon-basic-todo-pen' => 'todo-pen',
                'icon-basic-todo-pencil' => 'todo-pencil',
                'icon-basic-todo-txt' => 'todo-txt',
                'icon-basic-todolist-pen' => 'todolist-pen',
                'icon-basic-todolist-pencil' => 'todolist-pencil',
                'icon-basic-trashcan' => 'trashcan',
                'icon-basic-trashcan-full' => 'trashcan-full',
                'icon-basic-trashcan-refresh' => 'trashcan-refresh',
                'icon-basic-trashcan-remove' => 'trashcan-remove',
                'icon-basic-upload' => 'upload',
                'icon-basic-usb' => 'usb',
                'icon-basic-video' => 'video',
                'icon-basic-watch' => 'watch',
                'icon-basic-webpage' => 'webpage',
                'icon-basic-webpage-img-txt' => 'webpage-img-txt',
                'icon-basic-webpage-multiple' => 'webpage-multiple',
                'icon-basic-webpage-txt' => 'webpage-txt',
                'icon-basic-world' => 'world',
                'icon-mobile' => 'mobile',
                'icon-laptop' => 'laptop',
                'icon-desktop' => 'desktop',
                'icon-tablet' => 'tablet',
                'icon-phone' => 'phone',
                'icon-document' => 'document',
                'icon-documents' => 'documents',
                'icon-search' => 'search',
                'icon-clipboard' => 'clipboard',
                'icon-newspaper' => 'newspaper',
                'icon-notebook' => 'notebook',
                'icon-book-open' => 'book-open',
                'icon-browser' => 'browser',
                'icon-calendar' => 'calendar',
                'icon-presentation' => 'presentation',
                'icon-picture' => 'picture',
                'icon-pictures' => 'pictures',
                'icon-video' => 'video',
                'icon-camera' => 'camera',
                'icon-printer' => 'printer',
                'icon-toolbox' => 'toolbox',
                'icon-briefcase' => 'briefcase',
                'icon-wallet' => 'wallet',
                'icon-gift' => 'gift',
                'icon-bargraph' => 'bargraph',
                'icon-grid' => 'grid',
                'icon-expand' => 'expand',
                'icon-focus' => 'focus',
                'icon-edit' => 'edit',
                'icon-adjustments' => 'adjustments',
                'icon-ribbon' => 'ribbon',
                'icon-hourglass' => 'hourglass',
                'icon-lock' => 'lock',
                'icon-megaphone' => 'megaphone',
                'icon-shield' => 'shield',
                'icon-trophy' => 'trophy',
                'icon-flag' => 'flag',
                'icon-map' => 'map',
                'icon-puzzle' => 'puzzle',
                'icon-basket' => 'basket',
                'icon-envelope' => 'envelope',
                'icon-streetsign' => 'streetsign',
                'icon-telescope' => 'telescope',
                'icon-gears' => 'gears',
                'icon-key' => 'key',
                'icon-paperclip' => 'paperclip',
                'icon-attachment' => 'attachment',
                'icon-pricetags' => 'pricetags',
                'icon-lightbulb' => 'lightbulb',
                'icon-layers' => 'layers',
                'icon-pencil' => 'pencil',
                'icon-tools' => 'tools',
                'icon-tools-2' => 'tools-2',
                'icon-scissors' => 'scissors',
                'icon-paintbrush' => 'paintbrush',
                'icon-magnifying-glass' => 'magnifying-glass',
                'icon-circle-compass' => 'circle-compass',
                'icon-linegraph' => 'linegraph',
                'icon-mic' => 'mic',
                'icon-strategy' => 'strategy',
                'icon-beaker' => 'beaker',
                'icon-caution' => 'caution',
                'icon-recycle' => 'recycle',
                'icon-anchor' => 'anchor',
                'icon-profile-male' => 'profile-male',
                'icon-profile-female' => 'profile-female',
                'icon-bike' => 'bike',
                'icon-wine' => 'wine',
                'icon-hotairballoon' => 'hotairballoon',
                'icon-globe' => 'globe',
                'icon-genius' => 'genius',
                'icon-map-pin' => 'map-pin',
                'icon-dial' => 'dial',
                'icon-chat' => 'chat',
                'icon-heart' => 'heart',
                'icon-cloud' => 'cloud',
                'icon-upload' => 'upload',
                'icon-download' => 'download',
                'icon-target' => 'target',
                'icon-hazardous' => 'hazardous',
                'icon-piechart' => 'piechart',
                'icon-speedometer' => 'speedometer',
                'icon-global' => 'global',
                'icon-compass' => 'compass',
                'icon-lifesaver' => 'lifesaver',
                'icon-clock' => 'clock',
                'icon-aperture' => 'aperture',
                'icon-quote' => 'quote',
                'icon-scope' => 'scope',
                'icon-alarmclock' => 'alarmclock',
                'icon-refresh' => 'refresh',
                'icon-happy' => 'happy',
                'icon-sad' => 'sad',
                'icon-googleplus' => 'googleplus',
                'icon-rss' => 'rss',
                'icon-tumblr' => 'tumblr',
                'icon-dribbble' => 'dribbble',
                'ti-wand' => 'wand',
                'ti-volume' => 'volume',
                'ti-user' => 'user',
                'ti-unlock' => 'unlock',
                'ti-unlink' => 'unlink',
                'ti-trash' => 'trash',
                'ti-thought' => 'thought',
                'ti-target' => 'target',
                'ti-tag' => 'tag',
                'ti-tablet' => 'tablet',
                'ti-star' => 'star',
                'ti-spray' => 'spray',
                'ti-signal' => 'signal',
                'ti-shopping-cart' => 'shopping-cart',
                'ti-shopping-cart-full' => 'shopping-cart-full',
                'ti-settings' => 'settings',
                'ti-search' => 'search',
                'ti-zoom-in' => 'zoom-in',
                'ti-zoom-out' => 'zoom-out',
                'ti-cut' => 'cut',
                'ti-ruler' => 'ruler',
                'ti-ruler-pencil' => 'ruler-pencil',
                'ti-ruler-alt' => 'ruler-alt',
                'ti-bookmark' => 'bookmark',
                'ti-bookmark-alt' => 'bookmark-alt',
                'ti-reload' => 'reload',
                'ti-plus' => 'plus',
                'ti-pin' => 'pin',
                'ti-pencil' => 'pencil',
                'ti-pencil-alt' => 'pencil-alt',
                'ti-paint-roller' => 'paint-roller',
                'ti-paint-bucket' => 'paint-bucket',
                'ti-na' => 'na',
                'ti-mobile' => 'mobile',
                'ti-minus' => 'minus',
                'ti-medall' => 'medall',
                'ti-medall-alt' => 'medall-alt',
                'ti-marker' => 'marker',
                'ti-marker-alt' => 'marker-alt',
                'ti-arrow-up' => 'arrow-up',
                'ti-arrow-right' => 'arrow-right',
                'ti-arrow-left' => 'arrow-left',
                'ti-arrow-down' => 'arrow-down',
                'ti-lock' => 'lock',
                'ti-location-arrow' => 'location-arrow',
                'ti-link' => 'link',
                'ti-layout' => 'layout',
                'ti-layers' => 'layers',
                'ti-layers-alt' => 'layers-alt',
                'ti-key' => 'key',
                'ti-import' => 'import',
                'ti-image' => 'image',
                'ti-heart' => 'heart',
                'ti-heart-broken' => 'heart-broken',
                'ti-hand-stop' => 'hand-stop',
                'ti-hand-open' => 'hand-open',
                'ti-hand-drag' => 'hand-drag',
                'ti-folder' => 'folder',
                'ti-flag' => 'flag',
                'ti-flag-alt' => 'flag-alt',
                'ti-flag-alt-2' => 'flag-alt-2',
                'ti-eye' => 'eye',
                'ti-export' => 'export',
                'ti-exchange-vertical' => 'exchange-vertical',
                'ti-desktop' => 'desktop',
                'ti-cup' => 'cup',
                'ti-crown' => 'crown',
                'ti-comments' => 'comments',
                'ti-comment' => 'comment',
                'ti-comment-alt' => 'comment-alt',
                'ti-close' => 'close',
                'ti-clip' => 'clip',
                'ti-angle-up' => 'angle-up',
                'ti-angle-right' => 'angle-right',
                'ti-angle-left' => 'angle-left',
                'ti-angle-down' => 'angle-down',
                'ti-check' => 'check',
                'ti-check-box' => 'check-box',
                'ti-camera' => 'camera',
                'ti-announcement' => 'announcement',
                'ti-brush' => 'brush',
                'ti-briefcase' => 'briefcase',
                'ti-bolt' => 'bolt',
                'ti-bolt-alt' => 'bolt-alt',
                'ti-blackboard' => 'blackboard',
                'ti-bag' => 'bag',
                'ti-move' => 'move',
                'ti-arrows-vertical' => 'arrows-vertical',
                'ti-arrows-horizontal' => 'arrows-horizontal',
                'ti-fullscreen' => 'fullscreen',
                'ti-arrow-top-right' => 'arrow-top-right',
                'ti-arrow-top-left' => 'arrow-top-left',
                'ti-arrow-circle-up' => 'arrow-circle-up',
                'ti-arrow-circle-right' => 'arrow-circle-right',
                'ti-arrow-circle-left' => 'arrow-circle-left',
                'ti-arrow-circle-down' => 'arrow-circle-down',
                'ti-angle-double-up' => 'angle-double-up',
                'ti-angle-double-right' => 'angle-double-right',
                'ti-angle-double-left' => 'angle-double-left',
                'ti-angle-double-down' => 'angle-double-down',
                'ti-zip' => 'zip',
                'ti-world' => 'world',
                'ti-wheelchair' => 'wheelchair',
                'ti-view-list' => 'view-list',
                'ti-view-list-alt' => 'view-list-alt',
                'ti-view-grid' => 'view-grid',
                'ti-uppercase' => 'uppercase',
                'ti-upload' => 'upload',
                'ti-underline' => 'underline',
                'ti-truck' => 'truck',
                'ti-timer' => 'timer',
                'ti-ticket' => 'ticket',
                'ti-thumb-up' => 'thumb-up',
                'ti-thumb-down' => 'thumb-down',
                'ti-text' => 'text',
                'ti-stats-up' => 'stats-up',
                'ti-stats-down' => 'stats-down',
                'ti-split-v' => 'split-v',
                'ti-split-h' => 'split-h',
                'ti-smallcap' => 'smallcap',
                'ti-shine' => 'shine',
                'ti-shift-right' => 'shift-right',
                'ti-shift-left' => 'shift-left',
                'ti-shield' => 'shield',
                'ti-notepad' => 'notepad',
                'ti-server' => 'server',
                'ti-quote-right' => 'quote-right',
                'ti-quote-left' => 'quote-left',
                'ti-pulse' => 'pulse',
                'ti-printer' => 'printer',
                'ti-power-off' => 'power-off',
                'ti-plug' => 'plug',
                'ti-pie-chart' => 'pie-chart',
                'ti-paragraph' => 'paragraph',
                'ti-panel' => 'panel',
                'ti-package' => 'package',
                'ti-music' => 'music',
                'ti-music-alt' => 'music-alt',
                'ti-mouse' => 'mouse',
                'ti-mouse-alt' => 'mouse-alt',
                'ti-money' => 'money',
                'ti-microphone' => 'microphone',
                'ti-menu' => 'menu',
                'ti-menu-alt' => 'menu-alt',
                'ti-map' => 'map',
                'ti-map-alt' => 'map-alt',
                'ti-loop' => 'loop',
                'ti-location-pin' => 'location-pin',
                'ti-list' => 'list',
                'ti-light-bulb' => 'light-bulb',
                'ti-Italic' => 'Italic',
                'ti-info' => 'info',
                'ti-infinite' => 'infinite',
                'ti-id-badge' => 'id-badge',
                'ti-hummer' => 'hummer',
                'ti-home' => 'home',
                'ti-help' => 'help',
                'ti-headphone' => 'headphone',
                'ti-harddrives' => 'harddrives',
                'ti-harddrive' => 'harddrive',
                'ti-gift' => 'gift',
                'ti-game' => 'game',
                'ti-filter' => 'filter',
                'ti-files' => 'files',
                'ti-file' => 'file',
                'ti-eraser' => 'eraser',
                'ti-envelope' => 'envelope',
                'ti-download' => 'download',
                'ti-direction' => 'direction',
                'ti-direction-alt' => 'direction-alt',
                'ti-dashboard' => 'dashboard',
                'ti-control-stop' => 'control-stop',
                'ti-control-shuffle' => 'control-shuffle',
                'ti-control-play' => 'control-play',
                'ti-control-pause' => 'control-pause',
                'ti-control-forward' => 'control-forward',
                'ti-control-backward' => 'control-backward',
                'ti-cloud' => 'cloud',
                'ti-cloud-up' => 'cloud-up',
                'ti-cloud-down' => 'cloud-down',
                'ti-clipboard' => 'clipboard',
                'ti-car' => 'car',
                'ti-calendar' => 'calendar',
                'ti-book' => 'book',
                'ti-bell' => 'bell',
                'ti-basketball' => 'basketball',
                'ti-bar-chart' => 'bar-chart',
                'ti-bar-chart-alt' => 'bar-chart-alt',
                'ti-back-right' => 'back-right',
                'ti-back-left' => 'back-left',
                'ti-arrows-corner' => 'arrows-corner',
                'ti-archive' => 'archive',
                'ti-anchor' => 'anchor',
                'ti-align-right' => 'align-right',
                'ti-align-left' => 'align-left',
                'ti-align-justify' => 'align-justify',
                'ti-align-center' => 'align-center',
                'ti-alert' => 'alert',
                'ti-alarm-clock' => 'alarm-clock',
                'ti-agenda' => 'agenda',
                'ti-write' => 'write',
                'ti-window' => 'window',
                'ti-widgetized' => 'widgetized',
                'ti-widget' => 'widget',
                'ti-widget-alt' => 'widget-alt',
                'ti-wallet' => 'wallet',
                'ti-video-clapper' => 'video-clapper',
                'ti-video-camera' => 'video-camera',
                'ti-vector' => 'vector',
                'ti-themify-logo' => 'themify-logo',
                'ti-themify-favicon' => 'themify-favicon',
                'ti-themify-favicon-alt' => 'themify-favicon-alt',
                'ti-support' => 'support',
                'ti-stamp' => 'stamp',
                'ti-split-v-alt' => 'split-v-alt',
                'ti-slice' => 'slice',
                'ti-shortcode' => 'shortcode',
                'ti-shift-right-alt' => 'shift-right-alt',
                'ti-shift-left-alt' => 'shift-left-alt',
                'ti-ruler-alt-2' => 'ruler-alt-2',
                'ti-receipt' => 'receipt',
                'ti-pin2' => 'pin2',
                'ti-pin-alt' => 'pin-alt',
                'ti-pencil-alt2' => 'pencil-alt2',
                'ti-palette' => 'palette',
                'ti-more' => 'more',
                'ti-more-alt' => 'more-alt',
                'ti-microphone-alt' => 'microphone-alt',
                'ti-magnet' => 'magnet',
                'ti-line-double' => 'line-double',
                'ti-line-dotted' => 'line-dotted',
                'ti-line-dashed' => 'line-dashed',
                'ti-layout-width-full' => 'layout-width-full',
                'ti-layout-width-default' => 'layout-width-default',
                'ti-layout-width-default-alt' => 'layout-width-default-alt',
                'ti-layout-tab' => 'layout-tab',
                'ti-layout-tab-window' => 'layout-tab-window',
                'ti-layout-tab-v' => 'layout-tab-v',
                'ti-layout-tab-min' => 'layout-tab-min',
                'ti-layout-slider' => 'layout-slider',
                'ti-layout-slider-alt' => 'layout-slider-alt',
                'ti-layout-sidebar-right' => 'layout-sidebar-right',
                'ti-layout-sidebar-none' => 'layout-sidebar-none',
                'ti-layout-sidebar-left' => 'layout-sidebar-left',
                'ti-layout-placeholder' => 'layout-placeholder',
                'ti-layout-menu' => 'layout-menu',
                'ti-layout-menu-v' => 'layout-menu-v',
                'ti-layout-menu-separated' => 'layout-menu-separated',
                'ti-layout-menu-full' => 'layout-menu-full',
                'ti-layout-media-right-alt' => 'layout-media-right-alt',
                'ti-layout-media-right' => 'layout-media-right',
                'ti-layout-media-overlay' => 'layout-media-overlay',
                'ti-layout-media-overlay-alt' => 'layout-media-overlay-alt',
                'ti-layout-media-overlay-alt-2' => 'layout-media-overlay-alt-2',
                'ti-layout-media-left-alt' => 'layout-media-left-alt',
                'ti-layout-media-left' => 'layout-media-left',
                'ti-layout-media-center-alt' => 'layout-media-center-alt',
                'ti-layout-media-center' => 'layout-media-center',
                'ti-layout-list-thumb' => 'layout-list-thumb',
                'ti-layout-list-thumb-alt' => 'layout-list-thumb-alt',
                'ti-layout-list-post' => 'layout-list-post',
                'ti-layout-list-large-image' => 'layout-list-large-image',
                'ti-layout-line-solid' => 'layout-line-solid',
                'ti-layout-grid4' => 'layout-grid4',
                'ti-layout-grid3' => 'layout-grid3',
                'ti-layout-grid2' => 'layout-grid2',
                'ti-layout-grid2-thumb' => 'layout-grid2-thumb',
                'ti-layout-cta-right' => 'layout-cta-right',
                'ti-layout-cta-left' => 'layout-cta-left',
                'ti-layout-cta-center' => 'layout-cta-center',
                'ti-layout-cta-btn-right' => 'layout-cta-btn-right',
                'ti-layout-cta-btn-left' => 'layout-cta-btn-left',
                'ti-layout-column4' => 'layout-column4',
                'ti-layout-column3' => 'layout-column3',
                'ti-layout-column2' => 'layout-column2',
                'ti-layout-accordion-separated' => 'layout-accordion-separated',
                'ti-layout-accordion-merged' => 'layout-accordion-merged',
                'ti-layout-accordion-list' => 'layout-accordion-list',
                'ti-ink-pen' => 'ink-pen',
                'ti-info-alt' => 'info-alt',
                'ti-help-alt' => 'help-alt',
                'ti-headphone-alt' => 'headphone-alt',
                'ti-hand-point-up' => 'hand-point-up',
                'ti-hand-point-right' => 'hand-point-right',
                'ti-hand-point-left' => 'hand-point-left',
                'ti-hand-point-down' => 'hand-point-down',
                'ti-gallery' => 'gallery',
                'ti-face-smile' => 'face-smile',
                'ti-face-sad' => 'face-sad',
                'ti-credit-card' => 'credit-card',
                'ti-control-skip-forward' => 'control-skip-forward',
                'ti-control-skip-backward' => 'control-skip-backward',
                'ti-control-record' => 'control-record',
                'ti-control-eject' => 'control-eject',
                'ti-comments-smiley' => 'comments-smiley',
                'ti-brush-alt' => 'brush-alt',
                'ti-youtube' => 'youtube',
                'ti-vimeo' => 'vimeo',
                'ti-twitter' => 'twitter',
                'ti-time' => 'time',
                'ti-tumblr' => 'tumblr',
                'ti-skype' => 'skype',
                'ti-share' => 'share',
                'ti-share-alt' => 'share-alt',
                'ti-rocket' => 'rocket',
                'ti-pinterest' => 'pinterest',
                'ti-new-window' => 'new-window',
                'ti-microsoft' => 'microsoft',
                'ti-list-ol' => 'list-ol',
                'ti-linkedin' => 'linkedin',
                'ti-layout-sidebar-2' => 'layout-sidebar-2',
                'ti-layout-grid4-alt' => 'layout-grid4-alt',
                'ti-layout-grid3-alt' => 'layout-grid3-alt',
                'ti-layout-grid2-alt' => 'layout-grid2-alt',
                'ti-layout-column4-alt' => 'layout-column4-alt',
                'ti-layout-column3-alt' => 'layout-column3-alt',
                'ti-layout-column2-alt' => 'layout-column2-alt',
                'ti-instagram' => 'instagram',
                'ti-google' => 'google',
                'ti-github' => 'github',
                'ti-flickr' => 'flickr',
                'ti-facebook' => 'facebook',
                'ti-dropbox' => 'dropbox',
                'ti-dribbble' => 'dribbble',
                'ti-apple' => 'apple',
                'ti-android' => 'android',
                'ti-save' => 'save',
                'ti-save-alt' => 'save-alt',
                'ti-yahoo' => 'yahoo',
                'ti-wordpress' => 'wordpress',
                'ti-vimeo-alt' => 'vimeo-alt',
                'ti-twitter-alt' => 'twitter-alt',
                'ti-tumblr-alt' => 'tumblr-alt',
                'ti-trello' => 'trello',
                'ti-stack-overflow' => 'stack-overflow',
                'ti-soundcloud' => 'soundcloud',
                'ti-sharethis' => 'sharethis',
                'ti-sharethis-alt' => 'sharethis-alt',
                'ti-reddit' => 'reddit',
                'ti-pinterest-alt' => 'pinterest-alt',
                'ti-microsoft-alt' => 'microsoft-alt',
                'ti-linux' => 'linux',
                'ti-jsfiddle' => 'jsfiddle',
                'ti-joomla' => 'joomla',
                'ti-html5' => 'html5',
                'ti-flickr-alt' => 'flickr-alt',
                'ti-email' => 'email',
                'ti-drupal' => 'drupal',
                'ti-dropbox-alt' => 'dropbox-alt',
                'ti-css3' => 'css3',
                'ti-rss' => 'rss',
                'ti-rss-alt' => 'rss-alt',
                'pe-7s-album' => 'album',
                'pe-7s-arc' => 'arc',
                'pe-7s-back-2' => 'back-2',
                'pe-7s-bandaid' => 'bandaid',
                'pe-7s-car' => 'car',
                'pe-7s-diamond' => 'diamond',
                'pe-7s-door-lock' => 'door-lock',
                'pe-7s-eyedropper' => 'eyedropper',
                'pe-7s-female' => 'female',
                'pe-7s-gym' => 'gym',
                'pe-7s-hammer' => 'hammer',
                'pe-7s-headphones' => 'headphones',
                'pe-7s-helm' => 'helm',
                'pe-7s-hourglass' => 'hourglass',
                'pe-7s-leaf' => 'leaf',
                'pe-7s-magic-wand' => 'magic-wand',
                'pe-7s-male' => 'male',
                'pe-7s-map-2' => 'map-2',
                'pe-7s-next-2' => 'next-2',
                'pe-7s-paint-bucket' => 'paint-bucket',
                'pe-7s-pendrive' => 'pendrive',
                'pe-7s-photo' => 'photo',
                'pe-7s-piggy' => 'piggy',
                'pe-7s-plugin' => 'plugin',
                'pe-7s-refresh-2' => 'refresh-2',
                'pe-7s-rocket' => 'rocket',
                'pe-7s-settings' => 'settings',
                'pe-7s-shield' => 'shield',
                'pe-7s-smile' => 'smile',
                'pe-7s-usb' => 'usb',
                'pe-7s-vector' => 'vector',
                'pe-7s-wine' => 'wine',
                'pe-7s-cloud-upload' => 'cloud-upload',
                'pe-7s-cash' => 'cash',
                'pe-7s-close' => 'close',
                'pe-7s-bluetooth' => 'bluetooth',
                'pe-7s-cloud-download' => 'cloud-download',
                'pe-7s-way' => 'way',
                'pe-7s-close-circle' => 'close-circle',
                'pe-7s-id' => 'id',
                'pe-7s-angle-up' => 'angle-up',
                'pe-7s-wristwatch' => 'wristwatch',
                'pe-7s-angle-up-circle' => 'angle-up-circle',
                'pe-7s-world' => 'world',
                'pe-7s-angle-right' => 'angle-right',
                'pe-7s-volume' => 'volume',
                'pe-7s-angle-right-circle' => 'angle-right-circle',
                'pe-7s-users' => 'users',
                'pe-7s-angle-left' => 'angle-left',
                'pe-7s-user-female' => 'user-female',
                'pe-7s-angle-left-circle' => 'angle-left-circle',
                'pe-7s-up-arrow' => 'up-arrow',
                'pe-7s-angle-down' => 'angle-down',
                'pe-7s-switch' => 'switch',
                'pe-7s-angle-down-circle' => 'angle-down-circle',
                'pe-7s-scissors' => 'scissors',
                'pe-7s-wallet' => 'wallet',
                'pe-7s-safe' => 'safe',
                'pe-7s-volume2' => 'volume2',
                'pe-7s-volume1' => 'volume1',
                'pe-7s-voicemail' => 'voicemail',
                'pe-7s-video' => 'video',
                'pe-7s-user' => 'user',
                'pe-7s-upload' => 'upload',
                'pe-7s-unlock' => 'unlock',
                'pe-7s-umbrella' => 'umbrella',
                'pe-7s-trash' => 'trash',
                'pe-7s-tools' => 'tools',
                'pe-7s-timer' => 'timer',
                'pe-7s-ticket' => 'ticket',
                'pe-7s-target' => 'target',
                'pe-7s-sun' => 'sun',
                'pe-7s-study' => 'study',
                'pe-7s-stopwatch' => 'stopwatch',
                'pe-7s-star' => 'star',
                'pe-7s-speaker' => 'speaker',
                'pe-7s-signal' => 'signal',
                'pe-7s-shuffle' => 'shuffle',
                'pe-7s-shopbag' => 'shopbag',
                'pe-7s-share' => 'share',
                'pe-7s-server' => 'server',
                'pe-7s-search' => 'search',
                'pe-7s-film' => 'film',
                'pe-7s-science' => 'science',
                'pe-7s-disk' => 'disk',
                'pe-7s-ribbon' => 'ribbon',
                'pe-7s-repeat' => 'repeat',
                'pe-7s-refresh' => 'refresh',
                'pe-7s-add-user' => 'add-user',
                'pe-7s-refresh-cloud' => 'refresh-cloud',
                'pe-7s-paperclip' => 'paperclip',
                'pe-7s-radio' => 'radio',
                'pe-7s-note2' => 'note2',
                'pe-7s-print' => 'print',
                'pe-7s-network' => 'network',
                'pe-7s-prev' => 'prev',
                'pe-7s-mute' => 'mute',
                'pe-7s-power' => 'power',
                'pe-7s-medal' => 'medal',
                'pe-7s-portfolio' => 'portfolio',
                'pe-7s-like2' => 'like2',
                'pe-7s-plus' => 'plus',
                'pe-7s-left-arrow' => 'left-arrow',
                'pe-7s-play' => 'play',
                'pe-7s-key' => 'key',
                'pe-7s-plane' => 'plane',
                'pe-7s-joy' => 'joy',
                'pe-7s-photo-gallery' => 'photo-gallery',
                'pe-7s-pin' => 'pin',
                'pe-7s-phone' => 'phone',
                'pe-7s-plug' => 'plug',
                'pe-7s-pen' => 'pen',
                'pe-7s-right-arrow' => 'right-arrow',
                'pe-7s-paper-plane' => 'paper-plane',
                'pe-7s-delete-user' => 'delete-user',
                'pe-7s-paint' => 'paint',
                'pe-7s-bottom-arrow' => 'bottom-arrow',
                'pe-7s-notebook' => 'notebook',
                'pe-7s-note' => 'note',
                'pe-7s-next' => 'next',
                'pe-7s-news-paper' => 'news-paper',
                'pe-7s-musiclist' => 'musiclist',
                'pe-7s-music' => 'music',
                'pe-7s-mouse' => 'mouse',
                'pe-7s-more' => 'more',
                'pe-7s-moon' => 'moon',
                'pe-7s-monitor' => 'monitor',
                'pe-7s-micro' => 'micro',
                'pe-7s-menu' => 'menu',
                'pe-7s-map' => 'map',
                'pe-7s-map-marker' => 'map-marker',
                'pe-7s-mail' => 'mail',
                'pe-7s-mail-open' => 'mail-open',
                'pe-7s-mail-open-file' => 'mail-open-file',
                'pe-7s-magnet' => 'magnet',
                'pe-7s-loop' => 'loop',
                'pe-7s-look' => 'look',
                'pe-7s-lock' => 'lock',
                'pe-7s-lintern' => 'lintern',
                'pe-7s-link' => 'link',
                'pe-7s-like' => 'like',
                'pe-7s-light' => 'light',
                'pe-7s-less' => 'less',
                'pe-7s-keypad' => 'keypad',
                'pe-7s-junk' => 'junk',
                'pe-7s-info' => 'info',
                'pe-7s-home' => 'home',
                'pe-7s-help2' => 'help2',
                'pe-7s-help1' => 'help1',
                'pe-7s-graph3' => 'graph3',
                'pe-7s-graph2' => 'graph2',
                'pe-7s-graph1' => 'graph1',
                'pe-7s-graph' => 'graph',
                'pe-7s-global' => 'global',
                'pe-7s-gleam' => 'gleam',
                'pe-7s-glasses' => 'glasses',
                'pe-7s-gift' => 'gift',
                'pe-7s-folder' => 'folder',
                'pe-7s-flag' => 'flag',
                'pe-7s-filter' => 'filter',
                'pe-7s-file' => 'file',
                'pe-7s-expand1' => 'expand1',
                'pe-7s-exapnd2' => 'exapnd2',
                'pe-7s-edit' => 'edit',
                'pe-7s-drop' => 'drop',
                'pe-7s-drawer' => 'drawer',
                'pe-7s-download' => 'download',
                'pe-7s-display2' => 'display2',
                'pe-7s-display1' => 'display1',
                'pe-7s-diskette' => 'diskette',
                'pe-7s-date' => 'date',
                'pe-7s-cup' => 'cup',
                'pe-7s-culture' => 'culture',
                'pe-7s-crop' => 'crop',
                'pe-7s-credit' => 'credit',
                'pe-7s-copy-file' => 'copy-file',
                'pe-7s-config' => 'config',
                'pe-7s-compass' => 'compass',
                'pe-7s-comment' => 'comment',
                'pe-7s-coffee' => 'coffee',
                'pe-7s-cloud' => 'cloud',
                'pe-7s-clock' => 'clock',
                'pe-7s-check' => 'check',
                'pe-7s-chat' => 'chat',
                'pe-7s-cart' => 'cart',
                'pe-7s-camera' => 'camera',
                'pe-7s-call' => 'call',
                'pe-7s-calculator' => 'calculator',
                'pe-7s-browser' => 'browser',
                'pe-7s-box2' => 'box2',
                'pe-7s-box1' => 'box1',
                'pe-7s-bookmarks' => 'bookmarks',
                'pe-7s-bicycle' => 'bicycle',
                'pe-7s-bell' => 'bell',
                'pe-7s-battery' => 'battery',
                'pe-7s-ball' => 'ball',
                'pe-7s-back' => 'back',
                'pe-7s-attention' => 'attention',
                'pe-7s-anchor' => 'anchor',
                'pe-7s-albums' => 'albums',
                'pe-7s-alarm' => 'alarm',
                'pe-7s-airplay' => 'airplay',
            );
            $controls_registry->get_control( 'icon' )->set_settings( 'options', $wn_icons );
        }

    }

    Webnus_Elementor_Extentions::instance();

endif;
