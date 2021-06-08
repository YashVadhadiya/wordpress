<?php

/**
 * WooCommerce Template Functions.
 *
 * @package deep
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( ! is_plugin_active('woocommerce/woocommerce.php') ) {
    return;
}

// Remove Woocommerce redirect setup page
if ( ! function_exists( 'remove_class_filters' ) ) {
    function remove_class_filters( $tag, $class, $method ) {
        $filters = $GLOBALS['wp_filter'][ $tag ];
        if ( empty ( $filters ) ) {
            return;
        }
        foreach ( $filters as $priority => $filter ) {
            foreach ( $filter as $identifier => $function ) {
                if ( is_array( $function )  ) {

                    if ( is_array( $function['function'] ) || is_string( $function['function'] ) ) {

                        if ( is_a( $function['function'][0], $class ) and $method === $function['function'][1] ) {

                            remove_filter(
                                $tag,
                                array ( $function['function'][0], $method ),
                                $priority
                            );

                        }

                    }

                }

            }

        }

    }

}

add_action( 'admin_init', 'disable_shop_redirect', 0 );
function disable_shop_redirect() {
    remove_class_filters(
        'admin_init',
        'WC_Admin',
        'admin_redirects'
    );
}

/**
 * ---> Hook in on theme/plugin activation
 *
 * @see  deep_woo_image_dimensions()
 */

add_action( 'after_switch_theme', 'deep_woo_image_dimensions', 1 );
add_action( 'admin_init', 'deep_woo_image_dimensions', 1000 );

if ( ! function_exists( 'deep_woo_image_dimensions' ) ) {
    /**
     * Set WooCommerce image dimensions upon theme activation
     *
     * @since 1.0.0
     */
    function deep_woo_image_dimensions() {
        global $pagenow;

        if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
            return;
        }

        $thumbnail = array(
            'width'     => '134',   // px
            'height'    => '134',   // px
            'crop'      => 0        // false
        );
        $catalog = array(
            'width'     => '254',   // px
            'height'    => '352',   // px
            'crop'      => 0        // false
        );
        $single = array(
            'width'     => '660',   // px
            'height'    => '786',   // px
            'crop'      => 0        // false
        );

        // Image sizes
        update_option( 'shop_catalog_image_size', $catalog );       // Product category thumbs
        update_option( 'shop_single_image_size', $single );         // Single product image
        update_option( 'shop_thumbnail_image_size', $thumbnail );   // Image gallery thumbs
    }
}


/**
 * ---> Start Layout
 *
 * @see  deep_hide_page_title()
 * @see  deep_before_content()
 * @see  deep_loop_columns()
 */

// display variations price
add_filter( 'woocommerce_variation_option_name', 'display_price_in_variation' );

// disable woo styles
add_filter( 'woocommerce_enqueue_styles',                   '__return_empty_array' );
add_action( 'wp_enqueue_scripts',                           'deep_woo_scripts',                     9999 );

// remove the "shop" title on the main shop page
add_filter( 'woocommerce_show_page_title',                  'deep_hide_page_title' );

// before main content
remove_action( 'woocommerce_before_main_content',           'woocommerce_breadcrumb',                   20, 0 );
remove_action( 'woocommerce_before_main_content',           'woocommerce_output_content_wrapper',       10 );
add_action( 'woocommerce_before_main_content',              'deep_before_content',                  10 );

// before shop loop
remove_action( 'woocommerce_before_shop_loop',              'woocommerce_result_count',                 20 );
remove_action( 'woocommerce_before_shop_loop',              'woocommerce_catalog_ordering',             30 );
add_action( 'woocommerce_before_shop_loop',                 'deep_woo_before_shop_loop',                30 );

// after shop loop
add_action( 'woocommerce_after_shop_loop',                  'deep_woo_after_shop_loop',             30 );
add_action( 'wn_ordering_woo',                              'wn_ordering_woocommerce' );

// after main content
remove_action( 'woocommerce_after_main_content',            'woocommerce_output_content_wrapper_end',   10 );
add_action( 'woocommerce_after_main_content',               'deep_after_content',                   10 );

// Default loop columns on product archives
add_filter( 'loop_shop_columns',                            'deep_loop_columns' );

// Change default catalog sort order
add_filter( 'woocommerce_default_catalog_orderby',          'deep_change_default_catalog_orderby' );

// Sidebar
remove_action( 'woocommerce_sidebar',                       'woocommerce_get_sidebar',                  10 );

// Crat page
add_action( 'woocommerce_before_template_part',             'deep_woo_cart_empty_before' );
add_action( 'woocommerce_cart_is_empty',                    'deep_woo_cart_empty_content' );
add_action( 'woocommerce_after_template_part',              'deep_woo_cart_empty_after' );

// Single product
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_single_product_summary',        'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary',        'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary',        'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary',        'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary',        'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary',        'woocommerce_template_single_sharing', 50 );

remove_action( 'woocommerce_after_single_product_summary',  'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary',  'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary',  'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating', 10 );
remove_action( 'woocommerce_review_meta', 'woocommerce_review_display_meta', 10 );

add_action( 'woocommerce_after_single_product_summary', 'deep_woo_single_upsell_product', 19 );
add_action( 'woocommerce_after_single_product_summary', 'deep_woo_single_related_product', 20 );
add_action( 'deep_woo_single_related_product_action',   'woocommerce_output_related_products', 20 );

// Products posts per page
add_filter( 'loop_shop_per_page', function() {
    return 10;
}, 20 );


//--Next and Prev
add_action( 'woocommerce_before_single_product',            'deep_woo_return_to_shop_page' );
add_action( 'woocommerce_before_single_product',            'deep_woo_breadcrumb' );
add_action( 'woocommerce_before_single_product',            'dee_woo_nextprev_product' );

//--Gallery and Content
add_action( 'woocommerce_before_single_product_summary',    'deep_woo_start_single_content' );
add_action( 'woocommerce_before_single_product_summary',    'deep_woo_single_gallery_images' );
add_action( 'woocommerce_before_single_product_summary',    'deep_woo_single_details' );
add_action( 'woocommerce_after_single_product_summary',     'deep_woo_end_single_content' );
add_action( 'woocommerce_after_single_product_summary',     'woocommerce_output_product_data_tabs' );

// Review in single product
add_action( 'woocommerce_review_before_comment_meta', 'woocommerce_review_display_meta', 10 );
add_action( 'woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating', 10 );
add_filter( 'woocommerce_review_gravatar_size', 'deep_woo_review_avatar_size' );

// Change number of related products on product page
add_filter( 'woocommerce_output_related_products_args', 'deep_woo_related_products_limit' );

// Display Review by date on single product page
add_filter( 'woocommerce_product_review_list_args', 'dee_woo_newest_reviews_first' );

// Checkout
add_action( 'woocommerce_checkout_before_customer_details', 'deep_woo_checkout_before_customer_details' );
add_action( 'woocommerce_checkout_after_customer_details',  'deep_woo_checkout_after_customer_details' );
add_action( 'woocommerce_checkout_after_order_review',      'deep_woo_checkout_after_order_review' );
add_action( 'woocommerce_checkout_shipping',                'deep_woo_checkout_shipping' );

// Compare
add_action( 'yith_woocompare_popup_head',                   'deep_woo_yith_woocompare_popup_head' );

// Quick view
remove_action( 'yith_wcqv_product_image',                   'woocommerce_show_product_sale_flash', 10 );
remove_action( 'yith_wcqv_product_image',                   'woocommerce_show_product_images', 20 );
remove_action( 'yith_wcqv_product_summary',                 'woocommerce_template_single_title', 5 );
remove_action( 'yith_wcqv_product_summary',                 'woocommerce_template_single_rating', 10 );
remove_action( 'yith_wcqv_product_summary',                 'woocommerce_template_single_price', 15 );
remove_action( 'yith_wcqv_product_summary',                 'woocommerce_template_single_excerpt', 20 );
remove_action( 'yith_wcqv_product_summary',                 'woocommerce_template_single_add_to_cart', 25 );
remove_action( 'yith_wcqv_product_summary',                 'woocommerce_template_single_meta', 30 );

add_action( 'yith_wcqv_product_summary',                    'deep_woo_single_gallery_images' );
add_action( 'yith_wcqv_product_summary',                    'deep_woo_single_details' );


// login & register
add_action( 'woocommerce_after_customer_login_form',        'deep_woo_login_and_register' );

// my account
add_action( 'woocommerce_before_account_navigation',        'deep_woo_before_account_navigation' );
add_action( 'woocommerce_after_account_navigation',         'deep_woo_after_account_navigation' );
add_action( 'woocommerce_account_navigation',               'deep_woo_before_my_account' );
add_action( 'woocommerce_after_my_account',                 'deep_woo_after_my_account' );

// Change number of related products on product page
if ( ! function_exists( 'deep_woo_related_products_limit' ) ) {
    function deep_woo_related_products_limit() {
        global $product;
        $args['posts_per_page'] = 100;
        return $args;
    }
}


// Display Review by date
if ( ! function_exists( 'dee_woo_newest_reviews_first' ) ) {
    function dee_woo_newest_reviews_first($args) {
        $args['reverse_top_level'] = true;
        return $args;
    }
}

