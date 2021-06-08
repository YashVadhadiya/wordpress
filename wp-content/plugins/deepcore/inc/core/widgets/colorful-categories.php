<?php
/**
 * Class Deep_ColorfulCategoriesWidget
 * Colorful categories widget
 */
class Deep_ColorfulCategoriesWidget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'colorful_categories_widget',
            __('Colorful categories', 'deep'),
            array('description' => __('A list of categories in awesome colors', 'deep'))
        );
    }

    /**
     * @return array
     */
    protected function getThemes()
    {
        return apply_filters('colorful_categories_themes', array(
            ''       => __('No theme', 'deep'),
            'bubble' => __('Bubble', 'deep'),
            'box'    => __('Box', 'deep')
        ));
    }

    public function form($instance)
    {
        $instance = wp_parse_args((array) $instance, array('title' => '', 'taxonomy' => ''));
        $title = esc_attr($instance['title']);
        $empty = isset($instance['empty']) && $instance['empty'];
        $count = isset($instance['count']) ? (bool) $instance['count'] : false;
        $excluded = isset($instance['excluded']) ? trim($instance['excluded']) : '';
        $limit = isset($instance['limit']) ? (int) $instance['limit'] : '';
        ?>
        <p><label for="<?php echo '' . $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'deep' ); ?></label>
        <input class="widefat" id="<?php echo '' . $this->get_field_id('title'); ?>" name="<?php echo '' . $this->get_field_name('title'); ?>" type="text" value="<?php echo '' . $title; ?>" /></p>

        <p>
            <label for="<?php echo '' . $this->get_field_id('taxonomy'); ?>"><?php _e( 'Taxonomy:', 'deep' ); ?></label><br />
            <select id="<?php echo '' . $this->get_field_id('taxonomy'); ?>" name="<?php echo '' . $this->get_field_name('taxonomy'); ?>">
                <?php
                $taxonomies = Deep_ColorfulCategories::getTaxonomies();
                foreach($taxonomies as $taxonomy) {
                    $tax = get_taxonomy($taxonomy);
                    echo '<option value="' . $taxonomy . '" ' . selected($taxonomy, $instance['taxonomy']) . '>' . esc_html($tax->label) . ' [' . $taxonomy . ']</option>';
                }
                ?>
            </select>
        </p>

        <input type="checkbox" class="checkbox" id="<?php echo '' . $this->get_field_id('empty'); ?>" name="<?php echo '' . $this->get_field_name('empty'); ?>"<?php checked( $empty ); ?> />
        <label for="<?php echo '' . $this->get_field_id('empty'); ?>"><?php _e( 'Show empty categories', 'deep' ); ?></label><br />

        <input type="checkbox" class="checkbox" id="<?php echo '' . $this->get_field_id('count'); ?>" name="<?php echo '' . $this->get_field_name('count'); ?>"<?php checked( $count ); ?> />
        <label for="<?php echo '' . $this->get_field_id('count'); ?>"><?php _e( 'Show post counts', 'deep' ); ?></label><br />

        <p>
            <label for="<?php echo '' . $this->get_field_id('theme'); ?>"><?php _e( 'Theme', 'deep' ); ?></label><br />
            <select id="<?php echo '' . $this->get_field_id('theme'); ?>" name="<?php echo '' . $this->get_field_name('theme'); ?>">
                <?php
                $default = isset($instance['theme']) ? $instance['theme'] : '';
                foreach($this->getThemes() as $slug => $name) {
                    echo '<option value="' . esc_attr($slug) . '" ' . selected($slug, $default) . '>' . esc_html($name) . '</option>';
                }
                ?>
            </select>
        </p>

        <p><label for="<?php echo '' . $this->get_field_id('limit'); ?>"><?php _e( 'Limit items (0 means no limit):', 'deep' ); ?></label>
        <input class="widefat" id="<?php echo '' . $this->get_field_id('limit'); ?>" name="<?php echo '' . $this->get_field_name('limit'); ?>" type="text" maxlength="3" value="<?php echo '' . $limit; ?>" /></p>

        <p>
            <label for="<?php echo '' . $this->get_field_id('excluded'); ?>"><?php _e( 'Excluded categories IDs (comma separated):', 'deep' ); ?></label>
            <br />
            <textarea id="<?php echo '' . $this->get_field_id('excluded'); ?>" name="<?php echo '' . $this->get_field_name('excluded'); ?>" style="width: 100%;"><?=esc_textarea($excluded)?></textarea>
        </p>

        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['taxonomy'] = strip_tags($new_instance['taxonomy']);
        $instance['empty'] = !empty($new_instance['empty']) ? 1 : 0;
        $instance['count'] = !empty($new_instance['count']) ? 1 : 0;
        $instance['theme'] = sanitize_text_field($new_instance['theme']);
        $instance['limit'] = (int) $new_instance['limit'];
        $instance['excluded'] = sanitize_text_field($new_instance['excluded']);
        return $instance;
    }

    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', empty($instance['title']) ? __('Categories', 'deep') : $instance['title'], $instance, $this->id_base);

        $theme = isset($instance['theme']) ? $instance['theme'] : '';
        $excluded = isset($instance['excluded']) ? $instance['excluded'] : '';
        $t = isset($instance['taxonomy']) ? $instance['taxonomy'] : 'category';
        $c = !empty($instance['count']);
        $e = !empty($instance['empty']);
        $l = $instance['limit'] > 0 ? $instance['limit'] : '';

        echo '' . $args['before_widget'];
        if($title) {
            echo '' . $args['before_title'] . $title . $args['after_title'];
        }

        $terms = get_terms(apply_filters('colorful_categories_get_terms', array(
            'taxonomy'   => $t,
            'hide_empty' => !$e,
            'exclude'    => $excluded,
            'number'     => $l
        )));

        if(empty($terms)) {

            echo '<p class="deep-not-found">' . apply_filters('deep-not-found', __('List is empty', 'deep'), $t) . '</p>';

        } else {

            ?>
            <ul class="deep-colorful-cat<?=empty($theme) ? '' : ' ' . esc_attr($theme)?>">
            <?php

            /** @var WP_Term $term */
            foreach($terms as $term) {

                $text = stripslashes($term->name);
                if($c) {
                    $text .= ' <sup>' . $term->count . '</sup>';
                }

                $color = Deep_ColorfulCategories::getColorForTerm($term->term_id, true);

                echo '<li class="' . esc_attr($term->slug) . '"><a href="' . esc_url(get_term_link($term)) . '" style="background-color: ' . $color . ';">' . $text . '</a></li>';
            }

            echo '</ul>';
        }

        echo '' . $args['after_widget'];
    }
}
add_action('widgets_init', 'register_Deep_ColorfulCategoriesWidget');
function register_Deep_ColorfulCategoriesWidget(){
    register_widget('Deep_ColorfulCategoriesWidget');
}