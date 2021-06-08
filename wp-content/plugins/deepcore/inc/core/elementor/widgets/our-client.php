<?php
namespace Elementor;

class Webnus_Element_Widgets_Our_Client extends \Elementor\Widget_Base {

	/**
	 * Retrieve Our Clients widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'our_client';

	}

	/**
	 * Retrieve Our Clients widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Our Client', 'deep' );

	}

	/**
	 * Retrieve Our Clients widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'ti-layout-menu-full';

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

		return [ 'deep-owl-carousel', 'deep-our-client' ];

	}

	/**
	 * enqueue styles.
	 *
	 * @since 4.2.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'deep-owl-carousel', 'wn-deep-our-clients' ];

	}

	/**
	 * Register Our Clients widget controls.
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

		// Select Social Type
		$this->add_control(
			'type', //param_name
			[
				'label' 	=> esc_html__( 'Type', 'deep' ), //heading
				'type' 		=> Controls_Manager::SELECT, //type
				'default' 	=> '1',
				'options' 	=> [
                   		 '1'  	=> esc_html__( 'Grid', 'deep' ),
                   		 '2'  	=> esc_html__( 'Carousel', 'deep' ),
                   		// '3'  	=> esc_html__( 'Zoom', 'deep' ),
                   		 '4'  	=> esc_html__( 'Simple', 'deep' ),
                   		 '5'  	=> esc_html__( 'Simple Carousel', 'deep' ),
                   		 '6'  	=> esc_html__( 'Carousel2', 'deep' ),
				],
			]
        );

        $this->add_control(
            'client_images',
            [
                'label' => esc_html__( 'Add Images', 'deep' ),
                'type' => Controls_Manager::GALLERY,
            ]
        );

        // Greyscale Images
        $this->add_control(
            'filter',
            [
                'label'         => esc_html__( 'Greyscale Images', 'deep' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => '',
                'on'      		=> esc_html__( 'Enable', 'deep' ),
                'off'     		=> esc_html__( 'Disable', 'deep' ),
                'return_value'  => 'enable',
                'condition'     => array(
					'type'      => array( '1','2', '4','5', ),
				),
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

		$this->start_controls_section(
			'section_image_style',
			[
				'label' => __( 'Image', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'image_filters',
				'label' => __( 'Image', 'deep' ),
				'selector' => '{{WRAPPER}} .our-clients img, {{WRAPPER}} .our-clients-item-t5 img, {{WRAPPER}} .our-clients-item-t6 img,  {{WRAPPER}} .our-client-item img',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'image_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .our-clients img, {{WRAPPER}} .our-clients-item-t5 img, {{WRAPPER}} .our-clients-item-t6 img,  {{WRAPPER}} .our-client-item img',
			]
		);
		$this->add_control(
			'image_padding',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .our-clients img, {{WRAPPER}} .our-clients-item-t5 img, {{WRAPPER}} .our-clients-item-t6 img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'image_margin',
			[
				'label' 		=> __( 'Margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .our-clients img, {{WRAPPER}} .our-clients-item-t5 img, {{WRAPPER}} .our-clients-item-t6 img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'image_opacity',
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
					'{{WRAPPER}} .our-clients img, {{WRAPPER}} .our-clients-item-t5 img, {{WRAPPER}} .our-clients-item-t6 img' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'image_display',
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
					'{{WRAPPER}} .our-clients img, {{WRAPPER}} .our-clients-item-t5 img, {{WRAPPER}} .our-clients-item-t6 img' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'image_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .our-clients img, {{WRAPPER}} .our-clients-item-t5 img, {{WRAPPER}} .our-clients-item-t6 img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '{{WRAPPER}} .our-clients img, {{WRAPPER}} .our-clients-item-t5 img, {{WRAPPER}} .our-clients-item-t6 img,  {{WRAPPER}} .our-client-item img',
			]
		);
		$this->add_control(
			'hover2',
			[
				'label'     => __( 'Hover', 'deep' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'image_filters_hover',
				'label' => __( 'Image', 'deep' ),
				'selector' => '{{WRAPPER}} .our-clients img:hover, {{WRAPPER}} .our-clients-item-t5 img:hover, {{WRAPPER}} .our-clients-item-t6 img:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'image_bg_hover',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .our-clients img:hover, {{WRAPPER}} .our-clients-item-t5 img:hover, {{WRAPPER}} .our-clients-item-t6 img:hover',
			]
		);
		$this->add_control(
			'image_padding_hover',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .our-clients img:hover, {{WRAPPER}} .our-clients-item-t5 img:hover, {{WRAPPER}} .our-clients-item-t6 img:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'image_margin_hover',
			[
				'label' 		=> __( 'Margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .our-clients img:hover, {{WRAPPER}} .our-clients-item-t5 img:hover, {{WRAPPER}} .our-clients-item-t6 img:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'image_opacity_hover',
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
					'{{WRAPPER}} .our-clients img:hover, {{WRAPPER}} .our-clients-item-t5 img:hover, {{WRAPPER}} .our-clients-item-t6 img:hover' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'image_display_hover',
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
					'{{WRAPPER}} .our-clients img:hover, {{WRAPPER}} .our-clients-item-t5 img:hover, {{WRAPPER}} .our-clients-item-t6 img:hover' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'image_border_radius_hover',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .our-clients img:hover, {{WRAPPER}} .our-clients-item-t5 img:hover, {{WRAPPER}} .our-clients-item-t6 img:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border_hover',
				'label' => __( 'Border', 'deep' ),
				'selector' => '{{WRAPPER}} .our-clients img:hover, {{WRAPPER}} .our-clients-item-t5 img:hover, {{WRAPPER}} .our-clients-item-t6 img:hover',
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
				'selector' => '#wrap {{WRAPPER}} .our-clients',
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
					'#wrap {{WRAPPER}} .our-clients' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .our-clients',
			]
		);
		$this->add_control(
			'box_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .our-clients' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .our-clients',
				]
		);
		$this->add_control(
			'box_padding',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .our-clients' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .our-clients' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .our-clients' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .our-clients' => 'overflow: {{VALUE}};',
				],
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
			Group_Control_Background::get_type(),
			[
				'name'     => 'box_bg_hover',
				'label'    => __( 'Background', 'deep' ),
				'types'    => [ 'classic' , 'gradient' ],
				'selector' => '#wrap {{WRAPPER}} .our-clients:hover',
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
					'#wrap {{WRAPPER}} .our-clients:hover' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border_hover',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .our-clients:hover',
			]
		);
		$this->add_control(
			'box_border_radius_hover',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .our-clients:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow_hover',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .our-clients:hover',
				]
		);
		$this->add_control(
			'box_padding_hover',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .our-clients:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .our-clients:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .our-clients:hover' => 'opacity: {{SIZE}};',
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
	 * Render Our Clients widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings 			= $this->get_settings();
        $type               = $this->get_settings( 'type' );
		$images             = $this->get_settings( 'client_images' );
		$shortcodeclass		= $settings['shortcodeclass'];
		$shortcodeid		= $settings['shortcodeid'] ? 'id="' . $settings['shortcodeid'] . '"' : '' ;
		// $image_filter		= 'no-filter';
        //$filter             = $this->get_settings( 'image_filter' );

        foreach ( $images as $image ) {
            $img = $image['url'];
		}

		if ( 'enable' == $settings['filter'] ) {
			$image_filter = 'class="wn-gray-filter"';
		} else {
			$image_filter = '';
		}

        $alt_text = ' ';

		$client_images_url = '';
		$client_images_url2 = '';
		if( !empty( $client_images ) ) {
			$images_id_array = array();
			$images_id_array = explode( ',',$client_images );
			foreach( $images_id_array as $id ) {

				$alt_text		= get_post_meta($id, '_wp_attachment_image_alt', true);


				if( empty( $link ) ) {
					$client_images_url .= '
						<div class="our-client-item">
							<img alt="'.$alt_text.'" src="' .$img . '" '.$image_filter.'>
						</div>';
					$client_images_url2 .= '
						<div class="our-clients-item-t'.$type.'">
							<img alt="'.$alt_text.'" src="' .$img . '" '.$image_filter.'>
						</div>';
				} else {
					$client_images_url .= '
						<div class="our-client-item">
							<a target="_blank" href="' . esc_url( $link ) . '">
								<img alt="' . $alt_text . '"  src="' . $img . '" ' . $image_filter . '>
							</a>
						</div>';
					$client_images_url2 .= '
						<div class="our-clients-item-t' . $type . '">
							<a href="' . esc_url( $link ) . '">
								<img alt="'.$alt_text.'" src="' .$img . '" ' . $image_filter . '>
							</a>
						</div>';
				}
			}
		}

		foreach ( $images as $image ) {
			if( empty( $link ) ) {
				$client_images_url .= '<div class="our-client-item"><img alt="'.$alt_text.'" src="' .$image['url']. '" '.$image_filter.'></div>';
				$client_images_url2 .= '<div class="our-clients-item-t'.$type.'"><img alt="'.$alt_text.'" src="' .$image['url']. '" '.$image_filter.'></div>';
			} else {
				$client_images_url .= '<div class="our-client-item"><a href="' . esc_url( $link ) . '"><img alt="'.$alt_text.'" src="' .$image['url']. '" '.$image_filter.'></a></div>';
				$client_images_url2 .= '<div class="our-clients-item-t'.$type.'"><a href="' . esc_url( $link ) . '"><img alt="'.$alt_text.'" src="' .$image['url']. '" '.$image_filter.'></a></div>';
			}
		}

		$out = '';
		if ( $type == 1 || $type == 2 ) {
			$out .= '<div class="aligncenter ' . $shortcodeclass . '"  ' . $shortcodeid . '>';
			$out .= '<hr class="vertical-space1"><div class="col-md-12 our-clients-wrap">';
			$out .= '<div id="our-clients" class="our-clients ';
			if ( $type == 2 ) {
				$out .= 'owl-carousel owl-theme our-clients-wrap-carousel';
			}
			$out .= '">';
			$out .= $client_images_url;
			$out .='</div>';
			$out .= '</div><hr class="vertical-space2"></div>';
		} elseif( $type == 4 ) {
			$out .= '<div class="our-clients-type4 our-clients-wrap ' . $shortcodeclass . '"  ' . $shortcodeid . '>';
			$out .= '<div class="center">';
			$out .= $client_images_url;
			$out .= '</div>';
			$out .= '</div>';
		} elseif( $type == 5 ) {
			$out  = '<div class="our-clients-wrap our-clients-type5 owl-carousel owl-theme ' . $shortcodeclass . '"  ' . $shortcodeid . '>';
			$out .= $client_images_url2;
			$out .= '</div>';
		} elseif( $type == 6 ) {
			$out .= '<div class="our-clients-wrap our-clients-type6 owl-carousel owl-theme ' . $shortcodeclass . '"  ' . $shortcodeid . '>';
			$out .= $client_images_url2;
			$out .= '</div>';
		}

		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}

		echo $out;

	}

}
