<?php
namespace Elementor;

class Webnus_Element_Widgets_Faq extends \Elementor\Widget_Base {

	/**
	 * Retrieve Alert widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'faq';

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

		return __( 'Webnus Faq', 'deep' );

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

		// Select Type Section
		$this->add_control(
			'type', // param_name
			[
				'label'   => __( 'Select Type', 'deep' ), // heading
				'type'    => \Elementor\Controls_Manager::SELECT, // type
				'default' => 'grid',
				'options' => [
					'grid' => __( 'grid', 'deep' ),
					'list' => __( 'list', 'deep' ),
				],
			]
		);

		// Select Type Section
		$this->add_control(
			'sort', // param_name
			[
				'label'   => __( 'Order By', 'deep' ), // heading
				'type'    => \Elementor\Controls_Manager::SELECT, // type
				'default' => 'view',
				'options' => [
					'recent' => __( 'Most Recent', 'deep' ),
					'view'   => __( 'Most Popular', 'deep' ),
				],
			]
		);

		// Alert Content
		$this->add_control(
			'count', // param_name
			[
				'label'       => __( 'Post Count', 'deep' ), // heading
				'type'        => \Elementor\Controls_Manager::TEXT, // type
				'placeholder' => __( 'Number of event(s) to show. Note: When you type nothing it puts for default 6 events to show.', 'deep' ),
				'default'     => '6',
			]
		);

		// Show/Hide Cross Icon
		$this->add_control(
			'page', // param_name
			[
				'label'        => __( 'Page Navigation', 'deep' ), // heading
				'type'         => \Elementor\Controls_Manager::SWITCHER, // type
				'label_on'     => __( 'Show', 'deep' ),
				'label_off'    => __( 'Hide', 'deep' ),
				'return_value' => 'yes',
				'default'      => 'yes',
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
		$type     = $settings['type'];
		$sort     = $settings['sort'];
		$count    = $settings['count'];
		$page     = $settings['page'];
		ob_start();
		$deep_options = deep_options();
		$paged        = ( is_front_page() ) ? 'page' : 'paged';
		$pages        = $page == 'yes' ? get_query_var( $paged ) : '1';
		$args         = array(
			'post_type'      => 'faq',
			'posts_per_page' => $count,
			'paged'          => $pages,
		);
		$query        = new \WP_Query( $args ); ?>

	<div class="container faqs faqs-<?php echo $type; ?>">
		<?php
		$col    = ( $count < 5 ) ? 12 / $count : 4;
		$row    = 12 / $col;
		$rcount = 1;
		while ( $query->have_posts() ) :
			$query->the_post();
			$post_id = get_the_ID();
			$cats    = get_the_terms( $post_id, 'faq_category' );
			if ( is_array( $cats ) ) {
				$faq_category = array();
				foreach ( $cats as $cat ) {
					$faq_category[] = $cat->slug;
				}
			} else {
				$faq_category = array();
			}
			$cats = get_the_terms( $post_id, 'faq_category' );

			$cats_slug_str = '';
			if ( $cats && ! is_wp_error( $cats ) ) :
				$cat_slugs_arr = array();
				foreach ( $cats as $cat ) {
					$cat_slugs_arr[] = '<a href="' . get_term_link( $cat, 'faq_category' ) . '">' . $cat->name . '</a>';
				}
				$cats_slug_str = implode( ', ', $cat_slugs_arr );
			endif;

			$category  = ( $cats_slug_str ) ? esc_html__( 'Category: ', 'deep' ) . $cats_slug_str : '';
			$date      = get_the_time( 'F d, Y' );
			$permalink = get_the_permalink();

			$image = get_the_image(
				array(
					'meta_key' => array( 'thumbnail', 'thumbnail' ),
					'size'     => 'deep_webnus_courses_img',
					'echo'     => false,
				)
			);

			$image2 = get_the_image(
				array(
					'meta_key' => array( 'thumbnail', 'thumbnail' ),
					'size'     => 'deep_webnus_blog2_img',
					'echo'     => false,
				)
			);

			$title       = '<h4><a class="faq-title" href="' . $permalink . '">' . get_the_title() . '</a></h4>';
			$content     = '<p>' . deep_excerpt( 16 ) . '</p>';
			$progressbar = $faq_days = $faq_donate = '';
			$percentage  = 0;
			$received    = rwmb_meta( 'deep_faq_amount_received_meta' ) ? rwmb_meta( 'deep_faq_amount_received_meta' ) : 0;
			$amount      = rwmb_meta( 'deep_faq_amount_meta' );
			$end         = rwmb_meta( 'deep_faq_end_meta' );
			$currency    = esc_html( $deep_options['deep_webnus_currency'] );

			if ( $amount ) {
				$percentage  = ( $received / $amount ) * 100;
				$percentage  = round( $percentage );
				$out         = $percentage . '% ' . esc_html__( 'DONATED OF ', 'deep' ) . $currency . $amount;
				$progressbar = '
				<div class="wn-recived-faq">
					'.$out.'
					<div class="donates" style="margin: 7px 0px; position: relative; display: block; padding: 10px; background: #eee; border-radius: 50px; overflow: hidden;">
						<span class="progressbar colorb" style="width:'.$percentage.'%;position: absolute; height: 100%; top: 0; left: 0; transition: all .5s ease-in-out;"><span>
					</div>
				</div>';
			}

			$now       = date( 'Y-m-d 23:59:59' );
			$now       = strtotime( $now );
			$end_date  = $end . ' 23:59:59';
			$your_date = strtotime( $end_date );
			$datediff  = $your_date - $now;
			$days_left = floor( $datediff / ( 60 * 60 * 24 ) );
			$date_msg  = '';

			if ( $days_left == 0 ) {
				$date_msg = '1';
			} elseif ( $days_left < 0 ) {
				$date_msg = 'No';
			} else {
				$date_msg = $days_left + '1' . '';
			}
				$faq_days = ( $percentage < 100 ) ? '<span>' . $date_msg . '</span> ' . esc_html__( 'Days left to achieve target', 'deep' ) : esc_html__( 'Thank You', 'deep' );
			if ( $type == 'grid' ) {
				echo ( $rcount == 1 ) ? '<div class="row">' : '';
				echo '<div class="col-md-' . $col . ' col-sm-' . $col . '"><article>' . $image;
				echo '<div class="faq-content">' . $title . $content;
				echo '<div class="faq-meta">' . $progressbar . '<p class="faq-days">' . $faq_days . '</p>';
				if ( $days_left >= 0 && $percentage < 100 && $deep_options['deep_webnus_donate_form'] ) {
					echo deep_modal_donate();
				} else {
					echo '<p class="faq-completed">' . esc_html__( 'Has been completed', 'deep' ) . '</p>';
				}
				echo '</div></article></div>';
				if ( $rcount == $row ) {
					echo '</div>';
					$rcount = 0;
				}
				$rcount++;
			} elseif ( $type == 'list' ) {
				echo '<article id="post-' . $post_id . '"><div class="row"><div class="col-md-4">';
				echo ( $image ) ? '<figure class="faq-img">' . $image2 . '</figure>' : '';
				echo '</div><div class="col-md-8"><div class="faq-content">' . $title . '<div class="postmetadata">';
				?>
				<ul class="faq-metadata">
					<li class="faq-date"> <i class="fa-calendar-o"></i><span><?php the_time( 'F d, Y' ); ?></span> </li>
					<li class="faq-comments"> <i class="fa-folder"></i><span><?php the_terms( $post_id, 'faq_category', '', ' | ', '' ); ?></span> </li>
					<li class="faq-comments"> <i class="fa-comments"></i><span><?php comments_number(); ?></span> </li>
					<li  class="faq-views"> <i class="fa-eye"></i><span><?php echo deep_getViews( $post_id ); ?></span><?php esc_html_e( ' Views', 'deep' ); ?></li>
				</ul>
				</div>
					<?php
					echo $content . '<div class="faq-meta">' . $progressbar;
					if ( $days_left >= 0 && $percentage < 100 && $deep_options['deep_webnus_donate_form'] ) {
						echo deep_modal_donate();
					} else {
						echo '<p class="faq-completed">' . esc_html__( 'Has been completed', 'deep' ) . '</p>';
					}

					?>
				<div class="faq-sharing">
					<div class="faq-social">
					<a class="facebook" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php the_title(); ?>" target="blank"><i class="faq-sharing-icon fa-facebook"></i></a>
					<a class="google" href="https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url=<?php the_permalink(); ?>" target="_blank"><i class="faq-sharing-icon fa-google-plus"></i></a>
					<a class="twitter" href="https://twitter.com/intent/tweet?original_referer=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>&amp;tw_p=tweetbutton&amp;url=<?php the_permalink(); ?><?php echo isset( $twitter_user ) ? '&amp;via=' . $twitter_user : ''; ?>" target="_blank"><i class="faq-sharing-icon fa-twitter"></i></a>
					</div>
				</div>
					<?php
					echo '</div></div></article>';
			}
		endwhile;
		echo( ( $type == 'grid' ) && ( $rcount != 1 ) ) ? '</div>' : '';
		echo '</div>';

		if ( $page ) {
			?>
			<section class="container aligncenter">
				<?php
				if ( function_exists( 'wp_pagenavi' ) ) {
					wp_pagenavi( array( 'query' => $query ) );
				}
				?>
				<hr class="vertical-space2">
			</section>
			<?php
		}
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
