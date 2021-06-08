<?php
namespace Elementor;

class Webnus_Element_Widgets_LatestFromBlog extends \Elementor\Widget_Base {

	/**
	 * Retrieve LatestFromBlog widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'latestfromblog';

	}

	/**
	 * Retrieve LatestFromBlog widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return __( 'Webnus Latest From Blog', 'deep' );

	}

	/**
	 * Retrieve LatestFromBlog widget icon.
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
	 * enqueue JS
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_script_depends() {

		return [ 'deep-owl-carousel', 'deep-news-ticker', 'deep-latest-from-blog' ];

	}

	/**
	 * enqueue CSS
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'deep-owl-carousel', 'deep-ticker' ];

	}

	/**
	 * Register LatestFromBlog widget controls.
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

		$category_array  = array_combine($category_slug_array, $category_name_array);

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'General', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);
		$this->add_control(
			'type',
			[
				'label' 	=> __( 'Select Type', 'deep' ),
				'type' 		=> \Elementor\Controls_Manager::SELECT,
				'default' 	=> 'one',
				'options' 	=> [
					'one'  			=> __( 'One', 'deep' ),
					'two' 			=> __( 'Two', 'deep' ),
					'three' 		=> __( 'Three', 'deep' ),
					'four' 			=> __( 'Four', 'deep' ),
					'five' 			=> __( 'Five', 'deep' ),
					'six' 			=> __( 'Six', 'deep' ),
					'seven' 		=> __( 'Seven', 'deep' ),
					'eight' 		=> __( 'Eight', 'deep' ),
					'nine' 			=> __( 'Nine', 'deep' ),
					'ten' 			=> __( 'Ten', 'deep' ),
					'eleven' 		=> __( 'Eleven', 'deep' ),
					'twelve' 		=> __( 'Twelve', 'deep' ),
					'thirteen' 		=> __( 'Thirteen', 'deep' ),
					'fourteen' 		=> __( 'Fourteen', 'deep' ),
					'fifteen' 		=> __( 'Fifteen', 'deep' ),
					'sixteen' 		=> __( 'Sixteen', 'deep' ),
					'seventeen' 	=> __( 'Seventeen', 'deep' ),
					'eighteen' 		=> __( 'Eighteen', 'deep' ),
					'ninteen' 		=> __( 'Nineteen', 'deep' ),
					'twenty' 		=> __( 'Twenty', 'deep' ),
					'twenty-one' 	=> __( 'Twenty one', 'deep' ),
					'twenty-two' 	=> __( 'Twenty Two', 'deep' ),
					'twenty-three' 	=> __( 'Twenty Three', 'deep' ),
					'twenty-four' 	=> __( 'Twenty Four', 'deep' ),
					'twenty-five' 	=> __( 'Twenty Five', 'deep' ),
					'twenty-six' 	=> __( 'Twenty Six', 'deep' ),
					'twenty-seven' 	=> __( 'Twenty seven', 'deep' ),
					'twenty-eight' 	=> __( 'Twenty Eight', 'deep' ),
				],
			]
		);
		$this->add_control(
			'category',
			[
				'label' 	=> __( 'Category', 'deep' ),
				'type' 		=> \Elementor\Controls_Manager::SELECT,
				'default' 	=> '',
				'options' 	=> $category_array,
			]
		);
		$this->add_control(
			'title',
			[
				'label' 		=> __( 'Title', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'condition' 	=> [
					'type' 	=> [
						'twenty-four','twenty-five'
					],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' 			=> 'title_bg_color',
				'label' 		=> __( 'Title background color', 'deep' ),
				'types' 		=> [ 'classic', 'gradient' ],
				'selector' 		=> '{{WRAPPER}} .latestposts-twenty-four .latest-blg-wrap-title,{{WRAPPER}} .latestposts-twenty-five .latest-blg-wrap-title',
				'condition' 	=> [
					'type' 	=> [
						'twenty-four','twenty-five'
					],
				],
			]
		);
		$this->add_control(
			'carousel',
			[
				'label' 		=> __( 'Convert To Carousel', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Yes', 'deep' ),
				'label_off' 	=> __( 'No', 'deep' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'no',
				'condition' 	=> [
					'type' 	=> [
						'twelve','thirteen','eighteen','ninteen'
					],
				],
			]
		);
		$this->add_control(
			'navigation',
			[
				'label' 	=> __( 'Navigation', 'deep' ),
				'type' 		=> \Elementor\Controls_Manager::SELECT,
				'default' 	=> 'wn-lb-arrow-nav',
				'options' 	=> [
					'wn-lb-arrow-nav'  	=> __( 'Arrow', 'deep' ),
					'wn-lb-bullet-nav' 	=> __( 'Bullet', 'deep' ),
					'wn-lb-both-nav' 	=> __( 'Both', 'deep' ),
				],
				'condition' 	=> [
					'carousel' 	=> [
						'yes'
					],
					'type' 	=> [
						'twelve','thirteen','eighteen','ninteen'
					],
				],
			]
		);
		$this->add_control(
			'post_to_show',
			[
				'label' 		=> __( 'Number Of Posts', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default'		=> '6',
				'condition' 	=> [
					'carousel' 	=> [
						'yes'
					],
					'type' 	=> [
						'twelve','thirteen','eighteen','ninteen','three'
					],
				],
			]
		);
		$this->add_control(
			'item_to_show',
			[
				'label' 		=> __( 'Number Of Posts', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'condition' 	=> [
					'type' 	=> [
						'twenty','twenty-five','twenty-six','twenty-seven','three'
					],
				],
			]
		);
		$this->add_control(
			'item_carousel',
			[
				'label' 		=> __( 'Count in row', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default'		=> '3',
				'condition' 	=> [
					'carousel' 	=> [
						'yes'
					],
					'type' 	=> [
						'twelve','thirteen','eighteen','ninteen'
					],
				],
			]
		);
		$this->add_control(
			'link_target',
			[
				'label' 		=> __( 'Open link in a new tab?', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Yes', 'deep' ),
				'label_off' 	=> __( 'No', 'deep' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'no',
			]
		);
		$this->add_control(
			'reviews',
			[
				'label' 		=> __( 'Reviews', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'deep' ),
				'label_off' 	=> __( 'Hide', 'deep' ),
				'return_value' 	=> 'show',
				'default' 		=> 'show',
				'condition' 	=> [
					'type' 	=> [
						'one', 'two', 'three', 'four', 'six', 'seven', 'eleven', 'twelve', 'twenty-one'
					],
				],
			]
		);
		$this->add_control(
			'hide_cat',
			[
				'label' 		=> __( 'Post Category', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'deep' ),
				'label_off' 	=> __( 'Hide', 'deep' ),
				'return_value' 	=> 'show',
				'default' 		=> 'show',
				'condition' 	=> [
					'type' 	=> [
						'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'nine', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen' , 'twenty', 'twenty-one', 'twenty-eight'
					],
				],
			]
		);
		$this->add_control(
			'hide_date',
			[
				'label' 		=> __( 'Post Date', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'deep' ),
				'label_off' 	=> __( 'Hide', 'deep' ),
				'return_value' 	=> 'show',
				'default' 		=> 'show',
				'condition' 	=> [
					'type!' 	=> [
						'twenty-three', 'twenty-six'
					],
				],
			]
		);
		$this->add_control(
			'hide_author',
			[
				'label' 		=> __( 'Post Author', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'deep' ),
				'label_off' 	=> __( 'Hide', 'deep' ),
				'return_value' 	=> 'show',
				'default' 		=> 'show',
				'condition' 	=> [
					'type' 	=> [
						'one', 'two', 'four', 'five', 'six', 'seven', 'eight', 'twelve', 'thirteen', 'sixteen', 'ninteen', 'twenty-one', 'twenty-seven'
					],
				],
			]
		);
		$this->add_control(
			'hide_view',
			[
				'label' 		=> __( 'Post View', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'deep' ),
				'label_off' 	=> __( 'Hide', 'deep' ),
				'return_value' 	=> 'show',
				'default' 		=> 'show',
				'condition' 	=> [
					'type' 	=> [
						'seven'
					],
				],
			]
		);
		$this->add_control(
			'hide_comment',
			[
				'label' 		=> __( 'Post Comments', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'deep' ),
				'label_off' 	=> __( 'Hide', 'deep' ),
				'return_value' 	=> 'show',
				'default' 		=> 'show',
				'condition' 	=> [
					'type' 	=> [
						'three', 'eight', 'nine', 'eleven'
					],
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'classid_section',
			[
				'label' 	=> __( 'Class & ID', 'deep' ),
				'tab' 		=> \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);
		$this->add_control(
			'shortcodeid',
			[
				'label' 	=> __( 'Custom ID', 'deep' ),
				'type' 		=> \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'shortcodeclass',
			[
				'label' 	=> __( 'Custom Class', 'deep' ),
				'type' 		=> \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'title_typography',
				'label' 	=> __( 'Title Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .wn-latestfromblog .latest-title',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' 		=> __( 'Title color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'default'		=> '#000000',
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-latestfromblog .latest-title a, #wrap {{WRAPPER}} .wn-latestfromblog .blgt1-top-sec h4 a, #wrap {{WRAPPER}} .wn-latestfromblog .latest-b2-title a, #wrap {{WRAPPER}} .wn-latestfromblog .latest-b8-title a, #wrap {{WRAPPER}} .wn-latestfromblog .latest-b9-title a, #wrap {{WRAPPER}} .wn-latestfromblog .latest-b10-title a, #wrap {{WRAPPER}} .wn-latestfromblog .latest-b11-title a, #wrap {{WRAPPER}} .wn-latestfromblog .latest-b12-title a, #wrap {{WRAPPER}} .wn-latestfromblog .latest-b13-title a, #wrap {{WRAPPER}} .wn-latestfromblog .latest-b14-title a, #wrap {{WRAPPER}} .wn-latestfromblog .latest-b15-content h2 a, #wrap {{WRAPPER}} .wn-latestfromblog .latest-b16-overlay h3 a, #wrap {{WRAPPER}} .wn-latestfromblog .latest-b17-content h3 a, #wrap {{WRAPPER}} .wn-latestfromblog .latest-b18-title a, #wrap {{WRAPPER}} .wn-latestfromblog .latest-b19-title a, #wrap {{WRAPPER}} .wn-latestfromblog .latest-b20-title a, #wrap {{WRAPPER}} .wn-latestfromblog .latest-b21-title a, #wrap {{WRAPPER}} .wn-latestfromblog .latest-b22-content h2 a, #wrap {{WRAPPER}} .wn-latestfromblog .latest-b23-content h2 a, #wrap {{WRAPPER}} .wn-latestfromblog .latest-b24-title a, #wrap {{WRAPPER}} .wn-latestfromblog .latest-b25-title a, #wrap {{WRAPPER}} .wn-latestfromblog .latestposts-twenty-six .latest-title, #wrap {{WRAPPER}} .wn-latestfromblog .latest-title-28 a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .wn-latestfromblog .latest-title',
			]
		);
		$this->add_control(
			'title_padding',
			[
				'label' 		=> __( 'Title padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-latestfromblog .latest-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_margin',
			[
				'label' 		=> __( 'Title margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-latestfromblog .latest-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_opacity',
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
					'#wrap {{WRAPPER}} .wn-latestfromblog .latest-title' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'title_display',
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
					'#wrap {{WRAPPER}} .wn-latestfromblog .latest-title' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-latestfromblog .latest-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-latestfromblog .latest-title',
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
				'name' 		=> 'title_typography_hover',
				'label' 	=> __( 'Title Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .wn-latestfromblog .latest-title:hover',
			]
		);
		$this->add_control(
			'title_color_hover',
			[
				'label' 		=> __( 'Title color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-title a, #wrap {{WRAPPER}} .wn-latestfromblog:hover .blgt1-top-sec h4 a, #wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-b2-title a, #wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-b8-title a, #wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-b9-title a, #wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-b10-title a, #wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-b11-title a, #wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-b12-title a, #wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-b13-title a, #wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-b14-title a, #wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-b15-content h2 a, #wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-b16-overlay h3 a, #wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-b17-content h3 a, #wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-b18-title a, #wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-b19-title a, #wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-b20-title a, #wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-b21-title a, #wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-b22-content h2 a, #wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-b23-content h2 a, #wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-b24-title a, #wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-b25-title a, #wrap {{WRAPPER}} .wn-latestfromblog:hover .latestposts-twenty-six .latest-title, #wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-title-28 a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_bg_hover',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .wn-latestfromblog .latest-title:hover',
			]
		);
		$this->add_control(
			'title_padding_hover',
			[
				'label' 		=> __( 'Title padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-latestfromblog .latest-title:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_margin_hover',
			[
				'label' 		=> __( 'Title margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-latestfromblog .latest-title:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_opacity_hover',
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
					'#wrap {{WRAPPER}} .wn-latestfromblog .latest-title:hover' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'title_display_hover',
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
					'#wrap {{WRAPPER}} .wn-latestfromblog .latest-title:hover' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_border_radius_hover',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-latestfromblog .latest-title:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_border_hover',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-latestfromblog .latest-title:hover',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Content', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'content_typography',
				'label' 	=> __( 'Content Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .wn-latestfromblog .latest-excerpt',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' 		=> __( 'Content color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-latestfromblog .latest-excerpt' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .wn-latestfromblog .latest-excerpt',
			]
		);
		$this->add_control(
			'content_padding',
			[
				'label' 		=> __( 'Content padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-latestfromblog .latest-excerpt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'content_margin',
			[
				'label' 		=> __( 'Content margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-latestfromblog .latest-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'content_opacity',
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
					'#wrap {{WRAPPER}} .wn-latestfromblog .latest-excerpt' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'content_display',
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
					'#wrap {{WRAPPER}} .wn-latestfromblog .latest-excerpt' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'content_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-latestfromblog .latest-excerpt' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-latestfromblog .latest-excerpt',
			]
		);
		$this->add_control(
			'hover1',
			[
				'label'     => __( 'Hover', 'deep' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'content_typography_hover',
				'label' 	=> __( 'Content Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-excerpt',
			]
		);
		$this->add_control(
			'content_color_hover',
			[
				'label' 		=> __( 'Content color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-excerpt' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_bg_hover',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-excerpt',
			]
		);
		$this->add_control(
			'content_padding_hover',
			[
				'label' 		=> __( 'Content padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-excerpt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'content_margin_hover',
			[
				'label' 		=> __( 'Content margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'content_opacity_hover',
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
					'#wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-excerpt' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'content_display_hover',
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
					'#wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-excerpt' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'content_border_radius_hover',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-excerpt' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'content_border_hover',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-latestfromblog:hover .latest-excerpt',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_category_style',
			[
				'label' => __( 'Category', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'category_typography',
				'label' 	=> __( 'Category Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .wn-latestfromblog .latestfromblog-cat',
			]
		);
		$this->add_control(
			'category_color',
			[
				'label' 		=> __( 'Category color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-latestfromblog .latestfromblog-cat' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'category_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .wn-latestfromblog .latestfromblog-cat',
			]
		);
		$this->add_control(
			'category_padding',
			[
				'label' 		=> __( 'Category padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-latestfromblog .latestfromblog-cat' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'category_margin',
			[
				'label' 		=> __( 'Category margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-latestfromblog .latestfromblog-cat' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'category_opacity',
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
					'#wrap {{WRAPPER}} .wn-latestfromblog .latestfromblog-cat' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'category_display',
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
					'#wrap {{WRAPPER}} .wn-latestfromblog .latestfromblog-cat' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'category_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-latestfromblog .latestfromblog-cat' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'category_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-latestfromblog .latestfromblog-cat',
			]
		);
		$this->add_control(
			'hover4',
			[
				'label'     => __( 'Hover', 'deep' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'category_typography_hover',
				'label' 	=> __( 'Category Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .wn-latestfromblog:hover .latestfromblog-cat',
			]
		);
		$this->add_control(
			'category_color_hover',
			[
				'label' 		=> __( 'Category color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-latestfromblog:hover .latestfromblog-cat' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'category_bg_hover',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .wn-latestfromblog:hover .latestfromblog-cat',
			]
		);
		$this->add_control(
			'category_padding_hover',
			[
				'label' 		=> __( 'Category padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-latestfromblog:hover .latestfromblog-cat' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'category_margin_hover',
			[
				'label' 		=> __( 'Category margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-latestfromblog:hover .latestfromblog-cat' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'category_opacity_hover',
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
					'#wrap {{WRAPPER}} .wn-latestfromblog:hover .latestfromblog-cat' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'category_display_hover',
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
					'#wrap {{WRAPPER}} .wn-latestfromblog:hover .latestfromblog-cat' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'category_border_radius_hover',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-latestfromblog:hover .latestfromblog-cat' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'category_border_hover',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-latestfromblog:hover .latestfromblog-cat',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			[
				'label' => __( 'Button', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'type' 	=> [
						'two', 'twenty', 'twenty-three',
					],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'button_typography',
				'label' 	=> __( 'Category Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .wn-latestfromblog .readmore',
			]
		);
		$this->add_control(
			'button_color',
			[
				'label' 		=> __( 'Button color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-latestfromblog .readmore' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .wn-latestfromblog .readmore',
			]
		);
		$this->add_control(
			'button_padding',
			[
				'label' 		=> __( 'Button padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-latestfromblog .readmore' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_margin',
			[
				'label' 		=> __( 'Button margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-latestfromblog .readmore' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_opacity',
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
					'#wrap {{WRAPPER}} .wn-latestfromblog .readmore' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'button_display',
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
					'#wrap {{WRAPPER}} .wn-latestfromblog .readmore' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-latestfromblog .readmore' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-latestfromblog .readmore',
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
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'button_typography_hover',
				'label' 	=> __( 'Button Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' 	=> '#wrap {{WRAPPER}} .wn-latestfromblog .readmore:hover',
			]
		);
		$this->add_control(
			'button_color_hover',
			[
				'label' 		=> __( 'Button color', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-latestfromblog .readmore:hover' => 'color: {{VALUE}} !important',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_hover',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' ],
				'selector' => '#wrap {{WRAPPER}} .wn-latestfromblog .readmore:hover',
			]
		);
		$this->add_control(
			'button_padding_hover',
			[
				'label' 		=> __( 'Button padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-latestfromblog .readmore:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_margin_hover',
			[
				'label' 		=> __( 'Button margin', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-latestfromblog .readmore:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_opacity_hover',
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
					'#wrap {{WRAPPER}} .wn-latestfromblog .readmore:hover' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_control(
			'button_display_hover',
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
					'#wrap {{WRAPPER}} .wn-latestfromblog .readmore:hover' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_border_radius_hover',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-latestfromblog .readmore:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border_hover',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-latestfromblog .readmore:hover',
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
				'selector' => '#wrap {{WRAPPER}} .wn-latestfromblog',
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
					'#wrap {{WRAPPER}} .wn-latestfromblog' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-latestfromblog',
			]
		);
		$this->add_control(
			'box_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .wn-latestfromblog' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .wn-latestfromblog',
				]
		);
		$this->add_control(
			'box_padding',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .wn-latestfromblog' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-latestfromblog' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-latestfromblog' => 'opacity: {{SIZE}};',
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
					'#wrap {{WRAPPER}} .wn-latestfromblog' => 'overflow: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'hover2',
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
				'selector' => '#wrap {{WRAPPER}} .wn-latestfromblog:hover',
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
					'#wrap {{WRAPPER}} .wn-latestfromblog:hover' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border_hover',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-latestfromblog:hover',
			]
		);
		$this->add_control(
			'box_border_radius_hover',
			[
				'label' 		=> __( 'Border Radius', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .wn-latestfromblog:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'box_shadow_hover',
					'label'    => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .wn-latestfromblog:hover',
				]
		);
		$this->add_control(
			'box_padding_hover',
			[
				'label' 		=> __( 'Padding', 'deep' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', 'em', '%' ],
				'selectors'     => [
					'#wrap {{WRAPPER}} .wn-latestfromblog:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-latestfromblog:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-latestfromblog:hover' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->end_controls_section();

		// Custom css tab
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
	 * Render LatestFromBlog widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		echo '<div class="wn-latestfromblog">';
		$settings = $this->get_settings_for_display();

		$style_type = '';
		switch ($settings['type']) {
			case 'one':
				$style_type = '1';
				break;
			case 'two':
				$style_type = '2';
				break;
			case 'three':
				$style_type = '3';
				break;
			case 'four':
				$style_type = '4';
				break;
			case 'five':
				$style_type = '5';
				break;
			case 'six':
				$style_type = '6';
				break;
			case 'seven':
				$style_type = '7';
				break;
			case 'eight':
				$style_type = '8';
				break;
			case 'nine':
				$style_type = '9';
				break;
			case 'ten':
				$style_type = '10';
				break;
			case 'eleven' :
				$style_type = '11';
				break;
			case 'twelve' :
				$style_type = '12';
				break;
			case 'thirteen' :
				$style_type = '13';
				break;
			case 'fourteen' :
				$style_type = '14';
				break;
			case 'fifteen' :
				$style_type = '15';
				break;
			case 'sixteen' :
				$style_type = '16';
				break;
			case 'seventeen' :
				$style_type = '17';
				break;
			case 'eighteen' :
				$style_type = '18';
				break;
			case 'ninteen' :
				$style_type = '19';
				break;
			case 'twenty' :
				$style_type = '20';
				break;
			case 'twenty-one' :
				$style_type = '21';
				break;
			case 'twenty-two' :
				$style_type = '22';
				break;
			case 'twenty-three' :
				$style_type = '23';
				break;
			case 'twenty-four' :
				$style_type = '24';
				break;
			case 'twenty-five' :
				$style_type = '25';
				break;
			case 'twenty-six' :
				$style_type = '26';
				break;
			case 'twenty-seven' :
				$style_type = '27';
				break;
			case 'twenty-eight' :
				$style_type = '28';
				break;
		}

		wp_enqueue_style( 'wn-deep-latest-from-blog0', DEEP_ASSETS_URL . 'css/frontend/latest-from-blog/latest-from-blog0.css' );
		wp_enqueue_style( 'wn-deep-latest-from-blog' . $style_type, DEEP_ASSETS_URL . 'css/frontend/latest-from-blog/latest-from-blog' . $style_type . '.css' );

		$deep_options 	= deep_options();
		$uniqid 		= substr(uniqid(rand(),1),0,7);
		$newsticker 	= ( $settings['type']  == 'twenty-five' ) ? 'wn-news-ticker' : '' ;

		$shortcodeclass		= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
		$shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';
		$target 			= $settings['link_target'] == 'yes' ? ' target="_blank"' : '';
		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}

		if ( $settings['carousel'] == 'yes'  ) {

			$settings['carousel']		= $settings['carousel'] ? 'latest-b-carousel owl-carousel owl-theme' : '' ;
			$lastest_b_carousel_item	= $settings['item_carousel'] ? 'data-items="' . $settings['item_carousel'] . '"' : '';

			echo '<div class="clearfix"></div><div class="container latestposts-'.esc_attr($settings['type'] ).' ' . $settings['carousel'] . ' ' . $settings['navigation'] . '" ' .$lastest_b_carousel_item. ' >';

		} elseif ( $settings['type'] == 'twenty') {

			echo '<div class="clearfix"></div><div class="latestposts-'.esc_attr($settings['type'] ).' owl-carousel owl-theme ' . $settings['navigation'] . ' ">';

		} else  {
			echo '<div class="clearfix latestposts-'.esc_attr( $settings['type'] ).' ' . $shortcodeclass . '"  ' . $shortcodeid . '>';
		}

		if ( $settings['type'] == 'one' ) {
			$query = new \WP_Query('posts_per_page=2&category_name='.$settings['category'].'');
			while ($query -> have_posts()) : $query -> the_post();
			$display_review 	= $settings['reviews'] == 'show' ? deep_admin_post_review() : '';
			$thumbnail_url 	= get_the_post_thumbnail_url();
			$thumbnail_id  	= get_post_thumbnail_id();
			$categories = get_the_category();
			if( !empty( $thumbnail_url ) ) {
				if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
					require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
				}
				$image = new \Wn_Img_Maniuplate;
				$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '720' , '388' ); // set required and get result
			}

			echo '
			<div class="col-md-6 col-sm-6">
				<article class="latest-b">
					<figure class="latest-img"> ';
						if( !empty($thumbnail_url) )
							echo '<img src="'.$thumbnail_url.'" alt="' . get_the_title() . '">';
						else
							echo '<img src="'.DEEP_ASSETS_URL . 'images/featured.jpg"  alt="' . get_the_title() . '"/>';
			echo'
					</figure>
						<div class="latest-content">';
						if ( $settings['hide_cat'] == 'show' && $categories ) {
							echo '<h6 class="latest-b-cat"><a href="'.get_category_link($categories[0]->cat_ID).'" class="latestfromblog-cat">'.$categories[0]->cat_name.'</a></h6>';
						}
						echo'
						<h3 class="latest-title"><a href="'. get_the_permalink().'" ' . $target .'> '. get_the_title().'</a></h3>
						<p class="latest-author">';
						if ( $settings['hide_author'] == 'show' ) {
							echo  get_the_author_posts_link();
						}
						if ( $settings['hide_date'] == 'show' ) {
							echo '/ '. get_the_time(get_option( 'date_format' ));
						}
						echo'
						</p>
						'. $display_review.'
						<p class="latest-excerpt">'. deep_excerpt(36).'</p>
					</div>
				</article>
			</div>';
			endwhile;
			wp_reset_postdata();

		} elseif ( $settings['type']=='two'){
				$i = 0;
				$query = new \WP_Query('posts_per_page=5&category_name='.$settings['category'].'');
				while ($query -> have_posts()) : $query -> the_post();
				$display_review 	= $settings['reviews'] == 'show' ? deep_admin_post_review() : '';
				$post_format 	= get_post_format(get_the_ID());
				if( $i == 0 ) {
				$thumbnail_url = get_the_post_thumbnail_url();
				$thumbnail_id  = get_post_thumbnail_id();
				$categories = get_the_category();
				if( !empty( $thumbnail_url ) ) {
					// if main class not exist get it
					if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
						require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
					}
					$image = new \Wn_Img_Maniuplate;
					$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '720' , '388' ); // set required and get result
				}

				echo '
				<div class="col-md-7">
					<article class="blog-post clearfix ">
						<figure>';

								if( !empty($thumbnail_url) )
								echo '<img src="'.$thumbnail_url.'" alt="' . get_the_title() . '">';
								else
								echo '<img src="'.DEEP_ASSETS_URL . 'images/featured.jpg"  alt="' . get_the_title() . '"/>';
				echo '
						</figure>
						<div class="entry-content">
						<div class="blgt1-top-sec">
						<h4><a href="'. get_the_permalink() .'" ' . $target .'>'. get_the_title() .'</a></h4>';
						if ( $settings['hide_cat'] == 'show' && $categories ) {
							echo '<h6 class="blog-cat"><a href="'.get_category_link($categories[0]->cat_ID).'" class="latestfromblog-cat">'.$categories[0]->cat_name.'</a></h6>';
						}
						if ( $settings['hide_date'] == 'show' ) {
							echo '<h6 class="blog-date"><i class="sl-clock"></i>'.get_the_time(get_option( 'date_format' )) .'</h6>';
						}
						echo $display_review.'
						</div>';
								if( 'quote' == $post_format  ) echo '<blockquote>';
								echo '<p class="blog-detail latest-excerpt">';
								echo deep_excerpt(45);
								echo '... <br><br><a class="readmore" href="' . get_permalink($query->ID) . '" '.$target.'>' . esc_html($deep_options['deep_blog_readmore_text']) . '</a>';
								echo '</p>';
								if( 'quote' == $post_format  ) echo '</blockquote>';
				echo'
						</div>
					</article>
				</div><div class="col-md-5">';
				  }else{
					$thumbnail_url = get_the_post_thumbnail_url();
					$thumbnail_id  = get_post_thumbnail_id();
					$categories = get_the_category();
					if( !empty( $thumbnail_url ) ) {
						// if main class not exist get it
						if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
							require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
						}
						$image = new \Wn_Img_Maniuplate;
						$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '164' , '124' ); // set required and get result
					}

			echo '
			<article class="blog-line clearfix">
				<a href="'. get_the_permalink() .'" class="img-hover" ' . $target .'>';

					if( !empty($thumbnail_url) )
						echo '<img src="'.$thumbnail_url.'" alt="' . get_the_title() . '">';
					else
						echo '<img src="'.DEEP_ASSETS_URL . 'images/featured_140x110.jpg"  alt="' . get_the_title() . '"/>';

				echo '</a>';
				if ( $settings['hide_cat'] == 'show' && $categories ) {
					echo '<p class="blog-cat"><a href="'.get_category_link($categories[0]->cat_ID).'" class="latestfromblog-cat">'.$categories[0]->cat_name.'</a></p>';
				}
				echo $display_review.'
				<h4><a ' . $target .' href="'. get_the_permalink() .'"> '. get_the_title() .'</a></h4>
				<p>';
				if ( $settings['hide_date'] == 'show' ) {
					echo  get_the_time(get_option( 'date_format' )) . ' / ';
				}
				if ( $settings['hide_author'] == 'show' ) {
					echo ' <strong>'.esc_html__('by', 'deep') .'</strong> '. get_the_author();
				}
				echo '
				</p>
			</article>';
			}
			$i++;
			endwhile;
			wp_reset_postdata();

			echo '</div>';
		} elseif ($settings['type']=='three'){
			$item_to_show = $settings['item_to_show'] ? $settings['item_to_show'] : '3'  ;
			$query = new \WP_Query('posts_per_page=' . $item_to_show . '&category_name='.$settings['category'].'');
			switch ($item_to_show) {
				case '1':
					$three_item_show = '<div class="col-md-12 col-sm-12">';
					break;

				case '2':
					$three_item_show = '<div class="col-md-6 col-sm-6">';
					break;

				case '3':
					$three_item_show = '<div class="col-md-4 col-sm-4">';
					break;

				case '4':
					$three_item_show = '<div class="col-md-3 col-sm-3">';
					break;

				default:
					$three_item_show = '<div class="col-md-4 col-sm-4">';
					break;
			}
			while ($query -> have_posts()) : $query -> the_post();
			$display_review 	= $settings['reviews'] == 'show' ? deep_admin_post_review() : '';
			$thumbnail_url = get_the_post_thumbnail_url();
			$thumbnail_id  = get_post_thumbnail_id();
			$categories = get_the_category();
			if( !empty( $thumbnail_url ) ) {
				// if main class not exist get it
				if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
					require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
				}
				$image = new \Wn_Img_Maniuplate;
				$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '720' , '388' ); // set required and get result
			}
			echo '	'. $three_item_show .'
			<article class="latest-b2"><figure class="latest-b2-img">';

					if( !empty($thumbnail_url) )
						echo '<img src="'.$thumbnail_url.'" alt="' . get_the_title() . '">';
					else
						echo '<img src="'.DEEP_ASSETS_URL . 'images/featured.jpg"  alt="' . get_the_title() . '"/>';

			echo '</figure>
			<div class="latest-b2-cont">';
			if ( $settings['hide_cat'] == 'show' && $categories ) {
				echo '<h6 class="latest-b2-cat"><a href="'.get_category_link($categories[0]->cat_ID).'" class="latestfromblog-cat">'.$categories[0]->cat_name.'</a></h6>';
			}
			echo $display_review.'
			<h3 class="latest-b2-title"><a ' . $target .' href="'.get_the_permalink().'">'.get_the_title().'</a></h3>
			<p class="latest-excerpt">'.deep_excerpt(17).'</p>';

			if ( $settings['hide_date'] == 'show' ||  $settings['hide_comment'] == 'show' ) {
				echo '<div class="latest-b2-metad2">';
				if ( $settings['hide_comment'] == 'show' ) {
					echo '<i class="wn-far wn-fa-comment"></i><span>'.get_comments_number().'</span> / ';
				} ?>
					<span class="latest-b2-date">
						<?php if ( $settings['hide_author'] == 'show' ) { ?>
							<?php echo get_the_author_posts_link() . '/'; ?>
						<?php } ?>
						<?php if ( $settings['hide_date'] == 'show' ) { ?>
							<?php echo get_the_date(); ?>
						<?php } ?>
					</span>
				<?php
				echo '</div>';
			}
			echo '</div>
			</article></div>';

			endwhile;
			wp_reset_postdata();
		} elseif ($settings['type']=='four') {
			$query = new \WP_Query('posts_per_page=2&category_name='.$settings['category'].'');
			while ($query -> have_posts()) : $query -> the_post();
			$display_review = $settings['reviews'] == 'show' ? deep_admin_post_review() : '';
			$thumbnail_url = get_the_post_thumbnail_url();
			$thumbnail_id  = get_post_thumbnail_id();
			$categories = get_the_category();
			if( !empty( $thumbnail_url ) ) {
				// if main class not exist get it
				if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
					require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
				}
				$image = new \Wn_Img_Maniuplate;
				$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '720' , '388' ); // set required and get result
			}
			$class = $settings['hide_date'] != '' || $settings['hide_author'] != '' || $settings['hide_cat'] != '' || $settings['reviews'] != ''  ? 'col-md-9' : 'col-md-12';
			echo '
			<div class="col-md-6">
				<article class="latest-b2">';
				if ( $settings['hide_date'] == 'show' || $settings['hide_author'] == 'show' || $settings['hide_cat'] == 'show' && $categories || $settings['reviews'] == 'show' ) {
					echo '<div class="col-md-3">';

					if ( $settings['hide_date'] == 'show' ) {
						echo '<h6 class="blog-date">
								<span>'. get_the_time('d') .' </span>'. get_the_time('M Y') .'
							</h6>';
					}
					if ( $settings['hide_author'] == 'show' ) {
						echo '<div class="au-avatar">
								'. get_avatar( get_the_author_meta( 'user_email' ), 90 ) .'
							</div>
							<h6 class="blog-author">
								<strong>
									'. esc_html__('Written by','deep') .'
								</strong><br>
								'. get_the_author_posts_link() .'
							</h6>';
					}
					echo $display_review;
					if ( $settings['hide_cat'] == 'show' && $categories && $categories ) {
						echo '<h6 class="latest-b2-cat">';
						echo '<a href="' . get_category_link( $categories[0]->cat_ID ) . '" class="latestfromblog-cat">' . $categories[0]->cat_name . '</a>';
						echo '</h6>';
					}
					echo '</div>';
				}

				echo '<div class="' . $class . '">
						<figure class="latest-b2-img">';
								if( !empty($thumbnail_url) )
									echo '<img src="'.$thumbnail_url.'" alt="' . get_the_title() . '">';
								else
									echo '<img src="'.DEEP_ASSETS_URL . 'images/featured.jpg"  alt="' . get_the_title() . '"/>';
						echo'
						</figure>
						<div class="latest-b2-cont">
							<h3 class="latest-b2-title"><a href="'. get_the_permalink() .'" ' . $target .'>'. get_the_title() .'</a></h3>
						</div>
					</div>
					<div class="clearfix"></div>
				</article>
			</div>';
			endwhile;
			wp_reset_postdata();
		} elseif ($settings['type']=='five'){
			$query = new \WP_Query('posts_per_page=6&category_name='.$settings['category'].'');
			while ($query -> have_posts()) : $query -> the_post();
			$thumbnail_url = get_the_post_thumbnail_url();
			$thumbnail_id  = get_post_thumbnail_id();
			$categories = get_the_category();
			if( !empty( $thumbnail_url ) ) {
				// if main class not exist get it
				if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
					require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
				}
				$image = new \Wn_Img_Maniuplate;
				$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '420' , '330' ); // set required and get result
			}
		echo'<div class="col-md-6 col-lg-4"><article class="latest-b2">
			<figure class="latest-b2-img">';
					if( !empty($thumbnail_url) )
						echo '<img src="'.$thumbnail_url.'" alt="' . get_the_title() . '">';
					else
						echo '<img src="'.DEEP_ASSETS_URL . 'images/featured.jpg"  alt="' . get_the_title() . '"/>';
			echo'
			</figure>
			<div class="latest-b2-cont">';
			if ( $settings['hide_cat'] == 'show' && $categories ) {
				echo '<h6 class="latest-b2-cat"><a href="'.get_category_link($categories[0]->cat_ID).'" class="latestfromblog-cat">'.$categories[0]->cat_name.'</a></h6>';
			}
			echo '<h3 class="latest-b2-title"><a href="'.get_the_permalink() .'" ' . $target .'>'.get_the_title() .'</a></h3>
			<h5 class="latest-b2-date">';
			if ( $settings['hide_author'] == 'show' ) {
				echo get_the_author_posts_link();
			}
			if ( $settings['hide_date'] == 'show' ) {
				echo get_the_date();
			}
			echo '</h5>
			</div></article></div>';

			endwhile;
			wp_reset_postdata();
		} elseif ($settings['type']=='six') {
			$query = new \WP_Query('posts_per_page=4&category_name='.$settings['category'].'');
			while ($query -> have_posts()) : $query -> the_post();
			$display_review = $settings['reviews'] == 'show' ? deep_admin_post_review() : '';
			$thumbnail_url = get_the_post_thumbnail_url();
			$thumbnail_id  = get_post_thumbnail_id();
			$categories = get_the_category();
			if( !empty( $thumbnail_url ) ) {
				// if main class not exist get it
				if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
					require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
				}
				$image = new \Wn_Img_Maniuplate;
				$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '720' , '388' ); // set required and get result
			}
		echo'
			<div class="col-md-3 col-sm-6"><article class="latest-b">
			<figure class="latest-img">';
					if( !empty($thumbnail_url) )
						echo '<img src="'.$thumbnail_url.'" alt="' . get_the_title() . '">';
					else
						echo '<img src="'.DEEP_ASSETS_URL . 'images/featured.jpg"  alt="' . get_the_title() . '"/>';
			echo'
			</figure>
				<div class="latest-content">';
				if ( $settings['hide_date'] == 'show' ) {
					echo '<p class="latest-date">'.get_the_time(get_option( 'date_format' )).'</p>';
				}
				echo $display_review.'
				<h3 class="latest-title"><a href="'.get_the_permalink().'" ' . $target .'>'.get_the_title().'</a></h3>';
				if ( $settings['hide_author'] == 'show' ||  $settings['hide_cat'] == 'show' && $categories ) {
					echo '<p class="latest-author">';
						if ( $settings['hide_author'] == 'show' ) {
							echo '<strong>'.esc_html__('by','deep').'</strong>' . get_the_author_posts_link();
						}
						if ( $settings['hide_cat'] == 'show' && $categories && $categorie ) {
							echo ' <strong>'.esc_html__('in ','deep').'</strong><a href="'.get_category_link( $categories[0]->cat_ID ).'" class="latestfromblog-cat">'.$categories[0]->cat_name.'</a>';
						}
					echo'</p>';
				}
				echo '</div>
			</article></div>';
			endwhile;
			wp_reset_postdata();
		} elseif ( $settings['type'] == 'seven' ) {
			$wpbp = new \WP_Query('posts_per_page=3&category_name='.$settings['category'].'');
			if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
			$display_review = $settings['reviews'] == 'show' ? deep_admin_post_review() : '';
			$thumbnail_url = get_the_post_thumbnail_url();
			$thumbnail_id  = get_post_thumbnail_id();
			$categories = get_the_category();
			if( !empty( $thumbnail_url ) ) {
				// if main class not exist get it
				if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
					require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
				}
				$image = new \Wn_Img_Maniuplate;
				$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '720' , '388' ); // set required and get result
			}
			echo'
			<div class="col-md-4 col-sm-4"><article class="latest-b">
			<figure class="latest-img">';
					if( !empty($thumbnail_url) )
						echo '<img src="'.$thumbnail_url.'" alt="' . get_the_title() . '">';
					else
						echo '<img src="'.DEEP_ASSETS_URL . 'images/featured.jpg"  alt="' . get_the_title() . '"/>';
			echo'
			</figure>';
				if ( $settings['hide_date'] == 'show' || $settings['hide_view'] == 'show'  ) {
					echo '<div class="wrap-date-icons">';
						if ( $settings['hide_date'] == 'show' ) {
							echo '<h3 class="latest-date">
								<span class="latest-date-month">'. get_the_time('M') .'</span>
								<span class="latest-date-day">'. get_the_time('d') .'</span>
								<span class="latest-date-year">'. get_the_time('Y') .'</span>
							</h3>';
						}
						if ( $settings['hide_view'] == 'show' ) {
							echo '<div class="latest-icons">
								<p>
									<span><i class="wn-fa wn-fa-eye"></i></span>
								</p>
								<p>
									<span>'. deep_getViews(get_the_ID()) .'</span>
								</p>
							</div>';
						}
					echo '</div>';
				}
				echo '
				<div class="latest-content">
					<h3 class="latest-title"><a href="'.get_the_permalink().'" ' . $target .'> '.get_the_title().'</a></h3>';
					if ( $settings['hide_author'] == 'show' || $settings['hide_cat'] == 'show' && $categories  ) {
						echo '<p class="latest-author">';
							if ( $settings['hide_author'] == 'show' ) {
								echo esc_html__('by ','deep'). get_the_author();
							}
							if ( $settings['hide_cat'] == 'show' && $categories ) {
								echo  esc_html__(' in ','deep') . '<a href="'.get_category_link($categories[0]->cat_ID).'" class="latestfromblog-cat">'.$categories[0]->cat_name.'</a>';
							}
						echo '</p>';
					}
					echo $display_review.'
				</div>
			</article></div>';

			endwhile;
		wp_reset_postdata(); endif;
		} elseif ($settings['type']=='eight') {
		$query = new \WP_Query('posts_per_page=3&category_name='.$settings['category'].'');
			while ($query -> have_posts()) : $query -> the_post();
			$wn_comment = ( get_comments_number() == 0 || get_comments_number() == 1 ) ? esc_html__( ' Comment', 'deep' ) : esc_html__( ' Comments', 'deep' );
			$thumbnail_url = get_the_post_thumbnail_url();
			$thumbnail_id  = get_post_thumbnail_id();
			if( !empty( $thumbnail_url ) ) {
				// if main class not exist get it
				if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
					require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
				}
				$image = new \Wn_Img_Maniuplate;
				$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '720' , '388' ); // set required and get result
			}
			echo'
				<div class="col-sm-4">
					<article class="latest-b8">
						<figure class="latest-b8-img">';
								if( !empty($thumbnail_url) )
									echo '<img src="'.$thumbnail_url.'" alt="' . get_the_title() . '">';
								else
									echo '<img src="'.DEEP_ASSETS_URL . 'images/featured.jpg"  alt="' . get_the_title() . '"/>';
						echo'
						</figure>
						<div class="latest-b8-content">
							<span class="post-format-icon '. get_post_format().'"></span>
							<h3 class="latest-b8-title"><a href="'. get_the_permalink().'" ' . $target .'>'. get_the_title().'</a></h3>
							<p class="latest-excerpt">'. deep_excerpt(32).'</p>
							<a class="readmore" href="'. get_permalink($query->ID).'" ' . $target .'>'. esc_html($deep_options['deep_blog_readmore_text']) .'</a>';
							if ( $settings['hide_author'] == 'show' || $settings['hide_date'] == 'show' || $settings['hide_comment'] == 'show'  ) {
								echo '<div class="latest-b8-meta">';
									if ( $settings['hide_author'] == 'show' ) {
										echo '<div class="autho"><i class="sl-user"></i><span>'. esc_html__( 'by: ', 'deep' ) . get_the_author_posts_link().'</span></div>';
									}
									if ( $settings['hide_date'] == 'show' ) {
										echo '<div class="date"><i class="sl-calendar"></i><span>'. get_the_date() .'</span></div>';
									}
									if ( $settings['hide_comment'] == 'show' ) {
										echo '<div class="comments"><i class="sl-bubble"></i><span>'. get_comments_number() . $wn_comment .'</span></div>';
									}
								echo '</div>';
							}
						echo '
						</div>
					</article>
				</div>';
			endwhile;
			wp_reset_postdata();
		} elseif ($settings['type']=='nine') {
			$query = new \WP_Query('posts_per_page=3&category_name='.$settings['category'].'');
			while ($query -> have_posts()) : $query -> the_post();
			$wn_comment = ( get_comments_number() == 0 || get_comments_number() == 1 ) ? esc_html__( ' Comment', 'deep' ) : esc_html__( ' Comments', 'deep' );
			$thumbnail_url = get_the_post_thumbnail_url();
			$thumbnail_id  = get_post_thumbnail_id();
			$categories = get_the_category();
			if( !empty( $thumbnail_url ) ) {
				// if main class not exist get it
				if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
					require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
				}
				$image = new \Wn_Img_Maniuplate;
				$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '720' , '388' ); // set required and get result
			}
			echo'
				<div class="col-sm-4">
					<article class="latest-b9">
						<figure class="latest-b9-img">';
								if( !empty($thumbnail_url) )
									echo '<img src="'.$thumbnail_url.'" alt="' . get_the_title() . '">';
								else
									echo '<img src="'.DEEP_ASSETS_URL . 'images/featured.jpg"  alt="' . get_the_title() . '"/>';
						echo'
						</figure>
						<div class="latest-b9-content">
							<h3 class="latest-b9-title">
								<span class="post-format-icon '.get_post_format().'"></span>
								<a href="'.get_the_permalink().'" ' . $target .'>'.get_the_title().'</a>
							</h3>';
							if ( $settings['hide_date'] == 'show' || $settings['hide_cat'] == 'show' && $categories || $settings['hide_comment'] == 'show'  ) {
								echo '<div class="latest-b9-meta">';
									if ( $settings['hide_date'] == 'show' ) {
										echo '<span class="date">'.get_the_date().'</span>';
									}
									if ( $settings['hide_cat'] == 'show' && $categories ) {
										echo '<span class="categories">'.esc_html__( 'in ', 'deep' ) .'<a href="'.get_category_link($categories[0]->cat_ID).'" class="latestfromblog-cat">'.$categories[0]->cat_name.'</a></span>';
									}
									if ( $settings['hide_comment'] == 'show' ) {
										echo'<span class="comments">'. get_comments_number() . $wn_comment .'</span>';
									}
								echo'</div>';
							}
						echo '</div>
					</article>
				</div>';
			endwhile;
			wp_reset_postdata();
		} elseif ($settings['type']=='ten') {
			$query = new \WP_Query('posts_per_page=4&category_name='.$settings['category'].'');
			while ($query -> have_posts()) : $query -> the_post();
			$thumbnail_url = get_the_post_thumbnail_url();
			$thumbnail_id  = get_post_thumbnail_id();
			if( !empty( $thumbnail_url ) ) {
				// if main class not exist get it
				if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
					require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
				}
				$image = new \Wn_Img_Maniuplate;
				$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '460' , '460' ); // set required and get result
			}
			echo'
				<div class="col-md-6">
					<article class="latest-b10">
						<figure class="latest-b10-img">';
								if( !empty($thumbnail_url) )
									echo '<img src="'.$thumbnail_url.'" alt="' . get_the_title() . '">';
								else
									echo '<img src="'.DEEP_ASSETS_URL . 'images/featured.jpg"  alt="' . get_the_title() . '"/>';
						echo'
						</figure>
						<div class="latest-b10-content">';
							if ( $settings['hide_date'] == 'show' ) {
							echo '
								<div class="latest-b10-meta">
									<span class="date">'. get_the_date() .'</span>
								</div>';
							}
							echo '
							<h3 class="latest-b10-title">
								<a href="'.get_the_permalink() .'" ' . $target .'>'.get_the_title().'</a>
							</h3>
							<p class="latest-excerpt">'. deep_excerpt(19) .'</p>
							<a class="readmore" href="'. get_permalink($query->ID).'" ' . $target .'>'. esc_html($deep_options['deep_blog_readmore_text']).'</a>
						</div>
					</article>
				</div>';
			endwhile;
			wp_reset_postdata();
		} elseif ($settings['type']=='eleven') {
			$query = new \WP_Query('posts_per_page=3&category_name='.$settings['category'].'');
			while ($query -> have_posts()) : $query -> the_post();
			$display_review = $settings['reviews'] == 'show' ? deep_admin_post_review() : '';
			$wn_comment = ( get_comments_number() == 0 || get_comments_number() == 1 ) ? esc_html__( ' Comment', 'deep' ) : esc_html__( ' Comments', 'deep' );
			$thumbnail_url = get_the_post_thumbnail_url();
			$thumbnail_id  = get_post_thumbnail_id();
			$categories = get_the_category();
			if( !empty( $thumbnail_url ) ) {
				// if main class not exist get it
				if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
					require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
				}
				$image = new \Wn_Img_Maniuplate;
				$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '460' , '460' ); // set required and get result
			}
			echo'
				<div class="col-sm-4">
					<article class="latest-b11">
						<div class="latest-b11-content">';
							if ( $settings['hide_cat'] == 'show' && $categories ) {
							echo '<h6 class="categories">'. esc_html__( 'In ', 'deep' ) . '<a href="'.get_category_link($categories[0]->cat_ID).'" class="latestfromblog-cat">'.$categories[0]->cat_name.'</a></h6>';
							}
							echo $display_review.'
							<h3 class="latest-b11-title"><a href="'.get_the_permalink().'" ' . $target .'>'.get_the_title().'</a></h3>
							<div class="latest-b11-meta">';
								if ( $settings['hide_date'] == 'show' ) {
									echo '<span class="date">'.get_the_date().'</span>';
								}
								if ( $settings['hide_comment'] == 'show' ) {
									echo '<span class="comments">'. get_comments_number() . $wn_comment .'</span>';
								}
							echo '
							</div>
						</div>
						<figure class="latest-b11-img">';
								if( !empty($thumbnail_url) )
									echo '<img src="'.$thumbnail_url.'" alt="' . get_the_title() . '">';
								else
									echo '<img src="'.DEEP_ASSETS_URL . 'images/featured.jpg"  alt="' . get_the_title() . '"/>';
						echo'
						</figure>
					</article>
				</div>';
			endwhile;
			wp_reset_postdata();
		} elseif ($settings['type']=='twelve'){
			$post_to_show = $settings['post_to_show'] && $settings['carousel'] == 'yes' ? $settings['post_to_show'] : '3' ;
			$query = new \WP_Query('posts_per_page=' . $post_to_show . '&category_name='.$settings['category'].'');
			while ($query -> have_posts()) : $query -> the_post();
			$display_review = $settings['reviews'] == 'show' ? deep_admin_post_review() : '';
			$thumbnail_url = get_the_post_thumbnail_url();
			$thumbnail_id  = get_post_thumbnail_id();
			$categories = get_the_category();
			if( !empty( $thumbnail_url ) ) {
				// if main class not exist get it
				if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
					require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
				}
				$image = new \Wn_Img_Maniuplate;
				$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '420' , '330' ); // set required and get result
			}
			echo'
				<div class="col-md-4 col-sm-4">
					<article class="latest-b12">
						<figure class="latest-b12-img">';
								if( !empty($thumbnail_url) )
									echo '<img src="'.$thumbnail_url.'" alt="' . get_the_title() . '">';
								else
									echo '<img src="'.DEEP_ASSETS_URL . 'images/featured.jpg"  alt="' . get_the_title() . '"/>';
						echo'
						</figure>
						<div class="latest-b12-cont">';
						if ( $settings['hide_cat'] == 'show' && $categories ) {
							echo '<h6 class="latest-b12-cat"><a href="'.get_category_link($categories[0]->cat_ID).'" class="latestfromblog-cat">'.$categories[0]->cat_name.'</a></h6>';
						}
						echo $display_review.'
							<h3 class="latest-b12-title"><a href="'.get_the_permalink().'" ' . $target . '>'.get_the_title().'</a></h3>
							<p class="latest-excerpt">'.deep_excerpt(19).'</p>
							<div class="latest-b12-metad2">';
							if ( $settings['hide_author'] == 'show' ) {
								echo '<span class="latest-b12-author"><span>'.esc_html__( 'by', 'deep').'</span>'.get_the_author_posts_link().'</span>';
							}
							if ( $settings['hide_date'] == 'show' ) {
								echo '<span class="latest-b12-date">'.get_the_date().'</span>';
							}
							echo'
							</div>
						</div>
					</article>
				</div>';
			endwhile;
			wp_reset_postdata();
		} elseif ($settings['type']=='thirteen'){
			$post_to_show = $settings['post_to_show'] && $settings['carousel'] == 'yes' ? $settings['post_to_show'] : '3' ;
			$query = new \WP_Query('posts_per_page=' . $post_to_show . '&category_name='.$settings['category'].'');
			while ($query -> have_posts()) : $query -> the_post();
			$thumbnail_url = get_the_post_thumbnail_url();
			$thumbnail_id  = get_post_thumbnail_id();
			$categories = get_the_category();
			if( !empty( $thumbnail_url ) ) {
				// if main class not exist get it
				if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
					require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
				}
				$image = new \Wn_Img_Maniuplate;
				$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '420' , '330' ); // set required and get result
			}
			echo'
			<div class="col-md-3 col-sm-3">
				<article class="latest-b13">
					<figure class="latest-b13-img">';
							if( !empty($thumbnail_url) )
								echo '<img src="'.$thumbnail_url.'" alt="' . get_the_title() . '">';
							else
								echo '<img src="'.DEEP_ASSETS_URL . 'images/featured.jpg"  alt="' . get_the_title() . '"/>';
						if ( $settings['hide_cat'] == 'show' && $categories ) {
							echo'<h6 class="latest-b13-cat"><a href="'.get_category_link($categories[0]->cat_ID).'" class="latestfromblog-cat">'.$categories[0]->cat_name.'</a></h6>';
						}
					echo'
					</figure>
					<div class="latest-b13-cont">
						<h3 class="latest-b13-title"><a href="'.get_the_permalink().'" ' . $target .'>'.get_the_title().'</a></h3>
						<p class="latest-excerpt">'.deep_excerpt(19).'</p>
						<div class="latest-b13-metad2">';
							if ( $settings['hide_author'] == 'show' ) {
								echo '<span class="latest-b13-author"><span>'.esc_html__( 'BY', 'deep') .' </span>'.get_the_author_posts_link().'</span>';
							}
							if ( $settings['hide_date'] == 'show' ) {
								echo '<span class="latest-b13-date">'.get_the_date().'</span>';
							}
						echo '
						</div>
					</div>
				</article>
			</div>';
			endwhile;
			wp_reset_postdata();
		} elseif ( $settings['type'] == 'fourteen' ){
			$query	= new \WP_Query('posts_per_page=4&category_name='.$settings['category'].'');
			while ($query -> have_posts()) : $query -> the_post();
				$categories = get_the_category();
				$uniqid			= substr(uniqid(rand(),1),0,7);
				$thumbnail_url	= get_the_post_thumbnail_url();
				$thumbnail_id  	= get_post_thumbnail_id();
				if( !empty( $thumbnail_url ) ) {
					if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
						require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
					}
					$image = new \Wn_Img_Maniuplate;
					$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '299' , '309' );
				}
				$style = '.wn-latest-b14-' . $uniqid . ' .latest-b14 { background: url( ' . $thumbnail_url . ' ); }';

				if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
					echo '<style>'.$style.'</style>';
				}

				deep_save_dyn_styles( $style );

			echo'
				<div class="col-lg-3 col-md-6 wn-latest-b14 wn-latest-b14-' . $uniqid.'">
					<article class="latest-b14">
						<div class="latest-b14-cont">
							<a class="hcolorf" href="'.get_the_permalink().'" ' . $target .'>
								<i class="ti-arrow-right" aria-hidden="true"></i>
							</a>
							<div class="latest-b14-meta">';
							if ( $settings['hide_cat'] == 'show' && $categories ) {
								echo '<span class="latest-b14-cat"><a href="'.get_category_link($categories[0]->cat_ID).'" class="latestfromblog-cat">'.$categories[0]->cat_name.'</a></span>';
							}
							if ( $settings['hide_date'] == 'show' ) {
								echo '<span class="latest-b14-date">'.get_the_date().'</span>';
							}
							echo '
							</div>
							<h3 class="latest-b14-title"><a class="hcolorf" href="'.get_the_permalink().'" ' . $target .'>'.get_the_title().'</a></h3>
						</div>
					</article>
				</div>';
			endwhile;
			wp_reset_postdata();
		} elseif ( $settings['type'] == 'fifteen' ){
			$query = new \WP_Query('posts_per_page=3&category_name='.$settings['category'].'');
			while ($query -> have_posts()) : $query -> the_post();
			$thumbnail_url = get_the_post_thumbnail_url();
			$thumbnail_id  = get_post_thumbnail_id();
			$categories = get_the_category();
			if( !empty( $thumbnail_url ) ) {
				// if main class not exist get it
				if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
					require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
				}
				$image = new \Wn_Img_Maniuplate;
				$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '460' , '460' ); // set required and get result
			}
			echo'
				<div class="col-md-4 wn-latest-b15">
					<article class="latest-b15">
						<figure class="latest-b15-img">';
								if( !empty($thumbnail_url) )
									echo '<img src="'.$thumbnail_url.'" alt="' . get_the_title() . '">';
								else
									echo '<img src="'.DEEP_ASSETS_URL . 'images/featured.jpg"  alt="' . get_the_title() . '"/>';
							echo'
							<div class="latest-b15-overlay">
								<a href="'.get_permalink($query->ID).'" ' . $target .'><i class="ti-arrow-right"></i></a>
							</div>
						</figure>
						<div class="latest-b15-content">
							<div class="latest-b15-meta-data">';
								if ( $settings['hide_cat'] == 'show' && $categories ) {
									echo '<a href="'.get_category_link($categories[0]->cat_ID).'" class="latestfromblog-cat">'.$categories[0]->cat_name.'</a> / ';
								}
								if ( $settings['hide_date'] == 'show' ) {
									echo get_the_date();
								}
							echo '
							</div>
							<h2><a href="'.get_permalink($query->ID).'" ' . $target.'>'.get_the_title().'</a></h2>
						</div>
					</article>
				</div>';
			endwhile;
			wp_reset_postdata();
		} elseif ( $settings['type'] == 'sixteen' ) {
			$query = new \WP_Query('posts_per_page=4&category_name='.$settings['category'].'');
			while ($query -> have_posts()) : $query -> the_post();
			$thumbnail_url = get_the_post_thumbnail_url();
			$thumbnail_id  = get_post_thumbnail_id();
			$categories = get_the_category();
			if( !empty( $thumbnail_url ) ) {
				// if main class not exist get it
				if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
					require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
				}
				$image = new \Wn_Img_Maniuplate;
				$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '300' , '200' ); // set required and get result
			}
			echo'
				<div class="col-md-3 wn-latest-b16">
					<article class="latest-b16">
						<figure class="latest-b16-img">';
								if( !empty($thumbnail_url) )
									echo '<img src="'.$thumbnail_url.'" alt="' . get_the_title() . '">';
								else
									echo '<img src="'.DEEP_ASSETS_URL . 'images/featured.jpg"  alt="' . get_the_title() . '"/>';
							echo'
							<div class="latest-b16-overlay">
								<h3><a href="'.get_the_permalink().'" ' . $target .'>'.get_the_title().'</a></h3>';
								if ( $settings['hide_cat'] == 'show' && $categories ) {
									echo '<div class="latest-b16-meta-data"><a href="'.get_category_link($categories[0]->cat_ID).'" class="latestfromblog-cat">'.$categories[0]->cat_name.'</a></div>';
								}
							echo'
							</div>
						</figure>
						<div class="latest-b16-content">
							<p class="latest-b61-excerpt latest-excerpt">'.deep_excerpt(15).'</p>
							<a href="'.get_the_permalink().'" class="latest-b16-readmore" ' . $target .'>'.esc_html__( 'Read More', 'deep' ).'</a>';
							if ( $settings['hide_author'] == 'show' || $settings['hide_date'] == 'show' ) {
								echo '<div class="latest-b16-footer">';
								if ( $settings['hide_author'] == 'show' ) {
									echo '<div class="latest-author">
									<span>'.esc_html__('By','deep') .'</span><strong>'.get_the_author_posts_link().'</strong>
									</div>';
								}
								if ( $settings['hide_date'] == 'show' ) {
									echo '<div class="latest-date">
									<span><i class="pe-7s-clock"></i>'.get_the_date().'</span>
									</div>';
								}
								echo'</div>';
							}
						echo '
						</div>
					</article>
				</div>';
			endwhile;
			wp_reset_postdata();
		} elseif ( $settings['type'] == 'seventeen' ) {
			$query = new \WP_Query('posts_per_page=3&category_name='.$settings['category'].'');
			while ($query -> have_posts()) : $query -> the_post();
			echo'<div class="col-md-12 wn-latest-b17">
					<article class="latest-b17">
						<div class="latest-b17-content">';
						if ( $settings['hide_date'] == 'show' ) {
							echo '<div class="latest-date">'.get_the_date().'</div>';
						}
						echo '<h3><a href="'.get_the_permalink().'" ' . $target .'>'.get_the_title().'</a></h3>
							<a ' . $target .' href="'.get_the_permalink().'" class="latest-b17-readmore">'.esc_html__( 'Read More', 'deep' ).'</a>
						</div>
					</article>
				</div>';
			endwhile;
			wp_reset_postdata();
		} elseif ( $settings['type'] == 'eighteen' ) {
			$post_to_show = $settings['post_to_show'] && $settings['carousel'] == 'yes' ? $settings['post_to_show'] : '3' ;
			$query = new \WP_Query('posts_per_page=' . $post_to_show . '&category_name='.$settings['category'].'');
			while ($query -> have_posts()) : $query -> the_post();
			$thumbnail_url = get_the_post_thumbnail_url();
			$thumbnail_id  = get_post_thumbnail_id();
			if( !empty( $thumbnail_url ) ) {
				// if main class not exist get it
				if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
					require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
				}
				$image = new \Wn_Img_Maniuplate;
				$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '420' , '330' ); // set required and get result
			}
			echo'
				<div class="col-md-4 col-sm-4">
					<article class="latest-b18">
						<figure class="latest-b18-img">';
								if( !empty($thumbnail_url) )
									echo '<img src="'.$thumbnail_url.'" alt="' . get_the_title() . '">';
								else
									echo '<img src="'.DEEP_ASSETS_URL . 'images/featured.jpg"  alt="' . get_the_title() . '"/>';
						echo'
						</figure>
						<div class="latest-b18-cont">';
						if ( $settings['hide_date'] == 'show' ) {
							echo '<span class="latest-b18-date">'.get_the_date().'</span>';
						}
						echo '<h3 class="latest-b18-title"><a href="'.get_the_permalink().'" ' . $target .'>'.get_the_title().'</a></h3>
							<p class="latest-excerpt">'.deep_excerpt(19).'</p>
							<div class="latest-b18-metad2">
								<a href="'.get_the_permalink().'" class="colorf latest-b18-readmore" ' . $target .'>
									'.esc_html__( 'Read More', 'deep' ).'
								</a>
							</div>
						</div>
					</article>
				</div>';
			 endwhile;
			 wp_reset_postdata();
		} elseif ( $settings['type'] == 'ninteen' ) {
			$post_to_show = $settings['post_to_show'] && $settings['carousel'] == 'yes' ? $settings['post_to_show'] : '4' ;
			$query = new \WP_Query('posts_per_page=' . $post_to_show . '&category_name='.$settings['category'].'');
			while ($query -> have_posts()) : $query -> the_post();
			$thumbnail_url = get_the_post_thumbnail_url();
			$thumbnail_id  = get_post_thumbnail_id();
			if( !empty( $thumbnail_url ) ) {
				// if main class not exist get it
				if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
					require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
				}
				$image = new \Wn_Img_Maniuplate;
				$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '397' , '265' ); // set required and get result
			}
			echo'
			<div class="col-md-3 col-sm-3">
				<article class="latest-b19">
					<figure class="latest-b19-img">';
							if( !empty($thumbnail_url) )
								echo '<img src="'.$thumbnail_url.'" alt="' . get_the_title() . '">';
							else
								echo '<img src="'.DEEP_ASSETS_URL . 'images/featured.jpg"  alt="' . get_the_title() . '"/>';
					echo'
					</figure>
					<div class="latest-b19-cont">
						<h3 class="latest-b19-title"><a href="'.get_the_permalink().'" ' . $target .'>'.get_the_title().'</a></h3>
						<p class="latest-excerpt">'.deep_excerpt(19).'</p>
					</div>';
					if ( $settings['hide_date'] == 'show' || $settings['hide_author'] == 'show' ) {
						echo '<div class="latest-b19-metadata">';
							if ( $settings['hide_author'] == 'show' ) {
								echo '<span class="latest-b19-avatar">'.get_avatar( get_the_author_meta( 'user_email' ), 90 ) .' '.get_the_author_posts_link().' / </span>';
							}
							if ( $settings['hide_date'] == 'show' ) {
								echo '<span class="latest-b19-date">'.get_the_date().'</span>';
							}
						echo '</div>';
					}
					echo '
				</article>
			</div>';
			endwhile;
			wp_reset_postdata();
		} elseif ( $settings['type'] == 'twenty' ) {
			$item_to_show = $settings['item_to_show'] ? $settings['item_to_show'] : '2' ;
			$query = new \WP_Query('posts_per_page=' . $item_to_show . '&category_name='.$settings['category'].'');
			while ($query -> have_posts()) : $query -> the_post();
			$categories = get_the_category();
			$thumbnail_id = get_post_thumbnail_id();
			$thumbnail_url = get_the_post_thumbnail_url();
			if( !empty( $thumbnail_url ) ) {
				if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
					require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
				}
				$image = new \Wn_Img_Maniuplate;
				$thumbnail_url = $image->m_image( $thumbnail_id , $thumbnail_url , '645' , '440' );
			}
			echo'
				<article class="latest-b20">
					<figure class="latest-b20-img">';
							if( !empty($thumbnail_url) )
								echo '<img src="'.$thumbnail_url.'" alt="' . get_the_title() . '">';
							else
								echo '<img src="'.DEEP_ASSETS_URL . 'images/featured.jpg"  alt="' . get_the_title() . '"/>';
					echo'
					</figure>
					<div class="latest-b20-cont colorb">
						<div class="latest-b20-detail">';
						if ( $settings['hide_date'] == 'show' ) {
							echo '<span class="latest-b20-date">'.get_the_date().'</span>';
						}
						if ( $settings['hide_cat'] == 'show' && $categories ) {
							echo '<span class="latest-b20-cat">- <a href="'.get_category_link($categories[0]->cat_ID).'" class="latestfromblog-cat">'.$categories[0]->cat_name.'</a></span>';
						}
						echo '
						</div>
						<h3 class="latest-b20-title"><a href="'.get_the_permalink().'" ' . $target .'>'.get_the_title().'</a></h3>
						<a class="readmore" href="'.get_permalink($query->ID).'" ' . $target .'>'.esc_html($deep_options['deep_blog_readmore_text']).'</a>
					</div>
				</article>';
			endwhile;
			wp_reset_postdata();
		}  elseif ( $settings['type'] == 'twenty-one' ) {
			$query = new \WP_Query('posts_per_page=5&category_name='.$settings['category'].'');
			$first_post = true;
			$secound_posts = true;
			while ($query -> have_posts()) : $query -> the_post();
			$display_review = $settings['reviews'] == 'show' ? deep_admin_post_review() : '';
			$categories = get_the_category();
			$thumbnail_id = get_post_thumbnail_id();
			$thumbnail_url = get_the_post_thumbnail_url();
			if( !empty( $thumbnail_url ) ) {
				if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
					require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
				}
				$image = new \Wn_Img_Maniuplate;
				$thumbnail_url_1 = $image->m_image( $thumbnail_id , $thumbnail_url , '972' , '486' );
				$thumbnail_url_2 = $image->m_image( $thumbnail_id , $thumbnail_url , '299' , '226' );
			}
			$uniqid			= substr(uniqid(rand(),1),0,7);
			$style			= '#wrap .latest-b21-' . $uniqid . ' .latest-b21-category { background: ' . deep_category_color() . '; }';
			deep_save_dyn_styles( $style );

			if ( $first_post == true ) {
				echo'
				<article class="latest-b21 latest-b21-' . $uniqid.' col-md-6">
					<figure class="latest-b21-img">
						<a href="'.get_the_permalink().'">';
								if( !empty($thumbnail_url) )
									echo '<img src="'.$thumbnail_url.'" alt="' . get_the_title() . '">';
								else
									echo '<img src="'.DEEP_ASSETS_URL . 'images/featured.jpg"  alt="' . get_the_title() . '"/>';
						echo'
						</a>
					</figure>
					<div class="latest-b21-cont">';
					if ( $settings['hide_cat'] == 'show' && $categories && ! empty( $categories[0] ) ) {
						echo '
						<div class="latest-b21-category">
							<span class="latest-b21-cat" data-id="' . $uniqid.'"><a href="'.get_category_link($categories[0]->cat_ID).'" class="latestfromblog-cat">'.$categories[0]->cat_name.'</a></span>
						</div>';
					}
					if ( $settings['hide_date'] == 'show' ) {
					echo '<div class="latest-b21-date">
							<i class="pe-7s-clock"></i>'.get_the_date().'
						</div>';
					}
					echo  $display_review.'
						<h3 class="latest-b21-title"><a href="'.get_the_permalink().'" class="hcolorf" ' . $target .'>'.get_the_title().'</a></h3>
						<p class="latest-excerpt">'.deep_excerpt(30).'</p>';
						if ( $settings['hide_author'] == 'show' ) {
							echo '
								<div class="latest-author">
									<span>'.get_avatar( get_the_author_meta( 'user_email' ), 28 ).'</span>
									<span>'.get_the_author_posts_link().'</span>
								</div>
							';
						}
						echo '
					</div>
				</article>';
				} else {
				echo'
				<article class="latest-b21 latest-b21-' . $uniqid.' col-md-3">
					<figure class="latest-b21-img">
						<a href="'.get_the_permalink().'">';
								if( !empty($thumbnail_url_2) )
									echo '<img src="'.$thumbnail_url_2.'" alt="' . get_the_title() . '">';
								else
									echo '<img src="'.DEEP_ASSETS_URL . 'images/featured.jpg"  alt="' . get_the_title() . '"/>';
						echo'
						</a>
					</figure>
					<div class="latest-b21-cont">';
					if ( $settings['hide_cat'] == 'show' && $categories ) {
						echo '<div class="latest-b21-category">
							<span class="latest-b21-cat" data-id="' . $uniqid .'"><a href="'.get_category_link($categories[0]->cat_ID).'" class="latestfromblog-cat">'.$categories[0]->cat_name.'</a></span>
						</div>';
					}
					if ( $settings['hide_date'] == 'show' ) {
						echo'<div class="latest-b21-date">
								<i class="pe-7s-clock"></i>'.get_the_date().'
							</div>';
					}
					echo $display_review.'
						<h3 class="latest-b21-title"><a href="'.get_the_permalink().'" class="hcolorf" ' . $target .'>'.get_the_title().'</a></h3>
					</div>
				</article>';
			 }

			$first_post = false;
			$secound_posts = false;
			endwhile;
			wp_reset_postdata();
		}  elseif ( $settings['type'] == 'twenty-two' ) {
			$query = new \WP_Query('posts_per_page=3&category_name='.$settings['category'].'');
			while ($query -> have_posts()) : $query -> the_post();
			$thumbnail_url = get_the_post_thumbnail_url();
			$thumbnail_id  = get_post_thumbnail_id();
			if( !empty( $thumbnail_url ) ) {
				// if main class not exist get it
				if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
					require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
				}
				$image = new \Wn_Img_Maniuplate;
				$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '643' , '482' ); // set required and get result
			}
			echo'
				<div class="col-md-4 wn-latest-b22">
					<article class="latest-b22">
						<figure class="latest-b22-img">';
								if( !empty($thumbnail_url) )
									echo '<img src="'.$thumbnail_url.'" alt="' . get_the_title() . '">';
								else
									echo '<img src="'.DEEP_ASSETS_URL . 'images/featured.jpg"  alt="' . get_the_title() . '"/>';
						echo'
						</figure>
						<div class="latest-b22-content">';
						if ( $settings['hide_date'] == 'show' ) {
							echo '<div class="latest-b22-meta-data">'.get_the_date().'</div>';
						}
						echo '<h2>
								<a href="'.get_permalink($query->ID).'" ' . $target .'>
									'.get_the_title().'
								</a>
							</h2>
						</div>
					</article>
				</div>';
			endwhile;
			wp_reset_postdata();
		} elseif ( $settings['type'] == 'twenty-three' ) {
			$query = new \WP_Query('posts_per_page=5&category_name='.$settings['category'].'');
			while ($query -> have_posts()) : $query -> the_post();
			$thumbnail_url = get_the_post_thumbnail_url();
			$thumbnail_id  = get_post_thumbnail_id();
			if( !empty( $thumbnail_url ) ) {
				// if main class not exist get it
				if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
					require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
				}
				$image = new \Wn_Img_Maniuplate;
				$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '643' , '482' ); // set required and get result
			}
			echo'
				<div class="col-md-6 wn-latest-b23">
					<article class="latest-b23">
						<figure class="latest-b23-img">';
								if( !empty($thumbnail_url) )
									echo '<img src="'.$thumbnail_url.'" alt="' . get_the_title() . '">';
								else
									echo '<img src="'.DEEP_ASSETS_URL . 'images/featured.jpg"  alt="' . get_the_title() . '"/>';
							echo'
						</figure>
						<div class="latest-b23-content">
							<h2>
								<span class="latest-b23-line"></span>
								<span class="latest-b23-dot colorb"></span>
								<a href="'.get_permalink().'" ' . $target .'>'.get_the_title().'</a>
							</h2>
							<p class="latest-excerpt">'.deep_excerpt(19).'</p>
							<a class="readmore" href="'.get_permalink($query->ID).'" ' . $target .'>
								'.esc_html($deep_options['deep_blog_readmore_text']).'
							</a>
						</div>
					</article>
				</div>';
			endwhile;
			wp_reset_postdata();
		} elseif ( $settings['type'] == 'twenty-four' ) {

			$query 			= new \WP_Query('posts_per_page=4&category_name='.$settings['category'].'') ;
			$uniqid 		= substr(uniqid(rand(),1),0,7);
			$title			= $settings['title'] ? '<div class="latest-blg-wrap-title" data-id="' . $uniqid . '">' . $settings['title'] . '</div>' : '';

			// live editor
			// add_action( 'elementor/frontend/after_enqueue_styles', function() {
			// 		return '<style>'.$style.'</style>';
			// } );


			echo '' . $title ;

			?>
			<?php
			while ( $query->have_posts() ) :
				$query->the_post();

				$thumbnail_url = get_the_post_thumbnail_url();

				$thumbnail_id  = get_post_thumbnail_id();

				if( !empty( $thumbnail_url ) ) {

					// if main class not exist get it
					if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {

						require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';

					}

					$image 			= new \Wn_Img_Maniuplate;
					$thumbnail_url 	= $image->m_image( $thumbnail_id, $thumbnail_url , '74' , '74' ); // set required and get result
				}

			echo'
				<article class="latest-b24 col-md-3">
					<figure class="latest-b24-img">
						<a href="'.get_the_permalink().'">';
								if( !empty($thumbnail_url) )
									echo '<img src="'.$thumbnail_url.'" alt="' . get_the_title() . '">';
								else
									echo '<img src="'.DEEP_ASSETS_URL . 'images/featured.jpg"  alt="' . get_the_title() . '"/>';
						echo'
						</a>
					</figure>
					<div class="latest-b24-content">';
					if ( $settings['hide_date'] == 'show' ) {
						echo '<div class="latest-b24-date">
							<i class="pe-7s-clock"></i>'.get_the_date().'
						</div>';
					}
					echo '<h3 class="latest-b24-title">
							<a href="'.get_the_permalink().'" class="hcolorf" ' . $target .'>
								'.get_the_title().'
							</a>
						</h3>
					</div>
				</article>';
			endwhile;
			wp_reset_postdata();
		} elseif ( $settings['type'] == 'twenty-five' ) {
			$item_to_show = $settings['item_to_show'] ? $settings['item_to_show'] : '';
			$query 			= new \WP_Query('posts_per_page=' . $item_to_show . '&category_name='.$settings['category'].'') ;
			$uniqid 		= substr(uniqid(rand(),1),0,7);
			$title			= $settings['title'] ? '<div class="latest-blg-wrap-title" data-id="' . $uniqid . '">' . $settings['title'] . '</div>' : '';

			echo'
				<div class="wn-news-ticker" style="opacity: 0; position: absolute;">
					' . $title .'
					<ul id="wn-news-ticker">';
					while ( $query->have_posts() ) :

					$query->the_post();
					echo'
						<li class="latest-b25 col-md-12">
							<h3 class="latest-b25-title">';
							if ( $settings['hide_date'] == 'show' ) {
								echo '<span class="time">
								<i class="pe-7s-clock"></i>'.human_time_diff( get_the_time('U'), current_time('timestamp') ) . esc_html__( ' ago', 'deep' ).'
								</span>';
							}
							echo '<a href="'.get_the_permalink().'" class="hcolorf" ' . $target .'>
									'.get_the_title().'
								</a>
							</h3>
						</li>';

						endwhile;
						wp_reset_postdata();
					echo'
					</ul>
				</div>';

		} elseif ( $settings['type'] == 'twenty-six') { // Latest From Blog - Type 26
			$item_to_show = $settings['item_to_show'] ? $settings['item_to_show'] : '';
			$query = new \WP_Query('posts_per_page=' . $item_to_show . '&category_name='.$settings['category'].'');
			while ($query -> have_posts()) : $query -> the_post();
			$thumbnail_url = get_the_post_thumbnail_url();
			$thumbnail_id  = get_post_thumbnail_id();
			if( !empty( $thumbnail_url ) ) {
				// if main class not exist get it
				if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
					require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
				}
				$image = new \Wn_Img_Maniuplate;
				$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '140' , '140' ); // set required and get result
			}
			echo'
			<div class="col-md-12">
				<a href="'.get_the_permalink().'" ' . $target .'>
					<article class="latest-b">';
							if (!empty($thumbnail_url)) {
								echo '<figure class="latest-img">';
										echo  '<img src=" ' . $thumbnail_url . ' " alt=" ' . get_the_title() . ' ">';
								echo '</figure>';
							}
						echo'

						<div class="latest-content">
							<h3 class="latest-title">'.get_the_title().'</h3>
							<p class="latest-excerpt">'.deep_excerpt(36).'</p>
						</div>
					</article>
				</a>
			</div>';
			endwhile;
			wp_reset_postdata();
		} elseif ( $settings['type'] == 'twenty-seven') { // Latest From Blog - Type 27
			$item_to_show = $settings['item_to_show'] ? $settings['item_to_show'] : '';
			$query = new \WP_Query('posts_per_page=' . $item_to_show . '&category_name='.$settings['category'].'');
			$counter = 0;

			while ($query -> have_posts()) : $query -> the_post();
				$class = $counter >= 4 ? 'wn-hide': '';

			echo'

				<div class="col-md-12 '.esc_attr($class) .'">
					<article class="latest-27">';
						if ( $settings['hide_date'] == 'show' ) {
							echo '<div class="col-md-4"><p class="blog-date-27"><i class="ti-calendar"></i><span class="latest-27-date">'.get_the_date().'</span></p></div>';
						}
						echo '<div class="col-md-4"><h3 class="latest-title"><a href="'.get_the_permalink().'" ' . $target .'>'.get_the_title().'</a></h3></div>';
						if ( $settings['hide_author'] == 'show' ) {
							echo '<div class="col-md-4"><p class="latest-author"><i class="icon-software-pencil">'.get_the_author_posts_link().'</i></p></div>';
						}
						echo '
					</article>
				</div>';

				$counter++;

			endwhile;
			wp_reset_postdata();

			echo'
			<div class="click-more-latest-27">
				<button class="click-more-latest-btn"><i class="ti-arrow-down"></i></button>
			</div>';
		} elseif ( $settings['type'] == 'twenty-eight' ) { // Latest From Blog - Type 28
			$item_to_show = $settings['item_to_show'] ? $settings['item_to_show'] : '2';
			$query = new \WP_Query('posts_per_page=' . $item_to_show . '&category_name='.$settings['category'].'');
			while ($query -> have_posts()) : $query -> the_post();
			$categories = get_the_category();
			$thumbnail_id = get_post_thumbnail_id();
			$thumbnail_url = get_the_post_thumbnail_url();
			if( !empty( $thumbnail_url ) ) {
				if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
					require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
				}
				$image = new \Wn_Img_Maniuplate;
				$thumbnail_url = $image->m_image( $thumbnail_id , $thumbnail_url , '960' , '678' );
			}
			echo'
				<article class="latest-28">
					<div class="col-md-5">
						<div class="latest-28-inner">
							<h3 class="latest-title-28"><a href="'.get_the_permalink().'" ' . $target .'>'.get_the_title().'</a></h3>
							<p class="latest-excerpt-28 latest-excerpt">'.deep_excerpt(36).'</p>
							<div class="latest-28-details">';
							if ( $settings['hide_cat'] == 'show' && $categories ) {
								echo '<span class="latest-cat-28"><a href="'.get_category_link($categories[0]->cat_ID).'" class="latestfromblog-cat">'.$categories[0]->cat_name.'</a></span>';
							}
							if ( $settings['hide_date'] == 'show' ) {
								echo '<span class="latest-28-date">' . get_the_date() . '</span>';
								echo '<span class="latest-readmore-28">';
								echo '<a href="' . get_the_permalink() . '"' . $target .'>' . esc_html__('read more','deep') . '</a>';
								echo '</span>';
							}
							echo '</div>';
							echo '
						</div>
					</div>
					<div class="col-md-7">';
							if( !empty($thumbnail_url) )
								echo '<img src="'.$thumbnail_url.'" alt="' . get_the_title() . '">';
							else
								echo '<img src="'.DEEP_ASSETS_URL . 'images/featured.jpg" class="latest28-none-img" alt="' . get_the_title() . '"/>';
					echo'
					</div>
				  </article>';
			endwhile;
			wp_reset_postdata();
		}


		if ( $settings['carousel'] == 'yes' || $settings['type'] == 'twenty' ) {

			echo '</div><div class="clearfix"></div>';

		} else {

			echo '</div>';

		}
		echo '</div>';
	}

}
