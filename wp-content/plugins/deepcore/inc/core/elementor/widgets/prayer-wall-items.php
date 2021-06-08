<?php
namespace Elementor;
class Webnus_Element_Widgets_Prayer_Wall_Items extends \Elementor\Widget_Base {

	/**
	 * Retrieve Single Cause widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'prayer_wall_items';
		
	}

	/**
	 * Retrieve Single Cause widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Prayer Wall Items', 'deep' );

	}

	/**
	 * Retrieve Single Cause widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'fa fa-wpforms';

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
	 * Register Single Cause widget controls.
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
				'label' => esc_html__( 'Prayer wall items', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		// Show Prayer Wall Items
        $this->add_control(
        'post',
        [
            'label'         => esc_html__( 'Show Prayer Wall Items', 'deep' ),
            'type'          => Controls_Manager::RAW_HTML,                        
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
	 * Render Single Cause widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
     
    ?>
    
		<div class="wn-prayer-items">
			<?php echo do_shortcode('[prayer-wall]'); ?>
		</div>

		<div class="row">
			<div class="col-md-12">
				<?php
					$args = array(
						'post_type'   => 'prayerwall',
						'post_status' => 'publish',
					);
					$query = new \WP_Query( $args );
					// Pagination 
					if( function_exists( 'wp_pagenavi' ) )
					wp_pagenavi( array( 'query' => $query ) );	
				?>
			</div>
		</div>

	<?php
		
		$settings = $this->get_settings();
        $custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}

	}

}