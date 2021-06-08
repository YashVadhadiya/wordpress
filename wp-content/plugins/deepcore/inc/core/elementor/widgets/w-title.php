<?php
namespace Elementor;

class Webnus_Element_Widgets_TitleBuilder extends \Elementor\Widget_Base {

	/**
	 * Retrieve TitleBuilder widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'title_builder';

	}

	/**
	 * Retrieve TitleBuilder widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return __( 'Webnus Title Builder', 'deep' );

	}

	/**
	 * Retrieve TitleBuilder widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-site-title';

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
	 */
	public function get_script_depends() {

		return [ 'title-builder', 'deep-waypoints' ];

	}

	/**
	 * widget styles.
	 *
	 * @since 4.2.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'deep-title-builder' ];

	}

	/**
	 * Register TitleBuilder widget controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		// Content Tab
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'General', 'deep' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title', // param_name
			[
				'label'       => __( 'Title', 'deep' ), // heading
				'type'        => \Elementor\Controls_Manager::TEXTAREA, // type
				'rows'        => 10,
				'placeholder' => __( 'Enter main title', 'deep' ),
			]
		);

		$this->add_control(
			'subtitle', // param_name
			[
				'label'       => __( 'Subtitle', 'deep' ), // heading
				'type'        => \Elementor\Controls_Manager::TEXTAREA, // type
				'rows'        => 10,
				'placeholder' => __( 'Enter subtitle', 'deep' ),
			]
		);

		$this->add_control(
			'text_align',
			[
				'label'     => __( 'Alignment', 'deep' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'deep' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'deep' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'deep' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default'   => 'center',
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .wn-deep-title-wrap' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'rotate', // param_name
			[
				'label'     => __( 'Rotate', 'deep' ), // heading
				'type'      => \Elementor\Controls_Manager::SELECT, // type
				'default'   => '0',
				'options'   => [ // value
					'0'      => __( 'none', 'deep' ),
					'45deg'  => __( '45deg', 'deep' ),
					'90deg'  => __( '90deg', 'deep' ),
					'180deg' => __( '180deg', 'deep' ),
					'custom' => __( 'Custom', 'deep' ),
				],
				'selectors' => [
					'{{WRAPPER}} .wn-deep-title-wrap' => 'transform: rotate( {{VALUE}} );',
				],
			]
		);

		$this->add_control(
			'custom_rotate',
			[
				'label'      => __( 'Custom rotate', 'deep' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'range'      => [
					'deg' => [
						'min'  => 0,
						'max'  => 360,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'deg',
					'size' => 0,
				],
				'selectors'  => [
					'{{WRAPPER}} .wn-deep-title-wrap' => 'transform: rotate( {{SIZE}}{{UNIT}} );',
				],
				'condition'  => [ // dependency
					'rotate' => [
						'custom',
					],
				],
			]
		);

		$this->add_control(
			'display', // param_name
			[
				'label'     => __( 'Display', 'deep' ), // heading
				'type'      => \Elementor\Controls_Manager::SELECT, // type
				'default'   => 'block',
				'options'   => [ // value
					'inherit'      => __( 'Inherit', 'deep' ),
					'inline'       => __( 'inline', 'deep' ),
					'inline-block' => __( 'inline block', 'deep' ),
					'block'        => __( 'block', 'deep' ),
				],
				'selectors' => [
					'{{WRAPPER}} .wn-deep-title-wrap' => 'display: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_heading', // param_name
			[
				'label'   => __( 'Title HTML Tag', 'deep' ), // heading
				'type'    => \Elementor\Controls_Manager::SELECT, // type
				'default' => 'h1',
				'options' => [ // value
					'h1'   => __( 'h1', 'deep' ),
					'h2'   => __( 'h2', 'deep' ),
					'h3'   => __( 'h3', 'deep' ),
					'h4'   => __( 'h4', 'deep' ),
					'h5'   => __( 'h5', 'deep' ),
					'h6'   => __( 'h6', 'deep' ),
					'p'    => __( 'P', 'deep' ),
					'span' => __( 'Span', 'deep' ),
					'div'  => __( 'div', 'deep' ),
				],
			]
		);

		$this->add_control(
			'subtitle_heading', // param_name
			[
				'label'   => __( 'Subtitle HTML Tag', 'deep' ), // heading
				'type'    => \Elementor\Controls_Manager::SELECT, // type
				'default' => 'h1',
				'options' => [ // value
					'h1'   => __( 'h1', 'deep' ),
					'h2'   => __( 'h2', 'deep' ),
					'h3'   => __( 'h3', 'deep' ),
					'h4'   => __( 'h4', 'deep' ),
					'h5'   => __( 'h5', 'deep' ),
					'h6'   => __( 'h6', 'deep' ),
					'p'    => __( 'P', 'deep' ),
					'span' => __( 'Span', 'deep' ),
					'div'  => __( 'div', 'deep' ),
				],
			]
		);

		$this->add_control(
			'layer_animation', // param_name
			[
				'label'   => __( 'Layer Animation', 'deep' ), // heading
				'type'    => \Elementor\Controls_Manager::SELECT, // type
				'default' => 'none',
				'options' => [ // value
					'none'                   => __( 'None', 'deep' ),
					'wn-layer-anim-bottom'   => __( 'Bottom to Top', 'deep' ),
					'wn-layer-anim-top'      => __( 'Top to Bottom', 'deep' ),
					'wn-layer-anim-right'    => __( 'Left to Right', 'deep' ),
					'wn-layer-anim-left'     => __( 'Right to Left', 'deep' ),
					'wn-layer-anim-zoom-in'  => __( 'Zoom in', 'deep' ),
					'wn-layer-anim-zoom-out' => __( 'Zoom out', 'deep' ),
					'wn-layer-anim-fade'     => __( 'Fade', 'deep' ),
					'wn-layer-anim-flip'     => __( 'Flip', 'deep' ),
				],
			]
		);

		$this->end_controls_section();

		// Title Styling
		$this->start_controls_section(
			'title_styling',
			[
				'label' => __( 'Title Styling', 'deep' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_custom_class', // param_name
			[
				'label' => __( 'Custom class', 'deep' ), // heading
				'type'  => \Elementor\Controls_Manager::TEXT, // type
			]
		);

		$this->add_control(
			'title_bg_color', // param_name
			[
				'label'     => __( 'Title background Color', 'deep' ), // heading
				'type'      => \Elementor\Controls_Manager::COLOR, // type
				'selectors' => [
					'{{WRAPPER}} .wn-deep-innertitle' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_color_type', // param_name
			[
				'label'   => __( 'Color type', 'deep' ), // heading
				'type'    => \Elementor\Controls_Manager::SELECT, // type
				'default' => 'title-solid-color',
				'options' => [ // value
					'title-solid-color' => __( 'Solid color', 'deep' ),
					'gradient'          => __( 'Gradient', 'deep' ),
				],
			]
		);

		$this->add_control(
			'single_title_color_type', // param_name
			[
				'label'     => __( 'Title Color', 'deep' ), // heading
				'type'      => \Elementor\Controls_Manager::COLOR, // type
				'selectors' => [
					'{{WRAPPER}} .wn-deep-innertitle' => 'color: {{VALUE}}',
				],
				'condition' => [ // dependency
					'title_color_type' => [
						'title-solid-color',
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'title_grad_color',
				'label'     => __( 'Title Color', 'deep' ),
				'types'     => [ 'gradient' ],
				'selector'  => '{{WRAPPER}} .wn-deep-innertitle',
				'condition' => [ // dependency
					'title_color_type' => [
						'gradient',
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' => '#wrap {{WRAPPER}} .wn-deep-innertitle',
			]
		);

		$this->add_control(
			'title_padding', // param_name
			[
				'label'      => __( 'Title padding', 'deep' ), // heading
				'type'       => \Elementor\Controls_Manager::DIMENSIONS, // type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .wn-deep-innertitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_margin', // param_name
			[
				'label'      => __( 'Title margin', 'deep' ), // heading
				'type'       => \Elementor\Controls_Manager::DIMENSIONS, // type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .wn-deep-innertitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'display_title', // param_name
			[
				'label'     => __( 'Display', 'deep' ), // heading
				'type'      => \Elementor\Controls_Manager::SELECT, // type
				'default'   => 'block',
				'options'   => [ // value
					'inherit'      => __( 'Inherit', 'deep' ),
					'inline'       => __( 'inline', 'deep' ),
					'inline-block' => __( 'inline block', 'deep' ),
					'block'        => __( 'block', 'deep' ),
				],
				'selectors' => [
					'{{WRAPPER}} .wn-deep-innertitle' => 'display: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Subtitle Styling
		$this->start_controls_section(
			'subtitle_styling',
			[
				'label' => __( 'Subtitle Styling', 'deep' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'subtitle_custom_class', // param_name
			[
				'label' => __( 'Custom class', 'deep' ), // heading
				'type'  => \Elementor\Controls_Manager::TEXT, // type
			]
		);

		$this->add_control(
			'subtitle_bg_color', // param_name
			[
				'label'     => __( 'Subtitle background color', 'deep' ), // heading
				'type'      => \Elementor\Controls_Manager::COLOR, // type
				'selectors' => [
					'{{WRAPPER}} .wn-deep-subtitle' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'subtitle_color_type', // param_name
			[
				'label'   => __( 'Color type', 'deep' ), // heading
				'type'    => \Elementor\Controls_Manager::SELECT, // type
				'default' => 'subtitle-solid-color',
				'options' => [ // value
					'subtitle-solid-color' => __( 'Solid color', 'deep' ),
					'gradient'             => __( 'Gradient', 'deep' ),
				],
			]
		);

		$this->add_control(
			'sub_title_color_simple', // param_name
			[
				'label'     => __( 'Subtitle Color', 'deep' ), // heading
				'type'      => \Elementor\Controls_Manager::COLOR, // type
				'selectors' => [
					'{{WRAPPER}} .wn-deep-subtitle' => 'color: {{VALUE}}',
				],
				'condition' => [ // dependency
					'subtitle_color_type' => [
						'subtitle-solid-color',
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'sub_title_color_grad',
				'label'     => __( 'Subtitle Color', 'deep' ),
				'types'     => [ 'gradient' ],
				'selector'  => '{{WRAPPER}} .wn-deep-subtitle',
				'condition' => [ // dependency
					'subtitle_color_type' => [
						'gradient',
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'label'    => __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' => '#wrap {{WRAPPER}} .wn-deep-subtitle',
			]
		);

		$this->add_control(
			'subtitle_padding', // param_name
			[
				'label'      => __( 'Subtitle padding', 'deep' ), // heading
				'type'       => \Elementor\Controls_Manager::DIMENSIONS, // type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .wn-deep-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'subtitle_margin', // param_name
			[
				'label'      => __( 'Subtitle margin', 'deep' ), // heading
				'type'       => \Elementor\Controls_Manager::DIMENSIONS, // type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .wn-deep-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'display_subtitle', // param_name
			[
				'label'     => __( 'Display', 'deep' ), // heading
				'type'      => \Elementor\Controls_Manager::SELECT, // type
				'default'   => 'inline-block',
				'options'   => [ // value
					'inherit'      => __( 'Inherit', 'deep' ),
					'inline'       => __( 'inline', 'deep' ),
					'inline-block' => __( 'inline block', 'deep' ),
					'block'        => __( 'block', 'deep' ),
				],
				'selectors' => [
					'{{WRAPPER}} .wn-deep-subtitle' => 'display: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Shape
		$this->start_controls_section(
			'shape',
			[
				'label' => __( 'Shape', 'deep' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shapes', // param_name
			[
				'label'  => __( 'Shapes', 'deep' ), // heading
				'type'   => \Elementor\Controls_Manager::REPEATER, // type
				'fields' => [ // params
					[
						'name'        => 'shape_width', // param_name
						'label'       => __( 'Width', 'deep' ), // heading
						'type'        => \Elementor\Controls_Manager::TEXT, // type
						'placeholder' => __( 'example: 40px', 'deep' ),
						'admin_label' => true,
						'selectors'   => [
							'{{WRAPPER}} {{CURRENT_ITEM}}' => 'width: {{VALUE}}',
						],
					],
					[
						'name'        => 'shape_height', // param_name
						'label'       => __( 'Height', 'deep' ), // heading
						'type'        => \Elementor\Controls_Manager::TEXT, // type
						'placeholder' => __( 'example: 10px', 'deep' ),
						'admin_label' => true,
						'selectors'   => [
							'{{WRAPPER}} {{CURRENT_ITEM}}' => 'height: {{VALUE}}',
						],
					],
					[
						'name'        => 'shape_radius', // param_name
						'label'       => __( 'Shape Radius', 'deep' ), // heading
						'type'        => \Elementor\Controls_Manager::TEXT, // type
						'placeholder' => esc_html__( 'Example: 16px or %', 'deep' ),
						'admin_label' => true,
						'selectors'   => [
							'{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-radius: {{VALUE}}',
						],
					],
					[
						'name'    => 'bg_type', // param_name
						'label'   => __( 'Background Type', 'deep' ), // heading
						'type'    => \Elementor\Controls_Manager::SELECT, // type
						'default' => 'classic',
						'options' => [ // value
							'classic'  => __( 'Classic', 'deep' ),
							'gradient' => __( 'Gradient', 'deep' ),
						],
					],
					[
						'name'      => 'shape_background_color', // param_name
						'label'     => __( 'Background Color', 'deep' ), // heading
						'type'      => \Elementor\Controls_Manager::COLOR, // type
						'selectors' => [
							'{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
						],
						'condition' => [ // dependency
							'bg_type' => [
								'classic',
							],
						],
					],
					[
						'name'      => 'shape_background_image', // param_name
						'label'     => __( 'Shape background Image', 'deep' ), // heading
						'type'      => \Elementor\Controls_Manager::MEDIA, // type
						'selectors' => [
							'{{WRAPPER}} {{CURRENT_ITEM}}' => 'background: url({{URL}}) no-repeat center center;background-size: cover',
						],
						'condition' => [ // dependency
							'bg_type' => [
								'classic',
							],
						],
					],
					[
						'name'      => 'shape_background_gradient_color_1', // param_name
						'label'     => __( 'Background Color 1', 'deep' ), // heading
						'type'      => \Elementor\Controls_Manager::COLOR, // type
						'condition' => [ // dependency
							'bg_type' => [
								'gradient',
							],
						],
					],
					[
						'name'      => 'shape_background_gradient_color_2', // param_name
						'label'     => __( 'Background Color 2', 'deep' ), // heading
						'type'      => \Elementor\Controls_Manager::COLOR, // type
						'condition' => [ // dependency
							'bg_type' => [
								'gradient',
							],
						],
					],
					[
						'name'      => 'shape_background_gradient_color_3', // param_name
						'label'     => __( 'Background Color 3', 'deep' ), // heading
						'type'      => \Elementor\Controls_Manager::COLOR, // type
						'condition' => [ // dependency
							'bg_type' => [
								'gradient',
							],
						],
					],
					[
						'name'      => 'shape_background_gradient_color_4', // param_name
						'label'     => __( 'Background Color 4', 'deep' ), // heading
						'type'      => \Elementor\Controls_Manager::COLOR, // type
						'condition' => [ // dependency
							'bg_type' => [
								'gradient',
							],
						],
					],
					[
						'name'        => 'shape_top_position', // param_name
						'label'       => __( 'Top Position', 'deep' ), // heading
						'type'        => \Elementor\Controls_Manager::TEXT, // type
						'placeholder' => esc_html__( 'Example: 16px or %', 'deep' ),
						'selectors'   => [
							'{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{VALUE}}',
						],
					],
					[
						'name'        => 'shape_right_position', // param_name
						'label'       => __( 'Right Position', 'deep' ), // heading
						'type'        => \Elementor\Controls_Manager::TEXT, // type
						'placeholder' => esc_html__( 'Example: 16px or %', 'deep' ),
						'selectors'   => [
							'{{WRAPPER}} {{CURRENT_ITEM}}' => 'right: {{VALUE}}',
						],
					],
					[
						'name'        => 'shape_bottom_position', // param_name
						'label'       => __( 'Bottom Position', 'deep' ), // heading
						'type'        => \Elementor\Controls_Manager::TEXT, // type
						'placeholder' => esc_html__( 'Example: 16px or %', 'deep' ),
						'selectors'   => [
							'{{WRAPPER}} {{CURRENT_ITEM}}' => 'bottom: {{VALUE}}',
						],
					],
					[
						'name'        => 'shape_left_position', // param_name
						'label'       => __( 'Left Position', 'deep' ), // heading
						'type'        => \Elementor\Controls_Manager::TEXT, // type
						'placeholder' => esc_html__( 'Example: 16px or %', 'deep' ),
						'selectors'   => [
							'{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{VALUE}}',
						],
					],
					[
						'name'      => 'shape_rotate', // param_name
						'label'     => __( 'Shape Rotate', 'deep' ), // heading
						'type'      => \Elementor\Controls_Manager::SELECT, // type
						'default'   => '0',
						'options'   => [ // value
							'0'      => __( 'none', 'deep' ),
							'45deg'  => __( '45deg', 'deep' ),
							'90deg'  => __( '90deg', 'deep' ),
							'180deg' => __( '180deg', 'deep' ),
							'custom' => __( 'Custom', 'deep' ),
						],
						'selectors' => [
							'{{WRAPPER}} {{CURRENT_ITEM}}' => 'transform: rotate( {{VALUE}} )',
						],
					],
					[
						'name'       => 'shape_custom_rotate', // param_name
						'label'      => __( 'Shape Custom rotate', 'deep' ),
						'type'       => Controls_Manager::SLIDER,
						'size_units' => [ 'deg' ],
						'range'      => [
							'deg' => [
								'min'  => 0,
								'max'  => 360,
								'step' => 1,
							],
						],
						'default'    => [
							'unit' => 'deg',
							'size' => 0,
						],
						'selectors'  => [
							'{{WRAPPER}} {{CURRENT_ITEM}}' => 'transform: rotate( {{SIZE}}{{UNIT}} );',
						],
						'condition'  => [ // dependency
							'shape_rotate' => [
								'custom',
							],
						],
					],
				],
			]
		);

		$this->end_controls_section();

		// Icon
		$this->start_controls_section(
			'wicon',
			[
				'label' => __( 'Icon', 'deep' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'icons',
			[
				'label'       => __( 'Icon', 'deep' ),
				'type'        => \Elementor\Controls_Manager::ICON,
				'label_block' => true,
				'default'     => 'li_star',
			]
		);

		$repeater->add_control(
			'icon_font_size',
			[
				'label'       => __( 'Font Size', 'deep' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => '15px',
				'selectors'   => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'font-size: {{VALUE}}',
				],
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'icon_top',
			[
				'label'       => __( 'Top', 'deep' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => '0px',
				'selectors'   => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{VALUE}}',
				],
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'icon_right',
			[
				'label'       => __( 'Right', 'deep' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => '0px',
				'selectors'   => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'right: {{VALUE}}',
				],
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'icon_bottom',
			[
				'label'       => __( 'Bottom', 'deep' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => '0px',
				'selectors'   => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'bottom: {{VALUE}}',
				],
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'icon_left',
			[
				'label'       => __( 'Left', 'deep' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => '0px',
				'selectors'   => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{VALUE}}',
				],
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'icon_color',
			[
				'label'       => __( 'Color', 'deep' ),
				'type'        => \Elementor\Controls_Manager::COLOR,
				'selectors'   => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'aicons',
			[
				'label'       => __( 'Icons', 'deep' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ icons }}}',
			]
		);

		$this->end_controls_section();

		// Custom css tab
		$this->start_controls_section(
			'custom_css_section',
			[
				'label' => __( 'Custom CSS', 'deep' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'custom_css',
			[
				'label'      => __( 'Custom CSS', 'deep' ),
				'type'       => \Elementor\Controls_Manager::CODE,
				'language'   => 'css',
				'rows'       => 20,
				'show_label' => true,
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render TitleBuilder widget output on the frontend.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings                    = $this->get_settings();
		$uniqid                      = uniqid();
		$title                       = ! empty( $settings['title'] ) ? '<' . $settings['title_heading'] . ' class=" ' . $settings['title_custom_class'] . ' wn-deep-innertitle">' . $settings['title'] . '</' . $settings['title_heading'] . '>' : '';
		$subtitle                    = ! empty( $settings['subtitle'] ) ? '<' . $settings['subtitle_heading'] . ' class=" ' . $settings['subtitle_custom_class'] . ' wn-deep-subtitle">' . $settings['subtitle'] . '</' . $settings['subtitle_heading'] . '>' : '';
		$settings['layer_animation'] = $settings['layer_animation'] != 'none' ? $settings['layer_animation'] : '';
		$shape_gradient              = '';

		if ( $settings['layer_animation'] ) {
			wp_enqueue_script( 'deep-elements-animation', DEEP_ASSETS_URL . 'js/frontend/deep-elements-animation.js', array( 'jquery' ), DEEP_VERSION, true );
			wp_enqueue_style( 'deep-layer-animation', DEEP_ASSETS_URL . 'css/frontend/main-style/layer-animation.css', false, DEEP_VERSION );
		}

		if ( $settings['title_color_type'] == 'gradient' ) {
			$iconbox_wtitle_title_gradient_class = 'wn-wtitle-title-gradient';
		} else {
			$iconbox_wtitle_title_gradient_class = '';
		}

		if ( $settings['subtitle_color_type'] == 'gradient' ) {
			$iconbox_wtitle_subtitle_gradient_class = 'wn-wtitle-subtitle-gradient';
		} else {
			$iconbox_wtitle_subtitle_gradient_class = '';
		}

		$out = '
		<div class="wn-deep-title-wrap ' . $settings['layer_animation'] . ' wn-deep-title-wrap' . $uniqid . ' ' . $iconbox_wtitle_title_gradient_class . ' ' . $iconbox_wtitle_subtitle_gradient_class . '"><div class="wn-deep-title">';
		if ( $settings['aicons'] ) {
			$out .= '<div class="wn-title-icon-wrap">';
			foreach ( $settings['aicons'] as $iconi ) {
				$out .= '<i class="' . $iconi['icons'] . ' elementor-repeater-item-' . $iconi['_id'] . '"></i>';
			}
			$out .= '</div>';
		}
		if ( $settings['shapes'] ) {
			foreach ( $settings['shapes'] as $item ) {
				$out .= '<span class="wn-deep-title-shape elementor-repeater-item-' . $item['_id'] . ' after"></span>';
			}

			if ( $item['bg_type'] == 'gradient' ) {
				$bg_gradient_1  = ! empty( $item['shape_background_gradient_color_1'] ) ? $item['shape_background_gradient_color_1'] : '';
				$bg_gradient_2  = ! empty( $item['shape_background_gradient_color_2'] ) ? $item['shape_background_gradient_color_2'] : '';
				$bg_gradient_3  = ! empty( $item['shape_background_gradient_color_3'] ) ? $item['shape_background_gradient_color_3'] : '';
				$bg_gradient_4  = ! empty( $item['shape_background_gradient_color_4'] ) ? $item['shape_background_gradient_color_4'] : '';
				$shape_gradient = deep_gradient( $bg_gradient_1, $bg_gradient_2, $bg_gradient_3, $bg_gradient_4, '90' );
				deep_save_dyn_styles(
					'
					.wn-deep-title-wrap .elementor-repeater-item-' . $item['_id'] . ' {
						' . $shape_gradient . '
					}
				'
				);

				if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
					$out .= '
						<style>
							.wn-deep-title-wrap .elementor-repeater-item-' . $item['_id'] . ' {
								' . $shape_gradient . '
							}
						</style>
					';
				}
			}
		}
			$out .= $title;
			$out .= $subtitle;
		$out     .= '
		</div></div>';

		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>' . $custom_css . '</style>';
		}

		echo $out;
	}

}