if ( ! function_exists( 'deep_woo_scripts' ) ) {
    /**
     * Manage WooCommerce styles and scripts
     *
     * @since 1.0.0
     */
    function deep_woo_scripts() {
        wp_enqueue_style( 'deep-slick-icons', DEEP_ASSETS_URL . 'css/frontend/icons/slick.css' );
        wp_deregister_style('deep-woocommerce-style');
        wp_enqueue_style( 'deep-circle-side' );
        wp_enqueue_style( 'deep-woocommerce-style', DEEP_CORE_URL . 'woocommerce/assets/woocommerce.css' );
        wp_enqueue_script( 'deep-woocommerce-script', DEEP_CORE_URL . 'woocommerce/assets/woocommerce.js', array( 'jquery' ), null, true );

        // preparing for front ajax
        $deep_wishlist_loc = array(
            'ajax_url'                      => admin_url( 'admin-ajax.php', 'relative' ),
            'remove_from_wishlist_action'   => 'remove_from_wishlist',
            'translatblewishlist'           => __( 'Appended', 'deep' )
        );
        //lolize some var for wishlist
        wp_localize_script( 'deep-woocommerce-script', 'deep_wishlist_js', $deep_wishlist_loc );
    }
}

if ( ! function_exists( 'deep_hide_page_title' ) ) {
    /**
     * Remove the "shop" title on the main shop page
     *
     * @since   1.0.0
     * @return  void
     */
    function deep_hide_page_title() {
        return false;
    }
}

if ( ! function_exists( 'deep_before_content' ) ) {
    /**
     * Woo Content
     *
     * @since   1.0.0
     * @return  void
     */
    function deep_before_content() {
        $deep_options       = deep_options();
        $hast_left_sidebar  = ( $deep_options['deep_shop_layout'] == 'left' ) ? ' wn-woo-has-left-sidebar' : '';
        $has_right_sidebar  = ( $deep_options['deep_shop_layout'] == 'right' ) ? ' wn-woo-has-right-sidebar' : ''; ?>

        <div id="wn-woo-wrap" class="wn-woo-wrap<?php echo '' . $hast_left_sidebar . $has_right_sidebar ?> clearfix">

        <?php
    }
}

if ( ! function_exists( 'deep_woo_before_shop_loop' ) ) {
    /**
     * Woo Sidebar + Woo Filtering
     *
     * @since   1.0.0
     * @return  void
     */
function deep_woo_before_shop_loop() {
    $deep_options = deep_options();
    $hast_sidebar    = ( $deep_options['deep_shop_layout'] != 'full' ) ? ' wn-woo-has-sidebar' : '';

    if ( $deep_options['deep_shop_layout'] == 'left' ) : ?>
        <!-- woo sidebar -->
        <aside class="wn-woo-sidebar wn-woo-left-sidebar">
            <ul class="wn-woo-widget-wrap">
                <?php if ( is_active_sidebar( 'shop-widget-area' ) ) :
                    dynamic_sidebar( 'shop-widget-area' );
                endif; ?>
            </ul>
        </aside>
    <?php endif; ?>

    <!-- woo main -->
<?php
$deep_options   = deep_options();
$woo_skin_data  = ( $deep_options['deep_woo_shop_default_view'] == 'grid' ) ? 'grid' : 'list' ;
?>
    <main class="wn-woo-main<?php echo '' . $hast_sidebar; ?>" role="main" data-woo-skin="<?php echo '' . $woo_skin_data; ?>">


    <!-- woo filtering -->
    <div class="wn-woo-filtering-wrap clearfix">

        <!-- woo filtering in mobile -->
        <div class="wn-woo-mobile-filters">
            <div class="wn-woo-mobile-filters-button">
                <i class="ti-filter"></i>
                <span><?php esc_html_e('Filters','deep'); ?></span>
            </div>
        </div>

        <!-- categories filter -->
        <div class="wn-woo-product-categories clearfix">
            <?php
            $shop_page_url  = get_permalink( wc_get_page_id( 'shop' ) );
            $current_cat    = is_shop() ? ' current-cat' : '';
            echo '<span class="cat-item cat-item-all' . $current_cat . '"><a href="' . $shop_page_url . '">' . esc_html__( 'All', 'deep' ) . '</a></span>';
            the_widget( 'WC_Widget_Product_Categories', 'title=&hide_empty=0&hierarchical=0&count=0&show_children_only=0' );
            ?>
        </div>

        <!-- right filters -->
        <div class="wn-woo-right-side">
            <div class="wn-woo-skin-switcher">
                <?php
                $deep_options       = deep_options();
                $layout_grid_enable = ( $deep_options['deep_woo_shop_default_view'] == 'grid' ) ? 'wn-active' : '' ;
                $layout_list_enable = ( $deep_options['deep_woo_shop_default_view'] == 'list' ) ? 'wn-active' : '' ;
                ?>
                <a href="#"><span class="wn-list-view-icon <?php echo '' . $layout_list_enable; ?>" data-woo-skin="list"></span></a>
                <a href="#"><span class="wn-grid-view-icon <?php echo '' . $layout_grid_enable; ?>" data-woo-skin="grid"></span></a>
            </div>
            <div class="wn-woo-ordering-wrap wn-nice-select">
                <?php do_action( 'wn_ordering_woo' ); ?>
            </div>
        </div>

        <div class="wn-woo-mobile-filters-widgets">
            <hr class="vertical-space3">
            <ul class="wn-woo-widget-wrap">
                <?php if ( is_active_sidebar( 'shop-widget-area' ) ) {
                    dynamic_sidebar( 'shop-widget-area' );
                }else{
                    esc_html_e('There is no filters to show. You can active filters in "Appearance > Widget > Woocommerce Page Sidebar"','deep');
                } ?>
            </ul>
        </div>
    </div> <!-- end .wn-woo-filtering-wrap -->
    <?php
}
}

if ( ! function_exists( 'deep_woo_after_shop_loop' ) ) {
    /**
     * End Woo Sidebar + Woo Filtering
     *
     * @since   1.0.0
     * @return  void
     */
function deep_woo_after_shop_loop() {
    $deep_options   = deep_options();?>

    </main> <!-- #main -->

    <?php if ( $deep_options['deep_shop_layout'] == 'right' ) : ?>
    <!-- woo sidebar -->
    <aside class="wn-woo-sidebar wn-woo-right-sidebar">
        <ul class="wn-woo-widget-wrap">
            <?php if ( is_active_sidebar( 'shop-widget-area' ) ) :
                dynamic_sidebar( 'shop-widget-area' );
            endif; ?>
        </ul>
    </aside>
<?php endif;
}
}

if ( ! function_exists( 'deep_after_content' ) ) {
    /**
     * After Content
     * Closes the wrapping divs
     *
     * @since   1.0.0
     * @return  void
     */
    function deep_after_content() {
        ?>
        </div> <!-- #primary -->
        <?php
    }
}

if ( ! function_exists( 'deep_loop_columns' ) ) {
    /**
     * Default loop columns on product archives
     *
     * @since  1.0.0
     * @return integer products per row
     */
    function deep_loop_columns() {
        $deep_options       = deep_options();
        return apply_filters( 'deep_loop_columns', $deep_options['deep_woo_shop_products_in_shop'] ); // 5 products per row
    }
}

if ( ! function_exists( 'deep_change_default_catalog_orderby' ) ) {
    /**
     * Change default catalog sort order
     *
     * @since  1.0.0
     * @return void
     */
    function deep_change_default_catalog_orderby() {
        return 'date';
    }
}

/*
 * ---> End Layout
 */
