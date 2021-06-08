<?php

function whb_styling_tab( $params = array() ) {

	if ( ! $params ) return;

	$screens = array(
		'all'	=> array(
			'list'	=> 'all_list_items',
			'panel'	=> 'all_panel_items',
		),
		'tablets'	=> array(
			'list'	=> 'tablets_list_items',
			'panel'	=> 'tablets_panel_items',
		),
		'mobiles'	=> array(
			'list'	=> 'mobiles_list_items',
			'panel'	=> 'mobiles_panel_items',
		),
	);

	// $list_items = $panel_items = '';

	foreach ( $screens as $screen => $vars ) :

		${$vars['list']} = ${$vars['panel']} = '';

		foreach ( $params as $el_title => $el_partials ) :

			$el_href = str_replace( '-', '_', sanitize_title( $el_title ) );

			${$vars['list']} .= '
				<li class="whb-tab">
					<a href="#' . $el_href . '">
						<span>' . esc_html( $el_title ) . '</span>
					</a>
				</li>
			';

			${$vars['panel']} .= '<div class="whb-tab-panel whb-styling-group-panel" data-id="#' . $el_href . '">';
				foreach ( $el_partials as $el_atts ) :
					switch ( $el_atts['property'] ) :

						// typography
						case 'color':
							${$vars['panel']} .= whb_colorpicker( array(
								'title'			=> esc_html__( 'Color', 'deep' ),
								'id'			=> $el_atts['property'] . '_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
						break;

						case 'color_hover':
							${$vars['panel']} .= whb_colorpicker( array(
								'title'			=> esc_html__( 'Color Hover', 'deep' ),
								'id'			=> $el_atts['property'] . '_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
						break;

						case 'fill':
							${$vars['panel']} .= whb_colorpicker( array(
								'title'			=> esc_html__( 'Color', 'deep' ),
								'id'			=> $el_atts['property'] . '_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
						break;

						case 'fill_hover':
							${$vars['panel']} .= whb_colorpicker( array(
								'title'			=> esc_html__( 'Color Hover', 'deep' ),
								'id'			=> $el_atts['property'] . '_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
						break;

						case 'font_size':
							${$vars['panel']} .= whb_number_unit( array(
								'title'			=> esc_html__( 'Font Size', 'deep' ),
								'id'			=> $el_atts['property'] . '_sc_' . $screen . '_el_' . $el_href,
								'options'		=> array(
									'px'	=> 'px',
									'em'	=> 'em',
									'%'		=> '%',
								),
								'default_unit'	=> 'px',
								'get'			=> true,
							));
						break;

						case 'font_weight':
							${$vars['panel']} .= whb_custom_select( array(
								'title'			=> esc_html__( 'Font Weight', 'deep' ),
								'id'			=> $el_atts['property'] . '_sc_' . $screen . '_el_' . $el_href,
								'options'		=> array(
									'300'	=> '300',
									'400'	=> '400',
									'500'	=> '500',
									'600'	=> '600',
									'700'	=> '700',
									'800'	=> '800',
									'900'	=> '900',
									''		=> '<i class="wn-fa wn-fa-ban"></i>',
								),
								// 'default'	=> '',
								'get'			=> true,
							));
						break;

						case 'font_style':
							${$vars['panel']} .= whb_custom_select( array(
								'title'			=> esc_html__( 'Font Style', 'deep' ),
								'id'			=> $el_atts['property'] . '_sc_' . $screen . '_el_' . $el_href,
								'options'		=> array(
									'normal' => '<i class="wn-fa wn-fa-ban"></i>',
									'italic' => '<span style="font-style:italic;font-family: serif;">T</span>',
								),
								'get'			=> true,
							));
						break;

						case 'text_align':
							${$vars['panel']} .= whb_custom_select( array(
								'title'			=> esc_html__( 'Text Align', 'deep' ),
								'id'			=> $el_atts['property'] . '_sc_' . $screen . '_el_' . $el_href,
								'options'		=> array(
									''		  => '<i class="wn-fa wn-fa-ban"></i>',
									'left'	  => '<i class="wn-fa wn-fa-align-left"></i>',
									'center'  => '<i class="wn-fa wn-fa-align-center"></i>',
									'right'	  => '<i class="wn-fa wn-fa-align-right"></i>',
									'justify' => '<i class="wn-fa wn-fa-align-justify"></i>',
								),
								'get'			=> true,
							));
						break;

						case 'text_transform':
							${$vars['panel']} .= whb_custom_select( array(
								'title'			=> esc_html__( 'Text Transform', 'deep' ),
								'id'			=> $el_atts['property'] . '_sc_' . $screen . '_el_' . $el_href,
								'options'		=> array(
									'none'			=> '<i class="wn-fa wn-fa-ban"></i>',
									'uppercase'		=> 'TT',
									'capitalize'	=> 'Tt',
									'lowercase'		=> 'tt',
								),
								'get'			=> true,
							));
						break;

						case 'text_decoration':
							${$vars['panel']} .= whb_custom_select( array(
								'title'			=> esc_html__( 'Text Decoration', 'deep' ),
								'id'			=> $el_atts['property'] . '_sc_' . $screen . '_el_' . $el_href,
								'options'		=> array(
									'none'			=> '<i class="wn-fa wn-fa-ban"></i>',
									'underline'		=> '<u>T</u>',
									'line-through'	=> '<span style="text-decoration: line-through">T</span>',
								),
								'get'			=> true,
							));
						break;

						case 'width':
							${$vars['panel']} .= whb_number_unit( array(
								'title'			=> esc_html__( 'Width', 'deep' ),
								'id'			=> $el_atts['property'] . '_sc_' . $screen . '_el_' . $el_href,
								'options'		=> array(
									'px'	=> 'px',
									'em'	=> 'em',
									'%'		=> '%',
								),
								'default_unit'	=> 'px',
								'get'			=> true,
							));
						break;

						case 'max_width':
							${$vars['panel']} .= whb_number_unit( array(
								'title'			=> esc_html__( 'Max Width', 'deep' ),
								'id'			=> $el_atts['property'] . '_sc_' . $screen . '_el_' . $el_href,
								'options'		=> array(
									'px'	=> 'px',
									'em'	=> 'em',
									'%'		=> '%',
								),
								'default_unit'	=> 'px',
								'get'			=> true,
							));
						break;

						case 'height':
							${$vars['panel']} .= whb_number_unit( array(
								'title'			=> esc_html__( 'Height', 'deep' ),
								'id'			=> $el_atts['property'] . '_sc_' . $screen . '_el_' . $el_href,
								'options'		=> array(
									'px'	=> 'px',
									'em'	=> 'em',
									'%'		=> '%',
								),
								'default_unit'	=> 'px',
								'get'			=> true,
							));
						break;

						case 'min_height':
							${$vars['panel']} .= whb_number_unit( array(
								'title'			=> esc_html__( 'Min Height', 'deep' ),
								'id'			=> $el_atts['property'] . '_sc_' . $screen . '_el_' . $el_href,
								'options'		=> array(
									'px'	=> 'px',
									'em'	=> 'em',
									'%'		=> '%',
								),
								'default_unit'	=> 'px',
								'get'			=> true,
							));
						break;

						case 'line_height':
							${$vars['panel']} .= whb_number_unit( array(
								'title'			=> esc_html__( 'Line Height', 'deep' ),
								'id'			=> $el_atts['property'] . '_sc_' . $screen . '_el_' . $el_href,
								'options'		=> array(
									'px'	=> 'px',
									'em'	=> 'em',
									'%'		=> '%',
								),
								'default_unit'	=> 'px',
								'get'			=> true,
							));
						break;

						case 'letter_spacing':
							${$vars['panel']} .= whb_number_unit( array(
								'title'			=> esc_html__( 'Letter Spacing', 'deep' ),
								'id'			=> $el_atts['property'] . '_sc_' . $screen . '_el_' . $el_href,
								'options'		=> array(
									'px'	=> 'px',
									'em'	=> 'em',
									'%'		=> '%',
								),
								'default_unit'	=> 'px',
								'get'			=> true,
							));
						break;

						case 'overflow':
							${$vars['panel']} .= whb_select( array(
								'title'			=> esc_html__( 'Overflow', 'deep' ),
								'id'			=> $el_atts['property'] . '_sc_' . $screen . '_el_' . $el_href,
								'options'		=> array(
									''	  	  => '',
									'auto'	  => esc_html__( 'Auto', 'deep' ),
									'hidden'  => esc_html__( 'Hidden', 'deep' ),
									'inherit' => esc_html__( 'Inherit', 'deep' ),
									'initial' => esc_html__( 'Initial', 'deep' ),
									'overlay' => esc_html__( 'Overlay', 'deep' ),
									'visible' => esc_html__( 'Visible', 'deep' ),
								),
								'get'			=> true,
							));
						break;

						case 'word_break':
							${$vars['panel']} .= whb_select( array(
								'title'			=> esc_html__( 'Word Break', 'deep' ),
								'id'			=> $el_atts['property'] . '_sc_' . $screen . '_el_' . $el_href,
								'options'		=> array(
									''	  			=> '',
									'break-all'		=> esc_html__( 'Break All', 'deep' ),
									'break-word'	=> esc_html__( 'Break Word', 'deep' ),
									'inherit'		=> esc_html__( 'Inherit', 'deep' ),
									'initial'		=> esc_html__( 'Initial', 'deep' ),
									'normal'		=> esc_html__( 'Normal', 'deep' ),
								),
								'get'			=> true,
							));
						break;

						// background
						case 'background_color':
							${$vars['panel']} .= whb_colorpicker( array(
								'title'			=> esc_html__( 'Background Color', 'deep' ),
								'id'			=> $el_atts['property'] . '_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
						break;

						case 'background_color_hover':
							${$vars['panel']} .= whb_colorpicker( array(
								'title'			=> esc_html__( 'Background Hover Color', 'deep' ),
								'id'			=> $el_atts['property'] . '_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
						break;

						case 'background_image':
							${$vars['panel']} .= whb_image( array(
								'title'			=> esc_html__( 'Background Image', 'deep' ),
								'id'			=> $el_atts['property'] . '_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
						break;

						case 'background_position':
							${$vars['panel']} .= whb_select( array(
								'title'			=> esc_html__( 'Background Position', 'deep' ),
								'id'			=> $el_atts['property'] . '_sc_' . $screen . '_el_' . $el_href,
								'options'		=> array(
									'left top'		=> esc_html__( 'Left Top', 'deep' ),
									'left center'	=> esc_html__( 'Left Center', 'deep' ),
									'left bottom'	=> esc_html__( 'Left Bottom', 'deep' ),
									'center top'	=> esc_html__( 'Center Top', 'deep' ),
									'center center'	=> esc_html__( 'Center Center', 'deep' ),
									'center bottom'	=> esc_html__( 'Center Bottom', 'deep' ),
									'right top'		=> esc_html__( 'Right Top', 'deep' ),
									'right center'	=> esc_html__( 'Right Center', 'deep' ),
									'right bottom'	=> esc_html__( 'Right Bottom', 'deep' ),
								),
								'default'		=> 'center center',
								'get'			=> true,
							));
						break;

						case 'background_repeat':
							${$vars['panel']} .= whb_select( array(
								'title'			=> esc_html__( 'Background Repeat', 'deep' ),
								'id'			=> $el_atts['property'] . '_sc_' . $screen . '_el_' . $el_href,
								'options'		=> array(
									'repeat'	=> esc_html__( 'Repeat'	, 'deep' ),
									'repeat-x'	=> esc_html__( 'Repeat x', 'deep' ),
									'repeat-y'	=> esc_html__( 'Repeat y', 'deep' ),
									'no-repeat'	=> esc_html__( 'No Repeat', 'deep' ),
								),
								'default'		=> 'no-repeat',
								'get'			=> true,
							));
						break;

						case 'background_cover':
							${$vars['panel']} .= whb_switcher( array(
								'title'			=> esc_html__( 'Background Cover ?', 'deep' ),
								'id'			=> $el_atts['property'] . '_sc_' . $screen . '_el_' . $el_href,
								'default'		=> 'true',
								'get'			=> true,
							));
						break;

						// box
						case 'margin':
							${$vars['panel']} .= '<div class="wp-clearfix"></div><div class="whb-field whb-box-wrap w-col-sm-6"><h5>' . esc_html__( 'Margin', 'deep' ) . '</h5>';
							${$vars['panel']} .= whb_textfield( array(
								'id'			=> $el_atts['property'] . '_top_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
							${$vars['panel']} .= whb_textfield( array(
								'id'			=> $el_atts['property'] . '_right_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
							${$vars['panel']} .= whb_textfield( array(
								'id'			=> $el_atts['property'] . '_bottom_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
							${$vars['panel']} .= whb_textfield( array(
								'id'			=> $el_atts['property'] . '_left_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
							${$vars['panel']} .= '</div>';
						break;

						case 'padding':
							${$vars['panel']} .= '<div class="whb-field whb-box-wrap w-col-sm-12"><h5>' . esc_html__( 'Padding', 'deep' ) . '</h5>';
							${$vars['panel']} .= whb_textfield( array(
								'id'			=> $el_atts['property'] . '_top_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
							${$vars['panel']} .= whb_textfield( array(
								'id'			=> $el_atts['property'] . '_right_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
							${$vars['panel']} .= whb_textfield( array(
								'id'			=> $el_atts['property'] . '_bottom_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
							${$vars['panel']} .= whb_textfield( array(
								'id'			=> $el_atts['property'] . '_left_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
							${$vars['panel']} .= '</div><div class="wp-clearfix"></div>';
						break;

						case 'border_radius':
							${$vars['panel']} .= '<div class="whb-field whb-box-wrap whb-box-border-radius-wrap w-col-sm-6"><h5>' . esc_html__( 'Border Radius', 'deep' ) . '</h5>';
							${$vars['panel']} .= whb_textfield( array(
								'id'			=> 'top_left_radius_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
							${$vars['panel']} .= whb_textfield( array(
								'id'			=> 'top_right_radius_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
							${$vars['panel']} .= whb_textfield( array(
								'id'			=> 'bottom_right_radius_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
							${$vars['panel']} .= whb_textfield( array(
								'id'			=> 'bottom_left_radius_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
							${$vars['panel']} .= '</div>';
						break;

						case 'border':
							${$vars['panel']} .= '<div class="whb-field w-col-sm-6">';
							${$vars['panel']} .= whb_select( array(
								'title'			=> esc_html__( 'Border Style', 'deep' ),
								'id'			=> $el_atts['property'] . '_style_sc_' . $screen . '_el_' . $el_href,
								'options'		=> array(
									''			=> '',
									'none'		=> esc_html__( 'None', 'deep' ),
									'solid'		=> esc_html__( 'Solid', 'deep' ),
									'dotted'	=> esc_html__( 'Dotted', 'deep' ),
									'dashed'	=> esc_html__( 'Dashed', 'deep' ),
									'double'	=> esc_html__( 'Double', 'deep' ),
									'groove'	=> esc_html__( 'Groove', 'deep' ),
									'ridge'		=> esc_html__( 'Ridge', 'deep' ),
									'inset'		=> esc_html__( 'Inset', 'deep' ),
									'outset'	=> esc_html__( 'Outset', 'deep' ),
									'initial'	=> esc_html__( 'Initial', 'deep' ),
									'inherit'	=> esc_html__( 'Inherit', 'deep' ),
								),
								'get'			=> true,
							));
							${$vars['panel']} .= '</div>';
							${$vars['panel']} .= '<div class="whb-field w-col-sm-6">';
							${$vars['panel']} .= whb_colorpicker( array(
								'title'			=> esc_html__( 'Border Color', 'deep' ),
								'id'			=> $el_atts['property'] . '_color_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
							${$vars['panel']} .= '</div><div class="wp-clearfix"></div>';
							${$vars['panel']} .= '<div class="whb-field whb-box-wrap w-col-sm-6"><h5>' . esc_html__( 'Border Width', 'deep' ) . '</h5>';
							${$vars['panel']} .= whb_textfield( array(
								'id'			=> $el_atts['property'] . '_top_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
							${$vars['panel']} .= whb_textfield( array(
								'id'			=> $el_atts['property'] . '_right_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
							${$vars['panel']} .= whb_textfield( array(
								'id'			=> $el_atts['property'] . '_bottom_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
							${$vars['panel']} .= whb_textfield( array(
								'id'			=> $el_atts['property'] . '_left_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
							${$vars['panel']} .= '</div>';
						break;

						case 'float':
							${$vars['panel']} .= whb_custom_select( array(
								'title'			=> esc_html__( 'Floating', 'deep' ),
								'id'			=> $el_atts['property'] . '_sc_' . $screen . '_el_' . $el_href,
								'default'		=> 'left',
								'options'		=> array(
									'left'	=> 'left',
									'right'	=> 'right',
								),
								'get'			=> true,
							));
						break;

						case 'position_property':
							${$vars['panel']} .= whb_custom_select( array(
								'title'			=> esc_html__( 'Position', 'deep' ),
								'id'			=> $el_atts['position'] . '_sc_' . $screen . '_el_' . $el_href,
								'default'		=> 'static',
								'options'		=> array(
									'static'	=> 'static',
									'absolute'	=> 'absolute',
									'relative'	=> 'relative',
								),
								'get'			=> true,
							));
						break;

						case 'position':
							${$vars['panel']} .= '<div class="whb-field whb-box-wrap w-col-sm-6"><h5>' . esc_html__( 'Position', 'deep' ) . '</h5>';
							${$vars['panel']} .= whb_textfield( array(
								'id'			=> $el_atts['property'] . '_top_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
							${$vars['panel']} .= whb_textfield( array(
								'id'			=> $el_atts['property'] . '_right_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
							${$vars['panel']} .= whb_textfield( array(
								'id'			=> $el_atts['property'] . '_bottom_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
							${$vars['panel']} .= whb_textfield( array(
								'id'			=> $el_atts['property'] . '_left_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
							${$vars['panel']} .= '</div>';
							${$vars['panel']} .= '<div class="whb-field whb-help-content-wrap w-col-sm-12">';
							${$vars['panel']} .= whb_help( array(
								'title'			=> esc_html__( 'Help to use calc', 'deep' ),
								'id'			=> $el_atts['property'] . '_help_calc_' . $screen . '_el_' . $el_href,
								'default'		=> '
									To make this element stay center, all you need is using calc code as following:<br>
									calc(50% - half width)<br>
									For Example:<br>
									Width = 40px<br>
									Left = calc(50% - 20px)
								',
								'get'			=> true,
							));
							${$vars['panel']} .= '</div><div class="wp-clearfix"></div>';
						break;

						case 'box_shadow':
							${$vars['panel']} .= '<div class="whb-field whb-shadow-box-wrap w-col-sm-12"><h5>' . esc_html__( 'Box Shadow', 'deep' ) . '</h5>';
							${$vars['panel']} .= whb_number_unit( array(
								'title'			=> esc_html__( 'X offset', 'deep' ),
								'id'			=> $el_atts['property'] . '_xoffset_sc_' . $screen . '_el_' . $el_href,
								'options'		=> array(
									'px'	=> 'px',
									'em'	=> 'em',
									'%'		=> '%',
								),
								'default_unit'	=> 'px',
								'get'			=> true,
							));
							${$vars['panel']} .= whb_number_unit( array(
								'title'			=> esc_html__( 'Y offset', 'deep' ),
								'id'			=> $el_atts['property'] . '_yoffset_sc_' . $screen . '_el_' . $el_href,
								'options'		=> array(
									'px'	=> 'px',
									'em'	=> 'em',
									'%'		=> '%',
								),
								'default_unit'	=> 'px',
								'get'			=> true,
							));
							${$vars['panel']} .= whb_number_unit( array(
								'title'			=> esc_html__( 'Blur', 'deep' ),
								'id'			=> $el_atts['property'] . '_blur_sc_' . $screen . '_el_' . $el_href,
								'options'		=> array(
									'px'	=> 'px',
									'em'	=> 'em',
									'%'		=> '%',
								),
								'default_unit'	=> 'px',
								'get'			=> true,
							));
							${$vars['panel']} .= whb_number_unit( array(
								'title'			=> esc_html__( 'Spread', 'deep' ),
								'id'			=> $el_atts['property'] . '_spread_sc_' . $screen . '_el_' . $el_href,
								'options'		=> array(
									'px'	=> 'px',
									'em'	=> 'em',
									'%'		=> '%',
								),
								'default_unit'	=> 'px',
								'get'			=> true,
							));
							${$vars['panel']} .= whb_switcher( array(
								'title'			=> esc_html__( 'Inset Shadow Status', 'deep' ),
								'id'			=> $el_atts['property'] . '_status_sc_' . $screen . '_el_' . $el_href,
								'default'       => 'false',
								'get'			=> true,
							));
							${$vars['panel']} .= whb_colorpicker( array(
								'title'			=> esc_html__( 'Shadow Color', 'deep' ),
								'id'			=> $el_atts['property'] . '_color_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
							${$vars['panel']} .= '</div><div class="wp-clearfix"></div>';
						break;

						case 'gradient':
							${$vars['panel']} .= '<div class="whb-field whb-gradient-wrap w-col-sm-12"><h5>' . esc_html__( 'Gradient', 'deep' ) . '</h5>';
							${$vars['panel']} .= whb_colorpicker( array(
								'title'			=> esc_html__( 'Color 1', 'deep' ),
								'id'			=> $el_atts['property'] . '_color1_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
							${$vars['panel']} .= whb_colorpicker( array(
								'title'			=> esc_html__( 'Color 2', 'deep' ),
								'id'			=> $el_atts['property'] . '_color2_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
							${$vars['panel']} .= whb_colorpicker( array(
								'title'			=> esc_html__( 'Color 3', 'deep' ),
								'id'			=> $el_atts['property'] . '_color3_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
							${$vars['panel']} .= whb_colorpicker( array(
								'title'			=> esc_html__( 'Color 4', 'deep' ),
								'id'			=> $el_atts['property'] . '_color4_sc_' . $screen . '_el_' . $el_href,
								'get'			=> true,
							));
							${$vars['panel']} .= whb_number_unit( array(
								'title'			=> esc_html__( 'Direction', 'deep' ),
								'id'			=> $el_atts['property'] . '_direction_sc_' . $screen . '_el_' . $el_href,
								'options'		=> array(
									'deg'	=> 'deg',
								),
								'default_unit'	=> 'deg',
								'get'			=> true,
							));
							${$vars['panel']} .= '</div><div class="wp-clearfix"></div>';
						break;

					endswitch;
				endforeach;
			${$vars['panel']} .= '</div>';

		endforeach;

	endforeach;

	?>

	<ul class="whb-tabs-list whb-styling-screens wp-clearfix">
		<li class="whb-tab">
			<a href="#all">
				<i class="wn-fa wn-fa-desktop"></i>
				<span><?php esc_html_e( 'Desktop', 'deep' ); ?></span>
			</a>
		</li>
		<li class="whb-tab">
			<a href="#tablets">
				<i class="wn-fa wn-fa-tablet"></i>
				<span><?php esc_html_e( 'Tablets', 'deep' ); ?></span>
			</a>
		</li>
		<li class="whb-tab">
			<a href="#mobiles">
				<i class="wn-fa wn-fa-mobile"></i>
				<span><?php esc_html_e( 'Mobiles', 'deep' ); ?></span>
			</a>
		</li>
	</ul>

	<!-- all devices -->
	<div class="whb-tab-panel whb-styling-screen-panel wp-clearfix" data-id="#all">

		<ul class="whb-tabs-list whb-styling-groups wp-clearfix"><?php echo '' . $all_list_items; ?></ul>
		<?php echo '' . $all_panel_items; ?>

	</div> <!-- end all devices -->

	<!-- tablets devices -->
	<div class="whb-tab-panel whb-styling-screen-panel" data-id="#tablets">

		<ul class="whb-tabs-list whb-styling-groups wp-clearfix"><?php echo '' . $tablets_list_items; ?></ul>
		<?php echo '' . $tablets_panel_items; ?>

	</div> <!-- end tablets devices -->

	<!-- mobiles devices -->
	<div class="whb-tab-panel whb-styling-screen-panel" data-id="#mobiles">

		<ul class="whb-tabs-list whb-styling-groups wp-clearfix"><?php echo '' . $mobiles_list_items; ?></ul>
		<?php echo '' . $mobiles_panel_items; ?>

	</div> <!-- end mobiles devices -->

	<?php

}
