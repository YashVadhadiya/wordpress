<?php
namespace Elementor;
class Webnus_Element_Widgets_Teaserbox extends \Elementor\Widget_Base {

	/**
	 * Retrieve Teaserbox widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'teaserbox';
		
	}

	/**
	 * Retrieve Teaserbox widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Webnus Teaserbox', 'deep' );
	}

	/**
	 * Retrieve Teaserbox widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-image-rollover';
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
	 * Register Teaserbox widget controls.
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
		$this->add_control(
			'type', 
			[
				'label' 	=> __( 'Select Type', 'deep' ),
				'type' 		=> \Elementor\Controls_Manager::SELECT,
				'default' 	=> '1',
				'options' 	=> [ 
					'1'  	=> __( 'Type 1', 'deep' ),
					'2' 	=> __( 'Type 2', 'deep' ),
					'3' 	=> __( 'Type 3', 'deep' ),
					'4' 	=> __( 'Type 4', 'deep' ),
					'5' 	=> __( 'Type 5', 'deep' ),
					'6' 	=> __( 'Type 6', 'deep' ),
					'7' 	=> __( 'Type 7', 'deep' ),
					'8' 	=> __( 'Type 8', 'deep' ),
					'9' 	=> __( 'Type 9', 'deep' ),
					'10' 	=> __( 'Type 10', 'deep' ),
					'11' 	=> __( 'Type 11', 'deep' ),
					'12' 	=> __( 'Type 12', 'deep' ),
					'13' 	=> __( 'Type 13', 'deep' ),
					'14' 	=> __( 'Type 14', 'deep' ),
					'15' 	=> __( 'Type 15', 'deep' ),
					'16' 	=> __( 'Type 16', 'deep' ),
					'17' 	=> __( 'Type 17', 'deep' ),
					'18' 	=> __( 'Type 18', 'deep' ),
				],
			]
		);
		$this->add_control(
			'image', 
			[
				'label' 	=> __( 'Choose Image', 'deep' ),
				'type' 		=> \Elementor\Controls_Manager::MEDIA,
				'default' 	=> [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition'		=>	[
					'type!'		=>	[
						'17'
					],
				],
			]
		);
		$this->add_control(
			'thumbnail',
			[
				'label' 		=> __( 'Image Size', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
				'description' 	=> __( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'deep' ),
				'default' 		=> [
					'width' 		=> '',
					'height' 		=> '',
				],
				'condition'		=>	[
					'type!'		=>	[
						'17'
					],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .teaser-box17',
				'condition' 	=> [ 
					'type' 	=> [
						'17'
					],
				],
			]
		);
		$this->add_control(
			'image_alt', 
			[
				'label' 		=> __( 'Image alt', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'condition' 	=> [ 
					'type!' 	=> [
						'17'
					],
				],
			]
		);
		$this->add_control(
			'featured', 
			[
				'label' 		=> __( 'Tag Text', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'condition' 	=> [ 
					'type' 	=> [
						'8' , '15'
					],
				],
			]
		);
		$this->add_control(
			'time', 
			[
				'label' 		=> __( 'Time', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'condition' 	=> [ 
					'type' 	=> [
						'17'
					],
				],
			]
		);
		$this->add_control(
			'time_description', 
			[
				'label' 		=> __( 'Time Description', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'condition' 	=> [ 
					'type' 	=> [
						'17',
					],
				],
			]
		);
		$this->add_control(
			'title', 
			[
				'label' 		=> __( 'Title', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'subtitle', 
			[
				'label' 		=> __( 'Subtitle', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'condition' 	=> [ 
					'type' 	=> [
						'1', '2', '3', '4', '5', '6', '7', '8', '12', '13', '15', '16'
					],
				],
			]
		);
		$this->add_control(
			'teaser_btn', 
			[
				'label' 		=> __( 'Button Text', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'condition' 	=> [ 
					'type' 	=> [
						'8', '15', '16'
					],
				],
			]
		);
		$this->add_control(
			'link_url', 
			[
				'label' 		=> __( 'Button', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'deep' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
			]
		);
		$this->add_control(
			'teaser_btn_bg_color', 
			[
				'label' 		=> __( 'Background Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'scheme' 		=> [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' 	=> [
					'{{WRAPPER}} .teaser-btn' => 'background-color: {{VALUE}}',
				],
				'condition' 	=> [ 
					'type' 	=> [
						'8'
					],
				],
			]
		);
		$this->add_control(
			'teaser_btn_txt_color', 
			[
				'label' 		=> __( 'Text Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'scheme' 		=> [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' 	=> [
					'{{WRAPPER}} .teaser-btn' => 'color: {{VALUE}}',
				],
				'condition' 	=> [ 
					'type' 	=> [
						'8'
					],
				],
			]
		);
		$this->add_control(
			'text_content', 
			[
				'label' 		=> __( 'Content', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'rows' 			=> 10,
				'placeholder' 	=> __( 'Write Content', 'deep' ),
				'condition' 	=> [ 
					'type' 	=> [
						'10', '11', '15', '17', '10', '11'
					],
				],
			]
		);
		$this->add_control(
			'price', 
			[
				'label' 		=> __( 'Price', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'condition' 	=> [ 
					'type' 	=> [
						'15', '17'
					],
				],
			]
		);
		$this->add_control(
			'introduction_title', 
			[
				'label' 		=> __( 'Introduction Link Text', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'condition' 	=> [ 
					'type' 	=> [
						'18'
					],
				],
			]
		);
		$this->add_control(
			'introduction_link_url', 
			[
				'label' 		=> __( 'Introduction Link URL', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'default' 		=> [
					'url' 			=> 'https://your-link.com',
					'is_external' 	=> true,
				],
				'condition' 	=> [ 
					'type' 	=> [
						'18'
					],
				],
			]
		);
		$this->add_control(
			'live_preview_title', 
			[
				'label' 		=> __( 'Live Preview Link Text', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'condition' 	=> [ 
					'type' 	=> [
						'18'
					],
				],
			]
		);
		$this->add_control(
			'live_preview_link_url', 
			[
				'label' 		=> __( 'Live Preview Link URL', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'default' 		=> [
					'url' 			=> 'https://your-link.com',
					'is_external' 	=> true,
				],
				'condition' 	=> [ 
					'type' 	=> [
						'18'
					],
				],
			]
		);
		$this->add_control(
			'buy_item_title', 
			[
				'label' 		=> __( 'Buy Item Link Text', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'condition' 	=> [ 
					'type' 	=> [
						'18'
					],
				],
			]
		);
		$this->add_control(
			'buy_item_link_url', 
			[
				'label' 		=> __( 'Buy Item Link URL', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'default' 		=> [
					'url' 			=> 'https://your-link.com',
					'is_external' 	=> true,
				],
				'condition' 	=> [ 
					'type' 	=> [
						'18'
					],
				],
			]
		);
		$this->add_control(
			'features', 
			[
				'label' 		=> __( 'Repeater List', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::REPEATER,
				'fields' 		=> [ //params
					[
						'name' 			=> 'text', 
						'label' 		=> __( 'Property', 'deep' ),
						'type' 			=> \Elementor\Controls_Manager::TEXT,
						'admin_label' 	=> true,
					],
					[
						'name' 			=> 'number', 
						'label' 		=> __( 'Property Value', 'deep' ),
						'type' 			=> \Elementor\Controls_Manager::TEXT,
						'admin_label' 	=> true,
					],
				],
				'condition' 	=> [ 
					'type' 	=> [
						'15'
					],
				],
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
				'label' 	=> __( 'Title Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} h4.teaser-title, #wrap {{WRAPPER}} .c-title, {{WRAPPER}} .teaser-box18 .wn-title-box h4',
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
					'#wrap {{WRAPPER}} h4.teaser-title, #wrap {{WRAPPER}} .c-title, {{WRAPPER}} .teaser-box18 .wn-title-box h4' => 'text-align: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'title_color', 
			[
				'label' 		=> __( 'Title color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} h4.teaser-title, #wrap {{WRAPPER}} .c-title,{{WRAPPER}} .teaser-box18 .wn-title-box h4' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} h4.teaser-title, #wrap {{WRAPPER}} .c-title, {{WRAPPER}} .teaser-box18 .wn-title-box h4',
			]
		);
		$this->add_control(
			'title_padding', 
			[
				'label' 		=> __( 'Title padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} h4.teaser-title, #wrap {{WRAPPER}} .c-title, {{WRAPPER}} .teaser-box18 .wn-title-box h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} h4.teaser-title, #wrap {{WRAPPER}} .c-title, {{WRAPPER}} .teaser-box18 .wn-title-box h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} h4.teaser-title, #wrap {{WRAPPER}} .c-title, {{WRAPPER}} .teaser-box18 .wn-title-box h4' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} h4.teaser-title, #wrap {{WRAPPER}} .c-title, {{WRAPPER}} .teaser-box18 .wn-title-box h4' => 'display: {{VALUE}};',
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
					'#wrap {{WRAPPER}} h4.teaser-title, #wrap {{WRAPPER}} .c-title, {{WRAPPER}} .teaser-box18 .wn-title-box h4' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} h4.teaser-title, #wrap {{WRAPPER}} .c-title, {{WRAPPER}} .teaser-box18 .wn-title-box h4',
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
				'selector' 	=> '#wrap {{WRAPPER}} h4.teaser-title:hover, #wrap {{WRAPPER}} .c-title:hover, {{WRAPPER}} .teaser-box18 .wn-title-box h4:hover',
			]
		);
		$this->add_control(
			'title_color_hover', 
			[
				'label' 		=> __( 'Title color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} h4.teaser-title:hover, #wrap {{WRAPPER}} .c-title:hover,{{WRAPPER}} .teaser-box18 .wn-title-box h4:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_bg_hover',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} h4.teaser-title:hover, #wrap {{WRAPPER}} .c-title:hover, {{WRAPPER}} .teaser-box18 .wn-title-box h4:hover',
			]
		);
		$this->add_control(
			'title_padding_hover', 
			[
				'label' 		=> __( 'Title padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} h4.teaser-title:hover, #wrap {{WRAPPER}} .c-title:hover, {{WRAPPER}} .teaser-box18 .wn-title-box h4:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} h4.teaser-title:hover, #wrap {{WRAPPER}} .c-title:hover, {{WRAPPER}} .teaser-box18 .wn-title-box h4:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} h4.teaser-title:hover, #wrap {{WRAPPER}} .c-title:hover, {{WRAPPER}} .teaser-box18 .wn-title-box h4:hover' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} h4.teaser-title:hover, #wrap {{WRAPPER}} .c-title:hover, {{WRAPPER}} .teaser-box18 .wn-title-box h4:hover' => 'display: {{VALUE}};',
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
					'#wrap {{WRAPPER}} h4.teaser-title:hover, #wrap {{WRAPPER}} .c-title:hover, {{WRAPPER}} .teaser-box18 .wn-title-box h4:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_border_hover',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} h4.teaser-title:hover, #wrap {{WRAPPER}} .c-title:hover, {{WRAPPER}} .teaser-box18 .wn-title-box h4:hover',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_subtitle_style',
			[
				'label'			=> __( 'Subtitle', 'deep' ),
				'tab'			=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [ 
					'type' 	=> [
						'1', '2', '3', '4', '5', '6', '7', '8', '12', '13', '15', '16'
					],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'subtitle_typography',
				'label' 	=> __( 'Subtitle Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} h5.teaser-subtitle, #wrap {{WRAPPER}} .c-subtitle',
			]
		);
		$this->add_control(
			'subtitle_color', 
			[
				'label' 		=> __( 'Subtitle color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-teaser-box .teaser-subtitle, #wrap {{WRAPPER}} .c-subtitle' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'subtitle_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .teaser-subtitle, #wrap {{WRAPPER}} .c-subtitle',
			]
		);
		$this->add_control(
			'subtitle_padding', 
			[
				'label' 		=> __( 'Subtitle padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} h5.teaser-subtitle, #wrap {{WRAPPER}} .c-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'subtitle_margin', 
			[
				'label' 		=> __( 'Subtitle margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} h5.teaser-subtitle, #wrap {{WRAPPER}} .c-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);	
		$this->add_control(
			'subtitle_opacity',
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
					'#wrap {{WRAPPER}} h5.teaser-subtitle, #wrap {{WRAPPER}} .c-subtitle' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'subtitle_display',
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
					'#wrap {{WRAPPER}} h5.teaser-subtitle, #wrap {{WRAPPER}} .c-subtitle' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'subtitle_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ), 
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, 
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} h5.teaser-subtitle, #wrap {{WRAPPER}} .c-subtitle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'subtitle_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} h5.teaser-subtitle, #wrap {{WRAPPER}} .c-subtitle',
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
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'subtitle_typography_hover',
				'label' 	=> __( 'Subtitle Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} h5.teaser-subtitle:hover, #wrap {{WRAPPER}} .c-subtitle:hover',
			]
		);
		$this->add_control(
			'subtitle_color_hover', 
			[
				'label' 		=> __( 'Subtitle color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-teaser-box .teaser-subtitle:hover, #wrap {{WRAPPER}} .c-subtitle:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'subtitle_bg_hover',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .teaser-subtitle:hover, #wrap {{WRAPPER}} .c-subtitle:hover',
			]
		);
		$this->add_control(
			'subtitle_padding_hover', 
			[
				'label' 		=> __( 'Subtitle padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} h5.teaser-subtitle:hover, #wrap {{WRAPPER}} .c-subtitle:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'subtitle_margin_hover', 
			[
				'label' 		=> __( 'Subtitle margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} h5.teaser-subtitle:hover, #wrap {{WRAPPER}} .c-subtitle:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		
		$this->add_control(
			'subtitle_opacity_hover',
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
					'#wrap {{WRAPPER}} h5.teaser-subtitle:hover, #wrap {{WRAPPER}} .c-subtitle:hover' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'subtitle_display_hover',
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
					'#wrap {{WRAPPER}} h5.teaser-subtitle:hover, #wrap {{WRAPPER}} .c-subtitle:hover' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'subtitle_border_radius_hover', 
			[
				'label' 		=> __( 'Border Radius', 'deep' ), 
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, 
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} h5.teaser-subtitle:hover, #wrap {{WRAPPER}} .c-subtitle:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'subtitle_border_hover',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} h5.teaser-subtitle:hover, #wrap {{WRAPPER}} .c-subtitle:hover',
			]
		);	

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Content', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition'		=>	[
					'type'	=>	[
						'15','17'
					],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'content_typography',
				'label' 	=> __( 'Content Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .c-text_content, #wrap {{WRAPPER}} .tb17-p',
			]
		);
		$this->add_control(
			'content_color', 
			[
				'label' 		=> __( 'Content color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .c-text_content, #wrap {{WRAPPER}} .tb17-p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .c-text_content, #wrap {{WRAPPER}} .tb17-p',
			]
		);
		$this->add_control(
			'content_padding', 
			[
				'label' 		=> __( 'Content padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .c-text_content, #wrap {{WRAPPER}} .tb17-p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .c-text_content, #wrap {{WRAPPER}} .tb17-p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .c-text_content, #wrap {{WRAPPER}} .tb17-p' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .c-text_content, #wrap {{WRAPPER}} .tb17-p' => 'display: {{VALUE}};',
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
					'#wrap {{WRAPPER}} .c-text_content, #wrap {{WRAPPER}} .tb17-p' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .c-text_content, #wrap {{WRAPPER}} .tb17-p',
			]
		);	
		$this->add_control(
			'hover3',
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
				'label' 	=> __( 'Content Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .c-text_content:hover, #wrap {{WRAPPER}} .tb17-p:hover',
			]
		);
		$this->add_control(
			'content_color_hover', 
			[
				'label' 		=> __( 'Content color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .c-text_content:hover, #wrap {{WRAPPER}} .tb17-p:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_bg_hover',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .c-text_content:hover, #wrap {{WRAPPER}} .tb17-p:hover',
			]
		);
		$this->add_control(
			'content_padding_hover', 
			[
				'label' 		=> __( 'Content padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .c-text_content:hover, #wrap {{WRAPPER}} .tb17-p:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'content_margin_hover', 
			[
				'label' 		=> __( 'Content margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .c-text_content:hover, #wrap {{WRAPPER}} .tb17-p:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .c-text_content:hover, #wrap {{WRAPPER}} .tb17-p:hover' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .c-text_content:hover, #wrap {{WRAPPER}} .tb17-p:hover' => 'display: {{VALUE}};',
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
					'#wrap {{WRAPPER}} .c-text_content:hover, #wrap {{WRAPPER}} .tb17-p:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'content_border_hover',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .c-text_content:hover, #wrap {{WRAPPER}} .tb17-p:hover',
			]
		);	
		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			[
				'label' => __( 'Button', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition'		=>	[
					'type!'	=>	[
						'4','5','7','9','14','17'
					],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'button_typography',
				'label' 	=> __( 'Button Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} a.teaser-readmore,#wrap {{WRAPPER}} a.teaser-readmore i,#wrap {{WRAPPER}} a.teaser-readmore:after,#wrap {{WRAPPER}} a.teaser-readmore:before, #wrap {{WRAPPER}} .teaser-box1 a:after, {{WRAPPER}} .teaser-box2 a:after, {{WRAPPER}} .teaser-box8 .teaser-btn, {{WRAPPER}} .teaser-box12 .teaser-subtitle:after, #wrap {{WRAPPER}} .teaser-box15 .c-link, {{WRAPPER}} .teaser-box18 .tb18-content .wn-button-box .wn-btn',
			]
		);
		$this->add_control(
			'button_color', 
			[
				'label' 		=> __( 'Button color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} a.teaser-readmore,#wrap {{WRAPPER}} a.teaser-readmore i,#wrap {{WRAPPER}} a.teaser-readmore:after,#wrap {{WRAPPER}} a.teaser-readmore:before, #wrap {{WRAPPER}} .teaser-box1 a:after, {{WRAPPER}} .teaser-box2 a:after, {{WRAPPER}} .teaser-box8 .teaser-btn, {{WRAPPER}} .teaser-box12 .teaser-subtitle:after, #wrap {{WRAPPER}} .teaser-box15 .c-link, {{WRAPPER}} .teaser-box18 .tb18-content .wn-button-box .wn-btn' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} a.teaser-readmore,#wrap {{WRAPPER}} a.teaser-readmore i,#wrap {{WRAPPER}} a.teaser-readmore:after,#wrap {{WRAPPER}} a.teaser-readmore:before, #wrap {{WRAPPER}} .teaser-box1 a:after, {{WRAPPER}} .teaser-box2 a:after, {{WRAPPER}} .teaser-box8 .teaser-btn, {{WRAPPER}} .teaser-box12 .teaser-subtitle:after, #wrap {{WRAPPER}} .teaser-box15 .c-link, {{WRAPPER}} .teaser-box18 .tb18-content .wn-button-box .wn-btn',
			]
		);
		$this->add_control(
			'button_padding', 
			[
				'label' 		=> __( 'Button padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} a.teaser-readmore,#wrap {{WRAPPER}} a.teaser-readmore i,#wrap {{WRAPPER}} a.teaser-readmore:after,#wrap {{WRAPPER}} a.teaser-readmore:before, #wrap {{WRAPPER}} .teaser-box1 a:after, {{WRAPPER}} .teaser-box2 a:after, {{WRAPPER}} .teaser-box8 .teaser-btn, {{WRAPPER}} .teaser-box12 .teaser-subtitle:after, #wrap {{WRAPPER}} .teaser-box15 .c-link, {{WRAPPER}} .teaser-box18 .tb18-content .wn-button-box .wn-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_margin', 
			[
				'label' 		=> __( 'Button margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} a.teaser-readmore,#wrap {{WRAPPER}} a.teaser-readmore i,#wrap {{WRAPPER}} a.teaser-readmore:after,#wrap {{WRAPPER}} a.teaser-readmore:before, #wrap {{WRAPPER}} .teaser-box1 a:after, {{WRAPPER}} .teaser-box2 a:after, {{WRAPPER}} .teaser-box8 .teaser-btn, {{WRAPPER}} .teaser-box12 .teaser-subtitle:after, #wrap {{WRAPPER}} .teaser-box15 .c-link, {{WRAPPER}} .teaser-box18 .tb18-content .wn-button-box .wn-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} a.teaser-readmore,#wrap {{WRAPPER}} a.teaser-readmore i,#wrap {{WRAPPER}} a.teaser-readmore:after,#wrap {{WRAPPER}} a.teaser-readmore:before, #wrap {{WRAPPER}} .teaser-box1 a:after, {{WRAPPER}} .teaser-box2 a:after, {{WRAPPER}} .teaser-box8 .teaser-btn, {{WRAPPER}} .teaser-box12 .teaser-subtitle:after, #wrap {{WRAPPER}} .teaser-box15 .c-link, {{WRAPPER}} .teaser-box18 .tb18-content .wn-button-box .wn-btn' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} a.teaser-readmore,#wrap {{WRAPPER}} a.teaser-readmore i,#wrap {{WRAPPER}} a.teaser-readmore:after,#wrap {{WRAPPER}} a.teaser-readmore:before, #wrap {{WRAPPER}} .teaser-box1 a:after, {{WRAPPER}} .teaser-box2 a:after, {{WRAPPER}} .teaser-box8 .teaser-btn, {{WRAPPER}} .teaser-box12 .teaser-subtitle:after, #wrap {{WRAPPER}} .teaser-box15 .c-link, {{WRAPPER}} .teaser-box18 .tb18-content .wn-button-box .wn-btn' => 'display: {{VALUE}};',
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
					'#wrap {{WRAPPER}} a.teaser-readmore,#wrap {{WRAPPER}} a.teaser-readmore i,#wrap {{WRAPPER}} a.teaser-readmore:after,#wrap {{WRAPPER}} a.teaser-readmore:before, #wrap {{WRAPPER}} .teaser-box1 a:after, {{WRAPPER}} .teaser-box2 a:after, {{WRAPPER}} .teaser-box8 .teaser-btn, {{WRAPPER}} .teaser-box12 .teaser-subtitle:after, #wrap {{WRAPPER}} .teaser-box15 .c-link, {{WRAPPER}} .teaser-box18 .tb18-content .wn-button-box .wn-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} a.teaser-readmore,#wrap {{WRAPPER}} a.teaser-readmore i,#wrap {{WRAPPER}} a.teaser-readmore:after,#wrap {{WRAPPER}} a.teaser-readmore:before, #wrap {{WRAPPER}} .teaser-box1 a:after, {{WRAPPER}} .teaser-box2 a:after, {{WRAPPER}} .teaser-box8 .teaser-btn, {{WRAPPER}} .teaser-box12 .teaser-subtitle:after, #wrap {{WRAPPER}} .teaser-box15 .c-link, {{WRAPPER}} .teaser-box18 .tb18-content .wn-button-box .wn-btn',
			]
		);	
		$this->add_control(
			'hover4',
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
				'label' 	=> __( 'Button Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} a.teaser-readmore:hover,#wrap {{WRAPPER}} a.teaser-readmore i:hover,#wrap {{WRAPPER}} a.teaser-readmore:hover:after,#wrap {{WRAPPER}} a.teaser-readmore:hover:before, #wrap {{WRAPPER}} .teaser-box1 a:hover:after, {{WRAPPER}} .teaser-box2 a:hover:after, {{WRAPPER}} .teaser-box8 .teaser-btn:hover, {{WRAPPER}} .teaser-box12 .teaser-subtitle:hover:after, #wrap {{WRAPPER}} .teaser-box15 .c-link:hover, {{WRAPPER}} .teaser-box18 .tb18-content .wn-button-box .wn-btn:hover',
			]
		);
		$this->add_control(
			'button_color_hover', 
			[
				'label' 		=> __( 'Button color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} a.teaser-readmore:hover,#wrap {{WRAPPER}} a.teaser-readmore i:hover,#wrap {{WRAPPER}} a.teaser-readmore:hover:after,#wrap {{WRAPPER}} a.teaser-readmore:hover:before, #wrap {{WRAPPER}} .teaser-box1 a:hover:after, {{WRAPPER}} .teaser-box2 a:hover:after, {{WRAPPER}} .teaser-box8 .teaser-btn:hover, {{WRAPPER}} .teaser-box12 .teaser-subtitle:hover:after, #wrap {{WRAPPER}} .teaser-box15 .c-link:hover, {{WRAPPER}} .teaser-box18 .tb18-content .wn-button-box .wn-btn:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_hover',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} a.teaser-readmore:hover,#wrap {{WRAPPER}} a.teaser-readmore i:hover,#wrap {{WRAPPER}} a.teaser-readmore:hover:after,#wrap {{WRAPPER}} a.teaser-readmore:hover:before, #wrap {{WRAPPER}} .teaser-box1 a:hover:after, {{WRAPPER}} .teaser-box2 a:hover:after, {{WRAPPER}} .teaser-box8 .teaser-btn:hover, {{WRAPPER}} .teaser-box12 .teaser-subtitle:hover:after, #wrap {{WRAPPER}} .teaser-box15 .c-link:hover, {{WRAPPER}} .teaser-box18 .tb18-content .wn-button-box .wn-btn:hover',
			]
		);
		$this->add_control(
			'button_padding_hover', 
			[
				'label' 		=> __( 'Button padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} a.teaser-readmore:hover,#wrap {{WRAPPER}} a.teaser-readmore i:hover,#wrap {{WRAPPER}} a.teaser-readmore:hover:after,#wrap {{WRAPPER}} a.teaser-readmore:hover:before, #wrap {{WRAPPER}} .teaser-box1 a:hover:after, {{WRAPPER}} .teaser-box2 a:hover:after, {{WRAPPER}} .teaser-box8 .teaser-btn:hover, {{WRAPPER}} .teaser-box12 .teaser-subtitle:hover:after, #wrap {{WRAPPER}} .teaser-box15 .c-link:hover, {{WRAPPER}} .teaser-box18 .tb18-content .wn-button-box .wn-btn:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_margin_hover', 
			[
				'label' 		=> __( 'Button margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} a.teaser-readmore:hover,#wrap {{WRAPPER}} a.teaser-readmore i:hover,#wrap {{WRAPPER}} a.teaser-readmore:hover:after,#wrap {{WRAPPER}} a.teaser-readmore:hover:before, #wrap {{WRAPPER}} .teaser-box1 a:hover:after, {{WRAPPER}} .teaser-box2 a:hover:after, {{WRAPPER}} .teaser-box8 .teaser-btn:hover, {{WRAPPER}} .teaser-box12 .teaser-subtitle:hover:after, #wrap {{WRAPPER}} .teaser-box15 .c-link:hover, {{WRAPPER}} .teaser-box18 .tb18-content .wn-button-box .wn-btn:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} a.teaser-readmore:hover,#wrap {{WRAPPER}} a.teaser-readmore i:hover,#wrap {{WRAPPER}} a.teaser-readmore:hover:after,#wrap {{WRAPPER}} a.teaser-readmore:hover:before, #wrap {{WRAPPER}} .teaser-box1 a:hover:after, {{WRAPPER}} .teaser-box2 a:hover:after, {{WRAPPER}} .teaser-box8 .teaser-btn:hover, {{WRAPPER}} .teaser-box12 .teaser-subtitle:hover:after, #wrap {{WRAPPER}} .teaser-box15 .c-link:hover, {{WRAPPER}} .teaser-box18 .tb18-content .wn-button-box .wn-btn:hover' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} a.teaser-readmore:hover,#wrap {{WRAPPER}} a.teaser-readmore i:hover,#wrap {{WRAPPER}} a.teaser-readmore:hover:after,#wrap {{WRAPPER}} a.teaser-readmore:hover:before, #wrap {{WRAPPER}} .teaser-box1 a:hover:after, {{WRAPPER}} .teaser-box2 a:hover:after, {{WRAPPER}} .teaser-box8 .teaser-btn:hover, {{WRAPPER}} .teaser-box12 .teaser-subtitle:hover:after, #wrap {{WRAPPER}} .teaser-box15 .c-link:hover, {{WRAPPER}} .teaser-box18 .tb18-content .wn-button-box .wn-btn:hover' => 'display: {{VALUE}};',
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
					'#wrap {{WRAPPER}} a.teaser-readmore:hover,#wrap {{WRAPPER}} a.teaser-readmore i:hover,#wrap {{WRAPPER}} a.teaser-readmore:hover:after,#wrap {{WRAPPER}} a.teaser-readmore:hover:before, #wrap {{WRAPPER}} .teaser-box1 a:hover:after, {{WRAPPER}} .teaser-box2 a:hover:after, {{WRAPPER}} .teaser-box8 .teaser-btn:hover, {{WRAPPER}} .teaser-box12 .teaser-subtitle:hover:after, #wrap {{WRAPPER}} .teaser-box15 .c-link:hover, {{WRAPPER}} .teaser-box18 .tb18-content .wn-button-box .wn-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border_hover',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} a.teaser-readmore:hover,#wrap {{WRAPPER}} a.teaser-readmore i:hover,#wrap {{WRAPPER}} a.teaser-readmore:hover:after,#wrap {{WRAPPER}} a.teaser-readmore:hover:before, #wrap {{WRAPPER}} .teaser-box1 a:hover:after, {{WRAPPER}} .teaser-box2 a:hover:after, {{WRAPPER}} .teaser-box8 .teaser-btn:hover, {{WRAPPER}} .teaser-box12 .teaser-subtitle:hover:after, #wrap {{WRAPPER}} .teaser-box15 .c-link:hover, {{WRAPPER}} .teaser-box18 .tb18-content .wn-button-box .wn-btn:hover',
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
				'selector' => '#wrap {{WRAPPER}} .wn-teaser-box',
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
					'#wrap {{WRAPPER}} .wn-teaser-box' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-teaser-box',
			]
		);
		$this->add_control(
			'box_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .wn-teaser-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .wn-teaser-box',
				]
		);
		$this->add_control(
			'box_padding',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .wn-teaser-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-teaser-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-teaser-box' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .wn-teaser-box' => 'overflow: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'hover5',
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
				'selector' => '#wrap {{WRAPPER}} .wn-teaser-box:hover',
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
					'#wrap {{WRAPPER}} .wn-teaser-box:hover' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border_hover',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-teaser-box:hover',
			]
		);
		$this->add_control(
			'box_border_radius_hover',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .wn-teaser-box:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);			
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow_hover',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .wn-teaser-box:hover',
				]
		);
		$this->add_control(
			'box_padding_hover',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .wn-teaser-box:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-teaser-box:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-teaser-box:hover' => 'opacity: {{SIZE}};',
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
	 * Render Teaserbox widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings();

		wp_enqueue_style( 'wn-deep-teaser-box' . $settings['type'], DEEP_ASSETS_URL . 'css/frontend/teaser-box/teaser-box' . $settings['type'] . '.css' );

		$introduction_title			= !empty( $settings['introduction_title'] ) ? $settings['introduction_title'] : '';
		$introduction_link_url		= !empty( $settings['introduction_link_url']['url'] ) ? $settings['introduction_link_url']['url'] : '';
		$live_preview_title			= !empty( $settings['live_preview_title'] ) ? $settings['live_preview_title'] : '';
		$live_preview_link_url		= !empty( $settings['live_preview_link_url']['url'] ) ? $settings['live_preview_link_url']['url'] : '';
		$buy_item_title				= !empty( $settings['buy_item_title'] ) ? $settings['buy_item_title'] : '';
		$buy_item_link_url			= !empty( $settings['buy_item_link_url']['url'] ) ? $settings['buy_item_link_url']['url'] : '';
		$alt						= $settings['image_alt'] ? 'alt=' . $settings['image_alt'] . '' : '';
		$target						= $settings['link_url']['is_external'] ? ' target=_blank' : '';
		$rel						= $settings['link_url']['nofollow'] ? ' rel=nofollow' : '';
		$image_url					= '';

		if ( !empty( $settings['image']['url'] ) ) {
			$thumbnail_width 	= $settings['thumbnail']['width'] ? $settings['thumbnail']['width'] : '' ;
			$thumbnail_height 	= $settings['thumbnail']['height'] ? $settings['thumbnail']['height'] : '' ;
			if ( $settings['type'] == '3' ) {
				$settings['thumbnail']['width'] = $settings['thumbnail']['width'] == '' ? '340' : '';
				$settings['thumbnail']['height'] = $settings['thumbnail']['height'] == '' ? '423' : '';
			} elseif( $settings['type'] == '15' ) {
				$settings['thumbnail']['width'] = $settings['thumbnail']['width'] == '' ? '398' : '';
				$settings['thumbnail']['height'] = $settings['thumbnail']['height'] == '' ? '398' : '';
			}
			if ( !empty( $settings['thumbnail']['width'] ) || !empty( $settings['thumbnail']['height'] ) ) {
				if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
					require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
				}
				$image = new \Wn_Img_Maniuplate;
				$image_url = $image->m_image( $settings['image']['id'], $settings['image']['url'] , $settings['thumbnail']['width'], $settings['thumbnail']['height'] );
			} else {
				$image_url = $settings['image']['url'];
			}
		}

		$out = '<div class="wn-teaser-box teaser-box' . $settings['type'] . ' clearfix">';
 	
		if ( ( $settings['type'] != '15' ) && ( $settings['type'] != '16' ) && ( $settings['type'] != '17' ) && ( $settings['type'] != '18' ) ) {
			$has_image = $teaser_image = '';
			if ( ( ( $settings['type'] == 4 ) OR ( $settings['type'] == 5 ) ) && ( empty( $settings['subtitle'] ) ) ) {
				$settings['subtitle'] = $settings['title'];
			}

			if ( ( $settings['type'] == 6 ) && ( empty( $settings['subtitle'] ) ) ) {
				$settings['subtitle'] = esc_html__( 'Learn More', 'deep' );
			}

			$overlay = ( $settings['type'] == '13' ) ? '<span class="colorb overlay-teaser-box' . $settings['type'] . '"></span><i class="colorf ti-arrow-right"></i>' : '' ;

			if ( $image_url ) {
				$has_image = 'has-image';
				$teaser_image = '<figure>' . $overlay . '<img class="teaser-image " src="' . $image_url . '" ' . esc_attr( $alt ) . '></figure>';
			}

			if ( $settings['type'] == '12' ) {
				$out .= '<div class="teaser-content">';
			}

			if ( $settings['type'] == '11' || $settings['type'] == '12' ){
				$out .= '<div class="bgc-overlay"></div>';
			}

			if ( !empty( $settings['link_url']['url'] ) ) {
				$out .= '<a href="' . $settings['link_url']['url'] . '" ' . esc_attr( $target . $rel ) . '>';
			}
			
			$out .= $teaser_image;

			if ( !empty( $settings['featured'] ) ) {

				$out .= '<h6 class="teaser-featured">' . $settings['featured'] . '</h4>';

			}

			$before = $settings['type'] == '13' ? '<span class="before"></span>' : '';
			$after = $settings['type'] == '13' ? '<span class="after colorb"></span>' : '';

			$out .= '<h4 class="teaser-title ' . $has_image . '">' . $before .  $settings['title'] . $after . '</h4>';

			if ( !empty( $settings['subtitle'] ) && ( $settings['type'] == '1' || $settings['type'] == '2' || $settings['type'] == '3' || $settings['type'] == '4' || $settings['type'] == '5' || $settings['type'] == '6' || $settings['type'] == '7' || $settings['type'] == '8' || $settings['type'] == '12' || $settings['type'] == '13' || $settings['type'] == '15' || $settings['type'] == '16' ) ) {
				$out .= '<h5 class="teaser-subtitle">' . $settings['subtitle'] . '</h5> ' . $teaser_btn = $settings['type'] == '8' ? '<span class="teaser-btn teaser-readmore">' . esc_html( $settings['teaser_btn'] ) . '</span>': '';
			}

			if ( !empty( $settings['link_url']['url'] ) ) {
				$out .= '</a>';
			}

			if ( $settings['type'] == '12' ) {

				$out .= '</div>';

			}

			if ( !empty( $settings['text_content'] ) && $settings['type'] == '10' ) {
				$out .= '<p>' . $settings['text_content'] . '</p>';
			}

			if ( !empty( $settings['text_content'] ) && $settings['type'] == '11' ) {
				$out .= '<p>' . $settings['text_content'] . '</p>';
			}

		} elseif ( $settings['type'] == '15' ) {
			$out .= '<div class="col-xs-12 col-md-4 col-sm-4 tsb15-imgwrap">';
			$out .= !empty( $image_url ) ? '<img src="' . $image_url . '" ' . esc_attr( $alt ) . ' class="img-responsive">': '';
			$out .= '</div>';
			$out .= '<div class="col-xs-12 col-md-8 col-sm-8">';
			$out .= '<div class="inner-c">';
			$out .= !empty( $settings['price'] ) ? '<span class="c-price"> ' . $settings['price'] . ' </span>': '';
			$out .= !empty( $settings['featured'] ) ? '<div class="c-featured"> ' . $settings['featured'] . ' </div>': '';
			$out .= !empty( $settings['title'] ) ? '<h3 class="c-title">' . $settings['title'] . '</h3>': '';
			$out .= !empty( $settings['subtitle'] ) ? '<h4 class="c-subtitle"> ' . $settings['subtitle'] . ' </h4>': '';
			$out .= !empty( $settings['text_content'] ) ? '<p class="c-text_content"> ' . $settings['text_content'] . ' </p>': '';

			if ( $settings['features']  ) {
				$out .= '<div class="feat-box">';
				foreach (  $settings['features'] as $item ) {
					$out .= '<div class="features-data">';
					$out .= '<span class="c-feat"> ' . $item[ 'text' ] . ' </span>';
					$out .= '<span class="c-feat-n"> ' . $item[ 'number' ] . ' </span>';
					$out .= '</div>';
				}
				$out .= '</div>'; // Close feat-box
			}

			if ( !empty( $settings['teaser_btn'] ) && !empty( $settings['link_url']['url'] ) ) {
				$out .= '<a href="' . $settings['link_url']['url'] . '" class="teaser-readmore colorf c-link" ' . esc_attr( $target . $rel ) . '>';
				$out .= $settings['teaser_btn'];
				$out .= '</a>';
			} // close c-btn
			$out .= '</div>'; // close inner-c
			$out .= '</div>'; // close col-md-8

		} elseif ( $settings['type'] == '16' ) {

			$out .= '<div class="tb16-content">';
			$out .= !empty( $image_url ) ? '<img src="' . $image_url . '" ' . esc_attr( $alt ) . ' class="img-responsive">': '';
		
				$out .= '<div class="tb16-inner-c">';
					$out .= !empty( $settings['title'] ) ? '<h4 class="c-title"> ' . $settings['title'] . ' </h4>': '';
					$out .= !empty( $settings['subtitle'] ) ? '<h5 class="c-subtitle"> ' . $settings['subtitle'] . ' </h5>': '';
					if ( !empty( $settings['teaser_btn'] ) && !empty( $settings['link_url']['url'] ) ) {
						$out .= '<a href="' . $settings['link_url']['url'] . '" class="teaser-readmore colorf c-link" ' . esc_attr( $target . $rel ) . '>';
						$out .= $settings['teaser_btn'];
						$out .= '</a>';
					} // close c-btn
				$out .= '</div>'; // close tb16-inner-c
		
			$out .= '</div>'; // close tb16-content

		} elseif ( $settings['type'] == '17' ) {
			$out .= !empty( $settings['link_url']['url'] ) ? '<a href="' . $settings['link_url']['url'] . '" ' . esc_attr( $target . $rel ) . '>': '';
			$out .= '<div class="tb17-content">';
					$out .= '<div class="tb17-inner-c">';
						$out .= '<div class="time-content">';
							$out .= '<i class="wn-far wn-fa-clock"></i>'.'<br>';
							$out .= !empty( $settings['time'] ) ? '<span class="time-tb17">' . $settings['time'] . '</span>'.'<br>': '';
							$out .= !empty( $settings['time_description'] ) ? '<span class="c-subtitle"> ' . $settings['time_description'] . ' </span>': '';
						$out .= '</div>';//time-content
						$out .= !empty( $settings['title'] ) ? '<h4 class="c-title"> ' . $settings['title'] . ' </h4>': '';
						$out .= !empty( $settings['text_content'] ) ? '<p class="tb17-p"> ' . $settings['text_content'] . ' </p>': '';
						$out .= !empty( $settings['price'] ) ? '<span class="c-price"> ' . $settings['price'] . ' </span>': '';
					$out .= '</div>';// close tb17-inner-c
			$out .= '</div>';// tb17-content
		$out .= !empty( $settings['link_url']['url'] ) ? '</a>': '';

		} elseif ( $settings['type'] == '18' ) {	
			$out .= '<div class="tb18-content">';
				$out .= '<div class="wn-image-box">';
					$out .= '<div class="wn-title-box">';
					if ( !empty( $settings['link_url']['url'] ) ) {
							$out .= '<a href="' . $settings['link_url']['url'] . '" ' . esc_attr( $target ) . '>';
								$out .= !empty( $settings['title'] ) ? '<h4 class="tb-title"> ' . $settings['title'] . ' </h4>': '';
							$out .= '</a>';
					} else {
						$out .= !empty( $settings['title'] ) ? '<h4 class="tb-title"> ' . $settings['title'] . ' </h4>': '';
					}
					$out .= '</div>';
					$out .= !empty( $image_url ) ? '<img src="' . $image_url . '" ' . esc_attr( $alt ) . ' class="img-responsive">': '';
					$out .= '<div class="wn-button-box">';
						if ( !empty( $introduction_link_url ) && !empty( $introduction_title ) ) {
							$target = $settings['introduction_link_url']['is_external'] ? ' target=_blank' : '';
							$rel = $settings['introduction_link_url']['nofollow'] ? ' rel=nofollow' : '';
							$out .= '<a class="button small wn-btn" href="' . $introduction_link_url  . '"' . esc_attr( $target . $rel ) . '><i class="-sl-link icon-basic-link"></i><span> ' . $introduction_title  .  ' </spn></a>';
						}
						if ( !empty( $live_preview_link_url ) && !empty( $live_preview_title ) ) {
							$target = $settings['live_preview_link_url']['is_external'] ? ' target=_blank' : ''; 
							$rel = $settings['live_preview_link_url']['nofollow'] ? ' rel=nofollow' : ''; 
							$out .= '<a class="button small wn-btn" href="' . $live_preview_link_url  . '"' . esc_attr( $target . $rel ) . '><i class="icon-basic-display"></i><span> ' . $live_preview_title  .  ' </spn></a>';
						}
						if ( !empty( $buy_item_link_url ) && !empty( $buy_item_title ) ) {
							$target = $settings['buy_item_link_url']['is_external'] ? ' target=_blank' : ''; 
							$rel = $settings['buy_item_link_url']['nofollow'] ? ' rel=nofollow' : ''; 
							$out .= '<a class="button small wn-btn" href="' . $buy_item_link_url  . '"' . esc_attr( $target . $rel ) . '><i class="-sl-basket icon-ecommerce-cart-content"></i><span> ' . $buy_item_title  .  ' </spn></a>';
						}
					$out .= '</div>';				
				$out .= '</div>';
			$out .= '</div>';
		}
		$out .= '</div>';
		
        $custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}
		
		echo $out;

	}

}