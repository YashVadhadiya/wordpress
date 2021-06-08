<!-- modal elements -->
<div class="whb-modal-wrap whb-elements">

	<div class="whb-modal-header">
		<h4><?php esc_html_e( 'Add Element', 'deep' ); ?></h4>
		<i class="ti-close"></i>
	</div>

	<div class="whb-modal-contents-wrap">
		<div class="whb-modal-contents wp-clearfix">

			<!-- Logo -->
			<div class="whb-elements-item w-col-sm-4" data-element="logo">
				<a href="#"><i class="ti-image"></i><span class="whb-element-name"><?php esc_html_e( 'Logo', 'deep' ); ?></span></a>
			</div>

			<!-- menu -->
			<div class="whb-elements-item w-col-sm-4" data-element="menu">
				<a href="#"><i class="ti-align-justify"></i><span class="whb-element-name"><?php esc_html_e( 'Menu', 'deep' ); ?></span></a>
			</div>

			<!-- Search -->
			<div class="whb-elements-item w-col-sm-4" data-element="search">
				<a href="#"><i class="ti-search"></i><span class="whb-element-name"><?php esc_html_e( 'Search', 'deep' ); ?></span></a>
			</div>

			<!-- Login -->
			<div class="whb-elements-item w-col-sm-4" data-element="login">
				<a href="#"><i class="ti-user"></i><span class="whb-element-name"><?php esc_html_e( 'Login', 'deep' ); ?></span></a>
			</div>

			<!-- Icon Content -->
			<div class="whb-elements-item w-col-sm-4" data-element="icon-content">
				<a href="#"><i class="ti-pencil-alt"></i><span class="whb-element-name"><?php esc_html_e( 'Icon Content', 'deep' ); ?></span></a>
			</div>

			<!-- Hamburger Menu -->
			<div class="whb-elements-item w-col-sm-4" data-element="hamburger-menu">
				<a href="#"><i class="ti-menu"></i><span class="whb-element-name"><?php esc_html_e( 'Hamburger Menu', 'deep' ); ?></span></a>
			</div>

			<!-- Social -->
			<div class="whb-elements-item w-col-sm-4" data-element="social">
				<a href="#"><i class="ti-twitter"></i><span class="whb-element-name"><?php esc_html_e( 'Social Network', 'deep' ); ?></span></a>
			</div>

			<?php if ( is_plugin_active( 'jetpack/jetpack.php' ) ) : ?>
			<!-- Social -->
			<div class="whb-elements-item w-col-sm-4" data-element="jetpacksocial">
				<a href="#"><i class="ti-twitter"></i><span class="whb-element-name"><?php esc_html_e( 'Jetpack Socials', 'deep' ); ?></span></a>
			</div>
			<?php endif; ?>

			<!-- Map -->
			<div class="whb-elements-item w-col-sm-4" data-element="map">
				<a href="#"><i class="ti-location-pin"></i><span class="whb-element-name"><?php esc_html_e( 'Google Maps', 'deep' ); ?></span></a>
			</div>

			<!-- Cart -->
			<div class="whb-elements-item w-col-sm-4" data-element="cart">
				<a href="#"><i class="ti-shopping-cart"></i><span class="whb-element-name"><?php esc_html_e( 'Woocommerce cart', 'deep' ); ?></span></a>
			</div>

			<!-- Contact -->
			<div class="whb-elements-item w-col-sm-4" data-element="contact">
				<a href="#"><i class="ti-email"></i><span class="whb-element-name"><?php esc_html_e( 'Contact', 'deep' ); ?></span></a>
			</div>

			<!-- Button -->
			<div class="whb-elements-item w-col-sm-4" data-element="button">
				<a href="#"><i class="ti-control-record"></i><span class="whb-element-name"><?php esc_html_e( 'Button', 'deep' ); ?></span></a>
			</div>

			<!-- Text -->
			<div class="whb-elements-item w-col-sm-4" data-element="text">
				<a href="#"><i class="ti-smallcap"></i><span class="whb-element-name"><?php esc_html_e( 'Text', 'deep' ); ?></span></a>
			</div>

			<?php if ( function_exists( 'pll_languages_list' ) || defined( 'WPML_PLUGIN_BASENAME' ) ): ?>
				<!-- Language -->
				<div class="whb-elements-item w-col-sm-4" data-element="language">
					<a href="#"><i class="wn-fa wn-fa-language"></i><span class="whb-element-name"><?php esc_html_e( 'Language Switcher', 'deep' ); ?></span></a>
				</div>
			<?php endif; ?>

			<!-- Weather -->
			<div class="whb-elements-item w-col-sm-4" data-element="weather">
				<a href="#"><i class="ti-cloud"></i><span class="whb-element-name"><?php esc_html_e( 'Weather', 'deep' ); ?></span></a>
			</div>

			<!-- icon-menu -->
			<div class="whb-elements-item w-col-sm-4" data-element="icon-menu">
				<a href="#"><i class="ti-info-alt"></i><span class="whb-element-name"><?php esc_html_e( 'Icon Menu', 'deep' ); ?></span></a>
			</div>

			<!-- wishlist -->
			<div class="whb-elements-item w-col-sm-4" data-element="wishlist">
				<a href="#"><i class="ti-heart"></i><span class="whb-element-name"><?php esc_html_e( 'Woocommerce Wishlist', 'deep' ); ?></span></a>
			</div>

			<!-- profile -->
			<div class="whb-elements-item w-col-sm-4" data-element="profile">
				<a href="#"><i class="ti-id-badge"></i><span class="whb-element-name"><?php esc_html_e( 'Profile', 'deep' ); ?></span></a>
			</div>

			<!-- date -->
			<div class="whb-elements-item w-col-sm-4" data-element="date">
				<a href="#"><i class="ti-calendar"></i><span class="whb-element-name"><?php esc_html_e( 'Date', 'deep' ); ?></span></a>
			</div>

			<!-- Advertise -->
			<div class="whb-elements-item w-col-sm-4" data-element="advertisement">
				<a href="#"><i class="ti-announcement"></i><span class="whb-element-name"><?php esc_html_e( 'Advertisement', 'deep' ); ?></span></a>
			</div>



		</div>
	</div> <!-- end whb-modal-contents-wrap -->

</div> <!-- end whb-elements -->
