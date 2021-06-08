<?php
/**
 * Fairy Theme Customizer default values
 *
 * @package Fairy
 */
if ( !function_exists('fairy_default_theme_options_values') ) :
    function fairy_default_theme_options_values() {
        $default_theme_options = array(
            /*Top Header*/
            'fairy-enable-top-header'=> true,
            'fairy-enable-top-header-social'=> true,
            'fairy-enable-top-header-menu'=> true,
            'fairy-enable-top-header-search'=> true,

            /*Slider Settings Option*/
            'fairy-enable-slider'=> false,
            'fairy-select-category'=> 0,
            'fairy-image-size-slider'=> 'cropped-image',

            /*Category Boxes*/
            'fairy-enable-category-boxes'=> false,
            'fairy-single-cat-posts-select-1'=> 0,


            /*Sidebar Options*/
            'fairy-sidebar-blog-page'=>'right-sidebar',
            'fairy-sidebar-single-page' =>'right-sidebar',
            'fairy-enable-sticky-sidebar'=> true,


            /*Blog Page Default Value*/
            'fairy-column-blog-page'=> 'one-column',
            'fairy-content-show-from'=>'excerpt',
            'fairy-excerpt-length'=>25,
            'fairy-pagination-options'=>'numeric',
            'fairy-read-more-text'=> esc_html__('Read More','fairy'),
            'fairy-blog-page-masonry-normal'=> 'normal',
            'fairy-blog-page-image-position'=> 'left-image',
            'fairy-image-size-blog-page'=> 'original-image',

            /*Blog Layout Overlay*/
            'fairy-site-layout-blog-overlay'=> 1,

            /*Single Page Default Value*/
            'fairy-single-page-featured-image'=> true,
            'fairy-single-page-tags'=> false,
            'fairy-enable-underline-link' => true,
            'fairy-single-page-related-posts'=> true,
            'fairy-single-page-related-posts-title'=> esc_html__('Related Posts','fairy'),


            /*Breadcrumb Settings*/
            'fairy-blog-site-breadcrumb'=> true,
            'fairy-breadcrumb-display-from-option'=> 'theme-default',
            'fairy-breadcrumb-text'=> '',

             /*General Colors*/
            'fairy-primary-color' => '#d10014',
            'fairy-header-description-color'=>'#404040',

            'fairy-overlay-color' => 'rgba(209, 0, 20, 0.5)',
            'fairy-overlay-second-color'=>'rgba(0, 0, 0, 0.5)',

            /*Footer Options*/
            'fairy-footer-copyright'=> esc_html__('All Rights Reserved 2021.','fairy'),
            'fairy-go-to-top'=> true,
            'fairy-footer-social-icons'=> false,
            'fairy-footer-mailchimp-subscribe'=> false,
            'fairy-footer-mailchimp-form-id'=> '',
            'fairy-footer-mailchimp-form-title'=>  esc_html__('Subscribe to my Newsletter','fairy'),
            'fairy-footer-mailchimp-form-subtitle'=> esc_html__('Be the first to receive the latest buzz on upcoming contests & more!','fairy'),

            /*Font Options*/
            'fairy-font-family-url'=> 'Muli:400,300italic,300',
            'fairy-font-heading-family-url'=> 'Poppins:400,500,600,700',

            /*Extra Options*/
            'fairy-post-published-updated-date'=> 'post-published',

        );
        return apply_filters( 'fairy_default_theme_options_values', $default_theme_options );
    }
endif;

/**
 *  Fairy Theme Options and Settings
 *
 * @since Fairy 1.0.0
 *
 * @param null
 * @return array fairy_get_options_value
 *
 */
if ( !function_exists('fairy_get_options_value') ) :
    function fairy_get_options_value() {
        $fairy_default_theme_options_values = fairy_default_theme_options_values();
        $fairy_get_options_value = get_theme_mod( 'fairy_options');
        if( is_array( $fairy_get_options_value )){
            return array_merge( $fairy_default_theme_options_values, $fairy_get_options_value );
        }
        else{
            return $fairy_default_theme_options_values;
        }
    }
endif;