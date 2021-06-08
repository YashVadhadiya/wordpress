<?php

/**
 * Header Builder - Menu Field.
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
 * Menu field function.
 *
 * @since	1.0.0
 */
function whb_menu( $settings ) {

	$title	= isset( $settings['title'] ) ? $settings['title'] : '';
	$id		= isset( $settings['id'] ) ? $settings['id'] : '';
	$menus	= wp_get_nav_menus();
	$option = '';

	if ( ! empty( $menus ) ) :
		$option .= '<select class="whb-field-input whb-field-select whb-field-menu" data-field-name="' . esc_attr( $id ) . '">';
		foreach ( $menus as $item ) :
			$option .= '<option value="' . esc_attr( $item->term_id ) . '">' . esc_html( $item->name ) . '</option>';
		endforeach;
		$option .= '</select>';
	else :
		$option .= '<span class="whb-field-input whb-field-select whb-field-menu" data-field-name="' . esc_attr( $id ) . '">' . esc_html__( 'No items of this type were found.', 'deep' ) . '</span>';
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
