<?php
namespace Elementor;
class Webnus_Element_Widgets_Recipes extends \Elementor\Widget_Base {

	/**
	 * Retrieve Socials widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'recipes';
		
	}

	/**
	 * Retrieve Socials widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Food Recipes', 'deep' );

	}

	/**
	 * Retrieve Socials widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'li_food';

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

		return [ 'wn-deep-recipes' ];
		
	}

	/**
	 * Register Socials widget controls.
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

        // Column
		$this->add_control(
			'column',
			[
				'label' 	=> esc_html__( 'Column', 'deep' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> '3',
				'options' 	=> [
                   		 '3'  	=> esc_html__( '4 Column', 'deep' ),
                   		 '4'  	=> esc_html__( '3 Column', 'deep' ),
                   		 '6'  	=> esc_html__( '2 Column', 'deep' ),
                   		 '12'  	=> esc_html__( '1 Column', 'deep' ),
				],
			]
		);

        // Post Count
        $this->add_control(
            'post_count',
            [
                'label'         => esc_html__( 'Post Count', 'deep' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => 6,
                'min'           => 1,
                'max'           => 48,
                'step'          => 1,
                'description'   => esc_html__( 'Number of grid item(s) to show. Note: When you type nothing it puts for default 6 grid items to show.', 'deep'),
            ]
        );

        // Page Navigation
        $this->add_control(
            'pagination',
            [
                'label'         => esc_html__( 'Page Navigation', 'deep' ),
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
				'selector' => '#wrap {{WRAPPER}} .wn-recipes',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-recipes',
			]
		);

		$this->add_control(
			'box_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-recipes' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'box_shadow',
					'label' => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .wn-recipes',
				]
		);

		$this->add_control(
			'box_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-recipes' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-recipes' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


	}

	/**
	 * Render Socials widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

        ob_start();
        $settings = $this->get_settings_for_display();
    
        // Class & ID 
        $shortcodeclass 	= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
        $shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';        

		$category           = '';
		$column             = $settings['column'];
		$pagination         = $settings['pagination'];
		$post_count         = $settings['post_count'];

        $deep_options = deep_options();
        echo '<div class="clearfix wn-recipes">';
		$column 	= $column ?  $column  : '';
        // Query
        $pagination = $pagination ? get_query_var( is_front_page() ? 'page' : 'paged' ) : '1';
        $recipes_query = array(
			'post_type'			=> 'recipe',
            'posts_per_page'	=> $post_count,
            'paged'				=> $pagination,
        );
        $query = new \WP_Query( $recipes_query );
        while ($query -> have_posts()) : $query -> the_post();
        $thumbnail_url = get_the_post_thumbnail_url();
        $thumbnail_id  = get_post_thumbnail_id(); // id of image
        $post_id		= get_the_ID();
        $cats 			= get_the_terms( $post_id , 'recipe_category' );
        $cats_slug_str	= '';
        $cat_slugs_arr	= array();
        if( !empty( $thumbnail_url ) ) {
            // if main class not exist get it
            if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
            }
            $image = new \Wn_Img_Maniuplate; // instance from settor class
            switch ( $column ) {
                case '3':
                        $thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '319' , '517' ); // set required and get result
                    break;
                case '4':
                        $thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '426' , '517' ); // set required and get result
                    break;
                case '6':
                        $thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '852' , '517' ); // set required and get result
                    break;
                case '12':
                        $thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '1276' , '517' ); // set required and get result
                    break;
            }
        }
        if( is_array( $cats ) ) {
            $recipe_category = array();
            foreach( $cats as $cat ){
                $recipe_category[] = $cat->slug;
            }
        } else {
            $recipe_category = array();
        }
        if ( $cats && ! is_wp_error( $cats ) ) {
            foreach ($cats as $cat) {
                $cat_slugs_arr[] = ' <a href="'. get_term_link($cat, 'recipe_category') .'"> ' . $cat->name . ' </a> ';
            }
            $cats_slug_str = implode( ", ", $cat_slugs_arr );
        }
            $category = ( $cats_slug_str ) ? $cats_slug_str:'';
            $recipe			= rwmb_meta( 'deep_recipe' );
            $food_name		= rwmb_meta( 'deep_recipe_food_name' );
            ?>
            <!-- Single Recipes /Start -->
                <div class="col-md-<?php echo '' . $column; ?> recipe-one <?php echo $shortcodeclass; ?>" <?php echo $shortcodeid; ?>>
                    <article class="recipes">
                        <figure class="recipe-one-img">
                            <img src="<?php echo '' . $thumbnail_url ?>" alt="<?php the_title(); ?>" >
                            <div class="recipe-one-date colorb">
                                <span class="author"><i class="ti-user"></i></strong><?php the_author_posts_link(); ?></span>
                                <span class="categories"><i class="ti-folder"></i><?php echo '' . $category; ?></span>
                                <span class="date"><i class="ti-calendar"></i><?php echo get_the_date(); ?></span>
                            </div>
                        </figure>
                        <div class="recipe-one-content">
                            <h3 class="recipe-one-title"><a href="<?php the_permalink(); ?>" class="hcolorf"><?php echo '' . $food_name . ' ' . $recipe ; ?></a></h3>
                            <p class="latest-excerpt"><?php echo deep_excerpt(31); ?></p>
                        </div>
                    </article>
                </div>
			<!-- Recipes /End -->
            <?php endwhile;
            if ( $pagination != 1 ) : ?>
            <div class="row">
                <div class="col-sm-12">
                    <?php if( function_exists( 'wp_pagenavi' ) )
                        wp_pagenavi( array( 'query' => $query ) );?>
                </div>
            </div>
    <?php endif;
        echo '</div>';
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