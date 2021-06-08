<?php
/****************************/
/*     Navigation Menu
/****************************/

add_action( 'init', array( 'WN_Nav_Menu_Item_Custom_Fields', 'setup' ) );
 
class WN_Nav_Menu_Item_Custom_Fields {
 
    static $options = array();
    
    static function setup() {
        // @todo we can do some merging of provided options from WP options for from config
        self::$options['fields'] = array(
            'color' => array(
                'name'              => 'bgcolor',
                'label'             => __('Badge Background Color', 'deep'),
                'container_class'   => 'badge-background-color',
                'input_type'        => 'color',
            ),
            'badge' =>array(
                'name'              => 'badge',
                'label'             => __('Badge Text', 'deep'),
                'container_class'   => 'badge-text',
                'input_type'        => 'textarea',
            ),

        );
 
        add_filter( 'wp_edit_nav_menu_walker', function () {
            return 'WN_Walker_Nav_Menu_Edit';
        });
        add_filter( 'wn_nav_menu_item_additional_fields', array( __CLASS__, '_add_fields' ), 10, 5 );
        add_action( 'save_post', array( __CLASS__, '_save_post' ), 10, 2 );
    }
 
    static function get_fields_schema() {
        $schema = array();
        foreach(self::$options['fields'] as $name => $field) {
            if (empty($field['name'])) {
                $field['name'] = $name;
            }
            $schema[] = $field;
        }
        return $schema;
    }
 
    static function get_menu_item_postmeta_key($name) {
        return '_menu_item_' . $name;
    }
 
    /**
     * Inject the 
     * @hook {action} save_post
     */
    static function _add_fields($new_fields, $item_output, $item, $depth, $args) {
        
        $schema = self::get_fields_schema($item->ID);
        
        $new_fields = '';       
        
        foreach($schema as $field) {
            
            $field['value'] = get_post_meta($item->ID, self::get_menu_item_postmeta_key($field['name']), true);
            $field['id'] = $item->ID;
                        
            $new_fields .= '<p class="additional-menu-field-'.$field['name'].' description description-thin"><label for="edit-menu-item-'.$field['name'].'-'.$field['id'].'">'.$field['label'].'<br />';
            if( $field['name'] == 'icon'){ 
               $new_fields .= '<i style="font-size:24px;" class="webnus-menu-icon"></i><input type="hidden" id="edit-menu-item-icon-'.$field['id'].'" class="deep_megamenu_admin_icon_text widefat code edit-menu-item-custom" name="menu-item-icon['.$field['id'].']" value="'.$field['value'].'" />
                        <button type="button" class="deep_megamenu_admin_icon" >Choose Icon</button>
                        <button type="button" class="deep_megamenu_admin_icon_remove" >Remove Icon</button>';
            }else{
                $new_fields .= '<input type="'.$field['input_type'].'" ';
                $new_fields .= 'id="edit-menu-item-'.$field['name'].'-'.$field['id'].'"';
                $new_fields .= 'class="widefat code edit-menu-item-'.$field['name'].'"';
                $new_fields .= 'name="menu-item-'.$field['name'].'['.$field['id'].']"';
                $new_fields .= 'value="'.$field['value'].'"';
                $new_fields .= ' />';
            }

            

            $new_fields .= '</label></p>';
            
        }
        return $new_fields;
    }
 
    /**
     * Save the newly submitted fields
     * @hook {action} save_post
     */
    static function _save_post($post_id) {
        if (get_post_type($post_id) !== 'nav_menu_item') {
            return $post_id;
        }
        $fields_schema = self::get_fields_schema($post_id);
        foreach(self::$options['fields'] as $field_schema) {
            $form_field_name = 'menu-item-' . $field_schema['name'];
            $key = self::get_menu_item_postmeta_key($field_schema['name']);
            $value = isset( $_POST[$form_field_name][$post_id] ) ? stripslashes($_POST[$form_field_name][$post_id]) : '';                   
            update_post_meta($post_id, $key, $value);
        }
    }
 
}

