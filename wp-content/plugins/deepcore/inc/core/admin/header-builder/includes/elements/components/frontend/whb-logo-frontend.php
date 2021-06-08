<?php
function whb_logo( $atts, $uniqid, $once_run_flag ) {
	extract( WHB_Helper::component_atts( array(
		'type'				=> 'image',
		'logo'				=> '',
		'transparent_logo'	=> '',
		'logo_custom_url'	=> '',
		'logo_text'			=> '',
		'extra_class'		=> '',
	), $atts ));

	$out = $styles = '';
	$logo_text			= $logo_text ? $logo_text : get_bloginfo( 'name' );
	$logo				= $logo ? wp_get_attachment_url( $logo ) : DEEP_ASSETS_URL . 'images/whb-logo.png';
	$transparent_logo	= $transparent_logo ? wp_get_attachment_url( $transparent_logo ) : $logo;
	$extra_class		= $extra_class ? ' ' . $extra_class : '' ;
	$logo_custom_url	= $logo_custom_url ? $logo_custom_url : home_url( '/' );

	if ( $once_run_flag ) :
		$dynamic_style = '';
		$dynamic_style .= whb_styling_tab_output( $atts, 'Logo', 'body #wrap #webnus-header-builder [data-id=whb-logo-' . esc_attr( $uniqid ) . '] img.whb-logo' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Transparent Logo', 'body #wrap #webnus-header-builder [data-id=whb-logo-' . esc_attr( $uniqid ) . '] img.whb-logo-transparent' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Text', 'body #wrap #webnus-header-builder [data-id=whb-logo-' . esc_attr( $uniqid ) . '] .wn-site-name' );

		if ( $dynamic_style ) :
			WHB_Helper::set_dynamic_styles( $dynamic_style );
		endif;
	endif;

	// render
	$out .= '<a href="' . esc_url( $logo_custom_url ) . '" class="whb-element whb-logo' . esc_attr( $extra_class ) . '" data-id="whb-logo-' . esc_attr( $uniqid ) . '">';
		if ( ( ! empty( $logo ) || ! empty( $transparent_logo ) ) && $type == 'image' ) {
			$deep_options = deep_options();
			$transparent_header = isset($deep_options['page_transparent_dis']) ? $deep_options['page_transparent_dis'] : 'none' ;
			$transparent_header = ( rwmb_meta( 'deep_transparent_header_meta' ) != 'inherit' ) ? rwmb_meta( 'deep_transparent_header_meta' ) : $transparent_header;
			$src = ( ! empty( $transparent_header ) && $transparent_header == 'dark' ) ? $transparent_logo : $logo;

			if ( is_404() ) {
				$transparent_header = ( isset( $deep_options['deep_404_page_header'] ) && $deep_options['deep_404_page_header'] ) ? $deep_options['deep_404_page_header'] : 'none' ;
            	$src = ( ! empty( $transparent_header ) && $transparent_header != 'none' ) ? $transparent_logo : $logo;
			}

			$transparent_header_class = $transparent_header == 'dark' ? ' whb-logo-transparent' : '';
			$out .= '<img class="whb-logo' . $transparent_header_class . '" src="' . esc_url( $src ) . '" alt="'. get_bloginfo('name') .'">';
		} else {
			$out .= '<span class="wn-site-name">' . $logo_text . '</span>';
		}
	$out .= '</a>';

	return $out;
}

WHB_Helper::add_element( 'logo', 'whb_logo' );
