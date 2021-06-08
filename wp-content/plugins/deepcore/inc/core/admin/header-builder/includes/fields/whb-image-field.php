<?php

/**
 * Header Builder - Image Field.
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
 * Image field function.
 *
 * @since	1.0.0
 */
function whb_image( $settings ) {

	$title		 = isset( $settings['title'] ) ? $settings['title'] : '';
	$id			 = isset( $settings['id'] ) ? $settings['id'] : '';
	$placeholder = isset( $settings['placeholder'] ) ? ' whb-placeholder whb-img-placeholder' : '';

	$output = '
		<div class="whb-field w-col-sm-12' . esc_attr( $placeholder ) . '">
			<h5>' . $title . '</h5>
			<div class="whb-attach-image">
				<input type="hidden" class="whb-field-input whb-attach-image' . esc_attr( $placeholder ) . '" data-field-name="' . esc_attr( $id ) . '">
				<span class="whb-preview-image"></span>
				<button type="button" class="whb-add-image">' . esc_html__( 'Upload', 'deep' ) . '</button>
				<button type="button" class="whb-remove-image">' . esc_html__( 'Remove', 'deep' ) . '</button>
			</div>
		</div>
	';

	if ( ! isset( $settings['get'] ) ) :
		echo '' . $output;
	else :
		return $output;
	endif;

}
