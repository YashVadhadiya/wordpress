<?php
namespace Elementor;
class Webnus_Element_Widgets_Facebook_Page extends \Elementor\Widget_Base {

	/**
	 * Retrieve Facebook Page widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'wn_facebook_page';
		
	}

	/**
	 * Retrieve Facebook Page widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return __( 'Webnus Facebook Page/Group', 'deep' );

	}

	/**
	 * Retrieve Facebook Page widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-fb-feed';

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
	 * Register Facebook Page widget controls.
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
				'default' 	=> 'page',
				'options' 	=> [
					'page'  	=> esc_html__( 'Page', 'deep' ),
					'group' 	=> esc_html__( 'Group', 'deep' ),
				],
			]
		);

		$this->add_control(
			'page_url', //param_name
			[
				'label' 		=> esc_html__('Facebook URL', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXT, //type
				'placeholder' 	=> esc_html__('https://example.com', 'deep' ),
			]
		);

		$this->add_control(
			'tabs',
			[
				'label' 	=> esc_html__( 'Tabs', 'deep' ),
				'type' 		=> \Elementor\Controls_Manager::SELECT2,
				'multiple' 	=> true,
				'options' 	=> [
					'timeline'  => esc_html__( 'Timeline', 'deep' ),
					'events' 	=> esc_html__( 'Events', 'deep' ),
					'messages' 	=> esc_html__( 'Messages', 'deep' ),
				],
				'condition' 	=> [ //dependency
					'type' 	=> [
						'page'
					],
				],
			]
		);

		$this->add_control(
			'width',
			[
				'label' 		=>  esc_html__( 'Width' , 'deep'),
				'type' 			=> Controls_Manager::SLIDER,
				'description'   =>  esc_html__( 'The pixel width of the embed (Min. 180 to Max. 500)', 'deep'),
				'size_units' 	=> [ 'px' ],
				'range' => [
					'px' => [
						'min' => 180,
						'max' => 500,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 340,
				],
			]
		);

		$this->add_control(
			'height',
			[
				'label' 		=>  esc_html__( 'Height' , 'deep'),
				'type' 			=> Controls_Manager::SLIDER,
				'description'   =>  esc_html__( 'The pixel height of the embed (Min. 70)', 'deep'),
				'size_units' 	=> [ 'px' ],
				'range' => [
					'px' => [
						'min' => 70,
						'max' => 2000,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 500,
				],
				'condition' 	=> [ //dependency
					'type' 	=> [
						'page'
					],
				],
			]
		);

		$this->add_control(
			'header',
			[
				'label' 		=>  esc_html__( 'Small Header', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=>  esc_html__( 'Enable', 'deep' ),
				'label_off'		=>	esc_html__( 'Diable', 'deep' ),
				'return_value' 	=> 'true',
				'default' 		=> 'false',
				'condition' 	=> [ //dependency
					'type' 	=> [
						'page'
					],
				],
			]
		);

		$this->add_control(
			'cover',
			[
				'label' 		=>  esc_html__( 'Cover Photo', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=>  esc_html__( 'Show', 'deep' ),
				'label_off'		=>	esc_html__( 'Hide', 'deep' ),
				'return_value' 	=> 'false',
				'default' 		=> 'false',
				'condition' 	=> [ //dependency
					'type' 	=> [
						'page'
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
				'default' 		=> 'true',
				'condition' 	=> [ //dependency
					'type' 	=> [
						'page'
					],
				],
			]
		);

		$this->add_control(
			'container',
			[
				'label' 		=>  esc_html__( 'Adapt to plugin container width', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=>  esc_html__( 'Enable', 'deep' ),
				'label_off'		=>	esc_html__( 'Disable', 'deep' ),
				'return_value' 	=> 'true',
				'default' 		=> 'true',
				'condition' 	=> [ //dependency
					'type' 	=> [
						'page'
					],
				],
			]
		);

		$this->add_control(
			'call_to_action',
			[
				'label' 		=>  esc_html__( 'Custom call to action button (if available)', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=>  esc_html__( 'Show', 'deep' ),
				'label_off'		=>	esc_html__( 'Hide', 'deep' ),
				'return_value' 	=> 'false',
				'default' 		=> 'true',
				'condition' 	=> [ //dependency
					'type' 	=> [
						'page'
					],
				],
			]
		);

		$this->add_control(
			'skin', //param_name
			[
				'label' 	=> esc_html__('Skin', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'light',
				'options' 	=> [
					'light'  	=> esc_html__( 'light', 'deep' ),
					'dark' 		=> esc_html__( 'Dark', 'deep' ),
				],
				'condition' 	=> [ //dependency
					'type' 	=> [
						'group'
					],
				],
			]
		);

		$this->add_control(
			'metadata',
			[
				'label' 		=>  esc_html__( 'Metadata', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=>  esc_html__( 'Show', 'deep' ),
				'label_off'		=>	esc_html__( 'Hide', 'deep' ),
				'return_value' 	=> 'true',
				'default' 		=> 'false',
				'condition' 	=> [ //dependency
					'type' 	=> [
						'group'
					],
				],
			]
		);

		$this->add_control(
			'social',
			[
				'label' 		=>  esc_html__( 'Social Context', 'deep' ),
				'description'	=>  esc_html__( 'Include number of friends who are already a member in the group', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=>  esc_html__( 'Show', 'deep' ),
				'label_off'		=>	esc_html__( 'Hide', 'deep' ),
				'return_value' 	=> 'true',
				'default' 		=> 'true',
				'condition' 	=> [ //dependency
					'type' 	=> [
						'group'
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
	 * Render Facebook Page widget output on the frontend.
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
		$settings['cover'] 			= empty( $settings['cover'] ) ? 'true' : 'false';
		$settings['face'] 			= empty( $settings['face'] ) ? 'false' : 'true';
		$settings['container'] 		= empty( $settings['container'] ) ? 'false' : 'true';
		$settings['call_to_action'] = empty( $settings['call_to_action'] ) ? 'true' : 'false';
		$settings['tabs'] 			= !empty( $settings['tabs'] ) ? implode(',', $settings['tabs']) : '' ;
		
		if ( empty( $fb_api_code ) ) {
			esc_html_e( 'Please first set your Facebook APP ID in Theme Options > Social Networks > Integrations and refresh this page to display buttons correctly.', 'deep' );
		}


		if ( !empty($settings['page_url']) && $settings['type'] == 'page'  ) {
			echo '<div '.$settings['shortcodeid'].' class="'.$settings['shortcodeclass'].' wn-facebook-page fb-page"
			data-href="' . $settings['page_url'] . '"
			data-tabs="' . $settings['tabs'] . '"
			data-width="' . $settings['width']['size'] . '"
			data-height="' . $settings['height']['size'] . '"
			data-small-header="' . $settings['header'] . '"
			data-adapt-container-width="' . $settings['container'] . '"
			data-hide-cover="' . $settings['cover'] . '"
			data-show-facepile="' . $settings['face'] . '"
			hide_cta="' . $settings['call_to_action'] . '"></div>';
		}

		if ( !empty($settings['page_url']) && $settings['type'] == 'group'  ) {
			echo '<div '.$settings['shortcodeid'].' class="'.$settings['shortcodeclass'].' wn-facebook-group fb-group"
			data-href="' . $settings['page_url'] . '"
			data-width="' . $settings['width']['size'] . '"
			data-show-social-context="' . $settings['social'] . '"
			data-show-metadata="' . $settings['metadata'] . '"
			data-skin="' . $settings['skin'] . '"></div>';
		}

		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}

	}

}