<?php
namespace Elementor;
class Webnus_Element_Widgets_Speakers extends \Elementor\Widget_Base {

	/**
	 * Retrieve Speakers widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'speakers';

	}

	/**
	 * Retrieve Speakers widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Speakers', 'deep' );

	}

	/**
	 * Retrieve Speakers widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'ti-microphone';

	}

	/**
	 * Set widget category.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget category.
	 */
	public function get_style_depends() {
		return [ 'wn-deep-speakers' ];
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
	 * Register Speakers widget controls.
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

        // Link Target
        $this->add_control(
            'hide',
            [
                'label'         => esc_html__( 'Hide Speakers with no sermons', 'deep' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => 'false',
                'true'          => esc_html__( 'Yes', 'deep' ),
                'false'         => esc_html__( 'No', 'deep' ),
                'return_value'  => 'yes',
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

		// Custom css tab
		$this->start_controls_section(
			'custom_css_section',
			[
				'label' => __( 'Custom CSS', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
				'selector' => '#wrap {{WRAPPER}} .sermons-speakers',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .sermons-speakers',
			]
		);

		$this->add_control(
			'box_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .sermons-speakers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'box_shadow',
					'label' => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .sermons-speakers',
				]
		);

		$this->add_control(
			'box_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .sermons-speakers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .sermons-speakers' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


	}

	/**
	 * Render Speakers widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

        ob_start();

        $settings = $this->get_settings_for_display();
        // Class & ID
        $shortcodeclass 	= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
        $shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';
		$hide = $settings['hide'];

        echo '<div class="clearfix sermons-speakers ' . $shortcodeclass . '"  ' . $shortcodeid . '>';
        $tax = 'sermon_speaker';
        $hide_empty = ($hide)?true:false;
        $terms = get_terms( $tax, array('hide_empty' => $hide_empty,));
        $speaker_counter = 0;
        foreach( $terms as $term ) {
            if ($speaker_counter == 0){
                echo '<div class="row">';
            }
            $speaker_counter++;
            $sermons_count = $term->count;
            $speaker_detail = term_description( $term->term_id, $tax );
            if ( $sermons_count > 1 ) {
            $w_sermons_count = '<a href="'. get_term_link( $term ) .'">'. str_replace( '%', number_format_i18n( $sermons_count ), __( '% Sermons', 'deep' )) .'</a>';
            } elseif ( $sermons_count == 0 ) {
            $w_sermons_count = __( 'No Sermons', 'deep' );
            } else {
            $w_sermons_count = '<a href="'. get_term_link( $term ) .'">'. __( '1 Sermon', 'deep' ) .'</a>';
            }
            echo '<div class="col-md-4"><article class="speaker">';
            if (function_exists('z_taxonomy_image_url') ){
                echo '<figure><img width="80" src="' . z_taxonomy_image_url($term->term_id,array(300, 300), TRUE) . '"></figure>';
            }
            echo '<h2>'. $term->name .'</h2><h5>'. $w_sermons_count .'</h5>'. $speaker_detail .'</article></div>';
            if ($speaker_counter == 3){
                echo '</div>';
                $speaker_counter = 0;
            }
        }
        if ($speaker_counter != 0){ // if row not full
            echo '</div>'; //close row
        }
        echo '</div>';
        $out = ob_get_contents();
        ob_end_clean();
        wp_reset_postdata();

        $custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}

		echo $out;

	}

}