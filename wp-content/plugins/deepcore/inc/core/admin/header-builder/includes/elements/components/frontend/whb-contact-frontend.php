<?php
function whb_contact_f( $atts, $uniqid, $once_run_flag ) {
	extract( WHB_Helper::component_atts( array(
		'contact_form'		=> '',
		'contact_type'		=> 'icon',
		'custom_text'		=> 'CONTACT US',
		'open_form'			=> 'modal',
		'contact_text'		=> 'CONTACT US',
		'show_tooltip'		=> 'false',
		'tooltip_text'		=> 'Contact',
		'tooltip_position'	=> 'tooltip-on-bottom',
		'extra_class'		=> '',
	), $atts ));

	$out = $data_tooltip = $contact_extra_class = $modal = '';

	// login
	$contact_type 		= $contact_type ? $contact_type : '' ;
	$contact_text 		= $contact_text ? $custom_text : 'CONTACT US' ;
	$open_form 			= $open_form ? $open_form : '' ;

	// tooltip
	$tooltip_text	= ! empty( $tooltip_text ) ? $tooltip_text : '' ;
	$tooltip = $tooltip_class = '';

	if ( $show_tooltip == 'true' && $tooltip_text ) :
		$tooltip_position 	= ( isset( $tooltip_position ) && $tooltip_position ) ? $tooltip_position : 'tooltip-on-bottom';
		$tooltip_class		= ' whb-tooltip ' . $tooltip_position;
		$tooltip			= ' data-tooltip=" ' . esc_attr( $tooltip_text ) . ' "';
	endif;

	// styles
	if ( $once_run_flag ) :
		$dynamic_style = '';
        $dynamic_style .= whb_styling_tab_output( $atts, 'Text', 'body #wrap #webnus-header-builder [data-id=whb-contact-' . esc_attr( $uniqid ) .'] .whb-contact-text','body #wrap #webnus-header-builder [data-id=whb-contact-' . esc_attr( $uniqid ) .']:hover .whb-contact-text' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Icon', 'body #wrap #webnus-header-builder [data-id=whb-contact-' . esc_attr( $uniqid ) . '] #whb-icon-element i', 'body #wrap #webnus-header-builder [data-id=whb-contact-' . esc_attr( $uniqid ) . ']:hover #whb-icon-element i'  );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Box', 'body #wrap #webnus-header-builder [data-id=whb-contact-' . esc_attr( $uniqid ) .']' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Form', 'body #w-contact-' . esc_attr( $uniqid ) .' .wpcf7' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Tooltip', 'body #wrap #webnus-header-builder [data-id=whb-contact-' . esc_attr( $uniqid ) .'].whb-tooltip[data-tooltip]:before' );

        if ( $dynamic_style ) :
            WHB_Helper::set_dynamic_styles( $dynamic_style );
        endif;
	endif;

	// extra class
	$extra_class = $extra_class ? ' ' . $extra_class : '' ;

	if ( ( $contact_type == 'text' || $contact_type == 'icon' ) && ( $open_form == 'modal' ) ) {
		$contact_extra_class = 'whb-header-toggle';
	} elseif ( ( $contact_type == 'text' || $contact_type == 'icon' ) && ( $open_form == 'dropdown' ) ){
		$contact_extra_class = 'whb-header-dropdown';
	}

	// render
	if ( ( $contact_type == 'text' || $contact_type == 'icon' ) && ( $open_form == 'dropdown' ) ) {
		$out .= '<div class="whb-element whb-icon-wrap whb-contact ' . esc_attr( $extra_class ) . ' ' . $contact_extra_class . '"  data-id="whb-contact-' . esc_attr( $uniqid ) . '">';
	} else {
		$out .= '<div class="whb-element whb-icon-wrap whb-contact ' . esc_attr( $tooltip_class . $extra_class ) . ' ' . $contact_extra_class . '"  data-id="whb-contact-' . esc_attr( $uniqid ) . '" ' . $tooltip . '>';
	}

		if ( ( $contact_type == 'text' || $contact_type == 'icon' ) && ( $open_form == 'modal' ) ) {
			$out .= '<a class="whb-modal-element whb-modal-target-link" href="#w-contact-' . esc_attr( $uniqid ) . '" data-effect="mfp-zoom-in"></a>';
		}

		if ( $contact_type == 'text' || $contact_type == 'icon' ) {
			$out .= '<div id="whb-icon-element" class="whb-icon-element hcolorf">';
						if ( $contact_type == 'text' ) {
							$out .= '<span id="contact-header-icon" class="whb-contact-text">' . $contact_text . '</span>';
						} elseif ( $contact_type == 'icon' )  {
							$out .= '<i id="contact-header-icon" class="ti-email"></i>';
						}
			$out .= '</div>';

		}

		if ( ( $contact_type == 'text' || $contact_type == 'icon' ) && ( $open_form == 'modal' ) ) {
			$out .= '<div id="w-contact-' . esc_attr( $uniqid ) . '" class="w-modal modal-contact white-popup mfp-with-anim mfp-hide">
					<h3 class="modal-title"> ' . esc_html__( 'CONTACT', 'deep' ) . '</h3>';
		}
		if ( ( $contact_type == 'text' || $contact_type == 'icon' ) && ( $open_form == 'dropdown' ) ) {
			$out .= '<div class="whb-trigger-element ' . esc_attr( $tooltip_class ) . '" id="wn-contact-dropdown-icon" ' . $tooltip . '></div><div id="wn-contact-form-wrap" class="wn-contact-form wn-element-dropdown">';
		}

		if ( ( $contact_type == 'form' ) ) {
			$out .= '<div id="wn-contact-form-' . esc_attr( $uniqid ) . '" class="wn-contact-form whb-header-form-style">';
		}

		if ( ! empty( $contact_form ) ) {
			$out .=	do_shortcode( '[contact-form-7 id="' . $contact_form . '" title="' . esc_attr( 'Contact' ) . '"]' );
		} else {
			$out .=	esc_html__( 'Please select a from in Theme Option.', 'deep' );
		}

			$out .= '</div>';
	$out .= '</div>';
	return $out;

}

WHB_Helper::add_element( 'contact', 'whb_contact_f' );
