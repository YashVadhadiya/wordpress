<?php

/**
 * Header Builder - Dropdown Field.
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
 * Dropdown field function.
 *
 * @since	1.0.0
 */
function whb_select( $settings ) {

	$title				= isset( $settings['title'] ) ? $settings['title'] : '';
	$id					= isset( $settings['id'] ) ? $settings['id'] : '';
	$default			= isset( $settings['default'] ) ? $settings['default'] : '';
	$options			= isset( $settings['options'] ) ? $settings['options'] : '';
	$option				= '';
	$dependency			= isset( $settings['dependency'] ) ? $settings['dependency'] : '' ;
	$data_dependency	= '';
	$dependency_class	= '';

	if ( $dependency ) :
		$dependency_class = ' whb-dependency';
		$data_dependency = ' data-dependency="' . esc_attr( json_encode( $dependency ) ) . '"';
	endif;

	if ( $options ) :
		foreach ( $options as $opt_value => $opt_name ) :
			$option .= '<option value="' . esc_attr( $opt_value ) . '">' . esc_html( $opt_name ) . '</option>';
		endforeach;
	else :
		$option .= '<option value="null">Null</option>';
	endif;

	$output = '
		<div class="whb-field w-col-sm-12' . esc_attr( $dependency_class ) . '"' . $data_dependency . '>
			<h5>' . $title . '</h5>
			<div class="whb-dropdown">
				<select class="whb-field-input whb-field-select" data-field-name="' . esc_attr( $id ) . '" data-field-std="' . $default . '">' . $option . '</select>
			</div>
		</div>
	';

	if ( ! isset( $settings['get'] ) ) :
		echo '' . $output;
	else :
		return $output;
	endif;

}
