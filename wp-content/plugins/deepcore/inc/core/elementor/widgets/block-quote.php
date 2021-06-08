<?php
namespace Elementor;

class Webnus_Element_Widgets_Block_Quote extends \Elementor\Widget_Base {

	/**
	 * Retrieve Block Quote widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'block-quote';
	}

	/**
	 * Retrieve Block Quote widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Webnus Block Quote', 'deep' );
	}

	/**
	 * Retrieve Block Quote widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-blockquote';
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
	 * Register Block Quote widget controls.
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
		$this->add_control(
			'type',
			[
				'label'       => esc_html__( 'Type', 'deep' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'description' => esc_html__( 'Select shortcode type', 'deep' ),
				'default'     => '1',
				'options'     => [
					'1' => esc_html__( '1', 'deep' ),
					'2' => esc_html__( '2', 'deep' ),
				],
			]
		);
		$this->add_control(
			'author_image',
			[
				'label'       => esc_html__( 'Author Image', 'deep' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
				'description' => esc_html__( 'Select an image for author image, recommended size ( 50px X 50px )', 'deep' ),
				'default'     => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition'   => [
					'type' => [
						'2',
					],
				],
			]
		);
		// Image Size
        $this->add_control(
			'thumbnail',
			[
				'label' => esc_html__( 'Image Size', 'deep' ),
				'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
				'description' => esc_html__( 'Enter image size (Example: 200x100 (Width x Height)).', 'deep' ),
				'default' => [
					'width' => '90',
					'height' => '90',
				],
				'condition'   => [
					'type' => [
						'2',
					],
				],
			]
		);
		$this->add_control(
			'author_image_alt',
			[
				'label'     => esc_html__( 'Author Image alt', 'deep' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'type' => [
						'2',
					],
				],
			]
		);
		$this->add_control(
			'author_name',
			[
				'label'     => esc_html__( 'Author Name', 'deep' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'type' => [
						'2',
					],
				],
			]
		);
		$this->add_control(
			'background_image',
			[
				'label'       => esc_html__( 'Background Image', 'deep' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
				'description' => esc_html__( 'Select an image for background image', 'deep' ),
				'default'     => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition'   => [ // dependency
					'type' => [
						'1',
					],
				],
			]
		);
		$this->add_control(
			'background_image_alt',
			[
				'label'     => esc_html__( '‌Background Image alt', 'deep' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [ // dependency
					'type' => [
						'1',
					],
				],
			]
		);
		$this->add_control(
			'background_color', 
			[
				'label'     => __( 'Background color', 'deep' ), 
				'type'      => \Elementor\Controls_Manager::COLOR, 
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-block-quote-content' => 'background-color: {{VALUE}}',
				],
				'condition' => [ // dependency
					'type' => [
						'2',
					],
				],
			]
		);
		$this->add_control(
			'block_content',
			[
				'label'   => esc_html__( 'Content', 'deep' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'rows'    => 10,
				'default' => esc_html__( 'Innovative design always develops in tandem with innovative technology.', 'deep' ),
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'classid_section',
			[
				'label' => esc_html__( 'Class & ID', 'deep' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'shortcodeclass',
			[
				'label' => esc_html__( 'Extra Class', 'deep' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'shortcodeid',
			[
				'label' => esc_html__( 'ID', 'deep' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
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
				'selector' => '#wrap {{WRAPPER}} .wn-block-quote .content',
			]
		);
		$this->add_control(
			'content_color', 
			[
				'label'     => __( 'Color', 'deep' ), 
				'type'      => \Elementor\Controls_Manager::COLOR, 
				'selectors' => [
					'#wrap {{WRAPPER}} .wn-block-quote .content' => 'color: {{VALUE}} !important',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'content_bg',
				'label'    => __( 'Background', 'deep' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '#wrap {{WRAPPER}} .wn-block-quote .content',
			]
		);
		$this->add_control(
			'content_padding', 
			[
				'label'      => __( 'Padding', 'deep' ), 
				'type'       => \Elementor\Controls_Manager::DIMENSIONS, 
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'#wrap {{WRAPPER}} .wn-block-quote .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'content_margin', 
			[
				'label'      => __( 'Margin', 'deep' ), 
				'type'       => \Elementor\Controls_Manager::DIMENSIONS, 
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'#wrap {{WRAPPER}} .wn-block-quote .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '#wrap {{WRAPPER}} .wn-block-quote',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-block-quote',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => __( 'Box Shadow', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} .wn-block-quote',
			]
		);
		$this->add_control(
			'box_padding', 
			[
				'label'      => __( 'Padding', 'deep' ), 
				'type'       => \Elementor\Controls_Manager::DIMENSIONS, 
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'#wrap {{WRAPPER}} .wn-block-quote' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'box_margin', 
			[
				'label'      => __( 'Margin', 'deep' ), 
				'type'       => \Elementor\Controls_Manager::DIMENSIONS, 
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'#wrap {{WRAPPER}} .wn-block-quote' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'custom_css_section_style',
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
	 * Render Block Quote widget output on the frontend.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		if( !empty( $settings['thumbnail']['width'] ) && !empty( $settings['thumbnail']['width'] ) ) {
			if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
				require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
			}
			$image = new \Wn_Img_Maniuplate;
			$settings['author_image']['url'] = $image->m_image( $settings['author_image']['id'], $settings['author_image']['url'] , $settings['thumbnail']['width'] , $settings['thumbnail']['height'] );
		}
		$shortcodeclass       	= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
		$shortcodeid          	= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';
		$block_content        	= $settings['block_content'] ? '<p class="content">' . $settings['block_content'] . '</p>' : '';
		$author_name          	= $settings['author_name'] ? '<p class="author-name">' . $settings['author_name'] . '</p>' : '';
		$background_image_alt 	= $settings['background_image_alt'] ? $settings['background_image_alt'] : '';
		$author_image_alt     	= $settings['author_image_alt'] ? $settings['author_image_alt'] : '';
		$background_image     	= $settings['background_image'] ? '<img src="' . $settings['background_image']['url'] . '" alt="' . esc_attr( $background_image_alt ) . '">' : '';
		$author_image_url_1   	= ! empty( $settings['author_image'] ) ? '<img src="' . esc_url( $settings['author_image']['url'] ) . '" alt="' . esc_attr( $author_image_alt ) . '">' : '';
		$author_image_url_2   	= ! empty( $settings['author_image'] ) ? '<img src="' . esc_url( $settings['author_image']['url'] ) . '" alt="' . esc_attr( $author_image_alt ) . '">' : '';
		$author_box           	= ( ! empty( $author_image_url_1 ) && ! empty( $author_name ) ) ? '<div class="authorbox">' . $author_image_url_1 . $author_name . '</div>' : '';

		if ( $settings['type'] == '1' ) {
			$out = '
				<div class="wn-block-quote wn-block-quote-' . $settings['type'] . ' ' . $shortcodeclass . '"  ' . $shortcodeid . ' >
					<div class="block-quote-content-wrap">
						<div class="image-wrap">' . $background_image . '</div>
						<div class="block-quote-content">
							' . $block_content . $author_box . '
						</div>
					</div>
				</div>';
		} elseif ( $settings['type'] == '2' ) {
			$out = '
				<div class="wn-block-quote wn-block-quote-' . $settings['type'] . ' ' . $shortcodeclass . '"  ' . $shortcodeid . ' >
					<div class="wn-block-quote-content colorb">' . $block_content . $author_name . '</div>
					<div class="block-quote-author">' . $author_image_url_2 . '</div>
				</div>';
		}

		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>' . $custom_css . '</style>';
		}
		echo $out;

	}

}
