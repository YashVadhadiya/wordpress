<?php
/**
 * Custom Controls
 *
 * @package Signify
 */

/**
 * Add Custom Controls
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function signify_custom_controls( $wp_customize ) {
	// Custom control for Important Links.
	class Signify_Important_Links_Control extends WP_Customize_Control {
		public $type = 'important-links';

		public function render_content() {
			// Add Theme instruction, Support Forum, Changelog, Donate link, Review, Facebook, Twitter, Google+, Pinterest links.
			$important_links = array(
				'theme_instructions' => array(
					'link'  => esc_url( 'https://themepalace.com/instructions/themes/signify/' ),
					'text'  => esc_html__( 'Theme Instructions', 'signify' ),
					),
				'support' => array(
					'link'  => esc_url( 'https://themepalace.com/forum/free-themes/signify/' ),
					'text'  => esc_html__( 'Support Forum', 'signify' ),
					),
				'facebook' => array(
					'link'  => esc_url( 'https://www.facebook.com/wenthemes/' ),
					'text'  => esc_html__( 'Facebook', 'signify' ),
					),
				'twitter' => array(
					'link'  => esc_url( 'https://twitter.com/wenthemes/' ),
					'text'  => esc_html__( 'Twitter', 'signify' ),
					),
				'instagram' => array(
					'link'  => esc_url( 'https://www.instagram.com/wenthemes/' ),
					'text'  => esc_html__( 'Instagram', 'signify' ),
					),
			);

			foreach ( $important_links as $important_link ) {
				echo '<p><a target="_blank" href="' . $important_link['link'] . '" >' . $important_link['text'] . ' </a></p>';
			}
		}
	}

	// Custom control for dropdown category multiple select.
	class Signify_Multi_Cat extends WP_Customize_Control {
		public $type = 'dropdown-categories';

		public function render_content() {
			$dropdown = wp_dropdown_categories(
				array(
					'name'             => $this->id,
					'echo'             => 0,
					'hide_empty'       => false,
					'show_option_none' => false,
					'hide_if_empty'    => false,
					'show_option_all'  => esc_html__( 'All Categories', 'signify' ),
				)
			);

			$dropdown = str_replace( '<select', '<select multiple = "multiple" style = "height:150px;" ' . $this->get_link(), $dropdown );

			printf(
				'<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
				$this->label,
				$dropdown
			);

			echo '<p class="description">' . esc_html__( 'Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.', 'signify' ) . '</p>';
		}
	}

	// Custom control for any note, use label as output description.
	class Signify_Note_Control extends WP_Customize_Control {
		public $type = 'description';

		public function render_content() {
			echo '<h2 class="description">' . $this->label . '</h2>';
		}
	}

	/**
	 * Upsell section.
	 *
	 * @since 0.1
	 */
	class Signify_Customize_Section_Upsell extends WP_Customize_Section {

		/**
		 * The type of customize section being rendered.
		 *
		 * @since 0.1
		 * @access public
		 * @var    string
		 */
		public $type = 'upsell';

		/**
		 * Custom button text to output.
		 *
		 * @since 0.1
		 * @access public
		 * @var    string
		 */
		public $pro_text = '';

		/**
		 * Custom pro button URL.
		 *
		 * @since 0.1
		 * @access public
		 * @var    string
		 */
		public $pro_url = '';

		/**
		 * Add custom parameters to pass to the JS via JSON.
		 *
		 * @since 0.1
		 * @access public
		 * @return string
		 */
		public function json() {
			$json = parent::json();

			$json['pro_text'] = $this->pro_text;
			$json['pro_url']  = esc_url( $this->pro_url );

			return $json;
		}

		/**
		 * Outputs the Underscore.js template.
		 *
		 * @since 0.1
		 * @access public
		 * @return void
		 */
		protected function render_template() {
			?>
			<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
				<h3 class="accordion-section-title">
					{{ data.title }}

					<# if ( data.pro_text && data.pro_url ) { #>
						<a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
					<# } #>
				</h3>
			</li>
			<?php
		}
	}

}
add_action( 'customize_register', 'signify_custom_controls', 1 );

