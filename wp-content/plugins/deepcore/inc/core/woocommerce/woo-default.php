<?php
/*  
*   ---------------------------------------------------------------------
*   Woocommerce functions
*   --------------------------------------------------------------------- 
*/

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if ( is_plugin_active('woocommerce/woocommerce.php') ) {

    // Add Support
    add_action( 'wp_enqueue_scripts', 'webnus_script_loader2' );

    function webnus_script_loader2() {
        wp_enqueue_style( 'deep-woocommerce-style', DEEP_CORE_URL . 'woocommerce/assets/default-woocommerce.css' );
    }
    
    
    add_theme_support( 'woocommerce' );
    // Add for version 3
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    
    // Disable WooCommerce styles 
    if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
    add_filter( 'woocommerce_enqueue_styles', '__return_false' );
    } else {
        define( 'WOOCOMMERCE_USE_CSS', false );
    }
    
    // Define Wrapper
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

    add_action('woocommerce_before_main_content', 'deep_theme_wrapper_start', 10);
    add_action('woocommerce_after_main_content', 'deep_theme_wrapper_end', 10);

    function deep_theme_wrapper_start() {
        $deep_options       = deep_options();
        if ( $deep_options['deep_shop_layout'] == 'left' ) : ?>
        <!-- woo sidebar -->
        <aside id="sidebar_left" class="col-md-3 sidebar">
            <div id="default-widget-area" class="widget-area">
                <ul class="xoxo">
                <?php if ( is_active_sidebar( 'shop-widget-area' ) ) :
                    dynamic_sidebar( 'shop-widget-area' );
                endif; ?>
                </ul>
            </div>
        </aside>
        <?php endif;
        if ( $deep_options['deep_shop_layout'] == 'right' ) {
            $grid = 'col-md-8';
        } elseif ( $deep_options['deep_shop_layout'] == 'left' ) {
            $grid = 'col-md-8 col-md-offset-1';
        } elseif ( $deep_options['deep_shop_layout'] == 'full' ) {
            $grid = 'col-md-12';
        }
        echo '<section id="content_left" class="woo-template '.$grid.' ">';
        
    }
    function deep_theme_wrapper_end() {
      echo '</section>';
    }

    // Remove Breadcrumbs
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

    // Products per row
    add_filter('loop_shop_columns', 'loop_columns');
    
    if (!function_exists('loop_columns')) {
        function loop_columns() {
            return 3; //ot_get_option('woo_columns', '3');
        }
    }
    
    // Redefine woocommerce_output_related_products()
    function woocommerce_output_related_products() {
        woocommerce_related_products(array('posts_per_page'=>3,'columns'=>3)); // Display 3 products in rows of 3
    }
    
    // Products per page
    add_filter( 'loop_shop_per_page', function() {
        return 9;
    }, 20 );
    

    // Add image wrap
    add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_product_thumbnail_wrap_open', 9, 2);
    add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_product_thumbnail_wrap_close', 14, 2);

    if (!function_exists('woocommerce_product_thumbnail_wrap_open')) {
        function woocommerce_product_thumbnail_wrap_open() {
            echo '<div class="img-wrap">';
        }
    }

    if (!function_exists('woocommerce_product_thumbnail_wrap_close')) {
        function woocommerce_product_thumbnail_wrap_close() {
            echo '</div>';
        }
    }

    // Add secondary image
    if ( ! class_exists( 'WC_webnus' ) ) {

        class WC_webnus {

            public function __construct() {
                add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'woocommerce_template_loop_second_product_thumbnail' ), 11 );
                add_filter( 'post_class', array( $this, 'product_has_gallery' ) );
            }


            /*-----------------------------------------------------------------------------------*/
            /* Class Functions */
            /*-----------------------------------------------------------------------------------*/

            // Add webnus-has-gallery class to products that have a gallery
            function product_has_gallery( $classes ) {
                global $product;

                $post_type = get_post_type( get_the_ID() );

                if ( ! is_admin() ) {

                    if ( $post_type == 'product' ) {

                        $attachment_ids = $product->get_gallery_image_ids();

                        if ( $attachment_ids ) {
                            $classes[] = 'webnus-has-gallery';
                        }
                    }

                }

                return $classes;
            }


            /*-----------------------------------------------------------------------------------*/
            /* Frontend Functions */
            /*-----------------------------------------------------------------------------------*/

            // Display the second thumbnails
            function woocommerce_template_loop_second_product_thumbnail() {
                global $product, $woocommerce;

                $attachment_ids = $product->get_gallery_image_ids();

                if ( $attachment_ids ) {
                    $secondary_image_id = $attachment_ids['0'];
                    echo wp_get_attachment_image( $secondary_image_id, 'shop_catalog', '', $attr = array( 'class' => 'secondary-image attachment-shop-catalog' ) );
                }
            }

        }


        $WC_webnus = new WC_webnus();
    }
    


    // Add the inner div in product loop
    add_action( 'woocommerce_before_shop_loop_item_title', 'artificer_product_inner_open', 14, 2);
    add_action( 'woocommerce_after_shop_loop_item_title', 'artificer_product_inner_close', 12, 2);

    function artificer_product_inner_open() {
        echo '<div class="product-inner">';
    }
    function artificer_product_inner_close() {
        echo '</div>';
    }
    
    // Change rating position
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
    add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 11 );
    
    // Change linked product count in a row
    function woocommerce_upsell_display( $limit = 3, $columns = 3, $orderby = 'rand', $order = 'desc' ) {
    global $product, $woocommerce_loop;
    // Handle the legacy filter which controlled posts per page etc.
    $args = apply_filters( 'woocommerce_upsell_display_args', array(
        'posts_per_page' => $limit,
        'orderby'        => $orderby,
        'columns'        => $columns,
    ) );
    $woocommerce_loop['name']    = 'up-sells';
    $woocommerce_loop['columns'] = apply_filters( 'woocommerce_upsells_columns', isset( $args['columns'] ) ? $args['columns'] : $columns );
    $orderby                     = apply_filters( 'woocommerce_upsells_orderby', isset( $args['orderby'] ) ? $args['orderby'] : $orderby );
    $limit                       = apply_filters( 'woocommerce_upsells_total', isset( $args['posts_per_page'] ) ? $args['posts_per_page'] : $limit );
    // Get visble upsells then sort them at random, then limit result set.
    $upsells = wc_products_array_orderby( array_filter( array_map( 'wc_get_product', $product->get_upsell_ids() ), 'wc_products_array_filter_visible' ), $orderby, $order );
    $upsells = $limit > 0 ? array_slice( $upsells, 0, $limit ) : $upsells;

    wc_get_template( 'single-product/up-sells.php', array(
        'upsells' => $upsells,

        // Not used now, but used in previous version of up-sells.php.
        'posts_per_page' => $limit,
        'orderby'        => $orderby,
        'columns'        => $columns,
    ) );
    }
    
    

    // Show sidebar in selected pages
if ( ! function_exists( 'woocommerce_get_sidebar' ) ) {
        function woocommerce_get_sidebar() {
            $deep_options       = deep_options();
            if ( $deep_options['deep_shop_layout'] == 'right' ) : ?>
                <!-- woo sidebar -->
                <aside id="sidebar_right" class="col-md-3 col-md-offset-1 sidebar">
                    <div id="default-widget-area" class="widget-area">
                        <ul class="xoxo">
                        <?php if ( is_active_sidebar( 'shop-widget-area' ) ) :
                            dynamic_sidebar( 'shop-widget-area' );
                        endif; ?>
                        </ul>
                    </div>
                </aside>
            <?php endif;
            echo '<div class="clear"></div>';
        }
    }
    
} ?>