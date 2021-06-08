<?php
/**
 * Deep Theme.
 * 
 * The template for displaying all pages
 *
 * @since   1.0.0
 * @author  Webnus
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WN_Page' ) ) {
    class WN_Page extends WN_Core_Templates {

        /**
		 * Instance of this class.
         *
		 * @since   1.0.0
		 * @access  public
		 * @var     WN_Page
		 */
		public static $instance;

        /**
		 * Provides access to a single instance of a module using the singleton pattern.
		 *
		 * @since   1.0.0
		 * @return	object
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
		 * @since	1.0.0
		 */
		public function __construct() {
			$this->get_header();
			$this->content();
			$this->get_footer();
		}

		/**
		 * Render content.
		 * 
		 * @since	1.0.0
		 */
		private function content() {
			// Page Options from theme options
			$titlebar_fg			= deep_get_option( $this->theme_options, 'page_title_color' );
			$titlebar_bg			= deep_get_option( $this->theme_options, 'page_title_bg_color' );
			$titlebar_fs			= deep_get_option( $this->theme_options, 'page_title_fontsize' );
			$show_titlebar			= deep_get_option( $this->theme_options, 'page_title_show', '0' );
			$titlebar_align			= deep_get_option( $this->theme_options, 'page_title_textalign' );
			$titlebar_height		= deep_get_option( $this->theme_options, 'page_title_height' );
			$enable_breadcrumbs		= deep_get_option( $this->theme_options, 'deep_enable_breadcrumbs', '0' );
			$titlebar_bg_img_op		= deep_get_option( $this->theme_options, 'page_title_bg_img' );
			$titlebar_bg_img_op		= $titlebar_bg_img_op ? $titlebar_bg_img_op['url'] : '';
			$titlebar_lineheight	= deep_get_option( $this->theme_options, 'page_title_lineheight' );
			$titlebar_padding_op	= deep_get_option( $this->theme_options, 'page_title_padding' );
			$titlebar_mobileheight	= deep_get_option( $this->theme_options, 'page_title_mobileheight' );

			// page options variables
			$show_titlebar			= ( rwmb_meta( 'deep_page_title_bar_meta' ) != 'none' ) ? rwmb_meta( 'deep_page_title_bar_meta' ) : $show_titlebar;
			$titlebar_fg			= ! empty( rwmb_meta( 'deep_page_title_text_color_meta' ) ) ? rwmb_meta( 'deep_page_title_text_color_meta' ) : $titlebar_fg;
			$titlebar_bg			= ! empty( rwmb_meta( 'deep_page_title_bg_color_meta' ) ) ? rwmb_meta( 'deep_page_title_bg_color_meta' ) : $titlebar_bg;
			$titlebar_fs			= ! empty( rwmb_meta( 'deep_page_title_font_size_meta' ) ) ? rwmb_meta( 'deep_page_title_font_size_meta' ) : $titlebar_fs;
			$titlebar_bg_img		= ! empty( rwmb_meta( 'deep_page_title_bg_img' ) ) ? rwmb_meta( 'deep_page_title_bg_img' ) : $titlebar_bg_img_op;
			$titlebar_align			= ( rwmb_meta( 'deep_page_title_textalign' ) != 'none' ) ? rwmb_meta( 'deep_page_title_textalign' ) : $titlebar_align;
			$titlebar_padding		= ! empty( rwmb_meta( 'deep_page_title_padding' ) ) ? rwmb_meta( 'deep_page_title_padding' ) : '';
			$titlebar_height		= ! empty( rwmb_meta( 'deep_page_title_height' ) ) ? rwmb_meta( 'deep_page_title_height' ) : $titlebar_height;
			$titlebar_mobileheight	= ! empty( rwmb_meta( 'deep_page_title_mobileheight' ) ) ? rwmb_meta( 'deep_page_title_mobileheight' ) : $titlebar_height;
			$titlebar_lineheight	= ! empty( rwmb_meta( 'deep_page_title_lineheight' ) ) ? rwmb_meta( 'deep_page_title_lineheight' ) : $titlebar_lineheight;
			$breadcrumb 			= rwmb_meta( 'deep_breadcrumb_meta');
			$edge_onepage 			= rwmb_meta( 'deep_edge_onepage');

			if  ( ! empty( $titlebar_padding_op ) ) :
				if ( ! empty( $titlebar_padding_op['padding-top'] ) ) {
					$style .= ' #wrap .page-title { padding-top: ' . esc_attr($titlebar_padding_op['padding-top']) . ';}';
				}
				if ( ! empty( $titlebar_padding_op['padding-right'] ) ) {
					$style .= ' #wrap .page-title { padding-right: ' . esc_attr($titlebar_padding_op['padding-right']) . ';}';
				}
				if ( ! empty( $titlebar_padding_op['padding-bottom'] ) ) {
					$style .= ' #wrap .page-title { padding-bottom: ' . esc_attr($titlebar_padding_op['padding-bottom']) . ';}';
				}
				if ( ! empty( $titlebar_padding_op['padding-left'] ) ) {
					$style .= ' #wrap .page-title { padding-left: ' . esc_attr($titlebar_padding_op['padding-left']) . ';}';
				}
			endif;

			// headline and breadcrubs
			$show_titlebar = $show_titlebar == 0 ? 'disabled-title' : '';
			$style = '';
			$style .= ( ! empty( $titlebar_bg ) ) ? ' #wrap .page-title { background-color: ' . esc_attr($titlebar_bg) . ';}' : '';
			$style .= ( ! empty( $titlebar_bg ) ) ? ' #wrap .page-title { background-color: ' . esc_attr($titlebar_bg) . ';}' : '';
			$style .= ( ! empty( $titlebar_fg ) ) ? ' #wrap .page-title h1 { color: ' . esc_attr($titlebar_fg) . ';}' : '';
			$style .= ( ! empty( $titlebar_fs ) ) ? ' #wrap .page-title h1 { font-size: ' . esc_attr($titlebar_fs) . ';}' : '';
			$style .= ( ! empty( $titlebar_align ) ) ? ' #wrap .page-title h1 { text-align: ' . esc_attr($titlebar_align) . ';}' : '';
			$style .= ( ! empty( $titlebar_padding ) ) ? ' #wrap .page-title { padding: ' . esc_attr($titlebar_padding) . ';}' : '';
			$style .= ( ! empty( $titlebar_height ) ) ? ' #wrap .page-title { height: ' . esc_attr($titlebar_height) . ';}' : '';
			$style .= ( ! empty( $titlebar_lineheight ) ) ? ' #wrap .page-title h1 { line-height: ' . esc_attr($titlebar_lineheight) . ';}' : '';

			if  ( ! empty( $titlebar_bg_img_op ) ) {
				$style .= ' #wrap .page-title { background-image:url('. $titlebar_bg_img_op .'); background-repeat:no-repeat; background-size:cover; }';
			}

			if ( ! empty( $titlebar_mobileheight ) ) {
				$style .='@media only screen and (max-width: 768px) { #wrap .page-title { height: ' . esc_attr($titlebar_mobileheight) . ';} }';
			}

			if  ( ! empty( $titlebar_bg_img ) ) {
				foreach ( $titlebar_bg_img as $title_bg_image ) :
				$title_bg_image = $title_bg_image['full_url'];
				endforeach;

				$style .= ' #wrap .page-title { background-image:url('. $title_bg_image .'); background-repeat:no-repeat; background-size:cover; }';
			}

			deep_save_dyn_styles( $style ); 

			// Siderbar Options from theme options
			$sidebar_pos	= isset( $this->theme_options['page_sidebar_position'] ) ? $this->theme_options['page_sidebar_position'] : 'none';
			// Siderbar Options
			$have_sidebar	= '';
			$sidebar_pos	= ( rwmb_meta( 'deep_sidebar_position_meta') != 'inherit' ) ? rwmb_meta( 'deep_sidebar_position_meta') : $sidebar_pos;
			$have_sidebar 	= !( 'none' == $sidebar_pos || '' == $sidebar_pos ) ? 'true' : 'false';
			?>

			<section id="headline" class="page-title <?php echo esc_attr( $show_titlebar ); ?>">
				<div class="container">
					<h1><?php the_title(); ?></h1>
				</div>
			</section>

			<?php if ( function_exists( 'jetpack_breadcrumbs' ) ) : ?>
				<div class="wn-jetpack breadcrumb-area breadcrumbs-w">
					<div class="container">
					<?php jetpack_breadcrumbs(); ?>
					</div><!-- .wrapper -->
				</div><!-- .breadcrumb-area -->
			<?php endif;

			if ( $enable_breadcrumbs == 1 && $breadcrumb != 'no' ) { ?>
				<div class="breadcrumbs-w">
					<div class="container">
						<?php if ( 'deep_breadcrumbs' ) deep_breadcrumbs(); ?>
					</div>
				</div>
				<?php
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
				echo '<section class="clearfix">';
			}

			// left sidebar
			if ( ( ( 'left' == $sidebar_pos) || ( 'both' == $sidebar_pos ) ) && $edge_onepage == '0' ) { ?>
				<aside class="col-md-3 sidebar leftside">
					<?php if( is_active_sidebar( 'Left Sidebar' ) ) dynamic_sidebar( 'Left Sidebar' ); ?>
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
							echo '<div class="wn-section clearfix">';
						}
						?>
							<div id="main-content" class="container">
								<?php the_content(); ?>
							</div> <!-- end container -->
						</div> <!-- end wn-section -->
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
					<?php if( is_active_sidebar( 'Right Sidebar' ) ) dynamic_sidebar( 'Right Sidebar' ); ?>
				</aside>
			<?php }

			if ( $have_sidebar == 'true' ) {
				echo '</section>'; //close section.clearfix
			}
		}

    }
}