<?php
function whb_login( $atts, $uniqid, $once_run_flag ) {
	extract( WHB_Helper::component_atts( array(
		'login_type'		=> 'icon',
		'login_text'		=> __('Login / Register' , 'deep'),
		'login_text_icon'	=> '',
		'open_form'		    => 'modal',
		'show_arrow'		=> 'true',
		'show_avatar'		=> 'true',
		'show_tooltip'		=> 'false',
		'tooltip_text'		=> 'Login',
		'tooltip_position'	=> 'tooltip-on-bottom',
		'extra_class'		=> '',
	), $atts ));

    global $user_ID, $user_identity;
	$out = $modal = $wrap_class = '';

    $icon_alignment     = $login_text_icon == 'true' ? 'icon-right' : '';
    $login_text_icon    = $login_type == 'icon_text' ? '<i id="login-header-icon" class="ti-user"></i>' : '';
    $login_text         = $login_text ? $login_text : '';

	// tooltip
    $tooltip_text   = ! empty( $tooltip_text ) ? $tooltip_text : '' ;
    $tooltip = $tooltip_class = '';

    if ( $show_tooltip == 'true' && $tooltip_text ) :
        $tooltip_position   = ( isset( $tooltip_position ) && $tooltip_position ) ? $tooltip_position : 'tooltip-on-bottom';
        $tooltip_class      = ' whb-tooltip ' . $tooltip_position;
        $tooltip            = ' data-tooltip=" ' . esc_attr( $tooltip_text ) . ' "';
    endif;

    if ( $user_ID ) {
        $show_avatar    = $show_avatar == true ? '<span class="wn-header-avatar">' . get_avatar( $user_ID, $size = '50') . '</span>' : $login_text_icon;
    } else {
        $show_avatar    = $login_text_icon;
    }
    // login
	if ( is_user_logged_in() ) {
        $login_text = $show_avatar . '<span id="login-header-icon-span" class="whb-login-text-modal">' .  esc_html($user_identity).'</span>';
    } else {
    	$login_text = $show_avatar . '<span id="login-header-span" class="whb-login-text-modal">' . $login_text .'</span>' ;
    }

	// styles
	if ( $once_run_flag ) :
		$dynamic_style = '';
        $dynamic_style .= whb_styling_tab_output( $atts, 'Text', 'body #wrap #webnus-header-builder [data-id=whb-login-' . esc_attr( $uniqid ) .'] .whb-icon-element span','body #wrap #webnus-header-builder [data-id=whb-login-' . esc_attr( $uniqid ) .']:hover .whb-icon-element span' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Icon', 'body #wrap #webnus-header-builder [data-id=whb-login-' . esc_attr( $uniqid ) . '] #whb-icon-element i', 'body #wrap #webnus-header-builder [data-id=whb-login-' . esc_attr( $uniqid ) . ']:hover #whb-icon-element i'  );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Box', 'body #wrap #webnus-header-builder [data-id=whb-login-' . esc_attr( $uniqid ) .']' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Form', 'body .mfp-container #loginform, body #webnus-header-builder .wn-element-dropdown #loginform' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Tooltip', 'body #wrap #webnus-header-builder [data-id=whb-login-' . esc_attr( $uniqid ) .'].whb-tooltip[data-tooltip]:before' );

        if ( $dynamic_style ) :
            WHB_Helper::set_dynamic_styles( $dynamic_style );
        endif;
	endif;

	// extra class
	$extra_class = $extra_class ? ' ' . $extra_class : '' ;

    if ( $open_form == 'dropdown' ) {
        $show_arrow = $show_arrow == 'true' ? 'with-arrow' : ' no-arrow';
        $wrap_class = ' login-dropdown-element whb-header-dropdown';
    }


    // render
    if ( $open_form == 'modal' ) {
        $out .= '<div class="whb-element whb-icon-wrap whb-login ' . $show_arrow . $wrap_class . esc_attr( $tooltip_class . $extra_class ) . '" data-id="whb-login-' . esc_attr( $uniqid ) . '" ' . $tooltip . ' ' . $modal . '>';
    } elseif ( $open_form == 'dropdown' ) {
        $out .= '<div class="whb-element whb-icon-wrap whb-login ' . $show_arrow . $wrap_class . esc_attr( $extra_class ) . '" data-id="whb-login-' . esc_attr( $uniqid ) . '" ' . $modal . '>';
    }

        if ( $open_form == 'modal' ) {
            $out .= '<a class="whb-modal-element whb-modal-target-link" href="#w-login" data-effect="mfp-zoom-in"></a>';
        }

		$out .= '<div id="whb-icon-element" class=" ' . $icon_alignment . ' whb-icon-element hcolorf">';
		if ( $login_type == 'text' || $login_type == 'icon_text' ) {
			$out .=  $login_text;
		} else {
			$out .= '<i id="login-header-icon" class="ti-user"></i>';
		}
	    $out .= '</div>';

    if ( $open_form == 'modal' ) {
        $out .= '<div id="w-login" class="w-login modal-login white-popup mfp-with-anim mfp-hide">';
    } elseif ( $open_form == 'dropdown' ) {
        $out .= '<div class="whb-trigger-element ' . esc_attr( $tooltip_class ) . '" id="wn-login-dropdown-icon" ' . $tooltip . '></div><div id="w-login" class="w-login wn-element-dropdown">';
    }
	ob_start();
    if ( function_exists( 'deep_login' ) ) {
        deep_login();
    }
	$out .= ob_get_contents();
	ob_end_clean();
	$out .= '</div>
        </div>';

	return $out;

}

WHB_Helper::add_element( 'login', 'whb_login' );
