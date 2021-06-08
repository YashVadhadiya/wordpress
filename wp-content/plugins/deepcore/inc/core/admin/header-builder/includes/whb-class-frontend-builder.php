<?php
/**
 * Header Builder - Frontend Builder Class.
 *
 * @author  Webnus
 */

// don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

if ( ! class_exists( 'WHB_Frontend_Builder' ) ) :
    class WHB_Frontend_Builder {

		/**
		 * Instance of this class.
         *
		 * @since	1.0.0
		 * @access	private
		 * @var		WHB_Frontend_Builder
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
			if ( ! WHB_Helper::is_frontend_builder() ) {
				return;
			}

			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
			add_filter( 'admin_body_class', array( $this, 'admin_body_class' ) );
			add_action( 'admin_init', array( $this, 'render' ) );
			add_filter('show_admin_bar', '__return_false');
		}

		/**
		 * Register Stylesheets and JavaScripts.
		 *
		 * @since	1.0.0
		 */
		public function admin_enqueue_scripts() {
			wp_enqueue_media();

			// Editor scripts
			if ( WHB_Multilanguage::language() ) {
				$localize_data = array(
					'nonce'                 => wp_create_nonce( 'whb-nonce' ),
					'ajaxurl'               => admin_url( 'admin-ajax.php', 'relative' ),
					'assets_url'            => WHB_Helper::get_file_uri( 'assets/' ),
					'widgets_assets_url'	=> DEEP_ASSETS_URL . 'css/frontend/header-builder/' ,
					'prebuilds_url'         => 'https://webnus.biz/api/deep-prebuilds-headers/headers/',
					'components'            => get_option( WHB_Multilanguage::language() . '_whb_data_components' ),
					'editor_components'     => get_option( WHB_Multilanguage::language() . '_whb_data_editor_components' ),
					'frontend_components'   => get_option( WHB_Multilanguage::language() . '_whb_data_frontend_components' ),
				);
			} else {
				$localize_data = array(
					'nonce'                 => wp_create_nonce( 'whb-nonce' ),
					'ajaxurl'               => admin_url( 'admin-ajax.php', 'relative' ),
					'assets_url'            => WHB_Helper::get_file_uri( 'assets/' ),
					'widgets_assets_url'	=> DEEP_ASSETS_URL . 'css/frontend/header-builder/' ,
					'prebuilds_url'         => 'https://webnus.biz/api/deep-prebuilds-headers/headers/',
					'components'            => get_option( 'whb_data_components' ),
					'editor_components'     => get_option( 'whb_data_editor_components' ),
					'frontend_components'   => get_option( 'whb_data_frontend_components' ),
				);
			}
			wp_enqueue_script( 'wp-color-picker-alpha', DEEP_ASSETS_URL . 'js/libraries/wp-color-picker-alpha.js', array( 'wp-color-picker' ), WHB::VERSION );
			wp_enqueue_script( 'whb-editor-scripts', DEEP_ASSETS_URL . 'js/backend/whb-editor.js', array( 'jquery', 'jquery-ui-sortable', 'jquery-ui-droppable', 'wp-color-picker', 'deep-nicescroll-script' ), WHB::VERSION );
			wp_localize_script( 'whb-editor-scripts', 'whb_localize', $localize_data );
			wp_enqueue_style( 'whb-redux-styles', WHB_Helper::get_file_uri( 'assets/src/editor/css/redux-admin.css' ), WHB::VERSION, true );
			wp_enqueue_style( 'whb-editor-styles', DEEP_ASSETS_URL . 'css/backend/whb-editor.css', false, DEEP_VERSION );
		}

		/**
		 * Register hidden page in WP Admin.
		 *
		 * Create /wp-admin/admin.php?page=webnus_header_builder page.
		 * Page has no menu item in WP Admin Panel.
		 *
		 * @since	1.0.0
		 */
		public function admin_body_class($classes) {
			return $classes . ' whb-frontend-builder-wrap ';
		}

		/**
		 * Render.
		 *
		 * @since	1.0.0
		 */
		public function render() {
			ob_start();

			// WordPress Administration Bootstrap
			require_once( ABSPATH . 'wp-admin/admin.php' );
			include( ABSPATH . 'wp-admin/admin-header.php' );

			// Stupid hack for Wordpress alerts and warnings
			echo '<div class="wrap" style="height:0;overflow:hidden;"><h2></h2></div>';

			// Homepage iframe
			echo '<iframe name="whbIframe" id="whbIframe" src="' . WHB_Multilanguage::get_instance()->iframe_source() . '" style="border: 0; width: 100%; height: 100%"></iframe>';

			// Editor
			WHB_Helper::get_template( WHB::FILE_PREFIX . 'editor.tpl.php' );

			// Enqueue editor scripts
			wp_print_scripts( 'whb-editor-scripts' );

			include( ABSPATH . 'wp-admin/admin-footer.php' );
			return;
		}

	}
endif;
