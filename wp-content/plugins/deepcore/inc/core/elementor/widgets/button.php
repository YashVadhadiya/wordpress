<?php
namespace Elementor;

class Webnus_Element_Widgets_Button extends \Elementor\Widget_Base {

	/**
	 * Retrieve widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'wn_button';

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

		return  esc_html__( 'Webnus Buttons', 'deep' );

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

		return 'eicon-button';

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
	 * enqueue CSS
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'deep-button-widget' ];

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
				'label' =>  esc_html__( 'General', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'btn_content', //param_name
			[
				'label' 		=>  esc_html__( 'Button Text', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXT, //type
				'default'		=>  esc_html__( 'Button', 'deep'),
			]
		);

		$this->add_control(
			'link', //param_name
			[
				'label' 		=>  esc_html__( 'Button Link', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::URL, //type
				'placeholder' 	=>  esc_html__( 'https://your-link.com', 'deep' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '',
					'is_external' 	=> true,
					'nofollow' 		=> true,
				],
			]
		);

		$this->end_controls_section();

		// Styling
		$this->start_controls_section(
			'style_section',
			[
				'label' =>  esc_html__( 'Styling', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'shape',
			[
				'label' =>  esc_html__( 'Shape', 'deep' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options'			=> [
						""			=>	"Default",
						"square"	=>	"Square",
						"rounded"	=>	"Rounded",
				],
			]
		);

		$this->add_responsive_control(
			'size',
			[
				'label' =>  esc_html__( 'Size', 'deep' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options'			=> [
					'small'	=>	"Small",
					'medium'=>	'Medium',
					'large'	=>	'Large',
				],
				'default'	=>	'medium',
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
			]
		);

		$this->add_control(
			'border', //param_name
			[
				'label' 		=>  esc_html__( 'Bordered', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::SWITCHER, //type
				'label_on' 		=>  esc_html__( 'Enable', 'deep' ),
				'label_off' 	=>  esc_html__( 'Disable', 'deep' ),
				'return_value' 	=> 'true',
				'default'	=>	'false'
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_text_font',
				'label' => __( 'Typography', 'deep' ),
				'selector' => '{{WRAPPER}} a.button span',
			]
		);

		$this->add_control(
			'botton_skin',
			[
				'label' =>  esc_html__( 'Button Skin', 'deep' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options'			=> [
					"predefined"	=>	"Predefined",
					"custom"		=>	"Custom",
				],
				'default' 		=> 'predefined',
			]
		);

		$this->add_control(
			'color',
			[
				'label' =>  esc_html__( 'Color', 'deep' ),
				'type'  => \Elementor\Controls_Manager::SELECT,
				'options'			=> [
					"theme-skin"	=>	"Default",
					"green"		=>	"Green",
					"gold"		=>	"Gold",
					"red"		=>	"Red",
					"blue"		=>	"Blue",
					"gray"		=>	"Gray",
					"dark-gray"	=>	"Dark gray",
					"cherry"	=>	"Cherry",
					"orchid"	=>	"Orchid",
					"pink"		=>	"Pink",
					"orange"	=>	"Orange",
					"teal"		=>	"Teal",
					"skyblue"	=>	"SkyBlue",
					"jade"		=>	"Jade",
					"white"		=>	"White",
					"black"		=>	"Black",
				],
				'default' 		=> 'theme-skin',
				'condition'	=>	[
					'botton_skin'	=>	[
						'predefined'
					]
				]
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label'     => __( 'Alignment', 'deep' ),
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
					'#wrap {{WRAPPER}}' => 'text-align: {{VALUE}}',
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
			]
		);

		$this->add_control(
			'dp_button_transition',
			[
				'label' => __( 'Transition', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '',
				],
				'selectors' => [
					'#wrap {{WRAPPER}} a.button' => 'transition: all {{SIZE}}s ease;',
				],
			]
		);

		$this->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'style' => 'thick',
				'condition'	=>	[
					'botton_skin' =>	[
						'custom'
					]
				],
			]
		);


		$this->start_controls_tabs(
			'wn_style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => __( 'Normal', 'deep' ),
				'condition'	=>	[
					'botton_skin' =>	[
						'custom'
					]
				],
			]
		);

		$this->add_control(
			'btn_color', //param_name
			[
				'label' 		=>  esc_html__( 'Text Color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'condition'	=>	[
					'botton_skin' =>	[
						'custom'
					]
				],
				'selectors' 	=> [
					'{{WRAPPER}} a.button' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'btn_border_color', //param_name
			[
				'label' 		=>  esc_html__( 'Border color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'condition'	=>	[
					'botton_skin' =>	[
						'custom'
					]
				],
				'selectors' 	=> [
					'{{WRAPPER}} a.button' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'btn_background',
				'label' =>  esc_html__( 'Background', 'deep' ),
				'types' => [ 'classic', 'gradient', ],
				'selector' => '{{WRAPPER}} a.button',
				'condition'	=>	[
					'botton_skin' =>	[
						'custom'
					]
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => __( 'Hover', 'deep' ),
				'condition'	=>	[
					'botton_skin' =>	[
						'custom'
					]
				],
			]
		);

		$this->add_control(
			'btn_color_hover', //param_name
			[
				'label' 		=>  esc_html__( 'Text Color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'condition'	=>	[
					'botton_skin' =>	[
						'custom'
					]
				],
				'selectors' 	=> [
					'{{WRAPPER}} a.button:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'btn_border_color_hover', //param_name
			[
				'label' 		=>  esc_html__( 'Border color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'condition'	=>	[
					'botton_skin' =>	[
						'custom'
					]
				],
				'selectors' 	=> [
					'{{WRAPPER}} a.button:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'btn_background_hover',
				'label' =>  esc_html__( 'Background Hover', 'deep' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} a.button:hover',
				'condition'	=>	[
					'botton_skin' =>	[
						'custom'
					]
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'hr1',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'style' => 'thick',
				'condition'	=>	[
					'botton_skin' =>	[
						'custom'
					]
				],
			]
		);

		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab1',
			[
				'label' => __( 'Normal', 'plugin-name' ),
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' =>  esc_html__( 'Box Shadow', 'deep' ),
				'selector' => '{{WRAPPER}} a.button',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'label' => __( 'Button Border', 'deep' ),
				'selector' => '{{WRAPPER}} a.button',
			]
		);

		$this->add_control(
			'button_border_radius', //param_name
			[
				'label' 		=> __( 'Button Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_padding', //param_name
			[
				'label' 	=>  esc_html__( 'Padding', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units'=> [ 'px', 'em', '%' ],
				'devices'	=> [ 'desktop', 'tablet', 'mobile' ],
				'selectors'	=> [
					'{{WRAPPER}} a.button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_margin', //param_name
			[
				'label' 	=>  esc_html__( 'Margin', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'devices'	=> [ 'desktop', 'tablet', 'mobile' ],
				'size_units'=> [ 'px', 'em', '%' ],
				'selectors'	=> [
					'{{WRAPPER}} a.button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab2',
			[
				'label' => __( 'Hover', 'plugin-name' ),
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_hover',
				'label' =>  esc_html__( 'Box Shadow', 'deep' ),
				'selector' => '{{WRAPPER}} a.button:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border_hover',
				'label' => __( 'Button Border', 'deep' ),
				'selector' => '{{WRAPPER}} a.button:hover',
			]
		);

		$this->add_control(
			'button_border_radius_hover', //param_name
			[
				'label' 		=> __( 'Button Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_padding_hover', //param_name
			[
				'label' 	=>  esc_html__( 'Padding', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units'=> [ 'px', 'em', '%' ],
				'devices'	=> [ 'desktop', 'tablet', 'mobile' ],
				'selectors'	=> [
					'{{WRAPPER}} a.button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_margin_hover', //param_name
			[
				'label' 	=>  esc_html__( 'Margin', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'devices'	=> [ 'desktop', 'tablet', 'mobile' ],
				'size_units'=> [ 'px', 'em', '%' ],
				'selectors'	=> [
					'{{WRAPPER}} a.button:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_arrow', //param_name
			[
				'label' 		=>  esc_html__( 'Have Arrow when hover?', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::SWITCHER, //type
				'label_on' 		=>  esc_html__( 'Yes', 'deep' ),
				'label_off' 	=>  esc_html__( 'No', 'deep' ),
				'return_value' 	=> 'yes',
			]
		);

		$this->add_control(
			'btn_arrow_icon_color', //param_name
			[
				'label' 		=>  esc_html__( 'Icon Arrow Color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .button.arrow:hover::before' => 'color: {{VALUE}}',
				],
				'condition'	=>	[
					'button_arrow' =>	[
						'yes'
					]
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'hr2',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->end_controls_section();

		// Icon
		$this->start_controls_section(
			'icon_section',
			[
				'label' =>  esc_html__( 'Icon', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'type',
			[
				'label' 	=> __( 'Select Type', 'deep' ),
				'type' 		=> \Elementor\Controls_Manager::SELECT,
				'default' 	=> 'icon',
				'options' 	=> [
					'icon'  => __( 'Icon', 'deep' ),
					'svg' 	=> __( 'SVG', 'deep' ),
				],
			]
		);

		$this->add_control(
			'icon',
			[
				'label' =>  esc_html__( 'Icon', 'deep' ),
				'type' => \Elementor\Controls_Manager::ICON,
				'condition'	=>	[
					'type' => 'icon'
				],
			]
		);

		$this->add_control(
			'svg_img',
			[
				'label' 	=> __( 'Choose Image', 'deep' ),
				'type' 		=> \Elementor\Controls_Manager::MEDIA,
				'condition'	=>	[
					'type' => 'svg'
				],
			]
		);

		$this->end_controls_section();

		// Icon Styles
		$this->start_controls_section(
			'icon_style_section',
			[
				'label' =>  esc_html__( 'Icon', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition'	=>	[
					'icon!' =>	[
						''
					]
				],
			]
		);

		$this->add_responsive_control(
			'vertical_align',
			[
				'label' 	=>  esc_html__( 'Icon Vertical Alignment', 'deep' ),
				'type' 		=> \Elementor\Controls_Manager::SELECT,
				'options'	=> [
					'top'		=>	'Top',
					'middle'	=>	'Middle',
					'bottom'	=>	'Bottom',
				],
				'default' 	=> 'middle',
				'selectors' => [
					'{{WRAPPER}} a.button i' => 'vertical-align: {{VALUE}};',
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
			]
		);

		$this->add_responsive_control(
			'button_icon_float',
			[
				'label' 	=>  esc_html__( 'Icon Float', 'deep' ),
				'type' 		=> \Elementor\Controls_Manager::SELECT,
				'options'	=> [
					''		=> 'Default',
					'left'		=>	'Left',
					'right'	=>	'Right',
				],
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} a.button i' => 'float: {{VALUE}};',
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
			]
		);

		$this->start_controls_tabs(
			'wn_pp_button_icon_style_tabs'
		);

		$this->start_controls_tab(
			'pp_button_icon_style_normal_tab',
			[
				'label' => __( 'Normal', 'deep' ),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'icon_text_font',
				'label' => __( 'Icon Typography', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} a.button i',
			]
		);

		$this->add_responsive_control(
			'icon_font_size',
			[
				'label' => __( 'Icon Font Size', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 18,
				],
				'selectors' => [
					'#wrap {{WRAPPER}} a.button i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
			]
		);

		$this->add_control(
			'btn_icon_color', //param_name
			[
				'label' 		=>  esc_html__( 'Icon Color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} a.button i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding', //param_name
			[
				'label' 		=>  esc_html__( 'Icon Padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.button i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
			]
		);

		$this->add_responsive_control(
			'icon_margin', //param_name
			[
				'label' 		=>  esc_html__( 'Icon Margin', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.button i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'pp_button_icon_style_hover_tab',
			[
				'label' => __( 'Hover', 'deep' ),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'icon_text_font_hover',
				'label' => __( 'Icon Typography', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} a.button:hover i',
			]
		);

		$this->add_responsive_control(
			'icon_font_size_hover',
			[
				'label' => __( 'Icon Font Size', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '',
				],
				'selectors' => [
					'#wrap {{WRAPPER}} a.button:hover i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
			]
		);

		$this->add_control(
			'btn_icon_color_hover', //param_name
			[
				'label' 		=>  esc_html__( 'Hover Button Icon Color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} a.button:hover i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding_hover', //param_name
			[
				'label' 		=>  esc_html__( 'Icon Padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.button:hover i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
			]
		);

		$this->add_responsive_control(
			'icon_margin_hover', //param_name
			[
				'label' 		=>  esc_html__( 'Icon Margin', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.button:hover i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
		// Class & ID Tab
		$this->start_controls_section(
			'class_id_section',
			[
				'label' =>  esc_html__( 'Class & ID', 'deep' ),
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

		// Variables
		$shortcodeclass 			= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
		$shortcodeid				= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';
		$shape						= $settings['shape'];
		$btn_content				= $settings['btn_content'];
		$link						= $settings['link']['url'];
		$size						= $settings['size'];
		$border						= $settings['border'];
		$button_arrow				= $settings['button_arrow'];
		$botton_skin				= $settings['botton_skin'];
		$color						= $settings['color'];
		$btn_padding				= $settings['btn_padding'];
		$btn_margin					= $settings['btn_margin'];
		$btn_color					= $settings['btn_color'];
		$btn_color_hover			= $settings['btn_color_hover'];
		$btn_border_color			= $settings['btn_border_color'];
		$btn_border_color_hover		= $settings['btn_border_color_hover'];
		$icon						= $settings['icon'];
		$svg						= $settings['svg_img']['url'] ? $settings['svg_img']['url'] : '';

		$target		= $settings['link']['is_external'] ? ' target="_blank"' : '';
		$nofollow	= $settings['link']['nofollow'] ? ' rel="nofollow"' : '';

		if ( empty($color) ) $color = 'theme-skin';
		if ( empty($botton_skin) ) $botton_skin = 'predefined';
		$set_arrow = '';
		if( $button_arrow == "yes" ) {
			$set_arrow = 'arrow';
		}
		$btn_bg = $btn_bg_hover = '';
		// btn google fonts

		$btn_color 				= $btn_color ? 'color: ' . $btn_color . ' !important;' : '';
		$btn_color_hover 		= $btn_color_hover ? 'color: ' . $btn_color_hover . ' !important;' : '';
		$btn_border_color 		= $btn_border_color ? 'border-color:' . $btn_border_color . ' !important;' : '';
		$btn_border_color_hover = $btn_border_color_hover ? 'border-color:' . $btn_border_color_hover . ' !important;' : '';
		$predefined 			= ($botton_skin == 'predefined') ? $color : '';
		$custom					= ($botton_skin == 'custom') ? $btn_color . $btn_border_color : '';
		$custom_hover			= ($botton_skin == 'custom') ? $btn_border_color_hover . $btn_bg_hover : '';
		$link = $link ? $link : '';

		$border = ( 'true' == $border ) ? 'bordered-bot' : '';
		$icon_str = !empty($icon) ? '<i class="' . $icon . '"></i>' : '';
		$img_tag = !empty($svg) ? '<img src="' . $svg . '">' : '';

		$out = '
			<a href="'. $link . '" class="button ' .$predefined.' '.$shape.' '.$size.' '.$border.' '.$set_arrow.' ' . $shortcodeclass . '" ' . $shortcodeid . $target . $nofollow . '>' . $icon_str . $img_tag . '<span>' . $btn_content . '</span></a>';

		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}

		echo $out;

	}
}
