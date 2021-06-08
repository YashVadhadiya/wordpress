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

	<div class="wn-plugins wn-theme-browser-wrap">
		<?php
			$tgmpa_list_table	= new TGMPA_List_Table;
			$plugins			= TGM_Plugin_Activation::$instance->plugins;
		?>
		<?php

		?>
		<div class="theme-browser rendered">
			<div class="themes">

			<?php
			foreach( $plugins as $plugin ) :

				$plugin_status				= '';
				$plugin['type']				= isset( $plugin['type'] ) ? $plugin['type'] : 'recommended';
				$plugin['sanitized_plugin']	= $plugin['name'];

				$plugin_action = $tgmpa_list_table->actions_plugin( $plugin );

				if ( is_plugin_active( $plugin['file_path'] ) ) {
					$plugin_status = 'active';
				}

				$category = $plugin['category']

				?>

				<div class="theme <?php echo esc_attr( $plugin_status ); ?> <?php echo $category; ?>">

					<?php if ( $plugin['type'] == 'Required' ) : ?>
						<div class="plugin-required"><?php esc_html_e( 'REQUIRED', 'deep' ); ?></div>
					<?php endif; ?>

					<div class="theme-screenshot">
						<img src="<?php echo esc_url( $plugin['image_src'] ); ?>" alt="">
					</div>

					<h3 class="theme-name"><?php echo esc_html( $plugin['name'] ); ?></h3>

					<div class="theme-actions"><?php echo '' . $plugin_action; ?></div>


				</div>

			<?php endforeach; ?>

			</div>
		</div>
	</div>

</div> <!-- end wrap -->