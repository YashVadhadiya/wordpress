<?php
namespace Elementor;
class Webnus_Element_Widgets_Testimonial extends \Elementor\Widget_Base {

	/**
	 * Retrieve Testimonial widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'Testimonial';
		
	}

	/**
	 * Retrieve Testimonial widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Testimonial', 'deep' );

	}

	/**
	 * Retrieve Testimonial widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-testimonial';

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
	 * Register Testimonial widget controls.
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
				'label' => esc_html__( 'Type Settings', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		// Select Testimonial Type
		$this->add_control(
			'type',
			[
				'label' 	=> esc_html__( 'Type', 'deep' ),
				'type' 		=> Controls_Manager::SELECT,
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

        //Name
		$this->add_control(
			'name',
			[
				'label' 		=> esc_html__( 'Name', 'deep' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'Name', 'deep' ),
			]
		);

		// Color
		$this->add_control(
			'testimonial_name_color',
			[
				'label' 		=> esc_html__( ' Name color', 'deep' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wn-single-ts h5,{{WRAPPER}} .wn-single-ts .name,{{WRAPPER}} .testimonial3 .testimonial-content .t-m-footer h5' => 'color: {{VALUE}}',
                ],               
			]
		);
        
		// Upload Image
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
            
        // Image Size
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
			]
		);
            
		// Testimonial Content
		$this->add_control(
			'testimonial_content', 
			[
				'label' 		=> esc_html__( 'Testimonial Content', 'deep' ), 
				'type' 			=> Controls_Manager::TEXTAREA, //type
				'rows' 			=> 10,
				'placeholder' 	=> esc_html__( 'Content Goes Here', 'deep' ),
				'default'	 	=> esc_html__( 'Content Goes Here', 'deep' ),
			]
		);

		$this->add_control(
			'testimonial_content_color',
			[
				'label' 		=> esc_html__( 'Content color', 'deep' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .content,#wrap {{WRAPPER}} .testimonial-content,#wrap {{WRAPPER}} q' => 'color: {{VALUE}}',
                ],               
			]
		);

		$this->add_control(
			'cn_margin', //param_name
			[
				'label' 		=> __( 'Content margin', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .content,#wrap {{WRAPPER}} .testimonial-content,#wrap {{WRAPPER}} q' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'cn_padding', //param_name
			[
				'label' 		=> __( 'Content Padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .content,#wrap {{WRAPPER}} .testimonial-content,#wrap {{WRAPPER}} q' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'cn_typo',
				'label' 	=> __( 'Content Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .content,#wrap {{WRAPPER}} .testimonial-content,#wrap {{WRAPPER}} q',
			]
		);

		$this->add_control(
			'cn_align',
			[
				'label' => __( 'Content Alignment', 'deep' ),
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
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} #wrap {{WRAPPER}} .content,#wrap {{WRAPPER}} .testimonial-content,#wrap {{WRAPPER}} q' => 'text-align: {{VALUE}};',
				],
			]
		);

        // Job
        $this->add_control(
            'member_job',
            [
                'label' 		=> esc_html__( 'Job', 'deep' ),
                'type' 			=> Controls_Manager::TEXT,
                'condition'     => [
                        'type'     => [
                            '3','5',
                        ],
                ],                
            ]
        );

        // Social
        $this->add_control(
            'social',
            [
                'label'         => esc_html__( 'Social Icons', 'deep' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => '',
                'on'            => esc_html__( 'Enable', 'deep' ),
                'off'           => esc_html__( 'Disable', 'deep' ),
                'return_value'  => 'enable',
                'condition'     => [
					'type'     => [
						'3',
					],
                ],
            ]
        );

        // Select Icon
		$this->add_control(
			'first_social',
			[
				'label' => esc_html__( 'First Social Name', 'deep' ),
                'type' => Controls_Manager::ICON,
                'condition'     => [
					'social'     => [
						'enable',
					],
					'type'     => [
						'3',
					],
                ],                               
			]
        );
        
		// Social URL
		$this->add_control(
			'first_url', 
			[
				'label' 		=> esc_html__( 'First Social URL', 'deep' ), 
				'type' 			=> Controls_Manager::URL,
				'default' 		=> [
						'url' 			=> 'http://',
						'is_external' 	=> '',
				],
                'show_external' => true, 
                'condition'     => [
                    'social'     => [
						'enable',
					],
					'type'     => [
						'3',
					],
                ],  
			]
		);

        // Select Icon
		$this->add_control(
			'second_social',
			[
				'label' => esc_html__( 'Second Social Name', 'deep' ),
                'type' => Controls_Manager::ICON,  
                'condition'     => [
                    'social'     => [
						'enable',
					],
					'type'     => [
						'3',
					],
                ],                               
			]
        );
        
		// Social URL
		$this->add_control(
			'second_url', 
			[
				'label' 		=> esc_html__( 'Second Social URL', 'deep' ), 
				'type' 			=> Controls_Manager::URL,
				'default' 		=> [
						'url' 			=> 'http://',
						'is_external' 	=> '',
				],
                'show_external' => true, 
                'condition'     => [
                    'social'     => [
						'enable',
					],
					'type'     => [
						'3',
					],
                ],                  
			]
		);

        // Select Icon
		$this->add_control(
			'third_social',
			[
				'label' => esc_html__( 'Third Social Name', 'deep' ),
                'type' => Controls_Manager::ICON,
                'condition'     => [
                    'social'     => [
						'enable',
					],
					'type'     => [
						'3',
					],
                ],                     
			]
        );
        
		// Social URL
		$this->add_control(
			'third_url', 
			[
				'label' 		=> esc_html__( 'Third Social URL', 'deep' ), 
				'type' 			=> Controls_Manager::URL,
				'default' 		=> [
						'url' 			=> 'http://',
						'is_external' 	=> '',
				],
                'show_external' => true, 
                'condition'     => [
                    'social'     => [
						'enable',
					],
					'type'     => [
						'3',
					],
                ],                  
			]
		);

        // Select Icon
		$this->add_control(
			'fourth_social',
			[
				'label' => esc_html__( 'Fourth Social Name', 'deep' ),
                'type' => Controls_Manager::ICON,       
                'condition'     => [
                    'social'     => [
						'enable',
					],
					'type'     => [
						'3',
					],
                ],                         
			]
        );
        
		// Social URL
		$this->add_control(
			'fourth_url', 
			[
				'label' 		=> esc_html__( 'Fourth Social URL', 'deep' ), 
				'type' 			=> Controls_Manager::URL,
				'default' 		=> [
						'url' 			=> 'http://',
						'is_external' 	=> '',
				],
                'show_external' => true, 
                'condition'     => [
                    'social'     => [
						'enable',
					],
					'type'     => [
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
			'section_bg_style',
			[
				'label' => __( 'Background', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		// Background Color		
		$this->add_control(
			'testimonial_background',
			[
				'label' => esc_html__( 'Background color', 'deep' ),
				'type' => Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .testimonial .testimonial-content' => 'background: {{VALUE}}',
					'{{WRAPPER}} .testimonial3 .testimonial-content' => 'background: #fff',
					'{{WRAPPER}} .testimonial3 .testimonial-content .content' => 'background: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_bs_style',
			[
				'label' => __( 'Box Shadow', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'box_shadow',
					'label' => __( 'Box Shadow', 'deep' ),
					'selector' => '{{WRAPPER}} .wn-single-ts .testimonial-content',
				]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_border_style',
			[
				'label' => __( 'Border', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ts_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '{{WRAPPER}} .wn-single-ts .testimonial-content',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_padding_style',
			[
				'label' => __( 'Padding', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'bg_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wn-single-ts' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_margin_style',
			[
				'label' => __( 'Margin', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'bg_margin', //param_name
			[
				'label' 		=> __( 'Margin', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wn-single-ts' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	 * Render Testimonial widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings();

		wp_enqueue_style( 'wn-deep-testimonial', DEEP_ASSETS_URL . 'css/frontend/testimonial/testimonial.css' );
    
		$type							= $settings['type'];
		$testimonial_content			= $settings['testimonial_content'];
		$testimonial_background			= $settings['testimonial_background'];
		$testimonial_name_color			= $settings['testimonial_name_color'];
		$img							= $settings['img']['url'];
		$name						 	= $settings['name'];
		$social						 	= $settings['social'];
		$member_job						= $settings['member_job'];
		$thumbnail_width				= $settings['thumbnail']['width'];
		$thumbnail_height				= $settings['thumbnail']['height'];

		if ( !empty( $settings['thumbnail']['width'] ) || !empty( $settings['thumbnail']['height'] ) ) {
			// if main class not exist get it
			if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
				require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
			}

			$image = new \Wn_Img_Maniuplate; // instance from settor class

			$img = $image->m_image( $settings['img']['id'] , $settings['img']['url'] , $settings['thumbnail']['width'] , $settings['thumbnail']['height'] ); // set required and get result
		}

        // Class & ID 
        $shortcodeclass 				= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
        $shortcodeid					= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';

		static $uniqid = 0;
		$uniqid++;
		$comma_job		= ( $type == '5' && $member_job ) ? ', ' . $member_job  : '' ;
		$color			= ( $testimonial_name_color ) ? ' #wrap .testimonial { color:' . $testimonial_name_color . ';} ' : '';
		$background		= ( $testimonial_background ) ? ' #wrap .elementor-element-'.$this->get_id().' .testimonial .content { background:' . $testimonial_background . ';} ' : '';
		$border_color	= ( $testimonial_background ) ? ' #wrap .elementor-element-'.$this->get_id().' .testimonial .triangle,#wrap .elementor-element-'.$this->get_id().' .testimonial .testimonial-arrow:after { border-top-color:' . $testimonial_background . ';}  ' : '';

		// socials
		$socials = '';
		if ( $social == 'enable' ) :
			$first_social			= $settings['first_social'];
			$first_url				= $settings['first_url']['url'];
			$second_social			= $settings['second_social'];
			$second_url				= $settings['second_url']['url'];
			$third_social			= $settings['third_social'];
			$third_url				= $settings['third_url']['url'];
			$fourth_social			= $settings['fourth_social'];
			$fourth_url				= $settings['fourth_url']['url'];
			$link_target_first		= $settings['first_url']['is_external']		? ' target="_blank" ' : '';
			$link_target_second		= $settings['second_url']['is_external']	? ' target="_blank" ' : '';
			$link_target_third 		= $settings['third_url']['is_external']		? ' target="_blank" ' : '';
			$link_target_fourth 	= $settings['fourth_url']['is_external']	? ' target="_blank" ' : '';
			$social1 				= $social2 = $social3 = $social4 = '';
			$social1 				= ( $first_url ) ? '<a href="' . $first_url . '" '.$link_target_first.'><i class="' . $first_social . '"></i></a>' : '';
			$social2 				= ( $second_url ) ? '<a href="' . $second_url . '" '.$link_target_second.'><i class="' . $second_social . '"></i></a>' : '';
			$social3 				= ( $third_url ) ? '<a href="' . $third_url . '" '.$link_target_third.'><i class="' . $third_social . '"></i></a>' : '';
			$social4 				= ( $fourth_url ) ? '<a href="' . $fourth_url . '" '.$link_target_fourth.'><i class="' . $fourth_social . '"></i></a>' : '';
			$socials 				= '<div class="tl-social-team">' . $social1 . $social2 . $social3 . $social4 . '</div>';
		endif;

		$out = '';
		$img = !empty( $img ) ? '<img src="'. $img .'" alt="'. $name .'">' : '';

		if ( $type == 1 ) :
			$out .= '<div class="wn-single-ts single-testimonial testimonial testimonial ' . $shortcodeclass . '"  ' . $shortcodeid . '>';
			$out .= '<div class="testimonial-content content">';
			$out .= '<h4><q>'. $testimonial_content .'</q></h4>';
			$out .= '<div class="testimonial-arrow"></div>';
			$out .= '</div>';
			$out .= '<div class="testimonial-brand">'.$img;
			$out .= '<h5><strong>'.$name.'</strong><br><em>'.$member_job.'</em></h5></div>';
			$out .= '</div>';
		elseif( $type == 4 ) :
			$out .='
				<div class="wn-single-ts testimonial'. $type .' testimonial ' . $shortcodeclass . '"  ' . $shortcodeid . '>
					<div class="testimonial-content content	">
						<div class="testimonial-image">
							' . $img . '
						</div>
						<h5> ' . $name . ' </h5>
						<q> ' . $testimonial_content . ' </q>
					</div>
				</div>
			';
		elseif( $type == 5 ) :
			$out .='
				<div class="wn-single-ts testimonial'. $type .' testimonial ' . $shortcodeclass . '"  ' . $shortcodeid . '>
					<div class="testimonial-content">
						<div class="testimonial-image">
							' . $img . '
						</div>
						<q class="content"> ' . $testimonial_content . ' </q>
						<span class="triangle"></span>
						<div class="name"> ' . $name . ' </div>
						<div class="job"> ' . $comma_job . ' </div>
					</div>
				</div>
		';
		else :
			$name	 = $name ? '<h5><strong>'. $name .'</strong></h5>' : '';
			$member_job	 = $member_job ? '<h6>'. $member_job .'</h6>' : '';
			$content = $testimonial_content ? '<p class="content">'. $testimonial_content .'<span class="shape"></span></p>' : '';

			if ( $type == 3 ) {
				$out = '<div class="wn-single-ts testimonial'. $type .' testimonial">
					'. $img .'<div class="testimonial-content">'. $content .' <div class="t-m-footer">'.$name.' '.$member_job .  $socials .'</div></div></div>';
			} else {
				$out = '
				<div class="wn-single-ts testimonial'. $type .' testimonial ' . $shortcodeclass . '"  ' . $shortcodeid . '>
					' . $img . '
					<div class="testimonial-content">' . $name . $content . '</div>
				</div>';
			}
		endif;
		
		$custom_css = $border_color . $background . $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}
		
		echo $out;
		
	}

}