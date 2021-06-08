<?php
namespace Elementor;
class Webnus_Element_Widgets_Img_Hotspot extends Widget_Base {

	/**
	 * Retrieve Image Hotspot widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'wn_Img_hotspot';

	}

	/**
	 * Retrieve Image Hotspot widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Image Hotspot', 'deep' );

	}

	/**
	 * Retrieve Image Hotspot widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-image-hotspot';

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
		return [ 'img-hotspot' ];
	}

	/**
	 * Register Image Hotspot widget controls.
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
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'box_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' , 'gradient' ],
				'selector' => '{{WRAPPER}} .webnus-image-hotspot',
			]
        );
        $this->add_control(
			'image_h',
			[
				'label' => __( 'Height', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 10,
					],
                ],	
                'default' => [
					'unit' => 'px',
					'size' => 300,
				],                
				'selectors' => [
					'{{WRAPPER}} .webnus-image-hotspot' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $repeater = new Repeater();
        $repeater->add_control(
			'icon',
			[
				'label'		=> __( 'Icon', 'deep' ),
				'type'		=> Controls_Manager::ICON,
				'default'	=> 'wn-fab wn-fa-firefox',
			]
		);
		$repeater->add_control(
			'content', [
				'label' => __( 'Content', 'deep' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Content' , 'deep' ),
				'show_label' => false,
			]
        );
        $repeater->add_control(
			'icon_top',
			[
				'label' => __( 'Top', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
						'step' => 5,
					],
                ],		
                'default' => [
					'unit' => 'px',
					'size' => 50,
				],  
				'selectors' => [
					'.webnus-image-hotspot {{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
        );
        $repeater->add_control(
			'icon_left',
			[
				'label' => __( 'Left', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
						'step' => 5,
					],
                ],			
                'default' => [
					'unit' => 'px',
					'size' => 60,
				],  
				'selectors' => [
					'.webnus-image-hotspot {{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
            'list',
            [
                'label' => __( 'List', 'deep' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [                        
                        'content' => __( 'Item content. Click the edit button to change this text.', 'deep' ),                        
                    ],                   
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
	 * Render Image Hotspot widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();		
        echo '<div class="webnus-image-hotspot">';
            if ( $settings['list'] ) {
                foreach ( $settings['list'] as $list ) {   
                    echo '<div class="image-hotspot-wrapper elementor-repeater-item-' . $list['_id'] .'">';                                     
					echo '<span class="w-hotspot-icon"><i class="wn-icon '. $list['icon'] . '"></i>
						<div class="w-hotspot-content">' . esc_html( $list['content'] ) . '</div></span>';                    
                    echo '</div>';     
                }
            }
        echo '</div>';

        $custom_css = $settings['custom_css'];
		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}
	}

}
