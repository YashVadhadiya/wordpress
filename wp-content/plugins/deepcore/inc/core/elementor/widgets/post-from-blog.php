<?php
namespace Elementor;
class Webnus_Element_Widgets_Post_From_Blog extends \Elementor\Widget_Base {

	/**
	 * Retrieve Post From Blog widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'post_from_blog';
		
	}

	/**
	 * Retrieve Post From Blog widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Single Post From Blog', 'deep' );

	}

	/**
	 * Retrieve Post From Blog widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'icon-basic-postcard';

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
	 * widget styles.
	 *
	 * @since 4.2.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'wn-deep-post-from-blog' ];

	}

	/**
	 * Register Post From Blog widget controls.
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

		// Select Post From Blog Type
		$this->add_control(
			'type', //param_name
			[
				'label' 	=> esc_html__( 'Type', 'deep' ), //heading
				'type' 		=> Controls_Manager::SELECT, //type
				'default' 	=> '1',
				'options' 	=> [
                   		 '1'  	=> esc_html__( 'Type 1', 'deep' ),
                   		 '2'  	=> esc_html__( 'Type 2', 'deep' ),
				],
			]
        );
        
		// Post ID
		$this->add_control(
			'post', //param_name
			[
				'label' 		=> esc_html__( 'Post ID', 'deep' ), //heading
				'type' 			=> Controls_Manager::TEXT, //type
				'placeholder' 	=> esc_html__( 'EX: 4955', 'deep' ),
			]
		);

        // Target Link
        $this->add_control(
            'link_target',
            [
                'label'         => esc_html__( 'Open link in a new tab?', 'deep' ),
                'type'          => Controls_Manager::SWITCHER,
                'default'       => '',
                'on'            => esc_html__( 'Enable', 'deep' ),
                'off'           => esc_html__( 'Disable', 'deep' ),
                'return_value'  => 'enable',
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

		// Style
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
				'selector' 	=> '#wrap {{WRAPPER}} .wn-single-post-blog .latest-title, #wrap {{WRAPPER}} .a-post-box-2 .latest-title a',
			]
		);

		$this->add_control(
			'title_color', //param_name
			[
				'label' 		=> __( 'Color', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::COLOR, //type
				'selectors' 	=> [
					'#wrap {{WRAPPER}} .wn-single-post-blog .latest-title a, #wrap {{WRAPPER}} .a-post-box-2 .latest-title a' => 'color: {{VALUE}} !important',
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
			Group_Control_Background::get_type(),
			[
				'name' => 'box_bg',
				'label' => __( 'Background', 'deep' ),
				'types' => [ 'classic' , 'gradient' ],
				'selector' => '#wrap {{WRAPPER}} .wn-single-post-blog',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-single-post-blog',
			]
		);

		$this->add_control(
			'box_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-single-post-blog' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'box_shadow',
					'label' => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .wn-single-post-blog',
				]
		);

		$this->add_control(
			'box_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-single-post-blog' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-single-post-blog' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'box_align',
			[
				'label' => __( 'Link Alignment', 'deep' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'deep' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'deep' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'deep' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'toggle' => true,
				'selectors' => [
					'#wrap {{WRAPPER}} .latest-txt' => 'text-align: {{VALUE}}',
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
	 * Render Post From Blog widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

        ob_start();	

		$settings = $this->get_settings_for_display();
		$type               = $settings['type'];
		$post               = $settings['post'];
		$link_target        = $settings['link_target'];
        // Class & ID 
        $shortcodeclass 	= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
        $shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';
        $link_target_tag = '';
        if ( $link_target == 'enable' ){
            $link_target_tag = ' target="_blank" ';
        }
		$gcolor = '#000' ;
		static $uniqid = 0;
		$uniqid++;

        $query = new \WP_Query('p='.$post.'');
        if ($query -> have_posts()) : $query -> the_post();
        $thumbnail_id  = get_post_thumbnail_id();
        $thumbnail_url  = get_the_post_thumbnail_url();
        if( !empty( $thumbnail_url ) ) {
            // if main class not exist get it
            if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
            }
            $image = new \Wn_Img_Maniuplate; // instance from settor class
            $thumbnail_url = $image->m_image( $thumbnail_id , $thumbnail_url , '690' , '460' ); // set required and get result
        }
        if ( $type == 1 ) {
    ?>
        <article class="wn-single-post-blog a-post-box-<?php echo  $type; ?> <?php echo $shortcodeclass; ?>" <?php echo $shortcodeid; ?>>
            <figure class="latest-img"><img src="<?php echo  $thumbnail_url; ?>" alt="<?php the_title(); ?>"></figure>
                <div class="latest-overlay"></div>
                <div class="latest-txt">
                    <h4 class="latest-title"><a href="<?php the_permalink(); ?>" <?php echo '' . $link_target_tag; ?>><?php the_title(); ?></a></h4>
                    <span class="latest-cat"><?php the_category(' / '); ?></span>
                    <span class="latest-date"><i class="sl-clock"></i> <?php the_time(get_option( 'date_format' )); ?></span>
                </div>
        </article>
    <?php
        }
        if ( $type == 2 ) { ?>

            <article class="a-post-box-<?php echo  $type; ?> a-post-box-<?php echo esc_html( $type) . $uniqid; ?>">
                <figure class="latest-img"><img src="<?php echo  $thumbnail_url; ?>" alt="<?php the_title(); ?>" ></figure>
                    <div class="latest-txt">
                        <span class="latest-cat">
                            <div class="latest-color"></div>
                            <?php the_category(' / '); ?>
                        </span>
                        <span class="latest-date"><?php the_time(get_option( 'date_format' )); ?></span>
                        <h4 class="latest-title"><a href="<?php the_permalink(); ?>" <?php echo '' . $link_target_tag; ?>><?php the_title(); ?></a></h4>
                    </div>
            </article> <?php
        }
		endif;
		$style	= '.a-post-box-' . $type . $uniqid . ' .latest-color { background: ' . deep_category_color($post) . '; }';

		deep_save_dyn_styles( $style );

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