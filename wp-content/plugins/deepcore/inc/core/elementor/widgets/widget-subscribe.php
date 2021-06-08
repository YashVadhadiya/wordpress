<?php
namespace Elementor;
class Webnus_Element_Widgets_Subscribe_Widget extends \Elementor\Widget_Base {

	/**
	 * Retrieve  widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'w_subscribe';
		
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

		return __( 'Webnus Subscribe Widget', 'deep' );

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
			'display', //param_name
			[
				'label' 	=> __( 'Display Type', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'one',
				'options' 	=> [ //value
					'one' => __( 'one', 'deep' ),
					'two' => __( 'two', 'deep' ),
				],
			]
		);

		$this->add_control(
			'subscribe_service', //param_name
			[
				'label' 	=> __( 'Subscribe Service', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'feedburner',
				'options' 	=> [ //value
					'feedburner' => __( 'FeedBurner', 'deep' ),
					'mailchimp'  => __( 'MailChimp', 'deep' ),
				],
			]
		);

		$this->add_control(
			'feedburner_txt', //param_name
			[
				'label' 		=> __( 'Feedburner ID', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXT, //type
				'condition' 	=> [ //dependency
					'subscribe_service' 	=> [
						'feedburner'
					],
				],
			]
		);

		$this->add_control(
			'mailchimp_txt', //param_name
			[
				'label' 		=> __( 'Mailchimp form action URL', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXT, //type
				'condition' 	=> [ //dependency
					'subscribe_service' 	=> [
						'mailchimp'
					],
				],
			]
		);

		$this->add_control(
			'custom_text', //param_name
			[
				'label' 		=> __( 'Custom text', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA, //type
				'rows' 			=> 10,
				'placeholder' 	=> __( 'Write Content', 'deep' ),
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

		$display				= !empty( $settings['display'] ) ? $settings['display'] : '';
		$subscribe_service		= !empty( $settings['subscribe_service'] ) ? $settings['subscribe_service'] : '';
		$feedburner_txt			= !empty( $settings['feedburner_txt'] ) ? $settings['feedburner_txt'] : '';
		$mailchimp_txt			= !empty( $settings['mailchimp_txt'] ) ? $settings['mailchimp_txt'] : '';
		$custom_text			= !empty( $settings['custom_text'] ) ? $settings['custom_text'] : '';


		$instance = array(
			'display'			=> $display,
			'type'				=> $subscribe_service,
			'id'				=> $feedburner_txt,
			'url'				=> $mailchimp_txt,
			'text'				=> $custom_text,
		);

		$args = array(
			'before_title'	=> '<div class="subtitle-wrap"><h4 class="subtitle">',
			'after_title'	=> '</h4></div>'
		);

        $custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
        }

		echo get_the_widget( 'deep_subscribe_widget', $instance, $args );

	}

}