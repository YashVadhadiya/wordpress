<?php
/**
 * Header Builder - Helper methods.
 *
 * @author Webnus
 */

// don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

if ( ! class_exists( 'WHB_Helper' ) ) :
    class WHB_Helper {

		/**
		 * Instance of this class.
         *
		 * @since	1.0.0
		 * @access	private
		 * @var		WHB_Helper
		 */
		private static $instance;

        /**
         * Hold elements.
         *
         * @since	1.0.0
         * @var		array
         */
        private static $elements = array();

        /**
         * Hold dynamic styles.
         *
         * @since	1.0.0
         * @var		string
         */
        private static $dynamic_styles = '';

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
         * Add element.
         *
         * @since	1.0.0
         */
        public static function add_element( $id, $func_name ) {
            if ( empty( $id ) ) {
                return;
            }
            self::$elements[ $id ] = $func_name;
        }

        /**
         * Get elements.
         *
         * @since	1.0.0
         */
        public static function get_elements() {
            return self::$elements;
        }

        /**
         * Set dynamic styles.
         *
         * @since	1.0.0
         */
        public static function set_dynamic_styles( $styles ) {
            global $wp_filesystem;
            if ( empty( $styles ) ) {
                return;
            }
            if ( empty( $wp_filesystem ) ) {
                require_once (ABSPATH . '/wp-admin/includes/file.php');
                WP_Filesystem();
            }
            self::$dynamic_styles .= $styles;
            $dynamic_style_path =  DEEP_ASSETS_DIR . "css/frontend/dynamic-style/header.dyn.css";
            $wp_filesystem->put_contents( $dynamic_style_path, str_replace(
				array( "\r\n", "\r", "\n", "\t", '    ' ),
				'',
				preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '',  self::$dynamic_styles )
			), 0644 );
        }

        /**
         * Get dynamic styles.
         *
         * @since	1.0.0
         */
        public static function get_dynamic_styles() {
            global $wp_filesystem;
            if ( empty( $wp_filesystem ) ) {
                require_once (ABSPATH . '/wp-admin/includes/file.php');
                WP_Filesystem();
            }
            $dynamic_style_path = DEEP_ASSETS_DIR . "css/frontend/dynamic-style/header.dyn.css";
            $dynamic_styles     = str_replace(
                array( "\r\n", "\r", "\n", "\t", '    ' ),
                '',
                preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '',  $wp_filesystem->get_contents( $dynamic_style_path ) )
            );
            return $dynamic_styles;
        }

		/**
         * Sanatize CSS value.
         *
         * @since	1.0.0
         */
        public static function css_sanatize( $css_value ) {
            if ( is_numeric( $css_value ) ) :
                return $css_value . 'px';
            endif;
            return $css_value;
        }

        /**
		 * Get file.
		 *
		 * @since	1.0.0
		 */
		public static function get_file( $path ) {
            return WHB::get_path() . $path;
        }

		/**
         * Get file (uri).
		 *
         * @since	1.0.0
		 */
        public static function get_file_uri( $path ) {
            return WHB::get_url() . $path;
        }

        /**
         * Used to select the proper template.
         *
         * @since	1.0.0
         */
        public static function get_template( $file ) {
            if ( empty( $file ) ) {
                return;
            }
			$path = self::get_file( 'includes/templates/' . $file );
			require_once $path;
        }

        /**
         * Used to check if current page is WEBNUS Frontend Header Builder.
         *
         * @since	1.0.0
         */
        public static function is_frontend_builder() {
			return is_admin() && isset( $_GET['page'] ) &&  $_GET['page'] == 'webnus_header_builder' ? true : false;
		}

        /**
         * Combine user attributes with known attributes and fill in defaults when needed.
         *
         * The pairs should be considered to be all of the attributes which are
         * supported by the caller and given as a list. The returned attributes will
         * only contain the attributes in the $pairs list.
         *
         * If the $atts list has unsupported attributes, then they will be ignored and
         * removed from the final returned list.
         *
         * @since	1.0.0
         *
         * @param array  $pairs     Entire list of supported attributes and their defaults.
         * @param array  $atts      User defined attributes in component tag.
         * @return array Combined and filtered attribute list.
         */
        public static function component_atts( $pairs, $atts ) {
            $pairs = array_merge($pairs, $atts);
            $atts = (array)$atts;
            $out = array();

            foreach ($pairs as $name => $default) {
                if ( array_key_exists($name, $atts) )
                    $out[$name] = $atts[$name];
                else
                    $out[$name] = $default;
            }

            return $out;
        }

        /**
         * Set header default data.
         *
         * @since	1.0.0
         */
        public static function setHeaderDefaultData() {
            if ( ! class_exists( 'WHB_Multilanguage' ) ) {
                require DEEP_CORE_DIR . '/admin/header-builder/includes/whb-class-multilanguage.php';
            }
            $editor_components = WHB_Multilanguage::language() ? get_option( WHB_Multilanguage::language() . '_whb_data_editor_components' ) : get_option( 'whb_data_editor_components' );

            if ( $editor_components ) {
                return;
            }

            $platforms = array('desktop-view', 'tablets-view', 'mobiles-view');
            $editor_components = array();
            $uniqueId = uniqid();

            foreach ($platforms as $platform) {
                $platform_view = array(
                    'topbar'    => array(
                        'left'      => array(),
                        'center'    => array(),
                        'right'     => array(),
                        'settings'  => array(
                            'element'           => 'header-area',
                            'hidden_element'    => true,
                            'uniqueId'          => $uniqueId . 'tapbar',
                        ),
                    ),
                    'row1'  => array(
                        'left'      => array(
                            array(
                                "editor_icon" => "ti-image",
                                "hidden_element" => false,
                                "name" => "logo",
                                "uniqueId" => $uniqueId . 'logo',
                            )
                        ),
                        'center'    => array(),
                        'right'     => array(
                            array(
                                "editor_icon" => "ti-smallcap",
                                "hidden_element" => false,
                                "name" => "text",
                                "uniqueId" => $uniqueId . 'text',
                            )
                        ),
                        'settings'  => array(
                            'element'           => 'header-area',
                            'hidden_element'    => false,
                            'uniqueId'          => $uniqueId . 'row1',
                            'header_type'       => 'horizontal',
                        ),
                    ),
                    'row2'  => array(
                        'left'      => array(),
                        'center'    => array(),
                        'right'     => array(),
                        'settings'  => array(
                            'element'           => 'header-area',
                            'hidden_element'    => true,
                            'uniqueId'          => $uniqueId . 'row2',
                        ),
                    ),
                    'row3'  => array(
                        'left'      => array(),
                        'center'    => array(),
                        'right'     => array(),
                        'settings'  => array(
                            'element'           => 'header-area',
                            'hidden_element'    => true,
                            'uniqueId'          => $uniqueId . 'row3',
                        ),
                    ),
                );

                $editor_components[$platform] = $platform_view;
            }

            $sticky_view = array(
                'srow1'  => array(
                    'left'      => array(
                        array(
                            "editor_icon" => "ti-image",
                            "hidden_element" => false,
                            "name" => "logo",
                            "uniqueId" => uniqid() . 'logo',
                        ),
                    ),
                    'center'    => array(),
                    'right'     => array(
                        array(
                            "editor_icon" => "ti-smallcap",
                            "hidden_element" => false,
                            "name" => "text",
                            "uniqueId" => uniqid() . 'text',
                        )
                    ),
                    'settings'  => array(
                        'element'           => 'sticky-area',
                        'hidden_element'    => false,
                        'uniqueId'          => $uniqueId . 'srow1',
                    ),
                ),
                'srow2'  => array(
                    'left'      => array(),
                    'center'    => array(),
                    'right'     => array(),
                    'settings'  => array(
                        'element'           => 'sticky-area',
                        'hidden_element'    => true,
                        'uniqueId'          => $uniqueId . 'srow2',
                    ),
                ),
                'srow3'  => array(
                    'left'      => array(),
                    'center'    => array(),
                    'right'     => array(),
                    'settings'  => array(
                        'element'           => 'sticky-area',
                        'hidden_element'    => true,
                        'uniqueId'          => $uniqueId . 'srow3',
                    ),
                ),
            );
            $editor_components['sticky-view'] = $sticky_view;


            if ( WHB_Multilanguage::language() ) {
                update_option( WHB_Multilanguage::language() . '_whb_data_editor_components', $editor_components );
                update_option( WHB_Multilanguage::language() . '_whb_data_frontend_components', $editor_components );
            } else {
                update_option( 'whb_data_editor_components', $editor_components );
                update_option( 'whb_data_frontend_components', $editor_components );
            }

        }

        /**
         * Clear header data.
         *
         * @since	1.0.0
         */
        public static function clearHeaderData() {
            if ( WHB_Multilanguage::language() ) {
                delete_option( WHB_Multilanguage::language() . '_whb_data_components' );
                delete_option( WHB_Multilanguage::language() . '_whb_data_editor_components' );
                delete_option( WHB_Multilanguage::language() . '_whb_data_frontend_components' );
                delete_option( WHB_Multilanguage::language() . '_whb_styles' );
            } else {
                delete_option( 'whb_data_components' );
                delete_option( 'whb_data_editor_components' );
                delete_option( 'whb_data_frontend_components' );
                delete_option( 'whb_styles' );
            }
        }

        /**
         * Get cell components.
         *
         * @since	1.0.0
         */
        public static function getCellComponents( $editor_components, $panel, $row, $cell ) {

            if (empty($editor_components[$panel][$row][$cell])) {
                return;
            }

            $out = '';
            foreach ($editor_components[$panel][$row][$cell] as $cell_key => $el) {
                $el['hidden_element'] = $el['hidden_element'] ? 'true' : 'false';

                $out .= '
                <div class="whb-elements-item" data-element="' . esc_attr( $el['name'] ) . '" data-unique-id="' . esc_attr( $el['uniqueId'] ) . '" data-hidden_element="' . esc_attr( $el['hidden_element'] ) . '" data-editor_icon="' . esc_attr( $el['editor_icon'] ) . '">
                    <span class="whb-controls">
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Copy to Clipboard">
                            <i class="whb-control whb-copy-btn ti-files"></i>
                        </span>
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Settings">
                            <i class="whb-control whb-edit-btn sl-pencil"></i>
                        </span>
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Hide">
                            <i class="whb-control whb-hide-btn ti-eye"></i>
                        </span>
                        <span class="whb-tooltip tooltip-on-top" data-tooltip="Remove">
                            <i class="whb-control whb-delete-btn ti-close"></i>
                        </span>
                    </span>
                    <a href="#">
                        <i class="' . esc_attr( $el['editor_icon'] ) . '"></i>
                        <span class="whb-element-name">' . esc_html( ucfirst( $el['name'] ) ) . '</span>
                    </a>
                </div>
                ';
            }

            return $out;

        }

    }

endif;
