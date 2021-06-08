<?php
function whb_jpSocial( $atts, $uniqid, $once_run_flag ) {
	extract( WHB_Helper::component_atts( array(
		'extra_class'	=> '',
	), $atts ));

	$out = '';

	// styles
	if ( $once_run_flag ) :
		$dynamic_style = '';
        $dynamic_style .= whb_styling_tab_output( $atts, 'Social Icons', 'body #wrap #webnus-header-builder [data-id=whb-jpsocial-' . esc_attr( $uniqid ) . '] nav ul li a' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Social Box', 'body #wrap #webnus-header-builder [data-id=whb-jpsocial-' . esc_attr( $uniqid ) . ']' );

        if ( $dynamic_style ) :
            WHB_Helper::set_dynamic_styles( $dynamic_style );
        endif;
	endif;

	// extra class
	$extra_class = $extra_class ? ' ' . $extra_class : '' ;

	// render
	$out .= '
		<div class="whb-element whb-element-wrap whb-jpsocial-wrap whb-jpsocial' . esc_attr( $extra_class ) . '" data-id="whb-jpsocial-' . esc_attr( $uniqid ) . '">';
		ob_start();

			if ( function_exists( 'jetpack_social_menu' ) ) jetpack_social_menu();
			
		$out .= ob_get_contents();
		ob_end_clean();
	$out .= '</div>';

	return $out;
}

WHB_Helper::add_element( 'jetpacksocial', 'whb_jpSocial' );
