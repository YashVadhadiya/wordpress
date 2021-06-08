<?php
/**
 * Fairy Site Layout Option
 *
 * @since Fairy 1.0.0
 *
 */
/*Site Layout Options*/
$wp_customize->add_section( 'fairy_site_layout_section', array(
   'priority'       => 36,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Site Layout Options', 'fairy' ),
   'panel' 		 => 'fairy_panel',
) );
/*Box Shadow in Blog Page*/
$wp_customize->add_setting( 'fairy_options[fairy-site-layout-blog-overlay]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['fairy-site-layout-blog-overlay'],
    'sanitize_callback' => 'fairy_sanitize_checkbox'
) );
$wp_customize->add_control( 'fairy_options[fairy-site-layout-blog-overlay]', array(
    'label'     => __( 'Box Shadow of Blog and Sidebar', 'fairy' ),
    'description' => __('Remove Box Shadow completely and make it clean.', 'fairy'),
    'section'   => 'fairy_site_layout_section',
    'settings'  => 'fairy_options[fairy-site-layout-blog-overlay]',
    'type'      => 'checkbox',
    'priority'  => 15,
) );