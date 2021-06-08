<?php
namespace Elementor;

class Webnus_Element_Widgets_Image_Carousel extends \Elementor\Widget_Base {

	/**
	 * Retrieve Image Carousel widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'image_carousel';

	}

	/**
	 * Retrieve Image Carousel widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Image Carousel', 'deep' );

	}

	/**
	 * Retrieve Image Carousel widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-carousel';

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

		return [ 'deep-owl-carousel', 'deep-image-carousel' ];

	}

	/**
	 * enqueue styles.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'deep-owl-carousel' ];

	}

	/**
	 * Register Image Carousel widget controls.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'content_sectiona',
			[
				'label' => esc_html__( 'General Settings', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);
		$this->add_control(
			'type',
			[
				'label' 	=> esc_html__( 'Image Carousel Type', 'deep' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> 'type1',
				'options' 	=> [
                   		 'type1'  	=> esc_html__( 'Type 1', 'deep' ),
                   		 'type2'  	=> esc_html__( 'Type 2', 'deep' ),
                   		 'type3'  	=> esc_html__( 'Type 3', 'deep' ),
                   		 'type4'  	=> esc_html__( 'Type 4', 'deep' ),
				],
			]
		);
        $this->end_controls_section();

		$this->start_controls_section(
			'content_sectionb',
			[
				'label' => esc_html__( 'Image Items', 'deep' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
		);
        $this->add_control(
            'item_carousle',
            [
                'label'         => esc_html__( 'Carousle Items', 'deep' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => 3,
                'min'           => 1,
                'max'           => 12,
                'step'          => 1,
                'description'   => esc_html__( 'Type nothing to default (3).', 'deep'),
				'condition'     => [
					'type'      	=> [
						'type1',
					],
				],
            ]
        );
		$this->add_control(
			'image_item',
			[
				'label' 		=> esc_html__( 'Image Item', 'deep' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> [
						[
							'name' 			=> 'image',
							'label'         => esc_html__( 'Choose Image', 'deep' ),
							'type'          => Controls_Manager::MEDIA,
                            'default'       => [
                                    'url' => Utils::get_placeholder_image_src(),
                            ],
						],
				],
				'default' => [
					[
						'image' => Utils::get_placeholder_image_src(),
					],
					[
						'image' => Utils::get_placeholder_image_src(),
                    ],
				],
				'condition'     => [
					'type'      	=> [
						'type1', 'type2', 'type4',
					],
				],
			]
        );
		$this->add_control(
			'image_item_t3',
			[
				'label' 		=> esc_html__( 'Image Item', 'deep' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> [
						[
							'name' 			=> 'image_t3',
							'label'         => esc_html__( 'Choose Image', 'deep' ),
							'type'          => Controls_Manager::MEDIA,
                            'default'       => [
                                    'url' => Utils::get_placeholder_image_src(),
							],
							'label_block' 	=> true,
						],
						[
							'name' 			=> 'title_t3',
							'label' 		=> esc_html__( 'Caption', 'deep' ),
							'type' 			=> Controls_Manager::TEXT,
							'label_block' 	=> true,
						],
				],
				'default' => [
					[
						'image_t3' => Utils::get_placeholder_image_src(),
					],
					[
						'image_t3' => Utils::get_placeholder_image_src(),
                    ],
				],
				'condition'     => [
					'type'      	=> [
						'type3',
					],
				],
			]
		);
        $this->end_controls_section();

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
			'images_style',
			[
				'label' => __( 'Images Style', 'deep' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'images_bg',
				'label'    => __( 'Background', 'deep' ),
				'types'    => [ 'classic' , 'gradient' ],
				'selector' => '#wrap {{WRAPPER}} .services-carousel img',
			]
		);
		$this->add_control(
			'images_display',
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
					'#wrap {{WRAPPER}} .services-carousel img' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'images_border',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .services-carousel img',
			]
		);
		$this->add_control(
			'images_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .services-carousel img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'images_shadow',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .services-carousel img',
				]
		);
		$this->add_control(
			'images_padding',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .services-carousel img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'images_margin',
			[
				'label' 		=> __( 'Margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .services-carousel img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'images_opacity',
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
					'#wrap {{WRAPPER}} .services-carousel img' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'hover_images',
			[
				'label'     => __( 'Hover', 'deep' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'images_bg_hover',
				'label'    => __( 'Background', 'deep' ),
				'types'    => [ 'classic' , 'gradient' ],
				'selector' => '#wrap {{WRAPPER}} .services-carousel img:hover',
			]
		);
		$this->add_control(
			'images_display_hover',
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
					'#wrap {{WRAPPER}} .services-carousel img:hover' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'images_border_hover',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .services-carousel img:hover',
			]
		);
		$this->add_control(
			'images_border_radius_hover',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .services-carousel img:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'images_shadow_hover',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .services-carousel img:hover',
				]
		);
		$this->add_control(
			'images_padding_hover',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .services-carousel img:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'images_margin_hover',
			[
				'label' 	  => __( 'Margin', 'deep' ),
				'type' 		  => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'  => [ 'px', 'em', '%' ],
				'selectors'   => [
					'#wrap {{WRAPPER}} .services-carousel img:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'images_opacity_hover',
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
					'#wrap {{WRAPPER}} .services-carousel img:hover' => 'opacity: {{SIZE}};',
				],
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
				'selector' => '#wrap {{WRAPPER}} .w-image-carousel',
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
					'#wrap {{WRAPPER}} .w-image-carousel' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .w-image-carousel',
			]
		);
		$this->add_control(
			'box_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .w-image-carousel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .w-image-carousel',
				]
		);
		$this->add_control(
			'box_padding',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .w-image-carousel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .w-image-carousel' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .w-image-carousel' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .w-image-carousel' => 'overflow: {{VALUE}};',
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
				'selector' => '#wrap {{WRAPPER}} .w-image-carousel:hover',
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
					'#wrap {{WRAPPER}} .w-image-carousel:hover' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border_hover',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .w-image-carousel:hover',
			]
		);
		$this->add_control(
			'box_border_radius_hover',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .w-image-carousel:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow_hover',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .w-image-carousel:hover',
				]
		);
		$this->add_control(
			'box_padding_hover',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .w-image-carousel:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .w-image-carousel:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .w-image-carousel:hover' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->end_controls_section();

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
	 * Render Image Carousel widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings 			    = $this->get_settings();

		switch ($settings['type']) {
			case 'type1':
				$style_type = '1';
				break;
			case 'type2':
				$style_type = '2';
				break;
			case 'type3':
				$style_type = '3';
				break;
			case 'type4':
				$style_type = '4';
				break;
		}

		wp_enqueue_style( 'wn-deep-image-carousel0', DEEP_ASSETS_URL . 'css/frontend/image-carousel/image-carousel0.css' );
		wp_enqueue_style( 'wn-deep-image-carousel' . $settings['type'], DEEP_ASSETS_URL . 'css/frontend/image-carousel/image-carousel' . $settings['type'] . '.css' );

		$type               	= $settings['type'] ? $settings['type'] : '';
		$image_item  			= $settings['image_item'] ? $settings['image_item'] : '';
		$image_item_t3  		= $settings['image_item_t3'] ? $settings['image_item_t3'] : '';
		$item_carousle  		= $settings['item_carousle'] ? $settings['item_carousle'] : '3';

        // Class & ID
        $shortcodeclass 	= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
        $shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';

		// Render
		if ( $type == 'type1') {
			$out = '
			<div class="clearfix ">
					<div class="w-image-carousel owl-carousel owl-theme ' . $shortcodeclass . '"  ' . $shortcodeid . ' data-items="' . $item_carousle . '" >';
						foreach ( $image_item as $line ) :

							$img	= isset( $line['image'] ) ? '<img src="' . $line['image']['url'] . '" alt="' . $line['image']['id'] . '">' : '';
							$out .=' <div class="services-carousel"> ' . $img . ' </div>';

						endforeach;
			$out .='
					</div>
			</div>';
		} elseif ( $type == 'type2' ) {
			$out = '
			<div class="clearfix">
					<div class="wn-vertical-carousel w-image-carousel-type2 owl-carousel owl-theme ' . $shortcodeclass . '" ' . $shortcodeid . '>';

						foreach ( $image_item as $line ) :

							$img    = isset( $line['image'] ) ? '<img src="' . $line['image']['url'] . '" alt="' . $line['image']['id'] . '">' : '';
							$out .=' <div class="services-carousel"> ' . $img . ' </div>';

						endforeach;

			$out .='
					</div>
			</div>';
		} elseif ( $type == 'type3' ) {

			$out = '
			<div class="clearfix">
					<div class="colorb">
						<div class="wn-vertical-carousel w-image-carousel-type3 owl-carousel owl-theme ' . $shortcodeclass . '" ' . $shortcodeid . '>';
							foreach ( $image_item_t3 as $line ) :

								$img	= isset( $line['image_t3'] ) ? '<img src="' . $line['image_t3']['url'] . '" alt="' . $line['title_t3'] . '">' : '';
								$title	= isset( $line['title_t3'] ) ? '<span class="image-title">' . $line['title_t3'] . '</span>' : '';

								$out .='<div class="services-carousel"> ' . $img . $title .' </div>';

							endforeach;

				$out .='
						</div>
					</div>
			</div>';
		} elseif ( $type == 'type4' ) {
			$out = '
			<div class="clearfix">
					<div class="wn-vertical-carousel w-image-carousel-type4 owl-carousel owl-theme ' . $shortcodeclass . ' " ' . $shortcodeid . '>';

						foreach ( $image_item as $line ) :

							$img = isset( $line['image'] ) ? '<img src="' . $line['image']['url'] . '" alt="' . $line['image']['id'] . '">' : '';
							$out .=' <div class="services-carousel"> ' . $img . ' </div>';

						endforeach;

				$out .='
					</div>
			</div>';
		}
		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}
		echo $out;

	}

}
