<?php
/**
 * Dynamic CSS elements.
 *
 * @package fairy
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


if (!function_exists('fairy_dynamic_css')) :
    /**
     * Dynamic CSS
     *
     * @since 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function fairy_dynamic_css()
    {

        global $fairy_theme_options;
        $fairy_header_color = get_header_textcolor();
        $fairy_custom_css = '';
        $primary_color = esc_attr($fairy_theme_options['fairy-primary-color']);
        $site_description_color = esc_attr($fairy_theme_options['fairy-header-description-color']);

        if(!empty($primary_color)){
            $fairy_custom_css .= ".primary-color, p a, h1 a, h2 a, h3 a, h4 a, h5 a, .author-title a, figure a, table a, span a, strong a, li a, h1 a, .btn-primary-border, .main-navigation #primary-menu > li > a:hover, .widget-area .widget a:hover, .widget-area .widget a:focus, .card-bg-image .card_body a:hover, .main-navigation #primary-menu > li.focus > a, .card-blog-post .category-label-group a:hover, .card_title a:hover, .card-blog-post .entry-meta a:hover, .site-title a:visited, .post-navigation .nav-links > * a:hover, .post-navigation .nav-links > * a:focus, .wp-block-button.is-style-outline .wp-block-button__link, .error-404-title, .ct-dark-mode a:hover, .ct-dark-mode .widget ul li a:hover, .ct-dark-mode .widget-area .widget ul li a:hover, .ct-dark-mode .post-navigation .nav-links > * a, .ct-dark-mode .author-wrapper .author-title a, .ct-dark-mode .wp-calendar-nav a, .site-footer a:hover, .top-header-toggle-btn, .woocommerce ul.products li.product .woocommerce-loop-category__title:hover, .woocommerce ul.products li.product .woocommerce-loop-product__title:hover, .woocommerce ul.products li.product h3:hover, .entry-content dl a, .entry-content table a, .entry-content ul a, .breadcrumb-trail .trial-items a:hover, .breadcrumbs ul a:hover, .breadcrumb-trail .trial-items .trial-end a, .breadcrumbs ul li:last-child a, .comment-list .comment .comment-body a, .comment-list .comment .comment-body .comment-metadata a.comment-edit-link { color: {$primary_color}; }";

            $fairy_custom_css .= ".primary-bg, .btn-primary, .main-navigation ul ul a, #secondary .widget .widget-title:after, .search-form .search-submit, .category-label-group a:after, .posts-navigation .nav-links a, .category-label-group.bg-label a, .wp-block-button__link, .wp-block-button.is-style-outline .wp-block-button__link:hover, button, input[type=\"button\"], input[type=\"reset\"], input[type=\"submit\"], .pagination .page-numbers.current, .pagination .page-numbers:hover, table #today, .tagcloud .tag-cloud-link:hover, .footer-go-to-top, .woocommerce ul.products li.product .button,
.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,
.woocommerce #respond input#submit.alt.disabled, .woocommerce #respond input#submit.alt.disabled:hover, .woocommerce #respond input#submit.alt:disabled, .woocommerce #respond input#submit.alt:disabled:hover, .woocommerce #respond input#submit.alt:disabled[disabled], .woocommerce #respond input#submit.alt:disabled[disabled]:hover, .woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover, .woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover, .woocommerce a.button.alt:disabled[disabled], .woocommerce a.button.alt:disabled[disabled]:hover, .woocommerce button.button.alt.disabled, .woocommerce button.button.alt.disabled:hover, .woocommerce button.button.alt:disabled, .woocommerce button.button.alt:disabled:hover, .woocommerce button.button.alt:disabled[disabled], .woocommerce button.button.alt:disabled[disabled]:hover, .woocommerce input.button.alt.disabled, .woocommerce input.button.alt.disabled:hover, .woocommerce input.button.alt:disabled, .woocommerce input.button.alt:disabled:hover, .woocommerce input.button.alt:disabled[disabled], .woocommerce input.button.alt:disabled[disabled]:hover, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .fairy-menu-social li a[href*=\"mailto:\"] { background-color: {$primary_color}; }";

            $fairy_custom_css .= ".primary-border, .btn-primary-border, .site-header-v2,.wp-block-button.is-style-outline .wp-block-button__link, .site-header-bottom { border-color: {$primary_color}; }";

            $fairy_custom_css .= "a:focus, button.slick-arrow:focus, input[type=text]:focus, input[type=email]:focus, input[type=password]:focus, input[type=search]:focus, input[type=file]:focus, input[type=number]:focus, input[type=datetime]:focus, input[type=url]:focus, select:focus, textarea:focus { outline-color: {$primary_color}; }";

            $fairy_custom_css .= ".entry-content a { text-decoration-color: {$primary_color}; }";
            $fairy_custom_css .= ".post-thumbnail a:focus img, .card_media a:focus img, article.sticky .card-blog-post { border-color: {$primary_color}; }";

        }

        if (!empty($fairy_header_color)) {
            $fairy_custom_css .= ".site-title, .site-title a, h1.site-title a, p.site-title a,  .site-title a:visited { color: #{$fairy_header_color}; }";
        }

        if (!empty($site_description_color)) {
            $fairy_custom_css .= ".site-description { color: {$site_description_color}; }";
        }

        $fairy_overlay_color = esc_attr($fairy_theme_options['fairy-overlay-color']);
        $fairy_overlay_second_color = esc_attr($fairy_theme_options['fairy-overlay-second-color']);
        if(!empty($fairy_overlay_color) && !empty($fairy_overlay_second_color)){
            $fairy_custom_css .= "
                    .card-bg-image:after, .card-bg-image.card-promo .card_media a:after{
                    background-image: linear-gradient(45deg, {$fairy_overlay_color}, {$fairy_overlay_second_color});
                    }
                    ";
        }else{
            if(!empty($fairy_overlay_color)){
                $fairy_custom_css .= "
                    .card-bg-image:after, .card-bg-image.card-promo .card_media a:after{
                    background-image: none;
                    background-color: $fairy_overlay_color;
                    }
                    ";
            }
            if(!empty($fairy_overlay_second_color)){
                $fairy_custom_css .= "
                    .card-bg-image:after, .card-bg-image.card-promo .card_media a:after{
                    background-image: none;
                    background-color: $fairy_overlay_second_color;
                    }
                    ";
            }
        }

        $fairy_box_shadow = esc_attr($fairy_theme_options['fairy-site-layout-blog-overlay']);
        if(!empty($fairy_theme_options) && ($fairy_box_shadow == 0)){
            $fairy_custom_css .= "
                    .card-blog-post, .widget-area .widget{
                    box-shadow: none;
                    }
                    ";
        }

        $fairy_enable_link_underline = esc_attr($fairy_theme_options['fairy-enable-underline-link']);
        if(!empty($fairy_enable_link_underline) && ($fairy_enable_link_underline == 1)){
            $fairy_custom_css .= "
                    .entry-content a{
                   text-decoration: underline;
                    }
                    ";
        }else{
            $fairy_custom_css .= "
                    .entry-content a{
                   text-decoration: none;
                    }
                    ";
        }

        /* Paragraph Font Options */
        $fairy_google_fonts = fairy_google_fonts();
        $fairy_body_fonts = $fairy_theme_options['fairy-font-family-url'];
        if(!empty($fairy_body_fonts)){
            $fairy_font_family = esc_attr($fairy_google_fonts[$fairy_body_fonts] );
            if (!empty($fairy_font_family)) {
                $fairy_custom_css .= "body, button, input, select, optgroup, textarea { font-family: '{$fairy_font_family}'; }";
            }
        }

        /* Heading H1 Font Option */
        $fairy_heading_fonts = esc_attr( $fairy_theme_options['fairy-font-heading-family-url'] );
        if(!empty($fairy_heading_fonts)) {
            $fairy_heading_font_family = $fairy_google_fonts[$fairy_heading_fonts];
            if (!empty($fairy_heading_font_family)) {
                $fairy_custom_css .= "h1, h2, h3, h4, h5, h6, .entry-content h1 { font-family: '{$fairy_heading_font_family}'; }";
            }
        }



        $fairy_show_date = esc_attr($fairy_theme_options['fairy-post-published-updated-date']);
        if ($fairy_show_date == 'post-updated') {
            $fairy_custom_css .= "
                        .posted-on time.published:not(.updated){
                            display: none;
                        }
                        .posted-on time.updated:not(.published){
                            display: inline-block;
                        }
                    ";
        }

        wp_add_inline_style('fairy-style', $fairy_custom_css);
    }
endif;
add_action('wp_enqueue_scripts', 'fairy_dynamic_css', 99);