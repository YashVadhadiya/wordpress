<?php
namespace Elementor;
class Webnus_Element_Single_Course extends \Elementor\Widget_Base {

	/**
	 * Retrieve Distance widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'single-course';
		
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

		return esc_html__( 'Single Course', 'deep' );

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
				'description'	=> __( 'You can choose among these types.', 'deep' ),
				'type'			=> \Elementor\Controls_Manager::SELECT,
				'options'		=> [
					'latest'	=> __( 'Latest Course', 'deep' ),
					'custom'	=> __( 'Custom Course', 'deep' ),
				],
				'default'		=> 'latest',
			]
		);
		$this->add_control(
			'post',
			[
				'label' 		=> __( 'Course ID', 'deep' ),
				'description' 	=> __( 'Pick up the ID & follow this instruction: admin panel > courses > ID column. Note: When you type nothing it puts latest course as default to show.', 'deep' ),
				'type'			=> \Elementor\Controls_Manager::TEXT,
				'condition'		=> [
					'type'	=> [
						'custom'
					],
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
		$post					= $settings['post'];

		ob_start();
		$args = array(
			'post_type'			=> 'course',
			'posts_per_page'	=> 1,
			'p'					=> $post,
		);
		$query = new \WP_Query($args); ?>
		<div class="container courses single-course">
		<?php
			while ($query -> have_posts()) : $query -> the_post();
				$post_id = get_the_ID();
				$terms_slug_str = get_the_author_meta( 'display_name' );
				$cats = get_the_terms( $post_id , 'course_cat' );
				if(function_exists('tax_icons_output_term_icon') && $cats){
					$cat_icon = tax_icons_output_term_icon( $cats[0]->term_id )? tax_icons_output_term_icon( $cats[0]->term_id ):'';
				}else{
					$cat_icon = '';
				}
				if(is_array($cats)){
					$course_cat = array();
					foreach($cats as $cat){
						$course_cat[] = $cat->slug;
					}
				}else $course_cat=array();
				$cats_slug_str = '';
				if ($cats && !is_wp_error($cats)) :
					$cat_slugs_arr = array();
				foreach ($cats as $cat) {
					$cat_slugs_arr[] = '<a href="'. get_term_link($cat, 'course_cat') .'">' . $cat->name . '</a>';
				}
				$cats_slug_str = implode( ", ", $cat_slugs_arr);
				endif;
				$content ='<p>'.deep_excerpt(360).'</p>';
				$title = get_the_title();
				$permalink = get_the_permalink();
				$llms_product = new \LLMS_Product( $post_id );
				$thumbnail_url = get_the_post_thumbnail_url();
				$thumbnail_id  = get_post_thumbnail_id();
				if( !empty( $thumbnail_url ) ) {
					// if main class not exist get it
					if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
						require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
					}
					$image = new \Wn_Img_Maniuplate; // instance from settor class
					$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '420' , '280' ); // set required and get result
				}
					echo '<article class="w-course-list">';
					echo '<div class="clearfix">';
					echo '<div class="col-md-4 course-list-border-right">';
					echo ($cats_slug_str)?'<h6 class="course-list-cat">'. $cat_icon .$cats_slug_str.'</h6>':'';
					echo '<figure><img src="' . $thumbnail_url . '" alt="Placeholder"></figure>';
					echo '</div>';
					echo '<div class="col-md-8"><div class="course-list-content">';
					echo '<h5><a href="'.$permalink.'">'.$title.'</a></h5>';
					echo '<div class="course-list-price colorf">';
					deep_michigan_course_price();
					echo '</div>';
					echo $content;
					echo '</div></div>';
					echo '</div>';
					echo '<div class="clearfix">';
					echo '<div class="col-md-4 course-list-border-right">';
					echo '<div class="course-list-review">';
					if(function_exists('the_ratings')) {
					echo expand_ratings_template('<span class="rating">%RATINGS_IMAGES%</span> <strong>(%RATINGS_USERS% '.esc_html__('Reviews','deep').')</strong>', get_the_ID());
					}
					echo '</div>';
					echo '</div>';
					echo '<div class="col-md-8 nopad-all"><div class="course-list-meta">';
					echo '<div class="clearfix">';
					global $course;
					$post_id = get_the_ID();
					echo ($length_html = get_post_meta( $post_id, '_llms_length', true ))?'<div class="col-md-2 col-sm-2 col-xs-6"><span class="course-list-duration"><i class="sl-clock colorf"></i>'.$length_html.'</span></div>':'';
					if ( !isset( $lesson ) ) {
						$lesson = new \LLMS_Lesson( $post_id );
						$course_id = $lesson->parent_course;
						$my_post = get_post( $course_id );
						$author_id = $my_post->post_author;
						$instructor_title = '<a href="'.get_author_posts_url( $author_id ).'">'.get_the_author_meta( 'display_name',$author_id ).'</a>';
						echo '<div class="col-md-4 col-sm-4 col-xs-6"><div class="course-list-instructor"><i class="sl-user colorf"></i>'.$instructor_title.'</div></div>';
						$lesson_max_user = get_post_meta( $post_id , '_lesson_max_user', true );
						echo ($lesson_max_user)?'<div class="col-md-3 col-sm-3 col-xs-6"><div class="course-list-students"><i class="sl-people"></i>'.$lesson_max_user .' '. esc_html__('Studesnts','deep').'</div></div>':'';
						echo '<div class="col-md-3 col-sm-3 col-xs-6"><span class="modern-viewers"><i class="sl-eyeglass colorf"></i>'.deep_getViews(get_the_ID()) .' '. esc_html__('Viewers','deep').'</span></div>';
						echo '</div>';
						echo '</div></div>';
						echo '</div>';
						echo '</article>';
					}
			endwhile;
			echo '</div>';
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