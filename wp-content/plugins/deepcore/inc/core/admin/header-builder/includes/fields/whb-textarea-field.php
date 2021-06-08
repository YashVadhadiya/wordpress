<?php

/**
 * Header Builder - Textarea Field.
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
 * Textarea field function.
 *
 * @since   1.0.0
 */
function whb_textarea( $settings ) {

	$title		 = isset( $settings['title'] ) ? $settings['title'] : '';
	$id			 = isset( $settings['id'] ) ? $settings['id'] : '';

	$output = '
		<div class="whb-field w-col-sm-12">
			<h5>' . $title . '</h5>
			<textarea class="whb-field-input whb-field-textarea" data-field-name="' . esc_attr( $id ) . '"></textarea>
		</div>
	';

	if ( ! isset( $settings['get'] ) ) :
		echo '' . $output;
	else :
		return $output;
	endif;

}
