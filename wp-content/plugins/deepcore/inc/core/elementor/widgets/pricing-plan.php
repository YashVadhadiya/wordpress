<?php
namespace Elementor;
class Webnus_Element_Widgets_Pricing_Plan extends \Elementor\Widget_Base {

	/**
	 * Retrieve Pricing Plan widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'pricing-plan';
		
	}

	/**
	 * Retrieve Pricing Plan widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Pricing Plan', 'deep' );

	}

	/**
	 * Retrieve Pricing Plan widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'ti-money';

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
	 * Register Pricing Plan widget controls.
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
				'tab' => Controls_Manager::TAB_CONTENT,
            ]
		);

		// Select Pricing Plan Type
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
				],
			]
		);

		// Title
		$this->add_control(
			'title', 
			[
				'label' 		=> esc_html__( 'Title', 'deep' ), 
				'type' 			=> Controls_Manager::TEXT, 
				'placeholder' 	=> esc_html__( 'Type your title text here', 'deep' ),
				'default' 		=> esc_html__( 'Price Title', 'deep' ),
			]
        );
        
		// Features
		$this->add_control(
			'features',
			[
				'label' 		=> esc_html__( 'Repeater List', 'deep' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> [
					[
						'name'		=> 'feature_icon',
						'label' 	=> esc_html__( 'Feature Item Icon', 'deep' ),
						'type' 		=> Controls_Manager::SELECT, 
						'default' 	=> 'empty-icon',
						'options' 	=> [
								'empty-icon'        	=> esc_html__( 'Empty', 'deep' ),
								'available-icon'  	    => esc_html__( 'Available', 'deep' ),
								'not-available-icon'  	=> esc_html__( 'Not Available', 'deep' ),
						],
					],
					[
						'name' 			=> 'feature_item',
						'label' 		=> esc_html__( 'Feature Item', 'deep' ),
						'type' 			=> Controls_Manager::TEXT,
						'label_block' 	=> true,
					],
                ],
                'condition'     => array(
					'type'      => array( '2','3' ),
				),
			]
		);

		// Content
		$this->add_control(
			'text_content',
			[
				'label' 		=> esc_html__( 'Content', 'deep' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 10,
                'placeholder' 	=> esc_html__( 'Content Goes Here', 'deep' ),
                'condition'     => array(
					'type'      => array( '1' ),
				),
				'default' 		=> esc_html__( 'The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 'deep' ),
			]
		);

        // Flag
        $this->add_control(
            'flag',
            [
                'label'       => esc_html__( 'Flag', 'deep' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none'          => esc_html__( 'None', 'deep' ),
                    'featured'      => esc_html__( 'Featured', 'deep' ),
                    'popular'       => esc_html__( 'Popular', 'deep' ),
                ],
                'condition'     => array(
					'type'      => array( '2', ),
				),
            ]
        );
    
		// Upload Image
		$this->add_control(
			'img',
			[
				'label' 		=> esc_html__( 'Choose Image', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA, //type
				'default' 		=> [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'selectors' => [
					'{{WRAPPER}} .ppbg-overlay' => 'background: url({{URL}}) no-repeat;',
                ],
                'condition'     => array(
					'type'      => array( '3' ),
				),
			]
		);


		// Price
		$this->add_control(
			'price', 
			[
				'label' 		=> esc_html__( 'Price', 'deep' ), 
                'type' 			=> Controls_Manager::TEXT, 
                'default'       => '200$',
				'placeholder' 	=> esc_html__( 'Type your Price text here', 'deep' ),
			]
        );

		// Period
		$this->add_control(
			'period', 
			[
				'label' 		=> esc_html__( 'Period', 'deep' ), 
                'type' 			=> Controls_Manager::TEXT, 
                'placeholder' 	=> esc_html__( 'Type your Period text here', 'deep' ),
                'condition'     => array(
					'type'      => array( '3', ),
				),
			]
        );

		// Link Text
		$this->add_control(
			'link_text', 
			[
				'label' 		=> esc_html__( 'Link Text', 'deep' ), 
                'type' 			=> Controls_Manager::TEXT, 
				'placeholder' 	=> esc_html__( 'Type your Link Text text here', 'deep' ),
				'default' 		=> esc_html__( 'Link Text', 'deep' ),
			]
        );

		// URL
		$this->add_control(
			'link_url', //param_name
			[
				'label' 		=> esc_html__( 'Link URL', 'deep' ), //heading
				'type' 			=> Controls_Manager::URL,
				'default' 		=> [
						'url' 				=> '#',
						'is_external' 		=> '',
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
				'label' => __( 'Title style', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'title_typography',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .wn-pricing-plan h4',
			]
		);

		$this->add_control(
			'title_color', //param_name
			[
				'label' 		=> __( 'Color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-pricing-plan h4' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Content style', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'content_typography',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .wn-pricing-plan p',
			]
		);

		$this->add_control(
			'content_color', //param_name
			[
				'label' 		=> __( 'Color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-pricing-plan p' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_price_style',
			[
				'label' => __( 'Price style', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'price_typography',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .wn-pricing-plan .price',
			]
		);

		$this->add_control(
			'price_color', //param_name
			[
				'label' 		=> __( 'Color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-pricing-plan .price' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			[
				'label' => __( 'Button style', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'button_typography',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .wn-pricing-plan .readmore',
			]
		);

		$this->add_control(
			'button_color', //param_name
			[
				'label' 		=> __( 'Color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-pricing-plan .readmore' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' , 'gradient' ],
				'selector' => '#wrap {{WRAPPER}} .wn-pricing-plan .readmore',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-pricing-plan .readmore',
			]
		);

		$this->add_control(
			'button_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-pricing-plan .readmore' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'button_shadow',
					'label' => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .wn-pricing-plan .readmore',
				]
		);

		$this->add_control(
			'button_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-pricing-plan .readmore' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_margin', //param_name
			[
				'label' 		=> __( 'Margin', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-pricing-plan .readmore' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
				'selector' => '#wrap {{WRAPPER}} .wn-pricing-plan',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-pricing-plan',
			]
		);

		$this->add_control(
			'box_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-pricing-plan' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'box_shadow',
					'label' => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .wn-pricing-plan',
				]
		);

		$this->add_control(
			'box_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-pricing-plan' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-pricing-plan' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	 * Render Pricing Plan widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings();

		wp_enqueue_style( 'wn-deep-pricing-plan' . $settings['type'], DEEP_ASSETS_URL . 'css/frontend/pricing-plan/pricing-plan' . $settings['type'] . '.css' );

		$type 			= $settings['type'] ? $settings['type'] : '' ;
		$title 			= $settings['title'] ? '<h4>'. esc_html($settings['title']) .'</h4>' : '' ;
		$text_content 	= $settings['text_content'] ? '<p>' . $settings['text_content'] . '</p>' : '' ;
		$flag 			= $settings['flag'] != 'none' ?'<div class="ppflag">' .  $settings['flag']  . '</div>' : '' ;
		$price 			= $settings['price'] ? '<span class="price">'. $settings['price']  . " " .'</span>' : '' ;
		$period 		= $settings['period'] ? '<span class="period">'. "/" . " " . $settings['period'] .'</span>' : '' ;
		$link_text 		= $settings['link_text'] ? $settings['link_text'] : '' ;
		$link_url 		= $settings['link_url']['url'] ? $settings['link_url']['url'] : '' ;
		$link_target 	= $settings['link_url']['is_external'] ? 'target="_blank"' : '';
		$nofollow 		= $settings['link_url']['nofollow'] ? 'rel="nofollow"' : '';
		$link_html 		= $link_text ? '<a href="'. esc_url($link_url) .'" class="readmore" '.$link_target.' '.$nofollow.'>'. esc_html($link_text) .'</a>' : '' ;

		// Class & ID 
        $shortcodeclass 	= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
		$shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';
		
		$out = '<div class="wn-pricing-plan pricing-plan'. esc_html( $settings['type'] ) .' ' . $shortcodeclass . '"  ' . $shortcodeid . '>';

		if ( $settings['type'] == '1' ) {

			$out .= '
				<div class="ppheader"> ' . $title . $text_content . ' </div>
				<div class="ppfooter"> ' . $price . $link_html . ' </div> ';

		} elseif ( $settings['type'] == '2' ) {

			$features_out = '<ul class="ppfeatures">';

					if ( $settings['features']  ) {

						foreach (  $settings['features'] as $item ) {

							$features_out .= '<li class="feature-item">';

							if ( $item[ 'feature_icon' ] != 'empty-icon' ) {

								$features_out .= '<span class="feature-icon ' . esc_html( $item['feature_icon'] ) . '"></span>';

							}

							$features_out .= esc_html( $item['feature_item'] ) . '</li>';

						}

					}

			$features_out .= '</ul>';

			$out .=  $flag . '
					<div class="ppheader"> ' . $title . $features_out . ' </div>
					<div class="ppfooter"> ' . $price . $link_html . ' </div> ';

		} elseif ( $settings['type'] == '3' ) {

			$features_out = '<ul class="ppfeatures">';

					if ( $settings['features']  ) {

						foreach (  $settings['features'] as $item ) {

							$features_out .= '<li class="feature-item">';

							if ( $item[ 'feature_icon' ] != 'empty-icon' ) {

								$features_out .= '<span class="feature-icon ' . esc_html( $item['feature_icon'] ) . '"></span>';

							}

							$features_out .= esc_html( $item['feature_item'] ) . '</li>';

						}

					}

			$features_out .= '</ul>';
			$out .= '
				<div class="ppbg-overlay"></div>
				<div class="ppbc-overlay colorb"></div>
				<div class="ppcontent">
					<div class="clearfix">
						<div class="col-lg-4 col-md-3">
							<div class="ppheader colorb"> 
								' . $title . $price . $period . ' 
							</div>
							<span class="pptriangle"></span>
						</div>
						<div class="col-lg-6 col-md-7">
							' . $features_out . ' 
						</div>
						<div class="col-lg-2">
							<div class="ppfooter"> '  . $link_html  . ' </div> 
						</div>
					</div>
				</div>';
		
		}

		$out .= '</div>'; //Close main wrap

        $custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}
		echo $out;

	}

}