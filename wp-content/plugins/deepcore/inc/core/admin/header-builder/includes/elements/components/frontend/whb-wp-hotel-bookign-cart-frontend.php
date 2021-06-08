<?php
function whb_htc_cart( $atts, $uniqid, $once_run_flag ) {
	extract( WHB_Helper::component_atts( array(
		'cart_icon'         => '1',
		'show_tooltip'	    => 'false',
        'tooltip'	        => 'Cart',
        'tooltip_position'	=> 'tooltip-on-bottom',
		'extra_class'	    => '',
	), $atts ));

    ob_start();
    if ( class_exists( 'WP_Hotel_Booking' ) ) {

        $icon = '';
        $cart_content   = WPHB_Cart::instance();

        if ( $cart_icon == '1' ) {
            $icon = 'sl-basket-loaded';
        } elseif ( $cart_icon == '2' ) {
            $icon = 'wn-fa wn-fa-shopping-cart';
        } elseif ( $cart_icon == '3' ) {
            $icon = 'icon-ecommerce-cart-plus';
        } elseif ( $cart_icon == '4' ) {
            $icon = 'icon-ecommerce-bag';
        }        

        $cart_count = '';

        // styles
        if ( $once_run_flag ) :
            $current_element = 'body #wrap #webnus-header-builder [data-id=whb-cart-' . esc_attr( $uniqid ) . '] > a' ;

            $dynamic_style = '';
            $dynamic_style .= whb_styling_tab_output( $atts, 'Icon', 'body #wrap #webnus-header-builder [data-id=whb-cart-' . esc_attr( $uniqid ) . '] > .wn-cart-modal-icon > i:before', 'body #wrap #webnus-header-builder [data-id=whb-cart-' . esc_attr( $uniqid ) . ']:hover > .wn-cart-modal-icon i:before'  );
            $dynamic_style .= whb_styling_tab_output( $atts, 'Counter', 'body #wrap #webnus-header-builder [data-id=whb-cart-' . esc_attr( $uniqid ) . '] .header-cart-count-icon' );
            $dynamic_style .= whb_styling_tab_output( $atts, 'Box', 'body #wrap #webnus-header-builder [data-id=whb-cart-' . esc_attr( $uniqid ) . ']' );
            $dynamic_style .= whb_styling_tab_output( $atts, 'Tooltip', 'body #wrap #webnus-header-builder [data-id=whb-cart-' . esc_attr( $uniqid ) .'].whb-tooltip[data-tooltip]:before' );
            $dynamic_style .= whb_styling_tab_output( $atts, 'Products Box', 'body #wrap #webnus-header-builder [data-id=whb-cart-' . esc_attr( $uniqid ) .'] .htc-hotel-cart' );

            if ( $dynamic_style ) :
                WHB_Helper::set_dynamic_styles( $dynamic_style );
            endif;
        endif;

        // extra class
        $extra_class = $extra_class ? ' ' . $extra_class : '';
        if ( get_option('tp_hotel_booking_wc_enable') == 'no' ) {
            $cart_count = $cart_content->cart_items_count;
        } else {
            if ( WHB_Helper::is_frontend_builder() ) {
                $cart_count = esc_html__( '0', 'deep' );
            } else {
                $cart_count = deepCartCount();
            }
        }
        

        if ( empty ( $cart_count ) ) {
            $cart_count = '0';
        }
        // render
        ?>
        <div class="whb-element whb-icon-wrap whb-cart whb-hotel-cart <?php echo esc_attr( $tooltip_class . $extra_class ); ?>whb-header-woo-cart-toggle " data-id="whb-cart-<?php echo esc_attr( $uniqid ); ?>"  <?php echo esc_attr($tooltip); ?> >
            <a href="#" id="wn-cart-modal-icon"></a>

            <div class="wn-cart-modal-icon whb-icon-element hcolorf ">
                <span id="header-cart-count-icon" class="header-cart-count-icon colorb" data-cart_count = <?php echo esc_attr($cart_count); ?> >
                <?php 
                if ( class_exists( 'WP_Hotel_Booking' ) ) {
                    echo esc_html($cart_count);
                } else {
                    esc_html_e( '0', 'deep' );
                } ?>
                </span>
                <i id="header-cart-icon" class="<?php echo esc_attr($icon); ?>"></i>
            </div>

            <div class="htc-hotel-cart">
            <?php
                if ( ! empty( $cart_content ) ) :

                    hb_get_template( 'cart/mini_cart.php' );
                    
                endif;
                $cart           = WP_Hotel_Booking::instance()->cart;
                $rooms          = $cart->get_rooms();    
                if ( $rooms == NULL ) {
                    $WPHB_Cart = new WPHB_Cart;
                    $WPHB_Cart->empty_cart();
                }
                ?>
            </div>

        </div>

        <?php
        $out= ob_get_contents();
        ob_end_clean();
        return $out;
    }
	
}

WHB_Helper::add_element( 'wp-hotel-booking-cart', 'whb_htc_cart' );