if ( ! function_exists( 'deep_product_star_rating' ) ) {
    function deep_product_star_rating() {
        global $wpdb,$product,$post;
        $rating_count = $product->get_rating_count();
        $review_count = $product->get_review_count();
        $average      = $product->get_average_rating();
        $count = $wpdb->get_var("
                SELECT COUNT(meta_value) FROM $wpdb->commentmeta
                LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
                WHERE meta_key = 'rating'
                AND comment_post_ID = $post->ID
                AND comment_approved = '1'
                AND meta_value > 0
            ");

        $rating = $wpdb->get_var("
                SELECT SUM(meta_value) FROM $wpdb->commentmeta
                LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
                WHERE meta_key = 'rating'
                AND comment_post_ID = $post->ID
                AND comment_approved = '1'
            ");

        if ( $count > 0 ) {
            $average = number_format($rating / $count, 2);
            echo '
                    <div class="starwrapper" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                        <span class="wn-star-rating" title="'.sprintf(__('Rated %s out of 5', 'deep'), $average).'">
                            <span style="width:'.($average*15).'px">
                                <span itemprop="ratingValue" class="rating">'.$average.'</span>
                            </span>
                        </span>
                    </div>';
            printf(
                _n( '%s review', '%s reviews', $rating_count, 'deep' ),
                '<span class="count-rating">' . esc_html( $rating_count ) . '</span>'
            );
        }
    }
}



/**
 * ---> Start Products
 *
 * @see  deep_product_has_gallery()
 * @see  deep_woo_template_loop_second_product_thumbnail()
 * @see  deep_woo_shop_loop_item()
 */

// Product Image Flipper
// add_filter( 'post_class',                                'deep_product_has_gallery' );
//add_action( 'woocommerce_before_shop_loop_item_title',    'deep_woo_template_loop_second_product_thumbnail', 11 );

// Sale flashes
remove_action( 'woocommerce_before_shop_loop_item_title',   'woocommerce_show_product_loop_sale_flash',     10 );

// Product Loop Items
remove_action( 'woocommerce_before_shop_loop_item',         'woocommerce_template_loop_product_link_open',  10 );
remove_action( 'woocommerce_after_shop_loop_item',          'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_before_shop_loop_item_title',   'woocommerce_template_loop_product_thumbnail',  10 );
remove_action( 'woocommerce_shop_loop_item_title',          'woocommerce_template_loop_product_title',      10 );
remove_action( 'woocommerce_after_shop_loop_item',          'woocommerce_template_loop_add_to_cart',        10 );
remove_action( 'woocommerce_after_shop_loop_item_title',    'woocommerce_template_loop_price',              10 );
remove_action( 'woocommerce_after_shop_loop_item_title',    'woocommerce_template_loop_rating',             5 );
add_filter( 'post_class', 'add_type_list_grid_product_item' );


// YITH WooCommerce Quick View
if ( is_plugin_active( 'yith-woocommerce-quick-view/init.php' ) && class_exists( 'YITH_WCQV_Frontend' ) ) {
    remove_action( 'woocommerce_after_shop_loop_item',      array( YITH_WCQV_Frontend::get_instance(), 'yith_add_quick_view_button' ), 15 );
}

add_action( 'woocommerce_before_shop_loop_item',            'deep_woo_shop_loop_item',                  10 );
add_action( 'woocommerce_before_shop_loop',         'deep_woo_get_ajax_info',                   10 );
//add_action( 'woocommerce_before_shop_loop',         'deep_woo_get_cat_info',                   10 );

// Add list/grid type to li product item
if ( ! function_exists( 'add_type_list_grid_product_item' ) ) {
    function add_type_list_grid_product_item( $classes ) {
        $deep_options   = deep_options();
        if ( is_product() ){
            $classes[]  = 'type-grid single-type-grid' ;
        }else{
            $classes[]  = ( $deep_options['deep_woo_shop_default_view'] == 'grid' ) ? 'type-grid' : 'type-list' ;
        }
        return $classes;
    }
}



if ( ! function_exists( 'deep_product_has_gallery' ) ) {
    /**
     * Add "wn-woo-has-gallery" class to products that have a gallery
     *
     * @since  1.0.0
     * @return @classes
     */
    function deep_product_has_gallery( $classes ) {
        global $product;

        $post_type = get_post_type( get_the_ID() );

        if ( ! is_admin() ) :
            if ( $post_type == 'product' ) {
                $attachment_ids = $product->get_gallery_attachment_ids();
                if ( $attachment_ids ) {
                    $classes[] = 'wn-woo-has-gallery';
                }
            }
        endif; // ! is_admin()

        return $classes;
    }
}

if ( ! function_exists( 'deep_woo_template_loop_second_product_thumbnail' ) ) {
    /**
     * Display the second thumbnails
     *
     * @since  1.0.0
     * @return void
     */
    function deep_woo_template_loop_second_product_thumbnail( $width, $height ) {
        global $product, $woocommerce;
        $attachment_ids = $product->get_gallery_image_ids();
        if ( $attachment_ids ) {
            $secondary_image_id = $attachment_ids['0'];
            $secondary_image_url = get_attached_file( $secondary_image_id );
            if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
            }
            $image = new Wn_Img_Maniuplate; // instance from settor class
            $secondary_image_url = $image->m_image( $secondary_image_id, $secondary_image_url , $width , $height ); // set required and get result
            echo '<img src="'.$secondary_image_url.'" class="secondary-image attachment-shop-catalog" />';
        }
    }
}
if ( ! function_exists( 'deep_woo_display_colors' ) ) {
    function deep_woo_display_colors() {
        $terms_name = get_post_meta( get_the_ID() , '_product_attributes' );

        foreach ($terms_name as $v1) {
            foreach ($v1 as $v2) {
                $name = $v2['name'];
                $taxonomy = get_taxonomy( $name );
                if ( $taxonomy && ! is_wp_error( $taxonomy ) ) {
                    $terms = wp_get_post_terms( get_the_ID(), $name );
                    $terms_array = array();
                    if ( ! empty( $terms ) ) {
                        foreach ( $terms as $term ) {
                            $color = get_term_meta( $term->term_id, 'color', true );
                            if ( ! empty( $color ) ) {
                                echo '<span class="dee-woo-colors-attributes wn-data-tooltip" style="background-color: '.$color.'" data-name="'.$term->name.'"></span>';
                            }
                        }
                    }
                }
            }
        }
    }
}
if ( ! function_exists( 'deep_woo_display_discount' ) ) {
    function deep_woo_display_discount() {
        $data = new WC_Product( get_the_ID());
        if ( $data->is_on_sale() ) {
            if ( ! $data->is_type( 'variable' ) ) {
                $max_percentage = round( ( ( $data->get_regular_price() - $data->get_sale_price() ) / $data->get_regular_price() ) * 100 );
            } else {
                foreach ( $data->get_children() as $child_id ) {
                    $variation = $data->get_child( $child_id );
                    $price = $variation->get_regular_price();
                    $sale = $variation->get_sale_price();
                    $percentage = $price != 0 && ! empty( $sale ) ? ( ( $price - $sale ) / $price * 100 ) : $max_percentage;
                    if ( $percentage >= $highest_percentage ) {
                        $max_percentage = $percentage;
                        $regular_price = $data->get_variation_regular_price( 'min' );
                        $sale_price = $data->get_variation_sale_price( 'min' );
                    }
                }
            }
            echo "<span class='wn-woo-price-discount colorb'>" . round($max_percentage) . "% ". esc_html__( 'OFF', 'deep' ) ."</span>";
        }
    }
}

if ( ! function_exists( 'deep_woo_get_ajax_info' ) ) {
    function deep_woo_get_ajax_info() {
        $shop_page_url =  ( get_permalink( wc_get_page_id( 'shop' ) ) ) ? get_permalink( wc_get_page_id( 'shop' ) ) : '' ;
        $p_url = sanitize_text_field( $_POST['url'] );
        $post_url = isset ($p_url) ? $p_url : $shop_page_url ;

        // get filters from URL
        $query = parse_url($post_url);
        $filter_color =  $filter_color_value = $color_filter_name = $color_filter_value ='';
        if ( isset( $query['query'] ) ) {
            parse_str($query['query'], $query_parts);
            foreach ($query_parts as $key => $value) {
                if (strpos($key, 'filter_') !== false) {
                    $filter_color       = $key;
                    $filter_color_value = $value;
                }
            }
            if ( !empty( $filter_color) ) {
                $color_filter_name = 'color_filter_name='. $filter_color;
                $color_filter_value = 'color_filter_value='. $filter_color_value;
            }
        }

        echo '<input type="hidden" '.$color_filter_name.' '.$color_filter_value.' class="deep-woo-ajax-url" value="'.$post_url.'">
            ';
    }
}

if ( ! function_exists( 'deep_woo_shop_loop_item' ) ) {
    /**
     * Before Shop Loop item
     *
     * @since   1.0.0
     * @return  void
     */
    function deep_woo_shop_loop_item() {

        global $wpdb,$product,$product_id;

        if ( $product == 'null') {
            do_action('deep_woo_no_products_found');
        }
        if ( is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) ) {
            // get item added to wishlist
            $wishexistindb = $wpdb->get_results( "SELECT prod_id FROM {$wpdb->yith_wcwl_items}" );
            // convert stdclass object to php array
            $value         = json_decode( json_encode( $wishexistindb ), true );
            // now check value
            $wishitemdb    = isset( $value[0]['prod_id'] ) ? $value[0]['prod_id'] : '';
        }

        $deep_options       = deep_options();
        $layout_grid_enable = ( $deep_options['deep_woo_shop_default_view'] == 'grid' ) ? 'enable-grid' : 'w-hide' ;
        $layout_list_enable = ( $deep_options['deep_woo_shop_default_view'] == 'list' ) ? 'enable-list' : 'w-hide' ;
        $list_type_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
        $list_type_thumbnail_url = wp_get_attachment_url( $list_type_thumbnail_id );
        if( !empty( $list_type_thumbnail_url ) ) {
            // if main class not exist get it
            if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
            }
            $image = new Wn_Img_Maniuplate; // instance from settor class
            $list_type_thumbnail_url = $image->m_image( $list_type_thumbnail_id, $list_type_thumbnail_url , '480' , '440' ); // set required and get result
        }
        ?>
        <div class="wn-woo-skin wn-woo-products-list <?php echo '' . $layout_list_enable; ?> clearfix">
            <div class="wn-woo-list-thubmnail">
                <img src="<?php echo '' . $list_type_thumbnail_url; ?>" />
                <?php deep_woo_template_loop_second_product_thumbnail('480','440'); ?>
                <?php if ( is_plugin_active( 'yith-woocommerce-quick-view/init.php' ) ) : ?>
                    <div class="wn-woo-btn wn-quick-view-btn" data-wntooltip="<?php esc_html_e( 'Quick View', 'deep' ); ?>">
                        <?php
                        if ( class_exists( 'YITH_WCQV_Frontend' ) ) {
                            YITH_WCQV_Frontend::get_instance()->yith_add_quick_view_button();
                        }
                        ?>
                        <i class="sl-magnifier-add"></i>
                    </div>
                <?php endif; ?>
            </div>
            <div class="wn-woo-list-center-section">
                <div class="clearfix ">
                    <div class="col-xs-6 alignleft">
                        <div class="deep-woo-list-categories">
                            <?php
                            $product_id = get_the_ID();
                            echo wc_get_product_category_list( $product_id );
                            ?>
                        </div>
                    </div>
                    <div class="col-xs-6 alignright">
                        <?php
                        if ( get_option('yith_woocompare_compare_button_in_product_page') == 'yes' && is_plugin_active( 'yith-woocommerce-compare/init.php' ) ) {
                            echo '
                            <div class="deep-woo-list-details-content deep-woo-list-compare-button wn-data-tooltip" data-name="'.esc_html__( 'Compare' , 'deep' ).'">
                            '.do_shortcode( '[yith_compare_button]' ).'
                                <i class="sl-shuffle"></i>
                                </div>';
                        }

                        if ( is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) ) {
                            global $wpdb,$product,$product_id;
                            // get item added to wishlist
                            $wishexistindb = $wpdb->get_results( "SELECT prod_id FROM {$wpdb->yith_wcwl_items}" );
                            // convert stdclass object to php array
                            $value         = json_decode( json_encode( $wishexistindb ), true );
                            // now check value
                            $wishitemdb    = isset( $value[0]['prod_id'] ) ? $value[0]['prod_id'] : '';
                            $product_id = get_the_ID();
                            $is_in_wishlist = ( YITH_WCWL()->is_product_in_wishlist( $product_id ) ) ? 'wn-added-wishlist' : 'no';
                            $added_wishlist = ( YITH_WCWL()->is_product_in_wishlist( $product_id ) )  ? esc_html__( 'Extra ID', 'deep' ) :  esc_html__( 'Add to Wishlist', 'deep' ) ;
                            echo '
                            <div class="deep-woo-list-details-content deep-woo-list-wishlist-button wn-data-tooltip" data-name="'.$added_wishlist.'">
                                <div class="wn-woo-btn wn-wishlist-btn '.$is_in_wishlist.'"  data-id="'.get_the_ID().'"></div>
                            </div>';
                        }
                        ?>
                    </div>
                </div>
                <div class="deep-woo-list-title">
                    <h3 class="wn-woo-title">
                        <a class="wn-product-info-id hcolorf" href="<?php echo  get_the_permalink(); ?>">
                            <?php echo  get_the_title(); ?>
                            <span class="deep-woo-line-title-list"></span>
                            <?php
                            include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
                            if ( is_plugin_active( 'yith-woocommerce-best-sellers/init.php' ) ) {
                                $is_best_seller =  class_exists( 'YITH_WCBSL_Reports_Premium' ) ? new YITH_WCBSL_Reports_Premium() : new YITH_WCBSL_Reports();
                                if ( $is_best_seller->check_is_bestseller( get_the_ID() ) == 'true' ) {
                                    echo '<span class="dee-woo-is-best-seller">'.esc_html__( 'Best Seller', 'deep' ).'</span>';
                                }
                            }
                            ?>
                        </a>
                    </h3>
                </div>
                <div class="wn-woo-list-price">
                    <?php
                    woocommerce_template_loop_price();
                    deep_woo_display_discount();
                    ?>
                </div>
                <div class="wn-woo-list-colors">
                    <?php deep_woo_display_colors(); ?>
                </div>
                <div class="wn-woo-list-excerpt">
                    <?php the_excerpt(); ?>
                </div>
            </div>
            <div class="wn-woo-list-right-section">
                <div class="wn-woo-list-right-section-in">
                    <div class="deep-woo-list-product-rating alignleft">
                        <?php deep_product_star_rating(); ?>
                    </div>
                    <?php
                    if ( get_post_meta( get_the_ID(), '_deep_featured_text', true ) ) {
                        echo '
                    <div class="deep-woo-product-featured-text alignleft">
                        '.get_post_meta( get_the_ID(), '_deep_featured_text', true ).'
                    </div>';
                    } ?>
                    <?php
                    $data = new WC_Product( get_the_ID());
                    $data_height = $data->get_height();
                    $data_width = $data->get_width();
                    $data_length = $data->get_length();
                    $data_weight = $data->get_weight();
                    if ( get_post_meta( get_the_ID(), '_deep_featured_text', true ) && ( $data_height || $data_width || $data_length || $data_weight ) ) {
                        echo '<div class="wn-woo-border"></div>';
                    }
                    if ( $data_height || $data_width || $data_length || $data_weight ) {
                        echo '<div class="wn-woo-list-dimensions alignleft">';
                        if ( $data_height ) {
                            echo '<div><strong>'.esc_html__( 'Height', 'deep' ) .':</strong> ' .$data_height . '<span>' .get_option( 'woocommerce_dimension_unit' ).'</span></div>';
                        }
                        if ( $data_width ) {
                            echo '<div><strong>'.esc_html__( 'Width', 'deep' ) .':</strong> ' . $data_width . '<span>' . get_option( 'woocommerce_dimension_unit' ).'</span></div>';
                        }
                        if ( $data_length ) {
                            echo '<div><strong>'.esc_html__( 'Length', 'deep' ) .':</strong> ' . $data_length . '<span>' .get_option( 'woocommerce_dimension_unit' ).'</span></div>';
                        }
                        if ( $data_weight ) {
                            echo '<div><strong>'.esc_html__( 'Weight', 'deep' ) .':</strong> ' . $data_weight . '<span>' .get_option( 'woocommerce_weight_unit' ).'</span></div>';
                        }
                        echo '</div>';
                    }
                    ?>
                    <div class="type-list-readmore">
                        <?php woocommerce_template_loop_add_to_cart(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="wn-woo-skin wn-woo-products-grid <?php echo '' . $layout_grid_enable; ?>">
            <div class="wn-woo-thumbnail-wrap">

                <div class="wn-woo-thumbnail">
                    <?php
                    woocommerce_template_loop_product_link_open();
                    woocommerce_template_loop_product_thumbnail();
                    woocommerce_template_loop_product_link_close();
                    ?>
                </div>

                <div class="wn-woo-thumbnail-hover">
                    <?php
                    $deep_options['deep_woo_hover_enable']  = isset( $deep_options['deep_woo_hover_enable'] ) ? $deep_options['deep_woo_hover_enable'] : '1';

                    if ( $deep_options['deep_woo_hover_enable'] == '1' ) :
                        woocommerce_template_loop_product_link_open();
                        $size = wc_get_image_size( 'shop_catalog' );
                        $placeholder_width = $size['width'];
                        $placeholder_height = $size['height'];
                        deep_woo_template_loop_second_product_thumbnail($placeholder_width,$placeholder_height);
                        woocommerce_template_loop_product_link_close();
                    endif;


                    if ( $deep_options['deep_woo_hover_enable'] == '1' ) :

                        if ( is_plugin_active( 'yith-woocommerce-quick-view/init.php' ) ) : ?>
                            <div class="wn-woo-btn wn-quick-view-btn wn-woo-hover" data-wntooltip="<?php esc_html_e( 'Quick View', 'deep' ); ?>">
                                <?php
                                if ( class_exists( 'YITH_WCQV_Frontend' ) ) {
                                    YITH_WCQV_Frontend::get_instance()->yith_add_quick_view_button();
                                }
                                ?>
                                <i class="sl-magnifier-add"></i>
                            </div>
                        <?php endif; ?>

                        <?php if ( is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) ) :
                            $product_id = get_the_ID();
                            $is_in_wishlist = ( YITH_WCWL()->is_product_in_wishlist( $product_id ) ) ? 'wn-added-wishlist' : 'no';
                            $added_wishlist = ( YITH_WCWL()->is_product_in_wishlist( $product_id ) )  ? esc_html__( 'Appended', 'deep' ) :  esc_html__( 'Add to Wishlist', 'deep' ) ;
                            ?>
                            <div class="wn-woo-btn wn-wishlist-btn wn-woo-hover <?php  echo '' . $is_in_wishlist ?>" data-wntooltip="<?php  echo '' . $added_wishlist ?>" data-id="<?php echo get_the_ID(); ?>">
                                <i class="sl-heart"></i>
                            </div>
                        <?php endif; ?>

                        <?php if ( function_exists( 'yith_woocompare_constructor' ) && is_plugin_active( 'yith-woocommerce-compare/init.php' ) ) { ?>
                            <div class="wn-woo-btn wn-woo-compare-btn wn-woo-hover" data-wntooltip="<?php esc_html_e( 'Compare', 'deep' ); ?>">
                                <?php echo do_shortcode( '[yith_compare_button]' ); ?>
                                <i class="sl-shuffle"></i>
                            </div>
                        <?php } ?>

                        <div class="wn-woo-btn wn-woo-add-to-cart-btn wn-woo-hover">
                            <?php if( function_exists('woocommerce_template_loop_add_to_cart') ) : ?>
                                <i class="sl-basket"></i>
                                <?php woocommerce_template_loop_add_to_cart(); ?>
                            <?php endif; ?>
                        </div>

                    <?php
                    endif;
                    ?>
                </div>

            </div>

            <div class="wn-woo-contents-wrap">
                <?php
                echo wc_get_product_category_list( $product_id );
                echo '<h3 class="wn-woo-title"><a class="wn-product-info-id" href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
                woocommerce_template_loop_price();
                deep_woo_display_discount();
                ?>
                <div class="wn-woo-list-colors">
                    <?php deep_woo_display_colors(); ?>
                </div>
            </div>
        </div>
        <?php
    }
}

