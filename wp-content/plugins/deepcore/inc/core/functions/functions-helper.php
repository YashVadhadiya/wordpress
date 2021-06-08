<?php
/**
 * Deep Theme.
 * 
 * Function helpers for this theme
 *
 * @since   1.0.0
 * @author  Webnus
 */

/**
 * Get deep options
 *
 * @since   1.0.0
 * @author  WEBNUS
 */
function deep_get_option( $opts, $key, $default = '' ) {
	return isset( $opts[$key] ) ? $opts[$key] : $default;
}

/**
 * Utilities
 *
 * @since   1.0.0
 * @author  WEBNUS
 */
function deepassets( $slug, $file ) {
	return DEEP_ASSETS_URL .'dist/' . $slug . '/' . $file;
}

function deepCartCount() {
	if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
		return !WC()->cart->is_empty() ? WC()->cart->get_cart_contents_count() : esc_html__( '0', 'deep' );
	}
}

/**
 * Check URL
 *
 * @since   1.0.0
 * @author  WEBNUS
 */

function wn_check_url($url) {
	$headers = @get_headers( $url);
	$headers = ( is_array($headers ) ) ? implode( "\n ", $headers) : $headers;
	return (bool)preg_match('#^HTTP/.*\s+[(200|301|302)]+\s#i', $headers);
}

/**
 * Gradient
 *
 * @since   1.0.0
 * @author  WEBNUS
 */
function deep_gradient( $color_1 = '', $color_2 = '', $color_3 = '', $color_4 = '', $deg = '90deg' ) {
	// variables
	$grad_colors	= array();
	$color_1		= $color_1 ? $grad_colors[] = $color_1 : '';
	$color_2		= $color_2 ? $grad_colors[] = $color_2 : '';
	$color_3		= $color_3 ? $grad_colors[] = $color_3 : '';
	$color_4		= $color_4 ? $grad_colors[] = $color_4 : '';
	$deg         	= ( $deg == '' || $deg == '0' || $deg == '0deg' ) ? '-360deg' : $deg;
	$grad_bg		= '';
	$grad_count		= sizeof( $grad_colors );
	$grad_plus		= 0;
	$grad			= '';
	$precent 		= $grad_count - 1;

	// Diagnosis direction
	if ( $deg ) {
		$deg = explode( 'deg', $deg );
		$deg = $deg[0];
	}

	// default color
	if ( ! empty( $color_1 ) ) {
		$grad_bg = $color_1;
	} elseif ( ! empty( $color_2 ) ) {
		$grad_bg = $color_2;
	} elseif ( ! empty( $color_3 ) ) {
		$grad_bg = $color_3;
	} elseif ( ! empty( $color_4 ) ) {
		$grad_bg = $color_4;
	}
	// generate gradient
	for ( $i = 0; $i < $grad_count ; $i++ ) { 
		// comma
		$comma = $i < $grad_count - 1 ? ',' : '';
		// Percent
		$grad .= $grad_colors[$i] . ' ' . floor( $grad_plus ) . '%' . $comma . ' ';
		// if precent value isn't ziro
		if ( $precent != 0 ) {
			$grad_plus = $grad_plus + ( 100 / $precent );
		}
	}
	
	$out = '';
	if ( $grad_count <= 1 ) {
		$out .= ! empty( $grad_bg ) ? ' background: ' . $grad_bg . ';' : '' ;
	} else {
		if ( ! empty( $grad_bg ) && ! empty( $grad ) && ! empty( $deg ) ) {
			$out .= '
				background: ' . $grad_bg . ';
				background: linear-gradient( ' . $deg . 'deg, ' . $grad . ');
				background: -moz-linear-gradient( ' . $deg . 'deg, ' . $grad . ');
				background: -webkit-linear-gradient( ' . $deg . 'deg, ' . $grad . ');';
		}
	}
	return $out;
}