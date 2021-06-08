<?php

    $html_allow = array(
        'a' => array(
            'href' => array(),
            'title' => array(),
            'target' => array(),
            'style' => array(),
            'class' => array(),
        ),
        'br' => array(),
        'em' => array(),
        'strong' => array(),
        'span' => array(
            'class' => array(),
        ),
    );
    /**
     * ReduxFramework Barebones Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "deep_options";

    function webnus_redux_admin_css() {
        wp_dequeue_style( 'redux-admin-css' );
        wp_enqueue_style( 'wn-redux-admin-css', DEEP_CORE_URL . 'admin/theme-options/assets/wn-redux-admin.css', false, DEEP_VERSION );
    }

    add_action( 'redux/page/'.$opt_name.'/enqueue', 'webnus_redux_admin_css' );

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.
    $theme_bg_dir = DEEP_ASSETS_URL . 'images/bgs/';
    $menus  = wp_get_nav_menus();

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'submenu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Theme Options', 'deep' ),
        'page_title'           => esc_html__( 'Theme Options', 'deep' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'wn-admin-welcome',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => 'webnus_theme_options',
        // Page slug used to denote the panel
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!

        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        //'compiler'             => true,

        'hide_expand'           => true,

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'light',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */



    /*
     *
     * ---> START SECTIONS
     *
     */

    $ext_path = DEEP_CORE_DIR . '/admin/theme-options/extensions/';
    Redux::setExtensions( $opt_name, $ext_path );

    /*
     * ---> END ARGUMENTS
     */



    /*
     *
     * ---> START SECTIONS
     *
     */
    $webnus_socials = array (
        'dribbble'      => 'dribbble',
        'facebook'      => 'facebook',
        'flickr'        => 'flickr',
        'foursquare'    => 'foursquare',
        'github'        => 'github',
        'instagram'     => 'instagram',
        'lastfm'        => 'lastfm',
        'linkedin'      => 'linkedin',
        'pinterest'     => 'pinterest',
        'reddit'        => 'reddit',
        'soundcloud'    => 'soundcloud',
        'spotify'       => 'spotify',
        'tumblr'        => 'tumblr',
        'twitter'       => 'twitter',
        'vimeo'         => 'vimeo',
        'vine'          => 'vine',
        'yelp'          => 'yelp',
        'yahoo'         => 'yahoo',
        'youtube'       => 'youtube',
        'wordpress'     => 'wordpress',
        'dropbox'       => 'dropbox',
        'envato'        => 'envato',
        'skype'         => 'skype',
        'rss'           => 'feed',
        'telegram'      => 'telegram',
        'medium'        => 'medium',
    );
    // fab fa-telegram
    $deep_backto_top_arrow = array (
        'icon-arrows-slim-up'           => esc_html__( 'Arrow up 1', 'deep'),
        'icon-arrows-up'                => esc_html__( 'Arrow up 2', 'deep'),
        'icon-arrows-slide-up1'         => esc_html__( 'Arrow up 3', 'deep'),
        'icon-arrows-slide-up2'         => esc_html__( 'Arrow up 4', 'deep'),
        'icon-arrows-square-up'         => esc_html__( 'Arrow up 5', 'deep'),
        'icon-arrows-slim-up-dashed'    => esc_html__( 'Arrow up 6', 'deep'),
        'pe-7s-up-arrow'                => esc_html__( 'Arrow up 7', 'deep'),
        'pe-7s-angle-up'                => esc_html__( 'Arrow up 8', 'deep'),
        'ti-arrow-up'                   => esc_html__( 'Arrow up 9', 'deep'),
        'sl-arrow-up'                   => esc_html__( 'Arrow up 10', 'deep'),
        'sl-arrow-up-circle'            => esc_html__( 'Arrow up 11', 'deep'),
        'wn-fa wn-fa-arrow-up'          => esc_html__( 'Arrow up 12', 'deep'),
        'wn-fa wn-fa-level-up'          => esc_html__( 'Arrow up 13', 'deep'),
        'wn-fa wn-fa-angle-up'          => esc_html__( 'Arrow up 14', 'deep'),
        'wn-fa wn-fa-caret-up'          => esc_html__( 'Arrow up 15', 'deep'),
        'wn-fa wn-fa-arrow-up'          => esc_html__( 'Arrow up 16', 'deep'),
        'wn-fa wn-fa-chevron-up'        => esc_html__( 'Arrow up 17', 'deep'),
        'wn-fa wn-fa-long-arrow-up'     => esc_html__( 'Arrow up 18', 'deep'),
    );
    // SSL VALUE
    $backend_protocol = ( is_ssl() ) ? 'https' : 'http' ;

    $fonts = array (
        'Open Sans,arial,helvatica' => 'Open Sans',
        'BebasRegular,arial,helvatica' => 'Bebas Regular',
        'LeagueGothicRegular,arial,helvatica' => 'League Gothic Regular',
        'Arial,helvetica,sans-serif' => 'Arial',
        'helvetica,sans-serif,arial' => 'Helvatica',
        'sans-serif,arial,helvatica' => 'Sans Serif',
        'verdana,san-serif,helvatica' => 'Verdana' ,
        'custom-font-1' => 'deep_custom_font1',
        'custom-font-2' => 'deep_custom_font2',
        'custom-font-3' => 'deep_custom_font3',
        'typekit-font-1' => 'deep_typekit_font1',
        'typekit-font-2' => 'deep_typekit_font2',
        'typekit-font-3' => 'deep_typekit_font3',
    );

    $keyses = array(
            'a' => array(
                'href' => array(),
                'title' => array(),
                'target' => array(),
                ),
            'br' => array(),
            'em' => array(),
            'strong' => array(),
            'span' => array(
                'class' => array(),
                ),
            );
    // -> START Layout Fields
    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'General', 'deep' ),
        'desc'      => esc_html__( 'Here are general settings of the theme:', 'deep' ),
        'id'        => 'general_opts',
        'icon'      => 'ti-layout',
    ));

    // -> START General Fields
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'General', 'deep' ),
        'id'               => 'header_general_layout',
        'subsection'       => true,
        'fields'            => array(
            array(
                'title'     => esc_html__( 'Responsive', 'deep' ),
                'subtitle'  => esc_html__( 'Disable this option in case you don\'t need a responsive website.', 'deep' ),
                'id'        => 'deep_enable_responsive',
                'type'      => 'switch',
                'default'   => '1',
                'on'        => esc_html__( 'Enabled', 'deep' ),
                'off'       => esc_html__( 'Disabled', 'deep' ),
            ),
            array(
                'title'     => esc_html__( 'Adaptive images', 'deep' ),
                'subtitle'  => esc_html__( 'Automatically adapt your existing website images for mobile devices.', 'deep' ),
                'id'        => 'deep_adaptive_images',
                'type'      => 'switch',
                'default'   => '1',
                'on'        => esc_html__( 'Enabled', 'deep' ),
                'off'       => esc_html__( 'Disabled', 'deep' ),
            ),
            array(
                'title'     => esc_html__( 'Smooth Scroll', 'deep' ),
                'subtitle'  => esc_html__( 'By enabling this option, your page will have smooth scrolling effect.','deep' ),
                'id'        => 'deep_enable_smoothscroll',
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Enabled', 'deep' ),
                'off'       => esc_html__( 'Disabled', 'deep' ),
            ),
            array(
                'title'     => esc_html__( 'Admin Quick Access', 'deep' ),
                'subtitle'  => esc_html__( 'Quick access will be appear in the admin page, Right bottom corner','deep' ),
                'id'        => 'deep_quick_acess',
                'type'      => 'switch',
                'default'   => '1',
                'on'        => esc_html__( 'Enabled', 'deep' ),
                'off'       => esc_html__( 'Disabled', 'deep' ),
            ),
            array(
				'title'		=> esc_html__( 'Custom Favicon', 'deep' ),
				'subtitle'	=> esc_html__( 'An icon that will show in your browser tab near  your websites title.','deep' ),
				'id'		=> 'deep_favicon',
				'type'		=> 'media',
                'url'		=> true,
			),
        ),
    ) );

    // -> START Container Fields
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Container', 'deep' ),
        'id'               => 'header_container_options',
        'subsection'       => true,
        'fields'            => array(
            array(
                'title'     => esc_html__( 'Layout', 'deep' ),
                'subtitle'  => esc_html__( 'Select boxed or wide layout. in Boxed you can set background from "Styling Options > Background".','deep' ),
                'id'        => 'deep_background_layout',
                'type'      => 'button_set',
                'default'   => 'wide',
                'options'   => array(
                    'wide'           => esc_html__( 'Wide', 'deep' ),
                    'boxed-wrap' => esc_html__( 'Boxed', 'deep' ),
                ),
            ),
            array(
                'title'     => esc_html__( 'Wide Container', 'deep' ),
                'subtitle'  => esc_html__( 'Enable this option to have Wide Container in large screen', 'deep' ),
                'id'        => 'deep_wide_screen',
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Enabled', 'deep' ),
                'off'       => esc_html__( 'Disabled', 'deep' ),
                'required'  => array( 'deep_background_layout', '=', 'wide' ),
            ),
            array(
                'title'     => esc_html__( 'Container Width', 'deep' ),
                'subtitle'  => esc_html__( 'You can define the width of the Container in desktop view. ( Example: 1170px )','deep' ),
                'id'        => 'deep_container_width',
                'type'      => 'text',
            ),
            array(
                'title'     => esc_html__( 'Blog Pages Container Width', 'deep' ),
                'subtitle'  => esc_html__( 'Container width for Blog, Archive, Search and Single pages. ( Example: 1090px )','deep' ),
                'id'        => 'deep_blog_container_width',
                'type'      => 'text',
            ),
            array(
                'title'     => esc_html__( 'Mobile Landscape Container Width: 768px', 'deep' ),
                'subtitle'  => esc_html__( 'You can define width of Container in mobile landscape view. ( Example: 680px )','deep' ),
                'id'        => 'deep_mobile_container_width_768',
                'type'      => 'text',
            ),
            array(
                'title'     => esc_html__( 'Mobile Portrait Large Screens Container Width: 480px', 'deep' ),
                'subtitle'  => esc_html__( 'You can define width of Container in mobile portrait large screens view. ( Example: 420px )','deep' ),
                'id'        => 'deep_mobile_container_width_480',
                'type'      => 'text',
            ),
            array(
                'title'     => esc_html__( 'Mobile Portrait Small Screens Container Width: 320px', 'deep' ),
                'subtitle'  => esc_html__( 'You can define width of Container in mobile portrait small screens view. ( Example: 290px )','deep' ),
                'id'        => 'deep_mobile_container_width_320',
                'type'      => 'text',
            ),
        ),
    ) );

    // -> START Page Preloader Fields
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Page Preloader', 'deep' ),
        'id'               => 'page_preloader_options',
        'subsection'       => true,
        'fields'            => array(
            array(
                'title'     => esc_html__( 'Page Preloader', 'deep' ),
                'subtitle'  => esc_html__( 'Add preloader to your website','deep' ),
                'id'        => 'enable_preloader',
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Enabled', 'deep' ),
                'off'       => esc_html__( 'Disabled', 'deep' ),
            ),
            array(
                'title'		=> esc_html__( 'Page Preloader Spinkit Type', 'deep' ),
                'subtitle'  => esc_html__( 'A collection of loading indicators animated with CSS', 'deep' ),
                'id'		=> 'preloader_spinkit',
                'type'		=> 'select',
                'options'	=> array(
                    '1' => esc_html__( 'Type 1', 'deep' ),
					'2' => esc_html__( 'Type 2', 'deep' ),
					'3' => esc_html__( 'Type 3', 'deep' ),
					'4' => esc_html__( 'Type 4', 'deep' ),
					'5' => esc_html__( 'Type 5', 'deep' ),
					'6' => esc_html__( 'Type 6', 'deep' ),
					'7' => esc_html__( 'Type 7', 'deep' ),
					'8' => esc_html__( 'Type 8', 'deep' ),
					'9' => esc_html__( 'Type 9', 'deep' ),
					'10' => esc_html__( 'Type 10', 'deep' ),
					'11' => esc_html__( 'Type 11', 'deep' ),
					'12' => esc_html__( 'Type 12', 'deep' ),
					'13' => esc_html__( 'Type 13', 'deep' ),
                ),
                'default'  => '7',
                'required'  => array( 'enable_preloader', '=', '1' ),
            ),
            array(
                'title'    => esc_html__( 'Page Preloader Logo', 'deep' ),
                'subtitle'  => esc_html__( 'Example Your website LOGO', 'deep' ),
                'type'     => 'media',
                'id'       => 'preloader_logo',
                'required'  => array( 'enable_preloader', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Page Preloader Background Color', 'deep'),
                'subtitle'  => esc_html__( 'Just pick an image for Preloader Background. ', 'deep' ),
                'id'        => 'preloader_bg_color',
                'type'      => 'color',
                'transparent' => false,
                'required'  => array( 'enable_preloader', '=', '1' ),
                'default'   => '#437df9',
            ),
            array(
                'title'     => esc_html__( 'Page Preloader Timeout', 'deep' ),
                'subtitle'  => esc_html__( 'milliseconds', 'deep' ),
                'id'        => 'preloader_bg_timeout',
                'type'      => 'text',
                'required'  => array( 'enable_preloader', '=', '1' ),
            ),
        ),
    ) );

    // -> START Scrollbar Fields
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Scrollbar', 'deep' ),
        'id'               => 'header_scrollbar_options',
        'subsection'       => true,
        'fields'            => array(
            array(
                'title'     => esc_html__( 'Customize Browser Scroll Bar', 'deep' ),
                'subtitle'  => esc_html__( 'You will be able to customize the browser scrollbar by enabling this option', 'deep' ),
                'id'        => 'deep_custom_scrollbar',
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Enabled', 'deep' ),
                'off'       => esc_html__( 'Disabled', 'deep' ),
            ),
            array(
                'title'     => esc_html__('Cursor Color', 'deep'),
                'id'        => 'deep_scrollbar_cursor_color',
                'type'      => 'color',
                'required'  => array( 'deep_custom_scrollbar', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Rail Background', 'deep'),
                'id'        => 'deep_scrollbar_rail_background',
                'type'      => 'color',
                'required'  => array( 'deep_custom_scrollbar', '=', '1' ),
            ),
            array(
                'title'     => esc_html__( '"Hide" Animation', 'deep' ),
                'subtitle'  => esc_html__( 'If you enable this option, scrollbar will be displayed with mouseover on there.', 'deep' ),
                'id'        => 'deep_hide_scrollbar',
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Enabled', 'deep' ),
                'off'       => esc_html__( 'Disabled', 'deep' ),
                'required'  => array( 'deep_custom_scrollbar', '=', '1' ),
            ),
            array(
                'title'         => esc_html__('Scrollbar Width', 'deep'),
                'id'            => 'deep_scrollbar_width',
                'type'          => 'slider',
                'default'       => 10,
                'min'           => 1,
                'step'          => 1,
                'max'           => 20,
                'display_value' => 'text',
                'required'      => array( 'deep_custom_scrollbar', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Inner scrollbar Handle Color', 'deep'),
                'id'        => 'deep_inner_scrollbar_handle_color',
                'type'      => 'color',
                'subtitle' => esc_html__('Change inner scrollbar (WPBakery Page Builder Column) handle color.', 'deep'),
                'required'      => array( 'deep_custom_scrollbar', '=', '1' ),
            ),
        ),
    ) );

    // -> START Back to top Fields
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Back to top Button', 'deep' ),
        'id'               => 'header_backtotop_options',
        'subsection'       => true,
        'fields'            => array(
            array(
                'id'        => 'deep_backto_top',
                'type'      => 'switch',
                'title'     => esc_html__('Back to top button', 'deep'),
                'subtitle'  => esc_html__( 'Back to top Button will show in right bottom of your site', 'deep'),
                'on'        => esc_html__( 'Enabled', 'deep' ),
                'off'       => esc_html__( 'Disabled', 'deep' ),
                'default'   => '0',
            ),
            array(
                'id'       => 'deep_custom_backto_top_icon',
                'type'     => 'switch',
                'title'    => esc_html__('Custom Back to top button', 'deep'),
                'subtitle' => esc_html__('If you select "Disabled", it will show default design for "back to top" button.', 'deep'),
                'on'        => esc_html__( 'Enabled', 'deep' ),
                'off'       => esc_html__( 'Disabled', 'deep' ),
                'default'   => '2',
                'required'  => array( 'deep_backto_top', '=', array('1') ),
            ),
            array(
                'type'      => 'select',
                'id'        => 'deep_backto_top_icon',
                'title'     => esc_html__('Select Desired icon', 'deep'),
                'options'   => $deep_backto_top_arrow,
                'default'   => 'wn-fa wn-fa-caret-up',
                'required'  => array( 'deep_custom_backto_top_icon', '=', array('1') ),
            ),
            array(
                'type'      => 'border',
                'id'        => 'deep_backto_top_border',
                'title'     => esc_html__('Back to top border', 'deep'),
                'compiler'  => true,
                'output'    => array('#scroll-top a'),
                'required'  => array( 'deep_custom_backto_top_icon', '=', array('1') ),
            ),
            array(
                'type'      => 'color_rgba',
                'id'        => 'deep_backto_top_background',
                'title'     => esc_html__('Back to top background', 'deep'),
                'output'    => array(' background-color' => '#scroll-top a' ),
                'required'  => array( 'deep_custom_backto_top_icon', '=', array('1') ),
            ),
            array(
                'type'      => 'color_rgba',
                'id'        => 'deep_backto_top_icon_color',
                'title'     => esc_html__('Back to top Icon color', 'deep'),
                'output'    => array(
                    ' color' => '#scroll-top a i',
                ),
                'required'  => array( 'deep_custom_backto_top_icon', '=', array('1') ),
            ),
            array(
                'type'      => 'color_rgba',
                'id'        => 'deep_backto_top_icon_color_hover',
                'title'     => esc_html__('Hover back to top Icon color', 'deep'),
                'output'    => array(
                    ' color' => '#scroll-top a:hover i',
                ),
                'required'  => array( 'deep_custom_backto_top_icon', '=', array('1') ),
            ),
            array(
                'type'      => 'color_rgba',
                'id'        => 'deep_backto_top_background_hover',
                'title'     => esc_html__('Hover back to top background', 'deep'),
                'output'    => array(
                    ' background-color' => '#scroll-top a:hover',
                    ' border-color' => '#scroll-top a:hover'
                ),
                'required'  => array( 'deep_custom_backto_top_icon', '=', array('1') ),
            ),
            array(
                'id'       => 'deep_backto_top_on_mobile',
                'type'     => 'switch',
                'title'    => esc_html__('Keep Back To Top Button On Mobile', 'deep'),
                'subtitle' => esc_html__('If you select "Enabled", it will show in mobile devices.', 'deep'),
                'on'        => esc_html__( 'Enabled', 'deep' ),
                'off'       => esc_html__( 'Disabled', 'deep' ),
                'default'   => '2',
                'required'  => array( 'deep_backto_top', '=', array('1') ),
            ),
        ),
    ) );
    if ( defined( 'WPCF7_PLUGIN' ) ) {

        Redux::setSection( $opt_name, array(
            'title'            => esc_html__( 'Fast Contact Form', 'deep' ),
            'id'               => 'deep_fast_contact_form_section',
            'subsection'       => true,
            'fields'           => array(
                array(
                    'title'     => esc_html__( 'Fast Contact Form', 'deep' ),
                    'subtitle'  => esc_html__( 'It will show in bottom right corner', 'deep' ),
                    'id'        => 'deep_fast_contact_form',
                    'type'      => 'switch',
                    'default'   => 0,
                    'on'        => esc_html__( 'Show', 'deep' ),
                    'off'       => esc_html__( 'Hide', 'deep' ),
                ),
                array(
                    'title'     => esc_html__( 'Form title', 'deep' ),
                    'id'        => 'deep_fast_contact_form_title',
                    'type'      => 'text',
                    'required'  => array( 'deep_fast_contact_form', '=', '1' ),
                    'placeholder'  => esc_html__( 'Webnus', 'deep' ),
                ),
                array(
                    'title'     => esc_html__( 'Form subtitle', 'deep' ),
                    'id'        => 'deep_fast_contact_form_subtitle',
                    'type'      => 'text',
                    'required'  => array( 'deep_fast_contact_form', '=', '1' ),
                    'placeholder'  => esc_html__( 'Quick contact form', 'deep' ),
                ),
                array(
                    'title'     => esc_html__( 'Forms', 'deep' ),
                    'subtitle'  => esc_html__( 'Please make a contact form with contact form 7', 'deep' ),
                    'id'        => 'deep_fast_contact_form_forms',
                    'type'      => 'select',
                    'data'      => 'posts',
                    'args'      => array(
                        'post_type' => 'wpcf7_contact_form',
                    ),
                    'required'  => array( 'deep_fast_contact_form', '=', '1' ),
                ),
            ),
        ) );

    }

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Toggle Top Area', 'deep' ),
        'id'               => 'toggle_top_area_opts',
        'subsection'       => true,
        'fields'    => array(
            array(
                'title'     => esc_html__( 'Toggle Top Area', 'deep' ),
                'subtitle'  => wp_kses( __( 'It loads a small plus icon to the top right corner of your website. By clicking on it, it opens and shows your content that you set before.<br><br>To add content, Go to appearance > widgest and add your desired widgets to Toggle Top Area Sections widget areas','deep' ), $html_allow ),
                'id'        => 'deep_toggle_toparea_enable',
                'type'      => 'switch',
                'default'   => 0,
                'on'        => esc_html__( 'Show', 'deep' ),
                'off'       => esc_html__( 'Hide', 'deep' ),
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title'             => __( 'White Label', 'deep' ),
        'id'                => 'deep_white_label',
        'subsection'        => true,
        'fields'            => array(
                array(
                    'title'     => esc_html__( 'Deep Label', 'deep' ),
                    'subtitle'  => esc_html__( 'Change all deep words in admin', 'deep' ),
                    'id'        => 'deep_theme_lbl_name',
                    'type'      => 'text',
                ),
                array(
                    'title'     => esc_html__( 'Version number', 'deep' ),
                    'subtitle'  => esc_html__( 'You will be able to change theme version. Example: 1.0.0', 'deep' ),
                    'id'        => 'deep_theme_version',
                    'type'      => 'text',
                ),
                array(
                    'title'     => esc_html__( 'Remove Sub menus', 'deep' ),
                    'subtitle'  => esc_html__( 'Uncheck each sub menu that you don\'t want to display', 'deep' ),
                    'id'        => 'deep_theme_menus',
                    'type'      => 'checkbox',
                    'options'   => array(
                        'importer'      => 'Demo Importer',
                        'plugins'       => 'Plugins',
                        'tutorials'     => 'Tutorials',
                        'performance'   => 'Performance',
                    ),
                    'default'   => array(
                        'importer'      => '0',
                        'plugins'       => '0',
                        'tutorials'     => '0',
                        'performance'   => '0',
                    ),
                ),

                array(
                    'title'     => esc_html__( 'Deep Logo', 'deep' ),
                    'subtitle'  => esc_html__( 'You will able to change dashborad and theme options logo with your own. Recommended size is 160x159', 'deep' ),
                    'id'        => 'deep_theme_admin_logo',
                    'type'      => 'media',
                ),
                array(
                    'title'     => esc_html__( 'Admin Login Logo', 'deep' ),
                    'subtitle'  => esc_html__( 'It belongs to the back-end of your website to log-in to admin panel.', 'deep' ),
                    'id'        => 'deep_admin_login_logo',
                    'type'      => 'media',
                ),
                array(
                    'title'     => esc_html__( 'Custom CSS For admin', 'deep' ),
                    'subtitle'  => esc_html__( 'Any CSS you write here will run in admin.', 'deep' ),
                    'id'        => 'deep_theme_admin_custom_css',
                    'type'      => 'ace_editor',
                    'mode'      => 'css',
                    'theme'     => 'chrome',
                    'full_width'=> true,
                ),
            ),
    ) );

    // -> START Footer Options Fields
    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Footer', 'deep' ),
        'id'        => 'start_footer_opts',
        'icon'      => 'ti-layout-accordion-merged',
    ) );

    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Footer Top Area', 'deep' ),
        'id'        => 'footer_top_area_opts',
        'subsection'=> true,
        'desc'      => 'This options will show before above the footer',
        'fields'    => array(
            array(
                'title'     => esc_html__('Footer Social Bar', 'deep'),
                'subtitle'  => esc_html__('Set in Social Networks Tab.', 'deep'),
                'id'        => 'deep_footer_social_bar',
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Show', 'deep' ),
                'off'       => esc_html__( 'Hide', 'deep' ),
            ),
            array(
                'title'     => esc_html__('Footer Instagram Bar', 'deep'),
                'id'        => 'deep_footer_instagram_bar',
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Show', 'deep' ),
                'off'       => esc_html__( 'Hide', 'deep' ),
            ),
            array(
                'title'     => esc_html__('Instagram Style', 'deep'),
                'subtitle'  => wp_kses( __('you can select style for instagram', 'deep'), $keyses),
                'id'        => 'deep_footer_instagram_style',
                'type'      => 'select',
                'default'   => 'default',
                'options'   => array (
                    'default'     => 'Default',
                    'carousel'    => 'carousel',
                  ),
                'required'  => array( 'deep_footer_instagram_bar', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Instagram Username', 'deep'),
                'subtitle'  => wp_kses( __('Example: webnus.demo', 'deep'), $keyses),
                'id'        => 'deep_footer_instagram_username',
                'type'      => 'text',
                'required'  => array( 'deep_footer_instagram_bar', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Instagram Access Token', 'deep'),
                'subtitle'  => wp_kses( __('Get this information<a target="_blank" href="https://youtu.be/WTBqQQN910A?list=PLlzlPp2QQwz6gB6TJ5UT0EnDGflFRNr8O">here</a>.', 'deep'), $keyses ),
                'id'        => 'deep_footer_instagram_access',
                'type'      => 'text',
                'required'  => array( 'deep_footer_instagram_bar', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Footer Subscribe Bar', 'deep'),
                'id'        => 'deep_footer_subscribe_bar',
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Show', 'deep' ),
                'off'       => esc_html__( 'Hide', 'deep' ),
            ),
            array(
                'title'     => esc_html__('Footer Subscribe Text', 'deep'),
                'id'        => 'deep_footer_subscribe_text',
                'type'      => 'textarea',
                'required'  => array( 'deep_footer_subscribe_bar', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Subscribe Service', 'deep'),
                'subtitle'  => esc_html__('Select desired service', 'deep'),
                'id'        => 'deep_footer_subscribe_type',
                'type'      => 'button_set',
                'default'   => 'FeedBurner',
                'options'   => array(
                    'FeedBurner'    => esc_html__( 'FeedBurner', 'deep' ),
                    'MailChimp'     => esc_html__( 'MailChimp', 'deep' ),
                ),
                'required'  => array( 'deep_footer_subscribe_bar', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Feedburner ID', 'deep'),
                'subtitle'  => wp_kses( __('To find your feedburner id take a look <a href="https://docs.woocommerce.com/document/subscribe-and-connect/#feedburner" target="_blank">here</a>', 'deep'), $html_allow ),
                'id'        => 'deep_footer_feedburner_id',
                'type'      => 'text',
                'required'  => array( 'deep_footer_subscribe_type', '=', 'FeedBurner' ),
            ),
            array(
                'title'     => esc_html__('Mailchimp URL', 'deep'),
                'subtitle'  => wp_kses( __('To find your MailChimp URL ID take a look <a href="https://kb.mailchimp.com/lists/signup-forms/host-your-own-signup-forms" target="_blank">here</a>', 'deep'), $html_allow ),
                'id'        => 'deep_footer_mailchimp_url',
                'type'      => 'text',
                'required'  => array( 'deep_footer_subscribe_type', '=', 'MailChimp' ),
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Footer', 'deep' ),
        'id'        => 'footer_opts',
        'desc'      => esc_html__( 'If you use from footer builder, these options will no longer be displayed here.', 'deep' ),
        'subsection'=> true,
        'fields'    => array(
            array(
                'title'     => esc_html__( 'Footer Columns', 'deep' ),
                'subtitle'  => wp_kses( __( 'Choose among these structures (1column, 2column, 3column and 4column) for your footer section.<br>To filling these column sections you should go to appearance > widget. And put every widget that you want in these sections.','deep'), array( 'br' => array() ) ),
                'id'        => 'deep_footer_columns',
                'type'      => 'image_select',
                'full_width'=> true,
                'default'   => '1',
                'options'  => array(
                    '1' => array(
                        'alt' => esc_html__( 'Footer Layout 1', 'deep' ),
                        'img' => DEEP_ASSETS_URL . 'images/theme-options/footer1.png'
                    ),
                    '2' => array(
                        'alt' => esc_html__( 'Footer Layout 2', 'deep' ),
                        'img' => DEEP_ASSETS_URL . 'images/theme-options/footer2.png'
                    ),
                    '3' => array(
                        'alt' => esc_html__( 'Footer Layout 3', 'deep' ),
                        'img' => DEEP_ASSETS_URL . 'images/theme-options/footer3.png'
                    ),
                    '4' => array(
                        'alt' => esc_html__( 'Footer Layout 4', 'deep' ),
                        'img' => DEEP_ASSETS_URL . 'images/theme-options/footer4.png'
                    ),
                    '5' => array(
                        'alt' => esc_html__( 'Footer Layout 5', 'deep' ),
                        'img' => DEEP_ASSETS_URL . 'images/theme-options/footer5.png'
                    ),
                    '6' => array(
                        'alt' => esc_html__( 'Footer Layout 6', 'deep' ),
                        'img' => DEEP_ASSETS_URL . 'images/theme-options/footer6.png'
                    ),
                ),
                'required'  => array( 'deep_footer_builder_switch', '=', '0' ),
            ),
            array(
                'title'     => esc_html__( 'Footer background color', 'deep' ),
                'subtitle'  => esc_html__( 'Pick a background color', 'deep' ),
                'id'        => 'deep_footer_background_color',
                'type'      => 'color',
                'output'    => array(
                    'background-color' => '#wrap #footer',
                ),
                'required'  => array( 'deep_footer_builder_switch', '=', '0' ),
            ),
            array(
                'title'     => esc_html__( 'Footer Backgruond Color Style', 'deep'),
                'subtitle'     => esc_html__( 'Dark style will change content color to white and background color to dark and light style will change content color to dark and background color to light', 'deep'),
                'id'        => 'deep_footer_color',
                'type'      => 'button_set',
                'default'   => '1',
                'options'   => array(
                    '1' => esc_html__( 'Dark', 'deep' ),
                    '2' => esc_html__( 'Light', 'deep' ),
                ),
                'required'  => array( 'deep_footer_builder_switch', '=', '0' ),
            ),
            array(
                'title'     => esc_html__( 'Footer Background Image', 'deep' ),
                'subtitle'  => esc_html__( 'Please choose an image or insert an image url to use for the footer backgroud.', 'deep' ),
                'id'        => 'deep_footer_background_image',
                'type'      => 'media',
                'url'       => true,
                'required'  => array( 'deep_footer_builder_switch', '=', '0' ),
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Footer Bottom Area', 'deep' ),
        'id'        => 'footer_bottom_area_opts',
        'subsection'=> true,
        'fields'    => array(
            array(
                'title'     => esc_html__( 'Footer Bottom', 'deep' ),
                'subtitle'  => esc_html__( 'This option shows a section below the footer that you can put copyright menu and logo in it.', 'deep' ),
                'id'        => 'deep_footer_bottom_enable',
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Show', 'deep' ),
                'off'       => esc_html__( 'Hide', 'deep' ),
            ),
            array(
                'title'     => esc_html__('Footer bottom background color', 'deep'),
                'subtitle'  => esc_html__('Pick a background color', 'deep'),
                'id'        => 'deep_footer_bottom_background_color',
                'type'      => 'color',
                'required'  => array( 'deep_footer_bottom_enable', '=', '1' ),
                'output'    => array(
                    'background-color' => '#wrap #footer .footbot, #wrap #footer',
                ),
            ),
            array(
                'title'     => esc_html__('Footer Bottom Left Area', 'deep'),
                'id'        => 'deep_footer_bottom_left',
                'type'      => 'button_set',
                'default'   => '5',
                'options'   => array(
                    '1' => esc_html__( 'None', 'deep' ),
                    '2' => esc_html__( 'Logo', 'deep' ),
                    '3' => esc_html__( 'Menu', 'deep' ),
                    '4' => esc_html__( 'Copyright', 'deep' ),
                    '5' => esc_html__( 'Social Icons', 'deep' ),
                ),
                'required'  => array( 'deep_footer_bottom_enable', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Footer Bottom Left Area Align', 'deep'),
                'id'        => 'deep_footer_bottom_left_align',
                'type'      => 'button_set',
                'default'   => 'left',
                'options'   => array(
                    'left'      => esc_html__( 'Left', 'deep' ),
                    'center'    => esc_html__( 'Center', 'deep' ),
                    'right'     => esc_html__( 'Right', 'deep' ),
                ),
                'required'  => array( 'deep_footer_bottom_left', '!=', '1' ),
            ),
            array(
                'title'     => esc_html__('Footer Bottom center Area', 'deep'),
                'id'        => 'deep_footer_bottom_center',
                'type'      => 'button_set',
                'default'   => '4',
                'options'   => array(
                    '1' => esc_html__( 'None', 'deep' ),
                    '2' => esc_html__( 'Logo', 'deep' ),
                    '3' => esc_html__( 'Menu', 'deep' ),
                    '4' => esc_html__( 'Copyright', 'deep' ),
                    '5' => esc_html__( 'Social Icons', 'deep' ),
                ),
                'required'  => array( 'deep_footer_bottom_enable', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Footer Bottom Right Area', 'deep'),
                'id'        => 'deep_footer_bottom_right',
                'type'      => 'button_set',
                'default'   => '2',
                'options'   => array(
                    '1' => esc_html__( 'None', 'deep' ),
                    '2' => esc_html__( 'Logo', 'deep' ),
                    '3' => esc_html__( 'Menu', 'deep' ),
                    '4' => esc_html__( 'Copyright', 'deep' ),
                    '5' => esc_html__( 'Social Icons', 'deep' ),
                ),
                'required'  => array( 'deep_footer_bottom_enable', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Footer Bottom Right Area Align', 'deep'),
                'id'        => 'deep_footer_bottom_right_align',
                'type'      => 'button_set',
                'default'   => 'right',
                'options'   => array(
                    'left'      => esc_html__( 'Left', 'deep' ),
                    'center'    => esc_html__( 'Center', 'deep' ),
                    'right'     => esc_html__( 'Right', 'deep' ),
                ),
                'required'  => array( 'deep_footer_bottom_right', '!=', '1' ),
            ),
            array(
                'title'     => esc_html__('Footer Logo', 'deep'),
                'subtitle'  => esc_html__('Please choose an image file for footer logo.', 'deep'),
                'id'        => 'deep_footer_logo',
                'type'      => 'media',
                'url'       => true,
                'required'  => array( 'deep_footer_bottom_enable', '=', '1' ),
            ),
            array(
                'id'        => 'deep_footer_dynamic_copyright',
                'title'     => esc_html__('Dynamic copyright', 'deep'),
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Enable', 'deep' ),
                'off'       => esc_html__( 'Disable', 'deep' ),
                'required'  => array( 'deep_footer_bottom_enable', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Footer custom copyright', 'deep'),
                'id'        => 'deep_footer_custom_copyright',
                'type'      => 'text',
                'default'   => esc_html__( 'Webnus Studio All Rights Reserved.', 'deep' ),
                'required'  => array( 'deep_footer_dynamic_copyright', '!=', '1' ),
            ),
            array(
                'title'     => esc_html__( 'Footer Menu', 'deep' ),
                'id'        => 'deep_footer_botthom_menu',
                'type'      => 'select',
                'data'      => 'menus',
                'required'  => array( 'deep_footer_bottom_enable', '=', '1' ),
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Footer Builder', 'deep' ),
        'id'        => 'deep_footer_builder_opts',
        'subsection'=> true,
        'fields'    => array(
            array(
                'id'        => 'deep_footer_builder_switch',
                'title'     => __('Enable custom footer', 'deep'),
                'subtitle'  => esc_html__( 'If you Enable this item, other items like footer bottom will be disabled.', 'deep' ),
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Enable', 'deep' ),
                'off'       => esc_html__( 'Disable', 'deep' ),
            ),
            array(
                'title'     => esc_html__( 'Select footer page', 'deep' ),
                'subtitle'  => wp_kses( __( 'First make your footer from footer custom types then select it from here. <a href="https://webnus.net/deep-premium-wordpress-theme-documentation/footer-builder/" target="_blank">More information</a>', 'deep' ), $html_allow ),
                'id'        => 'deep_footer_builder_select',
                'type'      => 'select',
                'data'      => 'post',
                'args' => array('post_type' => 'wbf_footer'),
                'required'  => array( 'deep_footer_builder_switch', '=', '1' ),
            ),
        ),
    ) );

    // -> START Pages Fields
    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Pages', 'deep' ),
        'id'        => 'pages_opts',
        'icon'      => 'sl-docs',
    ) );

    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Page Options', 'deep' ),
        'id'        => 'page_options_opts',
        'subsection'=> true,
        'fields'    => array(
            array(
                'title'     => esc_html__('Sidebar Position', 'deep'),
                'id'        => 'page_sidebar_position',
                'type'      => 'button_set',
                'default'   => 'none',
                'options'   => array(
                    'none'  => esc_html__( 'None', 'deep' ),
                    'left'  => esc_html__( 'Left', 'deep' ),
                    'right' => esc_html__( 'Right', 'deep' ),
                    'both'  => esc_html__( 'Both', 'deep' ),
                ),
            ),
            array(
                'title'     => esc_html__('Transparent Header', 'deep'),
                'id'        => 'page_transparent_dis',
                'type'      => 'button_set',
                'default'   => 'none',
                'options'   => array(
                    'none'    => esc_html__( 'None', 'deep' ),
                    'light'   => esc_html__( 'Light Style', 'deep' ),
                    'dark'    => esc_html__( 'Dark Style', 'deep' ),
                ),
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Page Title', 'deep' ),
        'id'        => 'page_title_opts',
        'subsection'=> true,
        'fields'    => array(
            array(
                'title'     => esc_html__( 'Page Title', 'deep' ),
                'id'        => 'page_title_show',
                'type'      => 'switch',
                'default'   => '1',
                'on'        => esc_html__( 'Show', 'deep' ),
                'off'       => esc_html__( 'Hide', 'deep' ),
            ),
            array(
                'title'         => esc_html__( 'Color', 'deep' ),
                'id'            => 'page_title_color',
                'type'          => 'color',
                'transparent'   => false,
                'required'      => array( 'page_title_show', '=', '1' ),
            ),
            array(
                'title'         => esc_html__( 'Background Color', 'deep' ),
                'id'            => 'page_title_bg_color',
                'type'          => 'color',
                'transparent'   => false,
                'required'      => array( 'page_title_show', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Background Image', 'deep'),
                'id'        => 'page_title_bg_img',
                'type'      => 'media',
                'url'       => true,
                'required'  => array( 'page_title_show', '=', '1' ),
            ),
            array(
                'title'		=> esc_html__( 'Background Image Position', 'deep' ),
                'id'		=> 'page_title_bg_img_po',
                'type'		=> 'select',
                'options'	=> array(
					'top center'	=> esc_attr__( 'Top Center', 'deep' ),
					'top right'		=> esc_attr__( 'Top Right', 'deep' ),
					'top left'		=> esc_attr__( 'Top Left', 'deep' ),
					'center center'	=> esc_attr__( 'Center Center', 'deep' ),
					'bottom center'	=> esc_attr__( 'Bottom Center', 'deep' ),
					'bottom right'	=> esc_attr__( 'Bottom Right', 'deep' ),
					'bottom left'	=> esc_attr__( 'Bottom Left', 'deep' ),
                ),
                'default'  => 'center center',
                'required' => array( 'page_title_show', '=', '1' ),
            ),
            array(
                'title'		=> esc_html__( 'Text-align', 'deep' ),
                'id'		=> 'page_title_textalign',
                'type'		=> 'select',
                'options'	=> array(
					'none'      => esc_html__( 'None', 'deep' ),
					'center'    => esc_html__( 'Center', 'deep' ),
                    'left'      => esc_html__( 'Left', 'deep' ),
					'right'     => esc_html__( 'Right', 'deep' ),
                ),
                'default'  => 'none',
                'required' => array( 'page_title_show', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Font Size', 'deep'),
                'id'        => 'page_title_fontsize',
                'type'      => 'text',
                'subtitle'  => __( 'Example 35px', 'deep' ),
                'required'  => array( 'page_title_show', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Line Height', 'deep'),
                'id'        => 'page_title_lineheight',
                'type'      => 'text',
                'required'  => array( 'page_title_show', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Height', 'deep'),
                'id'        => 'page_title_height',
                'type'      => 'text',
                'subtitle'  => __( 'Example 150px', 'deep' ),
                'required'  => array( 'page_title_show', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Mobile Height', 'deep'),
                'id'        => 'page_title_mobileheight',
                'type'      => 'text',
                'subtitle'  => __( 'Example 150px', 'deep' ),
                'required'  => array( 'page_title_show', '=', '1' ),
            ),
            array(
                'id'             => 'page_title_padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'units'          => array('px', 'em', '%'),
                'units_extended' => 'false',
                'title'          => esc_html__( 'Padding', 'deep' ),
                'desc'           => esc_html__( 'You can use unites format.', 'deep' ),
                'default'        => array(
                    'padding-top'       => '',
                    'padding-right'     => '',
                    'padding-bottom'    => '',
                    'padding-left'      => '',
                    'units'             => 'px',
                ),
                'required'       => array( 'page_title_show', '=', '1' ),
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( '404 Page', 'deep' ),
        'id'        => '404_opts',
        'subsection'=> true,
        'fields'    => array(
            array(
                'id'        => 'deep_404_page_switch',
                'title'     => __('Custom 404 page?', 'deep'),
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Enable', 'deep' ),
                'off'       => esc_html__( 'Disable', 'deep' ),
            ),
            array(
                'title'     => esc_html__( 'Select Custom 404 Page', 'deep' ),
                'subtitle'  => esc_html__( 'Select 404 Page', 'deep' ),
                'id'        => 'deep_404_page',
                'type'      => 'select',
                'data'      => 'page',
                'required'  => array( 'deep_404_page_switch', '=', '1' ),
            ),
            array(
                'title'     => esc_html__( 'Text To Display', 'deep' ),
                'id'        => 'deep_404_text',
                'type'      => 'ace_editor',
                'theme'     => 'chrome',
                'mode'      => 'php',
                'default'   => 'We\'re sorry, but the page you were looking for doesn\'t exist.',
                'full_width'=> true,
                'required'  => array( 'deep_404_page_switch', '=', '0' ),
            ),
            array(
                'title'     => esc_html__('Transparent Header', 'deep'),
                'id'        => 'deep_404_page_header',
                'type'      => 'button_set',
                'default'   => 'none',
                'options'   => array(
                    'none'    => esc_html__( 'None', 'deep' ),
                    'light'   => esc_html__( 'Light Style', 'deep' ),
                    'dark'    => esc_html__( 'Dark Style', 'deep' ),
                ),
            ),
        ),
    ) );


    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Edge Onepager', 'deep' ),
        'id'        => 'edge_opts',
        'subsection'=> true,
        'fields'    => array(
            array(
                'title'     => esc_html__( 'Navigation', 'deep' ),
                'id'        => 'edge_navigation',
                'type'      => 'switch',
                'default'   => '1',
                'on'        => esc_html__( 'Enable', 'deep' ),
                'off'       => esc_html__( 'Disable', 'deep' ),
            ),
            array(
                'title'     => esc_html__( 'loop Bottom', 'deep' ),
                'id'        => 'edge_loopBottom',
                'type'      => 'switch',
                'default'   => '1',
                'on'        => esc_html__( 'Enable', 'deep' ),
                'off'       => esc_html__( 'Disable', 'deep' ),
            ),
            array(
                'title'     => esc_html__( 'loop Top', 'deep' ),
                'id'        => 'edge_loopTop',
                'type'      => 'switch',
                'default'   => '1',
                'on'        => esc_html__( 'Enable', 'deep' ),
                'off'       => esc_html__( 'Disable', 'deep' ),
            ),
            array(
                'title'     => esc_html__('Scroll Speed', 'deep'),
                'id'        => 'edge_scrollingSpeed',
                'type'      => 'slider',
                'default'   => 850,
                'min'       => 100,
                'step'      => 1,
                'max'       => 2000,
                'display_value' => 'text',
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Breadcrumbs', 'deep' ),
        'id'        => 'breadcrumbs_opts',
        'subsection'=> true,
        'fields'    => array(
            array(
                'title'     => esc_html__( 'Breadcrumbs', 'deep' ),
                'subtitle'  => esc_html__( 'It allows users to keep track of their locations within pages.','deep' ),
                'id'        => 'deep_enable_breadcrumbs',
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Show', 'deep' ),
                'off'       => esc_html__( 'Hide', 'deep' ),
            ),
            array(
                'title'     => esc_html__( 'Jetpack Breadcrumbs', 'deep' ),
                'subtitle'  => esc_html__( 'You should install and activate Jetpack plugin to use this option.','deep' ),
                'id'        => 'deep_enable_jetpack_breadcrumbs',
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Show', 'deep' ),
                'off'       => esc_html__( 'Hide', 'deep' ),
            ),
            array(
                'title'     => esc_html__( 'Breadcrumbs in Mobile', 'deep' ),
                'subtitle'  => esc_html__( 'It allows users to keep track of their locations within pages.','deep' ),
                'id'        => 'deep_enable_mobile_breadcrumbs',
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Show', 'deep' ),
                'off'       => esc_html__( 'Hide', 'deep' ),
            ),
            array(
                'title'         => esc_html__( 'Breadcrumbs Typography', 'deep' ),
                'subtitle'      => esc_html__( 'These settings control the typography for all Breadcrumbs links.', 'deep' ),
                'id'            => 'breadcrumbs-typography',
                'type'          => 'typography',
                'all_styles'    => true,
                'letter-spacing'=> true,
                'text-align'    => false,
                'font-style'    => true,
                'font-weight'   => true,
                'word-spacing'  => true,
                'text-transform'=> true,
                'output'        => array( '.breadcrumbs-w a,.breadcrumbs-w span' ),
                'units'         => 'px',
                'fonts'         => $fonts,
                'required'      => array( 'deep_enable_breadcrumbs', '=', '1' ),
            ),
            array(
                'id'             => 'breadcrumbs_padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'units'          => array('px', 'em', '%'),
                'units_extended' => 'false',
                'title'          => esc_html__( 'Breadcrumbs Padding', 'deep' ),
                'desc'           => esc_html__( 'You can use unites format.', 'deep' ),
                'default'        => array(
                    'padding-top'       => '',
                    'padding-right'     => '',
                    'padding-bottom'    => '',
                    'padding-left'      => '',
                    'units'             => 'px',
                ),
                'required'      => array( 'deep_enable_breadcrumbs', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Breadcrumbs Height', 'deep'),
                'id'        => 'breadcrumbs_height',
                'type'      => 'text',
                'subtitle'  => __( 'Example 150px', 'deep' ),
                'required'      => array( 'deep_enable_breadcrumbs', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Mobile Breadcrumbs Height', 'deep'),
                'id'        => 'breadcrumbs_mobileheight',
                'type'      => 'text',
                'subtitle'  => __( 'Example 150px', 'deep' ),
                'required'      => array( 'deep_enable_breadcrumbs', '=', '1' ),
            ),
        ),
    ) );

     Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Search Page', 'deep' ),
        'id'        => 'search_page',
        'subsection'=> true,
        'fields'    => array(
            array(
                'title'     => esc_html__( 'Show featured image in search result ', 'deep' ),
                'id'        => 'featured_img_search',
                'type'      => 'switch',
                'default'   => '1',
                'on'        => esc_html__( 'Show', 'deep' ),
                'off'       => esc_html__( 'Hide', 'deep' ),
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Blog', 'deep' ),
        'id'        => 'blog-opts',
        'icon'      => 'ti-pencil-alt',
    ) );

    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Blog Page', 'deep' ),
        'id'        => 'blog-page-opts',
        'subsection'=> true,
        'fields'    => array(
            array(
                'id'		=> 'deep_blog_template',
                'type'		=> 'select',
                'title'		=> esc_html__( 'Blog Template', 'deep' ),
                'subtitle'	=> esc_html__( 'First please select desired template.', 'deep' ),
                'options'	=> array(
					'1' => 'Default',
					'2' => 'Personal Blog',
					'3' => 'Magazine',
					'4' => 'Minimal',
                ),
                'default'  => '1',
            ),
            array(
                'title'     => esc_html__( 'Blog Template Layout', 'deep' ),
                'subtitle'  => esc_html__( 'For styling your blog page you can choose among these template layouts.', 'deep' ),
                'id'        => 'deep_blog_template_layout',
                'type'      => 'image_select',
                'full_width'=> true,
                'default'   => '1',
                'options'   => array(
                    '1' => array(
                        'alt' => esc_html__( 'Large image style', 'deep' ),
                        'img' => DEEP_ASSETS_URL . 'images/theme-options/blog-type1.png'
                    ),
                    '2' => array(
                        'alt' => esc_html__( 'List style', 'deep' ),
                        'img' => DEEP_ASSETS_URL . 'images/theme-options/blog-type2.png'
                    ),
                    '3' => array(
                        'alt' => esc_html__( '1 Large then list style', 'deep' ),
                        'img' => DEEP_ASSETS_URL . 'images/theme-options/blog-type3.png'
                    ),
                    '4' => array(
                        'alt' => esc_html__( 'Grid style', 'deep' ),
                        'img' => DEEP_ASSETS_URL . 'images/theme-options/blog-type4.png'
                    ),
                    '5' => array(
                        'alt' => esc_html__( '1 Large then grid style', 'deep' ),
                        'img' => DEEP_ASSETS_URL . 'images/theme-options/blog-type5.png'
                    ),
                    '6' => array(
                        'alt' => esc_html__( 'Masonry style', 'deep' ),
                        'img' => DEEP_ASSETS_URL . 'images/theme-options/blog-type6.png'
                    ),
                    '7' => array(
                        'alt' => esc_html__( 'Timeline style', 'deep' ),
                        'img' => DEEP_ASSETS_URL . 'images/theme-options/blog-type7.png'
                    ),
                ),
                'required'  => array( 'deep_blog_template', '!=', '' ),
            ),
            array(
                'title'     => esc_html__('Large-post image size', 'deep'),
                'subtitle'  => esc_html__('This size will be applied to large images. If this option is left empty, the full size will be used for the images.', 'deep'),
                'id'        => 'deep_image_large_dimensions',
                'type'      => 'dimensions',
                'required'  => array(
                    'deep_blog_template', '=', '4'
                ),
            ),
            array(
                'title'     => esc_html__('Blog Sidebar Position', 'deep'),
                'id'        => 'deep_blog_sidebar',
                'type'      => 'button_set',
                'default'   => 'right',
                'options'   => array(
                    'none'  => esc_html__( 'None', 'deep' ),
                    'left'  => esc_html__( 'Left', 'deep' ),
                    'right' => esc_html__( 'Right', 'deep' ),
                    'both'  => esc_html__( 'Both', 'deep' ),
                ),
                'required'  => array(
                    array( 'deep_blog_template_layout', '!=', '6' ),
                    array( 'deep_blog_template_layout', '!=', '7' )
                ),
            ),
            array(
                'title'     => esc_html__('Excerpt Or Full Blog Content', 'deep'),
                'subtitle'  => esc_html__('You can show all the text of your posts in blog page or a fixed amount of characters to show for each post.','deep'),
                'id'        => 'deep_blog_excerptfull_enable',
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Full', 'deep' ),
                'off'       => esc_html__( 'Excerpt', 'deep' ),
            ),
            array(
                'title'     => esc_html__('Excerpt Length for Large Posts', 'deep'),
                'subtitle'  => esc_html__('Type the number of characters you want to show in the blog page for each post.','deep'),
                'id'        => 'deep_blog_excerpt_large',
                'type'      => 'slider',
                'default'   => 93,
                'min'       => 1,
                'step'      => 1,
                'max'       => 400,
                'display_value' => 'text',
                'required'  => array( 'deep_blog_excerptfull_enable', '=', '0' ),
            ),
            array(
                'title'     => esc_html__('Excerpt Length for List, Grid, Timeline & Masonry Posts', 'deep'),
                'subtitle'  => esc_html__('Type the number of characters you want to show in the blog page for each post.','deep'),
                'id'        => 'deep_blog_excerpt_list',
                'type'      => 'slider',
                'default'   => 17,
                'min'       => 1,
                'step'      => 1,
                'max'       => 400,
                'display_value' => 'text',
                'required'  => array( 'deep_blog_excerptfull_enable', '=', '0' ),
            ),
            array(
                'title'     => esc_html__('Blog Page Title', 'deep'),
                'subtitle'  => esc_html__('By hiding this option, blog Page title will  disappear.','deep'),
                'id'        => 'deep_blog_page_title_enable',
                'type'      => 'switch',
                'default'   => '1',
                'on'        => esc_html__( 'Show', 'deep' ),
                'off'       => esc_html__( 'Hide', 'deep' ),
            ),
            array(
                'title'     => esc_html__('Blog Page Title Text', 'deep'),
                'id'        => 'deep_blog_page_title',
                'type'      => 'text',
                'default'   => 'Blog',
                'required'  => array( 'deep_blog_page_title_enable', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Read More Text', 'deep'),
                'subtitle'  => esc_html__('You can set another name instead of read more link.','deep'),
                'id'        => 'deep_blog_readmore_text',
                'type'      => 'text',
                'default'   => 'Continue Reading',
            ),
            array(
                'title'     => esc_html__( 'Featured Image on Blog', 'deep' ),
                'subtitle'  => esc_html__( 'By disabling this option, all blog feature images will disappear.', 'deep' ),
                'id'        => 'deep_blog_featuredimage_enable',
                'type'      => 'switch',
                'default'   => '1',
                'on'        => esc_html__( 'On', 'deep' ),
                'off'       => esc_html__( 'Off', 'deep' ),
            ),
            array(
                'title'     => esc_html__('Default Blank Featured Image', 'deep'),
                'subtitle'  => esc_html__( 'If a post does not have featured image this image will show as featured image', 'deep' ),
                'id'        => 'deep_no_image',
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'On', 'deep' ),
                'off'       => esc_html__( 'Off', 'deep' ),
            ),
            array(
                'title'     => esc_html__('Custom Default Blank Featured Image', 'deep'),
                'id'        => 'deep_no_image_src',
                'type'      => 'media',
                'url'       => true,
                'required'  => array( 'deep_no_image', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Social Share Links', 'deep'),
                'subtitle'  => esc_html__('By enabling this feature your visitors can share the post to social networks such as Facebook, Twitter and...','deep'),
                'id'        => 'deep_blog_index_social_share',
                'type'      => 'switch',
                'on'        => esc_html__( 'On', 'deep' ),
                'off'       => esc_html__( 'Off', 'deep' ),
                'default'   => '1',
            ),
            array(
                'title'     => esc_html__( 'Post Title on Blog', 'deep' ),
                'subtitle'  => esc_html__( 'By disabling this option, all post title images will disappear.','deep' ),
                'id'        => 'deep_blog_posttitle_enable',
                'type'      => 'switch',
                'default'   => '1',
                'on'        => esc_html__( 'On', 'deep' ),
                'off'       => esc_html__( 'Off', 'deep' ),
            ),
        ),
    ) );

      Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Sidebar Options', 'deep' ),
        'id'        => 'sidebar_blog_opts',
        'subsection'=> true,
        'fields'    => array(
            array(
                'title' => esc_html__( 'Sidebar Layout', 'deep' ),
                'id'             => 'deep_sidebar_blog_options',
                'type'           => 'select',
                'default'        => 'default',
                'options'        => array(
                    'default'               => 'Default',
                    'personal-sidebar'      => 'Personal',
                    'magazine-sidebar'      => 'Magazine',
                    'restaurant-sidebar'    => 'Restaurant',
                    'buddypress-sidebar'    => 'Buddypress',
                ),
            ),
            array(
                'title'     => esc_html__( 'Sidebar Size', 'deep' ),
                'subtitle'  => esc_html__( 'You can define the width of your Sidebar. (Note: Size of 40px automatically added as margin. )','deep' ),
                'id'        => 'deep_sidebar_width',
                'type'      => 'text',
                'default'   => '',
            ),
            array(
                'title'          => esc_html__( 'Widgets Custom Box Shadow/Padding/Margin/border', 'deep' ),
                'id'             => 'deep_custom_sidebar_widgets',
                'type'           => 'switch',
                'default'        => '0',
                'on'             => esc_html__( 'Show', 'deep' ),
                'off'            => esc_html__( 'Hide', 'deep' ),
            ),
            array(
                'id'      => 'deep_widgets_box_shadow',
                'type'    => 'box_shadow',
                'title'   => esc_html__('Box Shadow', 'deep'),
                'units'   => array( 'px', 'em', 'rem' ),
                'output'  => ( '.header' ),
                'opacity' => true,
                'rgba'    => true,
                'default' => array (
                    'horizontal'   => '', // can be negative value
                    'vertical'     => '', // can be negative value
                    'blur'         => '',
                    'spread'       => '',
                    'opacity'      => '',
                    'shadow-color' => '',
                    'shadow-type'  => '', // 'inset' or 'outside'
                    'units'        => 'px',
                ),
                'required'       => array( 'deep_custom_sidebar_widgets', '=', '1' ),
            ),
            array(
                'id'             => 'deep_edit_widget_margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'units'          => array( 'px', 'em', '%' ),
                'units_extended' => 'false',
                'title'          => esc_html__( 'Widgets Margin', 'deep' ),
                'subtitle'       => esc_html__( 'Change Widgets Margin. Each one is separate.', 'deep' ),
                'desc'           => esc_html__( 'You can use unites format.', 'deep' ),
                'default'        => array(
                    'margin-top'        => '0',
                    'margin-right'      => '0',
                    'margin-bottom'     => '0',
                    'margin-left'       => '0',
                    'units'             => 'px',
                ),
                'required'       => array( 'deep_custom_sidebar_widgets', '=', '1' ),
            ),
            array(
                'id'             => 'deep_edit_widget_padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'units'          => array('px', 'em', '%'),
                'units_extended' => 'false',
                'title'          => esc_html__( 'Widgets Box Padding', 'deep' ),
                'subtitle'       => esc_html__( 'Change Widgets Padding Each one is separate.', 'deep' ),
                'desc'           => esc_html__( 'You can use unites format.', 'deep' ),
                'default'        => array(
                    'padding-top'       => '0',
                    'padding-right'     => '0',
                    'padding-bottom'    => '0',
                    'padding-left'      => '0',
                    'units'             => 'px',
                ),
                'required'       => array( 'deep_custom_sidebar_widgets', '=', '1' ),
            ),
            array(
                'id'             => 'deep_edit_widget_content_padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'units'          => array('px', 'em', '%'),
                'units_extended' => 'false',
                'title'          => esc_html__( 'Widgets Inner Padding', 'deep' ),
                'subtitle'       => esc_html__( 'Change Widgets inner Content Padding Each one is separate.', 'deep' ),
                'desc'           => esc_html__( 'You can use unites format.', 'deep' ),
                'default'        => array(
                    'padding-top'       => '0',
                    'padding-right'     => '0',
                    'padding-bottom'    => '0',
                    'padding-left'      => '0',
                    'units'             => 'px',
                ),
                'required'       => array( 'deep_custom_sidebar_widgets', '=', '1' ),
            ),
            array(
                'id'       => 'deep_edit_widget_border',
                'type'     => 'border',
                'all'      => '',
                'title'    => __( 'Widget Border', 'deep' ),
                'default'  => array(
                    'border-color'     => '#437df9',
                    'border-style'     => 'none',
                    'border-top'       => '',
                    'border-right'     => '',
                    'border-bottom'    => '',
                    'border-left'      => '',
                    'border-all'       => 'false',
                ),
                'required'       => array( 'deep_custom_sidebar_widgets', '=', '1' ),
            ),
            array(
                'title'     => esc_html__( 'Title Shape', 'deep' ),
                'id'        => 'deep_blog_sidebar_title_shape',
                'type'      => 'image_select',
                'options'   => array(
                    '0' => array(
                        'alt'   => 'Widgets Title 0',
                        'img'   => DEEP_ASSETS_URL . 'images/theme-options/widget-title-0.png',
                        'class' => 'widgets-title',
                    ),
                    '1' => array(
                        'alt'   => 'Widgets Title 1',
                        'img'   => DEEP_ASSETS_URL . 'images/theme-options/widget-title-1.png',
                        'class' => 'widgets-title',
                    ),
                    '2' => array(
                        'alt'   => 'Widgets Title 2',
                        'img'   => DEEP_ASSETS_URL . 'images/theme-options/widget-title-2.png',
                        'class' => 'widgets-title',
                    ),
                    '3' => array(
                        'alt'   => 'Widgets Title 3',
                        'img'   => DEEP_ASSETS_URL . 'images/theme-options/widget-title-3.png',
                        'class' => 'widgets-title',
                    ),
                    '4' => array(
                        'alt'   => 'Widgets Title 4',
                        'img'   => DEEP_ASSETS_URL . 'images/theme-options/widget-title-4.png',
                        'class' => 'widgets-title',
                    ),
                    '5' => array(
                        'alt'   => 'Widgets Title 5',
                        'img'   => DEEP_ASSETS_URL . 'images/theme-options/widget-title-5.png',
                        'class' => 'widgets-title',
                    ),
                ),
                'default'       => '0',
                'full_width'    => true,
            ),
            array(
                'id'             => 'deep_edit_title_margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'units'          => array( 'px', 'em', '%' ),
                'units_extended' => 'false',
                'title'          => esc_html__( 'Widgets Title box Margin', 'deep' ),
                'default'        => array(
                    'margin-top'        => '',
                    'margin-right'      => '',
                    'margin-bottom'     => '',
                    'margin-left'       => '',
                    'units'             => 'px',
                ),
            ),
            array(
                'id'             => 'deep_edit_title_text_margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'units'          => array( 'px', 'em', '%' ),
                'units_extended' => 'false',
                'title'          => esc_html__( 'Widgets Title text Margin', 'deep' ),
                'default'        => array(
                    'margin-top'        => '',
                    'margin-right'      => '',
                    'margin-bottom'     => '',
                    'margin-left'       => '',
                    'units'             => 'px',
                ),
            ),
            array(
                'id'             => 'deep_edit_title_padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'units'          => array( 'px', 'em', '%' ),
                'units_extended' => 'false',
                'title'          => esc_html__( 'Widgets Title Padding', 'deep' ),
                'default'        => array(
                    'padding-top'       => '',
                    'padding-right'     => '',
                    'padding-bottom'    => '',
                    'padding-left'      => '',
                    'units'             => 'px',
                ),
            ),
            array(
                'id'       => 'deep_edit_title_border',
                'type'     => 'border',
                'all'      => '',
                'title'    => __( 'Widgets Title Border', 'deep' ),
                'default'  => array(
                    'border-color'     => '#437df9',
                    'border-style'     => 'none',
                    'border-top'       => '',
                    'border-right'     => '',
                    'border-bottom'    => '',
                    'border-left'      => '',
                    'border-all'       => 'false',
                ),
            ),
            array(
                'title'     => esc_html__('Widgets Title Font Size', 'deep'),
                'subtitle' => __( 'Example 35px', 'deep' ),
                'id'        => 'deep_edit_title_font_size',
                'type'      => 'text',
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Single Blog Page', 'deep' ),
        'id'        => 'single-blog-page-opts',
        'subsection'=> true,
        'fields'    => array(
            array(
                'title'     => esc_html__('Single Post Sidebar Position', 'deep'),
                'id'        => 'deep_blog_singlepost_sidebar',
                'type'      => 'button_set',
                'default'   => 'right',
                'options'   => array(
                    'none'  => esc_html__( 'None', 'deep' ),
                    'left'  => esc_html__( 'Left', 'deep' ),
                    'right' => esc_html__( 'Right', 'deep' ),
                ),
            ),
            array(
                'title'     => esc_html__('Post style', 'deep'),
                'subtitle'  => wp_kses( __( 'examples: <a href="http://deeptem.com/magazine/upcoming-photo-gallery-for-fashion-and-beauty/" target="_blank">Post Show Default</a>, <a href="http://deeptem.com/magazine/music-benefits-for-human-brain-heart-and-health/" target="_blank">Post Show 1</a>, <a href="http://deeptem.com/magazine/all-we-expect-from-a-high-quality-travel/" target="_blank">Post Show 2</a>, <a href="http://deeptem.com/magazine/popular-models-and-the-top-ranked-women-in-2017/" target="_blank">Post Show 3</a>, <a href="http://deeptem.com/minimal-blog/music-can-change-the-world-as-it-change-people/" target="_blank">Post Show 5</a> ', 'deep'), $html_allow ),
                'id'        => 'deep_blog_single_post_style',
                'type'      => 'button_set',
                'default'   => 'postshow0',
                'options'   => array(
                    'postshow0' => esc_html__( 'Post Show Default', 'deep' ),
                    'postshow1' => esc_html__( 'Post Show 1', 'deep' ),
                    'postshow2' => esc_html__( 'Post Show 2', 'deep' ),
                    'postshow3' => esc_html__( 'Post Show 3', 'deep' ),
                    'postshow4' => esc_html__( 'Post Show 4', 'deep' ),
                    'postshow5' => esc_html__( 'Post Show 5', 'deep' ),
                ),
                'full_width'    => true,
            ),
            array(
                'title'     => esc_html__('Style of Recommended Posts', 'deep'),
                'id'        => 'deep_blog_single_rec_posts',
                'type'      => 'button_set',
                'default'   => 'type1',
                'options'   => array(
                    'type1' => esc_html__( 'Default Style', 'deep' ),
                    'type2' => esc_html__( 'Magazine Style', 'deep' ),
                    'type3' => esc_html__( 'Personal Blog Style', 'deep' ),
                ),
            ),
            array(
                'title'     => esc_html__('Featured Image on Single Post', 'deep'),
                'title'     => esc_html__('Featured Image on Single Post', 'deep'),
                'id'        => 'deep_blog_sinlge_featuredimage_enable',
                'type'      => 'switch',
                'on'        => esc_html__( 'On', 'deep' ),
                'off'       => esc_html__( 'Off', 'deep' ),
                'default'   => '1',
            ),
            array(
                'title'     => esc_html__('Next and previous post', 'deep'),
                'subtitle'  => esc_html__('Add navigation to go next or previous post in single post', 'deep'),
                'id'        => 'deep_next_prev_post',
                'type'      => 'switch',
                'on'        => esc_html__( 'On', 'deep' ),
                'off'       => esc_html__( 'Off', 'deep' ),
                'default'   => '1',
            ),
            array(
                'title'     => esc_html__('Social Share Links', 'deep'),
                'subtitle'  => esc_html__('By enabling this feature your visitors can share the post to social networks such as Facebook, Twitter and...','deep'),
                'id'        => 'deep_blog_social_share',
                'type'      => 'switch',
                'on'        => esc_html__( 'On', 'deep' ),
                'off'       => esc_html__( 'Off', 'deep' ),
                'default'   => '1',
            ),
            array(
                'title'     => esc_html__( 'Social share layout', 'deep' ),
                'id'        => 'deep_social_share_layout',
                'type'      => 'image_select',
                'full_width'=> true,
                'default'   => '1',
                'options'   => array(
                    '1' => array(
                        'alt' => esc_html__( 'Social Share Layout 1', 'deep' ),
                        'img' => DEEP_ASSETS_URL . 'images/theme-options/social-layout-1.png'
                    ),
                    '2' => array(
                        'alt' => esc_html__( 'Social Share Layout 2', 'deep' ),
                        'img' => DEEP_ASSETS_URL . 'images/theme-options/social-layout-2.png'
                    ),
                    '3' => array(
                        'alt' => esc_html__( 'Social Share Layout 3', 'deep' ),
                        'img' => DEEP_ASSETS_URL . 'images/theme-options/social-layout-3.png'
                    ),
                    '4' => array(
                        'alt' => esc_html__( 'Social Share Layout 4', 'deep' ),
                        'img' => DEEP_ASSETS_URL . 'images/theme-options/social-layout-4.png'
                    ),
                    '5' => array(
                        'alt' => esc_html__( 'Social Share Layout 5', 'deep' ),
                        'img' => DEEP_ASSETS_URL . 'images/theme-options/social-layout-5.png'
                    ),
                ),
                'required'  => array( 'deep_blog_social_share', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Single post author box', 'deep'),
                'subtitle'  => esc_html__('This feature shows a picture of post author and their info.','deep'),
                'id'        => 'deep_blog_single_authorbox_enable',
                'type'      => 'switch',
                'on'        => esc_html__( 'On', 'deep' ),
                'off'       => esc_html__( 'Off', 'deep' ),
                'default'   => '0',
            ),
            array(
                'title'     => esc_html__( 'Select author box Layout', 'deep' ),
                'id'        => 'deep_authorbox_sec_type',
                'type'      => 'image_select',
                'options'   => array(
                    '0' => array(
                        'alt'   => 'Author Box Type 1',
                        'img'   => DEEP_ASSETS_URL . 'images/theme-options/author-type1.png',
                        'class' => 'header-select-image',
                    ),
                    '1' => array(
                        'alt'   => 'Author Box Type 2',
                        'img'   => DEEP_ASSETS_URL . 'images/theme-options/author-type2.png',
                        'class' => 'header-select-image',
                    ),
                ),
                'default'       => '0',
                'full_width'    => true,
                'required'  => array( 'deep_blog_single_authorbox_enable', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Recommended Posts', 'deep'),
                'subtitle'  => esc_html__('This feature recommends related posts to visitors.','deep'),
                'id'        => 'deep_recommended_posts',
                'type'      => 'switch',
                'on'        => esc_html__( 'On', 'deep' ),
                'off'       => esc_html__( 'Off', 'deep' ),
                'default'   => '1',
            ),
            array(
                'title'     => esc_html__('Google AdSense', 'deep'),
                'subtitle'  => esc_html__('Write down Google AdSense code in the following field.','deep'),
                'id'        => 'deep_google_ads',
                'type'      => 'ace_editor',
            ),
            array(
                'title'     => esc_html__('Show AdSense after post.', 'deep'),
                'id'        => 'deep_ads_after',
                'type'      => 'switch',
                'on'        => esc_html__( 'On', 'deep' ),
                'off'       => esc_html__( 'Off', 'deep' ),
                'default'   => '0',
            ),
            array(
                'title'     => esc_html__('Show AdSense before post.', 'deep'),
                'id'        => 'deep_ads_before',
                'type'      => 'switch',
                'on'        => esc_html__( 'On', 'deep' ),
                'off'       => esc_html__( 'Off', 'deep' ),
                'default'   => '0',
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Post Metadata', 'deep' ),
        'id'        => 'post-meta-opts',
        'subsection'=> true,
        'fields'    => array(
            array(
                'title'         => esc_html__('Post author', 'deep'),
                'id'            => 'deep_blog_meta_author_enable',
                'type'          => 'switch',
                'on'            => esc_html__( 'On', 'deep' ),
                'off'           => esc_html__( 'Off', 'deep' ),
                'default'       => '1'
            ),
            array(
                'title'         => esc_html__('Author Gravatar', 'deep'),
                'subtitle'      => wp_kses ( __('Author Gravatar. <a href="https://en.gravatar.com/" target="_blank">Create account</a>', 'deep'), $html_allow ),
                'id'            => 'deep_blog_meta_gravatar_enable',
                'type'          => 'switch',
                'on'            => esc_html__( 'On', 'deep' ),
                'off'           => esc_html__( 'Off', 'deep' ),
                'default'       => '1',
                'required'      => array( 'deep_blog_meta_author_enable', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Post Publish Date', 'deep'),
                'id'        => 'deep_blog_meta_date_enable',
                'type'      => 'switch',
                'on'        => esc_html__( 'On', 'deep' ),
                'off'       => esc_html__( 'Off', 'deep' ),
                'default'   => '1'
            ),
            array(
                'id'        => 'deep_blog_meta_category_enable',
                'type'      => 'switch',
                'title'     => esc_html__('Post Category', 'deep'),
                'on'        => esc_html__( 'On', 'deep' ),
                'off'       => esc_html__( 'Off', 'deep' ),
                'default'   => '1'
            ),
            array(
                'id'        => 'deep_blog_meta_comments_enable',
                'type'      => 'switch',
                'title'     => esc_html__('Post Comments Count', 'deep'),
                'on'        => esc_html__( 'On', 'deep' ),
                'off'       => esc_html__( 'Off', 'deep' ),
                'default'   => '1'
            ),
            array(
                'id'        => 'deep_blog_meta_views_enable',
                'type'      => 'switch',
                'title'     => esc_html__('Post Views Count', 'deep'),
                'on'        => esc_html__( 'On', 'deep' ),
                'off'       => esc_html__( 'Off', 'deep' ),
                'default'   => '0'
            ),
        ),
    ) );


    // -> START Styling Options Fields
    Redux::setSection( $opt_name, array(
    'title'     => __( 'Styling', 'deep' ),
    'id'        => 'styling_opts',
    'icon'      => 'ti-palette',
    ));

    Redux::setSection( $opt_name, array(
    'title'         => __( 'Background', 'deep' ),
    'id'            => 'background_opts',
    'desc'      => esc_html__('Background shows in Boxed layout. you can select layout in "Layout" tab.', 'deep'),
    'subsection'    => true,
    'fields'        => array(
        array(
            'title'     => esc_html__( 'Body Background', 'deep' ),
            'id'        => 'deep_background',
            'type'      => 'background',
            'output'    => array( 'body' ),
        ),

        array(
            'title'     => esc_html__( 'Background Pattern', 'deep' ),
            'id'        => 'deep_background_pattern',
            'type'      => 'image_select',
            'options'   => array(
                'none'  => array('alt' => 'None','img' => $theme_bg_dir.'none.jpg',),
                $theme_bg_dir.'bdbg1.png'               => array('alt'  => 'Default BG', 'img'      => $theme_bg_dir.'bdbg1.png',),
                $theme_bg_dir.'gray-jean.png'           => array('alt'  => 'Gray Jean', 'img'       => $theme_bg_dir.'gray-jean.png',),
                $theme_bg_dir.'light-wool.png'          => array('alt'  => 'Light Wool', 'img'      => $theme_bg_dir.'light-wool.png',),
                $theme_bg_dir.'subtle_freckles.png'     => array('alt'  => 'Subtle Freckles','img'  =>$theme_bg_dir.'subtle_freckles.png',),
                $theme_bg_dir.'subtle_freckles2.png'    => array('alt'  => 'Subtle Freckles 2','img'    =>$theme_bg_dir.'subtle_freckles2.png',),
                $theme_bg_dir.'green-fibers.png'        => array('alt'  => 'Green Fibers', 'img'    => $theme_bg_dir.'green-fibers.png',),
                $theme_bg_dir.'dust.png'                => array('alt'  => 'Dust', 'img'            => $theme_bg_dir.'dust.png',),
            ),
            'height'    => '64',
        ),
    ),
    ));

    Redux::setSection( $opt_name, array(
    'title'            => __( 'Colors', 'deep' ),
    'id'               => 'colors_opts',
    'subsection'       => true,
    'fields'           => array(
        array(
            'title'     => esc_html__( 'Choose Color Skin', 'deep' ),
            'subtitle'  => esc_html__( 'Select Predefiend or Custom Color.' , 'deep' ),
            'id'        => 'deep_color_skin_type',
            'type'      => 'button_set',
            'default'   => 'predefined',
            'options'   => array(
                'predefined'    => esc_html__( 'Predefined', 'deep' ),
                'custom'        => esc_html__( 'Custom', 'deep' ),
            ),
        ),
        array(
            'title'     => esc_html__( 'Predefined Color Skin', 'deep' ),
            'id'        => 'deep_color_skin',
            'type'      => 'palette',
            'class'     => 'w-p-colorskin',
            'default'   => 'e3e3e3',
            'palettes'  => array(
                'e3e3e3'    => array( '#e3e3e3' ),
                '1bbc9b'    => array( '#1bbc9b' ),
                '0093d0'    => array( '#0093d0' ),
                'e53f51'    => array( '#e53f51' ),
                'f1c40f'    => array( '#f1c40f' ),
                'e64883'    => array( '#e64883' ),
                '45ab48'    => array( '#45ab48' ),
                '9661ab'    => array( '#9661ab' ),
                '0aad80'    => array( '#0aad80' ),
                '03acdc'    => array( '#03acdc' ),
                'ff5a00'    => array( '#ff5a00' ),
                'c3512f'    => array( '#c3512f' ),
                '55606e'    => array( '#55606e' ),
                'fe8178'    => array( '#fe8178' ),
                '7c6853'    => array( '#7c6853' ),
                'bed431'    => array( '#bed431' ),
                '2d5c88'    => array( '#2d5c88' ),
                '76dd56'    => array( '#76dd56' ),
                '2997ab'    => array( '#2997ab' ),
                '734854'    => array( '#734854' ),
                'a81010'    => array( '#a81010' ),
            ),
            'required'      => array( 'deep_color_skin_type', '=', 'predefined' ),

        ),

        array(
            'id'            => 'deep_custom_color_skin',
            'type'          => 'color',
            'title'         => esc_html__('Choose Color ', 'deep'),
            'subtitle'      => esc_html__('Choose your desired color scheme.', 'deep'),
            'transparent'   => false,
            'required'      => array( 'deep_color_skin_type', '=', 'custom' ),
        ),
        array(
            'id'        => 'deep_link_color',
            'type'      => 'link_color',
            'title'     => esc_html__('Links Color', 'deep'),
            'active'    => false,
            'visited'   => true,
            'output'    => array( '.wn-wrap div a, .wn-wrap div a' ),
        ),
        array(
            'title'         => esc_html__( 'Selection Color', 'deep' ),
            'subtitle' 		=> esc_html__('You can set a custom color for selected items.', 'deep'),
            'id'            => 'selection_color',
            'type'          => 'color',
            'active'        => false,
            'transparent'   => false,
        ),
        array(
            'title'         => esc_html__( 'Selection Background', 'deep' ),
            'subtitle' 		=> esc_html__('You can set a custom background color for selected items.', 'deep'),
            'id'            => 'selection_bg',
            'type'          => 'color',
            'active'        => false,
            'transparent'   => false,
        ),
    )));

    // -> START Typography Fields
    Redux::setSection( $opt_name, array(
        'title'             => esc_html__( 'Typography', 'deep' ),
        'id'                => 'typography_opts',
        'icon'              => 'ti-smallcap',
    ));

    Redux::setSection( $opt_name, array(
        'title'             => esc_html__( 'Body Typography', 'deep' ),
        'id'                => 'body_typography_opts',
        'subsection'        => true,
        'fields'            => array(
            array(
                'title'     => esc_html__('Enabel default google fonts', 'deep'),
                'id'        => 'rm_cs_font',
                'type'      => 'switch',
                'default'   => true,
                'on'        => esc_html__( 'On', 'deep' ),
                'off'       => esc_html__( 'Off', 'deep' ),
            ),
            array(
                'title'         => esc_html__( 'Body Typography', 'deep' ),
                'subtitle'      => esc_html__( 'These settings control the typography for all body text.', 'deep' ),
                'id'            => 'body-typography',
                'type'          => 'typography',
                'all_styles'    => true,
                'letter-spacing'=> true,
                'font-style'    => true,
                'font-weight'   => true,
                'word-spacing'  => true,
                'text-transform'=> true,
                'units'         => 'px',
                'fonts' => $fonts,
            ),
        ),
    ));

    Redux::setSection( $opt_name, array(
        'title'             => esc_html__( 'Paragraph Typography', 'deep' ),
        'id'                => 'p_typography_opts',
        'subsection'        => true,
        'fields'            => array(
            array(
                'title'         => esc_html__( '(P) Paragraph Typography', 'deep' ),
                'subtitle'      => esc_html__( 'These settings control the typography for all (P) Paragraph.', 'deep' ),
                'id'            => 'p-typography',
                'type'          => 'typography',
                'all_styles'    => true,
                'letter-spacing'=> true,
                'font-style'    => true,
                'font-weight'   => true,
                'word-spacing'  => true,
                'text-transform'=> true,
                'units'         => 'px',
                'fonts' => $fonts,
            ),
        ),
    ));

    Redux::setSection( $opt_name, array(
        'title'             => esc_html__( 'Headings Typography', 'deep' ),
        'id'                => 'h_typography_opts',
        'subsection'        => true,
        'fields'            => array(
            array(
                'title'         => esc_html__( 'All Headings Typography', 'deep' ),
                'subtitle'      => esc_html__( 'These settings control the typography for all headings.', 'deep' ),
                'id'            => 'all-h-typography',
                'type'          => 'typography',
                'all_styles'    => true,
                'letter-spacing'=> true,
                'font-weight'   => true,
                'word-spacing'  => true,
                'text-transform'=> true,
                'font-size'     => true,
                'line-height'   => true,
                'text-align'    => true,
                'color'         => true,
                'units'         => 'px',
                'fonts'         => $fonts,
            ),
            array(
                'title'         => esc_html__( '(H1) Headings Typography', 'deep' ),
                'subtitle'      => esc_html__( 'These settings control the typography for all H1 Headings.', 'deep' ),
                'id'            => 'h1-typography',
                'type'          => 'typography',
                'all_styles'    => true,
                'letter-spacing'=> true,
                'font-style'    => true,
                'font-weight'   => true,
                'font-style'    => true,
                'font-weight'   => true,
                'word-spacing'  => true,
                'text-transform'=> true,
                'units'         => 'px',
                'fonts'         => $fonts,
            ),
            array(
                'title'         => esc_html__( '(H2) Headings Typography', 'deep' ),
                'subtitle'      => esc_html__( 'These settings control the typography for all H2 Headings.', 'deep' ),
                'id'            => 'h2-typography',
                'type'          => 'typography',
                'all_styles'    => true,
                'letter-spacing'=> true,
                'font-style'    => true,
                'font-weight'   => true,
                'font-style'    => true,
                'font-weight'   => true,
                'word-spacing'  => true,
                'text-transform'=> true,
                'units'         => 'px',
                'fonts'         => $fonts,
            ),
            array(
                'title'         => esc_html__( '(H3) Headings Typography', 'deep' ),
                'subtitle'      => esc_html__( 'These settings control the typography for all H3 Headings.', 'deep' ),
                'id'            => 'h3-typography',
                'type'          => 'typography',
                'all_styles'    => true,
                'letter-spacing'=> true,
                'font-style'    => true,
                'font-weight'   => true,
                'font-style'    => true,
                'font-weight'   => true,
                'word-spacing'  => true,
                'text-transform'=> true,
                'units'         => 'px',
                'fonts'         => $fonts,
            ),
            array(
                'title'         => esc_html__( '(H4) Headings Typography', 'deep' ),
                'subtitle'      => esc_html__( 'These settings control the typography for all H4 Headings.', 'deep' ),
                'id'            => 'h4-typography',
                'type'          => 'typography',
                'all_styles'    => true,
                'letter-spacing'=> true,
                'font-style'    => true,
                'font-weight'   => true,
                'font-style'    => true,
                'font-weight'   => true,
                'word-spacing'  => true,
                'text-transform'=> true,
                'units'         => 'px',
                'fonts'         => $fonts,
            ),
            array(
                'title'         => esc_html__( '(H5) Headings Typography', 'deep' ),
                'subtitle'      => esc_html__( 'These settings control the typography for all H5 Headings.', 'deep' ),
                'id'            => 'h5-typography',
                'type'          => 'typography',
                'all_styles'    => true,
                'letter-spacing'=> true,
                'font-style'    => true,
                'font-weight'   => true,
                'font-style'    => true,
                'font-weight'   => true,
                'word-spacing'  => true,
                'text-transform'=> true,
                'units'         => 'px',
                'fonts'         => $fonts,
            ),
            array(
                'title'         => esc_html__( '(H6) Headings Typography', 'deep' ),
                'subtitle'      => esc_html__( 'These settings control the typography for all H6 Headings.', 'deep' ),
                'id'            => 'h6-typography',
                'type'          => 'typography',
                'all_styles'    => true,
                'letter-spacing'=> true,
                'font-style'    => true,
                'font-weight'   => true,
                'font-style'    => true,
                'font-weight'   => true,
                'word-spacing'  => true,
                'text-transform'=> true,
                'units'         => 'px',
                'fonts'         => $fonts,
            ),
        ),
    ));

    Redux::setSection( $opt_name, array(
        'title'             => esc_html__( 'Menu Typography', 'deep' ),
        'id'                => 'menu_typography_opts',
        'subsection'        => true,
        'fields'            => array(
            array(
                'title'         => esc_html__( 'Menu Typography', 'deep' ),
                'subtitle'      => esc_html__( 'These settings control the typography for all Menu.', 'deep' ),
                'id'            => 'menu-typography',
                'type'          => 'typography',
                'all_styles'    => true,
                'letter-spacing'=> true,
                'font-style'    => true,
                'font-weight'   => true,
                'font-style'    => true,
                'font-weight'   => true,
                'word-spacing'  => true,
                'text-transform'=> true,
                'units'         => 'px',
                'fonts' => $fonts,
            ),
            array(
                'title'         => esc_html__( 'Sub Menu Typography', 'deep' ),
                'subtitle'      => esc_html__( 'These settings control the typography for all Sub Menus.', 'deep' ),
                'id'            => 'sub-menu-typography',
                'type'          => 'typography',
                'all_styles'    => true,
                'letter-spacing'=> true,
                'font-style'    => true,
                'font-weight'   => true,
                'font-style'    => true,
                'font-weight'   => true,
                'word-spacing'  => true,
                'text-transform'=> true,
                'units'         => 'px',
                'fonts'         => $fonts,
            ),
        ),
    ));

    Redux::setSection( $opt_name, array(
        'title'             => esc_html__( 'Blog Typography', 'deep' ),
        'id'                => 'blog_typography_opts',
        'subsection'        => true,
        'fields'            => array(
            array(
                'title'         => esc_html__( 'Post Title Typography In Blog Page', 'deep' ),
                'subtitle'      => esc_html__( 'These settings control the typography for all Post Titles.', 'deep' ),
                'id'            => 'post-title-typography',
                'type'          => 'typography',
                'all_styles'    => true,
                'letter-spacing'=> true,
                'font-style'    => true,
                'font-weight'   => true,
                'font-style'    => true,
                'font-weight'   => true,
                'word-spacing'  => true,
                'text-transform'=> true,
                'units'         => 'px',
                'fonts' => $fonts,
            ),
            array(
                'title'         => esc_html__( 'Post Title Typography in Single Blog Page', 'deep' ),
                'subtitle'      => esc_html__( 'These settings control the typography for all Post Titles.', 'deep' ),
                'id'            => 'single-post-title-typography',
                'type'          => 'typography',
                'all_styles'    => true,
                'letter-spacing'=> true,
                'font-style'    => true,
                'font-weight'   => true,
                'font-style'    => true,
                'font-weight'   => true,
                'word-spacing'  => true,
                'text-transform'=> true,
                'units'         => 'px',
                'fonts' => $fonts,
            ),
        ),
    ));

    Redux::setSection( $opt_name, array(
        'title'             => esc_html__( 'Custom Fonts', 'deep' ),
        'id'                => 'custom_fonts_opts',
        'desc'              => esc_html__( 'After uploading your fonts, you should select font family (custom-font-1/custom-font-2/custom-font-3) from dropdown list in (Body/Paragraph/Headings/Menu/Blog) Typography section.', 'deep' ),
        'subsection'        => true,
        'fields'            => array(
            array(
                'title'     => esc_html__( 'Custom Font1', 'deep' ),
                'subtitle'  => esc_html__( 'Please Enable this option to use Custom Font 1.', 'deep' ),
                'id'        => 'deep_custom_font1',
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Enabled', 'deep' ),
                'off'       => esc_html__( 'Disabled', 'deep' ),
            ),
            array(
                'title'     => esc_html__( 'Custom font 1 .woff', 'deep' ),
                'id'        => 'deep_custom_font1_woff',
                'type'      => 'media',
                'mode'       => false,
                'preview'  => false,
                'url'       => true,
                'required'  => array( 'deep_custom_font1', '=', '1' ),
            ),
            array(
                'title'     => esc_html__( 'Custom font 1 .ttf', 'deep' ),
                'id'        => 'deep_custom_font1_ttf',
                'type'      => 'media',
                'mode'      => false,
                'preview'   => false,
                'url'       => true,
                'required'  => array( 'deep_custom_font1', '=', '1' ),
            ),
            array(
                'title'     => esc_html__( 'Custom font 1 .eot', 'deep' ),
                'id'        => 'deep_custom_font1_eot',
                'type'      => 'media',
                'mode'      => false,
                'preview'   => false,
                'url'       => true,
                'required'  => array( 'deep_custom_font1', '=', '1' ),
            ),

            array(
                'title'     => esc_html__( 'Custom Font2', 'deep' ),
                'subtitle'  => esc_html__( 'Please Enable this option to use Custom Font 2', 'deep' ),
                'id'        => 'deep_custom_font2',
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Enabled', 'deep' ),
                'off'       => esc_html__( 'Disabled', 'deep' ),
            ),
            array(
                'title'     => esc_html__( 'Custom font 2 .woff', 'deep' ),
                'id'        => 'deep_custom_font2_woff',
                'type'      => 'media',
                'mode'      => false,
                'preview'   => false,
                'url'       => true,
                'required'  => array( 'deep_custom_font2', '=', '1' ),
            ),
            array(
                'title'     => esc_html__( 'Custom font 2 .ttf', 'deep' ),
                'id'        => 'deep_custom_font2_ttf',
                'type'      => 'media',
                'mode'      => false,
                'preview'   => false,
                'url'       => true,
                'required'  => array( 'deep_custom_font2', '=', '1' ),
            ),
            array(
                'title'     => esc_html__( 'Custom font 2 .eot', 'deep' ),
                'id'        => 'deep_custom_font2_eot',
                'type'      => 'media',
                'mode'      => false,
                'preview'   => false,
                'url'       => true,
                'required'  => array( 'deep_custom_font2', '=', '1' ),
            ),

            array(
                'title'     => esc_html__( 'Custom Font3', 'deep' ),
                'subtitle'  => esc_html__( 'Please Enable this option to use Custom Font 3', 'deep' ),
                'id'        => 'deep_custom_font3',
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Enabled', 'deep' ),
                'off'       => esc_html__( 'Disabled', 'deep' ),
            ),
            array(
                'title'     => esc_html__( 'Custom font 3 .woff', 'deep' ),
                'id'        => 'deep_custom_font3_woff',
                'type'      => 'media',
                'mode'      => false,
                'preview'   => false,
                'url'       => true,
                'required'  => array( 'deep_custom_font3', '=', '1' ),
            ),
            array(
                'title'     => esc_html__( 'Custom font 3 .ttf', 'deep' ),
                'id'        => 'deep_custom_font3_ttf',
                'type'      => 'media',
                'mode'      => false,
                'preview'   => false,
                'url'       => true,
                'required'  => array( 'deep_custom_font3', '=', '1' ),
            ),
            array(
                'title'     => esc_html__( 'Custom font 3 .eot', 'deep' ),
                'id'        => 'deep_custom_font3_eot',
                'type'      => 'media',
                'mode'      => false,
                'preview'   => false,
                'url'       => true,
                'required'  => array( 'deep_custom_font3', '=', '1' ),
            ),
        ),
    ));

    Redux::setSection( $opt_name, array(
        'title'             => esc_html__( 'Adobe Typekit', 'deep' ),
        'id'                => 'adobe_typekit_opts',
        'desc'              => esc_html__( 'After completing below settings, you should select font family (typekit-font-1/typekit-font-2/typekit-font-3) from dropdown list in (Body/Paragraph/Headings/Menu/Blog) Typography section', 'deep' ),
        'subsection'        => true,
        'fields'            => array(
            array(
                'title'     => esc_html__( 'Adobe Typekit', 'deep' ),
                'subtitle'  => esc_html__( 'Please Enable this option to use Adobe Typekit.', 'deep' ),
                'id'        => 'deep_adobe_typekit',
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Enabled', 'deep' ),
                'off'       => esc_html__( 'Disabled', 'deep' ),
            ),
            array(
                'title'     => esc_html__('Typekit Kit ID', 'deep'),
                'id'        => 'deep_typekit_id',
                'type'      => 'text',
                'required'  => array( 'deep_adobe_typekit', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Typekit Font Family 1', 'deep'),
                'id'        => 'deep_typekit_font1',
                'type'      => 'text',
                'required'  => array( 'deep_adobe_typekit', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Typekit Font Family 2', 'deep'),
                'id'        => 'deep_typekit_font2',
                'type'      => 'text',
                'required'  => array( 'deep_adobe_typekit', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Typekit Font Family 3', 'deep'),
                'id'        => 'deep_typekit_font3',
                'type'      => 'text',
                'required'  => array( 'deep_adobe_typekit', '=', '1' ),
            ),

        ),
    ));

    // -> START Recipe Fields
    if ( defined( 'RECIPES_DIR' ) ) {
    Redux::setSection( $opt_name, array(
        'title'             => esc_html__( 'Recipe', 'deep' ),
        'id'                => 'recipe_opt',
        'icon'              => 'dashicons dashicons-carrot',
        'fields'            => array(
            array(
                'title'     => esc_html__( 'Single recipe Layout', 'deep' ),
                'id'        => 'deep_recipe_layout',
                'type'      => 'image_select',
                'full_width'=> true,
                'default'   => 'right',
                'options'   => array(
                    'full' => array(
                        'alt' => esc_html__( 'Full Layout', 'deep' ),
                        'img' => DEEP_ASSETS_URL . 'images/theme-options/full-layout.png'
                    ),
                    'left' => array(
                        'alt' => esc_html__( 'Left Sidebar', 'deep' ),
                        'img' => DEEP_ASSETS_URL . 'images/theme-options/left-sidebar.png'
                    ),
                    'right' => array(
                        'alt' => esc_html__( 'Right Sidebar', 'deep' ),
                        'img' => DEEP_ASSETS_URL . 'images/theme-options/right-sidebar.png'
                    ),
                ),
            ),
            array(
                'id'        => 'deep_recipe_next_and_prev',
                'type'      => 'switch',
                'title'     => esc_html__('Next and previous post', 'deep'),
                'default'   => '1',
                'on'        => esc_html__( 'Show', 'deep' ),
                'off'       => esc_html__( 'Hide', 'deep' ),
            ),
            array(
                'id'        => 'deep_recipe_author',
                'type'      => 'switch',
                'title'     => esc_html__('Post author', 'deep'),
                'default'   => '1',
                'on'        => esc_html__( 'Show', 'deep' ),
                'off'       => esc_html__( 'Hide', 'deep' ),
            ),
            array(
                'id'        => 'deep_recipe_social_share',
                'type'      => 'switch',
                'title'     => esc_html__('Social share', 'deep'),
                'default'   => '1',
                'on'        => esc_html__( 'Show', 'deep' ),
                'off'       => esc_html__( 'Hide', 'deep' ),
            ),
            array(
                'id'        => 'deep_recipe_top_related',
                'type'      => 'switch',
                'title'     => esc_html__('Top related', 'deep'),
                'default'   => '1',
                'on'        => esc_html__( 'Show', 'deep' ),
                'off'       => esc_html__( 'Hide', 'deep' ),
            ),
            array(
                'id'        => 'deep_recipe_meta_data',
                'type'      => 'switch',
                'title'     => esc_html__('Metadata', 'deep'),
                'default'   => '1',
                'on'        => esc_html__( 'Show', 'deep' ),
                'off'       => esc_html__( 'Hide', 'deep' ),
            ),
            array(
                'id'        => 'deep_recipe_meta_data_cat',
                'type'      => 'switch',
                'title'     => esc_html__('Metadata category', 'deep'),
                'default'   => '1',
                'on'        => esc_html__( 'Show', 'deep' ),
                'off'       => esc_html__( 'Hide', 'deep' ),
                'required'  => array( 'deep_recipe_meta_data', '=', '1' ),
            ),
            array(
                'id'        => 'deep_recipe_meta_data_time',
                'type'      => 'switch',
                'title'     => esc_html__('Metadata time', 'deep'),
                'default'   => '1',
                'on'        => esc_html__( 'Show', 'deep' ),
                'off'       => esc_html__( 'Hide', 'deep' ),
                'required'  => array( 'deep_recipe_meta_data', '=', '1' ),
            ),
            array(
                'id'        => 'deep_recipe_meta_data_comment',
                'type'      => 'switch',
                'title'     => esc_html__('Metadata comment', 'deep'),
                'default'   => '1',
                'on'        => esc_html__( 'Show', 'deep' ),
                'off'       => esc_html__( 'Hide', 'deep' ),
                'required'  => array( 'deep_recipe_meta_data', '=', '1' ),
            ),
            array(
                'id'        => 'deep_recipe_meta_data_view',
                'type'      => 'switch',
                'title'     => esc_html__('Metadata view', 'deep'),
                'default'   => '1',
                'on'        => esc_html__( 'Show', 'deep' ),
                'off'       => esc_html__( 'Hide', 'deep' ),
                'required'  => array( 'deep_recipe_meta_data', '=', '1' ),
            ),
        ),
    ));
    }

    // -> START Recipe Fields
    if ( defined( 'CAUSES_DIR' ) || defined( 'SERMONS_DIR' ) ) {
        Redux::setSection( $opt_name, array(
            'title'		=> esc_html__( 'Church Options', 'deep' ),
            'id'		=> 'deep_opts',
            'icon'		=> 'ti-book',
        ) );

        // Sermon
        if ( defined( 'SERMONS_DIR' ) ) {

            Redux::setSection( $opt_name, array(
                'title'		=> esc_html__( 'Sermon', 'deep' ),
                'id'		=> 'sermon_opts',
                'subsection'=> true,
                'fields'	=> array(
                    array(
                        'title'		=> esc_html__( 'Single Sermon Sidebar', 'deep' ),
                        'id'		=> 'deep_singlesermon_sidebar',
                        'type'		=> 'button_set',
                        'default'	=> 'right',
                        'options'	=> array(
                            'none'	=> esc_html__( 'None', 'deep' ),
                            'left'	=> esc_html__( 'Left', 'deep' ),
                            'right'	=> esc_html__( 'Right', 'deep' ),
                        ),
                    ),
                    array(
                        'title'		=> esc_html__( 'Metadata Speaker', 'deep' ),
                        'id'		=> 'deep_sermon_speaker',
                        'type'		=> 'switch',
                        'default'	=> '1',
                        'on'		=> esc_html__( 'On', 'deep' ),
                        'off'		=> esc_html__( 'Off', 'deep' ),
                    ),
                    array(
                        'title'     => esc_html__( 'Metadata Series', 'deep' ),
                        'id'        => 'deep_sermon_series',
                        'type'      => 'switch',
                        'default'   => '1',
                        'on'        => esc_html__( 'On', 'deep' ),
                        'off'       => esc_html__( 'Off', 'deep' ),
                    ),
                    array(
                        'title'		=> esc_html__( 'Metadata Date', 'deep' ),
                        'id'		=> 'deep_sermon_date',
                        'type'		=> 'switch',
                        'default'	=> '1',
                        'on'		=> esc_html__( 'On', 'deep' ),
                        'off'		=> esc_html__( 'Off', 'deep' ),
                    ),
                    array(
                        'title'		=> esc_html__( 'Metadata Category', 'deep' ),
                        'id'		=> 'deep_sermon_category',
                        'type'		=> 'switch',
                        'default'	=> '1',
                        'on'		=> esc_html__( 'On', 'deep' ),
                        'off'		=> esc_html__( 'Off', 'deep' ),
                    ),
                    array(
                        'title'		=> esc_html__( 'Metadata Comments', 'deep' ),
                        'id'		=> 'deep_sermon_comments',
                        'type'		=> 'switch',
                        'default'	=> '1',
                        'on'		=> esc_html__( 'On', 'deep' ),
                        'off'		=> esc_html__( 'Off', 'deep' ),
                    ),
                    array(
                        'title'		=> esc_html__( 'Metadata Views', 'deep' ),
                        'id'		=> 'deep_sermon_views',
                        'type'		=> 'switch',
                        'default'	=> '1',
                        'on'		=> esc_html__( 'On', 'deep' ),
                        'off'		=> esc_html__( 'Off', 'deep' ),
                    ),
                    array(
                        'title'		=> esc_html__( 'Featured Image on Sermon Post', 'deep' ),
                        'id'		=> 'deep_sermon_featuredimage',
                        'type'		=> 'switch',
                        'default'	=> '1',
                        'on'		=> esc_html__( 'On', 'deep' ),
                        'off'		=> esc_html__( 'Off', 'deep' ),
                    ),
                    array(
                        'title'		=> esc_html__( 'Social Share Links', 'deep' ),
                        'id'		=> 'deep_sermon_social_share',
                        'type'		=> 'switch',
                        'default'	=> '1',
                        'on'		=> esc_html__( 'On', 'deep' ),
                        'off'		=> esc_html__( 'Off', 'deep' ),
                    ),
                    array(
                        'title'		=> esc_html__( 'Show Sermon Speaker Box', 'deep' ),
                        'id'		=> 'deep_sermon_speakerbox',
                        'type'		=> 'switch',
                        'default'	=> '1',
                        'on'		=> esc_html__( 'On', 'deep' ),
                        'off'		=> esc_html__( 'Off', 'deep' ),
                    ),
                    array(
                        'title'		=> esc_html__( 'Show Recent Sermons', 'deep' ),
                        'id'		=> 'deep_recent_sermons',
                        'type'		=> 'switch',
                        'default'	=> '1',
                        'on'		=> esc_html__( 'On', 'deep' ),
                        'off'		=> esc_html__( 'Off', 'deep' ),
                    ),
                ),
            ) );

        }

        // Cause
        if ( defined( 'CAUSES_DIR' ) ) {

            Redux::setSection( $opt_name, array(
                'title'		=> esc_html__( 'Cause', 'deep' ),
                'id'		=> 'cause_opts',
                'subsection'=> true,
                'fields'	=> array(
                    array(
                        'title'		=> esc_html__( 'Donate Form', 'deep' ),
                        'subtitle'	=> esc_html__( 'Choose previously created contact form from the drop down list.', 'deep' ),
                        'id'		=> 'webnus_donate_form',
                        'type'		=> 'select',
                        'data'		=> 'posts',
                        'args'		=> array( 'post_type' => 'wpcf7_contact_form', ),
                    ),
                        array(
                        'title'		=> esc_html__( 'Currency', 'deep' ),
                        'id'		=> 'webnus_cause_currency',
                        'type'		=> 'text',
                        'default'	=> '$',
                    ),
                        array(
                        'title'		=> esc_html__( 'Metadata Date', 'deep' ),
                        'id'		=> 'webnus_cause_date',
                        'type'		=> 'switch',
                        'default'	=> '1',
                        'on'		=> esc_html__( 'On', 'deep' ),
                        'off'		=> esc_html__( 'Off', 'deep' ),
                    ),
                        array(
                        'title'		=> esc_html__( 'Metadata Category', 'deep' ),
                        'id'		=> 'webnus_cause_category',
                        'type'		=> 'switch',
                        'default'	=> '1',
                        'on'		=> esc_html__( 'On', 'deep' ),
                        'off'		=> esc_html__( 'Off', 'deep' ),
                    ),
                        array(
                        'title'		=> esc_html__( 'Metadata Comments', 'deep' ),
                        'id'		=> 'webnus_cause_comments',
                        'type'		=> 'switch',
                        'default'	=> '1',
                        'on'		=> esc_html__( 'On', 'deep' ),
                        'off'		=> esc_html__( 'Off', 'deep' ),
                    ),
                        array(
                        'title'		=> esc_html__( 'Metadata Views', 'deep' ),
                        'id'		=> 'webnus_cause_views',
                        'type'		=> 'switch',
                        'default'	=> '1',
                        'on'		=> esc_html__( 'On', 'deep' ),
                        'off'		=> esc_html__( 'Off', 'deep' ),
                    ),
                        array(
                        'title'		=> esc_html__( 'Featured Image on Cause Post', 'deep' ),
                        'id'		=> 'webnus_cause_featuredimage',
                        'type'		=> 'switch',
                        'default'	=> '1',
                        'on'		=> esc_html__( 'On', 'deep' ),
                        'off'		=> esc_html__( 'Off', 'deep' ),
                    ),
                        array(
                        'title'		=> esc_html__( 'Social Share Links', 'deep' ),
                        'id'		=> 'webnus_cause_social_share',
                        'type'		=> 'switch',
                        'default'	=> '1',
                        'on'		=> esc_html__( 'On', 'deep' ),
                        'off'		=> esc_html__( 'Off', 'deep' ),
                    ),
                ),
            ) );

        }

    }

    // -> START Gallery Fields
    if ( defined( 'GALLERY_DIR' ) )  {
        Redux::setSection( $opt_name, array(
            'title'		=> esc_html__( 'Gallery Options', 'deep' ),
            'id'		=> 'gallery_opts',
            'icon'		=> 'ti-view-grid',
        ) );
            // Gallery
            Redux::setSection( $opt_name, array(
                'title'		=> esc_html__( 'Basic Options', 'deep' ),
                'id'		=> 'basic_gallery_opts',
                'subsection'=> true,
                'fields'	=> array(
                    array(
                        'title'     => esc_html__('Gallery Page Title', 'deep'),
                        'subtitle'  => esc_html__('By hiding this option, gallery Page title will be disappearing.','deep'),
                        'id'        => 'deep_gallery_page_title_enable',
                        'type'      => 'switch',
                        'default'   => '1',
                        'on'        => esc_html__( 'Show', 'deep' ),
                        'off'       => esc_html__( 'Hide', 'deep' ),
                    ),
                    array(
                        'title'         => esc_html__( 'Gallery Page Title Text', 'deep' ),
                        'id'            => 'deep_gallery_title',
                        'type'          => 'text',
                        'default'       => 'Gallery',
                        'required'  => array( 'deep_gallery_page_title_enable', '=', '1' ),
                    ),
                ),
            ) );
        // The Grid Gallery
        if ( defined( 'TOMB_DIR' ) ) {
            // The Grid Gallery
            Redux::setSection( $opt_name, array(
                'title'		=> esc_html__( 'Set Gallery', 'deep' ),
                'id'		=> 'thegrid_gallery_opts',
                'subsection'=> true,
                'fields'	=> array(
                    array(
                        'title'         => esc_html__( 'Set Gallery', 'deep' ),
                        'subtitle'      => esc_html__( 'Select the grid gallery for setting an archive page', 'deep' ),
                        'id'            => 'deep_thegrid_gallery',
                        'type'          => 'select',
                        'data'          => 'posts',
                        'args'          => array( 'post_type' => 'the_grid', ),
                    ),
                ),
            ) );
        }
    }

    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Social Networks', 'deep' ),
        'id'        => 'social_main_options',
        'icon'      => 'sl-share',
    ));

    // -> START Social Networks Fields
    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Socials', 'deep' ),
        'id'        => 'social_opts',
        'subsection'=> true,
        'fields'    => array(
            array(
                'id'       => 'deep_social_type',
                'type'     => 'select',
                'title'    => esc_html__('Select social type to show', 'deep'),
                'desc'     => esc_html__('If you select "icon", your social will display with icon without text and if you select "name" socials will display with name without icon.', 'deep'),
                'options'  => array(
                    '1' => 'Icon',
                    '2' => 'Name',
                ),
                'default'  => '1',
            ),
            array(
                'id'       => 'deep_social_first',
                'type'     => 'select',
                'title'    => esc_html__('1st Social Name', 'deep'),
                'options'  => $webnus_socials,
                'default'  => 'facebook',
            ),
            array(
                'id'        => 'deep_social_first_url',
                'type'      => 'text',
                'title'     => esc_html__('1st Social URL', 'deep'),
                'required'  => array( 'deep_social_first', '!=', '' ),
        'default'  => 'https://www.facebook.com/',
            ),
            array(
                'id'        => 'deep_social_second',
                'type'      => 'select',
                'title'     => esc_html__('2nd Social Name', 'deep'),
                'options'   => $webnus_socials,
        'default'  => 'twitter',
            ),
            array(
                'id'        => 'deep_social_second_url',
                'type'      => 'text',
                'title'     => esc_html__('2nd Social URL', 'deep'),
                'required'  => array( 'deep_social_second', '!=', '' ),
        'default'  => 'https://twitter.com/',
            ),
            array(
                'id'        => 'deep_social_third',
                'type'      => 'select',
                'title'     => esc_html__('3rd Social Name', 'deep'),
                'options'   => $webnus_socials,
        'default'  => 'instagram',
            ),
            array(
                'id'        => 'deep_social_third_url',
                'type'      => 'text',
                'title'     => esc_html__('3rd Social URL', 'deep'),
                'required'  => array( 'deep_social_third', '!=', '' ),
        'default'  => 'https://www.instagram.com/',
            ),
            array(
                'id'        => 'deep_social_fourth',
                'type'      => 'select',
                'title'     => esc_html__('4th Social Name', 'deep'),
                'options'   => $webnus_socials,
            ),
            array(
                'id'        => 'deep_social_fourth_url',
                'type'      => 'text',
                'title'     => esc_html__('4th Social URL', 'deep'),
                'required'  => array( 'deep_social_fourth', '!=', '' ),
            ),
            array(
                'id'        => 'deep_social_fifth',
                'type'      => 'select',
                'title'     => esc_html__('5th Social Name', 'deep'),
                'options'   => $webnus_socials,
            ),
            array(
                'id'        => 'deep_social_fifth_url',
                'type'      => 'text',
                'title'     => esc_html__('5th Social URL', 'deep'),
                'required'  => array( 'deep_social_fifth', '!=', '' ),
            ),
            array(
                'id'        => 'deep_social_sixth',
                'type'      => 'select',
                'title'     => esc_html__('6th Social Name', 'deep'),
                'options'   => $webnus_socials,
            ),
            array(
                'id'        => 'deep_social_sixth_url',
                'type'      => 'text',
                'title'     => esc_html__('6th Social URL', 'deep'),
                'required'  => array( 'deep_social_sixth', '!=', '' ),
            ),
            array(
                'id'        => 'deep_social_seventh',
                'type'      => 'select',
                'title'     => esc_html__('7th Social Name', 'deep'),
                'options'   => $webnus_socials,
            ),
            array(
                'id'        => 'deep_social_seventh_url',
                'type'      => 'text',
                'title'     => esc_html__('7th Social URL', 'deep'),
                'required'  => array( 'deep_social_seventh', '!=', '' ),
            ),
        ),
    ) );
    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Integrations', 'deep' ),
        'id'        => 'wn_integrations',
        'subsection'=> true,
        'fields'    => array(
            array(
                'title'     => esc_html__( 'Facebook APP ID', 'deep' ),
                'subtitle'  => wp_kses( __('In order for you to use Facebook widgets on your site, you need to create your own app in the following link:  <a href="https://developers.facebook.com/docs/apps/register/" target="_blank">Click Here</a><br><br>', 'deep'), $keyses ),
                'id'        => 'deep_facebook_app_id',
                'type'      => 'text',
            ),
        ),
    ));

    // -> START Google Maps Fields
    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Google Maps', 'deep' ),
        'id'        => 'google_map_opts',
        'icon'      => 'icon-map-pin',
        'fields'    => array(
            array(
                'title'     => esc_html__( 'API key', 'deep' ),
                'subtitle'  => wp_kses( __('You should create an API for yourself and put the code here. read the link below for more info:  <a href="https://console.developers.google.com/flows/enableapi?apiid=maps_backend,geocoding_backend,directions_backend,distance_matrix_backend,elevation_backend,places_backend&keyType=CLIENT_SIDE&reusekey=true" target="_blank">Here</a><br><br>', 'deep'), $keyses ),
                'id'        => 'deep_google_map_api',
                'type'      => 'text',
            ),
        ),
    ) );

    // -> START Header Options Fields
    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Shop', 'deep' ),
        'desc'      => esc_html__( 'Everything about Shop, Single shop information are here:', 'deep' ),
        'id'        => 'main_shop_opts',
        'icon'      => 'ti-shopping-cart',
    ));

    // -> START Shop Fields
    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Shop Page', 'deep' ),
        'id'        => 'shop_opts',
        'subsection'=> true,
        'fields'    => array(
            array(
                'title'     => esc_html__( 'Default Shop Style', 'deep' ),
                'subtitle'      => esc_html__( 'Deep customization may not be compatible with some of the plugins of WooCommerce, in such cases, you can enable this option in order to disable those customization and use WooCommerce main core with a style similar to Webnus style.', 'deep' ),
                'id'        => 'deep_shop_style',
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Enabled', 'deep' ),
                'off'       => esc_html__( 'Disabled', 'deep' ),
            ),
            array(
                'title'     => esc_html__( 'Shop Layout', 'deep' ),
                'id'        => 'deep_shop_layout',
                'type'      => 'image_select',
                'full_width'=> true,
                'default'   => 'left',
                'options'   => array(
                    'full' => array(
                        'alt' => esc_html__( 'Full Layout', 'deep' ),
                        'img' => DEEP_ASSETS_URL . 'images/theme-options/full-layout.png'
                    ),
                    'left' => array(
                        'alt' => esc_html__( 'Left Sidebar', 'deep' ),
                        'img' => DEEP_ASSETS_URL . 'images/theme-options/left-sidebar.png'
                    ),
                    'right' => array(
                        'alt' => esc_html__( 'Right Sidebar', 'deep' ),
                        'img' => DEEP_ASSETS_URL . 'images/theme-options/right-sidebar.png'
                    ),
                ),
            ),
            array(
                'title'     => esc_html__('Default on Grid or List?', 'deep'),
                'subtitle'  => esc_html__('Shop page products layout', 'deep'),
                'id'        => 'deep_woo_shop_default_view',
                'type'      => 'button_set',
                'default'   => 'grid',
                'options'   => array(
                    'grid'    => esc_html__( 'Grid', 'deep' ),
                    'list'     => esc_html__( 'List', 'deep' ),
                ),
                'required'  => array( 'deep_shop_style', '=', '0' ),
            ),
            array(
                'title'     => esc_html__('Products per row', 'deep'),
                'subtitle'  => esc_html__('Number of product in each row', 'deep'),
                'id'        => 'deep_woo_shop_products_in_shop',
                'type'      => 'button_set',
                'default'   => '5',
                'options'   => array(
                    '2' => esc_html__( '2', 'deep' ),
                    '3' => esc_html__( '3', 'deep' ),
                    '4' => esc_html__( '4', 'deep' ),
                    '5' => esc_html__( '5', 'deep' ),
                    '6' => esc_html__( '6', 'deep' ),
                ),
                'required' => array(
                    array( 'deep_woo_shop_default_view', '=', 'grid' ),
                    array( 'deep_shop_style', '=', '0' )
                ),
            ),
            array(
                'title'     => esc_html__( 'Display shop Page Title', 'deep' ),
                'id'        => 'deep_woo_shop_title_enable',
                'type'      => 'switch',
                'default'   => '1',
                'on'        => esc_html__( 'Show', 'deep' ),
                'off'       => esc_html__( 'Hide', 'deep' ),
            ),
            array(
                'title'     => esc_html__( 'Shop Page Title', 'deep' ),
                'id'        => 'deep_woo_shop_title',
                'type'      => 'text',
                'default'   => 'Shop',
                'required'  => array( 'deep_woo_shop_title_enable', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Show/Hide Sidebar', 'deep'),
                'id'        => 'deep_woo_sidebar_enable',
                'type'      => 'switch',
                'default'   => '1',
                'on'        => esc_html__( 'Show', 'deep' ),
                'off'       => esc_html__( 'Hide', 'deep' ),
                'required' => array(
                    array( 'deep_shop_layout', '!=', 'full' ),
                    array( 'deep_shop_style', '=', '0' )
                ),
            ),
            array(
                'title'     => esc_html__('Show/Hide Hover Products Elements', 'deep'),
                'id'        => 'deep_woo_hover_enable',
                'type'      => 'switch',
                'default'   => '1',
                'on'        => esc_html__( 'Show', 'deep' ),
                'off'       => esc_html__( 'Hide', 'deep' ),
                'required'  => array( 'deep_shop_style', '=', '0' ),
            ),
            array(
                'title'     => esc_html__('Show/Hide SHIPPING DETAILS title in the checkout page', 'deep'),
                'id'        => 'deep_woo_sdtitle_enable',
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Show', 'deep' ),
                'off'       => esc_html__( 'Hide', 'deep' ),
            ),
            array(
                'title'     => esc_html__('Disable the theme customized form in the checkout page', 'deep'),
                'subtitle'  => esc_html__('In case you want to use a checkout manager plugin', 'deep'),
                'id'        => 'deep_woo_disable_checkout_form',
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Yes', 'deep' ),
                'off'       => esc_html__( 'No', 'deep' ),
            ),
        ),
    ) );
    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Product Page', 'deep' ),
        'id'        => 'single_shop_opts',
        'subsection'=> true,
        'fields'    => array(
            array(
                'title'     => esc_html__('Show/Hide Upsell Products', 'deep'),
                'id'        => 'deep_woo_upsell_enable',
                'type'      => 'switch',
                'default'   => '1',
                'on'        => esc_html__( 'Show', 'deep' ),
                'off'       => esc_html__( 'Hide', 'deep' ),
                'required'  => array( 'deep_shop_style', '=', '0' ),
            ),
            array(
                'title'     => esc_html__('Show/Hide Related Products', 'deep'),
                'id'        => 'deep_woo_related_enable',
                'type'      => 'switch',
                'default'   => '1',
                'on'        => esc_html__( 'Show', 'deep' ),
                'off'       => esc_html__( 'Hide', 'deep' ),
                'required'  => array( 'deep_shop_style', '=', '0' ),
            ),
            array(
                'title'     => esc_html__('Product page title Show/Hide', 'deep'),
                'id'        => 'deep_woo_product_title_enable',
                'type'      => 'switch',
                'default'   => '1',
                'on'        => esc_html__( 'Show', 'deep' ),
                'off'       => esc_html__( 'Hide', 'deep' ),
            ),
            array(
                'title'     => esc_html__('Product page title', 'deep'),
                'id'        => 'deep_woo_product_title',
                'type'      => 'text',
                'default'   => 'Product',
                'required'  => array( 'deep_woo_product_title_enable', '=', '1' ),
            ),
            array(
                'title'     => esc_html__('Product social share', 'deep'),
                'id'        => 'deep_woo_product_social_share',
                'type'      => 'switch',
                'default'   => '1',
                'on'        => esc_html__( 'Show', 'deep' ),
                'off'       => esc_html__( 'Hide', 'deep' ),
            ),
        ),
    ) );


    if ( class_exists( 'LifterLMS' ) ) {
        // -> START Learning Options Fields
        Redux::setSection( $opt_name, array(
            'title'     => esc_html__( 'Learning Options', 'deep' ),
            'desc'      => esc_html__( 'Everything about Learning are here:', 'deep' ),
            'id'        => 'laerning_opts',
            'icon'      => 'ti-agenda',
        ));
        Redux::setSection( $opt_name, array(
            'title'     => esc_html__( 'Course Options', 'deep' ),
            'id'        => 'course_opt',
            'subsection'=> true,
            'fields'    => array(
                array(
                    'title'    => esc_html__( 'Course Features', 'deep' ),
                    'id'       => 'deep_webnus_course_features',
                    'type'     => 'checkbox',
                    'options'  => array(
                        'date'          => esc_html__('Course Date','deep'),
                        'capacity'      => esc_html__('Course Capacity','deep'),
                        'code'          => esc_html__('Course Code','deep'),
                        'views'         => esc_html__('Course View','deep'),
                        'students'      => esc_html__('Course Students','deep'),
                        'tags'          => esc_html__('Tags Bar','deep'),
                        'price'         => esc_html__('Price Widget','deep'),
                        'instructor'    => esc_html__('Instructor Widget','deep'),
                        'duration'      => esc_html__('Course Duration','deep'),
                        'difficulty'    => esc_html__('Course Difficulty','deep'),
                        'category'      => esc_html__('Course Category','deep'),
                        'rating'        => esc_html__('Course Rating','deep'),
                        'instructors'   => esc_html__('Course Instructors','deep'),
                        'comment'       => esc_html__('Comment Section','deep'),
                        'enrolled'      => esc_html__('Enrolled Widget','deep'),
                        'sharing'       => esc_html__('Sharing Widget','deep'),
                    ),
                    'default' => array(
                        'date'          => '1',
                        'capacity'      => '1',
                        'code'          => '1',
                        'views'         => '1',
                        'students'      => '1',
                        'tags'          => '1',
                        'price'         => '1',
                        'instructor'    => '1',
                        'duration'      => '1',
                        'difficulty'    => '1',
                        'category'      => '1',
                        'rating'        => '1',
                        'instructors'   => '1',
                        'comment'       => '1',
                        'enrolled'      => '1',
                        'sharing'       => '1',
                    )
                ),
                array(
                    'id'        => 'deep_webnus_course_taking',
                    'title'     => __('Taking Course', 'deep'),
                    'type'      => 'button_set',
                    'options'   => array(
                        '0'     => 'None',
                        '1'     => 'LifterLMS',
                        '2'     => 'Custom',
                    ),
                    'default'   => '0',
                ),
                array(
                    'title'     => esc_html__('Taking Course Custom URL', 'deep'),
                    'id'        => 'deep_webnus_course_taking_custom',
                    'type'      => 'text',
                    'required'  => array( 'deep_webnus_course_taking', '=', '2' ),
                ),
                array(
                    'title'     => esc_html__( 'Course Breadcrumb', 'deep' ),
                    'subtitle'  => esc_html__( 'Show Breadcrumb in Course and Lesson.','deep' ),
                    'id'        => 'deep_webnus_enable_breadcrumbs',
                    'type'      => 'switch',
                    'default'   => '0',
                    'on'        => esc_html__( 'Show', 'deep' ),
                    'off'       => esc_html__( 'Hide', 'deep' ),
                ),
                array(
                    'id'        => 'deep_webnus_course_no_image',
                    'title'     => __('Default Blank Featured Image', 'deep'),
                    'type'      => 'switch',
                    'default'   => '0',
                    'on'        => esc_html__( 'Enable', 'deep' ),
                    'off'       => esc_html__( 'Disable', 'deep' ),
                ),
                array(
                    'title'     => esc_html__( 'Custom Default Blank Featured Image', 'deep' ),
                    'id'        => 'deep_webnus_course_no_image_src',
                    'type'      => 'media',
                    'url'       => true,
                    'required'  => array( 'deep_webnus_course_no_image', '=', '1' ),
                ),
            ),
        ) );
        Redux::setSection( $opt_name, array(
            'title'     => esc_html__( 'Lesson Options', 'deep' ),
            'id'        => 'lesson_opt',
            'subsection'=> true,
            'fields'    => array(
                array(
                    'title'    => esc_html__( 'lesson Features', 'deep' ),
                    'id'       => 'deep_webnus_lesson_features',
                    'type'     => 'checkbox',
                    'options'  => array(
                        'image'         => esc_html__('Lesson Image','deep'),
                        'comment'       => esc_html__('Lesson Comment','deep'),
                        'date'          => esc_html__('Lesson Date','deep'),
                        'instructor'    => esc_html__('Lesson Instructor','deep'),
                    ),
                ),
            ),
        ) );
        // -> START Extra Options Fields
        Redux::setSection( $opt_name, array(
            'title'     => esc_html__( 'Extra Options', 'deep' ),
            'id'        => 'extra_opts',
            'icon'      => 'ti-clip',
        ));
        Redux::setSection( $opt_name, array(
            'title'     => esc_html__( 'Booking Options', 'deep' ),
            'id'        => 'booking_opt',
            'subsection'=> true,
            'fields'    => array(
                array(
                    'title'    => esc_html__( 'Event Booking', 'deep' ),
                    'id'       => 'deep_webnus_booking_enable',
                    'type'      => 'switch',
                    'default'   => '0',
                    'on'        => esc_html__( 'Enable', 'deep' ),
                    'off'       => esc_html__( 'Disable', 'deep' ),
                ),
                array(
                    'title'     => esc_html__( 'Select Booking Form', 'deep' ),
                    'id'        => 'deep_webnus_booking_form',
                    'type'      => 'select',
                    'data'      => 'posts',
                    'args'      => array( 'post_type' => 'wpcf7_contact_form', ),
                    'required'  => array( 'deep_webnus_booking_enable', '=', '1' ),
                ),
            ),
        ) );
        Redux::setSection( $opt_name, array(
            'title'     => esc_html__( 'Author Permalink', 'deep' ),
            'id'        => 'author_opt',
            'subsection'=> true,
            'fields'    => array(
                array(
                    'title'     => esc_html__('Author Base', 'deep'),
                    'id'        => 'deep_webnus_author_permalink',
                    'type'      => 'text',
                ),
            ),
        ) );
    }

    if ( defined('GOAL_DIR') ) {
        Redux::setSection( $opt_name, array(
            'title'     => esc_html__( 'Goal Options', 'deep' ),
            'id'        => 'goals_opt',
            'subsection'=> true,
            'fields'    => array(
                array(
                    'title'     => esc_html__('Single Goal Sidebar', 'deep'),
                    'id'        => 'deep_webnus_singlegoal_sidebar',
                    'type'      => 'button_set',
                    'options'   => array(
                        '0'     => 'None',
                        '1'     => 'left',
                        '2'     => 'right',
                    ),
                    'default'   => '0',
                ),

                array(
                    'title'     => esc_html__( 'Select Donate Form', 'deep' ),
                    'id'        => 'deep_webnus_donate_form',
                    'type'      => 'select',
                    'data'      => 'posts',
                    'args'      => array( 'post_type' => 'wpcf7_contact_form', ),
                ),

                array(
                    'title'     => esc_html__('Currency', 'deep'),
                    'id'        => 'deep_webnus_currency',
                    'type'      => 'text',
                ),

                array(
                    'title'    => esc_html__( 'Goal Features', 'deep' ),
                    'id'       => 'deep_webnus_goal_features',
                    'type'     => 'checkbox',
                    'options'  => array(
                        'image'         => esc_html__('Goal Image','deep'),
                        'category'      => esc_html__('Goal Cagetory','deep'),
                        'sharing'       => esc_html__('Goal Sharing','deep'),
                        'date'          => esc_html__('Goal Date','deep'),
                        'views'         => esc_html__('Goal Views','deep'),
                        'comment'       => esc_html__('Goal Comment','deep'),
                    ),
                    'default'  => array(
                        'image'         => '1',
                        'category'      => '1',
                        'sharing'       => '1',
                        'date'          => '1',
                        'views'         => '1',
                        'comment'       => '1',
                    ),
                ),
            ),
        ) );
    }


    if ( is_plugin_active( 'webnus-portfolio/webnus-portfolio.php' ) ) {
        Redux::setSection( $opt_name, array(
            'title'         => esc_html__( 'Portfolio', 'deep' ),
            'id'            => 'portfolio_opts',
            'icon'      => 'ti-image',
            'fields'    => array(
                array(
                    'title'     => esc_html__( 'Single portfolio archive page target', 'deep' ),
                    'subtitle'  => esc_html__( 'Select Portfolio archive button url in single portfolio', 'deep' ),
                    'id'        => 'deep_webnus_portfolio_page',
                    'type'      => 'select',
                    'data'      => 'pages',
                    ),
                ),
        ) );
    }

    // -> START Rooms Fields
    if ( class_exists('WP_Hotel_Booking') ) {
        Redux::setSection( $opt_name, array(
            'title'             => esc_html__( 'Hotel options', 'deep' ),
            'id'                => 'room_opt',
            'icon'              => 'dashicons dashicons-admin-multisite',
            'fields'            => array(
                array(
                    'title'     => esc_html__('Rooms Archive Title', 'deep'),
                    'id'        => 'deep_room_archive_enable',
                    'type'      => 'switch',
                    'default'   => '1',
                    'on'        => esc_html__( 'Show', 'deep' ),
                    'off'       => esc_html__( 'Hide', 'deep' ),
                ),
                array(
                    'title'         => esc_html__( 'Archive Rooms Page Title Text', 'deep' ),
                    'id'            => 'deep_room_archive_title',
                    'type'          => 'text',
                    'default'       => 'Rooms',
                    'required'      => array( 'deep_room_archive_enable', '=', '1' ),
                ),
                array(
                    'title'     => esc_html__('Rooms Archive Sidebar Position', 'deep'),
                    'id'        => 'deep_room_archive_sidebar',
                    'type'      => 'button_set',
                    'default'   => 'none',
                    'options'   => array(
                        'none'  => esc_html__( 'None', 'deep' ),
                        'left'  => esc_html__( 'Left', 'deep' ),
                        'right' => esc_html__( 'Right', 'deep' ),
                    ),
                ),
            ),
        ));
    }


    // -> START Maintenance Fields
    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Maintenance Mode', 'deep' ),
        'id'        => 'coming_soon_opts',
        'desc'      => esc_html__( 'After creating your page, you can select it from dropdown list.', 'deep' ),
        'icon'      => 'sl-rocket',
        'fields'    => array(
            array(
                'title'     => esc_html__( 'Maintenance Mode', 'deep' ),
                'subtitle'      => esc_html__( 'Status of Maintenance Mode', 'deep' ),
                'id'        => 'deep_maintenance_mode',
                'type'      => 'switch',
                'default'   => '0',
                'on'        => esc_html__( 'Enabled', 'deep' ),
                'off'       => esc_html__( 'Disabled', 'deep' ),
            ),
            array(
                'title'     => esc_html__( 'Maintenance Page', 'deep' ),
                'subtitle'      => esc_html__( 'Select Maintenance Page', 'deep' ),
                'id'        => 'deep_maintenance_page',
                'type'      => 'select',
                'data'      => 'page',
                'required'  => array( 'deep_maintenance_mode', '=', '1' ),
            ),
        ),
    ) );


    // -> START Custom Codes Fields
    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'Custom Codes', 'deep' ),
        'id'        => 'custom_codes',
        'icon'      => 'ti-receipt',
        'fields'    => array(
            array(
                'title'     => esc_html__( 'Custom CSS', 'deep' ),
                'subtitle'  => esc_html__( 'Any custom CSS from the user should go in this field, it will override the theme CSS.', 'deep' ),
                'id'        => 'deep_custom_css',
                'type'      => 'ace_editor',
                'mode'      => 'css',
                'theme'     => 'chrome',
                'full_width'=> true,
            ),
            array(
                'title'     => esc_html__( 'Space Before &lt;/head&gt;', 'deep' ),
                'subtitle'      => esc_html__( 'Add code before the &lt;/head&gt; tag.', 'deep' ),
                'id'        => 'deep_space_before_head',
                'type'      => 'ace_editor',
                'theme'     => 'chrome',
                'full_width'=> true,
            ),
            array(
                'title'     => esc_html__( 'Space Before &lt;/body&gt;', 'deep' ),
                'subtitle'      => esc_html__( 'Add code before the &lt;/body&gt; tag.', 'deep' ),
                'id'        => 'deep_space_before_body',
                'type'      => 'ace_editor',
                'theme'     => 'chrome',
                'full_width'=> true,
            ),
        ),
    ) );


    /*
     * <--- END SECTIONS
     */