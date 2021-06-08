<?php 
/**
 *  Fairy Breadcrumb Settings Option
 *
 * @since Fairy 1.0.0
 *
 */
/*Breadcrumb Options*/
$wp_customize->add_section( 'fairy_breadcrumb_options', array(
    'priority'       => 50,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Breadcrumb Options', 'fairy' ),
    'panel'          => 'fairy_panel',
) );

/*Breadcrumb Enable*/
$wp_customize->add_setting( 'fairy_options[fairy-blog-site-breadcrumb]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['fairy-blog-site-breadcrumb'],
    'sanitize_callback' => 'fairy_sanitize_checkbox'
) );
$wp_customize->add_control( 'fairy_options[fairy-blog-site-breadcrumb]', array(
    'label'     => __( 'Enable Breadcrumb', 'fairy' ),
    'description' => __( 'Breadcrumb will appear on all pages except home page. You can use  Yoast SEO, Rank Math or Breadcrumb NavXT plugin breadcrumb as well. Install the plugin and activate the breadcrumb from the settings.', 'fairy' ),
    'section'   => 'fairy_breadcrumb_options',
    'settings'  => 'fairy_options[fairy-blog-site-breadcrumb]',
    'type'      => 'checkbox',
    'priority'  => 15,
) );

/*callback functions breadcrumb enable*/
if ( !function_exists('fairy_breadcrumb_selection_enable') ) :
  function fairy_breadcrumb_selection_enable(){
      global $fairy_theme_options;
      $fairy_theme_options = fairy_get_options_value();
      $enable_bc = absint($fairy_theme_options['fairy-blog-site-breadcrumb']);
      if( $enable_bc == true){
          return true;
      }
      else{
          return false;
      }
  }
endif;

/*Show Breadcrumb Types Selection*/
$wp_customize->add_setting( 'fairy_options[fairy-breadcrumb-display-from-option]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['fairy-breadcrumb-display-from-option'],
    'sanitize_callback' => 'fairy_sanitize_select'
) );
$wp_customize->add_control( 'fairy_options[fairy-breadcrumb-display-from-option]', array(
    'choices' => array(
        'theme-default'    => __('Theme Default Breadcrumb','fairy'),
        'yoast-breadcrumb'    => __('Yoast SEO Breadcrumb','fairy'),
        'rankmath-breadcrumb'    => __('Rank Math Breadcrumb','fairy'),
        'breadcrumb-navxt'    => __('NavXT Breadcrumb','fairy'),
    ),
    'label'     => __( 'Select the Breadcrumb Show Option', 'fairy' ),
    'description' => __('Theme has its own breadcrumb. If you want to use the plugin breadcrumb, you need to enable the breadcrumb on the respected plugins first. Check plugin settings and enable it.', 'fairy'),
    'section'   => 'fairy_breadcrumb_options',
    'settings'  => 'fairy_options[fairy-breadcrumb-display-from-option]',
    'type'      => 'select',
    'priority'  => 15,
    'active_callback'=> 'fairy_breadcrumb_selection_enable',
) );

/*Breadcrumb Text*/
$wp_customize->add_setting( 'fairy_options[fairy-breadcrumb-text]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['fairy-breadcrumb-text'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'fairy_options[fairy-breadcrumb-text]', array(
    'label'     => __( 'Breadcrumb Text', 'fairy' ),
    'description' => __( 'Write your own text in place of You are Here', 'fairy' ),
    'section'   => 'fairy_breadcrumb_options',
    'settings'  => 'fairy_options[fairy-breadcrumb-text]',
    'type'      => 'text',
    'priority'  => 15,
    'active_callback' => 'fairy_breadcrumb_selection_enable',
) );
