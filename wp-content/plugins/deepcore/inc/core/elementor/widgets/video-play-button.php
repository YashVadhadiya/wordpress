<?php
namespace Elementor;

class Webnus_Element_Widgets_Video_Play_Button extends \Elementor\Widget_Base {

	/**
	 * Retrieve Video Play Button widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'video_play_button';

	}

	/**
	 * Retrieve Video Play Button widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus video play button', 'deep' );

	}

	/**
	 * Retrieve Video Play Button widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-youtube';

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

		return [ 'deep-magnific-popup', 'deep-video-ply-btn' ];

	}

	/**
	 * widget styles.
	 *
	 * @since 4.2.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'deep-magnific-popup', 'wn-deep-video-play-button' ];

	}

	/**
	 * Register Video Play Button widget controls.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'video_section',
			[
				'label' 		=> esc_html__( 'Video', 'deep' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
            ]
		);
		$this->add_control(
			'video_url', //param_name
			[
				'label' 		=> esc_html__( 'Video URL', 'deep' ), //heading
				'type' 			=> Controls_Manager::TEXT,
				'show_external' => true, // Show the 'open in new tab' button.
			]
		);
		$this->add_control(
			'icon_size',
			[
				'label'   		=> esc_html__( 'Icon Size (px)', 'deep' ),
				'type'    		=> Controls_Manager::NUMBER,
				'default' 		=> 25,
				'min'     		=> 1,
				'max'     		=> 1000,
				'step'    		=> 1,
				'selectors' 	=> [
					'{{WRAPPER}} .video-play-btn-wrap i' => 'font-size: {{VALUE}}px',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' 		=> esc_html__( 'Icon Color', 'deep' ),
				'type' 			=> Controls_Manager::COLOR,
				'scheme' 		=> [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'default' 		=> '#437df9',
				'selectors' 	=> [
					'{{WRAPPER}} .video-play-btn-wrap i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_bgcolor',
			[
				'label' 		=> esc_html__( 'Icon Background', 'deep' ),
				'type' 			=> Controls_Manager::COLOR,
				'scheme' 		=> [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .video-play-btn-wrap i' => 'background-color: {{VALUE}} !important',
				],
			]
		);
        $this->end_controls_section();

		$this->start_controls_section(
			'image_section',
			[
				'label' 		=> esc_html__( 'Image Options', 'deep' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
            ]
		);
		$this->add_control(
			'img',
			[
				'label' 		=> esc_html__( 'Choose Image', 'deep' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' 		=> Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'show_alt_tag',
			[
				'label' 		=> esc_html__( 'Show Alt Tag Under Video Button', 'deep' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'on',
				'options' => [
					'on'    => [
						'title' => __( 'Yes', 'deep' ),
						'icon' => 'eicon-preview',
					],
					'off' => [
						'title' => __( 'No', 'deep' ),
						'icon' => 'eicon-close',
					],
				],
			]
		);
		$this->add_control(
			'img_alt', //param_name
			[
				'label' 		=> esc_html__( 'Image Alt', 'deep' ), //heading
				'type' 			=> Controls_Manager::TEXT, //type
				'placeholder' 	=> esc_html__( 'Type your image alt text here', 'deep' ),
				'condition' => array(
					'show_alt_tag' => array( 'on' ),
				),
			]
		);
		$this->add_control(
			'img_width',
			[
				'label'	=> esc_html__( 'Image Width', 'deep' ),
				'type'	=> Controls_Manager::SLIDER,
				'default' => [
					'size' => 320,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2500,
						'step' => 1,
					],
				],
				'size_units' => [ 'px' ],
			]
		);
		$this->add_control(
			'img_height',
			[
				'label' => esc_html__( 'Image Height', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 320,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2500,
						'step' => 1,
					],
				],
				'size_units' => [ 'px' ],
			]
		);

		// Image Alignment
		$this->add_control(
			'image_alignment',
			[
				'label' => esc_html__( 'Image Alignment', 'deep' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'deep' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'deep' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'deep' ),
						'icon' => 'fa fa-align-right',
					],
				],
			]
		);

        $this->end_controls_section();


		// Class & ID Tab
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

		// Style
		$this->start_controls_section(
			'section_box_style',
			[
				'label' => __( 'Image Style', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .video-play-btn-wrap img',
			]
		);

		$this->add_control(
			'box_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .video-play-btn-wrap img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'box_shadow',
					'label' => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .video-play-btn-wrap img',
				]
		);

		$this->add_control(
			'box_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .video-play-btn-wrap img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'box_margin', //param_name
			[
				'label' 		=> __( 'Margin', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .video-play-btn-wrap img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Custom css tab
		$this->start_controls_section(
			'custom_css_section_style',
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
	 * Render Video Play Button widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings 		= $this->get_settings();
		$url			= $this->get_settings( 'video_url' );
		$image_bg 		= $this->get_settings( 'img' );
		$align 			= $this->get_settings( 'image_alignment' );
		$width 			= $this->get_settings( 'img_width' );
		$height 		= $this->get_settings( 'img_height' );
		$img_alt 		= $this->get_settings( 'img_alt' );
		$show_alt_tag 	= $this->get_settings( 'show_alt_tag' );
		if ( strpos( $url, 'youtu.be' ) == true) {
			$url = 'https://www.youtube.com/watch?v=' . substr($url, 17 );
		}

		$img 			= '';
		$width 			= $width['size'];
		$height			= $height['size'];

		if( !empty( $image_bg['url'] ) && $image_bg['url'] != Utils::get_placeholder_image_src() ) {
			// if main class not exist get it
			if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
				require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
			}

			$image = new \Wn_Img_Maniuplate; // instance from settor class
			$img = $image->m_image( $image_bg['id'], $image_bg['url'], $width, $height ); // set required and get result
		} elseif ( $image_bg['url'] == Utils::get_placeholder_image_src() ) {
			$img = $image_bg['url'];
		}

        // Class & ID
        $shortcodeclass 	= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
        $shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';
		$bottom_text 	= $show_alt_tag ? $show_alt_tag : '';


		if ( $show_alt_tag == 'on' ) {
			$bottom_text	= $bottom_text ? '<p class="bottom-btn-p" style="text-align: center;">' . $img_alt . '</p>' : '' ;
		} else {
			$bottom_text = ' ';
		}

        $custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
        }

		echo '<div class="video-play-btn-wrap ' . $align . ' ' . $shortcodeclass . '"  ' . $shortcodeid . '>';
		echo  $img ? '<img src="' . $img . '" alt="' . $img_alt . '">' : '' ;
		echo '<a href="' . $url . '" class="wn-popup-video video-play-btn video-play-btn ">';
			echo '<i class="sl-control-play"></i>';
			echo $bottom_text;
		echo '</a>';
		echo '</div>';



	}

}
