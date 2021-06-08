<?php
/**
 *  Fairy Slider Featured Section Option
 *
 * @since Fairy 1.0.0
 *
 */
/*Slider Options*/
$wp_customize->add_section( 'fairy_slider_section', array(
 'priority'       => 20,
 'capability'     => 'edit_theme_options',
 'theme_supports' => '',
 'title'          => __( 'Slider Section Options', 'fairy' ),
 'panel' 		 => 'fairy_panel',
) );
/*callback functions slider*/
if ( !function_exists('fairy_slider_active_callback') ) :
  function fairy_slider_active_callback(){
    global $fairy_theme_options;
    $fairy_theme_options = fairy_get_options_value();
    $enable_slider = absint($fairy_theme_options['fairy-enable-slider']);
    if( true == $enable_slider ){
      return true;
    }
    else{
      return false;
    }
  }
endif;
/*Slider Enable Option*/
$wp_customize->add_setting( 'fairy_options[fairy-enable-slider]', array(
 'capability'        => 'edit_theme_options',
 'transport' => 'refresh',
 'default'           => $default['fairy-enable-slider'],
 'sanitize_callback' => 'fairy_sanitize_checkbox'
) );
$wp_customize->add_control( 'fairy_options[fairy-enable-slider]', array(
 'label'     => __( 'Enable Slider Section', 'fairy' ),
 'description' => __('Checked to show slider section in Home Page.', 'fairy'),
 'section'   => 'fairy_slider_section',
 'settings'  => 'fairy_options[fairy-enable-slider]',
 'type'      => 'checkbox',
 'priority'  => 10,
) );

/*Slider Category Selection*/
$wp_customize->add_setting( 'fairy_options[fairy-select-category]', array(
  'capability'        => 'edit_theme_options',
  'transport' => 'refresh',
  'default'           => $default['fairy-select-category'],
  'sanitize_callback' => 'absint'
) );
$wp_customize->add_control(
  new Fairy_Customize_Category_Dropdown_Control(
    $wp_customize,
    'fairy_options[fairy-select-category]',
    array(
      'label'     => __( 'Select Category For Slider Section', 'fairy' ),
      'description' => __('From the dropdown select the category for the featured left section. Category having post will display in below dropdown.', 'fairy'),
      'section'   => 'fairy_slider_section',
      'settings'  => 'fairy_options[fairy-select-category]',
      'type'      => 'category_dropdown',
      'priority'  => 10,
      'active_callback'=>'fairy_slider_active_callback'
    )
  )
);

/*Slider image size*/
$wp_customize->add_setting( 'fairy_options[fairy-image-size-slider]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['fairy-image-size-slider'],
    'sanitize_callback' => 'fairy_sanitize_select'
) );
$wp_customize->add_control( 'fairy_options[fairy-image-size-slider]', array(
   'choices' => array(
    'cropped-image'    => __('Cropped Image','fairy'),
    'original-image'   => __('Original Image','fairy'),
),
   'label'     => __( 'Size of the image, either cropped or original', 'fairy' ),
   'description' => __('The image will be either cropped or original size based on the image. Recommended image size is 1170*606 px. Make the image with this size and add in the featured image.', 'fairy'),
   'section'   => 'fairy_slider_section',
   'settings'  => 'fairy_options[fairy-image-size-slider]',
   'type'      => 'select',
   'priority'  => 10,
   'active_callback'=>'fairy_slider_active_callback'
) );