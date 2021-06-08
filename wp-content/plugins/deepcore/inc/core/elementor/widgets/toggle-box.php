<?php
namespace Elementor;
class Webnus_Element_Widgets_Toggle_Box extends \Elementor\Widget_Base {

	/**
	 * Retrieve Toggle Box widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'toggle_box';
		
	}

	/**
	 * Retrieve Toggle Box widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return __( 'Webnus Toggle Box', 'deep' );

	}

	/**
	 * Retrieve Toggle Box widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-toggle';

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

		return [ 'nw-togglebox' ];
		
	}

	/**
	 * widget styles.
	 *
	 * @since 4.2.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'wn-deep-toggle-box' ];

	}

	/**
	 * Register Toggle Box widget controls.
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

		// Select Type Section
		$this->add_control(
			'type', //param_name
			[
				'label' 	=> __( 'Select Type', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> '1',
				'options' 	=> [
					'1'  	=> __( 'Type 1', 'deep' ),
					'2'  	=> __( 'Type 2', 'deep' ),
				],
			]
		);

        // Reservation Table ID
		$this->add_control(
			'service_single_title',
			[
				'label' 		=> esc_html__( 'Service Title', 'deep' ),
				'type' 			=> Controls_Manager::TEXT,
				'placeholder' 	=> esc_html__( 'Please write Service Title', 'deep' ),
				'default'		=> esc_html__( 'Service Title' , 'deep' ),
                'condition'     => [
                        'type'     => [
                            '1',
                        ],
                ],
			]
		);

		// Toggle Box Content
		$this->add_control(
			'service_single_content', //param_name
			[
				'label' 		=> __( 'Content', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA, //type
				'rows' 			=> 10,
				'placeholder' 	=> __( 'Please write Content', 'deep' ),
				'default'		=> esc_html__( 'making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.' , 'deep' ),

                'condition'     => [
                        'type'     => [
                            '1',
                        ],
                ],
			]
		);

		// Reservation Table ID
		$this->add_control(
			'background_image',
			[
				'label' 		=> esc_html__( 'Choose Image', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA, //type
				'default' 		=> [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'selectors' => [
					'{{WRAPPER}} .offer-toggle' => 'background: url({{URL}}) no-repeat;',
                ],
                'condition'     => array(
					'type'      => array( '2' ),
				),
			]
        );
		
		// Reservation Table ID
		$this->add_control(
			'offers_subtitle',
			[
				'label' 		=> esc_html__( 'Subtitle', 'deep' ),
				'type' 			=> Controls_Manager::TEXT,
                'placeholder' 	=> esc_html__( 'Please write Service Title', 'deep' ),
                'condition'     => [
                        'type'     => [
                            '2',
                        ],
                ],
			]
        );

		// Reservation Table ID
		$this->add_control(
			'offers_title',
			[
				'label' 		=> esc_html__( 'Title', 'deep' ),
				'type' 			=> Controls_Manager::TEXT,
				'placeholder' 	=> esc_html__( 'Please write Service Title', 'deep' ),
				'default'		=> esc_html__( 'Service Title' , 'deep' ),
                'condition'     => [
                        'type'     => [
                            '2',
                        ],
                ],
			]
        );

		// Reservation Table ID
		$this->add_control(
			'min_height',
			[
				'label' 		=> esc_html__( 'Minimum Height', 'deep' ),
				'type' 			=> Controls_Manager::TEXT,
				'placeholder' 	=> esc_html__( 'ex: 547', 'deep' ),
				'selectors' 	=> [
					'{{WRAPPER}} .offer-toggle' => 'min-height: {{VALUE}}px',
				],
                'condition'     => [
					'type' => [
						'2',
					],
                ],
			]
        );

        // Link Target
        $this->add_control(
            'open',
            [
                'label'         => __( 'Do you want the content open as default?', 'deep' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'false',
                'true'          => __( 'Yes', 'deep' ),
                'false'         => __( 'No', 'deep' ),
                'return_value'  => 'yes',
                'condition'     => [
                        'type'     => [
                            '2',
                        ],
                ],
            ]
        );

		// Toggle Box Content
		$this->add_control(
			'offers_content', //param_name
			[
				'label' 		=> __( 'Content', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA, //type
				'rows' 			=> 10,
				'placeholder' 	=> __( 'Please write Content', 'deep' ),
				'default'		=> esc_html__( 'making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.' , 'deep' ),
                'condition'     => [
                        'type'     => [
                            '2',
                        ],
                ],
			]
		);

        // Set Icon for Toggle Box
		$this->add_control(
			'icon_name',
			[
				'label' => __( 'Icon', 'deep' ),
				'type' => Controls_Manager::ICON,
				'default' => 'eicon-toggle',
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
				'label' => __( 'Box Style', 'deep' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'bgcolor',
				'label'    => __( 'Background', 'deep' ),
				'types'    => [ 'classic' , 'gradient' ],
				'default' => '#437df9',
				'selector' => '#wrap {{WRAPPER}} .suite-toggle, {{WRAPPER}} .offer-toggle',
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
					'#wrap {{WRAPPER}} .suite-toggle, {{WRAPPER}} .offer-toggle' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .suite-toggle, {{WRAPPER}} .offer-toggle',
			]
		);
		$this->add_control(
			'box_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .suite-toggle, {{WRAPPER}} .offer-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .suite-toggle, {{WRAPPER}} .offer-toggle',
				]
		);
		$this->add_control(
			'box_padding',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .suite-toggle, {{WRAPPER}} .offer-toggle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .suite-toggle, {{WRAPPER}} .offer-toggle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .suite-toggle, {{WRAPPER}} .offer-toggle' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .suite-toggle, {{WRAPPER}} .offer-toggle' => 'overflow: {{VALUE}};',
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
				'selector' => '#wrap {{WRAPPER}} .suite-toggle:hover, {{WRAPPER}} .offer-toggle:hover',
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
					'#wrap {{WRAPPER}} .suite-toggle:hover, {{WRAPPER}} .offer-toggle:hover' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border_hover',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .suite-toggle:hover, {{WRAPPER}} .offer-toggle:hover',
			]
		);
		$this->add_control(
			'box_border_radius_hover',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .suite-toggle:hover, {{WRAPPER}} .offer-toggle:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);			
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow_hover',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .suite-toggle:hover, {{WRAPPER}} .offer-toggle:hover',
				]
		);
		$this->add_control(
			'box_padding_hover',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .suite-toggle:hover, {{WRAPPER}} .offer-toggle:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .suite-toggle:hover, {{WRAPPER}} .offer-toggle:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .suite-toggle:hover, {{WRAPPER}} .offer-toggle:hover' => 'opacity: {{SIZE}};',
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
	 * Render Toggle Box widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings               = $this->get_settings_for_display();			
		$type                   = $settings['type'];
		$service_single_title   = $settings['service_single_title'];
		$service_single_content = $settings['service_single_content'];
		$background_image       = $settings['background_image'];
		$bgcolor                = ( !empty($settings['bgcolor']) ) ? $settings['bgcolor'] : '';
		$offers_subtitle        = $settings['offers_subtitle'];
		$offers_title           = $settings['offers_title'];
		$min_height             = $settings['min_height'];
		$open                   = $settings['open'];
		$offers_content         = $settings['offers_content'];
		$icon_name              = $settings['icon_name'];

		// Class & ID 
        $shortcodeclass 	= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
        $shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';

        $type = ( $type ) ? $type : '1' ;
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

        $custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
        }

        if ( $type == 1 ) {
			
			$service_single_title = ( $service_single_title ) ? '<h3>' . $service_single_title . '</h3>' : '' ;
            $bgcolor = $bgcolor ? ' . suite-toggle .toggle-content i { color: ' . $bgcolor . ';} ': '';
            $service_single_content = $service_single_content;            
            $service_main_content = ( $service_single_content ) ? '<div class="extra-content">' . $service_single_content . ' </div>' : '';
			
			$out = '
            <div class="suite-toggle suite-toggle ' . $shortcodeclass . '"  ' . $shortcodeid . '>
                <div class="main-content">
                    '. $service_single_title . '
                    <div class="service-icon">
                        <i class="'.$icon_name.'"></i>
                    </div>
                </div>
                <div class="toggle-content">
                    ' . $service_main_content . '
                    <span><i class="ti-plus"></i></span>
                </div>
            </div>';

			echo $out;

        } else {
            $open					= ( $open ) ? 'true' : 'false';
            $hide_content			= ( $open == "true" ) ? '' : 'w-hide' ;
            $plus_minus				= ( $open == "true" ) ? 'minus' : 'plus' ;
            $icon					= ( $icon_name ) ? '<div class="offer-icon"><i class="'. $icon_name .'"></i></div>' : '' ;
            $offers_subtitle 		= ( $offers_subtitle ) ? '<h4>' . $offers_subtitle . '</h4>' : '' ;
            $offers_title 	 		= ( $offers_title ) ? '<h3>' . $offers_title . '</h3>' : '' ;
            $background_color 		= ( $bgcolor ) ? ' background-color:' . $bgcolor . ';' : '' ;            
            $plus_icon 				= ( $offers_content ) ? '<span class="toogle-plus"><i class="ti-'. $plus_minus .'"></i></span>' : '' ;
            $offers_content 		= ( $offers_content ) ? $offers_content : '' ;
			$offers_main_content	= ( $offers_content ) ? '<div class="extra-content">' . $offers_content . '</div>' : '';

            $out = '
            <div class="offer-toggle offer-toggle ' . $shortcodeclass . '"  ' . $shortcodeid . '>
                <figure>
                    <div class="main-content">
                        ' . $icon . '
                        ' . $offers_subtitle . '
                        ' . $offers_title . '
                        ' . $plus_icon . '
                        <div class="toggle-content  '. $hide_content . '">
                            ' . $offers_main_content . '
                        </div>
                    </div>
                </figure>
            </div>';

            echo $out;
        
        }        


    }

}