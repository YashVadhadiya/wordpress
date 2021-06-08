<?php
namespace Elementor;

class Webnus_Element_Widgets_Blog extends \Elementor\Widget_Base {

	/**
	 * Retrieve widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'blog';

	}

	/**
	 * Retrieve widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Blog', 'deep' );

	}

	/**
	 * Retrieve widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-post-list';

	}

	/**
	 * Set widget category.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget category.
	 */
	public function get_categories() {

		return [ 'webnus' ];

	}

	/**
	 * enqueue CSS
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'deep-owl-carousel', 'deep-blog-main', 'deep-circle-side', 'deep-blog-metadata-author', 'deep-blog-metadata-cat', 'deep-blog-metadata-date', 'deep-blog-social-share-5' ];

	}

	/**
	 * enqueue JS
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_script_depends() {

		return [ 'deep-owl-carousel', 'deep-blog', 'jquery-masonry', 'deep-gallery-format' ];

	}

	/**
	 * Register widget controls.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

			// Content Tab
			$this->start_controls_section(
				'content_section',
				[
					'label' => esc_html__( 'General', 'deep' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
			$this->add_control(
				'type',
				[
					'label' =>  esc_html__( 'Type', 'deep' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'description' =>  esc_html__( 'Blog type layout', 'deep'),
					'options'			=> [
						'1'		=>	'Large Posts (Default)',
						'2'		=>	'List Posts (Default)',
						'3'		=>	'Grid Posts (Default)',
						'4'		=>	'First Large then List (Default)',
						'5'		=>	'First Large then Grid (Default)',
						'6'		=>	'Large Posts (Personal blog)',
						'7'		=>	'List Posts (Personal blog)',
						'8'		=>	'Grid Posts (Personal blog)',
						'9'		=>	'First Large then List (Personal blog)',
						'10'	=>	'First Large then Grid (Personal blog)',
						'11'	=>	'Large Posts (Magazine)',
						'12'	=>	'List Posts (Magazine)',
						'13'	=>	'Grid Posts (Magazine)',
						'14'	=>	'First Large then List (Magazine)',
						'15'	=>	'First Large then Grid (Magazine)',
						'16'	=>	'Masonry',
						'17'	=>	'Timeline',
						'18'	=>	'Large Posts (Minimal)',
						'19'	=>	'List Posts (Minimal)',
						'20'	=>	'Grid Posts (Minimal)',
						'21'	=>	'First Large then List (Minimal)',
						'22'	=>	'First Large then Grid (Minimal)',
					],
					'default' 	=> '1',
				]
			);
			$this->add_control(
				'sidebar',
				[
					'label' =>  esc_html__( 'Sidebar', 'deep' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'description' =>  esc_html__( 'Sidebar does not support Masonry and Timeline', 'deep'),
					'options'			=> [
						'none'		=> 'None',
						'left'		=> 'Left',
						'right'		=> 'Right',
						'both'		=> 'Both',
					],
					'default'	=>	'none',
					'condition'	=>	[
						'type!'	=>	[
							'16',
							'17',
						]
					]
				]
			);
			$categories = array();
			$categories = get_categories();
			$category_slug_array = array('');
			$category_name_array = array('');
			foreach( $categories as $category ) {
				$category_slug_array[] = $category->name;
				$category_name_array[] = $category->slug;
			}
			$category_array  = array_combine($category_slug_array, $category_name_array);
			$this->add_control(
				'category',
				[
					'label' =>  esc_html__( 'Category', 'deep' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'description' =>  esc_html__( 'Select specific category, leave blank to show all categories.', 'deep'),
					'options'			=> $category_array,
				]
			);
			$this->add_control(
				'count',
				[
					'label' 		=>  esc_html__( 'Post Count', 'deep' ), //heading
					'type' 			=> \Elementor\Controls_Manager::TEXT, //type
					'description'	=>  esc_html__( 'Number of post(s) to show', 'deep')
				]
			);
			$this->add_control(
				'orderby',
				[
					'label' =>  esc_html__( 'Order By', 'deep' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'description' =>  esc_html__( 'If you use "Social Post Score" type, then Social Metrics Tracker plugin must be activated via Apperance > Install Plugins.', 'deep'),
					'options'			=> [
						'date'	=>	 esc_html__( 'Date (Latest Posts)', 'deep' ),
						'comment_count'	=>	 esc_html__( 'Popular posts: Comment Count', 'deep' ),
						'view_count'	=>	 esc_html__( 'Popular posts: View Count', 'deep' ),
						'social_score'	=>	 esc_html__( 'Popular Posts: Social Score', 'deep' ),
					]
				]
			);
			$this->add_control(
				'loadmore_btn',
				[
					'label'		=>  esc_html__( 'Do you want load more button?', 'deep' ),
					'description'	=>  esc_html__( 'if you select it, this option will add a button below the shortcode to load more post to show', 'deep'),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER, //type
					'label_on' 		=>  esc_html__( 'Yes', 'deep' ),
					'label_off' 	=>  esc_html__( 'No', 'deep' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'no',
					'condition'		=>	[
						'type!'	=>	[
							'16'
						]
					],
				]
			);

		$this->end_controls_section();
			$this->start_controls_section(
				'classid_section',
				[
					'label' => esc_html__( 'Class & ID', 'deep' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
			$this->add_control(
				'shortcodeclass',
				[
					'label'	=>  esc_html__( 'Extra Class', 'deep' ),
					'type'	=> \Elementor\Controls_Manager::TEXT,
				]
			);
			$this->add_control(
				'shortcodeid',
				[
					'label'	=>  esc_html__( 'ID', 'deep' ),
					'type'	=> \Elementor\Controls_Manager::TEXT,
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'section_title_style',
				[
					'label' => __( 'Title style', 'deep' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'label' 	=> __( 'Typography', 'deep' ),
					'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
					'selector' 	=> '#wrap {{WRAPPER}} .wn-blogws-wrap h3 a,#wrap {{WRAPPER}} .pin-ecxt h4 a ,#wrap {{WRAPPER}} .tline-ecxt h4 a',
				]
			);
			$this->add_control(
				'title_color',
				[
					'label' 		=> __( 'Color', 'deep' ), //heading
					'type' 			=> \Elementor\Controls_Manager::COLOR, //type
					'selectors' 	=> [
						'#wrap {{WRAPPER}} .wn-blogws-wrap h3 a,#wrap {{WRAPPER}} .pin-ecxt h4 a ,#wrap {{WRAPPER}} .tline-ecxt h4 a' => 'color: {{VALUE}} !important',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'section_content_style',
				[
					'label' => __( 'Content style', 'deep' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'content_typography',
					'label' 	=> __( 'Typography', 'deep' ),
					'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
					'selector' 	=> '#wrap {{WRAPPER}} .wn-blogws-wrap p',
				]
			);
			$this->add_control(
				'content_color',
				[
					'label' 		=> __( 'Color', 'deep' ), //heading
					'type' 			=> \Elementor\Controls_Manager::COLOR, //type
					'selectors' 	=> [
						'#wrap {{WRAPPER}} .wn-blogws-wrap p' => 'color: {{VALUE}} !important',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'section_readmore_style',
				[
					'label' => __( 'Button style', 'deep' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'readmore_typography',
					'label' 	=> __( 'Typography', 'deep' ),
					'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
					'selector' 	=> '#wrap {{WRAPPER}} .wn-blogws-wrap .readmore',
				]
			);
			$this->add_control(
				'readmore_color',
				[
					'label' 		=> __( 'Color', 'deep' ), //heading
					'type' 			=> \Elementor\Controls_Manager::COLOR, //type
					'selectors' 	=> [
						'#wrap {{WRAPPER}} .wn-blogws-wrap .readmore' => 'color: {{VALUE}} !important',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'custom_css_section_style',
				[
					'label' => __( 'Custom CSS', 'deep' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'custom_css',
				[
					'label' => __( 'Custom CSS', 'deep' ),
					'type' => \Elementor\Controls_Manager::CODE,
					'language' => 'css',
					'rows' => 20,
					'show_label' => true,
				]
			);
			$this->end_controls_section();

		}

	/**
	 * Render Sermon Category widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		ob_start();
		// Class & ID
		$shortcodeclass		= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
		$shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';

		$deep_options 		= deep_options();
		$p_count 			= '0';
		$paged 				= ( is_front_page() ) ? 'page' : 'paged' ;
		$deep_last_time 	= get_the_time(get_option( 'date_format' )); $deep_i=1; $deep_flag = false; //timeline
		$blog_sidebar 		= $deep_options['deep_sidebar_blog_options'] = isset($deep_options['deep_sidebar_blog_options']) ? $deep_options['deep_sidebar_blog_options'] : '' ;
		$sidebar			= $settings['sidebar'] ? $settings['sidebar'] : 'none';
		$orderby			=	$settings['orderby'];
		$loadmore_btn		=	$settings['loadmore_btn'];
		$count				=	$settings['count'];
		$category			=	$settings['category'];
		$type				=	$settings['type'];

		if ( $type == '11'|| $type == '12' || $type == '13' || $type == '14' || $type == '15' || $type == '18' || $type == '19' || $type == '20' || $type == '21' || $type == '22') {
			wp_enqueue_style( 'wn-deep-latest-from-blog21', DEEP_ASSETS_URL . 'css/frontend/latest-from-blog/latest-from-blog21.css' );
		}

		// orderby query args
		switch ( $orderby ) :
			case 'comment_count':
				$orderby = '&orderby=comment_count&order=DESC';
			break;

			case 'view_count':
				$orderby = '&meta_key=deep_views&orderby=meta_value_num&order=DESC';
			break;

			case 'social_score':
				if ( class_exists( 'SocialMetricsTracker' ) ) {
					$orderby ='&post_type=post&meta_key=socialcount_total&orderby=meta_value_num&order=DESC';
				}
			break;

			default:
				$orderby = '&orderby=date&order=DESC';
			break;
		endswitch;

		$args = 'post_type=post&paged='.get_query_var($paged).'&category_name='.$category.'&posts_per_page='.$count.$orderby.'';
		$query = new \WP_Query($args);
		if ($type == '16'){
			echo'<section id="main-content-pin"><div class="container"><div id="pin-content">';
		}elseif ($type == '17'){
			echo'<section class="wn-blog-ajax" id="main-content-timeline"><div class="container"><div id="tline-content">';
		}
		echo '<div class="wn-blogws-wrap ' . $shortcodeclass . '"  ' . $shortcodeid . '>';
		// left sidebar
		if ( $sidebar == 'left' || $sidebar == 'both' ) {
			echo '<aside class="col-md-3 sidebar leftside ' . $blog_sidebar . ' ">';
				if( is_active_sidebar( 'Left Sidebar' ) ) dynamic_sidebar( 'Left Sidebar' );
			echo '</aside>';
		}

		if ( $sidebar == 'left' || $sidebar == 'right' ) {
			echo '<div class="col-md-9 cntt-w">';
		} elseif ( $sidebar == 'both' ) {
			echo '<div class="col-md-6 cntt-w">';
		}

		if ($query ->have_posts()) :
			if ($type == '3')
				echo '<div class="row">';
		while ($query -> have_posts()) : $query -> the_post();
			if ( $type == '2' ) {

				echo '<div class="blg-def-list wn-blog-ajax">';
					if ( defined( 'DEEP_HANDLE' ) ) {
						wp_enqueue_style( 'deep-blog-loop-2', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-2.css', false, DEEP_VERSION );
						include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type2.php';
					} else {
						get_template_part( 'inc/templates/loops/blogloop-type2');
					}
				echo '</div>';

			} elseif ( $type == '4' ) {

				if( $p_count == '0' ) {
					echo '<div class="blg-def-full wn-blog-ajax">';
						if ( defined( 'DEEP_HANDLE' ) ) {
							wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
							include DEEP_INCLUDES_DIR . 'templates/loops/blogloop.php';
						} else {
							get_template_part( 'inc/templates/loops/blogloop');
						}
					echo '</div>';

				} else {
					echo '<div class="blg-def-list wn-blog-ajax">';
						if ( defined( 'DEEP_HANDLE' ) ) {
							wp_enqueue_style( 'deep-blog-loop-2', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-2.css', false, DEEP_VERSION );
							include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type2.php';
						} else {
							get_template_part( 'inc/templates/loops/blogloop-type2');
						}
					echo '</div>';

				}

				$p_count++;

			} elseif ( $type == '3' ) {

					if ( defined( 'DEEP_HANDLE' ) ) {
						wp_enqueue_style( 'deep-blog-loop-3', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-3.css', false, DEEP_VERSION );
						include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type3.php';
					} else {
						get_template_part( 'inc/templates/loops/blogloop-type3');
					}

			} elseif ( $type == '5' ) {

				if ( $p_count == '0' ) {

					echo '<div class="blg-def-full wn-blog-ajax">';
						if ( defined( 'DEEP_HANDLE' ) ) {
							wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
							include DEEP_INCLUDES_DIR . 'templates/loops/blogloop.php';
						} else {
							get_template_part( 'inc/templates/loops/blogloop');
						}
					echo '</div>';
					echo '<div class="row">';

				} else {

					if ( defined( 'DEEP_HANDLE' ) ) {
						wp_enqueue_style( 'deep-blog-loop-3', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-3.css', false, DEEP_VERSION );
						include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type3.php';
					} else {
						get_template_part( 'inc/templates/loops/blogloop-type3');
					}

				}

				$p_count++;

			} elseif ( $type == '16' ) {

				echo '<div class="wn-blog-ajax">';
					if ( defined( 'DEEP_HANDLE' ) ) {
						wp_enqueue_style( 'deep-blog-masonry', DEEP_ASSETS_URL . 'css/frontend/blog/masonry.css', false, DEEP_VERSION );
						include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-masonry.php';
					} else {
						get_template_part( 'inc/templates/loops/blogloop-masonry' );
					}
				echo '</div>';

			} elseif (  $type == '17' ) {
							wp_enqueue_style( 'deep-blog-timeline', DEEP_ASSETS_URL . 'css/frontend/blog/timeline.css', false, DEEP_VERSION );
							global $post;
							$post_id = $post->ID;
							$post_format = get_post_format($post_id);
							$content = get_the_content();
							if( !$post_format ) $post_format = 'standard';
							if(($deep_last_time != date(' F Y',strtotime($post->post_date)) ) || $deep_i==1){
								$deep_last_time = date(' F Y',strtotime($post->post_date));
								echo '<div class="tline-topdate">'.  date(' F Y',strtotime($post->post_date)) .'</div>';
								if( $deep_i>1 ) $deep_flag = true;
							} ?>
								<article id="post-<?php the_ID(); ?>"  class="tline-box"> <span class="tline-row-<?php if(($deep_i%2)==0) echo 'r'; else echo 'l'; ?>"></span>
									<div class="tline-author-box">
										<h6 class="tline-author">
											<?php the_author_posts_link(); ?>
										</h6>
										<?php echo get_avatar( get_the_author_meta( 'user_email' ), 28 ); ?>
										<h6 class="tline-date"><?php echo get_the_date();?></h6>
									</div>
									<div class="tline-content-wrap">
										<div class="tline-ecxt col-md-7">
											<?php if(  $deep_options['deep_blog_meta_category_enable'] ):?>
											<h6 class="blog-cat-tline" style="background:<?php echo deep_category_color(); ?>;"> <?php the_category('- ') ?></h6>
											<?php endif; ?>
											<?php
											if($deep_options['deep_blog_posttitle_enable'] ) {
												if( ('aside' != $post_format ) && ('quote' != $post_format)  ) {
													if( 'link' == $post_format ) {
														preg_match('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i', $content,$matches);
														$content = preg_replace('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i','', $content,1);
														$link ='';
														if(isset($matches) && is_array($matches))
															$link = $matches[0];
														?>
														<h4><a href="<?php echo esc_url($link); ?>"><?php the_title(); ?></a></h4>
														<?php
													}else{
														?>
														<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
														<p class="blog-tline-excerpt">
															<?php echo deep_excerpt( ( $deep_options['deep_blog_excerpt_list'] ) ? $deep_options['deep_blog_excerpt_list'] : 19 ); ?>
														</p>
														<?php } }
												}
												if( $post_format == ('quote') || $post_format == 'aside' ) {
													echo '<blockquote>';
														echo deep_excerpt(31);
													echo '</blockquote>';
												}
												?>

													</div>
									<div class="tline-rigth-side col-md-5"> <?php
										$thumbnail_url = get_the_post_thumbnail_url( $post_id );
										$thumbnail_id  = get_post_thumbnail_id( $post_id );

										if( !empty( $thumbnail_url ) ) {
											// if main class not exist get it
											if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
												require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
											}
											$image = new \Wn_Img_Maniuplate; // instance from settor class
											$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '390' , '297' ); // set required and get result
										}

										if( $deep_options['deep_blog_featuredimage_enable'] ){

											$meta_video = rwmb_meta( 'deep_featured_video_meta' );

											if($post_format  == 'video' || $post_format == 'audio') {

												$pattern = '\\[' . '(\\[?)' . "(video|audio)" . '(?![\\w-])' . '(' . '[^\\]\\/]*' . '(?:' . '\\/(?!\\])' . '[^\\]\\/]*' . ')*?' . ')' . '(?:' . '(\\/)' . '\\]' . '|' . '\\]' . '(?:' . '(' . '[^\\[]*+' . '(?:' . '\\[(?!\\/\\2\\])' . '[^\\[]*+' . ')*+' . ')' . '\\[\\/\\2\\]' . ')?' . ')' . '(\\]?)';
												preg_match( '/' . $pattern . '/s', $post->post_content, $matches );

												if( ( is_array( $matches) ) && ( isset( $matches[3] ) ) && (  ( $matches[2] == 'video' ) || ( 'audio'  == $post_format ) ) && ( isset($matches[2] ) ) ) {
													$video = $matches[0];
													echo do_shortcode($video);
													$content = preg_replace('/'.$pattern.'/s', '', $content);

													} elseif( (!empty( $meta_video )) ) {

														echo do_shortcode($meta_video);

													}
											} else
											if( 'gallery'  == $post_format){
												$pattern = '\\[' . '(\\[?)' . "(gallery)" . '(?![\\w-])' . '(' . '[^\\]\\/]*' . '(?:' . '\\/(?!\\])' . '[^\\]\\/]*' . ')*?' . ')' . '(?:' . '(\\/)' . '\\]' . '|' . '\\]' . '(?:' . '(' . '[^\\[]*+' . '(?:' . '\\[(?!\\/\\2\\])' . '[^\\[]*+' . ')*+' . ')' . '\\[\\/\\2\\]' . ')?' . ')' . '(\\]?)';
												preg_match('/'.$pattern.'/s', $post->post_content, $matches);
												if( (is_array($matches)) && (isset($matches[3])) && ($matches[2] == 'gallery') && (isset($matches[2]))) {
													$ids = (shortcode_parse_atts($matches[3]));
													if(is_array($ids) && isset($ids['ids']))
														$ids = $ids['ids'];
														$galley_url = array();
														$galley_id = explode(",",$ids);

														?>

														<div class="post-gallery-format">
															<div class="gl-img owl-carousel owl-theme">
																<?php

																for ($i=0; $i < sizeof($galley_id); $i++) {

																	// echo wp_get_attachment_image( $galley_id[$i], 'full' );
																	if( !empty( $galley_id[$i] ) ) {

																		// if main class not exist get it
																		if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
																			require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
																		}
																		$thumbnail_url = $image->m_image( $galley_id[$i], wp_get_attachment_url( $galley_id[$i] ) , '385' , '293' ); // set required and get result

																		echo '<img src="' . esc_url($thumbnail_url) . '" alt="' . get_the_title() . '">';

																	}

																} ?>
															</div>
														</div>
														<?php
												}
											} else {
												if ( $thumbnail_url ) { ?>
													<a href="<?php the_permalink(); ?>">
														<img src="<?php echo '' . $thumbnail_url ?>" alt="<?php the_title(); ?>" >
													</a>
												<?php }
											}
										} ?>
									</div>

									<div class="tline-footer"> <?php
										if( $deep_options['deep_blog_meta_comments_enable'] ) { ?>
											<div class="tline-comment">
												<i class="wn-fa wn-fa-comment"></i>
												<?php comments_number( ); ?>
											</div> <?php
										}
										if( $deep_options['deep_blog_social_share'] ) {
											deep_social_share( $post_id );
										}
										?>
									</div>
								</div>
							</article>
							<?php $deep_i++;
			} elseif ( $type == '6' ) { // personal blog

				echo '<div class="blg-personal-full blgtyp10 wn-blog-ajax">';
						if ( defined( 'DEEP_HANDLE' ) ) {
							wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
							include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type1.php';
						} else {
							get_template_part( 'inc/templates/loops/blogloop-type1');
						}
				echo '</div>';

			} elseif ( $type == '7' ) { // personal blog
				echo '<div class="blg-personal-list wn-blog-ajax">';
					if ( defined( 'DEEP_HANDLE' ) ) {
						wp_enqueue_style( 'deep-blog-loop-5', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-5.css', false, DEEP_VERSION );
						include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type5.php';
					} else {
						get_template_part( 'inc/templates/loops/blogloop-type5');
					}
				echo '</div>';
			} elseif ( $type == '9' ) { // personal blog

					if( $p_count == '0' ) {
						echo '<div class="blg-personal-full blgfltl wn-blog-ajax">';
							if ( defined( 'DEEP_HANDLE' ) ) {
								wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
								include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type1.php';
							} else {
								get_template_part( 'inc/templates/loops/blogloop-type1');
							}
						echo '</div>';

					} else {

						echo '<div class="blg-personal-list blgfltl wn-blog-ajax">';
							if ( defined( 'DEEP_HANDLE' ) ) {
								wp_enqueue_style( 'deep-blog-loop-5', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-5.css', false, DEEP_VERSION );
								include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type5.php';
							} else {
								get_template_part( 'inc/templates/loops/blogloop-type5');
							}
						echo '</div>';

					}

					$p_count++;

			} elseif ( $type == '8' ) { // personal blog

				echo '<div class="blg-personal-grid col-md-6 blg-typ3 blgtyp10 wn-blog-ajax">';
					if ( defined( 'DEEP_HANDLE' ) ) {
						wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
						include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type7.php';
					} else {
						get_template_part( 'inc/templates/loops/blogloop-type7');
					}
				echo '</div>';

			} elseif ( $type == '10' ) { // personal blog


				if( $p_count == '0' ) {

					echo '<div class="blg-personal-full blgtyp10 wn-blog-ajax">';
					if ( defined( 'DEEP_HANDLE' ) ) {
						wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
						include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type1.php';
					} else {
						get_template_part( 'inc/templates/loops/blogloop-type1');
					}
					echo '</div>';

				} else {

					echo '<div class="blg-personal-grid wn-blog-ajax col-md-6 blg-typ3 blgtyp10">';
					if ( defined( 'DEEP_HANDLE' ) ) {
						wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
						include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type7.php';
					} else {
						get_template_part( 'inc/templates/loops/blogloop-type7');
					}
					echo '</div>';

				}

				$p_count++;


			} elseif ( $type == '11' ) { // Magazine
				echo '<div class="blg-magazine-full blgtyp11 wn-blog-ajax">';
				if( $p_count == '0' ) {
					if ( defined( 'DEEP_HANDLE' ) ) {
						wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
						include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type6.php';
					} else {
						get_template_part( 'inc/templates/loops/blogloop-type6');
					}
				}
				echo '</div>';
			} elseif ( $type == '18' ) { // Magazine
				echo '<div class="blg-minimal-full blgtyp18 wn-blog-ajax">';
				if( $p_count == '0' ) {
					if ( defined( 'DEEP_HANDLE' ) ) {
						wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
						include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type9.php';
					} else {
						get_template_part( 'inc/templates/loops/blogloop-type9');
					}
				}
				echo '</div>';
			} elseif ( $type == '12' ) { // Magazine
				echo '<div class="blg-magazine-list wn-blog-ajax">';
				if ( defined( 'DEEP_HANDLE' ) ) {
					wp_enqueue_style( 'deep-blog-loop-4', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-4.css', false, DEEP_VERSION );
					include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type4.php';
				} else {
					get_template_part( 'inc/templates/loops/blogloop-type4');
				}
				echo '</div>';
			} elseif ( $type == '19' ) { // Magazine
				echo '<div class="blg-minimal-list wn-blog-ajax">';
				if ( defined( 'DEEP_HANDLE' ) ) {
					wp_enqueue_style( 'deep-blog-loop-4', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-4.css', false, DEEP_VERSION );
					include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type4.php';
				} else {
					get_template_part( 'inc/templates/loops/blogloop-type4');
				}
				echo '</div>';
			} elseif ( $type == '14' ) { // Magazine
				if( $p_count == '0' ) {
					echo '<div class="blg-magazine-full blgtyp11 wn-blog-ajax">';
					if ( defined( 'DEEP_HANDLE' ) ) {
						wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
						include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type6.php';
					} else {
						get_template_part( 'inc/templates/loops/blogloop-type6');
					}
					echo '</div>';
				} else {
					echo '<div class="blg-magazine-list blgtyp11 wn-blog-ajax">';
					if ( defined( 'DEEP_HANDLE' ) ) {
						wp_enqueue_style( 'deep-blog-loop-4', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-4.css', false, DEEP_VERSION );
						include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type4.php';
					} else {
						get_template_part( 'inc/templates/loops/blogloop-type4');
					}
					echo '</div>';
				}
				$p_count++;
			}  elseif ( $type == '21' ) { // Magazine
					if( $p_count == '0' ) {
						echo '<div class="blg-minimal-full blgtyp18 wn-blog-ajax">';
						if ( defined( 'DEEP_HANDLE' ) ) {
							wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
							include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type9.php';
						} else {
							get_template_part( 'inc/templates/loops/blogloop-type9');
						}
						echo '</div>';
					} else {
						echo '<div class="blg-minimal-list blgtyp18 wn-blog-ajax">';
						if ( defined( 'DEEP_HANDLE' ) ) {
							wp_enqueue_style( 'deep-blog-loop-4', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-4.css', false, DEEP_VERSION );
							include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type4.php';
						} else {
							get_template_part( 'inc/templates/loops/blogloop-type4');
						}
						echo '</div>';
					}
					$p_count++;

			} elseif ( $type == '13' ) { // Magazine
				echo '<div class="blg-magazine-grid blgtyp11 col-md-6 wn-blog-ajax">';
					if ( defined( 'DEEP_HANDLE' ) ) {
						wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
						include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type8.php';
					} else {
						get_template_part( 'inc/templates/loops/blogloop-type8');
					}
				echo '</div>';
			} elseif ( $type == '20' ) { // Magazine
				echo '<div class="blg-minimal-grid blgtyp11 col-md-6 wn-blog-ajax">';
					if ( defined( 'DEEP_HANDLE' ) ) {
						wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
						include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type8.php';
					} else {
						get_template_part( 'inc/templates/loops/blogloop-type8');
					}
				echo '</div>';
			} elseif ( $type == '15' ) { // Magazine
				$classes = $p_count == '0' ? 'blg-magazine-full blgtyp11 wn-blog-ajax' : 'blg-magazine-grid wn-blog-ajax col-md-6 blg-typ3 blgtyp11';
				echo '<div class="' . esc_attr( $classes ) . '">';
				if( $p_count == '0' ) {
					if ( defined( 'DEEP_HANDLE' ) ) {
						wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
						include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type6.php';
					} else {
						get_template_part( 'inc/templates/loops/blogloop-type6');
					}
				} else {
					if ( defined( 'DEEP_HANDLE' ) ) {
						wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
						include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type8.php';
					} else {
						get_template_part( 'inc/templates/loops/blogloop-type8');
					}
				}
				$p_count++;
				echo '</div>';
			} elseif ( $type == '22' ) { // Magazine
				$classes = $p_count == '0' ? 'blg-minimal-full blgtyp18 wn-blog-ajax' : 'blg-minimal-grid wn-blog-ajax col-md-6 blg-typ3 blgtyp18';
				echo '<div class="' . esc_attr( $classes ) . '">';
				if( $p_count == '0' ) {
					if ( defined( 'DEEP_HANDLE' ) ) {
						wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
						include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type9.php';
					} else {
						get_template_part( 'inc/templates/loops/blogloop-type9');
					}
				} else {
					if ( defined( 'DEEP_HANDLE' ) ) {
						wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
						include DEEP_INCLUDES_DIR . 'templates/loops/blogloop-type8.php';
					} else {
						get_template_part( 'inc/templates/loops/blogloop-type8');
					}
				}
				$p_count++;
				echo '</div>';
			} else {
				echo '<div class="wn-blog-ajax blg-def-full">';
				if ( defined( 'DEEP_HANDLE' ) ) {
					wp_enqueue_style( 'deep-blog-loop-1', DEEP_ASSETS_URL . 'css/frontend/blog/blog-loop/blog-loop-1.css', false, DEEP_VERSION );
					include DEEP_INCLUDES_DIR . 'templates/loops/blogloop.php';
				} else {
					get_template_part( 'inc/templates/loops/blogloop');
				}
				echo '</div>';
			}
		endwhile;
		if( $type == '3' || $type == '5' )
			echo '</div>';

		elseif( $type == '17' ) // for timeline
			echo'<div class="tline-topdate enddte">'. get_the_time(get_option( 'date_format' )) .'</div></div></div>';
		endif;

		if ( $type == '17' ) {
			echo '</section>';
		}

		/**
		 * end masonry
		 *
		*/
		if ( $type == '16' ) {
			echo '</div></div></section>';
		}

