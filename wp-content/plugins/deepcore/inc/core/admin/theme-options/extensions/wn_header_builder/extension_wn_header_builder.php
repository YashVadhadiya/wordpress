<?php
/**
 * Header Builder - ReduxFramework Extention.
 *
 * @author Webnus
 */

// don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

if ( ! class_exists( 'ReduxFramework_extension_wn_header_builder' ) ) {

    /**
     * Main ReduxFramework wn_header_builder extension class
     *
     * @since       1.0.0
     */
    class ReduxFramework_extension_wn_header_builder {

        // Protected vars
        public static $instance;
        protected $parent;
        public $extension_url;
        public $extension_dir;

        /**
         * Class Constructor. Defines the args for the extions class
         *
         * @since       1.0.0
         * @access      public
         * @param       array $sections Panel sections.
         * @param       array $args Class constructor arguments.
         * @param       array $extra_tabs Extra panel tabs.
         * @return      void
         */
        public function __construct( $parent ) {
            
            $this->parent = $parent;

            if ( empty( $this->extension_dir ) ) {
                $this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
            }

            $this->field_name = 'wn_header_builder';

            self::$instance = $this;

            add_filter( 'redux/'.$this->parent->args['opt_name'].'/field/class/'.$this->field_name, array( &$this, 'overload_field_path' ) ); // Adds the local field

        }

        public static function get_instance() {
            return self::$instance;
        }

        // Forces the use of the embeded field path vs what the core typically would use    
        public function overload_field_path( $field ) {
            return dirname(__FILE__).'/'.$this->field_name.'/field_'.$this->field_name.'.php';
        }

    }

}
