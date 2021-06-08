<?php
namespace Elementor;

class Webnus_Element_Widgets_Content_Carousel extends \Elementor\Widget_Base {

	/**
	 * Retrieve Content Carousel widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'content-carousel';

	}

	/**
	 * Retrieve Content Carousel widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Content Carousel', 'deep' );

	}

	/**
	 * Retrieve Content Carousel widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'ti-layout-slider-alt';

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

		return [ 'deep-owl-carousel', 'deep-content-carousel' ];

	}

	/**
	 * widget styles.
	 *
	 * @since 4.2.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'deep-owl-carousel', 'wn-deep-content-carousel' ];

	}

	/**
	 * Register Content Carousel widget controls.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$elementor_tpl = \Elementor\Plugin::instance()->templates_manager->get_source( 'local' )->get_items();
		$elementor_tpl_opts = [ '0' => __( 'Elementor template is not defined yet.', 'deep' ) ];

		if ( ! empty( $elementor_tpl ) ) {
			$elementor_tpl_opts = [ '0' => __( 'Select elementor template', 'deep' ) ];

			foreach ( $elementor_tpl as $template ) {
				$elementor_tpl_opts[ $template['template_id'] ] = $template['title'] . ' (' . $template['type'] . ')';
			}
		}

		$this->start_controls_section(
			'main_setting',
			[
				'label' => esc_html__( 'General', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		$this->add_control(
			'item_num',
			[
				'label' 		=> esc_html__( 'Content Carousel Items', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::NUMBER,
				'min' 			=> 1,
				'max' 			=> 20,
				'step' 			=> 1,
				'default' 		=> 3,
				'description'	=> esc_html__( 'Number of items want to show in content carousel', 'deep' ),
			]
		);

		$this->add_control(
			'item_margin',
			[
				'label' =>  esc_html__('Item margin', 'deep'),
				'type' => Controls_Manager::SLIDER,
				'description'	=> esc_html__( 'Content carousel items margin right', 'deep' ),
				'range' => [
					'' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default' => [
					'size' => 10,
				],
			]
		);

		$this->add_control(
			'items_stage_padding',
			[
				'label' 		=>  esc_html__('Items stage padding', 'deep'),
				'type' 			=> Controls_Manager::SLIDER,
				'description'	=> esc_html__( 'Content carousel padding left and right on stage', 'deep' ),
				'range' 		=> [
					'' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default' 		=> [
					'size' => 0,
				],
			]
		);

		$this->add_control(
			'enable_padding', //param_name
			[
				'label' 		=> __( 'Padding for Carousel container', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::SWITCHER, //type
				'label_on' 		=> __( 'Enable', 'deep' ),
				'label_off' 	=> __( 'Disable', 'deep' ),
				'return_value' 	=> 'true',
				'default' 		=> 'false',
			]
		);

		$this->add_control(
			'carousel_padding', //param_name
			[
				'label' 		=>  esc_html__( 'Carousel container padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wn-content-carousel-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'enable_padding' => 'true',
				],
			]
		);

		$this->add_control(
			'carousel_rtl', //param_name
			[
				'label' 		=> __( 'RTL', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::SWITCHER, //type
				'label_on' 		=> __( 'Enable', 'deep' ),
				'label_off' 	=> __( 'Disable', 'deep' ),
				'return_value' 	=> 'true',
				'default' 		=> 'false',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'navi',
			[
				'label' => esc_html__( 'Navigation', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		$this->add_control(
			'dots', //param_name
			[
				'label' 		=> __( 'Bullets', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::SWITCHER, //type
				'label_on' 		=> __( 'Enable', 'deep' ),
				'label_off' 	=> __( 'Disable', 'deep' ),
				'return_value' 	=> 'true',
				'default' 		=> 'false',
			]
		);

		$this->add_control(
			'navigation', //param_name
			[
				'label' 		=> __( 'Arrows', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::SWITCHER, //type
				'label_on' 		=> __( 'Enable', 'deep' ),
				'label_off' 	=> __( 'Disable', 'deep' ),
				'return_value' 	=> 'true',
				'default' 		=> 'false',
			]
		);

		$this->add_control(
			'nav_location', //param_name
			[
				'label' 	=> __( 'Arrow location', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'sidebar_nav',
				'options' 	=> [
					'bottom_nav'  	=> __( 'Bottom', 'deep' ),
					'sidebar_nav' 	=> __( 'Sidebar', 'deep' ),
				],
				'condition' => [ //dependency
					'navigation' 	=> [
						'true'
					],
				],
			]
		);

		$this->end_controls_section();

        // Content Tab
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Items', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		$this->add_control(
			'carousel_item',
			[
				'label'			=> esc_html__( 'Process Item', 'deep' ),
				'type'			=> \Elementor\Controls_Manager::REPEATER,
				'description'	=>  esc_html__( 'If you want this element cover whole page width, please add it inside of a full row. For this purpose, click on edit button of the row and set Select Row Type on Full Width Row.', 'deep' ),
				'default' => [
					[
						'title'		=> __( 'Tab #1', 'deep' ),
					],
					[
						'title'		=> __( 'Tab #2', 'deep' ),
					],
					[
						'title'		=> __( 'Tab #3', 'deep' ),
					],
				],
				'fields' => [
					[
						'name'			=> 'title',
						'label'			=>  esc_html__( 'Tab Title', 'deep' ),
						'type'			=> \Elementor\Controls_Manager::TEXT,
						'default'		=> esc_html__( 'Tab Title' , 'deep' ),
					],
					[
						'name'			=> 'elementor_tpl_id',
						'label'			=> esc_html__( 'Choose template', 'deep' ),
						'type'			=> \Elementor\Controls_Manager::SELECT,
						'default'		=> '0',
						'options'		=> $elementor_tpl_opts,
						'label_block'	=> 'true',
					],
				]
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_box_style',
			[
				'label' => __( 'Item Style', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'box_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' , 'gradient' ],
				'selector' => '#wrap {{WRAPPER}} .wn-content-carousel .owl-carousel.owl-drag .owl-item',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-content-carousel .owl-carousel.owl-drag .owl-item',
			]
		);

		$this->add_control(
			'box_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-content-carousel .owl-carousel.owl-drag .owl-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'box_shadow',
					'label' => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .wn-content-carousel .owl-carousel.owl-drag .owl-item',
				]
		);

		$this->add_control(
			'box_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-content-carousel .owl-carousel.owl-drag .owl-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-content-carousel .owl-carousel.owl-drag .owl-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_box_style_hover',
			[
				'label' => __( ' Hover Item Style', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'box_bg_hover',
				'label' => __( 'Background Hover', 'deep' ),
				'types' => [ 'classic' , 'gradient' ],
				'selector' => '#wrap {{WRAPPER}} .wn-content-carousel .owl-carousel.owl-drag .owl-item:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border_hover',
				'label' => __( 'Border Hover', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-content-carousel .owl-carousel.owl-drag .owl-item:hover',
			]
		);

		$this->add_control(
			'box_border_radius_hover', //param_name
			[
				'label' 		=> __( 'Border Radius Hover', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-content-carousel .owl-carousel.owl-drag .owl-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'box_shadow_hover',
					'label' => __( 'Box Shadow Hover', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .wn-content-carousel .owl-carousel.owl-drag .owl-item:hover',
				]
		);

		$this->add_control(
			'box_padding_hover', //param_name
			[
				'label' 		=> __( 'Padding Hover', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-content-carousel .owl-carousel.owl-drag .owl-item:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'box_margin_hover', //param_name
			[
				'label' 		=> __( 'Margin Hover', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-content-carousel .owl-carousel.owl-drag .owl-item:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_dots_style',
			[
				'label' => __( ' Bullets Style', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'dots' => 'true',
				],
			]
		);

		$this->start_controls_tabs(
			'wn_style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => __( 'Normal', 'deep' ),
			]
		);

		$this->add_responsive_control(
			'dots_width',
			[
				'label' => __( 'Width', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-content-carousel .owl-dots .owl-dot' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dots_height',
			[
				'label' => __( 'Height', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-content-carousel .owl-dots .owl-dot' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'dots_border',
				'label' => __( 'Bullets Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-content-carousel .owl-dots .owl-dot',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'dots_background',
				'label' =>  esc_html__( 'Background', 'deep' ),
				'types' => [ 'classic', 'gradient', ],
				'selector' => '#wrap {{WRAPPER}} .wn-content-carousel .owl-dots .owl-dot',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'dots_shadow',
					'label' => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .wn-content-carousel .owl-dots .owl-dot',
				]
		);

		$this->add_control(
			'dots_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-content-carousel .owl-dots .owl-dot' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dots_padding', //param_name
			[
				'label' 	=>  esc_html__( 'Padding', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units'=> [ 'px', 'em', '%' ],
				'devices'	=> [ 'desktop', 'tablet', 'mobile' ],
				'selectors'	=> [
					'#wrap {{WRAPPER}} .wn-content-carousel .owl-dots .owl-dot' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dots_margin', //param_name
			[
				'label' 	=>  esc_html__( 'Margin', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'devices'	=> [ 'desktop', 'tablet', 'mobile' ],
				'size_units'=> [ 'px', 'em', '%' ],
				'selectors'	=> [
					'#wrap {{WRAPPER}} .wn-content-carousel .owl-dots .owl-dot' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => __( 'Hover & Active', 'deep' ),
			]
		);

		$this->add_responsive_control(
			'dots_width_hover',
			[
				'label' => __( 'Hover and Active Width', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-content-carousel .owl-dots .owl-dot.active, #wrap {{WRAPPER}} .wn-content-carousel .owl-dots .owl-dot:hover' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dots_height_hover',
			[
				'label' => __( 'Hover and Active Height', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-content-carousel .owl-dots .owl-dot.active, #wrap {{WRAPPER}} .wn-content-carousel .owl-dots .owl-dot:hover' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'dots_border_hover',
				'label' => __( 'Bullets Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-content-carousel .owl-dots .owl-dot.active, #wrap {{WRAPPER}} .wn-content-carousel .owl-dots .owl-dot:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'dots_background_hover',
				'label' =>  esc_html__( 'Background', 'deep' ),
				'types' => [ 'classic', 'gradient', ],
				'selector' => '#wrap {{WRAPPER}} .wn-content-carousel .owl-dots .owl-dot.active, #wrap {{WRAPPER}} .wn-content-carousel .owl-dots .owl-dot:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'dots_shadow_hover',
					'label' => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .wn-content-carousel .owl-dots .owl-dot.active, #wrap {{WRAPPER}} .wn-content-carousel .owl-dots .owl-dot:hover',
				]
		);

		$this->add_control(
			'dots_border_radius_hover', //param_name
			[
				'label' 		=> __( 'Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-content-carousel .owl-dots .owl-dot.active, #wrap {{WRAPPER}} .wn-content-carousel .owl-dots .owl-dot:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dots_padding_hover', //param_name
			[
				'label' 	=>  esc_html__( 'Padding', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units'=> [ 'px', 'em', '%' ],
				'devices'	=> [ 'desktop', 'tablet', 'mobile' ],
				'selectors'	=> [
					'#wrap {{WRAPPER}} .wn-content-carousel .owl-dots .owl-dot.active, #wrap {{WRAPPER}} .wn-content-carousel .owl-dots .owl-dot:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dots_margin_hover', //param_name
			[
				'label' 	=>  esc_html__( 'Margin', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'devices'	=> [ 'desktop', 'tablet', 'mobile' ],
				'size_units'=> [ 'px', 'em', '%' ],
				'selectors'	=> [
					'#wrap {{WRAPPER}} .wn-content-carousel .owl-dots .owl-dot.active, #wrap {{WRAPPER}} .wn-content-carousel .owl-dots .owl-dot:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_navigation_style',
			[
				'label' => __( ' Navigation Style', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => 'true',
				],
			]
		);

		$this->add_control(
			'arrow_font_size',
			[
				'label' => __( 'Arrow Size', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-prev .ol-pre:after, #wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-next .ol-nxt:after' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'wn_style_tabs2'
		);

		$this->start_controls_tab(
			'style_normal_tab2',
			[
				'label' => __( 'Normal', 'deep' ),
			]
		);

		$this->add_control(
			'arrow_color', //param_name
			[
				'label' 		=>  esc_html__( 'Arrow Color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-prev .ol-pre:after, #wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-next .ol-nxt:after' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'arrow_border',
				'label' => __( 'Arrow Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-prev .ol-pre:after, #wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-next .ol-nxt:after',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'arrow_background',
				'label' =>  esc_html__( 'Background', 'deep' ),
				'types' => [ 'classic', 'gradient', ],
				'selector' => '#wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-prev .ol-pre:after, #wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-next .ol-nxt:after',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'arrow_shadow',
					'label' => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-prev .ol-pre:after, #wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-next .ol-nxt:after',
				]
		);

		$this->add_control(
			'arrow_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-prev .ol-pre:after, #wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-next .ol-nxt:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'arrow_padding', //param_name
			[
				'label' 	=>  esc_html__( 'Padding', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units'=> [ 'px', 'em', '%' ],
				'devices'	=> [ 'desktop', 'tablet', 'mobile' ],
				'selectors'	=> [
					'#wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-prev .ol-pre:after, #wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-next .ol-nxt:after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'arrow_margin', //param_name
			[
				'label' 	=>  esc_html__( 'Margin', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'devices'	=> [ 'desktop', 'tablet', 'mobile' ],
				'size_units'=> [ 'px', 'em', '%' ],
				'selectors'	=> [
					'#wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-prev .ol-pre:after, #wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-next .ol-nxt:after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab2',
			[
				'label' => __( 'Hover', 'deep' ),
			]
		);

		$this->add_control(
			'arrow_color_hover', //param_name
			[
				'label' 		=>  esc_html__( 'Arrow Color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-prev .ol-pre:hover:after, #wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-next .ol-nxt:hover:after' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'arrow_border_hover',
				'label' => __( 'Arrow Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-prev .ol-pre:hover:after, #wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-next .ol-nxt:hover:after',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'arrow_background_hover',
				'label' =>  esc_html__( 'Background', 'deep' ),
				'types' => [ 'classic', 'gradient', ],
				'selector' => '#wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-prev .ol-pre:hover:after, #wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-next .ol-nxt:hover:after',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'arrow_shadow_hover',
					'label' => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-prev .ol-pre:hover:after, #wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-next .ol-nxt:hover:after',
				]
		);

		$this->add_control(
			'arrow_border_radius_hover', //param_name
			[
				'label' 		=> __( 'Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-prev .ol-pre:hover:after, #wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-next .ol-nxt:hover:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'arrow_padding_hover', //param_name
			[
				'label' 	=>  esc_html__( 'Padding', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units'=> [ 'px', 'em', '%' ],
				'devices'	=> [ 'desktop', 'tablet', 'mobile' ],
				'selectors'	=> [
					'#wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-prev .ol-pre:hover:after, #wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-next .ol-nxt:hover:after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'arrow_margin_hover', //param_name
			[
				'label' 	=>  esc_html__( 'Margin', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'devices'	=> [ 'desktop', 'tablet', 'mobile' ],
				'size_units'=> [ 'px', 'em', '%' ],
				'selectors'	=> [
					'#wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-prev .ol-pre:hover:after, #wrap {{WRAPPER}} .wn-content-carousel .owl-nav .owl-next .ol-nxt:hover:after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'classid_section',
			[
				'label' => __( 'Class', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		$this->add_control(
			'shortcodeclass', //param_name
			[
				'label' 		=> __( 'Custom Class', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXT, //type
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
	 * Render Content Carousel widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings();
		$uniqid = uniqid();
        $shortcodeclass 		= !empty( $settings['shortcodeclass'] ) 				? $settings['shortcodeclass'] 																			: '' ;
		$item_num 				= !empty( $settings['item_num'] ) 						? ' data-items			= "' . $settings['item_num'] . '"' 						: '' ;
		$item_margin 			= !empty( $settings['item_margin']['size'] ) 			? ' data-margin		 	= "' . $settings['item_margin']['size'] . '"' 			: '' ;
		$items_stage_padding 	= !empty( $settings['items_stage_padding']['size'] ) 	? ' data-stagePadding	= "' . $settings['items_stage_padding']['size'] . '"' 	: '' ;
		$carousel_rtl 			= !empty( $settings['carousel_rtl'] ) 					? ' data-rtl 		 	= "' . $settings['carousel_rtl'] . '"' 					: '' ;
		$dots 					= !empty( $settings['dots'] == 'true' ) 				? ' data-dots			= "true"' 												: ' data-dots			= "false"' ;
		$navigation 			= !empty( $settings['navigation'] == 'true' ) 			? ' data-nav			= "true"'												: ' data-nav			= "false"' ;
		$nav_location 			= $settings['nav_location'] == 'sidebar_nav' 			? 'wn-cc-sidebar' 																: 'bottom' ;

		if ( $settings['enable_padding'] == 'true' ) {
			echo'<div class="wn-content-carousel-container">';
		}

		$tab_contents = '';
		if ( !empty( $settings['carousel_item'] ) ) :
			foreach ( $settings['carousel_item'] as $tab_item ) :
				$uniqid_2 = substr(uniqid(rand(),1),0,7);
				$tab_contents .= '<div id="' . $uniqid_2 . '" class="content-carousel">' . \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $tab_item['elementor_tpl_id'] ) . '</div>';
			endforeach;
		endif;

		?>

		<div id="wn-content-carousel" class=" wn-content-carousel <?php echo '' . $nav_location ?> content-carousel-<?php echo '' . $uniqid ?> <?php echo '' . $shortcodeclass; ?>" data-id="<?php echo '' . $uniqid ?>" >
			<div class="content-carousel-tab">
				<div class="tabs owl-carousel owl-theme" <?php echo '' . $carousel_rtl . $item_num . $item_margin . $items_stage_padding . $dots . $navigation?> >
					<?php echo $tab_contents; ?>
				</div>
			</div>
		</div>

		<?php

		if ( $settings['enable_padding'] == 'true' ) {
			echo'</div>';
		}

		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}

	}

}
