<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package fairy
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found sec-spacing">
			<div class="container">
				<div class="error-404-content">
					<div class="page-header">
						<h1 class="error-404-title"><?php esc_html_e('404', 'fairy');?></h1>
						<h2 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'fairy' ); ?></h2>
					</div><!-- .page-header -->
	
					<div class="page-content">
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'fairy' ); ?></p>
	
							<?php
							get_search_form();
							?>
					</div><!-- .page-content -->
				</div>
			</div>
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
