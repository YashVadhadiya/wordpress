<?php
namespace Elementor;
class Webnus_Element_Widgets_Facebook_Comments extends \Elementor\Widget_Base {

	/**
	 * Retrieve Facebook Comments widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'wn_facebook_comments';
		
	}

	/**
	 * Retrieve Facebook Comments widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return __( 'Webnus Facebook Comments', 'deep' );

	}

	/**
	 * Retrieve Facebook Comments widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-facebook-comments';

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

		return [ 'deep-facebook-app-id' ];

	}

	/**
	 * Register Facebook Comments widget controls.
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
				'label' => esc_html__('General', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		$this->add_control(
			'comment_url', //param_name
			[
				'label' 		=> esc_html__('URL to comment on', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXT, //type
				'placeholder' 	=> esc_html__('https://example.com', 'deep' ),
			]
		);

		$this->add_control(
			'width',
			[
				'label' 		=>  esc_html__( 'Width' , 'deep'),
				'type' 			=> Controls_Manager::SLIDER,
				'description'   =>  esc_html__( 'The pixel width of the embed (accepts just 100% in % mode)', 'deep'),
				'size_units' 	=> [ 'px' , '%' ],
				'range' => [
					'px' => [
						'min' => 320,
						'max' => 2000,
					],
					'%' => [
						'min' => 100,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 550,
				],
			]
		);

		$this->add_control(
			'number', //param_name
			[
				'label' 		=> esc_html__('Number of Posts', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXT, //type
				'placeholder' 	=> esc_html__('Enter Number of Post', 'deep' ),
			]
		);

		$this->add_control(
			'order', //param_name
			[
				'label' 	=> esc_html__('Order by', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'social',
				'options' 	=> [
					'social'  		=> esc_html__( 'Social', 'deep' ),
					'time' 			=> esc_html__( 'Time', 'deep' ),
					'reverse_time' 	=> esc_html__( 'Reverse Time', 'deep' ),
				],
			]
		);

		$this->add_control(
			'color', //param_name
			[
				'label' 	=> esc_html__('Color', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'light',
				'options' 	=> [
					'light'  	=> esc_html__( 'Light', 'deep' ),
					'dark' 		=> esc_html__( 'Dark', 'deep' ),
				],
			]
		);

		$this->add_control(
			'mobile',
			[
				'label' 		=>  esc_html__( 'Mobile Optimized Version', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=>  esc_html__( 'Enable', 'deep' ),
				'label_off'		=>	esc_html__( 'Disable', 'deep' ),
				'return_value' 	=> 'true',
				'default' 		=> 'false',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'classid_section',
			[
				'label' => __( 'Class & ID', 'deep' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		$this->add_control(
			'shortcodeid', //param_name
			[
				'label' => __( 'Custom ID', 'deep' ), //heading
				'type' 	=> \Elementor\Controls_Manager::TEXT, //type
			]
		);

		$this->add_control(
			'shortcodeclass', //param_name
			[
				'label' => __( 'Custom Class', 'deep' ), //heading
				'type' 	=> \Elementor\Controls_Manager::TEXT, //type
			]
		);

		$this->end_controls_section();
		
		// Custom css tab
		$this->start_controls_section(
			'custom_css_section',
			[
				'label' => esc_html__('Custom CSS', 'deep' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'custom_css',
			[
				'label' => esc_html__('Custom CSS', 'deep' ),
				'type' => \Elementor\Controls_Manager::CODE,
				'language' => 'css',
				'rows' => 20,
				'show_label' => true,
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render Facebook Comments widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings	 				= $this->get_settings_for_display();
		$deep_options				= deep_options();
		$fb_api_code    			= deep_get_option( $deep_options, 'deep_facebook_app_id' );
		$settings['shortcodeclass'] = $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
		$settings['shortcodeid']	= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';
		$settings['width'] 			= $settings['width']['unit'] == '%' ? $settings['width']['size'] . $settings['width']['unit'] : $settings['width']['size'] ;
		
		if ( empty( $fb_api_code ) ) {
			esc_html_e( 'Please first set your Facebook APP ID in Theme Options > Social Networks > Integrations and refresh this page to display buttons correctly.', 'deep' );
		}

		if ( !empty($settings['comment_url']) ) :
			echo '<div '.$settings['shortcodeid'].' class="'.$settings['shortcodeclass'].' wn-facebook-comments fb-comments" data-href="'.$settings['comment_url'].'" data-width="'.$settings['width'].'" data-numposts="'.$settings['number'].'" data-colorscheme="'.$settings['color'].'" data-mobile="'.$settings['mobile'].'" data-order-by="'.$settings['order'].'"></div>';
		endif;

		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}

	}

}