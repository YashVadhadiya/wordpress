<?php
namespace Elementor;
class Webnus_Element_Widgets_Single_Sermon extends \Elementor\Widget_Base {

	/**
	 * Retrieve Single Sermon widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'single_sermon';

	}

	/**
	 * Retrieve Single Sermon widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Single Sermon', 'deep' );

	}

	/**
	 * Retrieve Single Sermon widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'ti-microphone';

	}

	public function get_style_depends() {

		return [ 'wn-deep-asermon' ];

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
	 * Register Single Sermon widget controls.
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

		// Select Single Sermon Type
		$this->add_control(
			'type', //param_name
			[
				'label' 	=> esc_html__( 'Type', 'deep' ), //heading
				'type' 		=> Controls_Manager::SELECT, //type
				'default' 	=> 'latest',
				'options' 	=> [
                   		 'latest'  	=> esc_html__( 'Latest Sermon', 'deep' ),
                   		 'custom'  	=> esc_html__( 'Custom Sermon', 'deep' ),
				],
			]
        );

		// Select Single Sermon Style
		$this->add_control(
			'style', //param_name
			[
				'label' 	=> esc_html__( 'Style', 'deep' ), //heading
				'type' 		=> Controls_Manager::SELECT, //type
				'default' 	=> '',
				'options' 	=> [
                   		 ''  	    => esc_html__( 'Standard', 'deep' ),
                   		 'boxed'  	=> esc_html__( 'Boxed', 'deep' ),
				],
			]
		);

		// Sermon Title
		$this->add_control(
			'box_title',
            [
                'label' 		=> esc_html__( 'Sermon Title', 'deep' ),
                'type' 			=> Controls_Manager::TEXT,
                'placeholder' 	=> esc_html__( 'Title', 'deep' ),
                'condition'     => [
                        'style'     => [
                            'boxed',
                        ],
                ],
            ]
		);

		// Sermon ID
		$this->add_control(
			'post',
            [
                'label' 		=> esc_html__( 'Sermon Post ID', 'deep' ),
                'type' 			=> Controls_Manager::TEXT,
                'placeholder' 	=> esc_html__( 'Post ID ex: 4976', 'deep' ),
                'condition'   => [
                        'type'   => [
                            'custom'
                        ],
                ],
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
				'selector' => '#wrap {{WRAPPER}} .wn-single-sermon-boxed,#wrap {{WRAPPER}} .sermons-grid-wrap',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-single-sermon-boxed,#wrap {{WRAPPER}} .sermons-grid-wrap',
			]
		);

		$this->add_control(
			'box_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-single-sermon-boxed,#wrap {{WRAPPER}} .sermons-grid-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'box_shadow',
					'label' => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .wn-single-sermon-boxed,#wrap {{WRAPPER}} .sermons-grid-wrap',
				]
		);

		$this->add_control(
			'box_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-single-sermon-boxed,#wrap {{WRAPPER}} .sermons-grid-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .wn-single-sermon-boxed,#wrap {{WRAPPER}} .sermons-grid-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


	}

	/**
	 * Render Single Sermon widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

        ob_start();

        $settings           = $this->get_settings_for_display();

        $post               = $settings['post'];
        $type               = $settings['type'];
        $style              = $settings['style'];
        $box_title          = $settings['box_title'];
        // Class & ID
        $shortcodeclass 	= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
        $shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';
        $w_post = ($type=='custom')?'&p='.$post:'&posts_per_page=1';
        $query = new \WP_Query('post_type=sermon'.$w_post);
        if ($query -> have_posts()) : $query -> the_post();
        //terms
            $post_id = get_the_ID();
            $terms = get_the_terms( $post_id , 'sermon_speaker' );
            if(is_array($terms)){
                $sermon_speaker= array();
                foreach($terms as $term){
                    $sermon_speaker[] = $term->slug;
                }
            }else $sermon_speaker=array();
            $terms = get_the_terms(get_the_id(), 'sermon_speaker' );
            $terms_slug_str = '';
            if ($terms && ! is_wp_error($terms)) :
                $term_slugs_arr = array();
            foreach ($terms as $term) {
                $term_slugs_arr[] = $term->name;
            }
            $terms_slug_str = implode( ", ", $term_slugs_arr);
            endif;
            //cats
            $cats = get_the_terms( $post_id , 'sermon_category' );
            if(is_array($cats)){
                $sermon_category = array();
                foreach($cats as $cat){
                    $sermon_category[] = $cat->slug;
                }
            }else $sermon_category=array();
            $cats = get_the_terms(get_the_id(), 'sermon_category' );
            $cats_slug_str = '';
            if ($cats && ! is_wp_error($cats)) :
                $cat_slugs_arr = array();
            foreach ($cats as $cat) {
                $cat_slugs_arr[] = '<a href="'. get_term_link($cat, 'sermon_category') .'">' . $cat->name . '</a>';
            }
            $cats_slug_str = implode( ", ", $cat_slugs_arr);
            endif;
            $content ='<p>'. deep_excerpt(28) .'</p>';
            $date = get_the_time('F d, Y');
            $sep2 = ($date && $terms_slug_str )?' | ':'';
            $speaker = get_the_term_list( get_the_id() , 'sermon_speaker' , esc_html__('Speaker: ','deep') );
            $title = get_the_title();
            $permalink = get_the_permalink();
            $image = get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'sermons-grid','echo'=>false, ) );
            $button=($style=='hasbutton')?'button dark-gray medium':'';
            global $sermon_meta;
            $sermon_video			= rwmb_meta( 'deep_sermon_video' );
            $sermon_audio			= rwmb_meta( 'deep_sermon_audio' );
            $sermon_attachment		= rwmb_meta( 'deep_sermon_attachment' );
            $download_file = '<a href="'.$sermon_attachment.'" class="button larg " target="_self"><span><i class="pe-7s-cloud-download"></i>'.esc_html__('DOWNLOAD','deep').'</span></a>';
            $sermons_meta =
            '<div class="media-links">
            <a href="'.$sermon_video.'" class="wn-sermon-media button larg" target="_self" data-effect="mfp-zoom-in"><span><i class="pe-7s-play"></i>'.esc_html__('WATCH','deep').'</span></a>
            <a href="#w-audio-'.$post_id.'" class="inlinelb button larg " target="_self"><span><i class="pe-7s-headphones"></i>'.esc_html__('LISTEN','deep').'</span></a>
            <div style="display:none">
                <div class="w-audio w-audio-'.$post_id.'">
                    '.do_shortcode('[audio mp3="'.$sermon_audio.'"][/audio]').'
                </div>
            </div>
            ' . $download_file . '
            <a href="' . get_the_permalink() . '" class="button larg "><span><i class="pe-7s-notebook"></i>'.esc_html__('READ MORE','deep').'</span></a>
        </div>';
            $sermon_read ='<a class="'.$button.'" href="'.$permalink.'" target="_self"><span><i class="wn-fa wn-fa-book"></i>'.esc_html__('READ MORE','deep').'</span></a>';
            if( $style == 'boxed' ){
                $thumbnail_id 	= get_post_thumbnail_id();
                $thumbnail_url 	= get_the_post_thumbnail_url();
                if( !empty( $thumbnail_url ) ) {
                    // if main class not exist get it
                    if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
                        require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
                    }
                    $image = new \Wn_Img_Maniuplate; // instance from settor class
                    $thumbnail_url = $image->m_image( $thumbnail_id ,$thumbnail_url , '720' , '388' ); // set required and get result
                }
                echo '<article class="wn-single-sermon-boxed a-sermon-boxed ' . $shortcodeclass . '"  ' . $shortcodeid . '>';
                echo '<div class="sermon-boxed-top"><img src="'.$thumbnail_url.'">';
                echo( $box_title ) ? '<h3>' . $box_title . '</h3>' : '' ;
                echo '</div><h4><a href="'.$permalink.'">'.$title.'</a></h4><div class="sermon-detail">'.$speaker.' | '.$date.'</div>';
                echo '' . $content . $sermons_meta ;
                echo '</article>';
            } else {
                $download_file = '<a href="'.$sermon_attachment.'" data-name="' . esc_html__( 'DOWNLOAD', 'deep' ) . '" class="wn-data-tooltip" target="_self"><i class="pe-7s-cloud-download"></i></a>';
                $sermons_meta_grid =
                '<div class="media-links ' . $shortcodeclass . '"  ' . $shortcodeid . '>
                <a href="'.$sermon_video.'" class="wn-sermon-media wn-data-tooltip" target="_self" data-effect="mfp-zoom-in" data-name="' . esc_html__( 'WATCH', 'deep' ) . '"><i class="pe-7s-play"></i></a>
                <a href="#w-audio-'.$post_id.'" class="inlinelb wn-data-tooltip" target="_self" data-name="' . esc_html__( 'LISTEN', 'deep' ) . '"><i class="pe-7s-headphones"></i></a>
                <div style="display:none">
                    <div class="w-audio w-audio-'.$post_id.'">
                        '.do_shortcode('[audio mp3="'.$sermon_audio.'"][/audio]').'
                    </div>
                </div>
                ' . $download_file . '
                <a href="' . get_the_permalink() . '" class="inlinelb wn-data-tooltip" target="_self" data-name="' . esc_html__( 'READ MORE', 'deep' ) . '"><i class="pe-7s-notebook"></i><span class="media_label"></span></a>
            </div>';
                echo '
                <div class="sermon-'.$type.'-item ' . $shortcodeclass . '"  ' . $shortcodeid . '>
                    <div class="sermons-grid-wrap">
                        <div class="sermon-grid-header">
                            <h4><a href="'.$permalink.'">'.$title.'</a></h4>
                            <div class="sermon-grid-cat">' .$cats_slug_str. '</div>
                        </div>
                        <div class="sermon-grid-content">
                            ' .$sermons_meta_grid. '
                            <p>'. deep_excerpt(15) .'</p>
                            <a class="sermon-readmore" href="' .$permalink. '">' .esc_html__( 'Sermon Details', 'deep' ). '</a>
                        </div>
                    </div>
                </div>';
            }
        endif;
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