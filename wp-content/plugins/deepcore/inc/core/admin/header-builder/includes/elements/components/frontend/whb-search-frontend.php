<?php

function whb_search( $atts, $uniqid, $once_run_flag ) {

	extract( WHB_Helper::component_atts( array(
		'type'				=> 'simple',
		'icon_type'			=> 'ti',
		'placeholder_text'	=> 'Search',
		'show_tooltip'		=> 'false',
		'tooltip_text'		=> 'Search',
		'tooltip_position'	=> 'tooltip-on-bottom',
		'top_arrow'			=> 'false',
		'searchbox_icon'	=> 'false',
		'text_beside_icon'	=> '',
		'extra_class'		=> '',
	), $atts ));

	$out = $search_icon = '';

	// login
	$placeholder_text 	= ! empty( $placeholder_text ) ? $placeholder_text : esc_html__( 'Search' , 'deep' );
	$text_beside_icon 	= ! empty( $text_beside_icon ) ? '<span class="search-toggle-txt">' . $text_beside_icon . '</span>' : '';
	$text_beside_icon	= ( ! empty( $text_beside_icon ) && $type == 'toggle' ) ? $text_beside_icon : '';

	// tooltip
	$tooltip_text	= ! empty( $tooltip_text ) ? $tooltip_text : '' ;
	$tooltip = $tooltip_class = '';
	if ( $show_tooltip == 'true' && $tooltip_text ) :

		$tooltip_position 	= ( isset( $tooltip_position ) && $tooltip_position ) ? $tooltip_position : 'tooltip-on-bottom';
		$tooltip_class		= ' whb-tooltip ' . $tooltip_position;
		$tooltip			= ' data-tooltip=" ' . esc_attr( $tooltip_text ) . ' "';

	endif;

	// styles
	if ( $once_run_flag ) :

		$dynamic_style = '';
		$dynamic_style .= whb_styling_tab_output( $atts, 'Icon', 'body #wrap #webnus-header-builder [data-id=whb-search-' . esc_attr( $uniqid ) . '] > a > i, body #wrap #webnus-header-builder [data-id=whb-search-' . esc_attr( $uniqid ) . '] > a > i:before, body #wrap #webnus-header-builder [data-id=whb-search-' . esc_attr( $uniqid ) . '] form:before', 'body #wrap #webnus-header-builder [data-id=whb-search-' . esc_attr( $uniqid ) . ']:hover > a > i, body #wrap #webnus-header-builder [data-id=whb-search-' . esc_attr( $uniqid ) . ']:hover form:before, body #wrap #webnus-header-builder [data-id=whb-search-' . esc_attr( $uniqid ) . ']:hover a i:before'  );

		$dynamic_style .= whb_styling_tab_output( $atts, 'Custom Text', 'body #wrap #webnus-header-builder [data-id=whb-search-' . esc_attr( $uniqid ) . '] > a > span.search-toggle-txt', 'body #wrap #webnus-header-builder [data-id=whb-search-' . esc_attr( $uniqid ) . ']:hover > a > span.search-toggle-txt' );

		$dynamic_style .= whb_styling_tab_output( $atts, 'Background', 'body #wrap #webnus-header-builder [data-id=whb-search-' . esc_attr( $uniqid ) . ']' );

        $dynamic_style .= whb_styling_tab_output( $atts, 'Box', 'body #wrap #webnus-header-builder [data-id=whb-search-' . esc_attr( $uniqid ). ']' );

        $dynamic_style .= whb_styling_tab_output( $atts, 'Tooltip', 'body #wrap #webnus-header-builder [data-id=whb-search-' . esc_attr( $uniqid ) . '] .whb-tooltip[data-tooltip]:before' );

        $dynamic_style .= whb_styling_tab_output( $atts, 'Search Form', 'body #wrap #webnus-header-builder [data-id=whb-search-' . esc_attr( $uniqid ). '] > .whb-search-form-box,.header-search-full-wrap,.main-slide-toggle #header-search-modal, .main-slide-toggle #header-search-modal .header-search-content,body #wrap #webnus-header-builder [data-id=whb-search-' . esc_attr( $uniqid ). '] > .header-search-simple-wrap' );

		$dynamic_style .= whb_styling_tab_output( $atts, 'Search Form Input', 'body #wrap #webnus-header-builder [data-id=whb-search-' . esc_attr( $uniqid ). '] > .whb-search-form-box .search-text-box,body #wrap #webnus-header-builder [data-id=whb-search-' . esc_attr( $uniqid ). '] > .header-search-simple-wrap .search-text-box,.header-search-full-wrap > form input,#header-search-modal .header-search-modal-text-box' );

        $dynamic_style .= whb_styling_tab_output( $atts, 'Full Page Search and Slide', 'body .mfp-ready.mfp-bg.full-search, #wrap .wn-header-search' );

        $dynamic_style .= whb_styling_tab_output( $atts, 'Arrow', 'body #wrap #webnus-header-builder [data-id=whb-search-' . esc_attr( $uniqid ). '] > .whb-search-form-box:before' );

		$dynamic_style .= whb_styling_tab_output( $atts, 'Search Box Icon', 'body #wrap #webnus-header-builder [data-id=whb-search-' . esc_attr( $uniqid ). '] form:before', 'body #wrap #webnus-header-builder [data-id=whb-search-' . esc_attr( $uniqid ). '] form:hover:before' );

		$dynamic_style .= whb_styling_tab_output( $atts, 'Placeholder', 'body #wrap #webnus-header-builder [data-id=whb-search-' . esc_attr( $uniqid ). '] form input::placeholder' );

        $dynamic_style .= whb_styling_tab_output( $atts, 'Close Icon', 'body .mfp-wrap  button.mfp-close' );

		if ( $dynamic_style ) :
			WHB_Helper::set_dynamic_styles( $dynamic_style );
		endif;

		if ( $top_arrow == 'true' ) :
			WHB_Helper::set_dynamic_styles( '#wrap #webnus-header-builder .whb-search-form-box:after, #wrap #webnus-header-builder .whb-search-form-box:before { display: none; }' );
		endif;

		if ( $searchbox_icon == 'true' ) :
			WHB_Helper::set_dynamic_styles( '#webnus-header-builder .whb-search form:before { display: none; }' );
		endif;


	endif;

	// extra class
	$extra_class = $extra_class ? ' ' . $extra_class : '' ;
	$toggle_trigger = ( $type == 'toggle' ) ? 'whb-icon-element-toggle' : 'whb-icon-element-slide' ;

	if ( $type == 'toggle') {
		$toggle_trigger = 'whb-icon-element-toggle' ;
	} elseif ( $type == 'slide' ) {
		$toggle_trigger = 'whb-icon-element-slide' ;
	} elseif ( $type == 'full' ) {
		$toggle_trigger = 'whb-icon-element-full' ;
	} else {
		$toggle_trigger = 'simple' ;
	}

	if ( $icon_type == '7s' ) {
		$search_icon = '<i id="search-icon-trigger" class="pe-7s-search"></i>';
	} elseif ( $icon_type == 'ti' ) {
		$search_icon = '<i id="search-icon-trigger" class="ti-search"></i>';
	} elseif ( $icon_type == 'fa' ) {
		$search_icon = '<i id="search-icon-trigger" class="wn-fa wn-fa-search"></i>';
	} elseif ( $icon_type == 'sl' ) {
		$search_icon = '<i id="search-icon-trigger" class="sl-magnifier"></i>';
	}

	$icon_id     = ( $type == 'full' ) ? 'wn-search-full-icon' : 'wn-search-modal-icon';

	// render
	$out .= '
		<div class="whb-element whb-icon-wrap whb-search ' . esc_attr( $extra_class ) . ' whb-header-' . $type . '" data-id="whb-search-' . esc_attr( $uniqid ) . '">';

			if ( $type == 'toggle' || $type == 'slide' || $type == 'full' ) {
				$out .= '
				<a href="#" id="' . $icon_id . '" class="whb-icon-element ' . $toggle_trigger . ' hcolorf ">
					' . $search_icon . $text_beside_icon .'
				</a>';
			}

			if ( $type == 'toggle' ) {
			$out .= '
				<div class="whb-trigger-element ' . esc_attr( $tooltip_class ) . '" ' . $tooltip . '></div><div id="whb-search-form-box" class="whb-search-form-box js-contentToggle__content">
					<form action="' . esc_url(home_url( '/' )) . '" method="get">
						<input type="text" class="search-text-box" id="search-box" name="s" placeholder="' . $placeholder_text . '">
					</form>
				</div>';
			} elseif ( $type == 'slide' ) {
				$out .= '
					<div id="whb-trigger-element" class="whb-trigger-element ' . esc_attr( $tooltip_class ) . '" ' . $tooltip . '></div>
					<div class="header-search-modal-wrap">';
				if ( $once_run_flag ) :
				$out .= '
					<div id="header-search-modal" class="wn-header-search colorb" data-id="whb-search-' . esc_attr( $uniqid ) . '">
						<div class="header-search-content container">
							<div class="col-md-12 search-slide">
								<form id="header-search-modal-form" role="search" action="' . esc_url(home_url( '/' )) . '" method="get" >
									<input name="s" type="text" class="header-search-modal-text-box" placeholder="' . $placeholder_text . '" autofocus>
									<i class="sl-magnifier"></i>
								</form>
							</div>
						</div>
					</div>';
				endif;
				$out .= '
					</div>';
			} elseif ( $type == 'simple' ) {
				$out .= '
					<div class="header-search-simple-wrap">
						<form action="' . esc_url(home_url( '/' )) . '" method="get">
							<input type="text" class="search-text-box" id="search-box" name="s" placeholder="' . $placeholder_text . '">
						</form>
					</div>
				';
			} elseif ( $type == 'full' ) {
				$out .= '
					<div class="whb-trigger-element ' . esc_attr( $tooltip_class ) . '" ' . $tooltip . '><a href="#full-search"></a></div>
					<div id="full-search" class="header-search-full-wrap white-popup mfp-with-anim mfp-hide">
						<form action="' . esc_url(home_url( '/' )) . '" method="get">
							<input type="text" class="search-text-box" id="search-box" name="s" placeholder="' . $placeholder_text . '">
						</form>
					</div>
				';
			}

	$out .= '
		</div>';

	return $out;

}

WHB_Helper::add_element( 'search', 'whb_search' );