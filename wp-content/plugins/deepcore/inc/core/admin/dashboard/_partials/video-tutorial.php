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

	<?php

	$keyses = array(
		'a' => array(
			'href' => array(),
			'title' => array(),
			'target' => array(),
		),
		'br' => array(),
		'em' => array(),
		'strong' => array(),
		'code' => array(
			'class' => array(),
		),
		'p' => array(
			'class' => array(),
		),
	);

	?>

	<div id="webnus-dashboard" class="wrap about-wrap">
		<div class="welcome-content w-clearfix extra">
			<div class="w-row">
					<div class="w-col-sm-6">
						<div class="w-box doc">
							<div class="w-box-head">
								<?php esc_html_e('Documentation','deep'); ?>
							</div>
							<div class="w-box-content">
								<p>
								<?php esc_html_e('Our documentation is simple and functional with full details and it cover all essential aspects, from beginner to the advanced.' , 'deep'); ?>
								</p>
								<div class="w-button">
									<a href="https://webnus.net/deep-premium-wordpress-theme-documentation/" target="_blank"><?php esc_html_e('DOCUMENTATION','deep'); ?></a>
								</div>
							</div>
						</div>
					</div>
					<div class="w-col-sm-6">
						<div class="w-box support">
							<div class="w-box-head">
								<?php esc_html_e('Support','deep'); ?>
							</div>
							<div class="w-box-content">
								<p>
								<?php esc_html_e('You don’t need to register anywhere for support anymore. just click the following button, and the chat box will open up to ask all your different questions using our channels.' , 'deep'); ?>
								</p>
								<div class="w-button">
								<a href="https://webnus.net/support/" id="open-ticket" target="_blank"><?php esc_html_e('OPEN A TICKET','deep'); ?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			<div class="w-row">
				<div class="w-col-sm-4">
					<div class="w-box doc">
						<iframe width="100%" height="315" src="https://www.youtube.com/embed/HKwbsORdars" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>	
					</div>
				</div>
				<div class="w-col-sm-4">
					<div class="w-box doc">
						<iframe width="100%" height="315" src="https://www.youtube.com/embed/Ey9fA6AKD2g" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>	
					</div>
				</div>
				<div class="w-col-sm-4">
					<div class="w-box doc">
						<iframe width="100%" height="315" src="https://www.youtube.com/embed/SVA3Q833CIg" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>	
					</div>
				</div>
			</div>

			<div class="w-row">
				<div class="w-col-sm-4">
					<div class="w-box doc">
						<iframe width="100%" height="315" src="https://www.youtube.com/embed/fZOSKv7YFzg" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>	
					</div>
				</div>
				<div class="w-col-sm-4">
					<div class="w-box doc">
						<iframe width="100%" height="315" src="https://www.youtube.com/embed/cOddLR5IoJA" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>	
					</div>
				</div>
				<div class="w-col-sm-4">
					<div class="w-box doc">
						<iframe width="100%" height="315" src="https://www.youtube.com/embed/rb3Gw-0Z7UI" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>	
					</div>
				</div>
			</div>
			<div class="w-row">
				<div class="w-col-sm-4">
					<div class="w-box doc">
						<iframe width="100%" height="315" src="https://www.youtube.com/embed/sAnBCXBbz3s" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>	
					</div>
				</div>
				<div class="w-col-sm-4">
					<div class="w-box doc">
						<iframe width="100%" height="315" src="https://www.youtube.com/embed/Hao_-YXjmHU" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>	
					</div>
				</div>
				<div class="w-col-sm-4">
					<div class="w-box doc">
						<iframe width="100%" height="315" src="https://www.youtube.com/embed/igdhWHe1k28" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>	
					</div>
				</div>
			</div>

			<div class="w-row">
				<div class="w-col-sm-4">
					<div class="w-box doc">
						<iframe width="100%" height="315" src="https://www.youtube.com/embed/RAfbn9wgUWU" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>	
					</div>
				</div>
				<div class="w-col-sm-4">
					<div class="w-box doc">
						<iframe width="100%" height="315" src="https://www.youtube.com/embed/N9v7K5DrkgE" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>	
					</div>
				</div>
				<div class="w-col-sm-4">
					<div class="w-box doc">
						<iframe width="100%" height="315" src="https://www.youtube.com/embed/yzY-q7oJmd4" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>	
					</div>
				</div>		
			</div>

			<div class="w-row">
				<div class="w-col-sm-4">
					<div class="w-box doc">
						<iframe width="100%" height="315" src="https://www.youtube.com/embed/kenK3KloLw4" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>	
					</div>
				</div>
				<div class="w-col-sm-4">
					<div class="w-box doc">
						<iframe width="100%" height="315" src="https://www.youtube.com/embed/P_dehEnNqRY" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>	
					</div>
				</div>
				<div class="w-col-sm-4">
					<div class="w-box doc">
						<iframe width="100%" height="315" src="https://www.youtube.com/embed/3eVNkxpN0tk" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>	
					</div>
				</div>	
			</div>
		</div>
	</div>

</div> <!-- end wrap -->