require_once ABSPATH . 'wp-admin/includes/nav-menu.php';
class WN_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit {
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $item_output = '';
        parent::start_el($item_output, $item, $depth, $args);
        $new_fields = apply_filters( 'wn_nav_menu_item_additional_fields', '', $item_output, $item, $depth, $args );
        // Inject $new_fields before: <div class="menu-item-actions description-wide submitbox">
        if ($new_fields) {
            $item_output = preg_replace('/(?=<div[^>]+class="[^"]*submitbox)/', $new_fields, $item_output);
        }
        $output .= $item_output;
    }
}

/** Walker Nav Menu */
class wn_description_walker extends Walker_Nav_Menu{

    function start_el(&$output, $item, $depth=0, $args=array(),$current_object_id=0){

        $this->curItem = $item;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $class_names = $value = $mega_class = '';

        $is_mega = ( $item->object == 'mega_menu' ) ? true : false;

        if( $is_mega ) {
            $mega_class = ' mega';
        }

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . $mega_class . '"' : '';
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        
        $output .= $indent . '<li' . $id . $value . $class_names .'>';
        $atts = array();
        $atts['title']      = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target']     = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']        = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']       = ! empty( $item->url )        ? $item->url        : '';
        $atts['badge']      = ! empty( $item->badge )      ? $item->badge      : '';
        $atts['bgcolor']    = ! empty( $item->bgcolor )    ? $item->bgcolor    : '';
        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
        $attributes = '';
        $item_output = '';

        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr && ! empty( $item->url ) && ! $is_mega ) ? esc_url( $value ) : '#';
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $badge_text = get_post_meta($item->ID, '_menu_item_badge', true);
        $badge_color = get_post_meta($item->ID, '_menu_item_bgcolor', true);

        if('page'  == $item->object){
            $item_output .= $args->before;
            /** colorize categories in menu */
            $color ='';
            if ($item->object == 'category'){
                $cat_data = get_option("category_$item->object_id");
                $color = (!empty($cat_data['catBG']))?'style="color:'. $cat_data['catBG'] .'"':'';
            }
            $item_output .= '<a '. $color . $attributes. ' data-description="' .$item->description .'">';
            if(!empty($item->icon))
            $item_output .= '<i class="'.$item->icon.' wn-menu-icon"></i>';
            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
            if(!empty($badge_text))
            $item_output .= '<span class="menu-item-badge"><span class="menu-item-badge-text" style="background-color:'.$badge_color.';">'.$badge_text.'</span><span class="menu-item-badge-border" style="border-top-color:'.$badge_color.';color:'.$badge_color.';"></span></span>';
            if ( ! empty( $item->description ) ) {
                 $item_output .= '<div class="wn-menu-desc">' . $item->description . '</div>';
            }
            $item_output .= '</a>';
            $item_output .= $args->after;
            // mega menu
        }
        else{
            $item_output .= isset( $args->before ) ? $args->before : '';
            $item_output .= '<a '. $attributes. ' data-description="' .$item->description .'">';
            if(!empty($item->icon))
                $item_output .= '<i class="'.$item->icon.' wn-menu-icon"></i>';
            $item_output .= isset( $args->link_before ) ? $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) : '';
            $item_output .= isset( $args->link_after ) ? $args->link_after : '';
            if(!empty($badge_text))
            $item_output .= '<span class="menu-item-badge"><span class="menu-item-badge-text" style="background-color:'.$badge_color.';">'.$badge_text.'</span><span class="menu-item-badge-border" style="border-top-color:'.$badge_color.';color:'.$badge_color.';"></span></span>';
            if ( ! empty( $item->description ) ) {
                 $item_output .= '<div class="wn-menu-desc">' . $item->description . '</div>';
            }
            $item_output .= '</a>';
            $item_output .= isset( $args->after ) ? $args->after : '';
        }

        if( $is_mega ) {
            $post_obj = get_post( $item->object_id, 'OBJECT' );
            if ( did_action( 'elementor/loaded' ) ) {
                $item_output .= '<ul class="sub-menu"><li>' .  \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($post_obj->ID) . '</li></ul>';
            } elseif ( is_plugin_active( 'kingcomposer/kingcomposer.php' ) ) {
                // Export Style from post_content
                $content = $post_obj->post_content;
                $footerStyle = find_string($content, '<style  >', '</style>');
                deep_save_dyn_styles( $footerStyle );
                $item_output .= '<ul class="sub-menu"><li>' .  do_shortcode( $post_obj->post_content_filtered ) . '</li></ul>';
            }

            if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
                $content = $post_obj->post_content;              
                $footerStyle = find_string($content, '<style  >', '</style>');
                deep_save_dyn_styles( $footerStyle );
                $item_output .= '<ul class="sub-menu"><li>' .  do_shortcode( $content ) . '</li></ul>';
            }

            // Mega menu meta
            $megamenu_width = rwmb_meta( 'megamenu_width', '', $post_obj->ID );
            $megamenu_display = rwmb_meta( 'megamenu_full_relative', '', $post_obj->ID );            
            
            // Set default value for the mega menu
            $deep_options = deep_options();
            $width = ( ! empty( $deep_options['deep_container_width'] ) ) ? $deep_options['deep_container_width'] : '';                        

            if ( empty($megamenu_width) ) {                
                deep_save_dyn_styles( '@media ( min-width:1281px) {#wrap .whb-nav-wrap .nav li.menu-item-' . $item->ID . '.mega ul.sub-menu {  width: 1603px; left: 50%; transform: translate(-50%, 0); } }' );
            } 

            if ( $megamenu_display == 'inheritfl' ) {
                deep_save_dyn_styles( '@media ( min-width:1281px) {#wrap .whb-nav-wrap .nav li.menu-item-' . $item->ID . '.mega ul.sub-menu {  width: '.$megamenu_width.'px !important; left: 50%; transform: translate(-50%, 0); } }' );
            }
           
            if ( $megamenu_display == 'inherit' ) {                
                deep_save_dyn_styles( '@media ( min-width:1281px) {#wrap .whb-nav-wrap .nav li.menu-item-' . $item->ID . '.mega ul.sub-menu { width: '.$width.'px; left: 50%; transform: translate(-50%, 0); } }' );
            } else {
                deep_save_dyn_styles( '@media ( min-width:1281px) {#wrap .whb-nav-wrap .nav li.menu-item-' . $item->ID . '.mega ul.sub-menu { width: 96%; left: 50%; transform: translate(-50%, 0); } }' );
            }           

        }

        /** mega posts start */
        if ( $depth == 0 && $item->object == 'category' && $item->classes['0'] == "mega" ) {
            $item_output .= '<ul class="sub-posts">';
                global $post;
                $menuposts = get_posts( array( 'posts_per_page' => 4, 'category' => $item->object_id ) );
                foreach( $menuposts as $post ):
                    $post_title = get_the_title();
                    $post_link = get_permalink();
                    $post_time = get_the_time(get_option( 'date_format' ));
                    $post_comments = get_comments_number();
                    $post_views = wn_getViews(get_the_ID());
                    $post_image = wp_get_attachment_image_src( get_post_thumbnail_id(), "wn_latestfromblog" );
                    if ( $post_image != ''){
                        $menu_post_image = '<img src="' . $post_image[0]. '" alt="' . $post_title . '" width="' . $post_image[1]. '" height="' . $post_image[2]. '" />';
                    } else {
                        $menu_post_image = esc_html__( 'No image','deep');
                    }
                    $item_output .= '
                            <li>
                                <figure>
                                    <a href="'  .esc_url($post_link) . '">' . $menu_post_image . '</a>
                                </figure>
                                <h5><a href="' . esc_url($post_link) . '">' . $post_title . '</a></h5>
                            </li>';
                endforeach;
                wp_reset_postdata();
            $item_output .= '</ul>';
        }

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}