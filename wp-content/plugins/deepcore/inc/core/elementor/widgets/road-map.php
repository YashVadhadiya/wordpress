<?php
namespace Elementor;
class Webnus_Element_Widgets_Road_Map extends \Elementor\Widget_Base {

	/**
	 * Retrieve Schedule widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'road_map';
		
	}

	/**
	 * Retrieve Schedule widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Roadmap', 'deep' );

	}

	/**
	 * Retrieve Schedule widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'ti-direction-alt';

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
	 * widget styles.
	 *
	 * @since 4.2.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'wn-deep-road-map' ];

	}

	/**
	 * Register Schedule widget controls.
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
				'label' => esc_html__( 'Road Map Settings', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		// Road Map Items
		$this->add_control(
			'roadmap_item',
			[
				'label' 		=> esc_html__( 'Road Map Items', 'deep' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> [
					[
						'name' 			=> 'item_title',
						'label' 		=> esc_html__( 'Mileston Title', 'deep' ),
						'type' 			=> Controls_Manager::TEXT,
						'description'   => esc_html__( 'Type your title, for example: Feb 5, 2018', 'deep' ),
						'label_block' 	=> true,
					],
					[
						'name'			=> 'item_past',
						'label'         => esc_html__( 'Past Mileston', 'deep' ),
						'type'          => Controls_Manager::SWITCHER,
						'on'            => esc_html__( 'Yes', 'deep' ),
						'off'           => esc_html__( 'No', 'deep' ),
						'return_value'  => 'enable',
						'description'   => esc_html__( 'Check it for past milestons', 'deep' ),
						'label_block' 	=> true,
					],
					[
						'name'			=> 'item_select',
						'label'         => esc_html__( 'Selected Mileston', 'deep' ),
						'type'          => Controls_Manager::SWITCHER,
						'on'            => esc_html__( 'Yes', 'deep' ),
						'off'           => esc_html__( 'No', 'deep' ),
						'return_value'  => 'enable',
						'description'   => esc_html__( 'Check it for show it different', 'deep' ),
						'label_block' 	=> true,							
					],
					[
						'name' 			=> 'item_desc',
						'label' 		=> esc_html__( 'Mileston Description', 'deep' ),
						'type' 			=> Controls_Manager::TEXTAREA,
						'description'   => esc_html__( 'Type your description here', 'deep'),
						'label_block' 	=> true,
					],
				],
				'default' => [
					[
						'item_title' => __( 'Item 1', 'deep' ),
						'item_past' => 'no',
						'item_select' => 'no',
						'item_desc' => esc_html__( ' It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.' , 'deep' ),
					],
					[
						'item_title' => __( 'Item 2', 'deep' ),
						'item_past' => 'no',
						'item_select' => 'enable',
						'item_desc' => esc_html__( ' It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.' , 'deep' ),
					],
					[
						'item_title' => __( 'Item 3', 'deep' ),
						'item_past' => 'no',
						'item_select' => 'no',
						'item_desc' => esc_html__( ' It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.' , 'deep' ),
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
				'selector' 	=> '#wrap {{WRAPPER}} .roadmap-item h4,#wrap {{WRAPPER}}  .roadmap-item p',
			]
		);

		$this->add_control(
			'content_color', //param_name
			[
				'label' 		=> __( 'Color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .roadmap-item h4,#wrap {{WRAPPER}}  .roadmap-item p' => 'color: {{VALUE}} !important',
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
				'selector' => '#wrap {{WRAPPER}} .roadmap-wrap',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .roadmap-wrap',
			]
		);

		$this->add_control(
			'box_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .roadmap-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'box_shadow',
					'label' => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .roadmap-wrap',
				]
		);

		$this->add_control(
			'box_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .roadmap-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .roadmap-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	 * Render Schedule widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings 			= $this->get_settings_for_display();	
		$roadmap_item 		= $settings['roadmap_item'];
        // Class & ID 
        $shortcodeclass 	= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
        $shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';
		// render
		$out  = '
		<div class="roadmap-wrap ' . $shortcodeclass . '"  ' . $shortcodeid . '>
			<div class="roadmap-items">';
				foreach ( $roadmap_item as $line ) :

					$item_title			= $line['item_title']	? $line['item_title']	:	''	;
					$item_past			= $line['item_past']	? $line['item_past']	:	''	;
					$item_select 		= $line['item_select']	? $line['item_select']	:	''	;
					$item_desc			= $line['item_desc']	? $line['item_desc']	:	''	;

					if ( 'enable' == $item_past ) {
						$item_past_class = ' roadmap-past';
					} else {
						$item_past_class = '';
					}
					if ( 'enable' == $item_select ) {
						$item_select_class = ' roadmap-select';
					} else {
						$item_select_class = '';
					}

					$out .= '
					<div class="roadmap-item' . $item_past_class . $item_select_class . '">
						<div class="roadmap-line">
							<div class="text-wrap">
								<h4>' . $item_title . '</h4>
								<p>' . $item_desc . '</p>
							</div>
						</div>
					</div>';
				endforeach;
				
		$out .= '
			</div>
		</div>';
	
        $custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}

		echo  $out;		
	}
}