<?php
namespace Elementor;
class Webnus_Element_Widgets_Facebook_Buttons extends \Elementor\Widget_Base {

	/**
	 * Retrieve Facebook Button widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'wn_facebook_button';
		
	}

	/**
	 * Retrieve Facebook Button widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return __( 'Webnus Facebook Buttons', 'deep' );

	}

	/**
	 * Retrieve Facebook Button widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-facebook-like-box';

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
	 * Register Facebook Button widget controls.
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
			'type', //param_name
			[
				'label' 	=> esc_html__('Type', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'like',
				'options' 	=> [
					'like'  	=> esc_html__( 'Like', 'deep' ),
					'recommend' => esc_html__( 'Recommend', 'deep' ),
					'save' 		=> esc_html__( 'Save', 'deep' ),
					'share' 	=> esc_html__( 'Share', 'deep' ),
				],
			]
		);
		
		$this->add_control(
			'size', //param_name
			[
				'label' 	=> esc_html__('Button Size', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'large',
				'options' 	=> [
					'large'  	=> esc_html__( 'Large', 'deep' ),
					'small' 	=> esc_html__( 'Small', 'deep' ),
				],
			]
		);

		$this->add_control(
			'button_url', //param_name
			[
				'label' 		=> esc_html__('URL', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXT, //type
				'placeholder' 	=> esc_html__('https://example.com', 'deep' ),
			]
		);

		$this->add_control(
			'width',
			[
				'label' 		=>  esc_html__( 'Width' , 'deep'),
				'type' 			=> Controls_Manager::SLIDER,
				'description'   =>  esc_html__( 'The pixel width of the plugin', 'deep'),
				'size_units' 	=> [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
				],
				'condition' 	=> [ //dependency
					'type' 	=> [
						'like' , 'recommend'
					],
				],
			]
		);

		$this->add_control(
			'layout', //param_name
			[
				'label' 	=> esc_html__('Layout', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'standard',
				'options' 	=> [
					'standard'  	=> esc_html__( 'Standard' , 'deep' ),
					'box_count' 	=> esc_html__( 'Box Count' , 'deep' ),
					'button_count' 	=> esc_html__( 'Button Count' , 'deep' ),
					'button' 		=> esc_html__( 'Button' , 'deep' ),
				],
				'condition' 	=> [ //dependency
					'type' 	=> [
						'like' , 'recommend'
					],
				],
			]
		);

		$this->add_control(
			'layout_share', //param_name
			[
				'label' 	=> esc_html__('Layout', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'icon_link',
				'options' 	=> [
					'icon_link'  	=> esc_html__( 'Default' , 'deep' ),
					'box_count' 	=> esc_html__( 'Box Count' , 'deep' ),
					'button_count' 	=> esc_html__( 'Button Count' , 'deep' ),
					'button' 		=> esc_html__( 'Button' , 'deep' ),
				],
				'condition' 	=> [ //dependency
					'type' 	=> [
						'share'
					],
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
					'dark' 		=> esc_html__('Dark', 'deep' ),
				],
				'condition' 	=> [ //dependency
					'type' 	=> [
						'like' , 'recommend'
					],
				],
			]
		);

		$this->add_control(
			'face',
			[
				'label' 		=>  esc_html__( 'Friends\' Faces?', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=>  esc_html__( 'Show', 'deep' ),
				'label_off'		=>	esc_html__( 'Hide', 'deep' ),
				'return_value' 	=> 'true',
				'default' 		=> 'false',
				'condition' 	=> [ //dependency
					'type' 	=> [
						'like' , 'recommend'
					],
				],
			]
		);

		$this->add_control(
			'share',
			[
				'label' 		=>  esc_html__( 'Share Button?', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=>  esc_html__( 'Show', 'deep' ),
				'label_off'		=>	esc_html__( 'Hide', 'deep' ),
				'return_value' 	=> 'true',
				'default' 		=> 'false',
				'condition' 	=> [ //dependency
					'type' 	=> [
						'like' , 'recommend'
					],
				],
			]
		);

		$this->add_control(
			'mobile',
			[
				'label' 		=>  esc_html__( 'Mobile Iframe', 'deep' ),
				'description'	=> esc_html__( 'Shows the share dialog in an iframe on mobile.', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=>  esc_html__( 'Enable', 'deep' ),
				'label_off'		=>	esc_html__( 'Disable', 'deep' ),
				'return_value' 	=> 'true',
				'default' 		=> 'false',
				'condition' 	=> [ //dependency
					'type' 	=> [
						'share'
					],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'classid_section',
			[
				'label' => __( 'Class & ID', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		$this->add_control(
			'shortcodeid', //param_name
			[
				'label' 		=> __( 'Custom ID', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXT, //type
			]
		);

		$this->add_control(
			'shortcodeclass', //param_name
			[
				'label' 		=> __( 'Custom Class', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXT, //type
			]
		);

		$this->end_controls_section();
		
		// Custom css tab
		$this->start_controls_section(
			'custom_css_section',
			[
				'label' => esc_html__('Custom CSS', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
	 * Render Facebook Button widget output on the frontend.
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
		
		if ( empty( $fb_api_code ) ) {
			esc_html_e( 'Please first set your Facebook APP ID in Theme Options > Social Networks > Integrations and refresh this page to display buttons correctly.', 'deep' );
		}

		echo '<div '.$settings['shortcodeid'].' class="'.$settings['shortcodeclass'] . ' wn-facebook-buttons ';

		if ( $settings['type'] == 'like' || $settings['type'] == 'recommend' ) {
			echo 'fb-like"
			data-href="' . $settings['button_url'] . '"
			data-width="' . $settings['width']['size'] . '"
			data-layout="' . $settings['layout'] . '"
			data-action="' . $settings['type'] . '" data-size="' . $settings['size'] . '" data-show-faces="' . $settings['face'] . '" data-share="' . $settings['share'] . '" data-colorscheme="' . $settings['color'] . '">';
		}

		if ( $settings['type'] == 'save' ) {
			echo 'fb-save"
			data-uri="' . $settings['button_url'] . '"
			data-size="' . $settings['size'] . '">';
		}

		if ( $settings['type'] == 'share' ) {
			echo 'fb-share-button"
			data-href="' . $settings['button_url'] . '"
			data-layout="' . $settings['layout_share'] . '"
			data-size="' . $settings['size'] . '"
			data-mobile-iframe="' . $settings['mobile'] . '">';
		}

		echo '</div>';

		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}

	}

}