<?php
function whb_weather( $atts, $uniqid, $once_run_flag ) {
	extract(
		WHB_Helper::component_atts(
			array(
				'weather_id'  => '',
				'extra_class' => '',
			),
			$atts
		)
	);

	include_once ABSPATH . 'wp-admin/includes/plugin.php';

	$out        = '';
	$weather_id = ! empty( $weather_id ) ? $weather_id : '';

	// styles
	if ( $once_run_flag ) :
		$dynamic_style  = '';
		$dynamic_style .= whb_styling_tab_output( $atts, 'Text', 'body #wrap #webnus-header-builder [data-id=whb-weather-' . esc_attr( $uniqid ) . '] #wpc-weather', 'body #wrap #webnus-header-builder [data-id=whb-weather-' . esc_attr( $uniqid ) . ']:hover #wpc-weather' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Icon', 'body #wrap #webnus-header-builder [data-id=whb-weather-' . esc_attr( $uniqid ) . '] #wpc-weather svg,body #wrap #webnus-header-builder [data-id=whb-weather-' . esc_attr( $uniqid ) . '] #wpc-weather .climacon_component-fill', 'body #wrap #webnus-header-builder [data-id=whb-weather-' . esc_attr( $uniqid ) . ']:hover #wpc-weather svg,body #wrap #webnus-header-builder [data-id=whb-weather-' . esc_attr( $uniqid ) . ']:hover #wpc-weather .climacon_component-fill' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Box', 'body #wrap #webnus-header-builder [data-id=whb-weather-' . esc_attr( $uniqid ) . ']' );

		if ( $dynamic_style ) :
			WHB_Helper::set_dynamic_styles( $dynamic_style );
		endif;

		// Dequeue and Enqueue script
		if ( is_plugin_active( 'wp-cloudy/wpcloudy.php' ) ) {
			wp_dequeue_script( 'wpc-ajax' );
			wp_enqueue_script( 'whb-wpc-ajax', WHB_Helper::get_file_uri( 'assets/src/frontend/whb-wpcloudy.js' ), array( 'jquery' ), '', true );
			$wpcAjax = array(
				'wpc_nonce' => wp_create_nonce( 'wpc_get_weather_nonce' ),
				'wpc_url'   => admin_url( 'admin-ajax.php' ) . '?lang=' . substr( get_locale(), 0, 2 ),
			);
			wp_localize_script( 'whb-wpc-ajax', 'wpcAjax', $wpcAjax );
		}
	endif;

	// extra class
	$extra_class = $extra_class ? ' ' . $extra_class : '';

	// render
	$out .= '
		<div class="whb-element whb-element-wrap whb-weather-wrap whb-weather ' . esc_attr( $extra_class ) . '" data-id="whb-weather-' . esc_attr( $uniqid ) . '">';
	if ( is_plugin_active( 'wp-cloudy/wpcloudy.php' ) ) {	
		$out .= do_shortcode( '[wpc-weather id="'. $weather_id .'"]' );			
	}
	$out .= '</div>';

	return $out;
}

WHB_Helper::add_element( 'weather', 'whb_weather' );
