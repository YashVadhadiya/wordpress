<?php
/**
 * Fairy Latest Post Widget
 *
 * @since 1.0.0
 */
if (!class_exists('Fairy_Latest_Post')) :

    /**
     * Highlight Post widget class.
     *
     * @since 1.0.0
     */
    class Fairy_Recent_Post extends WP_Widget
    {
        private function defaults()
        {
            $defaults = array(
                'title' => esc_html__('Recent Posts', 'fairy'),
                'post-number' => 5,
            );
            return $defaults;
        }

        public function __construct()
        {
            $opts = array(
                'classname' => 'fairy-latest',
                'description' => esc_html__('Recent Posts Widget with Thumbnail.', 'fairy'),
            );
            parent::__construct('fairy-latest', esc_html__('Fairy Recent Posts', 'fairy'), $opts);
        }

        public function widget($args, $instance)
        {
            $instance = wp_parse_args((array)$instance, $this->defaults());
            $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
            echo $args['before_widget'];

            if (!empty($title)) {
                echo $args['before_title'] . esc_html($title) . $args['after_title'];
            }
            $post_number = !empty($instance['post-number']) ? $instance['post-number'] : '';
            ?>


            <section class="latest-posts-block">
                <?php
                $p_query_args = array(
                    'post_type' => 'post',
                    'posts_per_page' => absint($post_number),
                    'ignore_sticky_posts' => true,
                );
                $p_query = new WP_Query($p_query_args);
                if ($p_query->have_posts()) :
                    ?>
                    <div class="list-post-block">
                        <ul class="list-post">
                            <?php
                            while ($p_query->have_posts()):
                                $p_query->the_post();
                                ?>
                                <li>
                                    <div class="post-block-style">

                                        <?php

                                        if (has_post_thumbnail()) {
                                            ?>
                                            <div class="post-thumb">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail('thumbnail'); ?>
                                                </a>
                                            </div><!-- Post thumb end -->
                                        <?php } ?>

                                        <div class="post-content">
                                            <?php fairy_list_category(); ?>
                                            <h3 class="post-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>
                                            <div class="post-meta">
                                                <?php
                                                fairy_posted_on();
                                                ?>
                                            </div>

                                        </div><!-- Post content end -->
                                    </div><!-- Post block style end -->
                                </li><!-- Li 1 end -->

                            <?php endwhile;
                            wp_reset_postdata(); ?>

                        </ul><!-- List post end -->
                    </div><!-- List post block end -->
                <?php
                endif;
                ?>
            </section>

            <?php
            echo $args['after_widget'];
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;

            $instance['title'] = sanitize_text_field($new_instance['title']);
            $instance['post-number'] = absint($new_instance['post-number']);

            return $instance;
        }

        public function form($instance)
        {
            $instance = wp_parse_args((array )$instance, $this->defaults());

            $title = esc_attr($instance['title']);
            $post_number = absint($instance['post-number']);

            ?>
            <p>
                <label
                        for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Widget Title:', 'fairy'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
                       value="<?php echo esc_attr($instance['title']); ?>"/>
            </p>
            <p>
                <label
                        for="<?php echo esc_attr($this->get_field_id('post-number')); ?>"><?php esc_html_e('Number of Posts to Display:', 'fairy'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('post-number')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('post-number')); ?>" type="number"
                       value="<?php echo esc_attr($instance['post-number']); ?>"/>
            </p>

            <?php
        }
    }
endif;