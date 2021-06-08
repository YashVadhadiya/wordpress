<?php
function whb_bp_messages( $atts, $uniqid, $once_run_flag ) {
	extract( WHB_Helper::component_atts( array(
		'show_tooltip'	    => 'false',
        'tooltip'	        => 'Notifications',
        'tooltip_position'	=> 'tooltip-on-bottom',
		'extra_class'	    => '',
	), $atts ));

    $out = '';
    if ( ! is_plugin_active( 'buddypress/bp-loader.php' ) && function_exists( 'deep_bp_user_messages' ) ) {
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
            $current_element = 'body #wrap #webnus-header-builder [data-id=whb-bp-messages-' . esc_attr( $uniqid ) . '] > a' ;
        
            $dynamic_style = '';
            $dynamic_style .= whb_styling_tab_output( $atts, 'Icon', 'body #wrap #webnus-header-builder [data-id=whb-bp-messages-' . esc_attr( $uniqid ) . '] .whb-icon-element .wn-bp-messages i.ti-email', 'body #wrap #webnus-header-builder [data-id=whb-bp-messages-' . esc_attr( $uniqid ) . ']:hover .whb-icon-element .wn-bp-messages i.ti-email'  );
            $dynamic_style .= whb_styling_tab_output( $atts, 'Counter', 'body #wrap #webnus-header-builder [data-id=whb-bp-messages-' . esc_attr( $uniqid ) . '] .wn-bp-pending-messages' );
            $dynamic_style .= whb_styling_tab_output( $atts, 'Box', 'body #wrap #webnus-header-builder [data-id=whb-bp-messages-' . esc_attr( $uniqid ) . ']' );
            $dynamic_style .= whb_styling_tab_output( $atts, 'Tooltip', 'body #wrap #webnus-header-builder [data-id=whb-bp-messages-' . esc_attr( $uniqid ) .'].whb-tooltip[data-tooltip]:before' );

            if ( $dynamic_style ) :
                WHB_Helper::set_dynamic_styles( $dynamic_style );
            endif;
        endif;

        // extra class
        $extra_class = $extra_class ? ' ' . $extra_class : '';

        ob_start();

        // render
        echo '
            <div class="whb-element whb-icon-wrap whb-bp-messages ' . esc_attr( $tooltip_class . $extra_class ) . ' whb-header-pb-messages-toggle " data-id="whb-bp-messages-' . esc_attr( $uniqid ) . '" ' . $tooltip . '>
                <div class="wn-messages-modal-icon whb-icon-element hcolorf ">
                    ' . deep_bp_user_messages() . '
                </div>
            </div>';

        $out .= ob_get_contents();
        ob_end_clean();

        return $out;
    }
}

WHB_Helper::add_element( 'bp-messages', 'whb_bp_messages' );