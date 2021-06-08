<?php
/**
 *  Fairy Top Header Option
 *
 * @since Fairy 1.0.0
 *
 */
/*Top Header Options*/
$wp_customize->add_section( 'fairy_header_section', array(
   'priority'       => 5,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Top Header Options', 'fairy' ),
   'panel' 		 => 'fairy_panel',
) );
/*callback functions header section*/
if ( !function_exists('fairy_header_active_callback') ) :
  function fairy_header_active_callback(){
      global $fairy_theme_options;
      $fairy_theme_options = fairy_get_options_value();
      $enable_header = absint($fairy_theme_options['fairy-enable-top-header']);
      if( true == $enable_header ){
          return true;
      }
      else{
          return false;
      }
  }
endif;
/*Enable Top Header Section*/
$wp_customize->add_setting( 'fairy_options[fairy-enable-top-header]', array(
   'capability'        => 'edit_theme_options',
   'transport' => 'refresh',
   'default'           => $default['fairy-enable-top-header'],
   'sanitize_callback' => 'fairy_sanitize_checkbox'
) );
$wp_customize->add_control( 'fairy_options[fairy-enable-top-header]', array(
   'label'     => __( 'Enable Top Header', 'fairy' ),
   'description' => __('Checked to show the top header section like search and social icons', 'fairy'),
   'section'   => 'fairy_header_section',
   'settings'  => 'fairy_options[fairy-enable-top-header]',
   'type'      => 'checkbox',
   'priority'  => 5,
) );
/*Enable Social Icons In Header*/
$wp_customize->add_setting( 'fairy_options[fairy-enable-top-header-social]', array(
   'capability'        => 'edit_theme_options',
   'transport' => 'refresh',
   'default'           => $default['fairy-enable-top-header-social'],
   'sanitize_callback' => 'fairy_sanitize_checkbox'
) );
$wp_customize->add_control( 'fairy_options[fairy-enable-top-header-social]', array(
   'label'     => __( 'Enable Social Icons', 'fairy' ),
   'description' => __('You can show the social icons here. Manage social icons from Appearance > Menus. Social Menu will display here.', 'fairy'),
   'section'   => 'fairy_header_section',
   'settings'  => 'fairy_options[fairy-enable-top-header-social]',
   'type'      => 'checkbox',
   'priority'  => 5,
   'active_callback'=>'fairy_header_active_callback'
) );

/*Enable Menu in top Header*/
$wp_customize->add_setting( 'fairy_options[fairy-enable-top-header-menu]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['fairy-enable-top-header-menu'],
    'sanitize_callback' => 'fairy_sanitize_checkbox'
) );
$wp_customize->add_control( 'fairy_options[fairy-enable-top-header-menu]', array(
    'label'     => __( 'Menu in Header', 'fairy' ),
    'description' => __('Top Header Menu will display here. Go to Appearance < Menu.', 'fairy'),
    'section'   => 'fairy_header_section',
    'settings'  => 'fairy_options[fairy-enable-top-header-menu]',
    'type'      => 'checkbox',
    'priority'  => 5,
    'active_callback'=>'fairy_header_active_callback'
) );

/*Enable Date in top Header*/
$wp_customize->add_setting( 'fairy_options[fairy-enable-top-header-search]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['fairy-enable-top-header-search'],
    'sanitize_callback' => 'fairy_sanitize_checkbox'
) );
$wp_customize->add_control( 'fairy_options[fairy-enable-top-header-search]', array(
    'label'     => __( 'Search in Header', 'fairy' ),
    'description' => __('Enable Search icon in Header', 'fairy'),
    'section'   => 'fairy_header_section',
    'settings'  => 'fairy_options[fairy-enable-top-header-search]',
    'type'      => 'checkbox',
    'priority'  => 5,
    'active_callback'=>'fairy_header_active_callback'
) );