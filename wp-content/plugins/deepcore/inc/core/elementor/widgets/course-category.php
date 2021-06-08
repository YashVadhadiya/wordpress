<?php
namespace Elementor;
class Webnus_Element_Course_Category extends \Elementor\Widget_Base {

	/**
	 * Retrieve Distance widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'course-category';
		
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

		return esc_html__( 'Course Category', 'deep' );

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

		return 'eicon-gallery-grid';

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
		$cat_args = array(
			'type'			=> 'post',
			'child_of'		=> 0,
			'parent'		=> '',
			'orderby'		=> 'id',
			'order'			=> 'ASC',
			'hide_empty'	=> false,
			'hierarchical'	=> 1,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> 'course_cat',
			'pad_counts'	=> false,
		);
		$categories = get_categories( $cat_args );
		// get category name
		$webnus_course_categories	= array();
		foreach( $categories as $category ) :
			$webnus_course_categories[$category->term_id] = $category->name;
		endforeach;

		$this->add_control(
			'typ',
			[
				'label'			=> __( 'Type', 'deep' ),
				'type'			=> \Elementor\Controls_Manager::SELECT,
				'options'		=> [
					'course-category-box'	=> __( 'Type 1', 'deep' ),
					'course-category-box2'	=> __( 'Type 2', 'deep' ),
				],
				'default'		=> 'course-category-box',
			]
		);
		$this->add_control(
			'brbottom',
			[
				'label'			=> __( 'Border Bottom', 'deep' ),
				'type'			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on'		=> __( 'Show', 'deep' ),
				'label_off'		=> __( 'Hide', 'deep' ),
				'return_value'	=> 'yes',
				'default'		=> 'no',
				'condition' 	=> [
					'typ' => [
						'course-category-box2'
					],
				],
			]
		);
		$this->add_control(
			'categories',
			[
				'label'			=> __( 'Category', 'deep' ),
				'type'			=> \Elementor\Controls_Manager::SELECT,
				'multiple'		=> true,
				'default'		=> '0',
				'options'		=> $webnus_course_categories,
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

		$settings	= $this->get_settings();
		$out 		= '<div class="course-category-wrap">';
		$category   = $settings['categories'];
		$brbottom 	= $settings['brbottom'] == '' ? ' no-border' : '';
		$term       = get_term( $category, 'course_cat' );
		$term_id    = (!empty($term->term_id)) ? $term->term_id : '';
		$term_meta  = get_option("taxonomy_{$term_id}_metas");		
		$cat_icon   = (!empty($term_meta['icon'])) ? $term_meta['icon'] : '';
		
		if ( $category && $term ) {
			switch ( $settings['typ'] ) :
				case 'course-category-box':
					$course_text = ( $term->count > 1 ) ? esc_html__( 'Courses', 'deep' ) : esc_html__( 'Course', 'deep' );
					$out = '
					<div class="course-category-box">
						<a href="' . esc_url( get_category_link( $category ) ) . '" title="' . esc_attr( sprintf( __( '%s category', 'deep' ), $term->name ) ) . '">
							<div class="ccb-content colorf">
							<i class="' . $cat_icon . '"></i>
								<span class="category-name">' . esc_html( $term->name ) . '</span>
							</div>
							<div class="ccb-hover-content colorb">
								<span class="category-count">' . esc_html( $term->count ) . '</span>
								<span>' . $course_text . '</span>
							</div>
						</a>
					</div>';
				break;
	
				case 'course-category-box2':
					$brbottom = $brbottom ? '' : esc_attr( ' no-border' );
					$out = '
					<div class="course-category-box2' . $brbottom . '">
						<a href="' . esc_url( get_category_link( $category ) ) . '" title="' . esc_attr( sprintf( __( '%s category', 'deep' ), $term->name ) ) . '">
							<span class="colorf"><i class="' . $cat_icon . '"></i></span>
							<span class="category-name">' . esc_html( $term->name ) . '</span>
						</a>
					</div>';
				break;
			endswitch;
		}

		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}
		echo $out;
	}
}