<?php
namespace Elementor;
class Webnus_Element_Widgets_Testimonial_Widget extends \Elementor\Widget_Base {

	/**
	 * Retrieve  widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'w_testimonial';
		
	}

	/**
	 * Retrieve  widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return __( 'Webnus Testimonial Widget', 'deep' );

	}

	/**
	 * Retrieve  widget icon.
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
	 * widget styles.
	 *
	 * @since 4.2.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'wn-deep-testimonial' ];

	}

	/**
	 * Register  widget controls.
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

		$this->add_control(
			'img_testimonial', //param_name
			[
				'label' 	=> __( 'Image URL', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::MEDIA, //type
				'default' 	=> [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'name_testimonial', //param_name
			[
				'label' 		=> __( 'Name', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXT, //type
			]
		);

		$this->add_control(
			'sub_testimonial', //param_name
			[
				'label' 		=> __( 'Subtitle', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXT, //type
			]
		);

		$this->add_control(
			'textarea_testimonial', //param_name
			[
				'label' 		=> __( 'Text', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA, //type
				'rows' 			=> 10,
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
	 * Render  widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();		
		$img_testimonial		= !empty( $settings['img_testimonial']['url'] ) ? $settings['img_testimonial']['url'] : '';
		$name_testimonial		= !empty( $settings['name_testimonial'] ) ? $settings['name_testimonial'] : '';
		$textarea_testimonial	= !empty( $settings['textarea_testimonial'] ) ? $settings['textarea_testimonial'] : '';
		$subtitle_testimonial	= !empty( $settings['sub_testimonial'] ) ? $settings['sub_testimonial'] : '';

		$instance = array(
			'image'		=> $img_testimonial,
			'name'		=> $name_testimonial,
			'text'		=> $textarea_testimonial,
			'subtitle'	=> $subtitle_testimonial,
		);

		$args = array(
			'before_title'	=> '<div class="subtitle-wrap"><h4 class="subtitle">',
			'after_title'	=> '</h4></div>'
		);

        $custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
        }

		echo get_the_widget( 'WebnusTestimonialWidget', $instance, $args );

	}

}