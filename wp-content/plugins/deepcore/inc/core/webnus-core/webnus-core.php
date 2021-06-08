<?php
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

// define some const
define( 'WEBNUS_CORE_DIR', DEEP_CORE_DIR . 'webnus-core/');
define( 'WEBNUS_CORE_URL', DEEP_CORE_URL . 'webnus-core/');

/*********************/
/*	    LOGIN
/*********************/
if ( ! function_exists('deep_login') ) {
	function deep_login() {
		$deep_options = deep_options();
		$color_skin_class = ( isset( $deep_options['deep_webnus_custom_color_skin'] ) || isset( $deep_options['deep_webnus_color_skin'] ) && $deep_options['deep_webnus_color_skin'] != 'e3e3e3' ) ? 'colorskin-custom' : '' ;
		global $user_ID, $user_identity;
		if ( $user_ID ) : ?>
			<div class="login-dropdown-arrow-wrap"></div>
			<div id="user-logged" class="<?php echo $color_skin_class; ?>">
				<span class="author-avatar"><?php echo get_avatar( $user_ID, $size = '100'); ?></span>
				<div class="user-welcome"><?php esc_html_e('Welcome','deep'); ?> <strong><?php echo esc_html($user_identity) ?></strong></div>
				<ul class="logged-links colorb">
					<?php if ( is_plugin_active( 'buddypress/bp-loader.php' ) ) { ?>
						<li><a href="<?php echo bp_loggedin_user_domain(); ?>"><?php esc_html_e('Profile','deep'); ?> </a></li>
						<li><a href="<?php echo esc_url(wp_logout_url(get_permalink())); ?>"><?php esc_html_e('Logout','deep'); ?> </a></li>
					<?php } else { ?>
						<li><a href="<?php echo esc_url(home_url('/wp-admin/')); ?>"><?php esc_html_e('Dashboard','deep'); ?> </a></li>
						<li><a href="<?php echo esc_url(home_url('/wp-admin/profile.php')); ?>"><?php esc_html_e('My Profile','deep'); ?> </a></li>
						<li><a href="<?php echo esc_url(wp_logout_url(get_permalink())); ?>"><?php esc_html_e('Logout','deep'); ?> </a></li>
					<?php } ?>
				</ul>
				<div class="clear"></div>
			</div>
		<?php else: ?>
			<div class="login-dropdown-arrow-wrap"></div>
				<?php if ( is_plugin_active('super-socializer/super_socializer.php') ) { ?>
					<!-- social login -->
					<div class="wn-social-login">
						<?php echo do_shortcode('[TheChamp-Login]'); ?>
						<div class="wn-or-divider">
							<span><?php _e( 'or', 'deep' ); ?></span>
						</div>
					</div>
				<?php } ?>
			<h3 id="user-login-title" class="user-login-title"><?php esc_html_e( 'Account Login', 'deep' ); ?></h3>
			<div id="user-login">
			<?php wp_login_form(array('label_username' => esc_html__( 'Username','deep' ),'label_password' => esc_html__( 'Password','deep' ),'label_remember' => esc_html__( 'Remember Me','deep' ),
			'label_log_in'   => esc_html__( 'Log In','deep' ),));?>
				<ul class="login-links">
					<?php if ( get_option('users_can_register') ) : ?><?php echo wp_register() ?><?php endif; ?>
					<li><a href="<?php echo esc_url(wp_lostpassword_url(get_permalink()))?>"><?php esc_html_e('Forget Password?','deep'); ?></a></li>
				</ul>
			</div>
		<?php endif;
	}
}
