<?php

/**
 * Header Builder - Contact Field.
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
 * Contact Form 7 field function.
 *
 * @since	1.0.0
 */
function whb_contact( $settings ) {

	$title  = isset( $settings['title'] ) ? $settings['title'] : '';
    $id     = isset( $settings['id'] ) ? $settings['id'] : '';

    $contact = $option = '';

	if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {

		$args = array(
			'post_type'         => 'wpcf7_contact_form',
			'posts_per_page'    => -1
		);

        $contact = get_posts( $args );

    }

    if ( ! empty( $contact ) ) :

		$option .= '<select class="whb-field-input whb-field-select" data-field-name="' . esc_attr( $id ) . '">';
		foreach ( $contact as $item ) :
			$option .= '<option value="' . esc_attr( $item->ID ) . '">' . esc_html( $item->post_title ) . '</option>';
		endforeach;
		$option .= '</select>';

    else :

        $option .= '<span class="whb-field-input whb-field-select" data-field-name="' . esc_attr( $id ) . '">' . esc_html__( 'No Contact Form found.', 'deep' ) . '</span>';

    endif;

	$output = '
		<div class="whb-field w-col-sm-12">
			<h5>' . $title . '</h5>
			<div class="whb-dropdown">
				' . $option . '
			</div>
		</div>
	';

	if ( ! isset( $settings['get'] ) ) :
		echo '' . $output;
	else :
		return $output;
	endif;

}
