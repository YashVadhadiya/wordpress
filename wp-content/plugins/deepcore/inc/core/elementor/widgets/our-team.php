<?php
namespace Elementor;

class Webnus_Element_Widgets_Our_Team extends \Elementor\Widget_Base {

	/**
	 * Retrieve Our Team widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'our_team';

	}

	/**
	 * Retrieve Our Team widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Our Team', 'deep' );

	}

	/**
	 * Retrieve Our Team widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'sl-people';

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

		return [ 'deep-owl-carousel', 'deep-our-team' ];

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
	 * Register Our Team widget controls.
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
				'label' => esc_html__( 'Select Type', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);
		$this->add_control(
			'type',
			[
				'label' 	=> esc_html__( 'Type', 'deep' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> '2',
				'options' 	=> [
                   		 '1'  	=> esc_html__( 'Type 1', 'deep' ),
                   		 '2'  	=> esc_html__( 'Type 2', 'deep' ),
                   		 '3'  	=> esc_html__( 'Type 3', 'deep' ),
                   		 '4'  	=> esc_html__( 'Type 4', 'deep' ),
                   		 '5'  	=> esc_html__( 'Type 5', 'deep' ),
                   		 '6'  	=> esc_html__( 'Type 6', 'deep' ),
                   		 '7'  	=> esc_html__( 'Type 7', 'deep' ),
                   		 '8'  	=> esc_html__( 'Type 8', 'deep' ),
                   		 '9'  	=> esc_html__( 'Type 9', 'deep' ),
                   		 '10'  	=> esc_html__( 'Type 10', 'deep' ),
                   		 '11'  	=> esc_html__( 'Type 11', 'deep' ),
                   		 '12'  	=> esc_html__( 'Type 12', 'deep' ),
                   		 '13'  	=> esc_html__( 'Type 13', 'deep' ),
                   		 '14'  	=> esc_html__( 'Type 14', 'deep' ),
                   		 '15'  	=> esc_html__( 'Type 15', 'deep' ),
                   		 '16'  	=> esc_html__( 'Type 16', 'deep' ),
				],
			]
		);
		$this->add_control(
			'img',
			[
				'label' 		=> esc_html__( 'Team Image', 'deep' ),
				'type' 			=> Controls_Manager::MEDIA,
                'condition'     => [
					'type!'     => [
						'9','10'
					],
                ],
			]
        );
		$this->add_control(
			'thumbnail',
			[
				'label' => esc_html__( 'Image Size', 'deep' ),
				'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
				'description' => esc_html__( 'Enter image size (Example: 200x100 (Width x Height)).', 'deep' ),
				'default' => [
					'width' => '',
					'height' => '',
				],
				'condition'     => [
					'type!'     => [
						'9','10','12','13','15','16'
					],
                ],
			]
		);
		$this->add_control(
			'number',
			[
				'label' 		=> esc_html__( 'Number', 'deep' ),
                'type' 			=> Controls_Manager::TEXT,
                'condition'     => [
					'type'     => [
						'13'
					],
                ],
			]
		);
		$this->add_control(
			'name',
			[
				'label' 		=> esc_html__( 'Team Member Name', 'deep' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> esc_html__( 'Member Name' , 'deep' ),
                'condition'     => [
					'type!'     => [
						'9','10','12'
					],
                ],
			]
        );
		$this->add_control(
			'title',
			[
				'label' 		=> esc_html__( 'Team Member Title', 'deep' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> esc_html__( 'Member Title' , 'deep' ),
                'condition'     => [
					'type!'     => [
						'9','10'
					],
                ],
			]
		);
		$this->add_control(
			'text',
			[
				'label' 		=> esc_html__( 'Team Member Description Text', 'deep' ),
                'type' 			=> Controls_Manager::TEXT,
                'condition'     => [
					'type'     => [
						'6'
					],
                ],
			]
		);
		$this->add_control(
			'link',
			[
				'label' 		=> esc_html__( 'Link URL', 'deep' ),
				'type' 			=> Controls_Manager::URL,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> '',
				],
                'condition'     => [
					'type'     => [
						'1','2','3','4','5','6','7','8'
					],
                ],
				'show_external' => true, // Show the 'open in new tab' button.
			]
        );
		$this->add_control(
			'ourteam_content',
			[
				'label' 		=> esc_html__( 'Content', 'deep' ),
				'type' 			=> Controls_Manager::TEXTAREA,
                'rows' 			=> 7,
                'condition'     => [
					'type'     => [
						'7','11','12'
					],
                ],
			]
		);
        $this->add_control(
            'des_top',
            [
                'label'         => esc_html__( 'Description on image', 'deep' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => '',
                'on'            => esc_html__( 'Enable', 'deep' ),
                'off'           => esc_html__( 'Disable', 'deep' ),
                'return_value'  => 'enable',
                'condition'     => [
					'type'     => [
						'8'
					],
                ],
            ]
        );
        $this->add_control(
            'social_type15_var',
            [
                'label'         => esc_html__( 'Social Icons', 'deep' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => '',
                'on'            => esc_html__( 'Enable', 'deep' ),
                'off'           => esc_html__( 'Disable', 'deep' ),
                'return_value'  => 'enable',
                'condition'     => [
					'type'     => [
						'15'
					],
                ],
            ]
        );
		$this->add_control(
			'type15_social',
			[
				'label'			=> __( 'Select Icon', 'deep' ),
				'type'			=> \Elementor\Controls_Manager::ICON,
				'default'		=> 'sl-screen-desktop',
				'condition'     => [
					'type' => [
						'15'
					],
                ],
			]
		);
		$this->add_control(
			'type15_url',
			[
				'label' 		=> esc_html__( 'Social URL', 'deep' ),
				'type' 			=> Controls_Manager::URL,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> '',
				],
                'condition'     => [
					'social_type15_var'     => [
						'enable'
					],
					'type'     => [
						'15'
					],
                ],
				'show_external' => true, // Show the 'open in new tab' button.
			]
		);

        // Social Icons
        $this->add_control(
            'social',
            [
                'label'         => esc_html__( 'Social Icons', 'deep' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => '',
                'on'            => esc_html__( 'Enable', 'deep' ),
                'off'           => esc_html__( 'Disable', 'deep' ),
                'return_value'  => 'enable',
                'condition'     => [
					'type!'     => [
						'8','9','10','11','12','15'
					],
                ],
            ]
        );


		// First Social URL
		$this->add_control(
			'first_url',
			[
				'label' 		=> esc_html__( 'Facebook', 'deep' ),
				'type' 			=> Controls_Manager::URL,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> '',
				],
                'condition'     => [
					'social'     => [
						'enable'
					],
					'type!'     => [
						'8','9','10','11','12','15'
					],
                ],
				'show_external' => true, // Show the 'open in new tab' button.
			]
        );


		// YouTube
		$this->add_control(
			'second_url',
			[
				'label' 		=> esc_html__( 'YouTube', 'deep' ),
				'type' 			=> Controls_Manager::URL,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> '',
				],
                'condition'     => [
					'social'     => [
						'enable'
					],
					'type!'     => [
						'8','9','10','11','12','15'
					],
                ],
				'show_external' => true, // Show the 'open in new tab' button.
			]
        );


		// WhatsApp
		$this->add_control(
			'third_url',
			[
				'label' 		=> esc_html__( 'WhatsApp ', 'deep' ),
				'type' 			=> Controls_Manager::URL,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> '',
				],
                'condition'     => [
					'social'     => [
						'enable'
					],
					'type!'     => [
						'8','9','10','11','12','15'
					],
                ],
				'show_external' => true, // Show the 'open in new tab' button.
			]
        );


		// Instagram
		$this->add_control(
			'fourth_url',
			[
				'label' 		=> esc_html__( 'Instagram ', 'deep' ),
				'type' 			=> Controls_Manager::URL,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> '',
				],
                'condition'     => [
					'social'     => [
						'enable'
					],
					'type!'     => [
						'8','9','10','11','12','15'
					],
                ],
				'show_external' => true, // Show the 'open in new tab' button.
			]
        );

		// Twitter
		$this->add_control(
			'fifth_url',
			[
				'label' 		=> esc_html__( 'Twitter ', 'deep' ),
				'type' 			=> Controls_Manager::URL,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> '',
				],
                'condition'     => [
					'social'     => [
						'enable'
					],
					'type!'     => [
						'8','9','10','11','12','15'
					],
                ],
				'show_external' => true, // Show the 'open in new tab' button.
			]
		);


		// Social Icons
        $this->add_control(
            'social_12',
            [
                'label'         => esc_html__( 'Social Icons', 'deep' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => '',
                'on'            => esc_html__( 'Enable', 'deep' ),
                'off'           => esc_html__( 'Disable', 'deep' ),
                'return_value'  => 'enable',
                'condition'     => [
					'type'     => [
						'12'
					],
                ],
            ]
        );

		$this->add_control(
			'first_social_12',
			[
				'label' => __( 'First Social Name', 'deep' ),
                'type' => Controls_Manager::TEXT,
                'condition'     => [
					'social_12'     => [
						'enable'
					],
					'type'     => [
						'12'
					],
                ],
			]
		);

		// First Social URL
		$this->add_control(
			'first_url_12',
			[
				'label' 		=> esc_html__( 'First Social URL', 'deep' ),
				'type' 			=> Controls_Manager::URL,
				'default' 		=> [
					'url' 			=> '#',
				],
                'condition'     => [
					'social_12'     => [
						'enable'
					],
					'type'     => [
						'12'
					],
                ],
				'show_external' => true, // Show the 'open in new tab' button.
			]
        );

        // Second Social Name
		$this->add_control(
			'second_social_12',
			[
				'label' => __( 'Second Social Name', 'deep' ),
                'type' => Controls_Manager::TEXT,
                'condition'     => [
					'social_12'     => [
						'enable'
					],
					'type'     => [
						'12'
					],
                ],
			]
		);

		// Second Social URL
		$this->add_control(
			'second_url_12',
			[
				'label' 		=> esc_html__( 'Second Social URL', 'deep' ),
				'type' 			=> Controls_Manager::URL,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> '',
				],
                'condition'     => [
					'social_12'     => [
						'enable'
					],
					'type'     => [
						'12'
					],
                ],
				'show_external' => true, // Show the 'open in new tab' button.
			]
        );

        // Third Social Name
		$this->add_control(
			'third_social_12',
			[
				'label' => __( 'Third Social Name', 'deep' ),
                'type' => Controls_Manager::TEXT,
                'condition'     => [
					'social_12'     => [
						'enable'
					],
					'type'     => [
						'12'
					],
                ],
			]
		);

		// Third Social URL
		$this->add_control(
			'third_url_12',
			[
				'label' 		=> esc_html__( 'Third Social URL', 'deep' ),
				'type' 			=> Controls_Manager::URL,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> '',
				],
                'condition'     => [
					'social_12'     => [
						'enable'
					],
					'type'     => [
						'12'
					],
                ],
				'show_external' => true, // Show the 'open in new tab' button.
			]
        );

        // Fourth Social Name
		$this->add_control(
			'fourth_social_12',
			[
				'label' => __( 'Fourth Social Name', 'deep' ),
                'type' => Controls_Manager::TEXT,
                'condition'     => [
					'social_12'     => [
						'enable'
					],
					'type'     => [
						'12'
					],
                ],
			]
		);

		// Fourth Social URL
		$this->add_control(
			'fourth_url_12',
			[
				'label' 		=> esc_html__( 'Fourth Social URL', 'deep' ),
				'type' 			=> Controls_Manager::URL,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> '',
				],
                'condition'     => [
					'social_12'     => [
						'enable'
					],
					'type'     => [
						'12'
					],
                ],
				'show_external' => true, // Show the 'open in new tab' button.
			]
        );

        // Fifth Social Name
		$this->add_control(
			'fifth_social_12',
			[
				'label' => __( 'Fifth Social Name', 'deep' ),
                'type' => Controls_Manager::TEXT,
                'condition'     => [
					'social_12'     => [
						'enable'
					],
					'type'     => [
						'12'
					],
                ],
			]
		);

		// Fifth Social URL
		$this->add_control(
			'fifth_url_12',
			[
				'label' 		=> esc_html__( 'Fifth Social URL', 'deep' ),
				'type' 			=> Controls_Manager::URL,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> '',
				],
                'condition'     => [
					'social_12'     => [
						'enable'
					],
					'type'     => [
						'12'
					],
                ],
				'show_external' => true, // Show the 'open in new tab' button.
			]
		);

		// Auto Play
		$this->add_control(
			'autoplay',
			[
				'label' 		=> esc_html__( 'Enable AutoPlay', 'deep' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Yes', 'deep' ),
				'label_off' 	=> __( 'No', 'deep' ),
				'return_value' 	=> 'yes',
				'condition'    => [
					'type' 	 => [
						'9', '10'
					],
				]
			]
		);

        // Our Team Item
		$this->add_control(
			'ourteam_item_type9',
			[
				'label' 		=> esc_html__( 'Our Team Item', 'deep' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> [
					[
						'name' 			=> 'ourteam_type9_image',
						'label' 		=> esc_html__( 'Select image', 'deep' ),
						'type' 			=> Controls_Manager::MEDIA,
						'default' 		=> [
								'url' 		=> Utils::get_placeholder_image_src(),
						],
					],
					[
						'name' 			=> 'ourteam_type9_name',
						'label' 		=> esc_html__( 'Team Member Name', 'deep' ),
						'type' 			=> Controls_Manager::TEXT,
						'label_block' 	=> true,
					],
					[
						'name' 			=> 'ourteam_type9_title',
						'label' 		=> esc_html__( 'Team Member Title', 'deep' ),
						'type' 			=> Controls_Manager::TEXT,
						'label_block' 	=> true,
					],
					[
						'name' 			=> 'ourteam_type9_link',
						'label' 		=> esc_html__( 'Link URL', 'deep' ),
						'type' 			=> Controls_Manager::URL,
						'default' 		=> [
								'url' 			=> '#',
								'is_external' 	=> '',
						],
						'label_block' 	=> true,
					],
				],
				'default' => [
					[
						'ourteam_type9_name' => __( 'Title #1', 'deep' ),
					],
					[
						'ourteam_type9_name' => __( 'Title #2', 'deep' ),
					],
					[
						'ourteam_type9_name' => __( 'Title #3', 'deep' ),
					],
					[
						'ourteam_type9_name' => __( 'Title #3', 'deep' ),
					],
				],
                'condition'     => [
					'type'     => [
						'9'
					],
                ],
			]
		);

        // Our Team Item
		$this->add_control(
			'ourteam_item_type10',
			[
				'label' 		=> esc_html__( 'Our Team Item', 'deep' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> [
					[
						'name' 			=> 'ourteam_type10_image',
						'label' 		=> esc_html__( 'Select image', 'deep' ),
						'type' 			=> Controls_Manager::MEDIA,
					],
					[
						'name' 			=> 'ourteam_type10_name',
						'label' 		=> esc_html__( 'Team Member Name', 'deep' ),
						'type' 			=> Controls_Manager::TEXT,
						'label_block' 	=> true,
					],
					[
						'name' 			=> 'ourteam_type10_title',
						'label' 		=> esc_html__( 'Team Member Title', 'deep' ),
						'type' 			=> Controls_Manager::TEXT,
						'label_block' 	=> true,
					],
					[
						'name' 			=> 'ourteam_type10_content',
						'label' 		=> __( 'Content', 'deep' ),
						'type' 			=> Controls_Manager::TEXTAREA,
						'admin_label' 	=> true,
					],
					[
						'name'          => 'ourteam_type10_social',
						'label'         => esc_html__( 'Show Social Icons', 'deep' ),
						'type'          => Controls_Manager::SWITCHER,
						'default'       => '',
						'on'            => esc_html__( 'Enable', 'deep' ),
						'off'           => esc_html__( 'Disable', 'deep' ),
						'return_value'  => 'enable',
					],
					[
						'name'          => 'ourteam_type10_first_url',
						'label' 		=> esc_html__( 'Facebook', 'deep' ),
						'type' 			=> Controls_Manager::URL,
						'default' 		=> [
							'url' 			=> '#',
							'is_external' 	=> '',
						],
						'condition'     => [
							'ourteam_type10_social'     => [
								'enable'
							],
						],
						'show_external' => true,
					],
					[
						'name'          => 'ourteam_type10_second_url',
						'label' 		=> esc_html__( 'Youtube', 'deep' ),
						'type' 			=> Controls_Manager::URL,
						'default' 		=> [
							'url' 			=> '#',
							'is_external' 	=> '',
						],
						'condition'     => [
							'ourteam_type10_social'     => [
								'enable'
							],
						],
						'show_external' => true,
					],
					[
						'name'          => 'ourteam_type10_third_url',
						'label' 		=> esc_html__( 'Whats app', 'deep' ),
						'type' 			=> Controls_Manager::URL,
						'default' 		=> [
							'url' 			=> '#',
							'is_external' 	=> '',
						],
						'condition'     => [
							'ourteam_type10_social'     => [
								'enable'
							],
						],
						'show_external' => true,
					],
					[
						'name'          => 'ourteam_type10_fourth_url',
						'label' 		=> esc_html__( 'Instagram', 'deep' ),
						'type' 			=> Controls_Manager::URL,
						'default' 		=> [
							'url' 			=> '#',
							'is_external' 	=> '',
						],
						'condition'     => [
							'ourteam_type10_social'     => [
								'enable'
							],
						],
						'show_external' => true,
					],
					[
						'name'          => 'ourteam_type10_fifth_url',
						'label' 		=> esc_html__( 'Twitter', 'deep' ),
						'type' 			=> Controls_Manager::URL,
						'default' 		=> [
							'url' 			=> '#',
							'is_external' 	=> '',
						],
						'condition'     => [
							'ourteam_type10_social'     => [
								'enable'
							],
						],
						'show_external' => true,
					],
				],
				'default' => [
					[
						'ourteam_type10_title' => __( 'Title #1', 'deep' ),
					],
					[
						'ourteam_type10_title' => __( 'Title #2', 'deep' ),
					],
					[
						'ourteam_type10_title' => __( 'Title #3', 'deep' ),
					],
					[
						'ourteam_type10_title' => __( 'Title #3', 'deep' ),
					],
				],
                'condition'     => [
					'type'     => [
						'10'
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
			'section_name_style',
			[
				'label' => __( 'Member Name', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'name_color',
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} h2,#wrap {{WRAPPER}} h4,#wrap {{WRAPPER}} h3' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'name_typography',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} h2,#wrap {{WRAPPER}} h4,#wrap {{WRAPPER}} h3',
			]
		);

		$this->add_control(
			'name_padding',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} h2,#wrap {{WRAPPER}} h4,#wrap {{WRAPPER}} h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'name_margin',
			[
				'label' 		=> __( 'Margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} h2,#wrap {{WRAPPER}} h4,#wrap {{WRAPPER}} h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Member Title', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} h1,#wrap {{WRAPPER}} h5,#wrap {{WRAPPER}} h6,#wrap {{WRAPPER}} .our-team-title' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'title_typography',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} h1,#wrap {{WRAPPER}} h5,#wrap {{WRAPPER}} h6,#wrap {{WRAPPER}} .our-team-title',
			]
		);

		$this->add_control(
			'title_padding',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} h1,#wrap {{WRAPPER}} h5,#wrap {{WRAPPER}} h6,#wrap {{WRAPPER}} .our-team-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_margin',
			[
				'label' 		=> __( 'Margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} h1,#wrap {{WRAPPER}} h5,#wrap {{WRAPPER}} h6,#wrap {{WRAPPER}} .our-team-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_socials_style',
			[
				'label' => __( 'Member Socials', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'socials_color',
			[
				'label' 		=> __( 'Color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .social-ourteam a i,#wrap {{WRAPPER}} .social-team a i,#wrap {{WRAPPER}} .t-footer a i,#wrap {{WRAPPER}} .our-team-socail a i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'socials_padding',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .social-ourteam a i,#wrap {{WRAPPER}} .social-team a i,#wrap {{WRAPPER}} .t-footer a i,#wrap {{WRAPPER}} .our-team-socail a i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'socials_margin',
			[
				'label' 		=> __( 'Margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .social-ourteam a i,#wrap {{WRAPPER}} .social-team a i,#wrap {{WRAPPER}} .t-footer a i,#wrap {{WRAPPER}} .our-team-socail a i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'social_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' , 'gradient' ],
				'selector' => '#wrap {{WRAPPER}} .social-ourteam a i,#wrap {{WRAPPER}} .social-team a i,#wrap {{WRAPPER}} .t-footer a i,#wrap {{WRAPPER}} .our-team-socail a i',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_box_style',
			[
				'label' => __( 'Member Box', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'box_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' , 'gradient' ],
				'selector' => '#wrap {{WRAPPER}} article',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'box_shadow',
					'label' => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} article',
				]
		);
		$this->add_control(
			'box_padding',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} article' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'box_margin',
			[
				'label' 		=> __( 'Margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} article' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	 * Render Our Team widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings();

		wp_enqueue_style( 'wn-deep-our-team0', DEEP_ASSETS_URL . 'css/frontend/our-team/our-team0.css' );
		wp_enqueue_style( 'wn-deep-our-team' . $settings['type'], DEEP_ASSETS_URL . 'css/frontend/our-team/our-team' . $settings['type'] . '.css' );

		$type 				= $settings['type'] ? $settings['type'] : '' ;
		$img 				= $settings['img']['url'] ? $settings['img']['url'] : '' ;
		$thumbnail_width 	= $settings['thumbnail']['width'] ? $settings['thumbnail']['width'] : '' ;
		$thumbnail_height 	= $settings['thumbnail']['height'] ? $settings['thumbnail']['height'] : '' ;
		$number 			= $settings['number'] ? $settings['number'] : '' ;
		$name 				= $settings['name'] ? $settings['name'] : '' ;
		$title 				= $settings['title'] ? $settings['title'] : '' ;
		$text 				= $settings['text'] ? $settings['text'] : '' ;
		$ourteam_content 	= $settings['ourteam_content'] ? $settings['ourteam_content'] : '' ;
		$des_top 			= $settings['des_top'] ? $settings['des_top'] : '' ;
		$link_url 			= $settings['link']['url'] ? $settings['link']['url'] : '' ;
		$link_target 		= $settings['link']['is_external'] ? 'target="_blank"' : '';
		$nofollow 			= $settings['link']['nofollow'] ? 'rel="nofollow"' : '';

		if ( $settings['autoplay'] == 'yes') {
			$autoplay = 'data-autoplay="true"';
		} else {
			$autoplay = '';
		}
		// socials
		$name_socials = '';
		if ( $settings['social_12'] == 'enable' ) :
			$social1_12 = $social2_12 = $social3_12 = $social4_12 = $social5_12 = '';

			$first_social_12	= $settings['first_social_12'] ? $settings['first_social_12'] : 'social';
			$second_social_12	= $settings['second_social_12'] ? $settings['second_social_12'] : 'social';
			$third_social_12	= $settings['third_social_12'] ? $settings['third_social_12'] : 'social';
			$fourth_social_12	= $settings['fourth_social_12'] ? $settings['fourth_social_12'] : 'social';
			$fifth_social_12	= $settings['fifth_social_12'] ? $settings['fifth_social_12'] : 'social';

			$first_url_external_12 = $settings['first_url_12']['is_external'] ? ' target=_blank' : '';
			$first_url_nofollow_12 = $settings['first_url_12']['nofollow'] ? ' rel=nofollow' : '';

			$second_url_external_12 = $settings['second_url_12']['is_external'] ? ' target=_blank' : '';
			$second_url_nofollow_12 = $settings['second_url_12']['nofollow'] ? ' rel=nofollow' : '';

			$third_url_external_12 = $settings['third_url_12']['is_external'] ? ' target=_blank' : '';
			$third_url_nofollow_12 = $settings['third_url_12']['nofollow'] ? ' rel=nofollow' : '';

			$fourth_url_external_12 = $settings['fourth_url_12']['is_external'] ? ' target=_blank' : '';
			$fourth_url_nofollow_12 = $settings['fourth_url_12']['nofollow'] ? ' rel=nofollow' : '';

			$fifth_url_external_12 = $settings['fifth_url_12']['is_external'] ? ' target=_blank' : '';
			$fifth_url_nofollow_12 = $settings['fifth_url_12']['nofollow'] ? ' rel=nofollow' : '';

			$social1_12 = $settings['first_social_12']  ? '<a href="' . $settings['first_url_12']['url'] . '"  ' . esc_attr( $first_url_external_12 . $first_url_nofollow_12 ) . '>  ' . $first_social_12 . ' </a>' : '';
			$social2_12 = $settings['second_social_12'] ? '<a href="' . $settings['second_url_12']['url'] . '" ' . esc_attr( $second_url_external_12 . $second_url_nofollow_12 ) . '> ' . $second_social_12 . ' </a>' : '';
			$social3_12 = $settings['third_social_12']  ? '<a href="' . $settings['third_url_12']['url']  . '" ' . esc_attr( $third_url_external_12 . $third_url_nofollow_12 ) . '> ' . $third_social_12  . ' </a>' : '';
			$social4_12 = $settings['fourth_social_12'] ? '<a href="' . $settings['fourth_url_12']['url'] . '" ' . esc_attr( $fourth_url_external_12 . $fourth_url_nofollow_12 ) . '> ' . $fourth_social_12 . ' </a>' : '';
			$social5_12 = $settings['fifth_social_12']  ? '<a href="' . $settings['fifth_url_12']['url']  . '" ' . esc_attr( $fifth_url_external_12 . $fifth_url_nofollow_12 ) . '> ' . $fifth_social_12  . ' </a>' : '';
			$name_socials = '<div class="social-ourteam first">' . $social1_12 . $social2_12 . '</div><div class="social-ourteam">' . $social3_12 . $social4_12 . '</div><div class="social-ourteam">' . $social5_12 . '</div>';
		endif;

		// socials
		$socials = '';
		if ( $settings['social'] == 'enable' ) :
			$social1 = $social2 = $social3 = $social4 = $social5 = '';

			$first_url_external = $settings['first_url']['is_external'] ? ' target=_blank' : '';
			$first_url_nofollow = $settings['first_url']['nofollow'] ? ' rel=nofollow' : '';

			$second_url_external = $settings['second_url']['is_external'] ? ' target=_blank' : '';
			$second_url_nofollow = $settings['second_url']['nofollow'] ? ' rel=nofollow' : '';

			$third_url_external = $settings['third_url']['is_external'] ? ' target=_blank' : '';
			$third_url_nofollow = $settings['third_url']['nofollow'] ? ' rel=nofollow' : '';

			$fourth_url_external = $settings['fourth_url']['is_external'] ? ' target=_blank' : '';
			$fourth_url_nofollow = $settings['fourth_url']['nofollow'] ? ' rel=nofollow' : '';

			$fifth_url_external = $settings['fifth_url']['is_external'] ? ' target=_blank' : '';
			$fifth_url_nofollow = $settings['fifth_url']['nofollow'] ? ' rel=nofollow' : '';


			$social1 =  $settings['first_url']['url']   ? '<a href="' . $settings['first_url']['url']  . esc_attr( $first_url_external . $first_url_nofollow ) . '" ><i class="wn-icon wn-fab wn-fa-facebook-f"></i></a>' : '';
			$social2 =  $settings['second_url']['url']  ? '<a href="' . $settings['second_url']['url']  . esc_attr( $second_url_external . $second_url_nofollow ) . '" ><i class="wn-icon wn-fab wn-fa-youtube"></i></a>' : '';
			$social3 =  $settings['third_url']['url']   ? '<a href="' . $settings['third_url']['url']   . esc_attr( $third_url_external . $third_url_nofollow ) . '" ><i class="wn-icon wn-fab wn-fa-whatsapp"></i></a>' : '';
			$social4 =  $settings['fourth_url']['url']  ? '<a href="' . $settings['fourth_url']['url']  . esc_attr( $fourth_url_external . $fourth_url_nofollow ) . '" ><i class="wn-icon wn-fab wn-fa-instagram"></i></a>' : '';
			$social5 =  $settings['fifth_url']['url']   ? '<a href="' . $settings['fifth_url']['url']   . esc_attr( $fifth_url_external . $fifth_url_nofollow ) . '" ><i class="wn-icon wn-fab wn-fa-twitter"></i></a>' : '';
			$socials = '<div class="social-team">' . $social1 . $social2 . $social3 . $social4 . $social5 . '</div>';
		endif;

		$ourteam_item_type9		= $settings['ourteam_item_type9'];
		$ourteam_item_type10	= $settings['ourteam_item_type10'];

		if( !empty( $img ) ) {
			// if main class not exist get it
			if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
				require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
			}
			$image = new \Wn_Img_Maniuplate; // instance from settor class
			$image_url_12 = $image->m_image( $settings['img']['id'] , $img , '822' , '886' ); // set required and get result
		}

		if ( empty( $settings['thumbnail']['width'] ) || empty( $settings['thumbnail']['height'] )  ) {
			if( $type == 3 ) {
				$settings['thumbnail']['width']		= '138';
				$settings['thumbnail']['height']	= '138';
			} elseif( $type == 7 ) {
				$settings['thumbnail']['width']		= '256';
				$settings['thumbnail']['height']	= '256';
			} elseif( $type == 7 ) {
				$settings['thumbnail']['width']		= '346';
				$settings['thumbnail']['height']	= '230';
			} elseif( $type == 10 ) {
				$settings['thumbnail']['width']		= '90';
				$settings['thumbnail']['height']	= '90';
			}
		}
		if ( !empty( $settings['thumbnail']['width'] ) || !empty( $settings['thumbnail']['height'] ) ) {
			// if main class not exist get it
			if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
				require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
			}

			$image = new \Wn_Img_Maniuplate; // instance from settor class

			$img = $image->m_image( $settings['img']['id'] , $settings['img']['url'] , $settings['thumbnail']['width'] , $settings['thumbnail']['height'] ); // set required and get result
		}

		// Class & ID
        $shortcodeclass 	= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
		$shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';

		// link
		$start_link = $end_link = '';
		$a_target = $settings['link']['is_external'] ? 'target=_blank' : '';
		$rel = $settings['link']['nofollow'] ? ' rel=nofollow' : '';

		if ( $settings['link']['url'] ) :
			$start_link = '<a href="' . esc_url($settings['link']['url']) . '" '. esc_attr( $a_target . $rel ) .'>';
			$end_link 	= '</a>';
		endif;
		// render content
		$out = '';
		switch ( $type ) :
			case '3':
				$out .= '
				<article class="our-team3 clearfix ' . $shortcodeclass . '"  ' . $shortcodeid . '>
					<figure>
						<img src="' . esc_url( $img ) . '" alt="' . esc_html( $name ) . '">
					</figure>
					<div class="tdetail">
						' . $start_link . '
							<h2>' . esc_html( $name ) . '</h2>
							<h5>' . esc_html( $title ) . '</h5>
						' . $end_link . '
						' . $socials . '
					</div>
				</article>';
			break;
			case '7':
				$out .= '
					<article class="our-team7 ' . $shortcodeclass . '"  ' . $shortcodeid . '>
						<figure>
							<img src="' . esc_url( $img ) . '" alt="' . esc_html( $name ) . '">
						</figure>
						<figcaption>
							' . $start_link . '
								<h2>' . esc_html( $name ) . '</h2>
								<h5>' . esc_html( $title ) . '</h5>
								<p> ' . $ourteam_content . ' </p>
							' . $end_link . '
						</figcaption>
						<div class="hover-item7">
							' . $socials . '
						</div>
					</article>';
			break;
			case '8':
				if ( $des_top == 'enable' ){
				$out .='
					<article class="our-team8 top ' . $shortcodeclass . '"  ' . $shortcodeid . '>
						'.$start_link.'
						<div class="tdetail">
								<h2>' . esc_html( $name ) . '</h2>
								<h5>' . esc_html( $title ) . '</h5>
						</div>
						<figure>
							<img src="' . esc_url( $img ) . '" alt="' . esc_html( $name ) . '">
						</figure>
						'.$end_link.'
					</article>';
				} else {
				$out .= '
					<article class="our-team8 ' . $shortcodeclass . '"  ' . $shortcodeid . '>
						'.$start_link.'
						<figure>
							<img src="' . esc_url( $img ) . '" alt="' . esc_html( $name ) . '">
						</figure>
						<div class="tdetail">
								<h2>' . esc_html( $name ) . '</h2>
								<h5>' . esc_html( $title ) . '</h5>
						</div>
						'.$end_link.'
					</article>';
				}
			break;
			case '9':
				$out .='
					<article class="ourteam-owl-carousel-type9 owl-carousel owl-theme ' . $shortcodeclass . '"  ' . $shortcodeid . ' ' . $autoplay . '>';

						foreach ( $ourteam_item_type9 as $line ) :

							$ourteam_type9_image		= !empty ( $line['ourteam_type9_image']['url'] ) ? $line['ourteam_type9_image']['url'] : '' ;
							$ourteam_type9_name			= !empty ( $line['ourteam_type9_name'] )  ? $line['ourteam_type9_name']  : '' ;
							$ourteam_type9_title		= !empty ( $line['ourteam_type9_title'] ) ? $line['ourteam_type9_title'] : '' ;
							$ourteam_type9_link			= !empty ( $line['ourteam_type9_link']['url'] )  ? $line['ourteam_type9_link']['url']  : '' ;
							$ourteam_type9_external 	= !empty ( $line['ourteam_type9_link']['is_external'] ) ? 'target="_blank"' : '';
							$ourteam_type9_nofollow 	= !empty ( $line['ourteam_type9_link']['nofollow'] ) ? 'rel="nofollow"' : '';
							if ( !empty (  $ourteam_type9_link  ) ) {
								$out .= '<a href="'.$ourteam_type9_link.'" '.$ourteam_type9_external.' '.$ourteam_type9_nofollow.'>';
							}
							$out .= '
								<div class="ourteam-item">
									<figure>
										<img src="' . $ourteam_type9_image . '"  alt="' . $ourteam_type9_name . '">
									</figure>
									<div class="tdetail">
										<h2 class="colorf">' . $ourteam_type9_name . '</h2>
										<h5>' . $ourteam_type9_title . '</h5>
									</div>
								</div>';
							if ( !empty (  $ourteam_type9_link  ) ) {
								$out .= '</a>';
							}
						endforeach;

			$out .='</article>';
			break;
			case '10':
				$out .='
				<div class="clearfix">
					<div class="col-md-10">
						<article class="ourteam-owl-carousel-type10 owl-carousel owl-theme ' . $shortcodeclass . '"  ' . $shortcodeid . ' ' . $autoplay . '>';
							$ourteam_type10_fourth_social = $ourteam_type10_third_social = $ourteam_type10_second_social = $ourteam_type10_first_social = '';
							foreach ( $ourteam_item_type10 as $line ) :

								$img						= !empty ($line['ourteam_type10_image'] )	? $line['ourteam_type10_image']	:	'';
								$ourteam_type10_image		= !empty ($line['ourteam_type10_image']['url'] )	? $line['ourteam_type10_image']['url']	:	'';
								$thumbnail_id 				= !empty ($line['ourteam_type10_image']['id'] )	? $line['ourteam_type10_image']['id']	:	'';
								$ourteam_type10_name		= !empty ($line['ourteam_type10_name'] )	? $line['ourteam_type10_name']	:	'';
								$ourteam_type10_title		= !empty ($line['ourteam_type10_title'] )	? $line['ourteam_type10_title']	:	'';
								$ourteam_type10_content		= !empty ($line['ourteam_type10_content'] )	? $line['ourteam_type10_content']	:	'';
								$ourteam_type10_social		= !empty ($line['ourteam_type10_social'] )	? $line['ourteam_type10_social'] : '' ;

								if( !empty( $img ) ) {
									// if main class not exist get it
									if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
										require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
									}
									$image = new \Wn_Img_Maniuplate; // instance from settor class
									$ourteam_type10_image2 = $image->m_image( $thumbnail_id , $ourteam_type10_image , '90' , '90' ); // set required and get result
								}

								if ( $ourteam_type10_social == 'enable' ) {
									$ourteam_type10_first_external 	= 	!empty ( $line['ourteam_type10_first_url']['is_external'] ) ? ' target=_blank' : '';
									$ourteam_type10_first_nofollow 	= 	!empty ( $line['ourteam_type10_first_url']['nofollow'] ) ? ' rel=nofollow' : '';
									$ourteam_type10_second_external = 	!empty ( $line['ourteam_type10_second_url']['is_external'] ) ? ' target=_blank' : '';
									$ourteam_type10_second_nofollow = 	!empty ( $line['ourteam_type10_second_url']['nofollow'] ) ? ' rel=nofollow' : '';
									$ourteam_type10_third_external 	= 	!empty ( $line['ourteam_type10_third_url']['is_external'] ) ? ' target=_blank' : '';
									$ourteam_type10_third_nofollow 	= 	!empty ( $line['ourteam_type10_third_url']['nofollow'] ) ? ' rel=nofollow' : '';
									$ourteam_type10_fourth_external = 	!empty ( $line['ourteam_type10_fourth_url']['is_external'] ) ? ' target=_blank' : '';
									$ourteam_type10_fourth_nofollow = 	!empty ( $line['ourteam_type10_fourth_url']['nofollow'] ) ? ' rel=nofollow' : '';
									$ourteam_type10_fifth_external = 	!empty ( $line['ourteam_type10_fifth_url']['is_external'] ) ? ' target=_blank' : '';
									$ourteam_type10_fifth_nofollow = 	!empty ( $line['ourteam_type10_fifth_url']['nofollow'] ) ? ' rel=nofollow' : '';
									$social1 =  !empty( $line['ourteam_type10_first_url']['url'] ) ? '<a href="' . $line['ourteam_type10_first_url']['url'] .'"' . esc_attr( $ourteam_type10_first_external . $ourteam_type10_first_nofollow ) . ' ><i class="wn-icon wn-fab wn-fa-facebook-f"></i></a>' : '';
									$social2 =  !empty( $line['ourteam_type10_second_url']['url'] ) ? '<a href="' . $line['ourteam_type10_second_url']['url'] .'"' . esc_attr( $ourteam_type10_second_external . $ourteam_type10_second_nofollow ) . ' ><i class="wn-icon wn-fab wn-fa-youtube"></i></a>' : '';
									$social3 =  !empty( $line['ourteam_type10_third_url']['url'] ) ? '<a href="' . $line['ourteam_type10_third_url']['url'] .'"'  . esc_attr( $ourteam_type10_third_external . $ourteam_type10_third_nofollow ) . ' ><i class="wn-icon wn-fab wn-fa-whatsapp"></i></a>' : '';
									$social4 =  !empty( $line['ourteam_type10_fourth_url']['url'] ) ? '<a href="' . $line['ourteam_type10_fourth_url']['url'] .'"' . esc_attr( $ourteam_type10_fourth_external . $ourteam_type10_fourth_nofollow ) . ' ><i class="wn-icon wn-fab wn-fa-instagram"></i></a>' : '';
									$social5 =  !empty( $line['ourteam_type10_fifth_url']['url'] ) ? '<a href="' . $line['ourteam_type10_fifth_url']['url'] .'"' . esc_attr( $ourteam_type10_fifth_external . $ourteam_type10_fifth_nofollow ) . ' ><i class="wn-icon wn-fab wn-fa-twitter"></i></a>' : '';
									$socials = '<div class="social-team">' . $social1 . $social2 . $social3 . $social4 . $social5 . '</div>';
								}

								$out .= '
									<div class="ourteam-item">
										<figure>
											<img src="' . esc_url( $ourteam_type10_image2 ) . '"  alt="' . esc_attr( $ourteam_type10_name ) . '">
										</figure>
										<div class="t-detail">
											<h2>' . wp_kses( $ourteam_type10_name, wp_kses_allowed_html( 'post' ) ) . '</h2>
											<h5>' . wp_kses( $ourteam_type10_title, wp_kses_allowed_html( 'post' ) ) . '</h5>
										</div>
										<div class="t-content"><p>' . wp_kses( $ourteam_type10_content, wp_kses_allowed_html( 'post' ) ) . '</p></div>
										<div class="t-footer">' . wp_kses( $socials, wp_kses_allowed_html( 'post' ) ) . '</div>
									</div>';
							endforeach;

						$out .='</article>
					</div>
					<div class="col-md-2"></div>
				</div>';
			break;
			case '11':
				$out .= '
				<article class="our-team11 ' . $shortcodeclass . '"  ' . $shortcodeid . '>
					<div class="img-box">
						<img src="' . esc_url( $img ) . '" alt="' . esc_html( $name ) . '">
					</div>
					<div class="content-box">
						<div class="name-box">
							<span class="grayline"></span>
							<h4 class="colorb">' . esc_html( $name ) . '</h4>
						</div>
						<div class="bottom">
							<h6 class="colorf">' . esc_html( $title ) . '</h6>
							<p> ' . $ourteam_content . ' </p>
						</div>
					</div>
				</article>';
			break;
			case '12':
				$out .= '
				<article class="our-team12 ' . $shortcodeclass . '"  ' . $shortcodeid . '>
					<div class="img-box">
						<img src="' . esc_url( $image_url_12 ) . '" alt="' . esc_html( $title ) . '">
					</div>
					<div class="content-box colorb">
					<span class="thisline"></span>
						<h1>' . esc_html( $title ) . '</h1>
						<p> ' . $ourteam_content . ' </p>
							' . $name_socials . '
					</div>
				</article>';
			break;
			case '13':

				$out .= '
				<article class="our-team13 ' . $shortcodeclass . '"  ' . $shortcodeid . '>
					<img src="' . esc_url( $image_url_12 ) . '" alt="' . esc_html( $title ) . '">
					<span class="our-team-hover"></span>
					<span class="our-team-num">' . $number . '</span>
					<div class="content-box">
						<h3 class="our-team-name colorf">' . esc_html( $name ) . '</h3>
						<p class="our-team-title"> ' . $title . ' </p>
						<div class="our-team-socail">   ' . $socials . ' </div>
					</div>
				</article>';
			break;
			case '14':
				$out .= '
				<article class="our-team14 ' . $shortcodeclass . '"  ' . $shortcodeid . '>
					<img src="' . esc_url( $img ) . '" alt="' . esc_html( $title ) . '">
					<div class="content-box">
						<h3 class="our-team-name">' . esc_html( $name ) . '</h3>
						<p class="our-team-title"> ' . $title . ' </p>
						<div class="our-team-socail">   ' . $socials . ' </div>
					</div>
				</article>';
			break;
			case '15':

				$social_type15_var	= $settings['social_type15_var'] ? $settings['social_type15_var'] : '' ;
				$type15_social = '';
				if ( $social_type15_var == 'enable' ) {
					$type15_social		= $settings['type15_social'] ?	$settings['type15_social'] : '' ;
					$type15_url			= $settings['type15_url']['url'] ?	$settings['type15_url']['url'] : '' ;
					$type15_link_target = $settings['type15_url']['is_external'] ? 'target="_blank"' : '';
					$type15_nofollow 	= $settings['type15_url']['nofollow'] ? 'rel="nofollow"' : '';
				}

				$social1 = '';

				if ( $social_type15_var == 'enable' ) {
					if ( !empty( $type15_social ) ) {
						$social1 = '<a href="' . esc_url( $type15_url ) . '" '.$type15_link_target.' '.$type15_nofollow.'>
						<i class="' . $type15_social . '"></i></a>';
					} else {
						$social1 = '<i class="fa-' . $type15_social . '"></i>';
					}
				}


				$social_class = strpos( $type15_social, 'wn-fab wn-fa-' ) !== false ? str_replace( 'wn-fab wn-fa-', '', $type15_social) : $type15_social;
				$out .= '
				<article class="our-team15 ' . $shortcodeclass . '"  ' . $shortcodeid . '>
					<figure>
						<div class="img-wrapper">
							<img src="' . esc_url( $img ) . '" alt="' . esc_html( $name ) . '">
							<div class="social-team ' . $social_class . '">' . $social1 . '</div>
						</div>
						<figcaption>
							<h2>' . esc_html( $name ) . '</h2>
							<h5>' . esc_html( $title ) . '</h5>
						</figcaption>
					</figure>
				</article>';

			break;
			case '16':
				$out .= '
				<article class="our-team16 ' . $shortcodeclass . '"  ' . $shortcodeid . '>
					<img src="' . esc_url( $img ) . '" alt="' . esc_html( $title ) . '">
					<div class="content-box">
						<h3 class="our-team-name">' . esc_html( $name ) . '</h3>
						<p class="our-team-title"> ' . $title . ' </p>
						<div class="our-team16-share">
						<i class="sl-share hcolorf"></i>
						<div class="our-team16-socail">' . $socials . '</div>
						</div>
					</div>
				</article>';
			break;
			// other types
			default:
				// description text
				$text = ( $settings['text'] && $type == '6' ) ? '<p>' . esc_html( $settings['text'] ) . '</p>' : '';
				$out .= '
				<article class="our-team' . $type . ' ' . $shortcodeclass . '"  ' . $shortcodeid . '>
					<figure>';
				if ( !empty($img) ) {
					$out .= '<img src="' . esc_url( $img ) . '" alt="' . esc_html( $name ) . '">';
				}
				$out .= $start_link . '
							<figcaption>
								<h2>' . esc_html( $name ) . '</h2>
								<h5>' . esc_html( $title ) . '</h5>
							</figcaption>
						' . $end_link . '
					</figure>
					' . $text . '
					' . $socials . '
				</article>';
			break;
		endswitch;

		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}

		echo $out;

	}

}
