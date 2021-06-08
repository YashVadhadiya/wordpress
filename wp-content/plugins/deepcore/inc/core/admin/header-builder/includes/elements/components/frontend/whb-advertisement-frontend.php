<?php
function whb_advertisement( $atts, $uniqid, $once_run_flag ) {
	extract( WHB_Helper::component_atts( array(
		'image'			=> '',
		'link'			=> '',
		'link_new_tab'	=> 'false',
		'html_text'		=> '',
		'extra_class'	=> '',
	), $atts ));

	$out = '';

	$image			= $image ?  wp_get_attachment_url( $image )  : '' ;
	$link			= $link ? $link : '' ;
	$html_text		= $html_text ? $html_text : '' ;
	$link_new_tab	= $link_new_tab == 'true' ? 'target="_blank"' : '' ;

	// styles
	if ( $once_run_flag ) :

		$dynamic_style = '';
        $dynamic_style .= whb_styling_tab_output( $atts, 'Image', 'body #wrap #webnus-header-builder [data-id=whb-advertisement-' . esc_attr( $uniqid ) . '] img.whb-advertisement-image' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Background', 'body #wrap #webnus-header-builder [data-id=whb-advertisement-' . esc_attr( $uniqid ) . ']' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Box', 'body #wrap #webnus-header-builder [data-id=whb-advertisement-' . esc_attr( $uniqid ) . ']' );

        if ( $dynamic_style ) :
            WHB_Helper::set_dynamic_styles( $dynamic_style );
        endif;

	endif;

	// extra class
	$extra_class = $extra_class ? ' ' . $extra_class : '' ;

	// render
	$out .= '
		<div class="whb-element whb-element-wrap whb-advertisement-wrap whb-advertisement' . esc_attr( $extra_class ) . '" data-id="whb-advertisement-' . esc_attr( $uniqid ) . '">';

		if ( ! empty ( $html_text ) ) {
			$out .= $html_text;
		}

		if ( ! empty ( $link ) ) {
			$out .= '<a href="' . esc_attr( $link ) . '" '. $link_new_tab .'>';
		}

		if ( ! empty ( $image ) ) {
			$out .= '<img class="whb-advertisement-image" src="' . esc_url( $image ) . '" alt="'. get_bloginfo('name') .'">';
		}
				
		if ( ! empty ( $link ) ) {
			$out .= '</a>';
		}

	$out .= '</div>';

	return $out;
}

WHB_Helper::add_element( 'advertisement', 'whb_advertisement' );
