<?php
/**
 * The template for displaying content on the search results page.
 *
 * @package ThinkUpThemes
 */
?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('blog-article'); ?>>

						<div class="entry-content">
							<?php consulting_thinkup_input_blogtitle(); ?>

							<div class="entry-meta">
								<?php consulting_thinkup_input_blogauthor(); ?>
								<?php consulting_thinkup_input_blogdate(); ?>
								<?php consulting_thinkup_input_blogcomment(); ?>
								<?php consulting_thinkup_input_blogcategory(); ?>
								<?php consulting_thinkup_input_blogtag(); ?>
							</div>

							<?php the_excerpt(); ?>
						</div>

					<div class="clearboth"></div>
					</article><!-- #post-<?php get_the_ID(); ?> -->	