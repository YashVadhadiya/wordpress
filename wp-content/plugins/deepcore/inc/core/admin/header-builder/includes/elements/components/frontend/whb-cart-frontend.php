<?php
function whb_cart( $atts, $uniqid, $once_run_flag ) {
	extract( WHB_Helper::component_atts( array(
		'cart_icon'         => '1',
		'show_tooltip'	    => 'false',
        'tooltip'	        => 'Cart',
        'tooltip_position'	=> 'tooltip-on-bottom',
		'extra_class'	    => '',
	), $atts ));

    $out = $icon = '';

    if ( $cart_icon == '1' ) {
        $icon = 'sl-basket-loaded';
    } elseif ( $cart_icon == '2' ) {
        $icon = 'wn-fa wn-fa-shopping-cart';
    } elseif ( $cart_icon == '3' ) {
        $icon = 'icon-ecommerce-cart-plus';
    } elseif ( $cart_icon == '4' ) {
        $icon = 'icon-ecommerce-bag';
    }
    
    // tooltip
    $tooltip_text   = ! empty( $tooltip_text ) ? $tooltip_text : '' ;
    $tooltip = $tooltip_class = '';
    if ( $show_tooltip == 'true' && $tooltip_text ) :
        
        $tooltip_position   = ( isset( $tooltip_position ) && $tooltip_position ) ? $tooltip_position : 'tooltip-on-bottom';
        $tooltip_class      = ' whb-tooltip ' . $tooltip_position;
        $tooltip            = ' data-tooltip=" ' . esc_attr( $tooltip_text ) . ' "';

    endif;

    $cart_count = '';

    // styles
    if ( $once_run_flag ) :
        $current_element = 'body #wrap #webnus-header-builder [data-id=whb-cart-' . esc_attr( $uniqid ) . '] > a' ;

        $dynamic_style = '';
        $dynamic_style .= whb_styling_tab_output( $atts, 'Icon', 'body #wrap #webnus-header-builder [data-id=whb-cart-' . esc_attr( $uniqid ) . '] > .wn-cart-modal-icon > i:before', 'body #wrap #webnus-header-builder [data-id=whb-cart-' . esc_attr( $uniqid ) . ']:hover > .wn-cart-modal-icon i:before'  );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Counter', 'body #wrap #webnus-header-builder [data-id=whb-cart-' . esc_attr( $uniqid ) . '] .header-cart-count-icon' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Box', 'body #wrap #webnus-header-builder [data-id=whb-cart-' . esc_attr( $uniqid ) . ']' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Tooltip', 'body #wrap #webnus-header-builder [data-id=whb-cart-' . esc_attr( $uniqid ) .'].whb-tooltip[data-tooltip]:before' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Products Box', 'body #wrap #webnus-header-builder [data-id=whb-cart-' . esc_attr( $uniqid ) .'] .wn-header-woo-cart' );

        if ( $dynamic_style ) :
            WHB_Helper::set_dynamic_styles( $dynamic_style );
        endif;
    endif;

    // extra class
    $extra_class = $extra_class ? ' ' . $extra_class : '';
    if ( WHB_Helper::is_frontend_builder() ) {
        $cart_count = esc_html__( '0', 'deep' );
    } else {
        $cart_count = deepCartCount();
    }

    if ( empty ( $cart_count ) ) {
        $cart_count = '0';
    }
    // render
    $out .= '
        <div class="whb-element whb-icon-wrap whb-cart ' . esc_attr( $tooltip_class . $extra_class ) . ' whb-header-woo-cart-toggle " data-id="whb-cart-' . esc_attr( $uniqid ) . '" ' . $tooltip . '>
            <a href="#" id="wn-cart-modal-icon"></a>
            <div class="wn-cart-modal-icon whb-icon-element hcolorf "><span id="header-cart-count-icon" class="header-cart-count-icon colorb" data-cart_count = ' . $cart_count . ' >';
            if ( is_plugin_active('woocommerce/woocommerce.php') ) {
                $out .=  $cart_count;
            } else {
                $out .= esc_html__( '0', 'deep' );
            }
    $out .= '</span><i id="header-cart-icon" class="'.$icon.'"></i>
            </div>';

            ob_start();
            echo '<div id="wn-header-woo-cart" class="wn-header-woo-cart">';
            echo '<div id="wn-header-woo-cart-wrap" class="wn-header-woo-cart-wrap">';
            if ( is_plugin_active('woocommerce/woocommerce.php') ) {
                if (!WHB_Helper::is_frontend_builder()) {
                    wn_mini_cart();
                }
            } else {
                echo '<div class="woo-no-product-in-cart">Your cart is empty</div>';
            }
            echo '</div>'; 
        	echo '</div>';
        	$out .= ob_get_contents();
            ob_end_clean();
        
    $out .= '</div>';
    return $out;
}

WHB_Helper::add_element( 'cart', 'whb_cart' );