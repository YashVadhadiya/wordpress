<?php
namespace Elementor;

class Webnus_Element_Widgets_Login extends \Elementor\Widget_Base {

	/**
	 * Retrieve Login widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'login';

	}

	/**
	 * Retrieve Login widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Login', 'deep' );

	}

	/**
	 * Retrieve Login widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-lock-user';

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
	 * widget styles.
	 *
	 * @since 4.2.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'wn-deep-login-box' ];

	}

	/**
	 * enqueue JS
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_script_depends() {

		return [ 'deep-social-login' ];

	}

	/**
	 * Register Login widget controls.
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
			'img',
			[
				'label' 	=>  esc_html__( 'Image', 'deep' ),
				'type' 		=> \Elementor\Controls_Manager::MEDIA,
				'default' 	=> [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'description' =>  esc_html__( 'Login Image', 'deep' ),
			]
		);
		$this->add_control(
			'title',
			[
				'label'	=>	 esc_html__( 'Title', 'deep' ),
				'type'	=> \Elementor\Controls_Manager::TEXT,
				'description'	=>  esc_html__( 'Enter the title', 'deep'),
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label'	=>	 esc_html__( 'Subitle', 'deep' ),
				'type'	=> \Elementor\Controls_Manager::TEXT,
				'description'	=>  esc_html__( 'Enter the subtitle', 'deep'),
			]
		);

		$this->add_control(
			'bpcontent',
			[
				'label'	=>	 esc_html__( 'Content', 'deep' ),
				'type'	=> \Elementor\Controls_Manager::TEXTAREA,
				'description'	=>  esc_html__( 'Enter the Content', 'deep'),
			]
		);

		// $this->add_control(
		// 	'bottom_text',
		// 	[
		// 		'label' 		=>  esc_html__( 'Hide login with Facebook or Google + ?', 'deep' ), //heading
		// 		'type' 			=> \Elementor\Controls_Manager::SWITCHER,
		// 		'label_on' 		=>  esc_html__( 'Yes', 'deep' ),
		// 		'label_off' 	=>  esc_html__( 'No', 'deep' ),
		// 		'return_value' 	=> 'yes',
		// 		'default' 		=> 'yes',
		// 	]
		// );

    $this->end_controls_section();

		// Class & ID Tab
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

		// Style
		$this->start_controls_section(
			'section_box_style',
			[
				'label' => __( 'Box Style', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'box_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' , 'gradient' ],
				'selector' => '#wrap {{WRAPPER}} .wp-sh-login',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wp-sh-login',
			]
		);

		$this->add_control(
			'box_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wp-sh-login' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'box_shadow',
					'label' => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .wp-sh-login',
				]
		);

		$this->add_control(
			'box_padding',
			[
				'label' 		=> __( 'Padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPERwrap
					}} .wp-sh-login' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'box_margin',
			[
				'label' 		=> __( 'Margin', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wp-sh-login' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
	 * Render Login widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		wp_enqueue_style( 'wn-deep-login-box', DEEP_ASSETS_URL . 'css/frontend/login-box/login-box.css' );

		$shortcodeclass		= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
		$shortcodeid		= $settings['shortcodeid'] ? ' id=' . $settings['shortcodeid'] . '' : '';

		ob_start();

		if ( $settings['img'] ) {
			$image_id = $settings['img']['id'];
			$img = $settings['img']['url'];
		}
		?>

			<div class="wp-sh-login <?php echo esc_attr( $shortcodeclass ); ?>" <?php echo esc_attr( $shortcodeid ); ?> >
				<?php

				if ( ! is_user_logged_in() ) {

					echo !empty( $img ) ? '<div class="wp-login-logo">': '';
						echo !empty( $img ) ? '<img src="' . $img . '" class="img-responsive">': '';
					echo !empty( $img ) ? '</div>': '';
					echo !empty( $settings['title'] ) || !empty( $settings['subtitle'] )  ? '<div class="wp-login-title">': '';
						echo !empty( $settings['title'] ) || !empty( $settings['subtitle'] ) ? '<h2 class="login-title"> ' . $settings['title'] . ' <span class="colorf"> '. $settings['subtitle'] .' </span></h2>': '';
					echo !empty( $settings['title'] ) || !empty( $settings['subtitle'] ) ? '</div>': '';

					echo !empty( $settings['bpcontent'] ) ? '<div class="wp-login-content">': '';
						echo !empty( $settings['bpcontent'] ) ? '<p class="login-content"> ' . $settings['bpcontent'] . ' </p>': '';
					echo !empty( $settings['bpcontent'] ) ? '</div>': '';

				}

				echo '<div class="wp-inner-login">';

					if ( function_exists('deep_login') ) {
						deep_login();
					}

				echo '</div>';
				?>

			 </div>

		<?php
		$out = ob_get_contents();
		ob_end_clean();

		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}

		echo $out;
	}

}
