<?php
namespace Elementor;

class Webnus_Element_Widgets_Content_Slider extends \Elementor\Widget_Base {

	/**
	 * Retrieve Content Slider widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'content-slider';

	}

	/**
	 * Retrieve Content Slider widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Content Slider', 'deep' );

	}

	/**
	 * Retrieve Content Slider widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-post-slider';

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
	 */
	public function get_script_depends() {

		return [ 'deep-owl-carousel', 'deep-content-slider' ];

	}

	/**
	 * widget styles.
	 *
	 * @since 4.2.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'deep-owl-carousel', 'wn-deep-content-slider' ];

	}

	/**
	 * Register Content Slider widget controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$elementor_tpl      = \Elementor\Plugin::instance()->templates_manager->get_source( 'local' )->get_items();
		$elementor_tpl_opts = [ '0' => __( 'Elementor template is not defined yet.', 'deep' ) ];

		if ( ! empty( $elementor_tpl ) ) {
			$elementor_tpl_opts = [ '0' => __( 'Select elementor template', 'deep' ) ];

			foreach ( $elementor_tpl as $template ) {
				$elementor_tpl_opts[ $template['template_id'] ] = $template['title'] . ' (' . $template['type'] . ')';
			}
		}

		// Content Tab
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Items', 'deep' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'slider_items',
			[
				'label'       => esc_html__( 'Process Item', 'deep' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'description' => esc_html__( 'If you want this element cover whole page width, please add it inside of a full row. For this purpose, click on edit button of the row and set Select Row Type on Full Width Row.', 'deep' ),
				'default'     => [
					[
						'title' => __( 'Tab #1', 'deep' ),
					],
					[
						'title' => __( 'Tab #2', 'deep' ),
					],
					[
						'title' => __( 'Tab #3', 'deep' ),
					],
				],
				'fields'      => [
					[
						'name'  => 'title',
						'label' => esc_html__( 'Title', 'deep' ),
						'type'  => \Elementor\Controls_Manager::TEXT,
					],
					[
						'name'         => 'full_width',
						'label'        => __( 'Full width content', 'deep' ), // heading
						'type'         => \Elementor\Controls_Manager::SWITCHER, // type
						'label_on'     => __( 'Enable', 'deep' ),
						'label_off'    => __( 'Disable', 'deep' ),
						'return_value' => 'yes',
						'default'      => 'no',
					],
					[
						'name'  => 'extra_class',
						'label' => esc_html__( 'Extra class', 'deep' ),
						'type'  => \Elementor\Controls_Manager::TEXT,
					],
					[
						'name'      => 'bg_color',
						'label'     => __( 'Background color', 'deep' ), // heading
						'type'      => \Elementor\Controls_Manager::COLOR, // type
						'selectors' => [
							'{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
						],
					],
					[
						'name'      => 'bg_image',
						'label'     => __( 'Background Image', 'deep' ), // heading
						'type'      => \Elementor\Controls_Manager::MEDIA, // type
						'selectors' => [
							'{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-image: url({{URL}})',
						],
					],
					[
						'name'      => 'bg_position',
						'label'     => __( 'Background Position', 'deep' ), // heading
						'type'      => \Elementor\Controls_Manager::SELECT, // type
						'default'   => 'center center',
						'options'   => [
							'left top'      => __( 'Left Top', 'deep' ),
							'left center'   => __( 'Left Center', 'deep' ),
							'left bottom'   => __( 'Left Bottom', 'deep' ),
							'center top'    => __( 'Center Top', 'deep' ),
							'center center' => __( 'Center Center', 'deep' ),
							'center bottom' => __( 'Center Bottom', 'deep' ),
							'right top'     => __( 'Right Top', 'deep' ),
							'right center'  => __( 'Right Center', 'deep' ),
							'right bottom'  => __( 'Right Bottom', 'deep' ),
						],
						'selectors' => [
							'{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-position: {{VALUE}} !important;',
						],
					],
					[
						'name'      => 'bg_repeat',
						'label'     => __( 'Background Repeat', 'deep' ), // heading
						'type'      => \Elementor\Controls_Manager::SELECT, // type
						'default'   => 'no-repeat',
						'options'   => [
							'repeat'    => __( 'Repeat', 'deep' ),
							'repeat-x'  => __( 'Repeat x', 'deep' ),
							'repeat-y'  => __( 'Repeat y', 'deep' ),
							'no-repeat' => __( 'No Repeat', 'deep' ),
						],
						'selectors' => [
							'{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-repeat: {{VALUE}} !important;',
						],
					],
					[
						'name'         => 'bg_cover',
						'label'        => __( 'Background Cover', 'deep' ), // heading
						'type'         => \Elementor\Controls_Manager::SWITCHER, // type
						'label_on'     => __( 'Yes', 'deep' ),
						'label_off'    => __( 'No', 'deep' ),
						'return_value' => 'cover',
						'default'      => 'cover',
						'selectors'    => [
							'{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-size: {{VALUE}} !important;',
						],
					],
					[
						'name'        => 'elementor_tpl_id',
						'label'       => esc_html__( 'Choose template', 'deep' ),
						'type'        => \Elementor\Controls_Manager::SELECT,
						'default'     => '0',
						'options'     => $elementor_tpl_opts,
						'label_block' => 'true',
					],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'classid_section',
			[
				'label' => __( 'Class', 'deep' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'shortcodeclass', // param_name
			[
				'label' => __( 'Custom Class', 'deep' ), // heading
				'type'  => \Elementor\Controls_Manager::TEXT, // type
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'main_setting',
			[
				'label' => esc_html__( 'General', 'deep' ),
				'tab'   => \Elementor\Controls_Manager::TAB_SETTINGS,
			]
		);

		$this->add_control(
			'full_height', // param_name
			[
				'label'        => __( 'Full height Slider', 'deep' ), // heading
				'type'         => \Elementor\Controls_Manager::SWITCHER, // type
				'label_on'     => __( 'Enable', 'deep' ),
				'label_off'    => __( 'Disable', 'deep' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'        => __( 'Autoplay', 'plugin-domain' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'your-plugin' ),
				'label_off'    => __( 'No', 'your-plugin' ),
				'return_value' => 'true',
			]
		);

		$this->add_control(
			'slider_speed',
			[
				'label'       => esc_html__( 'Slider Speed', 'deep' ),
				'type'        => Controls_Manager::SLIDER,
				'description' => esc_html__( 'Animation Speed', 'deep' ),
				'size_units'  => [ 'px' ],
				'range'       => [
					'px' => [
						'min'  => 1000,
						'max'  => 5000,
						'step' => 1,
					],
				],
				'default'     => [
					'unit' => 'px',
					'size' => 2000,
				],
				'condition'   => [ // dependency
					'autoplay' => [
						'true',
					],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'arrows_settings',
			[
				'label' => esc_html__( 'Arrows', 'deep' ),
				'tab'   => \Elementor\Controls_Manager::TAB_SETTINGS,
			]
		);

		$this->add_control(
			'arrow_type', // param_name
			[
				'label'   => __( 'Arrow Type', 'deep' ), // heading
				'type'    => \Elementor\Controls_Manager::SELECT, // type
				'default' => 'none',
				'options' => [
					'none'   => __( 'None', 'deep' ),
					'arrow1' => __( 'Normal Arrow', 'deep' ),
					'arrow2' => __( 'Arrow with Line', 'deep' ),
					'arrow3' => __( 'Box Arrow', 'deep' ),
					'arrow4' => __( 'Modern Box Arrow', 'deep' ),
				],
			]
		);

		$this->add_control(
			'arrow_position', // param_name
			[
				'label'   => __( 'Arrow Position', 'deep' ), // heading
				'type'    => \Elementor\Controls_Manager::SELECT, // type
				'default' => 'wn-normal-arrow',
				'options' => [
					'wn-normal-arrow' => esc_html__( 'Normal (left and right)', 'deep' ),
					'wn-tleft'        => esc_html__( 'Top Left', 'deep' ),
					'wn-tright'       => esc_html__( 'Top Right', 'deep' ),
					'wn-tcenter'      => esc_html__( 'Top Center', 'deep' ),
					'wn-bleft'        => esc_html__( 'Bottom Left', 'deep' ),
					'wn-bright'       => esc_html__( 'Bottom Right', 'deep' ),
					'wn-bcenter'      => esc_html__( 'Bottom Center', 'deep' ),
					'wn-mleft'        => esc_html__( 'Middle Left', 'deep' ),
					'wn-mright'       => esc_html__( 'Middle Right', 'deep' ),
					'wn-mcenter'      => esc_html__( 'Middle Center', 'deep' ),
					'wn-custom-arrow' => esc_html__( 'Custom', 'deep' ),
				],
				'condition' => [
                    'arrow_type!' => 'none'
                ]
			]
		);

		$this->add_control(
			'top_space',
			[
				'label'       => esc_html__( 'Top Space', 'deep' ),
				'type'        => Controls_Manager::SLIDER,
				'description' => esc_html__( 'If you enter value in this field then leave “Bottom Space” field blank', 'deep' ),
				'size_units'  => [ 'px' ],
				'range'       => [
					'px' => [
						'min'  => 0,
						'max'  => 2000,
						'step' => 1,
					],
				],
				'selectors'   => [
					'{{WRAPPER}} #wn-content-slider .owl-nav' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [ // dependency
					'arrow_position' => [
						'wn-custom-arrow',
					],
				],
			]
		);

		$this->add_control(
			'left_space',
			[
				'label'       => esc_html__( 'Left Space', 'deep' ),
				'type'        => Controls_Manager::SLIDER,
				'description' => esc_html__( 'In “arrow with line” type this field moves line and arrows together', 'deep' ),
				'size_units'  => [ 'px' ],
				'range'       => [
					'px' => [
						'min'  => 0,
						'max'  => 2000,
						'step' => 1,
					],
				],
				'devices'     => [ 'desktop', 'tablet', 'mobile' ],
				'selectors'   => [
					'{{WRAPPER}} #wn-content-slider .owl-nav' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [ // dependency
					'arrow_position' => [
						'wn-custom-arrow',
					],
				],
			]
		);

		$this->add_control(
			'arrow_color', // param_name
			[
				'label'     => __( 'Arrow color', 'deep' ), // heading
				'type'      => \Elementor\Controls_Manager::COLOR, // type
				'default'	=> '#000',
				'selectors' => [
					'{{WRAPPER}} #wn-content-slider .content-slider-arrow-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} #wn-content-slider .content-slider-arrow-icon:after' => 'background-color: {{VALUE}}',
				],

			]
		);

		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => __( 'Background', 'deep' ),
				'condition'  => [ // dependency
					'arrow_type' => [
						'arrow3',
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'       => 'arrow_bg_color',
				'label'      => __( 'Arrow Background color', 'deep' ),
				'show_label' => true,
				'types'      => [ 'classic', 'gradient' ],
				'selector'   => '{{WRAPPER}} #wn-content-slider.arrow-type-arrow3 .content-slider-arrow-icon i',
				'condition'  => [ // dependency
					'arrow_type' => [
						'arrow3',
					],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => __( 'Hover Background', 'deep' ),
				'condition'  => [ // dependency
					'arrow_type' => [
						'arrow3',
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'       => 'arrow_bg_color_hover',
				'label'      => __( 'Arrow Background color hover', 'deep' ),
				'types'      => [ 'classic', 'gradient' ],
				'selector'   => '#wrap {{WRAPPER}} #wn-content-slider.arrow-type-arrow3 .content-slider-arrow-icon i:hover',
				'show_label' => true,
				'condition'  => [ // dependency
					'arrow_type' => [
						'arrow3',
					],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'line_color', // param_name
			[
				'label'     => __( 'Line color', 'deep' ), // heading
				'type'      => \Elementor\Controls_Manager::COLOR, // type
				'selectors' => [
					'{{WRAPPER}} .arrow-type-arrow2.wn-normal-arrow .owl-nav .content-slider-arrow-icon:before, #wn-content-slider .owl-nav:before' => 'background-color: {{VALUE}}',
				],
				'condition' => [ // dependency
					'arrow_type' => [
						'arrow2',
					],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'bullets_settings',
			[
				'label' => esc_html__( 'Bullets', 'deep' ),
				'tab'   => \Elementor\Controls_Manager::TAB_SETTINGS,
			]
		);

		$this->add_control(
			'bullet_type', // param_name
			[
				'label'   => __( 'Bullet Type', 'deep' ), // heading
				'type'    => \Elementor\Controls_Manager::SELECT, // type
				'default' => 'none',
				'options' => [
					'none'             => esc_html__( 'None', 'deep' ),
					'wn-bullet-circle' => esc_html__( 'Circle', 'deep' ),
					'wn-bullet-rec'    => esc_html__( 'Rectangular', 'deep' ),
					'wn-bullet-sq'     => esc_html__( 'Square', 'deep' ),
				],
			]
		);

		$this->add_control(
			'bullet_color', // param_name
			[
				'label'     => __( 'Bullet color', 'deep' ), // heading
				'type'      => \Elementor\Controls_Manager::COLOR, // type
				'selectors' => [
					'{{WRAPPER}} .wn-content-slider-wrap .owl-dots .owl-dot.active' => 'background-color: {{VALUE}}',
				],
				'condition' => [ // dependency
					'bullet_type!' => [
						'none',
					],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'numbers_settings',
			[
				'label' => esc_html__( 'Numbers', 'deep' ),
				'tab'   => \Elementor\Controls_Manager::TAB_SETTINGS,
			]
		);

		$this->add_control(
			'numbers', // param_name
			[
				'label'   => __( 'Numbers', 'deep' ), // heading
				'type'    => \Elementor\Controls_Manager::SELECT, // type
				'default' => 'none',
				'options' => [
					'none'   => esc_html__( 'None', 'deep' ),
					'num-tl' => esc_html__( 'Top Left', 'deep' ),
					'num-tc' => esc_html__( 'Top Center', 'deep' ),
					'num-tr' => esc_html__( 'Top Right', 'deep' ),
					'num-bl' => esc_html__( 'Bottom Left', 'deep' ),
					'num-bc' => esc_html__( 'Bottom Center', 'deep' ),
					'num-br' => esc_html__( 'Bottom Right', 'deep' ),
					'num-ml' => esc_html__( 'Middle Left', 'deep' ),
					'num-mc' => esc_html__( 'Middle Center', 'deep' ),
					'num-mr' => esc_html__( 'Middle Right', 'deep' ),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'num_bg_color',
				'label'    => __( 'Background color', 'deep' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .wn-content-slider-wrap .content-slider-num',
			]
		);

		$this->add_control(
			'num_color', // param_name
			[
				'label'     => __( 'Number color', 'deep' ), // heading
				'type'      => \Elementor\Controls_Manager::COLOR, // type
				'selectors' => [
					'{{WRAPPER}} .wn-content-slider-wrap .content-slider-num span' => 'color: {{VALUE}}',
				],
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
				'name'     => 'box_bg',
				'label'    => __( 'Background', 'deep' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '#wrap {{WRAPPER}} .ww-cs-cn',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .ww-cs-cn',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => __( 'Box Shadow', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .ww-cs-cn',
			]
		);

		$this->add_control(
			'box_padding', // param_name
			[
				'label'      => __( 'Padding', 'deep' ), // heading
				'type'       => \Elementor\Controls_Manager::DIMENSIONS, // type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'#wrap {{WRAPPER}} .ww-cs-cn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'box_margin', // param_name
			[
				'label'      => __( 'Margin', 'deep' ), // heading
				'type'       => \Elementor\Controls_Manager::DIMENSIONS, // type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'#wrap {{WRAPPER}} .ww-cs-cn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
					'#wrap {{WRAPPER}} .ww-cs-cn' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'box_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .ww-cs-cn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .ww-cs-cn' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .ww-cs-cn' => 'overflow: {{VALUE}};',
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
				'selector' => '#wrap {{WRAPPER}} .ww-cs-cn:hover',
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
					'#wrap {{WRAPPER}} .ww-cs-cn:hover' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border_hover',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .ww-cs-cn:hover',
			]
		);
		$this->add_control(
			'box_border_radius_hover',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .ww-cs-cn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow_hover',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .ww-cs-cn:hover',
				]
		);
		$this->add_control(
			'box_padding_hover',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .ww-cs-cn:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .ww-cs-cn:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .ww-cs-cn:hover' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->end_controls_section();

		// Custom css tab
		$this->start_controls_section(
			'custom_css_section',
			[
				'label' => __( 'Custom CSS', 'deep' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'custom_css',
			[
				'label'      => __( 'Custom CSS', 'deep' ),
				'type'       => \Elementor\Controls_Manager::CODE,
				'language'   => 'css',
				'rows'       => 20,
				'show_label' => true,
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render Content Slider widget output on the frontend.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings();
		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}
		$content_slider_class = $live_page_builders_css = $desktop_custom_css = $tablet_custom_css = $mobile_custom_css = $wn_ba_colors = $arrow_icon_left = $arrow_icon_right = '';
		$uniqid               = uniqid();

		if ( $settings['arrow_type'] == 'arrow4' ) {
			$arrow_icon_left  = 'data-arrow-left="<i class=\'icon-arrows-slim-left\'></i><span>' . esc_html__( 'PRE', 'deep' ) . '</span>"';
			$arrow_icon_right = 'data-arrow-right="<span>' . esc_html__( 'NXT', 'deep' ) . '</span><i class=\'icon-arrows-slim-right\'></i>"';
		} else {
			$arrow_icon_left  = 'data-arrow-left="<i class=\'icon-arrows-left\'></i>"';
			$arrow_icon_right = 'data-arrow-right="<i class=\'icon-arrows-right\'></i>"';
		}

		// Full height option
		if ( $settings['full_height'] == 'yes' ) {
			$content_slider_class .= ' cs-full-height ';
		}

		// Get arrow type
		$arrows_arrow_type     = ( $settings['arrow_type'] !== 'none' ) ? 'data-arrow="true"' : 'data-arrow="false"';
		$content_slider_class .= ( $settings['arrow_type'] !== 'none' ) ? ' arrow-type-' . $settings['arrow_type'] . ' ' : '';

		// Get Bullet
		$dotted_arrow_type     = ( $settings['bullet_type'] == 'none' ) ? 'data-bullet="false"' : 'data-bullet="true"';
		$content_slider_class .= ( $settings['bullet_type'] !== 'none' ) ? ' ' . $settings['bullet_type'] . ' ' : '';
		$slider_speed = 'data-speed="' . $settings['slider_speed']['size'] . '"';
		$autoplay  =  ( $settings['autoplay'] == true ) ? 'data-play=true' : '';

		if ( $settings['numbers'] != 'none' ) {
			$data_number = ' data-number="true" ';
			echo '<div id="wn-content-slider-wrap" class="wn-content-slider-wrap wn-content-slider-wrap-' . $uniqid . ' ' . $settings['numbers'] . '" ' . $data_number . '>';
		}

		$tab_contents = $extra_class = $parallax_content = '';
		if ( ! empty( $settings['slider_items'] ) ) :
			foreach ( $settings['slider_items'] as $tab_item ) :
				$uniqid_2     = substr( uniqid( rand(), 1 ), 0, 7 );
				$extra_class .= ! empty( $tab_item['respo-bg-none'] ) ? ' ' . $tab_item['respo-bg-none'] . ' ' : '';
				$extra_class .= ! empty( $tab_item['extra_class'] ) ? ' ' . $tab_item['extra_class'] . ' ' : '';
				// if ( $tab_item['wn_parallax'] == 'content-moving' ) {
				// 	$extra_class      .= ' ' . $tab_item['wn_parallax'] . ' ';
				// 	$parallax_content .= '<div class="wn-parallax-bg-holder" data-wnparallax-speed="' . $tab_item['wn_parallax_speed'] . '"><div class="wn-parallax-bg"></div></div>';
				// }

				$tab_contents .= '<div id="content-slider-single-' . $uniqid_2 . '" class="content-slider-single ' . $extra_class . ' elementor-repeater-item-' . $tab_item['_id'] . '">' . $parallax_content;

				if ( $tab_item['full_width'] == 'yes' ) {
					$tab_contents .= '<div class="container">';
				}

				$tab_contents .= \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $tab_item['elementor_tpl_id'], true );

				if ( $tab_item['full_width'] == 'yes' ) {
					$tab_contents .= '</div>';
				}

				$tab_contents .= '</div>';
			endforeach;
		endif;

		?>
		<div id="wn-content-slider" class="ww-cs-cn content-slider-<?php echo '' . $uniqid; ?> <?php echo esc_attr( $settings['shortcodeclass'] );?><?php echo '' . $content_slider_class . ' ' . $settings['arrow_position']; ?> owl-carousel owl-theme" data-id="<?php echo '' . $uniqid; ?>"  <?php echo '' . $dotted_arrow_type; ?> <?php echo '' . $arrows_arrow_type; ?> <?php echo '' . $slider_speed . '' ; ?> <?php echo '' . $arrow_icon_left; ?> <?php echo '' . $arrow_icon_right; ?> <?php echo esc_attr($autoplay); ?>>
			<?php echo $tab_contents; ?>
		</div>
		<?php
		if ( $settings['numbers'] != 'none' ) {
			echo '<div class="content-slider-num"></div></div>';
		}

	}

}
