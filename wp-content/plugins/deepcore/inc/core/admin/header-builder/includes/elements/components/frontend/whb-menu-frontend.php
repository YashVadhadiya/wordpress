<?php
function whb_menu_f( $atts, $uniqid, $once_run_flag, $mobile_sticky ) {

	extract(
		WHB_Helper::component_atts(
			array(
				'menu'                      => '',
				'desc_item'                 => 'false',
				'full_menu'                 => 'false',
				'height_100'                => 'false',
				'extra_class'               => '',
				'show_mobile_menu'          => 'true',
				'deep_menu_location'        => 'false',
				'mobile_menu_display_width' => '',
				'show_parent_arrow'         => 'true',
				'parent_arrow_direction'    => 'bottom',
			),
			$atts
		)
	);

	$out = $parent_arrow = '';
	$desc_item              = $desc_item == 'true' ? ' has-desc-item' : '';
	$full_menu              = $full_menu == 'true' ? ' full-width-menu' : '';
	$show_mobile_menu_class = $show_mobile_menu == 'false' ? ' wn-hide-mobile-menu' : '';
	static $i = 0;

	if ( $show_parent_arrow == 'true' ) {

		$parent_arrow = ' has-parent-arrow';

		switch ( $parent_arrow_direction ) {
			case 'top':
				$parent_arrow .= ' arrow-top';
				break;
			case 'right':
				$parent_arrow .= ' arrow-right';
				break;
			case 'bottom':
				$parent_arrow .= ' arrow-bottom';
				break;
			case 'left':
				$parent_arrow .= ' arrow-left';
				break;
		}
	}

	if ( $once_run_flag ) :
		if ( ! empty( $menu ) && is_nav_menu( $menu ) ) {
			if ( $deep_menu_location == 'true' ) {
				$menu_out = wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'container'   => false,
						'menu_id'     => 'nav' . $i++,
						'menu_class'  => 'nav',
						'depth'       => '5',
						'fallback_cb' => 'wp_page_menu',
						'items_wrap'  => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'echo'        => false,
						'walker'      => new wn_description_walker(),
					)
				);
			} else {
				$menu_out = wp_nav_menu(
					array(
						'menu'        => $menu,
						'container'   => false,
						'menu_id'     => 'nav' . $i++,
						'menu_class'  => 'nav',
						'depth'       => '5',
						'fallback_cb' => 'wp_page_menu',
						'items_wrap'  => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'echo'        => false,
						'walker'      => new wn_description_walker(),
					)
				);
			}

			if ( $deep_menu_location == 'true' ) {
				if ( $show_mobile_menu == 'true' ) {
					$responsive_menu_out = wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'container'   => false,
							'menu_id'     => 'responav' . $i++,
							'menu_class'  => 'responav',
							'depth'       => '5',
							'fallback_cb' => 'wp_page_menu',
							'items_wrap'  => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'echo'        => false,
							'walker'      => new wn_description_walker(),
						)
					);
				}
			} else {
				if ( $show_mobile_menu == 'true' ) {
					$responsive_menu_out = wp_nav_menu(
						array(
							'menu'        => $menu,
							'container'   => false,
							'menu_id'     => 'responav' . $i++,
							'menu_class'  => 'responav',
							'depth'       => '5',
							'fallback_cb' => 'wp_page_menu',
							'items_wrap'  => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'echo'        => false,
							'walker'      => new wn_description_walker(),
						)
					);
				}
			}

		} else {
			$menu_out = '
				<div class="whb-element">
					<span>' . esc_html__( 'Your menu is empty or not selected! ', 'deep' ) . '<a href="https://webnus.net/deep-premium-wordpress-theme-documentation/create-menu-with-header-builder/" class="sf-with-ul hcolorf" target="_blank">' . esc_html__( 'How to config a menu', 'deep' ) . '</a></span>
				</div>
			';

			$responsive_menu_out = $show_mobile_menu == 'true' ? $menu_out : '';
		}

		$dynamic_style  = '';
		$dynamic_style .= whb_styling_tab_output(
			$atts,
			'Menu Item',
			'body #wrap #webnus-header-builder .whb-screen-view [data-id=whb-nav-wrap-' . esc_attr( $uniqid ) . '] > ul > li > a, .whb-responsive-menu-' . esc_attr( $uniqid ) . ' .responav li.menu-item > a:not(.button)',
			'#wrap #webnus-header-builder .whb-screen-view .whb-area .whb-col [data-id=whb-nav-wrap-' . esc_attr( $uniqid ) . '] > .nav > li:hover > a, .whb-responsive-menu-' . esc_attr( $uniqid ) . ' .responav li.menu-item:hover > a:not(.button)'
		);
		$dynamic_style .= whb_styling_tab_output( $atts, 'Current Menu Item', 'body #wrap #webnus-header-builder .whb-screen-view [data-id=whb-nav-wrap-' . esc_attr( $uniqid ) . '] .nav > li.current > a, body #wrap #webnus-header-builder .whb-screen-view [data-id=whb-nav-wrap-' . esc_attr( $uniqid ) . '] .nav > li.menu-item > a.active, body #wrap #webnus-header-builder .whb-screen-view [data-id=whb-nav-wrap-' . esc_attr( $uniqid ) . '] .nav ul.sub-menu li.current > a, .whb-responsive-menu-' . esc_attr( $uniqid ) . ' .responav li.current-menu-item > a:not(.button)', 'body #wrap #webnus-header-builder .whb-screen-view .whb-area [data-id=whb-nav-wrap-' . esc_attr( $uniqid ) . '] .nav > li.current > a:hover, body #wrap #webnus-header-builder .whb-screen-view [data-id=whb-nav-wrap-' . esc_attr( $uniqid ) . '] .nav > li.menu-item > a.active:hover, body #wrap #webnus-header-builder .whb-screen-view [data-id=whb-nav-wrap-' . esc_attr( $uniqid ) . '] .nav ul.sub-menu li.current > a:hover, .whb-responsive-menu-' . esc_attr( $uniqid ) . ' .responav li.current-menu-item > a:not(.button):hover' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Current Item Shape', 'body #wrap #webnus-header-builder .whb-screen-view [data-id=whb-nav-wrap-' . esc_attr( $uniqid ) . '] .nav > li.current > a:after', 'body #wrap #webnus-header-builder .whb-screen-view [data-id=whb-nav-wrap-' . esc_attr( $uniqid ) . '] .nav > li.current:hover > a:after' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Parent Menu Arrow', 'body #wrap #webnus-header-builder .whb-screen-view [data-id=whb-nav-wrap-' . esc_attr( $uniqid ) . '].has-parent-arrow > ul > li.menu-item-has-children:before, body #wrap #webnus-header-builder .whb-screen-view [data-id=whb-nav-wrap-' . esc_attr( $uniqid ) . '].has-parent-arrow > ul > li.menu-item-has-children>ul li.menu-item-has-children:before, body #wrap #webnus-header-builder .whb-screen-view [data-id=whb-nav-wrap-' . esc_attr( $uniqid ) . '].has-parent-arrow > ul > li.mega > a:before' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Menu Icon', 'body #wrap #webnus-header-builder .whb-responsive-menu-' . esc_attr( $uniqid ) . ' .responav > li > a > .wn-menu-icon, body #wrap #webnus-header-builder .whb-responsive-menu-' . esc_attr( $uniqid ) . ' .responav > li:hover > a > .wn-menu-icon, body #wrap #webnus-header-builder .whb-screen-view [data-id=whb-nav-wrap-' . esc_attr( $uniqid ) . '] .nav > li > a .wn-menu-icon', 'body #wrap #webnus-header-builder .whb-screen-view [data-id=whb-nav-wrap-' . esc_attr( $uniqid ) . '] .nav > li > a:hover .wn-menu-icon' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Submenu Menu Icon', 'body #wrap #webnus-header-builder .whb-responsive-menu-' . esc_attr( $uniqid ) . ' .responav > li > ul.sub-menu a > .wn-menu-icon, body #wrap #webnus-header-builder .whb-screen-view [data-id=whb-nav-wrap-' . esc_attr( $uniqid ) . '] .nav .sub-menu .wn-menu-icon', 'body #wrap #webnus-header-builder .whb-screen-view [data-id=whb-nav-wrap-' . esc_attr( $uniqid ) . '] .nav .sub-menu li a:hover .wn-menu-icon' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Menu Description', 'body #wrap #webnus-header-builder .whb-screen-view [data-id=whb-nav-wrap-' . esc_attr( $uniqid ) . '] .wn-menu-desc' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Menu Badge', 'body #wrap #webnus-header-builder .whb-screen-view [data-id=whb-nav-wrap-' . esc_attr( $uniqid ) . '] .nav a span.menu-item-badge, body #wrap #webnus-header-builder .whb-screen-view [data-id=whb-nav-wrap-' . esc_attr( $uniqid ) . '] .nav a span.menu-item-badge .menu-item-badge-text' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Submenu Item', 'body #wrap #webnus-header-builder .whb-nav-wrap[data-id=whb-nav-wrap-' . esc_attr( $uniqid ) . '] .nav ul li.menu-item a, .whb-responsive-menu-' . esc_attr( $uniqid ) . ' .responav li.menu-item > ul li > a:not(.button)', 'body #wrap #webnus-header-builder .whb-nav-wrap[data-id=whb-nav-wrap-' . esc_attr( $uniqid ) . '] .nav ul li.menu-item:hover > a, .whb-responsive-menu-' . esc_attr( $uniqid ) . ' .responav li.menu-item > ul li:hover > a:not(.button)' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Submenu Currnet Item', 'body #wrap #webnus-header-builder .whb-screen-view [data-id=whb-nav-wrap-' . esc_attr( $uniqid ) . '] .nav ul.sub-menu li.current > a' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Submenu Box', 'body #wrap #webnus-header-builder .whb-screen-view [data-id=whb-nav-wrap-' . esc_attr( $uniqid ) . '] .nav > li:not(.menu-item-object-mega_menu) ul' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Box', ' body #wrap #webnus-header-builder .whb-screen-view [data-id=whb-nav-wrap-' . esc_attr( $uniqid ) . '], .whb-responsive-menu-icon-wrap[data-uniqid="' . esc_attr( $uniqid ) . '"] .whb-responsive-menu-icon, .whb-responsive-menu-icon-wrap[data-uniqid="' . esc_attr( $uniqid ) . '"] .whb-responsive-menu-icon:before, .whb-responsive-menu-icon-wrap[data-uniqid="' . esc_attr( $uniqid ) . '"] .whb-responsive-menu-icon:after', 'body #wrap #webnus-header-builder .whb-screen-view [data-id=whb-nav-wrap-' . esc_attr( $uniqid ) . ']:hover' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Responsive Menu Box', '.whb-responsive-menu-' . esc_attr( $uniqid ) );

		if ( $dynamic_style ) {
			WHB_Helper::set_dynamic_styles( $dynamic_style );
		}

		if ( $height_100 == 'true' ) {
			WHB_Helper::set_dynamic_styles( 'body #wrap #webnus-header-builder .whb-screen-view [data-id=whb-nav-wrap-' . esc_attr( $uniqid ) . '], body #wrap #webnus-header-builder .whb-screen-view [data-id=whb-nav-wrap-' . esc_attr( $uniqid ) . '] .nav, .nav > li, .nav > li > a { height: 100%; }' );
		}

	endif;

	// extra class
	$extra_class = $extra_class ? ' ' . $extra_class : '';

	// render
	if ( $show_mobile_menu == 'true' ) {
		if ( $once_run_flag ) {
			// responsive menu
			$out .= '
				<div class="whb-responsive-menu-wrap whb-responsive-menu-' . esc_attr( $uniqid ) . '" data-uniqid="' . esc_attr( $uniqid ) . '">
					<div class="close-responsive-nav">
						<div class="whb-menu-cross-icon"></div>
					</div>
					' . $responsive_menu_out . '
				</div>';

			// normal menu
			$out .= '<nav class="whb-element whb-nav-wrap' . esc_attr( $extra_class ) . $desc_item . $parent_arrow . $full_menu . $show_mobile_menu_class . '" data-id="whb-nav-wrap-' . esc_attr( $uniqid ) . '" data-uniqid="' . esc_attr( $uniqid ) . '">' . $menu_out . '</nav>';

			if ( $mobile_sticky ) {
				$out .= '
					<div class="whb-responsive-menu-icon-wrap" data-uniqid="' . esc_attr( $uniqid ) . '">
						<div class="whb-menu-cross-icon whb-responsive-menu-icon"></div>
					</div>';
			}
		} else {
			$out .= '
				<div class="whb-responsive-menu-icon-wrap" data-uniqid="' . esc_attr( $uniqid ) . '">
					<div class="whb-menu-cross-icon whb-responsive-menu-icon"></div>
				</div>';
		}
	} else {
		if ( $deep_menu_location == 'true' ) {
			$menu_out = wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'container'   => false,
					'menu_id'     => 'nav' . $i++,
					'menu_class'  => 'nav',
					'depth'       => '5',
					'fallback_cb' => 'wp_page_menu',
					'items_wrap'  => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'echo'        => false,
					'walker'      => new wn_description_walker(),
				)
			);
		} else {
			$menu_out = wp_nav_menu(
				array(
					'menu'        => $menu,
					'container'   => false,
					'menu_id'     => 'nav' . $i++,
					'menu_class'  => 'nav',
					'depth'       => '5',
					'fallback_cb' => 'wp_page_menu',
					'items_wrap'  => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'echo'        => false,
					'walker'      => new wn_description_walker(),
				)
			);
		}

		// normal menu
		$out .= '<nav class="whb-element whb-nav-wrap' . esc_attr( $extra_class ) . $desc_item . $parent_arrow . $full_menu . $show_mobile_menu_class . '" data-id="whb-nav-wrap-' . esc_attr( $uniqid ) . '" data-uniqid="' . esc_attr( $uniqid ) . '">' . $menu_out . '</nav>';
	}

	return $out;
	$i++;
}

function deep_current_nav_class( $classes, $item ) {
	if ( in_array( 'current-menu-item', $classes ) ) {
		$classes[] = 'current ';
	}
	return $classes;
}
add_filter( 'nav_menu_css_class' , 'deep_current_nav_class' , 10 , 2 );

WHB_Helper::add_element( 'menu', 'whb_menu_f' );