/*
 * ---> End Products
 */

if ( is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) ) {
    /**
     * Register wishlist ajax
     *
     * @since   1.0.0
     * @return  wishlist items
     */
    // register wishlist ajax
    add_action( 'wp_ajax_remove_wishlist_deep', 'deep_remove_from_wishlist_ajax' );
    add_action( 'wp_ajax_nopriv_remove_wishlist_deep', 'deep_remove_from_wishlist_ajax' );
    function deep_remove_from_wishlist_ajax () {

        global $wpdb;

        $proid = sanitize_text_field( $_POST['proid'] );
        $prod_id = isset( $proid )  ? $proid : false;
        $user_id = get_current_user_id() ? get_current_user_id() : false;

        if ( is_user_logged_in() ) {
            $sql = "DELETE FROM {$wpdb->yith_wcwl_items} WHERE user_id = %d AND prod_id = %d";
            $sql_args = array(
                $user_id,
                $prod_id
            );

            $result = $wpdb->query( $wpdb->prepare( $sql, $sql_args ) );
        } else {
            $wishlist = yith_getcookie( 'yith_wcwl_products' );

            foreach( $wishlist as $key => $item ){
                if( $item['wishlist_id'] == $wishlist_id && $item['prod_id'] == $prod_id ){
                    unset( $wishlist[ $key ] );
                }
            }

            yith_setcookie( 'yith_wcwl_products', $wishlist );

            return true;
        }
    }
}




