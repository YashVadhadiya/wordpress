<?php
/**
 * Deep Theme.
 *
 * The template for displaying all pages
 *
 * @since   1.0.0
 * @author  Webnus
 */


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
		 * @since   1.0.0
		 */
		public function __construct() {
			$this->get_header();
			$this->content();
			$this->get_footer();
		}

		/**
		 * Render content.
		 *
		 * @since   1.0.0
		 */
		private function content() {
			// Page Options from theme options
			$titlebar_fg           = deep_get_option( $this->theme_options, 'page_title_color' );
			$titlebar_bg           = deep_get_option( $this->theme_options, 'page_title_bg_color' );
			$titlebar_fs           = deep_get_option( $this->theme_options, 'page_title_fontsize' );
			$show_titlebar         = deep_get_option( $this->theme_options, 'page_title_show', '0' );
			$titlebar_align        = deep_get_option( $this->theme_options, 'page_title_textalign' );
			$titlebar_height       = deep_get_option( $this->theme_options, 'page_title_height' );
			$enable_breadcrumbs    = deep_get_option( $this->theme_options, 'deep_enable_breadcrumbs', '0' );
			$titlebar_bg_img_op    = deep_get_option( $this->theme_options, 'page_title_bg_img' );
			$titlebar_bg_img_op    = $titlebar_bg_img_op ? $titlebar_bg_img_op['url'] : '';
			$titlebar_lineheight   = deep_get_option( $this->theme_options, 'page_title_lineheight' );
			$titlebar_padding_op   = deep_get_option( $this->theme_options, 'page_title_padding' );
			$titlebar_mobileheight = deep_get_option( $this->theme_options, 'page_title_mobileheight' );

			if ( ! empty( $titlebar_padding_op ) ) :
				if ( ! empty( $titlebar_padding_op['padding-top'] ) ) {
					$style .= ' #wrap .page-title { padding-top: ' . esc_attr( $titlebar_padding_op['padding-top'] ) . ';}';
				}
				if ( ! empty( $titlebar_padding_op['padding-right'] ) ) {
					$style .= ' #wrap .page-title { padding-right: ' . esc_attr( $titlebar_padding_op['padding-right'] ) . ';}';
				}
				if ( ! empty( $titlebar_padding_op['padding-bottom'] ) ) {
					$style .= ' #wrap .page-title { padding-bottom: ' . esc_attr( $titlebar_padding_op['padding-bottom'] ) . ';}';
				}
				if ( ! empty( $titlebar_padding_op['padding-left'] ) ) {
					$style .= ' #wrap .page-title { padding-left: ' . esc_attr( $titlebar_padding_op['padding-left'] ) . ';}';
				}
			endif;

			// headline and breadcrubs
			$show_titlebar = $show_titlebar == 0 ? 'disabled-title' : '';
			$style         = '';
			$style        .= ( ! empty( $titlebar_bg ) ) ? ' #wrap .page-title { background-color: ' . esc_attr( $titlebar_bg ) . ';}' : '';
			$style        .= ( ! empty( $titlebar_bg ) ) ? ' #wrap .page-title { background-color: ' . esc_attr( $titlebar_bg ) . ';}' : '';
			$style        .= ( ! empty( $titlebar_fg ) ) ? ' #wrap .page-title h1 { color: ' . esc_attr( $titlebar_fg ) . ';}' : '';
			$style        .= ( ! empty( $titlebar_fs ) ) ? ' #wrap .page-title h1 { font-size: ' . esc_attr( $titlebar_fs ) . ';}' : '';
			$style        .= ( ! empty( $titlebar_align ) ) ? ' #wrap .page-title h1 { text-align: ' . esc_attr( $titlebar_align ) . ';}' : '';
			$style        .= ( ! empty( $titlebar_padding ) ) ? ' #wrap .page-title { padding: ' . esc_attr( $titlebar_padding ) . ';}' : '';
			$style        .= ( ! empty( $titlebar_height ) ) ? ' #wrap .page-title { height: ' . esc_attr( $titlebar_height ) . ';}' : '';
			$style        .= ( ! empty( $titlebar_lineheight ) ) ? ' #wrap .page-title h1 { line-height: ' . esc_attr( $titlebar_lineheight ) . ';}' : '';

			if ( ! empty( $titlebar_bg_img_op ) ) {
				$style .= ' #wrap .page-title { background-image:url(' . $titlebar_bg_img_op . '); background-repeat:no-repeat; background-size:cover; }';
			}

			if ( ! empty( $titlebar_mobileheight ) ) {
				$style .= '@media only screen and (max-width: 768px) { #wrap .page-title { height: ' . esc_attr( $titlebar_mobileheight ) . ';} }';
			}

			if ( ! empty( $titlebar_bg_img ) ) {
				foreach ( $titlebar_bg_img as $title_bg_image ) :
					$title_bg_image = $title_bg_image['full_url'];
				endforeach;

				$style .= ' #wrap .page-title { background-image:url(' . $title_bg_image . '); background-repeat:no-repeat; background-size:cover; }';
			}

			deep_save_dyn_styles( $style ); ?>

			<section id="headline" class="page-title <?php echo esc_attr( $show_titlebar ); ?>">
				<div class="container">
					<h1><?php the_title(); ?></h1>
				</div>
			</section>

			<?php

			// Main Content
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					if ( class_exists( 'Webnus_Elementor_Extentions' ) ) {
						$elementor_enabled = new Webnus_Elementor_Extentions();
						$elementor_enabled = $elementor_enabled->elementor_page();
					} else {
						$elementor_enabled = '';
					}
					?>

					<div class="wn-section clearfix">
						<div id="main-content" class="container">
							<?php the_content(); ?>
						</div> <!-- end container -->
					</div> <!-- end wn-section -->
					<?php
				endwhile;
			endif;

		}

	}

}
