<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fairy
 */

get_header();
?>

    <main class="site-main">
        <section class="single-section sec-spacing">
            <div class="container">
                <?php
                $sidebar_options = esc_attr($fairy_theme_options['fairy-sidebar-single-page']);
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
                    <div id="primary" class="col-1-1 col-md-2-3">
                        <div class="card card-blog-post card-full-width">

                            <div class="card_body">
                                <?php
                                woocommerce_content();
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (($sidebar_options == 'left-sidebar') || ($sidebar_options == 'right-sidebar')) {
                        ?>
                        <div id="secondary" class="col-12 col-md-1-3 col-lg-1-3">
                            <?php get_sidebar('shop'); ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </section>
    </main><!-- #main -->

<?php
get_footer();
