<?php
/**
 * Header Builder - Enqueue Class.
 *
 * @author  Webnus
 */

// don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

if ( ! class_exists( 'WHB_Enqueue' ) ) :

    class WHB_Enqueue {

		/**
		 * Instance of this class.
         *
		 * @since	1.0.0
		 * @access	private
		 * @var		WHB_Enqueue
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

            // Enqueue editor scripts
            // add_action( 'admin_enqueue_scripts',    array( $this, 'editor_scripts' ) );

            // Enqueue frontend scripts
            add_action( 'wp_enqueue_scripts',       array( $this, 'frontend_scripts' ) );

            // Enqueue frontend inline styles
            add_action( 'wp_footer',                array( $this, 'frontend_inline_styles' ) );

		}

        /**
         * Enqueue editor scripts.
         *
         * @since	1.0.0
         */
        public function editor_scripts() {

            if ( isset( $_GET['page'] ) &&  $_GET['page'] == 'webnus_theme_options' ) {

                // JavaScripts
                wp_enqueue_script( 'wp-color-picker-alpha', DEEP_ASSETS_URL . 'js/libraries/wp-color-picker-alpha.js', array( 'wp-color-picker' ), WHB::VERSION );
                wp_enqueue_script( 'whb-editor-scripts', DEEP_ASSETS_URL . 'js/backend/whb-editor.js', array( 'jquery' ), WHB::VERSION, true );

                // Styles
                wp_enqueue_style( 'whb-editor-styles', DEEP_ASSETS_URL . 'css/backend/whb-editor.css', false, DEEP_VERSION );

            }

        }

        /**
         * Enqueue frontend scripts.
         *
         * @since	1.0.0
         */
        public function frontend_scripts() {

            $localize_data = array(
                'ajax_url'  => admin_url( 'admin-ajax.php' ),
            );

            // JavaScripts
            wp_enqueue_script( 'whb-jquery-plugins', WHB_Helper::get_file_uri( 'assets/src/frontend/whb-jquery-plugins.js' ), array( 'jquery' ), WHB::VERSION, true );
            wp_enqueue_script( 'whb-frontend-scripts', WHB_Helper::get_file_uri( 'assets/src/frontend/whb-frontend.js' ), array( 'jquery' ), WHB::VERSION, true );
            wp_localize_script( 'whb-frontend-scripts', 'whb_localize', $localize_data );

            // Styles
            wp_enqueue_style( 'whb-frontend-styles', DEEP_ASSETS_URL . 'css/frontend/header-builder/header-builder.css', array(), WHB::VERSION );

            if( WHB_Multilanguage::language() ) {
                $frontendComponents = get_option( WHB_Multilanguage::language() . '_whb_data_frontend_components' );
            } else {
                $frontendComponents = get_option( 'whb_data_frontend_components' );
            }

            $used_components = [];
            if( $frontendComponents ) {
                foreach ( $frontendComponents as $ed => $views ) {
                    foreach ( $views as $fg => $locations ) {
                        foreach ( $locations as $hj => $settings ) {
                            foreach ( $settings as $ty => $setting ) {
                                if( is_array( $setting ) ) {
                                    foreach ( $setting as $we => $element ) {
                                        if( 'name' == $we ) {
                                            $used_components[$element] = $element;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            if( $used_components ) {
                foreach ( $used_components as $style ) {
                    if ( $style == 'date' ) {
                        continue;
                    }

                    if ( $style == 'search' || $style == 'contact' || $style == 'booking-form' ) {
                        wp_enqueue_script( 'deep-content-toggle', DEEP_ASSETS_URL . 'js/frontend/plugins/content-toggle.js', array( 'jquery' ), DEEP_VERSION, true );
                    }

                    if ( $style == 'map' || $style == 'contact' || $style == 'login' || $style == 'social' ) {
                        wp_enqueue_script( 'deep-magnific-popup', DEEP_ASSETS_URL . 'js/frontend/plugins/magnific-popup.js', array( 'jquery' ), DEEP_VERSION, true );
                        wp_enqueue_style( 'deep-magnific-popup', DEEP_ASSETS_URL . 'css/frontend/plugins/magnific-popup.css', false, DEEP_VERSION );
                    }

                    if ( $style == 'login' ) {
                        wp_enqueue_script( 'deep-social-login', DEEP_ASSETS_URL . 'js/frontend/deep-social-login.js', array( 'jquery' ), DEEP_VERSION, true );
                    }

                    wp_enqueue_style( 'whb-' . $style, DEEP_ASSETS_URL . 'css/frontend/header-builder/' . $style . '.css', array( 'whb-frontend-styles' ), WHB::VERSION );
                    wp_enqueue_script( 'whb-' . $style, DEEP_ASSETS_URL . 'js/frontend/header-builder/' . $style . '.js', array( 'jquery', 'whb-frontend-scripts' ), WHB::VERSION, true );
                }
            }
        }

        /**
         * Enqueue frontend inline styles.
         *
         * @since	1.0.0
         */
        public function frontend_inline_styles() {

            // wp_enqueue_style( 'whb-dynamic-styles', WHB_Helper::get_file_uri( 'assets/src/frontend/dynamic-styles.css' ), array(), WHB::VERSION );
            // wp_add_inline_style( 'whb-dynamic-styles', WHB_Helper::get_dynamic_styles() );

        }

    }

endif;
