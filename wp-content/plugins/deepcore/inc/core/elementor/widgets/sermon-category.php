<?php
namespace Elementor;
class Webnus_Element_Widgets_Sermon_Category extends \Elementor\Widget_Base {

	/**
	 * Retrieve Sermon Category widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'sermon-category';

	}

	/**
	 * Retrieve Sermon Category widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Sermon Category', 'deep' );

	}

	/**
	 * Retrieve Sermon Category widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-editor-quote'; // Temporary Icon

	}

	public function get_style_depends() {

		return [ 'wn-deep-sermon-category' ];

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
	 * Register Sermon Category widget controls.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		// get sermon categoies
		$args = array(
				'type'         => 'sermon',
				'child_of'     => 0,
				'parent'       => '',
				'orderby'      => 'term_group',
				'hide_empty'   => false,
				'hierarchical' => 1,
				'exclude'      => '',
				'include'      => '',
				'number'       => '',
				'taxonomy'     => 'sermon_category',
				'pad_counts'   => false
		);

		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		if ( is_plugin_active( 'webnus-sermons/webnus-sermons.php' ) ) {

				$categories = get_categories( $args );
				// get category name
				$webnus_sermon_categories   = array();
				$webnus_sermon_categories_name   = array();
				foreach( $categories as $category ) :
					$webnus_sermon_categories[] = $category->slug;
					$webnus_sermon_categories_name[] = $category->name;
				endforeach;
				$category_array  = array_combine($webnus_sermon_categories, $webnus_sermon_categories_name);

		}


    // Content Tab
		$this->start_controls_section(
			'content_section',
			[
				'label' 		=> esc_html__( 'General', 'deep' ),
				'tab' 			=> \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		// Category Select
		$this->add_control(
			'category',
			[
				'label' 		=> esc_html__( 'Select Category', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT,
				'description' 	=> esc_html__( 'Select specific category', 'deep'),
				'options'		=> $category_array,
			]
		);

		// Category Image
		$this->add_control(
			'image',
			[
				'label' 		=> esc_html__( 'Select Category Image', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
				'description' 	=> esc_html__( 'Select Image for your category.', 'deep'),
				'default' 		=> [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'thumbnail',
			[
				'label' => esc_html__( 'Image Size', 'deep' ),
				'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
				'description' => esc_html__( 'Enter image size (Example: 200x100 (Width x Height)).', 'deep' ),
				'default' => [
					'width' => '',
					'height' => '',
				],
			]
		);

    $this->end_controls_section();

		// Class & ID Tab
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
				'selector' 	=> '#wrap {{WRAPPER}} .sermon-category-box .sermon-category-name',
			]
		);

		$this->add_control(
			'title_color', //param_name
			[
				'label' 		=> __( 'Color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .sermon-category-box .sermon-category-name' => 'color: {{VALUE}} !important',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_count_style',
			[
				'label' => __( 'Count style', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'count_typography',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .sermon-category-box .sermon-category-count',
			]
		);

		$this->add_control(
			'count_color', //param_name
			[
				'label' 		=> __( 'Color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .sermon-category-box .sermon-category-count' => 'color: {{VALUE}} !important',
				],
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
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .sermon-category-parent',
			]
		);

		$this->add_control(
			'box_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .sermon-category-parent' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'box_shadow',
					'label' => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .sermon-category-parent',
				]
		);

		$this->add_control(
			'box_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .sermon-category-parent' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .sermon-category-parent' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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

		$settings = $this->get_settings();

		$shortcodeclass		= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
		$shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';
		$category 			= get_term_by( 'slug', $settings['category'] , 'sermon_category' );
		$image_url 			= ($settings['image']['url']) ? $settings['image']['url'] : '';
		$category_link		= isset( $category ) ? esc_url( get_category_link( $category ) ) : '';

		if ( !empty( $settings['thumbnail']['width'] ) || !empty( $settings['thumbnail']['height'] ) ) {
			// if main class not exist get it
			if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
				require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
			}

			$image = new \Wn_Img_Maniuplate; // instance from settor class

			$image_url = $image->m_image( $settings['image']['id'] , $settings['image']['url'] , $settings['thumbnail']['width'] , $settings['thumbnail']['height'] ); // set required and get result
		}

		$out = '
		    <div class="sermon-category-parent ' . $shortcodeclass . '"  ' . $shortcodeid . '>
		        <a href="' . $category_link . '" title="' . esc_attr( sprintf( esc_html__( '%s category', 'deep' ), $category->name ) ) . '">
		            <img src="'.$image_url.'">
		            <div class="sermon-overlay colorb"></div>
		            <div class="sermon-category-box">
		                <div class="sermon-category-name">
		                    '.esc_html( $category->name ).'
		                </div>
		                <div class="sermon-category-count">
		                    '. esc_html( 'sermons' , 'deep' ) . ' ' . '(' . esc_html( $category->count ) . ')' .'
		                </div>
		            </div>
		        </a>
		    </div>
		';

        $custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}

		echo $out;
	}
}
