<?php 

function deepcore_single_portfolio() {
	$page_navi 		= rwmb_meta( 'deep_portfolio_page_nav');
	$related_works 	= rwmb_meta( 'deep_portfolio_page_related_work');
	$nav_align 		= rwmb_meta( 'deep_portfolio_page_nav_align');
	
	?>
	
	<!-- Start Page Content -->
	<div class="wn-portfolio-single">
		<?php
			if( have_posts() ):
				while( have_posts() ):
					the_post(); 
	
					$pure_content = get_the_content();
					$vc_enabled	  = ( $pure_content && ( substr( $pure_content, 0, 7 ) === '<p>[vc_' || substr( $pure_content, 0, 4 ) === '[vc_' ) ) ? true : false;
					$kc_enabled	  			= ( $pure_content && substr( $pure_content, 0, 4 ) === '[kc_' || $pure_content && substr( $pure_content, 0,14 ) === '<div class="kc'  ) ? true : false;
	
					if ( class_exists( 'Webnus_Elementor_Extentions' ) ) {
	
						$elementor_enabled = new Webnus_Elementor_Extentions();
						$elementor_enabled = $elementor_enabled->elementor_page();
	
					} else {
						$elementor_enabled = '';
					}
					if ( ! $vc_enabled && ! $kc_enabled && ! $elementor_enabled ) : ?>
						<!-- Start Page Content -->
						<div class="wn-section clearfix">
							<div id="main-content" class="container">
								<figure class="portfolio-single-featured-image image-id-<?php echo get_post_thumbnail_id(); ?>">
									<?php get_the_image( array( 'meta_key' => array( 'Full', 'Full' ), 'size' => 'Full', 'link_to_post' => false, ) );?>
								</figure>
								<?php the_content(); ?>
							</div> <!-- end container -->
						</div> <!-- end wn-section -->
					<?php else :
						the_content();
					endif;
					?>
		<?php	endwhile;
			endif;
		?>
	</div>
	
	<?php
	if ( isset( get_adjacent_post(false,'',false, 'portfolio_category')->ID) ) {
		$have_next_post 				= get_adjacent_post(false,'',false, 'portfolio_category')->ID ;
		$next_post_id 					= $have_next_post;
		$next_post_link 				= get_permalink( $next_post_id );
		$next_post_title 				= get_the_title ( $next_post_id );
		$next_post_thumbnail_id			= get_post_thumbnail_id( $next_post_id );
		$next_post_thumbnail_url_nav1	= $next_post_thumbnail_id ? wp_get_attachment_url( $next_post_thumbnail_id ) :  DEEP_ASSETS_URL . 'images/portfolio/empty-pic.jpg';
		$next_post_thumbnail_url_nav2	= $next_post_thumbnail_id ? wp_get_attachment_url( $next_post_thumbnail_id ) :  DEEP_ASSETS_URL . 'images/portfolio/empty-pic2.jpg';
		if( !empty( $next_post_thumbnail_id ) ) {
			// if main class not exist get it
			if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
				require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
			}
			$image = new Wn_Img_Maniuplate; // instance from settor class
			$next_post_thumbnail_url_nav1 = $image->m_image( $next_post_thumbnail_id , $next_post_thumbnail_url_nav1 , '500' , '330' ); // set required and get result
			$next_post_thumbnail_url_nav2 = $image->m_image( $next_post_thumbnail_id , $next_post_thumbnail_url_nav2 , '105' , '105' ); // set required and get result
		}
	}
	
	
	if ( isset( get_adjacent_post(false,'',true, 'portfolio_category')->ID ) ){
		$have_prev_post 				= get_adjacent_post(false,'',true, 'portfolio_category')->ID ;
		$prev_post_id 					= $have_prev_post;
		$prev_post_link 				= get_permalink( $prev_post_id );
		$prev_post_title 				= get_the_title ( $prev_post_id );
		$prev_post_thumbnail_id  		= get_post_thumbnail_id( $prev_post_id );
		$prev_post_thumbnail_url_nav1 	= $prev_post_thumbnail_id ? wp_get_attachment_url( $prev_post_thumbnail_id ) :  DEEP_ASSETS_URL . 'images/portfolio/empty-pic.jpg';
		$prev_post_thumbnail_url_nav2 	= $prev_post_thumbnail_id ? wp_get_attachment_url( $prev_post_thumbnail_id ) :  DEEP_ASSETS_URL . 'images/portfolio/empty-pic2.jpg';
		if( !empty( $prev_post_thumbnail_id ) ) {
			// if main class not exist get it
			if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
				require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
			}
			$image = new Wn_Img_Maniuplate; // instance from settor class
			$prev_post_thumbnail_url_nav1 = $image->m_image( $prev_post_thumbnail_id , $prev_post_thumbnail_url_nav1 , '500' , '330' ); // set required and get result
			$prev_post_thumbnail_url_nav2 = $image->m_image( $prev_post_thumbnail_id , $prev_post_thumbnail_url_nav2 , '105' , '105' ); // set required and get result
		}
	}
	
	$portfolio_page_id		= isset( $deep_options['deep_webnus_portfolio_page'] ) ? $deep_options['deep_webnus_portfolio_page'] : '';
	$portfolio_page_link	= get_page_link($portfolio_page_id);
	$columns_class 			= ( $page_navi == 'nav1' || $page_navi == 'nav2' ) ? 'col-sm-4 col-xs-4' : '' ;
	if ( !empty ( $page_navi ) ) { ?>
		<div class="container">
			<div class="row">
				<div class="wn-portfolio-nav type-<?php echo esc_attr( $page_navi ); ?>">
					<!-- Prev Post -->
					<div class="col-md-4 <?php echo esc_attr( $columns_class ); ?>">
						<?php if ( ( isset( $have_prev_post ) ) && ( $page_navi == 'nav1' || $page_navi == 'nav2' ) ){ ?>
						<div class="wn-portfolio-nav-wrap">
							<div class="wn-portfolio-nav-text">
								<a href="<?php echo esc_url( $prev_post_link ); ?>">
									<i class="icon-arrows-slim-left-dashed" ></i> <span> <?php esc_html_e( 'Previous Project' , 'deep' ); ?></span>
								</a>
							</div>
							<?php if ( $page_navi == 'nav1' ) { ?>
							<a href="<?php echo esc_url( $prev_post_link ); ?>">
								<div class="wn-portfolio-nav-content">
									<div class="wn-portfolio-nav-thumbnail">
										<img src="<?php echo esc_url( $prev_post_thumbnail_url_nav1 ); ?>" />
										<div class="wn-portfolio-nav-overlay colorb"></div>
										<div class="wn-portfolio-nav-title"><?php echo esc_html( $prev_post_title ); ?></div>
									</div>
								</div>
							</a>
							<?php } ?>
	
							<?php if ( $page_navi == 'nav2' ) { ?>
							<div class="wn-portfolio-nav-content portfolio-prev-post">
								<div class="wn-portfolio-nav-arrow-main">
									<span class="wn-portfolio-nav-arrow"></span>
								</div>
								<div class="wn-portfolio-nav-title"><a href="<?php echo esc_url( $prev_post_link ); ?>"><?php echo esc_html( $prev_post_title ); ?></a></div>
								<div class="wn-portfolio-nav-category"><?php the_terms( $prev_post_id, 'portfolio_category' , '' , ', ' , '' ); ?></div>
								<div class="wn-portfolio-nav-thumbnail">
									<img src="<?php echo esc_url( $prev_post_thumbnail_url_nav2 ); ?>" />
								</div>
							</div>	
							<?php } ?>
						</div>
						<?php } ?>
	
						<?php if ( $page_navi == 'nav3' && $nav_align == 'left' ) { ?>
						<div class="wn-portfolio-nav-wrap aligncenter">
						<?php if ( isset( $have_prev_post ) ) { ?>
							<div class="wn-portfolio-nav-main-content wn-portfolio-nav-arrow-left">
								<a href="<?php echo esc_url( $prev_post_link ); ?>" class="wn-data-tooltip" data-name="<?php esc_html_e( 'Previous Project' , 'deep' ); ?>">
									<i class="icon-arrows-slim-left-dashed hcolorf" ></i>
								</a>
							</div>
						<?php } ?>
							<div class="wn-portfolio-nav-main-content wn-portfolio-nav-arrow-center">
								<div class="wn-portfolio-nav-center-icon">
									<a href="<?php echo esc_html($portfolio_page_link); ?>">
										<i class="icon-arrows-squares hcolorr colorr hcolorf"></i>
									</a>
								</div>
							</div>
						<?php if ( isset( $have_next_post ) ) { ?>
							<div class="wn-portfolio-nav-main-content wn-portfolio-nav-arrow-right">
								<a href="<?php echo esc_url( $next_post_link ); ?>" class="wn-data-tooltip" data-name="<?php esc_html_e( 'Next Project' , 'deep' ); ?>">
									<i class="icon-arrows-slim-right-dashed hcolorf" ></i>
								</a>
							</div>
						<?php } ?>
						</div>
						<?php } ?>
					</div>
	
					<!-- Middle section -->
					<div class="col-md-4 <?php echo esc_attr( $columns_class ); ?> aligncenter">
					<?php if ( ( isset( $have_prev_post ) ) && ( $page_navi == 'nav1' || $page_navi == 'nav2' ) ){ ?>
						<div class="wn-portfolio-nav-center-icon">
							<a href="<?php echo esc_html($portfolio_page_link); ?>">
								<i class="icon-arrows-squares hcolorr colorr hcolorf"></i>
							</a>
						</div>
					<?php } ?>
					<?php if ( $page_navi == 'nav3' && $nav_align == 'center' ) { ?>
						<div class="wn-portfolio-nav-wrap aligncenter">
						<?php if ( isset( $have_prev_post ) ) { ?>
							<div class="wn-portfolio-nav-main-content wn-portfolio-nav-arrow-left">
								<a href="<?php echo esc_url( $prev_post_link ); ?>" class="wn-data-tooltip" data-name="<?php esc_html_e( 'Previous Project' , 'deep' ); ?>">
									<i class="icon-arrows-slim-left-dashed hcolorf" ></i>
								</a>
							</div>
						<?php } ?>
							<div class="wn-portfolio-nav-main-content wn-portfolio-nav-arrow-center">
								<div class="wn-portfolio-nav-center-icon">
									<a href="<?php echo esc_html($portfolio_page_link); ?>">
										<i class="icon-arrows-squares hcolorr colorr hcolorf"></i>
									</a>
								</div>
							</div>
						<?php if ( isset( $have_next_post ) ) { ?>
							<div class="wn-portfolio-nav-main-content wn-portfolio-nav-arrow-right">
								<a href="<?php echo esc_url( $next_post_link ); ?>" class="wn-data-tooltip" data-name="<?php esc_html_e( 'Next Project' , 'deep' ); ?>">
									<i class="icon-arrows-slim-right-dashed hcolorf" ></i>
								</a>
							</div>
						<?php } ?>
						</div>
					<?php } ?>
					</div>
	
					<!-- Next Post -->
					<div class="col-md-4 <?php echo esc_attr( $columns_class ); ?> alignright">
						<?php if ( ( isset( $have_next_post ) ) && ( $page_navi == 'nav1' || $page_navi == 'nav2' ) ){ ?>
						<div class="wn-portfolio-nav-wrap">
							<div class="wn-portfolio-nav-text">
								<a href="<?php echo esc_url( $next_post_link ); ?>">
									<span> <?php esc_html_e( 'Next Project' , 'deep' ); ?></span> <i class="icon-arrows-slim-right-dashed" ></i>
								</a>
							</div>
	
							<?php if ( $page_navi == 'nav1' ) { ?>
							<a href="<?php echo esc_url( $next_post_link ); ?>">
								<div class="wn-portfolio-nav-content">
									<div class="wn-portfolio-nav-thumbnail">
										<img src="<?php echo esc_url( $next_post_thumbnail_url_nav1 ); ?>" />
										<div class="wn-portfolio-nav-overlay colorb"></div>
										<div class="wn-portfolio-nav-title"><?php echo esc_html( $next_post_title ); ?></div>
									</div>
								</div>
							</a>
							<?php } ?>
	
							<?php if ( $page_navi == 'nav2' ) { ?>
							<div class="wn-portfolio-nav-content portfolio-next-post">
								<div class="wn-portfolio-nav-arrow-main">
									<span class="wn-portfolio-nav-arrow"></span>
								</div>
								<div class="wn-portfolio-nav-title"><a href="<?php echo esc_url( $next_post_link ); ?>"><?php echo esc_html( $next_post_title ); ?></a></div>
								<div class="wn-portfolio-nav-category"><?php the_terms( $next_post_id, 'portfolio_category' , '' , ', ' , '' ); ?></div>
								<div class="wn-portfolio-nav-thumbnail">
									<img src="<?php echo esc_url( $next_post_thumbnail_url_nav2 ); ?>" />
								</div>
							</div>	
							<?php } ?>
	
						</div>
						<?php } ?>
						
						<?php if ( $page_navi == 'nav3' && $nav_align == 'right' ) { ?>
						<div class="wn-portfolio-nav-wrap aligncenter">
						<?php if ( isset( $have_prev_post ) ) { ?>
							<div class="wn-portfolio-nav-main-content wn-portfolio-nav-arrow-left">
								<a href="<?php echo esc_url( $prev_post_link ); ?>">
									<i class="icon-arrows-slim-left-dashed hcolorf" ></i>
								</a>
							</div>
						<?php } ?>
							<div class="wn-portfolio-nav-main-content wn-portfolio-nav-arrow-center">
								<div class="wn-portfolio-nav-center-icon">
									<a href="<?php echo esc_html($portfolio_page_link); ?>">
										<i class="icon-arrows-squares hcolorr colorr hcolorf"></i>
									</a>
								</div>
							</div>
						<?php if ( isset( $have_next_post ) ) { ?>
							<div class="wn-portfolio-nav-main-content wn-portfolio-nav-arrow-right">
								<a href="<?php echo esc_url( $next_post_link ); ?>">
									<i class="icon-arrows-slim-right-dashed hcolorf" ></i>
								</a>
							</div>
						<?php } ?>
						</div>
						<?php } ?>
	
					</div>
				</div> <!-- End nav -->
			</div> <!-- End Row -->
		</div> <!-- End Container --> 
	<?php }
	
	?>
	
	<!-- Start Related Work -->
	<?php
	
	if ( $related_works == '1' ):
		// get current portfolio terms
		$post_id = get_the_ID();
		$terms	 = get_the_terms( $post_id , 'portfolio_category' );
	
		// get current portfolio category names
		$category_filter = array();
		if( is_array( $terms ) ) :
			foreach( $terms as $term )
				$category_filter[] = $term->slug;
		endif;
	
		// new Query
		$args = array(
			'post_type'		 => 'portfolio',
			'taxonomy'		 => 'portfolio_category',
			'post__not_in'	 => array( $post_id ),
			'orderby'        => 'rand',
			'posts_per_page' => 10,
			'tax_query'		 => array(
				array(
					'taxonomy' => 'portfolio_category',
					'field'    => 'slug',
					'terms'    => $category_filter,
				),
			),
		);
		$rw_query = new WP_Query( $args );
	?>
	
	<section class="related-works">
		<!-- subtitle -->
		<div class="container">
			<div class="col-md-12">
				<h4 class="subtitle"><?php esc_html_e( 'Related Works', 'deep' ); ?></h4>
				<!-- latest-projects (owl-carousel) -->
				<div id="latest-projects" class="owl-carousel owl-theme">
					<?php if ( $rw_query->have_posts()) : while ( $rw_query->have_posts() ) : $rw_query->the_post(); 
					$related_url = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
					if( !empty( $related_url ) ) {
						// if main class not exist get it
						if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
							require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
						}
						$image = new Wn_Img_Maniuplate; // instance from settor class
						$related_url = $image->m_image( get_post_thumbnail_id( get_the_ID() ) , $related_url , '300' , '200' ); // set required and get result
					}
					?>
						<div class="portfolio-item">
							<a><img src="<?php echo esc_url( $related_url ); ?>" /></a>
							<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
							<div class="portfolio-meta"><?php echo '<span class="portfolio-date">' . get_the_date() . '</span>'; ?></div>
						</div>
					<?php endwhile; endif;
					wp_reset_postdata(); ?>
				</div> <!-- end latest-projects -->
	
			</div> <!-- end col-md-12 -->
		</div>
	</section> 
	<?php endif; 
	
}


add_action( 'deepcore_single_portfolio', 'deepcore_single_portfolio' );