<?php
namespace Elementor;

class Webnus_Element_Widgets_The_Grid extends \Elementor\Widget_Base {

	/**
	 * Retrieve the grid widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'wn_the_grid';
		
	}

	/**
	 * Retrieve the grid widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return __( 'Webnus The Grid', 'deep' );

	}

	/**
	 * Retrieve the grid widget icon.
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
	 * Register the grid widget controls.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$post_args = array(
			'post_type'      => 'the_grid',
			'post_status'    => 'any',
			'posts_per_page' => -1,
			'orderby'        => 'modified',
			'suppress_filters' => true,
			'no_found_rows' => true,
			'cache_results' => false
		);

		$grids = get_posts($post_args);

		$the_grid_array = array();
		foreach ($grids as $grid ) {
			$grid_ID   = $grid->ID;
			$the_grid_array[$grid->post_title] = $grid->post_title;
		}
		if ( empty( $the_grid_array ) ) {
			$the_grid_array = esc_html__( 'No Grid Found', 'deep' );
		}

		// Content Tab
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'General', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);
		
		// Select Type Section
		$this->add_control(
			'alias', //param_name
			[
				'label' 	=> __( 'Select Type', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'options' 	=> $the_grid_array,
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
	 * Render the grid widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		
		$settings = $this->get_settings();

        $custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
        }

		echo do_shortcode( '[the_grid name="'.$settings['alias'].'"]' ) ;

	}

}