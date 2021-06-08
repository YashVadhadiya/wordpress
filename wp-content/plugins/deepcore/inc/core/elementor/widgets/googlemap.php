<?php
namespace Elementor;

class Webnus_Element_Widgets_GoogleMaps extends \Elementor\Widget_Base {

	/**
	 * Retrieve widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'google-maps';

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

		return esc_html__( 'Webnus GoogleMaps', 'deep' );

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

		return 'eicon-google-maps';

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

		return [ 'wn-google-map-js' ];

	}

	/**
	 * widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'deep-map' ];

	}

	/**
	 * Register widget controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		// Content Tab
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Map Center', 'deep' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'lat_center',
			[
				'label'       => esc_html__( 'Map center Latitude', 'deep' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'please enter map center Latitude', 'deep' ),
				'default'     => '43.653225',
			]
		);

		$this->add_control(
			'lon_center',
			[
				'label'       => esc_html__( 'Map center Longitude', 'deep' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'please enter map center Longitude', 'deep' ),
				'default'     => '-79.383186',
			]
		);

		$this->end_controls_section();

		// Options
		$this->start_controls_section(
			'options_section',
			[
				'label' => esc_html__( 'Options', 'deep' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'zoom_map',
			[
				'label'       => esc_html__( 'Zoom', 'deep' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Default map zoom level. (1-19)', 'deep' ),
				'default'     => '9',
			]
		);

		$this->add_control(
			'zoom_click',
			[
				'label'       => esc_html__( 'Zoom After click on marker', 'deep' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Default map zoom level after click on marker. (1-19)', 'deep' ),
				'default'     => '17',
			]
		);

		$this->add_control(
			'map_type_display', // param_name
			[
				'label'        => esc_html__( 'Display Map Types', 'deep' ), // heading
				'type'         => \Elementor\Controls_Manager::SWITCHER, // type
				'label_on'     => esc_html__( 'Yes', 'deep' ),
				'label_off'    => esc_html__( 'No', 'deep' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'description'  => __( 'You can see Map Types <a href="https://developers.google.com/maps/documentation/javascript/maptypes" target="_blank">Here</a>', 'deep' ),
			]
		);

		$this->add_control(
			'map_type', // param_name
			[
				'label'       => esc_html__( 'Select Map Types', 'deep' ), // heading
				'type'        => \Elementor\Controls_Manager::SELECT, // type
				'options'     => [
					'roadmap'   => esc_html__( 'Roadmap', 'deep' ),
					'terrain'   => esc_html__( 'Terrain (load with Roadmap type)', 'deep' ),
					'satellite' => esc_html__( 'Satellite', 'deep' ),
					'hybrid'    => esc_html__( 'Hybrid (load with Satellite type)', 'deep' ),
				],
				'default'     => 'roadmap',
				'description' => esc_html__( 'Select your map type.', 'deep' ),
				'condition'   => [
					'map_type_display' => [ 'yes' ],
				],
			]
		);

		$this->add_control(
			'draggable', // param_name
			[
				'label'        => esc_html__( 'Enable Draggable feature', 'deep' ), // heading
				'type'         => \Elementor\Controls_Manager::SWITCHER, // type
				'label_on'     => esc_html__( 'Yes', 'deep' ),
				'label_off'    => esc_html__( 'No', 'deep' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'description'  => __( 'Enable Draggable feature. see <a href="https://developers.google.com/maps/documentation/javascript/markers#draggable" target="_blank">Here</a> for more information.<br/><br/>', 'deep' ),
			]
		);

		$this->add_control(
			'animation', // param_name
			[
				'label'        => esc_html__( 'Enable Drop Animation', 'deep' ), // heading
				'type'         => \Elementor\Controls_Manager::SWITCHER, // type
				'label_on'     => esc_html__( 'Yes', 'deep' ),
				'label_off'    => esc_html__( 'No', 'deep' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'description'  => __( 'Drop Animation for markers. see <a href="https://developers.google.com/maps/documentation/javascript/examples/marker-animations" target="_blank">Here</a> for more information.<br/><br/>', 'deep' ),
			]
		);

		$this->add_control(
			'zoom_control_display', // param_name
			[
				'label'        => esc_html__( 'Enable Zoom Control', 'deep' ), // heading
				'type'         => \Elementor\Controls_Manager::SWITCHER, // type
				'label_on'     => esc_html__( 'Yes', 'deep' ),
				'label_off'    => esc_html__( 'No', 'deep' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'description'  => esc_html__( 'The Zoom control displays "+" and "-" buttons for changing the zoom level of the map.', 'deep' ),
			]
		);

		$this->add_control(
			'scrollwheel', // param_name
			[
				'label'        => esc_html__( 'Enable Scrollwheel', 'deep' ), // heading
				'type'         => \Elementor\Controls_Manager::SWITCHER, // type
				'label_on'     => esc_html__( 'Yes', 'deep' ),
				'label_off'    => esc_html__( 'No', 'deep' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'description'  => esc_html__( 'This feature stops zoom in/out on your map when your page scrolls up and down from Google Maps section, so only the page will scroll.', 'deep' ),
			]
		);

		$this->add_control(
			'street_view', // param_name
			[
				'label'        => esc_html__( 'Enable Street View Control', 'deep' ), // heading
				'type'         => \Elementor\Controls_Manager::SWITCHER, // type
				'label_on'     => esc_html__( 'Yes', 'deep' ),
				'label_off'    => esc_html__( 'No', 'deep' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'description'  => __( 'You can see Documentation <a href="https://developers.google.com/maps/documentation/ios-sdk/streetview" target="_blank">Here</a><br/><br/>', 'deep' ),
			]
		);

		$this->add_control(
			'scale_control', // param_name
			[
				'label'        => esc_html__( 'Enable Scale Control', 'deep' ), // heading
				'type'         => \Elementor\Controls_Manager::SWITCHER, // type
				'label_on'     => esc_html__( 'Yes', 'deep' ),
				'label_off'    => esc_html__( 'No', 'deep' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'description'  => __( 'You can see Documentation <a href="https://developers.google.com/maps/documentation/javascript/controls#DefaultUI" target="_blank">Here</a><br/><br/>', 'deep' ),
			]
		);

		$this->end_controls_section();

		// Custom Marker Tab
		$this->start_controls_section(
			'custom_marker_section',
			[
				'label' => esc_html__( 'Custom Marker', 'deep' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'marker_type', // param_name
			[
				'label'		=> esc_html__( 'Select Marker Type', 'deep' ), // heading
				'type'		=> \Elementor\Controls_Manager::SELECT, // type
				'default'	=> 'img',
				'options'	=> [
					'img'   => esc_html__( 'Google Default / Image', 'deep' ),
					'radar' => esc_html__( 'Radar', 'deep' ),
				],
				'description' => esc_html__( 'if you select "Google Default / Image", you can upload image for your marker or leave it to have deafult Google Mapss icon.', 'deep' ),
			]
		);

		$this->add_control(
			'marker_color', // param_name
			[
				'label'       => esc_html__( 'Marker color', 'deep' ), // heading
				'type'        => \Elementor\Controls_Manager::COLOR, // type
				'description' => esc_html__( 'Select Marker color.', 'deep' ),
				'condition'   => [
					'marker_type' => [
						'radar',
					],
				],
			]
		);

		$this->add_control(
			'marker_animation', // param_name
			[
				'label'		=> esc_html__( 'Marker Animation', 'deep' ), // heading
				'type'		=> \Elementor\Controls_Manager::SELECT, // type
				'default'	=> 'none',
				'options'	=> [
					'none'   => 'None',
					'DROP'   => 'Drop',
					'BOUNCE' => 'Bounce',
				],
				'description' => esc_html__( 'You can select Drop or Bounce animation.', 'deep' ),
				'condition'   => [ // dependency
					'marker_type' => [
						'img',
					],
				],
			]
		);

		$this->end_controls_section();

		// Addresses Tab
		$this->start_controls_section(
			'address_section',
			[
				'label' => esc_html__( 'Addresses', 'deep' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'map_points',
			[
				'label'       => esc_html__( 'Google Maps', 'deep' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'description' => esc_html__( 'Please Add Your Item', 'deep' ),
				'fields'      => [
					[
						'name'        => 'latitude',
						'label'       => esc_html__( 'Latitude', 'deep' ),
						'type'        => \Elementor\Controls_Manager::TEXT,
						'description' => esc_html__( ' Please enter your Latitude ', 'deep' ),
					],
					[
						'name'        => 'longitude',
						'label'       => esc_html__( 'Longitude', 'deep' ),
						'type'        => \Elementor\Controls_Manager::TEXT,
						'description' => esc_html__( ' Please enter your Longitude ', 'deep' ),
					],
					[
						'name'        => 'address',
						'label'       => esc_html__( 'Address/Info', 'deep' ),
						'type'        => \Elementor\Controls_Manager::TEXTAREA,
						'description' => esc_html__( ' Please enter your Address or information about this point. It Appears after click on Icon marker.', 'deep' ),
					],
					[
						'name'  => 'location_title',
						'label' => esc_html__( 'Location Title', 'deep' ),
						'type'  => \Elementor\Controls_Manager::TEXT,
					],
					[
						'name'  => 'location_website',
						'label' => esc_html__( 'Location Website', 'deep' ),
						'type'  => \Elementor\Controls_Manager::URL,
					],

					[
						'name'        => 'custom_marker_s',
						'label'       => esc_html__( 'Custom point Marker', 'deep' ),
						'type'        => \Elementor\Controls_Manager::MEDIA, // type
						'description' => esc_html__( 'You can select an image for your marker seperately', 'deep' ),
					],

				],
				'default' => [
					[
						'latitude'	=> '43.653225',
						'longitude'	=> '-79.383186',
					],
				],
			]
		);

		$this->end_controls_section();

		// Class & ID Tab
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

		// Style Tab
		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Style', 'deep' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'width',
			[
				'label'       => esc_html__( 'Width', 'deep' ),
				'type'        => \Elementor\Controls_Manager::TEXT, // type
				'description' => esc_html__( 'Set to 0 is the full width. (0-960)', 'deep' ),
				'default'     => '0',
			]
		);

		$this->add_control(
			'height',
			[
				'label'       => esc_html__( 'Height', 'deep' ),
				'type'        => \Elementor\Controls_Manager::TEXT, // type
				'description' => esc_html__( 'Default is 400.', 'deep' ),
				'default'     => '400',
			]
		);

		$this->add_control(
			'map_style', // param_name
			[
				'label'       => esc_html__( 'Select Map Style', 'deep' ), // heading
				'type'        => \Elementor\Controls_Manager::SELECT, // type
				'options'     => [
					'simple' => esc_html__( 'Simple', 'deep' ),
					'light'  => esc_html__( 'Ultra Light', 'deep' ),
					'gray'   => esc_html__( 'Subtle Grayscale', 'deep' ),
					'black'  => esc_html__( 'Shade of Grey', 'deep' ),
					'blue'   => esc_html__( 'Blue water' ),
				],
				'description' => esc_html__( 'if you select "Simple", you see simple map and you can select "hue" color.', 'deep' ),
			]
		);

		$this->add_control(
			'bg_color', // param_name
			[
				'label'       => esc_html__( 'Background color', 'deep' ), // heading
				'type'        => \Elementor\Controls_Manager::COLOR, // type
				'description' => esc_html__( 'Select map background color.', 'deep' ),
			]
		);

		$this->add_control(
			'hue', // param_name
			[
				'label'       => esc_html__( 'Hue', 'deep' ), // heading
				'type'        => \Elementor\Controls_Manager::COLOR, // type
				'description' => __( 'You can see Hue example <a href="https://developers.google.com/maps/documentation/javascript/styling" target="_blank">Here</a>', 'deep' ),
				'condition'   => [
					'map_style' => [
						'simple',
					],
				],
			]
		);

		$this->end_controls_section();

		// Custom css tab
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
	 * Render List widget output on the frontend.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		wp_enqueue_script( 'deep-googlemap-api' );
		$shortcodeclass   = $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
		$shortcodeid      = $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';
		$width            = $settings['width'];
		$height           = $settings['height'];
		$zoom_click       = $settings['zoom_click'];
		$zoom_map         = $settings['zoom_map'];
		$map_style        = $settings['map_style'];
		$map_type         = $settings['map_type'];
		$lat_center       = $settings['lat_center'];
		$lon_center       = $settings['lon_center'];
		$bg_color         = $settings['bg_color'];
		$hue              = $settings['hue'];
		$marker_animation = $settings['marker_animation'];
		$marker_color     = $settings['marker_color'];

		$width      = ( $width && is_numeric( $width ) ) ? 'width:' . $width . 'px;' : '';
		$height     = ( $height && is_numeric( $height ) ) ? 'height:' . $height . 'px;' : '';
		$zoom_click = ( $zoom_click ) ? $zoom_click : $zoom_map;
		$map_style  = $map_style ? $map_style : 'simple';

		$draggable            = $settings['draggable'] == 'yes' ? 'true' : 'false';
		$animation            = $settings['animation'] == 'yes' ? 'true' : 'false';
		$map_type_display     = $settings['map_type_display'] == 'yes' ? 'true' : 'false';
		$zoom_control_display = $settings['zoom_control_display'] == 'yes' ? 'true' : 'false';
		$scrollwheel          = $settings['scrollwheel'] == 'yes' ? 'true' : 'false';
		$street_view          = $settings['street_view'] == 'yes' ? 'true' : 'false';
		$scale_control        = $settings['scale_control'] == 'yes' ? 'true' : 'false';
		$marker_type          = $settings['marker_type'] ? $settings['marker_type'] : '';

		$map_item_data = array();
		// Fetch Carousle Item Loop Variables
		if ( $settings['map_points'] ) {
			foreach ( $settings['map_points'] as $data ) {
				$new_line                     = $data;
				$new_line['latitude']         = isset( $new_line['latitude'] ) ? $new_line['latitude'] : '';
				$new_line['longitude']        = isset( $new_line['longitude'] ) ? $new_line['longitude'] : '';
				$new_line['address']          = isset( $new_line['address'] ) ? $new_line['address'] : '';
				$new_line['location_title']   = isset( $new_line['location_title'] ) ? $new_line['location_title'] : '';
				$new_line['location_website'] = isset( $new_line['location_website'] ) ? $new_line['location_website']['url'] : '';
				$new_line['custom_marker_s']  = isset( $new_line['custom_marker_s'] ) ? $new_line['custom_marker_s'] : '';
				$map_item_data[]              = $new_line;
			}
		}

		$map_addresses = array();
		$marker_icon   = '';
		foreach ( $map_item_data as $map_single_item ) :
			if ( $map_single_item['location_title'] || $map_single_item['latitude'] || $map_single_item['longitude'] || $map_single_item['custom_marker_s'] || $map_single_item['address'] ) {
				if ( $map_single_item['custom_marker_s'] ) {
					$marker_icon = $map_single_item['custom_marker_s']['url'];
				} elseif ( $marker_type == 'radar' ) {
					$marker_icon = 'radar';
				} else {
					$marker_icon = $custom_marker['url'];
				}
				$map_addresses[] = '[\'' . $map_single_item['location_title'] . '\',' . $map_single_item['latitude'] . ',' . $map_single_item['longitude'] . ',' . $marker_icon . ',\'' . $map_single_item['address'] . '\']|';
			};
		endforeach;

		ob_start();

		static $uniqid = 0;
		$uniqid++; ?>

		<div class="w-map <?php echo '' . $shortcodeclass; ?>" <?php echo $shortcodeid; ?> >
			<div
			data-map-draggable			= "<?php echo esc_attr( $draggable ); ?>"
			data-map-type-display		= "<?php echo esc_attr( $map_type_display ); ?>"
			data-map-zoom-control 		= "<?php echo esc_attr( $zoom_control_display ); ?>"
			data-map-scroll-wheel 		= "<?php echo esc_attr( $scrollwheel ); ?>"
			data-map-street-view 		= "<?php echo esc_attr( $street_view ); ?>"
			data-map-scale-control 		= "<?php echo esc_attr( $scale_control ); ?>"
			data-map-zoom 				= "<?php echo esc_attr( $zoom_map ); ?>"
			data-map-zoom-click 		= "<?php echo esc_attr( $zoom_click ); ?>"
			data-map-types 				= "<?php echo esc_attr( $map_type ); ?>"
			data-map-latitude-center 	= "<?php echo esc_attr( $lat_center ); ?>"
			data-map-longitude-center 	= "<?php echo esc_attr( $lon_center ); ?>"
			data-map-background-color 	= "<?php echo esc_attr( $bg_color ); ?>"
			data-map-hue-color 			= "<?php echo esc_attr( $hue ); ?>"
			data-map-animation 			= "<?php echo esc_attr( $animation ); ?>"
			data-map-addresses 			= "<?php echo implode( '', $map_addresses ); ?>"
			data-map-animation-value	= "<?php echo esc_attr( $marker_animation ); ?>"
			data-map-marker-type		= "<?php echo esc_attr( $marker_type ); ?>"
			data-map-marker-color		= "<?php echo esc_attr( $marker_color ); ?>"
			data-map-style				= "<?php echo esc_attr( $map_style ); ?>"
			id							= "map_<?php echo esc_attr( $uniqid ); ?>"
			style 						= "<?php echo esc_attr( $width ); ?><?php echo esc_attr( $height ); ?>"
			class 						= "webnus-google-map"
			>
			</div>
		</div>

		<?php
		$out = ob_get_contents();
		ob_end_clean();
		$out        = str_replace( '<p></p>', '', $out );
		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>' . $custom_css . '</style>';
		}
		echo $out;
	}

}
