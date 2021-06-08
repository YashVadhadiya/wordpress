<?php
/**
 * Deep Theme.
 *
 * The template content
 *
 * @since   1.0.0
 * @author  Webnus
 */

defined( 'ABSPATH' ) || exit;

use Deep\Front as Front;

class WN_Content {

	/**
	 * Instance of this class.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     WN_Content
	 */
	public static $instance;

	/**
	 * Variables
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public $sidebar;
	public $template;
	public $page_title;
	public $post_count;
	public $blog_sidebar;
	public $theme_options;
	public $template_layout;
	public $enable_page_title;
	public $enable_post_title;
	public $enable_comments_meta;
	public $enable_category_meta;
	public $enable_featured_image;

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
	 * Define the core functionality of the 404.php
	 *
	 * @since   1.0.0
	 */
	public function __construct() {
		add_action( 'notfound_page', array( $this, 'notfound_content' ) );
		add_action( 'wp_loaded', array( $this, 'deep_404_redirect' ) );
		add_action( 'page_content', array( $this, 'page_content' ) );
		add_action( 'attachment_content', array( $this, 'attachment_content' ) );
		add_action( 'author_content', array( $this, 'author_content' ) );
		add_action( 'buddypress_content', array( $this, 'buddypress_content' ) );
		add_action( 'footer_content', array( $this, 'footer_content' ) );
		add_action( 'header_content', array( $this, 'header_content' ) );
		add_action( 'search_content', array( $this, 'search_content' ) );
		add_action( 'single_content', array( $this, 'single_content' ) );
		add_action( 'index_content', array( $this, 'index_content' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * 404 Redirect.
	 *
	 * @since   4.3.7
	 */
	public function deep_404_redirect( $url ) {
		ob_start();
		if ( wp_redirect( $url ) ) {
			exit();
		}
	}

	/**
	 * 404 content.
	 *
	 * @since   1.0.0
	 */
	public function notfound_content() {
		$this->theme_options   = deep_options();
		$not_found_page_status = deep_get_option( $this->theme_options, 'deep_404_page_switch', '0' );
		$not_found_page_id     = deep_get_option( $this->theme_options, 'deep_404_page' );
		$not_found_page_text   = deep_get_option( $this->theme_options, 'deep_404_text' );
		$url_404 = get_permalink($not_found_page_id);

		if ( $not_found_page_status && $not_found_page_id ) {
			$this->deep_404_redirect( $url_404 );
		} else {
			?>
			<div class="wn-section clearfix">
				<div id="main-content" class="container">
					<h1 class="pnf404"><?php esc_html_e( '404', 'deep' ); ?></h1>
					<h2 class="pnf404"><?php esc_html_e( 'Page Not Found', 'deep' ); ?></h2>
					<br>
					<h3><?php echo esc_html( $not_found_page_text ); ?></h3>
					<div>
						<?php get_search_form(); ?>
					</div>
					<hr class="vertical-space5">
				</div>
			</div>
			<?php
		}
	}

	/**
	 * Page content.
	 *
	 * @since   1.0.0
	 */
	public function page_content() {
		// Page Options from theme options
		$this->theme_options	= deep_options();
		$style					= '';
		$titlebar_fg			= deep_get_option( $this->theme_options, 'page_title_color' );
		$titlebar_bg			= deep_get_option( $this->theme_options, 'page_title_bg_color' );
		$titlebar_fs			= deep_get_option( $this->theme_options, 'page_title_fontsize' );
		$show_titlebar			= deep_get_option( $this->theme_options, 'page_title_show', '0' );
		$titlebar_align			= deep_get_option( $this->theme_options, 'page_title_textalign' );
		$titlebar_height		= deep_get_option( $this->theme_options, 'page_title_height' );
		$enable_breadcrumbs		= deep_get_option( $this->theme_options, 'deep_enable_breadcrumbs', '0' );
		$titlebar_bg_img_op		= deep_get_option( $this->theme_options, 'page_title_bg_img' );
		$titlebar_bg_img_op		= $titlebar_bg_img_op ? $titlebar_bg_img_op['url'] : '';
		$titlebar_bg_img_po		= deep_get_option( $this->theme_options, 'page_title_bg_img_po' );
		$titlebar_lineheight	= deep_get_option( $this->theme_options, 'page_title_lineheight' );
		$titlebar_padding_op	= deep_get_option( $this->theme_options, 'page_title_padding' );
		$titlebar_mobileheight	= deep_get_option( $this->theme_options, 'page_title_mobileheight' );
		$breadcrumbs_opts		= deep_get_option( $this->theme_options, 'breadcrumbs_opts' );

		// page options variables
		$show_titlebar			= ( rwmb_meta( 'deep_page_title_bar_meta' ) != 'none' ) ? rwmb_meta( 'deep_page_title_bar_meta' ) : $show_titlebar;
		$titlebar_fg			= ! empty( rwmb_meta( 'deep_page_title_text_color_meta' ) ) ? rwmb_meta( 'deep_page_title_text_color_meta' ) : $titlebar_fg;
		$titlebar_bg			= ! empty( rwmb_meta( 'deep_page_title_bg_color_meta' ) ) ? rwmb_meta( 'deep_page_title_bg_color_meta' ) : $titlebar_bg;
		$titlebar_fs			= ! empty( rwmb_meta( 'deep_page_title_font_size_meta' ) ) ? rwmb_meta( 'deep_page_title_font_size_meta' ) : $titlebar_fs;
		$titlebar_bg_img		= ! empty( rwmb_meta( 'deep_page_title_bg_img' ) ) ? rwmb_meta( 'deep_page_title_bg_img' ) : '';
		$titlebar_bg_img_pos	= ! empty( rwmb_meta( 'deep_page_title_bg_img_po' ) ) ? rwmb_meta( 'deep_page_title_bg_img_po' ) : $titlebar_bg_img_po;
		$titlebar_align			= ( rwmb_meta( 'deep_page_title_textalign' ) != 'none' ) ? rwmb_meta( 'deep_page_title_textalign' ) : $titlebar_align;
		$titlebar_padding		= ! empty( rwmb_meta( 'deep_page_title_padding' ) ) ? rwmb_meta( 'deep_page_title_padding' ) : '';
		$titlebar_height		= ! empty( rwmb_meta( 'deep_page_title_height' ) ) ? rwmb_meta( 'deep_page_title_height' ) : $titlebar_height;
		$titlebar_mobileheight	= ! empty( rwmb_meta( 'deep_page_title_mobileheight' ) ) ? rwmb_meta( 'deep_page_title_mobileheight' ) : $titlebar_mobileheight;
		$titlebar_lineheight	= ! empty( rwmb_meta( 'deep_page_title_lineheight' ) ) ? rwmb_meta( 'deep_page_title_lineheight' ) : $titlebar_lineheight;
		$breadcrumb 			= rwmb_meta( 'deep_breadcrumb_meta') == 'themeoptions' ? $breadcrumbs_opts : rwmb_meta( 'deep_breadcrumb_meta');
		$edge_onepage 			= rwmb_meta( 'deep_edge_onepage');
		$custom_page_title 		= rwmb_meta( 'deep_custom_page_title');

		if  ( ! empty( $titlebar_padding_op ) ) :
			$padding_top	= ! empty( $titlebar_padding_op['padding-top'] ) ? ' padding-top: ' . $titlebar_padding_op['padding-top'] . ' ;' : '';
			$padding_right	= ! empty( $titlebar_padding_op['padding-right'] ) ? ' padding-right: ' . $titlebar_padding_op['padding-right'] . ' ;' : '';
			$padding_bottom	= ! empty( $titlebar_padding_op['padding-bottom'] ) ? ' padding-bottom: ' . $titlebar_padding_op['padding-bottom'] . ' ;' : '';
			$padding_title	= ! empty( $titlebar_padding_op['padding-left'] ) ? ' padding-left: ' . $titlebar_padding_op['padding-left'] . ' ;' : '';
			if ( $padding_top || $padding_right || $padding_bottom || $padding_title ) {
				$style .= '#wrap .page-title{ ' . $padding_top . $padding_right . $padding_bottom . $padding_title . ' }';
			}
		endif;

		// headline and breadcrubs
		$show_titlebar = $show_titlebar == 0 ? 'disabled-title' : '';
		$style .= ( ! empty( $titlebar_bg ) ) ? ' #wrap .page-title { background-color: ' . esc_attr($titlebar_bg) . ';}' : '';
		$style .= ( ! empty( $titlebar_bg ) ) ? ' #wrap .page-title { background-color: ' . esc_attr($titlebar_bg) . ';}' : '';
		$style .= ( ! empty( $titlebar_fg ) ) ? ' #wrap .page-title h1 { color: ' . esc_attr($titlebar_fg) . ';}' : '';
		$style .= ( ! empty( $titlebar_fs ) ) ? ' #wrap .page-title h1 { font-size: ' . esc_attr($titlebar_fs) . ';}' : '';
		$style .= ( ! empty( $titlebar_align ) && $titlebar_align != 'none' ) ? ' #wrap .page-title h1 { text-align: ' . esc_attr($titlebar_align) . ';}' : '';
		$style .= ( ! empty( $titlebar_padding ) ) ? ' #wrap .page-title { padding: ' . esc_attr($titlebar_padding) . ';}' : '';
		$style .= ( ! empty( $titlebar_height ) ) ? ' #wrap .page-title { height: ' . esc_attr($titlebar_height) . ';}' : '';
		$style .= ( ! empty( $titlebar_lineheight ) ) ? ' #wrap .page-title h1 { line-height: ' . esc_attr($titlebar_lineheight) . ';}' : '';

		if  ( ! empty( $titlebar_bg_img_op ) ) {
			$style .= ' #wrap .page-title { background-image:url('. $titlebar_bg_img_op .'); background-repeat:no-repeat; background-size:cover;background-position: '.$titlebar_bg_img_po.'; }';
		}

		if ( ! empty( $titlebar_mobileheight ) ) {
			$style .='@media only screen and (max-width: 768px) { #wrap .page-title { height: ' . esc_attr($titlebar_mobileheight) . ';} }';
		}

		if  ( ! empty( $titlebar_bg_img ) ) {
			foreach ( $titlebar_bg_img as $title_bg_image ) :
			$title_bg_image = $title_bg_image['full_url'];
			endforeach;

			$style .= ' #wrap .page-title { background-image:url('. $title_bg_image .'); background-repeat:no-repeat; background-size:cover;background-position: '.$titlebar_bg_img_pos.'; }';
		}

		$wn_color		= rwmb_meta( 'deep_wrap_color_meta' );
		$wn_bg_color	= rwmb_meta( 'deep_body_bg_color_meta' );
		$wn_bg_image	= rwmb_meta( 'deep_body_bg_img_meta' );
		$wrap_color		= ! empty( $wn_color ) ? $wn_color : '' ;
		$bgcolor		= ! empty( $wn_bg_color ) ? $wn_bg_color : '' ;
		$bgimages		= ! empty( $wn_bg_image ) ? $wn_bg_image : '' ;
		$bgimage		= '';

		if ( ! empty( $bgimages ) ) :
			foreach ( $bgimages as $bgimage ) :
				$bgimage = $bgimage['full_url'];
			endforeach;
		endif;
		$bgpercent	= rwmb_meta( 'deep_body_bg_image_100_meta' );
		$bgrepeat	= rwmb_meta( 'deep_body_bg_image_repeat_meta' );

		$style .= 'body { ';
		if( ! empty( $bgcolor ) ) {
			$style .= esc_attr( "background-color: $bgcolor ; "  );
		}
		if( ! empty( $bgimage ) ) {
			if( $bgrepeat == 1 ) {
				$style .=  esc_attr( ' background-image:url('. $bgimage .'); background-repeat:repeat;' );
			} elseif( $bgrepeat == 2 ) {
				$style .=  esc_attr( ' background-image:url('. $bgimage .'); background-repeat:repeat-x;' );
			} elseif( $bgrepeat == 3 ) {
				$style .=  esc_attr( ' background-image:url('. $bgimage .'); background-repeat:repeat-y;' );
			} else if( $bgrepeat == 0 ) {
				if( $bgpercent == '1' ) {
					$style .=  esc_attr( ' background-image:url('. $bgimage .'); background-repeat:no-repeat; background-size:100% auto; ' );
				} else {
					$style .=  esc_attr( ' background-image:url('. $bgimage .'); background-repeat:no-repeat; ' );
				}
			}
		}
		if( $bgpercent == '1' && !empty( $bgimage ) ) {
			$style .= esc_attr( 'background-size:cover; background-attachment:fixed; background-position:center;' );
		}
		if( $wrap_color ) {
			$style .= esc_attr( '} #wrap{background:'.$wrap_color.';' );
			if ( $bgimage ) {
				$style .= esc_attr( 'background: none;' );
			}
		}
		if ( !$wrap_color && $bgimage ) {
			$style .= esc_attr( '} #wrap{background: none;' );
		}
		$style .= '}';

		deep_save_dyn_styles( $style );

		// Siderbar Options from theme options
		$sidebar_pos	= isset( $this->theme_options['page_sidebar_position'] ) ? $this->theme_options['page_sidebar_position'] : 'none';
		$jet_breadcrumb	= isset( $this->theme_options['deep_enable_jetpack_breadcrumbs'] ) ? $this->theme_options['deep_enable_jetpack_breadcrumbs'] : '';
		// Siderbar Options
		$have_sidebar	= '';
		$sidebar_pos	= ( rwmb_meta( 'deep_sidebar_position_meta') != 'inherit' ) ? rwmb_meta( 'deep_sidebar_position_meta') : $sidebar_pos;
		$have_sidebar 	= !( 'none' == $sidebar_pos || '' == $sidebar_pos ) ? 'true' : 'false';
		$page_title 	= $custom_page_title ? $custom_page_title : get_the_title();
		?>

		<?php
			if ( $show_titlebar != 'disabled-title') {
				echo '
				<section id="headline" class="page-title">
					<div class="container">
						<h1>' . $page_title . '</h1>
					</div>
				</section>';
			}
		?>

		<?php if ( function_exists( 'jetpack_breadcrumbs' ) && !empty( $jet_breadcrumb )  ) : ?>
			<div class="wn-jetpack breadcrumb-area breadcrumbs-w">
				<div class="container">
					<?php jetpack_breadcrumbs(); ?>
				</div><!-- .wrapper -->
			</div><!-- .breadcrumb-area -->
		<?php endif;
		if ( ! is_front_page() && get_post_type( get_the_ID() ) != 'mega_menu' ) {
			if ( $enable_breadcrumbs == 1 && $breadcrumb != 'no' ) { ?>
				<div class="breadcrumbs-w">
					<div class="container">
						<?php if ( 'deep_breadcrumbs' ) deep_breadcrumbs(); ?>
					</div>
				</div> <?php
			} elseif ( $breadcrumb == 'yes' ) { ?>
				<div class="breadcrumbs-w">
					<div class="container">
						<?php if ( 'deep_breadcrumbs' ) deep_breadcrumbs(); ?>
					</div>
				</div> <?php
			}

		}

		// Edge One page
		if ( $edge_onepage == '1' ) {
			$edge_navigation		= isset( $this->theme_options['edge_navigation'] ) && $this->theme_options['edge_navigation'] == '1' ? 'true' : 'false';
			$edge_loopBottom		= isset( $this->theme_options['edge_loopBottom'] ) && $this->theme_options['edge_loopBottom'] == '1' ? 'true' : 'false';
			$edge_loopTop			= isset( $this->theme_options['edge_loopTop'] ) && $this->theme_options['edge_loopTop'] == '1' ? 'true' : 'false';
			$edge_scrollingSpeed	= isset( $this->theme_options['edge_scrollingSpeed'] ) ? $this->theme_options['edge_scrollingSpeed'] : '850';

			echo '<div
			class="wn-edge-onepage"
			data-navigation ="' . $edge_navigation . '"
			data-loopBottom ="' . $edge_loopBottom . '"
			data-loopTop ="' . $edge_loopTop . '"
			data-scrollingSpeed ="' . $edge_scrollingSpeed . '"
			>';
		}

		if ( $have_sidebar == 'true' ) {
			echo '<section class="container">';
		}

		// left sidebar
		if ( ( ( 'left' == $sidebar_pos) || ( 'both' == $sidebar_pos ) ) && $edge_onepage == '0' ) { ?>
			<aside class="col-md-3 sidebar leftside">
				<?php if( is_active_sidebar( 'Left Sidebar' ) ) dynamic_sidebar( esc_html__( 'Left Sidebar', 'deep' ) ); ?>
			</aside>
			<?php
		}

		// Main Content
		if ( have_posts() ) : while( have_posts() ): the_post();
				$pure_content 			= get_the_content();
				$vc_enabled	  			= ( $pure_content && ( substr( $pure_content, 0, 7 ) === '<p>[vc_' || substr( $pure_content, 0, 4 ) === '[vc_' ) ) ? true : false;
				$kc_enabled	  			= ( $pure_content && substr( $pure_content, 0, 4 ) === '[kc_' || $pure_content && substr( $pure_content, 0,14 ) === '<div class="kc'  ) ? true : false;

				if ( class_exists( 'Webnus_Elementor_Extentions' ) ) {
					$elementor_enabled = new Webnus_Elementor_Extentions();
					$elementor_enabled = $elementor_enabled->elementor_page();
				} else {
					$elementor_enabled = '';
				}

				if ( ! $vc_enabled && ! $kc_enabled && ! $elementor_enabled ) : ?>
					<!-- Start Page Content -->
					<?php
					if ( $have_sidebar == 'true' ) {
						if ( 'both' == $sidebar_pos ) {
							echo '<div class="col-md-6 cntt-w">';
						} elseif ( 'right' == $sidebar_pos || 'left' == $sidebar_pos ) {
							echo '<div class="col-md-9 cntt-w">';
						}
					} else {
						echo '
						<div class="wn-section clearfix">';
					}
					?>
						<div id="main-content" class="container">
							<?php the_content(); ?>
						</div> <!-- end container -->
					<?php if ( $have_sidebar != 'true' ) { ?>
						</div> <!-- end wn-section -->
					<?php } ?>
				<?php else :

					if ( $have_sidebar == 'true' ) {
						if ( 'both' == $sidebar_pos ) {
							echo '<div class="col-md-6 cntt-w">';
						} elseif ( 'right' == $sidebar_pos || 'left' == $sidebar_pos ) {
							echo '<div class="col-md-9 cntt-w">';
						}
					}
					the_content();
				endif;
		endwhile; endif;

		// Edge One page
		if ( $edge_onepage == '1' ) {
			echo '</div>';
		}

		// Comment template
		echo '<div class="container">';
			wp_link_pages();
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		echo '</div>';

		if ( $have_sidebar == 'true' ) {
			echo '</div>'; //close cntt-w when vc or kc is run
		}

		if ( ( ( 'right' == $sidebar_pos) || ( 'both' == $sidebar_pos ) ) && $edge_onepage == '0' ) { ?>
			<aside class="col-md-3 sidebar">
				<?php if( is_active_sidebar( 'Right Sidebar' ) ) dynamic_sidebar( esc_html__( 'Right Sidebar', 'deep' ) ); ?>
			</aside>
		<?php }

		if ( $have_sidebar == 'true' ) {
			echo '</section>'; //close section.clearfix
		}
	}

	/**
	 * Attachment content.
	 *
	 * @since   1.0.0
	 */
	public function attachment_content() {
		$this->theme_options	= deep_options();
		$sidebar = deep_get_option( $this->theme_options, 'deep_blog_singlepost_sidebar', 'right' );
		?>
		<section class="container page-content" >
			<hr class="vertical-space">

			<!-- left sidebar -->
			<?php if ( $sidebar == 'left' ) { ?>
				<aside class="col-md-3 sidebar leftside">
					<?php
					if ( is_active_sidebar( 'Left Sidebar' ) ) {
						dynamic_sidebar( esc_html__( 'Left Sidebar', 'deep' ) );
					}
					?>
				</aside>
			<?php } ?>

			<!-- blog content -->
			<section class="col-md-8 omega">
				<article class="blog-single-post">
					<?php
					if ( have_posts() ) : while( have_posts() ) : the_post(); ?>
						<div <?php post_class( 'post' ); ?>>
							<h1><?php the_title(); ?></h1>
							<?php
							if ( wp_attachment_is_image( get_the_ID() ) ) {
								echo wp_get_attachment_image( get_the_ID(), 'full' );
							}
							?>
						</div>
					<?php endwhile; endif; ?>
				</article>
				<?php comments_template(); ?>
			</section>

			<!-- right sidebar -->
			<?php if ( $sidebar == 'right' ) { ?>
				<aside class="col-md-3 sidebar">
					<?php if( is_active_sidebar( 'Right Sidebar' ) ) dynamic_sidebar( esc_html__( 'Right Sidebar', 'deep' ) ); ?>
				</aside>
			<?php } ?>

			<div class="vertical-space3"></div>
		</section>
		<?php
	}

	/**
	 * Author content.
	 *
	 * @since   1.0.0
	 */
	public function author_content() {

		if ( defined( 'DEEP_HANDLE' ) ) {
			wp_enqueue_style( 'deep-blog-masonry', DEEP_ASSETS_URL . 'css/frontend/blog/masonry.css', false, DEEP_VERSION );
			include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-masonry.php';
		} else {
			get_template_part( 'inc/templates/loops/blogloop-masonry' );
		}

	}

	/**
	 * Buddypress content.
	 *
	 * @since   1.0.0
	 */
	public function buddypress_content() {
		$this->theme_options	= deep_options();
		$blog_sidebar			= deep_get_option( $this->theme_options, 'deep_sidebar_blog_options' );
		?>
		<section id="headline" >
			<div class="container">
			<h2><?php the_title(); ?></h2>
			</div>
		</section>
		<section id="main-content" class="container">
			<?php
				if ( is_active_sidebar('buddypress-sidebar') ) {
					$right_side_class = 'col-md-9 cntt-w';
				} else {
					$right_side_class = 'col-md-12';
				}
			?>
			<section class="<?php echo esc_attr( $right_side_class ); ?>">
				<article>
					<?php
					if ( have_posts() ): while( have_posts() ): the_post();
						the_content();
					endwhile; endif;
					?>
				</article>
			</section>

			<?php if( is_active_sidebar( 'buddypress-sidebar' ) ) { ?>
				<aside class="col-md-3 sidebar <?php echo '' . $blog_sidebar; ?>">
					<?php dynamic_sidebar('buddypress-sidebar'); ?>
				</aside>
			<?php } ?>

		</section>
		<?php
	}

	/**
	 * Footer content.
	 *
	 * @since   1.0.0
	 */
	public function footer_content() {
		$this->theme_options		= deep_options();
		$enable_footer_builder		= deep_get_option( $this->theme_options, 'deep_footer_builder_switch', '0' );
		$footer_builder_page_id		= deep_get_option( $this->theme_options, 'deep_footer_builder_select', '0' );
		$custom_back_to_top_icon	= deep_get_option( $this->theme_options, 'deep_custom_backto_top_icon' );
		$enable_back_to_top			= deep_get_option( $this->theme_options, 'deep_backto_top' );
		$enable_back_to_top_mobile	= deep_get_option( $this->theme_options, 'deep_backto_top_on_mobile' ) == '0' ? 'disable-in-mobile' : 'enable-in-mobile';
		$back_to_top_icon			= deep_get_option( $this->theme_options, 'deep_backto_top_icon' );
		$back_to_top_icon			= $back_to_top_icon && $custom_back_to_top_icon == '1' ? '<i class="' . $back_to_top_icon . '"></i>' : '<i class="icon-arrows-slim-up"></i>';
		$footer_show				= 'ture';
		$footer_builder_page_id		= rwmb_meta( 'deep_custom_footer_for_this_page' ) ? rwmb_meta( 'deep_custom_footer_for_this_page' ) : deep_get_option( $this->theme_options, 'deep_footer_builder_select', '0' );
		// wpml compatiblity
		$footer_builder_page_id 	= defined( 'WPML_PLUGIN_FILE' ) ? apply_filters( 'wpml_object_id', $footer_builder_page_id, 'wbf_footer' ) : $footer_builder_page_id ;
		$footer_by_elementor		= did_action( 'elementor/loaded' ) ? Elementor\Plugin::instance()->db->is_built_with_elementor( $footer_builder_page_id ): '';
		// Polylag compatiblity
		$footer_builder_page_id     = function_exists( 'pll_get_post' ) && !defined( 'WPML_PLUGIN_FILE' ) ? intval( pll_get_post( $footer_builder_page_id ) ) : $footer_builder_page_id;

		$footer_color				= deep_get_option( $this->theme_options, 'deep_footer_color', '1' );
		// prefooter
		$footer_social_bar			= deep_get_option( $this->theme_options, 'deep_footer_social_bar', '0' );
		$footer_instagram_bar		= deep_get_option( $this->theme_options, 'deep_footer_instagram_bar', '0' );
		$footer_subscribe_bar		= deep_get_option( $this->theme_options, 'deep_footer_subscribe_bar', '0' );
		// footer bottom
		$enable_footer_bottom		= deep_get_option( $this->theme_options, 'deep_footer_bottom_enable', '0' );

		global $post;
		if ( isset( $post ) ) {
			if ( 'product' == get_post_type( $post->ID ) ) {
				echo '</section>';
			}
		}

		// footer visibility
		$footer_show = rwmb_meta( 'deep_footer_show' );
		if ( $footer_show === '1') {
			$footer_show = true;
		} elseif ( $footer_show === '0' ) {
			$footer_show = false;
		} elseif ( $footer_show === false || empty( $footer_show ) ) {
			$footer_show = true;
		}

		// footer
		if ( $footer_show || is_archive() || is_single() || is_home() || is_search() || is_404() ) :
			?>
			<!-- start footer bars -->
			<section id="pre-footer">
				<?php
				if ( $footer_instagram_bar ) {
					if ( defined( 'DEEP_HANDLE' ) ) {
						include DEEP_INCLUDES_DIR . 'templates/instagram-bar.php';
					} else {
						get_template_part( 'inc/templates/instagram-bar' );
					}
				}
				if ( $footer_social_bar ) {
					if ( defined( 'DEEP_HANDLE' ) ) {
						include DEEP_INCLUDES_DIR . 'templates/social-bar.php';
					} else {
						get_template_part( 'inc/templates/social-bar' );
					}
				}
				if ( $footer_subscribe_bar ) {
					if ( defined( 'DEEP_HANDLE' ) ) {
						include DEEP_INCLUDES_DIR . 'templates/subscribe-bar.php';
					} else {
						get_template_part( 'inc/templates/subscribe-bar' );
					}
				}
				?>
			</section>
			<?php
			if ( $enable_footer_builder == '1' && $footer_builder_page_id ) :
				// footer builder
				?>
				<footer class="wn-footer">
					<?php
					if ( ! empty ( $footer_builder_page_id ) ) {
						// Get footer Post
						$getFooterPost = get_post( $footer_builder_page_id );
						if ( ! empty ( $getFooterPost ) ) :
							// King Composer Builder
							if (  is_plugin_active( 'kingcomposer/kingcomposer.php' ) ) {
								// Export Style from post_content
								$content = $getFooterPost->post_content;
								$footerStyle = find_string($content, '<style type="text/css">', '</style>');
								deep_save_dyn_styles( $footerStyle );
								// Check if content created with KC
								$kc_enabled	  = ( $getFooterPost->post_content_filtered && substr( $getFooterPost->post_content_filtered, 0, 4 ) === '[kc_'  ) ? true : false;
								// Display Footer
								if ( ! $kc_enabled ) {
									echo $getFooterPost->post_content_filtered;
								} else {
									echo do_shortcode( $getFooterPost->post_content_filtered );
								}
							// Visual Composer Builder
							} elseif ( is_plugin_active( 'js_composer/js_composer.php' ) && ! $footer_by_elementor ) {
								// Check if content created with VC
								$vc_enabled	  = ( $getFooterPost->post_content && ( substr( $getFooterPost->post_content, 0, 7 ) === '<p>[vc_' || substr( $getFooterPost->post_content, 0, 4 ) === '[vc_' ) ) ? true : false;
								// Display Footer
								if ( ! $vc_enabled ) {
									echo $getFooterPost->post_content;
								} else {
									echo do_shortcode( $getFooterPost->post_content );
								}

							// Elementor Builder
							} elseif ( did_action( 'elementor/loaded' ) && $footer_by_elementor ) {
								echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($footer_builder_page_id);
							} else {
								echo $getFooterPost->post_content;
							}
							// footer bottom
							if ( $enable_footer_bottom ) {
								if ( defined( 'DEEP_HANDLE' ) ) {
									include DEEP_INCLUDES_DIR . 'templates/footer-bottom.php';
								} else {
									get_template_part( 'inc/templates/footer-bottom' );
								}
							}
						endif;
					}
					?>
				</footer>
				<?php
			else :
				// normal footer
				?>
				<footer id="footer" class="<?php echo $footer_color == 2 ? esc_attr( 'litex' ) : ''; ?>">
					<?php if ( is_active_sidebar( 'footer-section-1' ) || is_active_sidebar( 'footer-section-2' ) || is_active_sidebar( 'footer-section-3' ) || is_active_sidebar( 'footer-section-4' ) ) { ?>
						<section class="container footer-in">
							<div class="row">
								<?php
								$footer_type = deep_get_option( $this->theme_options, 'deep_footer_columns', '1' );
								switch( $footer_type ) {
									case 1:
										?>
										<div class="col-md-4"><?php if ( is_active_sidebar( 'footer-section-1' ) ) dynamic_sidebar( 'footer-section-1' ); ?></div>
										<div class="col-md-4"><?php if ( is_active_sidebar( 'footer-section-2' ) ) dynamic_sidebar( 'footer-section-2' ); ?></div>
										<div class="col-md-4"><?php if ( is_active_sidebar( 'footer-section-3' ) ) dynamic_sidebar( 'footer-section-3' ); ?></div>
										<?php
										break;
									case 2:
										?>
										<div class="col-md-3"><?php if ( is_active_sidebar( 'footer-section-1' ) ) dynamic_sidebar( 'footer-section-1' ); ?></div>
										<div class="col-md-3"><?php if ( is_active_sidebar( 'footer-section-2' ) ) dynamic_sidebar( 'footer-section-2' ); ?></div>
										<div class="col-md-3"><?php if ( is_active_sidebar( 'footer-section-3' ) ) dynamic_sidebar( 'footer-section-3' ); ?></div>
										<div class="col-md-3"><?php if ( is_active_sidebar( 'footer-section-4' ) ) dynamic_sidebar( 'footer-section-4' ); ?></div>
										<?php
										break;
									case 3:
										?>
										<div class="col-md-6"><?php if ( is_active_sidebar( 'footer-section-1' ) ) dynamic_sidebar( 'footer-section-1' ); ?></div>
										<div class="col-md-3"><?php if ( is_active_sidebar( 'footer-section-2' ) ) dynamic_sidebar( 'footer-section-2' ); ?></div>
										<div class="col-md-3"><?php if ( is_active_sidebar( 'footer-section-3' ) ) dynamic_sidebar( 'footer-section-3' ); ?></div>
										<?php
									break;
									case 4:
										?>
										<div class="col-md-3"><?php if ( is_active_sidebar( 'footer-section-1' ) ) dynamic_sidebar( 'footer-section-1' ); ?></div>
										<div class="col-md-3"><?php if ( is_active_sidebar( 'footer-section-2' ) ) dynamic_sidebar( 'footer-section-2' ); ?></div>
										<div class="col-md-6"><?php if ( is_active_sidebar( 'footer-section-3' ) ) dynamic_sidebar( 'footer-section-3' ); ?></div>
										<?php
										break;
									case 5:
										?>
										<div class="col-md-6"><?php if ( is_active_sidebar( 'footer-section-1' ) ) dynamic_sidebar( 'footer-section-1' ); ?></div>
										<div class="col-md-6"><?php if ( is_active_sidebar( 'footer-section-2' ) ) dynamic_sidebar( 'footer-section-2' ); ?></div>
										<?php
										break;
									case 6:
										?>
										<div class="col-md-12"><?php if ( is_active_sidebar( 'footer-section-1' ) ) dynamic_sidebar( 'footer-section-1' ); ?></div>
										<?php
										break;
								} ?>
							</div>
						</section> <!-- end footer-in -->
					<?php }
					// footer bottom
					if ( $enable_footer_bottom ) {
						if ( defined( 'DEEP_HANDLE' ) ) {
							include DEEP_INCLUDES_DIR . 'templates/footer-bottom.php';
						} else {
							get_template_part( 'inc/templates/footer-bottom' );
						}
					}
					?>
				</footer>
				<?php
			endif;
		endif;

		// Elementor Pro Footer Builder
		if ( class_exists('Webnus_Elementor_Extentions') ) {
			$webnus_elementor = new Webnus_Elementor_Extentions;
			if ( $webnus_elementor->elementor_pro_is_active() ) {
				if ( elementor_theme_do_location( 'deep-elementor-footer' ) ) {
					elementor_theme_do_location( 'deep-elementor-footer' );
				}
			}
		}

		// back to top
		if ( $enable_back_to_top == '1' ) {
			?>
			<span id="scroll-top" class="<?php echo esc_attr( $enable_back_to_top_mobile ); ?>"><a class="scrollup"> <?php echo wp_kses_post( $back_to_top_icon ); ?></a></span>
			<?php
		}
		deep_fast_contact();
		?>

				</div> <!-- end #wrap -->
				<?php
				// Theme space before body
				echo deep_get_option( $this->theme_options, 'deep_space_before_body' );
				wp_footer();
				?>
				<div id="whb-enqueue-dynamic-style">
					<style>.borderbox { box-sizing: border-box; }</style>
				</div>
			</body>
		</html>
		<?php
	}

	/**
	 * Header content.
	 *
	 * @since   1.0.0
	 */
	public function header_content() {
		$this->theme_options	= deep_options();
		$enable_responsive		= deep_get_option( $this->theme_options, 'deep_enable_responsive', '1' );
		$custom_color_skin		= deep_get_option( $this->theme_options, 'deep_custom_color_skin' );
		$color_skin_color		= deep_get_option( $this->theme_options, 'deep_color_skin', 'e3e3e3' );
		// -> Start the #wrap div classes
		$wrap_class				= 'wn-wrap ';

		// Colorskin
		if ( $color_skin_color != 'e3e3e3' || $custom_color_skin ) {
			$wrap_class .= 'colorskin-custom ';
		}

		// Background Layout
		$background_layout	= deep_get_option( $this->theme_options, 'deep_background_layout', 'wide' );
		$wrap_class 		.= ( ( $background_layout == 'boxed-wrap' ) ) ? $background_layout . ' ' : '';
		// -> End the #wrap div classes

		// Toggle Toparea
		$toggle_toparea_enable		= deep_get_option( $this->theme_options, 'deep_toggle_toparea_enable', 0 );

		// woocommerce
		$woo_product_title_enable 	= deep_get_option( $this->theme_options, 'deep_woo_product_title_enable' );
		$woo_product_title			= deep_get_option( $this->theme_options, 'deep_woo_product_title' );
		$woo_shop_title_enable		= deep_get_option( $this->theme_options, 'deep_woo_shop_title_enable' );
		$woo_shop_title				= deep_get_option( $this->theme_options, 'deep_woo_shop_title' );
		$wn_facebook_app_id			= deep_get_option( $this->theme_options, 'deep_facebook_app_id' ) != '' ? 'data-fb_app_id="'.deep_get_option( $this->theme_options, 'deep_facebook_app_id' ).'"' : '';
		$deep_shop_head 			= (!empty(deep_get_option( $this->theme_options, 'deep_shop_style' )) && deep_get_option( $this->theme_options, 'deep_shop_style' ) == 1 )  ? '1' : '0' ;

		?>
		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
		<head>
			<?php if ( !empty( deep_get_option( $this->theme_options, 'deep_facebook_app_id' ) ) ) { ?>
				<script   src="https://connect.facebook.net/<?php echo get_locale(); ?>/sdk.js#xfbml=1&version=v3.1&appId=<?php echo esc_attr__(deep_get_option( $this->theme_options, 'deep_facebook_app_id' )); ?>&autoLogAppEvents=1"></script>
			<?php } ?>

			<meta charset="<?php bloginfo( 'charset' ); ?>">
			<?php
			// Mobile Specific Metas
			if( $enable_responsive ) : ?>
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
			<?php else : ?>
			<meta name="viewport" content="width=1200,user-scalable=yes">
			<?php endif;
			if ( get_option( 'sync_favicon' ) != '0' && !has_site_icon() ) :
				echo '<link rel="shortcut icon" href="'.get_option( 'sync_favicon_url' ).'" sizes="32x32" />';
			endif;
			?>
			<link rel="profile" href="http://gmpg.org/xfn/11">
			<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
			<?php endif; ?>
			<?php wp_head(); ?>
			<?php
				if ( !empty( deep_get_option( $this->theme_options, 'deep_space_before_head' ) ) ) {
					echo deep_get_option( $this->theme_options, 'deep_space_before_head' );
				}
			?>
		</head>
		<body <?php body_class(); ?>  <?php echo $wn_facebook_app_id; ?>>
			<!-- Start the #wrap div -->
			<div id="wrap" class="<?php echo esc_attr( $wrap_class ); ?>">

				<?php if ( $toggle_toparea_enable ) : ?>
					<section class="toggle-top-area footer-in">
						<div class="w_toparea container">
							<div class="col-md-3">
								<?php if( is_active_sidebar( 'top-area-1' ) ) dynamic_sidebar('top-area-1'); ?>
							</div>
							<div class="col-md-3">
								<?php if( is_active_sidebar( 'top-area-2' ) ) dynamic_sidebar('top-area-2'); ?>
							</div>
							<div class="col-md-3">
								<?php if( is_active_sidebar( 'top-area-3' ) ) dynamic_sidebar('top-area-3'); ?>
							</div>
							<div class="col-md-3">
								<?php if( is_active_sidebar( 'top-area-4' ) ) dynamic_sidebar('top-area-4'); ?>
							</div>
						</div>
						<a class="w_toggle" href="#"></a>
					</section>
				<?php endif;

				// Webnus Header Builder
				if ( class_exists( 'WHB' ) ) {
					echo WHB_Output::output();
				}

				// Elementor Pro Header Builder
				if ( class_exists('Webnus_Elementor_Extentions') ) {
					$webnus_elementor = new Webnus_Elementor_Extentions;
					if ( $webnus_elementor->elementor_pro_is_active() ) {
						// Elementor Pro `header` location
						if ( elementor_theme_do_location( 'deep-elementor-header' ) ) {
							elementor_theme_do_location( 'deep-elementor-header' );
						}
					}
				}

				// Woocommerce - if woocommerce available add page headline section
				global $post;
				if ( isset( $post ) && get_post_type( $post->ID ) == 'product' ) :

					if ( function_exists( 'is_product' ) && is_product() && $woo_product_title_enable ) {
						?>
						<section id="headline">
							<div class="container">
								<h2><?php echo esc_html( $woo_product_title ); ?></h2>
							</div>
						</section>
						<?php
					}

					if ( function_exists( 'is_product'  ) && ! is_product() && $woo_shop_title_enable ) {
						?>
						<section id="headline">
							<div class="container">
								<h2><?php echo esc_html( $woo_shop_title ); ?></h2>
							</div>
						</section>
						<?php
					}

					if ( function_exists( 'is_product' ) && is_product() ) {
						if ( $deep_shop_head == '0' ) {
						?>
						<section class="single-product-wrap">
							<hr class="vertical-space">
						<?php
						} else {
						?>
						<section class="container">
							<hr class="vertical-space">
						<?php
						}
					} else {
						?>
						<!-- Start Page Content -->
						<section class="container">
							<hr class="vertical-space">
						<?php
					}

				endif; // end woocommerce
	}

	/**
	 * Search content.
	 *
	 * @since   1.0.0
	 */
	public function search_content() {
		$this->theme_options	= deep_options();
		$blog_sidebar			= deep_get_option( $this->theme_options, 'deep_sidebar_blog_options' );
		?>
		<section id="headline">
			<div class="container">
				<h2><?php printf( '<small>'.esc_html__( 'Search Results for', 'deep' ).':</small> %s', get_search_query() ); ?></h2>
			</div>
		</section>
		<section class="container search-results">
		<hr class="vertical-space2">
			<!-- begin | main-content -->
			<section class="col-md-8">
				<?php
				if ( have_posts() ) :
					while( have_posts() ):
						the_post();
						if ( defined( 'DEEP_HANDLE' ) ) {
							wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
							include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-search.php';
						} else {
							get_template_part( 'inc/templates/loops/blogloop-search' );
						}
					endwhile;
				else:
					if ( defined( 'DEEP_HANDLE' ) ) {
						include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-none.php';
					} else {
						get_template_part( 'inc/templates/loops/blogloop-none' );
					}
				endif;
				?>
				<br class="clear">
				<?php
				if ( function_exists( 'wp_pagenavi' ) ) {
					wp_pagenavi();
				} else {
					echo '<div class="wp-pagenavi">';
					next_posts_link(esc_html__('&larr; Previous page', 'deep'));
					previous_posts_link(esc_html__('Next page &rarr;', 'deep'));
				}
				?>
				<div class="white-space"></div>
			</section>

			<aside class="col-md-3 sidebar <?php echo esc_attr( $blog_sidebar ); ?> ">
				<?php
				if ( is_active_sidebar( 'Right Sidebar' ) ) {
					dynamic_sidebar( 'Right Sidebar' );
				}
				?>
			</aside>
			<br class="clear">
		</section>
		<?php
	}

	/**
	 * Search content.
	 *
	 * @since   1.0.0
	 */
	public function single_content() {
		$this->theme_options	 = deep_options();
		$full_width				 = rwmb_meta( 'deep_blogpost_width' ) != 'yes' ? 'container ' : 'clearfix ';
		$style                   = '';
		$uniqid                  = uniqid();
		$single_post_style       = rwmb_meta( 'deep_blogpost_meta' ) == 'themeopts' ? deep_get_option( $this->theme_options, 'deep_blog_single_post_style', '0' ) : rwmb_meta( 'deep_blogpost_meta' );
		$author_id               = get_the_author_meta( 'ID' );
		$post_format             = get_post_format( get_the_ID() );
		$user_rating             = deep_get_option( $this->theme_options, 'deep_user_rating' );
		$blog_sidebar            = deep_get_option( $this->theme_options, 'deep_sidebar_blog_options' );
		$no_image_src            = deep_get_option( $this->theme_options, 'deep_no_image_src' );
		$social_share            = deep_get_option( $this->theme_options, 'deep_blog_social_share', '1' );
		$author_position         = get_user_meta( $author_id, 'author_position', true );
		$author_position         = $author_position ? $author_position : '';
		$single_rec_posts        = deep_get_option( $this->theme_options, 'deep_blog_single_rec_posts', '0' );
		$enable_views_meta       = deep_get_option( $this->theme_options, 'deep_blog_meta_views_enable', '0' );
		$recommended_posts       = deep_get_option( $this->theme_options, 'deep_recommended_posts', '1' );
		$singlepost_sidebar      = deep_get_option( $this->theme_options, 'deep_blog_singlepost_sidebar', 'right' );
		$authorbox_sec_type      = deep_get_option( $this->theme_options, 'deep_authorbox_sec_type', '0' );
		$enable_comments_meta    = deep_get_option( $this->theme_options, 'deep_blog_meta_comments_enable', '1' );
		$enable_date_meta        = deep_get_option( $this->theme_options, 'deep_blog_meta_date_enable', '1' );
		$enable_author_meta      = deep_get_option( $this->theme_options, 'deep_blog_meta_author_enable', '1' );
		$enable_gravatar_meta    = deep_get_option( $this->theme_options, 'deep_blog_meta_gravatar_enable', '1' );
		$enable_category_meta    = deep_get_option( $this->theme_options, 'deep_blog_meta_category_enable', '1' );
		$enable_single_authorbox = deep_get_option( $this->theme_options, 'deep_blog_single_authorbox_enable', '0' );

		if ( $single_post_style == 'postshow1' ) {
			$style .= '.postshow1{ background-image: url( ' . get_the_post_thumbnail_url() . ' ); }';
			if ( defined( 'DEEP_HANDLE' ) ) {
				include DEEP_INCLUDES_DIR . 'templates/loops/single/parts/post-show1.php';
			} else {
				get_template_part( 'inc/templates/loops/single/parts/post-show1' );
			}
		} ?>

		<section class="<?php echo esc_attr( $full_width ); ?>page-content">
			<!-- Magazine Title and meta author -->
			<?php if ( $single_post_style == 'postshow3' ) { ?>
				<hr class="vertical-space1">
				<?php
				$style .= '.post-cat-ps3 { background: ' . deep_category_color() . '; }';
				if ( defined( 'DEEP_HANDLE' ) ) {
					include DEEP_INCLUDES_DIR . 'templates/loops/single/parts/post-show3/post-thumbnail.php';
				} else {
					get_template_part( 'inc/templates/loops/single/parts/post-show3/post-thumbnail' );
				}
			}
			?>
			<!-- left sidebar -->
			<?php if ( 'left' == $singlepost_sidebar ) { ?>
				<aside class="col-md-3 sidebar leftside <?php echo esc_attr( $blog_sidebar ); ?>">
					<?php
					if ( is_active_sidebar( 'Left Sidebar' ) ) {
						dynamic_sidebar( 'Left Sidebar' );
					}
					?>
				</aside>
			<?php } ?>
			<section class="<?php echo ( 'none' == $singlepost_sidebar ) ? 'col-md-12' : 'col-md-9 cntt-w'; ?>">
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						if ( $single_post_style == 'postshow1' ) {
							if ( defined( 'DEEP_HANDLE' ) ) {
								include DEEP_INCLUDES_DIR . 'templates/loops/single/postshow1.php';
							} else {
								get_template_part( 'inc/templates/loops/single/postshow1' );
							}
						} elseif ( $single_post_style == 'postshow2' ) {
							if ( defined( 'DEEP_HANDLE' ) ) {
								include DEEP_INCLUDES_DIR . 'templates/loops/single/postshow2.php';
							} else {
								get_template_part( 'inc/templates/loops/single/postshow2' );
							}
						} elseif ( $single_post_style == 'postshow3' ) {
							if ( defined( 'DEEP_HANDLE' ) ) {
								include DEEP_INCLUDES_DIR . 'templates/loops/single/postshow3.php';
							} else {
								get_template_part( 'inc/templates/loops/single/postshow3' );
							}
						} elseif ( $single_post_style == 'postshow4' ) {
							$style .= '.category-color { background: ' . deep_category_color() . '; }';
							if ( defined( 'DEEP_HANDLE' ) ) {
								include DEEP_INCLUDES_DIR . 'templates/loops/single/postshow4.php';
							} else {
								get_template_part( 'inc/templates/loops/single/postshow4' );
							}
						} elseif ( $single_post_style == 'postshow5' ) {
							if ( defined( 'DEEP_HANDLE' ) ) {
								include DEEP_INCLUDES_DIR . 'templates/loops/single/postshow5.php';
							} else {
								get_template_part( 'inc/templates/loops/single/postshow5' );
							}
						} else {
							if ( defined( 'DEEP_HANDLE' ) ) {
								include DEEP_INCLUDES_DIR . 'templates/loops/single/postshow0.php';
							} else {
								get_template_part( 'inc/templates/loops/single/postshow0' );
							}
						}
					endwhile;
				endif;
				wp_reset_postdata();
				?>
			</section>
			<!-- end-main-conten -->

			<?php if ( $singlepost_sidebar == 'right' ) { ?>
				<aside class="col-md-3 sidebar <?php echo esc_attr( $blog_sidebar ); ?>">
					<?php
					if ( is_active_sidebar( 'Right Sidebar' ) ) {
						dynamic_sidebar( 'Right Sidebar' );}
					?>
				</aside>
			<?php } ?>
			<div class="white-space"></div>
		</section>
		<?php

		if ( $style ) {
			deep_save_dyn_styles( $style );
		}
	}

	/**
	 * Index content.
	 *
	 * @since   1.0.0
	 */
	public function index_content() {
		$this->theme_options			= deep_options();
		$this->post_count            	= '0';
		$this->sidebar               	= deep_get_option( $this->theme_options, 'deep_blog_sidebar', 'right' );
		$this->template              	= deep_get_option( $this->theme_options, 'deep_blog_template', '2' );
		$this->page_title            	= deep_get_option( $this->theme_options, 'deep_blog_page_title', 'Blog' );
		$this->blog_sidebar          	= deep_get_option( $this->theme_options, 'deep_sidebar_blog_options' );
		$this->template_layout       	= deep_get_option( $this->theme_options, 'deep_blog_template_layout', '2' );
		$this->enable_page_title     	= deep_get_option( $this->theme_options, 'deep_blog_page_title_enable', '1' );
		$this->enable_post_title     	= deep_get_option( $this->theme_options, 'deep_blog_posttitle_enable', '1' );
		$this->enable_comments_meta  	= deep_get_option( $this->theme_options, 'deep_blog_meta_comments_enable', '1' );
		$this->enable_category_meta  	= deep_get_option( $this->theme_options, 'deep_blog_meta_category_enable', '1' );
		$this->enable_featured_image 	= deep_get_option( $this->theme_options, 'deep_blog_featuredimage_enable', '1' );
		$this->deep_blog_excerpt_list	= deep_get_option( $this->theme_options, 'deep_blog_excerpt_list' );

		// disable sidebar in masonry and timeline
		if ( $this->template_layout == '6' || $this->template_layout == '7' ) {
			$this->sidebar = 'none';
		}

		$this->headline();
		$this->before_posts();
		if ( $this->template_layout == '5' ) {
			echo '<div class="blg-full-grid">';
		}
		if ( have_posts() ) :
			$this->jetpack_integration();
			while ( have_posts() ) :
				the_post();
				switch ( $this->template ) {
					// Default
					case '1':
						if ( $this->template_layout == '1' ) {
							$this->default_standard();
						} elseif ( $this->template_layout == '2' ) {
							$this->default_list();
						} elseif ( $this->template_layout == '3' ) {
							$this->default_standard_then_list();
						} elseif ( $this->template_layout == '4' ) {
							$this->default_grid();
						} elseif ( $this->template_layout == '5' ) {
							$this->default_standard_then_grid();
						}
						break;

					// Personal Blog
					case '2':
						if ( $this->template_layout == '1' ) {
							$this->personal_blog_standard();
						} elseif ( $this->template_layout == '2' ) {
							$this->personal_blog_list();
						} elseif ( $this->template_layout == '3' ) {
							$this->personal_blog_standard_then_list();
						} elseif ( $this->template_layout == '4' ) {
							$this->personal_blog_grid();
						} elseif ( $this->template_layout == '5' ) {
							$this->personal_blog_standard_then_grid();
						}
						break;

					// Magazine
					case '3':
						if ( $this->template_layout == '1' ) {
							$this->magazine_standard();
						} elseif ( $this->template_layout == '2' ) {
							$this->magazine_list();
						} elseif ( $this->template_layout == '3' ) {
							$this->magazine_standard_then_list();
						} elseif ( $this->template_layout == '4' ) {
							$this->magazine_grid();
						} elseif ( $this->template_layout == '5' ) {
							$this->magazine_standard_then_grid();
						}
						break;

					// Minimal
					case '4':
						if ( $this->template_layout == '1' ) {
							$this->minimal_standard();
						} elseif ( $this->template_layout == '2' ) {
							$this->minimal_list();
						} elseif ( $this->template_layout == '3' ) {
							$this->minimal_standard_then_list();
						} elseif ( $this->template_layout == '4' ) {
							$this->minimal_grid();
						} elseif ( $this->template_layout == '5' ) {
							$this->minimal_standard_then_grid();
						}
						break;
				}

				// template layout = masonry
				if ( $this->template_layout == '6' ) {
					$this->masonry();
					// template layout = timeline
				} elseif ( $this->template_layout == '7' ) {
					$this->timeline();
				}
			endwhile;
			wp_reset_postdata();
		else :
			if ( defined( 'DEEP_HANDLE' ) ) {
				include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-none.php';
			} else {
				get_template_part( 'inc/templates/loops/blogloop-none' );
			}
		endif;
		if ( $this->template_layout == '5' ) {
			echo '</div>';
		}
		$this->after_posts();

	}

	/**
	 * Headline.
	 *
	 * @since   1.0.0
	 */
	public function headline() {
		if ( $this->enable_page_title ) {
			if ( is_archive() ) {
				echo '
				<section id="headline">
					<div class="container">
						<h2>';
				if ( is_day() ) :
					printf( '<small>' . esc_html__( 'Daily Archives', 'deep' ) . ':</small> %s', get_the_date() );
							elseif ( is_month() ) :
								printf( '<small>' . esc_html__( 'Monthly Archives', 'deep' ) . ':</small> %s', get_the_date( _x( 'F Y', 'monthly archives date format', 'deep' ) ) );
							elseif ( is_year() ) :
								printf( '<small>' . esc_html__( 'Yearly Archives', 'deep' ) . ':</small> %s', get_the_date( _x( 'Y', 'yearly archives date format', 'deep' ) ) );
							elseif ( is_category() ) :
								printf( '%s', single_cat_title( '', false ) );
							elseif ( is_tag() ) :
								printf( '<small>' . esc_html__( 'Tag', 'deep' ) . ':</small> %s', single_tag_title( '', false ) );
							else :
								echo esc_html( $this->blog_title );
							endif;
							echo '
						</h2>
					</div>
				</section>';
			} else {
				echo '
				<section id="headline">
					<div class="container">
						<h2>' . esc_html( $this->page_title ) . '</h2>
					</div>
				</section>';
			}
		}
	}

	/**
	 * Before start posts
	 *
	 * @since   1.0.0
	 */
	private function before_posts() {
		// if: template layout isn't masonry or timeline
		if ( $this->template_layout == '1' || $this->template_layout == '2' || $this->template_layout == '3' || $this->template_layout == '4' || $this->template_layout == '5' || $this->template_layout == '8' || $this->template_layout == '9' || $this->template_layout == '10' ) {
			echo '<section id="wn-page-content" class="container page-content">
				<hr class="vertical-space2">';

				// left sidebar
			if ( $this->sidebar == 'left' || $this->sidebar == 'both' ) {
				echo '<aside class="col-md-3 sidebar leftside ' . $this->blog_sidebar . ' ">';
				if ( is_active_sidebar( 'Left Sidebar' ) ) {
					dynamic_sidebar( 'Left Sidebar' );
				}
				echo '</aside>';
			}

			if ( $this->sidebar == 'both' ) {
				$class = 'col-md-6 cntt-w';
			} elseif ( $this->sidebar == 'right' || $this->sidebar == 'left' ) {
				$class = 'col-md-9 cntt-w';
			} else {
				$class = 'col-md-12 omega';
			}
				$infinite_id = '';
			if ( is_plugin_active( 'jetpack/jetpack.php' ) && get_option( 'infinite_scroll' ) == '1' ) :
				$infinite_id = 'id="wn-infinite-jetpack"';
				endif;
				echo '<section ' . $infinite_id . ' class="' . esc_attr( $class ) . '">';

			// templatelayout: masonry
		} elseif ( $this->template_layout == '6' ) {
			echo '
			<section id="main-content-pin">
				<div class="container">
					<div id="pin-content">';

			// templatelayout: timeline
		} elseif ( $this->template_layout == '7' ) {
			echo '
			<section id="main-timeline">
				<div class="container">
					<div id="tline-content">';
		}
		// template_layout = standard then grid
		if ( $this->template_layout == '3' ) {
			echo '<div class="row">';
		}
	}

	/**
	 * Jetpack integration
	 *
	 * @since   1.0.0
	 */
	private function jetpack_integration() {
		if ( is_plugin_active( 'jetpack/jetpack.php' ) ) :
			if ( deep_has_featured_posts( 1 ) ) :
				echo '<div class="wn-featured-content">';
					echo '<h3>' . esc_html__( 'Featured Posts', 'deep' ) . '</h3>';
				if ( $this->post_count == '0' ) {
					echo '<div class="blg-def-full">';
					if ( defined( 'DEEP_HANDLE' ) ) {
						wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
						include DEEP_INCLUDES_DIR . 'templates/loops/blogloop.php';
					} else {
						get_template_part( 'inc/templates/loops/blogloop' );
					}
					echo '</div>';
				} else {
					echo '<div class="blg-def-list">';
					if ( defined( 'DEEP_HANDLE' ) ) {
						wp_enqueue_style( 'deep-blog-loop-2', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-2.css', false, DEEP_VERSION );
						include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type2.php';
					} else {
						get_template_part( 'inc/templates/loops/blogloop-type2' );
					}
					echo '</div>';
				}
				echo '</div>';
				$this->post_count ++;
			endif;
		endif;
	}

	/**
	 * Default template, Standard posts layout
	 *
	 * @since   1.0.0
	 */
	private function default_standard() {
		echo '<div class="blg-def-full">';
		if ( defined( 'DEEP_HANDLE' ) ) {
			wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
			include DEEP_INCLUDES_DIR . 'templates/loops/blogloop.php';
		} else {
			get_template_part( 'inc/templates/loops/blogloop' );
		}
		echo '</div>';
	}

	/**
	 * Default template, List posts layout
	 *
	 * @since   1.0.0
	 */
	private function default_list() {
		echo '<div class="blg-def-list">';
		if ( defined( 'DEEP_HANDLE' ) ) {
			wp_enqueue_style( 'deep-blog-loop-2', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-2.css', false, DEEP_VERSION );
			include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type2.php';
		} else {
			get_template_part( 'inc/templates/loops/blogloop-type2' );
		}
		echo '</div>';
	}

	/**
	 * Default template, Standard then List posts layout
	 *
	 * @since   1.0.0
	 */
	private function default_standard_then_list() {
		if ( $this->post_count == '0' ) {
			echo '<div class="blg-def-full">';
				if ( defined( 'DEEP_HANDLE' ) ) {
					wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
					include DEEP_INCLUDES_DIR . 'templates/loops/blogloop.php';
				} else {
					get_template_part( 'inc/templates/loops/blogloop' );
				}
			echo '</div>';
		} else {
			echo '<div class="blg-def-list">';
				if ( defined( 'DEEP_HANDLE' ) ) {
					wp_enqueue_style( 'deep-blog-loop-2', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-2.css', false, DEEP_VERSION );
					include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type2.php';
				} else {
					get_template_part( 'inc/templates/loops/blogloop-type2' );
				}
			echo '</div>';
		}
		$this->post_count ++;
	}

	/**
	 * Default template, Grid posts layout
	 *
	 * @since   1.0.0
	 */
	private function default_grid() {
		if ( defined( 'DEEP_HANDLE' ) ) {
			wp_enqueue_style( 'deep-blog-loop-3', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-3.css', false, DEEP_VERSION );
			include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type3.php';
		} else {
			get_template_part( 'inc/templates/loops/blogloop-type3' );
		}
	}

	/**
	 * Default template, Standard then Grid posts layout
	 *
	 * @since   1.0.0
	 */
	private function default_standard_then_grid() {
		if ( $this->post_count == '0' ) {
			echo '<div class="blg-def-full">';
				if ( defined( 'DEEP_HANDLE' ) ) {
					wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
					include DEEP_INCLUDES_DIR . 'templates/loops/blogloop.php';
				} else {
					get_template_part( 'inc/templates/loops/blogloop' );
				}
			echo '</div>';
		} else {
			if ( defined( 'DEEP_HANDLE' ) ) {
				wp_enqueue_style( 'deep-blog-loop-3', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-3.css', false, DEEP_VERSION );
				include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type3.php';
			} else {
				get_template_part( 'inc/templates/loops/blogloop-type3' );
			}
		}
		$this->post_count++;
	}

	/**
	 * Personal Blog template, Standard posts layout
	 *
	 * @since   1.0.0
	 */
	private function personal_blog_standard() {
		echo '<div class="blgtyp10 blg-personal-full">';
			if ( defined( 'DEEP_HANDLE' ) ) {
				wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
				wp_enqueue_style( 'deep-blog-loop-5', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-5.css', false, DEEP_VERSION );
				include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type1.php';
			} else {
				get_template_part( 'inc/templates/loops/blogloop-type1' );
			}
		echo '</div>';
	}

	/**
	 * Personal Blog template, List posts layout
	 *
	 * @since   1.0.0
	 */
	private function personal_blog_list() {
		echo '<div class="blg-personal-list">';
			if ( defined( 'DEEP_HANDLE' ) ) {
				wp_enqueue_style( 'deep-blog-loop-5', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-5.css', false, DEEP_VERSION );
				include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type5.php';
			} else {
				get_template_part( 'inc/templates/loops/blogloop-type5' );
			}
		echo '</div>';
	}

	/**
	 * Personal Blog template, Standard then List posts layout
	 *
	 * @since   1.0.0
	 */
	private function personal_blog_standard_then_list() {
		if ( $this->post_count == '0' ) {
			echo '<div class="blgfltl blg-personal-full">';
				if ( defined( 'DEEP_HANDLE' ) ) {
					wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
					include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type1.php';
				} else {
					get_template_part( 'inc/templates/loops/blogloop-type1' );
				}
			echo '</div>';
		} else {
			echo '<div class="blgfltl blg-personal-list">';
				if ( defined( 'DEEP_HANDLE' ) ) {
					wp_enqueue_style( 'deep-blog-loop-5', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-5.css', false, DEEP_VERSION );
					include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type5.php';
				} else {
					get_template_part( 'inc/templates/loops/blogloop-type5' );
				}
			echo '</div>';
		}
		$this->post_count++;
	}

	/**
	 * Personal Blog template, Grid posts layout
	 *
	 * @since   1.0.0
	 */
	private function personal_blog_grid() {
		$cloumnsize = $this->sidebar == 'none' ? 'col-md-4' : 'col-md-6';
		echo '<div class="' . $cloumnsize . ' blg-typ3 blgtyp10 blg-personal-grid">';
			if ( defined( 'DEEP_HANDLE' ) ) {
				wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
				include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type7.php';
			} else {
				get_template_part( 'inc/templates/loops/blogloop-type7' );
			}
		echo '</div>';
	}

	/**
	 * Personal Blog template, Standard then Grid posts layout
	 *
	 * @since   1.0.0
	 */
	private function personal_blog_standard_then_grid() {
		if ( $this->post_count == '0' ) {
			$this->personal_blog_standard();
		} else {
			$this->personal_blog_grid();
		}
		$this->post_count++;
	}

	/**
	 * Magazine template, Standard posts layout
	 *
	 * @since   1.0.0
	 */
	private function magazine_standard() {
		wp_enqueue_style( 'wn-deep-latest-from-blog21', DEEP_ASSETS_URL . 'css/frontend/latest-from-blog/latest-from-blog21.css' );
		echo '<div class="blgtyp11 blg-magazine-full">';
		if ( $this->post_count == '0' ) {
			if ( defined( 'DEEP_HANDLE' ) ) {
				wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
				include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type6.php';
			} else {
				get_template_part( 'inc/templates/loops/blogloop-type6' );
			}
		}
		echo '</div>';
	}

	/**
	 * Magazine template, List posts layout
	 *
	 * @since   1.0.0
	 */
	private function magazine_list() {
		wp_enqueue_style( 'wn-deep-latest-from-blog21', DEEP_ASSETS_URL . 'css/frontend/latest-from-blog/latest-from-blog21.css' );
		echo '<div class="blgtyp11 blg-magazine-list">';
			if ( defined( 'DEEP_HANDLE' ) ) {
				wp_enqueue_style( 'deep-blog-loop-4', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-4.css', false, DEEP_VERSION );
				include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type4.php';
			} else {
				get_template_part( 'inc/templates/loops/blogloop-type4' );
			}
		echo '</div>';
	}

	/**
	 * Magazine template, Standard then List posts layout
	 *
	 * @since   1.0.0
	 */
	private function magazine_standard_then_list() {
		wp_enqueue_style( 'wn-deep-latest-from-blog21', DEEP_ASSETS_URL . 'css/frontend/latest-from-blog/latest-from-blog21.css' );
		if ( $this->post_count == '0' ) {
			echo '<div class="blgtyp11 blg-magazine-full">';
				if ( defined( 'DEEP_HANDLE' ) ) {
					wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
					include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type6.php';
				} else {
					get_template_part( 'inc/templates/loops/blogloop-type6' );
				}
			echo '</div>';
		} else {
			echo '<div class="blgtyp11 blg-magazine-list">';
				if ( defined( 'DEEP_HANDLE' ) ) {
					wp_enqueue_style( 'deep-blog-loop-4', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-4.css', false, DEEP_VERSION );
					include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type4.php';
				} else {
					get_template_part( 'inc/templates/loops/blogloop-type4' );
				}
			echo '</div>';
		}
		$this->post_count++;
	}

	/**
	 * Magazine template, Grid posts layout
	 *
	 * @since   1.0.0
	 */
	private function magazine_grid() {
		wp_enqueue_style( 'wn-deep-latest-from-blog21', DEEP_ASSETS_URL . 'css/frontend/latest-from-blog/latest-from-blog21.css' );
		$cloumnsize = $this->sidebar == 'none' ? 'col-md-4' : 'col-md-6';
		echo '<div class="' . $cloumnsize . ' blg-magazine-grid">';
			echo '<div class="blgtyp11">';
				if ( defined( 'DEEP_HANDLE' ) ) {
					wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
					include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type8.php';
				} else {
					get_template_part( 'inc/templates/loops/blogloop-type8' );
				}
			echo '</div>';
		echo '</div>';
		$this->post_count++;
	}

	/**
	 * Magazine template, Standard then Grid posts layout
	 *
	 * @since   1.0.0
	 */
	private function magazine_standard_then_grid() {
		wp_enqueue_style( 'wn-deep-latest-from-blog21', DEEP_ASSETS_URL . 'css/frontend/latest-from-blog/latest-from-blog21.css' );
		if ( $this->post_count == '0' ) {
			$this->magazine_standard();
		} else {
			$this->magazine_grid();
		}
		$this->post_count++;
	}

	/**
	 * Minimal template, Standard posts layout
	 *
	 * @since   1.0.0
	 */
	private function minimal_standard() {
		echo '<div class="blgtyp11 blg-minimal-full">';
		if ( $this->post_count == '0' ) {
			if ( defined( 'DEEP_HANDLE' ) ) {
				wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
				include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type9.php';
			} else {
				get_template_part( 'inc/templates/loops/blogloop-type9' );
			}
		}
		echo '</div>';
	}

	/**
	 * Minimal template, List posts layout
	 *
	 * @since   1.0.0
	 */
	private function minimal_list() {
		echo '<div class="blgtyp11 blg-minimal-full">';
		if ( $this->post_count == '0' ) {
			if ( defined( 'DEEP_HANDLE' ) ) {
				wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
				include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type9.php';
			} else {
				get_template_part( 'inc/templates/loops/blogloop-type9' );
			}
		}
		echo '</div>';
	}

	/**
	 * Minimal template, Standard then List posts layout
	 *
	 * @since   1.0.0
	 */
	private function minimal_standard_then_list() {
		if ( $this->post_count == '0' ) {
			echo '<div class="blgtyp11 blg-minimal-full">';
				if ( defined( 'DEEP_HANDLE' ) ) {
					wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
					include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type9.php';
				} else {
					get_template_part( 'inc/templates/loops/blogloop-type9' );
				}
			echo '</div>';
		} else {
			echo '<div class="blgtyp11 blg-minimal-list">';
				if ( defined( 'DEEP_HANDLE' ) ) {
					wp_enqueue_style( 'deep-blog-loop-4', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-4.css', false, DEEP_VERSION );
					include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type4.php';
				} else {
					get_template_part( 'inc/templates/loops/blogloop-type4' );
				}
			echo '</div>';
		}
		$this->post_count++;
	}

	/**
	 * Minimal template, Grid posts layout
	 *
	 * @since   1.0.0
	 */
	private function minimal_grid() {
		wp_enqueue_style( 'wn-deep-latest-from-blog21', DEEP_ASSETS_URL . 'css/frontend/latest-from-blog/latest-from-blog21.css' );
		$cloumnsize = $this->sidebar == 'none' ? 'col-md-4' : 'col-md-6';
		echo '<div class="' . $cloumnsize . ' blg-minimal-full">';
			echo '<div class="blgtyp11">';
				if ( defined( 'DEEP_HANDLE' ) ) {
					wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
					include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type9.php';
				} else {
					get_template_part( 'inc/templates/loops/blogloop-type9' );
				}
			echo '</div>';
		echo '</div>';
		$this->post_count++;
	}

	/**
	 * Minimal template, Standard then Grid posts layout
	 *
	 * @since   1.0.0
	 */
	private function minimal_standard_then_grid() {
		if ( $this->post_count == '0' ) {
			$this->minimal_standard();
		} else {
			$this->magazine_grid();
		}
		$this->post_count++;
	}

	/**
	 * Masonry posts layout
	 *
	 * @since   1.0.0
	 */
	private function masonry() {
		if ( defined( 'DEEP_HANDLE' ) ) {
			wp_enqueue_style( 'deep-blog-masonry', DEEP_ASSETS_URL . 'css/frontend/blog/masonry.css', false, DEEP_VERSION );
			include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-masonry.php';
		} else {
			get_template_part( 'inc/templates/loops/blogloop-masonry' );
		}
	}

	/**
	 * Timline posts layout
	 *
	 * @since   1.0.0
	 */
	private function timeline() {
		global $post;

		$timeline_last_time = get_the_time( get_option( 'date_format' ) );
		$timeline_i         = 1;
		$timeline_flag      = false;
		$post_id            = $post->ID;
		$post_format        = get_post_format( $post_id );
		$content            = get_the_content();

		if ( ! $post_format ) {
			$post_format = 'standard';
		}

		if ( ( $timeline_last_time != date( ' F Y', strtotime( $post->post_date ) ) ) || $timeline_i == 1 ) {
			$timeline_last_time = date( ' F Y', strtotime( $post->post_date ) );
			echo '<div class="tline-topdate">' . date( ' F Y', strtotime( $post->post_date ) ) . '</div>';
			if ( $timeline_i > 1 ) {
				$timeline_flag = true;
			}
		}
		?>
		<article id="post-<?php the_ID(); ?>"  class="tline-box">
			<span class="tline-row-<?php echo esc_attr( $timeline_i ) % 2 == 0 ? 'r' : 'l' ?> "></span>
			<div class="tline-author-box">
				<h6 class="tline-author">
					<?php the_author_posts_link(); ?>
				</h6>
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), 28 ); ?>
				<h6 class="tline-date"><a class="hcolorf" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_date(); ?></a></h6>
			</div>
			<div class="tline-content-wrap">
				<div class="tline-ecxt col-md-7">
					<?php if ( $this->enable_category_meta ) : ?>
						<h6 class="blog-cat-tline" style="background:<?php echo deep_category_color(); ?>;"> <?php the_category( '- ' ); ?></h6>
						<?php
					endif;
					if ( $this->enable_post_title ) {
						if ( ( 'aside' != $post_format ) && ( 'quote' != $post_format ) ) {
							if ( 'link' == $post_format ) {
								preg_match( '/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i', $content, $matches );
								$content = preg_replace( '/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i-', $content, 1 );
								$link    = '';
								if ( isset( $matches ) && is_array( $matches ) ) {
									$link = $matches[0];
								}
								?>
								<h4><a href="<?php echo esc_url( $link ); ?>"><?php the_title(); ?></a></h4>
								<?php
							} else {
								?>
								<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								<p class="blog-tline-excerpt">
									<?php echo deep_excerpt( ( $this->deep_blog_excerpt_list ) ? $this->deep_blog_excerpt_list : 19 ); ?>
								</p>
								<?php
							}
						}
					}

					if ( $post_format == ( 'quote' ) || $post_format == 'aside' ) {
						echo '<blockquote>';
							echo deep_excerpt( 31 );
						echo '</blockquote>';
					}
					?>
				</div>

				<div class="tline-rigth-side col-md-5">
				<?php
					$thumbnail_url = get_the_post_thumbnail_url( $post_id );
					$thumbnail_id  = get_post_thumbnail_id( $post_id );

				if ( ! empty( $thumbnail_url ) ) {
					// if main class not exist get it
					if ( ! class_exists( 'Wn_Img_Maniuplate' ) ) {
						require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
					}
					$image         = new Wn_Img_Maniuplate(); // instance from settor class
					$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url, '390', '297' ); // set required and get result
				}

				if ( $this->enable_featured_image ) {
					$meta_video = rwmb_meta( 'deep_featured_video_meta' );

					if ( $post_format == 'video' || $post_format == 'audio' ) {
						$pattern = '\\[' . '(\\[?)' . '(video|audio)' . '(?![\\w-])' . '(' . '[^\\]\\/]*' . '(?:' . '\\/(?!\\])' . '[^\\]\\/]*' . ')*?' . ')' . '(?:' . '(\\/)' . '\\]' . '|' . '\\]' . '(?:' . '(' . '[^\\[]*+' . '(?:' . '\\[(?!\\/\\2\\])' . '[^\\[]*+' . ')*+' . ')' . '\\[\\/\\2\\]' . ')?' . ')' . '(\\]?)';
						preg_match( '/' . $pattern . '/s', $post->post_content, $matches );

						if ( ( is_array( $matches ) ) && ( isset( $matches[3] ) ) && ( ( $matches[2] == 'video' ) || ( 'audio' == $post_format ) ) && ( isset( $matches[2] ) ) ) {
							$video = $matches[0];
							echo do_shortcode( $video );
							$content = preg_replace( '/' . $pattern . '/s', '', $content );
						} elseif ( ( ! empty( $meta_video ) ) ) {
							echo do_shortcode( $meta_video );
						}
					} else {
						if ( 'gallery' == $post_format ) {
							$pattern = '\\[' . '(\\[?)' . '(gallery)' . '(?![\\w-])' . '(' . '[^\\]\\/]*' . '(?:' . '\\/(?!\\])' . '[^\\]\\/]*' . ')*?' . ')' . '(?:' . '(\\/)' . '\\]' . '|' . '\\]' . '(?:' . '(' . '[^\\[]*+' . '(?:' . '\\[(?!\\/\\2\\])' . '[^\\[]*+' . ')*+' . ')' . '\\[\\/\\2\\]' . ')?' . ')' . '(\\]?)';
							preg_match( '/' . $pattern . '/s', $post->post_content, $matches );
							if ( ( is_array( $matches ) ) && ( isset( $matches[3] ) ) && ( $matches[2] == 'gallery' ) && ( isset( $matches[2] ) ) ) {
								$ids = ( shortcode_parse_atts( $matches[3] ) );
								if ( is_array( $ids ) && isset( $ids['ids'] ) ) {
									$ids = $ids['ids'];
								}
								$galley_url = array();
								$galley_id  = explode( ',', $ids );
								?>


									<div class="post-gallery-format">
										<div class="gl-img owl-carousel owl-theme">
										<?php
										for ( $i = 0; $i < sizeof( $galley_id ); $i++ ) {
											// echo wp_get_attachment_image( $galley_id[$i], 'full' );
											if ( ! empty( $galley_id[ $i ] ) ) {
												// if main class not exist get it
												if ( ! class_exists( 'Wn_Img_Maniuplate' ) ) {
													require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
												}
												$image         = new Wn_Img_Maniuplate(); // instance from settor class
												$thumbnail_url = $image->m_image( $galley_id[ $i ], wp_get_attachment_url( $galley_id[ $i ] ), '385', '293' ); // set required and get result

												echo '<img src="' . esc_url( $thumbnail_url ) . '" alt="' . get_the_title() . '">';
											}
										}
										?>

										</div>
									</div>
									<?php
							}
						} else {
							get_the_image(
								array(
									'size' => 'medium',
								)
							);
						}
					}
				}
				?>
				</div>

				<div class="tline-footer">
				<?php
				if ( $this->enable_comments_meta ) {
					?>
						<div class="tline-comment">
							<?php comments_popup_link( '<i class="wn-far wn-fa-comment"></i>' . esc_html__( '0 Comments-deep' ), '<i class="wn-far wn-fa-comment"></i>' . esc_html__( '1 Comment-deep' ), '<i class="wn-far wn-fa-comment"></i>' . esc_html__( '% Comments-deep' ) ); ?>
						</div>
						<?php
				}
				if ( $this->theme_options['deep_blog_social_share'] ) {
					deep_social_share( $post_id );
				}
				?>
				</div>
			</div>
		</article>
		<?php
		$timeline_i++;
	}

	/**
	 * After end posts
	 *
	 * @since   1.0.0
	 */
	private function after_posts() {
		// for timeline
		if ( $this->template_layout == '7' ) {
			echo '<div class="tline-topdate enddte">' . get_the_time( get_option( 'date_format' ) ) . '</div></div>';
		}

		if ( $this->template_layout == '3' || $this->template_layout == '6' || $this->template_layout == '7' ) {
			echo '</div>';
		}

		if ( is_plugin_active( 'jetpack/jetpack.php' ) && get_option( 'infinite_scroll' ) == '1' ) {
			// return;
		} else {
			if ( function_exists( 'wp_pagenavi' ) ) {
				if ( ( $this->template == '3' && $this->template_layout == '1' ) || ( $this->template == '3' && $this->template_layout == '2' ) || ( $this->template == '3' && $this->template_layout == '3' ) || ( $this->template == '3' && $this->template_layout == '4' ) || ( $this->template == '3' && $this->template_layout == '5' ) ) {
					echo '<div class="pagination-blgtype4">';
				}
				wp_pagenavi();
				if ( ( $this->template == '3' && $this->template_layout == '1' ) || ( $this->template == '3' && $this->template_layout == '2' ) || ( $this->template == '3' && $this->template_layout == '3' ) || ( $this->template == '3' && $this->template_layout == '4' ) || ( $this->template == '3' && $this->template_layout == '5' ) ) {
					echo '</div>';
				}
			} else {
				echo '<div class="wp-pagenavi">';
				next_posts_link( esc_html__( '&larr; Previous page', 'deep' ) );
				previous_posts_link( esc_html__( 'Next page &rarr;', 'deep' ) );
				echo '</div>';
			}
		}

		?>

		<hr class="vertical-space">

		<?php if ( $this->template_layout == '1' || $this->template_layout == '2' || $this->template_layout == '3' || $this->template_layout == '4' || $this->template_layout == '5' ) { ?>
			</section>
			<?php
		}

		if ( $this->sidebar == 'right' || $this->sidebar == 'both' ) {
			echo '<aside class="col-md-3 sidebar rightside ' . $this->blog_sidebar . ' ">';
			if ( is_active_sidebar( 'Right Sidebar' ) ) {
				dynamic_sidebar( 'Right Sidebar' );
			}
			echo '</aside>';
		}

		if ( $this->template_layout == '1' || $this->template_layout == '2' || $this->template_layout == '3' || $this->template_layout == '4' || $this->template_layout == '5' || $this->template_layout == '6' ) {
			echo '</section>';
		}
	}

	/**
	 * Enqueue Scripts.
	 *
	 * @since   4.4.0
	 */
	public function enqueue_scripts() {
		$deep_options = Front\Deep_Front::deep_options();
		$post_format = get_post_format();

		/**
         * Blog.
         */
        if ( deep_is_blog() ) {
			wp_enqueue_style( 'deep-blog-main', DEEP_ASSETS_URL . 'css/frontend/base/deep-blog.css', false, DEEP_VERSION );
        }

		/**
         * Blog Masonry.
         */
		if ( $deep_options['deep_blog_template_layout'] == '6' ) {
			wp_enqueue_style( 'deep-blog-masonry', DEEP_ASSETS_URL . 'css/frontend/blog/masonry.css', false, DEEP_VERSION );
		}

		/**
         * Blog timeline.
         */
		if ( $deep_options['deep_blog_template_layout'] == '7' ) {
			wp_enqueue_style( 'deep-blog-timeline', DEEP_ASSETS_URL . 'css/frontend/blog/timeline.css', false, DEEP_VERSION );
		}

		/**
         * Blog minimal.
         */
		if ( $deep_options['deep_blog_template'] == '4' || $deep_options['deep_blog_single_post_style'] == 'postshow5' ) {
			wp_enqueue_style( 'deep-blog-minimal', DEEP_ASSETS_URL . 'css/frontend/blog/minimal.css', false, DEEP_VERSION );
		}

		/**
         * Search results.
         */
		if ( is_search() ) {
			wp_enqueue_style( 'deep-blog-search-results', DEEP_ASSETS_URL . 'css/frontend/blog/search-results.css', false, DEEP_VERSION );
		}

		/**
         * Single.
         */
		if ( is_single() ) {
			wp_enqueue_style( 'deep-blog-single-post', DEEP_ASSETS_URL . 'css/frontend/blog/single/single.css', false, DEEP_VERSION );
		}

		/**
         * Single 1.
         */
		if ( is_singular( 'post' ) && $deep_options['deep_blog_single_post_style'] == 'postshow1' ) {
			wp_enqueue_style( 'deep-blog-single-1', DEEP_ASSETS_URL . 'css/frontend/blog/single/single-1.css', false, DEEP_VERSION );
		}

		/**
         * Single 2.
         */
		if ( is_singular( 'post' ) && $deep_options['deep_blog_single_post_style'] == 'postshow2' ) {
			wp_enqueue_style( 'deep-blog-single-2', DEEP_ASSETS_URL . 'css/frontend/blog/single/single-2.css', false, DEEP_VERSION );
		}

		/**
         * Single 3.
         */
		if ( is_singular( 'post' ) && $deep_options['deep_blog_single_post_style'] == 'postshow3' ) {
			wp_enqueue_style( 'deep-blog-single-3', DEEP_ASSETS_URL . 'css/frontend/blog/single/single-3.css', false, DEEP_VERSION );
		}

		/**
         * Single 4.
         */
		if ( is_singular( 'post' ) && $deep_options['deep_blog_single_post_style'] == 'postshow4' ) {
			wp_enqueue_style( 'deep-blog-single-4', DEEP_ASSETS_URL . 'css/frontend/blog/single/single-4.css', false, DEEP_VERSION );
		}

		if ( deep_is_blog() || is_single() ) {
			/**
			 * Social share 1.
			 */
			if ( $deep_options['deep_social_share_layout'] == '1' ) {
				wp_enqueue_style( 'deep-blog-social-share-1', DEEP_ASSETS_URL . 'css/frontend/blog/social-share/social-share-1.css', false, DEEP_VERSION );
				wp_enqueue_style( 'deep-social-tooltip', DEEP_ASSETS_URL . 'css/frontend/blog/social-tooltip.css', false, DEEP_VERSION );
			}

			/**
			 * Social share 2.
			 */
			if ( $deep_options['deep_social_share_layout'] == '2' ) {
				wp_enqueue_style( 'deep-blog-social-share-2', DEEP_ASSETS_URL . 'css/frontend/blog/social-share/social-share-2.css', false, DEEP_VERSION );
			}

			/**
			 * Social share 3.
			 */
			if ( $deep_options['deep_social_share_layout'] == '3' ) {
				wp_enqueue_style( 'deep-blog-social-share-3', DEEP_ASSETS_URL . 'css/frontend/blog/social-share/social-share-3.css', false, DEEP_VERSION );
				wp_enqueue_style( 'deep-social-tooltip', DEEP_ASSETS_URL . 'css/frontend/blog/social-tooltip.css', false, DEEP_VERSION );
			}

			/**
			 * Social share 4.
			 */
			if ( $deep_options['deep_social_share_layout'] == '4' ) {
				wp_enqueue_style( 'deep-blog-social-share-4', DEEP_ASSETS_URL . 'css/frontend/blog/social-share/social-share-4.css', false, DEEP_VERSION );
			}

			/**
			 * Social share 5.
			 */
			if ( $deep_options['deep_social_share_layout'] == '5' ) {
				wp_enqueue_style( 'deep-blog-social-share-5', DEEP_ASSETS_URL . 'css/frontend/blog/social-share/social-share-5.css', false, DEEP_VERSION );
			}

			/**
			 * Date.
			 */
			if ( $deep_options['deep_blog_meta_date_enable'] == '1' ) {
				wp_enqueue_style( 'deep-blog-metadata-date', DEEP_ASSETS_URL . 'css/frontend/blog/metadata/date.css', false, DEEP_VERSION );
			}

			/**
			 * Category.
			 */
			if ( $deep_options['deep_blog_meta_category_enable'] == '1' ) {
				wp_enqueue_style( 'deep-blog-metadata-cat', DEEP_ASSETS_URL . 'css/frontend/blog/metadata/cat.css', false, DEEP_VERSION );
			}

			/**
			 * View.
			 */
			if ( $deep_options['deep_blog_meta_views_enable'] == '1' ) {
				wp_enqueue_style( 'deep-blog-metadata-view', DEEP_ASSETS_URL . 'css/frontend/blog/metadata/view.css', false, DEEP_VERSION );
			}

			/**
			 * Author.
			 */
			if ( $deep_options['deep_blog_meta_author_enable'] == '1' ) {
				wp_enqueue_style( 'deep-blog-metadata-author', DEEP_ASSETS_URL . 'css/frontend/blog/metadata/author.css', false, DEEP_VERSION );
			}

			/**
			 * Load more style.
			 */
			wp_enqueue_style( 'deep-circle-side' );
		}

		if ( is_singular( 'post' ) && $deep_options['deep_recommended_posts'] == '1' ) {
			/**
			 * Recommended posts 1.
			 */
			if ( $deep_options['deep_blog_single_rec_posts'] == 'type1' ) {
				wp_enqueue_style( 'deep-blog-recommended-1', DEEP_ASSETS_URL . 'css/frontend/blog/recommended/recommended-1.css', false, DEEP_VERSION );
			}

			/**
			 * Recommended posts 2.
			 */
			if ( $deep_options['deep_blog_single_rec_posts'] == 'type2' ) {
				wp_enqueue_style( 'deep-blog-recommended-2', DEEP_ASSETS_URL . 'css/frontend/blog/recommended/recommended-2.css', false, DEEP_VERSION );
			}

			/**
			 * Recommended posts 3.
			 */
			if ( $deep_options['deep_blog_single_rec_posts'] == 'type3' ) {
				wp_enqueue_style( 'deep-blog-recommended-3', DEEP_ASSETS_URL . 'css/frontend/blog/recommended/recommended-3.css', false, DEEP_VERSION );
			}
		}

		/**
		 * Comments.
		 */
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_style( 'deep-blog-comments', DEEP_ASSETS_URL . 'css/frontend/blog/comments.css', false, DEEP_VERSION );
		}

		/**
		 * Next and previous post.
		 */
		if ( $deep_options['deep_next_prev_post'] == '1' ) {
			wp_enqueue_style( 'deep-blog-next-prev-article', DEEP_ASSETS_URL . 'css/frontend/blog/next-prev-article.css', false, DEEP_VERSION );
		}

		/**
         * Gallery post format.
         */
		if ( 'gallery' === $post_format ) {
			wp_enqueue_script( 'deep-owl-carousel', DEEP_ASSETS_URL . 'js/frontend/plugins/owl.js', array( 'jquery' ), DEEP_VERSION, true );
			wp_enqueue_script( 'deep-gallery-format', DEEP_ASSETS_URL . 'js/frontend/wp-widgets/gallery-format.js', array( 'jquery' ), DEEP_VERSION, true );
			wp_enqueue_style( 'deep-owl-carousel', DEEP_ASSETS_URL . 'css/frontend/plugins/owl-carousel.css', false, DEEP_VERSION );
			wp_enqueue_style( 'deep-blog-gallery-format', DEEP_ASSETS_URL . 'css/frontend/blog/gallery-format.css', false, DEEP_VERSION );
		}
	}
}

WN_Content::get_instance();
