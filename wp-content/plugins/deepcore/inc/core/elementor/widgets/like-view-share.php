<?php
namespace Elementor;

class Webnus_Element_Widgets_Like_View_Share extends \Elementor\Widget_Base {

	/**
	 * Retrieve Like View Share widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'lvs';

	}

	/**
	 * Retrieve Like View Share widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Like View Share', 'deep' );

	}

	/**
	 * Retrieve Like View Share widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-facebook-like-box';

	}

	/**
	 * Set widget category.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget category.
	 */
	public function get_categories() {

		return [ 'webnus' ];


	}
	/**
	 * enqueue JS
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_script_depends() {

		return [ 'deep-like-button' ];

	}

	/**
	 * enqueue CSS
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'deep-like', 'wn-deep-lvs' ];

	}

	/**
	 * Register Like View Share widget controls.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'General', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);
		$this->add_control(
			'display_like',
			[
				'label' 		=>  esc_html__( 'Display Like?', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=>  esc_html__( 'Yes', 'deep' ),
				'label_off' 	=>  esc_html__( 'No', 'deep' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);
		$this->add_control(
			'display_view',
			[
				'label' 		=>  esc_html__( 'Display View?', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=>  esc_html__( 'Yes', 'deep' ),
				'label_off' 	=>  esc_html__( 'No', 'deep' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);
		$this->add_control(
			'display_share',
			[
				'label' 		=>  esc_html__( 'Display Share?', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=>  esc_html__( 'Yes', 'deep' ),
				'label_off' 	=>  esc_html__( 'No', 'deep' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'classid_section',
			[
				'label' => esc_html__( 'Class & ID', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'shortcodeclass',
			[
				'label'	=>  esc_html__( 'Extra Class', 'deep' ),
				'type'	=> \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'shortcodeid',
			[
				'label'	=>  esc_html__( 'ID', 'deep' ),
				'type'	=> \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'custom_css_section',
			[
				'label' => __( 'Custom CSS', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'custom_css',
			[
				'label' => __( 'Custom CSS', 'deep' ),
				'type' => \Elementor\Controls_Manager::CODE,
				'language' => 'css',
				'rows' => 20,
				'show_label' => true,
			]
		);
		$this->end_controls_section();

	}

	/**
	 * Render Like View Share widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$shortcodeclass 			= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
		$shortcodeid					= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';

		ob_start();

		if ( $settings['display_like'] == 'yes' || $settings['display_view'] == 'yes' || $settings['display_share'] == 'yes' ) {
			echo '<div class="wn-lvs-shortcode-wrap ' . $shortcodeclass . '"  ' . $shortcodeid . '>';
		}

			if ( $settings['display_like'] == 'yes' ) {
				echo '<div class="wn-like-shortcode">';
				if ( function_exists('get_simple_likes_button') ) {
					echo get_simple_likes_button( get_the_ID() );
				}
				echo '</div>';
			}

			if ( $settings['display_view'] == 'yes' ) {
				echo '<div class="wn-view-shortcode">';
				echo '<div class="wn-view-shortcode-count">' . deep_getViews( get_the_ID() ) . '</div>';
				echo '<div class="wn-view-shortcode-icon"><i class="icon-basic-eye"></i></div>';
				echo '</div>';
			}

			if ( $settings['display_share'] == 'yes' ) {
				$dashed_title	=  sanitize_title_with_dashes ( get_the_title(get_the_ID()) );
				$post_id		= get_the_ID();
				echo '<div class="wn-share-shortcode">';
				echo '<div class="wn-share-shortcode-icon hcolorb hcolorr"><i class="sl-share share"></i></div>';
				echo '<div class="wn-share-shortcode-dropdown">';
				echo '<div class="socialfollow">
						<a target="_blank" class="facebook hcolorf" href="https://www.facebook.com/sharer.php?m2w&s=100&p[url]='. get_the_permalink($post_id).'&p[images][0]='. get_the_post_thumbnail_url( $post_id, 'full' ) .'">' . esc_html__( 'FACEBOOK', 'deep' ) . '</a>
						<a target="_blank" class="google hcolorf" href="https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url='. get_the_permalink($post_id) .'">' . esc_html__( 'GOOGLE+', 'deep' ) . '</a>
						<a target="_blank" class="twitter hcolorf" href="https://twitter.com/intent/tweet?original_referer='. get_the_permalink($post_id) .'&amp;text='. esc_html( $dashed_title ) .'&amp;tw_p=tweetbutton&amp;url='. get_the_permalink($post_id) .'">' . esc_html__( 'TWITTER', 'deep' ) . '</a>
						<a target="_blank" class="linkedin hcolorf" href="https://www.linkedin.com/shareArticle?mini=true&url='. get_the_permalink($post_id) .'&title='. get_the_title($post_id) .'&source=LinkedIn">' . esc_html__( 'LINKEDIN', 'deep' ) . '</a>
						<a target="_blank" class="email hcolorf" href="mailto:?subject='. esc_html( $dashed_title ) .'&amp;body='. get_the_permalink($post_id) .'">' . esc_html__( 'MAIL', 'deep' ) . '</a>
					</div>';
				echo '</div>';
				echo '</div>';
			}
		if ( $settings['display_like'] == 'yes' || $settings['display_view'] == 'yes' || $settings['display_share'] == 'yes' ) {
			echo '</div>';
		}

		$out = ob_get_contents();
	  ob_end_clean();

		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}
		echo $out;
	}

}
