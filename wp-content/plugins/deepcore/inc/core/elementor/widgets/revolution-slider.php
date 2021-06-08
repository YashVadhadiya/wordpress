<?php
namespace Elementor;

class Webnus_Element_Widgets_Slider_Revolution extends \Elementor\Widget_Base {

	/**
	 * Retrieve slider revolution widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'wn_slider_revolution';
		
	}

	/**
	 * Retrieve slider revolution widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return __( 'Webnus Slider Revolution', 'deep' );

	}

	/**
	 * Retrieve slider revolution widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-slideshow';

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
	 * Register slider revolution widget controls.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$revslider_array = '';
		$slider = new \RevSlider();
		$arrSliders = $slider->getArrSliders();
		$revsliders_alias = $revsliders_name = array();
		if ( $arrSliders ) {
			foreach ( $arrSliders as $slider ) {
				$revsliders_alias[ $slider->getTitle() ] = $slider->getAlias();
				$revsliders_name[ $slider->getTitle() ] = $slider->getTitle();
			}
		} else {
			$revsliders_alias[ __( 'No sliders found', 'deep' ) ] = 0;
			$revsliders_name[ __( 'No sliders found', 'deep' ) ] = __( 'No sliders found', 'deep' );
		}
		$revslider_array  = array_combine($revsliders_alias, $revsliders_name);

        // Content Tab
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'General', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);
		
		// Select Type Section
		$this->add_control(
			'alias', //param_name
			[
				'label' 	=> __( 'Select Type', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'options' 	=> $revslider_array,
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


	}
	
	/**
	 * Render slider revolution widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		
		$settings = $this->get_settings();

        $custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}
		echo do_shortcode( '[rev_slider '.$settings['alias'].']' ) ;

		

	}

}