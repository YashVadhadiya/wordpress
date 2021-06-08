<?php
/**
 * Header Builder - ReduxFramework Extention (Field Render Class).
 *
 * @author Webnus
 */

// don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

if ( ! class_exists( 'ReduxFramework_wn_header_builder' ) ) {

	/**
	 * Main ReduxFramework_wn_header_builder class
	 *
	 * @since	1.0.0
	 */
	class ReduxFramework_wn_header_builder extends ReduxFramework {

		public $parent;
		public $field;
		public $value;
		public $args;
		public $repeater_values	= '';
		public $extension_dir	= '';
		public $extension_url	= '';

		/**
		 * Field Constructor.
		 *
		 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
		 *
		 * @since	1.0.0
		 * @access	public
		 * @return	void
		 */
		function __construct( $field = array(), $value ='', $parent ) {

			// Set required variables
			$this->parent	= $parent;
			$this->field	= $field;
			$this->value	= $value;
			$this->args		= $parent->args;

			// Set extension dir & url
			if ( empty( $this->extension_dir ) ) {
				$this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
				$this->extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->extension_dir ) );
			}

			// Set default args for this field to avoid bad indexes. Change this to anything you use.
			$defaults = array(
				'options'			=> array(),
				'stylesheet'		=> '',
				'output'			=> true,
				'enqueue'			=> true,
				'enqueue_frontend'	=> true
			);

			$this->field = wp_parse_args( $this->field, $defaults );

		}

		/**
		 * Field Render Function.
		 *
		 * Takes the vars and outputs the HTML for the field in the settings
		 *
		 * @since	1.0.0
		 * @access	public
		 * @return	void
		 */
		public function render() {

			WHB_Helper::get_template( WHB::FILE_PREFIX . 'editor.tpl.php' );

		}

		/**
		 * Enqueue Function.
		 *
		 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
		 *
		 * @since	1.0.0
		 * @access	public
		 * @return	void
		 */
		public function enqueue() {}

		/**
		 * Output Function.
		 *
		 * Used to enqueue to the front-end
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		public function output() {

			if ( $this->field['enqueue_frontend'] ) {

			}

		}

	}

}
