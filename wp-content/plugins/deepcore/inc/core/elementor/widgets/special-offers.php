<?php
namespace Elementor;

class Webnus_Element_Widgets_Special_Offers extends \Elementor\Widget_Base {

	/**
	 * Retrieve Special Offers widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'special_offers';

	}

	/**
	 * Retrieve Special Offers widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Special Offers', 'deep' );

	}

	/**
	 * Retrieve Special Offers widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'icon-pricetags';

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

		return [ 'deep-owl-carousel', 'countdown' ];

	}

	/**
	 * enqueue styles.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'deep-owl-carousel' ];

	}

	/**
	 * Register Special Offers widget controls.
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

        $special_offers_product = array(
            'post_type'			=> 'product',
            'order'				=> 'ASC',
            'posts_per_page'	=> '-1',
        );

        $spo_query = new \WP_Query( $special_offers_product );
        $titles = array();
        if ( $spo_query->have_posts() ) {
            $titles[] = esc_html__( 'Please select a product', 'deep' );
            while ( $spo_query->have_posts() ) {
                $spo_query->the_post();

                $product_has_off		= get_post_meta( get_the_id(), '_sale_price', true );
                $sale_price_dates_from	= get_post_meta( get_the_id(), '_sale_price_dates_from', true );
                $sale_price_dates_to	= get_post_meta( get_the_id(), '_sale_price_dates_to', true );

                // Get the discount
                if ( $product_has_off != '' ) {
                    $titles[get_the_ID()] = get_the_title();
                }
            }

		}
		wp_reset_postdata();


		// Category Select
        $this->add_control(
            'post_to_show',
            [
                'label'         => esc_html__( 'Select Category', 'deep' ),
                'type'          => Controls_Manager::SELECT,
                'description'   => esc_html__( 'Select Specific Category', 'deep'),
                'options'       => $titles,
            ]
        );

        // Link Target
        $this->add_control(
            'link_target',
            [
                'label' => esc_html__( 'Open link in a new tab? ', 'deep' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'false',
                'true' => esc_html__( 'Yes', 'deep' ),
                'false' => esc_html__( 'No', 'deep' ),
                'return_value' => 'yes',
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
	 * Render Special Offers widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		ob_start();

        $settings 			= $this->get_settings_for_display();

		$post_to_show 		= $settings['post_to_show'];
		$link_target 		= $settings['link_target'];
        // Class & ID
        $shortcodeclass 	= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
        $shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';
		$out = '';

		$link_target_tag = '';
		if ( $link_target == 'yes' ){
			$link_target_tag = ' target="_blank" ';
		}
		$special_offers_product = array(
			'post_type'			=> 'product',
			'order'				=> 'ASC',
			'posts_per_page'	=> '-1',
			'p'					=> $post_to_show,
		);

		$so_query = new \WP_Query( $special_offers_product );

		if ( $so_query->have_posts() ) {

			while ( $so_query->have_posts() ) {
				$so_query->the_post();
				global $product, $woocommerce, $product_id;

				// Get Variables
				$product_id					= get_the_ID();
				$product					= wc_get_product( $product_id );
				$discount					= get_post_meta( get_the_id(), '_sale_price', true ) ? get_post_meta( get_the_id(), '_sale_price', true ) : '';
				$sale_price_dates_from		= get_post_meta( get_the_id(), '_sale_price_dates_from', true );
				$sale_price_dates_to		= get_post_meta( get_the_id(), '_sale_price_dates_to', true );
				$deep_offer_finish_text		= get_post_meta( get_the_id(), '_deep_offer_finish_text', true ) ? get_post_meta( get_the_id(), '_deep_offer_finish_text', true ) : 'Offering time is over';
				$regular_price				= $product->get_regular_price();
				$sale_price					= $product->get_sale_price() ? $product->get_sale_price() : '0';
				$woo_currency				= get_woocommerce_currency_symbol();
				$sale_price_dates_to		= ( $date = get_post_meta( get_the_ID(), '_sale_price_dates_to', true ) ) ? date_i18n( 'dF Y', $date ) : '';
				$precent_discount			= round( ( $regular_price - $sale_price ) / $regular_price * 100 ) ;
				$countdown 					= \Elementor\Plugin::instance()->elements_manager->create_element_instance(
					[
						'elType'		=> 'widget',
						'widgetType'	=> 'wn_countdown',
						'id'			=> 'stubID',
						'settings'		=> [
							'type'		=> 'simple',
							'datetime'	=> $sale_price_dates_to,
							'done'		=> $deep_offer_finish_text,
						],
					]
				);
				// Check Product To Have Discount
				if ( $discount ) {
					// Product Gallery
					$attachment_ids = $product->get_gallery_image_ids(); ?>
					<div class="wn-special-offer-wrap special-offer-<?php echo esc_attr( $product_id ); ?> <?php echo $shortcodeclass; ?>" <?php echo $shortcodeid; ?>>
						<div class="col-sm-7 special-offer-left-sec">
							<h2 class="wn-so-title">
								<a href="<?php echo the_permalink(); ?> " <?php echo '' . $link_target_tag; ?>><?php echo esc_html__( 'Special ', 'deep' ) . esc_html( $precent_discount ) . '%' . esc_html__( ' discount', 'deep' ) ?></a>
							</h2>
							<p class="wn-so-excerpt"><?php echo deep_excerpt(15); ?> </p>
							<div class="sp-offer-gallery owl-carousel owl-theme" >
								<?php foreach( $attachment_ids as $attachment_id ) {
										$thumbnail_url = wp_get_attachment_url( $attachment_id );
										if( !empty( $thumbnail_url ) ) {
											// if main class not exist get it
											if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
													require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
											}
											$image = new \Wn_Img_Maniuplate; // instance from settor class
											$thumbnail_url = $image->m_image( $attachment_id, $thumbnail_url , '314' , '389' ); // set required and get result
										} ?>
										<img class="thumb" src="<?php echo '' . $thumbnail_url; ?>" alt="<?php the_title(); ?>">
								<?php } ?>
							</div>
							<?php if ( is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) ) {
								$is_in_wishlist = ( YITH_WCWL()->is_product_in_wishlist( $product_id ) ) ? 'wn-added-wishlist' : 'no';
								$added_wishlist = ( YITH_WCWL()->is_product_in_wishlist( $product_id ) )  ? esc_html__( 'Appended', 'deep' ) :  esc_html__( 'Add to Wishlist', 'deep' ) ; ?>
								<div class="wn-woo-btn wn-wishlist-btn <?php  echo '' . $is_in_wishlist ?>" data-wntooltip="<?php  echo '' . $added_wishlist ?>" data-id="<?php echo get_the_ID(); ?>">
									<i class="pe-7s-like"></i>
								</div>
							<?php } ?>

							<?php if ( is_plugin_active( 'yith-woocommerce-quick-view/init.php' ) ) { ?>
								<div class="wn-woo-btn wn-quick-view-btn" data-wntooltip="'. esc_html__( 'Quick View', 'deep' ) .'">
									<?php $quick_view = new \YITH_WCQV_Frontend(); ?>
									<?php $quick_view->yith_add_quick_view_button(); ?>
									<i class="pe-7s-search"></i>
								</div>
							<?php } ?>
						</div>
						<div class="col-sm-5 special-offer-right-sec">
							<h3><?php esc_html_e( 'special offer', 'deep' )?></h3>
							<h6><?php echo '' . $woo_currency . $sale_price ; ?></h6>
							<p><?php echo '' . $woo_currency . $regular_price ; ?></p>
							<?php if ( ! empty( $sale_price_dates_from ) && ! empty( $sale_price_dates_to ) ) { ?>
								<div class="sp-cout-down">
									<?php $countdown->print_element(); ?>
								</div>
							<?php } ?>
							<a class="readmore" href="<?php the_permalink(); ?> " <?php echo '' . $link_target_tag; ?>><?php esc_html_e( 'buy now', 'deep' ); ?> </a>
						</div>
					</div>
				<?php
				}
			}
		}

		$out = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();

        $custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}

		echo $out;

	}

}
