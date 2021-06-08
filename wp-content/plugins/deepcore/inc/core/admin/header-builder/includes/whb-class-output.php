<?php
/**
 * Header Builder - Header Output Class.
 *
 * @author  Webnus
 */

// don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

if ( ! class_exists( 'WHB_Output' ) ) :

    class WHB_Output {

		/**
		 * Instance of this class.
         *
		 * @since	1.0.0
		 * @access	private
		 * @var		WHB_Output
		 */
		private static $instance;

		/**
		 * Provides access to a single instance of a module using the singleton pattern.
		 *
		 * @since	1.0.0
		 * @return	object
		 */
		public static function get_instance() {

			if ( self::$instance === null ) {
				self::$instance = new self();
            }

			return self::$instance;

		}

		/**
		 * Constructor.
		 *
		 * @since	1.0.0
		 */
		public function __construct() {
		}

		/**
		 * Output header.
		 *
		 * @since	1.0.0
		 */
        public static function output($is_frontend_builder = false, $whb_data = array()) {

            $is_frontend_builder = $is_frontend_builder ? $is_frontend_builder : WHB_Helper::is_frontend_builder();

            $header_show = rwmb_meta( 'deep_header_show' );
            // header visibility
            if ( $header_show === '1') {
                $header_show = true;
            } elseif ( $header_show === '0' ) {
                $header_show = false;
            } elseif ( $header_show === false || empty( $header_show ) ) {
                $header_show = true;
            }

            if ( ! ( $is_frontend_builder || $header_show ) ) {
                return;
            }
            
            $header_options = WHB_Multilanguage::language() ? get_option( WHB_Multilanguage::language() . '_whb_data_frontend_components' ) : get_option( 'whb_data_frontend_components' );
            
            $whb_data = $whb_data ? $whb_data : $header_options;
            $class_frontend_builder = $is_frontend_builder ? ' whb-frontend-builder' : '';

            // Start render header output
            $output = '
            <header id="webnus-header-builder" class="whb-wrap' . esc_attr( $class_frontend_builder ) . '">
                <div class="main-slide-toggle"></div>';
                
            if ( isset( $whb_data ) && ! empty( $whb_data ) ) :
                $desktop_hidden_el_arr = array();
                foreach ( $whb_data as $screen_view_index => $screen_view ) :

                    if ( is_array( $whb_data ) ) {
                        foreach ( $whb_data as $key2 => $header_terms ) {
                            if ( is_array( $header_terms ) ) {
                                foreach ( $header_terms as $key => $header_term ) {
                                    $whb_data[$key] = sanitize_text_field( $header_term );
                                }
                            } else {                              
                                $whb_date[$key2] = sanitize_text_field( $header_terms ); 
                            }                          
                        }
                    }
                    
                    $sa_screen_view_index = sanitize_text_field( $screen_view_index );

                    // Create dynamically variable of panel
                    $screen_name    = str_replace( '-view', '', $sa_screen_view_index );                   
                    $$screen_name   = ''; // $desktop, $tablets, $mobils, $sticky

                    $vertical_header = $screen_view_classes = '';

                    /**
                     * Webnus Header Builder - Sticky View
                     * 
                     * @version 1.0.0
                     * @author  WEBNUS
                     */
                    if ( $sa_screen_view_index == 'sticky-view' ) {
                        extract( WHB_Helper::component_atts( array(
                            'area_height'		=> '100px',
                            'area_width'		=> '',
                            'full_container'	=> 'false',
                            'container_padd'	=> 'true',
                            'super_sticky'	    => 'false',
                            'content_position'	=> 'middle',
                            'sticky_appear'	    => 'both',
                            'mobile_sticky'	    => 'false',
                            'extra_class'   	=> '',
                            'extra_id'      	=> '',
                        ), $whb_data[ $sa_screen_view_index ][ 'srow1' ]['settings'] ));

                        $screen_view_classes .= ' ' . $sticky_appear . ' ';
                        $screen_view_classes .= $mobile_sticky == 'false' ? 'hide-in-reponsive' : '';

                        if ( $super_sticky == 'true' ) : 
                            $screen_view_classes .= ' whb-sticky-fixed' ;
                            WHB_Helper::set_dynamic_styles(
                                '@media only screen and (min-width: 961px) {
                                    #webnus-header-builder { position: fixed; width: 100%; }
                                }'
                            );
                        endif;

                    }

                    $$screen_name .= '<div class="whb-screen-view whb-' . esc_attr( $sa_screen_view_index . $screen_view_classes ) . '">';
                    $sticky_heights = array();

                    // Rows
                    foreach ( $screen_view as $area_index => $area ) :
                        // visibility
                        $hidden_area = $whb_data[ $sa_screen_view_index ][ $area_index ]['settings']['hidden_element'];
                        if ( $hidden_area === 'false' ) {
                            $hidden_area = false;
                        } elseif ( $hidden_area === 'true' ) {
                            $hidden_area = true;
                        }

                        // vertical header
                        if ( $sa_screen_view_index == 'desktop-view' ) :
                            $header_type = ! empty( $whb_data[ $sa_screen_view_index ][ $area_index ]['settings']['header_type'] ) ? $whb_data[ $sa_screen_view_index ][ $area_index ]['settings']['header_type'] : '' ;

                            if ( $area_index != 'row1' ) :
                                if ( $header_type == 'vertical' ) :
                                    continue;
                                endif;
                            else :
                                if ( $header_type == 'vertical' ) :
                                    $vertical_header = ' whb-vertical';
                                endif;
                            endif;

                        endif;

                        if ( ! $hidden_area ) :
                            $area_settings      = isset( $whb_data[ $sa_screen_view_index ][ $area_index ]['settings'] ) ? $whb_data[ $sa_screen_view_index ][ $area_index ]['settings'] : '' ;
                            $areas              = array();
                            $areas['left']      = isset( $whb_data[ $sa_screen_view_index ][ $area_index ]['left'] ) ? $whb_data[ $sa_screen_view_index ][ $area_index ]['left'] : '' ;
                            $areas['center']    = isset( $whb_data[ $sa_screen_view_index ][ $area_index ]['center'] ) ? $whb_data[ $sa_screen_view_index ][ $area_index ]['center'] : '' ;
                            $areas['right']     = isset( $whb_data[ $sa_screen_view_index ][ $area_index ]['right'] ) ? $whb_data[ $sa_screen_view_index ][ $area_index ]['right'] : '' ;

                            if ( $sa_screen_view_index != 'sticky-view' ) {
                                extract( WHB_Helper::component_atts( array(
                                    'full_container'	=> 'false',
                                    'container_padd'	=> 'true',
                                    'content_position'	=> 'middle',
                                    'extra_class'   	=> '',
                                    'extra_id'      	=> '',
                                ), $area_settings ));
                            } else {
                                extract( WHB_Helper::component_atts( array(
                                    'area_height'		=> '100px',
                                    'area_width'		=> '',
                                    'full_container'	=> 'false',
                                    'container_padd'	=> 'true',
                                    'super_sticky'	    => 'false',
                                    'content_position'	=> 'middle',
                                    'sticky_appear'	    => 'both',
                                    'mobile_sticky'	    => 'false',
                                    'extra_class'   	=> '',
                                    'extra_id'      	=> '',
                                ), $area_settings ));
                            }

                            // once fire
                            // if ( $sa_screen_view_index == 'desktop-view' || $sa_screen_view_index == 'sticky-view' ) :
                                if ( $sa_screen_view_index == 'sticky-view' ) {
                                    $sticky_heights[] =  ( isset( $area_height  ) && $area_height ) ? $area_height : '' ;
                                }

                                $vertical_dynamic_style = '';
                                if ( $header_type == 'vertical' && $sa_screen_view_index == 'desktop-view' ) :

                                    if ( $header_type == 'vertical' ) {
                                        extract( WHB_Helper::component_atts( array(
                                            'alignment'             => 'flex-start',
                                            'vertical_toggle'		=> 'false',
                                            'vertical_toggle_type'	=> 'freelancer',
                                            'vertical_toggle_icon'  => 'foursome',
                                            'logo'                  => '',
                                            'contact_icon'          => 'false',
                                            'full_screen'	        => 'false',
                                            'box_title'   	        => 'Contact David',
                                            'email'      	        => 'youremail@yourserver.com',
                                            'tel'      	            => '123 456 789',
                                            'schedule'              => 'Office hours are 9 a.m. and 5 p.m. Central time.',
                                            'address'      	        => 'address',
                                            'social'      	        => 'false',
                                            'form_title'      	    => 'General form',
                                            'contact_form'      	=> '',
                                            'socials'      	        => 'true',
                                            'social_text_1'      	=> 'Facebook',
                                            'social_url_1'      	=> 'https://www.facebook.com/',
                                            'social_text_2'      	=> '',
                                            'social_url_2'      	=> '',
                                            'social_text_3'      	=> '',
                                            'social_url_3'      	=> '',
                                            'social_text_4'      	=> '',
                                            'social_url_4'      	=> '',
                                            'social_text_5'      	=> '',
                                            'social_url_5'      	=> '',
                                            'social_text_6'      	=> '',
                                            'social_url_6'      	=> '',
                                            'social_text_7'      	=> '',
                                            'social_url_7'      	=> '',
                                            'extra_class'      	    => '',
                                            'extra_id'      	    => '',
                                        ), $area_settings ));

                                        // Render Custom Style
                                        $vertical_dynamic_style .= whb_styling_tab_output( $area_settings, 'Logo', '#webnus-header-builder .whb-vertical-logo-wrap' );
                                        $vertical_dynamic_style .= whb_styling_tab_output( $area_settings, 'Toggle Bar', '#webnus-header-builder .whb-vertical-toggle-wrap' );
                                        $vertical_dynamic_style .= whb_styling_tab_output( $area_settings, 'Toggle Icon Color', '#webnus-header-builder .vertical-menu-icon-foursome > div', '#webnus-header-builder .vertical-menu-icon-foursome:hover > div' );
                                        $vertical_dynamic_style .= whb_styling_tab_output( $area_settings, 'Toggle Icon Box', '#webnus-header-builder .vertical-toggle-icon' );
                                        $vertical_dynamic_style .= whb_styling_tab_output( $area_settings, 'Contact', '#webnus-header-builder .vertical-contact-icon' );
                                        $vertical_dynamic_style .= whb_styling_tab_output( $area_settings, 'Fullscreen', '#webnus-header-builder .vertical-fullscreen-icon' );
                                        $vertical_dynamic_style .= whb_styling_tab_output( $area_settings, 'Box', '#webnus-header-builder.whb-wrap .whb-vertical' );

                                        if ( ! empty( $vertical_dynamic_style ) ) {
                                            WHB_Helper::set_dynamic_styles( '
                                                @media only screen and (min-width: 961px) {
                                                    ' . $vertical_dynamic_style . '
                                                }
                                            ' );
                                        }

                                        WHB_Helper::set_dynamic_styles( '
                                            @media only screen and (min-width: 961px) {
                                                #webnus-header-builder .whb-vertical .whb-content-wrap,#webnus-header-builder .whb-vertical .whb-col { align-items: ' . $alignment . '; }
                                            }
                                        ' );
                                    }

                                    if ( $vertical_toggle == 'true' ) {

                                        // Get Elements
                                        $vertical_dynamic_style = $vertical_type = '';
                                        $logo                   = $logo ? wp_get_attachment_url( $logo ) : '';
                                        $alignment              = $alignment ? $alignment : '';
                                        $email                  = $email ? $email : '';
                                        $tel                    = $tel ? $tel : '';
                                        $schedule               = $schedule ? $schedule : '';
                                        $address                = $address ? $address : '';
                                        $box_title              = $box_title ? $box_title : '';
                                        $form_title             = $form_title ? $form_title : '';

                                        // Render Logo
                                        if ( ! empty( $logo ) ) {
                                            $logo = '
                                            <div class="whb-vertical-logo-wrap">
                                                <img class="whb-vertical-logo" src="' . esc_url( $logo ) . '" alt="'. get_bloginfo('name') .'">
                                            </div>';
                                        }

                                        if ( $vertical_toggle_type == 'freelancer' ) { 
                                            $vertical_type = 'whb-vertical-type-1';
                                        } elseif ( $vertical_toggle_type == 'photography' ) {
                                            $vertical_type = 'whb-vertical-type-2';
                                        }

                                        // Render Toggle Wrap
                                        $$screen_name .= '<div class="whb-vertical-toggle-wrap ' . $vertical_type . '">';

                                        // vertical togle icon
                                        if ( $vertical_toggle_icon == 'foursome' ) {
                                            $$screen_name .= '
                                                <div class="vertical-toggle-icon vertical-menu-icon-foursome">
                                                    <div class="vertical-menu-icon-foursome-top"></div>
                                                    <div class="vertical-menu-icon-foursome-center"></div>
                                                    <div class="vertical-menu-icon-foursome-bottom"></div>
                                                    <div class="vertical-menu-icon-foursome-extra-bottom"></div>
                                                </div>
                                            ';
                                        } else {
                                            $$screen_name .= '
                                                <div class="vertical-toggle-icon vertical-menu-icon-triad">
                                                    <div class="vertical-menu-icon-triad-top"></div>
                                                    <div class="vertical-menu-icon-triad-center"></div>
                                                    <div class="vertical-menu-icon-triad-bottom"></div>
                                                </div>
                                            ';
                                        }

                                        $$screen_name .= $logo;

                                        if ( $contact_icon == 'true' ) {
                                            $$screen_name .= '<div class="vertical-contact-icon"><i class="ti-email"></i></div>';
                                        }

                                        if ( $full_screen == 'true' ) {
                                            $$screen_name .= '<div class="vertical-fullscreen-icon"><i class="ti-fullscreen"></i></div>';
                                        }

                                        $$screen_name .= '</div>' ;

                                        if ( $contact_icon == 'true' ) { 
                                            $$screen_name .= '<div class="whb-vertical-contact-form-wrap">';

                                            $$screen_name .= '<div class="whb-vertical-contact-form-top">';

                                            if ( ! empty( $box_title ) ) {
                                                $$screen_name .= '<div class="whb-vertical-contact-form-box-title">';
                                                $$screen_name .= $box_title;
                                                $$screen_name .= '</div>';
                                            }

                                            if ( ! empty( $email ) ) {
                                                $$screen_name .= '<div class="whb-vertical-contact-form-details whb-vertical-contact-form-email">';
                                                $$screen_name .= '<strong>' . esc_html__( 'Email: ', 'deep' ). '</strong>';
                                                $$screen_name .= $email;
                                                $$screen_name .= '</div>';
                                            }

                                            if ( ! empty( $tel ) ) {
                                                $$screen_name .= '<div class="whb-vertical-contact-form-details whb-vertical-contact-form-tel">';
                                                $$screen_name .= '<strong>' . esc_html__( 'Telephone: ', 'deep' ). '</strong>';
                                                $$screen_name .= $tel;
                                                $$screen_name .= '</div>';
                                            }

                                            if ( ! empty( $schedule ) ) {
                                                $$screen_name .= '<div class="whb-vertical-contact-form-details whb-vertical-contact-form-schedule">';
                                                $$screen_name .= $schedule;
                                                $$screen_name .= '</div>';
                                            }

                                            if ( ! empty( $address ) ) {
                                                $$screen_name .= '<div class="whb-vertical-contact-form-details whb-vertical-contact-form-address">';
                                                $$screen_name .= '<strong>' . esc_html__( 'Address: ', 'deep' ). '</strong>';
                                                $$screen_name .= $address;
                                                $$screen_name .= '</div>';
                                            }

                                            if ( $social == 'true' ) {
                                                $$screen_name .= '<div class="whb-vertical-contact-form-details whb-vertical-contact-form-socials">';
                                                $$screen_name .= '<strong>' . esc_html__( 'Socials: ', 'deep' ). '</strong>';
                                                // Get Social Icons
                                                $display_socials = '';
                                                for ($i = 1; $i < 8; $i++) {

                                                    ${"social_text_" . $i}  = ${"social_text_" . $i} ? ${"social_text_" . $i} : '';
                                                    ${"social_url_" . $i}   = ${"social_url_" . $i} ? ${"social_url_" . $i} : '';

                                                    if (  !empty( ${"social_text_" . $i} ) ) {
                                                        $display_socials .= '<div class="vertical-contact-social-icons social-icon-' . $i . '">';
                                                        if ( ! empty( ${"social_url_" . $i} ) ) {
                                                            $display_socials .= '<a href="' . ${"social_url_" . $i} . '" target="_blank" class="hcolorf">';
                                                        }
                                                        $display_socials .= '<span class="vertical-contact-social-text">' . ${"social_text_" . $i} . '</span>';
                                                        if ( ! empty( ${"social_url_" . $i} ) ) {
                                                            $display_socials .= '</a>';
                                                        }
                                                        $display_socials .= '</div>';
                                                    }
                                                }
                                                $$screen_name .= $display_socials;
                                                $$screen_name .= '</div>';
                                            }

                                            $$screen_name .= '</div>'; // close .whb-vertical-contact-form-top

                                            $$screen_name .= '<div class="whb-vertical-contact-form-bottom">';

                                            if ( ! empty( $form_title ) ) {
                                                $$screen_name .= '<div class="whb-vertical-contact-form-form-title">';
                                                $$screen_name .= $form_title;
                                                $$screen_name .= '</div>';
                                            }

                                            if ( $contact_icon == 'true' ) {

                                                if ( ! empty( $contact_form ) ) {
                                                    $$screen_name .= do_shortcode( '[contact-form-7 id="' . $contact_form . '" title="' . esc_attr( 'Contact' ) . '"]' );
                                                } else {
                                                    $$screen_name .= esc_html__( 'Please select a from in Theme Option.', 'deep' );
                                                }

                                            }

                                            $$screen_name .= '</div>'; //Close .whb-vertical-contact-form-bottom
                                            $$screen_name .= '</div>'; // Close .whb-vertical-contact-form-wrap
                                        }

                                    }

                                endif;

                                // height
                                if ( ! empty( $area_height ) ) {
                                    $area_height = ! empty( $area_height ) ? $area_height : '';
                                    $area_height = 'height: ' . WHB_Helper::css_sanatize( $area_height, '90px' ) . ';';
                                    WHB_Helper::set_dynamic_styles( '#webnus-header-builder .whb-' . $area_index . '-area:not(.whb-vertical) { ' . $area_height . ' }' );  
                                }

                                $dynamic_style  = '';
                                $dynamic_style .= whb_styling_tab_output( $area_settings, 'Typography', '#webnus-header-builder .whb-' . $area_index . '-area' );
                                $dynamic_style .= whb_styling_tab_output( $area_settings, 'Background', '#webnus-header-builder .whb-' . $area_index . '-area' );
                                $dynamic_style .= whb_styling_tab_output( $area_settings, 'Box', '#webnus-header-builder .whb-' . $area_index . '-area:not(.whb-vertical)' );

                                // width
                                if ( ! empty( $area_width ) ) {
                                    $area_width = 'width: ' . WHB_Helper::css_sanatize( $area_width ) . ';';
                                    WHB_Helper::set_dynamic_styles(
                                        '@media only screen and (min-width: 961px) {
                                            #webnus-header-builder .whb-' . $area_index . '-area:not(.whb-vertical) > .container { ' . $area_width . ' }
                                        }'
                                    );
                                }

                                if ( $dynamic_style ) :
                                    WHB_Helper::set_dynamic_styles( $dynamic_style );
                                endif;
                            // endif;

                            // Classes
                            $area_classes   = '';
                            $area_classes   .= ! empty($content_position) ? ' whb-content-' . $content_position : '' ;
                            $area_classes   .= ! empty($extra_class) ? ' ' . $extra_class : '' ;
                            $container_padd = $container_padd == 'true' ? '' : ' wn-no-padding';

                            // Id
                            $extra_id = ! empty( $extra_id ) ? ' id="' . esc_attr( $extra_id ) . '"' : '' ;

                            // Toggle vertical
                            $whb_vertical_toggle = '';

                            if ( $header_type == 'vertical' ) :

                                if ( $vertical_toggle == 'true' ) {
                                    if ( $vertical_toggle_type == 'freelancer' ) { 
                                        $whb_vertical_toggle .= ' whb-vertical-type-1';
                                    } elseif ( $vertical_toggle_type == 'photography' ) {
                                        $whb_vertical_toggle .= ' whb-vertical-type-2';
                                    }
                                    $whb_vertical_toggle .= ' whb-vertical-toggle' ;
                                }

                            endif;

                            $$screen_name .= '<div class="whb-area whb-' . $area_index . '-area' . $vertical_header . $whb_vertical_toggle . $area_classes . '"' . $extra_id . '>';

                                $$screen_name .= $full_container == 'false' ? '<div class="container' . $container_padd . '">' : '';
                                $$screen_name .= '<div class="whb-content-wrap">';

                                // columns
                                foreach ( $areas as $area_key => $components ) :

                                    $$screen_name .= '<div class="whb-col whb-' . esc_attr( $area_key ) . '-col">';

                                        if ( $components ) :

                                            foreach ( $components as $attrs ) :

                                                $hidden_el = $attrs['hidden_element'];

                                                if ($sa_screen_view_index == 'desktop-view' && $hidden_el) {
                                                    array_push($desktop_hidden_el_arr, $attrs['name']);
                                                }

                                                if ( ! $hidden_el ) :
                                                    $element_type   = $attrs['name'];
                                                    $elements       = WHB_Helper::get_elements();
                                                    $func_name      = $elements[ $element_type ];
                                                    $uniqid         = $attrs['uniqueId'];

                                                    if ( $sa_screen_view_index == 'desktop-view' ) :
                                                        $once_run_flag = true;
                                                    elseif ( $sa_screen_view_index == 'sticky-view' ) :
                                                        $once_run_flag = true;
                                                    else :
                                                        $once_run_flag = false;
                                                    endif;

                                                    if ( in_array( $element_type, $desktop_hidden_el_arr ) ) {
                                                        $once_run_flag = true;
                                                        if ( ( $key = array_search($element_type, $desktop_hidden_el_arr )) !== false) {
                                                            unset($desktop_hidden_el_arr[$key]);
                                                        }
                                                    }

                                                    $mobile_sticky = isset($mobile_sticky) ? $mobile_sticky : false;
                                                    $$screen_name .= $func_name( $attrs, $uniqid, $once_run_flag, $mobile_sticky );

                                                endif;

                                            endforeach; // end components loop

                                        endif;

                                    $$screen_name .= '</div>';

                                endforeach; // end areas loop

                                $$screen_name .= '</div>';
                                $$screen_name .= $full_container == 'false' ? '</div>' : '';

                            $$screen_name .= '</div>';
                        endif;
                    endforeach; // end screens loop

                    // Sticky height
                    $sticky_heights = array_filter($sticky_heights);

                    if ( !empty( $sticky_heights ) ) {
                        $space_top = '0';
                        for ( $i = 0 ; $i < count ( $sticky_heights ) ; $i++ ) {
                            $str = $sticky_heights[$i];
                            preg_match_all('!\d+!', $str, $matches);
                            $space_top = $space_top + $matches['0']['0'];
                        }

                        WHB_Helper::set_dynamic_styles( '
                            .whb-sticky-view.header-sticky-hide,
                            .whb-sticky-view.is-top { top: -' . $space_top . 'px;  }
                        ' );
                    }
                        
                    $$screen_name .= '</div>';
                endforeach; // end header builder data loop

                $output .= $desktop;
                $output .= $tablets;
                $output .= $mobiles;
                $output .= $sticky;
            endif;

            $output .= '</header>';

            return $output;

        }

    }

endif;
