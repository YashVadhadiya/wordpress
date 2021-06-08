<?php

/**
 * Mini cart.
 *
 * @since   1.0.0
 */
function wn_mini_cart() {

    $data_items_count = '0';

    if ( !WC()->cart->is_empty() && class_exists( 'WooCommerce' ) ) :

        do_action( 'woocommerce_before_mini_cart_contents' );

        $data_items_count = WC()->cart->get_cart_contents_count();

        echo '<div class="wn-count-cart-product colorf" data-items="' . esc_attr( $data_items_count ) . '">';
        echo sprintf ( _n( '<strong>%d</strong> '.esc_html__( 'ITEM', 'deep' ).'', '<strong>%d</strong> '.esc_html__( 'ITEMS', 'deep' ).'', $data_items_count ), $data_items_count );
        echo ' ';
        echo esc_html__( 'IN SHOPPING BAG', 'deep' );
        echo '</div>';
        echo '<div class="whb-cart-elements-wrap">';

        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

            $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

                $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                $thumbnail_url     = ( $_product->get_image_id() ) ? wp_get_attachment_url( $_product->get_image_id() ) : '' ;
                $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

                ?>

                <div class="clearfix woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
                    <?php
                    echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                        '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                        esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                        __( 'Remove this item', 'deep' ),
                        esc_attr( $product_id ),
                        esc_attr( $_product->get_sku() )
                    ), $cart_item_key );
                    ?>
                    <?php if ( ! $_product->is_visible() ) : ?>
                        <?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . $product_name . '&nbsp;'; ?>
                    <?php else : ?>
                    <a class="wn-woo-cart-product-wrap" href="<?php echo esc_url( $product_permalink ); ?>">
                        <div class="wn-woo-cart-img">
                        <?php 
                        if( !empty( $thumbnail_url ) ) {
                            // if main class not exist get it
                            if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                                require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
                            }
                            $image = new Wn_Img_Maniuplate; // instance from settor class
                            $thumbnail_url = $image->m_image( $_product->get_image_id() , $thumbnail_url , '64' , '64' ); // set required and get result
                        }
                        ?>
                        <img src="<?php echo '' . $thumbnail_url; ?>" />
                        </div>
                        <div class="wn-woo-cart-content">
                            <div class="wn-woo-cart-product-name">
                                <?php echo '' . $product_name; ?>
                            </div>
                            <div class="wn-woo-cart-product-price">
                                <?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
                                <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', ''.esc_html__('Qty:','deep').' <span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
                            </div>
                        </div>
                    </a>
                    <?php endif; ?>
                </div>
                <?php
            }
        }

        echo '</div>';

        do_action( 'woocommerce_mini_cart_contents' ); ?>

        <p class="woocommerce-mini-cart__total total"><strong><?php _e( 'ITEM TOTAL', 'deep' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

        <?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

        <p class="woocommerce-mini-cart__buttons buttons"><?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?></p>

    <?php else :

        echo '<div class="wn-count-cart-product colorf" data-items="' . esc_attr( $data_items_count ) . '">';
        echo sprintf ( _n( '<strong>%d</strong> '.esc_html__( 'ITEM', 'deep' ).'', '<strong>%d</strong> '.esc_html__( 'ITEMS', 'deep' ).'', $data_items_count ), $data_items_count );
        echo ' ';
        echo esc_html__( 'IN SHOPPING BAG', 'deep' );
        echo '</div>';
        echo '<div class="whb-cart-elements-wrap"></div>';

    endif;

    do_action( 'woocommerce_after_mini_cart' );

}