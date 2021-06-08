<?php
/**
 * Deep Theme Admin.
 *
 * @package Deep Theme
 */

namespace DeepTheme\Admin;

/**
 * Class Deep_Theme_Admin.
 */
class Deep_Theme_Admin {

	/**
	 * Instance of this class.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     Deep_Theme_Admin
	 */
	public static $instance;

	/**
	 * Page title.
	 *
	 * @since   1.0.0
	 * @var     page_title
	 */
	public static $page_title = 'Deep';

	/**
	 * Menu title.
	 *
	 * @since   1.0.0
	 * @var     menu_title
	 */
	public static $menu_title = 'Deep Theme';

	/**
	 * Plugin Slug.
	 *
	 * @since   1.0.0
	 * @var     plugin_slug
	 */
	public static $plugin_slug = 'deep';

	/**
	 * Provides access to a single instance of a module using the singleton pattern.
	 *
	 * @since   1.0.0
	 * @return  object
	 */
	public static function get_instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor.
	 *
	 * @access private
	 * @since 1.0.0
	 */
	private function __construct() {
        $this->load_dependencies();
        $this->hooks();
	}

	/**
	 * Load the dependencies.
	 *
	 * @access private
	 * @since 1.0.0
	 */
    private function load_dependencies() { }

    /**
	 * Hooks.
	 *
	 * @access private
	 * @since 1.0.0
	 */
    private function hooks() {

		add_action( 'admin_menu', [$this, 'deeptheme_admin_menu'] );
		add_action( 'deeptheme_rate', [$this, 'deeptheme_rate'] );
		add_action( 'admin_notices', [$this, 'deeptheme_admin_notices'] );
		// add_action( 'deeptheme_community', [$this, 'deeptheme_community'] );
		add_action( 'admin_enqueue_scripts', [$this, 'deeptheme_admin_assets'] );
		add_action( 'deeptheme_admin_header', [$this, 'deeptheme_admin_header'] );
		add_action( 'deeptheme_more_options', [$this, 'deeptheme_more_options'] );
		add_action( 'deeptheme_admin_content', [$this, 'deeptheme_admin_content'] );
		add_action( 'deeptheme_plugin_notice', [$this, 'deeptheme_plugin_notice'] );
		add_action( 'deeptheme_knowledge_base', [$this, 'deeptheme_knowledge_base'] );
		add_action( 'deeptheme_import_template', [$this, 'deeptheme_import_template'] );
		add_action( 'deeptheme_customizer_links', [$this, 'deeptheme_customizer_links'] );

	}

	/**
	 * Deep Admin Assets.
	 *
	 * @access  public
	 * @since   1.0.0
	 */
	public function deeptheme_admin_assets() {

		wp_enqueue_style( 'deep-theme-admin', DEEP_THEME_URI . 'src/assets/css/deeptheme-admin-page.css', false, DEEPTHEME );

	}

