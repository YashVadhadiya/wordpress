<?php
namespace Elementor;

class Webnus_Element_Widgets_Donate extends \Elementor\Widget_Base {

	/**
	 * Retrieve Donate widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'donate';

	}

	/**
	 * Retrieve Donate widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return __( 'Webnus Donate', 'deep' );

	}

	/**
	 * Retrieve Donate widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-alert';

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
	public function get_style_depends() {

		return [ 'deep-magnific-popup', 'wn-deep-donate' ];

	}

	/**
	 * enqueue JS
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_script_depends() {

		return [ 'deep-magnific-popup', 'deep-donate-button' ];

	}


	/**
	 * Register Donate widget controls.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
		$contact_forms_id = array();
		$contact_forms_name = array();
		if ( $cf7 ) {
			foreach ( $cf7 as $cform ) {
				$contact_forms_id[ $cform->post_title ] = $cform->ID;
				$contact_forms_name[ $cform->post_title ] = $cform->post_title;
			}
		} else {
			$contact_forms_id[ esc_html__( 'No contact forms found', 'deep' ) ] = 0;
			$contact_forms_name[ esc_html__( 'No contact forms found', 'deep' ) ] = esc_html__( 'No contact forms found', 'deep' );
		}
		$contact_forms_array  = array_combine($contact_forms_id, $contact_forms_name);

        // Content Tab
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'General', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		// Donate Content
		$this->add_control(
			'donate_content', //param_name
			[
				'label' 		=> __( 'Content', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA, //type
				'rows' 			=> 10,
				'placeholder' 	=> __( 'Button Text Content', 'deep' ),
			]
		);

		$this->add_control(
			'form_id', //param_name
			[
				'label' 	=> __( 'Select contact form', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'options' 	=> $contact_forms_array,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_section_style',
			[
				'label' => __( 'Style', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
		);

		$this->add_control(
			'color', //param_name
			[
				'label' 	=> __( 'Color', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'info',
				'options' 	=> [
					'default'  	=> esc_html__( 'Default', 'deep' ),
					'red' 		=> esc_html__( 'Red', 'deep' ),
					'blue' 		=> esc_html__( 'Blue', 'deep' ),
					'gray' 		=> esc_html__( 'Gray', 'deep' ),
					'dark-gray' => esc_html__( 'Dark gray', 'deep' ),
					'cherry' 	=> esc_html__( 'Cherry', 'deep' ),
					'orchid' 	=> esc_html__( 'Orchid', 'deep' ),
					'pink' 		=> esc_html__( 'Pink', 'deep' ),
					'orange' 	=> esc_html__( 'Orange', 'deep' ),
					'teal' 		=> esc_html__( 'Teal', 'deep' ),
					'skyblue' 	=> esc_html__( 'SkyBlue', 'deep' ),
					'jade' 		=> esc_html__( 'Jade', 'deep' ),
					'white' 	=> esc_html__( 'White', 'deep' ),
					'black' 	=> esc_html__( 'Black', 'deep' ),
				],
				'description'	=> esc_html__( 'Button Color', 'deep'),
			]
		);

		$this->add_control(
			'size', //param_name
			[
				'label' 	=> esc_html__( 'Size', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'info',
				'options' 	=> [
					'small'  	=> esc_html__( 'Small', 'deep' ),
					'medium' 	=> esc_html__( 'Medium', 'deep' ),
					'large' 	=> esc_html__( 'Large', 'deep' ),
				],
				'description' => esc_html__( 'Button Size', 'deep'),
			]
		);

		$this->add_control(
			'border', //param_name
			[
				'label' 		=> __( 'Bordered?', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::SWITCHER, //type
				'label_on' 		=> __( 'Yes', 'deep' ),
				'label_off' 	=> __( 'No', 'deep' ),
				'return_value' 	=> 'yes',
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => __( 'Icons', 'deep' ),
				'type' => \Elementor\Controls_Manager::ICON,
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'classid_section',
			[
				'label' 	=> __( 'Class & ID', 'deep' ),
				'tab' 		=> \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		$this->add_control(
			'shortcodeid', //param_name
			[
				'label' 	=> __( 'Custom ID', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::TEXT, //type
			]
		);

		$this->add_control(
			'shortcodeclass', //param_name
			[
				'label' 	=> __( 'Custom Class', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::TEXT, //type
			]
		);

		$this->end_controls_section();

		// Custom css tab
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
	 * Render Donate widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$shortcodeclass		= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
		$shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';

		$border 	= ( 'yes' == $settings['border'] ) ? 'bordered-bot' : '';
		$icon_str 	= $settings['icon'] ? '<i class=" ' . $settings['icon'] . ' "></i>' : '';
		$theme_skin	= ( $settings['color'] == 'default' ) ? 'theme-skin' : '' ;

		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}
		echo '<a class="donate-button square button '.$theme_skin.' '.$settings['color'].' '.$settings['size'].' '.$border.' ' . $shortcodeclass . '"  ' . $shortcodeid . '  href="#w-donate-'.get_the_ID().'" data-effect="mfp-zoom-in">
				<span class="media_label">'. $icon_str . $settings['donate_content'] . '</span>
			</a>
			<div id="w-donate-'.get_the_ID().'" class="white-popup mfp-with-anim mfp-hide">
				<div id="donate-contact-modal-'.get_the_ID().'">
					<div class="w-modal modal-donate wn-donate-contact-modal" id="w-donate-'.get_the_ID().'">
						<h3 class="modal-title">'. $settings['donate_content'] .'</h3>
						'.do_shortcode('[contact-form-7 id="'.$settings['form_id'].'" title="' . $settings['donate_content'] . '"]').'
					</div>
				</div>
			</div>';

	}

}
