<?php
namespace Elementor;

class Webnus_Element_Widgets_VideoTeaser extends \Elementor\Widget_Base {

	/**
	 * Retrieve widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'wn_video_teaser';

	}

	/**
	 * Retrieve widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return  esc_html__( 'Webnus Video Teaser', 'deep' );

	}

	/**
	 * Retrieve widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-youtube';

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

		return [ 'deep-video-teaser' ];

	}

	protected function _register_controls() {

		// Styling
		$this->start_controls_section(
			'general',
			[
				'label'	=>  esc_html__( 'General', 'deep' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'			=> 'video_url',
				'label'			=>  esc_html__( 'Video URL', 'deep' ),
				'types'			=> [ 'video' ],
				'selector'		=> '{{WRAPPER}} .elementor-background-video-container',
			]
		);

		$this->add_control(
			'action_type',
			[
				'label'		=> __( 'Action on click', 'deep' ),
				'type'		=> \Elementor\Controls_Manager::SELECT,
				'default'	=> 'popup',
				'options'	=> [
					'popup'		=> __( 'Light box video', 'deep' ),
					'page_url'	=> __( 'Page URL', 'deep' ),
				],
			]
		);

		$this->add_control(
			'target_url',
			[
				'label'			=> __( 'Target URL', 'deep' ),
				'type'			=> \Elementor\Controls_Manager::URL,
				'placeholder'	=> __( 'https://your-link.com', 'deep' ),
				'show_external' => true,
				'default' => [
					'url'			=> '',
					'is_external'	=> true,
					'nofollow'		=> true,
				],
				'condition'	=> [
					'action_type'	=> [
						'page_url'
					]
				],
			]
		);

		$this->add_control(
			'overlay_color',
			[
				'label'		=> __( 'Overlay color', 'deep' ),
				'type'		=> \Elementor\Controls_Manager::COLOR,
				'scheme'	=> [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'default'	=> 'rgba(60,53,255,0)',
				'selectors'	=> [
					'{{WRAPPER}} .video-background-wrap .wn-popup-video' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'height',
			[
				'label' => __( 'Video Height', 'deep' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 684,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 684,
				],
				'selectors' => [
					'{{WRAPPER}} .video-background-wrap' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// Class & ID Tab
		$this->start_controls_section(
			'class_id_section',
			[
				'label' =>  esc_html__( 'Class & ID', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

			$this->add_control(
				'shortcodeclass',
				[
					'label'	=>  esc_html__( 'Extra Class', 'deep' ),
					'type'	=> \Elementor\Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'shortcodeid',
				[
					'label'	=>  esc_html__( 'ID', 'deep' ),
					'type'	=> \Elementor\Controls_Manager::TEXT,
				]
			);

		$this->end_controls_section();

		// Style
		$this->start_controls_section(
			'section_box_style',
			[
				'label' => __( 'Box Style', 'deep' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .video-background-wrap',
			]
		);

		$this->add_control(
			'box_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .video-background-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'box_shadow',
					'label' => __( 'Box Shadow', 'deep' ),
					'selector' => '#wrap {{WRAPPER}} .video-background-wrap',
				]
		);

		$this->add_control(
			'box_padding', //param_name
			[
				'label' 		=> __( 'Padding', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS, //type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'#wrap {{WRAPPER}} .video-background-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} .video-background-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Custom css tab
		$this->start_controls_section(
			'custom_css_section',
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

	protected function render() {

		$settings		= $this->get_settings();

		$action_type	= $settings['action_type']		? $settings['action_type'] : '';
		$target_url		= $settings['target_url']['url'] ? $settings['target_url']['url'] : '';
		$link_target	= $settings['target_url']['is_external'] ? 'target="_blank"' : '';
		$rel_url		= $settings['target_url']['nofollow'] ? 'rel="nofollow"' : '';
		$height			= $settings['height']['size']	? $settings['height']['size'] : '';
		$shortcodeid	= $settings['shortcodeid']		? ' id="' . $settings['shortcodeid'] . '"' : '';
		$overlay_color	= $settings['overlay_color']	? $settings['overlay_color'] : '';
		$shortcodeclass	= $settings['shortcodeclass']	? $settings['shortcodeclass'] : '';
		if ( $action_type == 'popup' ) {
			$target_url	= '<a href="' . esc_attr( $settings['video_url_video_link'] ) . '" class="wn-popup-video"></a>';
		} else {
			$target_url	= '<a href="'. esc_url( $target_url ) .'" ' . $link_target . $rel_url . '></a>';
		}

		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
        } ?>

		<div class="video-background-wrap <?php echo $shortcodeclass; ?>" <?php echo $shortcodeid; ?> >
			<?php echo $target_url;
			if ( 'video' === $settings['video_url_background'] ) :
				if ( $settings['video_url_video_link'] ) :
					$video_properties = Embed::get_video_properties( $settings['video_url_video_link'] ); ?>
					<div class="elementor-background-video-container elementor-hidden-phone">
						<?php if ( $video_properties ) : ?>
							<iframe class="elementor-background-video-embed"
							frameborder="0"
							allowfullscreen="1"
							allow="autoplay; encrypted-media"
							title="YouTube video player"
							src="https://www.youtube.com/embed/<?php echo esc_attr( $video_properties['video_id'] );?>?controls=0&;showinfo=0&;rel=0&;autoplay=1&;mute=1&;loop=1"
							style="width: 1216px; height: 684px;">
							</iframe>
						<?php else : ?>
							<video class="elementor-background-video-hosted elementor-html5-video" autoplay loop muted></video>
						<?php endif; ?>
					</div>
				<?php
				endif;
			endif; ?>
		</div>
		<?php

	}

}
