<?php
/**
 * Primary Menu Template
 *
 * @package Signify Pro
 */

?>
	<div id="site-header-menu" class="site-header-menu">
		<div id="primary-menu-wrapper" class="menu-wrapper">
			<div class="menu-toggle-wrapper">
				<button id="menu-toggle" class="menu-toggle" aria-controls="top-menu" aria-expanded="false"><span class="menu-label"><?php echo esc_html_e( 'Menu', 'signify' ); ?></span></button>
			</div><!-- .menu-toggle-wrapper -->

			<div class="menu-inside-wrapper">
				<nav id="site-navigation" class="main-navigation default-page-menu" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'signify' ); ?>">

				<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
					<?php
						wp_nav_menu( array(
								'container'      => '',
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
								'menu_class'     => 'menu nav-menu',
							)
						);
					?>
				<?php else : ?>
					<?php wp_page_menu(
						array(
							'menu_class' => 'primary-menu-container',
							'before'     => '<ul id="menu-primary-items" class="menu nav-menu">',
							'after'      => '</ul>',
						)
					); ?>
				<?php endif; ?>

				</nav><!-- .main-navigation -->

				<?php if ( get_theme_mod( 'signify_primary_search_enable' ) ) : ?>
					<div class="mobile-social-search">
						<div class="search-container">
							<?php get_search_form(); ?>
						</div>
					</div><!-- .mobile-social-search -->
				<?php endif; ?>
			</div><!-- .menu-inside-wrapper -->
		</div><!-- #primary-menu-wrapper.menu-wrapper -->

		<?php if ( get_theme_mod( 'signify_primary_search_enable') ) : ?>
		<div id="primary-search-wrapper" class="menu-wrapper">
			<div class="menu-toggle-wrapper">
				<button id="social-search-toggle" class="menu-toggle search-toggle">
					<span class="menu-label screen-reader-text"><?php echo esc_html_e( 'Search', 'signify' ); ?></span>
				</button>
			</div><!-- .menu-toggle-wrapper -->

			<div class="menu-inside-wrapper">
				<div class="search-container">
					<?php get_Search_form(); ?>
				</div>
			</div><!-- .menu-inside-wrapper -->
		</div><!-- #social-search-wrapper.menu-wrapper -->
		<?php endif; ?>
	</div><!-- .site-header-menu -->
