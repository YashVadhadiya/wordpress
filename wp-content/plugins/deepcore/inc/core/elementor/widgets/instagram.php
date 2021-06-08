<?php
namespace Elementor;

class Webnus_Element_Widgets_Instagram extends \Elementor\Widget_Base {

	/**
	 * Retrieve Alert widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'instagram';

	}

	/**
	 * Retrieve Alert widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Instagram', 'deep' );

	}

	/**
	 * Retrieve Alert widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'fa fa-instagram';

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
	public function get_style_depends() {

		return [ 'deep-owl-carousel', 'wn-deep-instagram' ];

	}

	/**
	 * enqueue JS
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_script_depends() {

		return [ 'deep-owl-carousel', 'deep-instagram' ];

	}


	/**
	 * Register Alert widget controls.
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
			'type',
			[
				'label' 	=> esc_html__( 'Type', 'deep' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> 'default',
				'options' 	=> [
					'default'  		=> esc_html__( 'Default', 'deep' ),
					'carousel'  	=> esc_html__( 'Carousel', 'deep' ),
					'grid'  		=> esc_html__( 'Grid', 'deep' ),
				],
			]
		);
		$this->add_control(
			'access_token',
			[
				'label' 		=> esc_html__( 'TOKEN', 'deep' ),
				'type' 			=> Controls_Manager::TEXTAREA,
			]
		);
		$this->add_control(
			'postnumber',
			[
				'label'   => esc_html__( 'Number Of Post', 'your-plugin' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 9,
				'min'     => 1,
				'max'     => 30,
				'step'    => 1,
			]
		);
        $this->end_controls_section();

		$this->start_controls_section(
			'classid_section',
			[
				'label' => __( 'Class & ID', 'deep' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'shortcodeclass',
			[
				'label'	=> esc_html__( 'Extra Class', 'deep' ),
				'type'	=> Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'shortcodeid',
			[
				'label'	=> esc_html__( 'ID', 'deep' ),
				'type'	=> Controls_Manager::TEXT,
			]
		);
		$this->end_controls_section();

		// Custom css tab
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
	 * Render Alert widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

        $settings = $this->get_settings_for_display();
		$type     = $settings['type'];
		$token    = $settings['access_token'];
		$limit    = $settings['postnumber'];

        // Class & ID
        $shortcodeclass = $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
		$shortcodeid	= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';

		$image_count = 0;

		if ( $token ) {
			$img_data = deep_theme_instagram($token);
			$images = json_decode($img_data['body']);
			?>

			<div class="instagram-feed <?php echo esc_attr( $type ); ?>  <?php echo esc_attr( $shortcodeclass ); ?>" <?php echo esc_attr( $shortcodeid ); ?>>
				<div class="instagram-wrap">
				<?php

				switch ( $type ) :
					case 'default':
						echo '<ul>';
						foreach($images->data as $content) {
							$image_count++;

							echo '<li><a href="'. esc_url( $content->permalink ) .'"><img src="' . esc_url( $content->media_url ) .'"/></a></li>';

							if ( $image_count >= $limit) {
								break;
							}

						}
						echo '</ul>';

					break;

					case 'carousel':
						echo '<div class="owl-carousel-instagram owl-carousel owl-theme">';
							foreach($images->data as $content) {
								$image_count++;
								$username = $content->username;
								echo '<li><a href="'. esc_url( $content->permalink ) .'"><img src="' . esc_url( $content->media_url ) .'"/></a></li>';

								if ( $image_count >= $limit) {
									break;
								}

							}
						echo '</div>';
						echo '<div class="instagram-text"><i class="wn-fab wn-fa-instagram"></i> Follow us <a href="http://instagram.com/' . $username . '">@' . $username .  '</a></div>';
					break;

					case 'grid':
						echo '<ul>';
						foreach($images->data as $content) {
							$image_count++;

							echo '<li><a href="'. esc_url( $content->permalink ) .'"><img src="' . esc_url( $content->media_url ) .'"/></a></li>';

							if ( $image_count >= $limit) {
								break;
							}

						}
						echo '</ul>';
					break;

				endswitch;

				?>

					<div class="clear"></div>
				</div>
			</div>

			<?php

		}

		$custom_css = $settings['custom_css'];
		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}

	}

}
