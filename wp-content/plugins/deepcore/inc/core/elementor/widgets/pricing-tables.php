<?php
namespace Elementor;
class Webnus_Element_Widgets_Pricing_Tables extends \Elementor\Widget_Base {

	/**
	 * Retrieve widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'pricing-tables';

	}

	/**
	 * Retrieve widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Pricing Tables', 'deep' );

	}

	/**
	 * Retrieve widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-price-table';

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
	 * Register widget controls.
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
				'label' => esc_html__( 'General', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		$this->add_control(
			'type',
			[
				'label'			=>  esc_html__( 'Type', 'deep' ),
				'type'			=> \Elementor\Controls_Manager::SELECT,
				'description'	=>  esc_html__( 'You can choose from these pre-designed types.', 'deep'),
				'options'		=> [
					'1'		=>	'Type 1',
					'2'		=>	'Type 2',
					'3'		=>	'Type 3',
					'4'		=>	'Type 4',
					'5'		=>	'Type 5',
					'6'		=>	'Type 6',
					'7'		=>	'Type 7',
					'8'		=>	'Type 8',
					'9'		=>	'Type 9',
					'10'	=>	'Type 10',
				],
				'default'	=> '1',
			]
		);

		$this->add_control(
			'title',
			[
				'label' 		=>  esc_html__( 'Title', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default'		=> esc_html__( 'Price Title' , 'deep' ),
				'description' 	=>  esc_html__( 'Pricing Table Title', 'deep'),
			]
		);

		$this->add_control(
			'description',
			[
				'label' 		=>  esc_html__( 'Header Description', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'description' 	=>  esc_html__( 'Pricing Table Description', 'deep'),
				'condition'		=>	[
					'type'	=>	[
						'4',
					],
				],
			]
		);

		$this->add_control(
			'price',
			[
				'label' 		=>  esc_html__( 'Price', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default'		=> esc_html__( '254$' , 'deep' ),
				'description' 	=>  esc_html__( 'Pricing Table Price', 'deep'),
				'default'		=>	'',
			]
		);

		$this->add_control(
			'price_symbol',
			[
				'label'       =>  esc_html__( 'Price Symbol', 'deep' ),
				'description'   =>  esc_html__( 'Pricing Symbol', 'deep'),
				'type'          => \Elementor\Controls_Manager::TEXT,
				'condition'    => [
					'type'	=>	[
						'7',
						'10',
					]
				]
			]
		);

		$this->add_control(
			'on_sale_price',
			[
				'label'       =>  esc_html__( 'Special Offer', 'deep' ),
				'description'   =>  esc_html__( 'Pricing Table Special Offer or On Sale Price', 'deep'),
				'type'          => \Elementor\Controls_Manager::TEXT,
				'condition'    => [
					'type'	=>	['1','2','3','4','5','6','7','10']
				]
			]
		);

		$this->add_control(
			'plan_label',
			[
				'label'       =>  esc_html__( 'Plan Label', 'deep' ),
				'description'   =>  esc_html__( 'Pricing Table Label', 'deep'),
				'type'          => \Elementor\Controls_Manager::TEXT,
				'condition'    => [
					'type'	=>	[
						'3',
						'5',
					]
				]
			]
		);

		$this->add_control(
			'label_bg_color',
			[
				'label'		=>  esc_html__( 'Label Color', 'deep' ),
				'description' 	=>  esc_html__( 'Select Custom Label Color', 'deep'),
				'type'			=> \Elementor\Controls_Manager::COLOR,
				'condition'	=> [
					'type'	=>	[
						'5'
					]
				],
				'selectors' => [
					'{{WRAPPER}} .pt-header' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .w-pricing-table' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'period',
			[
				'label' 		=>  esc_html__( 'Period', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'description' 	=>  esc_html__( 'Pricing Table Period', 'deep'),
			]
		);

		$this->add_control(
			'features',
			[
				'label' => esc_html__( 'Features', 'deep' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'description'	=>  esc_html__( 'Enter features for pricing table - value, title and color.', 'deep' ),
				'condition'	=>	[
					'type!'	=>	[
						'8',
						'9',
					]
				],
				'fields' => [
					[
						'name'	=> 'feature_icon',
						'label' =>  esc_html__( 'Feature Item Icon', 'deep' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'default',
						'options' => [
							'empty-icon'	 =>  esc_html__( 'Empty', 'deep' ),
							'available-icon'	=>	 esc_html__( 'Available', 'deep' ),
							'not-available-icon'	=>	 esc_html__( 'Not Available', 'deep' ),
						],
					],
					[
						'name' => 'feature_item',
						'label' =>  esc_html__( 'Feature Item Text', 'deep' ),
						'type' => \Elementor\Controls_Manager::TEXT,
					],
				],
				'default' => [
					[
						'feature_item' => __( 'Item 1', 'deep' ),
						'feature_icon' => 'available-icon',
					],
					[
						'feature_item' => __( 'Item 2', 'deep' ),
						'feature_icon' => 'available-icon',
                    ],
                    [
						'feature_item' => __( 'Item 3', 'deep' ),
						'feature_icon' => 'not-available-icon',
					],
				],
			]
		);

		$this->add_control(
			'content_text',
			[
				'label'		=>  esc_html__( 'Content Pricing Table Text', 'deep' ),
				'type'			=> \Elementor\Controls_Manager::TEXT,
				'condition'	=> [
					'type'	=>	[
						'8'
					]
				]
			]
		);

		$this->add_control(
			'footer_text',
			[
				'label'		=>  esc_html__( 'Footer Pricing Table Text', 'deep' ),
				'type'			=> \Elementor\Controls_Manager::TEXT,
				'condition'	=> [
					'type!'	=>	[
						'8',
						'9',
					]
				]
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'		=>  esc_html__( 'Button Text', 'deep' ),
				'type'			=> \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'button_url',
			[
				'label'		=>  esc_html__( 'Button URL', 'deep' ),
				'type'			=> \Elementor\Controls_Manager::URL,
				'description'	=>  esc_html__( 'Button URL (http://example.com)', 'deep' ),
			]
		);

		$this->add_control(
			'featured', 
			[
				'label' 		=>  esc_html__( 'Featured Plan?', 'deep' ), 
				'type' 			=> \Elementor\Controls_Manager::SWITCHER, 
				'label_on' 		=>  esc_html__( 'Yes', 'deep' ),
				'label_off' 	=>  esc_html__( 'No', 'deep' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
				'description'	=>  esc_html__( 'Pricing Tables Featured Plan', 'deep'),
				'condition'		=>	[
					'type!'	=>	[ '5', '8', '9', ]
				]
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Plan Icon', 'deep' ),
				'type' => \Elementor\Controls_Manager::ICON,
				'condition'	=>	[
					'type'	=>	['2']
					]
			]
		);

		$this->add_control(
			'heading_bg_color',
			[
				'label'		=>  esc_html__( 'Heading Background Color', 'deep' ),
				'description' 	=>  esc_html__( 'Select Custom Background Color', 'deep'),
				'type'			=> \Elementor\Controls_Manager::COLOR,
				'condition'	=> [
					'type'	=>	[
						'6'
					]
				],
				'selectors' => [
					'{{WRAPPER}} .pt-header' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .w-pricing-table' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'heading_text_color',
			[
				'label'		=>  esc_html__( 'Heading Text Color', 'deep' ),
				'description' 	=>  esc_html__( 'Select Custom Text Color', 'deep'),
				'type'			=> \Elementor\Controls_Manager::COLOR,
				'condition'	=> [
					'type'	=>	[
						'6'
					]
				],
				'selectors' => [
					'{{WRAPPER}} .pt-header h4 > small, {{WRAPPER}} .pt-header h3.plan-title, {{WRAPPER}} .pt-header h4.plan-price' => 'color: {{VALUE}};',
				],
			]
		);

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
				'selector' 	=> '#wrap {{WRAPPER}} .w-pricing-table .plan-title',
			]
		);		
		$this->add_control(
			'title_color', 
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,				
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .w-pricing-table .plan-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .w-pricing-table .plan-title',
			]
		);
		$this->add_control(
			'title_padding', 
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .w-pricing-table .plan-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .w-pricing-table .plan-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .w-pricing-table .plan-title' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .w-pricing-table .plan-title' => 'display: {{VALUE}};',
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
					'#wrap {{WRAPPER}} .w-pricing-table .plan-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .w-pricing-table .plan-title',
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
				'selector' 	=> '#wrap {{WRAPPER}} .w-pricing-table:hover .plan-title:hover',
			]
		);
		$this->add_control(
			'title_color_hover', 
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .w-pricing-table:hover .plan-title:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_bg_hover',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .w-pricing-table:hover .plan-title:hover',
			]
		);
		$this->add_control(
			'title_padding_hover', 
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .w-pricing-table:hover .plan-title:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .w-pricing-table:hover .plan-title:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .w-pricing-table:hover .plan-title:hover' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .w-pricing-table:hover .plan-title:hover' => 'display: {{VALUE}};',
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
					'#wrap {{WRAPPER}} .w-pricing-table:hover .plan-title:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_border_hover',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .w-pricing-table:hover .plan-title',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_price_style',
			[
				'label' => __( 'Price and Special Offer', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'price_typography',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .w-pricing-table .plan-price del, #wrap {{WRAPPER}} .w-pricing-table .plan-price span, #wrap {{WRAPPER}} .w-pricing-table .plan-price small',
			]
		);		
		$this->add_control(
			'price_color', 
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,				
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .w-pricing-table .plan-price del, #wrap {{WRAPPER}} .w-pricing-table .plan-price span, #wrap {{WRAPPER}} .w-pricing-table .plan-price small' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'price_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .w-pricing-table .plan-price del, #wrap {{WRAPPER}} .w-pricing-table .plan-price span, #wrap {{WRAPPER}} .w-pricing-table .plan-price small',
			]
		);
		$this->add_control(
			'price_padding', 
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .w-pricing-table .plan-price del, #wrap {{WRAPPER}} .w-pricing-table .plan-price span, #wrap {{WRAPPER}} .w-pricing-table .plan-price small' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'price_margin', 
			[
				'label' 		=> __( 'Margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .w-pricing-table .plan-price del, #wrap {{WRAPPER}} .w-pricing-table .plan-price span, #wrap {{WRAPPER}} .w-pricing-table .plan-price small' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		
		$this->add_control(
			'price_opacity',
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
					'#wrap {{WRAPPER}} .w-pricing-table .plan-price del, #wrap {{WRAPPER}} .w-pricing-table .plan-price span, #wrap {{WRAPPER}} .w-pricing-table .plan-price small' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'price_display',
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
					'#wrap {{WRAPPER}} .w-pricing-table .plan-price del, #wrap {{WRAPPER}} .w-pricing-table .plan-price span, #wrap {{WRAPPER}} .w-pricing-table .plan-price small' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'price_border_radius', 
			[
				'label' 		=> __( 'Border Radius', 'deep' ), 
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, 
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .w-pricing-table .plan-price del, #wrap {{WRAPPER}} .w-pricing-table .plan-price span, #wrap {{WRAPPER}} .w-pricing-table .plan-price small' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'price_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .w-pricing-table .plan-price del, #wrap {{WRAPPER}} .w-pricing-table .plan-price span, #wrap {{WRAPPER}} .w-pricing-table .plan-price small',
			]
		);
		$this->add_control(
			'price_sale',
			[
				'label'     => __( 'Price', 'deep' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'sale_typography',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .w-pricing-table h4.plan-price span',
			]
		);
		$this->add_control(
			'sale_color', 
			[
				'label' 		=> __( 'Color', 'deep' ), 
				'type' 			=> \Elementor\Controls_Manager::COLOR, 
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .w-pricing-table h4.plan-price span' => 'color: {{VALUE}} !important',
				],
			]
		);
		$this->add_control(
			'period_price',
			[
				'label'     => __( 'Period', 'deep' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'period_typography',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .w-pricing-table h4.plan-price small',
			]
		);
		$this->add_control(
			'period_color', 
			[
				'label' 		=> __( 'Color', 'deep' ), 
				'type' 			=> \Elementor\Controls_Manager::COLOR, 
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .w-pricing-table h4.plan-price small' => 'color: {{VALUE}} !important',
				],
			]
		);
		$this->add_control(
			'hover_price',
			[
				'label'     => __( 'Hover', 'deep' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'price_typography_hover',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .w-pricing-table:hover .plan-price del, #wrap {{WRAPPER}} .w-pricing-table:hover .plan-price span, #wrap {{WRAPPER}} .w-pricing-table:hover .plan-price small',
			]
		);
		$this->add_control(
			'price_color_hover', 
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .w-pricing-table:hover .plan-price del, #wrap {{WRAPPER}} .w-pricing-table:hover .plan-price span, #wrap {{WRAPPER}} .w-pricing-table:hover .plan-price small' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'price_bg_hover',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .w-pricing-table:hover .plan-price del, #wrap {{WRAPPER}} .w-pricing-table:hover .plan-price span, #wrap {{WRAPPER}} .w-pricing-table:hover .plan-price small',
			]
		);
		$this->add_control(
			'price_padding_hover', 
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .w-pricing-table:hover .plan-price del, #wrap {{WRAPPER}} .w-pricing-table:hover .plan-price span, #wrap {{WRAPPER}} .w-pricing-table:hover .plan-price small' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'price_margin_hover', 
			[
				'label' 		=> __( 'Margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .w-pricing-table:hover .plan-price del, #wrap {{WRAPPER}} .w-pricing-table:hover .plan-price span, #wrap {{WRAPPER}} .w-pricing-table:hover .plan-price small' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);	
		$this->add_control(
			'price_opacity_hover',
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
					'#wrap {{WRAPPER}} .w-pricing-table:hover .plan-price del, #wrap {{WRAPPER}} .w-pricing-table:hover .plan-price span, #wrap {{WRAPPER}} .w-pricing-table:hover .plan-price small' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'price_display_hover',
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
					'#wrap {{WRAPPER}} .w-pricing-table:hover .plan-price del, #wrap {{WRAPPER}} .w-pricing-table:hover .plan-price span, #wrap {{WRAPPER}} .w-pricing-table:hover .plan-price small' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'price_border_radius_hover', 
			[
				'label' 		=> __( 'Border Radius', 'deep' ), 
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, 
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .w-pricing-table:hover .plan-price del, #wrap {{WRAPPER}} .w-pricing-table:hover .plan-price span, #wrap {{WRAPPER}} .w-pricing-table:hover .plan-price small' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'price_border_hover',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .w-pricing-table:hover .plan-price del, #wrap {{WRAPPER}} .w-pricing-table:hover .plan-price span, #wrap {{WRAPPER}} .w-pricing-table:hover .plan-price small',
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_features_style',
			[
				'label' => __( 'Features', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'features_typography',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .w-pricing-table .feature-item',
			]
		);		
		$this->add_control(
			'features_color', 
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,				
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .w-pricing-table .feature-item' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'features_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .w-pricing-table .feature-item',
			]
		);
		$this->add_control(
			'features_padding', 
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .w-pricing-table .feature-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'features_margin', 
			[
				'label' 		=> __( 'Margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .w-pricing-table .feature-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		
		$this->add_control(
			'features_opacity',
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
					'#wrap {{WRAPPER}} .w-pricing-table .feature-item' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'features_display',
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
					'#wrap {{WRAPPER}} .w-pricing-table .feature-item' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'features_border_radius', 
			[
				'label' 		=> __( 'Border Radius', 'deep' ), 
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, 
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .w-pricing-table .feature-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'features_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .w-pricing-table .feature-item',
			]
		);
		$this->add_control(
			'hover_features',
			[
				'label'     => __( 'Hover', 'deep' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'features_typography_hover',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .w-pricing-table .feature-item:hover',
			]
		);
		$this->add_control(
			'features_color_hover', 
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .w-pricing-table .feature-item:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'features_bg_hover',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .w-pricing-table .feature-item:hover',
			]
		);
		$this->add_control(
			'features_padding_hover', 
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .w-pricing-table .feature-item:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'features_margin_hover', 
			[
				'label' 		=> __( 'Margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .w-pricing-table .feature-item:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);	
		$this->add_control(
			'features_opacity_hover',
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
					'#wrap {{WRAPPER}} .w-pricing-table .feature-item:hover' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'features_display_hover',
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
					'#wrap {{WRAPPER}} .w-pricing-table .feature-item:hover' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'features_border_radius_hover', 
			[
				'label' 		=> __( 'Border Radius', 'deep' ), 
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, 
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .w-pricing-table .feature-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'features_border_hover',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .w-pricing-table .feature-item:hover',
			]
		);
		$this->end_controls_section();		
		
		$this->start_controls_section(
			'section_button_style',
			[
				'label' => __( 'Button', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'button_typography',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .w-pricing-table .pt-footer a.magicmore',
			]
		);		
		$this->add_control(
			'button_color', 
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,				
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .w-pricing-table .pt-footer a.magicmore' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .w-pricing-table .pt-footer a.magicmore',
			]
		);
		$this->add_control(
			'button_padding', 
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .w-pricing-table .pt-footer a.magicmore' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .w-pricing-table .pt-footer a.magicmore' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .w-pricing-table .pt-footer a.magicmore' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .w-pricing-table .pt-footer a.magicmore' => 'display: {{VALUE}};',
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
					'#wrap {{WRAPPER}} .w-pricing-table .pt-footer a.magicmore' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .w-pricing-table .pt-footer a.magicmore',
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
				'selector' 	=> '#wrap {{WRAPPER}} .w-pricing-table .pt-footer a.magicmore:hover',
			]
		);
		$this->add_control(
			'button_color_hover', 
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .w-pricing-table .pt-footer a.magicmore:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_hover',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .w-pricing-table .pt-footer a.magicmore:hover',
			]
		);
		$this->add_control(
			'button_padding_hover', 
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .w-pricing-table .pt-footer a.magicmore:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .w-pricing-table .pt-footer a.magicmore:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .w-pricing-table .pt-footer a.magicmore:hover' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .w-pricing-table .pt-footer a.magicmore:hover' => 'display: {{VALUE}};',
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
					'#wrap {{WRAPPER}} .w-pricing-table .pt-footer a.magicmore:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border_hover',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .w-pricing-table .pt-footer a.magicmore:hover',
			]
		);
		$this->end_controls_section();		
		
		$this->start_controls_section(
			'section_footer_text_style',
			[
				'label' => __( 'Footer Text', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'footer_text_typography',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .w-pricing-table .pt-footer p',
			]
		);		
		$this->add_control(
			'footer_text_color', 
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,				
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .w-pricing-table .pt-footer p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'footer_text_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .w-pricing-table .pt-footer p',
			]
		);
		$this->add_control(
			'footer_text_padding', 
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .w-pricing-table .pt-footer p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'footer_text_margin', 
			[
				'label' 		=> __( 'Margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .w-pricing-table .pt-footer p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		
		$this->add_control(
			'footer_text_opacity',
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
					'#wrap {{WRAPPER}} .w-pricing-table .pt-footer p' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'footer_text_display',
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
					'#wrap {{WRAPPER}} .w-pricing-table .pt-footer p' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'footer_text_border_radius', 
			[
				'label' 		=> __( 'Border Radius', 'deep' ), 
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, 
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .w-pricing-table .pt-footer p' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'footer_text_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .w-pricing-table .pt-footer p',
			]
		);
		$this->add_control(
			'hover_footer_text',
			[
				'label'     => __( 'Hover', 'deep' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'footer_text_typography_hover',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .w-pricing-table:hover .pt-footer p',
			]
		);
		$this->add_control(
			'footer_text_color_hover', 
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .w-pricing-table:hover .pt-footer p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'footer_text_bg_hover',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .w-pricing-table:hover .pt-footer p',
			]
		);
		$this->add_control(
			'footer_text_padding_hover', 
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .w-pricing-table:hover .pt-footer p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'footer_text_margin_hover', 
			[
				'label' 		=> __( 'Margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .w-pricing-table:hover .pt-footer p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);	
		$this->add_control(
			'footer_text_opacity_hover',
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
					'#wrap {{WRAPPER}} .w-pricing-table:hover .pt-footer p' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'footer_text_display_hover',
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
					'#wrap {{WRAPPER}} .w-pricing-table:hover .pt-footer p' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'footer_text_border_radius_hover', 
			[
				'label' 		=> __( 'Border Radius', 'deep' ), 
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, 
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .w-pricing-table:hover .pt-footer p' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'footer_text_border_hover',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .w-pricing-table:hover .pt-footer p',
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
				'selector' => '#wrap {{WRAPPER}} .w-pricing-table',
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
					'#wrap {{WRAPPER}} .w-pricing-table' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .w-pricing-table',
			]
		);
		$this->add_control(
			'box_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .w-pricing-table' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .w-pricing-table',
				]
		);
		$this->add_control(
			'box_padding',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .w-pricing-table' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .w-pricing-table' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .w-pricing-table' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .w-pricing-table' => 'overflow: {{VALUE}};',
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
				'selector' => '#wrap {{WRAPPER}} .w-pricing-table:hover',
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
					'#wrap {{WRAPPER}} .w-pricing-table:hover' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border_hover',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .w-pricing-table:hover',
			]
		);
		$this->add_control(
			'box_border_radius_hover',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .w-pricing-table:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);			
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow_hover',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .w-pricing-table:hover',
				]
		);
		$this->add_control(
			'box_padding_hover',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .w-pricing-table:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .w-pricing-table:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .w-pricing-table:hover' => 'opacity: {{SIZE}};',
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
	 * Render Sermon Category widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings();

		wp_enqueue_style( 'wn-deep-pricing-table0', DEEP_ASSETS_URL . 'css/frontend/pricing-table/pricing-table0.css' );
		wp_enqueue_style( 'wn-deep-pricing-table' . $settings['type'], DEEP_ASSETS_URL . 'css/frontend/pricing-table/pricing-table' . $settings['type'] . '.css' );

		// variables
		$shortcodeclass 	= 	$settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
		$shortcodeid		= 	$settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';
		$type				=	$settings['type'];
		$title				=	$settings['title'];
		$description		=	$settings['description'];
		$price				=	$settings['price'];
		$price_symbol		=	$settings['price_symbol'];
		$on_sale_price		=	$settings['on_sale_price'];
		$plan_label			=	$settings['plan_label'];
		$period				=	$settings['period'];
		$features			=	$settings['features'];
		$content_text		=	$settings['content_text'];
		$button_text		=	$settings['button_text'];
		$button_url			=	$settings['button_url']['url'];
		$button_target		=	$settings['button_url']['is_external'] ? 'target="_blank"' : '';
		$button_nofolow		=	$settings['button_url']['nofollow'] ? ' rel="nofollow"' : '' ;
		$icon				=	$settings['icon'];

		$link_target_tag = '';
		if ( $settings['button_url']['is_external'] == 'true' ){
				$link_target_tag = ' target="_blank" ';
		}

		static $uniqid = 0;
		$uniqid++;
		$featured 		= $settings['featured'] ? ' featured' : '';
		$footer_text	= $settings['footer_text'] ? '<p>' . $settings['footer_text'] . '</p>' : '';
		if ( $on_sale_price ) :
			$temp_price		= $price;
			$price			= $on_sale_price;
			$on_sale_price	= '<del>' . $temp_price . '</del>';
		endif;
		if ( $type != '6' ) {
			$period = $period ? '<small>/' . esc_html( $period ) . '</small>' : '';
		}else{
			$period = $period ? $period : '';
		}


		// features loop
		$features_data	= array();
		$features_out	= '';

		// Fetch Carousle Item Loop Variables
		if ($features) {
			$features_out .= '<ul class="pt-features">';
			foreach ( $features as $data ) :
				$line 					= $data;
				$line['feature_icon']	= isset( $data['feature_icon'] ) ? $data['feature_icon'] : '';
				$line['feature_item']	= isset( $data['feature_item'] ) ? $data['feature_item'] : '';
				$features_out .= '<li class="feature-item"><span class="feature-icon ' . esc_html( $line['feature_icon'] ) . '"></span>' . esc_html( $line['feature_item'] ) . '</li>';
			endforeach;
			$features_out .= '</ul>';
		}


		// footer cache
		$background_color = "";

		if( $type == '8'){
			$background_color = "colorb";
		}

		$footer_out = '<div class="pt-footer">' . $footer_text;
		if ( !empty( $button_text ) ) {
			$footer_out .= '<a href="' . esc_url( $button_url ) . '" class="magicmore ' .$background_color. '" ' . $link_target_tag . $button_target . $button_nofolow . '>' . esc_html( $button_text ) . '</a>';
		}
		$footer_out .= '</div>';

		// render
		$out = '<div class="w-pricing-table w-pricing-table-' . $uniqid . ' pt-type' . esc_html( $type ) . esc_html( $featured ) . ' ' . $shortcodeclass . '"  ' . $shortcodeid . '>';
			switch ( $type ) :
				case '1':
				case '3':
				case '7':
				case '10':
					$plan_label	  = ( $type == 3 && $plan_label ) ? '<span class="plan-label">' . $plan_label . '</span>' : '';
					$price_symbol = ( ( $type == 7 || $type == 10 ) && $price_symbol ) ? '<span class="price-symbol">' . esc_html( $price_symbol ) . '</span>': '';
					$out .= '
					<div class="pt-header">
						<h3 class="plan-title">' . esc_html( $title ) . '</h3>
						<h4 class="plan-price">
							' . $on_sale_price . '
							' . $price_symbol . '
							<span>' . esc_html( $price ) . '</span>
							' . $period . '
						</h4>
					' . $plan_label . '
					</div>
					' . $features_out . '
					' . $footer_out . '';
				break;

				case '2':
					$out .= '
					<span class="icon vc_icon_element-icon ' . $icon . '"></span>
					<h3 class="plan-title">' . esc_html( $title ) . '</h3>
					' . $features_out . '
					<h4 class="pt-price plan-price">
						' . $on_sale_price . '
						<span>' . esc_html( $price ) . '</span>
						' . $period . '</h4>
						' . $footer_out . '';
				break;

				case '4':
					$out .= '
					<div class="pt-header">
						<h3 class="plan-title">' . esc_html( $title ) . '</h3>
						<h6 class="plan-desc">' . esc_html( $description ) . '</h6>
					</div>
					' . $features_out . '
					<div class="pt-price">
						<h4 class="plan-price"><span>' . $on_sale_price . esc_html( $price ) . '</span>' . $period . '</h4>

					</div>
					' . $footer_out . '';
				break;

				case '5':
					$plan_label  = $plan_label ? '<span>' . $plan_label . '</span>' : '';
					$out .= '
					<div class="pt-header">
						' . $plan_label . '
						<h3 class="plan-title">' . esc_html( $title ) . '</h3>
						<h4 class="plan-price"><span>' . $on_sale_price . esc_html( $price ) . '</span>' . $period . '</h4>

					</div>
					' . $features_out . '
					' . $footer_out . '';
				break;

				case '6':
					$out .= '
					<div class="pt-header">
						<h3 class="plan-title">' . esc_html( $title ) . '</h3>
						<h4 class="plan-price"><span>' . esc_html( $price ) . '</span><small>/' . esc_html( $period ) . '</small></h4>
						' . $on_sale_price . '
					</div>
					' . $features_out . '
					' . $footer_out . '';
				break;

				case '8':
					$out .= '
						<div class="pt-header">
						<h3 class="plan-title">' . esc_html( $title ) . '<span class="plan-title-line"></span></h3>
						<h4 class="plan-price"><span>' . esc_html( $price ) . '</span>' . $period . '</h4>
						' . $on_sale_price . '
						</div>
						<div class="pt-content">' . $content_text . '</div>
						' . $footer_out . '';
				break;

				case '9':
					$out .= '
					<h3 class="plan-title">' . esc_html( $title ) . '</h3>
					<h4 class="pt-price plan-price"><span>' . esc_html( $price ) . '</span>' . $period . '</h4>
					' . $on_sale_price . '
					' . $footer_out . '';
				break;

			endswitch;

		$out .= '</div>';
		
		$custom_css = $settings['custom_css'];
		
		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}

		echo $out;

	}

}
