<?php

/**
 * Header Builder - Number Unit Field.
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
 * Number Unit field function.
 *
 * @since	1.0.0
 */
function whb_number_unit( $settings ) {

	$title			= isset( $settings['title'] ) ? $settings['title'] : '';
	$id				= isset( $settings['id'] ) ? $settings['id'] : '';
	$default		= isset( $settings['default'] ) ? $settings['default'] : '';
	$options		= isset( $settings['options'] ) ? $settings['options'] : '';
	$default_unit	= isset( $settings['default_unit'] ) ? $settings['default_unit'] : '';
	$option			= '';

	if ( $options ) :
		foreach ( $options as $opt_value => $opt_name ) :
			$active = ( $opt_value == $default_unit ) ? ' class="whb-active"' : '' ;
			$option .= '<span data-value="' . esc_attr( $opt_value ) . '"' . $active . '>' . esc_html( $opt_name ) . '</span>';
		endforeach;
	else :
		$option .= '<span>' . esc_html__( 'Empty', 'deep' ) . '</span>';
	endif;

	$val = $default ? esc_attr( $default . $default_unit ) : '' ;

	$output = '
		<div class="whb-field w-col-sm-6">
			<h5>' . $title . '</h5>
			<div class="whb-number-unit wp-clearfix">
				<input type="hidden" class="whb-field-input whb-field-number-unit" data-field-name="' . esc_attr( $id ) . '" data-field-std="' . esc_attr( $val ) . '">
				<input type="number" value="' . esc_attr( $default ) . '">
				<div class="whb-opts wp-clearfix">
				' . $option . '
				</div>
			</div>
		</div>
	';

	if ( ! isset( $settings['get'] ) ) :
		echo '' . $output;
	else :
		return $output;
	endif;

}
