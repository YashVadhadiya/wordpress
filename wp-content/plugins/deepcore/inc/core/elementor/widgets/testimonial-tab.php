<?php
namespace Elementor;

class Webnus_Element_Widgets_Testimonial_tabs extends \Elementor\Widget_Base {

	/**
	 * Retrieve Testimonial Tabs widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'testimonial_tabs';

	}

	/**
	 * Retrieve Testimonial Tabs widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Testimonial Tabs', 'deep' );

	}

	/**
	 * Retrieve Testimonial Tabs widget icon.
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
	 * enqueue JS
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_script_depends() {

		return [ 'deep-testimonial-tabs' ];

	}

	/**
	 * widget styles.
	 *
	 * @since 4.2.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'wn-deep-testimonial-tab' ];

	}


	/**
	 * Register Testimonial Tabs widget controls.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$elementor_tpl = \Elementor\Plugin::instance()->templates_manager->get_source( 'local' )->get_items();
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
				'label' => esc_html__( 'General', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		// Title Text Field
		$this->add_control(
			'center_align', //param_name
			[
				'label' 		=> __( 'Align Center', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::SWITCHER, //type
				'label_on' 		=> __( 'Enable', 'deep' ),
				'label_off' 	=> __( 'Disable', 'deep' ),
				'return_value' 	=> 'enable',
				'default' 		=> 'disable',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'items',
			[
				'label' => esc_html__( 'Items', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		$this->add_control(
			'tab_items',
			[
				'label'			=> esc_html__( 'Tab Item', 'deep' ),
				'type'			=> \Elementor\Controls_Manager::REPEATER,
				'description'	=>  esc_html__( 'If you want this element cover whole page width, please add it inside of a full row. For this purpose, click on edit button of the row and set Select Row Type on Full Width Row.', 'deep' ),
				'default' => [
					[
						'title'		=> __( 'Tab #1', 'deep' ),
					],
					[
						'title'		=> __( 'Tab #2', 'deep' ),
					],
					[
						'title'		=> __( 'Tab #3', 'deep' ),
					],
				],
				'fields' => [
					[
						'name'			=> 'title',
						'label'			=>  esc_html__( 'Title', 'deep' ),
						'type'			=> \Elementor\Controls_Manager::TEXT,
						'default'		=> esc_html__( 'Title' , 'deep' ),
					],
					[
						'name'			=> 'img',
						'label' 		=> __( 'Testimonial Image', 'deep' ), //heading
						'type' 			=> \Elementor\Controls_Manager::MEDIA, //type
					],
					[
						'name'			=> 'name',
						'label'			=>  esc_html__( 'Testimonial Name', 'deep' ),
						'type'			=> \Elementor\Controls_Manager::TEXT,
						'default'		=> esc_html__( 'Name' , 'deep' ),
					],
					[
						'name'			=> 'job',
						'label'			=>  esc_html__( 'Testimonial Job', 'deep' ),
						'type'			=> \Elementor\Controls_Manager::TEXT,
						'default'		=> esc_html__( 'Job' , 'deep' ),
					],
					[
						'name'       => 'editor',
						'label'      => esc_html__( 'Content', 'deep' ),
						'type'       => \Elementor\Controls_Manager::WYSIWYG,
						'default'    => esc_html__( 'I am tab content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorp I am er mattis, pulvinar dapibus leo.', 'deep' ),
						'show_label' => false,
					],
				]
			]
		);

		$this->end_controls_section();

		// Class & ID Tab
		$this->start_controls_section(
			'classid_section',
			[
				'label' => esc_html__( 'Class & ID', 'deep' ),
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

		// Style
		$this->start_controls_section(
			'section_name_style',
			[
				'label' => __( 'Name', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'name_typography',
				'label' 	=> __( 'Name Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .testimonial-tab-name',
			]
		);
		$this->add_control(
			'name_text_align',
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
					'#wrap {{WRAPPER}} .testimonial-tab-name' => 'text-align: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'name_color',
			[
				'label' 		=> __( 'Name color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .testimonial-tab-name' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'name_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .testimonial-tab-name',
			]
		);
		$this->add_control(
			'name_padding',
			[
				'label' 		=> __( 'Name padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .testimonial-tab-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'name_margin',
			[
				'label' 		=> __( 'Name margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .testimonial-tab-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'name_opacity',
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
					'#wrap {{WRAPPER}} .testimonial-tab-name' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'name_display',
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
					'#wrap {{WRAPPER}} .testimonial-tab-name' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'name_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .testimonial-tab-name' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'name_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .testimonial-tab-name',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_job_style',
			[
				'label' => __( 'Job', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'job_typography',
				'label' 	=> __( 'Job Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .testimonial-tab-job',
			]
		);
		$this->add_control(
			'job_text_align',
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
					'#wrap {{WRAPPER}} .testimonial-tab-job' => 'text-align: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'job_color',
			[
				'label' 		=> __( 'Job color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .testimonial-tab-job' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'job_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .testimonial-tab-job',
			]
		);
		$this->add_control(
			'job_padding',
			[
				'label' 		=> __( 'Job padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .testimonial-tab-job' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'job_margin',
			[
				'label' 		=> __( 'Job margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .testimonial-tab-job' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'job_opacity',
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
					'#wrap {{WRAPPER}} .testimonial-tab-job' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'job_display',
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
					'#wrap {{WRAPPER}} .testimonial-tab-job' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'job_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .testimonial-tab-job' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'job_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .testimonial-tab-job',
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
				'selector' => '{{WRAPPER}} .testimonial-tab-info img',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'image_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .testimonial-tab-info img',
			]
		);
		$this->add_control(
			'image_padding',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-tab-info img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .testimonial-tab-info img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .testimonial-tab-info img' => 'opacity: {{SIZE}};',
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
					'{{WRAPPER}} .testimonial-tab-info img' => 'display: {{VALUE}};',
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
					'{{WRAPPER}} .testimonial-tab-info img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '{{WRAPPER}} .testimonial-tab-info img',
			]
		);
		$this->end_controls_section();

		/*******************start************** */
		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Content', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'content_typography',
				'label' 	=> __( 'Content Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .testimonial-tab-content',
			]
		);
		$this->add_control(
			'content_text_align',
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
					'#wrap {{WRAPPER}} .testimonial-tab-content' => 'text-align: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' 		=> __( 'Content color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .testimonial-tab-content' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .testimonial-tab-content',
			]
		);
		$this->add_control(
			'content_padding',
			[
				'label' 		=> __( 'Content padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .testimonial-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .testimonial-tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .testimonial-tab-content' => 'display: {{VALUE}};',
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
					'#wrap {{WRAPPER}} .testimonial-tab-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		/*******************end************** */

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
				'selector' => '#wrap {{WRAPPER}} .testimonial-tab-items',
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
					'#wrap {{WRAPPER}} .testimonial-tab-items' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .testimonial-tab-items',
			]
		);
		$this->add_control(
			'box_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .testimonial-tab-items' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .testimonial-tab-items',
				]
		);
		$this->add_control(
			'box_padding',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .testimonial-tab-items' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .testimonial-tab-items' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .testimonial-tab-items' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .testimonial-tab-items' => 'overflow: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'box_hover',
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
				'selector' => '#wrap {{WRAPPER}} .testimonial-tab-items:hover',
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
					'#wrap {{WRAPPER}} .testimonial-tab-items:hover' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border_hover',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .testimonial-tab-items:hover',
			]
		);
		$this->add_control(
			'box_border_radius_hover',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .testimonial-tab-items:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow_hover',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .testimonial-tab-items:hover',
				]
		);
		$this->add_control(
			'box_padding_hover',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .testimonial-tab-items:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .testimonial-tab-items:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .testimonial-tab-items:hover' => 'opacity: {{SIZE}};',
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
	 * Render Testimonial Tabs widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings();
		$shortcodeclass 	= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
		$shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';
		$uniqid 			= uniqid();
		$center_align 		= $settings['center_align'] == 'enable' ? ' aligncenter ' : '' ;
		$tab_items = $tab_contents = $thumbnail_url = '';

        $custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
        }

		foreach ( $settings['tab_items'] as $tab_item ) :
			$counter = substr(uniqid(rand(),1),0,7);
			if( !empty( $tab_item['img']['url'] ) ) {
				// if main class not exist get it
				if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
					require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
				}
				$image = new \Wn_Img_Maniuplate; // instance from settor class
				$thumbnail_url = $image->m_image( $tab_item['img']['id'] , $tab_item['img']['url'] , '90' , '90' ); // set required and get result
			} else {
				$thumbnail_url =  DEEP_ASSETS_URL . 'images/no_speaker.jpg ';
			}

			$img_attach = '<img src="'. $thumbnail_url .'" alt="'. $tab_item['name'] .'">';

			$tab_contents .= '
				<div class="testimonial-tab-item">
					<input type="radio" name="css-tabs" id="tab-' .  $counter . '" class="testimonial-tab-switch">
					<div class="testimonial-tab-info">
						<label for="tab-' . $counter . '" class="testimonial-tab-label">' . $img_attach . '</label>
						<div class="testimonial-tab-name"> ' . $tab_item['name'] . ' </div>
						<div class="testimonial-tab-job"> ' . $tab_item['job'] . ' </div>
					</div>
					<div class="testimonial-tab-content">
					'.wp_kses_post( $tab_item['editor'] );
			$tab_contents .= '
					</div>
				</div>';
		endforeach;

		?>

			<div id="wn-testimonial-tab" class="testimonial-tab-<?php echo '' . $uniqid ?> <?php esc_attr_e( $shortcodeclass );?>" data-id="<?php echo '' . $uniqid ?>">
				<div class="testimonial-tab-items"><div class="testimonial-tabs<?php echo '' . $center_align ?>" <?php esc_attr_e( $shortcodeid );?>>
					<?php echo $tab_contents; ?>
				</div>
			</div>

		<?php
	}

}
