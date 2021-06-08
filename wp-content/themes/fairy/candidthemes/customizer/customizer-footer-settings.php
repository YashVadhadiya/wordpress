<?php
/**
 * Fairy Footer Option
 *
 * @since Fairy 1.0.0
 *
 */
/*Footer Options*/
$wp_customize->add_section( 'fairy_footer_section', array(
   'priority'       => 55,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Footer Options', 'fairy' ),
   'panel' 		 => 'fairy_panel',
) );
/*Copyright Setting*/
$wp_customize->add_setting( 'fairy_options[fairy-footer-copyright]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['fairy-footer-copyright'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'fairy_options[fairy-footer-copyright]', array(
    'label'     => __( 'Copyright Text', 'fairy' ),
    'description' => __('Enter your own copyright text.', 'fairy'),
    'section'   => 'fairy_footer_section',
    'settings'  => 'fairy_options[fairy-footer-copyright]',
    'type'      => 'text',
    'priority'  => 15,
) );
/*Go to Top Setting*/
$wp_customize->add_setting( 'fairy_options[fairy-go-to-top]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['fairy-go-to-top'],
    'sanitize_callback' => 'fairy_sanitize_checkbox'
) );
$wp_customize->add_control( 'fairy_options[fairy-go-to-top]', array(
    'label'     => __( 'Enable Go to Top', 'fairy' ),
    'description' => __('Checked to Enable Go to Top', 'fairy'),
    'section'   => 'fairy_footer_section',
    'settings'  => 'fairy_options[fairy-go-to-top]',
    'type'      => 'checkbox',
    'priority'  => 15,
) );

/*Social Icons Footer*/
$wp_customize->add_setting( 'fairy_options[fairy-footer-social-icons]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['fairy-footer-social-icons'],
    'sanitize_callback' => 'fairy_sanitize_checkbox'
) );
$wp_customize->add_control( 'fairy_options[fairy-footer-social-icons]', array(
    'label'     => __( 'Enable Social Icons', 'fairy' ),
    'description' => __('Checked to Enable Social Icons. Make Social Menus from Appearance > Menus.', 'fairy'),
    'section'   => 'fairy_footer_section',
    'settings'  => 'fairy_options[fairy-footer-social-icons]',
    'type'      => 'checkbox',
    'priority'  => 15,
) );

if(function_exists('mc4wp_get_form')) {

    /*Enable Subscribe in Footer*/
    $wp_customize->add_setting('fairy_options[fairy-footer-mailchimp-subscribe]', array(
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'default' => $default['fairy-footer-mailchimp-subscribe'],
        'sanitize_callback' => 'fairy_sanitize_checkbox'
    ));
    $wp_customize->add_control('fairy_options[fairy-footer-mailchimp-subscribe]', array(
        'label' => __('Mailchimp Subscribe Form', 'fairy'),
        'description' => sprintf('%1$s <a href="%2$s" target="_blank">%3$s</a> %4$s',
        __( 'Install and Customize', 'fairy' ),
        esc_url('https://wordpress.org/plugins/mailchimp-for-wp/'),
        __('Mailchimp Subscribe Plugin' , 'fairy'),
        __('and paste the form ID below.' ,'fairy')
    ),
        'section' => 'fairy_footer_section',
        'settings' => 'fairy_options[fairy-footer-mailchimp-subscribe]',
        'type' => 'checkbox',
        'priority' => 15,
    ));

    /*callback functions mailchimp enable*/
    if (!function_exists('fairy_footer_mailchimp_enable')) :
        function fairy_footer_mailchimp_enable()
        {
            global $fairy_theme_options;
            $fairy_theme_options = fairy_get_options_value();
            $enable_mailchimp = absint($fairy_theme_options['fairy-footer-mailchimp-subscribe']);
            if ($enable_mailchimp == true) {
                return true;
            } else {
                return false;
            }
        }
    endif;

    /*Enable Mailchimp form Id in Footer*/
    $wp_customize->add_setting('fairy_options[fairy-footer-mailchimp-form-id]', array(
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'default' => $default['fairy-footer-mailchimp-form-id'],
        'sanitize_callback' => 'absint'
    ));
    $wp_customize->add_control('fairy_options[fairy-footer-mailchimp-form-id]', array(
        'label' => __('Mailchimp Form ID', 'fairy'),
        'description' => __('From your dashboard go to the mailchimp form plugin and get the ID and put here.', 'fairy'),
        'section' => 'fairy_footer_section',
        'settings' => 'fairy_options[fairy-footer-mailchimp-form-id]',
        'type' => 'number',
        'priority' => 15,
        'active_callback'=> 'fairy_footer_mailchimp_enable',
    ));

    /*Title for mailchimp*/
    $wp_customize->add_setting('fairy_options[fairy-footer-mailchimp-form-title]', array(
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'default' => $default['fairy-footer-mailchimp-form-title'],
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('fairy_options[fairy-footer-mailchimp-form-title]', array(
        'label' => __('Mailchimp Section Title', 'fairy'),
        'description' => __('Enter the title of subscribe.', 'fairy'),
        'section' => 'fairy_footer_section',
        'settings' => 'fairy_options[fairy-footer-mailchimp-form-title]',
        'type' => 'text',
        'priority' => 15,
        'active_callback'=> 'fairy_footer_mailchimp_enable',
    ));


    /*subTitle for mailchimp*/
    $wp_customize->add_setting('fairy_options[fairy-footer-mailchimp-form-subtitle]', array(
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'default' => $default['fairy-footer-mailchimp-form-subtitle'],
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('fairy_options[fairy-footer-mailchimp-form-subtitle]', array(
        'label' => __('Mailchimp Section Sub Title', 'fairy'),
        'description' => __('Enter the sub title of subscribe.', 'fairy'),
        'section' => 'fairy_footer_section',
        'settings' => 'fairy_options[fairy-footer-mailchimp-form-subtitle]',
        'type' => 'text',
        'priority' => 15,
        'active_callback'=> 'fairy_footer_mailchimp_enable',
    ));
}