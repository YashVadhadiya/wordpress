<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

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

	$webnus_theme = wp_get_theme();
	$theme_version = $webnus_theme->get( 'Version' );
	$theme_name = $webnus_theme->get( 'Name' );
	$mem_limit = ini_get('memory_limit');
	$mem_limit_byte = wp_convert_hr_to_bytes($mem_limit);
	$upload_max_filesize = ini_get('upload_max_filesize');
	$upload_max_filesize_byte = wp_convert_hr_to_bytes($upload_max_filesize);
	$post_max_size = ini_get('post_max_size');
	$post_max_size_byte = wp_convert_hr_to_bytes($post_max_size);
	$mem_limit_byte_boolean = ($mem_limit_byte < 268435456);
	$upload_max_filesize_byte_boolean = ($upload_max_filesize_byte < 0.000038147);
	$post_max_size_byte_boolean = ($post_max_size_byte < 0.000038147);
	$execution_time = ini_get('max_execution_time');
	$execution_time_boolean = ($execution_time < 120);
	$input_vars = ini_get('max_input_vars');
	$input_vars_boolean = ($input_vars < 1000);
	$input_time = ini_get('max_input_time');
	$input_time_boolean = ($input_time < 1000);
	$theme_option_address = admin_url("themes.php?page=webnus_theme_options");

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

	if( class_exists('ZipArchive', false) == false ){
		$ziparchive = 'Disabled';
	} else {
		$ziparchive = 'Enabled';
	}

	?>

	<div id="webnus-dashboard" class="wrap about-wrap">

		<div class="welcome-content w-clearfix">

		</div>
		<?php if ( ! defined( 'DEEPFREE' ) ) { ?>
			<div class="w-row">
				<div class="w-col-sm-12">
					<div class="w-box theme-activate">
						<div class="w-box-head">
							<?php esc_html_e('Theme Activate','deep'); ?>
						</div>
						<div class="w-box-content">
							<?php esc_html_e('In order to use all theme features and options, please enter your purchase code.','deep') ?>
						</div>
						<div class="w-box-content">
							<?php
								$purchase_code = get_option( 'deep_purchase', '' );
								$purchase_type = get_option( 'deep_purchase_type', 'one' );
								$purchase_validation = get_option( 'deep_purchase_validation', '' );
								$purchase_form_class = $purchase_validation ? 'class="' . esc_attr( $purchase_validation ) . '"' : '';
							?>
							<form <?php echo $purchase_form_class; ?> id="wnThemeActivate" method="post" action="#">
								<div id="wnLicenseType">
									<div class="wn-radio-wrap">
										<label class="wn-radio-control <?php echo $purchase_type == 'one' ? 'checked' : ''; ?>" for="oneLicense">
											<input type="radio" id="oneLicense" name="typeOfLicense" value="one" checked="<?php echo $purchase_type == 'one' ? 'checked' : ''; ?>">
											<span class="wn-radio-indicator <?php echo $purchase_type == 'one' ? 'checked' : ''; ?>"></span>
											<?php esc_html_e( '1 License', 'deep' ); ?>
										</label>
									</div>
									<div class="wn-radio-wrap">
										<label class="wn-radio-control <?php echo $purchase_type == 'five' ? 'checked' : ''; ?>" for="fiveLicense">
											<input type="radio" id="fiveLicense" name="typeOfLicense" value="five" checked="<?php echo $purchase_type == 'five' ? 'checked' : ''; ?>">
											<span class="wn-radio-indicator <?php echo $purchase_type == 'five' ? 'checked' : ''; ?>"></span>
											<?php esc_html_e( '5 License', 'deep' ); ?>
										</label>
									</div>
									<div class="wn-radio-wrap">
										<label class="wn-radio-control <?php echo $purchase_type == 'ten' ? 'checked' : ''; ?>" for="tenLicense">
											<input type="radio" id="tenLicense" name="typeOfLicense" value="ten" checked="<?php echo $purchase_type == 'ten' ? 'checked' : ''; ?>">
											<span class="wn-radio-indicator <?php echo $purchase_type == 'ten' ? 'checked' : ''; ?>"></span>
											<?php esc_html_e( '10 License', 'deep' ); ?>
										</label>
									</div>
									<div class="wn-radio-wrap">
										<label class="wn-radio-control <?php echo $purchase_type == 'yearly' ? 'checked' : ''; ?>" for="yearlyLicense">
											<input type="radio" id="yearlyLicense" name="typeOfLicense" value="yearly" checked="<?php echo $purchase_type == 'yearly' ? 'checked' : ''; ?>">
											<span class="wn-radio-indicator <?php echo $purchase_type == 'yearly' ? 'checked' : ''; ?>"></span>
											<?php esc_html_e( 'Yearly Access', 'deep' ); ?>
										</label>
									</div>
									<div class="wn-radio-wrap">
										<label class="wn-radio-control <?php echo $purchase_type == 'lifetime' ? 'checked' : ''; ?>" for="lifetimeLicense">
											<input type="radio" id="lifetimeLicense" name="typeOfLicense" value="lifetime" checked="<?php echo $purchase_type == 'lifetime' ? 'checked' : ''; ?>">
											<span class="wn-radio-indicator <?php echo $purchase_type == 'lifetime' ? 'checked' : ''; ?>"></span>
											<?php esc_html_e( 'Lifetime Access', 'deep' ); ?>
										</label>
									</div>
								</div>
								<div id="wnGetLicense">
									<input placeholder="<?php echo esc_html__( 'Put your purchase code here', 'deep' ); ?>" id="wnPurchaseCode" name="deep_purchase" type="password" value="<?php echo $purchase_code; ?>">
									<input type="submit">
									<i class="wn-fa wn-fa-check" aria-hidden="true"></i>
									<i class="wn-fa wn-fa-times" aria-hidden="true"></i>
									<div id="wnFailedMesaage"></div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
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
			<!-- Post counts -->
			<div class="w-row">
				<div class="w-col-sm-2">
					<div class="w-box w-stat">
						<i class="ti-files"></i>
						<span><?php echo wp_count_posts( 'page' )->publish . esc_html__( ' Pages', 'deep' )?></span>
					</div>
				</div>
				<div class="w-col-sm-2">
					<div class="w-box w-stat">
						<i class="ti-pencil-alt"></i>
						<span><?php echo wp_count_posts( 'post' )->publish . esc_html__( ' Posts', 'deep' )?></span>
					</div>
				</div>
				<div class="w-col-sm-2">
					<div class="w-box w-stat">
						<i class="ti-comments"></i>
						<span><?php echo get_comment_count()["approved"] . esc_html__( ' Comments', 'deep' )?></span>
					</div>
				</div>
				<div class="w-col-sm-2">
					<div class="w-box w-stat">
						<i class="ti-briefcase"></i>
						<span><?php echo defined( 'PORTFOLIO_DIR' ) ? wp_count_posts( 'portfolio' )->publish . esc_html__( ' Portfolio Items', 'deep' ) : esc_html__( ' 0 Portfolio Items', 'deep' );?></span>
					</div>
				</div>
				<div class="w-col-sm-2">
					<div class="w-box w-stat">
						<i class="ti-calendar"></i>
						<span><?php echo class_exists( 'MEC' ) ? wp_count_posts( 'mec_calendars' )->publish . esc_html__( ' Events', 'deep' ) : esc_html__( ' 0 Events', 'deep' ); ?></span>
					</div>
				</div>
				<div class="w-col-sm-2">
					<div class="w-box w-stat">
						<i class="ti-gallery"></i>
						<span><?php echo array_sum( (array) wp_count_attachments() ) . esc_html__( ' Media Items', 'deep' )?></span>
					</div>
				</div>
			</div>
			<div id="wSystemStatus" class="w-row">
				<div class="w-col-sm-12">
					<div class="w-box">
						<div class="w-box-head">
							<?php esc_html_e('System Status','deep'); ?>
						</div>
						<div class="w-box-content">
							<?php esc_html_e('When you install a demo it provides pages, images, theme options, posts, sliders, widgets and etc. IMPORTANT: Please check the status below to see if your server meets all essential requirements for a successful import.','deep') ?>
							<!-- PHP Version -->
							<div class="w-system-info">
								<span> <?php esc_html_e('PHP Version','deep'); ?> </span>
								<?php
								if( version_compare(phpversion(), '5.6', '<') ){ ?>
									<i class="w-icon w-icon-red ti-close"></i> <span class="w-current"> <?php echo esc_html__('Currently:','deep').' '. phpversion() ?> </span>
									<span class="w-min"> <?php esc_html_e('(min: 5.6)','deep') ?> </span>
									<label class="hero button" for="php-version"> <?php esc_html_e('Please contact Host provider to fix it.','deep') ?> </label>
								<?php } else { ?>
									<i class="w-icon w-icon-green ti-check"></i> <span class="w-current"> <?php echo esc_html__('Currently:','deep').' '. phpversion() ?> </span>
								<?php } ?>
							</div>
							<!-- PHP ZipArchive -->
							<div class="w-system-info">
								<span> <?php esc_html_e('PHP ZipArchive extension','deep'); ?> </span>
								<?php
								if( class_exists('ZipArchive', false) == false ){ ?>
									<i class="w-icon w-icon-red ti-close"></i> <span class="w-current"> <?php echo esc_html__('Currently:','deep').' '. $ziparchive ?> </span>
									<span class="w-min"></span>
									<label class="hero button" for="php-version"> <?php esc_html_e('Please contact Host provider to fix it.','deep') ?> </label>
								<?php } else { ?>
									<i class="w-icon w-icon-green ti-check"></i> <span class="w-current"> <?php echo esc_html__('Currently:','deep').' '. $ziparchive ?> </span>
								<?php } ?>
							</div>
							<!-- PHP Maximum Execution Time -->
							<div class="w-system-info">
								<span> <?php esc_html_e('PHP Maximum Execution Time','deep'); ?> </span>
								<?php
								if($execution_time_boolean){ ?>
									<i class="w-icon w-icon-red ti-close"></i>
									<span class="w-current"> <?php echo esc_html('Currently:','deep').' '.$execution_time; ?> </span>
									<span class="w-min"> <?php esc_html_e('(min:180)','deep') ?> </span>
									<label class="hero button" for="execution-time"> <?php esc_html_e('How to fix it','deep') ?> </label>
									<aside class="lightbox">
										<input type="checkbox" class="state" id="execution-time" />
										<article class="content">
											<header class="header">
												<label class="button" for="execution-time"><i class="ti-close"></i></label>
											</header>
											<main class="main">
												<p class="red"> <?php esc_html_e( 'We recommend setting max execution time to at least 180. you can read the links for more information:' , 'deep' ) ?> </p>
												<a href="http://codex.wordpress.org/Common_WordPress_Errors#Maximum_execution_time_exceeded" target="_blank"> <?php esc_html_e( 'Increasing Max. Execution Time' , 'deep' ) ?> </a>
											</main>
										</article>
										<label class="backdrop" for="execution-time"></label>
									</aside>
								<?php } else { ?>
									<i class="w-icon w-icon-green ti-check"></i> <span class="w-current"> <?php echo esc_html__('Currently:','deep').' '.$execution_time; ?> </span>
								<?php } ?>
							</div>
							<!-- PHP Maximum Input Vars -->
							<div class="w-system-info">
								<span> <?php esc_html_e('PHP Maximum Input Vars','deep') ?> </span>
								<?php
								if($input_vars_boolean){ ?>
									<i class="w-icon w-icon-red ti-close"></i>
									<span class="w-current"> <?php echo esc_html__('Currently:','deep').' '.$input_vars; ?> </span>
									<span class="w-min"> <?php esc_html_e('(min:2000)','deep') ?> </span>
									<label class="hero button" for="input-variables"><?php esc_html_e('How to fix it','deep') ?> </label>
									<aside class="lightbox">
										<input type="checkbox" class="state" id="input-variables" />
										<article class="content">
											<header class="header">
												<label class="button" for="input-variables"><i class="ti-close"></i></label>
											</header>
											<main class="main">
												<p class="red"> <?php esc_html_e( 'We recommend setting max input vars to at least 2000. Please follow these steps:' , 'deep' ) ?></p>
												<p>There are several ways to do it. First one to check would be to login to your server's cPanel and look there for PHP settings. Often there's an option to edit PHP settings "per host" or "per domain" and you may find it there.
												<br>
												If there's no such option:
												<br>
												- create a file named "php.ini"<br>
												- put following line inside
												<br>
												<code class="red">max_input_vars = 3000;</code>
												<br>
												- save the file and upload it to your server to the root (main) folder of your domain
												<br>
												On some servers it's not possible to use "php.ini" file that way so if above doesn't work, there's another way to check:
												<br>
												- edit the ".htaccess" file of your site<br>
												- add following lines at the very top of it (do not remove anything that's already there)
												<br>
												<code class="red">php_value max_input_vars 3000</code>
												<br>
												- save the file.
												<br>
												If that doesn't work either or breaks the site, edit the file again to remove the line and get in touch with your host asking them if they could increase that value for you.</p>
											</main>
										</article>
										<label class="backdrop" for="input-variables"></label>
									</aside>
								<?php } else { ?>
									<i class="w-icon w-icon-green ti-check"></i> <span class="w-current"> <?php echo esc_html__('Currently:','deep').' '.$input_vars; ?> </span>
								<?php } ?>
							</div>
							<!-- Maximum filesize for upload -->
							<div class="w-system-info">
								<span> <?php esc_html_e('Maximum filesize for upload','deep') ?> </span>
								<?php
								if($upload_max_filesize_byte_boolean){ ?>
									<i class="w-icon w-icon-red ti-close"></i> <span class="w-current"> <?php echo esc_html__('Currently:','deep').' '.$upload_max_filesize; ?> </span>
									<span class="w-min"> <?php esc_html_e('(min:40M)','deep') ?> </span>
									<label class="hero button" for="php-upload-size"> <?php esc_html_e('How to fix it','deep') ?> </label>
									<aside class="lightbox">
										<input type="checkbox" class="state" id="php-upload-size" />
										<article class="content">
											<header class="header">
												<label class="button" for="php-upload-size"><i class="ti-close"></i></label>
											</header>
											<main class="main">
												<p class="red"> <?php esc_html_e( 'We recommend setting Upload Max. Filesize to at least 10MB. You can read these links for more information:' , 'deep' ) ?></p>
												<a href="https://premium.wpmudev.org/blog/increase-memory-limit/?ench=b&utm_expid=3606929-78.ZpdulKKETQ6NTaUGxBaTgQ.1&utm_referrer=https%3A%2F%2Fpremium.wpmudev.org%2Fblog%2F%3Fench%3Db%26s%3Dmemory_limit" target="_blank"> <?php esc_html_e( 'Increasing Upload Max. Filesize' , 'deep' ) ?></a><br>
											</main>
										</article>
										<label class="backdrop" for="php-upload-size"></label>
									</aside>
								<?php } else { ?>
									<i class="w-icon w-icon-green ti-check"></i> <span class="w-current"> <?php echo esc_html__('Currently:','deep').' '.$upload_max_filesize; ?> </span>
								<?php } ?>
							</div>
							<!-- Maximum Post Size -->
							<div class="w-system-info">
								<span> <?php esc_html_e('Maximum Post Size','deep') ?> </span>
								<?php
								if($post_max_size_byte_boolean){ ?>
									<i class="w-icon w-icon-red ti-close"></i> <span class="w-current"> <?php echo esc_html__('Currently:','deep').' '.$post_max_size; ?> </span>
									<span class="w-min"> <?php esc_html_e('(min:40M)','deep') ?> </span>
									<label class="hero button" for="php-post-upload-size"> <?php esc_html_e('How to fix it','deep') ?> </label>
									<aside class="lightbox">
										<input type="checkbox" class="state" id="php-post-upload-size" />
										<article class="content">
											<header class="header">
												<label class="button" for="php-post-upload-size"><i class="ti-close"></i></label>
											</header>
											<main class="main">
												<p class="red"> <?php esc_html_e( 'We recommend setting Max. Post Size to at least 30MB. you can read these links for more information:' , 'deep' ) ?> </p>
												<a href="https://premium.wpmudev.org/blog/increase-memory-limit/?ench=b&utm_expid=3606929-78.ZpdulKKETQ6NTaUGxBaTgQ.1&utm_referrer=https%3A%2F%2Fpremium.wpmudev.org%2Fblog%2F%3Fench%3Db%26s%3Dmemory_limit" target="_blank">Increasing Max. Post Size</a><br>
											</main>
										</article>
										<label class="backdrop" for="php-post-upload-size"></label>
									</aside>
								<?php }else{ ?>
									<i class="w-icon w-icon-green ti-check"></i> <span class="w-current"> <?php echo esc_html__('Currently:','deep').' '.$post_max_size; ?> </span>
								<?php } ?>
							</div>
							<!-- WP Memory Limit -->
							<div class="w-system-info">
								<span> <?php esc_html_e('WP Memory Limit','deep'); ?> </span>
								<?php
								$wp_memory_limit = WP_MEMORY_LIMIT;
								$wp_memory_limit_value = preg_replace("/[^0-9]/", '', $wp_memory_limit);
								if( $wp_memory_limit_value < 256 ){ ?>
									<i class="w-icon w-icon-red ti-close"></i> <span class="w-current"> <?php echo esc_html__('Currently:','deep').' '.$wp_memory_limit ?> </span>
									<span class="w-min"> <?php esc_html_e('(min:256M)','deep') ?> </span>
									<label class="hero button" for="wp-memory-limit"> <?php esc_html_e('How to fix it','deep') ?> </label>
									<aside class="lightbox">
										<input type="checkbox" class="state" id="wp-memory-limit" />
										<article class="content">
											<header class="header">
												<label class="button" for="wp-memory-limit"><i class="ti-close"></i></label>
											</header>
											<main class="main">
												<p class="red"> <?php esc_html_e( 'We recommend setting memory to at least 256MB. Please define memory limit in wp-config.php file. you can read these links for more information:' , 'deep' ) ?></p>
												<a href="https://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP" target="_blank"> <?php esc_html_e( 'Increasing Wp Memory Limit' , 'deep' ) ?> </a>
											</main>
										</article>
										<label class="backdrop" for="wp-memory-limit"></label>
									</aside>
								<?php } else { ?>
									<i class="w-icon w-icon-green ti-check"></i> <span class="w-current"> <?php echo esc_html__('Currently:','deep').' '.$wp_memory_limit; ?> </span>
								<?php } ?>
							</div>
							<!-- PHP Max Input Time -->
							<!-- <div class="w-system-info">
								<span> <?php esc_html_e('PHP Max. Input Time','deep') ?> </span>
								<?php
								if($input_time_boolean){ ?>
									<i class="w-icon w-icon-red ti-close"></i> <span class="w-current"> <?php echo esc_html__('Currently:','deep').' '.$input_time; ?> </span>
									<span class="w-min"> <?php esc_html_e('(min:1000)','deep') ?></span>
									<label class="hero button" for="php-input-time"> <?php esc_html('How to fix it','deep') ?></label>
									<aside class="lightbox">
										<input type="checkbox" class="state" id="php-input-time" />
										<article class="content">
											<header class="header">
												<label class="button" for="php-input-time"><i class="ti-close"></i></label>
											</header>
											<main class="main">
												<p class="red"> <?php esc_html_e('It may not work with some shared hosts in which case you would have to ask your hosting service provider for support.' , 'deep' ) ?> </p>
												<strong> <?php esc_html_e('1- Create or Edit an existing PHP.INI file' , 'deep' ) ?> </strong><br>
												<?php esc_html_e('In most cases if you are on a shared host, you will not see a php.ini file in your directory. If you do not see one, then create a file called php.ini and upload it in the root folder. In that file add the following code:' , 'deep' ) ?><br>
												<code class="red"> <?php esc_html_e('max_input_time' , 'deep' ) ?> = 1000 </code><br><br>
												<strong> <?php esc_html_e('2- htaccess Method' , 'deep' ) ?></strong><br>
												<?php esc_html_e('Some people have tried using the htaccess method where by modifying the .htaccess file in the root directory, you can increase the Max. Input Time in WordPress. Open or create the .htaccess file in the root folder and add the following code:' , 'deep' ) ?><br>
												<code class="red"> <?php esc_html_e('php_value max_input_time' , 'deep' ) ?> 1000</code><br>
											</main>
										</article>
										<label class="backdrop" for="php-input-time"></label>
									</aside>
								<?php } else { ?>
									<i class="w-icon w-icon-green ti-check"></i> <span class="w-current"> <?php echo esc_html__('Currently:','deep').' '.$input_time; ?> </span>
								<?php }	?>
							</div> -->
						</div>
					</div>
				</div>
			</div>
			<div class="w-row">
				<div class="w-col-sm-12">
					<div class="w-box change-log">
						<div class="w-box-head">
							<?php esc_html_e('Changelog (Updates)','deep'); ?>
						</div>
						<div class="w-box-content">
						<?php include_once DEEP_INCLUDES_DIR . 'Change_log.php'; ?>
							<pre><?php echo '' . $change_log; ?></pre>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div> <!-- end wrap -->