<?php
function whb_text( $atts, $uniqid, $once_run_flag ) {
	extract( WHB_Helper::component_atts( array(
		'is_shortcode'	=> 'false',
		'text'			=> 'This is a text field',
		'link'			=> '',
		'link_new_tab'	=> 'false',
		'rel'			=> 'false',
		'extra_class'	=> '',
	), $atts ));

	$out = '';

	$text			= $text ? $text : '' ;
	$link			= $link ? $link : '' ;
	$link_new_tab	= $link_new_tab == 'true' ? 'target="_blank"' : '' ;
	$rel_link 		= $rel == 'true' ? 'rel="nofollow"' : '';

	// styles
	if ( $once_run_flag ) :
		$dynamic_style = '';
        $dynamic_style .= whb_styling_tab_output( $atts, 'Text', 'body #wrap #webnus-header-builder [data-id=whb-text-' . esc_attr( $uniqid ) . '] span' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Background', 'body #wrap #webnus-header-builder [data-id=whb-text-' . esc_attr( $uniqid ) . ']' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Box', 'body #wrap #webnus-header-builder [data-id=whb-text-' . esc_attr( $uniqid ) . ']' );

        if ( $dynamic_style ) :
            WHB_Helper::set_dynamic_styles( $dynamic_style );
        endif;
	endif;

	// extra class
	$extra_class = $extra_class ? ' ' . $extra_class : '' ;

	// render
	$out .= '
		<div class="whb-element whb-element-wrap whb-text-wrap whb-text' . esc_attr( $extra_class ) . '" data-id="whb-text-' . esc_attr( $uniqid ) . '">';
		$text = str_replace('\"','',$text);
		if ( $is_shortcode == 'true' ) {
			$out .= do_shortcode( ''. $text .'' );
		} else {
			if ( ! empty ( $link ) ) {
				$out .= '<a href="' . esc_attr( $link ) . '" '. $link_new_tab .' ' . $rel_link . '>';
			}
				$out .= '<span>'. $text .'</span>';
			if ( ! empty ( $link ) ) {
				$out .= '</a>';
			}
		}
	$out .= '</div>';

	return $out;
}

WHB_Helper::add_element( 'text', 'whb_text' );
