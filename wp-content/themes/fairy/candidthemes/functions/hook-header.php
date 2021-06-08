<?php
if (!function_exists('fairy_do_skip_to_content_link')) {
    /**
     * Add skip to content link before the header.
     *
     * @since 1.0.0
     */
    function fairy_do_skip_to_content_link()
    {
        ?>
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'fairy'); ?></a>
        <?php
    }
}
add_action('fairy_before_header', 'fairy_do_skip_to_content_link', 10);


if (!function_exists('fairy_header_search_modal')) {
    /**
     * Add search modal before header
     *
     * @since 1.0.0
     */
    function fairy_header_search_modal()
    {
        global $fairy_theme_options;
        if (($fairy_theme_options['fairy-enable-top-header-search'] != 1) || ($fairy_theme_options['fairy-enable-top-header'] != 1))
            return false;
        ?>
        <section class="search-section">
            <div class="container">
                <button class="close-btn"><i class="fa fa-times"></i></button>
                <?php get_search_form(); ?>
            </div>
        </section>
        <?php

    }
}
add_action('fairy_header', 'fairy_header_search_modal', 10);


if (!function_exists('fairy_construct_header')) {
    /**
     * Add header
     *
     * @since 1.0.0
     */
    function fairy_construct_header()
    {
        global $fairy_theme_options;
        $fairy_enable_top_header = absint($fairy_theme_options['fairy-enable-top-header']);
        $fairy_enable_top_social = absint($fairy_theme_options['fairy-enable-top-header-social']);
        $fairy_enable_top_menu = absint($fairy_theme_options['fairy-enable-top-header-menu']);
        $fairy_enable_top_search = absint($fairy_theme_options['fairy-enable-top-header-search']);
        ?>
        <header id="masthead" class="site-header text-center site-header-v2">
            <?php
            if (($fairy_enable_top_header == 1) && (($fairy_enable_top_menu == 1) || ($fairy_enable_top_search == 1) || ($fairy_enable_top_social == 1))) {
                ?>
                <section class="site-header-topbar">
                    <a href="#" class="top-header-toggle-btn">
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    </a>
                    <div class="container">
                        <div class="row">
                            <div class="col col-sm-2-3 col-md-2-3 col-lg-2-4">
                                <?php
                                /**
                                 * fairy_top_left hook.
                                 *
                                 * @since 1.0.0
                                 *
                                 * @hooked fairy_top_menu - 10
                                 *
                                 */
                                do_action('fairy_top_left');
                                ?>
                            </div>
                            <div class="col col-sm-1-3 col-md-1-3 col-lg-1-4">
                                <div class="fairy-menu-social topbar-flex-grid">
                                    <?php
                                    /**
                                     * fairy_top_right hook.
                                     *
                                     * @since 1.0.0
                                     *
                                     * @hooked fairy_top_search - 10
                                     * @hooked fairy_top_social - 20
                                     *
                                     */
                                    do_action('fairy_top_right');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
            }

            /**
             * fairy_main_header hook.
             *
             * @since 1.0.0
             *
             * @hooked fairy_construct_main_header - 10
             */
            do_action('fairy_main_header');
            ?>
        </header><!-- #masthead -->
        <?php

    }
}
add_action('fairy_header', 'fairy_construct_header', 20);

if (!function_exists('fairy_top_menu')) {
    /**
     * Add menu on top header.
     *
     * @since 1.0.0
     */
    function fairy_top_menu()
    {
        global $fairy_theme_options;
        if ($fairy_theme_options['fairy-enable-top-header-menu'] != 1)
            return false;
        ?>
        <nav class="site-header-top-nav">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'top-menu',
                'container' => 'ul',
                'menu_class' => 'site-header-top-menu',
                'depth' => 1
            ));
            ?>
        </nav>
        <?php
    }
}
add_action('fairy_top_left', 'fairy_top_menu', 10);


