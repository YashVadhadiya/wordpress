<?php
namespace Elementor;

class Webnus_Element_Widgets_Portfolio_Carousel extends \Elementor\Widget_Base {

	/**
	 * Retrieve Portfolio Carousel widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'portfolio_carousel';

	}

	/**
	 * Retrieve Portfolio Carousel widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Portfolio Carousel', 'deep' );

	}

	/**
	 * Retrieve Portfolio Carousel widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-posts-carousel';

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

		return [ 'deep-owl-carousel', 'deep-portfolio-carousel' ];

	}

	/**
	 * widget styles.
	 *
	 * @since 4.2.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'deep-owl-carousel', 'wn-deep-portfolio-carousel' ];

	}

	/**
	 * Register Portfolio Carousel widget controls.
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

		// Select Type Section
		$this->add_control(
			'type', //param_name
			[
				'label' 	=> __( 'Select Type', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> '1',
				'options' 	=> [ //value
					'1'  	=> __( 'Type 1', 'deep' ),
					'2' 	=> __( 'Type 2', 'deep' ),
				],
			]
		);

		// Carousel Count
		$this->add_control(
			'carousel_count',
			[
				'label' 		=> esc_html__( 'Carousel Count', 'deep' ),
				'type' 			=> Controls_Manager::TEXT,
				'placeholder' 	=> esc_html__( 'Example: 7', 'deep' ),
			]
		);

        // Show Post Title
        $this->add_control(
            'enable_title',
            [
                'label'         => esc_html__( 'Show Post Title', 'deep' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => '',
                'on'            => esc_html__( 'Enable', 'deep' ),
                'off'           => esc_html__( 'Disable', 'deep' ),
				'return_value'  => 'enable',
				'condition' 	=> [ //dependency
					'type' 	=> [
						'1'
					],
				],
            ]
        );

        // Show Post Content
        $this->add_control(
            'enable_content',
            [
                'label'         => esc_html__( 'Show Post Content', 'deep' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => '',
                'on'            => esc_html__( 'Enable', 'deep' ),
                'off'           => esc_html__( 'Disable', 'deep' ),
				'return_value'  => 'enable',
				'condition' 	=> [ //dependency
					'type' 	=> [
						'1'
					],
				],
            ]
		);

		//  Title
		$this->add_control(
			'title',
			[
				'label' 		=> esc_html__( 'Title', 'deep' ),
				'type' 			=> Controls_Manager::TEXT,
				'condition'		=> [
					'type'   => [
						'2'
					]
				]
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

		$this->start_controls_section(
			'section_box_style',
			[
				'label' => __( 'Box Style', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'box_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' , 'gradient' ],
				'selector' => '#wrap {{WRAPPER}} .related-works',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .related-works',
			]
		);

		$this->add_control(
			'box_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .related-works' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'box_shadow',
					'label' => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .related-works',
				]
		);

		$this->add_control(
			'box_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .related-works' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .related-works' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render Portfolio Carousel widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		ob_start();

        $settings           = $this->get_settings();

		$carousel_count     = $settings['carousel_count'];
		$enable_title       = $settings['enable_title'];
		$enable_content     = $settings['enable_content'];
		$title			    = $settings['title'];

        // Class & ID
        $shortcodeclass 	= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
        $shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';

        $post_id = get_the_ID();

        // new Query
        $args = array(
            'post_type'		 => 'portfolio',
            'posts_per_page' => $carousel_count,
            'post__not_in'	 => array( $post_id ),
        );
        $rw_query = new \WP_Query( $args );

        if ( 'enable' == $enable_title ) {
            $title_state    = 'enable';
        } else {
			$title_state = '';
		}
        if ( 'enable' == $enable_content ) {
            $content_state  = 'enable';
        } else {
			$content_state = '';
		}

        ?>
        <?php
			if ( $settings['type'] == '1' ) {
		?>
			<section class="related-works ' . $shortcodeclass . '"  ' . $shortcodeid . '>
            <!-- latest-projects (owl-carousel) -->
            <ul id="portfolio" class="portfolio-carousel owl-carousel owl-theme ">
                <?php if ( $rw_query->have_posts() ) :
                    while ( $rw_query->have_posts() ) :
                        $rw_query->the_post(); ?>
                            <li class="portfolio-item">
                                <a class="portfolio-img">
                                <?php
                                    $thumbnail_url = get_the_post_thumbnail_url();
                                    $thumbnail_id  = get_post_thumbnail_id();
                                    if( !empty( $thumbnail_url ) ) {
                                        if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                                            require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
                                        }
                                        $image = new \Wn_Img_Maniuplate; // instance from settor class
                                        $thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '591' , '461' ); // set required and get result
                                    } elseif ( empty( $thumbnail_url ) ) {
                                        $thumbnail_url = get_template_directory_uri() . '/images/no_image_att.jpg' ;
                                    }
                                ?>
                                <img src="<?php echo '' . $thumbnail_url ?>" alt="<?php the_title(); ?>">
                                </a>
                                <div class="bgc-overlay"></div>
                                <h5 class="portfolio-title <?php echo '' . $title_state ?> "><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                <div class="portfollo-content <?php echo '' . $content_state ?> "><?php echo deep_excerpt(25); ?></div>
                            </li>
                <?php endwhile; endif;
             ?>
            </ul> <!-- end latest-projects -->
        	</section> <!-- end related-works -->
		<?php
			}
		?>


		<?php if ( $settings['type'] == '2' ) { ?>

			<section class="related-works">
				<!-- subtitle -->
				<div class="portfolio-carousel-subtitle">
					<h4 class="subtitle"><?php echo esc_html( $title ); ?></h4>
					<!-- owl-carousel custom navigation -->
					<div class="latest-projects-navigation">
						<a class="btn prev"><i class="wn-fas wn-fa-angle-left"></i></a>
						<a class="btn next"><i class="wn-fas wn-fa-angle-right"></i></a>
					</div>
				</div>

				<!-- latest-projects (owl-carousel) -->
				<ul id="latest-projects-<?php echo esc_attr( $settings['type'] ); ?>" class="owl-carousel owl-theme">
					<?php if ( $rw_query->have_posts()) : while ( $rw_query->have_posts() ) : $rw_query->the_post(); ?>
						<li class="portfolio-item">
							 <a class="portfolio-img">
                                <?php
                                    $thumbnail_url = get_the_post_thumbnail_url();
                                    $thumbnail_id  = get_post_thumbnail_id();
                                    if( !empty( $thumbnail_url ) ) {
                                        if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                                            require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
                                        }
                                        $image = new \Wn_Img_Maniuplate; // instance from settor class
                                        $thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '300' , '200' ); // set required and get result
                                    } elseif ( empty( $thumbnail_url ) ) {
                                        $thumbnail_url = get_template_directory_uri() . '/images/no_image_att.jpg' ;
                                    }
                                ?>
                                <img src="<?php echo '' . $thumbnail_url ?>" alt="<?php the_title(); ?>">
                                </a>
							<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
							<div class="portfolio-meta"><?php echo '<span class="portfolio-date">' . get_the_date() . '</span>'; ?></div>
						</li>
					<?php endwhile; endif;
					wp_reset_query(); ?>
				</ul> <!-- end latest-projects -->
			</section> <!-- end related-works -->


        <?php
		}
        $out = ob_get_contents();
        ob_end_clean();
        $out = str_replace('<p></p>','',$out);
        $custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}
        echo $out;

	}

}
