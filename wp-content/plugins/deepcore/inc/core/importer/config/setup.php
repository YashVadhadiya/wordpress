<?php
/**
 * Deep Theme.
 *
 * The Demo Importer
 *
 * @since   4.2.8
 * @author  Webnus
 */

use Elementor\Utils as Utils;

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Deep_Demo_Importer {

	/**
	 * Instance of this class.
	 *
	 * @since   4.2.8
	 * @access  public
	 * @var     Deep_Demo_Importer
	 */
	public static $instance;

	private $demo;

	private $pagebuilder;

	private $path;

	private $webnus_dir;

	private $demo_dir;

	private $pages;

	private $posts;

	private $themeoptions;

	private $widgets;

	private $images;

	private $contact_forms;

	private $header;

	/**
	 * Provides access to a single instance of a module using the singleton pattern.
	 *
	 * @since   4.2.8
	 * @return  object
	 */
	public static function get_instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Define the core functionality of the theme.
	 *
	 * Load the dependencies.
	 *
	 * @since   4.2.8
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', [$this, 'scripts'] );
		add_action( 'wp_ajax_importing_demo_content', [$this, 'importing_demo_content'] );
		add_action( 'wp_ajax_nopriv_importing_demo_content', [$this, 'importing_demo_content'] );
		add_action( 'wp_ajax_reset_progress', [$this, 'reset_progress'] );
		add_action( 'wp_ajax_nopriv_reset_progress', [$this, 'reset_progress'] );
		add_action( 'wp_ajax_deep_demo_listings', [$this, 'deep_demo_listings'] );
		add_action( 'wp_ajax_nopriv_deep_demo_listings', [$this, 'deep_demo_listings'] );
		add_action( 'init', [$this, 'deep_events_demo'] );
		add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );
		add_action( 'pt-ocdi/time_for_one_ajax_call', [$this, 'single_ajax_call_time'] );
	}

	/**
	 * Register Scripts.
	 *
	 * Load the dependencies.
	 *
	 * @since   4.2.8
	 */
	public function scripts(){
		wp_enqueue_script( 'one-demo-importer', DEEP_ASSETS_URL . 'js/backend/one-importer.js', array( 'jquery' ), DEEP_VERSION, false );

		wp_localize_script(
		'one-demo-importer',
		'OneImporter',
			array(
				'ajax_url'   =>  admin_url( 'admin-ajax.php' ),
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

	/**
	 * Importing Content.
	 *
	 * @since   4.2.8
	 */
	public function importing_demo_content() {

		$nonce = $_POST['nonce'];
		if ( ! wp_verify_nonce( $nonce, 'one_demo_importer' ) )
			die ( 'Wrong nonce!');

		if ( ! empty( $_POST ) ) {

			if( isset( $_POST['demo'] ) ) {
                $this->demo = sanitize_text_field( $_POST['demo'] );
			}

			if ( isset( $_POST['pagebuilder'] ) ) {
                $this->pagebuilder = sanitize_text_field( $_POST['pagebuilder'] );
            }

			if ( isset( $_POST['contents'] ) ) {
				foreach ( $_POST['contents'] as $content ) {
					switch ($content) {
						case 'pages':
							$this->pages = 'pages';
							break;

						case 'posts':
							$this->posts = 'posts';
							break;

						case 'contact-forms':
							$this->contact_forms = 'contact_forms';
							break;

						case 'images':
							$this->images = 'images';
							break;

						case 'widgets':
							$this->widgets = 'widgets';
							break;

						case 'themeoptions':
							$this->themeoptions = 'themeoptions';
							break;

						case 'header':
							$this->header = 'header';
							break;

						default:

							break;
					}
				}
			}
		}

		$this->demo_setup();
		$this->import_content();
		wp_die();

	}

	/**
	 * Demo Setup.
	 *
	 * @since   4.2.8
	 */
	public function demo_setup() {

		$this->webnus_dir = wp_upload_dir()['basedir'] . '/webnus/';
		$this->demo_dir = $this->webnus_dir . 'demo-data/';
		$this->path = $this->demo_dir . $this->demo;

		if ( wp_mkdir_p( $this->demo_dir. $this->demo ) ) {
			wp_mkdir_p( $this->demo_dir . $this->demo );
		}

		// Upload files in demo folder
		$value = '';

		if ( wn_check_url( deep_ssl() . 'deeptem.com/deep-downloads/demo-data/' . $this->demo . '/' . $this->demo . '.zip') ) {
			$value = deep_ssl() . 'deeptem.com/deep-downloads/demo-data/' . $this->demo . '/' . $this->demo . '.zip';
		} else {
			$value = 'http://webnus.biz/deep-downloads/demo-data/' . $this->demo . '/' . $this->demo . '.zip';
		}

		$get_file = wp_remote_get(
			$value,
			array(
				'timeout'     => 120,
				'user-agent'  => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.116 Safari/537.36'
			)
		);

		$upload = wp_upload_bits( basename( $value ), '', wp_remote_retrieve_body( $get_file ) );
		if( !empty( $upload['error'] ) ) {
			return false;
		}

		// unzip demo files
		if ( class_exists('ZipArchive', false) == false ) {

			require_once ( 'zip-extention/zip.php' );
			$zip = new Zip();
			$zip->unzip_file( $upload['file'], $this->demo_dir . $this->demo . '/' );

		} else {

			$zip = new ZipArchive;
			$success_unzip = '';
			if ( $zip->open( $upload['file'] ) === TRUE ) {
				$zip->extractTo( $this->demo_dir . $this->demo . '/' );
				$zip->deleteAfterUnzip = true;
				$zip->close();
				$success_unzip = 'success';
			} else {
				$success_unzip = 'faild';
			}

		}
	}

	/**
	 * Import Content.
	 *
	 * @since   4.2.8
	 */
	public function import_content() {

		if ( ! class_exists( 'OCDI_Plugin' ) ) {
			require_once DEEP_CORE_DIR . 'importer/one-click-demo-import/one-click-demo-import.php';
		}

		// Progress Content
		$result = $this->demo_dir.'/result.txt';
		$this->result_file = $result;

		$im_content = array (
			"pages"         => $this->pages,
			"posts"         => $this->posts,
			"themeoptions"  => $this->themeoptions,
			"header"        => $this->header,
			"widgets"       => $this->widgets,
			"contact_forms" => $this->contact_forms,
			"images"   		=> $this->images,
		);

		$cn_logger = new OCDI\Logger();
		$importing_demo = new OCDI\Importer( [
			'update_attachment_guids' => true,
			'fetch_attachments'       => true
		], $cn_logger );

		foreach ( $im_content as $key => $item ) {
			switch ($item) {
				case 'pages':

					$importing_demo->import_content($this->path.'/pages-ele.xml');
					$importing_demo->import_content($this->path.'/mega-menus-ele.xml');
					$importing_demo->import_content($this->path.'/footer-ele.xml');
					$importing_demo->import_content($this->path.'/templates.xml');
					$importing_demo->import_content($this->path.'/menu-ele.xml');

					file_put_contents($result, '10');

					break;

				case 'posts':

					$importing_demo->import_content($this->path.'/posts-ele.xml');

					file_put_contents($result, '20');

					break;

				case 'themeoptions':
					/**
					 * Theme Options
					 */
					if ( file_exists( $this->path.'/theme_options.txt' ) ) {
						$file_contents = file_get_contents( $this->path.'/theme_options.txt' );
						$options = json_decode($file_contents, true);
						$redux = ReduxFrameworkInstances::get_instance('deep_options');
						$redux->set_options($options);
					}

					file_put_contents($result, '50');

					break;

				case 'header':
					/**
					 * Header
					 */
					$headerFile = $this->path.'/header.json';
					if ( file_exists( $headerFile ) ) {
						$headerData = file_get_contents( $headerFile );
						$headerData = json_decode( stripslashes( $headerData ), true );
						update_option( 'whb_data_components', $headerData['whb_data_components'] );
						update_option( 'whb_data_editor_components', $headerData['whb_data_editor_components'] );
						update_option( 'whb_data_frontend_components', $headerData['whb_data_frontend_components'] );
					}

					file_put_contents($result, '60');

					break;

				case 'widgets':
					/**
					 * Widgets
					 */
					if ( file_exists( $this->path . '/widgets.json' ) ) {
						// OCDI\WidgetImporter::import($this->path . '/widgets.json');
					}

					file_put_contents($result, '70');

					break;

				case 'contact_forms':

					$importing_demo->import_content($this->path.'/contact-forms.xml');

					file_put_contents($result, '80');

					break;

				case 'images':

					$importing_demo->import_content($this->path.'/media-ele.xml');

					file_put_contents($result, '90');

					break;

				default:

					break;
			}
		}

		/**
		 * MEC Shortcodes
		 *
		 * @since 4.2.8
		 */
		if ( is_plugin_active( 'modern-events-calendar-lite/modern-events-calendar-lite.php' ) || is_plugin_active( 'modern-events-calendar/mec.php' ) ) {

			if ( file_exists( $this->path.'/mec-shortcodes.xml' ) ) {
				$importing_demo->import_content($this->path.'/mec-shortcodes.xml');
			}

			$this->deep_events_demo();

		}
		file_put_contents($result, '95');

		$this->front_posts_page();
		$this->deep_api_demo_data();

		if ( is_plugin_active( 'elementor/elementor.php' ) ) {
			Utils::replace_urls( 'http://deeptem.com/' . $this->demo,  site_url() );
		}

		file_put_contents($result, '100');

	}


	/**
	 * Demo Data Analytics
	 *
	 * @since   4.3.8
	 */
	private function deep_api_demo_data() {

		$url = 'http://webnus.biz/api/wp-json/dp/v1/deep-api/';

		$fields = array(
			'method' => 'POST',
			'user-agent'  => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.116 Safari/537.36',
			'body' => array(
				'demo-name'			=> $this->demo,
				'demo-pagebuilder'	=> $this->pagebuilder
			),
		);

		wp_remote_post( $url, $fields );

	}

	/**
	 * Assign front page and posts page.
	 *
	 * @since   4.2.8
	 */
	public function front_posts_page() {

		switch ( $this->demo ) {
			case 'magazine-free':
				$front_page = get_page_by_title( 'Home 1 - Magazine' );
				$blog_page  = get_page_by_title( 'Blog' );
				break;

			case 'personal-blog-free':
				$front_page = get_page_by_title( 'Home 1 - Personal Blog' );
				$blog_page  = get_page_by_title( 'Blog' );
				break;

			case 'agency2free':
				$front_page = get_page_by_title( 'Home - Agency 2' );
				$blog_page  = get_page_by_title( 'Blog' );
				break;
			case 'modern-business':
			case 'conference-free':
			case 'spa-free':
			case 'corporate-free':
			case 'corporate2-free':
			case 'events-free':
			case 'church-free':
			case 'real-estate-free':
			case 'freelancer-free':
			case 'language-school-free':
			case 'business-free':
			case 'lawyer-free':
			case 'dentist-free':
			case 'startup-free':
			case 'wedding-free':
			case 'insurance-free':
			case 'yoga-free':
			case 'mechanic-free':
			case 'portfolio-free':
			case 'dietitian-free':
			case 'software-free':
			case 'beauty-free':
			case 'consulting-free':
			case 'crypto-free':
				$front_page = get_page_by_title( 'Home' );
				$blog_page  = get_page_by_title( '' );
				break;

			default:

				break;
		}

		update_option( 'show_on_front', 'page' );

		if ( $front_page ) {
			update_option( 'page_on_front', $front_page->ID );
		}

		if ( $blog_page ) {
			update_option( 'page_for_posts', $blog_page->ID );
		}

	}

	/**
	 * Events
	 *
	 * @since 4.2.8
	 */
	public function deep_events_demo() {

		if ( is_plugin_active( 'modern-events-calendar-lite/modern-events-calendar-lite.php' ) || is_plugin_active( 'modern-events-calendar/mec.php' ) ) {

			if ( file_exists( $this->path.'/events.xml' ) ) {
				do_action( 'mec_import_file', $this->path.'/events.xml' );
			}

		}

	}

	/**
	 * Reset progress bar
	 *
	 * @since 4.3.0
	 */
	public function reset_progress() {

		$result_file = wp_upload_dir()['basedir'] . '/webnus/demo-data/result.txt';

		if ( file_exists( $result_file ) ) {
			file_put_contents($result_file, '0');
		}

		wp_die();

	}

	/**
	 * Single Ajax Call Time
	 *
	 * @since 4.2.10
	 */
	public function single_ajax_call_time() {

		return 99999;

	}

	/**
	 * Deep Demo Listings
	 *
	 * @since 4.3.7
	 */
	public function deep_demo_listings() {
		$nonce = $_POST['nonce'];
		if ( ! wp_verify_nonce( $nonce, 'one_demo_importer' ) )
			die ( 'Wrong nonce!');

		if( ! empty( $_POST )) {
		    if( isset( $_POST['type'] ) ) {
		        $atype = sanitize_text_field( $_POST['type'] );
		    }

		    if( isset( $_POST['category'] ) ) {
		        $category = sanitize_text_field( $_POST['category'] );
		    }

		    if( isset( $_POST['pageBuilder'] ) ) {
		        $pageBuilder = sanitize_text_field( $_POST['pageBuilder'] );
		    }

			self::deep_demo_listings_loop($pageBuilder, $atype, $category);
		}
		wp_die();
	}

	/**
	 * Deep Demo Listings Loop
	 *
	 * @since 4.3.7
	 */
	public static function deep_demo_listings_loop($pg = '', $atype = '', $acategory = '') {
		require_once DEEP_CORE_DIR . 'importer/config/listings.php';

		foreach ($demos as $demo) {
			$name = esc_attr( $demo['name'] );
			$type = esc_attr( $demo['type'] );
			$slug = esc_attr( $demo['slug'] );
			$pg1  = esc_attr( $demo['pg1'] );
			$pg2  = esc_attr( $demo['pg2'] );
			$pageBuilder = '';
			$category = esc_attr( $demo['category'] );
			$imageURL = 'http://deeptem.com/deep-downloads/demo-data/' . $slug . '/screen-image.jpg';
			$previewURL = 'http://deeptem.com/' . $slug . '/';

			if ($pg1 == $pg) { $pageBuilder = 'Elementor'; }
			if ($pg2 == $pg) { $pageBuilder = 'WPBakery'; }

			if ($pageBuilder == $pg) {
				if ($type == $atype || $atype == 'All') {
					if ($acategory == 'All' || $category == $acategory) {
						?>
						<div class="wrap-importer theme not-imported" slug="<?php echo $slug;?>" type="<?php echo $type; ?>" category="<?php echo $category; ?>" pg1="<?php echo $pg1; ?>" pg2="<?php echo $pg2; ?>">
							<div class="theme-screenshot">
								<img class="wbc_image" src="<?php echo esc_url( $imageURL ); ?>">
							</div>
							<a class="more-details" href="<?php echo esc_url( $previewURL ); ?>" target="_blank"><?php esc_attr_e( 'Preview', 'deep' ); ?></a>
							<h3 class="theme-name">
								<?php echo $name; ?>
								<span class="deep-demo-type <?php echo $type; ?>">
								<?php echo $type; ?>
								</span>
							</h3>
							<div class="theme-actions">
								<div class="wbc-importer-buttons">
									<span class="button button-primary importer-button import-demo-data"><?php esc_attr_e( 'Import', 'Import' ); ?></span>
								</div>
							</div>
						</div>
						<?php
						self::deep_demo_checkbox($name, $slug, $imageURL, $type);
					}
				}
			}
		}
	}

	/**
	 * Deep Demo Checkbox
	 *
	 * @since 4.3.7
	 */
	private static function deep_demo_checkbox($name, $slug, $imageURL, $type) {
		require_once DEEP_CORE_DIR . 'importer/config/plugins.php';
		?>
		<div class="wn-lightbox-wrap wp-clearfix">
			<div class="wn-lightbox-contents">
				<i class="ti-close"></i>
				<div class="wn-lightbox" slug="<?php echo $slug; ?>" type="<?php echo $type; ?>">
					<h2><?php echo $name; ?></h2>
					<input id="demo" name="demo" type="hidden" value="<?php echo $slug; ?>">
					<div class="wn-lb-content wni-settings">
					<?php
					if ( $type == 'Pro'  ) {
						echo '
						<div id="wnInvalidPurchaseCode" style="display: block">
							<div class="btn-wrap">
							<p>Get full access to more demos and all advanced features of Deep theme by upgrading to Pro version right away.</p>
								<a class="importer-button go-pro" href="' . esc_url( 'https://webnus.net/pricing/' ) . '" target="_blank">' . esc_html__( 'Go Pro', 'deep' ) . '</a>
							</div>
						</div>';
					}
					?>
					<?php if ( $type == 'Free'  ):

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
					?>
					<div class="wnl-row">
						<div class="whi-install-plugins-wrap">
							<h3>The plugins below are required</h3>
							<a href="#" class="wn-admin-btn whi-install-plugins">Activate all plugins</a>
						</div>
						<div class="wn-plugins-wrap wn-plugins">
							<?php
							foreach ($install_plugins as $plugin) {
								$plugin['sanitized_plugin'] = $plugin['name'];
								$plugin_action = $tgmpa_list_table->actions_plugin( $plugin );

								if ( is_plugin_active( $plugin['file_path'] ) ) {
									$plugin_action = '
									<div class="row-actions visible active">
										<span class="activate">
											<a class="button wn-admin-btn">' . esc_html__( 'Activated', 'deep' ) . '</a>
										</span>
									</div>';
								}
								?>

								<div class="wn-plugin wp-clearfix" data-plugin-name="<?php echo esc_attr( $plugin['name'] ); ?>">
								<h4><?php echo esc_html( $plugin['name'] ); ?></h4>
								<span class="wn-plugin-line"></span>
								<?php echo $plugin_action; ?>
								</div>
								<?php
							}
							?>
						</div>
					</div>
					<?php endif; ?>

					<?php if ( $type == 'Free'  ): ?>
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
					<?php endif; ?>

					<?php if ( $type == 'Free'  ): ?>
					<div class="wnl-row import-btn-row">
						<div class="wbc-progress-back">
							<div class="wbc-progress-bar button-primary" style="width: 0%;">
								<span class="wbc-progress-count">0%</span>
							</div>
						</div>
						<p id="w-importing">Before you begin, make sure all the required plugins are activated.</p>
						<a href="#" class="wn-import-demo-btn">Import</a>
					</div>
					<?php endif; ?>
					</div>

					<div class="wn-suc-imp-title"><strong><?php echo $name; ?></strong></div>
					<div class="wn-lb-content wn-suc-imp-content-wrap">
						<div class="wn-suc-imp-content">
							<a href="http://localhost/deep/" target="_blank" title="Visit Site">
								<img class="wbc_image" src="<?php echo $imageURL; ?>">
							</a>
							<div class="wn-suc-imp-t100"><strong>% 100</strong>Demo imported successfully</div>
							<div class="wn-suc-imp-links">
								<a class="wn-suc-imp-links-d" href="<?php echo esc_url( self_admin_url( 'admin.php?page=wn-admin-welcome' ) ); ?>">Deep Dashboard</a>
								<a class="wn-suc-imp-links-t" href="<?php echo esc_url( self_admin_url( 'admin.php?page=webnus_theme_options' ) ); ?>">Theme Options</a>
								<a class="wn-suc-imp-links-v" href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank"><?php esc_html_e( 'Visit Site', 'deep' ); ?></a>
							</div>
							<div class="wni-start">
							<span class="wni-start-message">Please do not refresh the page until import is complete. The time it takes to import depends on your host configuration and it may take up to 15 minutes, so please be patient.</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

Deep_Demo_Importer::get_instance();
