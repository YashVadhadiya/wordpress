<?php
/**
 * Author Profile Widget
 *
 * @package Fairy
 */

if (!class_exists('Fairy_Author_Widget')) :

    /**
     * Author widget class.
     *
     * @since Fairy 1.0.0
     */
    class Fairy_Author_Widget extends WP_Widget
    {

        /**
         * Constructor.
         *
         * @since Fairy 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'fairy_widget_author',
                'description' => esc_html__('Display Author Profile.', 'fairy'),
                'customize_selective_refresh' => true,
            );
            parent::__construct('fairy-author', esc_html__('Fairy Author', 'fairy'), $opts);
        }

        /**
         * Echo the widget content.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments including before_title, after_title,
         *                        before_widget, and after_widget.
         * @param array $instance The settings for the particular instance of the widget.
         */
        function widget($args, $instance)
        {

            $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

            $author_description = !empty($instance['author_description']) ? $instance['author_description'] : '';

            $author_image = !empty($instance['author_image']) ? $instance['author_image'] : '';

            $author_facebook = !empty($instance['author_facebook']) ? $instance['author_facebook'] : '';

            $author_twitter = !empty($instance['author_twitter']) ? $instance['author_twitter'] : '';

            $author_linkedin = !empty($instance['author_linkedin']) ? $instance['author_linkedin'] : '';

            $author_instagram = !empty($instance['author_instagram']) ? $instance['author_instagram'] : '';

            $author_pinterest = !empty($instance['author_pinterest']) ? $instance['author_pinterest'] : '';

            $author_youtube = !empty($instance['author_youtube']) ? $instance['author_youtube'] : '';

            $author_vk = !empty($instance['author_vk']) ? $instance['author_vk'] : '';

            $author_sign = !empty($instance['author_sign']) ? $instance['author_sign'] : '';

            echo $args['before_widget']; ?>

            <div class="fairy-author-profile">

                <?php

                if ($title) {
                    echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
                } ?>

                <div class="profile-wrapper social-menu-wrap">
                    <?php
                    if (isset($author_image) && !empty($author_image)) {
                        ?>
                        <figure class="author">
                            <img src="<?php echo esc_url($instance['author_image']); ?>">
                        </figure>
                    <?php
                    }
                    ?>

                    <p><?php if (isset($author_description) && !empty($author_description)) {
                            echo wp_kses_post($instance['author_description']);
                        } ?></p>

                    <?php
                            if (isset($author_sign) && !empty($author_sign)) {
                                ?>
                                <figure class="author-sign">
                                    <img src="<?php echo esc_url($instance['author_sign']); ?>">
                                </figure>
                            <?php
                            }
                            ?>


                    <?php if ($author_facebook || $author_twitter || $author_linkedin || $author_instagram || $author_pinterest || $author_youtube || $author_vk) { ?>
                        <ul class="menu author-social-profiles fairy-menu-social">
                            <?php if ($author_facebook) { ?>
                                <li>
                                    <a href="<?php echo esc_url($author_facebook); ?>" target="_blank"><span
                                            class="screen-reader-text"><?php esc_html_e('facebook', 'fairy'); ?></span></a>
                                </li>
                            <?php } ?>

                            <?php if ($author_twitter) { ?>
                                <li>
                                    <a href="<?php echo esc_url($author_twitter); ?>" target="_blank"><span
                                            class="screen-reader-text"><?php esc_html_e('twitter', 'fairy'); ?></span></a>
                                </li>
                            <?php } ?>

                            <?php if ($author_linkedin) { ?>
                                <li>
                                    <a href="<?php echo esc_url($author_linkedin); ?>" target="_blank"><span
                                            class="screen-reader-text"><?php esc_html_e('linkedin', 'fairy'); ?></span></a>
                                </li>
                            <?php } ?>

                            <?php if ($author_instagram) { ?>
                                <li>
                                    <a href="<?php echo esc_url($author_instagram); ?>" target="_blank"><span
                                            class="screen-reader-text"><?php esc_html_e('instagram', 'fairy'); ?></span></a>
                                </li>
                            <?php } ?>

                            <?php if ($author_pinterest) { ?>
                                <li>
                                    <a href="<?php echo esc_url($author_pinterest); ?>" target="_blank"><span
                                            class="screen-reader-text"><?php esc_html_e('pinterest', 'fairy'); ?></span></a>
                                </li>
                            <?php } ?>

                            <?php if ($author_youtube) { ?>
                                <li>
                                    <a href="<?php echo esc_url($author_youtube); ?>" target="_blank"><span
                                            class="screen-reader-text"><?php esc_html_e('youtube', 'fairy'); ?></span></a>
                                </li>
                            <?php } ?>

                            <?php if ($author_vk) { ?>
                                <li>
                                    <a href="<?php echo esc_url($author_vk); ?>" target="_blank"><span
                                            class="screen-reader-text"><?php esc_html_e('vk', 'fairy'); ?></span></a>
                                </li>
                            <?php } ?>

                        </ul>

                    <?php } ?>

                </div>
                <!-- .profile-wrapper -->

            </div><!-- .author-profile -->

            <?php

            echo $args['after_widget'];

        }

        /**
         * Update widget instance.
         *
         * @since 1.0.0
         *
         * @param array $new_instance New settings for this instance as input by the user via
         *                            {@see WP_Widget::form()}.
         * @param array $old_instance Old settings for this instance.
         * @return array Settings to save or bool false to cancel saving.
         */
        function update($new_instance, $old_instance)
        {

            $instance = $old_instance;

            $instance['title'] = sanitize_text_field($new_instance['title']);

            $instance['author_description'] = wp_kses_post($new_instance['author_description']);

            $instance['author_image'] = esc_url_raw($new_instance['author_image']);

            $instance['author_facebook'] = esc_url_raw($new_instance['author_facebook']);

            $instance['author_twitter'] = esc_url_raw($new_instance['author_twitter']);

            $instance['author_linkedin'] = esc_url_raw($new_instance['author_linkedin']);

            $instance['author_instagram'] = esc_url_raw($new_instance['author_instagram']);

            $instance['author_pinterest'] = esc_url_raw($new_instance['author_pinterest']);

            $instance['author_youtube'] = esc_url_raw($new_instance['author_youtube']);

            $instance['author_vk'] = esc_url_raw($new_instance['author_vk']);

            $instance['author_sign'] = esc_url_raw($new_instance['author_sign']);

            return $instance;
        }

        /**
         * Output the settings update form.
         *
         * @since 1.0.0
         *
         * @param array $instance Current settings.
         * @return void
         */
        function form($instance)
        {

            // Defaults.
            $defaults = array(
                'title' => esc_html__('About Us', 'fairy' ),
                'author_description' => '',
                'author_facebook' => '',
                'author_twitter' => '',
                'author_linkedin' => '',
                'author_instagram' => '',
                'author_pinterest' => '',
                'author_youtube' => '',
                'author_vk' => '',
            );

            $instance = wp_parse_args((array)$instance, $defaults);
            ?>

            <p>
                <label
                    for="<?php echo esc_attr($this->get_field_id('title')); ?>"><strong><?php esc_html_e('Title:', 'fairy'); ?></strong></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
                       value="<?php echo esc_attr($instance['title']); ?>"/>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('author_image'); ?>">
                    <?php _e('Select Image', 'fairy'); ?>
                </label>
                <br/>
                <?php
                if (isset($instance['author_image']) && $instance['author_image'] != '') :
                    echo '<img class="widefat custom_media_image" src="' . esc_url($instance['author_image']) . '" />';
                endif;
                ?>

                <input type="text" class="widefat custom_media_url"
                       name="<?php echo $this->get_field_name('author_image'); ?>"
                       id="<?php echo $this->get_field_id('author_image'); ?>" value="<?php
                if (isset($instance['author_image']) && $instance['author_image'] != '') :
                    echo esc_url($instance['author_image']);
                endif;
                ?>">
                <input type="button" class="button button-primary custom_media_button" id="custom_media_button"
                       name="<?php echo $this->get_field_name('author_image'); ?>"
                       value="<?php esc_attr_e('Upload Image', 'fairy') ?>"/>
            </p>

            <p>
                <label
                    for="<?php echo esc_attr($this->get_field_id('author_description')); ?>"><strong><?php esc_html_e('Description:', 'fairy'); ?></strong></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('author_description')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('author_description')); ?>" type="text"
                       value="<?php echo esc_attr($instance['author_description']); ?>"/>
            </p>


            <p>
                <label for="<?php echo $this->get_field_id('author_sign'); ?>">
                    <?php _e('Upload Author Signature Image', 'fairy'); ?>
                </label>
                <br/>
                <?php
                if (isset($instance['author_sign']) && $instance['author_sign'] != '') :
                    echo '<img class="widefat custom_media_image" src="' . esc_url($instance['author_sign']) . '" />';
                endif;
                ?>

                <input type="text" class="widefat custom_media_url"
                       name="<?php echo $this->get_field_name('author_sign'); ?>"
                       id="<?php echo $this->get_field_id('author_sign'); ?>" value="<?php
                if (isset($instance['author_sign']) && $instance['author_sign'] != '') :
                    echo esc_url($instance['author_sign']);
                endif;
                ?>">
                <input type="button" class="button button-primary custom_media_button" id="custom_media_button"
                       name="<?php echo $this->get_field_name('author_sign'); ?>"
                       value="<?php esc_attr_e('Upload Sign', 'fairy') ?>"/>
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_name('author_facebook')); ?>">
                    <?php esc_html_e('Facebook:', 'fairy'); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('author_facebook')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('author_facebook')); ?>" type="text"
                       value="<?php echo esc_url($instance['author_facebook']); ?>"/>
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_name('author_twitter')); ?>">
                    <?php esc_html_e('Twitter:', 'fairy'); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('author_twitter')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('author_twitter')); ?>" type="text"
                       value="<?php echo esc_url($instance['author_twitter']); ?>"/>
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_name('author_linkedin')); ?>">
                    <?php esc_html_e('LinkedIn:', 'fairy'); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('author_linkedin')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('author_linkedin')); ?>" type="text"
                       value="<?php echo esc_url($instance['author_linkedin']); ?>"/>
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_name('author_instagram')); ?>">
                    <?php esc_html_e('Instagram:', 'fairy'); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('author_instagram')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('author_instagram')); ?>" type="text"
                       value="<?php echo esc_url($instance['author_instagram']); ?>"/>
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_name('author_pinterest')); ?>">
                    <?php esc_html_e('Pinterest:', 'fairy'); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('author_pinterest')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('author_pinterest')); ?>" type="text"
                       value="<?php echo esc_url($instance['author_pinterest']); ?>"/>
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_name('author_youtube')); ?>">
                    <?php esc_html_e('Youtube:', 'fairy'); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('author_youtube')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('author_youtube')); ?>" type="text"
                       value="<?php echo esc_url($instance['author_youtube']); ?>"/>
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_name('author_vk')); ?>">
                    <?php esc_html_e('VK:', 'fairy'); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('author_vk')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('author_vk')); ?>" type="text"
                       value="<?php echo esc_url($instance['author_vk']); ?>"/>
            </p>

        <?php

        }
    }

endif;
add_action('admin_enqueue_scripts', 'fairy_widgets_backend_enqueue');
function fairy_widgets_backend_enqueue()
{
    wp_register_script('fairy-custom-widgets', get_template_directory_uri() . '/candidthemes/assets/custom/js/widget.js', array('jquery'), true);
    wp_enqueue_media();
    wp_enqueue_script('fairy-custom-widgets');
}