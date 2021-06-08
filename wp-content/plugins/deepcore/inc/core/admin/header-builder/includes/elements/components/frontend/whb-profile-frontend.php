<?php
function whb_profile( $atts, $uniqid, $once_run_flag ) {
	extract( WHB_Helper::component_atts( array(
		'avatar'		=> '',
		'profile_name'	    	=> 'David Hamilton James',
		'socials'		=> 'true',
		'social_text_1'	=> 'Facebook',
		'social_url_1'	=> 'https://www.facebook.com/',
		'social_text_2'	=> '',
		'social_url_2'	=> '',
		'social_text_3'	=> '',
		'social_url_3'	=> '',
		'social_text_4'	=> '',
		'social_url_4'	=> '',
		'social_text_5'	=> '',
		'social_url_5'	=> '',
		'social_text_6'	=> '',
		'social_url_6'	=> '',
		'social_text_7'	=> '',
		'social_url_7'	=> '',
		'extra_class'	=> '',
	), $atts ));

	$out = '';

	$avatar			= $avatar ? wp_get_attachment_url( $avatar ) : '' ;
	$profile_name	= $profile_name ? $profile_name : '' ;

	// Get Social Icons
	$display_socials = '';
	for ($i = 1; $i < 8; $i++) {

		${"social_text_" . $i} 	= ${"social_text_" . $i} ? ${"social_text_" . $i} : '';
		${"social_url_" . $i}  	= ${"social_url_" . $i} ? ${"social_url_" . $i} : '';

		if (  !empty( ${"social_text_" . $i} ) ) {
			$display_socials .= '<div class="profile-social-icons social-icon-' . $i . '">';
			if ( ! empty( ${"social_url_" . $i} ) ) {
				$display_socials .= '<a href="' . ${"social_url_" . $i} . '" target="_blank">';
			}
			$display_socials .= '- <span class="profile-social-text">' . ${"social_text_" . $i} . '</span>';
			if ( ! empty( ${"social_url_" . $i} ) ) {
				$display_socials .= '</a>';
			}
			$display_socials .= '</div>';
		}
	}

	// styles
	if ( $once_run_flag ) :
		$dynamic_style = '';
        $dynamic_style .= whb_styling_tab_output( $atts, 'Image', 'body #wrap #webnus-header-builder [data-id=whb-profile-' . esc_attr( $uniqid ) . '] .whb-profile-image-wrap' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Name', 'body #wrap #webnus-header-builder [data-id=whb-profile-' . esc_attr( $uniqid ) . '] .whb-profile-name' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Socials Text', 'body #wrap #webnus-header-builder [data-id=whb-profile-' . esc_attr( $uniqid ) . '] .whb-profile-socials-icons a' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Socials Box', 'body #wrap #webnus-header-builder [data-id=whb-profile-' . esc_attr( $uniqid ) . '] .whb-profile-socials-icons' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Box', 'body #wrap #webnus-header-builder [data-id=whb-profile-' . esc_attr( $uniqid ) . ']' );

        if ( $dynamic_style ) :
            WHB_Helper::set_dynamic_styles( $dynamic_style );
        endif;
	endif;

	// extra class
	$extra_class = $extra_class ? ' ' . $extra_class : '' ;

	// render
	$out .= '<div class="whb-element whb-element-wrap whb-profile-wrap whb-profile' . esc_attr( $extra_class ) . '" data-id="whb-profile-' . esc_attr( $uniqid ) . '">';

	$out .= '<div class="clearfix">';
	if ( !empty( $avatar ) ) {
		$out .= '
		<div class="whb-profile-image-wrap">
			<img class="whb-profile-image" src="' . esc_url( $avatar ) . '" alt="' . $profile_name . '">
		</div>';
	}
		$out .= '<div class="whb-profile-content">';			
		if ( !empty( $profile_name ) ) {
			$out .= '<span class="whb-profile-name">' . $profile_name . '</span>';
		}			
		if ( $socials == 'true' ) {
			$out .= '
			<div class="whb-profile-socials-wrap">
				<div class="whb-profile-socials-text-wrap">
					<span class="whb-profile-socials-divider"></span>
					<div class="whb-profile-socials-text">' . esc_html__( 'SOCIALS', 'deep' ) . ' <i class="ti-angle-down"></i>
						<div class="whb-profile-socials-icons profile-socials-hide">
						' . $display_socials . '
						</div>
					</div>
				</div>
				
			</div>';
		}
		$out .=	'</div>';			
	$out .= '</div>'; // End clearfix	

	$out .= '</div>';

	return $out;
}

WHB_Helper::add_element( 'profile', 'whb_profile' );
