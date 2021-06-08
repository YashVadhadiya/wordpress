<?php
/**
 *  Fairy Blog Page Option
 *
 * @since Fairy 1.0.0
 *
 */
/*Blog Page Options*/
$wp_customize->add_section( 'fairy_blog_page_section', array(
   'priority'       => 35,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Blog Section Options', 'fairy' ),
   'panel' 		 => 'fairy_panel',
) );

/*Blog Page Layout Masonry*/
$wp_customize->add_setting( 'fairy_options[fairy-blog-page-masonry-normal]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['fairy-blog-page-masonry-normal'],
    'sanitize_callback' => 'fairy_sanitize_select'
) );
$wp_customize->add_control( 'fairy_options[fairy-blog-page-masonry-normal]', array(
   'choices' => array(
    'normal'    => __('Normal Layout','fairy'),
    'masonry'   => __('Masonry Layout','fairy'),
    'full-image'   => __('Full Image Layout','fairy'),
),
   'label'     => __( 'Masonry or Normal Layout', 'fairy' ),
   'description' => __('Some image layout option will not work in masonry.', 'fairy'),
   'section'   => 'fairy_blog_page_section',
   'settings'  => 'fairy_options[fairy-blog-page-masonry-normal]',
   'type'      => 'select',
   'priority'  => 10,
) );

/*Blog Page Show content from*/
$wp_customize->add_setting( 'fairy_options[fairy-content-show-from]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['fairy-content-show-from'],
    'sanitize_callback' => 'fairy_sanitize_select'
) );
$wp_customize->add_control( 'fairy_options[fairy-content-show-from]', array(
   'choices' => array(
    'excerpt'    => __('Excerpt','fairy'),
    'content'    => __('Content','fairy'),
    'hide'    => __('Hide Content','fairy'),
),
   'label'     => __( 'Select Content Display Option', 'fairy' ),
   'description' => __('You can enable excerpt from Screen Options inside post section of dashboard', 'fairy'),
   'section'   => 'fairy_blog_page_section',
   'settings'  => 'fairy_options[fairy-content-show-from]',
   'type'      => 'select',
   'priority'  => 10,
) );

/*Blog image size*/
$wp_customize->add_setting( 'fairy_options[fairy-image-size-blog-page]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['fairy-image-size-blog-page'],
    'sanitize_callback' => 'fairy_sanitize_select'
) );
$wp_customize->add_control( 'fairy_options[fairy-image-size-blog-page]', array(
   'choices' => array(
    'cropped-image'    => __('Cropped Image','fairy'),
    'original-image'   => __('Original Image','fairy'),
),
   'label'     => __( 'Size of the image, either cropped or original', 'fairy' ),
   'description' => __('The image will be either cropped or original size based on the image. Recommended image size is 800*600 px.', 'fairy'),
   'section'   => 'fairy_blog_page_section',
   'settings'  => 'fairy_options[fairy-image-size-blog-page]',
   'type'      => 'select',
   'priority'  => 10,
) );

/*Blog Page excerpt length*/
$wp_customize->add_setting( 'fairy_options[fairy-excerpt-length]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['fairy-excerpt-length'],
    'sanitize_callback' => 'absint'
) );
$wp_customize->add_control( 'fairy_options[fairy-excerpt-length]', array(
    'label'     => __( 'Size of Excerpt Content', 'fairy' ),
    'description' => __('Enter the number per Words to show the content in blog page.', 'fairy'),
    'section'   => 'fairy_blog_page_section',
    'settings'  => 'fairy_options[fairy-excerpt-length]',
    'type'      => 'number',
    'priority'  => 10,
) );
/*Blog Page Pagination Options*/
$wp_customize->add_setting( 'fairy_options[fairy-pagination-options]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['fairy-pagination-options'],
    'sanitize_callback' => 'fairy_sanitize_select'
) );
$wp_customize->add_control( 'fairy_options[fairy-pagination-options]', array(
   'choices' => array(
    'default'    => __('Default','fairy'),
    'numeric'    => __('Numeric','fairy'),
),
   'label'     => __( 'Pagination Types', 'fairy' ),
   'description' => __('Select the Required Pagination Type', 'fairy'),
   'section'   => 'fairy_blog_page_section',
   'settings'  => 'fairy_options[fairy-pagination-options]',
   'type'      => 'select',
   'priority'  => 10,
) );
/*Blog Page read more text*/
$wp_customize->add_setting( 'fairy_options[fairy-read-more-text]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['fairy-read-more-text'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'fairy_options[fairy-read-more-text]', array(
    'label'     => __( 'Enter Read More Text', 'fairy' ),
    'description' => __('Read more text for blog and archive page.', 'fairy'),
    'section'   => 'fairy_blog_page_section',
    'settings'  => 'fairy_options[fairy-read-more-text]',
    'type'      => 'text',
    'priority'  => 10,
) );