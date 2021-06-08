<?php
/**
 *  Fairy Sidebar Option
 *
 * @since Fairy 1.0.0
 *
 */
/*Blog Page Options*/
$wp_customize->add_section( 'fairy_sidebar_section', array(
   'priority'       => 45,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Sidebar Options', 'fairy' ),
   'panel' 		 => 'fairy_panel',
) );
/*Blog Page Sidebar Layout*/
$wp_customize->add_setting( 'fairy_options[fairy-sidebar-blog-page]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['fairy-sidebar-blog-page'],
    'sanitize_callback' => 'fairy_sanitize_select'
) );
$wp_customize->add_control( 'fairy_options[fairy-sidebar-blog-page]', array(
   'choices' => array(
    'right-sidebar'   => __('Right Sidebar','fairy'),
    'left-sidebar'    => __('Left Sidebar','fairy'),
    'no-sidebar'      => __('No Sidebar','fairy'),
    'middle-column'   => __('Middle Column','fairy')
),
   'label'     => __( 'Blog Page Sidebar Layout', 'fairy' ),
   'description' => __('This sidebar will work for the blog, archive, category, author pages. More options is in pro theme.', 'fairy'),
   'section'   => 'fairy_sidebar_section',
   'settings'  => 'fairy_options[fairy-sidebar-blog-page]',
   'type'      => 'select',
   'priority'  => 10,
) );

/*Inner Page Sidebar Layout*/
$wp_customize->add_setting( 'fairy_options[fairy-sidebar-single-page]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['fairy-sidebar-single-page'],
    'sanitize_callback' => 'fairy_sanitize_select'
) );
$wp_customize->add_control( 'fairy_options[fairy-sidebar-single-page]', array(
   'choices' => array(
    'right-sidebar'   => __('Right Sidebar','fairy'),
    'left-sidebar'    => __('Left Sidebar','fairy'),
    'no-sidebar'      => __('No Sidebar','fairy'),
    'middle-column'   => __('Middle Column','fairy')
),
   'label'     => __( 'Inner Pages Sidebar Layout', 'fairy' ),
   'description' => __('This sidebar will work for the single page and post. More options is in pro theme.', 'fairy'),
   'section'   => 'fairy_sidebar_section',
   'settings'  => 'fairy_options[fairy-sidebar-single-page]',
   'type'      => 'select',
   'priority'  => 10,
) );


/*Sticky Sidebar Setting*/
$wp_customize->add_setting( 'fairy_options[fairy-enable-sticky-sidebar]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['fairy-enable-sticky-sidebar'],
    'sanitize_callback' => 'fairy_sanitize_checkbox'
) );
$wp_customize->add_control( 'fairy_options[fairy-enable-sticky-sidebar]', array(
    'label'     => __( 'Sticky Sidebar Option', 'fairy' ),
    'description' => __('Enable and Disable sticky sidebar from this section.', 'fairy'),
    'section'   => 'fairy_sidebar_section',
    'settings'  => 'fairy_options[fairy-enable-sticky-sidebar]',
    'type'      => 'checkbox',
    'priority'  => 15,
) );