<?php
namespace Elementor;

class Webnus_Element_Courses extends \Elementor\Widget_Base {

	/**
	 * Retrieve Distance widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'courses';

	}

	/**
	 * Retrieve Distance widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Courses', 'deep' );

	}

	/**
	 * Retrieve Distance widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-document-file';

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
	 * enqueue JS
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_script_depends() {

		return [ 'deep-owl-carousel' ];

	}

	/**
	 * enqueue styles.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'deep-owl-carousel' ];

	}

	/**
	 * Register Distance widget controls.
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
				'tab' => Controls_Manager::TAB_CONTENT,
            ]
		);

		$this->add_control(
			'type',
			[
				'label'			=> __( 'Type', 'deep' ),
				'description'	=> __( 'You can choose from these pre-designed types.', 'deep' ),
				'type'			=> \Elementor\Controls_Manager::SELECT,
				'options'		=> [
					'list'		=> __( 'List', 'deep' ),
					'grid'		=> __( 'Grid', 'deep' ),
					'modern'	=> __( 'Modern', 'deep' ),
					'table'		=> __( 'Table', 'deep' ),
					'carousel'	=> __( 'Carousel', 'deep' ),
				],
				'default'		=> 'list',
			]
		);
		$this->add_control(
			'sort',
			[
				'label'			=> __( 'Order by', 'deep' ),
				'description'	=> __( 'Recent Or Popular.', 'deep' ),
				'type'			=> \Elementor\Controls_Manager::SELECT,
				'options'		=> [
					''		=> __( 'Most Recent', 'deep' ),
					'view'		=> __( 'View', 'deep' ),
				],
				'default'		=> '',
			]
		);
		$this->add_control(
			'count',
			[
				'label' 		=> __( 'Post Count', 'deep' ),
				'description' 	=> __( 'Number of course(s) to show.', 'deep' ),
				'type'			=> \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'item_carousel',
			[
				'label' 		=> __( 'Carousel Item', 'deep' ),
				'description' 	=> __( 'Number of course(s) to show.', 'deep' ),
				'type'			=> \Elementor\Controls_Manager::TEXT,
				'default'		=> 3,
				'condition'		=> [
					'type'		=> [
						'carousel'
					]
				]
			]
		);
		$this->add_control(
			'page',
			[
				'label'			=> __( 'Page Navigation', 'deep' ),
				'type'			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on'		=> __( 'Show', 'deep' ),
				'label_off' 	=> __( 'Hide', 'deep' ),
				'return_value'	=> 'yes',
				'default'		=> 'yes',
				'condition'		=> [
					'type'		=> [
						!'carousel'
					]
				]
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


	}

	/**
	 * Render Distance widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings				= $this->get_settings();
		// $post					= $settings['post'];

		$type 			= $settings['type'];
		$category 		= (!empty( $settings['category'] ) ? $settings['category'] : '');
		$count 			= $settings['count'];
		$page 			= $settings['page'];
		$sort 			= $settings['sort'];
		$icon 			= (!empty( $settings['icon'] ) ? $settings['icon'] : '');
		$item_carousel 	= $settings['item_carousel'];
		ob_start();
		$deep_options = deep_options();
		$view =($sort=='view')?"'&orderby=meta_value_num&meta_key=deep_views":"";
		$paged = ( is_front_page() ) ? 'page' : 'paged' ;
		$pages = ($page)?'&paged='.get_query_var($paged):'&paged=1';
		if(empty($count)){
			$count=1;
		}
		$query = new \WP_Query('post_type=course&posts_per_page='.$count.'&category_name='.$category.$pages.$view);
		$rcount= 1 ;
		$crsl = $crsl_items = '';
		if ( $type == 'carousel'){
			$crsl = ' course-carousel courses-modern llms-course-list';
			$crsl_items = ' data-items="' . $item_carousel . '"';
		}
		$startrow = ( $type == 'carousel' ) ? '<div class="row">' : '' ;
		echo $startrow;
		?>
		<div class="container courses-<?php echo $type . $crsl; ?>"<?php echo $crsl_items; ?>>

		<?php while ($query -> have_posts()) : $query -> the_post();
			$post_id = get_the_ID();
			$terms_slug_str = get_the_author_meta( 'display_name' );
			$cats_slug_str ='';
			if (taxonomy_exists('course_cat')){
				$cats = get_the_terms(get_the_id(), 'course_cat' );
				if(is_array($cats)){
					$course_cat = array();
					foreach($cats as $cat){
						$course_cat[] = $cat->slug;
					}
				}else{
					$course_cat=array();
				}
				$cats_slug_str = '';
				if ($cats && ! is_wp_error($cats)) :
					$cat_slugs_arr = array();
				foreach ($cats as $cat) {
					$cat_slugs_arr[] = '<a href="'. get_term_link($cat, 'course_cat') .'">' . $cat->name . '</a>';
				}
				$cats_slug_str = implode( ", ", $cat_slugs_arr);
				endif;
				$category = ($cats_slug_str)?esc_html__('Category: ','deep') . $cats_slug_str:'';
				if(function_exists('tax_icons_output_term_icon') && $cats){
					$cat_icon = tax_icons_output_term_icon( $cats[0]->term_id )? tax_icons_output_term_icon( $cats[0]->term_id ):'';
				}else{
					$cat_icon = '';
				}
			}
			$content ='<p>'.deep_excerpt(36).'</p>';
			$date = get_the_time('F d, Y');
			$instructor = ($terms_slug_str)?esc_html__('Instructor: ','deep') . $terms_slug_str:'';
			$title = get_the_title();
			$button=($type=='toggle')?'button dark-gray medium':'';
			$course_start=$course_duration='';
			$course_start = get_post_meta( $post_id, '_llms_start_date', true );
			$course_duration = get_post_meta( $post_id, '_llms_length', true );
			$image = get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'deep_blog3_img','echo'=>false, ) );
			$image_m = get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'deep_blog2_img','echo'=>false, ) );
			$no_img = get_template_directory_uri().'/images/course_no_image_l.png';
			$no_img_m = get_template_directory_uri().'/images/course_no_image.png';

			$n_students = new \LLMS_Student_Query( array(
				'statuses' => 'enrolled'
			) );
			$course_students = $n_students->found_results;

			if ($type=='list'){ ?>
				<article class="w-course-list"><div class="clearfix">
				<div class="col-md-4 course-list-border-right">
					<?php echo ($cats_slug_str)?'<h6 class="course-list-cat">'. $cat_icon .$cats_slug_str.'</h6>':'';
					echo ($image)?'<figure>'.$image.'</figure>':'<figure><img src="'. $no_img .'" alt="Placeholder" class="w-no-img" /></figure>';?>
				</div>
				<div class="col-md-8"><div class="course-list-content">
					<h5><a href="<?php the_permalink();?>"><?php echo $title;?></a></h5>
					<?php
						echo '<div class="course-list-price">';
								deep_michigan_course_price();
						echo '</div>';
						echo $content;
					?>
				</div></div>
				</div><div class="clearfix"><div class="col-md-4 course-list-border-right"><div class="course-list-review">
				<?php if(function_exists('the_ratings')) {
					echo expand_ratings_template('<span class="rating">%RATINGS_IMAGES%</span> <strong>(%RATINGS_USERS% '.esc_html__('Reviews','deep').')</strong>', get_the_ID());
				} ?>
				</div></div><div class="col-md-8 nopad-all"><div class="course-list-meta"><div class="clearfix">
				<?php
				if( is_plugin_active( 'lifterlms/lifterlms.php') ){
					global $course;
					echo ($length_html = get_post_meta( get_the_ID(), '_llms_length', true ))?'<div class="col-md-2 col-sm-2 col-xs-6"><span class="course-list-duration"><i class="sl-clock"></i>'.$length_html.'</span></div>':'';
				}
				echo '<div class="col-md-4 col-sm-4 col-xs-6"><div class="course-list-instructor"><i class="sl-user"></i>'.get_the_author().'</div></div>';
				echo ($course_students)?'<div class="col-md-3 col-sm-3 col-xs-6"><div class="course-list-students"><i class="sl-people"></i>'.$course_students .' '. esc_html__('Studesnts','deep').'</div></div>':'';
				echo '<div class="col-md-3 col-sm-3 col-xs-6"><span class="modern-viewers"><i class="sl-eyeglass"></i>'.deep_getViews(get_the_ID()) .' '. esc_html__('Viewers','deep').'</span></div>';
				?>
				</div></div></div></div></article>
				<?php }
				else if ($type=='grid'){
					echo ($rcount == 1)?'<div class="row">':'';
						if($count<5){
							$col=12/$count;
							$column='col-md-'.$col;
						}elseif($count%4==0){
							$col=3;
							$column='col-md-3 col-sm-6';
						}else{
							$col=4;
							$column='col-md-4 col-sm-4';
						}
						$row = 12/$col;
					echo '<div class="'.$column.'">';
					$image = get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'deep_blog3_img','echo'=>false, ) );
					$image_media = $abs_class = '';
					if($image){
						$image_media = '<figure>'.$image.'</figure>';
						$abs_class = ' abs-top';
					}?>

						<article>
							<?php
							echo'<div class="mc-price colorf">';
								deep_michigan_course_price();
							echo '</div>';
							echo $image_media;?>
							<div class="mc-content">
								<h6 class="course-cat"><?php echo $category;?></h6>
								<h5><a href="<?php the_permalink();?>" class="hcolorf"><?php echo $title;?></a></h5>
								<div class="postmetadata">
									<h6 class="course-inst"><?php echo $instructor;?></h6>
								</div>
								<p><?php echo $content;?></p>
							</div>
							<div class="mc-detail">
								<div class="mc-detail-d">
									<div class="mc-time">
										<h6><?php esc_html_e('Start Time:','deep');?></h6>
										<span><?php echo $course_start;?></span>
									</div>
									<div class="mc-duration">
										<h6><?php esc_html_e('Duration:','deep');?></h6>
										<span><?php echo $course_duration;?></span>
									</div>
								</div>
							</div>
						</article>
					<?php
						echo '</div>';
						if($rcount == $row){
							echo '</div>';
							$rcount = 0;
						}
						$rcount++;
				}
				else if ($type=='modern' || $type=='carousel'){
					if ( $type == 'modern' ) {
						echo ($rcount == 1)?'<div class="row">':'';
						if($count<5){
							$col=12/$count;
							$column='col-md-'.$col.' col-sm-'.$col;
						}elseif($count%4==0){
							$col=3;
							$column='col-md-3 col-sm-6';
						}else{
							$col=4;
							$column='col-md-4 col-sm-4';
						}
						$row = 12/$col;
						echo '<div class="'. $column.'">';
					}
					$image = get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'deep_blog3_img','echo'=>false, ) );
					$image_media = $abs_class = '';
					if($image){
						$image_media = '<figure>'.$image.'</figure>';
						$abs_class = ' abs-top';
					} ?>

					<article class="modern-grid llms-course-list">
						<div class="llms-course-link">
							<?php echo ($cats_slug_str)?'<div class="modern-cat">'. $cat_icon .$cats_slug_str.'</div>':''; ?>
							<div class="modern-feature">
								<?php echo ($image_m)? $image_m :'<img src="' . $no_img_m . '" alt="Placeholder" class="w-no-img" />';
								echo ($course_duration)?'<span class="modern-duration">'.$course_duration.'<i class="fa fa-clock-o"></i></span>':''; ?>
							</div>
							<div class="modern-content">
								<h3 class="llms-title"><a href="<?php the_permalink();?>" class="hcolorf"><?php echo $title;?></a></h3>
								<?php if(function_exists('the_ratings')){
									echo expand_ratings_template('<div class="modern-rating"><span class="rating">%RATINGS_IMAGES%</span> <strong>(%RATINGS_USERS% '.esc_html__('Reviews','deep').')</strong></div>', get_the_ID());
								}
								echo '<div class="llms-price-wrapper"><h4 class="llms-price colorf"><span>';
								deep_michigan_course_price();
								echo '</span></h4></div>'; ?>
							</div>
							<div class="clearfix modern-meta">
								<div class="col-md-8 col-sm-8 col-xs-8">
								<?php
								global $post;
								$my_post = get_post( $post->ID );
								$author_id = $my_post->post_author;
								$instructor_avatar = get_avatar( get_the_author_meta( 'user_email',$author_id ), 20 );
								$instructor_title = '<a href="'.get_author_posts_url( $author_id ).'">'.$instructor_avatar .get_the_author_meta( 'display_name',$author_id ).'</a>';
								echo '
									<div class="modern-instructor">'.
										$instructor_title
									.'</div>';
								?>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-4">
									<?php echo ($course_students)?'<span class="modern-students" title="'.esc_html__('Enrolled Students','deep').'"><i class="sl-people"></i>'.$course_students.'</span>':'<span class="modern-viewers" title="'.esc_html__('Viewers','deep').'"><i class="fa fa-eye"></i>'.deep_getViews(get_the_ID()).'</span>'; ?>
								</div>
							</div>
						</div>
					</article>
	<?php if ( $type =='modern') {?>
				</div>
				<?php if($rcount == $row){
					echo '</div>';
					$rcount = 0;
				}
				$rcount++;
	}
			}else if ($type=='table'){
					echo($rcount==1)?'<table class="w-table"><thead><tr><th class="colorb">ID</th><th class="colorb">'.esc_html__('Course Name','deep').'</th><th class="colorb">'.esc_html__('Duration','deep').'</th><th class="colorb">'.esc_html__('Start Date','deep').'</th><th class="colorb">'.esc_html__('Instructor','deep').'</th></tr></thead><tbody>':'';
					$tr_class=($rcount%2==0)?'class="even"':'';
					echo'<tr '.$tr_class.'><td>'.esc_html__('C-','deep').$post_id.'</td>'; ?>
					<td><a href="<?php echo the_permalink();?>" class="hcolorf"><?php echo $title;?></a></td>
					<?php echo '<td>'.$course_duration.'</td><td>'.$course_start.'</td><td>'.$terms_slug_str.'</td></tr>';
					$rcount++;
			}
		endwhile;
		if ($type=='table'){
			echo '</tbody></table>';
		}
		echo((($type=='grid') OR ($type=='modern'))&&($rcount !=1))?'</div>':'';
		echo "</div>";
		$endrow = ( $type == 'carousel' ) ? '</div>' : '' ;
		echo $endrow;

		if($page){
			echo '<section class="container aligncenter">';
			if(function_exists('wp_pagenavi')) {
				wp_pagenavi( array( 'query' => $query ) );
			}
			echo '<hr class="vertical-space2"></section>';
		}
		$out = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		echo $out;
		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}
	}
}
