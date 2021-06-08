<?php
namespace Elementor;

class Webnus_Element_Widgets_Iconbox extends \Elementor\Widget_Base {

	/**
	 * Retrieve Iconbox widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'iconbox';

	}

	/**
	 * Retrieve Iconbox widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return __( 'Webnus Icon box', 'deep' );

	}

	/**
	 * Retrieve Iconbox widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-icon-box';

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

		return [ 'wn-tilt-lib', 'wn-tilt', 'deep-icon-box' ];

	}

	/**
	 * Register Iconbox widget controls.
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

		// Select Type
		$this->add_control(
			'type', //param_name
			[
				'label' 	=> __( 'Select Type', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> '7',
				'options' 	=> [
					'0' 	=> __( 'Type 0', 'deep' ),
					'1' 	=> __( 'Type 1', 'deep' ),
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
					'19' 	=> __( 'Type 19', 'deep' ),
					'20' 	=> __( 'Type 20', 'deep' ),
					'21' 	=> __( 'Type 21', 'deep' ),
					'22' 	=> __( 'Type 22', 'deep' ),
					'23' 	=> __( 'Type 23', 'deep' ),
					'24' 	=> __( 'Type 24', 'deep' ),
					'25' 	=> __( 'Type 25', 'deep' ),
					'26' 	=> __( 'Type 26', 'deep' ),
					'27' 	=> __( 'Type 27', 'deep' ),
					'28' 	=> __( 'Type 28', 'deep' ),
					'29' 	=> __( 'Type 29', 'deep' ),
					'30' 	=> __( 'Type 30', 'deep' ),
				],
			]
		);

		$this->add_control(
			'tileffect',
			[
				'label'			=> __( 'Tilt Effect', 'plugin-domain' ),
				'type'			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on'		=> __( 'Yes', 'deep' ),
				'label_off'		=> __( 'No', 'deep' ),
				'return_value'	=> 'yes',
				'default'		=> 'no',
			]
		);

		$this->add_control(
			'iconbox_color_type', //param_name
			[
				'label' 	=> __( 'Background Color type', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'iconbox_solid_color',
				'options' 	=> [ //value
					'iconbox_solid_color' 	=> __( 'Solid color', 'deep' ),
					'iconbox_gradient'  	=> __( 'Gradient', 'deep' ),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_solid',
				'label' => __( 'Background Color', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .wn-icon-box .shape,{{WRAPPER}} .wn-icon-box .wn-content-wrap,{{WRAPPER}} .wn-icon-box',
				'condition' 	=> [ //dependency
					'iconbox_color_type' 	=> [
						'iconbox_solid_color'
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_gradient',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .wn-icon-box .shape,{{WRAPPER}} .wn-icon-box .wn-content-wrap,{{WRAPPER}} .wn-icon-box',
				'condition' 	=> [ //dependency
					'iconbox_color_type' 	=> [
						'iconbox_gradient'
					],
				],
			]
		);

		$this->add_control(
			'iconbox_color_type_hover', //param_name
			[
				'label' 	=> __( 'Hover Background Color type', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'iconbox_solid_color_hover',
				'options' 	=> [ //value
					'iconbox_solid_color_hover' 	=> __( 'Solid color', 'deep' ),
					'iconbox_gradient_hover'  		=> __( 'Gradient', 'deep' ),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_solid_hover',
				'label' => __( 'Background Color', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .wn-icon-box .shape:hover,{{WRAPPER}} .wn-icon-box .wn-content-wrap:hover,{{WRAPPER}} .wn-icon-box:hover',
				'condition' 	=> [ //dependency
					'iconbox_color_type_hover' 	=> [
						'iconbox_solid_color_hover'
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' 		=> 'background_gradient_hover',
				'label' 	=> __( 'Background', 'deep' ),
				'types' 	=> [ 'gradient' ],
				'selector' 	=> '#wrap {{WRAPPER}} .wn-icon-box .wn-grad-bg',
				'condition' => [ //dependency
					'iconbox_color_type_hover' 	=> [
						'iconbox_gradient_hover'
					],
				],
			]
		);

		$this->add_control(
			'bg_img_pos', //param_name
			[
				'label' 	=> __( 'Background Image Position', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'tlp',
				'options' 	=> [
					'tlp'  		=> __( 'Top Left Position', 'deep' ),
					'trp' 		=> __( 'Top Right Position', 'deep' ),
					'blp' 		=> __( 'Bottom Left Position', 'deep' ),
					'brp' 		=> __( 'Bottom Right Position', 'deep' ),
				],
				'condition' 	=> [ //dependency
					'type' 	=> [
						'28'
					],
				],
			]
		);
		// webnus
		$this->add_control(
			'align',
			[
				'label' => __( 'Alignment', 'deep' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'deep' ),
						'icon' => 'fa fa-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'deep' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'toggle' => true,
				'condition' 	=> [ //dependency
					'type' 	=> [
						'18'
					],
				],
			]
		);
		// webnus
		$this->add_control(
			'featured', //param_name
			[
				'label' 		=> __( 'Featured Iconbox?', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::SWITCHER, //type
				'label_on' 		=> __( 'Yes', 'deep' ),
				'label_off' 	=> __( 'No', 'deep' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'no',
				'condition' 	=> [ //dependency
					'type' 	=> [
						'22'
					],
				],
			]
		);
		// webnus
		$this->add_control(
			'border_right', //param_name
			[
				'label' 		=> __( 'Remove right border?', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::SWITCHER, //type
				'label_on' 		=> __( 'Yes', 'deep' ),
				'label_off' 	=> __( 'No', 'deep' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'no',
				'condition' 	=> [ //dependency
					'type' 	=> [
						'22',
						'15',
					],
				],
			]
		);

		$this->add_control(
			'side_by_side_title_icon', //param_name
			[
				'label' 	=> __( 'Make title and icon/image side by side', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> '',
				'options' 	=> [
					''  	=> __( 'none', 'deep' ),
					'left' 		=> __( 'left', 'deep' ),
					'right' 	=> __( 'right', 'deep' ),
				],
				'selectors' => [
					'{{WRAPPER}} .wn-icon-box i,{{WRAPPER}} .wn-icon-box img' => 'float: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'iconbox_padding', //param_name
			[
				'label' 		=> __( 'Iconbox padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wn-icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'iconbox_margin', //param_name
			[
				'label' 		=> __( 'Iconbox margin', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wn-icon-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_box_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '{{WRAPPER}} .wn-icon-box',
			]
		);

		$this->add_control(
			'icon_box_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wn-icon-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'cursor ',
			[
				'label' => __( 'Enable cursor pointer', 'deep' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'deep' ),
				'label_off' => __( 'No', 'deep' ),
				'return_value' => 'pointer',
				'default' => 'yes',
				'selectors' => [
					'{{WRAPPER}} .wn-icon-box' => 'cursor: {{VALUE}};',
				],
			]
		);
		// webnus
		$this->add_control(
			'min_height', //param_name
			[
				'label' 		=> __( 'Minimum Background Color Height', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXT, //type
				'placeholder' 	=> __( 'In px format: 250px', 'deep' ),
				'selectors' 	=> [
					'{{WRAPPER}} .wn-icon-box .icon-wrap' => 'height: {{VALUE}}',
				],
				'condition' 	=> [ //dependency
					'type' 	=> [
						'26'
					],
				],
			]
		);
		// webnus
		$this->add_control(
			'icon_bg', //param_name
			[
				'label' 		=> __( 'Icon Background color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .wn-icon-box .icon-wrap' => 'color: {{VALUE}}',
				],
				'condition' 	=> [ //dependency
					'type' 	=> [
						'26'
					],
				],
			]
		);
		// webnus
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_image',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .wn-icon-box',
				'condition' 	=> [ //dependency
					'type' 	=> [
						'30'
					],
				],
			]
		);


		$this->end_controls_section();

		// Link Tab
		$this->start_controls_section(
			'link_section',
			[
				'label' => __( 'Link', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		$this->add_control(
			'icon_link_text',
			[
				'label' 		=> __( 'Link Text', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXT, //type
			]
		);
		$this->add_control(
			'icon_link_url',
			[
				'label' 		=> __( 'Link URL', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::URL, //type
				'placeholder' 	=> __( 'https://your-link.com', 'deep' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '',
					'is_external' 	=> true,
					'nofollow' 		=> true,
				],
			]
		);
		$this->add_control(
			'title_linkable', //param_name
			[
				'label' 		=> __( 'Title linkable', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::SWITCHER, //type
				'description'	=> __( 'Add Link to title', 'deep'),
				'label_on' 		=> __( 'Yes', 'deep' ),
				'label_off' 	=> __( 'No', 'deep' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'no',
			]
		);
		$this->add_control(
			'box_linkable', //param_name
			[
				'label' 		=> __( 'Iconbox linkable', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::SWITCHER, //type
				'description'	=> __( 'By activating this option "Link More" will be removed', 'deep'),
				'label_on' 		=> __( 'Yes', 'deep' ),
				'label_off' 	=> __( 'No', 'deep' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'no',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'link_style',
			[
				'label' => __( 'Link Style', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
		);

		$this->add_control(
			'link_color', //param_name
			[
				'label' 		=> __( 'Link color (leave bank for default color)', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .wn-icon-box .magicmore' => 'color: {{VALUE}}',
				],
				'condition' 	=> [ //dependency
					'type!' 	=> [
						'0','30',
					],
				],
			]
		);

		$this->add_control(
			'icon_link_align',
			[
				'label' => __( 'Link Alignment', 'deep' ),
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
					'{{WRAPPER}} .wn-icon-box div.readmore' => 'text-align: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();

		// Title Tab
		$this->start_controls_section(
			'title_section',
			[
				'label'		=> __( 'Title', 'deep' ),
				'tab'		=> \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		$this->add_control(
			'icon_title', //param_name
			[
				'label' 	=> __( 'Title', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::TEXT, //type
				'default'	=> 'Lorem ipsum dolor sit.',
			]
		);

		$this->end_controls_section();

		// Title Style
		$this->start_controls_section(
			'title_style',
			[
				'label' => __( 'Title Style', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'icon_title_typo',
				'label' 	=> __( 'Title Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} h4.title-style',
			]
		);

		// webnus
		$this->add_control(
			'icon_title_align',
			[
				'label' => __( 'Alignment', 'deep' ),
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
					'{{WRAPPER}} h4.title-style' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_color_type', //param_name
			[
				'label' 	=> __( 'Color type', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'title_solid_color',
				'options' 	=> [ //value
					'title_solid_color' => __( 'Solid color', 'deep' ),
					'title_gradient'  	=> __( 'Gradient', 'deep' ),
				],
			]
		);

		$this->add_control(
			'title_color', //param_name
			[
				'label' 		=> __( 'Title color (leave bank for default color)', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .wn-icon-box h4.title-style' => 'color: {{VALUE}}',
				],
				'condition' 	=> [ //dependency
					'title_color_type' 	=> [
						'title_solid_color'
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_grad_color',
				'label' => __( 'Gradient Color', 'deep' ),
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .wn-icon-box h4.title-style',
				'condition' 	=> [ //dependency
					'title_color_type' 	=> [
						'title_gradient'
					],
				],
			]
		);

		$this->add_control(
			'title_color_type_hover', //param_name
			[
				'label' 	=> __( 'Hover Color type', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'title_solid_color',
				'options' 	=> [ //value
					'title_solid_color_hover' 	=> __( 'Solid color', 'deep' ),
					'title_gradient_hover'  	=> __( 'Gradient', 'deep' ),
				],
			]
		);

		$this->add_control(
			'title_color_hover', //param_name
			[
				'label' 		=> __( 'Title Hover color (leave bank for default color)', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .wn-icon-box:hover h4.title-style' => 'color: {{VALUE}}',
				],
				'condition' 	=> [ //dependency
					'title_color_type_hover' 	=> [
						'title_solid_color_hover'
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_grad_color_hover',
				'label' => __( 'Gradient Color', 'deep' ),
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .wn-icon-box:hover h4.title-style',
				'condition' 	=> [ //dependency
					'title_color_type_hover' 	=> [
						'title_gradient_hover'
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_title_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '{{WRAPPER}} h4.title-style',
			]
		);

		$this->add_control(
			'icon_title_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} h4.title-style' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_title_padding', //param_name
			[
				'label' 		=> __( 'padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} h4.title-style' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_title_margin', //param_name
			[
				'label' 		=> __( 'margin', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} h4.title-style' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();
		// webnus
		$this->start_controls_section(
			'subtitle_section',
			[
				'label' => __( 'Subtitle', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' 	=> [ //dependency
					'type' 	=> [
						'1',
						'15',
						'21',
					],
				],
            ]
		);

		$this->add_control(
			'icon_subtitle', //param_name
			[
				'label' 		=> __( 'Subtitle', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXT, //type
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'icon_subtitle_typo',
				'label' 	=> __( 'Subtitle Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '{{WRAPPER}} h5,{{WRAPPER}} h6',
			]
		);

		$this->add_control(
			'icon_subtitle_align',
			[
				'label' => __( 'Alignment', 'deep' ),
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
					'{{WRAPPER}} h5,{{WRAPPER}} h6' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_subtitle_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '{{WRAPPER}} h5,{{WRAPPER}} h6',
			]
		);

		$this->add_control(
			'icon_subtitle_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} h5,{{WRAPPER}} h6' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'subtitle_padding', //param_name
			[
				'label' 		=> __( 'Icon Subtitle padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} h5,{{WRAPPER}} h6' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'subtitle_margin', //param_name
			[
				'label' 		=> __( 'Icon Subtitle margin', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} h5,{{WRAPPER}} h6' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'maincontent_section',
			[
				'label'		=> __( 'Content', 'deep' ),
				'tab'		=> \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		$this->add_control(
			'iconbox_content', //param_name
			[
				'label' 		=> __( 'Content', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA, //type
				'rows' 			=> 10,
				'placeholder' 	=> __( 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Libero inventore magni repellendus optio. Doloremque, cum.', 'deep' ),
			]
		);

		$this->end_controls_section();

		// Content Style
		$this->start_controls_section(
			'maincontent_style',
			[
				'label' => __( 'Content Style', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'icon_content_typo',
				'label' 	=> __( 'Content Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '{{WRAPPER}} p.content-style',
			]
		);

		$this->add_control(
			'icon_content_align',
			[
				'label' => __( 'Alignment', 'deep' ),
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
					'{{WRAPPER}} p.content-style' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_color', //param_name
			[
				'label' 		=> __( 'Content Color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} p.content-style' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'content_color_hover', //param_name
			[
				'label' 		=> __( 'Hover Content Color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .wn-icon-box:hover p.content-style' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_content_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '{{WRAPPER}} p.content-style',
			]
		);

		$this->add_control(
			'icon_content_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} p.content-style' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_padding', //param_name
			[
				'label' 		=> __( 'Content padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} p.content-style' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_margin', //param_name
			[
				'label' 		=> __( 'Content margin', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} p.content-style' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'icon_image_section',
			[
				'label' => __( 'Icon or Image', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		$this->add_control(
			'icon_or_image', //param_name
			[
				'label' 	=> __( 'Icon or image', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'icon',
				'options' 	=> [
					'icon'  	=> __( 'Icon', 'deep' ),
					'image' 	=> __( 'Image', 'deep' ),
				],
			]
		);

		$this->add_control(
			'icon_name',
			[
				'label' => __( 'Select Icon', 'deep' ),
				'type' => \Elementor\Controls_Manager::ICON,
				'default' => 'sl-screen-desktop',
				'condition' 	=> [ //dependency
					'icon_or_image' 	=> [
						'icon'
					],
				],
			]
		);

		$this->add_control(
			'icon_image', //param_name
			[
				'label' 	=> __( 'Choose Image', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::MEDIA, //type
				'condition' 	=> [ //dependency
					'icon_or_image' 	=> [
						'image'
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
				'condition' 	=> [ //dependency
					'icon_or_image' 	=> [
						'image'
					],
				],
			]
		);

		$this->end_controls_section();

		// Icon or Image Style
		$this->start_controls_section(
			'icon_image_style',
			[
				'label' => __( 'Icon or Image Style', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
		);

		$this->add_control(
			'icon_size',
			[
				'label' 		=> __( 'Size', 'deep' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', '%' ],
				'range' 		=> [
					'px' 		=> [
						'min' 		=> 0,
						'max' 		=> 200,
						'step' 		=> 1,
					],
					'%' 		=> [
						'min' 		=> 0,
						'max' 		=> 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wn-icon-box i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' 	=> [ //dependency
					'icon_or_image' 	=> [
						'icon'
					],
				],
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label' => __( 'Alignment', 'deep' ),
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
					'#wrap {{WRAPPER}} .wn-icon-box i' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_color_type', //param_name
			[
				'label' 	=> __( 'Color type', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'icon_solid_color',
				'options' 	=> [ //value
					'icon_solid_color' 	=> __( 'Solid color', 'deep' ),
					'icon_gradient'  	=> __( 'Gradient', 'deep' ),
				],
				'condition' 	=> [ //dependency
					'icon_or_image' 	=> [
						'icon'
					],
				],
			]
		);

		$this->add_control(
			'icon_color', //param_name
			[
				'label' 		=> __( 'Color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .wn-icon-box i' => 'color: {{VALUE}}',
				],
				'condition' 	=> [ //dependency
					'icon_color_type' 	=> [
						'icon_solid_color'
					],
					'icon_or_image' 	=> [
						'icon'
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => '_hover',
				'label' => __( 'Gradient Color', 'deep' ),
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .wn-icon-box i',
				'condition' 	=> [ //dependency
					'icon_color_type' 	=> [
						'icon_gradient'
					],
				],
			]
		);

		$this->add_control(
			'icon_color_type_hover', //param_name
			[
				'label' 	=> __( 'Hover Color type', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'icon_solid_color_hover',
				'options' 	=> [ //value
					'icon_solid_color_hover' 	=> __( 'Solid color', 'deep' ),
					'icon_gradient_hover'  		=> __( 'Gradient', 'deep' ),
				],
				'condition' 	=> [ //dependency
					'icon_or_image' 	=> [
						'icon'
					],
				],
			]
		);

		$this->add_control(
			'icon_color_hover', //param_name
			[
				'label' 		=> __( 'Hover Color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .wn-icon-box:hover i' => 'color: {{VALUE}}',
				],
				'condition' 	=> [ //dependency
					'icon_color_type_hover' 	=> [
						'icon_solid_color_hover'
					],
					'icon_or_image' 	=> [
						'icon'
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'			=> 'icon_grad_color_hover',
				'label' 		=> __( 'Gradient hover Color', 'deep' ),
				'types' 		=> [ 'gradient' ],
				'selector'		=> '{{WRAPPER}} .wn-icon-box:hover i',
				'condition' 	=> [ //dependency
					'icon_color_type_hover' 	=> [
						'icon_gradient_hover'
					],
				],
			]
		);

		$this->add_responsive_control(
			'icon_width',
			[
				'label'	=> __( 'width', 'deep' ),
				'type'	=> \Elementor\Controls_Manager::SLIDER,
				'range'	=> [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'selectors' => [
					'{{WRAPPER}} .wn-icon-box i, {{WRAPPER}} .wn-icon-box img' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'icon_height',
			[
				'label' => __( 'height', 'deep' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'selectors' => [
					'{{WRAPPER}} .wn-icon-box i, {{WRAPPER}} .wn-icon-box img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Select Type
		$this->add_control(
			'icon_display_type', //param_name
			[
				'label' 	=> __( 'display', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'inline-block',
				'options' 	=> [
					'inline' 		=> __( 'inline', 'deep' ),
					'inline-block' 	=> __( 'inline block', 'deep' ),
					'block' 		=> __( 'block', 'deep' ),
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wn-icon-box i, {{WRAPPER}} .wn-icon-box img' => 'display: {{VALUE}}',
				],
			]
		);

		// icon bg type
		$this->add_control(
			'icon_bg_color_type', //param_name
			[
				'label' 	=> __( 'background color type', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'icon_bg_solid',
				'options' 	=> [ //value
					'icon_bg_solid' 	=> __( 'Solid color', 'deep' ),
					'icon_bg_grad'  	=> __( 'Gradient', 'deep' ),
				],
				'condition' 	=> [ //dependency
					'icon_or_image' 	=> [
						'icon'
					],
				],
				]
			);

		// icon bg solid color
		$this->add_control(
			'icon_bg_solid', //param_name
			[
				'label' 		=> __( 'background color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .wn-icon-box i' => 'background: {{VALUE}}',
				],
				'condition' 	=> [ //dependency
					'icon_bg_color_type' 	=> [
						'icon_bg_solid'
					],
					'icon_or_image' 	=> [
						'icon'
					],
				],
			]
		);

		// icon bg gradient
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'icon_bg_grad',
				'label' => __( 'Gradient hover Color', 'deep' ),
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .wn-icon-box i',
				'condition' 	=> [ //dependency
					'icon_bg_color_type' 	=> [
						'icon_bg_grad'
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '{{WRAPPER}} .wn-icon-box i, {{WRAPPER}} .wn-icon-box img',
			]
		);

		$this->add_control(
			'icon_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wn-icon-box i, {{WRAPPER}} .wn-icon-box img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_padding', //param_name
			[
				'label' 		=> __( 'Icon padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wn-icon-box i, {{WRAPPER}} .wn-icon-box img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_margin', //param_name
			[
				'label' 		=> __( 'Icon margin', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wn-icon-box i, {{WRAPPER}} .wn-icon-box img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'boxshadow_section',
			[
				'label' => __( 'Box shadow', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'box_shadow',
					'label' => __( 'Box Shadow', 'deep' ),
					'selector' => '{{WRAPPER}} .wn-icon-box',
				]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'classid_section',
			[
				'label' => __( 'Class & ID', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		$this->add_control(
			'shortcodeid', //param_name
			[
				'label' 		=> __( 'Custom ID', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXT, //type
			]
		);

		$this->add_control(
			'shortcodeclass', //param_name
			[
				'label' 		=> __( 'Custom Class', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXT, //type
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
	 * Render Iconbox widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings();

		wp_enqueue_style( 'wn-deep-icon-box0', DEEP_ASSETS_URL . 'css/frontend/icon-box/icon-box0.css' );
		wp_enqueue_style( 'wn-deep-icon-box' . $settings['type'], DEEP_ASSETS_URL . 'css/frontend/icon-box/icon-box' . $settings['type'] . '.css' );
		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}
		$start_wrap = $end_wrap = $thumbnail_url = '';
		$settings['type'] 			 = ( $settings['type'] == 0 ) ? '' : $settings['type'] ;
		$settings['tileffect']		 = $settings['tileffect'] === 'yes' ? ' wniconbx-tilt ' : '';
		$settings['bg_img_pos'] 	 = ( $settings['type'] == 28 && $settings['bg_img_pos'] ) ? $settings['bg_img_pos'] : '' ;
		$settings['shortcodeclass']  = $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
		$settings['shortcodeid']	 = $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';
		$iconbox_content 			 = $settings['iconbox_content'] ? '<p class="content-style">'.$settings['iconbox_content'] .'</p>' : '' ;

		if ( $settings['title_color_type'] == 'title_gradient' || $settings['title_color_type_hover'] == 'title_gradient_hover' ) {
			$iconbox_title_gradient_class = 'wn-title-gradient';
		} else {
			$iconbox_title_gradient_class = '';
		}

		if ( $settings['icon_color_type'] == 'icon_gradient' || $settings['icon_color_type_hover'] == 'icon_gradient_hover' ) {
			$iconbox_icon_gradient_class = 'wn-icon-gradient';
		} else {
			$iconbox_icon_gradient_class = '';
		}



		if ( $settings['type'] == 17 ) {
			$start_wrap = '<div class="icon-wrap">';
			$end_wrap   = '</div>';
		}

		if ( $settings['type'] == 26 ) {
			$start_wrap = '<div class="icon-wrap">';
			$end_wrap   = '</div>';
		}

		$iconbox22_class = '';
		if ( $settings['type'] == 15 || $settings['type'] == 22 ) {
			$iconbox22_class .= $settings['featured'] ? ' ' . $settings['featured'] : '';
			$iconbox22_class .= $settings['border_right'] ? ' ' . $settings['border_right'] : '';
		}

		if ( !empty( $settings['icon_link_url']['url'] ) && $settings['box_linkable'] == 'yes' ) {
			$target = $settings['icon_link_url']['is_external'] ? ' target=_blank' : '';
			$rel	= $settings['icon_link_url']['nofollow'] ? ' rel=nofollow' : '';
			echo '<a href="' . esc_url( $settings['icon_link_url']['url'] ) . '" class="icon-box-wrap-link" ' . esc_attr( $target . $rel ) . '>';
		}
		echo '<article class="wn-icon-box '. $settings['tileffect'] . $iconbox_title_gradient_class.' '.$iconbox_icon_gradient_class.' icon-box' . $settings['type'] . $iconbox22_class . ' ' . $settings['bg_img_pos'] . ' ' . $settings['align'] . ' ' . $settings['shortcodeclass'] . '"  ' . $settings['shortcodeid'] . '>';

			if ( $settings['iconbox_color_type_hover'] == 'iconbox_gradient_hover' ) {
				echo '<div class="wn-grad-bg"></div>';
			}

			if ( $settings['type'] == 18 ) {
				echo '<span class="shape"></span>';
				echo '<div class="wn-content-wrap">';
			}

			$icon_name = $settings['icon_name'] ? $settings['icon_name'] : '';
			if( !empty( $settings['icon_link_url']['url'] ) && $settings['icon_name'] != '' && $settings['box_linkable'] != 'yes' ) {
				$target = $settings['icon_link_url']['is_external'] ? ' target=_blank' : '';
				$rel	= $settings['icon_link_url']['nofollow'] ? ' rel=nofollow' : '';
				echo wp_kses( $start_wrap, wp_kses_allowed_html( 'post' ) ) . '<a href="' . esc_url( $settings['icon_link_url']['url'] ) . '" ' . esc_attr( $target . $rel ) . '>';
				if ( $settings['type'] != 21  && $settings['icon_name'] != '' && $settings['icon_or_image'] == 'icon' ) {
					echo '<i class="wn-icon '. esc_attr( $settings['icon_name'] ) . '"></i>';
				}
				echo '</a>' . $end_wrap ;
			} elseif ( $settings['type'] != 21 && $settings['icon_or_image'] == 'icon' ) {
				echo wp_kses( $start_wrap, wp_kses_allowed_html( 'post' ) ) . '<i class="wn-icon '. esc_attr( $settings['icon_name'] ) . '"></i>' . $end_wrap;
			}

			if ( !empty( $settings['icon_image']['url'] ) && $settings['icon_or_image'] == 'image' ) {

				$thumbnail_width 	= $settings['thumbnail']['width'] ? $settings['thumbnail']['width'] : '' ;
				$thumbnail_height 	= $settings['thumbnail']['height'] ? $settings['thumbnail']['height'] : '' ;

				if ( !empty( $settings['thumbnail']['width'] ) || !empty( $settings['thumbnail']['height'] ) ) {
					// if main class not exist get it
					if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
						require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
					}
					$image = new \Wn_Img_Maniuplate; // instance from settor class
					$thumbnail_url = $image->m_image( $settings['icon_image']['id'] , $settings['icon_image']['url'] , $settings['thumbnail']['width'] , $settings['thumbnail']['height'] ); // set required and get result
				} else {
					$thumbnail_url = $settings['icon_image']['url'];
				}

				if ( $settings['type'] != 21 ) {
					if( !empty( $settings['icon_link_url']['url'] ) && $settings['box_linkable'] != 'yes' ) {
						$target = $settings['icon_link_url']['is_external'] ? ' target=_blank' : '';
						$rel = $settings['icon_link_url']['nofollow'] ? ' rel=nofollow' : '';
						echo '<a href='. $settings['icon_link_url']['url'] .' ' . esc_attr( $target . $rel ) . '>' . '<img src="' . esc_url( $thumbnail_url ) .'" alt="' . $settings['icon_title'] . '">' . '</a>' ;
					} else {
						echo wp_kses( $start_wrap, wp_kses_allowed_html( 'post' ) ) . '<img src="' . esc_url( $thumbnail_url ) .'" alt="' . $settings['icon_title'] . '" />' . $end_wrap ;
					}
				}
			}

			if ( $settings['type'] == 21 ) {

				echo '<div class="iconbox-leftsection">';
				if ( $settings['icon_name'] != '' && $settings['icon_or_image'] == 'icon' ) {
					echo '<i class="wn-icon '. esc_attr( $settings['icon_name'] ) . '"></i>';
				}

				if( !empty( $settings['icon_link_url']['url'] ) && $settings['icon_or_image'] == 'image' && $settings['box_linkable'] != 'yes' ) {
					$target = $settings['icon_link_url']['is_external'] ? ' target=_blank' : '';
					echo '<a href='. $settings['icon_link_url']['url'] .' ' . esc_attr( $target ) . '>' . '<img src="' . esc_url( $thumbnail_url ) . '" alt="' . $settings['icon_title'] . '" />' . '</a>' ;
				} elseif ( !empty( $icon_image ) ) {
					echo wp_kses( $start_wrap, wp_kses_allowed_html( 'post' ) ) . '<img src="' . esc_url( $thumbnail_url ) . '" alt="' . esc_attr( $settings['icon_title'] ) . '">' . $end_wrap ;
				}
				echo '</div>';

			}

			if ( $settings['type'] != 21 ) {
				$icon_link_text = $settings['icon_link_text'] ? $settings['icon_link_text'] : '';
				$icon_link_url	= $settings['icon_link_url']['url'] ? $settings['icon_link_url']['url'] : '';
				$target 		= $settings['icon_link_url']['is_external'] ? ' target=_blank' : '';
				$rel			= $settings['icon_link_url']['nofollow'] ? ' rel=nofollow' : '';
				echo (!empty($settings['icon_subtitle'])) ? '<h5>' . $settings['icon_subtitle'] . '</h5>' : '';
				if ( $settings['title_linkable'] == 'yes' && $settings['box_linkable'] != 'yes' ) {
					echo '<a href="' . esc_url( $icon_link_url ) . '" ' . esc_attr( $target . $rel ) . '><h4 class="title-style">' . $settings['icon_title'] . '</h4></a>';
				} else {
					echo '<h4 class="title-style">' . $settings['icon_title'] . '</h4>';
				}

				echo  $iconbox_content ;
				echo (!empty($settings['icon_link_url']['url']) &&  (!empty($icon_link_text))  && $settings['box_linkable'] != 'yes' )?"<div class=\"readmore\"><a class=\"magicmore\" href=\"{$icon_link_url}\" >{$icon_link_text}</a></div>":'';

			}
			if ( $settings['type'] == 21 ) {
				$icon_link_text = $settings['icon_link_text'] ? $settings['icon_link_text'] : '';
				$icon_link_url = $settings['icon_link_url']['url'] ? $settings['icon_link_url']['url'] : '';
				$target = $settings['icon_link_url']['is_external'] ? ' target=_blank' : '';
				$rel	= $settings['icon_link_url']['nofollow'] ? ' rel=nofollow' : '';
				$settings['icon_subtitle'] = $settings['icon_subtitle'] ? '<h6 class="title-style">'.$settings['icon_subtitle'].'</h6>' : '' ;
				echo '
				<div class="iconbox-rightsection">
				<h6 class="title-style">' . $settings['icon_subtitle'] . '</h6>';
				if ( $settings['title_linkable'] == 'yes' && $settings['box_linkable'] != 'yes' ) {
					echo '<a href="' . esc_url( $icon_link_url ) . '" ' . esc_attr( $target . $rel ) . '><h4 class="title-style">' . $settings['icon_title'] . '</h4></a>';
				} else {
					echo '<h4 class="title-style">' . $settings['icon_title'] . '</h4>';
				}

				echo wp_kses( $iconbox_content, wp_kses_allowed_html( 'post' ) ) .'
				<div class="readmore">
				<a class="magicmore" href="' . esc_url( $settings['icon_link_url']['url'] ) . '" ' . esc_attr( $target . $rel ) .'>' . $icon_link_text . '</a>
				</div>
				</div>';

			}

			if ( $settings['type'] == 18 ) {
				echo '</div>';
			}

			echo '</article>';
			if ( !empty( $settings['icon_link_url']['url'] ) && $settings['box_linkable'] == 'yes' ) {
				echo '</a>';
			}

	}

}
