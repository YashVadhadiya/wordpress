<?php
/**
 *
 * Sidebar Layout Options
 *
 * @since  1.0.0
 *
 * @param null
 * @return array
 *
 */
if ( !function_exists('fairy_sidebar_layout_options') ) :
    function fairy_sidebar_layout_options() {
        $fairy_sidebar_layout_options = array(
            'left-sidebar' => array(
                'value'     => 'left-sidebar',
                'thumbnail' => get_template_directory_uri() . '/candidthemes/assets/custom/img/left-sidebar.jpg'
            ),
            'right-sidebar' => array(
                'value' => 'right-sidebar',
                'thumbnail' => get_template_directory_uri() . '/candidthemes/assets/custom/img/right-sidebar.jpg'
            ),
            'middle-column' => array(
                'value'     => 'middle-column',
                'thumbnail' => get_template_directory_uri() . '/candidthemes/assets/custom/img/middle-column.jpg'
            ),
            'no-sidebar' => array(
                'value'     => 'no-sidebar',
                'thumbnail' => get_template_directory_uri() . '/candidthemes/assets/custom/img/no-sidebar.jpg'
            ),
            'default-sidebar' => array(
                'value'     => 'default-sidebar',
                'thumbnail' => get_template_directory_uri() . '/candidthemes/assets/custom/img/default-sidebar.jpg'
            )
        );
        return apply_filters( 'fairy_sidebar_layout_options', $fairy_sidebar_layout_options );
    }
endif;

/**
 * Custom Metabox
 *
 * @since Refined Magazine 1.0.0
 *
 * @param null
 * @return void
 *
 */
if( !function_exists( 'fairy_add_metabox' )):
    function fairy_add_metabox() {
        add_meta_box(
            'fairy_sidebar_layout', // $id
            __( 'Sidebar Layout', 'fairy' ), // $title
            'fairy_sidebar_layout_callback', // $callback
            'post', // $page
            'normal', // $context
            'high'
        ); // $priority
        
        add_meta_box(
            'fairy_sidebar_layout', // $id
            __( 'Sidebar Layout', 'fairy' ), // $title
            'fairy_sidebar_layout_callback', // $callback
            'page', // $page
            'normal', // $context
            'high'
        ); // $priority
    }
endif;
add_action('add_meta_boxes', 'fairy_add_metabox');

/**
 * Callback function for metabox
 *
 * @since Refined Magazine 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('fairy_sidebar_layout_callback') ) :
    function fairy_sidebar_layout_callback(){
        global $post;
        $fairy_sidebar_layout_options = fairy_sidebar_layout_options();
        $fairy_sidebar_layout = 'default-sidebar';
        $fairy_sidebar_meta_layout = get_post_meta( $post->ID, 'fairy_sidebar_layout', true );
        if( !fairy_is_null_or_empty($fairy_sidebar_meta_layout) ){
            $fairy_sidebar_layout = $fairy_sidebar_meta_layout;
        }
        wp_nonce_field( basename( __FILE__ ), 'fairy_sidebar_layout_nonce' );
        ?>
        <style>
            .hide-radio{
                position: relative;
                margin-bottom: 6px;
            }
            
            .hide-radio img, .hide-radio label{
                display: block;
            }
            
            .hide-radio input[type="radio"]{
                position: absolute;
                left: 50%;
                top: 50%;
                opacity: 0;
            }
            
            .hide-radio input[type=radio] + label {
                border: 3px solid #F1F1F1;
            }
            
            .hide-radio input[type=radio]:checked + label {
                border: 3px solid #F88C00;
            }
        </style>
        <table class="form-table page-meta-box">
            <tr>
                <td colspan="4"><h4><?php _e( 'Choose Sidebar Template', 'fairy' ); ?></h4></td>
            </tr>
            <tr>
                <td>
                    <?php
                    foreach ($fairy_sidebar_layout_options as $field) {
                        ?>
                        <div class="hide-radio radio-image-wrapper" style="float:left; margin-right:30px;">
                            <input id="<?php echo $field['value']; ?>" type="radio" name="fairy_sidebar_layout" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], $fairy_sidebar_layout ); ?>/>
                            <label class="description" for="<?php echo $field['value']; ?>">
                                <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="" />
                            </label>
                        </div>
                    <?php } // end foreach
                    ?>
                    <div class="clear"></div>
                </td>
            </tr>
            <tr>
                <td><em class="f13"><?php _e( 'You can set up the sidebar content', 'fairy' ); ?> <a href="<?php echo admin_url('/widgets.php'); ?>"><?php _e( 'here', 'fairy' ); ?></a></em></td>
            </tr>
        </table>
        <?php
    }
endif;

/**
 * save the custom metabox data
 * @hooked to save_post hook
 *
 * @since Refined Magazine 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('fairy_save_sidebar_layout') ) :
    function fairy_save_sidebar_layout( $post_id ) {
        /*
          * A Guide to Writing Secure Themes – Part 4: Securing Post Meta
          *https://make.wordpress.org/themes/2015/06/09/a-guide-to-writing-secure-themes-part-4-securing-post-meta/
          * */
        if (
            !isset( $_POST[ 'fairy_sidebar_layout_nonce' ] ) ||
            !wp_verify_nonce( $_POST[ 'fairy_sidebar_layout_nonce' ], basename( __FILE__ ) ) || /*Protecting against unwanted requests*/
            ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || /*Dealing with autosaves*/
            ! current_user_can( 'edit_post', $post_id )/*Verifying access rights*/
        ){
            return;
        }
        
        //Execute this saving function
        if(isset($_POST['fairy_sidebar_layout'])){
            $old = get_post_meta( $post_id, 'fairy_sidebar_layout', true);
            $new = sanitize_text_field($_POST['fairy_sidebar_layout']);
            if ($new && $new != $old) {
                update_post_meta($post_id, 'fairy_sidebar_layout', $new);
            } elseif ('' == $new && $old) {
                delete_post_meta($post_id,'fairy_sidebar_layout', $old);
            }
        }
    }
endif;
add_action('save_post', 'fairy_save_sidebar_layout');