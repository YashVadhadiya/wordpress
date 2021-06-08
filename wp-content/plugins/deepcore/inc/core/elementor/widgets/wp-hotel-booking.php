<?php
namespace Elementor;
class HTC_Element_Widgets_Booking_Form extends \Elementor\Widget_Base {

	/**
	 * Retrieve Distance widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'hotel_booking_form';
		
	}

	/**
	 * Retrieve Distance widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Hotel Booking Form', 'deep' );

	}

	/**
	 * Retrieve Distance widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'sl-calendar';

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
	 * Register Distance widget controls.
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
				'label' => esc_html__( 'General', 'deep' ),
				'tab' => Controls_Manager::TAB_CONTENT,
            ]
		);

		$this->add_control(
			'type', //param_name
			[
				'label' 	=> __( 'Select Type', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'vertical',
				'options' 	=> [
					'vertical'   => __( 'Vertical', 'deep' ),
					'horizontal' => __( 'Horizontal', 'deep' ),
				],
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
	 * Render Distance widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

        $type   = $settings['type'] == 'vertical' ? 'vertical' : 'horizontal';

        if ( ! class_exists( 'WPHB_Room' ) ) {
			WP_Hotel_Booking::instance()->_include( 'includes/class-wphb-room.php' );
		}

		$start_date = hb_get_request( 'hb_check_in_date' );
		if ( $start_date ) {
			$start_date = date( 'm/d/Y', $start_date );
		}

		$end_date = hb_get_request( 'hb_check_out_date' );
		if ( $end_date ) {
			$end_date = date( 'm/d/Y', $end_date );
		}
		$adults    = hb_get_request( 'adults', 1 );
		$max_child = hb_get_request( 'max_child', 0 );

		$atts = wp_parse_args(
			array(
				'check_in_date'  => $start_date,
				'check_out_date' => $end_date,
				'adults'         => $adults,
				'max_child'      => $max_child,
				'search_page'    => null,
				'widget_search'  => false
			)
        );

		$page = hb_get_request( 'hotel-booking' );

		$template      = 'search/search-page.php';
		$template_args = array();

		// find the url for form action
		$search_permalink = '';
		if ( $search_page = $atts['search_page'] ) {
			if ( is_numeric( $search_page ) ) {
				$search_permalink = get_the_permalink( $search_page );
			} else {
				$search_permalink = $search_page;
			}
		} else {
			$search_permalink = hb_get_url();
		}
		$template_args['search_page'] = $search_permalink;
		/**
		 * Add argument use in shortcode display
		 */
		$template_args['atts'] = $atts;

		/**
		 * Display the template based on current step
		 */

		switch ( $page ) {
			case 'results':
				if ( ! isset( $atts['page'] ) || $atts['page'] !== 'results' ) {
					break;
				}

				$template                 = 'search/results.php';
				$template_args['results'] = hb_search_rooms(
					array(
						'check_in_date'  => $start_date,
						'check_out_date' => $end_date,
						'adults'         => $adults,
						'max_child'      => $max_child
					)
				);
				break;
			default:
				$template = 'search/search-page.php';
				break;
		}

		$template = apply_filters( 'hotel_booking_shortcode_template', $template );

        echo '<div class="htc-booking ' . $type . '">';        
        do_action( 'hb_wrapper_start' );
        hb_get_template( $template, $template_args );
        do_action( 'hb_wrapper_end' );   
		echo '</div>';
        $custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
        }

	}

}