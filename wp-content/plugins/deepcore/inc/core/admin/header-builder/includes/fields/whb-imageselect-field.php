<?php

/**
 * Header Builder - Imageselect Field.
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
 * Imageselect field function.
 *
 * @since	1.0.0
 */
function whb_imageselect( $settings ) {

	$title				= isset( $settings['title'] ) ? $settings['title'] : '';
	$id					= isset( $settings['id'] ) ? $settings['id'] : '';
	$default			= isset( $settings['default'] ) ? $settings['default'] : '';
	$options			= isset( $settings['options'] ) ? $settings['options'] : '';
	$option				= '';
	$dependency			= isset( $settings['dependency'] ) ? $settings['dependency'] : '' ;
	$data_dependency	= '';
	$dependency_class	= '';
    $uniqid             = substr(uniqid(rand(),1),0,7);

	if ( $dependency ) :
		$dependency_class = ' whb-dependency';
		$data_dependency = ' data-dependency="' . esc_attr( json_encode( $dependency ) ) . '"';
	endif;

	if ( $options ) :
		foreach ( $options as $opt_value => $opt_name ) :
			$option .= '
			<label for="' . esc_attr( $opt_value ) . '" class="wn-label' . esc_attr( $checked ) . '">
				<input
					type="radio"
					name="whb-imageselect-name-' . $uniqid . '"
					id="' . esc_attr( $opt_value ) . '"
					class="input-hidden"
					value="' . esc_attr( $opt_value ) . '"
				>
				<img src="' . esc_attr( $opt_name ) . '" alt="" />
			</label>
			';
		endforeach;
	else :
		$option .= '<option value="null">Null</option>';
	endif;

	$output = '
		<div class="whb-field w-col-sm-12' . esc_attr( $dependency_class ) . '"' . $data_dependency . '>
			<h5>' . $title . '</h5>
			<div id="whb-imageselect-' . $uniqid . '" class="whb-imageselect whb-field-input whb-field-select" data-field-name="' . esc_attr( $id ) . '" data-field-std="' . $default . '">' . $option . '</div>
		</div>
		<script>
			jQuery( ".wn-header-builder-wrap" ).ajaxComplete(function( event, request, settings ) {
				jQuery( "#whb-imageselect-' . $uniqid . '.whb-imageselect" ).find( "input[type=radio]" ).each(function(index, el) {
					if ( jQuery(this).attr( "id" ) == jQuery( "#whb-imageselect-' . $uniqid . '.whb-imageselect" ).attr( "value" ) ) {
						jQuery(this).closest( ".wn-label" ).addClass( "checked" );
						jQuery(this).attr( "checked" , "checked" );
					}
				});
			});
			jQuery( "#whb-imageselect-' . $uniqid . '.whb-imageselect" ).find( "input[type=radio]" ).change( function( event ) {
				var main_key = jQuery(this).val();
				jQuery( "#whb-imageselect-' . $uniqid . '.whb-imageselect" ).find( ".wn-label" ).removeClass( "checked" );
				jQuery(this).parent().addClass( "checked" );
				jQuery(this).closest( "#whb-imageselect-' . $uniqid . '.whb-imageselect" ).attr( "value" ,  main_key );
			});
		</script>
	';

	if ( ! isset( $settings['get'] ) ) :
		echo '' . $output;
	else :
		return $output;
	endif;

}
