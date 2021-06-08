<?php

if (!function_exists('fairy_construct_cat_section')) {
    /**
     * Display category section on homepage
     *
     * @since 1.0.0
     *
     */
    function fairy_construct_cat_section()
    {
        global $fairy_theme_options;
        if ((is_front_page()) && ($fairy_theme_options['fairy-enable-category-boxes'] == 1)) {
                /**
                 * fairy_single_cat_posts hook.
                 *
                 * @since 1.0.0
                 *
                 * @hooked fairy_constuct_single_cat_posts - 10
                 */
                do_action('fairy_single_cat_posts');

        }


    }
}
add_action('fairy_cat_section', 'fairy_construct_cat_section', 10);


if (!function_exists('fairy_constuct_single_cat_posts')) {
    /**
     * Display latest posts boxes of 3 different categories
     *
     * @since 1.0.0
     *
     */
    function fairy_constuct_single_cat_posts()
    {
        global $fairy_theme_options;
        $cat1 = absint($fairy_theme_options['fairy-single-cat-posts-select-1']);
        if (!empty($cat1)) {
            ?>
            <section class="promo-section sec-spacing">
                <div class="container">
                    <div class="row">
                        <?php
                        $fairy_cat_post_args = array(
                            'category__in' => $cat1,
                            'post_type' => 'post',
                            'posts_per_page' => 3,
                            'post_status' => 'publish',
                            'ignore_sticky_posts' => true
                        );
                        $fairy_featured_query = new WP_Query($fairy_cat_post_args);
                        if ($fairy_featured_query->have_posts()) :

                            while ($fairy_featured_query->have_posts()) : $fairy_featured_query->the_post();
                                ?>
                                <div class="col-1-1 col-sm-1-2 col-md-1-3">
                                    <div class="card card-bg-image card-promo">
                                        <figure class="card_media">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php
                                                if (has_post_thumbnail()) {
                                                    the_post_thumbnail('fairy-medium');
                                                } else {
                                                    ?>
                                                    <img src="<?php echo esc_url(get_template_directory_uri()) . '/candidthemes/assets/custom/img/fairy-medium.jpg' ?>" alt="<?php the_title(); ?>">
                                                    <?php
                                                }
                                                ?>
                                            </a>
                                        </figure>

                                        <article class="card_body">
                                            <h3 class="card_title">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php
                                                    $tags = get_the_tags();
                                                    if (!empty($tags)) {
                                                        $tag_name = $tags[0]->name;
                                                        echo esc_html($tag_name);
                                                    } else {
                                                        echo esc_html(get_cat_name($cat1));
                                                    }

                                                    ?>
                                                </a>
                                            </h3>
                                        </article>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                        endif;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </section>
            <?php
        }
    }
}
add_action('fairy_single_cat_posts', 'fairy_constuct_single_cat_posts', 10);



if (!function_exists('fairy_posts_navigation')) {
    /**
     * Display pagination based on type seclected
     *
     * @since 1.0.0
     *
     */
    function fairy_posts_navigation()
    {
        global $fairy_theme_options;
        if ($fairy_theme_options['fairy-pagination-options'] == 'numeric') {
            the_posts_pagination();
        }else {
            the_posts_navigation();
        }

    }
}
add_action('fairy_action_navigation', 'fairy_posts_navigation', 10);


if (!function_exists('fairy_related_post')) :
    /**
     * Display related posts from same category
     *
     * @param int $post_id
     * @return void
     *
     * @since 1.0.0
     *
     */
    function fairy_related_post($post_id)
    {

        global $fairy_theme_options;
        if ($fairy_theme_options['fairy-single-page-related-posts'] == 0) {
            return;
        }
        $categories = get_the_category($post_id);
        if ($categories) {
            $category_ids = array();
            $category = get_category($category_ids);
            $categories = get_the_category($post_id);
            foreach ($categories as $category) {
                $category_ids[] = $category->term_id;
            }
            $count = $category->category_count;
            if ($count > 1) { ?>
                <div class="related-post">
                    <?php
                    $fairy_related_post_title = esc_html($fairy_theme_options['fairy-single-page-related-posts-title']);
                    if (!empty($fairy_related_post_title)):
                        ?>
                        <h2 class="post-title"><?php echo esc_html($fairy_related_post_title); ?></h2>
                    <?php
                    endif;

                    $fairy_cat_post_args = array(
                        'category__in' => $category_ids,
                        'post__not_in' => array($post_id),
                        'post_type' => 'post',
                        'posts_per_page' => 2,
                        'post_status' => 'publish',
                        'ignore_sticky_posts' => true
                    );
                    $fairy_featured_query = new WP_Query($fairy_cat_post_args);
                    ?>
                    <div class="row">
                        <?php
                        if ($fairy_featured_query->have_posts()) :

                        while ($fairy_featured_query->have_posts()) : $fairy_featured_query->the_post();
                            ?>
                            <div class="col-1-1 col-sm-1-2 col-md-1-2">
                                <div class="card card-blog-post card-full-width">
                                    <?php
                                    if (has_post_thumbnail()):
                                        ?>
                                        <figure class="card_media">
                                            <a href="<?php the_permalink() ?>">
                                                <?php the_post_thumbnail('fairy-medium'); ?>
                                            </a>
                                        </figure>
                                    <?php
                                    endif;
                                    ?>
                                    <div class="card_body">
                                        <?php fairy_list_category(); ?>
                                        <h4 class="card_title">
                                            <a href="<?php the_permalink() ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h4>
                                        <div class="entry-meta">
                                            <?php
                                                fairy_posted_on();
                                                fairy_posted_by();
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endwhile;
                        ?>
                    </div>

                <?php
                endif;
                wp_reset_postdata();
                ?>
                </div> <!-- .related-post -->
                <?php
            }
        }
    }
