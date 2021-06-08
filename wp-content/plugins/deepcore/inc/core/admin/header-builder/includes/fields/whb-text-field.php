<?php

/**
 * Header Builder - Text Field.
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
 * Text field function.
 *
 * @since	1.0.0
 */
function whb_textfield( $settings ) {

	$title		 = isset( $settings['title'] ) ? $settings['title'] : '';
	$id			 = isset( $settings['id'] ) ? $settings['id'] : '';
	$default	 = isset( $settings['default'] ) ? $settings['default'] : '';
	$placeholder = isset( $settings['placeholder'] ) ? ' whb-placeholder whb-text-placeholder' : '';

	$output = '
		<div class="whb-field w-col-sm-12' . esc_attr( $placeholder ) . '">
			<h5>' . $title . '</h5>
			<input type="text" class="whb-field-input whb-field-textfield' . esc_attr( $placeholder ) . '" data-field-name="' . esc_attr( $id ) . '" data-field-std="' . $default . '">
		</div>
	';

	if ( ! isset( $settings['get'] ) ) :
		echo '' . $output;
	else :
		return $output;
	endif;

}
