<?php
namespace Elementor;

class Webnus_Element_Widgets_Info_Box extends \Elementor\Widget_Base {

	/**
	 * Retrieve Info Box widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'info_box';

	}

	/**
	 * Retrieve Info Box widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Info Box', 'deep' );

	}

	/**
	 * Retrieve Info Box widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-call-to-action';

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

		return [ 'info-box', 'deep-nice-select' ];

	}

	/**
	 * widget styles.
	 *
	 * @since 4.2.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'deep-nice-select', 'wn-deep-info-box' ];

	}


	/**
	 * Register Info Box widget controls.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

        // Content Tab
		$this->start_controls_section(
			'content_sectiona',
			[
				'label' => esc_html__( 'General Options', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		// Featured Text
		$this->add_control(
			'featured_txt', //param_name
			[
				'label' 		=> esc_html__( 'Featured Text', 'deep' ), //heading
				'type' 			=> Controls_Manager::TEXT, //type
				'placeholder' 	=> esc_html__( 'Type your title text here', 'deep' ),
				'selectors' 	=> [
							'{{WRAPPER}} .infobox' => 'min-height: 222px',
				],
			]
		);

		// Featured URL
		$this->add_control(
			'feature_url', //param_name
			[
				'label' 		=> esc_html__( 'Featured URL', 'deep' ), //heading
				'type' 			=> Controls_Manager::URL,
				'default' 		=> [
						'url' 				=> 'http://',
						'is_external' 		=> '',
				],
				'show_external' => true, // Show the 'open in new tab' button.
			]
		);

		// Color of Text
		$this->add_control(
			'txt_color',
			[
				'label' 		=> esc_html__( 'Text Color', 'deep' ),
				'type' 			=> Controls_Manager::COLOR,
						'scheme' 		=> [
							'type'  => \Elementor\Core\Schemes\Color::get_type(),
							'value' => \Elementor\Core\Schemes\Color::COLOR_1,
						],
				'default' 		=> '#437df9',
				'selectors' 	=> [
							'{{WRAPPER}} .infobox .button-box .featured-text, {{WRAPPER}}  .infobox, {{WRAPPER}}  .infobox .infoselect' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' 		=> esc_html__( 'Icon Color', 'deep' ),
				'type' 			=> Controls_Manager::COLOR,
						'scheme' 		=> [
							'type'  => \Elementor\Core\Schemes\Color::get_type(),
							'value' => \Elementor\Core\Schemes\Color::COLOR_1,
						],
				'default' 		=> '#437df9',
				'selectors' 	=> [
							'{{WRAPPER}} .infobox .img svg path,{{WRAPPER}} .infobox .img svg line,{{WRAPPER}} .infobox .img svg ellipse' => 'stroke: {{VALUE}}',
				],
			]
		);

        $this->end_controls_section();

        // Content Tab
		$this->start_controls_section(
			'content_sectionb',
			[
				'label' => esc_html__( 'Branch Options', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		// Branch Items
		$this->add_control(
			'branch_list',
			[
				'label' 		=> esc_html__( 'Repeater List', 'deep' ),
				'type' 			=> Controls_Manager::REPEATER,
					'default' 	=> [
						[
							'branch' 		=> esc_html__( 'Branch 1', 'deep' ),
							'phone' 		=> esc_html__( '(888) - 123 456', 'deep' ),
							'email' 		=> esc_html__( 'branch1@yourbrand.co.uk', 'deep' ),
							'startday' 		=> esc_html__( 'Monday', 'deep' ),
							'time_of_week' 	=> esc_html__( '09:00 - 17:00', 'deep' ),
							'endday' 		=> esc_html__( 'Monday', 'deep' ),
						],
					],
				'fields' 		=> [
						[
							'name' 			=> 'branch',
							'label' 		=> esc_html__( 'Branch', 'deep' ),
							'type' 			=> Controls_Manager::TEXT,
							'default' 		=> esc_html__( 'Branch' , 'deep' ),
							'label_block' 	=> true,
							'description'   => esc_html__( 'Type a Location of your branch (EX : Area/State/Province/City/Country)', 'deep'),
						],
						[
							'name' 			=> 'phone',
							'label' 		=> esc_html__( 'Phone Number Of Branch', 'deep' ),
							'type' 			=> Controls_Manager::TEXT,
							'default' 		=> esc_html__( '(555) 123 - 4567' , 'deep' ),
							'label_block' 	=> true,
							'description'   => esc_html__( 'Type your branch phone number', 'deep'),
						],
						[
							'name' 			=> 'email',
							'label' 		=> esc_html__( 'E-mail Address Of Branch', 'deep' ),
							'type' 			=> Controls_Manager::TEXT,
							'default' 		=> esc_html__( 'info@yourdomain.com' , 'deep' ),
							'label_block' 	=> true,
							'description'   => esc_html__( 'Type your branch e-mail address', 'deep'),
						],
						[
							'name'		=> 'startday',
							'label' 	=> esc_html__( 'Start of week for branch', 'deep' ),
							'type' 		=> Controls_Manager::SELECT,
							'default' 	=> '2',
							'options' 	=> [
									'1'  	=> esc_html__( 'Sunday', 'deep' ),
									'2'  	=> esc_html__( 'Monday', 'deep' ),
									'3'  	=> esc_html__( 'Tuseday', 'deep' ),
									'4'  	=> esc_html__( 'Wednsday', 'deep' ),
									'5'  	=> esc_html__( 'Thursday', 'deep' ),
									'6'  	=> esc_html__( 'Friday', 'deep' ),
									'7'  	=> esc_html__( 'Saturday', 'deep' ),
							],
						],
						[
							'name' 			=> 'time_of_week',
							'label' 		=> esc_html__( 'Time Of Week', 'deep' ),
							'type' 			=> Controls_Manager::TEXT,
							'default' 		=> esc_html__( '8:30 AM - 7:00 PM' , 'deep' ),
							'label_block' 	=> true,
							'description'   => esc_html__( 'Start Time and End of Time day', 'deep'),
						],
						[
							'name'		=> 'endday',
							'label' 	=> esc_html__( 'End of week for branch', 'deep' ),
							'type' 		=> Controls_Manager::SELECT,
							'default' 	=> '2',
							'options' 	=> [
									'1'  	=> esc_html__( 'Sunday', 'deep' ),
									'2'  	=> esc_html__( 'Monday', 'deep' ),
									'3'  	=> esc_html__( 'Tuseday', 'deep' ),
									'4'  	=> esc_html__( 'Wednsday', 'deep' ),
									'5'  	=> esc_html__( 'Thursday', 'deep' ),
									'6'  	=> esc_html__( 'Friday', 'deep' ),
									'7'  	=> esc_html__( 'Saturday', 'deep' ),
							],
						],
				],
				'title_field'	 => '{{{ branch }}}',
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
				'selector' 	=> '#wrap {{WRAPPER}} .infobox .button-box a',
			]
		);

		$this->add_control(
			'button_color', //param_name
			[
				'label' 		=> __( 'Color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .infobox .button-box a' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' , 'gradient' ],
				'selector' => '#wrap {{WRAPPER}} .button-box a',
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
				'selector' => '#wrap {{WRAPPER}} .infobox',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .infobox',
			]
		);

		$this->add_control(
			'box_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .infobox' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'box_shadow',
					'label' => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .infobox',
				]
		);

		$this->add_control(
			'box_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .infobox' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .infobox' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	 * Render Info Box widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings 			= $this->get_settings_for_display();
		$featured_txt		= $this->get_settings( 'featured_txt' );
		$feature_url		= $this->get_settings( 'feature_url' );
		$txt_color			= $this->get_settings( 'txt_color' );

        // Class & ID
        $shortcodeclass 	= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
        $shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';
		$custom_css 		= $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}
		echo '<div class="infobox ' . $shortcodeclass . '"  ' . $shortcodeid . '>';

			$branch_list = $this->get_settings( 'branch_list' );
			$i = 1;

			echo '<select class="wn-niceselect infoselect">';
				foreach ( $branch_list as $line ) :
					echo '<option value="' . $line['branch'] . '" class="select-' . $i++ . '">' . $line['branch'] . '</option>';
				endforeach;
			echo '</select>';

			$branch_content = $this->get_settings( 'branch_list' );
			if ( $branch_content ) {
				echo '<div class="showbox">';
				foreach ( $branch_content as $item ) {
					echo '<div  id="' . $item['branch'] . '" class="info type-'. $item['branch'] . '">';
					echo '
							<div class="img"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="35px" height="35px" viewBox="0 0 35 35" enable-background="new 0 0 35 35" xml:space="preserve"><g><path fill="none" stroke="'. $settings['txt_color'] .'" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M33.477,17.5c0,8.693-7.156,15.74-15.977,15.74c-8.827,0-15.977-7.047-15.977-15.74S8.673,1.76,17.5,1.76 C26.321,1.76,33.477,8.807,33.477,17.5z"/><line fill="none" stroke="'. $settings['txt_color'] .'" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="25.836" y1="25.712" x2="18.968" y2="18.949"/><path fill="none" stroke="'. $settings['txt_color'] .'" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M19.584,17.5c0,1.133-0.936,2.053-2.084,2.053c-1.153,0-2.084-0.919-2.084-2.053c0-1.133,0.931-2.053,2.084-2.053 C18.648,15.447,19.584,16.367,19.584,17.5z"/><line fill="none" stroke="'. $settings['txt_color'] .'" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="16.805" y1="9.972" x2="16.805" y2="15.561"/></g></svg></div>
							<div class="timebox">
								<span class="time">' . $item['time_of_week'] . '</span>
								<span class="weekday">' . $item['startday'] . ' ' . esc_html__('to', 'deep') . ' ' . $item['endday'] . '</span>
							</div>
							<div class="img"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="35px" height="35px" viewBox="0 0 35 35" enable-background="new 0 0 35 35" xml:space="preserve"><g><path fill="none" stroke="'. $settings['txt_color'] .'" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M4.152,21.713c-1.552,0-2.81-1.241-2.81-2.771c0-1.531,1.258-2.771,2.81-2.771"/><path fill="none" stroke="'. $settings['txt_color'] .'" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M21.013,31.413h2.81c2.717,0,4.918-1.478,4.918-4.157V25.78"/><ellipse fill="none" stroke="'. $settings['txt_color'] .'" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" cx="18.905" cy="31.413" rx="2.108" ry="2.079"/><path fill="none" stroke="'. $settings['txt_color'] .'" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M9.772,25.87h-2.81c-1.552,0-2.81-1.241-2.81-2.771v-8.314c0-1.531,1.258-2.771,2.81-2.771h2.81V25.87z"/><path fill="none" stroke="'. $settings['txt_color'] .'" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M30.848,21.713c1.552,0,2.81-1.241,2.81-2.771c0-1.531-1.258-2.771-2.81-2.771"/><path fill="none" stroke="'. $settings['txt_color'] .'" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M25.228,25.87h2.81c1.552,0,2.81-1.241,2.81-2.771v-8.314c0-1.531-1.258-2.771-2.81-2.771h-2.81V25.87z"/><path fill="none" stroke="'. $settings['txt_color'] .'" stroke-width="2" stroke-linejoin="round" stroke-miterlimit="10" d="M7.664,12.012	c0-5.357,4.403-9.7,9.835-9.7c5.431,0,9.835,4.343,9.835,9.7"/></g></svg></div>
							<div class="callbox">
								<span class="phone">' . $item['phone'] . '</span>
								<span class="mail">' . $item['email'] . '</span>
							</div>
					';
					echo '</div>';
				}
				echo '</div>';
			}
			$target = $feature_url['is_external'] ? ' target=_blank' : '';
			$rel = $feature_url['nofollow'] ? ' rel=nofollow' : '';
			echo '<div class="button-box">
						<div class="featured-text ">' . $featured_txt . '</div>
						<a href="' . $feature_url['url'] . '"' . esc_attr( $target . $rel ) . ' class="button rounded small colorb">' . esc_html__('contact us today', 'deep' ) . '</a>
					</div>';

		echo '</div>';

	}

}