endif;
add_action('fairy_related_posts', 'fairy_related_post', 10, 1);


if (!function_exists('fairy_constuct_carousel')) {
    /**
     * Add carousel on header
     *
     * @since 1.0.0
     */
    function fairy_constuct_carousel()
    {

        if (is_front_page()) {
            global $fairy_theme_options;
            if ($fairy_theme_options['fairy-enable-slider'] != 1)
                return false;
            $featured_cat = absint($fairy_theme_options['fairy-select-category']);
            $fairy_slider_args = array();
            if(is_rtl()){
                $fairy_slider_args['rtl'] = true;
            }
            $fairy_slider_args_encoded = wp_json_encode( $fairy_slider_args );
            $query_args = array(
                'post_type' => 'post',
                'ignore_sticky_posts' => true,
                'posts_per_page' => 6,
                'cat' => $featured_cat
            );

            $query = new WP_Query($query_args);
            if ($query->have_posts()) :
                ?>
                <section class="hero hero-slider-section">
                    <div class="container">
                        <!-- slick slider component start -->
                        <div class="hero_slick-slider" data-slick='<?php echo $fairy_slider_args_encoded; ?>'>
                            <?php
                            $i = 1;
                            while ($query->have_posts()) :
                                $query->the_post();

                                ?>
                                <div class="card card-bg-image">
                                    <?php
                                    if (has_post_thumbnail()) {
                                        ?>
                                        <div class="post-thumb">
                                            <figure class="card_media">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php
                                                    $cropped_image = $fairy_theme_options['fairy-image-size-slider'];
                                                    if($cropped_image == 'cropped-image'){
                                                        the_post_thumbnail('fairy-large');
                                                    }else{
                                                        the_post_thumbnail();
                                                    }
                                                    ?>
                                                </a>
                                            </figure>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="post-thumb">
                                            <a href="<?php the_permalink(); ?>">

                                                <img src="<?php echo esc_url(get_template_directory_uri()) . '/candidthemes/assets/custom/img/fairy-default.jpg' ?>"
                                                     alt="<?php the_title(); ?>">

                                            </a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <article class="card_body">
                                        <?php
                                            fairy_list_category();
                                        ?>

                                        <h3 class="card_title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>

                                        <div class="entry-meta">
                                            <?php
                                                fairy_posted_on();
                                                fairy_posted_by();
                                            ?>
                                        </div>
                                    </article>

                                </div>
                                <?php
                                $i++;

                            endwhile;
                            ?>
                        </div>
                    </div>
                </section><!-- .hero -->
            <?php
            endif;
            wp_reset_postdata();


        }//is_front_page
    }
}
add_action('fairy_carousel', 'fairy_constuct_carousel', 10);


if (!function_exists('fairy_breadcrumb_options')) :
    /**
     * Functions to manage breadcrumbs
     */
    function fairy_breadcrumb_options()
    {
        global $fairy_theme_options;
        if (($fairy_theme_options['fairy-blog-site-breadcrumb'] == 1) && !is_front_page()) {
            $breadcrumb_from = $fairy_theme_options['fairy-breadcrumb-display-from-option'];

            if ((function_exists('yoast_breadcrumb')) && ($breadcrumb_from == 'yoast-breadcrumb')) {
                ?>
                <div class="fairy-breadcrumb-wrapper">
                    <?php
                    yoast_breadcrumb();
                    ?>
                </div>
                <?php
            } elseif ((function_exists('rankmath-breadcrumb')) && ($breadcrumb_from == 'rank-math')) {
                ?>
                <div class="fairy-breadcrumb-wrapper">
                    <?php
                    rank_math_the_breadcrumbs();
                    ?>
                </div>
                <?php
            } elseif ((function_exists('bcn_display')) && ($breadcrumb_from == 'breadcrumb-navxt')) {
                ?>
                <div class="fairy-breadcrumb-wrapper">
                    <?php
                    bcn_display();
                    ?>
                </div>
                <?php
            } else {
                ?>
                <div class="fairy-breadcrumb-wrapper">
                    <?php
                    fairy_breadcrumbs();
                    ?>
                </div>
                <?php
            }
        }
    }
endif;
add_action('fairy_breadcrumb', 'fairy_breadcrumb_options', 10);


/**
 * BreadCrumb Settings
 */
if (!function_exists('fairy_breadcrumbs')):
    function fairy_breadcrumbs()
    {
        $breadcrumb_args = array(
            'container' => 'div',
            'show_browse' => false
        );
        global $fairy_theme_options;

        $fairy_you_are_here_text = esc_html($fairy_theme_options['fairy-breadcrumb-text']);


        if (!empty($fairy_you_are_here_text)) {
            $fairy_you_are_here_text = "<span class='breadcrumb'>" . $fairy_you_are_here_text . "</span>";
        }
        echo "<div class='breadcrumbs init-animate clearfix'>" . $fairy_you_are_here_text . "<div id='fairy-breadcrumbs' class='clearfix'>";
        breadcrumb_trail($breadcrumb_args);
        echo "</div></div>";

    }
endif;