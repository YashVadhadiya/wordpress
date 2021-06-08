<?php
namespace Elementor;
class Webnus_Element_Widgets_Single_Cause extends \Elementor\Widget_Base {

	/**
	 * Retrieve Single Cause widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'single_causes';
		
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

		return esc_html__( 'Webnus Single Causes', 'deep' );

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

		return 'li_heart';

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

    public function get_script_depends() {
        return [
            'wn-pie-cart',
            'wn-jquery-stats'
        ];
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
				'label' => esc_html__( 'Single Causes', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		// Select Single Cause ID
        $this->add_control(
        'post',
        [
            'label'         => esc_html__( 'ID', 'deep' ),
            'type'          => Controls_Manager::TEXT,
            'placeholder'   => esc_html__( '7508', 'deep' ),
            'description'   => esc_html__( 'Ex: 7508 - Pick up the ID & follow this instruction: admin panel > causes > ID column. Note: When you type nothing it puts latest cause as default to show.', 'deep'),
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
				'selector' => '#wrap {{WRAPPER}} .causes.single-cause',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .causes.single-cause',
			]
		);

		$this->add_control(
			'box_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .causes.single-cause' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'box_shadow',
					'label' => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .causes.single-cause',
				]
		);

		$this->add_control(
			'box_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .causes.single-cause' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .causes.single-cause' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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

        ob_start();

        $settings       = $this->get_settings_for_display();
		$post           = $settings['post'];
        // Class & ID 
        $shortcodeclass 	= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
        $shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';
                    
        $args = array(
            'post_type' => 'cause',
            'posts_per_page' => 1,
            'p'	=> $post,
        );
        $query = new \WP_Query($args);
    ?>
    <div class="clearfix causes single-cause <?php echo $shortcodeclass; ?>" <?php echo $shortcodeid; ?> >
    <?php	while ($query -> have_posts()) : $query -> the_post();
            $post_id = get_the_ID();
            $cats = get_the_terms( $post_id , 'cause_category' );
            if(is_array($cats)){
                $cause_category = array();
                foreach($cats as $cat){
                    $cause_category[] = $cat->slug;
                }
            }else $cause_category=array();
            $cats = get_the_terms($post_id, 'cause_category' );
            $cats_slug_str = '';
            if ($cats && ! is_wp_error($cats)) :
                $cat_slugs_arr = array();
            foreach ($cats as $cat) {
                $cat_slugs_arr[] = '<a href="'. get_term_link($cat, 'cause_category') .'">' . $cat->name . '</a>';
            }
            $cats_slug_str = implode( ", ", $cat_slugs_arr);
            endif;

            $category = ($cats_slug_str)?esc_html__('Category: ','deep') . $cats_slug_str:'';
            $date = get_the_time('F d, Y');
            $permalink = get_the_permalink();
            $image = get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'sermons-gridmons-grid','echo'=>false, ) );
            $image2 = get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'blog2_thumb','echo'=>false, ) );
            $title = '<h4><a class="cause-title" href="'.$permalink.'">'.get_the_title().'</a></h4>';
            $content ='<p>'. deep_excerpt(64) .'</p>';
            $view = '<div class="cause_view"><i class="wn-fa wn-fa-eye"></i>'.deep_getViews($post_id).'</div>';
            $deep_options = deep_options();
            global $cause_meta;
            $progressbar = $cause_days = $cause_donate = '';
            $received = $percentage = 0;
            $progressbar = $cause_days = $cause_donate = '';
            $received = $percentage = 0;
            $received	= rwmb_meta( 'deep_cause_amount_received' );
            $amount		= rwmb_meta( 'deep_cause_amount' );
            $end		= rwmb_meta( 'deep_cause_end_date' );
            $deep_options['webnus_cause_currency'] = isset( $deep_options['webnus_cause_currency'] ) ? $deep_options['webnus_cause_currency'] : '';
            $currency = esc_html($deep_options['webnus_cause_currency']);
            if( $amount ) {
                $percentage = ($received/$amount)*100;
                $percentage = round($percentage);
                $out=$currency.$received.esc_html__(' RAISED OF ','deep').$currency.$amount;
				$progressbar = '
				<div class="wn-piechart single-cause-pie">
					<div class="wn-percentage"  data-size ="300" data-bar-color="#ff9900" data-track-color="rgba(255,153,0,0.5)" data-percent="' . $percentage . '">
						<span>' . $percentage . '<sup>%</sup></span>
					</div>
					<div class="wn-label"><h4>'.$out.'</h4></div>
				</div>';

            }
            $now = date('Y-m-d 23:59:59');
            $now = strtotime($now);
            $end_date = $end.' 23:59:59';
            $your_date = strtotime($end_date);
            $datediff = $your_date - $now;
            $days_left = floor($datediff/(60*60*24));
            $date_msg = '';
            if($days_left==0) {$date_msg = '1';}
            elseif($days_left<0) {$date_msg = 'No';}
            else {$date_msg = $days_left+'1'.'';}
            $cause_days = ($percentage<100)?'<span>'.$date_msg.'</span> '.esc_html__('Days left to achieve target','deep'):esc_html__('Thank You','deep');
            echo '<article class="clearfix"><div class="cause-content row">';
            echo '<div class="cause-progress col-md-4 col-sm-4">'.$progressbar .'</div>';
            echo '<div class="col-md-8 col-sm-8">'.$title.$content;
			$deep_options['webnus_donate_form'] = isset( $deep_options['webnus_donate_form'] ) ? $deep_options['webnus_donate_form'] : '';
            if($days_left>=0 && $percentage<100 && $deep_options['webnus_donate_form']){
                echo deep_modal_donate();
            }else{
                echo '<p class="cause-completed">'.esc_html__('Has been completed','deep').'</p>';
            }
            echo '<p class="cause-days">'.$cause_days.'</p></div></div></article>';
        endwhile;
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