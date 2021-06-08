<?php
namespace Elementor;

class Webnus_Element_Widgets_Single_Goal extends \Elementor\Widget_Base {

	/**
	 * Retrieve Alert widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'singlegoal';

	}

	/**
	 * Retrieve Alert widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return __( 'Webnus Single Goal', 'deep' );

	}

	/**
	 * Retrieve Alert widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'icon-target';

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
	 * Register Alert widget controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		// Content Tab
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'General', 'deep' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		// Alert Content
		$this->add_control(
			'post', // param_name
			[
				'label'       => __( 'Goal ID', 'deep' ), // heading
				'type'        => \Elementor\Controls_Manager::TEXT, // type
				'placeholder' => __( 'Pick up the ID & follow this instruction: admin panel > goals > ID column. Note: When you type nothing it puts latest goal as default to show.', 'deep' ),
			]
		);

		$this->end_controls_section();

		// Custom css tab
		$this->start_controls_section(
			'custom_css_section',
			[
				'label' => __( 'Custom CSS', 'deep' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'custom_css',
			[
				'label'      => __( 'Custom CSS', 'deep' ),
				'type'       => \Elementor\Controls_Manager::CODE,
				'language'   => 'css',
				'rows'       => 20,
				'show_label' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Content style', 'deep' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'label'    => __( 'Typography', 'deep' ),
				'scheme'       => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' => '#wrap {{WRAPPER}} .alert',
			]
		);

		$this->add_control(
			'content_color', // param_name
			[
				'label'     => __( 'Color', 'deep' ), // heading
				'type'      => \Elementor\Controls_Manager::COLOR, // type
				'selectors' => [
					'#wrap {{WRAPPER}} .alert' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_box_style',
			[
				'label' => __( 'Box Style', 'deep' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'box_bg',
				'label'    => __( 'Background', 'deep' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '#wrap {{WRAPPER}} .alert',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .alert',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => __( 'Box Shadow', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .alert',
			]
		);

		$this->add_control(
			'box_padding', // param_name
			[
				'label'      => __( 'Padding', 'deep' ), // heading
				'type'       => \Elementor\Controls_Manager::DIMENSIONS, // type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'#wrap {{WRAPPER}} .alert' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'box_margin', // param_name
			[
				'label'      => __( 'Margin', 'deep' ), // heading
				'type'       => \Elementor\Controls_Manager::DIMENSIONS, // type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'#wrap {{WRAPPER}} .alert' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render Alert widget output on the frontend.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		$post     = $settings['post'];
		ob_start();
		$args = array(
			'post_type' => 'goal',
			'posts_per_page' => 1,
			'p'	=> $post,
		);
		$query = new \WP_Query($args); ?>
		<div class="container goals single-goal">
		<?php 
		while ($query -> have_posts()) : $query -> the_post();
			$post_id = get_the_ID();
			$deep_options = deep_options();
			$cats = get_the_terms( $post_id , 'goal_category' );
			if(is_array($cats)){
				$goal_category = array();
				foreach($cats as $cat){
					$goal_category[] = $cat->slug;
				}
			}else $goal_category=array();
			$cats = get_the_terms($post_id, 'goal_category' );
			$cats_slug_str = '';
			if ($cats && ! is_wp_error($cats)) :
				$cat_slugs_arr = array();
			foreach ($cats as $cat) {
				$cat_slugs_arr[] = '<a href="'. get_term_link($cat, 'goal_category') .'">' . $cat->name . '</a>';
			}
			$cats_slug_str = implode( ", ", $cat_slugs_arr);
			endif;

			$category = ($cats_slug_str)?esc_html__('Category: ','deep') . $cats_slug_str:'';
			$date = get_the_time('F d, Y');
			$permalink = get_the_permalink();
			$image = get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'deep_webnus_courses_img','echo'=>false, ) );
			$image2 = get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'deep_webnus_blog2_img','echo'=>false, ) );
			$title = '<h4><a class="goal-title" href="'.$permalink.'">'.get_the_title().'</a></h4>';
			$content ='<p>'.deep_excerpt(64).'</p>';
			$view = '<div class="goal_view"><i class="fa-eye"></i>'.deep_getViews($post_id).'</div>';
			$progressbar = $goal_days = $goal_donate = '';
			$percentage = 0;
			$received = rwmb_meta( 'deep_goal_amount_received_meta' ) ? rwmb_meta( 'deep_goal_amount_received_meta' ) : 0;
			$amount = rwmb_meta( 'deep_goal_amount_meta' ) ? rwmb_meta( 'deep_goal_amount_meta' ) : 0 ;
			$end = rwmb_meta( 'deep_goal_end_meta' ) ? rwmb_meta( 'deep_goal_end_meta' ) : '' ;
			$currency = esc_html($deep_options['deep_webnus_currency']);
			if($amount) {
				$percentage = ($received/$amount)*100;
				$percentage = round($percentage);
				$out= $currency.$received.esc_html__(' Raised of ','deep').$currency.$amount;
				$progressbar = '
				<div class="wn-recived-goal">
					<div class="donates" style="margin: 7px 0px; position: relative; display: block; padding: 10px; background: #eee; border-radius: 50px; overflow: hidden;">
						<span class="progressbar colorb" style="width:'.$percentage.'%;position: absolute; height: 100%; top: 0; left: 0; transition: all .5s ease-in-out;"><span>
					</div>
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
			$goal_days = ($percentage<100)?'<span>'.$date_msg.'</span> '.esc_html__('Days left to achieve target','deep'):esc_html__('Thank You','deep');
			echo '<article class="container"><div class="goal-content row">';
			echo '<div class="goal-details col-md-12">'.$title.$progressbar.$content;
			if($days_left>=0 && $percentage<100 && $deep_options['deep_webnus_donate_form']){
				echo deep_modal_donate();
				echo '<span class="goal-raised">'.$out.'</span>';
			}else{
				echo '<p class="goal-completed">'.esc_html__('Has been completed','deep').'</p>';
			}
			echo '<span class="goal-days">'.$goal_days.'</span></div></div></article>';
		endwhile;
		$out = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		echo $out;
        $custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}
	}
}
