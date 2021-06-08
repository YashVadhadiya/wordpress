<?php
namespace Elementor;

class Webnus_Element_Widgets_CategoryTab extends \Elementor\Widget_Base {

	/**
	 * Retrieve Info Box widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'category_tab';

	}

	/**
	 * Retrieve Info Box widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Category Tab', 'deep' );

	}

	/**
	 * Retrieve Info Box widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'ti-layout-tab-v';

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

		return [ 'deep-category-tab' ];

	}

	/**
	 * enqueue JS
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_script_depends() {

		return [ 'deep-cat-tab', 'deep-simple-pagination' ];

	}


	/**
	 * Register Info Box widget controls.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$categories = array();
		$categories = get_categories();
		$category_slug_array = array('');
		$category_name_array = array('');
		foreach( $categories as $category ) {
			$category_slug_array[] = $category->name;
			$category_name_array[] = $category->slug;
		}

		$category_array  = array_combine($category_name_array, $category_slug_array);

        // Content Tab
		$this->start_controls_section(
			'content_sectiona',
			[
				'label' => esc_html__( 'General Options', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		$this->add_control(
			'param_category',
			[
				'label' 	=> esc_html__( 'Choose Categories', 'deep' ),
				'type' 		=> \Elementor\Controls_Manager::SELECT2,
				'multiple' 	=> true,
				'options' 	=> $category_array,
			]
		);

		$this->add_control(
			'sort_order', //param_name
			[
				'label' 	=> esc_html__( 'Sort order', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'date',
				'options' 	=> [ //value
					'date'  		=> esc_html__( 'Date', 'deep' ),
					'title' 		=> esc_html__( 'Title', 'deep' ),
					'comment_count' => esc_html__( 'Popular Post', 'deep' ),
					'latest' 		=> esc_html__( 'Recent Posts', 'deep' ),
					'rand' 			=> esc_html__( 'Random Post', 'deep' ),
					'modified' 		=> esc_html__( 'Last Modified Post', 'deep' ),
				],
			]
		);

		$this->add_control(
			'p_cat', //param_name
			[
				'label' 		=> __( 'Post Category', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::SWITCHER, //type
				'label_on' 		=> __( 'Show', 'deep' ),
				'label_off' 	=> __( 'Hide', 'deep' ),
				'return_value' 	=> 'show',
			]
		);

		$this->add_control(
			'p_date', //param_name
			[
				'label' 		=> __( 'Post Date', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::SWITCHER, //type
				'label_on' 		=> __( 'Show', 'deep' ),
				'label_off' 	=> __( 'Hide', 'deep' ),
				'return_value' 	=> 'show',
			]
		);


        $this->end_controls_section();

		// Class & ID Tab
		$this->start_controls_section(
			'classid_section',
			[
				'label' => esc_html__( 'Class & ID', 'deep' ),
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

		$this->start_controls_section(
			'section_items_style',
			[
				'label' => __( 'Tab Items', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'items_typography',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .wn-category-wrap .wn-category-tab-nav li a',
			]
		);
		$this->add_control(
			'items_text_align',
			[
				'label'     => __( 'Text align', 'deep' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'deep' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'deep' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'deep' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-category-wrap .wn-category-tab-nav li a' => 'text-align: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'items_color',
			[
				'label' 		=> __( 'color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-category-wrap .wn-category-tab-nav li a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'items_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .wn-category-wrap .wn-category-tab-nav li a',
			]
		);
		$this->add_control(
			'items_padding',
			[
				'label' 		=> __( 'padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-category-wrap .wn-category-tab-nav li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'items_margin',
			[
				'label' 		=> __( 'margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-category-wrap .wn-category-tab-nav li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'items_opacity',
			[
				'label' => __( 'Opacity', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-category-wrap .wn-category-tab-nav li a' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'items_display',
			[
				'label'     => __( 'Display', 'deep' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'inherit'      => __( 'Inherit', 'deep' ),
					'inline'       => __( 'inline', 'deep' ),
					'inline-block' => __( 'inline block', 'deep' ),
					'block'        => __( 'block', 'deep' ),
					'none'         => __( 'none', 'deep' ),
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-category-wrap .wn-category-tab-nav li a' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'items_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-category-wrap .wn-category-tab-nav li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'items_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-category-wrap .wn-category-tab-nav li a',
			]
		);
		$this->add_control(
			'hover',
			[
				'label'     => __( 'Hover', 'deep' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'items_typography_hover',
				'label' 	=> __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .wn-category-wrap .wn-category-tab-nav li a:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'items_bg_hover',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .wn-category-wrap .wn-category-tab-nav li a:hover',
			]
		);
		$this->add_control(
			'items_padding_hover',
			[
				'label' 		=> __( 'padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-category-wrap .wn-category-tab-nav li a:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'items_margin_hover',
			[
				'label' 		=> __( 'margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-category-wrap .wn-category-tab-nav li a:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'items_opacity_hover',
			[
				'label' => __( 'Opacity', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-category-wrap .wn-category-tab-nav li a:hover' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'items_display_hover',
			[
				'label'     => __( 'Display', 'deep' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'inherit'      => __( 'Inherit', 'deep' ),
					'inline'       => __( 'inline', 'deep' ),
					'inline-block' => __( 'inline block', 'deep' ),
					'block'        => __( 'block', 'deep' ),
					'none'         => __( 'none', 'deep' ),
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-category-wrap .wn-category-tab-nav li a:hover' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'items_border_radius_hover',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-category-wrap .wn-category-tab-nav li a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'items_border_hover',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-category-wrap .wn-category-tab-nav li a:hover',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'box_style',
			[
				'label' => __( 'Box Style', 'deep' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'box_bg',
				'label'    => __( 'Background', 'deep' ),
				'types'    => [ 'classic' , 'gradient' ],
				'selector' => '#wrap {{WRAPPER}} .wn-category-wrap',
			]
		);
		$this->add_control(
			'box_display',
			[
				'label'     => __( 'Display', 'deep' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'inherit'      => __( 'Inherit', 'deep' ),
					'inline'       => __( 'inline', 'deep' ),
					'inline-block' => __( 'inline block', 'deep' ),
					'block'        => __( 'block', 'deep' ),
					'none'         => __( 'none', 'deep' ),
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-category-wrap' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-category-wrap',
			]
		);
		$this->add_control(
			'box_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .wn-category-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .wn-category-wrap',
				]
		);
		$this->add_control(
			'box_padding',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .wn-category-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'box_margin',
			[
				'label' 		=> __( 'Margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .wn-category-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'box_opacity',
			[
				'label' => __( 'Opacity', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-category-wrap' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'box_overflow ',
			[
				'label'     => __( 'Overflow', 'deep' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'inherit'   => __( 'inherit', 'deep' ),
					'scroll'    => __( 'scroll', 'deep' ),
					'hidden'    => __( 'hidden', 'deep' ),
					'auto' 		=> __( 'auto', 'deep' ),
					'auto'      => __( 'auto', 'deep' ),
					'visible'   => __( 'visible', 'deep' ),
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-category-wrap' => 'overflow: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'hover5',
			[
				'label'     => __( 'Hover', 'deep' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'box_bg_hover',
				'label'    => __( 'Background', 'deep' ),
				'types'    => [ 'classic' , 'gradient' ],
				'selector' => '#wrap {{WRAPPER}} .wn-category-wrap:hover',
			]
		);
		$this->add_control(
			'box_display_hover',
			[
				'label'     => __( 'Display', 'deep' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'inherit'      => __( 'Inherit', 'deep' ),
					'inline'       => __( 'inline', 'deep' ),
					'inline-block' => __( 'inline block', 'deep' ),
					'block'        => __( 'block', 'deep' ),
					'none'         => __( 'none', 'deep' ),
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-category-wrap:hover' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border_hover',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-category-wrap:hover',
			]
		);
		$this->add_control(
			'box_border_radius_hover',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .wn-category-wrap:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow_hover',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .wn-category-wrap:hover',
				]
		);
		$this->add_control(
			'box_padding_hover',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .wn-category-wrap:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'box_margin_hover',
			[
				'label' 	  => __( 'Margin', 'deep' ),
				'type' 		  => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'  => [ 'px', 'em', '%' ],
				'selectors'   => [
					'#wrap {{WRAPPER}} .wn-category-wrap:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'box_opacity_hover',
			[
				'label' => __( 'Opacity', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-category-wrap:hover' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->end_controls_section();

		// Custom css tab
		$this->start_controls_section(
			'custom_css_section',
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
	 * Render Info Box widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings 	= $this->get_settings();


		if ( is_single() || is_page() ) {
			global $post;
			$post_slug = $post->post_name;
		}

		// Class & ID
		$shortcodeclass		= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
		$shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';
		$sort_order			= !empty( $settings['sort_order'] ) ? $settings['sort_order'] : '';
		$post_number		= '8';
		static $uniqid = 0;
		$uniqid++;

		$cat_ids = '';

		if ( !empty( $settings['param_category'] ) ) :
			$arrayKeys = array_keys($settings['param_category']);
			$lastArrayKey = array_pop($arrayKeys);

			foreach ( $settings['param_category'] as $key => $value ) {
				$get_cat 	= get_category_by_slug($value);
				if ( $get_cat ) {
					if($key == $lastArrayKey) {
						$get_cat_id = $get_cat->term_id;
					} else {
						$get_cat_id = $get_cat->term_id . ',';
					}
					$cat_ids .= $get_cat_id;
				}
			}
		endif;

		$args = array(
			'post_type' 		=> 'post',
			'posts_per_page'	=> -1,
			'cat'				=> $cat_ids,
			'orderby'			=> $sort_order
		);

		$out			= '';
		$category_tab 	= new \WP_Query( $args );
		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		} ?>

		<div class="wn-category-wrap clearfix <?php echo '' . $shortcodeclass; ?>" <?php echo $shortcodeid; ?>>

			<?php if ( !empty( $settings['param_category'] ) ) {  ?>

					<ul class="wn-category-tab-nav">
						<?php $category_list = '
							<li class="active" data-cat-slug="all">
								<a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '" class="all cat-item colorf" data-param_category="all">
									' . esc_html__( 'All', 'deep' ) . '
								</a>
							</li>'; ?>

						<?php
						foreach( $settings['param_category'] as $id => $cat_slug ) {
							$get_cats = get_category_by_slug($cat_slug);
							if ( $get_cats ) {
								$get_cats_id = $get_cats->term_id;
								if ( $cat_slug != null ) {
									$category_list .='
										<li data-cat-slug="' . $cat_slug . '">
											<a href="' . get_category_link( $get_cats_id ) . '" data-cat-slug="all ' . $cat_slug . '" class="cat-item">
												' . get_the_category_by_ID( $get_cats_id ) . '
											</a>
										</li>';
								}
							}

						}

						echo '' . $category_list; ?>
					</ul> <?php
				} ?>

				<div class="wn-category-posts clearfix" data-cat-slug="all"><?php

				if ( $category_tab->have_posts() ) {

					// The 2nd Loop
					while ( $category_tab->have_posts() ) {

						$category_tab->the_post();
						// $cat_id = the_category_ID( $echo = false );

						// thumbnail
						$thumbnail_url = get_the_post_thumbnail_url( $category_tab->post->ID );
						$thumbnail_id  = get_post_thumbnail_id( $category_tab->post->ID );
						if( !empty( $thumbnail_url ) ) {
							// if main class not exist get it
							if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
								require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
							}
							$image = new \Wn_Img_Maniuplate; // instance from settor class
							$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '315' , '217' ); // set required and get result
						}

						?>
						<div class="wn-category-tab <?php echo '' . $uniqid; ?> wn-pagination active"  data-cat-slug="<?php echo get_the_terms( get_the_ID(), 'category' )[0]->slug; ?>">
							<article class="wn-category">
								<?php if( !empty($thumbnail_url) ): ?>
									<a href="<?php the_permalink() ?>">
										<img src="<?php echo '' . $thumbnail_url; ?> " alt="<?php the_title($category_tab->post->ID); ?>">
									</a>
								<?php  endif ?>
								<div class="wn-tab-cat-content">
									<?php if ( $settings['p_cat'] == 'show' ) { ?>
										<div class="wn-category-meta" style="background: <?php echo deep_category_color(); ?>;">
											<?php echo the_category(', '); ?>
										</div>
									<?php } ?>
									<?php if ( $settings['p_date'] == 'show' ) { ?>
										<div class="wn-category-date">
											<i class="pe-7s-clock"></i>
											<?php echo get_the_date(); ?>
										</div>
									<?php } ?>

									<h5 class="wn-category-title"><a class="hcolorf" href="<?php the_permalink($category_tab->post->ID); ?>"><?php the_title(); ?></a></h5>
								</div>
							</article>
						</div> <?php
					}

					wp_reset_postdata();
				}?>
			</div>
		</div>

		<?php


	}

}
