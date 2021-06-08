<?php
function whb_icon_content( $atts, $uniqid, $once_run_flag ) {
	extract( WHB_Helper::component_atts( array(
		'content'		=> '',
		'icon'			=> '',
		'extra_class'	=> '',
	), $atts ));

	$out = '';

	$content = ! empty( $content ) ? '<span>' . $content . '</span>' : '' ;
	$icon	 = ! empty( $icon ) ? '<i class="' . $icon . '" ></i>' : '' ;

	// styles
	if ( $once_run_flag ) :
		$dynamic_style = '';
        $dynamic_style .= whb_styling_tab_output( $atts, 'Text', 'body #wrap #webnus-header-builder [data-id=whb-icon-content-' . esc_attr( $uniqid ) .'] span','body #wrap #webnus-header-builder [data-id=whb-icon-content-' . esc_attr( $uniqid ) .']:hover span' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Icon', 'body #wrap #webnus-header-builder [data-id=whb-icon-content-' . esc_attr( $uniqid ) .'] i','body #wrap #webnus-header-builder [data-id=whb-icon-content-' . esc_attr( $uniqid ) .']:hover i'  );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Background', 'body #wrap #webnus-header-builder [data-id=whb-icon-content-' . esc_attr( $uniqid ) .']' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Box', 'body #wrap #webnus-header-builder [data-id=whb-icon-content-' . esc_attr( $uniqid ) .']' );

        if ( $dynamic_style ) :
            WHB_Helper::set_dynamic_styles( $dynamic_style );
        endif;
	endif;

	// extra class
	$extra_class = $extra_class ? ' ' . $extra_class : '' ;

	// render
	$out .= '
		<div class="whb-element whb-icon-content' . esc_attr( $extra_class ) . '" data-id="whb-icon-content-' . esc_attr( $uniqid ) . '">
			' . $icon . $content . '
		</div>';

	return $out;
}

WHB_Helper::add_element( 'icon-content', 'whb_icon_content' );
