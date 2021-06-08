<?php
namespace Elementor;
use \Elementor\Utils;
class Webnus_Element_Widgets_Food_Menu extends \Elementor\Widget_Base {

	/**
	 * Retrieve Socials widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'food_menu';
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

		return esc_html__( 'Webnus Food Menu', 'deep' );

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

		return 'li_food';

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

		return [ 'food-menu' ];
		
	}

	/**
	 * widget styles.
	 *
	 * @since 4.2.0
	 * @access public
	 *
	 */
	public function get_style_depends() {
		
		return [ 'wn-deep-food-menu' ];

	}

	/**
	 * Register Socials widget controls.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

        // Content Tab
		$this->start_controls_section(
			'content_sectiona',
			[
				'label' => esc_html__( 'Type Settings', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		// Select Socials Type
		$this->add_control(
			'type', //param_name
			[
				'label' 	=> esc_html__( 'Type', 'deep' ), //heading
				'type' 		=> Controls_Manager::SELECT, //type
				'default' 	=> '1',
				'options' 	=> [
                   		 '1'  	=> esc_html__( 'Type 1', 'deep' ),
                   		 '2'  	=> esc_html__( 'Type 2', 'deep' ),
                   		 '3'  	=> esc_html__( 'Type 3', 'deep' ),
                   		 '4'  	=> esc_html__( 'Type 4', 'deep' ),
                   		 '5'  	=> esc_html__( 'Type 5', 'deep' ),
				],
			]
		);

		// Food Menu Image
		$this->add_control(
			'img',
			[
				'label' 		=> esc_html__( 'Food Menu Image', 'deep' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
							'url' 		=> Utils::get_placeholder_image_src(),
                ],
                'condition'     => [
                        'type'     => [
                            '1', '3', '4', '5'
                        ],
                ],  
			]
		);

		$this->add_control(
			'thumbnail',
			[
				'label' => esc_html__( 'Image Size', 'deep' ),
				'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
				'description' => esc_html__( 'Enter image size (Example: 200x100 (Width x Height)).', 'deep' ),
				'default' => [
					'width' => '',
					'height' => '',
				],
				'condition'     => [
					'type!'     => [
						'9','10','12','13','15'
					],
                ],  
			]
		);		

		// Title
		$this->add_control(
			'title', //param_name
			[
				'label' 		=> esc_html__( 'Title', 'deep' ), //heading
				'type' 			=> Controls_Manager::TEXT, //type
				'placeholder' 	=> esc_html__( 'Type your title text here', 'deep' ),
				'default' 		=> esc_html__( 'Title', 'deep' ),
                'condition'     => [
                        'type'     => [
                            '1', '3', '4', '5'
                        ],
                ],                 
			]
        );
        
		// Price
		$this->add_control(
			'price', //param_name
			[
				'label' 		=> esc_html__( 'Price', 'deep' ), //heading
				'type' 			=> Controls_Manager::TEXT, //type
				'placeholder' 	=> esc_html__( 'Ex $ 10', 'deep' ),
				'default' 		=> esc_html__( '$30', 'deep' ),
                'condition'     => [
                        'type'     => [
                            '1', '3', '4', '5'
                        ],
                ],                 
			]
        );
        
		// Description
		$this->add_control(
			'description', //param_name
			[
				'label' 		=> esc_html__( 'Description', 'deep' ), //heading
				'type' 			=> Controls_Manager::TEXTAREA, //type
				'rows' 			=> 10,
                'placeholder' 	=> esc_html__( 'Content Goes Here', 'deep' ),
                'condition'     => [
                        'type'     => [
                            '3', '4', '5'
                        ],
                ],                 
			]
		);

		// Ingredients
		$this->add_control(
			'ingredients',
			[
				'label' 		=> esc_html__( 'Ingredients', 'deep' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> [
						[
							'name' 			=> 'ingredient',
							'label' 		=> esc_html__( 'Ingredients', 'deep' ),
							'type' 			=> Controls_Manager::TEXT,
							'label_block' 	=> true,
                        ],                      
                ],
                'condition'     => [
                        'type'     => [
                            '1'
                        ],
				], 
				'default' => [
					[
						'ingredient' => __( 'Item 1', 'deep' ),
					],
					[
						'ingredient' => __( 'Item 2', 'deep' ),
                    ],
                    [
						'ingredient' => __( 'Item 3', 'deep' ),
					],
				],               
			]
		);

		// Food Items
		$this->add_control(
			'food_menu2',
			[
				'label' 		=> esc_html__( 'Food Items', 'deep' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> [
						[
							'name' 			=> 'title',
							'label' 		=> esc_html__( 'Title', 'deep' ),
							'type' 			=> Controls_Manager::TEXT,
							'label_block' 	=> true,
						],
                        [
                            'name'      => 'image',
                            'label'     => __( 'Food Image', 'plugin-domain' ),
                            'type'      => Controls_Manager::MEDIA,
                            'default'   => [
                                'url'   => Utils::get_placeholder_image_src(),
                            ],
                        ],
						[
							'name' 			=> 'price',
							'label' 		=> esc_html__( 'Price', 'deep' ),
							'type' 			=> Controls_Manager::TEXT,
							'label_block' 	=> true,
                        ],
                        [
                            'name' 			=> 'tp_color',
                            'label' 		=> esc_html__( 'Price and Title Background color', 'deep' ),
                            'type' 			=> Controls_Manager::COLOR,
                                    'scheme' 		=> [
                                        'type'  => \Elementor\Core\Schemes\Color::get_type(),
                                        'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                                    ],
                            'default' 		=> '#fff',
                            'selectors' 	=> [
                                        '{{WRAPPER}} .fm-w2-item .fm-w2-name, {{WRAPPER}} .fm-w2-item .fm-w2-price' => 'background: {{VALUE}}',
                            ],
                        ],
						[
							'name' 			=> 'description',
							'label' 		=> esc_html__( 'Description', 'deep' ),
							'type' 			=> Controls_Manager::TEXT,
							'label_block' 	=> true,
                        ],
						[
							'name'		=> 'food_style',
							'label' 	=> esc_html__( 'Food Item Style', 'deep' ),
							'type' 		=> Controls_Manager::SELECT, 
							'default' 	=> 'default',
							'options' 	=> [
									'default'  	    => esc_html__( 'Default Food Item', 'deep' ),
									'featured-w2'  	=> esc_html__( 'Featured Food Item', 'deep' ),
							],
						],
						[
							'name' 			=> 'featured_text',
							'label' 		=> esc_html__( 'Featured Text', 'deep' ),
							'type' 			=> Controls_Manager::TEXT,
                            'label_block' 	=> true,
                            'condition'     => [
                                    'food_style'     => [
                                        'featured-w2'
                                    ],
                            ],                             
						],
                ],
                'condition'     => [
                        'type'     => [
                            '2'
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
				'label' 	=> __( 'Title Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .wn-food-menu-sh h3, #wrap {{WRAPPER}} .fm-w2-item .fm-w2-name',
			]
		);
		$this->add_control(
			'title_text_align',
			[
				'label'     => __( 'Text align', 'deep' ),
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
				'toggle'    => true,
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-food-menu-sh h3, #wrap {{WRAPPER}} .fm-w2-item .fm-w2-name' => 'text-align: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'title_color', 
			[
				'label' 		=> __( 'Title color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-food-menu-sh h3, #wrap {{WRAPPER}} .fm-w2-item .fm-w2-name' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .wn-food-menu-sh h3, #wrap {{WRAPPER}} .fm-w2-item .fm-w2-name',
			]
		);
		$this->add_control(
			'title_padding', 
			[
				'label' 		=> __( 'Title padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-food-menu-sh h3, #wrap {{WRAPPER}} .fm-w2-item .fm-w2-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_margin', 
			[
				'label' 		=> __( 'Title margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-food-menu-sh h3, #wrap {{WRAPPER}} .fm-w2-item .fm-w2-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-food-menu-sh h3, #wrap {{WRAPPER}} .fm-w2-item .fm-w2-name' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .wn-food-menu-sh h3, #wrap {{WRAPPER}} .fm-w2-item .fm-w2-name' => 'display: {{VALUE}};',
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
					'#wrap {{WRAPPER}} .wn-food-menu-sh h3, #wrap {{WRAPPER}} .fm-w2-item .fm-w2-name' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-food-menu-sh h3, #wrap {{WRAPPER}} .fm-w2-item .fm-w2-name',
			]
		);
		$this->add_control(
			'hover',
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
				'label' 	=> __( 'Title Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .wn-food-menu-sh:hover h3, #wrap {{WRAPPER}} .fm-w2-item:hover .fm-w2-name',
			]
		);
		$this->add_control(
			'title_color_hover', 
			[
				'label' 		=> __( 'Title color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-food-menu-sh:hover h3, #wrap {{WRAPPER}} .fm-w2-item:hover .fm-w2-name' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_bg_hover',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .wn-food-menu-sh:hover h3, #wrap {{WRAPPER}} .fm-w2-item:hover .fm-w2-name',
			]
		);
		$this->add_control(
			'title_padding_hover', 
			[
				'label' 		=> __( 'Title padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-food-menu-sh:hover h3, #wrap {{WRAPPER}} .fm-w2-item:hover .fm-w2-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_margin_hover', 
			[
				'label' 		=> __( 'Title margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-food-menu-sh:hover h3, #wrap {{WRAPPER}} .fm-w2-item:hover .fm-w2-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-food-menu-sh:hover h3, #wrap {{WRAPPER}} .fm-w2-item:hover .fm-w2-name' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .wn-food-menu-sh:hover h3, #wrap {{WRAPPER}} .fm-w2-item:hover .fm-w2-name' => 'display: {{VALUE}};',
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
					'#wrap {{WRAPPER}} .wn-food-menu-sh:hover h3, #wrap {{WRAPPER}} .fm-w2-item:hover .fm-w2-name' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_border_hover',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-food-menu-sh:hover h3, #wrap {{WRAPPER}} .fm-w2-item:hover .fm-w2-name',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_price_style',
			[
				'label' => __( 'Price', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'price_typography',
				'label' 	=> __( 'Price Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .wn-food-menu-sh h5, #wrap {{WRAPPER}} .wn-food-menu-sh .fm-w2-price',
			]
		);
		$this->add_control(
			'price_text_align',
			[
				'label'     => __( 'Text align', 'deep' ),
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
				'toggle'    => true,
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-food-menu-sh h5, #wrap {{WRAPPER}} .wn-food-menu-sh .fm-w2-price' => 'text-align: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'price_color', 
			[
				'label' 		=> __( 'Price color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-food-menu-sh h5, #wrap {{WRAPPER}} .wn-food-menu-sh .fm-w2-price' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'price_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .wn-food-menu-sh h5, #wrap {{WRAPPER}} .wn-food-menu-sh .fm-w2-price',
			]
		);
		$this->add_control(
			'price_padding', 
			[
				'label' 		=> __( 'Price padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-food-menu-sh h5, #wrap {{WRAPPER}} .wn-food-menu-sh .fm-w2-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'price_margin', 
			[
				'label' 		=> __( 'Price margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-food-menu-sh h5, #wrap {{WRAPPER}} .wn-food-menu-sh .fm-w2-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-food-menu-sh h5, #wrap {{WRAPPER}} .wn-food-menu-sh .fm-w2-price' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .wn-food-menu-sh h5, #wrap {{WRAPPER}} .wn-food-menu-sh .fm-w2-price' => 'display: {{VALUE}};',
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
					'#wrap {{WRAPPER}} .wn-food-menu-sh h5, #wrap {{WRAPPER}} .wn-food-menu-sh .fm-w2-price' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'price_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-food-menu-sh h5, #wrap {{WRAPPER}} .wn-food-menu-sh .fm-w2-price',
			]
		);
		$this->add_control(
			'price_hover',
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
				'label' 	=> __( 'Price Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .wn-food-menu-sh:hover h5, #wrap {{WRAPPER}} .wn-food-menu-sh:hover .fm-w2-price',
			]
		);
		$this->add_control(
			'price_color_hover', 
			[
				'label' 		=> __( 'Price color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-food-menu-sh:hover h5, #wrap {{WRAPPER}} .wn-food-menu-sh:hover .fm-w2-price' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'price_bg_hover',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .wn-food-menu-sh:hover h5, #wrap {{WRAPPER}} .wn-food-menu-sh:hover .fm-w2-price',
			]
		);
		$this->add_control(
			'price_padding_hover', 
			[
				'label' 		=> __( 'Price padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-food-menu-sh:hover h5, #wrap {{WRAPPER}} .wn-food-menu-sh:hover .fm-w2-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'price_margin_hover', 
			[
				'label' 		=> __( 'Price margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-food-menu-sh:hover h5, #wrap {{WRAPPER}} .wn-food-menu-sh:hover .fm-w2-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-food-menu-sh:hover h5, #wrap {{WRAPPER}} .wn-food-menu-sh:hover .fm-w2-price' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .wn-food-menu-sh:hover h5, #wrap {{WRAPPER}} .wn-food-menu-sh:hover .fm-w2-price' => 'display: {{VALUE}};',
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
					'#wrap {{WRAPPER}} .wn-food-menu-sh:hover h5, #wrap {{WRAPPER}} .wn-food-menu-sh:hover .fm-w2-price' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'price_border_hover',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-food-menu-sh:hover h5, #wrap {{WRAPPER}} .wn-food-menu-sh:hover .fm-w2-price',
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
				'selector' => '#wrap {{WRAPPER}} .wn-food-menu-sh',
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
					'#wrap {{WRAPPER}} .wn-food-menu-sh' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-food-menu-sh',
			]
		);
		$this->add_control(
			'box_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .wn-food-menu-sh' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .wn-food-menu-sh',
				]
		);
		$this->add_control(
			'box_padding',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .wn-food-menu-sh' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-food-menu-sh' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-food-menu-sh' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .wn-food-menu-sh' => 'overflow: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'box_hover',
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
				'selector' => '#wrap {{WRAPPER}} .wn-food-menu-sh:hover',
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
					'#wrap {{WRAPPER}} .wn-food-menu-sh:hover' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border_hover',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-food-menu-sh:hover',
			]
		);
		$this->add_control(
			'box_border_radius_hover',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .wn-food-menu-sh:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);			
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow_hover',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .wn-food-menu-sh:hover',
				]
		);
		$this->add_control(
			'box_padding_hover',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .wn-food-menu-sh:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-food-menu-sh:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-food-menu-sh:hover' => 'opacity: {{SIZE}};',
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
	 * Render Socials widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

        $settings = $this->get_settings();    
        $type           = $settings['type'];
        $img            = $settings['img']['url'];
        $title          = $settings['title'];
        $price          = $settings['price'];
        $description    = $settings['description'];
        $ingredients    = $settings['ingredients'];
        $food_menu2     = $settings['food_menu2'];
        
        $price_color    = ' ';
 
        $shortcodeclass = $settings['shortcodeclass'];
        $shortcodeid    = $settings['shortcodeid'];
            
        // Class & ID 
        $shortcodeclass 	= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
        $shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';

        $food_menu2_data = array();
        static $uniqid = 0;
        $uniqid++;
        // if( is_numeric( $img ) )
        //     $img = wp_get_attachment_url( $img );
		
		if( !empty( $img ) ) {
			// if main class not exist get it
			if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
				require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
			}
			$image = new \Wn_Img_Maniuplate; // instance from settor class
			$img = $image->m_image( $settings['img']['id'] , $img , '822' , '886' ); // set required and get result
		}	
		
		if ( empty( $settings['thumbnail']['width'] ) || empty( $settings['thumbnail']['height'] )  ) {
			if( $type == 3 ) {
				$settings['thumbnail']['width']		= '138';
				$settings['thumbnail']['height']	= '138';
			} elseif( $type == 7 ) {
				$settings['thumbnail']['width']		= '256';
				$settings['thumbnail']['height']	= '256';
			} elseif( $type == 7 ) {
				$settings['thumbnail']['width']		= '346';
				$settings['thumbnail']['height']	= '230';
			} elseif( $type == 10 ) {
				$settings['thumbnail']['width']		= '90';
				$settings['thumbnail']['height']	= '90';
			}
		}
		if ( !empty( $settings['thumbnail']['width'] ) || !empty( $settings['thumbnail']['height'] ) ) {
			// if main class not exist get it
			if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
				require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
			}

			$image = new \Wn_Img_Maniuplate; // instance from settor class

			$img = $image->m_image( $settings['img']['id'] , $settings['img']['url'] , $settings['thumbnail']['width'] , $settings['thumbnail']['height'] ); // set required and get result
		}
		

        $out  = '';

            switch ( $type ) :
                // type 1 or 3 or 4 or 5
                case '1':
                        $menu_class = 'menu-dts-'.$type;
                    $out .= '
                    <div class="wn-food-menu-sh food-menu-w' . $type . ' ' . $shortcodeclass . '"  ' . $shortcodeid . ' >
                        <img src="' . esc_url( $img ) . '" alt="' . esc_html( $title ) . '">
                        <div class="' . $menu_class . ' space">
                            <h3>' . esc_html( $title ) . '</h3>
                            <h5>' . esc_html( $price ) . '</h5>
                            <p>';
                            foreach ( $ingredients as $line ) :
                                $ingredients_data   = isset( $line['ingredient'] ) ? $line['ingredient'] . '<br>' : '';
                                $out .= $ingredients_data;
                            endforeach;
                        $out .= '</p>
                        </div>
                        ' . $description . '
                    </div>';
                break;
                case '3':
                case '4':
                    $ingredients_data = '';
                        $description = $description ? '<div class="w' . $type . '-menu-dts">' . $description . '</div>' : '';
                        $menu_class = 'w' . $type . '-menu-top';
                    $out .= '
                    <div class="wn-food-menu-sh food-menu-w' . $type . ' ' . $shortcodeclass . '"  ' . $shortcodeid . ' >
                        <img src="' . esc_url( $img ) . '" alt="' . esc_html( $title ) . '">
                        <div class="' . $menu_class . ' space">
                            <h3>' . esc_html( $title ) . '</h3>
                            <h5>' . esc_html( $price ) . '</h5>
                            ' . $ingredients_data . '
                        </div>
                        ' . $description . '
                    </div>';
                break;

                case '5':
                    $menu_class = 'menu-dts-'.$type ;
                    $out .= '
                    <div class="wn-food-menu-sh food-menu-w' . $type . ' colorb ' . $shortcodeclass . '"  ' . $shortcodeid . ' >
                        <div class="' . $menu_class . '">
                            <h3>' . esc_html( $title ) . '</h3>
                            <h5>' . esc_html( $price ) . '</h5>
                        </div>
                        <div class="border-' . $type . ' ">	 
                            <img src="' . esc_url( $img ) . '" alt="' . esc_html( $title ) . '" class="fmt-5">
                        </div>
                        <div class="background-5">
                            <p><strong>' . esc_html( $title ) . ' ingredients: </strong>' . $description . '</p>
                        </div>
                    </div>';
                break;
                // type 2
                case '2':				
                    $out .= '<div class="wn-food-menu-sh food-menu-w2 ' . $shortcodeclass . '"  ' . $shortcodeid . ' >';

                        foreach ( $food_menu2 as $line ) :

                            $title              = isset( $line['title'] )           ? $line['title'] : '';
                            $price              = isset( $line['price'] )           ? $line['price'] : '';
                            $description        = isset( $line['description'] )     ? $line['description'] : '';
                            $featured_text      = isset( $line['featured_text'] )   ? $line['featured_text'] : '';
                            $image              = isset( $line['image'] )           ? $line['image'] : '';
                            $food_style         = isset( $line['food_style'] ) && $line['food_style'] == 'featured-w2'  ? ' colorr ' . $line['food_style'] : '';
                            $featured_text = $food_style ? '<span class="fm-w2-featured colorb">' . $featured_text . '</span>' : '';
                            if( !empty( $image['url'] ) ) {
                                if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                                    require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
                                }
                                $food_image = new \Wn_Img_Maniuplate; // instance from settor class
                                $thumbnail = $food_image->m_image( $image['id'], $image['url'] , '20' , '20' ); // set required and get result
                                $datasrc = $food_image->m_image( $image['id'], $image['url'] , '650' , '650' ); // set required and get result
                            }
                            $data_src = isset( $image['url'] ) ? 'data-src="' . $datasrc . '"' : '';
                            $out .= '
                            <div class="fm-w2-item' . $food_style . '">
                                <div class="fm-w2-top space">
                                    <img src="' . $thumbnail . '" ' . $data_src . '>
                                    <span class="fm-w2-name">' . $title . '</span>
                                    <span class="fm-w2-price" >' . $price . '</span>
                                </div>
                                <div class="fm-w2-des">' . $description . '</div>
                                ' . $featured_text . '
                            </div>';
                        endforeach;

                    
                    $out .= '</div>';
                break;
            endswitch;

		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}
        echo $out;
		
	}

}