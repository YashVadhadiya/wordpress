<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fairy
 */
global $fairy_theme_options;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <!-- 
        for full single column card layout add [.card-full-width] class 
        for reverse align for figure and card_body add [.reverse-row] class in .card-blog-post
    -->
    <?php
    $image_alignment_class = '';
    $image_alignment = esc_attr($fairy_theme_options['fairy-blog-page-masonry-normal']);
    if($image_alignment == 'full-image'){
        $image_alignment_class = 'card-full-width';
    }
    ?>
    <div class="card card-blog-post <?php echo esc_attr($image_alignment_class); ?>">
        <?php
        if(has_post_thumbnail()) {
            ?>
            <figure class="post-thumbnail card_media">
                <a href="<?php the_permalink(); ?>">
                    <?php
                    $cropped_image = esc_attr($fairy_theme_options['fairy-image-size-blog-page']);
                    if($cropped_image == 'cropped-image'){
                        the_post_thumbnail('fairy-medium');
                    }else{
                        the_post_thumbnail();
                    }

                    ?>
                </a>
            </figure>
            <?php
        }
        ?>
        <div class="card_body">
            <!-- To have a background category link add [.bg-label] in category-label-group class -->
            <div>
            <?php
                fairy_list_category();

            if (is_singular()) :
                the_title('<h1 class="card_title">', '</h1>');
            else :
                the_title('<h2 class="card_title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            endif;
            ?>
            <?php

            if ('post' === get_post_type()) :
                ?>
                <div class="entry-meta">
                    <?php
                        fairy_posted_on();
                        fairy_posted_by();
                    ?>
                </div><!-- .entry-meta -->
            <?php endif; ?>
            </div>
            <div>
            <div class="entry-content">
                <?php
                if (is_singular()) {
                    the_content(
                        sprintf(
                            wp_kses(
                            /* translators: %s: Name of current post. Only visible to screen readers */
                                __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'fairy'),
                                array(
                                    'span' => array(
                                        'class' => array(),
                                    ),
                                )
                            ),
                            wp_kses_post(get_the_title())
                        )
                    );

                    wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'fairy'),
                            'after' => '</div>',
                        )
                    );
                } else {
                    if($fairy_theme_options['fairy-content-show-from'] == 'excerpt'){
                        the_excerpt();
                    }elseif($fairy_theme_options['fairy-content-show-from'] == 'content'){
                        the_content();
                    }else{
                        echo "";
                    }

                }
                ?>
            </div>
            <?php
            if(($fairy_theme_options['fairy-content-show-from'] == 'excerpt') && (!is_singular())){
                $read_more_text = esc_html($fairy_theme_options['fairy-read-more-text']);

                if(!empty($read_more_text)){
                ?>
                <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                    <?php
                        echo esc_html($read_more_text);
                    ?>
                </a>
                <?php

                }
            }
            ?>
            </div>


        </div>
    </div>


    <!--<footer class="entry-footer">
		<?php // fairy_entry_footer(); ?>
	</footer>--><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
