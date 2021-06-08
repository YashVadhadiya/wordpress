<?php
function whb_map( $atts, $uniqid, $once_run_flag ) {
	extract( WHB_Helper::component_atts( array(
		'address'		=> '3175 Highland Ave, Selma, CA 93662',
		'show_icon'		=> 'true',
		'text'			=> '',
		'extra_class'	=> '',
	), $atts ));

	$out = '';

	// styles
	if ( $once_run_flag ) :
		$dynamic_style = '';
        $dynamic_style .= whb_styling_tab_output( $atts, 'Text', 'body #wrap #webnus-header-builder [data-id=whb-map-' . esc_attr( $uniqid ) .'] span' ,'body #wrap #webnus-header-builder [data-id=whb-map-' . esc_attr( $uniqid ) .']:hover span'  );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Icon', 'body #wrap #webnus-header-builder [data-id=whb-map-' . esc_attr( $uniqid ) . '] > a > i:before', 'body #wrap #webnus-header-builder [data-id=whb-map-' . esc_attr( $uniqid ) . '] > a:hover i:before'  );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Background', 'body #wrap #webnus-header-builder [data-id=whb-map-' . esc_attr( $uniqid ) . '] a' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Box', 'body #wrap #webnus-header-builder [data-id=whb-map-' . esc_attr( $uniqid ). '] a' );

        if ( $dynamic_style ) :
            WHB_Helper::set_dynamic_styles( $dynamic_style );
        endif;
	endif;

	// vars
	$address 		= ! empty( $address ) ? esc_attr( $address ) : '';
	$icon 			= $show_icon == 'true' ? '<i class="ti-location-pin" ></i>' : '';
	$text			= ! empty( $text ) ? $text : '';
	$extra_class	= ! empty( $extra_class ) ? ' ' . $extra_class : '';

	// render
	$out .= '
		<div class="whb-element-wrap whb-map-wrap whb-map ' . esc_attr( $extra_class ) . '" data-id="whb-map-' . esc_attr( $uniqid ) . '">
			<a href="https://maps.google.com/maps?q='. $address .'" class="popup-gmaps">
				<span>'. $text .'</span>'. $icon .'
			</a>
		</div>
	';

	return $out;
}

WHB_Helper::add_element( 'map', 'whb_map' );
