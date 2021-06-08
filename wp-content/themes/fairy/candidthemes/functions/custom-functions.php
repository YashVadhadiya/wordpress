<?php
if (!function_exists('fairy_social_menu')) {
    /**
     * Add social icons menu
     *
     * @since 1.0.0
     *
     */
    function fairy_social_menu()
    {
        if (has_nav_menu('social-menu')) :
        wp_nav_menu(array(
            'theme_location' => 'social-menu',
            'container' => 'ul',
            'menu_class' => 'social-menu'
        ));
        endif;
    }
}


if (!function_exists('fairy_custom_body_class')) {
    /**
     * Add sidebar class in body
     *
     * @since 1.0.0
     *
     */
    function fairy_custom_body_class($classes)
    {
        global $fairy_theme_options;
        if( $fairy_theme_options['fairy-enable-sticky-sidebar'] == 1){
            $classes[] = 'ct-sticky-sidebar';
        }

        return $classes;
    }
}

add_filter('body_class', 'fairy_custom_body_class');



if ( !function_exists('fairy_excerpt_more') ) :
    /**
     * Remove ... From Excerpt
     *
     * @since 1.0.0
     */
    function fairy_excerpt_more( $more ) {
        if(!is_admin() ){
            return '';
        }
    }
endif;
add_filter('excerpt_more', 'fairy_excerpt_more');


if ( !function_exists('fairy_alter_excerpt') ) :
    /**
     * Filter to change excerpt length size
     *
     * @since 1.0.0
     */
    function fairy_alter_excerpt( $length ){
        if(is_admin() ){
            return $length;
        }
        global $fairy_theme_options;
        $excerpt_length = $fairy_theme_options['fairy-excerpt-length'];
        if( !empty( $excerpt_length ) ){
            return absint($excerpt_length);
        }
        return 25;
    }
endif;
add_filter('excerpt_length', 'fairy_alter_excerpt');


if (!function_exists('fairy_tag_cloud_widget')) :
    /**
     * Function to modify tag clouds font size
     *
     * @param none
     * @return array $args
     *
     * @since 1.0.0
     *
     */
    function fairy_tag_cloud_widget($args)
    {
        $args['largest'] = 0.9; //largest tag
        $args['smallest'] = 0.9; //smallest tag
        $args['unit'] = 'rem'; //tag font unit
        return $args;
    }
endif;
add_filter('widget_tag_cloud_args', 'fairy_tag_cloud_widget');


/**
 * Google Fonts
 *
 * @param null
 * @return array
 *
 * @since Fairy 1.0.0
 *
 */
if (!function_exists('fairy_google_fonts')) :
    function fairy_google_fonts()
    {
        $fairy_google_fonts = array(       
            'Libre+Baskerville'=> 'Libre Baskerville',
            'Merriweather:400,400italic,300,900,700' => 'Merriweather',
            'Montserrat:400,700' => 'Montserrat',
            'Muli:400,300italic,300' => 'Muli',
            'Open+Sans:400,400italic,600,700' => 'Open Sans',
            'Open+Sans+Condensed:300,300italic,700' => 'Open Sans Condensed',
            'Oswald:400,300,700' => 'Oswald',
            'Oxygen:400,300,700' => 'Oxygen',
            'Poppins:400,500,600,700'=>'Poppins',
            'Roboto:400,500,300,700,400italic' => 'Roboto',
            'Voltaire' => 'Voltaire',
            'Yanone+Kaffeesatz:400,300,700' => 'Yanone Kaffeesatz'
        );
        return apply_filters('fairy_google_fonts', $fairy_google_fonts);
    }
endif;


/**
 * Enqueue the list of fonts.
 */
function fairy_customizer_fonts()
{
    wp_enqueue_style('fairy_customizer_fonts', 'https://fonts.googleapis.com/css?family=Libre+Baskerville|Merriweather|Montserrat|Muli|Open+Sans|Open+Sans+Condensed|Oswald|Oxygen|Poppins|Roboto|Voltaire|Yanone+Kaffeesatz', array(), null);
}

add_action('customize_controls_print_styles', 'fairy_customizer_fonts');
add_action('customize_preview_init', 'fairy_customizer_fonts');

add_action(
    'customize_controls_print_styles',
    function () {
        ?>
        <style>
            <?php
            $arr = array( 'Libre+Baskerville', 'Merriweather','Montserrat','Muli','Open+Sans','Open+Sans+Condensed','Oswald','Oxygen','Poppins','Roboto','Voltaire','Yanone+Kaffeesatz');

            foreach ( $arr as $font ) {
                $font_family = str_replace("+", " ", $font);
                echo '.customize-control select option[value*="' . $font . '"] {font-family: ' . $font_family . '; font-size: 22px;}';
            }
            ?>
        </style>
        <?php
    }
);


if (!function_exists('fairy_editor_assets')) {
    /**
     * Add styles and fonts for the editor.
     */
    function fairy_editor_assets()
    {
        wp_enqueue_style('fairy-fonts', fairy_fonts_url(), array(), null);

        /* Paragraph Font Options */
        $fairy_custom_css = '';
        global $fairy_theme_options;
        $fairy_theme_options = fairy_get_options_value();
        $fairy_google_fonts = fairy_google_fonts();

        $fairy_body_fonts = esc_attr( $fairy_theme_options['fairy-font-family-url'] );
        $fairy_heading_fonts = esc_attr( $fairy_theme_options['fairy-font-heading-family-url'] );

        $fairy_google_fonts_enqueue = array(
            $fairy_body_fonts,
            $fairy_heading_fonts,
        );
        $fairy_google_fonts_enqueue_uniques = array_unique( $fairy_google_fonts_enqueue );
        foreach ( $fairy_google_fonts_enqueue_uniques as $fairy_google_fonts_enqueue_unique ) {
            wp_enqueue_style(
                $fairy_google_fonts_enqueue_unique,
                '//fonts.googleapis.com/css?family=' . $fairy_google_fonts_enqueue_unique . '',
                array(),
                ''
            );
        }
        if(!empty($fairy_body_fonts)){
            $fairy_font_family = esc_attr($fairy_google_fonts[$fairy_body_fonts] );
            if (!empty($fairy_font_family)) {
                $fairy_custom_css .= ".editor-styles-wrapper .wp-block-table td, .editor-styles-wrapper .wp-block-table th, .editor-styles-wrapper, .editor-styles-wrapper .wp-block-button__link, .editor-styles-wrapper ul li, .editor-styles-wrapper ol li, .editor-styles-wrapper p, .editor-styles-wrapper .editor-block-list__block-edit, .editor-block-list__block  { font-family: '{$fairy_font_family}'; }";
            }
        }

        /* Heading H1 Font Option */
        if(!empty($fairy_heading_fonts)) {
            $fairy_heading_font_family = $fairy_google_fonts[$fairy_heading_fonts];
            if (!empty($fairy_heading_font_family)) {
                $fairy_custom_css .= ".editor-post-title__block .editor-post-title__input , .editor-styles-wrapper h1, .editor-styles-wrapper h2, .editor-styles-wrapper h3, .editor-styles-wrapper h4, .editor-styles-wrapper h5, .editor-styles-wrapper h6 { font-family: '{$fairy_heading_font_family}'; }";
            }
        }

        wp_add_inline_style($fairy_google_fonts_enqueue_unique, $fairy_custom_css);
    }

    add_action('enqueue_block_editor_assets', 'fairy_editor_assets');
}