		/**
		 * page navi
		 * @author Webnus
		 * @version 1.0.0
		 *
		*/
		if( function_exists('wp_pagenavi') ) {
			if ($loadmore_btn != 'yes') {

				if ( $type == '11' || $type == '12' || $type == '13' || $type == '14' ) {
					echo '<div class="pagination-blgtype4">';
				}
				wp_pagenavi( array( 'query' => $query ) );

				if ( $type == '11' || $type == '12' || $type == '13' || $type == '14' ) {
					echo '</div>';
				}
			}
		}

		/**
		 * loar more button
		 *
		*/
		if ( $loadmore_btn == 'yes' ) {
			global $wp;
			$posts_per_page		= $query->query_vars[ 'posts_per_page' ];
			$found_posts		= $query->found_posts;
			$max_num_pages		= $query->max_num_pages;
			$current_page_num	= $query->query[ 'paged' ];
			$current_page_url	= home_url( $wp->request );
			?>
			<div
				class="wn-loadmore-ajax"
				data-site-url="<?php echo '' . $current_page_url; ?>"
				data-current-page="<?php echo '' . $current_page_num; ?>"
				data-max-page-num="<?php echo '' . $max_num_pages; ?>"
				data-total="<?php echo '' . $posts_per_page; ?>"
				data-post-pre-page="<?php echo '' . $found_posts; ?>"
				data-no-more-post="<?php _e( 'NO MORE POST', 'deep' ) ?>"
			>
				<a href="#"><?php _e( 'LOAD MORE', 'deep' ); ?></a>
			</div> <?php
		}

		if ( $sidebar != 'none' ) {
			echo '</div>'; // end col-md-9 or col-md-6
		}


		// right sidebar
		if ( $sidebar == 'right' || $sidebar == 'both' ) {
			echo '<aside class="col-md-3 sidebar rightside ' . $blog_sidebar . ' ">';
				if( is_active_sidebar( 'Right Sidebar' ) ) dynamic_sidebar( 'Right Sidebar' );
			echo '</aside>';
		}
		echo '</div>'; // end wn-blogws-wrap
		$out = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();


		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}
		echo $out;

	}

}
