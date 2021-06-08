<?php
namespace Elementor;
class Webnus_Element_Widgets_Icons extends \Elementor\Widget_Base {

	/**
	 * Retrieve Icons widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'icons';
	}

	/**
	 * Retrieve Icons widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Webnus Icons', 'deep' );
	}

	/**
	 * Retrieve Icons widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-social-icons';
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
	 * Register Icons widget controls.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'General', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);
		$this->add_control(
			'name',
			[
				'label'		=> __( 'Icon', 'deep' ),
				'type'		=> \Elementor\Controls_Manager::ICON,
				'default'	=> 'wn-fab wn-fa-facebook',
			]
		);
		$this->add_control(
			'link',
			[
				'label' 		=> __( 'Icon Link URL', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::URL, //type
				'placeholder' 	=> __( 'https://your-link.com', 'deep' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '',
					'is_external' 	=> true,
					'nofollow' 		=> true,
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Styling', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'size',
			[
				'label' => __( 'Icon Size', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 18,
				],
				'selectors' => [
					'{{WRAPPER}} .wn-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'color',
			[
				'label' 		=> __( 'Icon color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .wn-icon' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'idisplay',
			[
				'label' 		=> __( 'Display Block', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::SWITCHER, //type
				'description'   => __( 'If you set alignment for the icon, you shuold also enable this option ', 'deep' ),
				'label_on'		=> __( 'Yes', 'deep' ),
				'label_off'		=> __( 'No', 'deep' ),
				'return_value'	=> 'block',
				'default'		=> 'block',
				'selectors' 	=> [
					'{{WRAPPER}} .wn-icon' => 'display: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'align',
			[
				'label' => __( 'Alignment', 'deep' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'deep' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'deep' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'deep' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .wn-icon' => 'text-align: {{VALUE}}',			
				],
			]
		);
		$this->add_control(
			'link_class',
			[
				'label' 		=> __( 'Icon Link Class', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXT, //type
			]
		);
		$this->add_control(
			'bg_color',
			[
				'label' 		=> __( 'Custom background color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'{{WRAPPER}} .wn-icon' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'padding',
			[
				'label' 		=> __( 'Icon padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wn-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '{{WRAPPER}} .wn-icon',
			]
		);
		$this->add_control(
			'border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __( 'Box Shadow', 'deep' ),
				'selector' => '{{WRAPPER}} .wn-icon',
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
	 * Render Icons widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		if( !empty( $settings['link']['url'] ) ) {
			$target		= $settings['link']['is_external'] ? ' target=_blank' : '';
			$rel		= $settings['link']['nofollow'] ? ' rel=nofollow' : '';
			$link_class = $settings['link_class'] ? ' class='. $settings['link_class'] .' ' : '';
			$out = '
			<a href="'. esc_url( $settings['link']['url'] ) .'"'. esc_attr( $link_class . $target . $rel ) .' >
				<i class="wn-icon '. $settings['name'] . '"></i>
			</a>';
		}
		else {
			$out = '<i class="wn-icon '. $settings['name'] . '"></i>';
		}
		$custom_css = $settings['custom_css'];
		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}
		echo wp_kses( $out, wp_kses_allowed_html( 'post' ) );
	}
}