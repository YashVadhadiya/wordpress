<?php
/**
 * Deep Theme.
 * Setup Wizard.
 *
 * @since   1.0.0
 * @author  Webnus
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Deep_Setup_Wizard' ) ) {
	class Deep_Setup_Wizard {

		/**
		 * Instance of this class.
		 *
		 * @since   1.0.0
		 * @access  private
		 * @var     Deep_Setup_Wizard
		 */
		private static $instance;

		/**
		 * Provides access to a single instance of a module using the singleton pattern.
		 *
		 * @since   1.0.0
		 * @access  public
		 * @return  object
		 */
		public static function get_instance() {
			if ( self::$instance === null ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Class Constructor.
		 *
		 * @since   1.0.0
		 * @access  public
		 */
		public function __construct() {
			if ( ! is_admin() || empty( $_GET['page'] ) || $_GET['page'] !== 'webnus-setup-wizard' ) {
				return;
			}

			add_action( 'admin_menu', array( $this, 'deep_admin_menus' ) );
			add_action( 'admin_init', array( $this, 'deep_admin_enqueue_scripts' ) );
			add_action( 'admin_init', array( $this, 'deep_setup_wizard' ) );
		}

		/**
		 * Add admin menus.
		 *
		 * @since   1.0.0
		 * @access  public
		 */
		public function deep_admin_menus() {
			add_dashboard_page( '', '', 'manage_options', 'webnus-setup-wizard', '' );
		}

		/**
		 * Register Stylesheets and JavaScripts.
		 *
		 * @since   1.0.0
		 * @access public
		 */
		public function deep_admin_enqueue_scripts() {
			wp_enqueue_style( 'deep-iconset', DEEP_ASSETS_URL . 'css/frontend/icons/iconset.css' );
			wp_enqueue_style( 'deep-font-awesome', DEEP_ASSETS_URL . 'css/frontend/icons/font-awesome.css' );
			wp_enqueue_style( 'deep-et-line', DEEP_ASSETS_URL . 'css/frontend/icons/et-line.css' );
			wp_enqueue_style( 'deep-linea-arrows', DEEP_ASSETS_URL . 'css/frontend/icons/linea-arrows-10.css' );
			wp_enqueue_style( 'deep-linea-basic', DEEP_ASSETS_URL . 'css/frontend/icons/linea-basic-10.css' );
			wp_enqueue_style( 'deep-linea-ecommerce', DEEP_ASSETS_URL . 'css/frontend/icons/linea-ecommerce-10.css' );
			wp_enqueue_style( 'deep-linea-software-10', DEEP_ASSETS_URL . 'css/frontend/icons/linea-software-10.css' );
			wp_enqueue_style( 'deep-linecons', DEEP_ASSETS_URL . 'css/frontend/icons/linecons.css' );
			wp_enqueue_style( 'deep-simple-line-icons', DEEP_ASSETS_URL . 'css/frontend/icons/simple-line-icons.css' );
			wp_enqueue_style( 'deep-themify-icons', DEEP_ASSETS_URL . 'css/frontend/icons/themify.css' );
			wp_enqueue_style( 'deep-setup-wizard', DEEP_ASSETS_URL . 'css/backend/setup-wizard.css', false, DEEP_VERSION );

			// scripts
			wp_register_script( 'jquery', includes_url() . '/js/jquery/jquery.min.js' );
			if ( isset( $_GET['step'] ) && $_GET['step'] == '2' ) {
				wp_enqueue_script( 'deep-admin-plugins', DEEP_ASSETS_URL . 'js/backend/wn-plugins.js', array( 'jquery' ), DEEP_VERSION, false );
				wp_enqueue_script( 'one-demo-importer', DEEP_ASSETS_URL . 'js/backend/one-importer.js', array( 'jquery' ), DEEP_VERSION, false );
				wp_localize_script(
					'one-demo-importer',
					'OneImporter',
					array(
						'ajax_url'   => admin_url( 'admin-ajax.php' ),
						'nonce'      => wp_create_nonce( 'one_demo_importer' ),
					)
				);

				// Progress Data
				$req_data = wp_upload_dir()['baseurl'] . '/webnus/demo-data/result.txt';

				wp_localize_script(
					'one-demo-importer',
					'ProgressData',
					array(
						'ajax_url' => $req_data,
					)
				);
			}
			wp_enqueue_script( 'deep-setup-wizard', DEEP_ASSETS_URL . 'js/backend/setup-wizard.js', array( 'jquery' ), DEEP_VERSION, false );
			wp_localize_script(
				'deep-setup-wizard',
				'ajaxObject',
				array(
					'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
					'colornonce' => wp_create_nonce( 'colorCategoriesNonce' ),
				)
			);
		}

		/**
		 * Select template.
		 *
		 * @since   1.0.0
		 * @access  private
		 */
		private function deep_template_step() {

			require_once DEEP_CORE_DIR . 'importer/config/listings.php';
			?>

			<div class="wsw-select-importer">
			<?php
			foreach ( $demos as $demo ) {
				$name = esc_attr( $demo['name'] );
				$type = esc_attr( $demo['type'] );
				$slug = esc_attr( $demo['slug'] );
				$pg1  = esc_attr( $demo['pg1'] );
				$pg2  = esc_attr( $demo['pg2'] );
				$imageURL = 'http://deeptem.com/deep-downloads/demo-data/' . $slug . '/screen-image.jpg';
				$previewURL = 'http://deeptem.com/' . $slug . '/';
				if ( $type == 'Free'  ) {
				?>
				<div class="wsw-importer-demo wrap-importer" slug="<?php echo $slug; ?>">
					<div class="wsw-importer-screenshot">
						<img class="wsw-importer-image" src="<?php echo $imageURL; ?>">
					</div>
					<h3 class="wsw-theme-name"><input type="checkbox" name="theme-name" value="<?php echo $slug; ?>"><?php echo $name; ?>
					<span class="deep-demo-type <?php echo $type; ?>"><?php echo $type; ?></span>
					</h3>
					<a class="wsw-importer-preview" href="<?php echo $previewURL;  ?>" target="_blank"><?php esc_html_e( 'Preview', 'deep' ); ?></a>
				</div>
				<?php
				self::deep_importer_settings( $slug, $type, $name, $imageURL, $pg1, $pg2 );
			}
		}

			?>
			</div>
			<div class="wsw-btn-step">
				<a href="#" class="wsw-btn" data-step="1" data-step-type="back"><?php esc_html_e( 'Back Step', 'deep' ); ?></a>
				<a href="#" class="wsw-btn" data-step="3" data-step-type="next"><?php esc_html_e( 'Next Step', 'deep' ); ?></a>
				<a id="wswReturnDashboard" href="<?php echo admin_url( 'admin.php?page=wn-admin-welcome' ); ?>"><?php esc_html_e( 'Return to the Dashboard', 'deep' ); ?></a>
			</div>
			<?php
		}

		/**
		 * Importer settings.
		 *
		 * @since   1.0.0
		 * @access  private
		 */
		private static function deep_importer_settings( $slug, $type, $name, $imageURL, $pg1, $pg2 ) {
		?>
		<div class="wn-lightbox-wrap wp-clearfix" slug="<?php echo $slug; ?>">
			<div class="wn-lightbox-contents">
				<div class="wn-lightbox" slug="<?php echo $slug; ?>">
					<div class="wn-lb-content wni-settings">
					<?php
						if ( $type == 'Free'  ) {
							self::deep_page_builder( $slug, $pg1, $pg2 );
							self::deep_install_plugins( $slug );
							self::deep_import_template( $slug, $type );
						}
						?>
						</div>
					<?php self::deep_ready( $slug, $type, $name, $imageURL ); ?>
				</div>
			</div>
		</div>
		<?php
		}

		/**
		 * Page Builder.
		 *
		 * @since   1.0.0
		 * @access  private
		 */
		private static function deep_page_builder( $slug, $pg1, $pg2 ) {
			?>
			<div class="wnl-row">
				<h3><?php esc_html_e( 'Choose page builder', 'deep' ); ?></h3>
				<div class="wn-pagebuilder-wrap">
					<?php if (!empty($pg1)): ?>
					<div class="wn-radio-wrap">
						<label class="wn-radio-control elementor-builder checked" for="elementor">
							<input type="radio" id="elementor" name="pagebuilder" value="Elementor" checked="checked">
							<span class="wn-radio-indicator checked"></span>
							<?php esc_html_e( 'Elementor', 'deep' ); ?>
						</label>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<?php
		}

		/**
		 * Install required plugins.
		 *
		 * @since   1.0.0
		 * @access  private
		 */
		private static function deep_install_plugins( $slug ) {
			require_once DEEP_CORE_DIR . 'importer/config/plugins.php';
			?>
			<div class="wnl-row">
				<div class="whi-install-plugins-wrap">
					<h3><?php esc_html_e( 'The plugins below are required', 'deep' ); ?></h3>
					<a href="#" class="wn-admin-btn wsw-btn whi-install-plugins"><?php esc_html_e( 'Activate all plugins', 'deep' ); ?></a>
				</div>
				<div class="wn-plugins-wrap wn-plugins">

				<?php
				$tgmpa_list_table = new TGMPA_List_Table();
				$plugins = TGM_Plugin_Activation::$instance->plugins;
				$install_plugins = [];
				$demo_plugins = deep_demo_plugins($slug);

				if ($demo_plugins) {
					foreach ($demo_plugins as $plugin) {
						if (array_key_exists($plugin, $plugins)) {
							$install_plugins[$plugin] = $plugins[$plugin];
						}
					}
				}

				foreach ($install_plugins as $plugin) {
					$plugin['type'] = isset( $plugin['type'] ) ? $plugin['type'] : 'recommended';
					$plugin['sanitized_plugin'] = $plugin['name'];

					$plugin_action = $tgmpa_list_table->actions_plugin( $plugin );

					if ( is_plugin_active( $plugin['file_path'] ) ) {
						$plugin_action = '
						<div class="row-actions visible active">
							<span class="activate">
								<a class="button wn-admin-btn wsw-btn">' . esc_html__( 'Activated', 'deep' ) . '</a>
							</span>
						</div>';
					}
					?>
					<div class="wn-plugin wp-clearfix" data-plugin-name="<?php echo esc_html( $plugin['name'] ); ?>">
						<h4><?php echo esc_html( $plugin['name'] ); ?></h4>
						<span class="wn-plugin-line"></span>
						<?php echo $plugin_action; ?>
					</div>
				<?php
				}
				?>
				</div>
			</div>
			<?php
		}

		/**
		 * Import desired template.
		 *
		 * @since   1.0.0
		 * @access  private
		 */
		private static function deep_import_template( $slug, $type ) {
			?>
			<div class="wnl-row">
			<h3>Import content</h3>
			<div class="wn-import-content-wrap wp-clearfix">
				<div class="wn-checkbox-wrap">
					<label for="all" class="wn-checkbox-label all-contents"></label>
					<input type="checkbox" class="wn-checkbox-input all-contents" id="all" value="all">
					<span>All</span>
				</div>

				<div class="wn-checkbox-wrap">
					<label for="pages" class="wn-checkbox-label"></label>
					<input type="checkbox" class="wn-checkbox-input" id="pages" value="pages">
					<span>Pages</span>
				</div>

				<div class="wn-checkbox-wrap">
					<label for="posts" class="wn-checkbox-label"></label>
					<input type="checkbox" class="wn-checkbox-input" id="posts" value="posts">
					<span>Posts</span>
				</div>

				<div class="wn-checkbox-wrap">
					<label for="contact-forms" class="wn-checkbox-label"></label>
					<input type="checkbox" class="wn-checkbox-input" id="contact-forms" value="contact-forms">
					<span>Contact forms</span>
				</div>

				<div class="wn-checkbox-wrap">
					<label for="images" class="wn-checkbox-label"></label>
					<input type="checkbox" class="wn-checkbox-input" id="images" value="images">
					<span>Images</span>
				</div>

				<div class="wn-checkbox-wrap">
					<label for="widgets" class="wn-checkbox-label"></label>
					<input type="checkbox" class="wn-checkbox-input" id="widgets" value="widgets">
					<span>Widgets</span>
				</div>

				<div class="wn-checkbox-wrap">
					<label for="themeoptions" class="wn-checkbox-label"></label>
					<input type="checkbox" class="wn-checkbox-input" id="themeoptions" value="themeoptions">
					<span>Theme options</span>
				</div>

				<div class="wn-checkbox-wrap">
					<label for="header" class="wn-checkbox-label"></label>
					<input type="checkbox" class="wn-checkbox-input" id="header" value="header">
					<span>Header</span>
				</div>
			</div>
		</div>

		<div class="wnl-row">
			<a href="#" class="wn-import-demo-btn"><?php esc_html_e( 'Import', 'deep' ); ?></a>
		</div>
		<?php
		}

		/**
		 * Ready step.
		 *
		 * @since   1.0.0
		 * @access  private
		 */
		private static function deep_ready( $slug, $type, $name, $imageURL ) {
			?>
			<div class="wn-suc-imp-title"><strong><?php echo $name; ?></strong></div>
			<div class="wn-lb-content wn-suc-imp-content-wrap">
				<div class="wn-suc-imp-content">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank" title="<?php esc_html_e( 'Visit Site', 'deep' ); ?>">
						<img class="wbc_image" src="<?php echo $imageURL; ?>">
					</a>
					<div class="wn-suc-imp-t100"><strong>100%</strong><?php esc_html_e( 'Demo imported successfully', 'deep' ); ?></div>
					<div class="wn-suc-imp-links">
						<a class="wn-suc-imp-links-d" href="<?php echo esc_url( self_admin_url( 'admin.php?page=wn-admin-welcome' ) ); ?>"><?php esc_html_e( 'Deep Dashboard', 'deep' ); ?></a>
						<a class="wn-suc-imp-links-t" href="<?php echo esc_url( self_admin_url( 'admin.php?page=webnus_theme_options' ) ); ?>"><?php esc_html_e( 'Theme Options', 'deep' ); ?></a>
						<a class="wn-suc-imp-links-l" href="<?php echo esc_url( self_admin_url( 'admin.php?page=wn-admin-video-tutorial' ) ); ?>"><?php esc_html_e( 'Tutorials', 'deep' ); ?></a>
						<a class="wn-suc-imp-links-v" href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank"><?php esc_html_e( 'Visit Site', 'deep' ); ?></a>
					</div>
					<div class="wni-start">
						<div class="wbc-progress-back">
							<div class="wbc-progress-bar button-primary" style="width: 0%;">
								<span class="wbc-progress-count">0%</span>
							</div>
						</div>
						<span class="wni-start-message"><?php esc_html_e( 'Please do not refresh the page until import is complete. The time it takes to import depends on your host configuration and it may take up to 15 minutes, so please be patient.', 'deep' ); ?></span>
					</div>
				</div>
			</div>
			<?php
		}

		/**
		 * Show the setup wizard.
		 *
		 * @access  public
		 * @param   null
		 * @return  void
		 */
		public function deep_setup_wizard() {
			ob_start();
			?>
			<!DOCTYPE html>
			<html>
			<head>
				<meta name="viewport" content="width=device-width" />
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<title><?php esc_html_e( 'Deep Setup Wizard', 'deep' ); ?></title>
				<script>
					var ajaxurl = '<?php echo admin_url( 'admin-ajax.php', 'relative' ); ?>';
				</script>
				<?php do_action( 'admin_print_styles' ); ?>
			</head>
			<body>
				<?php
				$step = isset( $_GET['step'] ) ? (int) $_GET['step'] : 1;
				$active_class = 'class="active"';
				?>
				<div id="wnSetupWizard" class="wn-setup-wizard wn-sw-step<?php echo $step; ?>">
					<div class="wsw-logo">
						<img src="<?php echo esc_url( DEEP_ASSETS_URL . 'images/deep-wizard-logo.png' ); ?>">
					</div>
					<ul class="wsw-menu wsw-clearfix">
					<li <?php echo $step >= 1 ? $active_class : ''; ?>><?php esc_html_e( 'Select Demo', 'deep' ); ?></li>
						<li <?php echo $step > 2 ? $active_class : ''; ?>><?php esc_html_e( 'Choose Page Builder', 'deep' ); ?></li>
						<li <?php echo $step > 3 ? $active_class : ''; ?>><?php esc_html_e( 'Install Plugins', 'deep' ); ?></li>
						<li <?php echo $step > 4 ? $active_class : ''; ?>><?php esc_html_e( 'Import', 'deep' ); ?></li>
						<li <?php echo $step > 5 ? $active_class : ''; ?>><?php esc_html_e( 'Ready!', 'deep' ); ?></li>
					</ul>

					<div class="wsw-contents wsw-clearfix">
						<?php
						switch ( $step ) {
							case '1':
								wp_redirect( admin_url( 'admin.php?page=wn-admin-welcome' ) );
								exit;
								break;
							case '2':
								$this->deep_template_step();
								break;
						}
						?>
					</div>

					<?php
					wp_print_scripts( 'deep-admin-plugins' );
					wp_print_scripts( 'one-demo-importer' );
					wp_print_scripts( 'deep-setup-wizard' );
					?>
				</div>
			</body>
			</html>
			<?php
			exit;
		}

	}

	Deep_Setup_Wizard::get_instance();
}
