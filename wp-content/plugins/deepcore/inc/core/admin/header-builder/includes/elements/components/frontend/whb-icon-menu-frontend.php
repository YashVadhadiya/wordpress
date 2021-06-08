<?php
function whb_icon_menu( $atts, $uniqid, $once_run_flag ) {
	extract( WHB_Helper::component_atts( array(
		'menu'      	    => '',
		'show_tooltip'	    => 'false',
        'tooltip_text'	    => 'Search',
        'tooltip_position'	=> 'tooltip-on-bottom',
		'extra_class'	    => '',
		'main_icon' 	    => '',
	), $atts ));

    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	$out = '';

    if ( ! empty( $menu ) && is_nav_menu( $menu ) ) {
        $menu_out = wp_nav_menu( array(
            'menu'          => $menu,
            'container'     => false,
            'menu_id'       => 'nav',
            'depth'         => '5',
            'fallback_cb'   => 'wp_page_menu',
            'items_wrap'    => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'echo'          => false,
            'walker'        => new wn_description_walker(),
        ));
    } else {
        $menu_out = '';
    }

    $main_icon = ! empty( $main_icon ) ? $main_icon : 'sl-user' ;

    // tooltip
    $tooltip_text   = ! empty( $tooltip_text ) ? $tooltip_text : '' ;
    $tooltip = $tooltip_class = '';

    if ( $show_tooltip == 'true' && $tooltip_text ) :
        $tooltip_position   = ( isset( $tooltip_position ) && $tooltip_position ) ? $tooltip_position : 'tooltip-on-bottom';
        $tooltip_class      = ' whb-tooltip ' . $tooltip_position;
        $tooltip            = ' data-tooltip=" ' . esc_attr( $tooltip_text ) . ' "';
    endif;

	// styles
	if ( $once_run_flag ) :
		$dynamic_style = '';
        $dynamic_style .= whb_styling_tab_output( $atts, 'Icon', 'body #wrap #webnus-header-builder [data-id=whb-icon-menu-' . esc_attr( $uniqid ) . '] .wn-icon-menu-icon i','body #wrap #webnus-header-builder [data-id=whb-icon-menu-' . esc_attr( $uniqid ) . ']:hover .wn-icon-menu-icon i' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Box', 'body #wrap #webnus-header-builder [data-id=whb-icon-menu-' . esc_attr( $uniqid ) . ']' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Dropdown Box', 'body #wrap #webnus-header-builder [data-id=whb-icon-menu-' . esc_attr( $uniqid ) .'] .whb-icon-menu-content' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Menu Item', 'body #wrap #webnus-header-builder [data-id=whb-icon-menu-' . esc_attr( $uniqid ) .'] .whb-icon-menu-content #nav li' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Menu Item Text', 'body #wrap #webnus-header-builder [data-id=whb-icon-menu-' . esc_attr( $uniqid ) .'] .whb-icon-menu-content #nav > li > a','body #wrap #webnus-header-builder [data-id=whb-icon-menu-' . esc_attr( $uniqid ) . ']:hover .whb-icon-menu-content #nav > li:hover > a' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Menu Item Icon', 'body #wrap #webnus-header-builder [data-id=whb-icon-menu-' . esc_attr( $uniqid ) .'] .whb-icon-menu-content #nav > li > a > i','body #wrap #webnus-header-builder [data-id=whb-icon-menu-' . esc_attr( $uniqid ) . ']:hover .whb-icon-menu-content #nav > li:hover > a > i' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Tooltip', 'body #wrap #webnus-header-builder [data-id=whb-icon-menu-' . esc_attr( $uniqid ) . '] .whb-tooltip[data-tooltip]:before' );

        if ( $dynamic_style ) :
            WHB_Helper::set_dynamic_styles( $dynamic_style );
        endif;
	endif;

	// extra class
	$extra_class = $extra_class ? ' ' . $extra_class : '' ;

	// render
	$out .= '
		<div class="whb-element whb-header-dropdown whb-icon-menu-wrap whb-icon-menu ' . esc_attr( $extra_class ) . '" data-id="whb-icon-menu-' . esc_attr( $uniqid ) . '">
            <a href="#" id="wn-icon-menu-trigger" class="whb-trigger-element ' . esc_attr( $tooltip_class ) . '" ' . $tooltip . '></a>
            <div class="wn-icon-menu-icon whb-icon-element hcolorf ">
                <i id="header-icon-menu-icon" class="' . $main_icon . '"></i>
            </div>';
    $out .= '<div class="wn-element-dropdown whb-icon-menu-content">';
    $out .= $menu_out;
    $out .= '</div>';
    $out .= '</div>';

	return $out;
}

WHB_Helper::add_element( 'icon-menu', 'whb_icon_menu' );
