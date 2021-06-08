<?php
function whb_booking_form( $atts, $uniqid, $once_run_flag ) {
	extract( WHB_Helper::component_atts( array(
		'wn_form_type'		=> '1',
		'extra_class'		=> '',
	), $atts ));

	if ( is_plugin_active( 'wp-hotel-booking/wp-hotel-booking.php' ) ) {

		ob_start();

		switch ($wn_form_type) {
			case '1':
				$type = 'horizontal';
				break;

			case '2':
				$type = 'vertical';
				break;

			default:
				$type = 'horizontal';
				break;
		}

		// styles
		if ( $once_run_flag ) :

			$dynamic_style = '';
			$dynamic_style .= whb_styling_tab_output( $atts, 'Icon', '#wrap #webnus-header-builder [data-id=whb-booking-form-' . esc_attr( $uniqid ) . '] i.htc-booking-vertical-btn', '#wrap #webnus-header-builder [data-id=whb-booking-form-' . esc_attr( $uniqid ) . ']:hover i.htc-booking-vertical-btn');
			$dynamic_style .= whb_styling_tab_output( $atts, 'Box', '#wrap #webnus-header-builder [data-id=whb-booking-form-' . esc_attr( $uniqid ) . ']');
			$dynamic_style .= whb_styling_tab_output( $atts, 'Form Box', '#wrap #webnus-header-builder [data-id=whb-booking-form-' . esc_attr( $uniqid ) . ']  .htc-booking.vertical, #wrap #webnus-header-builder [data-id=whb-booking-form-' . esc_attr( $uniqid ) . ']  .htc-booking.horizontal');

			if ( $dynamic_style ) :
				WHB_Helper::set_dynamic_styles( $dynamic_style );
			endif;
		endif;

		// extra class
        $extra_class = $extra_class ? ' ' . $extra_class : '';

		if ( is_plugin_active( 'wp-hotel-booking/wp-hotel-booking.php' ) && ! class_exists( 'WPHB_Room' ) ) {
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
				$template = 'search/search-form.php';
				break;
		}

		$template = apply_filters( 'hotel_booking_shortcode_template', $template );

		switch ($wn_form_type) {
			case '1':
				echo '<div class="whb-element whb-wrap-booking-header ' . esc_attr( $extra_class ) . '" data-id="whb-booking-form-' . esc_attr( $uniqid ) . '">';
				echo '<div class="booking-header-icon-res">';
				echo '<i class="htc-booking-vertical-btn sl-event"></i>';
				echo '</div>';
				echo '<div class="htc-booking ' . $type . '">';
				do_action( 'hb_wrapper_start' );
				hb_get_template( $template, $template_args );
				do_action( 'hb_wrapper_end' );
				echo '</div>';
				echo '</div>';
			break;

			case '2':
				echo '<div class="whb-element whb-icon-wrap whb-wrap-booking-header whb-header-toggle ' . esc_attr( $extra_class ) . '" data-id="whb-booking-form-' . esc_attr( $uniqid ) . '">';
				echo '<div class="booking-header-icon">';
				echo '<i class="htc-booking-vertical-btn sl-event"></i>';
				echo '</div>';
				echo '<div class="htc-booking ' . $type . ' js-contentToggle__content">';
				echo '<h2 class="title-booking-vertical">Your Reservation</h2>';
				do_action( 'hb_wrapper_start' );
				hb_get_template( $template, $template_args );
				do_action( 'hb_wrapper_end' );
				echo '</div>';
				echo '</div>';
			break;
		}

		$out = ob_get_contents();
		ob_end_clean();
		return $out;
	}

}

WHB_Helper::add_element( 'booking-form', 'whb_booking_form' );