	/**
	 * Deep Admin Menu.
	 *
	 * @access  public
	 * @since   1.0.0
	 */
	public function deeptheme_admin_menu() {

		$capability = 'manage_options';
		$menu_slug  = self::$plugin_slug;
		$page_title = self::$page_title;
		$menu_title = self::$menu_title;
		$admin_menu_callback = __CLASS__ . '::deeptheme_admin_menu_callback';

		add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $admin_menu_callback );

	}

	/**
	 * Deep Admin Menu Callback.
	 *
	 * @access  public
	 * @since   1.0.0
	 */
	public static function deeptheme_admin_menu_callback() {

		?>
		<div class="deeptheme-admin-page">
			<?php
				do_action( 'deeptheme_admin_header' );
				do_action( 'deeptheme_admin_content' );
			?>
		</div>
		<?php

	}

	/**
	 * Deep Admin Header.
	 *
	 * @access  public
	 * @since   1.0.0
	 */
	public function deeptheme_admin_header() {

		?>
		<div class="deeptheme-admin-header">
			<div class="dp-admin-top-bar">
				<div class="dp-admin-top-title">
					<a href="<?php echo esc_url( 'https://webnus.net/deep-premium-wordpress-theme/' ); ?>" target="_blank">
						<img src="<?php echo esc_url( DEEP_THEME_URI . 'src/assets/img/deep-logo.svg' ) ?>" width="120">
					</a>
				</div>
				<div class="dp-admin-top-links">
					<a href="<?php echo esc_url( 'https://webnus.net/deep-premium-wordpress-theme/' ) ?>" target="_blank"><?php esc_html_e( 'Intro', 'deep' ); ?></a>
					<a href="<?php echo esc_url( 'https://webnus.net/deep-premium-wordpress-theme/#demos' ) ?>" target="_blank"><?php esc_html_e( 'Demos', 'deep' ); ?></a>
					<a href="<?php echo esc_url( 'https://webnus.net/pricing/' ) ?>" target="_blank"><?php esc_html_e( 'Pro', 'deep' ); ?></a>
					<a href="<?php echo esc_url( 'https://webnus.net/support/' ); ?>" target="_blank"><?php esc_html_e( 'Support', 'deep' ); ?></a>
					<a href="<?php echo esc_url( 'https://webnus.net/deep-premium-wordpress-theme-documentation/' ); ?>" target="_blank"><?php esc_html_e( 'Help', 'deep' ); ?></a>
				</div>
			</div>
		</div>
		<?php

	}

	/**
	 * Deep Admin Content.
	 *
	 * @access  public
	 * @since   1.0.0
	 */
	public function deeptheme_admin_content() {

		?>
		<div class="deeptheme-admin-content">
			<?php
				do_action( 'deeptheme_plugin_notice' );
			?>
			<div class="deeptheme-admin-left">
			<?php
				do_action( 'deeptheme_customizer_links' );
				do_action( 'deeptheme_more_options' );
			?>
			</div>
			<div class="deeptheme-admin-right">
			<?php
				do_action( 'deeptheme_import_template' );
				do_action( 'deeptheme_knowledge_base' );
				do_action( 'deeptheme_community' );
				do_action( 'deeptheme_rate' );
			?>
			</div>
		</div>
		<?php

	}

	/**
	 * Deep Install plugin Notice.
	 *
	 * @access  public
	 * @since   1.0.0
	 */
	public static function deeptheme_plugin_notice() {

		if ( ! defined( 'DEEPCOREPRO' ) ) {
			?>
			<div class="deeptheme-plugin-notice">
				<?php if( ! defined( 'DEEPCORE' ) ): ?>
					<h2><?php esc_html_e( 'Enable all Features of the Deep theme', 'deep' ); ?></h2>
					<p><?php esc_html_e( 'In order to take full advantage of the Deep theme and enabling its demo importer, please install the recommended plugins.', 'deep' ); ?></p>
					<a href="<?php echo esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ); ?>"><?php esc_html_e( 'Install Plugin', 'deep' ); ?></a>
				<?php else: ?>
					<h2><?php esc_html_e( 'Go Pro & Full Access to Advanced Features', 'deep' ); ?></h2>
					<p><?php esc_html_e( 'Get full access to more demos and all advanced features of Deep theme by upgrading to Pro version right away.', 'deep' ); ?></p>
					<a href="<?php echo esc_url( 'https://webnus.net/pricing/' ); ?>" target="_blank"><?php esc_html_e( 'Go Pro', 'deep' ); ?></a>
				<?php endif; ?>
			</div>
			<?php
		}

	}

	/**
	 * Deep Customizer Links.
	 *
	 * @access  public
	 * @since   1.0.0
	 */
	public function deeptheme_customizer_links() {

		if ( is_plugin_active( 'deepcore/deepcore.php' ) || is_plugin_active( 'deep-core-pro/deep-core-pro.php' ) ) {

			$customizer_url = admin_url( 'customize.php' ) . '?autofocus[panel]=';

			$customizer_links = apply_filters(
				'deep_customizer_links',
				array(
					'general' => array(
						'name'     => __( 'General', 'deep' ),
						'icon'  => 'dashicons-admin-generic',
						'url' => $customizer_url . 'general_opts',
					),
					'typography'       => array(
						'name'     => __( 'Typography', 'deep' ),
						'icon'  => 'dashicons-editor-textcolor',
						'url' => $customizer_url . 'typography_opts',
					),
					'blog'   => array(
						'name'     => __( 'Blog Settings', 'deep' ),
						'icon'  => 'dashicons-welcome-write-blog',
						'url' => $customizer_url . 'blog-opts',
					),
					'styling'       => array(
						'name'     => __( 'Styling', 'deep' ),
						'icon'  => 'dashicons-layout',
						'url' => $customizer_url . 'styling_opts',
					),
					'header-builder'       => array(
						'name'     => __( 'Header Builder', 'deep' ),
						'icon'  => 'dashicons-align-center',
						'url' => admin_url( 'admin.php?page=webnus_header_builder' ),
					),
					'pages'  => array(
						'name'     => __( 'Pages Settings', 'deep' ),
						'icon'  => 'dashicons-welcome-write-blog',
						'url' => $customizer_url . 'pages_opts',
					),
					'footer'       => array(
						'name'     => __( 'Footer Settings', 'deep' ),
						'icon'  => 'dashicons-admin-generic',
						'url' => $customizer_url . 'start_footer_opts',
					),
					'sidebars'     => array(
						'name'     => __( 'Site Identity', 'deep' ),
						'icon'  => 'dashicons-format-image',
						'url' => admin_url( 'customize.php?autofocus[section]=title_tagline' ),
					),
				)
			);

			?>

			<div class="deeptheme-customizer-links">
				<h2 class="deeptheme-admin-title">
				<i class="dashicons dashicons-admin-customizer"></i>
				<?php esc_html_e( 'Start Customizing', 'deep' ); ?>
				</h2>
				<?php
				if ( ! empty( $customizer_links ) ) :
					?>
					<ul class="customizer-links">
						<?php
						foreach ( $customizer_links as $link ) {
							echo '<li><a href="' . esc_url( $link['url'] ) . '" target="_blank"><span class="dashicons ' . esc_attr( $link['icon'] ) . '"></span> ' . esc_html( $link['name'] ) . '</a></li>';
						}
						?>
					</ul>
				<?php endif; ?>
			</div>

			<?php
		}

	}

	/**
	 * Deep More Options.
	 *
	 * @access  public
	 * @since   1.0.0
	 */
	public function deeptheme_more_options() {

		$more_options = apply_filters(
			'deeptheme_pro_options',
			array(
				'header-builder' => array(
					'title' => __( 'Header Builder', 'deep' ),
					'link'  => array(
						'url'     =>   'https://webnus.net/deep-premium-wordpress-theme-documentation/header-builder/',
						'text'    => __( 'Learn More', 'deep' ),
					),
				),
				'defined-headers' => array(
					'title' => __( 'Pre-defined Headers', 'deep' ),
					'link'  => array(
						'url'     =>   'https://webnus.net/deep-premium-wordpress-theme-documentation/import-pre-defined-headers/',
						'text'    => __( 'Learn More', 'deep' ),
					),
				),
				'footer-builder' => array(
					'title' => __( 'Footer Builder', 'deep' ),
					'link'  => array(
						'url'     =>   'https://webnus.net/deep-premium-wordpress-theme-documentation/footer-builder/',
						'text'    => __( 'Learn More', 'deep' ),
					),
				),
				'portfolio' => array(
					'title' => __( 'Portfolio', 'deep' ),
					'link'  => array(
						'url'     =>   'https://webnus.net/deep-premium-wordpress-theme-documentation/webnus-portfolio/',
						'text'    => __( 'Learn More', 'deep' ),
					),
				),
				'gallery' => array(
					'title' => __( 'Gallery', 'deep' ),
					'link'  => array(
						'url'     =>   'https://webnus.net/deep-premium-wordpress-theme-documentation/webnus-gallery/',
						'text'    => __( 'Learn More', 'deep' ),
					),
				),
				'shop' => array(
					'title' => __( 'Shop', 'deep' ),
					'link'  => array(
						'url'     =>   'https://webnus.net/deep-premium-wordpress-theme-documentation/shop-theme-options/',
						'text'    => __( 'Learn More', 'deep' ),
					),
				),
				'typography' => array(
					'title' => __( 'Typography', 'deep' ),
					'link'  => array(
						'url'     =>   'https://webnus.net/deep-premium-wordpress-theme-documentation/typography/',
						'text'    => __( 'Learn More', 'deep' ),
					),
				),
				'blog' => array(
					'title' => __( 'Blog Options', 'deep' ),
					'link'  => array(
						'url'     =>   'https://webnus.net/deep-premium-wordpress-theme-documentation/blog-options/',
						'text'    => __( 'Learn More', 'deep' ),
					),
				),
				'importer' => array(
					'title' => __( 'One Click Demo Importer', 'deep' ),
					'link'  => array(
						'url'     =>   'https://webnus.net/deep-premium-wordpress-theme-documentation/import-demo/',
						'text'    => __( 'Learn More', 'deep' ),
					),
				),
				'plugins' => array(
					'title' => __( 'Premium Plugins', 'deep' ),
					'link'  => array(
						'url'     =>   'https://webnus.net/deep-premium-wordpress-theme-documentation/other-premium-plugins/',
						'text'    => __( 'Learn More', 'deep' ),
					),
				),
			)
		);

		?>
		<div class="deeptheme-more-options">
			<h2 class="deeptheme-admin-title">
			<i class="dashicons dashicons-star-filled"></i>
			<?php esc_html_e( 'Deep Features', 'deep' ); ?>
			</h2>
			<?php
			if ( ! empty( $more_options ) ) :
				?>
				<ul class="pro-more-options">
					<?php
						foreach ( $more_options as $option ) {
							$title = $option['title'];
							$url   = $option['link']['url'];
							$text  = $option['link']['text'];

							echo '<li>';
								echo '<a href="' . esc_url( $url ) . '" target="_blank"> ' . esc_html( $title ) . ' <span> ' . esc_html( $text ) . ' <i class="dashicons dashicons-arrow-right-alt2"></i> </span> </a>';
							echo '</li>';
						}
					?>
				</ul>
			<?php endif; ?>
		</div>
		<?php

	}

	/**
	 * Deep Import Starter Template.
	 *
	 * @access  public
	 * @since   1.0.0
	 */
	public function deeptheme_import_template() {

		?>
		<div class="deeptheme-import-template deeptheme-r-admin">
			<h2><i class="dashicons dashicons-database-import"></i> <?php esc_html_e( 'Demo Importer', 'deep' ); ?></h2>
			<img src="<?php echo esc_url( DEEP_THEME_URI . 'src/assets/img/deep-importer-sc05.png' ); ?>" width="245">
			<p>
			<?php esc_html_e( 'In order to import the demo, you need to install the Deep Core plugin.', 'deep' ); ?>
			</p>
			<p>
			<?php esc_html_e( 'Click', 'deep' ); ?> <a href="<?php echo esc_url( 'https://webnus.net/deep-premium-wordpress-theme-documentation/import-demo/' )?>" target="_blank"><?php esc_html_e( 'here', 'deep' ); ?></a><?php esc_html_e( ' to see the documentation.', 'deep' ); ?>
			</p>
		</div>
		<?php

	}

	/**
	 * Deep Knowledge Base.
	 *
	 * @access  public
	 * @since   1.0.0
	 */
	public function deeptheme_knowledge_base() {

		?>
		<div class="deeptheme-knowledge-base deeptheme-r-admin">
			<h2><i class="dashicons dashicons-book"></i> <?php esc_html_e( 'Knowledge Base', 'deep' ); ?></h2>
			<p><?php esc_html_e( 'To find out more details of the features and sections please follow the documentation.', 'deep' ); ?></p>
			<p><a href="<?php echo esc_url( 'https://webnus.net/deep-premium-wordpress-theme-documentation/' ); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'deep' ); ?></a></p>
		</div>
		<?php

	}

	/**
	 * Deep Community.
	 *
	 * @access  public
	 * @since   1.0.0
	 */
	public function deeptheme_community() {

		?>
		<div class="deeptheme-community deeptheme-r-admin">
			<h2><i class="dashicons dashicons-reddit"></i> <?php esc_html_e( 'Deep Theme Community', 'deep' ); ?></h2>
			<p><?php esc_html_e( 'Join the Deep Theme subreddit to get help and ask your technical questions.', 'deep' ); ?></p>
			<p><a href="<?php echo esc_url( '#' ); ?>" target="_blank"><?php esc_html_e( 'Join The Deep Theme Subreddit ', 'deep' ); ?></a></p>
		</div>
		<?php

	}

	/**
	 * Deep Rate.
	 *
	 * @access  public
	 * @since   1.0.0
	 */
	public function deeptheme_rate() {

		?>
		<div class="deeptheme-rate deeptheme-r-admin">
			<h2><i class="dashicons dashicons-star-filled"></i> <?php esc_html_e( 'Rate us', 'deep' ); ?></h2>
			<p><?php esc_html_e( 'If you interested in the Deep Theme please rate us on WordPress.', 'deep' ); ?></p>
			<p><a href="<?php echo esc_url( 'https://wordpress.org/support/theme/deep/reviews/#new-post' ); ?>" target="_blank"><?php esc_html_e( 'Rate Us', 'deep' ); ?></a></p>
		</div>
		<?php

	}

	/**
	 * Deep Admin Notices.
	 *
	 * @access  public
	 * @since   1.0.0
	 */
	public function deeptheme_admin_notices() {

		$screen = get_current_screen();

		if ( $screen -> id == 'dashboard' || $screen -> id == 'themes' || $screen -> id == 'plugins' ) {
			if ( ! get_theme_mod( 'deep_theme_install' ) ) set_theme_mod( 'deep_theme_install', 'true' );

			if ( ! defined( 'DEEPCOREPRO' ) ) {

				if ( get_theme_mod( 'deep_theme_install' ) == 'false' ) {
					return;
				}

				if ( isset( $_GET['deep_theme_hide'] ) && $_GET['deep_theme_hide'] == 'false' ) {
					if ( isset( $_GET['deep_theme_hide'] ) ) {
						set_theme_mod( 'deep_theme_install', 'false' );
					}

					return;
				}

				?>
				<div class="deeptheme-admin-notice">
					<?php
					self::deeptheme_plugin_notice();
					?>
					<a class="notice-dismiss" href="?deep_theme_hide=false"></a>
				</div>
				<?php
			}
		}

	}

}

Deep_Theme_Admin::get_instance();