/*
 * ---> End Advanced Woo Features
 */

/**
     * ---> Special offer Backend
     *
     * @see  deep_woo_add_metabox_tab()
     * @see  deep_woo_add_metabox_tab_fields()
     * @see  deep_woo_save_metabox()
     */

    // Add tab
    add_filter( 'woocommerce_product_data_tabs',    'deep_woo_add_metabox_tab' , 10 , 1 );

    // Add option to tab
    add_action( 'woocommerce_product_data_panels',  'deep_woo_add_metabox_tab_fields' );

    // Save options
    add_action( 'woocommerce_process_product_meta', 'deep_woo_save_metabox' );

    if ( ! function_exists( 'deep_woo_add_metabox_tab' ) ) {
        /**
         * Add custom metabox tab to woo metaboxes
         *
         * @since   1.0.0
         * @return  String array $product_data_tabs
         */
        function deep_woo_add_metabox_tab( $product_data_tabs ) {
            // Add offer tab to woo admin
            $product_data_tabs['deep-offer_time-tab'] = array(
                'label' => esc_html__( 'Deep Options', 'deep' ),
                'target' => 'deep_count_down_offer_time',
            );
            return $product_data_tabs;
        }
    }

    if ( ! function_exists( 'deep_woo_add_metabox_tab_fields' ) ) {
        /**
         * Add custom metabox tab fields to woo metaboxes
         *
         * @since   1.0.0
         * @return  String array
         */

        function deep_woo_add_metabox_tab_fields() {
            global $woocommerce, $post; ?>

            <div id="deep_count_down_offer_time" class="panel woocommerce_options_panel">
                <div class="options_group">
                <?php
                woocommerce_wp_text_input( array(
                    'id'            => '_deep_offer_finish_text',
                    'label'         => esc_html__( 'Please Enter Finish Text', 'deep' ),
                    'description'   => esc_html__( 'For example : Offering time is over', 'deep' ),
                    'default'       => '0',
                    'value'         => get_post_meta( $post->ID, '_deep_offer_finish_text', true ),
                    'desc_tip'      => false,
                ) );
                ?>
                </div>
                <div class="options_group">
                    <?php
                    woocommerce_wp_text_input( array(
                        'id'            => '_deep_featured_video',
                        'label'         => esc_html__( 'Featured Video', 'deep' ),
                        'description'   => esc_html__( 'Please put Youtube Video', 'deep' ),
                        'default'       => '0',
                        'value'         => get_post_meta( $post->ID, '_deep_featured_video', true ),
                        'desc_tip'      => false,
                    ) );
                    ?>
                </div>
                <div class="options_group">
                    <?php
                    woocommerce_wp_textarea_input( array(
                        'id'            => '_deep_featured_text',
                        'label'         => esc_html__( 'Featured Text', 'deep' ),
                        'description'   => esc_html__( 'Please put your content', 'deep' ),
                        'default'       => '0',
                        'value'         => get_post_meta( $post->ID, '_deep_featured_text', true ),
                        'desc_tip'      => false,
                    ) );
                    ?>
                </div>
            </div>
            <?php
        }
    }

    if ( ! function_exists( 'deep_woo_save_metabox' ) ) {
        /**
         *
         * @since   1.0.0
         * @return  _deep_offer
         */
        function deep_woo_save_metabox( $post_id ) {

            $finish_text = sanitize_text_field( $_POST['_deep_offer_finish_text'] );
            $deep_so_offer_finish_text = isset( $finish_text ) ? $finish_text : '';
            update_post_meta( $post_id, '_deep_offer_finish_text', $deep_so_offer_finish_text );

            $featured_video = sanitize_text_field( $_POST['_deep_featured_video'] );
            $deep_featured_video = isset( $featured_video ) ? $featured_video : '';
            update_post_meta( $post_id, '_deep_featured_video', $deep_featured_video );

            $featured_text = sanitize_text_field( $_POST['_deep_featured_text'] );
            $deep_featured_text = isset( $featured_text ) ? $featured_text : '';
            update_post_meta( $post_id, '_deep_featured_text', $deep_featured_text );
        }
    }

/**
 * ---> Woocommerce cart
 *
 */

if ( ! function_exists('deep_woo_cart_empty_before') ) {
    function deep_woo_cart_empty_before() {
        if ( WC()->cart->cart_contents_count == 0 && is_cart() ) {
            echo '<div class="wn-cart-empty wn-layer-anim-bottom">';
        }
    }
}
if ( ! function_exists('deep_woo_cart_empty_content') ) {
    function deep_woo_cart_empty_content() {
        if ( WC()->cart->cart_contents_count == 0 && is_cart() ) {
            echo '
                    <hr class="vertical-space5">
                    <hr class="vertical-space2">
                    <i class="pe-7s-cart"></i>';
            echo '
            <div class="wn-deep-title-wrap wn-layer-anim-bottom wn-done-anim">
                <div class="wn-deep-title">
                    <span class="wn-deep-title-shape after shape-coutn-0"></span>
                    <span class="wn-deep-title-shape after colorb shape-coutn-1"></span>
                    <h2 class="wn-deep-innertitle">'. esc_html__('Our Products','deep') .'</h2>
                </div>
            </div>';
            echo '<p>' . esc_html__( 'You have to add some items to your shopping cart before launching the checkout. you will detect several amazing products on our "Shop" page.', 'deep' ) . '</p>';
            echo '<hr class="vertical-space5">';
        }
    }
}
if ( ! function_exists('deep_woo_cart_empty_after') ) {
    function deep_woo_cart_empty_after() {
        if ( WC()->cart->cart_contents_count == 0 && is_cart() ) {
            echo '</div>'; // end .wn-cart-empty
            echo '<hr class="vertical-space5"> <hr class="vertical-space2">';
        }
    }
}

if ( ! function_exists('deep_woo_return_to_shop_page') ) {
    function deep_woo_return_to_shop_page() {
        echo '
            <div class="container">
            <div class="row deep-woo-single-product-nav">
                <div class="col-md-3">';
        if ( wc_get_page_id( 'shop' ) ) {
            echo '<a class="deep-woo-backward wn-data-tooltip" href="'. get_permalink( wc_get_page_id( 'shop' ) ).'" data-name="'. esc_attr__( 'Back To Shop', 'deep' ) .'"><i class="pe-7s-back hcolorb hcolorr colorf"></i></a>';
        }
        echo '
                </div>';
    }
}

// Woo breadcrumb
if ( ! function_exists('deep_woo_breadcrumb') ) {
    function deep_woo_breadcrumb() {
        $args = array(
            'delimiter' => ' <i class="wn-fa wn-fa-angle-right colorf"></i> ',
        );
        echo '<div class="col-md-6 aligncenter">';
        echo '<div class="deep-woo-breadcrumbs">';
        woocommerce_breadcrumb( $args );
        echo '</div>';
        echo '</div>';
    }
}

