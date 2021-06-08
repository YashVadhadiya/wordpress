<?php
/**
 *  Fairy Boxed Option
 *
 * @since Fairy 1.0.0
 *
 */
/* Header Types Options*/
$wp_customize->add_section( 'fairy_category_boxes_section', array(
    'priority'       => 25,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Category Boxes Options', 'fairy' ),
    'panel' 		 => 'fairy_panel',
) );
/*Enable Boxes*/
$wp_customize->add_setting( 'fairy_options[fairy-enable-category-boxes]', array(
 'capability'        => 'edit_theme_options',
 'transport' => 'refresh',
 'default'           => $default['fairy-enable-category-boxes'],
 'sanitize_callback' => 'fairy_sanitize_checkbox'
) );
$wp_customize->add_control( 'fairy_options[fairy-enable-category-boxes]', array(
 'label'     => __( 'Enable Category Boxes Section', 'fairy' ),
 'description' => __('Checked to show category boxes section in Home Page.', 'fairy'),
 'section'   => 'fairy_category_boxes_section',
 'settings'  => 'fairy_options[fairy-enable-category-boxes]',
 'type'      => 'checkbox',
 'priority'  => 10,
) );

/*callback functions header section*/
if ( !function_exists('fairy_category_enable_boxes_callback') ) :
  function fairy_category_enable_boxes_callback(){
      global $fairy_theme_options;
      $fairy_theme_options = fairy_get_options_value();
      $enable_box = absint($fairy_theme_options['fairy-enable-category-boxes']);
      if( true == $enable_box ){
          return true;
      }
      else{
          return false;
      }
  }
endif;

/*Boxes Category*/
$wp_customize->add_setting( 'fairy_options[fairy-single-cat-posts-select-1]', array(
  'capability'        => 'edit_theme_options',
  'transport' => 'refresh',
  'default'           => $default['fairy-single-cat-posts-select-1'],
  'sanitize_callback' => 'absint'
) );
$wp_customize->add_control(
  new Fairy_Customize_Category_Dropdown_Control(
    $wp_customize,
    'fairy_options[fairy-single-cat-posts-select-1]',
    array(
      'label'     => __( 'Select Category', 'fairy' ),
      'description' => __('Three Posts from the same category will appear.', 'fairy'),
      'section'   => 'fairy_category_boxes_section',
      'settings'  => 'fairy_options[fairy-single-cat-posts-select-1]',
      'type'      => 'category_dropdown',
      'priority'  => 10,
      'active_callback'=>'fairy_category_enable_boxes_callback'
    )
  )
);