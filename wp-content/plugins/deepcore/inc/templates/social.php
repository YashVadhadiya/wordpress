<?php
$deep_options = deep_options();
$deep_social_type = isset( $deep_options['deep_social_type'] ) ? $deep_options['deep_social_type'] : '' ;
$social = array();
$social[1] = strtolower( trim( isset( $deep_options['deep_social_first'] ) ? $deep_options['deep_social_first'] : '' ) );
$social[2] = strtolower( trim( isset( $deep_options['deep_social_second'] ) ? $deep_options['deep_social_second'] : '' ) );
$social[3] = strtolower( trim( isset( $deep_options['deep_social_third'] ) ? $deep_options['deep_social_third'] : '' ) );
$social[4] = strtolower( trim( isset( $deep_options['deep_social_fourth'] ) ? $deep_options['deep_social_fourth'] : '' ) );
$social[5] = strtolower( trim( isset( $deep_options['deep_social_fifth'] ) ? $deep_options['deep_social_fifth'] : '' ) );
$social[6] = strtolower( trim( isset( $deep_options['deep_social_sixth'] ) ? $deep_options['deep_social_sixth'] : '' ) );
$social[7] = strtolower( trim( isset( $deep_options['deep_social_seventh'] ) ? $deep_options['deep_social_seventh'] : '' ) );
$social_url = array();
$social_url[1] = trim( isset( $deep_options['deep_social_first_url'] ) ? $deep_options['deep_social_first_url'] : '' );
$social_url[2] = trim( isset( $deep_options['deep_social_second_url'] ) ? $deep_options['deep_social_second_url'] : '' );
$social_url[3] = trim( isset( $deep_options['deep_social_third_url'] ) ? $deep_options['deep_social_third_url'] : '' );
$social_url[4] = trim( isset( $deep_options['deep_social_fourth_url'] ) ? $deep_options['deep_social_fourth_url'] : '' );
$social_url[5] = trim( isset( $deep_options['deep_social_fifth_url'] ) ? $deep_options['deep_social_fifth_url'] : '' );
$social_url[6] = trim( isset( $deep_options['deep_social_sixth_url'] ) ? $deep_options['deep_social_sixth_url'] : '' );
$social_url[7] = trim( isset( $deep_options['deep_social_seventh_url'] ) ? $deep_options['deep_social_seventh_url'] : '' );

if ( $deep_social_type == 1 ) {
	echo '<div class="socialfollow">';
} else {
	echo '<div class="socialfollow-name">';
}
	for ($x = 1; $x <= 7; $x++) {
		if ( $deep_social_type == 1 ) {
			if ( $social[$x] == 'rss' ) {
				if ( $social[$x] && $social_url[$x] ) {
					echo '<a target="_blank" href="'. esc_url( $social_url[$x] ) .'" data-network="'. esc_attr( $social[$x] ) .'" class="' . esc_attr( $social[$x] ) . '"><i class="wn-fas wn-fa-' . esc_attr( $social[$x] ) . '" data-network="'.esc_attr( $social[$x] ).'"></i></a>';
				}
			} elseif ( $social[$x] == 'envato' ) {
				if ( $social[$x] && $social_url[$x] ) {
					echo '<a target="_blank" href="'. esc_url( $social_url[$x] ) .'" class="' . esc_attr( $social[$x] ) . '"><i class="wn-fab wn-fa-'.esc_attr( $social[$x] ).'"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 381.979 381.979" style="enable-background:new 0 0 381.979 381.979;" xml:space="preserve"> <path d="M307.447,4.355c-13.981-7.505-46.504-5.208-84.733,6.098 c-29.043,23.432-123.57,107.68-124.689,212.441c-0.09,8.466-11.647,10.833-14.991,3.054c-9.003-20.943-16.319-55.899-6.439-109.632 c1.461-7.948-8.631-12.614-13.753-6.364c-3.441,4.199-6.705,8.512-9.77,12.937c-60.282,87.038-17.18,198.593,53.754,237.366 c70.934,38.774,176.364,30.137,227.146-62.765C384.754,204.59,342.818,23.341,307.447,4.355z"/> </svg></i></a>';
				}
			} else {
				if ( $social[$x] && $social_url[$x] ) {
					echo '<a target="_blank" href="'. esc_url( $social_url[$x] ) .'" data-network="' . esc_attr( $social[$x] ) . '" class="'.esc_attr( $social[$x] ).'"><i class="wn-fab wn-fa-'.esc_attr( $social[$x] ).'" data-network="' . esc_attr( $social[$x] ) . '"></i></a>';
				}
			}
		} else {
			if( $social[$x] && $social_url[$x] ) {
				echo '<a target="_blank" href="'.   esc_attr( $social_url[$x] ) . '" data-network="'.esc_attr( $social[$x] ).'" class="'.esc_attr( $social[$x] ).'">' . esc_attr( $social[$x] ) . '</a>';
			}
		}
	} 
echo '</div>';