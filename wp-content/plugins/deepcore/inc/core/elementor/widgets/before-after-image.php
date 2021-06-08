<?php
namespace Elementor;

class Webnus_Element_Widgets_Before_After_Image extends \Elementor\Widget_Base {

	/**
	 * Retrieve Before After Image widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'beforeafter';

	}

	/**
	 * Retrieve Before After Image widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return  esc_html__( 'Webnus Before After Image', 'deep' );

	}

	/**
	 * Retrieve Before After Image widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-image-before-after';

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

		return [ 'jquery-twentytwenty', 'deep-twentytwenty' ];

	}

	/**
	 * enqueue CSS
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'deep-twentytwenty' ];

	}

	/**
	 * Register Before After Image widget controls.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' =>  esc_html__( 'Images', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);
		$this->add_control(
			'img1',
			[
				'label' =>  esc_html__( '"Before" image', 'deep' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'img1_alt',
			[
				'label' =>  esc_html__( 'Image alt', 'deep' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'img2',
			[
				'label' =>  esc_html__( '"After" image', 'deep' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'img2_alt',
			[
				'label' =>  esc_html__( 'Image alt', 'deep' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
    	$this->end_controls_section();

		$this->start_controls_section(
			'option_section',
			[
				'label' =>  esc_html__( 'Options', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'arrow_type',
			[
				'label' =>  esc_html__( 'Arrow Type', 'deep' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'circle',
				'options' => [
					'circle'     => 'Circle' ,
					'square'     => 'Square' ,
				],
			]
		);
		$this->add_control(
			'no_middle_line',
			[
				'label' =>  esc_html__( 'Remove Middle line?', 'deep' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' =>  esc_html__( 'Yes', 'deep' ),
				'label_off' =>  esc_html__( 'No', 'deep' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'visible_value',
			[
				'label' =>  esc_html__('Visible "Before" image value', 'deep'),
				'type' => Controls_Manager::SLIDER,
				'description'   =>  esc_html__( 'How much of the "before" image is visible when the page loads? Please enter between 0 - 100. Default is 50', 'deep'),
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
			]
		);
		$this->add_control(
			'orientation_type',
			[
				'label' =>  esc_html__( 'Orientation Type', 'deep' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'horizontal'    => 'Horizontal' ,
					'vertical'      => 'Vertical' ,
				],
				'description'   =>  esc_html__( 'Orientation of the before and after images', 'deep'),
			]
		);
		$this->add_control(
			'no_overlay',
			[
				'label' =>  esc_html__( 'Display Overlay?', 'deep' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' =>  esc_html__( 'Yes', 'deep' ),
				'label_off'=>	 esc_html__( 'No', 'deep' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'before_label',
			[
				'label' =>  esc_html__('Before label', 'deep'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description'   =>  esc_html__( 'Set a custom before label', 'deep'),
				'condition'			=> [
					'no_overlay'	=> ['yes']
				],
			]
		);
		$this->add_control(
			'after_label',
			[
				'label' =>  esc_html__('After label', 'deep'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description'   =>  esc_html__( 'Set a custom after label', 'deep'),
				'condition'			=> [
					'no_overlay'	=> ['yes']
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'classid_section',
			[
				'label'	=> esc_html__( 'Class & ID', 'deep' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_CONTENT,
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

		$this->start_controls_section(
			'section_arrow_style',
			[
				'label' => __( 'Arrow Style', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'arrow_color',
			[
				'label'		=>  esc_html__( 'Color', 'deep' ),
				'type'		=> \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'#wrap {{WRAPPER}} .twentytwenty-left-arrow' => 'border-right-color: {{VALUE}};',
					'#wrap {{WRAPPER}} .twentytwenty-right-arrow' => 'border-left-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'arrow_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' , 'gradient' ],
				'selector' => '#wrap {{WRAPPER}} .twentytwenty-handle',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_line_style',
			[
				'label' => __( 'Line Style', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'line_color',
			[
				'label'		=>  esc_html__( 'Color', 'deep' ),
				'type'		=> \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'#wrap {{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:after,#wrap {{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:before,#wrap {{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:after,#wrap {{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:before' => 'background: {{VALUE}};',
					'#wrap {{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:before' => '-webkit-box-shadow: 0 3px 0 {{VALUE}}, 0 0 12px rgba(51,51,51,.5);-moz-box-shadow: 0 3px 0 {{VALUE}},0 0 12px rgba(51,51,51,.5);box-shadow: 0 3px 0 {{VALUE}}, 0 0 12px rgba(51,51,51,.5);',
					'#wrap {{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:after' => '-webkit-box-shadow: 0 -3px 0 {{VALUE}}, 0 0 12px rgba(51,51,51,.5); -moz-box-shadow: 0 -3px 0 {{VALUE}},0 0 12px rgba(51,51,51,.5);box-shadow: 0 -3px 0 {{VALUE}}, 0 0 12px rgba(51,51,51,.5);',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_label_style',
			[
				'label' => __( 'Label Style', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'label_typography',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .twentytwenty-after-label:before,#wrap {{WRAPPER}} .twentytwenty-before-label:before',
			]
		);
		$this->add_control(
			'label_color',
			[
				'label'		=>  esc_html__( 'Color', 'deep' ),
				'type'		=> \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'#wrap {{WRAPPER}} .twentytwenty-after-label:before,#wrap {{WRAPPER}} .twentytwenty-before-label:before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'label_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' , 'gradient' ],
				'selector' => '#wrap {{WRAPPER}} .twentytwenty-after-label:before,#wrap {{WRAPPER}} .twentytwenty-before-label:before',
			]
		);
		$this->add_control(
			'label_padding',
			[
				'label' 		=> __( 'Padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .twentytwenty-after-label:before,#wrap {{WRAPPER}} .twentytwenty-before-label:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'label_margin',
			[
				'label' 		=> __( 'Margin', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .twentytwenty-after-label:before,#wrap {{WRAPPER}} .twentytwenty-before-label:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

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
				'label'			=> __( 'Custom CSS', 'deep' ),
				'type'			=> \Elementor\Controls_Manager::CODE,
				'language'		=> 'css',
				'rows'			=> 20,
				'show_label'	=> true,
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Render Before After Image widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		$shortcodeclass 	= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
		$shortcodeid		= $settings['shortcodeid'] ? ' id=' . $settings['shortcodeid'] . '' : '';
		$before_label = $after_label = '';
		$img1_alt = $settings['img1_alt'] ? $settings['img1_alt'] : '';
		$img2_alt = $settings['img1_alt'] ? $settings['img2_alt'] : '';
		$out = '';
		if ( $settings['img1'] ) {
			$img1 = $settings['img1']['url'];
		}

		if ( $settings['img2'] ) {
			$img2 = $settings['img2']['url'];
		}

		if ( !empty( $settings['visible_value'] ) ) {
			$visible_value = $settings['visible_value']['size'] / 100;
		} else {
			$visible_value = '0.5';
		}

		if ( !empty( $settings['orientation_type'] ) ) {
			$orientation_type = $settings['orientation_type'];
		} else {
			$orientation_type = 'horizontal';
		}

		if (  $settings['no_overlay'] == 'yes'  ) {
			if ( !empty( $settings['before_label'] ) || !empty( $settings['after_label'] ) ) {
				$before_label 	= 'data-before-label = "'. $settings['before_label'] .'"';
				$after_label 	= 'data-after-label = "'. $settings['after_label'] .'"';
				$no_overlay 	= 'false';
			}else{
				$no_overlay = 'true';
				$before_label 	 = 'data-before-label = "none"';
				$after_label 	 = 'data-after-label = "none"';
			}
		}else{
			$no_overlay = 'true';
		}

		$arrow_type = ( $settings['arrow_type'] == 'circle' ) ? 'arrow-circle' : 'arrow-square';

		$no_middle_line = ( $settings['no_middle_line'] == 'yes' ) ? 'no-middle-line' : '' ;


		$out .= '
		<div class="wn-before-after ' . esc_attr( $arrow_type ) . ' ' . esc_attr( $no_middle_line ) . ' ' . esc_attr( $shortcodeclass ) . '"  ' . esc_attr( $shortcodeid ) . ' " data-visible-value="' . esc_attr( $visible_value ) . '" data-orientation="' . esc_attr( $orientation_type ) . '" data-no-overlay = "'.$no_overlay.'" '.$before_label.' '.$after_label.' >
			<img src="'.$img1 .'" alt="' . $img1_alt . '"/>

			<img src="'.$img2 .'" alt="' . $img2_alt . '"/>
		</div>';

        $custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
        }

		echo $out;

	}

}
