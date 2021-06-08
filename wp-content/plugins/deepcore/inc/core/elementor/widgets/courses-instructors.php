<?php
namespace Elementor;

class Webnus_Element_Course_Instructors extends \Elementor\Widget_Base {

	/**
	 * Retrieve Distance widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'course-instructors';

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

		return esc_html__( 'Course Instructors', 'deep' );

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

		return 'eicon-person';

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
			'view',
			[
				'label'			=> __( 'Type', 'deep' ),
				'description'	=> __( 'You can choose from these pre-designed types', 'deep' ),
				'type'			=> \Elementor\Controls_Manager::SELECT,
				'options'		=> [
					'1'	=> __( 'New Instructors', 'deep' ),
					'2'	=> __( 'Popular Instructors', 'deep' ),
					'3'	=> __( 'Top Rated Instructorsr', 'deep' ),
					'4'	=> __( 'Most Active Instructors', 'deep' ),
				],
				'default'		=> '1',
			]
		);

		$this->add_control(
			'count',
			[
				'label' 		=> __( 'Instructors Count', 'deep' ),
				'description' 	=> __( 'Number of instructor(s) to show.', 'deep' ),
				'type'			=> \Elementor\Controls_Manager::NUMBER,
				'min'			=> 1,
				'max'			=> 300,
				'step'			=> 1,
				'default'		=> 4,
			]
		);

		$this->add_control(
			'page',
			[
				'label'			=> __( 'Page Navigation', 'deep' ),
				'type'			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on'		=> __( 'Show', 'deep' ),
				'label_off'		=> __( 'Hide', 'deep' ),
				'return_value'	=> 'yes',
				'default'		=> 'no',
			]
		);

		$this->add_control(
			'display_as_carousel',
			[
				'label'			=> __( 'Carousel Preview', 'deep' ),
				'type'			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on'		=> __( 'Show', 'deep' ),
				'label_off'		=> __( 'Hide', 'deep' ),
				'return_value'	=> 'yes',
				'default'		=> 'no',
			]
		);

		$this->add_control(
			'carousel_items',
			[
				'label' 		=> __( 'Instructors items per view', 'deep' ),
				'description' 	=> __( 'Number of instructor(s) to show.', 'deep' ),
				'type'			=> \Elementor\Controls_Manager::NUMBER,
				'min'			=> 1,
				'max'			=> 4,
				'step'			=> 1,
				'default'		=> 3,
				'condition'		=> [
					'display_as_carousel' => [
						'yes'
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
		$view					= $settings['view'];
		$count					= $settings['count'];
		$page					= $settings['page'];
		$display_as_carousel	= $settings['display_as_carousel'];
		$carousel_items			= $settings['carousel_items'];

		if($view) {
			switch($view){
				case '1':
					$orderby = 'ID';
					$meta_key = 'instructor_is';
				break;
				case '2':
					$orderby = 'meta_value_num';
					$meta_key = 'instructor_students';
				break;
				case '3':
					$orderby = 'meta_value_num';
					$meta_key = 'instructor_rate';
				break;
				case '4':
					$orderby = 'meta_value_num';
					$meta_key = 'instructor_courses';
				break;
			}
			GLOBAL $post;
			$wp_instructors= new \WP_User_Query( array(
				'role__in' => array('Administrator','Editor','Author','Contributer'),
				'has_published_posts' => true,
			));
			$instructors = $wp_instructors->get_results();
			if(!empty($instructors)) {
				foreach ($instructors as $instructor){
					deep_instructor_update($instructor->ID);
				}
			}
			$rcount = 1;
			$count=($count==0)?4:$count;
			$paged = ( get_query_var('paged') ) ? get_query_var('paged') : (( get_query_var('page') ) ? get_query_var('page') : 1);
			if ( $display_as_carousel == 'no' ) {
			echo '<div class="courses-instructors">';
			} else {
			echo '<div class="courses-instructors">';
			}
				$arg = array (
				'number' => $count,
				'order' => 'DESC',
				'orderby' => $orderby,
				'meta_key' => $meta_key,
				'offset' => (($paged - 1) * $count),
				'has_published_posts' => true,
			);
			$wp_user_query = new \WP_User_Query($arg);
			$authors = $wp_user_query->get_results();
			if (!empty($authors)) {
				foreach ( $authors as $user) {
					$instructor_avatar = get_avatar( get_the_author_meta( 'user_email',$user->ID ), 265 );
					$instructor_title = '<a class="hcolorf" href="'.get_author_posts_url( $user->ID ).'">'.get_the_author_meta( 'display_name',$user->ID ).'</a>';
					$instructor_biography = get_the_author_meta( 'biography',$user->ID );
					$facebook = esc_url(get_the_author_meta( "facebook",$user->ID));
					$twitter = esc_url(get_the_author_meta( "twitter",$user->ID));
					$google_plus = esc_url(get_the_author_meta( "googleplus",$user->ID));
					$linkedin = esc_url(get_the_author_meta( "linkedin",$user->ID));
					$youtube = esc_url(get_the_author_meta( "youtube",$user->ID));
					$title = get_the_author_meta( "title",$user->ID);
					$instructor_email = get_the_author_meta( 'display_email' , $user->ID);
					$url = esc_url(get_the_author_meta( "url",$user->ID));

					// carousel variables
					$carousel_classes = $carousel_items_data = '';
					if ( $display_as_carousel == 'yes' ) :
						$carousel_classes	 = ' instructors-owl-carousel owl-carousel owl-theme';
						$carousel_items_data = ' data-instructors-count="' . $carousel_items . '"';
					endif;

					if ( $display_as_carousel == 'no' ) {
						echo ($rcount == 1)?'<div class="clearfix">':'';
					} else {
						echo ($rcount == 1) ? '<div class="clearfix' . $carousel_classes . '"' . $carousel_items_data . '>' : '';
					}
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
					if ( $display_as_carousel == 'no' ) {
					echo '<div class="'. $column.'">';
					}
					echo '<article class="course-instructor"><a href="'.get_author_posts_url( $user->ID ).'"><figure>'.$instructor_avatar .'</figure></a>';
					echo '<div class="inst-detail">
					<span class="inst-tip colorf" title="' . esc_html__('Total Courses:','deep') . ' ' . get_the_author_meta( 'instructor_courses',$user->ID).'"><i title="" class="sl-book-open"></i></span>
					<span class="inst-tip colorf" title="' . esc_html__('Total Students:','deep') . ' ' . get_the_author_meta( 'instructor_students',$user->ID).'">
					<i title="" class="sl-people"></i>
					</span>
					<span class="inst-tip colorf" title=" ' . esc_html__('Total Rates:','deep') . ' ' . get_the_author_meta( 'instructor_rate',$user->ID) . '">
					<i title="" class="sl-star"></i>
					</span>
					</div>';
					echo '<div class="inst-desc"><h3>'. $instructor_title .'</h3><h5 class="colorf">'.$title.'</h5><p>'.$instructor_biography.'</p></div>';
					echo '<ul class="inst-social">';
					echo ($url)?'<li><a href="'.$url.'" target="_blank"><i class="fa-globe"></i></a></li>':'';
					echo ($instructor_email)?'<li><a href="mailto:'.$instructor_email.'"><i class="fa-envelope"></i></a></li>':'';
					echo ($facebook)?'<li><a href="'.$facebook.'"><i class="fa-facebook" target="_blank"></i></a></li>':'';
					echo ($twitter)?'<li><a href="'.$twitter.'"><i class="fa-twitter" target="_blank"></i></a></li>':'';
					echo ($linkedin)?'<li><a href="'.$linkedin.'"><i class="fa-linkedin" target="_blank"></i></a></li>':'';
					echo ($google_plus)?'<li><a href="'.$google_plus.'"><i class="fa-google-plus" target="_blank"></i></a></li>':'';
					echo ($youtube)?'<li><a target="_blank" href="'.$youtube.'"><i class="fa-youtube" target="_blank"></i></a></li>' : '';
					echo '</ul>';
					echo '</article>';
					if ( $display_as_carousel == 'no' ) {
						echo '</div>'; // end col-md-*
					}
					if ( $display_as_carousel == 'no' ) {
						if($rcount == $row){
							echo '</div>'; // end row
							$rcount = 0;
						}
						$rcount++;
					} else {
						$rcount = 0;
					}
				}

				if ( $display_as_carousel == 'yes' ) {
					echo '</div>'; // end row carousel
				}
			}
			echo '</div>';
			if ( $display_as_carousel == 'no' ) {
				if($page){
					global $wp_rewrite;
					$pagination_args = array(
						'base' => @add_query_arg('paged','%#%'),
						'format' => '',
						'total' => ceil($wp_user_query->get_total() / $count),
						'current' => $paged,
						'show_all' => false,
						'type' => 'plain',
					);
					if( $wp_rewrite->using_permalinks() )
						$pagination_args['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s',get_pagenum_link(1) ) ) . 'page/%#%/', 'paged');
					if( !empty($wp_query->query_vars['s']) )
						$pagination_args['add_args'] = array('s'=>get_query_var('s'));
					$links = paginate_links($pagination_args);
					echo '<div class="wp-pagenavi">'.$links.'</div>';
				}
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
}
