<?php
function whb_language( $atts, $uniqid, $once_run_flag ) {
	extract( WHB_Helper::component_atts( array(
		'p_type'		=> 'wpml',
		'type'			=> 'dropdown',
		'extra_class'	=> '',
	), $atts ));

	$out = '';

	// styles
	if ( $once_run_flag ) :
		$dynamic_style = '';
        $dynamic_style .= whb_styling_tab_output( $atts, 'Typography', 'body #wrap #webnus-header-builder [data-id=whb-language-' . esc_attr( $uniqid ) .'] a' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Background', 'body #wrap #webnus-header-builder [data-id=whb-language-' . esc_attr( $uniqid ) . ']' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Box', 'body #wrap #webnus-header-builder [data-id=whb-language-' . esc_attr( $uniqid ) . ']' );

        if ( $dynamic_style ) :
            WHB_Helper::set_dynamic_styles( $dynamic_style );
        endif;
	endif;

	// extra class
	$extra_class = $extra_class ? ' ' . $extra_class : '' ;

	// render
	$out .= '
	<div class="whb-element whb-icon-wrap whb-language ' . esc_attr( $extra_class ) . ' " data-id="whb-language-' . esc_attr( $uniqid ) . '" >';
	//$out .= wpml_language_switcher ( $type );
	if ( $p_type == 'wpml' ) {
		ob_start(); ?>
		<div class="wn-wpml-switcher header-language-list">
 			<?php do_action('wpml_add_language_selector'); ?>
 		</div>
 		<?php $out .= ob_get_contents();
 		ob_end_clean();
	}

	if ( $p_type == 'polylang' & $type == 'dropdown') {
		ob_start();?>
		<div class="wn-polylang-switcher-dropdown header-language-list">
 			<?php
 			if ( function_exists( 'pll_the_languages' ) ) {
 				pll_the_languages( array( 'dropdown' => 1 ) );
 			}
 			
 			?>
 		</div>
 		<?php $out .= ob_get_contents();
 		ob_end_clean();
	}
	if ( $p_type == 'polylang' & $type == 'name_flag' ) {
		ob_start();?>
		<div class="wn-polylang-switcher-inline header-language-list">
			<ul>
	 			<?php
	 			if ( function_exists( 'pll_the_languages' ) ) {
	 				pll_the_languages( array( 'show_flags' => 1,'show_names' => 1 ) );
	 			}
	 			
	 			?>
	 		</ul>
 		</div>
 		<?php $out .= ob_get_contents();
 		ob_end_clean();
	}
	if ( $p_type == 'polylang' & $type == 'flag' ) {
		ob_start();?>
		<div class="wn-polylang-switcher-inline header-language-list">
			<ul>
	 			<?php
	 			if ( function_exists( 'pll_the_languages' ) ) {
	 				pll_the_languages( array( 'show_flags' => 1,'show_names' => 0 ) );
	 			}
	 			?>
	 		</ul>
 		</div>
 		<?php $out .= ob_get_contents();
 		ob_end_clean();
	}

	$out .= '</div>';
	return $out;
}

WHB_Helper::add_element( 'language', 'whb_language' );
