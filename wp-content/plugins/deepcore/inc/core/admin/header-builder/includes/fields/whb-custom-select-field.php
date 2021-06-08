<?php

/**
 * Header Builder - Custom Select Field.
 *
 * @author	Webnus
 */

// don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

/**
 * Custom Select field function.
 *
 * @since	1.0.0
 */
function whb_custom_select( $settings ) {

	$title			= isset( $settings['title'] ) ? $settings['title'] : '';
	$id				= isset( $settings['id'] ) ? $settings['id'] : '';
	$default		= isset( $settings['default'] ) ? $settings['default'] : '';
	$options		= isset( $settings['options'] ) ? $settings['options'] : '';
	$option			= '';

	if ( $options ) :
		foreach ( $options as $opt_value => $opt_name ) :
			$active = ( $opt_value == $default ) ? ' class="whb-active"' : '' ;
			$option .= '<span data-value="' . esc_attr( $opt_value ) . '"' . $active . '>' . $opt_name . '</span>';
		endforeach;
	else :
		$option .= '<span>' . esc_html__( 'Empty', 'deep' ) . '</span>';
	endif;

	$output = '
		<div class="whb-field w-col-sm-12">
			<h5>' . $title . '</h5>
			<div class="whb-custom-select wp-clearfix">
				<div class="whb-opts wp-clearfix">
				' . $option . '
				</div>
				<input type="text" class="whb-field-input whb-field-custom-select" data-field-name="' . esc_attr( $id ) . '" data-field-std="' . esc_attr( $default ) . '" placeholder="' . esc_html__( 'Custom', 'deep' ) . '">
			</div>
		</div>
	';

	if ( ! isset( $settings['get'] ) ) :
		echo '' . $output;
	else :
		return $output;
	endif;

}
