<?php
namespace Elementor;

class Webnus_Element_Widgets_WnTabs extends \Elementor\Widget_Base {

	/**
	 * Retrieve WnTabs widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'wn-tabs';
		
	}

	/**
	 * Retrieve WnTabs widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return __( 'Webnus Tab', 'deep' );

	}

	/**
	 * Retrieve WnTabs widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'ti-layout-tab';

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

		return [ 'wn-tabs' ];

	}

	/**
	 * Register WnTabs widget controls.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		
		$elementor_tpl = \Elementor\Plugin::instance()->templates_manager->get_source( 'local' )->get_items();        
        $elementor_tpl_opts = [ '0' => __( 'Elementor template is not defined yet.', 'deep' ) ];

        if ( ! empty( $elementor_tpl ) ) {
            $elementor_tpl_opts = [ '0' => __( 'Select elementor template', 'deep' ) ];

            foreach ( $elementor_tpl as $template ) {
                $elementor_tpl_opts[ $template['template_id'] ] = $template['title'] . ' (' . $template['type'] . ')';
            }
        }
		
		// Start general tab
		$this->start_controls_section(
			'content_section',
			[
				'label'	=>	esc_html__( 'General', 'deep' ),
				'tab'	=>	\Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);
		$this->add_control(
			'tab_items',
			[
				'label'			=> esc_html__( 'Process Item', 'deep' ),
				'type'			=> \Elementor\Controls_Manager::REPEATER,
				'description'	=>  esc_html__( 'If you want this element cover whole page width, please add it inside of a full row. For this purpose, click on edit button of the row and set Select Row Type on Full Width Row.', 'deep' ),
				'default' => [
					[
						'title'		=> __( 'Tab #1', 'deep' ),
						'editor'	=> __( 'I am tab content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorp I am er mattis, pulvinar dapibus leo.', 'deep' ),
					],
					[
						'title'		=> __( 'Tab #2', 'deep' ),
						'editor'	=> __( 'I am tab content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorp I am er mattis, pulvinar dapibus leo.', 'deep' ),
					],
				],
				'fields' => [
					[
						'name'			=> 'title',
						'label'			=>  esc_html__( 'Tab Title', 'deep' ),
						'type'			=> \Elementor\Controls_Manager::TEXT,
						'default'		=> esc_html__( 'Tab Title' , 'deep' ),
					],
					[
						'name'			=> 'icon',
						'label'			=> esc_html__( 'Tab Icon', 'deep' ),
						'type'			=> \Elementor\Controls_Manager::ICON,
						'description'	=>  esc_html__( 'Select icon from library.', 'deep' ),
					],
					[
						'name'		=> 'content_type',
						'label'		=> esc_html__( 'Content Type', 'deep' ),
						'type'		=> \Elementor\Controls_Manager::SELECT,
						'default'	=> 'editor',
						'options' 	=> [
							'editor'		=> esc_html__( 'Editor', 'deep' ),
							'elementor_tpl'	=> esc_html__( 'Elementor Template', 'deep' ),
						],
					],
					[
						'name'       => 'editor',
						'label'      => esc_html__( 'Editor Content', 'deep' ),
						'type'       => \Elementor\Controls_Manager::WYSIWYG,
						'default'    => esc_html__( 'I am tab content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorp I am er mattis, pulvinar dapibus leo.', 'deep' ),
						'show_label' => false,
						'condition'  => ['content_type' => 'editor'],
					],
					[
						'name'			=> 'elementor_tpl_id',
						'label'			=> esc_html__( 'Choose template', 'deep' ),
						'type'			=> \Elementor\Controls_Manager::SELECT,
						'default'		=> '0',
						'options'		=> $elementor_tpl_opts,
						'label_block'	=> 'true',
						'condition'		=> ['content_type' => "elementor_tpl"],
					],
				]
			]
		);
		// End general tab
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



	}
	
	/**
	 * Render WnTabs widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings	= $this->get_settings_for_display();
		$id			= $this->get_id();
		$tab_items = $tab_contents = '';
		
		foreach ( $settings['tab_items'] as $tab_item ) :
			$tab_items .= '<li class="wn-tabs-item"><a href="#' . esc_attr( sanitize_title( $tab_item['title'] ) ) . '">' . esc_html( $tab_item['title'] ) . '</a></li>';	
			if ( $tab_item['content_type'] == 'elementor_tpl' && ! empty( $tab_item['elementor_tpl_id'] ) ) {
				$tab_contents .= \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $tab_item['elementor_tpl_id'] );
			} else {
				$tab_contents .= wp_kses_post( $tab_item['editor'] );
			}
		endforeach;

        $custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}
		?>

		<div class="wn-tabs" id="wn-tabs-<?php echo esc_attr($id); ?>">
			<ul class="wn-tabs-items"><?php echo $tab_items; ?></ul>
			<div class="wn-tabs-contents"><?php echo $tab_contents; ?></div>
		</div>

		<?php
	}

}