if (!function_exists('fairy_top_search')) {
    /**
     * Add search icon on top header.
     *
     * @since 1.0.0
     */
    function fairy_top_search()
    {
        global $fairy_theme_options;
        if ($fairy_theme_options['fairy-enable-top-header-search'] != 1)
            return false;
        ?>
        <button class="search-toggle"><i class="fa fa-search"></i></button>
        <?php
    }
}
add_action('fairy_top_right', 'fairy_top_search', 10);

if (!function_exists('fairy_top_social')) {
    /**
     * Add social icon menu on top header.
     *
     * @since 1.0.0
     */
    function fairy_top_social()
    {
        global $fairy_theme_options;
        if ($fairy_theme_options['fairy-enable-top-header-social'] != 1)
            return false;
        fairy_social_menu();
    }
}
add_action('fairy_top_right', 'fairy_top_social', 20);

if (!function_exists('fairy_construct_main_header')) {
    /**
     * Add Main Header
     *
     * @since 1.0.0
     */
    function fairy_construct_main_header()
    {

            /**
             * fairy_header_default hook.
             *
             * @since 1.0.0
             *
             * @hooked fairy_default_header - 10
             */
            do_action('fairy_header_default');


    }
}
add_action('fairy_main_header', 'fairy_construct_main_header', 10);


if (!function_exists('fairy_default_header')) {
    /**
     * Add Default header
     *
     * @since 1.0.0
     */
    function fairy_default_header()
    {

        //has header image
        $has_header_image = has_header_image();

        ?>

        <section id="site-navigation" class="site-header-top header-main-bar" <?php if (!empty($has_header_image)) { ?> style="background-image: url(<?php echo header_image(); ?>);" <?php } ?>>
            <div class="container">
                <div class="row">
                    <div class="col-1-1">
                        <?php
                        /**
                         * fairy_branding hook.
                         *
                         * @since 1.0.0
                         *
                         * @hooked fairy_construct_branding - 10
                         */
                        do_action('fairy_branding');
                        ?>
                    </div>

                </div>
            </div>
        </section>

        <section class="site-header-bottom">
            <div class="container">
                <?php
                /**
                 * fairy_main_menu hook.
                 *
                 * @since 1.0.0
                 *
                 * @hooked fairy_construct_main_menu - 10
                 */
                do_action('fairy_main_menu');
                ?>

            </div>
        </section>
        <?php
    }
}
add_action('fairy_header_default', 'fairy_default_header', 10);





if (!function_exists('fairy_construct_branding')) {
    /**
     * Add Branding on Header
     *
     * @since 1.0.0
     */
    function fairy_construct_branding()
    {
        ?>
        <div class="site-branding">
            <?php
            the_custom_logo();
            if (is_front_page() && is_home()) :
                ?>
                <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                          rel="home"><?php bloginfo('name'); ?></a></h1>
            <?php
            else :
                ?>
                <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                         rel="home"><?php bloginfo('name'); ?></a></p>
            <?php
            endif;
            $fairy_description = get_bloginfo('description', 'display');
            if ($fairy_description || is_customize_preview()) :
                ?>
                <p class="site-description"><?php echo $fairy_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    ?></p>
            <?php endif; ?>
        </div><!-- .site-branding -->

        <button id="menu-toggle-button" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </button>
        <?php
    }
}
add_action('fairy_branding', 'fairy_construct_branding', 10);



if (!function_exists('fairy_construct_main_menu')) {
    /**
     * Add Main Menu on Header
     *
     * @since 1.0.0
     */
    function fairy_construct_main_menu()
    {
        ?>
        <nav class="main-navigation">
            <ul id="primary-menu" class="nav navbar-nav nav-menu justify-content-center">
                <?php
                if (has_nav_menu('menu-1')) :
                    wp_nav_menu(array(
                        'theme_location' => 'menu-1',
                        'items_wrap' => '%3$s',
                        'container' => false
                    ));
                else:
                    wp_list_pages(array('depth' => 0, 'title_li' => ''));
                endif; // has_nav_menu
                ?>
                <button class="close_nav"><i class="fa fa-times"></i></button>
            </ul>
        </nav><!-- #site-navigation -->
        <?php
    }
}
add_action('fairy_main_menu', 'fairy_construct_main_menu', 10);