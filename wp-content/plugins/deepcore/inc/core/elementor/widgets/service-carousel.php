<?php
namespace Elementor;

class Webnus_Element_Widgets_Service_Carousel extends \Elementor\Widget_Base {

	/**
	 * Retrieve Service Carousel widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'service_carousel';

	}

	/**
	 * Retrieve Service Carousel widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Service Carousel', 'deep' );

	}

	/**
	 * Retrieve Service Carousel widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-slideshow';

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

		return [ 'deep-owl-carousel', 'deep-service-carousel' ];

	}

	/**
	 * widget styles.
	 *
	 * @since 4.2.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'deep-owl-carousel', 'wn-deep-our-services-carousel' ];

	}

	/**
	 * Register Service Carousel widget controls.
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
				'label' => esc_html__( 'Carousel Settings', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		// Carousel items
		$this->add_control(
			'item_carousle',
			[
				'label' 		=> esc_html__( 'Carousel Items', 'deep' ),
				'type' 			=> Controls_Manager::TEXT,
				'placeholder' 	=> esc_html__( '3', 'deep' ),
				'default' 		=> '3',
			]
		);

		// Repeater For :: undeca
		$this->add_control(
			'carousel_item',
			[
				'label' 		=> esc_html__( 'Testimonial Item', 'deep' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> [
					[
						'name' 			=> 'service_content',
						'label' 		=> esc_html__( 'Box Content', 'deep' ),
						'type'          => Controls_Manager::TEXTAREA,
						'label_block' 	=> true,
					],
					[
						'name' 			=> 'service_title',
						'label' 		=> esc_html__( 'Box Title', 'deep' ),
						'type' 			=> Controls_Manager::TEXT,
						'label_block' 	=> true,
					],
					[
						'name'          => 'service_icon',
						'label'         => esc_html__( 'Select Icon', 'deep' ),
						'type'          => Controls_Manager::ICON,
					],
				],
				'default' => [
					[
						'service_content' => __( 'making this the first true generator on the Internet.<br> It uses a dictionary of over 200 Latin words,<br> combined with a handful of model sentence structures', 'deep' ),
						'service_title' =>  __( 'Item 1', 'deep' ),
						'service_icon' => 'sl-screen-tablet',
					],
					[
						'service_content' => __( 'making this the first true generator on the Internet.<br> It uses a dictionary of over 200 Latin words,<br> combined with a handful of model sentence structures', 'deep' ),
						'service_title' =>  __( 'Item 2', 'deep' ),
						'service_icon' => 'sl-screen-tablet',
					],
					[
						'service_content' => __( 'making this the first true generator on the Internet.<br> It uses a dictionary of over 200 Latin words,<br> combined with a handful of model sentence structures', 'deep' ),
						'service_title' =>  __( 'Item 3', 'deep' ),
						'service_icon' => 'sl-screen-tablet',
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
				'selector' 	=> '#wrap {{WRAPPER}} .our-service-carousel-wrap h2',
			]
		);

		$this->add_control(
			'title_color', //param_name
			[
				'label' 		=> __( 'Color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .our-service-carousel-wrap h2' => 'color: {{VALUE}} !important',
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
				'selector' 	=> '#wrap {{WRAPPER}} .our-service-carousel-wrap p',
			]
		);

		$this->add_control(
			'content_color', //param_name
			[
				'label' 		=> __( 'Color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .our-service-carousel-wrap p' => 'color: {{VALUE}} !important',
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
				'selector' => '#wrap {{WRAPPER}} .our-service-carousel-wrap',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .our-service-carousel-wrap',
			]
		);

		$this->add_control(
			'box_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .our-service-carousel-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'box_shadow',
					'label' => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .our-service-carousel-wrap',
				]
		);

		$this->add_control(
			'box_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .our-service-carousel-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .our-service-carousel-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

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
	 * Render Service Carousel widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
        $settings               = $this->get_settings_for_display();
		$item_carousle           = $settings['item_carousle'];
		$carousel_item           = $settings['carousel_item'];
        // Class & ID
        $shortcodeclass 	= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
        $shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';
		// Render
		$out = '
			<div class="clearfix ' . $shortcodeclass . '"  ' . $shortcodeid . '>
				<div class="clearfix">
                    <div class="our-service-carousel-wrap owl-carousel owl-theme" data-items="' . $item_carousle . '" >';

                            foreach ( $carousel_item as $line ) :

                                $service_title           = isset ( $line['service_title'] ) ? $line['service_title'] : '' ;
                                $service_content         = isset ( $line['service_content'] ) ? $line['service_content'] : '' ;
                                $service_icon            = isset ( $line['service_icon'] ) ? $line['service_icon'] : '' ;

                                $service_title          = $line['service_icon'] 	? '<i class="' . $line['service_icon'] . '"></i>' : '' ;
                                $service_content        = $line['service_title'] 	? '<h2>' . $line['service_title'] . '</h2>' : '' ;
                                $service_icon           = $line['service_content'] 	? '<p>' . $line['service_content'] . '</p>' : '' ;

                                $out .='
                                <div class="services-carousel">
                                    ' . $service_icon . '
                                    <div class="tdetail">
                                        ' . $service_title . $service_content . '
                                    </div>
                                </div>';
							endforeach;

		$out .='
					</div>
				</div>
			</div>';

        $custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}

	echo $out;

	}

}
