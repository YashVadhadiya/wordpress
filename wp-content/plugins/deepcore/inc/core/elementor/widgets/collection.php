<?php
namespace Elementor;
class Webnus_Element_Widgets_Collection extends \Elementor\Widget_Base {

	/**
	 * Retrieve Collection widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'collection';
		
	}

	/**
	 * Retrieve Collection widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Collection', 'deep' );

	}

	/**
	 * Retrieve Collection widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'ti-layout-accordion-list';

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
		return [ 'wn-deep-collection' ];
	}

	/**
	 * Register Collection widget controls.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'content_sectiona',
			[
				'label' => esc_html__( 'General', 'deep' ),
				'tab' => Controls_Manager::TAB_CONTENT,
            ]
		);
		$this->add_control(
			'title',
			[
				'label' 		=> esc_html__( 'Collection Name', 'deep' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> 'Jacket',
				'placeholder' 	=> esc_html__( 'Type your title text here', 'deep' ),
			]
		);
		$this->add_control(
			'image',
			[
				'label' 		=> esc_html__( 'Choose Image', 'deep' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
							'url' 		=> Utils::get_placeholder_image_src(),
				],
			]
		);	
        $this->add_control(
            'image_top_bottom',
            [
                'label'       	=> __( 'Image in Top or Bottom?', 'deep' ),
                'type' => Controls_Manager::SELECT,
                'default' 		=> 'top',
                'options' 		=> [
						'top'  		=> __( 'Top', 'deep' ),
						'bottom' 	=> __( 'Bottom', 'deep' ),
                ],
            ]
        );
        $this->add_control(
            'image_left_right',
            [
                'label'       	=> __( 'Image in Left or Right?', 'deep' ),
                'type' 			=> Controls_Manager::SELECT,
                'default' 		=> 'right',
                'options' 		=> [
						'left'  	=> __( 'Left', 'deep' ),
						'right' 	=> __( 'Right', 'deep' ),
                ],
            ]
        );
		$this->add_control(
			'year', 
			[
				'label' 		=> esc_html__( 'Collection Year', 'deep' ), 
				'type' 			=> Controls_Manager::TEXT, 
				'default' 		=> '2020', 
				'placeholder' 	=> esc_html__( 'Type your title text here', 'deep' ),
			]
        );
		$this->add_control(
			'brands', 
			[
				'label' 		=> esc_html__( 'Brands', 'deep' ), 
				'type' 			=> Controls_Manager::TEXT, 
				'default'		=> 'ZARA', 
				'placeholder' 	=> esc_html__( 'Type your title text here', 'deep' ),
			]
		);
		$this->add_control(
			'c_content',
			[
				'label' 		=> esc_html__( 'Collection Content', 'deep' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 10,
				'default'		=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum laboriosam sapiente ullam, dicta quasi earum?',
				'placeholder' 	=> esc_html__( 'Content Goes Here', 'deep' ),
			]
        );
        $this->end_controls_section();

        // Content Tab
		$this->start_controls_section(
			'content_sectionb',
			[
				'label' => esc_html__( 'URL Options', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		// Collection Brands
		$this->add_control(
			'link_title', 
			[
				'label' 		=> esc_html__( 'Lint Title', 'deep' ), 
				'default'		=> esc_html__( 'Read More', 'deep' ), 
				'type' 			=> Controls_Manager::TEXT, 
				'placeholder' 	=> esc_html__( 'Type your title text here', 'deep' ),
			]
		);

		// Target URL
		$this->add_control(
			'link_href',
			[
				'label' 		=> esc_html__( 'Target URL', 'deep' ),
				'type' 			=> Controls_Manager::URL,
				'default' 		=> [
						'url' 			=> 'http://',
						'is_external' 	=> '',
				],
                'show_external' => true, // Show the 'open in new tab' button.
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
				'selector' 	=> '#wrap {{WRAPPER}} .wn-collections .collection-title h3',
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
					'#wrap {{WRAPPER}} .wn-collections .collection-title h3' => 'text-align: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'title_color', 
			[
				'label' 		=> __( 'Title color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-collections .collection-title h3' => 'color: {{VALUE}} !important',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .wn-collections .collection-title h3',
			]
		);
		$this->add_control(
			'title_padding', 
			[
				'label' 		=> __( 'Title padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-collections .collection-title h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-collections .collection-title h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-collections .collection-title h3' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .wn-collections .collection-title h3' => 'display: {{VALUE}};',
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
					'#wrap {{WRAPPER}} .wn-collections .collection-title h3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-collections .collection-title h3',
			]
		);
		$this->end_controls_section();	
		
		$this->start_controls_section(
			'section_brand_style',
			[
				'label' => __( 'Brand', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'brand_typography',
				'label' 	=> __( 'Brand Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .wn-collections .collection-brands',
			]
		);
		$this->add_control(
			'brand_text_align',
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
					'#wrap {{WRAPPER}} .wn-collections .collection-brands' => 'text-align: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'brand_color', 
			[
				'label' 		=> __( 'Brand color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-collections .collection-brands' => 'color: {{VALUE}} !important',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'brand_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .wn-collections .collection-brands',
			]
		);
		$this->add_control(
			'brand_padding', 
			[
				'label' 		=> __( 'Brand padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-collections .collection-brands' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'brand_margin', 
			[
				'label' 		=> __( 'Brand margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-collections .collection-brands' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		
		$this->add_control(
			'brand_opacity',
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
					'#wrap {{WRAPPER}} .wn-collections .collection-brands' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'brand_display',
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
					'#wrap {{WRAPPER}} .wn-collections .collection-brands' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'brand_border_radius', 
			[
				'label' 		=> __( 'Border Radius', 'deep' ), 
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, 
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-collections .collection-brands' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'brand_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-collections .collection-brands',
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
				'label' 	=> __( 'Content Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .wn-collections .collection-content p',
			]
		);
		$this->add_control(
			'content_text_align',
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
					'#wrap {{WRAPPER}} .wn-collections .collection-content p' => 'text-align: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'content_color', 
			[
				'label' 		=> __( 'Content color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-collections .collection-content p' => 'color: {{VALUE}} !important',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .wn-collections .collection-content p',
			]
		);
		$this->add_control(
			'content_padding', 
			[
				'label' 		=> __( 'Content padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-collections .collection-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'content_margin', 
			[
				'label' 		=> __( 'Content margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-collections .collection-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-collections .collection-content p' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .wn-collections .collection-content p' => 'display: {{VALUE}};',
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
					'#wrap {{WRAPPER}} .wn-collections .collection-content p' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-collections .collection-content p',
			]
		);
		$this->end_controls_section();		

		$this->start_controls_section(
			'section_button_style',
			[
				'label' => __( 'Button Style', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
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

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'btn_typography',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .wn-collections .collection-link a',
			]
		);	

		$this->add_control(
			'button_text_align',
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
					'#wrap {{WRAPPER}} .wn-collections .collection-link a' => 'text-align: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'btn_color', 
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-collections .collection-link a' => 'color: {{VALUE}} !important',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'btn_background',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .wn-collections .collection-link a',
			]
		);
		$this->add_control(
			'button_padding', 
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-collections .collection-link a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-collections .collection-link a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-collections .collection-link a' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .wn-collections .collection-link a' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'btn_border_radius', 
			[
				'label' 		=> __( 'Border Radius', 'deep' ), 
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, 
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-collections .collection-link a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-collections .collection-link a',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'btn_shadow',
					'label' => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .wn-collections .collection-link a',
				]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => __( 'Hover', 'deep' ),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'btn_background_hover',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .wn-collections .collection-link a:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'btn_shadow_hover',
					'label' => __( 'Box Shadow Hover', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .wn-collections .collection-link a:hover',
				]
		);
		$this->add_control(
			'btn_color_hover', 
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-collections .collection-link a:hover' => 'color: {{VALUE}} !important',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_hover',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .wn-collections .collection-link a:hover',
			]
		);
		$this->add_control(
			'button_padding_hover', 
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-collections .collection-link a:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-collections .collection-link a:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-collections .collection-link a:hover' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .wn-collections .collection-link a:hover' => 'display: {{VALUE}};',
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
					'#wrap {{WRAPPER}} .wn-collections .collection-link a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'btn_border_color_hover',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-collections .collection-link a:hover',
			]
		);
		$this->end_controls_tab();

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
				'selector' => '#wrap {{WRAPPER}} .wn-collections',
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
					'#wrap {{WRAPPER}} .wn-collections' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-collections',
			]
		);
		$this->add_control(
			'box_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .wn-collections' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .wn-collections',
				]
		);
		$this->add_control(
			'box_padding',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .wn-collections' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-collections' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-collections' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .wn-collections' => 'overflow: {{VALUE}};',
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
				'selector' => '#wrap {{WRAPPER}} .wn-collections:hover',
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
					'#wrap {{WRAPPER}} .wn-collections:hover' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border_hover',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-collections:hover',
			]
		);
		$this->add_control(
			'box_border_radius_hover',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .wn-collections:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);			
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow_hover',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .wn-collections:hover',
				]
		);
		$this->add_control(
			'box_padding_hover',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .wn-collections:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-collections:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-collections:hover' => 'opacity: {{SIZE}};',
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
	 * Render Collection widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings                       = $this->get_settings_for_display();
		$title                          = $this->get_settings( 'title' );
		$image                          = $this->get_settings( 'image' );
		$image_top_bottom               = $this->get_settings( 'image_top_bottom' );
		$image_left_right               = $this->get_settings( 'image_left_right' );
		$year                           = $this->get_settings( 'year' );
		$brands                         = $this->get_settings( 'brands' );
		$c_content                      = $this->get_settings( 'c_content' );
		$link_title                     = $this->get_settings( 'link_title' );
        $link_href                      = $this->get_settings( 'link_href' );

        $url                            = $link_href['url'];
        $link_target_tag                = $link_href['is_external'] ? 'target="_blank"' : '';
        $link_no_follow                	= $link_href['nofollow'] ? ' rel="nofollow"' : '';

        $image_url 			            = isset( $image ) ?  $image['url'] : '';         


	    // Class & ID 
        $shortcodeclass 	= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
        $shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';	

        $image_alt			= $title;
        $title  			= ( $title ) ? '<div class="collection-title wn-animation-run"><span class="before"></span><h3>'.$title.'</h3><span class="after"></span></div>' : '' ;
        $year 				= ( $year ) ? '<div class="collection-year"><span>'.$year.'</span></div>' : '' ;
        $brands 			= ( $brands ) ? '<div class="collection-brands colorf"><span>'.$brands.'</span></div>' : '' ;
        $c_content 			= ( $c_content ) ? '<div class="collection-content"><p>'.$c_content.'</p></div>' : '' ;
        $url 			    = ( $url ) ? $url : '' ;
        $link_title 		= ( $link_title ) ? '<div class="collection-link"><a class="colorf button" href="'.$url.'" '.$link_target_tag . $link_no_follow . ' ><span>'.$link_title.'</span></a></div>' : '' ;
        $image_url			= isset( $image_url ) ? $image_url : '';
        if( is_numeric( $image ) ){
            $image_url = wp_get_attachment_url( $image );
            if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                 require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
            }
            $image_class = new \Wn_Img_Maniuplate; // instance from settor class
            $image_url = $image_class->m_image( $image , $image_url , '365' , '415' ); // set required and get result
        }
        $image_url = ( $image_url ) ? '<div class="collection-img"><img src="'.$image_url.'" alt="' . $image_alt . '"></div>' : '' ;


        $out = '<div class="wn-collections type-'.$image_top_bottom.'-'.$image_left_right.' ' . $shortcodeclass . '"  ' . $shortcodeid . ' >';
        $out.= $image_url;
        if ( $image_top_bottom == 'top' && $image_left_right == 'right' ){
            $out .= '
                <div class="collection-year-brands">
                    <div class="clearfix">
                        <div class="col-lg-6 col-md-7 col-sm-9 col-xs-6">' . $year . $brands . '</div>
                        <div class="col-md-5"></div>
                    </div>
                </div>
                <div class="collection-meta">
                    <div class="clearfix">
                        <div class="col-md-6 col-sm-12">'.$title.'</div>
                        <div class="col-md-6 col-sm-12"></div>
                    </div>
                    <div class="clearfix collection-content-wrap">
                        <div class="col-md-12">'.$c_content.'</div>
                    </div>
                    <div class="clearfix collection-button">
                        <div class="col-md-12">'.$link_title.'</div>
                    </div>
                </div>
            ';
        }elseif ( $image_top_bottom == 'top' && $image_left_right == 'left' ) {
            $out .= '
                <div class="collection-year-brands">
                    <div class="clearfix">
                        <div class="col-md-6 col-sm-6 col-xs-6"></div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">' . $year . $brands . '</div>
                    </div>
                </div>
                <div class="collection-meta">
                    <div class="clearfix">
                        <div class="col-md-6 col-sm-12 col-xs-12"></div>
                        <div class="col-md-6 col-sm-12 col-xs-12">'.$title.'</div>
                    </div>
                    <div class="clearfix collection-content-wrap">
                        <div class="col-md-6 col-sm-12 col-xs-12"></div>
                        <div class="col-md-6 col-sm-12 col-xs-12">'.$c_content.'</div>
                    </div>
                    <div class="clearfix collection-button">
                        <div class="col-md-6 col-sm-12 col-xs-12"></div>
                        <div class="col-md-6 col-sm-12 col-xs-12">'.$link_title.'</div>
                    </div>
                </div>
            ';
        }elseif ( ( $image_top_bottom == 'bottom' && $image_left_right == 'left' ) ) {
            $out .= '
                <div class="collection-meta">
                    '.$title.'
                    '.$c_content.'
                    '.$link_title.'
                </div>
                <div class="collection-year-brands">
                    <div class="clearfix">
                        <div class="col-md-6 col-sm-5 col-xs-6"></div>
                        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-6">' . $year . $brands . '</div>
                    </div>
                </div>
            ';
        }elseif ( $image_top_bottom == 'bottom' && $image_left_right == 'right' ) {
            $out .= '
                <div class="collection-meta">
                    '.$title.'
                    '.$c_content.'
                    '.$link_title.'
                </div>
                <div class="collection-year-brands">
                    <div class="clearfix">
                        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-6">' . $year . $brands . '</div>
                        <div class="col-md-6 col-sm-5 col-xs-6"></div>
                    </div>
                </div>
            ';
        }

        $out .= '</div>';
		
		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}
        echo $out;

	}

}