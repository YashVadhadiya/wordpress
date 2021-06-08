<?php
namespace Elementor;

class Webnus_Element_Widgets_Magazine extends \Elementor\Widget_Base {

	/**
	 * Retrieve Magazine widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'magazine';

	}

	/**
	 * Retrieve Magazine widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Magazine', 'deep' );

	}

	/**
	 * Retrieve Magazine widget icon.
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
	 * enqueue JS
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_script_depends() {

		return [ 'deep-magazine', 'deep-simple-pagination' ];

	}

	/**
	 * widget styles.
	 *
	 * @since 4.2.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'wn-deep-magazine', 'deep-circle-side' ];

	}

	/**
	 * Register Magazine widget controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'General', 'deep' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$categories          = array();
		$categories          = get_categories();
		$category_slug_array = array( '' );
		$category_name_array = array( '' );
		foreach ( $categories as $category ) {
			$category_slug_array[] = $category->name;
			$category_name_array[] = $category->slug;
		}
		$category_array = array_combine( $category_name_array, $category_slug_array );

		$this->add_control(
			'type', 
			[
				'label'   => esc_html__( 'Type', 'deep' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => esc_html__( 'Type 1', 'deep' ),
					'2' => esc_html__( 'Type 2', 'deep' ),
					'3' => esc_html__( 'Type 3', 'deep' ),
				],
			]
		);
		$this->add_control(
			'post_title', 
			[
				'label'       => esc_html__( 'Title', 'deep' ), 
				'type'        => Controls_Manager::TEXT, 
				'placeholder' => esc_html__( 'Type your title text here', 'deep' ),
			]
		);
		$this->add_control(
			'post_url', 
			[
				'label'         => esc_html__( 'Title URL', 'deep' ), 
				'type'          => Controls_Manager::URL,
				'default'       => [
					'url'         => '',
					'is_external' => '',
				],
				'show_external' => false, // Show the 'open in new tab' button.
			]
		);
		$this->add_control(
			'param_category',
			[
				'label'    => esc_html__( 'Choose Categories', 'deep' ),
				'type'     => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options'  => $category_array,
			]
		);
		$this->add_control(
			'sort_order', 
			[
				'label'   => esc_html__( 'Sort Order', 'deep' ), 
				'type'    => Controls_Manager::SELECT, 
				'default' => 'date',
				'options' => [
					'date'          => esc_html__( 'Date', 'deep' ),
					'title'         => esc_html__( 'Title', 'deep' ),
					'comment_count' => esc_html__( 'Popular Post', 'deep' ),
					'latest'        => esc_html__( 'Recent Posts', 'deep' ),
					'rand'          => esc_html__( 'Random Posts', 'deep' ),
					'modified'      => esc_html__( 'Last Modified Post', 'deep' ),
				],
			]
		);
		$this->add_control(
			'post_number',
			[
				'label'   => esc_html__( 'Number Of Show Post', 'deep' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 8,
				'min'     => 1,
				'max'     => 24,
				'step'    => 1,
			]
		);
		$this->add_control(
			'post_prepage',
			[
				'label'   => esc_html__( 'Post Pre Page', 'deep' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 4,
				'min'     => 1,
				'max'     => 24,
				'step'    => 1,
			]
		);
		$this->add_control(
			'pagination',
			[
				'label'        => esc_html__( 'Pagination', 'deep' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_off'    => esc_html__( 'Hide', 'deep' ),
				'label_on'     => esc_html__( 'Show', 'deep' ),
				'return_value' => 'show',
				'default'      => 'show',
			]
		);
		$this->add_control(
			'reviews', 
			[
				'label'        => __( 'Reviews', 'deep' ), 
				'type'         => \Elementor\Controls_Manager::SWITCHER, 
				'label_on'     => __( 'Show', 'deep' ),
				'label_off'    => __( 'Hide', 'deep' ),
				'return_value' => 'show',
				'default'      => 'show',
			]
		);
		$this->add_control(
			'hide_cat', 
			[
				'label'        => __( 'Post Category', 'deep' ), 
				'type'         => \Elementor\Controls_Manager::SWITCHER, 
				'label_on'     => __( 'Show', 'deep' ),
				'label_off'    => __( 'Hide', 'deep' ),
				'return_value' => 'show',
				'default'      => 'show',
			]
		);
		$this->add_control(
			'hide_date', 
			[
				'label'        => __( 'Post Date', 'deep' ), 
				'type'         => \Elementor\Controls_Manager::SWITCHER, 
				'label_on'     => __( 'Show', 'deep' ),
				'label_off'    => __( 'Hide', 'deep' ),
				'return_value' => 'show',
				'default'      => 'show',
			]
		);
		$this->add_control(
			'hide_author', 
			[
				'label'        => __( 'Post Author', 'deep' ), 
				'type'         => \Elementor\Controls_Manager::SWITCHER, 
				'label_on'     => __( 'Show', 'deep' ),
				'label_off'    => __( 'Hide', 'deep' ),
				'return_value' => 'show',
				'default'      => 'show',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'classid_section',
			[
				'label' => __( 'Class & ID', 'deep' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'shortcodeclass',
			[
				'label' => esc_html__( 'Extra Class', 'deep' ),
				'type'  => Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'shortcodeid',
			[
				'label' => esc_html__( 'ID', 'deep' ),
				'type'  => Controls_Manager::TEXT,
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'deep' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'post_title_color',
			[
				'label'     => esc_html__( 'Title Color', 'deep' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'default'   => '#437df9',
				'selectors' => [
					'{{WRAPPER}} .magazin-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'post_title_border_color',
			[
				'label'     => esc_html__( 'Title Border Color', 'deep' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .magazin-wrap .magazin-cat-nav-wrap .magazin-title:before' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'custom_css_section',
			[
				'label' => __( 'Custom CSS', 'deep' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
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

	}

	/**
	 * Render Magazine widget output on the frontend.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings();

		global $post;
		$post_slug = $post->post_name;

		// Class & ID
		$shortcodeclass = $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
		$shortcodeid    = $settings['shortcodeid'] ? ' id=' . $settings['shortcodeid'] . '' : '';
		$sort_order      = ! empty( $settings['sort_order'] ) ? $settings['sort_order'] : '';
		$post_number     = ! empty( $settings['post_number'] ) ? $settings['post_number'] : '';
		$post_title      = ! empty( $settings['post_title'] ) ? $settings['post_title'] : '';
		$post_prepage    = ! empty( $settings['post_prepage'] ) ? $settings['post_prepage'] : '';
		$post_url        = ! empty( $settings['post_url']['url'] ) ? $settings['post_url']['url'] : '';
		$pagination      = $settings['pagination'] == 'show' ? ' show-pagination ' : ' hide-pagination ';
		$type            = ! empty( $settings['type'] ) ? $settings['type'] : '';
		$hide_cat        = $settings['hide_cat'] == '' ? ' hide-cat ' : '';
		$hide_date       = $settings['hide_date'] == '' ? ' hide-date ' : '';
		$hide_author     = $settings['hide_author'] == '' ? ' hide-author ' : '';
		$shortcodeclass .= $hide_cat . $hide_date . $hide_author . $pagination;
		$cat_ids = $param_tag = $excerpt_value = $thumbnail_url_1 = $thumbnail_url_2 = '';

		if ( ! empty( $settings['param_category'] ) ) :
			$arrayKeys    = array_keys( $settings['param_category'] );
			$lastArrayKey = array_pop( $arrayKeys );

			foreach ( $settings['param_category'] as $key => $value ) {
				$get_cat = get_category_by_slug( $value );

				if ( $get_cat ) {
					if ( $key == $lastArrayKey ) {
						$get_cat_id = $get_cat->term_id;
					} else {
						$get_cat_id = $get_cat->term_id . ',';
					}
					$cat_ids .= $get_cat_id;
				}
			}
		endif;

		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => $post_number,
			'cat'            => $cat_ids,
			'orderby'        => $sort_order,
		);

		$custom_query = new \WP_Query( $args );
		$temp_query   = $custom_query;
		$custom_query = null;
		$magazine     = $temp_query;

		$totall_post = $magazine->post_count ? $magazine->post_count : '';

		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>' . $custom_css . '</style>';
		}

		if ( $type == '1' ) {
			static $magazin_uniqid = 0;
			$magazin_uniqid++;
			?>

		<div
		class="magazin-wrap magazin-<?php echo '' . $type . ' ' . $shortcodeclass; ?>"
		 <?php echo esc_attr( $shortcodeid ); ?>
		data-id="<?php echo esc_attr( $magazin_uniqid ); ?>"
		data-post-name="<?php echo esc_attr( $post_slug ); ?>"
		data-totall_post="<?php echo esc_attr( $totall_post ); ?>"
		data-pagination="<?php echo esc_attr( $pagination ); ?>"
		data-param_category="<?php echo esc_attr( $cat_ids ); ?>"
		data-param_tag="<?php echo esc_attr( $param_tag ); ?>"
		data-post_title="<?php echo esc_html( $post_title ); ?>"
		data-post_url="<?php echo esc_attr( $post_url ); ?>"
		data-type="<?php echo esc_attr( $type ); ?>"
		data-sort_order="<?php echo esc_attr( $sort_order ); ?>"
		data-post_number="<?php echo esc_attr( $post_number ); ?>"
		data-post_prepage="<?php echo esc_attr( $post_prepage ); ?>"
		>

			<?php static $title_uniqid = 0; $title_uniqid++; ?>
			<?php if ($post_url): ?>
					<?php $post_title = $post_title ? '<a href="' . $post_url . '"><h4 class="magazin-title" data-id="' . $title_uniqid . '">' . $post_title . '</h4></a>' : '';  ?>
			<?php else: ?>
					<?php $post_title = $post_title ? '<h4 class="magazin-title" data-id="' . $title_uniqid . '">' . $post_title . '</h4>' : '';  ?>
			<?php endif; ?>
			<div class="clearfix">

			<?php if ( ! empty( $settings['param_category'] ) ) { ?>

				<div class="magazin-cat-nav-wrap">
					<?php echo wp_kses( $post_title, wp_kses_allowed_html( 'post' ) ); ?>
					<ul class="magazin-cat-nav">
						<?php $category_list = '<li><a href="#" class="all cat-item colorf" data-param_category="' . $cat_ids . '">' . esc_html__( 'All', 'deep' ) . '</a></li>'; ?>
						<?php $cat_counter = 0; ?>
						<?php $catsize = sizeof( $settings['param_category'] ); ?>
						<?php
						foreach ( $settings['param_category'] as $id => $cat_slug ) {
							$get_cats = get_category_by_slug( $cat_slug );

							if ( $get_cats ) {
								$cat_id   = $get_cats->term_id;

								$cat_counter++;
								$total_cat_counter = $cat_counter;

								$start_ul      = ( $cat_counter == 5 ) ? '<li class="magazin-dropdown-list"><i class="sl-options"></i><ul>' : '';
								$category_term = get_term( $cat_id, 'category' );
								if ( $category_term ) {
									$category_list .= $start_ul . '<li><a href="#" data-cat-slug="' . $category_term->slug . '" class="cat-item" data-param_category="' . $cat_id . '">' . $category_term->name . '</a></li>';
								}
							}
						}
						if ( $cat_counter == 5 ) {
							if ( $cat_counter == $catsize ) {
								$end_ul         = '</ul></li>';
								$category_list .= $end_ul;
							}
						}
						echo '' . $category_list;
						?>
					</ul>
				</div>

			<?php } ?>

			<div class="magazin-wrap-content">

				<?php
				$post_counter = 0;
				if ( $magazine->have_posts() ) {
					?>
					<?php
					static $uniqid = 0;
					while ( $magazine->have_posts() ) {
						$post_counter++;
						$magazine->the_post();

						$uniqid++;
						$thumbnail_url = get_the_post_thumbnail_url();
						$thumbnail_id  = get_post_thumbnail_id();

						if ( ! empty( $thumbnail_url ) ) {
							if ( ! class_exists( 'Wn_Img_Maniuplate' ) ) {
								require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';

							}
							$image         = new \Wn_Img_Maniuplate(); // instance from settor class
							$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url, '508', '300' ); // set required and get result
						}
						?>

						<?php if ( $post_counter % 2 == 1 ) { ?>
							<div class="row">
						<?php } ?>
								<div class="col-md-6 wn-pagination" >
									<article class="magazine-b<?php echo '' . $type; ?> magazine-b<?php echo '' . $type; ?>-cont" data-id="<?php echo '' . $uniqid; ?>">
										<figure class="magazine-b<?php echo '' . $type; ?>-img">
											<a href="<?php the_permalink(); ?>">
												<?php if ( ! empty( $thumbnail_url ) ) : ?>
													<img src="<?php echo '' . $thumbnail_url; ?>" alt="<?php the_title(); ?>" >
												<?php else : ?>
													<img src="<?php echo DEEP_ASSETS_URL . 'images/featured.jpg'; ?>"  alt="<?php echo get_the_title(); ?>"/>
												<?php endif ?>
											</a>
										</figure>
										<div class="magazine-b<?php echo '' . $type; ?>-cont">
											<?php
											if ( $hide_cat != 'true' ) {
												?>
												<div class="magazine-b<?php echo '' . $type; ?>-category" style="background: <?php echo deep_category_color(); ?>;">
														<span class="magazine-b<?php echo '' . $type; ?>-cat magazine-cat" data-id="<?php echo '' . $uniqid; ?>"><?php the_category( ', ' ); ?></span>
												</div>
												<?php
											}
											?>
											<div class="magazine-b<?php echo '' . $type; ?>-date">
												<i class="pe-7s-clock"></i><?php echo get_the_date(); ?>
											</div>
											<h3 class="magazine-b<?php echo '' . $type; ?>-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
											<div class="magazine-author">
												<span><?php echo get_avatar( get_the_author_meta( 'user_email' ), 28 ); ?></span>
												<span><?php the_author_posts_link(); ?></span>
											</div>
											<?php $reviews = $settings['reviews'] == 'show' ? deep_admin_post_review() : ''; ?>
										</div>
									</article>
								</div>
						<?php if ( $post_counter % 2 == 0 ) { ?>
							</div>
						<?php } ?>
					<?php } ?>
			</div>
		</div><!-- End magazin-wrap  -->
			<?php } ?>
		</div>
			<?php
		} elseif ( $type == '2' ) {
			static $magazin_uniqid = 0;
			$magazin_uniqid++;
			?>

		<div
			class="magazin-wrap magazin-<?php echo esc_attr( $type ) . ' ' . $shortcodeclass; ?>"
			<?php echo esc_attr( $shortcodeid ); ?>
			data-id="<?php echo esc_attr( $magazin_uniqid ); ?>"
			data-post-name="<?php echo esc_attr( $post_slug ); ?>"
			data-totall_post="<?php echo esc_attr( $totall_post ); ?>"
			data-pagination="<?php echo esc_attr( $pagination ); ?>"
			data-param_category="<?php echo esc_attr( $cat_ids ); ?>"
			data-param_tag="<?php echo esc_attr( $param_tag ); ?>"
			data-post_title="<?php echo esc_attr( $post_title ); ?>"
			data-post_url="<?php echo esc_attr( $post_url ); ?>"
			data-type="<?php echo esc_attr( $type ); ?>"
			data-sort_order="<?php echo esc_attr( $sort_order ); ?>"
			data-post_number="<?php echo esc_attr( $post_number ); ?>"
			data-post_prepage="<?php echo esc_attr( $post_prepage ); ?>"
			data-excerpt_value="<?php echo esc_attr( $excerpt_value ); ?>"
		>
			<?php
			static $title_uniqid = 0;
			$title_uniqid++;

			$post_title = $post_title ? '<h4 class="magazin-title" data-id="' . $title_uniqid . '">' . $post_title . '</h4>' : '';
			?>
			<div class="clearfix">

				<?php if ( ! empty( $settings['param_category'] ) ) { ?>

					<div class="magazin-cat-nav-wrap">
						<?php echo wp_kses( $post_title, wp_kses_allowed_html( 'post' ) ); ?>
						<ul class="magazin-cat-nav">
							<?php $category_list = '<li><a href="#" class="all cat-item colorf" data-param_category="' . $cat_ids . '">' . esc_html__( 'All', 'deep' ) . '</a></li>'; ?>
							<?php $cat_counter = 0; ?>
							<?php $catsize = sizeof( $settings['param_category'] ); ?>
							<?php
							foreach ( $settings['param_category'] as $id => $cat_slug ) {
								$get_cats = get_category_by_slug( $cat_slug );


								if ( $get_cats ) {
									$cat_id   = $get_cats->term_id;
									$cat_counter++;
									$total_cat_counter = $cat_counter;

									$start_ul = ( $cat_counter == 5 ) ? '<li class="magazin-dropdown-list"><i class="sl-options"></i><ul>' : '';

									$category_list .= $start_ul . '<li><a href="#" data-cat-slug="' . deep_get_cat_slug( $cat_id ) . '" class="cat-item" data-param_category="' . $cat_id . '">' . get_the_category_by_ID( $cat_id ) . '</a></li>';
								}

							}
							if ( $cat_counter == 5 ) {
								if ( $cat_counter == $catsize ) {
									$end_ul         = '</ul></li>';
									$category_list .= $end_ul;
								}
							}
							echo '' . $category_list;
							?>
						</ul>
					</div>

				<?php } ?>

				<div class="magazin-wrap-content">

					<?php
					$first_post   = true;
					$post_counter = 0;
						// The Loop
					if ( $magazine->have_posts() ) {
						static $uniqid = 0;
						?>

						<div class="row">
							<?php
							while ( $magazine->have_posts() ) {
								$post_counter++;
								$magazine->the_post();
								$uniqid++;
								$thumbnail_url = get_the_post_thumbnail_url();
								$thumbnail_id  = get_post_thumbnail_id();
								if ( ! empty( $thumbnail_url ) ) {
									if ( ! class_exists( 'Wn_Img_Maniuplate' ) ) {
										require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
									}
									$image           = new \Wn_Img_Maniuplate(); // instance from settor class
									$thumbnail_url_1 = $image->m_image( $thumbnail_id, $thumbnail_url, '508', '300' ); // set required and get result
									$thumbnail_url_2 = $image->m_image( $thumbnail_id, $thumbnail_url, '120', '80' ); // set required and get result
								}
								if ( $first_post == true ) {
									?>
									<div class="col-md-6">
										<div class="left-section">
											<article class="magazine-b<?php echo '' . $type; ?> magazine-b<?php echo '' . $type; ?>-cont" data-id="<?php echo '' . $uniqid; ?>">
												<figure class="magazine-b<?php echo '' . $type; ?>-img">
													<img src="<?php echo '' . $thumbnail_url_1; ?>" alt="<?php the_title(); ?>" >
												</figure>
												<div class="magazine-b<?php echo '' . $type; ?>-cont">
													<?php
													if ( $hide_cat != 'true' ) {
														?>
														<div class="magazine-b<?php echo '' . $type; ?>-category" style="background: <?php echo deep_category_color(); ?>;">
															<span class="magazine-b<?php echo '' . $type; ?>-cat magazine-cat" data-id="<?php echo '' . $uniqid; ?>"><?php the_category( ', ' ); ?></span>
														</div>
														<?php
													}
													?>
													<div class="magazine-b<?php echo '' . $type; ?>-date">
														<i class="pe-7s-clock"></i><?php echo get_the_date(); ?>
													</div>
													<h3 class="magazine-b<?php echo '' . $type; ?>-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
													<div class="magazine-author">
														<span><?php echo get_avatar( get_the_author_meta( 'user_email' ), 28 ); ?></span>
														<span><?php the_author_posts_link(); ?></span>
													</div>
													<?php $reviews = $settings['reviews'] == 'show' ? deep_admin_post_review() : ''; ?>
												</div>
											</article>
										</div>
									</div>
								<?php } else { ?>
										<?php if ( $post_counter == 2 ) { ?>
											<div class="col-md-6">
												<div class="right-section">
										<?php } ?>
												<article class="wn-pagination magazine-b<?php echo '' . $type; ?> magazine-b<?php echo '' . $type; ?>-cont" data-id="<?php echo '' . $uniqid; ?>">
													<figure class="magazine-b<?php echo '' . $type; ?>-img">
														<img src="<?php echo '' . $thumbnail_url_2; ?>" alt="<?php the_title(); ?>" >
													</figure>
													<div class="magazine-b<?php echo '' . $type; ?>-cont">
														<div class="magazine-b<?php echo '' . $type; ?>-date">
															<i class="pe-7s-clock"></i><?php echo get_the_date(); ?>
														</div>
														<?php $reviews = $reviews == 'show' ? deep_admin_post_review() : ''; ?>
														<h3 class="magazine-b<?php echo '' . $type; ?>-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
													</div>
												</article>
										<?php if ( ( $magazine->current_post + 1 ) == ( $magazine->post_count ) ) { ?>
												</div>
											</div>
										<?php } ?>
									<?php if ( $first_post == true ) { ?>
										</div>
									<?php } ?>
									<?php
								} $first_post = false;
							}
							?>
						</div>
				</div>
			</div><!-- End magazin-wrap  -->
				<?php } ?>
		</div>
			<?php
		} elseif ( $type == '3' ) {
			static $magazin_uniqid = 0;
			$magazin_uniqid++;
			?>

		<div
			class="magazin-wrap magazin-<?php echo esc_attr( $type ) . ' ' . $shortcodeclass; ?>"
			<?php echo esc_attr( $shortcodeid ); ?>
			data-id="<?php echo esc_attr( $magazin_uniqid ); ?>"
			data-post-name="<?php echo esc_attr( $post_slug ); ?>"
			data-totall_post="<?php echo esc_attr( $totall_post ); ?>"
			data-pagination="<?php echo esc_attr( $pagination ); ?>"
			data-param_category="<?php echo esc_attr( $cat_ids ); ?>"
			data-param_tag="<?php echo esc_attr( $param_tag ); ?>"
			data-post_title="<?php echo esc_html( $post_title ); ?>"
			data-post_url="<?php echo esc_attr( $post_url ); ?>"
			data-type="<?php echo esc_html( $type ); ?>"
			data-sort_order="<?php echo esc_attr( $sort_order ); ?>"
			data-post_number="<?php echo esc_attr( $post_number ); ?>"
			data-post_prepage="<?php echo esc_attr( $post_prepage ); ?>"
			data-excerpt_value="<?php echo esc_attr( $excerpt_value ); ?>"
		>
			<?php
			static $title_uniqid = 0;
			$title_uniqid++;
			$post_title = $post_title ? '<h4 class="magazin-title" data-id="' . $title_uniqid . '">' . $post_title . '</h4>' : '';
			?>
			<div class="clearfix">
				<?php if ( ! empty( $settings['param_category'] ) ) { ?>
					<div class="magazin-cat-nav-wrap">
						<?php echo wp_kses( $post_title, wp_kses_allowed_html( 'post' ) ); ?>
						<ul class="magazin-cat-nav">
							<?php $category_list = '<li><a href="#" class="all cat-item colorf" data-param_category="' . $cat_ids . '">' . esc_html__( 'All', 'deep' ) . '</a></li>'; ?>
							<?php $cat_counter = 0; ?>
							<?php $catsize = sizeof( $settings['param_category'] ); ?>
							<?php
							foreach ( $settings['param_category'] as $id => $cat_slug ) {
								$get_cats = get_category_by_slug( $cat_slug );

								if ( $get_cats ) {
									$cat_id   = $get_cats->term_id;
									$cat_counter++;
									$total_cat_counter = $cat_counter;
									$start_ul          = ( $cat_counter == 5 ) ? '<li class="magazin-dropdown-list"><i class="sl-options"></i><ul>' : '';
									$category_list    .= $start_ul . '<li><a href="#" data-cat-slug="' . deep_get_cat_slug( $cat_id ) . '" class="cat-item" data-param_category="' . $cat_id . '">' . get_the_category_by_ID( $cat_id ) . '</a></li>';
								}
							}
							if ( $cat_counter == 5 ) {
								if ( $cat_counter == $catsize ) {
									$end_ul         = '</ul></li>';
									$category_list .= $end_ul;
								}
							}
							echo $category_list;
							?>
						</ul>
					</div>

				<?php } ?>

				<div class="magazin-wrap-content">
					<?php
					$first_post   = true;
					$post_counter = 0;
					// The Loop
					if ( $magazine->have_posts() ) {
						?>
						<div class="row">
							<?php
							static $uniqid = 0;
							while ( $magazine->have_posts() ) {
								$post_counter++;
								$magazine->the_post();
								$uniqid++;
								$thumbnail_url = get_the_post_thumbnail_url();
								$thumbnail_id  = get_post_thumbnail_id();
								if ( ! empty( $thumbnail_url ) ) {
									if ( ! class_exists( 'Wn_Img_Maniuplate' ) ) {
										require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
									}
									$image           = new \Wn_Img_Maniuplate(); // instance from settor class
									$thumbnail_url_1 = $image->m_image( $thumbnail_id, $thumbnail_url, '508', '300' ); // set required and get result
									$thumbnail_url_2 = $image->m_image( $thumbnail_id, $thumbnail_url, '120', '80' ); // set required and get result
								}
								if ( $first_post == true ) {
									?>
									<div class="col-md-6">
										<div class="left-section ">
											<article class="magazine-b<?php echo '' . $type; ?> magazine-b<?php echo '' . $type; ?>-cont" data-id="<?php echo '' . $uniqid; ?>">
												<figure class="magazine-b<?php echo '' . $type; ?>-img">
													<a href="<?php the_permalink(); ?>">
														<img src="<?php echo '' . $thumbnail_url_1; ?>" alt="<?php the_title(); ?>" >
													</a>
												</figure>
												<div class="magazine-b<?php echo '' . $type; ?>-cont">
													<?php
													if ( $hide_cat != 'true' ) {
														?>
														<div class="magazine-b<?php echo '' . $type; ?>-category" style="background: <?php echo deep_category_color(); ?>;">
															<span class="magazine-b<?php echo '' . $type; ?>-cat magazine-cat" data-id="<?php echo '' . $uniqid; ?>"><?php the_category( ', ' ); ?></span>
														</div>
														<?php
													}
													?>
													<div class="magazine-b<?php echo '' . $type; ?>-date">
														<i class="pe-7s-clock"></i><?php echo get_the_date(); ?>
													</div>
													<h3 class="magazine-b<?php echo '' . $type; ?>-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
													<div class="magazine-author">
														<span><?php echo get_avatar( get_the_author_meta( 'user_email' ), 28 ); ?></span>
														<span><?php the_author_posts_link(); ?></span>
													</div>
													<?php $reviews = $settings['reviews'] == 'show' ? deep_admin_post_review() : ''; ?>
												</div>
											</article>
										</div>
									</div>
								<?php } else { ?>
										<?php if ( $post_counter == 2 ) { ?>
											<div class="col-md-6">
												<div class="left-section">
													<article class="magazine-b<?php echo '' . $type; ?> magazine-b<?php echo '' . $type; ?>-cont" data-id="<?php echo '' . $uniqid; ?>">
														<figure class="magazine-b<?php echo '' . $type; ?>-img">
															<a href="<?php the_permalink(); ?>">
																<img src="<?php echo '' . $thumbnail_url_1; ?>" alt="<?php the_title(); ?>" >
															</a>
														</figure>
														<div class="magazine-b<?php echo '' . $type; ?>-cont">
															<?php
															if ( $hide_cat != 'true' ) {
																?>
																<div class="magazine-b<?php echo '' . $type; ?>-category" style="background: <?php echo deep_category_color(); ?>;">
																	<span class="magazine-b<?php echo '' . $type; ?>-cat magazine-cat" data-id="<?php echo '' . $uniqid; ?>"><?php the_category( ', ' ); ?></span>
																</div>
																<?php
															}
															?>
															<div class="magazine-b<?php echo '' . $type; ?>-date">
																<i class="pe-7s-clock"></i><?php echo get_the_date(); ?>
															</div>
															<h3 class="magazine-b<?php echo '' . $type; ?>-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
															<div class="magazine-author">
																<span><?php echo get_avatar( get_the_author_meta( 'user_email' ), 28 ); ?></span>
																<span><?php the_author_posts_link(); ?></span>
															</div>
															<?php $reviews = $settings['reviews'] == 'show' ? deep_admin_post_review() : ''; ?>
														</div>
													</article>
												</div>
											</div>
										</div>
										<?php } ?>
									<?php if ( $post_counter >= 3 ) { ?>
										<div class="col-md-6 below-section wn-pagination">
											<article class="magazine-b<?php echo '' . $type; ?> magazine-b<?php echo '' . $type; ?>-cont" data-id="<?php echo '' . $uniqid; ?>">
												<figure class="magazine-b<?php echo '' . $type; ?>-img">
													<a href="<?php the_permalink(); ?>">
														<img src="<?php echo '' . $thumbnail_url_2; ?>" alt="<?php the_title(); ?>" >
													</a>
												</figure>
												<div class="magazine-b<?php echo '' . $type; ?>-cont">
													<div class="magazine-b<?php echo '' . $type; ?>-date">
														<i class="pe-7s-clock"></i><?php echo get_the_date(); ?>
													</div>
													<?php $reviews = $settings['reviews'] == 'show' ? deep_admin_post_review() : ''; ?>
													<h3 class="magazine-b<?php echo '' . $type; ?>-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
												</div>
											</article>
										</div>
									<?php } ?>

									<?php
								} $first_post = false;
							}
							?>
					</div>
				</div>
			</div><!-- End magazin-wrap  -->
				<?php } ?>
			<?php
		}
			wp_reset_postdata();
	}
}