// Next and prev single product
if ( ! function_exists('dee_woo_nextprev_product') ) {
    function dee_woo_nextprev_product(){
        $next_p = !empty( get_adjacent_post(false,'',false, 'product_cat')->ID ) ? wc_get_product( get_adjacent_post(false,'',false, 'product_cat')->ID ) : '';
        if ( !empty( $next_p ) ) {
            $next_post_id = get_adjacent_post(false,'',false, 'product_cat')->ID;
            $next_post_link = get_permalink( $next_post_id );
            $next_post_title = get_the_title ( $next_post_id );
            $next_post_thumbnail_url = wp_get_attachment_url( get_post_thumbnail_id( $next_post_id ) );
            $next_post_price = wc_get_product( $next_post_id ) -> get_price_html();
        }
        $previous_p = !empty(get_adjacent_post(false,'',true, 'product_cat')->ID ) ? wc_get_product( get_adjacent_post(false,'',true, 'product_cat')->ID ) : '';
        if ( !empty( $previous_p ) ){
            $prev_post_id = get_adjacent_post(false,'',true, 'product_cat')->ID;
            $prev_post_link = get_permalink( $prev_post_id );
            $prev_post_title = get_the_title ( $prev_post_id );
            $prev_post_thumbnail_url = wp_get_attachment_url( get_post_thumbnail_id( $prev_post_id ) );
            $prev_post_price = wc_get_product( $prev_post_id ) -> get_price_html();
        }

        if( !empty( $next_post_thumbnail_url ) ) {
            // if main class not exist get it
            if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
            }
            $image = new Wn_Img_Maniuplate; // instance from settor class
            $next_post_thumbnail_url = $image->m_image( get_post_thumbnail_id( $next_post_id ) , $next_post_thumbnail_url , '65' , '65' ); // set required and get result
        }

        if( !empty( $prev_post_thumbnail_url ) ) {
            // if main class not exist get it
            if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
            }
            $image = new Wn_Img_Maniuplate; // instance from settor class
            $prev_post_thumbnail_url = $image->m_image( get_post_thumbnail_id( $prev_post_id ) , $prev_post_thumbnail_url , '65' , '65' ); // set required and get result
        }

        if ( isset( $prev_post_id ) || isset( $next_post_id ) ) {
            echo '<div class="col-md-3 alignright">
                     <div class="deep-woo-prev-next-buttons">';
        }
        if ( isset( $prev_post_id ) ) {
            echo '<div class="deep-woo-next-prev-product-botton wn-prev-product">
                    <a href="'. $prev_post_link .'" class="wn-data-tooltip" data-name="'. esc_attr__( 'Previous Product', 'deep' ) .'"><i class="ti-angle-left colorf hcolorb hcolorr"></i></a>
                    <div class="deep-woo-prev-product-post w-hide">
                        <div class="deep-woo-product-post-arrow-main"><span class="deep-woo-product-post-arrow"></span></div>
                        <div class="deep-woo-prev-product-detail">
                            <div class="deep-woo-prev-product-detail-title">'. $prev_post_title .'</div>
                            <div class="deep-woo-prev-product-detail-price">'. $prev_post_price .'</div>
                        </div>
                        <div class="deep-woo-next-prev-product-img"><img src="'. $prev_post_thumbnail_url .'" alt="'. $prev_post_title .'"></div>
                    </div>
                </div>';
        }
        if ( isset( $next_post_id ) ) {
            echo '<div class="deep-woo-next-prev-product-botton wn-next-product">
                    <a href="'. $next_post_link .'" class="wn-data-tooltip" data-name="'. esc_attr__( 'Next Product', 'deep' ) .'"><i class="ti-angle-right colorf hcolorb hcolorr"></i></a>
                    <div class="deep-woo-next-product-post w-hide">
                        <div class="deep-woo-product-post-arrow-main"><span class="deep-woo-product-post-arrow"></span></div>
                        <div class="deep-woo-next-product-detail">
                            <div class="deep-woo-next-product-detail-title">'. $next_post_title .'</div>
                            <div class="deep-woo-next-product-detail-price">'. $next_post_price .'</div>
                        </div>
                        <div class="deep-woo-next-next-product-img"><img src="'. $next_post_thumbnail_url .'" alt="'. $next_post_title .'"></div>
                    </div>
                </div>';
        }
        if ( isset( $prev_post_id ) || isset( $next_post_id ) ) {
            echo '</div>
            </div>';
        }

        echo '</div>'; // row
        echo '</div>'; // container

    }
}

// Checkout

if ( ! function_exists( 'deep_woo_checkout_before_customer_details' ) ) :
    function deep_woo_checkout_before_customer_details() {
        // After checkout from
        if ( is_checkout() )
            echo '<div class="col-md-8">';
    }
endif;

if ( ! function_exists( 'deep_woo_checkout_after_customer_details' ) ) :
    function deep_woo_checkout_after_customer_details() {
        // Before checkout from
        if ( is_checkout() )
            echo '</div>'; // end .col-md-8
        echo '<div class="col-md-4">';
    }
endif;

if ( ! function_exists( 'deep_woo_checkout_after_order_review' ) ) :
    function deep_woo_checkout_after_order_review() {
        // Before checkout from
        if ( is_checkout() )
            echo '</div>'; // end .col-md-4
    }
endif;

if ( ! function_exists( 'deep_woo_checkout_shipping' ) ) :
    function deep_woo_checkout_shipping() {
        // Before checkout from
        $deep_options = deep_options();
        if ( is_checkout() && $deep_options['deep_woo_sdtitle_enable'] == '1' )
            echo '<h3 class="wn-shipping-details">' . esc_html__( 'SHIPPING DETAILS', 'deep' ) . '</h3>';
    }
endif;

// Compare
function deep_woo_yith_woocompare_popup_head() {
    echo '<link rel="stylesheet" href="' . DEEP_URL . 'inc/core/woocommerce/assets/woocommerce.css"/>';
    echo '<link rel="stylesheet" href="' . DEEP_ASSETS_URL . 'css/frontend/icons/simple-line-icons.css"/>';
    echo '<link rel="stylesheet" href="' . deep_google_fonts_url() . '">';
}

function wn_ordering_woocommerce() {
    $orderby  = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
    $show_default_orderby  = 'menu_order' === apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
    $catalog_orderby_options = apply_filters( 'woocommerce_catalog_orderby', array(
        'menu_order' => __( 'Default sorting', 'deep' ),
        'popularity' => __( 'Sort by popularity', 'deep' ),
        'rating'     => __( 'Sort by average rating', 'deep' ),
        'date'       => __( 'Sort by newness', 'deep' ),
        'price'      => __( 'Sort by price: low to high', 'deep' ),
        'price-desc' => __( 'Sort by price: high to low', 'deep' ),
    ) );
    ?>
    <form class="woocommerce-ordering" method="get">
        <select name="orderby" class="orderby">
            <?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
                <option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
            <?php endforeach; ?>
        </select>
        <?php wc_query_string_form_fields( null, array( 'orderby', 'submit' ) ); ?>
    </form>
    <?php
}

if ( ! function_exists('deep_woo_start_single_content') ) {
    function deep_woo_start_single_content() {
        echo '
            <div class="container">
                <div class="row deep-woo-single-gallery">
            ';
    }
}
if ( ! function_exists('deep_woo_single_gallery_images') ) {
    function deep_woo_single_gallery_images() {
        wp_enqueue_script( 'deep-slick' );
        wp_enqueue_style( 'deep-slick' );

        global $product;
        $attachment_ids = $product->get_gallery_image_ids();
        if ( !empty ( $attachment_ids ) ){
            remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
            echo '<div class="col-md-2"><div class="deep-woo-product-thumbs">';
            foreach( $attachment_ids as $attachment_id ) {
                $thumbnail_url = wp_get_attachment_url( $attachment_id );
                if( !empty( $thumbnail_url ) ) {
                    // if main class not exist get it
                    if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                        require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
                    }
                    $image = new Wn_Img_Maniuplate; // instance from settor class
                    $thumbnail_url = $image->m_image( $attachment_id , $thumbnail_url , '130' , '130' ); // set required and get result
                }
                echo '
                        <img class="thumb" src="' . $thumbnail_url . '">
                    ';
            }
            echo '</div></div>';
            echo '<div class="col-md-4"><div class="deep-woo-product-main-thumbs-content">';
            echo '<button type="button" data-role="none" class="slick-prev slick-arrow colorf square" aria-label="Previous" role="button" style="display: block;"><span>'. esc_html__('Previous','deep') .'</span></button>';
            if ( get_post_meta( get_the_ID(), '_deep_featured_video', true ) ) {
                wp_enqueue_style( 'deep-magnific-popup', DEEP_ASSETS_URL . 'css/frontend/plugins/magnific-popup.css', false, DEEP_VERSION );
                wp_enqueue_script( 'deep-magnific-popup', DEEP_ASSETS_URL . 'js/frontend/plugins/magnific-popup.js', array( 'jquery' ), DEEP_VERSION, true);
                echo '
                <div class="deep-woo-product-video-button">
                    <a class="wn-popup-youtube" href="'.get_post_meta( get_the_ID(), '_deep_featured_video', true ).'"><i class="sl-control-play hcolorf"></i></a>
                </div>';
            }
            echo '
                <div class="deep-woo-product-main-thumbs">';
            $size = wc_get_image_size( 'shop_single' );
            if ( empty($size['width']) ) {
                $size['width'] = '660';
                $size['height'] = '785';
            } else {
                $size['height'] = $size['width'];
            }
            foreach( $attachment_ids as $attachment_id ) {
                $thumbnail_url_big = wp_get_attachment_url( $attachment_id );
                if( !empty( $thumbnail_url_big ) ) {
                    // if main class not exist get it
                    if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                        require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
                    }
                    $image = new Wn_Img_Maniuplate; // instance from settor class
                    $thumbnail_url_big = $image->m_image( $attachment_id , $thumbnail_url_big , $size['width'] , $size['height'] ); // set required and get result
                }
                echo '
                        <div>
                            <img class="thumb" src="' . $thumbnail_url_big . '">
                            <a href="' . $thumbnail_url_big . '" class="deep-woo-single-image-zoom"><i class="icon-arrows-expand hcolorf"></i></a>
                        </div>
                    ';
            }
            echo '
                    </div>
                </div> <button type="button" data-role="none" class="slick-next slick-arrow colorf square" aria-label="Next" role="button" style="display: block;"><span>'. esc_html__('Previous','deep') .'</span></button></div>';
        }
    }
}

/**
* Display price variation
*
* @author Webnus
* @since   4.0.2
*/
function display_price_in_variation( $term ) {
    if ( is_product() ){
        $product = wc_get_product();
        if ( empty( $term ) ) {
                return $term;
            }
            if ( $product->is_type( 'variable' ) && $product instanceof WC_Product ) {
                $product_variations = $product->get_available_variations();
            } else {
            return $term;
        }

        foreach($product_variations as $variation){
                if(count($variation['attributes']) > 1){
                    return $term;
                }
                foreach($variation['attributes'] as $key => $slug){
                    if("attribute_" == mb_substr( $key, 0, 10 )){
                        if($slug == $term){
                            $term .= " (" . wp_kses( wc_price($variation['display_price']), array()) . ")";
                        }
                    }
                }
            }
        return $term;
    }
}

