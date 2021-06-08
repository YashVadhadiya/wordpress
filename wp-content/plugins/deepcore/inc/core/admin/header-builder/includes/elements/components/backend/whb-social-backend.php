<!-- modal search edit -->
<div class="whb-modal-wrap whb-modal-edit" data-element-target="social">

	<div class="whb-modal-header">
		<h4><?php esc_html_e( 'Socials Settings', 'deep' ); ?></h4>
		<i class="ti-close"></i>
	</div>

	<div class="whb-modal-contents-wrap">
		<div class="whb-modal-contents w-row">

			<ul class="whb-tabs-list whb-element-groups wp-clearfix">
				<li class="whb-tab w-active">
					<a href="#general">
						<span><?php esc_html_e( 'General', 'deep' ); ?></span>
					</a>
				</li>				
				<li class="whb-tab">
					<a href="#socialicons">
						<span><?php esc_html_e( 'Social Icons', 'deep' ); ?></span>
					</a>
				</li>
				<li class="whb-tab">
					<a href="#styling">
						<span><?php esc_html_e( 'Styling', 'deep' ); ?></span>
					</a>
				</li>
				<li class="whb-tab">
					<a href="#extra-class">
						<span><?php esc_html_e( 'Extra Class', 'deep' ); ?></span>
					</a>
				</li>
			</ul> <!-- end .whb-tabs-list -->

			<!-- general -->
			<div class="whb-tab-panel whb-group-panel" data-id="#general">

				<?php

					// Main Icon
					whb_select(
						array(
							'title'      => esc_html__( 'Twitter Icon or Text?', 'deep' ),
							'id'         => 'main_social_icon',
							'default'    => 'icon',
							'options'    => array(
								'icon' => esc_html__( 'Icon', 'deep' ),
								'text' => esc_html__( 'Text', 'deep' ),
							),
							'dependency' => array(
								'text' => array( 'main_icon_text' ),
							),
						)
					);

					// Twitter Text
					whb_textfield(
						array(
							'title'   => esc_html__( 'Text instead of Main Icon', 'deep' ),
							'id'      => 'main_icon_text',
							'default' => 'Socials',
						)
					);

					// Social Hover
					whb_select(
						array(
							'title'   => esc_html__( 'Social Hover Effect', 'deep' ),
							'id'      => 'social_hover',
							'default' => 'none',
							'options' => array(
								'none'    => esc_html__( 'None', 'deep' ),
								'grow'    => esc_html__( 'Grow', 'deep' ),
								'shrink'  => esc_html__( 'Shrink', 'deep' ),
								'rotate'  => esc_html__( 'Rotate', 'deep' ),								
								'swing'   => esc_html__( 'Swing', 'deep' ),
								'btt'     => esc_html__( 'Bottom To Top', 'deep' ),
							),
						)
					);

					// Type
					whb_select(
						array(
							'title'      => esc_html__( 'Type', 'deep' ),
							'id'         => 'social_type',
							'default'    => 'simple',
							'options'    => array(
								'simple'   => esc_html__( 'Simple', 'deep' ),
								'slide'    => esc_html__( 'Slide', 'deep' ),
								'dropdown' => esc_html__( 'Dropdown', 'deep' ),
								'full'     => esc_html__( 'Full', 'deep' ),
							),
							'dependency' => array(
								'slide'    => array( 'toggle_text' ),
								'dropdown' => array( 'default_icon_bg' ),
							),
						)
					);

					whb_select(
						array(
							'title'   => esc_html__( 'Format', 'deep' ),
							'id'      => 'social_format',
							'default' => 'icon',
							'options' => array(
								'icon'     => esc_html__( 'Icon', 'deep' ),
								'text'     => esc_html__( 'Text', 'deep' ),
								'icontext' => esc_html__( 'Icon + Text', 'deep' ),
							),
						)
					);					

					// Tooltip Text
					whb_switcher(
						array(
							'title'      => esc_html__( 'Show Tooltip Text ?', 'deep' ),
							'id'         => 'show_tooltip',
							'default'    => 'false',
							'dependency' => array(
								'true' => array( 'tooltip_text', 'tooltip_position' ),
							),
						)
					);

					whb_textfield(
						array(
							'title'   => esc_html__( 'Tooltip Text', 'deep' ),
							'id'      => 'tooltip_text',
							'default' => 'Tooltip Text',
						)
					);

					whb_select(
						array(
							'title'   => esc_html__( 'Select Tooltip Position', 'deep' ),
							'id'      => 'tooltip_position',
							'default' => 'tooltip-on-bottom',
							'options' => array(
								'tooltip-on-top'    => esc_html__( 'Top', 'deep' ),
								'tooltip-on-bottom' => esc_html__( 'Bottom', 'deep' ),
							),
						)
					);				

					?>

			</div> <!-- end general -->		

			<!-- social icons -->
			<div class="whb-tab-panel whb-group-panel" data-id="#socialicons">

				<?php
					$webnus_socials = array(
						'none'        => 'None',
						'dribbble'    => 'Dribbble',
						'facebook'    => 'Facebook',
						'flickr'      => 'Flickr',
						'foursquare'  => 'Foursquare',
						'github'      => 'Github',						
						'instagram'   => 'Instagram',
						'lastfm'      => 'Lastfm',
						'linkedin'    => 'Linkedin',
						'pinterest'   => 'Pinterest',
						'reddit'      => 'Reddit',
						'soundcloud'  => 'Soundcloud',
						'spotify'     => 'Spotify',
						'tumblr'      => 'Tumblr',
						'twitter'     => 'Twitter',
						'vimeo'       => 'Vimeo',
						'whatsapp'    => 'Whatsapp',
						'vine'        => 'Vine',
						'yelp'        => 'Yelp',
						'yahoo'       => 'Yahoo',
						'youtube'     => 'Youtube',
						'wordpress'   => 'Wordpress',
						'dropbox'     => 'Dropbox',												
						'skype'       => 'Skype',
						'vk'          => 'VK',
						'rss-square'  => 'Feed',
						'telegram'    => 'Telegram',
						'medium'      => 'Medium',
					);
					// Social icon 1
					whb_select(
						array(
							'title'   => esc_html__( '1st Social Icon', 'deep' ),
							'id'      => 'social_icon_1',
							'default' => 'facebook',
							'options' => $webnus_socials,
						)
					);

					// Social text 1
					whb_textfield(
						array(
							'title'   => esc_html__( '1st Social Text', 'deep' ),
							'id'      => 'social_text_1',
							'default' => 'Facebook',
						)
					);

					// Social link 1
					whb_textfield(
						array(
							'title'   => esc_html__( '1st Social URL', 'deep' ),
							'id'      => 'social_url_1',
							'default' => '#',
						)
					);

					?>
				
				<div class="w-col-sm-12 whb-line-divider"></div>

				<?php

					// Social icon 2
					whb_select(
						array(
							'title'   => esc_html__( '2st Social Icon', 'deep' ),
							'id'      => 'social_icon_2',
							'default' => 'none',
							'options' => $webnus_socials,
						)
					);

					// Social text 2
					whb_textfield(
						array(
							'title' => esc_html__( '2st Social Text', 'deep' ),
							'id'    => 'social_text_2',
						)
					);

					// Social link 2
					whb_textfield(
						array(
							'title' => esc_html__( '2st Social URL', 'deep' ),
							'id'    => 'social_url_2',
							'default' => '#',
						)
					);

					?>

				<div class="w-col-sm-12 whb-line-divider"></div>

				<?php

					// Social icon 3
					whb_select(
						array(
							'title'   => esc_html__( '3st Social Icon', 'deep' ),
							'id'      => 'social_icon_3',
							'default' => 'none',
							'options' => $webnus_socials,
						)
					);

					// Social text 3
					whb_textfield(
						array(
							'title' => esc_html__( '3st Social Text', 'deep' ),
							'id'    => 'social_text_3',
						)
					);

					// Social link 3
					whb_textfield(
						array(
							'title' => esc_html__( '3st Social URL', 'deep' ),
							'id'    => 'social_url_3',
							'default' => '#',
						)
					);

					?>

				<div class="w-col-sm-12 whb-line-divider"></div>

				<?php

					// Social icon 4
					whb_select(
						array(
							'title'   => esc_html__( '4st Social Icon', 'deep' ),
							'id'      => 'social_icon_4',
							'default' => 'none',
							'options' => $webnus_socials,
						)
					);

					// Social text 4
					whb_textfield(
						array(
							'title' => esc_html__( '4st Social Text', 'deep' ),
							'id'    => 'social_text_4',
						)
					);

					// Social link 4
					whb_textfield(
						array(
							'title' => esc_html__( '4st Social URL', 'deep' ),
							'id'    => 'social_url_4',
							'default' => '#',
						)
					);

					?>

				<div class="w-col-sm-12 whb-line-divider"></div>

				<?php

					// Social icon 5
					whb_select(
						array(
							'title'   => esc_html__( '5st Social Icon', 'deep' ),
							'id'      => 'social_icon_5',
							'default' => 'none',
							'options' => $webnus_socials,
						)
					);

					// Social text 5
					whb_textfield(
						array(
							'title' => esc_html__( '5st Social Text', 'deep' ),
							'id'    => 'social_text_5',
						)
					);

					// Social link 5
					whb_textfield(
						array(
							'title' => esc_html__( '5st Social URL', 'deep' ),
							'id'    => 'social_url_5',
							'default' => '#',
						)
					);

					?>

				<div class="w-col-sm-12 whb-line-divider"></div>

				<?php

					// Social icon 6
					whb_select(
						array(
							'title'   => esc_html__( '6st Social Icon', 'deep' ),
							'id'      => 'social_icon_6',
							'default' => 'none',
							'options' => $webnus_socials,
						)
					);

					// Social text 6
					whb_textfield(
						array(
							'title' => esc_html__( '6st Social Text', 'deep' ),
							'id'    => 'social_text_6',
						)
					);

					// Social link 6
					whb_textfield(
						array(
							'title' => esc_html__( '6st Social URL', 'deep' ),
							'id'    => 'social_url_6',
							'default' => '#',
						)
					);

					?>

				<div class="w-col-sm-12 whb-line-divider"></div>

				<?php

					// Social icon 7
					whb_select(
						array(
							'title'   => esc_html__( '7st Social Icon', 'deep' ),
							'id'      => 'social_icon_7',
							'default' => 'none',
							'options' => $webnus_socials,
						)
					);

					// Social text 7
					whb_textfield(
						array(
							'title' => esc_html__( '7st Social Text', 'deep' ),
							'id'    => 'social_text_7',
						)
					);

					// Social link 7
					whb_textfield(
						array(
							'title' => esc_html__( '7st Social URL', 'deep' ),
							'id'    => 'social_url_7',
							'default' => '#',
						)
					);

					?>

			</div> <!-- social icons -->

			

			<!-- styling -->
			<div class="whb-tab-panel whb-group-panel" data-id="#styling">
				
				<?php
					whb_styling_tab(
						array(
							'Slide type Icon/Text'       => array(
								array( 'property' => 'color' ),
								array( 'property' => 'color_hover' ),
								array( 'property' => 'font_size' ),
							),
							'Box'                  => array(
								array( 'property' => 'width' ),
								array( 'property' => 'height' ),
								array( 'property' => 'background_color' ),
								array( 'property' => 'background_color_hover' ),
								array( 'property' => 'background_image' ),
								array( 'property' => 'background_position' ),
								array( 'property' => 'background_repeat' ),
								array( 'property' => 'background_cover' ),
								array( 'property' => 'margin' ),
								array( 'property' => 'padding' ),
								array( 'property' => 'border' ),
								array( 'property' => 'border_radius' ),
							),
							'Social Box'           => array(
								array( 'property' => 'width' ),
								array( 'property' => 'height' ),
								array( 'property' => 'background_color' ),
								array( 'property' => 'background_color_hover' ),
								array( 'property' => 'background_image' ),
								array( 'property' => 'background_position' ),
								array( 'property' => 'background_repeat' ),
								array( 'property' => 'background_cover' ),
								array( 'property' => 'margin' ),
								array( 'property' => 'padding' ),
								array( 'property' => 'border' ),
								array( 'property' => 'border_radius' ),								
								array( 'property' => 'box_shadow' ),
							),
							'Social Icon/Text Box' => array(
								array( 'property' => 'color' ),
								array( 'property' => 'color_hover' ),
								array( 'property' => 'background_color' ),								
								array( 'property' => 'font_size' ),
								array( 'property' => 'font_weight' ),
								array( 'property' => 'font_style' ),
								array( 'property' => 'text_align' ),
								array( 'property' => 'text_transform' ),
								array( 'property' => 'text_decoration' ),
								array( 'property' => 'line_height' ),
								array( 'property' => 'letter_spacing' ),
								array( 'property' => 'overflow' ),
								array( 'property' => 'word_break' ),
								array( 'property' => 'width' ),
								array( 'property' => 'height' ),								
								array( 'property' => 'background_image' ),
								array( 'property' => 'background_position' ),
								array( 'property' => 'background_repeat' ),
								array( 'property' => 'background_cover' ),
								array( 'property' => 'margin' ),
								array( 'property' => 'padding' ),
								array( 'property' => 'border' ),
								array( 'property' => 'border_radius' ),
							),
							'Social Icon'          => array(
								array( 'property' => 'color' ),
								array( 'property' => 'color_hover' ),
								array( 'property' => 'font_size' ),									
								array( 'property' => 'line_height' ),
								array( 'property' => 'letter_spacing' ),								
								array( 'property' => 'width' ),
								array( 'property' => 'height' ),
								array( 'property' => 'background_color' ),
								array( 'property' => 'background_color_hover' ),								
								array( 'property' => 'margin' ),
								array( 'property' => 'padding' ),
								array( 'property' => 'border' ),
								array( 'property' => 'border_radius' ),
								array( 'property' => 'box_shadow' ),
							),
							'Social Text'          => array(
								array( 'property' => 'color' ),
								array( 'property' => 'color_hover' ),
								array( 'property' => 'font_size' ),
								array( 'property' => 'font_weight' ),
								array( 'property' => 'font_style' ),								
								array( 'property' => 'text_transform' ),
								array( 'property' => 'text_decoration' ),
								array( 'property' => 'line_height' ),
								array( 'property' => 'letter_spacing' ),														
								array( 'property' => 'background_color' ),
								array( 'property' => 'background_color_hover' ),							
								array( 'property' => 'margin' ),
								array( 'property' => 'padding' ),
								array( 'property' => 'border' ),
								array( 'property' => 'border_radius' ),
							),
							'Full Page Social'     => array(
								array( 'property' => 'background_color' ),
								array( 'property' => 'background_color_hover' ),
								array( 'property' => 'background_image' ),
								array( 'property' => 'background_position' ),
								array( 'property' => 'background_repeat' ),
								array( 'property' => 'background_cover' ),
							),
							'Tooltip'              => array(
								array( 'property' => 'color' ),								
								array( 'property' => 'background_color' ),								
								array( 'property' => 'font_size' ),
								array( 'property' => 'font_weight' ),
								array( 'property' => 'font_style' ),
								array( 'property' => 'letter_spacing' ),
								array( 'property' => 'overflow' ),
								array( 'property' => 'word_break' ),
							),
						)
					);
					?>

			</div> <!-- end #styling -->

			<!-- extra-class -->
			<div class="whb-tab-panel whb-group-panel" data-id="#extra-class">

				<?php

					whb_textfield(
						array(
							'title' => esc_html__( 'Extra class', 'deep' ),
							'id'    => 'extra_class',
						)
					);

					?>

			</div> <!-- end #extra-class -->

		</div>
	</div> <!-- end whb-modal-contents-wrap -->

	<div class="whb-modal-footer">
		<input type="button" class="whb_close button" value="<?php esc_html_e( 'Close', 'deep' ); ?>">
		<input type="button" class="whb_save button button-primary" value="<?php esc_html_e( 'Save Changes', 'deep' ); ?>">
	</div>

</div> <!-- end whb-elements -->
