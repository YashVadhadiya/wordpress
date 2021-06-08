<?php
namespace Elementor;
class Webnus_Element_Widgets_Icon_Divider extends \Elementor\Widget_Base {

	/**
	 * Retrieve Icon Divider widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'icon-divider';

	}

	/**
	 * Retrieve Icon Divider widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Icon Divider', 'deep' );

	}

	/**
	 * Retrieve Icon Divider widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-divider';

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
		return [ 'wn-deep-icon-divider' ];
	}

	/**
	 * Register Icon Divider widget controls.
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
			'name',
			[
				'label'			=> esc_html__( 'Icon', 'deep' ),
				'type'			=> \Elementor\Controls_Manager::ICON,
				'default'		=> 'sl-arrow-down',
				'description'	=>  esc_html__( "Select Icon", 'deep'),
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
			'content_section_style',
			[
				'label' => esc_html__( 'Style', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
		);

		$this->add_control(
			'color', //param_name
			[
				'label' 		=> esc_html__( 'Icon color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'description' =>  esc_html__( "Select icon color", 'deep'),
				'selectors' 	=> [
					'{{WRAPPER}} .cir' => 'color: {{VALUE}}',
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
	 * Render Icon Divider widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();		
		$shortcodeclass 	= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
		$shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';

		$name	= $settings['name'] ? ' ' . $settings['name'] : '';
		$out 	= '<div class="sec-divider ' . $shortcodeclass . '"  ' . $shortcodeid . ' ><div class="cir '. $name .'"></div></div>';
		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}
		echo $out;
	}

}
