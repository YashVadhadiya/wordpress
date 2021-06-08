<?php
namespace Elementor;
class Webnus_Element_Widgets_Featured_Products extends \Elementor\Widget_Base {

	/**
	 * Retrieve Distance widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'wn_featured_products';
		
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

		return esc_html__( 'Webnus Featured Products', 'deep' );

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

		return 'pe-7s-star';

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
			'per_page', //param_name
			[
				'label' 	=> __( 'Per page', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::TEXT, //type
				'default'	=> '12',
			]
		);
		$this->add_control(
			'columns', //param_name
			[
				'label' 	=> __( 'Columns', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::TEXT, //type
				'default'	=> '4',
			]
		);
		$this->add_control(
			'orderby', //param_name
			[
				'label' 	=> __( 'Order by', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'date',
				'options' 	=> [ //value
					'date'				=> __( 'Date', 'deep' ),
					'ID'				=> __( 'ID', 'deep' ),
					'author'			=> __( 'Author', 'deep' ),
					'title'				=> __( 'Title', 'deep' ),
					'modified'			=> __( 'Modified', 'deep' ),
					'rand'				=> __( 'Random', 'deep' ),
					'comment_count'		=> __( 'Comment count', 'deep' ),
					'menu_order'		=> __( 'Menu order', 'deep' ),
					'menu_order title'	=> __( 'Menu order & title', 'deep' ),
					'include'			=> __( 'Include', 'deep' ),
				],
			]
		);
		$this->add_control(
			'order', //param_name
			[
				'label' 	=> __( 'Sort order', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'DESC',
				'options' 	=> [ //value
					'DESC' => __( 'Descending', 'deep' ),
					'ASC' => __( 'Ascending', 'deep' ),
				],
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
		$per_page	= $settings['per_page'];
		$columns	= $settings['columns'];
		$orderby	= $settings['orderby'];
		$order		= $settings['order'];

		

		if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			echo do_shortcode(
				shortcode_unautop(
					'[featured_products per_page="' . $per_page . '" columns="' . $columns . '" orderby="' . $orderby . '" order="' . $order . '"]'
				)
			);
		} else {
			echo esc_html__( 'Please install the WooCommerce' , 'deep' );
		}
	}

}