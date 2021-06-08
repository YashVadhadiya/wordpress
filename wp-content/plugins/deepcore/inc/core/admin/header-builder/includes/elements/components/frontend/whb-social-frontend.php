<?php
function whb_social( $atts, $uniqid, $once_run_flag ) {
	extract( WHB_Helper::component_atts( array(
		'main_social_icon'	=> 'icon',
		'social_hover'		=> 'none',
		'main_icon_text'	=> 'Socials',
		'social_type'		=> 'simple',
		'toggle_text'		=> 'Social Network',
		'has_tooltip'		=> 'false',
		'tooltip_text'		=> 'Socials',
		'tooltip_position'	=> 'tooltip-on-bottom',
		'social_format'		=> 'icon',
		'inline'			=> 'false',
		'social_icon_1'		=> 'facebook',
		'social_text_1'		=> 'Facebook',
		'social_url_1'		=> 'https://www.facebook.com/',
		'social_icon_2'		=> 'none',
		'social_text_2'		=> '',
		'social_url_2'		=> '',
		'social_icon_3'		=> 'none',
		'social_text_3'		=> '',
		'social_url_3'		=> '',
		'social_icon_4'		=> 'none',
		'social_text_4'		=> '',
		'social_url_4'		=> '',
		'social_icon_5'		=> 'none',
		'social_text_5'		=> '',
		'social_url_5'		=> '',
		'social_icon_6'		=> 'none',
		'social_text_6'		=> '',
		'social_url_6'		=> '',
		'social_icon_7'		=> 'none',
		'social_text_7'		=> '',
		'social_url_7'		=> '',
		'extra_class'		=> '',
		'show_tooltip'		=> 'false',
		'default_icon_bg'	=> 'false',
	), $atts ));

	$out = $link_to = '';

	// login
	$toggle_text 		= $toggle_text ? $toggle_text : '' ;

	// tooltip
	$tooltip_text		= ! empty( $tooltip_text ) ? $tooltip_text : '' ;
	$tooltip = $tooltip_class = '';

	if ( $show_tooltip == 'true' && $tooltip_text ) :
		$tooltip_position 	= ( isset( $tooltip_position ) && $tooltip_position ) ? $tooltip_position : 'tooltip-on-bottom';
		$tooltip_class		= ' whb-tooltip ' . $tooltip_position;
		$tooltip			= ' data-tooltip=" ' . esc_attr( $tooltip_text ) . ' "';
	endif;

	// Get Social Icons
	$display_socials = '';
	for ($i = 1; $i < 8; $i++) {
		${"social_text_" . $i} 	= ${"social_text_" . $i} ? ${"social_text_" . $i} : '';
		${"social_url_" . $i}  	= ${"social_url_" . $i} ? ${"social_url_" . $i} : '';

		if ( ${"social_icon_" . $i} != 'none' ) {
			$display_socials .= '<div class="header-social-icons social-icon-' . $i . ' whb-social-' . $social_hover . ' ">';
			if ( ! empty( ${"social_url_" . $i} ) ) {
				$display_socials .= '<a href="' . ${"social_url_" . $i} . '" target="_blank">';
			}

			if ( $social_format != 'text' ) {

				if ( ${"social_icon_" . $i} == 'rss-square' ) {
					$display_socials .= '<i class="header-social-icon wn-fa wn-fa-' . ${"social_icon_" . $i} . '"></i>';
				} else {
					$display_socials .= '<i class="header-social-icon wn-fab wn-fa-' . ${"social_icon_" . $i} . '"></i>';
				}

			}
			if ( $social_format != 'icon' ) {
				$display_socials .= '<span class="header-social-text">' . ${"social_text_" . $i} . '</span>';
			}
			if ( ! empty( ${"social_url_" . $i} ) ) {
				$display_socials .= '</a>';
			}
			$display_socials .= '</div>';
		}
	}

	// styles
	if ( $once_run_flag ) :
		$dynamic_style = '';

		$dynamic_style .=
			whb_styling_tab_output(
				$atts, 'Slide type Icon/Text',
					'body #wrap #webnus-header-builder [data-id=whb-social-' . esc_attr( $uniqid ) . '] .wn-header-social-icon i:before,
					body #wrap #webnus-header-builder [data-id=whb-social-' . esc_attr( $uniqid ) . '] .wh-social-icons-box i:before,
					body #wrap #webnus-header-builder [data-id=whb-social-' . esc_attr( $uniqid ) . '] .wn-header-social-icon span',
					'body #wrap #webnus-header-builder [data-id=whb-social-' . esc_attr( $uniqid ) . ']:hover .wn-header-social-icon i:before,
					body #wrap #webnus-header-builder [data-id=whb-social-' . esc_attr( $uniqid ) . '] .wh-social-icons-box i:hover:before,
					body #wrap #webnus-header-builder [data-id=whb-social-' . esc_attr( $uniqid ) . ']:hover  .wn-header-social-icon span'  );

		$dynamic_style .=
			whb_styling_tab_output(
				$atts, 'Box',
				'body #wrap #webnus-header-builder [data-id=whb-social-' . esc_attr( $uniqid ). '],
				body #wrap #webnus-header-builder [data-id=whb-social-' . esc_attr( $uniqid ). '] .wh-social-icons-box',
				'body #wrap #webnus-header-builder [data-id=whb-social-' . esc_attr( $uniqid ). ']:hover,
				body #wrap #webnus-header-builder [data-id=whb-social-' . esc_attr( $uniqid ). '] .wh-social-icons-box:hover'
			);

		$dynamic_style .= whb_styling_tab_output( $atts, 'Social Box', 'body #wrap #webnus-header-builder [data-id=whb-social-' . esc_attr( $uniqid ). '] .wh-social-icons-box,#header-social-full-wrap,.main-slide-toggle #header-social-modal', 'body #wrap #webnus-header-builder [data-id=whb-social-' . esc_attr( $uniqid ). '] .wh-social-icons-box:hover,#header-social-full-wrap:hover,.main-slide-toggle #header-social-modal:hover' );

		$dynamic_style .= whb_styling_tab_output( $atts, 'Social Icon/Text Box', 'body #wrap #webnus-header-builder [data-id=whb-social-' . esc_attr( $uniqid ). '] .wh-social-icons-box .header-social-icons a, .wh-social-icons-box .header-social-icons a, #header-social-modal .header-social-icons a' );

		$dynamic_style .= whb_styling_tab_output( $atts, 'Social Icon', 'body #wrap #webnus-header-builder [data-id=whb-social-' . esc_attr( $uniqid ). '] .wh-social-icons-box .header-social-icons a i, .wh-social-icons-box .header-social-icons a i, #header-social-modal .header-social-icons a i','body #wrap #webnus-header-builder [data-id=whb-social-' . esc_attr( $uniqid ). '] .wh-social-icons-box .header-social-icons:hover a i, .wh-social-icons-box .header-social-icons:hover a i, #header-social-modal .header-social-icons:hover a i' );

        $dynamic_style .= whb_styling_tab_output( $atts, 'Social Text', 'body #wrap #webnus-header-builder [data-id=whb-social-' . esc_attr( $uniqid ). '] .wh-social-icons-box .header-social-icons a span, .wh-social-icons-box .header-social-icons a span, #header-social-modal .header-social-icons a span','body #wrap #webnus-header-builder [data-id=whb-social-' . esc_attr( $uniqid ). '] .wh-social-icons-box .header-social-icons:hover a span, .wh-social-icons-box .header-social-icons:hover a span, #header-social-modal .header-social-icons:hover a span' );

        $dynamic_style .= whb_styling_tab_output( $atts, 'Tooltip', 'body #wrap #webnus-header-builder [data-id=whb-social-' . esc_attr( $uniqid ) .'].whb-tooltip[data-tooltip]:before', 'body #wrap #webnus-header-builder [data-id=whb-social-' . esc_attr( $uniqid ) .'].whb-tooltip[data-tooltip]:hover:before' );

        $dynamic_style .= whb_styling_tab_output( $atts, 'Full Page Social', 'body .mfp-ready.mfp-bg.full-social' );

        if ( $dynamic_style ) :
            WHB_Helper::set_dynamic_styles( $dynamic_style );
        endif;

        if ( $inline == 'true' ) :
			WHB_Helper::set_dynamic_styles( '#webnus-header-builder .header-social-icons,#header-social-full-wrap .header-social-icons { display: inline-block; }' );
		endif;
	endif;

	// extra class
	$extra_class = $extra_class ? ' ' . $extra_class : '' ;

	if ( $social_type == 'slide' ) {
		$link_to = 'href="#" id="wn-social-modal-icon"';
	} elseif ( $social_type == 'full' ) {
		$link_to = 'href="#header-social-full-wrap" id="wn-social-slide-icon" data-effect="mfp-zoom-in"';
	} elseif ( $social_type == 'dropdown' ) {
		$link_to = 'href="#" id="wn-social-dropdown-icon"';
	}

	if ( $main_social_icon == 'text' && ! empty( $main_icon_text ) ) {
		$text_icon = '<span>' . $main_icon_text . '</span>';
	} else {
		$text_icon = $default_icon_bg == 'false' ? '<i class="sl-social-twitter"></i>' : '';
	}

	// render
	$out .= '<div class="whb-element whb-icon-wrap whb-social ' . esc_attr( $tooltip_class . $extra_class ) . ' whb-header-dropdown" data-id="whb-social-' . esc_attr( $uniqid ) . '" ' . $tooltip . '>';

	if ( $social_type != 'simple' ) {
		$out .= '<a ' . $link_to . ' class="whb-icon-element hcolorf"></a>
				 <div class="wn-header-social-icon">' . $text_icon . '</div>';
	}

	if ( $social_type == 'simple' ) {
		$out .= '
		<div class="wh-social-icons-box header-social-simple-wrap">
			' . $display_socials . '
		</div>';
	} elseif ( $social_type == 'slide' ) {
		$out .= '
		<div class="header-social-modal-wrap">
			<div id="header-social-modal" class="wn-header-social">
				<div class="header-social-content container">
					<div class="col-md-6">
						<div class="socialfollow">
						' . $display_socials . '
						</div>
					</div>
				</div>
			</div>
		</div>';
	} elseif ( $social_type == 'full' ) {
		$out .= '
		<div id ="header-social-full-wrap" class="wh-social-icons-box header-social-full-wrap white-popup mfp-with-anim mfp-hide">
			' . $display_socials . '
		</div>';
	} elseif ( $social_type == 'dropdown' ) {
		$out .= '
		<div id ="header-social-dropdown-wrap" class="wh-social-icons-box header-social-dropdown-wrap">
			' . $display_socials . '
		</div>';
	}
	$out .= '</div>';

	return $out;
}

WHB_Helper::add_element( 'social', 'whb_social' );
