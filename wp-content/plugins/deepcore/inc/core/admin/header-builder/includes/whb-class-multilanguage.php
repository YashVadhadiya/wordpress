<?php
/**
 * Header Builder - Enqueue Class.
 *
 * @author  Webnus
 */

// don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

if ( ! class_exists( 'WHB_Multilanguage' ) ) :

	class WHB_Multilanguage {

		/**
		 * Instance of this class.
		 *
		 * @since   1.0.0
		 * @access  private
		 * @var     WHB_Multilanguage
		 */
		private static $instance;

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
		 * @since   1.0.0
		 */
		public function __construct() {
			if ( ! function_exists( 'pll_languages_list' ) || ! function_exists( 'icl_get_languages' ) ) {
				return;
			}
			add_action( 'init', array( $this, 'add_languages_option' ) );
		}

		/**
		 * update options.
		 *
		 * @since   3.3.5
		 */
		public function add_languages_option() {
			$whb_data_components          = get_option( 'whb_data_components' );
			$whb_data_editor_components   = get_option( 'whb_data_editor_components' );
			$whb_data_frontend_components = get_option( 'whb_data_frontend_components' );
			$whb_styles 				  = get_option( 'whb_styles' );
			if ( function_exists( 'pll_languages_list' ) ) {
				foreach ( pll_languages_list() as $lang ) {
					if ( get_option( $lang . '_whb_data_components' ) == false ) {
						update_option( $lang . '_whb_data_components', $whb_data_components );
					}
					if ( get_option( $lang . '_whb_data_editor_components' ) == false ) {
						update_option( $lang . '_whb_data_editor_components', $whb_data_editor_components );
					}
					if ( get_option( $lang . '_whb_data_frontend_components' ) == false ) {
						update_option( $lang . '_whb_data_frontend_components', $whb_data_frontend_components );
					}
					if ( get_option( $lang . '_whb_styles' ) == false ) {
						update_option( $lang . '_whb_styles', $whb_styles );
					}
				}
			}
			if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
				foreach ( icl_get_languages() as $lang ) {
					if ( get_option( $lang['language_code'] . '_whb_data_components' ) == false ) {
						update_option( $lang['language_code'] . '_whb_data_components', $whb_data_components );
					}
					if ( get_option( $lang['language_code'] . '_whb_data_editor_components' ) == false ) {
						update_option( $lang['language_code'] . '_whb_data_editor_components', $whb_data_editor_components );
					}
					if ( get_option( $lang['language_code'] . '_whb_data_frontend_components' ) == false ) {
						update_option( $lang['language_code'] . '_whb_data_frontend_components', $whb_data_frontend_components );
					}
					if ( get_option( $lang['language_code'] . '_whb_styles' ) == false ) {
						update_option( $lang['language_code'] . '_whb_styles', $whb_styles );
					}
				}
			}
		}

		/**
		 * Get languages
		 *
		 * @since 3.3.5
		 */
		public function get_languages() {
			if ( function_exists( 'pll_languages_list' ) || defined( 'WPML_PLUGIN_BASENAME' ) ) {
				$out  = '<div class="whb-languages-wrap">';
				$out .= '<div class="whb-lang-container">';
				$out .= '<i class="ti-world"></i>';
				$out .= '<span>' . __( 'Select Language', 'deep' ) . '</span>';
				$out .= '<select class="whb-languages">';
				if ( function_exists( 'pll_languages_list' ) ) {
					foreach ( pll_languages_list() as $lang ) {
						$out .= '<option class="language" ' . selected( self::language(), $lang, false ) . ' value="' . $lang . '">' . $lang . '</li>';
					}
				} elseif ( function_exists( 'icl_get_languages' ) ) {
					foreach ( icl_get_languages() as $lang ) {
						$out .= '<option class="language" ' . selected( self::language(), $lang['code'], false ) . ' value="' . $lang['code'] . '">' . $lang['code'] . '</li>';
					}
				}
				$out .= '</select>';
				$out .= '</div>';
				$out .= '</div>';
				return $out;
			}
		}

		 /**
		  * Get languages
		  *
		  * @since 3.3.5
		  */
		public static function language() {
			if ( WHB_Helper::is_frontend_builder() ) {
				if ( isset( $_REQUEST['page'] ) && isset( $_REQUEST['lang'] ) && $_REQUEST['page'] == 'webnus_header_builder' ) {
					return $_REQUEST['lang'];
				} elseif ( function_exists( 'pll_default_language' ) ) {
					return pll_default_language();
				} elseif ( defined( 'ICL_LANGUAGE_CODE' ) ) {
					return ICL_LANGUAGE_CODE;
				}
			} else {
				if ( function_exists( 'pll_current_language' ) ) {
					return pll_current_language( 'slug' );
				} elseif ( function_exists( 'pll_default_language' ) ) {
					return pll_default_language();
				} elseif ( defined( 'ICL_LANGUAGE_CODE' ) ) {
					return ICL_LANGUAGE_CODE;
				}
			}
		}

		/**
		 * Get frontend builder iframe source
		 *
		 * @since 3.3.5
		 */
		public function iframe_source() {
			if ( self::language() ) {
				if ( function_exists( 'pll_home_url' ) ) {
					return pll_home_url();
				} elseif ( function_exists( 'icl_get_languages' ) ) {
					return apply_filters( 'wpml_home_url', get_option( 'home' ) );
				}
			} else {
				return get_home_url();
			}
		}
	}

endif;
