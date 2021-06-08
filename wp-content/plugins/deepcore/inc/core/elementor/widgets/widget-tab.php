<?php
namespace Elementor;

class Webnus_Element_Widgets_Tab_Widget extends \Elementor\Widget_Base {

	/**
	 * Retrieve Tab Widget widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'w_tab';

	}

	/**
	 * Retrieve Tab Widget widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return __( 'Webnus Tab Widget', 'deep' );

	}

	/**
	 * Retrieve Tab Widget widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'ti-settings';

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

		return [ 'deep-tabs-widget' ];

	}

	/**
	 * Register Tab Widget widget controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		// Content Tab
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'General', 'deep' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'sort_by', // param_name
			[
				'label'   => __( 'Popular Posts Order By', 'deep' ), // heading
				'type'    => \Elementor\Controls_Manager::SELECT, // type
				'default' => 'comments',
				'options' => [ // value
					'comments' => __( 'Comments', 'deep' ),
					'views'    => __( 'Views', 'deep' ),
				],
			]
		);

		$this->add_control(
			'counter_popular_post', // param_name
			[
				'label'   => __( 'Number of popular posts', 'deep' ), // heading
				'type'    => \Elementor\Controls_Manager::TEXT, // type
				'default' => '5',
			]
		);

		$this->add_control(
			'counter_recent_post', // param_name
			[
				'label'   => __( 'Number of recent posts', 'deep' ), // heading
				'type'    => \Elementor\Controls_Manager::TEXT, // type
				'default' => '5',
			]
		);

		$this->add_control(
			'counter_comments_post', // param_name
			[
				'label'   => __( 'Number of comments', 'deep' ), // heading
				'type'    => \Elementor\Controls_Manager::TEXT, // type
				'default' => '5',
			]
		);

		$this->add_control(
			'show_popular_posts', // param_name
			[
				'label'        => __( 'Popular posts', 'deep' ), // heading
				'type'         => \Elementor\Controls_Manager::SWITCHER, // type
				'label_on'     => __( 'ON', 'deep' ),
				'label_off'    => __( 'OFF', 'deep' ),
				'return_value' => 'on',
				'default'      => 'on',
			]
		);

		$this->add_control(
			'show_recent_posts', // param_name
			[
				'label'        => __( 'Recent posts', 'deep' ), // heading
				'type'         => \Elementor\Controls_Manager::SWITCHER, // type
				'label_on'     => __( 'ON', 'deep' ),
				'label_off'    => __( 'OFF', 'deep' ),
				'return_value' => 'on',
				'default'      => 'on',
			]
		);

		$this->add_control(
			'show_comments', // param_name
			[
				'label'        => __( 'Comments', 'deep' ), // heading
				'type'         => \Elementor\Controls_Manager::SWITCHER, // type
				'label_on'     => __( 'ON', 'deep' ),
				'label_off'    => __( 'OFF', 'deep' ),
				'return_value' => 'on',
				'default'      => 'on',
			]
		);

		$this->end_controls_section();

		// Custom css tab
		$this->start_controls_section(
			'custom_css_section',
			[
				'label' => __( 'Custom CSS', 'deep' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'custom_css',
			[
				'label'      => __( 'Custom CSS', 'deep' ),
				'type'       => \Elementor\Controls_Manager::CODE,
				'language'   => 'css',
				'rows'       => 20,
				'show_label' => true,
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render Tab Widget widget output on the frontend.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$counter_popular_post  = ! empty( $settings['counter_popular_post'] ) ? $settings['counter_popular_post'] : '';
		$counter_recent_post   = ! empty( $settings['counter_recent_post'] ) ? $settings['counter_recent_post'] : '';
		$counter_comments_post = ! empty( $settings['counter_comments_post'] ) ? $settings['counter_comments_post'] : '';
		$show_popular          = $settings['show_popular_posts'] == 'on' ? 'on' : '';
		$show_comments         = $settings['show_comments'] == 'on' ? 'on' : '';
		$show_recent           = $settings['show_recent_posts'] == 'on' ? 'on' : '';
		$sort_by               = ! empty( $settings['sort_by'] ) ? $settings['sort_by'] : '';

		$instance = array(
			'posts'              => $counter_popular_post,
			'comments'           => $counter_comments_post,
			'tags'               => $counter_recent_post,
			'show_popular_posts' => $show_popular,
			'show_recent_posts'  => $show_recent,
			'show_comments'      => $show_comments,
			'show_tags'          => '',
			'orderby'            => $sort_by,
		);

		$args = array(
			'before_title' => '<div class="subtitle-wrap"><h4 class="subtitle">',
			'after_title'  => '</h4></div>',
		);

		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>' . $custom_css . '</style>';
		}

		echo get_the_widget( 'WebnusWidgetTabs', $instance, $args );

	}

}
