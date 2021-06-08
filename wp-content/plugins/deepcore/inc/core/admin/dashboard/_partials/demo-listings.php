<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="wrap about-wrap wn-admin-wrap">
    <h1><?php echo esc_html__( 'Welcome to ', 'deep' ) . Deep_Admin::theme( 'name' ); ?></h1>
    <div class="about-text"><?php echo Deep_Admin::theme( 'name' ) . esc_html__( ' is now installed and ready to use! Let’s convert your imaginations to reality on the web!', 'deep' ); ?></div>
    <div class="wp-badge"><?php printf( esc_html__( 'Version %s', 'deep' ), DEEP_VERSION ); ?></div>
    <?php do_action( 'deep_before_start_dashboard' ); ?>
    <h2 class="nav-tab-wrapper wp-clearfix">
        <?php
        // Dashboard Menu
        Deep_Admin::dashboard_menu();
        ?>
    </h2>
    <div class="wbc_importer wn-theme-browser-wrap">
        <div class="theme-browser rendered wp-clearfix">

        <div class="deep-demo-search-nav">
            <div class="deep-demo-search-c-filter">
                <ul class="deep-demo-filter">
                    <li class="active"><a href="#"><?php esc_html_e( 'All', 'deep' ); ?></a></li>
                    <li><a href="#"><?php esc_html_e( 'Pro', 'deep' ); ?></a></li>
                    <li><a href="#"><?php esc_html_e( 'Free', 'deep' ); ?></a></li>
                </ul>
            </div>
            <div class="deep-demo-search-c-cat">
                <div class="deep-demo-categories">
                    <a href="#" class="demo-show-cat">
                    Categories
                    </a>
                    <span><svg class="deep-demo-arrow-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="10px"><!-- Font Awesome Free 5.15.3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) --><path d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"/></svg></span>
                    <ul class="demo-cat-list">
                        <li class="active"><a href="#"><?php esc_html_e( 'All', 'deep' ); ?></a></li>
                        <li><a href="#"><?php esc_html_e( 'Business', 'deep' ); ?></a></li>
                        <li><a href="#"><?php esc_html_e( 'Blog', 'deep' ); ?></a></li>
                        <li><a href="#"><?php esc_html_e( 'Church', 'deep' ); ?></a></li>
                        <li><a href="#"><?php esc_html_e( 'Event', 'deep' ); ?></a></li>
                        <li><a href="#"><?php esc_html_e( 'Software', 'deep' ); ?></a></li>
                        <li><a href="#"><?php esc_html_e( 'Personal', 'deep' ); ?></a></li>
                        <li><a href="#"><?php esc_html_e( 'Portfolio', 'deep' ); ?></a></li>
                        <li><a href="#"><?php esc_html_e( 'Hosting', 'deep' ); ?></a></li>
                        <li><a href="#"><?php esc_html_e( 'SEO', 'deep' ); ?></a></li>
                        <li><a href="#"><?php esc_html_e( 'Food', 'deep' ); ?></a></li>
                        <li><a href="#"><?php esc_html_e( 'Shop', 'deep' ); ?></a></li>
                        <li><a href="#"><?php esc_html_e( 'Health', 'deep' ); ?></a></li>
                        <li><a href="#"><?php esc_html_e( 'Learning', 'deep' ); ?></a></li>
                        <li><a href="#"><?php esc_html_e( 'Hotel', 'deep' ); ?></a></li>
                        <li><a href="#"><?php esc_html_e( 'Pet', 'deep' ); ?></a></li>
                        <li><a href="#"><?php esc_html_e( 'Coming Soon', 'deep' ); ?></a></li>
                    </ul>

                    <div class="deep-demo-search">
                        <input type="text" name="search" id="deep-demo-search-form" placeholder="Search">
                        <span id="deep-demo-search-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="13px"><!-- Font Awesome Free 5.15.3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) --><path d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"/></svg></span>
                    </div>
                </div>
            </div>
            <div class="deep-demo-search-c-pg">
                <div class="deep-demo-pg-menu">
                    <span class="pg-menu-src"><img src="<?php echo esc_url( DEEP_ASSETS_URL . 'images/pg/elementor.jpg' ); ?>"></span>
                    <span class="pg-menu-name">Elementor</span>
                    <span class="deep-demo-arrow-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="10px"><!-- Font Awesome Free 5.15.3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) --><path d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"/></svg></span></span>
                </div>
                <ul class="deep-demo-pg-list">
                    <li class="active">
                        <span class="pg-src"><img src="<?php echo esc_url( DEEP_ASSETS_URL . 'images/pg/elementor.jpg' ); ?>"></span>
                        <span class="pg-name">Elementor</span>
                    </li>
                    <li>
                        <span class="pg-src"><img src="<?php echo esc_url( DEEP_ASSETS_URL . 'images/pg/wpbakery.jpg' ); ?>"></span>
                        <span class="pg-name">WPBakery</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="themes wp-clearfix deep-demo-loop">
            <?php Deep_Demo_Importer::deep_demo_listings_loop('Elementor', 'All', 'All'); ?>
        </div>
        </div>
    </div>
</div>
