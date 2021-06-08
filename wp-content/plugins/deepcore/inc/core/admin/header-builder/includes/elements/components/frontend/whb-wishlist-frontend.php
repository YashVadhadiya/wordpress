<?php
function whb_wishlist( $atts, $uniqid, $once_run_flag ) {
    extract( WHB_Helper::component_atts( array(
		'show_tooltip'	    => 'false',
        'tootlip'	        => 'Wishlist',
        'tooltip_position'	=> 'tooltip-on-bottom',
		'extra_class'	    => '',
	), $atts ));

    $out = $icon = '';

    // tooltip
    $tooltip_text   = ! empty( $tooltip_text ) ? $tooltip_text : '' ;
    $tooltip = $tooltip_class = '';

    if ( $show_tooltip == 'true' && $tooltip_text ) :
        $tooltip_position   = ( isset( $tooltip_position ) && $tooltip_position ) ? $tooltip_position : 'tooltip-on-bottom';
        $tooltip_class      = ' whb-tooltip ' . $tooltip_position;
        $tooltip            = ' data-tooltip=" ' . esc_attr( $tooltip_text ) . ' "';
    endif;
    
    // styles
    if ( $once_run_flag ) :
        $current_element = 'body #wrap #webnus-header-builder [data-id=whb-wishlist-' . esc_attr( $uniqid ) . '] > a' ;
    
        $dynamic_style = '';
        $dynamic_style .= whb_styling_tab_output( $atts, 'Icon', 'body #wrap #webnus-header-builder [data-id=whb-wishlist-' . esc_attr( $uniqid ) . '] > .wn-wishlist-modal-icon > i:before', 'body #wrap #webnus-header-builder [data-id=whb-wishlist-' . esc_attr( $uniqid ) . ']:hover > .wn-wishlist-modal-icon i:before'  );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Counter', 'body #wrap #webnus-header-builder [data-id=whb-wishlist-' . esc_attr( $uniqid ) . '] .header-wishlist-count-icon' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Box', 'body #wrap #webnus-header-builder [data-id=whb-wishlist-' . esc_attr( $uniqid ) . ']' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Tooltip', 'body #wrap #webnus-header-builder [data-id=whb-wishlist-' . esc_attr( $uniqid ) .'] .whb-tooltip[data-tooltip]:before' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Wishlist Box', 'body #wrap #webnus-header-builder [data-id=whb-wishlist-' . esc_attr( $uniqid ) .'] .wn-header-wishlist-wrap' );

        if ( $dynamic_style ) :
            WHB_Helper::set_dynamic_styles( $dynamic_style );
        endif;
    endif;

    // extra class
    $extra_class = $extra_class ? ' ' . $extra_class : '' ;

    // render
    $out .= '
       <div class="whb-element whb-icon-wrap whb-wishlist ' . esc_attr( $extra_class ) . ' whb-header-dropdown" data-id="whb-wishlist-' . esc_attr( $uniqid ) . '">
            <a href="#" id="wn-wishlist-icon" class="whb-trigger-element ' . esc_attr( $tooltip_class ) . '" ' . $tooltip . '></a>
            <div class="wn-wishlist-modal-icon whb-icon-element hcolorf "><span id="header-wishlist-count-icon" class="wn-wishlist-cnt header-wishlist-count-icon colorb">';
            if ( is_plugin_active('woocommerce/woocommerce.php') && class_exists( 'YITH_WCWL' ) ) {
                global $wpdb, $yith_wcwl, $woocommerce;

                $cnt = array();
                if ( is_user_logged_in() ) {
                    $user_id = get_current_user_id();
                    $cnt = $wpdb->get_results( $wpdb->prepare( 'SELECT COUNT(*) as `cnt` FROM `' . YITH_WCWL_TABLE . '` WHERE `user_id` = %d', $user_id  ), ARRAY_A );
                    $cnt = $cnt[0]['cnt'];
                } else {
                    $cnt[0]['cnt'] = count( yith_getcookie( 'yith_wcwl_products' ) );
                    $cnt = $cnt[0]['cnt'];
                }

                if ( is_array( $cnt ) ) {
                    $cnt = 0;
                }
            }
            if ( is_plugin_active('woocommerce/woocommerce.php') && class_exists( 'YITH_WCWL' ) ) {
                $out .=  $cnt;
            } else {
                $out .= esc_html__( '0', 'deep' );
            }
    $out .= '</span><i id="header-wishlist-icon" class="sl-heart"></i>
            </div>';

    $out .= '<div class="wn-element-dropdown wn-header-wishlist-wrap">';
    if ( is_plugin_active('woocommerce/woocommerce.php') && class_exists( 'YITH_WCWL' ) ) {
        if ( function_exists ( 'deep_get_wish' ) ) :
            $out .= deep_get_wish( 'render' );
        endif;
    }
    $out .= '</div>';
    $out .= '</div>';

    return $out;
}

WHB_Helper::add_element( 'wishlist', 'whb_wishlist' );