add_action( 'woocommerce_before_single_product_summary', 'deep_single_add_to_cart' );
function deep_single_add_to_cart(){
    global $product;

    if ( $product->get_sold_individually() == false && !is_plugin_active( 'woocommerce-product-addons/woocommerce-product-addons.php' ) ) {
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    }
}

if ( ! function_exists('deep_woo_single_details') ) {
    function deep_woo_single_details() {
        global $product;
        $post_price = wc_get_product( get_the_ID() ) -> get_price_html();
        $availability = ( $product->is_in_stock() ) ? esc_html__('In Stock', 'deep') : esc_html__('Out of Stock', 'deep');
        $sku = ( $product->get_sku() ) ? $product->get_sku() : '' ;
        $sku_html = ( $sku ) ? '<span>'.esc_html__('Product Code:', 'deep') .'</span> <span class="deep-woo-single-detail-sku-number">'. esc_html__( '#' , 'deep' ) . $sku .'</span>' : '' ;
        echo '
            <div class="col-md-6">
                <div class="deep-woo-single-detail">
                    <h3 class="deep-woo-single-product-title">'.get_the_title().'</h3>';
                    if ( !is_plugin_active( 'woocommerce-email-inquiry-cart-options/woocommerce-email-inquiry-cart-options.php' ) ) {
                    echo '<div class="deep-woo-single-product-price"><span>'.$post_price.'</span></div>';
                    }
                    if ( $product->get_stock_status() !== 'onbackorder' ) {
                        echo '<div class="deep-woo-single-product-available"><span>'.esc_html__('Availability:','deep').'</span> <span class="colorf">'.$availability.'</span></div>';
                    }
        if ( $sku ) {
            echo '<div class="deep-woo-single-product-sku"><span>'.$sku_html.'</span></div>';
        }
        if ( has_excerpt( get_the_ID() ) ) {
            echo '<div class="deep-woo-single-product-content">';
            the_excerpt();
            echo '</div>';
        }
        echo '
                    <div class="deep-woo-single-product-attr">';
        // Get product attributes
        if ( !$product->is_type( 'variable' ) ) :
            $attributes = $product->get_attributes();
            foreach ( $attributes as $attribute ) {
                if ( $attribute['is_taxonomy'] ) {
                    $values = wc_get_product_terms( get_the_ID(), $attribute['name'], array( 'fields' => 'names' ) );
                    $product_attributes = array();
                    $product_attributes = explode(',',wpautop( wptexturize( implode( ', ', $values ) ) ));
                    $attribute_name     = str_replace('pa_','',$attribute['name']);
                    $attributes_dropdown = '<select>';
                    $attributes_dropdown .= '<option value="Select an option">'. __('Select ', 'deep') . $attribute_name.'</option>';
                    foreach ( $product_attributes as $product_attribute ) {
                        $attributes_dropdown .= '<option value="' . $product_attribute . '">' . $product_attribute . '</option>';
                    }

                    $attributes_dropdown .= '</select>';
                    echo '' . $attributes_dropdown;

                } else {
                    // Convert pipes to commas and display values
                    $values = array_map( 'trim', explode( WC_DELIMITER, $attribute['value'] ) );
                    echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );
                }
            }
        endif;


        if ( $product->is_type( 'variable' ) ) :
            $get_variations = count( $product->get_children() ) <= apply_filters( 'woocommerce_ajax_variation_threshold', 30, $product );
            $available_variations = $get_variations ? $product->get_available_variations() : false;
            $attributes  = $product->get_variation_attributes();
            $selected_attributes  = $product->get_default_attributes();
            if ( empty( $available_variations ) && false !== $available_variations ) { ?>
                <p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p> <?php
            } else { ?>
                <form class="variations_form cart" action="<?php echo esc_url( get_permalink() ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo htmlspecialchars( wp_json_encode( $available_variations ) ) ?>">
                    <?php do_action( 'woocommerce_before_variations_form' ); ?>

                    <?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
                        <p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
                    <?php else : ?>
                        <table class="wn-woo-variables variations" cellspacing="0">
                            <tbody>
                                 <tr>
                                <?php foreach ( $attributes as $attribute_name => $options ) : ?>
                                    <td class="value">
                                        <?php
                                            $selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( stripslashes( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) ) : $product->get_variation_default_attribute( $attribute_name );
                                            wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
                                        ?>
                                    </td>
                                <?php endforeach;?>
                                 </tr>
                            </tbody>
                        </table>
                        <div class="deep-woo-single-product-addtocart">
                            <?php
                            $pr_quantity = sanitize_text_field( $_POST['quantity'] );
                                woocommerce_quantity_input( array(
                                    'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
                                    'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
                                    'input_value' => isset( $pr_quantity ) ? wc_stock_amount( $pr_quantity ) : $product->get_min_purchase_quantity(),
                                ) );
                            ?>
                            <button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
                            <input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
                            <input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
                            <input type="hidden" name="variation_id" class="variation_id" value="0" />
                        </div>
                    <?php endif; ?>
                </form>
        <?php
            }
        endif;

        if ( $product->is_type( 'grouped' ) ) :
            global $product, $post;
            $parent_product_post = $post;
            $grouped_products = array();
            $child_ids        = $product->get_children( 'edit' );
            foreach ( $child_ids as $child_id ) {
                $child = wc_get_product( $child_id );
                if ( ! $child ) {
                    continue;
                }

                $grouped_products[] =  $child_id;
            }
            ?>
            <div class="wn-grouped-products">
                <form class="cart" method="post" enctype='multipart/form-data'>
                    <?php
                        foreach ( $grouped_products as $product_id ) :
                            $post    = get_post( $product->get_id() );
                            setup_postdata( $post );
                            ?>
                            <div class="wn-single-product-grouped">
                                <?php
                                $quantites_required = true;
                                $qua_pro_id = sanitize_text_field( $_POST['quantity'][$product_id] );
                                echo '<div class="deep-woo-single-product-addtocart">';
                                woocommerce_quantity_input( array(
                                        'input_name'  => 'quantity[' . $product_id . ']',
                                        'input_value' => ( isset( $qua_pro_id ) ? wc_stock_amount( $qua_pro_id ) : 0 ),
                                        'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 0, $product ),
                                        'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
                                ) );
                                echo '</div>';
                                ?>
                                <label for="product-<?php echo $product_id; ?>">
                                    <?php echo $product->is_visible() ?  '<a href="' . esc_url( apply_filters( 'woocommerce_grouped_product_list_link', get_permalink($product_id), $product_id ) ) . '">' . get_the_title($product_id) . '</a>' : get_the_title($product_id); ?>
                                </label>
                                <?php do_action ( 'woocommerce_grouped_product_list_before_price', $product );
                                echo $product->get_price_html();
                                if ( $availability = $product->get_availability() ) {
                                    $availability_html = '';
                                    echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
                                }
                                echo '</div>';
                            endforeach;
                            $post    = $parent_product_post;
                            $product = wc_get_product( $parent_product_post->ID );
                            setup_postdata( $parent_product_post );
                        ?>

                        <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />
                        <?php
                        $quantites_required = true;
                        if ( $quantites_required ) : ?>
                            <div class="deep-woo-single-product-addtocart">
                                <button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
                            </div>
                        <?php endif; ?>
                </form>
            </div>
            <?php
        endif;

        if ( $product->is_type( 'external' ) ) :
        ?>
            <form class="cart" action="<?php echo esc_url( $product->get_product_url() ); ?>" method="get">
                <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
                <div class="deep-woo-single-product-addtocart">
                    <button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->get_button_text() ); ?></button>
                </div>
                <?php wc_query_string_form_fields( $product->get_product_url() ); ?>
                <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
            </form>
        <?php
        endif;

        echo '
                    </div>
                    ';
        echo '<div class="deep-woo-single-product-rating">';
        deep_product_star_rating();
        echo '</div>';
        if ( get_the_term_list( get_the_ID(), 'product_tag', '', ', ', '' ) ) {
            echo '<div class="deep-woo-single-product-tags">';
            echo '<span>'.esc_html__('Tags:','deep') . '</span> ' . get_the_term_list( get_the_ID(), 'product_tag', '', ', ', '' );
            echo '</div>';
        }
        if ( wc_get_product_category_list( get_the_ID(), ' > ', '' ,  '' ) ) {
            echo '<div class="deep-woo-single-product-cat">';
            echo '<span>'.esc_html__('Categories:','deep') . '</span> ' . wc_get_product_category_list( get_the_ID(), ' > ', '' ,  '' );
            echo '</div>';
        }
        echo '
                <div class="deep-woo-single-product-addtocart">
            ';




        if ( is_plugin_active( 'woocommerce-email-inquiry-cart-options/woocommerce-email-inquiry-cart-options.php' ) ) {
            $Catalog = new WC_Email_Inquiry_Hook_Filter();
            echo  $Catalog::add_email_inquiry_button( get_the_ID() );
        } elseif ( $product && $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() && ! $product->is_sold_individually() ) {
            echo '
                <form class="cart" method="post" enctype="multipart/form-data">';
            echo '<span>'.esc_html__( 'Qty' , 'deep' ).'</span>';
            echo woocommerce_quantity_input( array(), $product, false );
            echo '<button type="submit" name="add-to-cart" value="'.get_the_ID().'" class="single_add_to_cart_button button alt">' . esc_html( $product->add_to_cart_text() ) . '</button>';
            echo '
                </form>';
        }

        if ( get_option('yith_woocompare_compare_button_in_product_page') == 'yes' && is_plugin_active( 'yith-woocommerce-compare/init.php' ) ) {
            echo '<div class="deep-woo-single-details-content deep-woo-single-compare-button wn-data-tooltip" data-name="'.esc_html__( 'Compare' , 'deep' ).'">
                    '.do_shortcode( '[yith_compare_button]' ).'
                </div>';
        }

        if ( is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) ) {
            global $wpdb,$product,$product_id;
            // get item added to wishlist
            $wishexistindb = $wpdb->get_results( "SELECT prod_id FROM {$wpdb->yith_wcwl_items}" );
            // convert stdclass object to php array
            $value         = json_decode( json_encode( $wishexistindb ), true );
            // now check value
            $wishitemdb    = isset( $value[0]['prod_id'] ) ? $value[0]['prod_id'] : '';
            $product_id = get_the_ID();
            $is_in_wishlist = ( YITH_WCWL()->is_product_in_wishlist( $product_id ) ) ? 'wn-added-wishlist' : 'no';
            $added_wishlist = ( YITH_WCWL()->is_product_in_wishlist( $product_id ) )  ? esc_html__( 'Appended', 'deep' ) :  esc_html__( 'Add to Wishlist', 'deep' ) ;
            echo '
                <div class="deep-woo-single-details-content deep-woo-single-wishlist-button wn-data-tooltip" data-name="'.$added_wishlist.'">
                    <div class="wn-woo-btn wn-wishlist-btn '.$is_in_wishlist.'"  data-id="'.get_the_ID().'"></div>
                </div>';
        }

        $deep_options = deep_options();
        if ( $deep_options['deep_woo_product_social_share'] ) {
            $product_id = get_the_ID();
            echo '
            <div class="deep-woo-single-details-content deep-woo-single-share-button wn-data-tooltip" data-name="'.esc_html__( 'Share' , 'deep' ).'"><i class="sl-share share hcolorf"></i><div class="social-sharing">';
            echo '<a href="http://www.facebook.com/sharer.php?u='.get_permalink( $product_id ).'" class="wn-fab wn-fa-facebook"></a>
                <a href="https://twitter.com/share?url='.get_permalink( $product_id ).'" class="wn-fab wn-fa-twitter"></a>
                <a href="mailto:?'.get_permalink( $product_id ).'" class="wn-icon wn-fas wn-fa-envelope"></a>';
            echo '</div></div>';
        }

        echo '</div>'; // close deep-woo-single-product-addtocart
        echo '
                </div>
            </div>
            ';

    }
}

