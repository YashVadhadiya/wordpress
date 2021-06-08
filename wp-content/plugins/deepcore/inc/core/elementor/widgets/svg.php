<?php
namespace Elementor;

class Webnus_Element_Widgets_WSVG extends \Elementor\Widget_Base {

	/**
	 * Retrieve WSVG widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'wsvg';

	}

	/**
	 * Retrieve WSVG widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return __( 'Webnus SVG', 'deep' );

	}

	/**
	 * Retrieve WSVG widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-animation';

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

		return [ 'wn-svg', 'deep-vivus' ];

	}

	/**
	 * Register WSVG widget controls.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'General', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);
		$this->add_control(
			'type',
			[
				'label' 	=> __( 'Select Type', 'deep' ),
				'type' 		=> \Elementor\Controls_Manager::SELECT,
				'default' 	=> '0',
				'options' 	=> [
					'live' 	=> esc_html__( 'Live Icon', 'deep' ),
					'img' 	=> esc_html__( 'Image Tag', 'deep' ),
				],
				'default'	=> 'live',
			]
		);
		$this->add_control(
			'svg_img',
			[
				'label' 	=> __( 'Choose Image', 'deep' ),
				'type' 		=> \Elementor\Controls_Manager::MEDIA,
				'default' 	=> [
					'url' => DEEP_ASSETS_URL . 'images/weather_cloud.svg',
				],
			]
		);
		$this->add_control(
			'svg_color',
			[
				'label' 		=> __( 'SVG color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wn-svg-wrap svg *' => 'stroke: {{VALUE}}',
				],
				'condition' 	=> [
					'type' 	=> [
						'live'
					],
				],
			]
		);
		$this->add_control(
			'svg_size',
			[
				'label' => __( 'SVG Size', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .wn-svg-wrap svg' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' 	=> [
					'type' 	=> [
						'live'
					],
				],
			]
		);
		$this->add_control(
			'svg_size_img',
			[
				'label' => __( 'SVG Size', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 18,
				],
				'selectors' => [
					'{{WRAPPER}} .wn-svg-wrap img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' 	=> [
					'type' 	=> [
						'img'
					],
				],
			]
		);
		$this->add_control(
			'svg_align',
			[
				'label' => __( 'Alignment', 'deep' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'deep' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'deep' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'deep' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .wn-svg-wrap' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'link_section',
			[
				'label' => __( 'Link', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);
		$this->add_control(
			'svg_link_url',
			[
				'label' 		=> __( 'Link URL', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'deep' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '',
					'is_external' 	=> true,
					'nofollow' 		=> true,
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'classid_section',
			[
				'label' => __( 'Class & ID', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);
		$this->add_control(
			'shortcodeid',
			[
				'label' 		=> __( 'Custom ID', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'shortcodeclass',
			[
				'label' 		=> __( 'Custom Class', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->end_controls_section();

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
				'selector' => '#wrap {{WRAPPER}} .wn-svg-wrap svg',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-svg-wrap svg',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'box_shadow',
					'label' => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .wn-svg-wrap svg',
				]
		);
		$this->add_control(
			'box_padding',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-svg-wrap svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'box_margin',
			[
				'label' 		=> __( 'Margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-svg-wrap svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	 * Render WSVG widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$settings['type']			= $settings['type'] ? $settings['type'] : '';
		$settings['shortcodeclass']	= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
		$settings['shortcodeid']	= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';
		$settings['svg_img']['url']	= $settings['svg_img']['url'] ? $settings['svg_img']['url'] : '';

		$svg = '';
		$uniqid = uniqid();

		if ( !empty( $settings['svg_img']['url'] ) ) {
			$svg = deep_get_file_content( $settings['svg_img']['url'] );
			$svg = find_string( $svg, '<svg', '</svg>' );
			$svg = str_replace( 'Layer_1', 'wn-svg-wrap' , $svg );
		}

		if ( $settings['type'] == 'img') {
			$out .= '<div class="wn-svg-wrap ' . $settings['shortcodeclass'] . '"  ' . $settings['shortcodeid'] . ' data-svg="wn-' . $uniqid . '">';
			$out .= '<img src="' . $settings['svg_img']['url'] . '">';
			$out .= '</div>';
		} else {
			$out = '<div class="wn-svg-wrap ' . $settings['shortcodeclass'] . '"  ' . $settings['shortcodeid'] . ' data-svg="wn-' . $uniqid . '">';
			if ( !empty( $settings['svg_link_url']['url'] ) ) {
				$target = $settings['svg_link_url']['is_external'] ? ' target=_blank' : '';
				$rel = $settings['svg_link_url']['nofollow'] ? ' rel=nofollow' : '';
				$out .= '<a href="' . $settings['svg_link_url']['url'] . '" ' . esc_attr( $target . $rel ) . '>';
			}

			$out .= '<svg' . $svg . '</svg>';
			if ( !empty( $settings['svg_link_url']['url'] ) ) {
				$out .= '</a>';
			}
			$out .= '</div>';
		}

        $custom_css = $settings['custom_css'];
		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}
		echo $out;

	}

}
