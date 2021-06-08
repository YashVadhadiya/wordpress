<?php
namespace Elementor;

class Webnus_Element_Widgets_Testimonial_Carousel extends \Elementor\Widget_Base {

	/**
	 * Retrieve Testimonial Carousel widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'testimonial_carousel';

	}

	/**
	 * Retrieve Testimonial Carousel widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Testimonial Carousel', 'deep' );

	}

	/**
	 * Retrieve Testimonial Carousel widget icon.
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

		return [ 'deep-owl-carousel', 'deep-testimonial-carousel' ];

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
	 * Register Testimonial Carousel widget controls.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'content_sectiona',
			[
				'label' => esc_html__( 'General', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);
		$this->add_control(
			'type',
			[
				'label' 	=> esc_html__( 'Type', 'deep' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> '1',
				'options' 	=> [
                    '1'  	=> esc_html__( 'One', 'deep' ),
                    '2'  	=> esc_html__( 'Two', 'deep' ),
                    '3'  	=> esc_html__( 'Three', 'deep' ),
                    '4'  	=> esc_html__( 'Four', 'deep' ),
				],
			]
        );
        $this->add_control(
            'items',
            [
                'label'         => esc_html__( 'Testimonial Items Per View', 'deep' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => 3,
                'min'           => 1,
                'step'          => 1,
                'condition'     => [
                    'type'     => [
                        '1', '2', '3',
                    ],
                ],
            ]
        );
		$this->add_control(
			'testimonial_item',
			[
				'label' 		=> esc_html__( 'Repeater List', 'deep' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> [
                    [
                        'name' 			=> 'img',
                        'label' 		=> esc_html__( 'Testimonial Image', 'deep' ),
                        'type' 			=> Controls_Manager::MEDIA,
                        'default' 		=> [
                            'url' 		=> Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name' 			=> 'thumbnail',
                        'label'         => esc_html__( 'Image Size', 'deep' ),
                        'type'          => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
                        'description'   => esc_html__( 'Enter image size (Example: 200x200 (Width x Height)).', 'deep' ),
                        'default'       => [
                            'width' => '100',
                            'height' => '100',
                        ],
                    ],
                    [
                        'name' 			=> 'tc_content',
                        'label' 		=> esc_html__( 'Testimonial Content', 'deep' ),
                        'type'          => Controls_Manager::TEXTAREA,
                        'label_block' 	=> true,
                        'description'   => esc_html__( 'Enter image size (Example: 200x100 (Width x Height)).', 'deep'),
                    ],
                    [
                        'name' 			=> 'name',
                        'label' 		=> esc_html__( 'Testimonial Name', 'deep' ),
                        'type' 			=> Controls_Manager::TEXT,
                        'label_block' 	=> true,
                    ],
                    [
                        'name' 			=> 'job',
                        'label' 		=> esc_html__( 'Testimonial Job', 'deep' ),
                        'type' 			=> Controls_Manager::TEXT,
                        'label_block' 	=> true,
                    ],
                ],
                'default' => [
					[
						'tc_content' => __( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.', 'deep' ),
					],
					[
						'tc_content' => __( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.', 'deep' ),
                    ],
                    [
						'tc_content' => __( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.', 'deep' ),
					],
				],
                'condition'     => [
                    'type'     => [
                        '1', '2', '3',
                    ],
                ],
			]
		);
		$this->add_control(
			'testimonial_item_type4',
			[
				'label' 		=> esc_html__( 'Repeater List', 'deep' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> [
                    [
                        'name' 			=> 'tc_content_t4',
                        'label' 		=> esc_html__( 'Testimonial Content', 'deep' ),
                        'type'          => Controls_Manager::TEXTAREA,
                        'label_block' 	=> true,
                        'description'   => esc_html__( 'Enter image size (Example: 200x100 (Width x Height)).', 'deep'),
                    ],
                    [
                        'name'          => 'first_social',
                        'label'         => esc_html__( 'First Social Name', 'deep' ),
                        'type'          => Controls_Manager::ICON,
                    ],
                    [
                        'name'          => 'first_url',
                        'label' 		=> esc_html__( 'First Social URL', 'deep' ),
                        'type' 			=> Controls_Manager::URL,
                        'default' 		=> [
                                'url' 			=> 'http://',
                                'is_external' 	=> '',
                        ],
                        'show_external' => true,
                    ],
                    [
                        'name'          => 'second_social',
                        'label'         => esc_html__( 'Second Social Name', 'deep' ),
                        'type'          => Controls_Manager::ICON,
                    ],
                    [
                        'name'          => 'second_url',
                        'label' 		=> esc_html__( 'Second Social URL', 'deep' ),
                        'type' 			=> Controls_Manager::URL,
                        'default' 		=> [
                                'url' 			=> 'http://',
                                'is_external' 	=> '',
                        ],
                        'show_external' => true,
                    ],
                    [
                        'name'          => 'third_social',
                        'label'         => esc_html__( 'Third Social Name', 'deep' ),
                        'type'          => Controls_Manager::ICON,
                    ],
                    [
                        'name'          => 'third_url',
                        'label' 		=> esc_html__( 'Third Social URL', 'deep' ),
                        'type' 			=> Controls_Manager::URL,
                        'default' 		=> [
                                'url' 			=> 'http://',
                                'is_external' 	=> '',
                        ],
                        'show_external' => true,
                    ],
                    [
                        'name'          => 'fourth_social',
                        'label'         => esc_html__( 'Fourth Social Name', 'deep' ),
                        'type'          => Controls_Manager::ICON,
                    ],
                    [
                        'name'          => 'fourth_url',
                        'label' 		=> esc_html__( 'Fourth Social URL', 'deep' ),
                        'type' 			=> Controls_Manager::URL,
                        'default' 		=> [
                                'url' 			=> 'http://',
                                'is_external' 	=> '',
                        ],
                        'show_external' => true,
                    ],
				],
                'condition'     => [
                    'type'     => [
                        '4',
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
			'section_content_style',
			[
				'label' => __( 'Content Text Style', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'content_typography',
				'label' 	=> __( 'Content Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .testimonial-carousel .tc-content',
			]
        );
        $this->add_control(
			'tc_content_color',
			[
				'label' 		=> __( 'Content color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .testimonial-carousel .tc-content' => 'color: {{VALUE}}',
				],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
			'section_social_style',
			[
				'label'     => __( 'Socials Style', 'deep' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'type' => [
                        '4',
                    ],
                ],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'social_typography',
				'label' 	=> __( 'Social Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .testimonial-carousel .tc-content-t4 li i',
			]
        );
        $this->add_control(
			'tc_social_color',
			[
				'label' 		=> __( 'social color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .testimonial-carousel .tc-content-t4 li i' => 'color: {{VALUE}}',
				],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
			'section_name_style',
			[
				'label'     => __( 'Name Text Style', 'deep' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'type!' => '4'
                ]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'name_typography',
				'label' 	=> __( 'Name Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .testimonial-carousel .tc-name',
			]
        );
        $this->add_control(
			'tc_name_color',
			[
				'label' 		=> __( 'Name color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .testimonial-carousel .tc-name' => 'color: {{VALUE}} !important',
                ],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
			'section_job_text_style',
			[
				'label'     => __( 'Job Text Style', 'deep' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'type!' => '4'
                ]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'job_text_typography',
				'label' 	=> __( 'Job Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .testimonial-carousel .tc-job',
			]
        );
        $this->add_control(
			'tc_job_color',
			[
				'label' 		=> __( 'Job Text color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .testimonial-carousel .tc-job' => 'color: {{VALUE}}',
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
	 * Render Testimonial Carousel widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

        $settings = $this->get_settings();
        wp_enqueue_style( 'wn-deep-testimonial-carousel0', DEEP_ASSETS_URL . 'css/frontend/testimonial-carousel/testimonial-carousel0.css' );
        wp_enqueue_style( 'wn-deep-testimonial-carousel' . $settings['type'], DEEP_ASSETS_URL . 'css/frontend/testimonial-carousel/testimonial-carousel' . $settings['type'] . '.css' );

        $type                    = $settings['type'] ? $settings['type'] : '';
        $items                   = $settings['items'] ? $settings['items'] : '';
        $testimonial_item        = $settings['testimonial_item'] ? $settings['testimonial_item'] : '';
        $testimonial_item_type4  = $settings['testimonial_item_type4'] ? $settings['testimonial_item_type4'] : '';

        // Class & ID
        $shortcodeclass 	= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
        $shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';

        $custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {

			deep_save_dyn_styles( $custom_css );

			if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
				echo '<style>'. $custom_css .'</style>';
			}

        }

        // render
        if ( $type == '1' ) {
            $out = '<div class="testimonial-carousel testi-carou-' . $type . ' ' . $shortcodeclass . '"  ' . $shortcodeid . '>';
                $out .= '<div class="testimonial-owl-carousel owl-carousel owl-theme" data-count="' . $items . '">';
                        foreach ( $testimonial_item as $line ) :

                            if ( !empty( $line['thumbnail']['width'] ) || !empty( $line['thumbnail']['height'] ) ) {

                                if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                                    require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
                                }

                                $image = new \Wn_Img_Maniuplate;

                                if ( ($line['img']['id'] == 0 ) ) {
                                    $img   = '<img src="' . $line['img']['url'] . '" alt="' . $line['name'] . '">';
                                } else {
                                    $img   = $image->m_image( $line['img']['id'] , $line['img']['url'] , $line['thumbnail']['width'] , $line['thumbnail']['height'] );
                                    $img   = '<img src="' . $img . '" alt="' . $line['name'] . '">';
                                }

                            } else {
                                $img   = !empty( $line['img']['url'] ) ? '<img src="' . $line['img']['url'] . '" alt="' . $line['name'] . '">' : '';
                            }
                            $tc_content     = !empty( $line['tc_content'] ) ? '<p class="tc-content">' . esc_html( $line['tc_content'] ) . '</p>' : '';
                            $name           = !empty( $line['name'] ) ? '<p class="tc-name colorf">' . esc_html( $line['name'] ) . '</p>' : '';
                            $job            = !empty( $line['job'] ) ? '<p class="tc-job">' . esc_html( $line['job'] ) . '</p>' : '';
                            $out .= '<div class="tc-item">' . $img . $tc_content . $name . $job . '</div>';
                        endforeach;
                $out .= '</div>';
            $out .= '</div>';
            echo $out;
        } if ( $type == '2' ) {
            $out = '<div class="testimonial-carousel testi-carou-' . $type . ' ' . $shortcodeclass . '"  ' . $shortcodeid . '>';
                $out .= '<div class="testimonial-owl-carousel owl-carousel owl-theme" data-count="' . $items . '">';
                    foreach ( $testimonial_item as $line ) :
                        if ( !empty( $line['thumbnail']['width'] ) || !empty( $line['thumbnail']['height'] ) ) {

                                if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                                    require_once DEEP_CORE_DIR .'helper-classes/class_webnus_manuplate.php';
                                }

                                $image = new \Wn_Img_Maniuplate;

                                $img   = $image->m_image( $line['img']['id'] , $line['img']['url'] , $line['thumbnail']['width'] , $line['thumbnail']['height'] );
                                $img   = '<img src="' . $img . '" alt="' . $line['name'] . '">';
                            } else {
                                $img   = !empty( $line['img']['url'] ) ? '<img src="' . $line['img']['url'] . '" alt="' . $line['name'] . '">' : '';
                            }
                        $tc_content     = !empty( $line['tc_content'] ) ? '<p class="tc-content">' . esc_html( $line['tc_content'] ) . '</p>' : '';
                        $name           = !empty( $line['name'] ) ? '<p class="tc-name colorf">' . esc_html( $line['name'] ) . '</p>' : '';
                        $job            = !empty( $line['job'] ) ? '<p class="tc-job">' . esc_html( $line['job'] ) . '</p>' : '';
                        $out .= '<div class="tc-item">
                                    ' . $tc_content . '
                                    <div class="t-m-footer">'. $img . $name . $job . '</div>
                                </div>';
                    endforeach;
                $out .= '</div>';
            $out .= '</div>';
            echo $out;
        } if ( $type == '3' ) {
            $out = '<div class="testimonial-carousel testi-carou-' . $type . ' ' . $shortcodeclass . '"  ' . $shortcodeid . '>';
                $out .= '<div class="testimonial-owl-carousel owl-carousel owl-theme" data-count="' . $items . '">';
                    foreach ( $testimonial_item as $line ) :
                            if ( !empty( $line['thumbnail']['width'] ) || !empty( $line['thumbnail']['height'] ) ) {

                                if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                                    require_once DEEP_CORE_DIR .'helper-classes/class_webnus_manuplate.php';
                                }

                                $image = new \Wn_Img_Maniuplate;

                                $img   = $image->m_image( $line['img']['id'] , $line['img']['url'] , $line['thumbnail']['width'] , $line['thumbnail']['height'] );
                                $img   = '<img src="' . $img . '" alt="' . $line['name'] . '">';
                            } else {
                                $img   = !empty( $line['img']['url'] ) ? '<img src="' . $line['img']['url'] . '" alt="' . $line['name'] . '">' : '';
                            }
                            $tc_content     = !empty( $line['tc_content'] ) ? '<p class="tc-content">' . esc_html( $line['tc_content'] ) . '</p>' : '';
                            $name           = !empty( $line['name'] ) ? '<p class="tc-name colorf">' . esc_html( $line['name'] ) . '</p>' : '';
                            $job            = !empty( $line['job'] ) ? '<p class="tc-job">' . esc_html( $line['job'] ) . '</p>' : '';
                            $out .= '<div class="tc-item">
                                        ' . $img . '
                                        <div class="main-content">
                                            ' . $name . $job . '
                                            <div class="t-m-footer"> ' . $tc_content . ' </div>
                                        </div>
                                    </div>';
                    endforeach;
                $out .= '</div>';
            $out .= '</div>';
            echo $out;
        } if ( $type == '4' ) {
            $out = '<div class="testimonial-carousel testi-carou-' . $type . ' colorb ' . $shortcodeclass . '"  ' . $shortcodeid . '>';
                $out .= '<div class="testimonial-owl-carousel owl-carousel owl-theme" data-count="' . $items . '">';
                    foreach ( $testimonial_item_type4 as $line ) :
                        $tc_content_t4      = !empty( $line['tc_content_t4'] ) ? $line['tc_content_t4'] : '' ;

                        $first_url          = !empty( $line['first_url']['url'] ) ? $line['first_url']['url'] : '' ;
                        $first_target       = !empty( $line['first_url']['is_external'] ) ? 'target="_blank"' : '' ;
                        $first_nofollow     = !empty( $line['first_url']['nofollow'] ) ? 'rel="nofollow"' : '' ;
                        $first_social       = !empty( $line['first_social'] ) ? '<li><a href="' . $first_url  . '" ' . $first_target . ' ' . $first_nofollow . '><i class="' . $line['first_social']  . '"></i></a></li>' : '' ;

                        $second_url          = !empty( $line['second_url']['url'] ) ? $line['second_url']['url'] : '' ;
                        $second_target       = !empty( $line['second_url']['is_external'] ) ? 'target="_blank"' : '' ;
                        $second_nofollow     = !empty( $line['second_url']['nofollow'] ) ? 'rel="nofollow"' : '' ;
                        $second_social       = !empty( $line['second_social'] ) ? '<li><a href="' . $second_url  . '" ' . $second_target . ' ' . $second_nofollow . '><i class="' . $line['second_social']  . '"></i></a></li>' : '' ;


                        $third_url          = !empty( $line['third_url']['url'] ) ? $line['third_url']['url'] : '' ;
                        $third_target       = !empty( $line['third_url']['is_external'] ) ? 'target="_blank"' : '' ;
                        $third_nofollow     = !empty( $line['third_url']['nofollow'] ) ? 'rel="nofollow"' : '' ;
                        $third_social       = !empty( $line['third_social'] ) ? '<li><a href="' . $third_url  . '" ' . $third_target . ' ' . $third_nofollow . '><i class="' . $line['third_social']  . '"></i></a></li>' : '' ;

                        $fourth_url          = !empty( $line['fourth_url']['url'] ) ? $line['fourth_url']['url'] : '' ;
                        $fourth_target       = !empty( $line['fourth_url']['is_external'] ) ? 'target="_blank"' : '' ;
                        $fourth_nofollow     = !empty( $line['fourth_url']['nofollow'] ) ? 'rel="nofollow"' : '' ;
                        $fourth_social       = !empty( $line['fourth_social'] ) ? '<li><a href="' . $fourth_url  . '" ' . $fourth_target . ' ' . $fourth_nofollow . '><i class="' . $line['fourth_social']  . '"></i></a></li>' : '' ;

                        $out .= '<div class="tc-content-t4">
                                    <p class="tc-content">' . $tc_content_t4 . ' </p>
                                    <div class="tc-social-t4">
                                        ' . $first_social . $second_social . $third_social . $fourth_social . '
                                    </div>
                                </div>';
                    endforeach;
                $out .= '</div>';
            $out .= '</div>';
            echo $out;
        }

	}

}
