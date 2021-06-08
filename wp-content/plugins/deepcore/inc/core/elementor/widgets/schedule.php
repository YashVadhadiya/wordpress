<?php
namespace Elementor;
class Webnus_Element_Widgets_Schedule extends \Elementor\Widget_Base {

	/**
	 * Retrieve Schedule widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'schedule';
		
	}

	/**
	 * Retrieve Schedule widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Schedule', 'deep' );

	}

	/**
	 * Retrieve Schedule widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-time-line';

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
		
		return [ 'wn-deep-schedule' ];

	}

	/**
	 * Register Schedule widget controls.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

        // Content Tab
		$this->start_controls_section(
			'content_sectiona',
			[
				'label' => esc_html__( 'General', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		// Schedule Start Text
		$this->add_control(
			'start_date',
			[
				'label' 		=> esc_html__( 'Start Text (date)', 'deep' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> esc_html__( '07-17-2018', 'deep' ),
			]
		);

		// Schedule End Text
		$this->add_control(
			'end_date',
			[
				'label' 		=> esc_html__( 'End Text (date)', 'deep' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> esc_html__( '07-19-2018', 'deep' ),
			]
		);

        // Do you need schedule in dark skin?
        $this->add_control(
            'dark_bg',
            [
                'label'         => esc_html__( 'Dark Background (White Color)', 'deep' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => '',
                'on'            => esc_html__( 'Dark', 'deep' ),
                'off'           => esc_html__( 'Light', 'deep' ),
                'return_value'  => 'enable',
            ]
        );

		// Schedule Items
		$this->add_control(
			'schedule_item',
			[
				'label' 		=> esc_html__( 'Schedule Items', 'deep' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> [
					[
						'name' 			=> 'item_time',
						'label' 		=> esc_html__( 'Time', 'deep' ),
						'type' 			=> Controls_Manager::TEXT,
						'label_block' 	=> true,
					],
					[
						'name' 			=> 'item_title',
						'label' 		=> esc_html__( 'Title', 'deep' ),
						'type' 			=> Controls_Manager::TEXT,
						'label_block' 	=> true,
					],
					[
						'name' 			=> 'item_presenter_name',
						'label' 		=> esc_html__( 'Presenter Name', 'deep' ),
						'type' 			=> Controls_Manager::TEXT,
						'label_block' 	=> true,
					],
					[
						'name' 			=> 'item_presenter_image',
						'label' 		=> esc_html__( 'Presenter Image', 'deep' ),
						'type' 			=> Controls_Manager::MEDIA,
						'default' 		=> [
							'url' 		=> Utils::get_placeholder_image_src(),
						],
					],
					[
						'name' 			=> 'item_location',
						'label' 		=> esc_html__( 'Location', 'deep' ),
						'type' 			=> Controls_Manager::TEXT,
						'label_block' 	=> true,
					],
				],
				'default' => [
					[
						'item_time' => '07-17-2018',
						'item_title' => 'WordPress',
						'item_presenter_name' => 'Jane Smith',
						'item_location' => 'California',
					],
					[
						'item_time' => '07-18-2018',
						'item_title' => 'WordPress',
						'item_presenter_name' => 'Jane Smith',
						'item_location' => 'California',
					],
					[
						'item_time' => '07-19-2018',
						'item_title' => 'WordPress',
						'item_presenter_name' => 'Jane Smith',
						'item_location' => 'California',
					],
				],
			]
		);

		$this->end_controls_section();

		// Class & ID Tab
		$this->start_controls_section(
			'classid_section',
			[
				'label' => __( 'Class & ID', 'deep' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'shortcodeclass',
			[
				'label'	=> esc_html__( 'Extra Class', 'deep' ),
				'type'	=> Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'shortcodeid',
			[
				'label'	=> esc_html__( 'ID', 'deep' ),
				'type'	=> Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();
		
		// Style
		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Content style', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'content_typography',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .wn-schedule-content,#wrap {{WRAPPER}} .wn-schedule-time,#wrap {{WRAPPER}} .wn-schedule-title',
			]
		);

		$this->add_control(
			'content_color', //param_name
			[
				'label' 		=> __( 'Color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-schedule-content,#wrap {{WRAPPER}} .wn-schedule-time,#wrap {{WRAPPER}} .wn-schedule-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_line_style',
			[
				'label' => __( 'Line style', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'line_color', //param_name
			[
				'label' 		=> __( 'Color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-schedule-box:before,#wrap {{WRAPPER}} .wn-schedule-date,#wrap {{WRAPPER}} .wn-schedule-event:before' => 'background: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		// Custom css tab
		$this->start_controls_section(
			'custom_css_section_style',
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
	 * Render Schedule widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings 			= $this->get_settings_for_display();		    
		$start_date 		= $settings['start_date'];
		$end_date 			= $settings['end_date'];
		$schedule_item 		= $settings['schedule_item'];
        // Class & ID 
        $shortcodeclass 	= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
        $shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';
		if ( 'enable' == $settings['dark_bg'] ) {
			$dark_class			= 'w-s-darkbg';
		} else {
			$dark_class = '';
		}

		// render
		if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
			require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
		}
		$image = new \Wn_Img_Maniuplate;
		$out  = '
		<div class="wn-schedule-wrap ' . $dark_class . ' ' . $shortcodeclass . '"  ' . $shortcodeid . '>
			<div class="wn-schedule-box">
				<div class="wn-schedule-date w-s-date-start">' . $start_date . '</div>';
					foreach ( $schedule_item as $line ) :
						$item_time				= $line['item_time'] ? $line['item_time']	: '';
						$item_title				= $line['item_title'] ? $line['item_title']	: '';
						$item_presenter_name	= $line['item_presenter_name'] ? $line['item_presenter_name'] :	''	;
						$item_presenter_image	= !empty( $line['item_presenter_image']['id'] ) ? $image->m_image( $line['item_presenter_image']['id'], $line['item_presenter_image']['url'] , '28' , '28' ) : '';
						$item_location			= $line['item_location'] ? $line['item_location'] : '';

						if ( !empty ( $item_presenter_image ) ) {
							$presenter_image = '<img src="' . esc_url( $item_presenter_image ) . '" alt="' . esc_attr( $item_presenter_name ) . '">';
						} else {
							$presenter_image = '';
						}

						$out .= '<div class="wn-schedule-event">';
							$out .=	!empty ( $item_time ) ? '<div class="wn-schedule-time">' . $item_time . '</div>' : '';
							$out .=	'<div class="wn-schedule-content">';
							$out .=	!empty ( $item_title ) ?'<div class="wn-schedule-title">' . $item_title . '</div>' : '';
							$out .=	( empty ( $presenter_image ) && empty ( $item_presenter_name ) ) ? '' : '<div class="wn-schedule-presenter"> ' . $presenter_image . ' ' . $item_presenter_name . '</div>';
							$out .=	!empty ( $item_location ) ?	'<div class="wn-schedule-location">' . $item_location . '</div>' : '';
							$out .=	'</div>';
						$out .=	'</div>';

					endforeach;
				
		$out .= '
				<div class="wn-schedule-date w-s-date-end">' . $end_date . '</div>
			</div>
		</div>';

		if ( !empty($settings['line_color']) ) {
			deep_save_dyn_styles( '#wrap .elementor-element-'.$this->get_id().' .wn-schedule-event:before {box-shadow: 0 0 0 4px '.$settings['line_color'].'}' );
			if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
				echo '<style>#wrap .elementor-element-'.$this->get_id().' .wn-schedule-event:before {box-shadow: 0 0 0 4px '.$settings['line_color'].'}</style>';
			}
		}

        $custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}

		echo $out;
		
	}

}