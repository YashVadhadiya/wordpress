<?php
namespace Elementor;

class Webnus_Element_Widgets_Line extends \Elementor\Widget_Base {

	/**
	 * Retrieve Line widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'line';

	}

	/**
	 * Retrieve Line widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Line', 'deep' );

	}

	/**
	 * Retrieve Line widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-ellipsis-h';

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
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'deep-hr-widget' ];

	}

	/**
	 * Register Line widget controls.
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
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		$this->add_control(
			'type',
			[
				'label' => esc_html__( 'Line Type', 'deep' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'description' =>  esc_html__( 'Select the Line type', 'deep'),
				'options' => [
					'1'	=>	 esc_html__('Line'),
					'2'	=>	 esc_html__('Thick Line'),
				],
				'default'	=>	'1',
			]
		);

		$this->end_controls_section();

		// Style
		$this->start_controls_section(
			'content_section_style',
			[
				'label' => esc_html__( 'Style', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
		);

		$this->add_control(
			'line_color', //param_name
			[
				'label' 		=> __( 'Color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'#wrap {{WRAPPER}} hr' => 'border-color: {{VALUE}} !important',
				],
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
	 * Render Line widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$shortcodeclass 			= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
		$shortcodeid					= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';

		$out = ( $settings['type'] == '1')?  '<hr class="' . $shortcodeclass . '"  ' . $shortcodeid . '>' : '<hr class="boldbx ' . $shortcodeclass . '"  ' . $shortcodeid . '>';

		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}

		echo $out;
	}

}
