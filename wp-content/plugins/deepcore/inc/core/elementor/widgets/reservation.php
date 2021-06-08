<?php
namespace Elementor;

class Webnus_Element_Widgets_Reservation extends \Elementor\Widget_Base {

	/**
	 * Retrieve Reservation widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'reservation';

	}

	/**
	 * Retrieve Reservation widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Reservation', 'deep' );

	}

	/**
	 * Retrieve Reservation widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'ti-time';

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

		return [ 'wn-reservation', 'deep-nice-select', 'jquery-ui-datepicker' ];

	}

	/**
	 * widget styles.
	 *
	 * @since 4.2.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'deep-nice-select', 'deep-datepicker', 'wn-deep-reservation' ];

	}

	/**
	 * Register Reservation widget controls.
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
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		// Select Reservation Type
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

		// Reservation Table ID
		$this->add_control(
			'restaurant_id',
			[
				'label'       => esc_html__( 'Open Table Restaurant ID', 'deep' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( '53425', 'deep' ),
				'description' => esc_html__( 'Sign up here to get ID: https://www.opentable.com/start/home', 'deep' ),
			]
		);

		// Reservation Description
		$this->add_control(
			'description',
			[
				'label'       => esc_html__( 'Description', 'deep' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 10,
				'placeholder' => esc_html__( 'The opening hour is 7:00 am - 11:00 pm every day on week', 'deep' ),
			]
		);

		$this->end_controls_section();

		// Class & ID Tab
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

		// Style
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
				'selector' => '#wrap {{WRAPPER}} form > div',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border',
				'label'    => __( 'Border', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} form > div',
			]
		);

		$this->add_control(
			'box_border_radius', // param_name
			[
				'label'      => __( 'Border Radius', 'deep' ), // heading
				'type'       => \Elementor\Controls_Manager::DIMENSIONS, // type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'#wrap {{WRAPPER}} form > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => __( 'Box Shadow', 'deep' ),
				'selector' => '#wrap {{WRAPPER}} form > div',
			]
		);

		$this->add_control(
			'box_padding', // param_name
			[
				'label'      => __( 'Padding', 'deep' ), // heading
				'type'       => \Elementor\Controls_Manager::DIMENSIONS, // type
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'#wrap {{WRAPPER}} form > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'#wrap {{WRAPPER}} form > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Custom css tab
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
	 * Render Reservation widget output on the frontend.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$type          = $settings['type'];
		$restaurant_id = $settings['restaurant_id'];
		$description   = $settings['description'];

		// Class & ID
		$shortcodeclass = $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
		$shortcodeid    = $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';

		$out = '';

		switch ( $type ) {
			case '1':
					$out .= '
                    <form action="http://www.opentable.com/restaurant-search.aspx" method="get" class="wpcf7-form ' . $shortcodeclass . '"  ' . $shortcodeid . '>
                        <div class="book-form-deep reservation-form-w">
                            <div class="col-sm-12 r-deep-form r-date">
                                    <input name="startDate" type="text" class="open-table-date" value="" autocomplete="off">
                            </div>
                            <div class="col-sm-12 r-deep-form r-time">
                                    <select name="time" class="wn-niceselect time">';
										// Time Loop
										$inc   = 30 * 60;
										$start = ( strtotime( '00:00:00' ) ); // 6  AM
										$end   = ( strtotime( '11:59PM' ) ); // 10 PM
				for ( $i = $start; $i <= $end; $i += $inc ) {
					// to the standart format
					$time      = date( 'g:i a', $i );
					$timeValue = date( 'g:ia', $i );
					$default   = '7:00pm';
					$out      .= "<option value=\"$timeValue\" " . ( ( $timeValue == $default ) ? ' selected="selected" ' : '' ) . ">$time</option>" . PHP_EOL;
				}
									$out .= '</select>
                            </div>
                            <div class="col-sm-12 r-deep-form r-people">
                                <select name="people" class="wn-niceselect people">
                                    <option value="1">' . esc_html__( '1 Person', 'deep' ) . '</option>
                                    <option value="2">' . esc_html__( '2 People', 'deep' ) . '</option>
                                    <option value="3">' . esc_html__( '3 People', 'deep' ) . '</option>
                                    <option value="4">' . esc_html__( '4 People', 'deep' ) . '</option>
                                    <option value="5">' . esc_html__( '5 People', 'deep' ) . '</option>
                                    <option value="6">' . esc_html__( '6 People', 'deep' ) . '</option>
                                    <option value="7">' . esc_html__( '7 People', 'deep' ) . '</option>
                                    <option value="8">' . esc_html__( '8 People', 'deep' ) . '</option>
                                    <option value="9">' . esc_html__( '9 People', 'deep' ) . '</option>
                                    <option value="10">' . esc_html__( '10 People', 'deep' ) . '</option>
                                </select>
                            </div>
                            <div class="col-sm-12 r-deep-form r-submition">
                                <input type="submit" class="colorr" value="' . esc_html__( 'FIND A TABLE', 'deep' ) . '">
                            </div>
                            <input type="hidden" name="RestaurantID" class="RestaurantID" value="' . $restaurant_id . '">
                            <input type="hidden" name="rid" class="rid" value="' . $restaurant_id . '">
                            <input type="hidden" name="GeoID" class="GeoID" value="15">
                            <input type="hidden" name="txtDateFormat" class="txtDateFormat" value="MM/dd/yyyy">
                            <input type="hidden" name="RestaurantReferralID" class="RestaurantReferralID" value="' . $restaurant_id . '">
                            <p>' . $description . '</p>
                        </div>
                    </form>';
				break;

			case '2':
					$out .= '<form action="http://www.opentable.com/restaurant-search.aspx" method="get" class="wpcf7-form ' . $shortcodeclass . '"  ' . $shortcodeid . '  target="_blank">
                        <div class="row reservation-form-w2">

                        <div class="col-md-3 rfw-col">
                            <i class="li_calendar"></i>
                            <span class="form-control-wrap">
                                <input name="startDate" type="text" class="open-table-date" value="" autocomplete="off">
                            </span>
                        </div>

                        <div class="col-md-3 rfw-col">
                            <i class="li_clock"></i>
                            <span class="form-control-wrap">
                                    <select name="time" class=" otw-selectpicker wn-niceselect">';
				// Time Loop
				$inc   = 30 * 60;
				$start = ( strtotime( '00:00:00' ) ); // 6  AM
				$end   = ( strtotime( '11:59PM' ) ); // 10 PM
				for ( $i = $start; $i <= $end; $i += $inc ) {
					// to the standart format
					$time      = date( 'g:i a', $i );
					$timeValue = date( 'g:ia', $i );
					$default   = '7:00pm';
					$out      .= "<option value=\"$timeValue\" " . ( ( $timeValue == $default ) ? ' selected="selected" ' : '' ) . ">$time</option>" . PHP_EOL;
				}
									$out .= '
                                    </select>
                            </span>
                        </div>

                        <div class="col-md-3 rfw-col">
                            <i class="ti-user"></i>
                            <span class="form-control-wrap">
                                <select name="partySize" class="otw-party-size-select wn-niceselect">
                                    <option value="1">' . esc_html__( '1 Person', 'deep' ) . '</option>
                                    <option value="2">' . esc_html__( '2 People', 'deep' ) . '</option>
                                    <option value="3">' . esc_html__( '3 People', 'deep' ) . '</option>
                                    <option value="4">' . esc_html__( '4 People', 'deep' ) . '</option>
                                    <option value="5">' . esc_html__( '5 People', 'deep' ) . '</option>
                                    <option value="6">' . esc_html__( '6 People', 'deep' ) . '</option>
                                    <option value="7">' . esc_html__( '7 People', 'deep' ) . '</option>
                                    <option value="8">' . esc_html__( '8 People', 'deep' ) . '</option>
                                    <option value="9">' . esc_html__( '9 People', 'deep' ) . '</option>
                                    <option value="10">' . esc_html__( '10 People', 'deep' ) . '</option>
                                </select>
                            </span>
                        </div>

                        <div class="col-md-3 rfw-col">
                            <input type="submit" class="colorb" value="' . esc_html__( 'FIND A TABLE', 'deep' ) . '">
                        </div>

                        <input type="hidden" name="RestaurantID" class="RestaurantID" value="' . $restaurant_id . '">
                        <input type="hidden" name="rid" class="rid" value="' . $restaurant_id . '">
                        <input type="hidden" name="GeoID" class="GeoID" value="15">
                        <input type="hidden" name="txtDateFormat" class="txtDateFormat" value="MM/dd/yyyy">
                        <input type="hidden" name="RestaurantReferralID" class="RestaurantReferralID" value="' . $restaurant_id . '">

                        <p>' . $description . '</p>
                    </div>
                    </form>';
				break;

			case '3':
					$out .= '<form action="http://www.opentable.com/restaurant-search.aspx" method="get" class="wpcf7-form ' . $shortcodeclass . '"  ' . $shortcodeid . '>
                        <div class="row reservation-form-w3">
                            <div class="col-md-4 r-deep-form r-date">
                                    <i class="ti-calendar"></i>
                                    <input name="startDate" type="text" class="open-table-date" value="" autocomplete="off">
                            </div>
                            <div class="col-md-4 r-deep-form r-time">
                                    <i class="ti-time"></i>
                                    <select name="time" class="wn-niceselect time">';
										// Time Loop
										$inc   = 30 * 60;
										$start = ( strtotime( '00:00:00' ) ); // 6  AM
										$end   = ( strtotime( '11:59PM' ) ); // 10 PM
				for ( $i = $start; $i <= $end; $i += $inc ) {
					// to the standart format
					$time      = date( 'g:i a', $i );
					$timeValue = date( 'g:ia', $i );
					$default   = '7:00pm';
					$out      .= "<option value=\"$timeValue\" " . ( ( $timeValue == $default ) ? ' selected="selected" ' : '' ) . ">$time</option>" . PHP_EOL;
				}
									$out .= '
                                    </select>
                            </div>
                            <div class="col-md-4 r-deep-form r-people">
                                <i class="ti-user"></i>
                                <select name="people" class="wn-niceselect people">
                                    <option value="1">' . esc_html__( '1 Person', 'deep' ) . '</option>
                                    <option value="2">' . esc_html__( '2 People', 'deep' ) . '</option>
                                    <option value="3">' . esc_html__( '3 People', 'deep' ) . '</option>
                                    <option value="4">' . esc_html__( '4 People', 'deep' ) . '</option>
                                    <option value="5">' . esc_html__( '5 People', 'deep' ) . '</option>
                                    <option value="6">' . esc_html__( '6 People', 'deep' ) . '</option>
                                    <option value="7">' . esc_html__( '7 People', 'deep' ) . '</option>
                                    <option value="8">' . esc_html__( '8 People', 'deep' ) . '</option>
                                    <option value="9">' . esc_html__( '9 People', 'deep' ) . '</option>
                                    <option value="10">' . esc_html__( '10 People', 'deep' ) . '</option>
                                </select>
                            </div>
                            <div class="col-sm-12 r-deep-form r-submition">
                                <input type="submit" value="' . esc_html__( 'FIND A TABLE', 'deep' ) . '">
                            </div>
                            <input type="hidden" name="RestaurantID" class="RestaurantID" value="' . $restaurant_id . '">
                            <input type="hidden" name="rid" class="rid" value="' . $restaurant_id . '">
                            <input type="hidden" name="GeoID" class="GeoID" value="15">
                            <input type="hidden" name="txtDateFormat" class="txtDateFormat" value="MM/dd/yyyy">
                            <input type="hidden" name="RestaurantReferralID" class="RestaurantReferralID" value="' . $restaurant_id . '">
                            <p>' . $description . '</p>
                        </div>
                    </form>';
				break;
		}

		$custom_css = $settings['custom_css'];

		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>' . $custom_css . '</style>';
		}

		echo $out;

	}

}
