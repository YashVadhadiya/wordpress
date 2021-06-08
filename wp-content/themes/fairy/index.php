<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fairy
 */

get_header();
global $fairy_theme_options;
?>

    <main class="site-main">
        <?php
        /**
         * fairy_carousel hook.
         *
         * @since 1.0.0
         *
         * @hooked fairy_constuct_carousel - 10
         */
        do_action('fairy_carousel');
        ?>

        <?php
        /**
         * fairy_cat_section hook.
         *
         * @since 1.0.0
         *
         * @hooked fairy_construct_cat_section - 10
         */
        do_action('fairy_cat_section');
        ?>

        <section class="blog-list-section sec-spacing">
            <div class="container">
                <!--
                    => For changing the sidebar and main content column order in desktop version  use .	  [.row-inverse-md] class

                    => For Full width column use [.row-full-width] class

                    => For center align column use [.row-center-col] class
                 -->
                <?php
                $sidebar_options = esc_attr($fairy_theme_options['fairy-sidebar-blog-page']);
                $sidebar_class = '';
                if ($sidebar_options == 'left-sidebar') {
                    $sidebar_class = 'row-inverse-md';
                } elseif ($sidebar_options == 'no-sidebar') {
                    $sidebar_class = 'row-full-width';
                } elseif ($sidebar_options == 'middle-column') {
                    $sidebar_class = 'row-center-col';
                }
                ?>
                <div class="row <?php echo esc_attr($sidebar_class); ?>">
                    <div id="primary" class="col-12 col-md-2-3 col-lg-2-3">
                        <?php
                        if (have_posts()) :

                            if (is_home() && !is_front_page()) :
                                ?>
                                <header>
                                    <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                                </header>
                            <?php
                            endif;
                            $masonry_options = esc_attr($fairy_theme_options['fairy-blog-page-masonry-normal']);
                            $column_class = '';
                             if($masonry_options == 'masonry'){
                                 if($sidebar_options == 'no-sidebar'){
                                     $column_class = 'fairy-three-column fairy-masonry';
                                 }else{
                                     $column_class = 'fairy-two-column fairy-masonry';
                                 }
                             }
                            ?>
                            <div class="fairy-content-area <?php echo esc_attr($column_class); ?>">
                                <?php
                                /* Start the Loop */
                                while (have_posts()) :
                                    the_post();

                                    /*
                                    * Include the Post-Type-specific template for the content.
                                    * If you want to override this in a child theme, then include a file
                                    * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                                    */
                                    get_template_part('template-parts/content', get_post_type());

                                endwhile;
                                ?>
                            </div>
                            <?php

                            /**
                             * fairy_action_navigation hook
                             * @since 1.0.0
                             *
                             * @hooked fairy_posts_navigation -  10
                             */
                            do_action('fairy_action_navigation');


                        else :

                            get_template_part('template-parts/content', 'none');

                        endif;
                        ?>
                    </div>
                    <?php
                    if (($sidebar_options == 'left-sidebar') || ($sidebar_options == 'right-sidebar')) {
                        ?>
                        <div id="secondary" class="col-12 col-md-1-3 col-lg-1-3">
                            <?php get_sidebar(); ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>

            </div>
        </section

    </main><!-- #main -->

<?php
get_footer();
