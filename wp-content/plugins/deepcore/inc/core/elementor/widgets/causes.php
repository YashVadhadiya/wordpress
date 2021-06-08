<?php
namespace Elementor;
use Elementor\Widget_Base;
class Webnus_Element_Widgets_Causes extends \Elementor\Widget_Base {

	/**
	 * Retrieve Causes widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'causes';
		
	}

	/**
	 * Retrieve Causes widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Causes', 'deep' );

	}

	/**
	 * Retrieve Causes widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'icon-basic-heart';

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

	public function get_style_depends() {
		return [ 'wn-deep-causes' ];
	}

	/**
	 * Register Causes widget controls.
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
				'label' => esc_html__( 'Causes Settings', 'deep' ),
				'tab' => Controls_Manager::TAB_CONTENT,
            ]
		);

		// Select Social Type
		$this->add_control(
			'type', //param_name
			[
				'label' 	=> esc_html__( 'Type', 'deep' ), //heading
				'type' 		=> Controls_Manager::SELECT, //type
				'default' 	=> 'grid',
				'options' 	=> [
                   		 'grid'  	=> esc_html__( 'Grid', 'deep' ),
                   		 'grid2'  	=> esc_html__( 'Grid 2', 'deep' ),
                   		 'list'  	=> esc_html__( 'List', 'deep' ),
                   		 'list2'  	=> esc_html__( 'List 2', 'deep' ),
                ],
                'description'   => esc_html__( 'You can choose from these pre-designed types.', 'deep'),
			]
		);

		// Sort Order
		$this->add_control(
			'sort', //param_name
			[
				'label' 	=> esc_html__( 'Order By', 'deep' ), //heading
				'type' 		=> Controls_Manager::SELECT, //type
				'default' 	=> 'view',
				'options' 	=> [
                        ' '  	    => esc_html__( 'Most Recent', 'deep' ),
                   		'view'  	=> esc_html__( 'Most Popular', 'deep' ),
                ],
                'description'   => esc_html__( 'Recent Or Popular.', 'deep'),
			]
		);

        // Post Pre Page
        $this->add_control(
            'count',
            [
                'label'         => esc_html__( 'Post Count', 'deep' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => 6,
                'min'           => 1,
                'max'           => 24,
                'step'          => 1,
                'description'   => esc_html__( 'Type nothing to default (6) and type 0 to show all.', 'deep'),
            ]
        );

        // Navigation
        $this->add_control(
            'page',
            [
                'label'         => esc_html__( 'Page Navigation', 'deep' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => '',
                'on'      => esc_html__( 'Enable', 'deep' ),
                'off'     => esc_html__( 'Disable', 'deep' ),
                'return_value'  => 'enable',
                'description'   => esc_html__( 'Enable page navigation.', 'deep'),
            ]
        );

        $this->end_controls_section();

		// Class & ID Tab
		$this->start_controls_section(
			'classid_section',
			[
				'label' => __( 'Class & ID', 'deep' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'shortcodeclass',
			[
				'label'	=> esc_html__( 'Extra Class', 'deep' ),
				'type'	=> Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'shortcodeid',
			[
				'label'	=> esc_html__( 'ID', 'deep' ),
				'type'	=> Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();

		// Custom css tab
		$this->start_controls_section(
			'custom_css_section',
			[
				'label' => __( 'Custom CSS', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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

		$this->start_controls_section(
			'section_box_style',
			[
				'label' => __( 'Box Style', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'box_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' , 'gradient' ],
				'selector' => '#wrap {{WRAPPER}} .wn-causes-sh .wn-single-cause-gd',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-causes-sh .wn-single-cause-gd',
			]
		);

		$this->add_control(
			'box_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-causes-sh .wn-single-cause-gd' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'box_shadow',
					'label' => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .wn-causes-sh .wn-single-cause-gd',
				]
		);

		$this->add_control(
			'box_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-causes-sh .wn-single-cause-gd' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'box_margin', //param_name
			[
				'label' 		=> __( 'Margin', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-causes-sh .wn-single-cause-gd' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


	}

	/**
	 * Render Causes widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

        $settings               = $this->get_settings_for_display();
    
		$type                   = $settings['type'];
		$sort                   = $settings['sort'];
		$count                  = $settings['count'];
		$page                   = $settings['page'];
	    $category               = '';
	    $icon                   = '';
		$post                   = '';     
		   
        // Class & ID 
        $shortcodeclass 	= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
		$shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';
		
        if ( 'enable' == $settings['page'] ) {
            $page     = $settings['page'];
        }
		
		ob_start();
		$view =($sort=='view')?"'&orderby=meta_value_num&meta_key=webnus_views":"";
		$paged = ( is_front_page() ) ? 'page' : 'paged' ;
		$pages = ($page)?'&paged='.get_query_var($paged):'&paged=1';
		$query = new \WP_Query('post_type=cause&posts_per_page='.$count.'&category_name='.$category.$pages.$view);
	?>
	<div class="clearfix wn-causes-sh causes causes-<?php echo $type . $shortcodeclass ?>"  <?php echo $shortcodeid; ?>>
	<?php
		if(empty($count)){
			$count=1;
		}
		$col = ($count<5)? 12/$count:4;
		$row = 12/$col;
		$rcount= 1 ;
		while ($query -> have_posts()) : $query -> the_post();
			$post_id = get_the_ID();
			$cats = get_the_terms( $post_id , 'cause_category' );
			if(is_array($cats)){
				$cause_category = array();
				foreach($cats as $cat){
					$cause_category[] = $cat->slug;
				}
			}else $cause_category=array();
			$cats = get_the_terms($post_id, 'cause_category' );
			$cats_slug_str = '';
			if ($cats && ! is_wp_error($cats)) :
				$cat_slugs_arr = array();
			foreach ($cats as $cat) {
				$cat_slugs_arr[] = '<a href="'. get_term_link($cat, 'cause_category') .'">' . $cat->name . '</a>';
			}
			$cats_slug_str = implode( ", ", $cat_slugs_arr);
			endif;

			$category = ($cats_slug_str)?esc_html__('Category: ','deep') . $cats_slug_str:'';
			$date = get_the_time('F d, Y');
			$permalink = get_the_permalink();
			$image = get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'sermons-gridmons-grid','echo'=>false, ) );
			$image2 = get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'blog2_thumb','echo'=>false, ) );
			$title = '<h4><a class="cause-title hcolorf" href="'.$permalink.'">'.get_the_title().'</a></h4>';
			$content ='<p>'. deep_excerpt(25) .'</p>';
			$view = '<div class="cause_view"><i class="sl-eye"></i>'.deep_getViews($post_id).'</div>';
			$deep_options = deep_options();
			$deep_options['webnus_donate_form'] = isset( $deep_options['webnus_donate_form'] ) ? $deep_options['webnus_donate_form'] : '';
			global $cause_meta;
			$progressbar = $cause_days = $cause_donate = '';
			$received = $percentage = 0;

			$received	= rwmb_meta( 'deep_cause_amount_received' );
			$amount		= rwmb_meta( 'deep_cause_amount' );
			$end		= rwmb_meta( 'deep_cause_end_date' );
			$deep_options['webnus_cause_currency'] = isset( $deep_options['webnus_cause_currency'] ) ? $deep_options['webnus_cause_currency'] : '';
			$currency = esc_html($deep_options['webnus_cause_currency']);

			if( $amount ) {
				$uniqid = uniqid();
				$percentage 	= ($received/$amount)*100;
				$percentage 	= round($percentage);
				$out			= '<p>' . $percentage.'% '.esc_html__('DONATED OF ','deep').$currency.$amount . '</p>';
				$progressbar 	= '
					<div class="wn-cause-prgs-bar-wrap wn-cause-prgs-' . $uniqid . '">
						' . $out . '
						<div class="wn-cause-prgs-bar-bg">
							<div class="wn-cause-prgs-bar colorb"></div>
						</div>
					</div>';
					deep_save_dyn_styles( '
						.wn-cause-prgs-bar-wrap.wn-cause-prgs-' . $uniqid . ' .wn-cause-prgs-bar-bg .wn-cause-prgs-bar  {
							width: ' . $percentage . '%;
						}
					' );

			}
			

			$now = date('Y-m-d 23:59:59');
			$now = strtotime($now);
			$end_date = $end.' 23:59:59';
			$your_date = strtotime($end_date);
			$datediff = $your_date - $now;
			$days_left = floor($datediff/(60*60*24));
			$date_msg = '';
			if($days_left==0) {$date_msg = '1';}
			elseif($days_left<0) {$date_msg = 'No';}
			else {$date_msg = $days_left+'1'.'';}
			$cause_days = ($percentage<100)?'<span>'.$date_msg.'</span> '.esc_html__('Days left to achieve target','deep'):esc_html__('Thank You','deep');
			if ($type=='grid'){
				echo ($rcount == 1)?'<div class="row">':'';
				echo '<div class="wn-single-cause-gd wn-single-grid col-md-'.$col.' col-sm-'.$col.'"><article>'.$image;
				echo '<div class="cause-content">' . $title . '<p> ' . deep_excerpt(15) . ' </p>';
				echo '<div class="cause-meta">'.$progressbar.'<p class="cause-days">'.$cause_days.'</p>';
				echo '<div class="wn-cause-list-foot">';
						$deep_options['webnus_cause_social_share'] = isset( $deep_options['webnus_cause_social_share'] ) ? $deep_options['webnus_cause_social_share'] : '';

						if( $deep_options['webnus_cause_social_share'] ) {
							$dashed_title =  sanitize_title_with_dashes ( get_the_title() );
							?>
						<div class="wn-cause-sharing">
							<ul class="wn-cause-sharing-icons">
								<li class="wn-wrap-social hcolorb"><i class="pe-7s-share"></i>
									<ul>
										<li class="hcolorb"><a class="facebook" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php $dashed_title; ?>" target="blank"><i class="sl-social-facebook"></i></a></li>
										<li class="hcolorb"><a class="google" href="https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url=<?php the_permalink(); ?>" target="_blank"><i class="sl-social-google"></i></a></li>
										<li class="hcolorb"><a class="twitter" href="https://twitter.com/intent/tweet?original_referer=<?php the_permalink(); ?>&amp;text=<?php $dashed_title; ?>&amp;tw_p=tweetbutton&amp;url=<?php the_permalink(); ?><?php echo isset( $twitter_user ) ? '&amp;via='.$twitter_user : ''; ?>" target="_blank"><i class="sl-social-twitter"></i></a></li>
									</ul>
								</li>
								<li class="single-mail hcolorb"><a class="email" href="mailto:?subject=<?php $dashed_title; ?>&amp;body=<?php the_permalink(); ?>"><i class="pe-7s-mail"></i></a></li>
							</ul>
						</div>

					<?php if($days_left>=0 && $percentage<100 && $deep_options['webnus_donate_form']){
						echo deep_modal_donate();
					}else{
						echo '<p class="cause-completed">'.esc_html__('Has been completed','deep').'</p>';
					} ?>
					</div></div>
					<?php }
				echo '</div></article></div>';
				if($rcount == $row){
					echo '</div>';
					$rcount = 0;
				}
				$rcount++;
			} elseif ($type=='grid2'){
				echo ($rcount == 1)?'<div class="row">':'';
				echo '<div class="wn-single-cause-gd wn-single-grid2 col-md-'.$col.' col-sm-'.$col.'"><article>'.$image;
				echo '<div class="cause-content">' . $title . '<p class="cause-days">'.$cause_days.'</p>';
				echo '<div class="cause-meta"><p> ' . deep_excerpt(15) . ' </p>'.$progressbar.'';
				echo '<div class="wn-cause-list-foot">';
						$deep_options['webnus_cause_social_share'] = isset( $deep_options['webnus_cause_social_share'] ) ? $deep_options['webnus_cause_social_share'] : '';

					if($days_left>=0 && $percentage<100 && $deep_options['webnus_donate_form']){
						echo deep_modal_donate();
					} else{
						echo '<p class="cause-completed">'.esc_html__('Has been completed','deep').'</p>';
					} ?>
					</div>
					<?php
				echo '</div></article></div>';
				if($rcount == $row){
					echo '</div>';
					$rcount = 0;
				}
				$rcount++;
			} elseif ($type=='list') {
				echo '<article class="wn-single-cause-gd" id="post-'.$post_id.'">
						<div class="row">
							<div class="col-md-4 wn-ca-list-left">';
				echo ($image)?'<figure class="cause-img">'.$image2.'':'';
									echo '<div class="postmetadata">
											<ul class="cause-metadata">';
											$deep_options['webnus_cause_views'] = isset( $deep_options['webnus_cause_views'] ) ? $deep_options['webnus_cause_views'] : '';
											if($deep_options['webnus_cause_views']){ ?>
											<li  class="cause-views"> <i class="sl-eye"></i><span><?php echo deep_getViews($post_id); ?></span></li>
											<?php }
											$deep_options['webnus_cause_comments'] = isset( $deep_options['webnus_cause_comments'] ) ? $deep_options['webnus_cause_comments'] : '';
											if($deep_options['webnus_cause_comments']){ ?>
											<li class="cause-comments"><i class="ti-comment"></i><span><?php comments_number(); ?></span> </li>
											<?php }
									echo '</ul></div></figure>
							</div>
							<div class="col-md-8 wn-ca-list-right">
								<div class="cause-content">
									'.$title.'
									<div class="postmetadata">';
				?>
										<ul class="cause-metadata">
											<?php
											$deep_options['webnus_cause_date'] = isset( $deep_options['webnus_cause_date'] ) ? $deep_options['webnus_cause_date'] : '';
											if($deep_options['webnus_cause_date']){ ?>
											<li class="cause-date"><i class="ti-calendar"></i><span><?php the_time('F d, Y') ?></span> </li>
											<?php }
											$deep_options['webnus_cause_category'] = isset( $deep_options['webnus_cause_category'] ) ? $deep_options['webnus_cause_category'] : '';
											if($deep_options['webnus_cause_category']){ ?>
											<li class="cause-comments"><i class="ti-folder"></i><span><?php the_terms($post_id, 'cause_category', '',' | ','' ); ?></span> </li>
											<?php } ?>
										</ul>
									</div>
				<?php echo '' . $content.'<div class="cause-meta">'.$progressbar;
				echo '<div class="wn-cause-list-foot">';
					if($days_left>=0 && $percentage<100 && $deep_options['webnus_donate_form']){
						echo deep_modal_donate();
					} else {
						echo '<p class="cause-completed">'.esc_html__('Has been completed','deep').'</p>';
					}
						$deep_options['webnus_cause_social_share'] = isset( $deep_options['webnus_cause_social_share'] ) ? $deep_options['webnus_cause_social_share'] : '';

						if( $deep_options['webnus_cause_social_share'] ) {
							$dashed_title =  sanitize_title_with_dashes ( get_the_title() );
							$dashed_blog_info_name =  sanitize_title_with_dashes ( get_bloginfo( 'name' ) );?>
						<div class="wn-cause-sharing">
							<ul class="wn-cause-sharing-icons">
								<li class="wn-wrap-social"><i class="pe-7s-share"></i>
									<ul>
										<li><a class="facebook" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php echo esc_html( $dashed_title ); ?>" target="blank"><i class="sl-social-facebook"></i></a></li>
										<li><a class="google" href="https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url=<?php the_permalink(); ?>" target="_blank"><i class="sl-social-google"></i></a></li>
										<li><a class="twitter" href="https://twitter.com/intent/tweet?original_referer=<?php the_permalink(); ?>&amp;text=<?php echo esc_html( $dashed_title ); ?>&amp;tw_p=tweetbutton&amp;url=<?php the_permalink(); ?><?php echo isset( $twitter_user ) ? '&amp;via='.$twitter_user : ''; ?>" target="_blank"><i class="sl-social-twitter"></i></a></li>
									</ul>
								</li>
								<li class="single-mail"><a class="email" href="mailto:?subject=<?php echo esc_html( $dashed_title ); ?>&amp;body=<?php the_permalink(); ?>"><i class="pe-7s-mail"></i></a></li>
							</ul>
						</div>
				<?php } // end wn-cause-sharing
				echo '</div>'; // end wn-cause-list-foot
				echo '</div>'; // end cause-meta
				echo '</div>'; // end cause-content
				echo '</div>'; // end col-md-8
				echo'</div>'; // end row
				echo'</article>';
			} elseif ($type=='list2') {
				echo '<article class="wn-single-cause-gd" id="post-'.$post_id.'">
						<div class="row">
							<div class="col-md-4 wn-ca-list-left">';
				$thumbnail_id  = get_post_thumbnail_id();
				$thumbnail_url = get_the_post_thumbnail_url();
				if( !empty( $thumbnail_url ) ) {
					// if main class not exist get it
					if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
						require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
					}
					$image = new \Wn_Img_Maniuplate; // instance from settor class
					$thumbnail_url = $image->m_image( $thumbnail_id , $thumbnail_url , '420' , '280' ); // set required and get result
				}
				if ($thumbnail_url){
				echo '<figure class="cause-img"><img src="'.$thumbnail_url.'"></figure>';
					}?>
						</div>
							<div class="col-md-8 wn-ca-list-right">
								<div class="cause-content">
									<div class="postmetadata">
										<ul class="cause-metadata">
											<?php
											$deep_options['webnus_cause_date'] = isset( $deep_options['webnus_cause_date'] ) ? $deep_options['webnus_cause_date'] : '';
											if($deep_options['webnus_cause_date']){ ?>
											<li class="cause-date"><i class="ti-calendar"></i><span><?php the_time('F d, Y') ?></span> </li>
											<?php }
											$deep_options['webnus_cause_category'] = isset( $deep_options['webnus_cause_category'] ) ? $deep_options['webnus_cause_category'] : '';
											if($deep_options['webnus_cause_category']){ ?>
											<li class="cause-comments"><i class="ti-folder"></i><span><?php the_terms($post_id, 'cause_category', '',' | ','' ); ?></span> </li>
											<?php }
											$deep_options['webnus_cause_comments'] = isset( $deep_options['webnus_cause_comments'] ) ? $deep_options['webnus_cause_comments'] : '';
											if($deep_options['webnus_cause_comments']){ ?>
											<li class="cause-comments"><i class="ti-comment"></i><span><?php comments_number(); ?></span> </li>
											<?php }
											$deep_options['webnus_cause_views'] = isset( $deep_options['webnus_cause_views'] ) ? $deep_options['webnus_cause_views'] : '';
											if($deep_options['webnus_cause_views']){ ?>
											<li  class="cause-views"> <i class="sl-eye"></i><span><?php echo deep_getViews($post_id); ?></span></li>
											<?php } ?>

										</ul>
									</div>
									<div class="days-left">
										<?php echo '' . $cause_days = ($percentage < 100) ? '<strong>' . $date_msg . esc_html__('Days left','deep') . '</strong><div>' . esc_html__('to achieve target','deep') . '</div>' : esc_html__('Thank You','deep'); ?></div>
									<?php  echo '' . $title;?>
				<?php echo '' . $content.'<div class="cause-meta">'.$progressbar;
				echo '<div class="wn-cause-list-foot">';
						$deep_options['webnus_cause_social_share'] = isset( $deep_options['webnus_cause_social_share'] ) ? $deep_options['webnus_cause_social_share'] : '';

						if($days_left>=0 && $percentage<100 && $deep_options['webnus_donate_form']){
							echo deep_modal_donate();
						} else {
							echo '<p class="cause-completed">'.esc_html__('Has been completed','deep').'</p>';
						}
						echo '</div></div></article>';
			}
		endwhile;
		echo(($type=='grid2')&&($rcount !=1))?'</div>':'';
		echo "</div>";

	if($page){ ?>
		<section class="clearfix aligncenter">
			<?php
				if(function_exists('wp_pagenavi')) {
					wp_pagenavi( array( 'query' => $query ) );
				} else {
					echo '<p>' . esc_html__( 'Please install the WP-PageNavi WordPress plugin', 'deep' ) . '</p>';
				}
			?>
			<hr class="vertical-space2">
		</section>
		<?php }

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