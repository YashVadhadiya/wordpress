<?php
namespace Elementor;

use Elementor\Controls_Manager;

class Webnus_Element_Widgets_Testimonial_Slider extends \Elementor\Widget_Base {

	/**
	 * Retrieve Testimonial Slider widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'testimonial_slider';

	}

	/**
	 * Retrieve Testimonial Slider widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Testimonial Slider', 'deep' );

	}

	/**
	 * Retrieve Testimonial Slider widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-testimonial-carousel';

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

		return [ 'deep-owl-carousel', 'deep-testimonial-slider' ];

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
	 * Register Testimonial Slider widget controls.
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

		// Select Testimonial Slider Type
		$this->add_control(
			'type',
			[
				'label' 	    => esc_html__( 'Type', 'deep' ),
				'type' 		    => Controls_Manager::SELECT,
				'default' 	    => 'mono',
				'options' 	    => [
                        'mono'      => esc_html__( 'One', 'deep' ),
                        'di'        => esc_html__( 'Two', 'deep' ),
                        'tri'       => esc_html__( 'Three', 'deep' ),
                        'tetra'     => esc_html__( 'Four', 'deep' ),
                        'penta'     => esc_html__( 'Five', 'deep' ),
                        'hexa'      => esc_html__( 'Six', 'deep' ),
                        'hepta'     => esc_html__( 'Seven', 'deep' ),
                        'octa'      => esc_html__( 'Eight', 'deep' ),
                        'nona'      => esc_html__( 'Nine', 'deep' ),
                        'deca'      => esc_html__( 'Ten', 'deep' ),
                        'undeca'    => esc_html__( 'Eleven', 'deep' ),
                        'dodeca'    => esc_html__( 'Twelve', 'deep' ),
                ],
                'description'   => wp_kses( __( 'You can choose from these pre-designed types. <a href="http://deeptem.com/features/carousels/testimonial-slider/" target="_blank">View All Types</a>', 'deep'), deep_kses() ),
			]
        );

        // Type 1
        $this->add_control(
			'custom_dimension_type_1',
			[
				'label'       => __( 'Image Dimension', 'deep' ),
				'type'        => Controls_Manager::IMAGE_DIMENSIONS,
				'description' => __( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'plugin-name' ),
				'default' => [
					'width'  => '140',
					'height' => '140',
                ],
                'condition' => [
                    'type'   => 'mono',
                ],
			]
        );

        // Type 2
        $this->add_control(
			'custom_dimension_type_2',
			[
				'label'       => __( 'Image Dimension', 'deep' ),
				'type'        => Controls_Manager::IMAGE_DIMENSIONS,
				'description' => __( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'plugin-name' ),
				'default' => [
					'width'  => '500',
					'height' => '500',
                ],
                'condition' => [
                    'type'   => 'di',
                ],
			]
        );

        // Type 3
        $this->add_control(
			'custom_dimension_type_3',
			[
				'label'       => __( 'Image Dimension', 'deep' ),
				'type'        => Controls_Manager::IMAGE_DIMENSIONS,
				'description' => __( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'plugin-name' ),
				'default' => [
					'width'  => '120',
					'height' => '120',
                ],
                'condition' => [
                    'type'   => 'tri',
                ],
			]
		);

        // Type 4
        $this->add_control(
			'custom_dimension_type_4',
			[
				'label'       => __( 'Image Dimension', 'deep' ),
				'type'        => Controls_Manager::IMAGE_DIMENSIONS,
				'description' => __( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'plugin-name' ),
				'default' => [
					'width'  => '76',
					'height' => '76',
                ],
                'condition' => [
                    'type'   => 'tetra',
                ],
			]
        );

        // Type 5
        $this->add_control(
			'custom_dimension_type_5',
			[
				'label'       => __( 'Image Dimension', 'deep' ),
				'type'        => Controls_Manager::IMAGE_DIMENSIONS,
				'description' => __( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'plugin-name' ),
				'default' => [
					'width'  => '140',
					'height' => '140',
                ],
                'condition' => [
                    'type'   => 'penta',
                ],
			]
        );

        // Type 6
        $this->add_control(
			'custom_dimension_type_6',
			[
				'label'       => __( 'Image Dimension', 'deep' ),
				'type'        => Controls_Manager::IMAGE_DIMENSIONS,
				'description' => __( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'plugin-name' ),
				'default' => [
					'width'  => '70',
					'height' => '70',
                ],
                'condition' => [
                    'type'   => 'hexa',
                ],
			]
        );

        // Type 7
        $this->add_control(
			'custom_dimension_type_7',
			[
				'label'       => __( 'Image Dimension', 'deep' ),
				'type'        => Controls_Manager::IMAGE_DIMENSIONS,
				'description' => __( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'plugin-name' ),
				'default' => [
					'width'  => '200',
					'height' => '200',
                ],
                'condition' => [
                    'type'   => 'hepta',
                ],
			]
        );

        // Type 9
        $this->add_control(
			'custom_dimension_type_9',
			[
				'label'       => __( 'Image Dimension', 'deep' ),
				'type'        => Controls_Manager::IMAGE_DIMENSIONS,
				'description' => __( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'plugin-name' ),
				'default' => [
					'width'  => '120',
					'height' => '120',
                ],
                'condition' => [
                    'type'   => 'nona',
                ],
			]
		);

        // Type 10
        $this->add_control(
			'custom_dimension_type_10',
			[
				'label'       => __( 'Image Dimension', 'deep' ),
				'type'        => Controls_Manager::IMAGE_DIMENSIONS,
				'description' => __( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'plugin-name' ),
				'default' => [
					'width'  => '500',
					'height' => '500',
                ],
                'condition' => [
                    'type'   => 'deca',
                ],
			]
        );

        // Type 12
        $this->add_control(
			'custom_dimension_type_12',
			[
				'label'       => __( 'Image Dimension', 'deep' ),
				'type'        => Controls_Manager::IMAGE_DIMENSIONS,
				'description' => __( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'plugin-name' ),
				'default' => [
					'width'  => '120',
					'height' => '120',
                ],
                'condition' => [
                    'type'   => 'dodeca',
                ],
			]
        );


		// Upload Image
		$this->add_control(
			'testimonial_img_octa',
			[
				'label' 		=> esc_html__( 'Choose Image', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA, //type
                'default' 		=> [
                    'url' 		=> \Elementor\Utils::get_placeholder_image_src(),
                ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-slider-owl-carousel.ts-octa' => 'background-image: url({{URL}}); background-repeat: no-repeat;',
                ],
                'condition'     => [
                    'type'     => [
                        'octa',
                    ],
                ],
			]
		);

		// Background Color
		$this->add_control(
			'testimonial_bgcolor',
			[
				'label' 		=> esc_html__( 'Background Color', 'deep' ),
				'type' 			=> Controls_Manager::COLOR,
						'scheme' 		=> [
							'type'  => \Elementor\Core\Schemes\Color::get_type(),
                            'value' => \Elementor\Core\Schemes\Color::COLOR_1,
						],
				'default' 		=> 'rgba(67,125,249,0.88)',
				'selectors' 	=> [
							'{{WRAPPER}} .testimonial-slider-owl-carousel.ts-octa .owl-stage-outer' => 'background-color: {{VALUE}}',
                ],
                'condition'     => [
                        'type'     => [
                            'octa',
                        ],
                ],
			]
		);

		// Repeater For :: mono, di, tri, tetra, penta, hexa, hepta, deca
		$this->add_control(
			'testimonial_item',
			[
				'label' 		=> esc_html__( 'Testimonial Item', 'deep' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> [
						[
							'name' 			=> 'testimonial_name',
							'label' 		=> esc_html__( 'Name', 'deep' ),
							'type' 			=> Controls_Manager::TEXT,
							'label_block' 	=> true,
						],
                        [
                            'name' 			=> 'testimonial_img_id',
                            'label' 		=> esc_html__( 'Image', 'deep' ),
                            'type' 			=> Controls_Manager::MEDIA,
                        ],
						[
							'name' 			=> 'testimonial_subtitle',
							'label' 		=> esc_html__( 'Subtitle', 'deep' ),
							'type' 			=> Controls_Manager::TEXT,
							'label_block' 	=> true,
						],
						[
							'name' 			=> 'testimonial_content',
							'label' 		=> esc_html__( 'Content', 'deep' ),
                            'type'          => Controls_Manager::TEXTAREA,
                            'label_block' 	=> true,
                        ],
                        [
                            'name'          => 'testimonial_first_social',
                            'label'         => esc_html__( 'First Social Name', 'deep' ),
                            'type'          => Controls_Manager::ICON,
                            'include'       => [
                                'wn-icon wn-fab wn-fa-twitter',
                                'wn-icon wn-fab wn-fa-facebook',
                                'wn-icon wn-fab wn-fa-vimeo',
                                'wn-icon wn-fab wn-fa-dribbble',
                                'wn-icon wn-fab wn-fa-youtube',
                                'wn-icon wn-fab wn-fa-pinterest',
                                'wn-icon wn-fab wn-fa-linkedin',
                                'wn-icon wn-fab wn-fa-instagram',
                            ],
                        ],
                        [
                            'name'          => 'testimonial_first_url',
                            'label' 		=> esc_html__( 'First Social URL', 'deep' ),
                            'type' 			=> Controls_Manager::URL,
                            'default' 		=> [
                                    'url' 			=> '',
                                    'is_external' 	=> '',
                            ],
                            'show_external' => true,
                        ],
                        [
                            'name'          => 'testimonial_second_social',
                            'label'         => esc_html__( 'Second Social Name', 'deep' ),
                            'type'          => Controls_Manager::ICON,
                            'include'       => [
                                'wn-icon wn-fab wn-fa-twitter',
                                'wn-icon wn-fab wn-fa-facebook',
                                'wn-icon wn-fab wn-fa-vimeo',
                                'wn-icon wn-fab wn-fa-dribbble',
                                'wn-icon wn-fab wn-fa-youtube',
                                'wn-icon wn-fab wn-fa-pinterest',
                                'wn-icon wn-fab wn-fa-linkedin',
                                'wn-icon wn-fab wn-fa-instagram',
                            ],
                        ],
                        [
                            'name'          => 'testimonial_second_url',
                            'label' 		=> esc_html__( 'Second Social URL', 'deep' ),
                            'type' 			=> Controls_Manager::URL,
                            'default' 		=> [
                                    'url' 			=> '',
                                    'is_external' 	=> '',
                            ],
                            'show_external' => true,
                        ],
                        [
                            'name'          => 'testimonial_third_social',
                            'label'         => esc_html__( 'Third Social Name', 'deep' ),
                            'type'          => Controls_Manager::ICON,
                           'include'       => [
                                'wn-icon wn-fab wn-fa-twitter',
                                'wn-icon wn-fab wn-fa-facebook',
                                'wn-icon wn-fab wn-fa-vimeo',
                                'wn-icon wn-fab wn-fa-dribbble',
                                'wn-icon wn-fab wn-fa-youtube',
                                'wn-icon wn-fab wn-fa-pinterest',
                                'wn-icon wn-fab wn-fa-linkedin',
                                'wn-icon wn-fab wn-fa-instagram',
                            ],
                        ],
                        [
                            'name'          => 'testimonial_third_url',
                            'label' 		=> esc_html__( 'Third Social URL', 'deep' ),
                            'type' 			=> Controls_Manager::URL,
                            'default' 		=> [
                                    'url' 			=> '',
                                    'is_external' 	=> '',
                            ],
                            'show_external' => true,
                        ],
                        [
                            'name'          => 'testimonial_fourth_social',
                            'label'         => esc_html__( 'Fourth Social Name', 'deep' ),
                            'type'          => Controls_Manager::ICON,
                            'include'       => [
                                'wn-icon wn-fab wn-fa-twitter',
                                'wn-icon wn-fab wn-fa-facebook',
                                'wn-icon wn-fab wn-fa-vimeo',
                                'wn-icon wn-fab wn-fa-dribbble',
                                'wn-icon wn-fab wn-fa-youtube',
                                'wn-icon wn-fab wn-fa-pinterest',
                                'wn-icon wn-fab wn-fa-linkedin',
                                'wn-icon wn-fab wn-fa-instagram',
                            ],
                        ],
                        [
                            'name'          => 'testimonial_fourth_url',
                            'label' 		=> esc_html__( 'Fourth Social URL', 'deep' ),
                            'type' 			=> Controls_Manager::URL,
                            'default' 		=> [
                                    'url' 			=> '',
                                    'is_external' 	=> '',
                            ],
                            'show_external' => true,
                        ],
                ],
                'default' => [
					[
						'testimonial_content' => __( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'deep' ),
					],
					[
						'testimonial_content' => __( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'deep' ),
                    ],
                    [
						'testimonial_content' => __( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'deep' ),
					],
				],
                'condition'     => [
                        'type'     => [
                            'mono', 'di', 'tri', 'tetra', 'penta', 'hexa', 'hepta', 'deca',
                        ],
                ],
			]
		);

		// Repeater For :: octa
		$this->add_control(
			'testimonial_item_octa',
			[
				'label' 		=> esc_html__( 'Testimonial Item', 'deep' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> [
						[
							'name' 			=> 'testimonial_name_octa',
							'label' 		=> esc_html__( 'Name', 'deep' ),
							'type' 			=> Controls_Manager::TEXT,
							'label_block' 	=> true,
						],
						[
							'name' 			=> 'testimonial_subtitle_octa',
							'label' 		=> esc_html__( 'Subtitle', 'deep' ),
							'type' 			=> Controls_Manager::TEXT,
							'label_block' 	=> true,
						],
						[
							'name' 			=> 'testimonial_content_octa',
							'label' 		=> esc_html__( 'Content', 'deep' ),
                            'type'          => Controls_Manager::TEXTAREA,
                            'label_block' 	=> true,
                        ],
                ],
                'default' => [
                    [
						'testimonial_content_octa' => __( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'deep' ),
					],
				],
                'condition'     => [
                        'type'     => [
                            'octa',
                        ],
                ],
			]
		);

		// Repeater For :: nona, dodeca
		$this->add_control(
			'testimonial_item_two',
			[
				'label' 		=> esc_html__( 'Testimonial Item', 'deep' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> [
						[
							'name' 			=> 'testimonial_name_two',
							'label' 		=> esc_html__( 'Name', 'deep' ),
							'type' 			=> Controls_Manager::TEXT,
							'label_block' 	=> true,
                        ],
                        [
                            'name' 			=> 'testimonial_img_id_two',
                            'label' 		=> esc_html__( 'Image', 'deep' ),
                            'type' 			=> Controls_Manager::MEDIA,
                        ],
						[
							'name' 			=> 'testimonial_title_two',
							'label' 		=> esc_html__( 'Title', 'deep' ),
							'type' 			=> Controls_Manager::TEXT,
							'label_block' 	=> true,
						],
						[
							'name' 			=> 'testimonial_subtitle_two',
							'label' 		=> esc_html__( 'Subtitle', 'deep' ),
							'type' 			=> Controls_Manager::TEXT,
							'label_block' 	=> true,
						],
						[
							'name' 			=> 'testimonial_content_two',
							'label' 		=> esc_html__( 'Content', 'deep' ),
                            'type'          => Controls_Manager::TEXTAREA,
                            'label_block' 	=> true,
                        ],
				],
                'condition'     => [
                        'type'     => [
                            'nona', 'dodeca',
                        ],
                ],
			]
		);

		// Repeater For :: undeca
		$this->add_control(
			'testimonial_item_eleven',
			[
				'label' 		=> esc_html__( 'Testimonial Item', 'deep' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> [
						[
							'name' 			=> 'tc_content_t11',
							'label' 		=> esc_html__( 'Content', 'deep' ),
                            'type'          => Controls_Manager::TEXTAREA,
                            'label_block' 	=> true,
                        ],
                        [
                            'name'          => 'first_social',
                            'label'         => esc_html__( 'First Social Name', 'deep' ),
                            'type'          => Controls_Manager::ICON,
                           'include'       => [
                                'wn-icon wn-fab wn-fa-twitter',
                                'wn-icon wn-fab wn-fa-facebook',
                                'wn-icon wn-fab wn-fa-vimeo',
                                'wn-icon wn-fab wn-fa-dribbble',
                                'wn-icon wn-fab wn-fa-youtube',
                                'wn-icon wn-fab wn-fa-pinterest',
                                'wn-icon wn-fab wn-fa-linkedin',
                                'wn-icon wn-fab wn-fa-instagram',
                            ],
                        ],
                        [
                            'name'          => 'first_url',
                            'label' 		=> esc_html__( 'First Social URL', 'deep' ),
                            'type' 			=> Controls_Manager::URL,
                            'default' 		=> [
                                    'url' 			=> '',
                                    'is_external' 	=> '',
                            ],
                            'show_external' => true,
                        ],
                        [
                            'name'          => 'second_social',
                            'label'         => esc_html__( 'Second Social Name', 'deep' ),
                            'type'          => Controls_Manager::ICON,
                            'include'       => [
                                'wn-icon wn-fab wn-fa-twitter',
                                'wn-icon wn-fab wn-fa-facebook',
                                'wn-icon wn-fab wn-fa-vimeo',
                                'wn-icon wn-fab wn-fa-dribbble',
                                'wn-icon wn-fab wn-fa-youtube',
                                'wn-icon wn-fab wn-fa-pinterest',
                                'wn-icon wn-fab wn-fa-linkedin',
                                'wn-icon wn-fab wn-fa-instagram',
                            ],
                        ],
                        [
                            'name'          => 'second_url',
                            'label' 		=> esc_html__( 'Second Social URL', 'deep' ),
                            'type' 			=> Controls_Manager::URL,
                            'default' 		=> [
                                    'url' 			=> '',
                                    'is_external' 	=> '',
                            ],
                            'show_external' => true,
                        ],
                        [
                            'name'          => 'third_social',
                            'label'         => esc_html__( 'Third Social Name', 'deep' ),
                            'type'          => Controls_Manager::ICON,
                            'include'       => [
                                'wn-icon wn-fab wn-fa-twitter',
                                'wn-icon wn-fab wn-fa-facebook',
                                'wn-icon wn-fab wn-fa-vimeo',
                                'wn-icon wn-fab wn-fa-dribbble',
                                'wn-icon wn-fab wn-fa-youtube',
                                'wn-icon wn-fab wn-fa-pinterest',
                                'wn-icon wn-fab wn-fa-linkedin',
                                'wn-icon wn-fab wn-fa-instagram',
                            ],
                        ],
                        [
                            'name'          => 'third_url',
                            'label' 		=> esc_html__( 'Third Social URL', 'deep' ),
                            'type' 			=> Controls_Manager::URL,
                            'default' 		=> [
                                    'url' 			=> '',
                                    'is_external' 	=> '',
                            ],
                            'show_external' => true,
                        ],
                        [
                            'name'          => 'fourth_social',
                            'label'         => esc_html__( 'Fourth Social Name', 'deep' ),
                            'type'          => Controls_Manager::ICON,
                            'include'       => [
                                'wn-icon wn-fab wn-fa-twitter',
                                'wn-icon wn-fab wn-fa-facebook',
                                'wn-icon wn-fab wn-fa-vimeo',
                                'wn-icon wn-fab wn-fa-dribbble',
                                'wn-icon wn-fab wn-fa-youtube',
                                'wn-icon wn-fab wn-fa-pinterest',
                                'wn-icon wn-fab wn-fa-linkedin',
                                'wn-icon wn-fab wn-fa-instagram',
                            ],
                        ],
                        [
                            'name'          => 'fourth_url',
                            'label' 		=> esc_html__( 'Fourth Social URL', 'deep' ),
                            'type' 			=> Controls_Manager::URL,
                            'default' 		=> [
                                    'url' 			=> '',
                                    'is_external' 	=> '',
                            ],
                            'show_external' => true,
                        ],
				],
                'condition'     => [
                        'type'     => [
                            'undeca',
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
				'label' => __( 'Content Style', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'content_typography',
				'label' 	=> __( 'Content Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .testimonial-slider-owl-carousel .testimonial-content q,#wrap {{WRAPPER}} .testimonial-slider-owl-carousel .testimonial-content p',
			]
        );

        $this->add_control(
			'content_color',
			[
				'label' 		=> __( 'Content color', 'deep' ), //heading
				'type' 			=> Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .testimonial-slider-owl-carousel .testimonial-content q,#wrap {{WRAPPER}} .testimonial-slider-owl-carousel .testimonial-content p' => 'color: {{VALUE}}',
				],
			]
        );

        $this->add_control(
			'content_padding', //param_name
			[
				'label' 		=> __( 'Content Padding', 'deep' ), //heading
				'type' 			=> Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .testimonial-slider-owl-carousel .testimonial-content q,#wrap {{WRAPPER}} .testimonial-slider-owl-carousel .testimonial-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_margin', //param_name
			[
				'label' 		=> __( 'Content Margin', 'deep' ), //heading
				'type' 			=> Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .testimonial-slider-owl-carousel .testimonial-content q,#wrap {{WRAPPER}} .testimonial-slider-owl-carousel .testimonial-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'name'     => 'background_solid',
				'label'    => __( 'Background', 'deep' ),
				'types'    => [ 'classic' , 'gradient' ],
				'selector' => '#wrap {{WRAPPER}} .testimonial-slider-owl-carousel .testimonial-content',
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
					'#wrap {{WRAPPER}} .testimonial-slider-owl-carousel .testimonial-content' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .testimonial-slider-owl-carousel .testimonial-content',
			]
		);
		$this->add_control(
			'box_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .testimonial-slider-owl-carousel .testimonial-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .testimonial-slider-owl-carousel .testimonial-content',
				]
		);
		$this->add_control(
			'box_padding',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .testimonial-slider-owl-carousel .testimonial-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .testimonial-slider-owl-carousel .testimonial-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .testimonial-slider-owl-carousel .testimonial-content' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .testimonial-slider-owl-carousel .testimonial-content' => 'overflow: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'hover1',
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
				'selector' => '#wrap {{WRAPPER}} .testimonial-slider-owl-carousel .testimonial-content:hover',
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
					'#wrap {{WRAPPER}} .testimonial-slider-owl-carousel .testimonial-content:hover' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border_hover',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .testimonial-slider-owl-carousel .testimonial-content:hover',
			]
		);
		$this->add_control(
			'box_border_radius_hover',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .testimonial-slider-owl-carousel .testimonial-content:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow_hover',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .testimonial-slider-owl-carousel .testimonial-content:hover',
				]
		);
		$this->add_control(
			'box_padding_hover',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .testimonial-slider-owl-carousel .testimonial-content:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .testimonial-slider-owl-carousel .testimonial-content:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .testimonial-slider-owl-carousel .testimonial-content:hover' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->end_controls_section();

        // Custom css tab
		$this->start_controls_section(
			'custom_css_section',
			[
				'label' => __( 'Custom CSS', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'custom_css',
			[
				'label' => __( 'Custom CSS', 'deep' ),
				'type' => Controls_Manager::CODE,
				'language' => 'css',
				'rows' => 20,
				'show_label' => true,
			]
		);

        $this->end_controls_section();

	}

	/**
	 * Render Testimonial Slider widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

        $settings = $this->get_settings();

        switch ($settings['type']) {
            case 'mono':
                $style_type = '1';
                break;
            case 'di':
                $style_type = '2';
                break;
            case 'tri':
                $style_type = '3';
                break;
            case 'tetra':
                $style_type = '4';
                break;
            case 'penta':
                $style_type = '5';
                break;
            case 'hexa':
                $style_type = '6';
                break;
            case 'hepta':
                $style_type = '7';
                break;
            case 'octa':
                $style_type = '8';
                break;
            case 'nona':
                $style_type = '9';
                break;
            case 'deca':
                $style_type = '10';
                break;
            case 'undeca':
                $style_type = '11';
                break;
            case 'dodeca':
                $style_type = '12';
                break;
        }

        wp_enqueue_style( 'wn-deep-testimonial-slider0', DEEP_ASSETS_URL . 'css/frontend/testimonial-slider/testimonial-slider0.css' );
        wp_enqueue_style( 'wn-deep-testimonial-slider' . $style_type, DEEP_ASSETS_URL . 'css/frontend/testimonial-slider/testimonial-slider' . $style_type . '.css' );

        $type = $settings['type'];

        $live_page_builders_css = '';

        $testimonial_item               = $settings['testimonial_item'];
        $testimonial_item_octa          = $settings['testimonial_item_octa'];
        $testimonial_item_two           = $settings['testimonial_item_two'];
        $testimonial_item_eleven        = $settings['testimonial_item_eleven'];
        $out                            = '';
        // Class & ID
        $shortcodeclass 	= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
        $shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';
        $n_img = '';

        // Render
        if ( $type == 'undeca') {
            $out .= '<div class="testimonial-slider-'.$type.' colorb">';
        }

        $out .= '
            <div class="testimonial-slider-owl-carousel owl-carousel owl-theme ts-' . $type . ' ts-' . $type .' ' . $shortcodeclass . '"  ' . $shortcodeid . '>';

                foreach ( $testimonial_item as $line ) :

                    $testimonial_name               = isset( $line['testimonial_name'] ) ? $line['testimonial_name']   : '';
                    $testimonial_img_id             = isset( $line['testimonial_img_id'] ) ? $line['testimonial_img_id']['url'] : '';
                    $thumbnail_id                   = isset( $line['testimonial_img_id'] ) ? $line['testimonial_img_id']['id'] : '';
                    $testimonial_subtitle           = isset( $line['testimonial_subtitle'] ) ? $line['testimonial_subtitle']   : '';
                    $testimonial_content            = isset( $line['testimonial_content'] ) ? $line['testimonial_content']    : '';
                    $testimonial_first_social       = isset( $line['testimonial_first_social'] ) ? $line['testimonial_first_social']   : '';
                    $testimonial_first_url          = isset( $line['testimonial_first_url'] ) ? $line['testimonial_first_url']['url']  : '';
                    $testimonial_second_social      = isset( $line['testimonial_second_social'] ) ? $line['testimonial_second_social']  : '';
                    $testimonial_second_url         = isset( $line['testimonial_second_url'] ) ? $line['testimonial_second_url']['url'] : '';
                    $testimonial_third_social       = isset( $line['testimonial_third_social'] ) ? $line['testimonial_third_social']   : '';
                    $testimonial_third_url          = isset( $line['testimonial_third_url'] ) ? $line['testimonial_third_url']['url']  : '';
                    $testimonial_fourth_social      = isset( $line['testimonial_fourth_social'] ) ? $line['testimonial_fourth_social']  : '';
                    $testimonial_fourth_url         = isset( $line['testimonial_fourth_url'] ) ? $line['testimonial_fourth_url']['url'] : '';

                    if( is_numeric( $testimonial_img_id ) )
                        $testimonial_img_id = wp_get_attachment_url( $testimonial_img_id );

                    $socialvar = '';
                    if( $testimonial_first_url || $testimonial_second_url ||  $testimonial_third_url || $testimonial_fourth_url ) :
                        $socialvar .= '<div class="social-testimonial"><ul>';

                    if( !empty( $testimonial_first_url ) )
                        $socialvar .= '<li class="first-social"><a href="'. esc_url($testimonial_first_url) .'"><i class="'. $testimonial_first_social .'"></i></a></li>';

                    if(!empty($testimonial_second_url))
                        $socialvar .= '<li class="second-social"><a href="'. esc_url($testimonial_second_url) .'"><i class="'. $testimonial_second_social .'"></i></a></li>';

                    if(!empty($testimonial_third_url))
                        $socialvar .= '<li class="third-social"><a href="'. esc_url($testimonial_third_url) .'"><i class="'.  $testimonial_third_social .'"></i></a></li>';

                    if(!empty($testimonial_fourth_url))
                        $socialvar .= '<li class="fourth-social"><a href="'. esc_url($testimonial_fourth_url) .'"><i class="'. $testimonial_fourth_social .'"></i></a></li>';

                    $socialvar .= '</ul></div>';
                    endif;

                    if ( $type == 'mono' || $type == 'di' || $type == 'tri' || $type == 'tetra' || $type == 'penta' || $type == 'hexa' || $type == 'hepta') {

                        if ( $settings['type'] == 'deca' ) {
                            if( !empty( $testimonial_img_id ) ) {
                                if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                                    require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
                                }
                                $image = new \Wn_Img_Maniuplate;
                                $testimonial_img_id = $image->m_image( $thumbnail_id, $testimonial_img_id , $settings['custom_dimension_type_1']['width'] , $settings['custom_dimension_type_1']['height'] );
                            }
                        }

                        if ( $settings['type'] == 'mono' ) {
                            if( !empty( $testimonial_img_id ) ) {
                                if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                                    require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
                                }
                                $image = new \Wn_Img_Maniuplate;
                                $testimonial_img_id = $image->m_image( $thumbnail_id, $testimonial_img_id , $settings['custom_dimension_type_1']['width'] , $settings['custom_dimension_type_1']['height'] );
                            }
                        }

                        if ( $settings['type'] == 'hepta' ) {
                            if( !empty( $testimonial_img_id ) ) {
                                if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                                    require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
                                }
                                $image = new \Wn_Img_Maniuplate;
                                $testimonial_img_id = $image->m_image( $thumbnail_id, $testimonial_img_id , $settings['custom_dimension_type_7']['width'] , $settings['custom_dimension_type_7']['height'] );
                            }
                        }

                        if ( $settings['type'] == 'hexa' ) {
                            if( !empty( $testimonial_img_id ) ) {
                                if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                                    require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
                                }
                                $image = new \Wn_Img_Maniuplate;
                                $testimonial_img_id = $image->m_image( $thumbnail_id, $testimonial_img_id , $settings['custom_dimension_type_6']['width'] , $settings['custom_dimension_type_6']['height'] );
                            }
                        }

                        if ( $settings['type'] == 'penta' ) {
                            if( !empty( $testimonial_img_id ) ) {
                                if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                                    require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
                                }
                                $image = new \Wn_Img_Maniuplate;
                                $testimonial_img_id = $image->m_image( $thumbnail_id, $testimonial_img_id , $settings['custom_dimension_type_5']['width'] , $settings['custom_dimension_type_5']['height'] );
                            }
                        }

                        if ( $settings['type'] == 'tetra' ) {
                            if( !empty( $testimonial_img_id ) ) {
                                if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                                    require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
                                }
                                $image = new \Wn_Img_Maniuplate;
                                $testimonial_img_id = $image->m_image( $thumbnail_id, $testimonial_img_id , $settings['custom_dimension_type_4']['width'] , $settings['custom_dimension_type_4']['height'] );
                            }
                        }

                        if ( $settings['type'] == 'tri' ) {
                            if( !empty( $testimonial_img_id ) ) {
                                if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                                    require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
                                }
                                $image = new \Wn_Img_Maniuplate;
                                $testimonial_img_id = $image->m_image( $thumbnail_id, $testimonial_img_id , $settings['custom_dimension_type_3']['width'] , $settings['custom_dimension_type_3']['height'] );
                            }
                        }

                        if ( $settings['type'] == 'di' ) {
                            if( !empty( $testimonial_img_id ) ) {
                                if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                                    require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
                                }
                                $image = new \Wn_Img_Maniuplate;
                                $testimonial_img_id = $image->m_image( $thumbnail_id, $testimonial_img_id , $settings['custom_dimension_type_2']['width'] , $settings['custom_dimension_type_2']['height'] );
                            }
                        }

                        if ( $settings['type'] == 'mono' ) {
                            if( !empty( $testimonial_img_id ) ) {
                                if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                                    require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
                                }
                                $image = new \Wn_Img_Maniuplate;
                                $testimonial_img_id = $image->m_image( $thumbnail_id, $testimonial_img_id , $settings['custom_dimension_type_1']['width'] , $settings['custom_dimension_type_1']['height'] );
                            }
                        }

                        $out .='
                            <div class="testimonial">
                                <div class="testimonial-content">
                                    <h4><q>'.$testimonial_content.'</q></h4>
                                    <div class="testimonial-arrow"></div>
                                </div>
                                <div class="testimonial-brand">
                                    <img src="'.$testimonial_img_id.'" alt="'.$testimonial_name.'">
                                    <h5>
                                        <strong>'.$testimonial_name.'</strong><br>
                                        <em>'.$testimonial_subtitle.'</em>
                                    </h5>
                                    <div class="social-testimonial">
                                        ' . $socialvar . '
                                    </div>
                                </div>
                            </div>';
                    }
                    if ( $type == 'deca' ) {
                        if( !empty( $testimonial_img_id ) ) {
                            if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                                require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
                            }
                            $image = new \Wn_Img_Maniuplate;
                            $testimonial_img_id = $image->m_image( $thumbnail_id, $testimonial_img_id , $settings['custom_dimension_type_10']['width'] , $settings['custom_dimension_type_10']['height'] );
                        }
                        $out .='
                            <div class="testimonial">
                                <div class="testimonial-content">
                                    <h4><q>'.$testimonial_content.'</q></h4>
                                    <h5>
                                        <strong>'.$testimonial_name.'</strong><br>
                                        <em>'.$testimonial_subtitle.'</em>
                                    </h5>
                                    <div class="social-testimonial">
                                        ' . $socialvar . '
                                    </div>
                                </div>
                                <div class="center-line">
                                    <span class="deca-line"></span>
                                </div>
                                <div class="testimonial-brand">
                                    <img src="'.$testimonial_img_id.'" alt="'.$testimonial_name.'">
                                </div>
                            </div>';
                    }
                endforeach;

                foreach ( $testimonial_item_octa as $line ) :

                    $testimonial_name_octa          = $line['testimonial_name_octa'];
                    $testimonial_subtitle_octa      = $line['testimonial_subtitle_octa'];
                    $testimonial_content_octa       = $line['testimonial_content_octa'];
                    $testimonial_name_octa          = isset( $line['testimonial_name_octa'] ) ? $line['testimonial_name_octa']   : '';
                    $testimonial_subtitle_octa      = isset( $line['testimonial_subtitle_octa'] ) ? $line['testimonial_subtitle_octa']   : '';
                    $testimonial_content_octa       = isset( $line['testimonial_content_octa'] ) ? $line['testimonial_content_octa']   : '';

                    if ( $type == 'octa' ) {
                        $out .='
                        <div class="testimonial">
                            <div class="testimonial-content">
                                <h4><q>'.$testimonial_content_octa.'</q></h4>
                                <div class="testimonial-arrow"></div>
                            </div>
                            <div class="testimonial-brand">
                                <h5>
                                    <strong>'.$testimonial_name_octa.'</strong><br>
                                    <em>'.$testimonial_subtitle_octa.'</em>
                                </h5>
                            </div>
                        </div>';
                    }
                endforeach;

                foreach ( $testimonial_item_two as $line ) :

                    $testimonial_name_two           = isset( $line['testimonial_name_two'] ) ? $line['testimonial_name_two']   : '';
                    $testimonial_img_id_two         = isset( $line['testimonial_img_id_two'] ) ? $line['testimonial_img_id_two']['url']   : '';
                    $thumbnail_id                   = isset( $line['testimonial_img_id_two'] ) ? $line['testimonial_img_id_two']['id']   : '';
                    $testimonial_title_two          = isset( $line['testimonial_title_two'] ) ? $line['testimonial_title_two']   : '';
                    $testimonial_subtitle_two       = isset( $line['testimonial_subtitle_two'] ) ? $line['testimonial_subtitle_two']   : '';
                    $testimonial_content_two        = isset( $line['testimonial_content_two'] ) ? $line['testimonial_content_two']   : '';

                    if ( $type == 'nona' ) {
                        if( !empty( $testimonial_img_id_two ) ) {
                            if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                                require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
                            }
                            $image = new \Wn_Img_Maniuplate;
                            $testimonial_img_id_two = $image->m_image( $thumbnail_id, $testimonial_img_id_two , $settings['custom_dimension_type_9']['width'] , $settings['custom_dimension_type_9']['height'] );
                        }
                        if ( empty( $testimonial_img_id_two ) ) {
                            $testimonial_img_id_two = ELEMENTOR_ASSETS_URL . 'images/placeholder.png';
                            $n_img = 'ts-placeholder-image';
                        }
                        $out .='
                        <div class="testimonial '.$n_img.'">
                            <em>'.$testimonial_subtitle_two.'</em>
                            <div class="testimonial-content">
                                <div class="testimonial-title">'.$testimonial_title_two.'</div>
                                <h4><q>'.$testimonial_content_two.'</q></h4>
                            </div>
                            <div class="testimonial-brand">
                                <img src="'.$testimonial_img_id_two.'" alt="'.$testimonial_name_two.'">
                                <strong>'.$testimonial_name_two.'</strong><br>
                            </div>
                        </div>';
                    }
                endforeach;

                if ( $type == 'undeca' ) {
                    foreach ( $testimonial_item_eleven as $line ) :

                    $tc_content_t11         = isset( $line['tc_content_t11'] ) ? $line['tc_content_t11']   : '';
                    $first_social           = isset( $line['first_social'] ) ? $line['first_social']   : '';
                    $first_url              = isset( $line['first_url'] ) ? $line['first_url']['url']   : '';
                    $second_social          = isset( $line['second_social'] ) ? $line['second_social']   : '';
                    $second_url             = isset( $line['second_url'] ) ? $line['second_url']['url']   : '';
                    $third_social           = isset( $line['third_social'] ) ? $line['third_social']   : '';
                    $third_url              = isset( $line['third_url'] ) ? $line['third_url']['url']   : '';
                    $fourth_social          = isset( $line['fourth_social'] ) ? $line['fourth_social']   : '';
                    $fourth_url             = isset( $line['fourth_url'] ) ? $line['fourth_url']['url']   : '';

                    $first_target           = $first_url['is_external'] ? 'target="_blank"' : '';
                    $second_target          = $second_url['is_external'] ? 'target="_blank"' : '';
                    $third_target           = $third_url['is_external'] ? 'target="_blank"' : '';
                    $fourth_target          = $fourth_url['is_external'] ? 'target="_blank"' : '';
                    $first_url		        = isset( $line['first_url'] )	? '<a href="' . $line['first_url']['url']  . '" ' . $first_target . '><i class="' . $line['first_social']  . '"></i></a>' : '';
                    $second_url		        = isset( $line['second_url'] )  ? '<a href="' . $line['second_url']['url']	. '" ' . $second_target . '><i class="' . $line['second_social']  . '"></i></a>' : '';
                    $third_url		        = isset( $line['third_url'] )	? '<a href="' . $line['third_url']['url']	. '" ' . $third_target . '><i class="' . $line['third_social']  . '"></i></a>' : '';
                    $fourth_url		        = isset( $line['fourth_url'] )	? '<a href="' . $line['fourth_url']['url']	. '" ' . $fourth_target . '><i class="' . $line['fourth_social']  . '"></i></a>' : '';

                        $out .= '
                        <div class="tc-content-t11">
                            <p>' . $tc_content_t11 . ' </p>
                            <div class="tc-social-t11">
                                <li>' . $first_url . '</li>
                                <li>' . $second_url . '</li>
                                <li>' . $third_url . '</li>
                                <li>' . $fourth_url . '</li>
                            </div>
                        </div>';
                    endforeach;
                }

                if ( $type == 'dodeca' ) {

                    foreach ( $testimonial_item_two as $line ) :

                    $testimonial_name_two           = isset( $line['testimonial_name_two'] ) ? $line['testimonial_name_two']   : '';
                    $testimonial_img_id_two         = isset( $line['testimonial_img_id_two'] ) ? $line['testimonial_img_id_two']['url']   : '';
                    $testimonial_img_id             = isset( $line['testimonial_img_id_two'] ) ? $line['testimonial_img_id_two']['id']   : '';
                    $testimonial_title_two          = isset( $line['testimonial_title_two'] ) ? $line['testimonial_title_two']   : '';
                    $testimonial_subtitle_two       = isset( $line['testimonial_subtitle_two'] ) ? $line['testimonial_subtitle_two']   : '';
                    $testimonial_content_two        = isset( $line['testimonial_content_two'] ) ? $line['testimonial_content_two']   : '';

                    if ( $settings['type'] == 'dodeca' ) {
                        if( !empty( $testimonial_img_id_two ) ) {
                            if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                                require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
                            }
                            $image = new \Wn_Img_Maniuplate;
                            $testimonial_img_id_two = $image->m_image( $testimonial_img_id, $testimonial_img_id_two , $settings['custom_dimension_type_12']['width'] , $settings['custom_dimension_type_12']['height'] );
                        }
                    }

                    if ( empty( $testimonial_img_id_two ) ) {
                        $testimonial_img_id_two = ELEMENTOR_ASSETS_URL . 'images/placeholder.png';
                        $n_img = 'ts-placeholder-image';
                    }

                        $out .='
                        <div class="testimonial">
                            <div class="testimonial-brand '.$n_img.'">
                                <img src="'.$testimonial_img_id_two.'" alt="'.$testimonial_name_two.'">
                            </div>
                                <div class="testimonial-title colorf">'.$testimonial_name_two.'</div>
                                <span class="testimonial-sub-title">'.$testimonial_title_two.'</span>
                                <span class="testimonial-sub-title">'.$testimonial_subtitle_two.'</span>
                            <div class="testimonial-content">
                                <p>'.$testimonial_content_two.'</p>
                            </div>
                        </div>';
                    endforeach;
                }

        $out .=
            '</div>';

        if ( $type == 'undeca') {
            $out .= '</div>';
        }

        $custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
        }

        echo $out;

	}

}