if ( ! function_exists('deep_woo_end_single_content') ) {
    function deep_woo_end_single_content() {
        echo '
                </div>
            </div>
            ';
    }
}

if ( ! function_exists('deep_woo_review_avatar_size') ) {
    function deep_woo_review_avatar_size( $size ) {
        return 90;
    }
}

if ( ! function_exists('deep_woo_single_upsell_product') ) {
    function deep_woo_single_upsell_product() {
        $deep_options   = deep_options();
        $data = new WC_Product( get_the_ID());
        if ( $deep_options['deep_woo_upsell_enable'] == '1' &&  $data->get_upsell_ids() ) {
            echo '

                <hr class="related-post-hr">
                <section class="container">
                    <h3 class="deep-related-products-title">'. esc_html__('Upsell Products','deep') .'</h3>
                    <h5 class="deep-related-products-subtitle">'. esc_html__('You may also like','deep') .'</h5>
                    ';
            woocommerce_upsell_display();
            echo '
                </section>
                ';
        }
    }
}

if ( ! function_exists('deep_woo_single_related_product') ) {
    function deep_woo_single_related_product() {
        $deep_options   = deep_options();
        if ( $deep_options['deep_woo_related_enable'] == '1' ) {
            echo '
                <hr class="related-post-hr">
                <section class="container">
                    <h3 class="deep-related-products-title">'. esc_html__('Related Products','deep') .'</h3>
                    <h5 class="deep-related-products-subtitle">'. esc_html__('Choose The Best Product','deep') .'</h5>';
            do_action('deep_woo_single_related_product_action' );
            echo '
                </section>';
        }
    }
}

if ( ! function_exists('deep_woo_login_and_register') ) {
    function deep_woo_login_and_register() {
        echo '
            <div id="customer_login" class="wn-woo-login">
                <div class="or-section">
                    <span>' . esc_html__( 'or', 'deep' ) . '</span>
                </div>
                <a href="#" class="button colorf bordered-bot square btn-login"><span>' . esc_html__( 'SIGN IN', 'deep' ) . '</span></a>
                <a href="#" class="button colorf bordered-bot square btn-register"><span>' . esc_html__( 'REGISTER', 'deep' ) . '</span></a>
            </div>';
    }
}

if ( $deep_options['deep_woo_disable_checkout_form'] == '0' ) {
    add_filter('woocommerce_checkout_fields','deep_woo_reorder_checkout_fields');
    function deep_woo_reorder_checkout_fields( $fields ) {
        $fields2['billing']['billing_first_name'] = $fields['billing']['billing_first_name'];
        $fields2['billing']['billing_last_name'] = $fields['billing']['billing_last_name'];
        $fields2['billing']['billing_email'] = $fields['billing']['billing_email'];
        $fields2['billing']['billing_phone'] = $fields['billing']['billing_phone'];
        $fields2['billing']['billing_country'] = $fields['billing']['billing_country'];
        $fields2['billing']['billing_address_1'] = $fields['billing']['billing_address_1'];
        $fields2['billing']['billing_address_2'] = $fields['billing']['billing_address_2'];
        $fields2['billing']['billing_city'] = $fields['billing']['billing_city'];
        $fields2['billing']['billing_state'] = $fields['billing']['billing_state'];
        $fields2['billing']['billing_postcode'] = $fields['billing']['billing_postcode'];

        $fields2['shipping']['shipping_first_name'] = $fields['shipping']['shipping_first_name'];
        $fields2['shipping']['shipping_last_name'] = $fields['shipping']['shipping_last_name'];
        $fields2['shipping']['shipping_country'] = $fields['shipping']['shipping_country'];
        $fields2['shipping']['shipping_address_1'] = $fields['shipping']['shipping_address_1'];
        $fields2['shipping']['shipping_address_2'] = $fields['shipping']['shipping_address_2'];
        $fields2['shipping']['shipping_city'] = $fields['shipping']['shipping_city'];
        $fields2['shipping']['shipping_state'] = $fields['shipping']['shipping_state'];
        $fields2['shipping']['shipping_postcode'] = $fields['shipping']['shipping_postcode'];


        // Add full width Classes and Clears to Adjustments
        $fields2['billing']['billing_email'] = array(
            'label'     => __('Email', 'deep'),
            'required'  => true,
            'class'     => array('form-row-first'),
            'clear'     => true,
        );
        $fields2['billing']['billing_phone'] = array(
            'label'     => __('Phone', 'deep'),
            'required'  => true,
            'class'     => array('form-row-last'),
            'clear'     => true,
        );
        $fields2['billing']['billing_address_1'] = array(
            'label'     => __('Address', 'deep'),
            'required'  => false,
            'class'     => array('form-row-first'),
            'clear'     => true,
            'placeholder'   => 'Street address',
        );
        $fields2['billing']['billing_address_2'] = array(
            'label'         => __('Address2', 'deep'),
            'required'      => false,
            'class'         => array('form-row-last'),
            'clear'         => true,
            'placeholder'   => 'Apartment, suite, unit etc. (optional)',
        );
        $fields2['billing']['billing_state'] = array(
            'label'     => __('Province', 'deep'),
            'required'  => false,
            'class'     => array('form-row-first'),
            'clear'     => true,
        );
        $fields2['billing']['billing_postcode'] = array(
            'label'     => __('Postcode / ZIP', 'deep'),
            'required'  => false,
            'class'     => array('form-row-last'),
            'clear'     => true,
        );

        $checkout_fields = array_merge( $fields, $fields2);
        return $checkout_fields;
    }
}

if ( ! function_exists('deep_woo_before_account_navigation') ) {
    function deep_woo_before_account_navigation() {
        $current_user = wp_get_current_user();
        $defult_image       = DEEP_ASSETS_URL . 'images/avatr1.png';
        $default_image      = 'mystery';
        $current_user_id    = $current_user->ID;
        $current_user_login = $current_user->user_login;
        echo '  <div class="wn-myaccount">
                <div class="col-md-2 sidebar">';
    }

}
if ( ! function_exists('deep_woo_after_account_navigation') ) {
    function deep_woo_after_account_navigation() {
        echo '</div>';
    }
}
if ( ! function_exists('deep_woo_before_my_account') ) {
    function deep_woo_before_my_account() {
        echo '<div class="col-md-10 cntt">';
    }

}
if ( ! function_exists('deep_woo_after_my_account') ) {
    function deep_woo_after_my_account() {
        echo '</div>';
    }
}
/**
 * Remove cart
 *
 * @since   1.0.0
 * @return  cart items
 */
// remove cart
add_action( 'wp_ajax_nopriv_deep_woo_ajax_update_cart', 'deep_woo_ajax_update_cart' );
add_action( 'wp_ajax_deep_woo_ajax_update_cart', 'deep_woo_ajax_update_cart' );

function deep_woo_ajax_update_cart() {

    // Set the product ID to remove

    $cart_product_id    = sanitize_text_field( $_POST['cart_product_id'] );
    $prod_to_remove     = array( $cart_product_id );

    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ){

        $cart_item_id = $cart_item['data']->get_id();

        if( in_array($cart_item_id, $prod_to_remove) )
            WC()->cart->remove_cart_item($cart_item_key);
    }

    woocommerce_mini_cart();
    wp_die();
}
