<?php
/**
 *  Fairy Typography Option
 *
 * @since Fairy 1.1.9
 *
 */
$wp_customize->add_panel( 'fairy_typography', array(
    'priority' => 30,
    'capability' => 'edit_theme_options',
    'title' => __( 'Fonts Options', 'fairy' ),
) );

/*
* Font and Typography Options
* Paragraph Option Section
* Fairy 1.1.9
*/
$wp_customize->add_section( 'fairy_font_options', array(
   'priority'       => 20,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Paragraph Font', 'fairy' ),
   'panel' 		 => 'fairy_typography',
) );
/*Paragraph Font Family*/
$wp_customize->add_setting( 'fairy_options[fairy-font-family-url]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['fairy-font-family-url'],
    'sanitize_callback' => 'wp_kses_post'
) );
$choices = fairy_google_fonts();
$wp_customize->add_control( 'fairy_options[fairy-font-family-url]', array(
    'label'     => __( 'Body Paragraph Font Family', 'fairy' ),
    'description' =>__( 'Select the required font from the dropdown.', 'fairy' ),
    'choices'  	=> $choices,
    'section'   => 'fairy_font_options',
    'settings'  => 'fairy_options[fairy-font-family-url]',
    'type'      => 'select',
    'priority'  => 15,
) );

/*
* Heading Fonts Options
* Heading Font Option Section
* Fairy 1.1.9
*/

/*Heading Fonts*/
$wp_customize->add_section( 'fairy_heading_font_options', array(
    'priority'       => 30,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Heading Font Family', 'fairy' ),
    'panel'         => 'fairy_typography',
) );
/*Font Family URL*/
$wp_customize->add_setting( 'fairy_options[fairy-font-heading-family-url]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['fairy-font-heading-family-url'],
    'sanitize_callback' => 'wp_kses_post'
) );
$choices = fairy_google_fonts();
$wp_customize->add_control( 'fairy_options[fairy-font-heading-family-url]', array(
    'label'     => __( 'Select Heading Font Family', 'fairy' ),
    'description' => __( 'Select the required font from the dropdown(H1-H6).', 'fairy' ),
    'choices'  	=> $choices,
    'section'   => 'fairy_heading_font_options',
    'settings'  => 'fairy_options[fairy-font-heading-family-url]',
    'type'      => 'select',
    'priority'  => 10,
) );