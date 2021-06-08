<?php
function whb_bp_notification( $atts, $uniqid, $once_run_flag ) {
	extract( WHB_Helper::component_atts( array(
		'show_tooltip'	    => 'false',
        'tooltip'	        => 'Notifications',
        'tooltip_position'	=> 'tooltip-on-bottom',
		'extra_class'	    => '',
	), $atts ));

    $out = '';

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
        $current_element = 'body #wrap #webnus-header-builder [data-id=whb-bp-notification-' . esc_attr( $uniqid ) . '] > a' ;
    
        $dynamic_style = '';
        $dynamic_style .= whb_styling_tab_output( $atts, 'Icon', 'body #wrap #webnus-header-builder [data-id=whb-bp-notification-' . esc_attr( $uniqid ) . '] .whb-icon-element .wn-bp-notification i.ti-bell', 'body #wrap #webnus-header-builder [data-id=whb-bp-notification-' . esc_attr( $uniqid ) . ']:hover .whb-icon-element .wn-bp-notification i.ti-bell'  );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Counter', 'body #wrap #webnus-header-builder [data-id=whb-bp-notification-' . esc_attr( $uniqid ) . '] .wn-bp-pending-notifications' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Box', 'body #wrap #webnus-header-builder [data-id=whb-bp-notification-' . esc_attr( $uniqid ) . ']' );
        $dynamic_style .= whb_styling_tab_output( $atts, 'Tooltip', 'body #wrap #webnus-header-builder [data-id=whb-bp-notification-' . esc_attr( $uniqid ) .'].whb-tooltip[data-tooltip]:before' );

        if ( $dynamic_style ) :
            WHB_Helper::set_dynamic_styles( $dynamic_style );
        endif;
    endif;

    // extra class
    $extra_class = $extra_class ? ' ' . $extra_class : '';

    // render
    $out .= '
        <div class="whb-element whb-icon-wrap whb-bp-notification ' . esc_attr( $tooltip_class . $extra_class ) . ' whb-header-pb-notification-toggle " data-id="whb-bp-notification-' . esc_attr( $uniqid ) . '" ' . $tooltip . '>
            <div class="wn-notification-modal-icon whb-icon-element hcolorf ">
                ' . deep_bp_user_notifications() . '
            </div>
        </div>';
        
    return $out;

}

WHB_Helper::add_element( 'bp-notification', 'whb_bp_notification' );