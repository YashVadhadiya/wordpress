<?php
/**
 *  Fairy Color Option
 *
 * @since Fairy 1.0.0
 *
 */

/* Site Title hover color */
$wp_customize->add_setting( 'fairy_options[fairy-primary-color]',
    array(
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'transport' => 'refresh',
        'default'           => $default['fairy-primary-color'],
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'fairy_options[fairy-primary-color]',
        array(
            'label'       => esc_html__( 'Site Primary Color', 'fairy' ),
            'description' => esc_html__( 'It will change the color of site whole site.', 'fairy' ),
            'section'     => 'colors',
             'settings'  => 'fairy_options[fairy-primary-color]',
        )
    )
);

/* Site Title hover color */
$wp_customize->add_setting( 'fairy_options[fairy-header-description-color]',
    array(
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'transport' => 'refresh',
        'default'           => $default['fairy-header-description-color'],
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'fairy_options[fairy-header-description-color]',
        array(
            'label'       => esc_html__( 'Header Description Color', 'fairy' ),
            'description' => esc_html__( 'It will change the color of site header description.', 'fairy' ),
            'section'     => 'colors',
             'settings'  => 'fairy_options[fairy-header-description-color]',
        )
    )
);



//Color option for slider hex color
$wp_customize->add_setting( 'fairy_options[fairy-overlay-color]' , array(
    'default'           => $default['fairy-overlay-color'], // Use any HEX or RGBA value.
    'transport'         => 'refresh',
    'sanitize_callback' => 'fairy_alpha_color_sanitization_callback'
) );
include_once get_theme_file_path( 'candidthemes/alpha-color/src/ColorAlpha.php' );

$wp_customize->add_control( new ColorAlpha( $wp_customize, 'fairy_options[fairy-overlay-color]', [
    'label'      => __( 'Overlay First Color', 'fairy' ),
    'description' => esc_html__( 'It will change the overlay color of slider and category box sections.', 'fairy' ),
    'section'    => 'colors',
    'settings'   => 'fairy_options[fairy-overlay-color]',
    'active_callback'=>'fairy_slider_active_callback',
] ) );


$wp_customize->add_setting( 'fairy_options[fairy-overlay-second-color]' , array(
    'default'           => $default['fairy-overlay-second-color'], // Use any HEX or RGBA value.
    'transport'         => 'refresh',
    'sanitize_callback' => 'fairy_alpha_color_sanitization_callback'
) );

$wp_customize->add_control( new ColorAlpha( $wp_customize, 'fairy_options[fairy-overlay-second-color]', [
    'label'      => __( 'Overlay Second Color', 'fairy' ),
    'description' => esc_html__( 'It will change the overlay color of slider and category box sections.', 'fairy' ),
    'section'    => 'colors',
    'settings'   => 'fairy_options[fairy-overlay-second-color]',
    'active_callback'=>'fairy_slider_active_callback',
] ) );