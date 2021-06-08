<?php
function whb_button( $atts, $uniqid, $once_run_flag ) {
	extract( WHB_Helper::component_atts( array(
		'text'				=> 'Button',
		'link'				=> 'http://webnus.net',
		'link_new_tab'		=> 'false',
		'show_tooltip'		=> 'false',
		'rel'				=> 'false',
		'tooltip_text'		=> 'Tooltip Text',
		'tooltip_position'	=> 'tooltip-on-bottom',
		'extra_class'		=> '',
	), $atts ));

	$out = $tooltip = $tooltip_class = '';
	
	$text 			= ! empty( $text ) ? $text : '' ;
	$link 			= ! empty( $link ) ? $link : '' ;
	$link_new_tab 	= $link_new_tab == 'true' ? 'target="_blank"' : '' ;
	$rel_link 		= $rel == 'true' ? 'rel="nofollow"' : '';
	
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
		$current_element = 'body #wrap #webnus-header-builder [data-id=whb-button-' . esc_attr( $uniqid ) .'] > *' ;
		$dynamic_style = '';
		$dynamic_style .= whb_styling_tab_output( $atts, 'Button', 'body #wrap #webnus-header-builder [data-id=whb-button-' . esc_attr( $uniqid ) .'] a' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Tooltip', 'body #wrap #webnus-header-builder [data-id=whb-button-' . esc_attr( $uniqid ) .'].whb-tooltip[data-tooltip]:before' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Tooltip Arrow', 'body #wrap #webnus-header-builder [data-id=whb-button-' . esc_attr( $uniqid ) .'].whb-tooltip[data-tooltip]:after' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Box', 'body #wrap #webnus-header-builder [data-id=whb-button-' . esc_attr( $uniqid ) . ']' );

		if ( $dynamic_style ) :
			WHB_Helper::set_dynamic_styles( $dynamic_style );
		endif;
	endif;

	// extra class
	$extra_class = $extra_class ? ' ' . $extra_class : '' ;

	// render
	$out .= '
	<div class="whb-element whb-button' . esc_attr( $tooltip_class . $extra_class ) . '" data-id="whb-button-' . esc_attr( $uniqid ) . '"' . $tooltip . '>
		<a href="' . $link . '" class="whb-icon-element" ' . $link_new_tab . ' ' . $rel_link . '>
			<span class="whb-button-text-modal">' . $text . '</span>
		</a>
	</div>';

	return $out;
}

WHB_Helper::add_element( 'button', 'whb_button' );
