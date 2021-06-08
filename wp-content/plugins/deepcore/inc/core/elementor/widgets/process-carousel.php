<?php
namespace Elementor;

class Webnus_Element_Widgets_ProcessCarousel extends \Elementor\Widget_Base {

	/**
	 * Retrieve ProcessCarousel widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'process_carousel';

	}

	/**
	 * Retrieve ProcessCarousel widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return __( 'Webnus Process Carousel', 'deep' );

	}

	/**
	 * Retrieve ProcessCarousel widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-post-slider';

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

		return [ 'deep-owl-carousel', 'deep-process-carousel' ];

	}

	/**
	 * widget styles.
	 *
	 * @since 4.2.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'deep-owl-carousel', 'deep-process-carousel' ];

	}

	/**
	 * Register ProcessCarousel widget controls.
	 *
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
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		// Properties section
		$this->add_control(
			'process_item',
			[
				'label' 		=> __( 'Process Carousel Item', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::REPEATER,
				'fields' 		=> [ //params
					[
						'name' 			=> 'pc_title',
						'label' 		=> __( 'Process Title', 'deep' ),
						'type' 			=> \Elementor\Controls_Manager::TEXT,
						'admin_label' 	=> true,
					],
					[
						'name' 			=> 'pc_content',
						'label' 		=> __( 'Process Content', 'deep' ),
						'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
						'admin_label' 	=> true,
					],
				],
				'default' => [
					[
						'pc_title' => __( 'Process Title 1', 'deep' ),
						'pc_content' => __( 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.' , 'deep'),
					],
					[
						'pc_title' => __( 'Process Title 2', 'deep' ),
						'pc_content' => __( 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.' , 'deep'),
                    ],
                    [
						'pc_title' => __( 'Process Title 3', 'deep' ),
						'pc_content' => __( 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.' , 'deep'),
					],
				],
			]
		);

		$this->end_controls_section();

		// Custom css tab
		$this->start_controls_section(
			'custom_css_section',
			[
				'label' => __( 'Custom CSS', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'title_typography',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .process-carousel .process-item .process-title span',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .process-carousel .process-item .process-title span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .process-carousel .process-item .process-title span',
			]
		);
		$this->add_control(
			'title_padding',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel .process-item .process-title span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_margin',
			[
				'label' 		=> __( 'Margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel .process-item .process-title span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_opacity',
			[
				'label' => __( 'Opacity', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel .process-item .process-title span' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'title_display',
			[
				'label'     => __( 'Display', 'deep' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'inherit'      => __( 'Inherit', 'deep' ),
					'inline'       => __( 'inline', 'deep' ),
					'inline-block' => __( 'inline block', 'deep' ),
					'block'        => __( 'block', 'deep' ),
					'none'         => __( 'none', 'deep' ),
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel .process-item .process-title span' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel .process-item .process-title span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .process-carousel .process-item .process-title span',
			]
		);
		$this->add_control(
			'hover_title',
			[
				'label'     => __( 'Hover', 'deep' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'title_typography_hover',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .process-carousel:hover .process-item .process-title span',
			]
		);
		$this->add_control(
			'title_color_hover',
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .process-carousel:hover .process-item .process-title span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_bg_hover',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .process-carousel:hover .process-item .process-title span',
			]
		);
		$this->add_control(
			'title_padding_hover',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel:hover .process-item .process-title span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_margin_hover',
			[
				'label' 		=> __( 'Margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel:hover .process-item .process-title span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_opacity_hover',
			[
				'label' => __( 'Opacity', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel:hover .process-item .process-title span' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'title_display_hover',
			[
				'label'     => __( 'Display', 'deep' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'inherit'      => __( 'Inherit', 'deep' ),
					'inline'       => __( 'inline', 'deep' ),
					'inline-block' => __( 'inline block', 'deep' ),
					'block'        => __( 'block', 'deep' ),
					'none'         => __( 'none', 'deep' ),
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel:hover .process-item .process-title span' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_border_radius_hover',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel:hover .process-item .process-title span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_border_hover',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .process-carousel:hover .process-item .process-title span',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Content', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'content_typography',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .process-carousel .process-item .process-content p',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .process-carousel .process-item .process-content p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .process-carousel .process-item .process-content p',
			]
		);
		$this->add_control(
			'content_padding',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel .process-item .process-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'content_margin',
			[
				'label' 		=> __( 'Margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel .process-item .process-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'content_opacity',
			[
				'label' => __( 'Opacity', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel .process-item .process-content p' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'content_display',
			[
				'label'     => __( 'Display', 'deep' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'inherit'      => __( 'Inherit', 'deep' ),
					'inline'       => __( 'inline', 'deep' ),
					'inline-block' => __( 'inline block', 'deep' ),
					'block'        => __( 'block', 'deep' ),
					'none'         => __( 'none', 'deep' ),
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel .process-item .process-content p' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'content_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel .process-item .process-content p' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .process-carousel .process-item .process-content p',
			]
		);
		$this->add_control(
			'hover_content',
			[
				'label'     => __( 'Hover', 'deep' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'content_typography_hover',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .process-carousel:hover .process-item .process-content p',
			]
		);
		$this->add_control(
			'content_color_hover',
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .process-carousel:hover .process-item .process-content p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_bg_hover',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .process-carousel:hover .process-item .process-content p',
			]
		);
		$this->add_control(
			'content_padding_hover',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel:hover .process-item .process-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'content_margin_hover',
			[
				'label' 		=> __( 'Margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel:hover .process-item .process-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'content_opacity_hover',
			[
				'label' => __( 'Opacity', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel:hover .process-item .process-content p' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'content_display_hover',
			[
				'label'     => __( 'Display', 'deep' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'inherit'      => __( 'Inherit', 'deep' ),
					'inline'       => __( 'inline', 'deep' ),
					'inline-block' => __( 'inline block', 'deep' ),
					'block'        => __( 'block', 'deep' ),
					'none'         => __( 'none', 'deep' ),
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel:hover .process-item .process-content p' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'content_border_radius_hover',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel:hover .process-item .process-content p' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'content_border_hover',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .process-carousel:hover .process-item .process-content p',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_arrow_style',
			[
				'label' => __( 'Arrow', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'arrow_size',
			[
				'label' => __( 'Icon Size', 'deep' ),
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
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-prev .ol-pre:after,#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-next .ol-nxt:after' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'arrow_color',
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-prev .ol-pre:after,#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-next .ol-nxt:after' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'arrow_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-prev .ol-pre:after,#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-next .ol-nxt:after',
			]
		);
		$this->add_control(
			'arrow_padding',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-prev .ol-pre:after,#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-next .ol-nxt:after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'arrow_margin',
			[
				'label' 		=> __( 'Margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-prev .ol-pre:after,#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-next .ol-nxt:after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'arrow_opacity',
			[
				'label' => __( 'Opacity', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-prev .ol-pre:after,#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-next .ol-nxt:after' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'arrow_display',
			[
				'label'     => __( 'Display', 'deep' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'inherit'      => __( 'Inherit', 'deep' ),
					'inline'       => __( 'inline', 'deep' ),
					'inline-block' => __( 'inline block', 'deep' ),
					'block'        => __( 'block', 'deep' ),
					'none'         => __( 'none', 'deep' ),
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-prev .ol-pre:after,#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-next .ol-nxt:after' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'arrow_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-prev .ol-pre:after,#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-next .ol-nxt:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'arrow_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-prev .ol-pre:after,#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-next .ol-nxt:after',
			]
		);
		$this->add_control(
			'hover_arrow',
			[
				'label'     => __( 'Hover', 'deep' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'arrow_size_hover',
			[
				'label' => __( 'Icon Size', 'deep' ),
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
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-prev .ol-pre:hover:after,#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-next .ol-nxt:hover:after' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'arrow_color_hover',
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-prev .ol-pre:hover:after,#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-next .ol-nxt:hover:after' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'arrow_bg_hover',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-prev .ol-pre:hover:after,#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-next .ol-nxt:hover:after',
			]
		);
		$this->add_control(
			'arrow_padding_hover',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-prev .ol-pre:hover:after,#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-next .ol-nxt:hover:after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'arrow_margin_hover',
			[
				'label' 		=> __( 'Margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-prev .ol-pre:hover:after,#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-next .ol-nxt:hover:after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'arrow_opacity_hover',
			[
				'label' => __( 'Opacity', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-prev .ol-pre:hover:after,#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-next .ol-nxt:hover:after' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'arrow_display_hover',
			[
				'label'     => __( 'Display', 'deep' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'inherit'      => __( 'Inherit', 'deep' ),
					'inline'       => __( 'inline', 'deep' ),
					'inline-block' => __( 'inline block', 'deep' ),
					'block'        => __( 'block', 'deep' ),
					'none'         => __( 'none', 'deep' ),
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-prev .ol-pre:hover:after,#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-next .ol-nxt:hover:after' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'arrow_border_radius_hover',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-prev .ol-pre:hover:after,#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-next .ol-nxt:hover:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'arrow_border_hover',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-prev .ol-pre:hover:after,#wrap {{WRAPPER}} .process-carousel .owl-nav .owl-next .ol-nxt:hover:after',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_number_style',
			[
				'label' => __( 'Number', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'number_typography',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .process-carousel-num',
			]
		);
		$this->add_control(
			'number_color',
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .process-carousel-num' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'number_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .process-carousel-num',
			]
		);
		$this->add_control(
			'number_padding',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel-num' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'number_margin',
			[
				'label' 		=> __( 'Margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel-num' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'number_opacity',
			[
				'label' => __( 'Opacity', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel-num' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'number_display',
			[
				'label'     => __( 'Display', 'deep' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'inherit'      => __( 'Inherit', 'deep' ),
					'inline'       => __( 'inline', 'deep' ),
					'inline-block' => __( 'inline block', 'deep' ),
					'block'        => __( 'block', 'deep' ),
					'none'         => __( 'none', 'deep' ),
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel-num' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'number_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel-num' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'number_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .process-carousel-num',
			]
		);
		$this->add_control(
			'hover_number',
			[
				'label'     => __( 'Hover', 'deep' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'number_typography_hover',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .process-carousel-num:hover',
			]
		);
		$this->add_control(
			'number_color_hover',
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .process-carousel-num:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'number_bg_hover',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .process-carousel-num:hover',
			]
		);
		$this->add_control(
			'number_padding_hover',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel-num:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'number_margin_hover',
			[
				'label' 		=> __( 'Margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel-num:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'number_opacity_hover',
			[
				'label' => __( 'Opacity', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel-num:hover' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'number_display_hover',
			[
				'label'     => __( 'Display', 'deep' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'inherit'      => __( 'Inherit', 'deep' ),
					'inline'       => __( 'inline', 'deep' ),
					'inline-block' => __( 'inline block', 'deep' ),
					'block'        => __( 'block', 'deep' ),
					'none'         => __( 'none', 'deep' ),
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel-num:hover' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'number_border_radius_hover',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel-num:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'number_border_hover',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .process-carousel-num:hover',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'box_style',
			[
				'label' => __( 'Box Style', 'deep' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'box_bg',
				'label'    => __( 'Background', 'deep' ),
				'types'    => [ 'classic' , 'gradient' ],
				'selector' => '#wrap {{WRAPPER}} .process-carousel',
			]
		);
		$this->add_control(
			'box_display',
			[
				'label'     => __( 'Display', 'deep' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'inherit'      => __( 'Inherit', 'deep' ),
					'inline'       => __( 'inline', 'deep' ),
					'inline-block' => __( 'inline block', 'deep' ),
					'block'        => __( 'block', 'deep' ),
					'none'         => __( 'none', 'deep' ),
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .process-carousel',
			]
		);
		$this->add_control(
			'box_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .process-carousel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .process-carousel',
				]
		);
		$this->add_control(
			'box_padding',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .process-carousel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'box_margin',
			[
				'label' 		=> __( 'Margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .process-carousel' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'box_opacity',
			[
				'label' => __( 'Opacity', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'box_overflow ',
			[
				'label'     => __( 'Overflow', 'deep' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'inherit'   => __( 'inherit', 'deep' ),
					'scroll'    => __( 'scroll', 'deep' ),
					'hidden'    => __( 'hidden', 'deep' ),
					'auto' 		=> __( 'auto', 'deep' ),
					'auto'      => __( 'auto', 'deep' ),
					'visible'   => __( 'visible', 'deep' ),
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel' => 'overflow: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'hover_box',
			[
				'label'     => __( 'Hover', 'deep' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'box_bg_hover',
				'label'    => __( 'Background', 'deep' ),
				'types'    => [ 'classic' , 'gradient' ],
				'selector' => '#wrap {{WRAPPER}} .process-carousel:hover',
			]
		);
		$this->add_control(
			'box_display_hover',
			[
				'label'     => __( 'Display', 'deep' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'inherit'      => __( 'Inherit', 'deep' ),
					'inline'       => __( 'inline', 'deep' ),
					'inline-block' => __( 'inline block', 'deep' ),
					'block'        => __( 'block', 'deep' ),
					'none'         => __( 'none', 'deep' ),
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel:hover' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border_hover',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .process-carousel:hover',
			]
		);
		$this->add_control(
			'box_border_radius_hover',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .process-carousel:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow_hover',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .process-carousel:hover',
				]
		);
		$this->add_control(
			'box_padding_hover',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .process-carousel:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'box_margin_hover',
			[
				'label' 	  => __( 'Margin', 'deep' ),
				'type' 		  => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'  => [ 'px', 'em', '%' ],
				'selectors'   => [
					'#wrap {{WRAPPER}} .process-carousel:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'box_opacity_hover',
			[
				'label' => __( 'Opacity', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .process-carousel:hover' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->end_controls_section();

	}

	/**
	 * Render ProcessCarousel widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		$out ='
			<div id="process-carousel-wrap">
				<div id="process-carousel" class="process-carousel owl-carousel owl-theme colorb">';

				if ( $settings['process_item']  ) {

					foreach (  $settings['process_item'] as $item ) {

						$out .= '
						<div class="process-item">
							<div class="process-title">
								<span>' . $item['pc_title'] . '</span>
							</div>
							<div class="process-content">
								<p>' . $item['pc_content']. '</p>
							</div>
						</div>';

					}

				}

		$out .= '
				</div>
				<div class="process-carousel-num"></div>
			</div>';

        $custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}

		echo $out;

	}

}
