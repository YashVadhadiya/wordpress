<?php
namespace Elementor;
class Webnus_Element_Widgets_About_Widget extends \Elementor\Widget_Base {

	/**
	 * Retrieve About widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'w_about';
		
	}

	/**
	 * Retrieve About widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return __( 'Webnus About Widget', 'deep' );

	}

	/**
	 * Retrieve About widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'ti-settings';

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
	 * Register About widget controls.
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
				'label' => __( 'General', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		// About Content
		$this->add_control(
			'name', //param_name
			[
				'label' 		=> __( 'About Content', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXT, //type
				'rows' 			=> 10,
				'placeholder' 	=> __( 'Content Goes Here', 'deep' ),
			]
		);

		$this->add_control(
			'image', //param_name
			[
				'label' 	=> __( 'Image', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::MEDIA, //type
				'default' 	=> [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'description', //param_name
			[
				'label' 		=> __( 'About Content', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA, //type
				'rows' 			=> 10,
				'placeholder' 	=> __( 'Content Goes Here', 'deep' ),
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
	 * Render About widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$name			= !empty( $settings['name'] ) ? $settings['name'] : '';
		$image			= !empty( $settings['image']['url'] ) ? $settings['image']['url'] : '';
		$description	= !empty( $settings['description'] ) ? $settings['description'] : '';

		$instance = array(
			'name'			=> $name,
			'imageurl'		=> $image,
			'description'	=> $description,
		);

		$args = array(
			'before_title'	=> '<div class="subtitle-wrap"><h4 class="subtitle">',
			'after_title'	=> '</h4></div>'
		);
        $custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
        }
		echo get_the_widget( 'WebnusAboutWidget', $instance, $args );

	}

}