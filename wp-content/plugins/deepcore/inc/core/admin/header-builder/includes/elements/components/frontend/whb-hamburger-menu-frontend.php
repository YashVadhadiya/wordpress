<?php
function whb_hamburger_menu( $atts, $uniqid, $once_run_flag ) {
	extract( WHB_Helper::component_atts( array(
		'menu'				=> '',
		'hamburger_type'	=> 'toggle',
		'hamburger_icon'	=> '3line',
		'hm_style'			=> 'light',
		'toggle_from'		=> 'right',
		'image_logo'		=> '',
		'socials'			=> 'true',
		'search'			=> 'true',
		'placeholder'		=> 'Search ...',
		'content'			=> 'false',
		'text_content'		=> '',
		'copyright'			=> 'Copyright',
		'extra_class'		=> '',
	), $atts ));

	wp_enqueue_script( 'deep-nicescroll-script', DEEP_ASSETS_URL . 'js/libraries/jquery.nicescroll.js', array( 'jquery' ), null, true );

	$out = $menu_out = '';
    $dark_wrap       = ( $hm_style == 'dark' ) ? 'dark-wrap' : 'light-wrap' ;
	$menu_style		 = ( $hm_style == 'dark' ) ? 'hm-dark' : '' ;
	$copyright 		 = $copyright ? $copyright : '' ;
	$hamburger_type  = $hamburger_type ? $hamburger_type : 'toggle' ;
	$menu_list_style = ( $hamburger_type == 'toggle' ) ? 'toggle-menu' : 'full-menu';
	$hamburger_icon  = ( $hamburger_icon == '4line' ) ? 'fourline' : 'threeline';
	$placeholder	 = ! empty( $placeholder ) ? $placeholder : '' ;
	$image_logo		 = $image_logo ? wp_get_attachment_url( $image_logo ) : '' ;

	if ( $hamburger_type == 'toggle' ){
		$toggle_from = ( $toggle_from == 'right' ) ? 'toggle-right' : 'toggle-left';
	} else {
		$toggle_from = '';
	}

    if ( ! empty( $menu ) ) {
        $menu_out = wp_nav_menu( array(
            'menu'          => $menu,
            'container'     => false,
            'menu_class'    => $menu_list_style,
            'menu_id'       => 'hamburger-nav',
            'depth'         => '5',
            'fallback_cb'   => 'wp_page_menu',
            'items_wrap'    => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'echo'          => false,
            'walker'        => new wn_description_walker(),
        ));
    }

	// styles
	if ( $once_run_flag ) :

		$current_element = '#whb-hamburger-menu-' . esc_attr( $uniqid ) .' > a' ;
		$dynamic_style = '';
		if ( isset( $atts['background_image_sc_all_el_hamburger_icon_box'] ) ) {
			$asd = 'Hamburger Icon Color, #whb-hamburger-menu-' . esc_attr( $uniqid ) .' .hamburger-icon-center, #whb-hamburger-menu-' . esc_attr( $uniqid ) .' .hamburger-icon-top, #whb-hamburger-menu-' . esc_attr( $uniqid ) .' .hamburger-icon-bottom {display: none;}';
			WHB_Helper::set_dynamic_styles( $asd );
		} else {
			$dynamic_style .= whb_styling_tab_output( $atts, 'Hamburger Icon Color', '#whb-hamburger-menu-' . esc_attr( $uniqid ) .' .hamburger-icon-center, #whb-hamburger-menu-' . esc_attr( $uniqid ) .' .hamburger-icon-top, #whb-hamburger-menu-' . esc_attr( $uniqid ) .' .hamburger-icon-bottom, #whb-hamburger-menu-' . esc_attr( $uniqid ) .' .hamburger-icon-extra','#whb-hamburger-menu-' . esc_attr( $uniqid ) .' .hamburger-op-icon:hover .hamburger-icon-center, #whb-hamburger-menu-' . esc_attr( $uniqid ) .' .hamburger-op-icon:hover .hamburger-icon-top, #whb-hamburger-menu-' . esc_attr( $uniqid ) .' .hamburger-op-icon:hover .hamburger-icon-bottom, #whb-hamburger-menu-' . esc_attr( $uniqid ) .' .hamburger-op-icon:hover .hamburger-icon-extra');
		}
		$dynamic_style .= whb_styling_tab_output( $atts, 'Hamburger Icon Box', '#whb-hamburger-menu-' . esc_attr( $uniqid ) .' > a' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Hamburger Box', '.wn-ht .hamburger-menu-wrap-cl.hamburger-menu-wrap-' . esc_attr( $uniqid ) . ' ,.full .wn-hamburger-wrap-' . esc_attr( $uniqid ) . '' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Menu Box', '.wn-ht .hamburger-menu-wrap-cl.hamburger-menu-wrap-' . esc_attr( $uniqid ) . ' #hamburger-nav ,.full .wn-hamburger-wrap-' . esc_attr( $uniqid ) . ' #hamburger-nav', '.wn-ht .hamburger-menu-wrap-cl.hamburger-menu-wrap-' . esc_attr( $uniqid ) . ' #hamburger-nav:hover ,.full .wn-hamburger-wrap-' . esc_attr( $uniqid ) . ' #hamburger-nav:hover' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Menu Item', '.wn-ht .hamburger-menu-wrap-cl.hamburger-menu-wrap-' . esc_attr( $uniqid ) . ' #hamburger-nav > li > a ,.full .wn-hamburger-wrap-' . esc_attr( $uniqid ) . ' #hamburger-nav > li > a','.wn-ht .hamburger-menu-wrap-cl.hamburger-menu-wrap-' . esc_attr( $uniqid ) . ' #hamburger-nav > li:hover > a ,.full .wn-hamburger-wrap-' . esc_attr( $uniqid ) . ' #hamburger-nav > li:hover > a' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Current Menu Item', '.wn-ht .hamburger-menu-wrap-cl.hamburger-menu-wrap-' . esc_attr( $uniqid ) . ' #hamburger-nav > li.current > a ,.full .wn-hamburger-wrap-' . esc_attr( $uniqid ) . ' #hamburger-nav > li.current > a','.wn-ht .hamburger-menu-wrap-cl.hamburger-menu-wrap-' . esc_attr( $uniqid ) . ' #hamburger-nav > li.current:hover > a ,.full .wn-hamburger-wrap-' . esc_attr( $uniqid ) . ' #hamburger-nav > li.current:hover > a' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Current Item Shape', '.wn-ht .hamburger-menu-wrap-cl.hamburger-menu-wrap-' . esc_attr( $uniqid ) . ' #hamburger-nav > li.current > a:after ,.full .wn-hamburger-wrap-' . esc_attr( $uniqid ) . ' #hamburger-nav > li.current > a:after','.wn-ht .hamburger-menu-wrap-cl.hamburger-menu-wrap-' . esc_attr( $uniqid ) . ' #hamburger-nav > li.current:hover > a:after ,.full .wn-hamburger-wrap-' . esc_attr( $uniqid ) . ' #hamburger-nav > li.current:hover > a:after' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Submenu Item', '.wn-ht .hamburger-menu-wrap-cl.hamburger-menu-wrap-' . esc_attr( $uniqid ) . ' #hamburger-nav > li ul li a ,.full .wn-hamburger-wrap-' . esc_attr( $uniqid ) . ' #hamburger-nav > li ul li a','.wn-ht .hamburger-menu-wrap-cl.hamburger-menu-wrap-' . esc_attr( $uniqid ) . ' #hamburger-nav > li ul li:hover a ,.full .wn-hamburger-wrap-' . esc_attr( $uniqid ) . ' #hamburger-nav > li ul li:hover a' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Elements Box', '.wn-ht .hamburger-menu-wrap-cl.hamburger-menu-wrap-' . esc_attr( $uniqid ) . ' .hamburger-elements,.full .wn-hamburger-wrap-' . esc_attr( $uniqid ) . ' .hamburger-elements', '.wn-ht .hamburger-menu-wrap-cl.hamburger-menu-wrap-' . esc_attr( $uniqid ) . ' .hamburger-elements:hover,.full .wn-hamburger-wrap-' . esc_attr( $uniqid ) . ' .hamburger-elements:hover' );		
		$dynamic_style .= whb_styling_tab_output( $atts, 'Socials', '.wn-ht .hamburger-menu-wrap-cl.hamburger-menu-wrap-' . esc_attr( $uniqid ) . ' .hamburger-social-icons a i, .full .wn-hamburger-wrap-' . esc_attr( $uniqid ) . ' .hamburger-social-icons a i, .hamburger-menu-wrap-cl .hamburger-social-icons .socialfollow-name a','.wn-ht .hamburger-menu-wrap-cl.hamburger-menu-wrap-' . esc_attr( $uniqid ) . ' .hamburger-social-icons a:hover i, .full .wn-hamburger-wrap-' . esc_attr( $uniqid ) . ' .hamburger-social-icons a:hover i ,.hamburger-menu-wrap-cl .hamburger-social-icons .socialfollow-name a:hover' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Copyright', '.wn-ht .hamburger-menu-wrap-cl.hamburger-menu-wrap-' . esc_attr( $uniqid ) . ' .hamburger-copyright,.full .wn-hamburger-wrap-' . esc_attr( $uniqid ) . ' .hamburger-copyright', '.wn-ht .hamburger-menu-wrap-cl.hamburger-menu-wrap-' . esc_attr( $uniqid ) . ' .hamburger-copyright:hover,.full .wn-hamburger-wrap-' . esc_attr( $uniqid ) . ' .hamburger-copyright:hover' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Search Input', '.wn-ht .hamburger-menu-wrap-cl.hamburger-menu-wrap-' . esc_attr( $uniqid ) . ' #hamburger-menu-search-form input[type="text"],.full .wn-hamburger-wrap-' . esc_attr( $uniqid ) . ' #hamburger-menu-search-form input[type="text"]' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Search Box', '.wn-ht .hamburger-menu-wrap-cl.hamburger-menu-wrap-' . esc_attr( $uniqid ) . ' #hamburger-menu-search-form,.full .wn-hamburger-wrap-' . esc_attr( $uniqid ) . ' #hamburger-menu-search-form', '.wn-ht .hamburger-menu-wrap-cl.hamburger-menu-wrap-' . esc_attr( $uniqid ) . ' #hamburger-menu-search-form:hover,.full .wn-hamburger-wrap-' . esc_attr( $uniqid ) . ' #hamburger-menu-search-form:hover' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Logo Box', '.wn-ht .hamburger-menu-wrap-cl.hamburger-menu-wrap-' . esc_attr( $uniqid ) . ' .hamburger-logo-image-wrap,.full .wn-hamburger-wrap-' . esc_attr( $uniqid ) . ' .hamburger-logo-image-wrap', '.wn-ht .hamburger-menu-wrap-cl.hamburger-menu-wrap-' . esc_attr( $uniqid ) . ' .hamburger-logo-image-wrap:hover, .full .wn-hamburger-wrap-' . esc_attr( $uniqid ) . ' .hamburger-logo-image-wrap:hover' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Search Placeholder', '.wn-ht .hamburger-menu-wrap-cl.hamburger-menu-wrap-' . esc_attr( $uniqid ) . ' .hamburger-menu-search-content input.hamburger-search-text-box::placeholder' );
		$dynamic_style .= whb_styling_tab_output( $atts, 'Search Icon', '.wn-ht .hamburger-menu-wrap-cl.hamburger-menu-wrap-' . esc_attr( $uniqid ) . ' .hamburger-menu-search-content .hamburger-menu-search-icon' );

        if ( $dynamic_style ) :
            WHB_Helper::set_dynamic_styles( $dynamic_style );
        endif;

	endif;

	// extra class
	$extra_class = $extra_class ? ' ' . $extra_class : '';

	// render
	$out .= '
	<div class="whb-element whb-icon-wrap whb-hamburger-menu ' . esc_attr( $extra_class ) . ' ' . $hamburger_type . ' ' . $dark_wrap . ' ' . $hamburger_icon . '" id="whb-hamburger-menu-' . esc_attr( $uniqid ) . '">
		<a href="#" id="wn-hamburger-icon" class="whb-icon-element close-button hcolorf hamburger-op-icon">
			<div class="hamburger-icon">
				<div class="hamburger-icon-top"></div>
				<div class="hamburger-icon-center"></div>
				<div class="hamburger-icon-bottom"></div>';
				if ( $hamburger_icon == 'fourline') {
					$out .= '<div class="hamburger-icon-extra"></div>';
				}
		$out .= '
			</div>
		</a>';

	if ( $hamburger_type == 'full' ) :
		$out .= '
		<div class="wn-hamburger-wrap-' . esc_attr( $uniqid ) . ' wn-hamburger-wrap wn-hamuburger-bg ' . esc_attr( $menu_style ) . ' aligncenter">
			<div class="hamburger-full-wrap">
				<div class="whb-hamburger-top">';
					if ( ! empty( $image_logo ) ) {
						$out .= '
						<div class="hamburger-logo-image-wrap">
							<img class="hamburger-logo-image" src="' . esc_url( $image_logo ) . '" alt="'. get_bloginfo('name') .'">
						</div>';
					}

					$out .= $menu_out;

					if ( $search == 'true' ) :
						$out .= '
						<form id="hamburger-menu-search-form" role="search" action="' . esc_url(home_url( '/' )) . '" method="get" >
							<div class="hamburger-menu-search-content">
								<input name="s" type="text" class="hamburger-search-text-box" placeholder="' . $placeholder . '" >
								<i class="sl-magnifier hamburger-menu-search-icon"></i>
							</div>
						</form>';
					endif;

					$out .= '
				</div>
				<div class="whb-hamburger-bottom hamburger-elements">';
					if ( $content == 'true' ) :
						$out .= '<div class="whmb-text-content">' . $text_content . '</div>';
					endif;

					if ( $socials == 'true' ) :
						ob_start(); ?>
						<div class="hamburger-social-icons">
							<?php get_template_part( 'inc/templates/social' ); ?>
						</div>

						<?php
						$out .= ob_get_contents();
						ob_end_clean();
					endif;

					if ( ! empty( $copyright ) ) :
						$out .= '
						<div class="whb-hamburger-bottom hamburger-copyright">
						' . $copyright . '
						</div>';
					endif;
					$out .= '
				</div>
			</div>
		</div>';
	endif;

	if ( $once_run_flag ) :
		if ( $hamburger_type == 'toggle' ) :
			$out .= '
			<div class="hamburger-menu-wrap-cl wn-hamuburger-bg hamburger-menu-content ' . esc_attr( $menu_style ) . ' hamburger-menu-wrap-' . esc_attr( $uniqid ) . ' ' . $toggle_from . '">
				<div class="hamburger-menu-main">
					<div class="whb-hamburger-top">';
						if ( ! empty( $image_logo ) ) {
							$out .= '
							<div class="hamburger-logo-image-wrap">
								<img class="hamburger-logo-image" src="' . esc_url( $image_logo ) . '" alt="'. get_bloginfo('name') .'">
							</div>';
						}

						$out .=	$menu_out;

						if ( $search == 'true' ) :
							$out .= '
							<form id="hamburger-menu-search-form" role="search" action="' . esc_url(home_url( '/' )) . '" method="get" >
								<div class="hamburger-menu-search-content">
									<input name="s" type="text" class="hamburger-search-text-box" placeholder="' . $placeholder . '" >
									<i class="sl-magnifier hamburger-menu-search-icon"></i>
								</div>
							</form>';
						endif;

						$out .= '
					</div>';

					$out .= '<div class="whb-hamburger-bottom hamburger-elements">';
						if ( $content == 'true' ) :
							$out .= '<div class="whmb-text-content">' . $text_content . '</div>';
						endif;

						if ( $socials == 'true' ) :
							ob_start(); ?>

							<div class="hamburger-social-icons">
								<?php get_template_part( 'inc/templates/social' ); ?>
							</div>

							<?php
							$out .= ob_get_contents();
							ob_end_clean();
						endif;

						if ( ! empty( $copyright ) ) :
							$out .= '
							<div class="whb-hamburger-bottom hamburger-copyright">
							' . $copyright . '
							</div>';
						endif;
					$out .= '</div>'; // Close .hamburger-elements
				$out .= '</div>'; // Close .hamburger-menu-main

			$out .= '</div>';
		endif;
	endif;

	$out .= '</div>';

	return $out;
}

WHB_Helper::add_element( 'hamburger-menu', 'whb_hamburger_menu' );
