<!-- modal profile edit -->
<div class="whb-modal-wrap whb-modal-edit" data-element-target="profile">

	<div class="whb-modal-header">
		<h4><?php esc_html_e( 'Profile Settings', 'deep' ); ?></h4>
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
					<a href="#socials">
						<span><?php esc_html_e( 'Socials', 'deep' ); ?></span>
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

					whb_image( array(
						'title'			=> esc_html__( 'Image', 'deep' ),
						'id'			=> 'avatar',
					));

					whb_textfield( array(
						'title'			=> esc_html__( 'Name', 'deep' ),
						'id'			=> 'profile_name',
						'default'		=> 'David Hamilton James',
						'placeholder'	=> true,
					));

				?>

			</div> <!-- end general -->

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
						'Image' => array(
							array( 'property' => 'width' ),
							array( 'property' => 'height' ),
							array( 'property' => 'background_color' ),
							array( 'property' => 'margin' ),
							array( 'property' => 'padding' ),
							array( 'property' => 'border' ),
							array( 'property' => 'border_radius' ),
						),
						'Name' => array(
							array( 'property' => 'color' ),
							array( 'property' => 'color_hover' ),
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
							array( 'property' => 'margin' ),
							array( 'property' => 'padding' ),
							array( 'property' => 'border' ),
							array( 'property' => 'border_radius' ),
						),
						'Socials Text' => array(
							array( 'property' => 'color' ),
							array( 'property' => 'color_hover' ),
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
							array( 'property' => 'margin' ),
							array( 'property' => 'padding' ),
							array( 'property' => 'border' ),
							array( 'property' => 'border_radius' ),
						),
						'Socials Box' => array(
							array( 'property' => 'width' ),
							array( 'property' => 'height' ),
							array( 'property' => 'background_color' ),
							array( 'property' => 'margin' ),
							array( 'property' => 'padding' ),
							array( 'property' => 'position' ),
							array( 'property' => 'border' ),
							array( 'property' => 'border_radius' ),
						),
						'Box' => array(
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

				?>

			</div> <!-- end #classID -->

		</div>
	</div> <!-- end whb-modal-contents-wrap -->

	<div class="whb-modal-footer">
		<input type="button" class="whb_close button" value="<?php esc_html_e( 'Close', 'deep' ); ?>">
		<input type="button" class="whb_save button button-primary" value="<?php esc_html_e( 'Save Changes', 'deep' ); ?>">
	</div>

</div> <!-- end whb-elements -->