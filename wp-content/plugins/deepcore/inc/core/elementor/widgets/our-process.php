<?php
namespace Elementor;

class Webnus_Element_Widgets_Our_Process extends \Elementor\Widget_Base {

	/**
	 * Retrieve Socials widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'our_process';

	}

	/**
	 * Retrieve Socials widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Our Process', 'deep' );

	}

	/**
	 * Retrieve Socials widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'pe-7s-refresh-2';

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
	 * Register Socials widget controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		// Content Tab
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'General', 'deep' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		// Select Socials Type
		$this->add_control(
			'type', 
			[
				'label'   => esc_html__( 'Type', 'deep' ), 
				'type'    => Controls_Manager::SELECT, 
				'default' => '1',
				'options' => [
					'1' => esc_html__( 'Type 1', 'deep' ),
					'2' => esc_html__( 'Type 2', 'deep' ),
					'3' => esc_html__( 'Type 3', 'deep' ),
				],
			]
		);
		$this->add_control(
			'process_item',
			[
				'label'     => esc_html__( 'Repeater List', 'deep' ),
				'type'      => Controls_Manager::REPEATER,
				'fields'    => [
					[
						'name'        => 'process_title',
						'label'       => esc_html__( 'Process Title', 'deep' ),
						'type'        => Controls_Manager::TEXT,
						'label_block' => true,
					],
					[
						'name'        => 'process_content',
						'label'       => esc_html__( 'Process Content', 'deep' ),
						'type'        => Controls_Manager::TEXTAREA,
						'label_block' => true,
					],
					[
						'name'        => 'icon_fontawesome',
						'label'       => __( 'Icon', 'deep' ),
						'type'        => Controls_Manager::ICON,
						'label_block' => true,
					],
				],
				'condition' => [
					'type' => [
						'1',
					],
				],
				'default'   => [
					[
						'process_title'    => __( 'Item 1', 'deep' ),
						'process_content'  => __( 'making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 'deep' ),
						'icon_fontawesome' => 'li_cloud',
					],
					[
						'process_title'    => __( 'Item 1', 'deep' ),
						'process_content'  => __( 'making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 'deep' ),
						'icon_fontawesome' => 'li_star',
					],
					[
						'process_title'    => __( 'Item 1', 'deep' ),
						'process_content'  => __( 'making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 'deep' ),
						'icon_fontawesome' => 'li_cloud',
					],
				],
			]
		);
		$this->add_control(
			'process_item_t2',
			[
				'label'     => esc_html__( 'Repeater List', 'deep' ),
				'type'      => Controls_Manager::REPEATER,
				'fields'    => [
					[
						'name'        => 'process_title_t2',
						'label'       => esc_html__( 'Process Title', 'deep' ),
						'type'        => Controls_Manager::TEXT,
						'label_block' => true,
					],
					[
						'name'        => 'process_content_t2',
						'label'       => esc_html__( 'Process Content', 'deep' ),
						'type'        => Controls_Manager::TEXTAREA,
						'label_block' => true,
					],
					[
						'name'        => 'line_flag_t2',
						'label'       => esc_html__( 'Line Number or Text', 'deep' ),
						'type'        => Controls_Manager::TEXT,
						'label_block' => true,
					],
				],
				'condition' => [
					'type' => [
						'2',
					],
				],
			]
		);
		$this->add_control(
			'process_item_t3',
			[
				'label'     => esc_html__( 'Repeater List', 'deep' ),
				'type'      => Controls_Manager::REPEATER,
				'fields'    => [
					[
						'name'        => 'process_title_t3',
						'label'       => esc_html__( 'Process Top Title', 'deep' ),
						'type'        => Controls_Manager::TEXT,
						'label_block' => true,
					],
					[
						'name'        => 'process_title_top_t3',
						'label'       => esc_html__( 'Process Title', 'deep' ),
						'type'        => Controls_Manager::TEXT,
						'label_block' => true,
					],				
					[
						'name'        => 'process_content_t3',
						'label'       => esc_html__( 'Process Content', 'deep' ),
						'type'        => Controls_Manager::TEXTAREA,
						'label_block' => true,
					],					
					[
						'name'        => 'teaser_btn',
						'label'       => esc_html__( 'Button Text', 'deep' ),
						'type'        => Controls_Manager::TEXT,
						'label_block' => true,
					],
					[
						'name'          => 'link_url',
						'label'         => esc_html__( 'Link URL', 'deep' ),
						'type'          => Controls_Manager::URL,
						'default'       => [
							'url'         => 'http://',
							'is_external' => '',
						],
						'show_external' => true,
					],
				],
				'condition' => [
					'type' => [
						'3',
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
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'shortcodeclass',
			[
				'label' => esc_html__( 'Extra Class', 'deep' ),
				'type'  => Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'shortcodeid',
			[
				'label' => esc_html__( 'ID', 'deep' ),
				'type'  => Controls_Manager::TEXT,
			]
		);
		$this->end_controls_section();

		// Style		
		$this->start_controls_section(
			'section_icon_number_style',
			[
				'label' => __( 'Icon and Number', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'icon_number_typography',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item  i, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type2 span, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type3 span',
			]
		);		
		$this->add_control(
			'icon_number_color', 
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,				
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item  i, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type2 span, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type3 span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'icon_number_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item  i, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type2 span, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type3 span',
			]
		);
		$this->add_control(
			'icon_number_padding', 
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item  i, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type2 span, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type3 span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_number_margin', 
			[
				'label' 		=> __( 'Margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item  i, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type2 span, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type3 span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		
		$this->add_control(
			'icon_number_opacity',
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
					'#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item  i, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type2 span, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type3 span' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'icon_number_display',
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
					'#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item  i, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type2 span, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type3 span' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_number_border_radius', 
			[
				'label' 		=> __( 'Border Radius', 'deep' ), 
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, 
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item  i, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type2 span, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type3 span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_number_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item  i, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type2 span, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type3 span',
			]
		);
		$this->add_control(
			'hover_icon_number',
			[
				'label'     => __( 'Hover', 'deep' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'icon_number_typography_hover',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item:hover  i, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type2:hover span, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type3:hover span',
			]
		);
		$this->add_control(
			'icon_number_color_hover', 
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item:hover  i, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type2:hover span, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type3:hover span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'icon_number_bg_hover',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item:hover  i, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type2:hover span, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type3:hover span',
			]
		);
		$this->add_control(
			'icon_number_padding_hover', 
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item:hover  i, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type2:hover span, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type3:hover span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_number_margin_hover', 
			[
				'label' 		=> __( 'Margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item:hover  i, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type2:hover span, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type3:hover span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);	
		$this->add_control(
			'icon_number_opacity_hover',
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
					'#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item:hover  i, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type2:hover span, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type3:hover span' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'icon_number_display_hover',
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
					'#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item:hover  i, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type2:hover span, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type3:hover span' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_number_border_radius_hover', 
			[
				'label' 		=> __( 'Border Radius', 'deep' ), 
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, 
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item:hover  i, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type2:hover span, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type3:hover span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_number_border_hover',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item:hover  i, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type2:hover span, #wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item-type3:hover span',
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
				'selector' 	=> '#wrap {{WRAPPER}} .our-process-wrap-ele h4',
			]
		);		
		$this->add_control(
			'title_color', 
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,				
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .our-process-wrap-ele h4' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .our-process-wrap-ele h4',
			]
		);
		$this->add_control(
			'title_padding', 
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .our-process-wrap-ele h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .our-process-wrap-ele h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .our-process-wrap-ele h4' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .our-process-wrap-ele h4' => 'display: {{VALUE}};',
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
					'#wrap {{WRAPPER}} .our-process-wrap-ele h4' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .our-process-wrap-ele h4',
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
				'selector' 	=> '#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item:hover h4',
			]
		);
		$this->add_control(
			'title_color_hover', 
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item:hover h4' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_bg_hover',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item:hover h4',
			]
		);
		$this->add_control(
			'title_padding_hover', 
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item:hover h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item:hover h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item:hover h4' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item:hover h4' => 'display: {{VALUE}};',
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
					'#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item:hover h4' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_border_hover',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item:hover h4',
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
				'selector' 	=> '#wrap {{WRAPPER}} .our-process-wrap-ele p',
			]
		);		
		$this->add_control(
			'content_color', 
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,				
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .our-process-wrap-ele p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .our-process-wrap-ele p',
			]
		);
		$this->add_control(
			'content_padding', 
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .our-process-wrap-ele p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .our-process-wrap-ele p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .our-process-wrap-ele p' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .our-process-wrap-ele p' => 'display: {{VALUE}};',
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
					'#wrap {{WRAPPER}} .our-process-wrap-ele p' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .our-process-wrap-ele p',
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
				'selector' 	=> '#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item:hover p',
			]
		);
		$this->add_control(
			'content_color_hover', 
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item:hover p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_bg_hover',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item:hover p',
			]
		);
		$this->add_control(
			'content_padding_hover', 
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item:hover p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item:hover p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item:hover p' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item:hover p' => 'display: {{VALUE}};',
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
					'#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item:hover p' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'content_border_hover',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .our-process-wrap-ele .our-process-item:hover p',
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_button_style',
			[
				'label' => __( 'Button', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' => [
						'3',
					],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'button_typography',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .our-process-item-type3 a',
			]
		);		
		$this->add_control(
			'button_color', 
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,				
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .our-process-item-type3 a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .our-process-item-type3 a',
			]
		);
		$this->add_control(
			'button_padding', 
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .our-process-item-type3 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_margin', 
			[
				'label' 		=> __( 'Margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .our-process-item-type3 a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		
		$this->add_control(
			'button_opacity',
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
					'#wrap {{WRAPPER}} .our-process-item-type3 a' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'button_display',
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
					'#wrap {{WRAPPER}} .our-process-item-type3 a' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_border_radius', 
			[
				'label' 		=> __( 'Border Radius', 'deep' ), 
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, 
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .our-process-item-type3 a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .our-process-item-type3 a',
			]
		);
		$this->add_control(
			'hover_button',
			[
				'label'     => __( 'Hover', 'deep' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'button_typography_hover',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .our-process-item-type3 a:hover',
			]
		);
		$this->add_control(
			'button_color_hover', 
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .our-process-item-type3 a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_hover',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .our-process-item-type3 a:hover',
			]
		);
		$this->add_control(
			'button_padding_hover', 
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .our-process-item-type3 a:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_margin_hover', 
			[
				'label' 		=> __( 'Margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .our-process-item-type3 a:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);	
		$this->add_control(
			'button_opacity_hover',
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
					'#wrap {{WRAPPER}} .our-process-item-type3 a:hover' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'button_display_hover',
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
					'#wrap {{WRAPPER}} .our-process-item-type3 a:hover' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_border_radius_hover', 
			[
				'label' 		=> __( 'Border Radius', 'deep' ), 
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, 
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .our-process-item-type3 a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border_hover',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .our-process-item-type3 a:hover',
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
				'selector' => '#wrap {{WRAPPER}} .our-process-wrap-ele',
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
					'#wrap {{WRAPPER}} .our-process-wrap-ele' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .our-process-wrap-ele',
			]
		);
		$this->add_control(
			'box_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .our-process-wrap-ele' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .our-process-wrap-ele',
				]
		);
		$this->add_control(
			'box_padding',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .our-process-wrap-ele' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .our-process-wrap-ele' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .our-process-wrap-ele' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .our-process-wrap-ele' => 'overflow: {{VALUE}};',
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
				'selector' => '#wrap {{WRAPPER}} .our-process-wrap-ele:hover',
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
					'#wrap {{WRAPPER}} .our-process-wrap-ele:hover' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border_hover',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .our-process-wrap-ele:hover',
			]
		);
		$this->add_control(
			'box_border_radius_hover',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .our-process-wrap-ele:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);			
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow_hover',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .our-process-wrap-ele:hover',
				]
		);
		$this->add_control(
			'box_padding_hover',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .our-process-wrap-ele:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .our-process-wrap-ele:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .our-process-wrap-ele:hover' => 'opacity: {{SIZE}};',
				],
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
	 * Render Socials widget output on the frontend.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings();

		wp_enqueue_style( 'wn-deep-our-process' . $settings['type'], DEEP_ASSETS_URL . 'css/frontend/our-process/our-process' . $settings['type'] . '.css' );

		$type            = $settings['type'];
		$process_item    = $settings['process_item'];
		$process_item_t2 = $settings['process_item_t2'];
		$process_item_t3 = $settings['process_item_t3'];

		// Class & ID
		$shortcodeclass = $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
		$shortcodeid    = $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';

		// render
		if ( $type == '1' ) {
			$out = '<div class="our-process-wrap-ele our-process-wrap ' . $shortcodeclass . '"  ' . $shortcodeid . '>';
			if ( $process_item ) {
				foreach ( $process_item as $line ) :
					$icon_fontawesome = isset( $line['icon_fontawesome'] ) ? $line['icon_fontawesome'] : '';
					$process_title    = isset( $line['process_title'] ) ? $line['process_title'] : '';
					$process_content  = isset( $line['process_content'] ) ? $line['process_content'] : '';
					$out             .= '
                        <div class="our-process-item ">
                            <i class="' . $icon_fontawesome . '"></i>
                            <h4>' . $process_title . '</h4>
                            <p>' . $process_content . '</p>
                        </div>';
				endforeach;
			}
			$out .= '</div>';
		} elseif ( $type == '2' ) {
			$out = '<div class= "our-process-wrap-ele our-process-wrap-type2 ' . $shortcodeclass . '"  ' . $shortcodeid . '>';
			if ( $process_item_t2 ) {
				foreach ( $process_item_t2 as $line ) :
					$line_flag_t2       = isset( $line['line_flag_t2'] ) ? $line['line_flag_t2'] : '';
					$process_title_t2   = isset( $line['process_title_t2'] ) ? $line['process_title_t2'] : '';
					$process_content_t2 = isset( $line['process_content_t2'] ) ? $line['process_content_t2'] : '';
					$out               .= '
                        <div class="our-process-item-type2">
                            <span>' . $line_flag_t2 . '</span>
                            <h4>' . $process_title_t2 . '</h4>
                            <p>' . $process_content_t2 . '</p>
                        </div>';
				endforeach;
			}
			$out .= '</div>';
		} elseif ( $type == '3' ) {
			$out = '<div class= "our-process-wrap-ele our-process-wrap-type3 ' . $shortcodeclass . '"  ' . $shortcodeid . '>';
			if ( $process_item_t3 ) {
				foreach ( $process_item_t3 as $line ) :
					$process_title_t3     = $line['process_title_t3'] ? $line['process_title_t3'] : '';
					$process_title_top_t3 = $line['process_title_top_t3'] ? $line['process_title_top_t3'] : '';
					$process_content_t3   = $line['process_content_t3'] ? $line['process_content_t3'] : '';
					$link_url             = $line['link_url']['url'] ? $line['link_url']['url'] : '';
					$link_target          = $line['link_url']['is_external'] ? 'target="_blank"' : '';
					$nofollow             = $line['link_url']['nofollow'] ? 'rel="nofollow"' : '';
					$teaser_btn           = $line['teaser_btn'] ? $line['teaser_btn'] : '';

					$out .= '
                        <div class="our-process-item-type3">
                            <span>' . $process_title_t3 . '</span>
                            <h4>' . $process_title_top_t3 . '</h4>
							<p>' . $process_content_t3 . '</p>';
					if ( ! empty( $teaser_btn ) ) :
						$out .= '
							<a href="' . $link_url . '" ' . $link_target . ' ' . $nofollow . '>' . $teaser_btn . '</a>';
					endif;
						$out .= '
						</div>';
				endforeach;
			}
			$out .= '</div>';
		}

		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>' . $custom_css . '</style>';
		}

		echo $out;
	}
}
