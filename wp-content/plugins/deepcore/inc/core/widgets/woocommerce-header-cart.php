<?php
if ( class_exists( 'Woocommerce_Header_Cart' ) ) {

	class Woocommerce_Header_Cart extends WP_Widget {
		public function __construct() {
			parent::__construct('woocommerce-header-cart','Woocommerce Header Cart',
				array( 'description' => esc_html__( 'Woocommerce Header Cart', 'deep' ), )
			);
		}
		public function widget( $args, $instance ) {
			global $post;
			extract( $args );
			echo '' . $before_widget;
			global $woocommerce; ?>
			<div class="woo-cart-header">
				<a class="header-cart" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>"><span class="header_cart_span"><?php echo esc_html( $woocommerce->cart->cart_contents_count ); ?></span></a>
				<div class="woo-cart-dropdown">
				<?php
					$cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0; ?>
					<div class="widget_shopping_cart_content">
						<ul class="cart_list product_list_widget cart-list product-list-widget">
							<?php if ( ! WC()->cart->is_empty() ) : ?>
								<?php do_action( 'woocommerce_before_mini_cart_contents' ); ?>
								<?php
								foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
									$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
									$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

									if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
										$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
										$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
										$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
										$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key ); ?>
										<li class="<?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
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
												<a href="<?php echo esc_url( $product_permalink ); ?>">
													<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . $product_name . '&nbsp;'; ?>
												</a>
											<?php endif; ?>
											<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>

											<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
										</li>
											<?php
										}
									}
									?>
									<?php do_action( 'woocommerce_mini_cart_contents' ); ?>
							<?php else : ?>
								<li class="empty"><?php _e( 'No products in the cart.', 'woocommerce' ); ?></li>
							<?php endif; ?>
						</ul><!-- end product list -->
					</div>
				</div>
			</div>
			<?php echo '' . $after_widget;
		}
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			return $instance;
		}
	}

	add_action( 'widgets_init', create_function( '', 'register_widget( "Woocommerce_Header_Cart" );' ) );
	add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
	function woocommerce_header_add_to_cart_fragment( $fragments ) {
		global $woocommerce;
		ob_start();	?>
		<span class="header_cart_span"><?php echo esc_html( $woocommerce->cart->cart_contents_count ); ?></span>
		<?php
			$fragments['span.header_cart_span'] = ob_get_clean();
			return $fragments;	
	}
}