<!-- modal header area -->
<div class="whb-modal-wrap whb-modal-edit" data-element-target="vertical-area">

	<div class="whb-modal-header">
		<h4><?php esc_html_e( 'Vertical Header Area', 'deep' ); ?></h4>
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
					<a href="#contact">
						<span><?php esc_html_e( 'Toggle Contact', 'deep' ); ?></span>
					</a>
				</li>
				<li class="whb-tab">
					<a href="#socials">
						<span><?php esc_html_e( 'Toggle Socials', 'deep' ); ?></span>
					</a>
				</li>
				<li class="whb-tab">
					<a href="#styling">
						<span><?php esc_html_e( 'Styling', 'deep' ); ?></span>
					</a>
				</li>
				<li class="whb-tab">
					<a href="#classID">
						<span><?php esc_html_e( 'Class & ID', 'deep' ); ?></span>
					</a>
				</li>
			</ul> <!-- end .whb-tabs-list -->

			<!-- general -->
			<div class="whb-tab-panel whb-group-panel" data-id="#general">

				<?php

					whb_select( array(
						'title'			=> esc_html__( 'Alignment', 'deep' ),
						'id'			=> 'alignment',
						'default'		=> 'flex-start',
						'options'		=> array(
							'flex-start'	 => esc_html__( 'Left', 'deep' ),
							'center' 		 => esc_html__( 'Center', 'deep' ),
							'flex-end' 		 => esc_html__( 'Right', 'deep' ),
						),
					));

					whb_switcher( array(
						'title'			=> esc_html__( 'Header Toggle', 'deep' ),
						'id'			=> 'vertical_toggle',
						'default'		=> 'false',
					));

					whb_imageselect( array(
						'title'			=> esc_html__( 'Select Toggle Type', 'deep' ),
						'id'			=> 'vertical_toggle_type',
						'default'		=> 'freelancer',
						'options'		=> array(
							'freelancer'	=> WHB_Helper::get_file_uri( 'assets/dist/images/fields/freelancer.jpg' ),
							'photography'	=> WHB_Helper::get_file_uri( 'assets/dist/images/fields/photography.jpg' ),
						),
					));

					whb_imageselect( array(
						'title'			=> esc_html__( 'Select Toggle Icon', 'deep' ),
						'id'			=> 'vertical_toggle_icon',
						'default'		=> 'foursome',
						'options'		=> array(
							'triad'			=> WHB_Helper::get_file_uri( 'assets/dist/images/fields/triad.png' ),
							'foursome'		=> WHB_Helper::get_file_uri( 'assets/dist/images/fields/foursome.png' ),
						),
					));

					whb_image( array(
						'title'			=> esc_html__( 'Toggle Logo', 'deep' ),
						'id'			=> 'logo',
					));

					whb_switcher( array(
						'title'			=> esc_html__( 'Toggle Contact Icon', 'deep' ),
						'id'			=> 'contact_icon',
						'default'		=> 'false',
					));

					whb_switcher( array(
						'title'			=> esc_html__( 'Toggle Full Screen Icon', 'deep' ),
						'id'			=> 'full_screen',
						'default'		=> 'false',
					));

				?>

			</div> <!-- end general -->
			
			<!-- contact -->
			<div class="whb-tab-panel whb-group-panel" data-id="#contact">

				<?php

					whb_textfield( array(
						'title'			=> esc_html__( 'Contact Box Title', 'deep' ),
						'id'			=> 'box_title',
						'default'		=> 'Contact David',
					));

					whb_textfield( array(
						'title'			=> esc_html__( 'Email', 'deep' ),
						'id'			=> 'email',
						'default'		=> 'youremail@yourserver.com',
					));

					whb_textfield( array(
						'title'			=> esc_html__( 'Telephone', 'deep' ),
						'id'			=> 'tel',
						'default'		=> '123 456 789',
					));

					whb_textfield( array(
						'title'			=> esc_html__( 'Schedule', 'deep' ),
						'id'			=> 'schedule',
						'default'		=> 'Office hours are 9 a.m. and 5 p.m. Central time.',
					));

					whb_textfield( array(
						'title'			=> esc_html__( 'Address', 'deep' ),
						'id'			=> 'address',
						'default'		=> 'address',
					));

					whb_switcher( array(
						'title'			=> esc_html__( 'Social', 'deep' ),
						'id'			=> 'social',
						'default'		=> 'false'
					));

					whb_textfield( array(
						'title'			=> esc_html__( 'Contact Form Title', 'deep' ),
						'id'			=> 'form_title',
						'default'		=> 'General form',
					));

					whb_contact( array(
						'title'			=> esc_html__( 'Select contact form', 'deep' ),
						'id'			=> 'contact_form',
					));

				?>

			</div><!-- end #contact -->

			<!-- socials -->
			<div class="whb-tab-panel whb-group-panel" data-id="#socials">

				<?php

					whb_switcher( array(
						'title'			=> esc_html__( 'Socials', 'deep' ),
						'id'			=> 'socials',
						'default'		=> 'true',
					));

					// Social text 1
					whb_textfield( array(
						'title'			=> esc_html__( '1st Social Text', 'deep' ),
						'id'			=> 'social_text_1',
						'default'		=> 'Facebook',
					));

					// Social link 1
					whb_textfield( array(
						'title'			=> esc_html__( '1st Social URL', 'deep' ),
						'id'			=> 'social_url_1',
						'default'		=> 'https://www.facebook.com/',
					));

				?>
				
				<div class="w-col-sm-12 whb-line-divider"></div>

				<?php

					// Social text 2
					whb_textfield( array(
						'title'			=> esc_html__( '2st Social Text', 'deep' ),
						'id'			=> 'social_text_2',
					));

					// Social link 2
					whb_textfield( array(
						'title'			=> esc_html__( '2st Social URL', 'deep' ),
						'id'			=> 'social_url_2',
					));

				?>

				<div class="w-col-sm-12 whb-line-divider"></div>

				<?php

					// Social text 3
					whb_textfield( array(
						'title'			=> esc_html__( '3st Social Text', 'deep' ),
						'id'			=> 'social_text_3',
					));

					// Social link 3
					whb_textfield( array(
						'title'			=> esc_html__( '3st Social URL', 'deep' ),
						'id'			=> 'social_url_3',
					));

				?>

				<div class="w-col-sm-12 whb-line-divider"></div>

				<?php

					// Social text 4
					whb_textfield( array(
						'title'			=> esc_html__( '4st Social Text', 'deep' ),
						'id'			=> 'social_text_4',
					));

					// Social link 4
					whb_textfield( array(
						'title'			=> esc_html__( '4st Social URL', 'deep' ),
						'id'			=> 'social_url_4',
					));

				?>

				<div class="w-col-sm-12 whb-line-divider"></div>

				<?php

					// Social text 5
					whb_textfield( array(
						'title'			=> esc_html__( '5st Social Text', 'deep' ),
						'id'			=> 'social_text_5',
					));

					// Social link 5
					whb_textfield( array(
						'title'			=> esc_html__( '5st Social URL', 'deep' ),
						'id'			=> 'social_url_5',
					));

				?>

				<div class="w-col-sm-12 whb-line-divider"></div>

				<?php

					// Social text 6
					whb_textfield( array(
						'title'			=> esc_html__( '6st Social Text', 'deep' ),
						'id'			=> 'social_text_6',
					));

					// Social link 6
					whb_textfield( array(
						'title'			=> esc_html__( '6st Social URL', 'deep' ),
						'id'			=> 'social_url_6',
					));

				?>

				<div class="w-col-sm-12 whb-line-divider"></div>

				<?php

					// Social text 7
					whb_textfield( array(
						'title'			=> esc_html__( '7st Social Text', 'deep' ),
						'id'			=> 'social_text_7',
					));

					// Social link 7
					whb_textfield( array(
						'title'			=> esc_html__( '7st Social URL', 'deep' ),
						'id'			=> 'social_url_7',
					));

				?>

			</div> <!-- socials -->


			<!-- styling -->
			<div class="whb-tab-panel whb-group-panel" data-id="#styling">

				<?php
					whb_styling_tab( array(
						'Box' => array(
							array( 'property' => 'width' ),
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
						'Toggle Bar' => array(
							array( 'property' => 'background_color' ),
							array( 'property' => 'background_color_hover' ),
							array( 'property' => 'background_image' ),
							array( 'property' => 'background_position' ),
							array( 'property' => 'background_repeat' ),
							array( 'property' => 'background_cover' ),
							array( 'property' => 'padding' ),
							array( 'property' => 'border' ),
						),
						'Toggle Icon Color' => array(
							array( 'property' => 'background_color' ),
							array( 'property' => 'background_color_hover' ),
						),
						'Toggle Icon Box' => array(
							array( 'property' => 'position' ),
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
						'Logo' => array(
							array( 'property' => 'position' ),
							array( 'property' => 'width' ),
							array( 'property' => 'height' ),
							array( 'property' => 'background_color' ),
							array( 'property' => 'margin' ),
							array( 'property' => 'padding' ),
							array( 'property' => 'border' ),
							array( 'property' => 'border_radius' ),
						),
						'Contact' => array(
							array( 'property' => 'position' ),
							array( 'property' => 'background_color' ),
							array( 'property' => 'margin' ),
							array( 'property' => 'padding' ),
							array( 'property' => 'border' ),
							array( 'property' => 'border_radius' ),
						),
						'Fullscreen' => array(
							array( 'property' => 'position' ),
							array( 'property' => 'background_color' ),
							array( 'property' => 'margin' ),
							array( 'property' => 'padding' ),
							array( 'property' => 'border' ),
							array( 'property' => 'border_radius' ),
						),
					) );
				?>

			</div> <!-- end #styling -->

			<!-- classID -->
			<div class="whb-tab-panel whb-group-panel" data-id="#classID">

				<?php

					whb_textfield( array(
						'title'			=> esc_html__( 'Extra class', 'deep' ),
						'id'			=> 'extra_class',
					));

					whb_textfield( array(
						'title'			=> esc_html__( 'Extra ID', 'deep' ),
						'id'			=> 'extra_id',
					));

				?>

			</div> <!-- end #classID -->

		</div>
	</div> <!-- end whb-modal-contents-wrap -->

	<div class="whb-modal-footer">
		<input type="button" class="whb_close button" value="<?php esc_html_e( 'Close', 'deep' ); ?>">
		<input type="button" class="whb_save button button-primary" value="<?php esc_html_e( 'Save Changes', 'deep' ); ?>">
	</div>

</div> <!-- end whb-elements -->