<?php
namespace Elementor;
class Webnus_Element_Widgets_Facebook_Embed extends \Elementor\Widget_Base {

	/**
	 * Retrieve Facebook Embed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'wn_facebook_embed';
		
	}

	/**
	 * Retrieve Facebook Embed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return __( 'Webnus Facebook Embed', 'deep' );

	}

	/**
	 * Retrieve Facebook Embed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-fb-embed';

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
	 * Register Facebook Embed widget controls.
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
				'label' 	=> esc_html__('Embed Type', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'comment',
				'options' 	=> [
					'comment' 	=> esc_html__( 'Comments', 'deep' ),
					'post'  	=> esc_html__( 'Posts', 'deep' ),
					'video' 	=> esc_html__( 'Videos', 'deep' ),
				],
			]
		);

		$this->add_control(
			'url', //param_name
			[
				'label' 		=> esc_html__('URL', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXT, //type
				'placeholder' 	=> esc_html__('https://example.com', 'deep' ),
			]
		);

		$this->add_control(
			'width_1',
			[
				'label' 		=>  esc_html__( 'Width' , 'deep'),
				'type' 			=> Controls_Manager::SLIDER,
				'description'   =>  esc_html__( 'The pixel width of the embed', 'deep'),
				'size_units' 	=> [ 'px' ],
				'range' => [
					'px' => [
						'min' => 220,
						'max' => 2000,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 560,
				],
				'condition' 	=> [ //dependency
					'type' 	=> [
						'comment'
					],
				],
			]
		);

		$this->add_control(
			'width_2',
			[
				'label' 		=>  esc_html__( 'Width' , 'deep'),
				'type' 			=> Controls_Manager::SLIDER,
				'description'   =>  esc_html__( 'The pixel width of the embed', 'deep'),
				'size_units' 	=> [ 'px' ],
				'range' => [
					'px' => [
						'min' => 220,
						'max' => 2000,
					],
				],
				'condition' 	=> [ //dependency
					'type' 	=> [
						'video'
					],
				],
			]
		);

		$this->add_control(
			'width_3',
			[
				'label' 		=>  esc_html__( 'Width' , 'deep'),
				'type' 			=> Controls_Manager::SLIDER,
				'description'   =>  esc_html__( 'The pixel width of the embed (Leave empty to use fluid width.)', 'deep'),
				'size_units' 	=> [ 'px' ],
				'range' => [
					'px' => [
						'min' => 350,
						'max' => 750,
					],
				],
				'condition' 	=> [ //dependency
					'type' 	=> [
						'post'
					],
				],
			]
		);

		$this->add_control(
			'parent',
			[
				'label' 		=>  esc_html__( 'Include parent comment', 'deep' ),
				'description'   =>  esc_html__( 'If url is a reply', 'deep'),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=>  esc_html__( 'Enable', 'deep' ),
				'label_off'		=>	esc_html__( 'Disable', 'deep' ),
				'return_value' 	=> 'true',
				'default' 		=> 'false',
				'condition' 	=> [ //dependency
					'type' 	=> [
						'comment'
					],
				],
			]
		);

		$this->add_control(
			'full_post',
			[
				'label' 		=>  esc_html__( 'Include full post', 'deep' ),
				'description'   =>  esc_html__( 'Applied to photo post', 'deep'),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=>  esc_html__( 'Enable', 'deep' ),
				'label_off'		=>	esc_html__( 'Disable', 'deep' ),
				'return_value' 	=> 'true',
				'default' 		=> 'false',
				'condition' 	=> [ //dependency
					'type' 	=> [
						'post'
					],
				],
			]
		);

		$this->add_control(
			'full_post_v',
			[
				'label' 		=>  esc_html__( 'Text with Video', 'deep' ),
				'description'   =>  esc_html__( 'Include the text from the Facebook post associated with the video. Only available for desktop sites.', 'deep'),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=>  esc_html__( 'Show', 'deep' ),
				'label_off'		=>	esc_html__( 'Hide', 'deep' ),
				'return_value' 	=> 'true',
				'default' 		=> 'false',
				'condition' 	=> [ //dependency
					'type' 	=> [
						'video'
					],
				],
			]
		);

		$this->add_control(
			'full_screen',
			[
				'label' 		=>  esc_html__( 'Fullscreen', 'deep' ),
				'description'   =>  esc_html__( 'Allow the video to be played in fullscreen mode', 'deep'),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=>  esc_html__( 'Enable', 'deep' ),
				'label_off'		=>	esc_html__( 'Disable', 'deep' ),
				'return_value' 	=> 'true',
				'default' 		=> 'false',
				'condition' 	=> [ //dependency
					'type' 	=> [
						'video'
					],
				],
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' 		=>  esc_html__( 'Auto Play', 'deep' ),
				'description'   =>  esc_html__( 'Automatically start playing the video when the page loads. The video will be played without sound (muted). People can turn on sound via the video player controls. This setting does not apply to mobile devices.', 'deep'),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=>  esc_html__( 'Enable', 'deep' ),
				'label_off'		=>	esc_html__( 'Disable', 'deep' ),
				'return_value' 	=> 'true',
				'default' 		=> 'false',
				'condition' 	=> [ //dependency
					'type' 	=> [
						'video'
					],
				],
			]
		);

		$this->add_control(
			'caption',
			[
				'label' 		=>  esc_html__( 'Caption', 'deep' ),
				'description'   =>  esc_html__( 'Show captions (if available) by default. Captions are only available on desktop.', 'deep'),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=>  esc_html__( 'Show', 'deep' ),
				'label_off'		=>	esc_html__( 'Hide', 'deep' ),
				'return_value' 	=> 'true',
				'default' 		=> 'false',
				'condition' 	=> [ //dependency
					'type' 	=> [
						'video'
					],
				],
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
	 * Render Facebook Embed widget output on the frontend.
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

		if ( $settings['type'] == 'comment' && !empty($settings['url']) ) :
			echo '<div '.$settings['shortcodeid'].' class="'.$settings['shortcodeclass'].' wn-facebook-embed-comments fb-comment-embed"
					data-href="'.$settings['url'].'"
					data-width="'.$settings['width_1']['size'].'"
					data-include-parent="'.$settings['parent'].'">
				</div>';
		endif;

		if ( $settings['type'] == 'post' && !empty($settings['url']) ) :
			echo '<div '.$settings['shortcodeid'].' class="'.$settings['shortcodeclass'].' wn-facebook-embed-posts fb-post"
					data-href="'.$settings['url'].'"
					data-width="'.$settings['width_3']['size'].'"
					data-show-text="'.$settings['full_post'].'">
				</div>';
		endif;

		if ( $settings['type'] == 'video' && !empty($settings['url']) ) :
			echo '<div  '.$settings['shortcodeid'].' class="'.$settings['shortcodeclass'].' wn-facebook-embed-videos fb-video"
					data-href="'.$settings['url'].'"
					data-width="'.$settings['width_2']['size'].'"
					data-allowfullscreen="'.$settings['full_screen'].'"
					data-autoplay="'.$settings['autoplay'].'"
					data-show-captions="'.$settings['caption'].'"
					data-show-text="'.$settings['full_post_v'].'">
				</div>';
		endif;

		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}

	}

}