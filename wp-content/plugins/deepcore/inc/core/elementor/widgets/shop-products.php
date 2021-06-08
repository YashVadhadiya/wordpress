<?php
namespace Elementor;

class Webnus_Element_Widgets_Shop_Products extends \Elementor\Widget_Base {

	/**
	 * Retrieve Shop Products widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'shop_products';

	}

	/**
	 * Retrieve Shop Products widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Shop Products', 'deep' );

	}

	/**
	 * Retrieve Shop Products widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'ti-shopping-cart-full';

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
	 * Register Shop Products widget controls.
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
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);
		// Select Shop Products Type
        $this->add_control(
            'more_options',
            [
                'label'             => 'This shortcode uses Theme Options inside settings. Please go to this direction: Theme Options > Shop',
                'type'              => Controls_Manager::HEADING,
                'separator'         => 'before',
            ]
        );

        $this->end_controls_section();

		// Class & ID Tab
		$this->start_controls_section(
			'classid_section',
			[
				'label' => __( 'Class & ID', 'deep' ),
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
	 * Render Shop Products widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

        ob_start();

        $settings = $this->get_settings_for_display();
        // Class & ID
        $shortcodeclass 	= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
        $shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';
		$number_of_columns  = '';
		$out				= '';
		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			$out .= '
			<style>
				.wn-woo-wrap.wn-woo-has-left-sidebar
				.wn-woo-main.wn-woo-has-sidebar {
					width: 100%;
					padding-left: 0;
				}
				.wn-woo-wrap .wn-woo-sidebar {
					display: none;
				}
			</style>';
		}

        if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) :
            echo '<div class="wn-shop-products-shortocde post-type-archive-product ' . $shortcodeclass . '"  ' . $shortcodeid . '>';
            echo '<div id="wn-woo-wrap" class="wn-woo-wrap wn-woo-has-left-sidebar clearfix">';

                $deep_options = deep_options();
                $product_columns = isset( $deep_options['deep_woo_shop_products_in_shop'] ) ? 'columns-' . $deep_options['deep_woo_shop_products_in_shop'] : '';
                $paged	= (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args	= array(
                    'post_type' 		=> 'product',
					'paged'				=> $paged,
					'posts_per_page'	=> '10',
                );
                $loop = new \WP_Query( $args );
                if ( $loop->have_posts() ) {
                    do_action( 'woocommerce_before_shop_loop' );
                    echo '<ul class="products ' . $product_columns . ' ">';
                    while ( $loop->have_posts() ) : $loop->the_post();
                        wc_get_template_part( 'content', 'product' );
                    endwhile;
                    echo '</ul>';
                    // Display numbered pagination
                    echo '<nav class="woocommerce-pagination">';
					echo str_replace(
						home_url(),
						get_permalink( wc_get_page_id( 'shop' ) ),
						paginate_links( array(
							'base'        	=> esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
							'format'		=> '?paged=%#%',
							'add_args'    	=> false,
							'current' 	  	=> max( 1, get_query_var('paged') ),
							'total' 	  	=> $loop->max_num_pages,
							'prev_text'   	=> '&larr;',
							'next_text'   	=> '&rarr;',
							'type'        	=> 'list',
							'end_size'    	=> 3,
							'mid_size'    	=> 3
						) )
						);
                    echo '</nav>';
                } else {
                    esc_html_e( 'No products found' , 'deep' );
                }
                wp_reset_postdata();
            echo '</div>';
            echo '</div>';
        endif;
        $out .= ob_get_contents();
        ob_end_clean();

        $custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}

		echo $out;

	}

}
