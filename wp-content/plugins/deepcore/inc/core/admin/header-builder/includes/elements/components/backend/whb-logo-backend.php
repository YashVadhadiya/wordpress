<!-- modal logo edit -->
<div class="whb-modal-wrap whb-modal-edit" data-element-target="logo">

	<div class="whb-modal-header">
		<h4><?php esc_html_e( 'Logo Settings', 'deep' ); ?></h4>
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

					whb_select( array(
						'title'			=> esc_html__( 'Type', 'deep' ),
						'id'			=> 'type',
						'default'		=> 'image',
						'options'		=> array(
							'image'	=> esc_html__( 'Image', 'deep' ),
							'text'	=> esc_html__( 'Text', 'deep' ),
						),
						'dependency'	=> array(
							'image'	=> array( 'logo', 'transparent_logo' ),
							'text'  => array( 'logo_text' ),
						),
					));

					whb_textfield( array(
						'title'			=> esc_html__( 'Custom URL', 'deep' ),
						'id'			=> 'logo_custom_url',
						'default'		=> '',
					));

					whb_image( array(
						'title'			=> esc_html__( 'Default Logo + Transparent (light background) Logo', 'deep' ),
						'id'			=> 'logo',
						'placeholder'	=> true,
					));

					whb_image( array(
						'title'			=> esc_html__( 'Transparent (dark background) Logo - "Do not use in sticky header"', 'deep' ),
						'id'			=> 'transparent_logo',
					));

					whb_textfield( array(
						'title'			=> esc_html__( 'Logo Text', 'deep' ),
						'id'			=> 'logo_text',
					));

				?>

			</div> <!-- end general -->

			<!-- styling -->
			<div class="whb-tab-panel whb-group-panel" data-id="#styling">


				<?php
					whb_styling_tab( array(
						'Logo' => array(
							array( 'property' => 'width' ),
							array( 'property' => 'height' ),
							array( 'property' => 'background_color' ),
							array( 'property' => 'margin' ),
							array( 'property' => 'padding' ),
							array( 'property' => 'border' ),
							array( 'property' => 'border_radius' ),
							array( 'property' => 'box_shadow' ),
						),
						'Transparent Logo' => array(
							array( 'property' => 'width' ),
							array( 'property' => 'height' ),
							array( 'property' => 'margin' ),
							array( 'property' => 'padding' ),
							array( 'property' => 'border' ),
							array( 'property' => 'border_radius' ),
						),
						'Text' => array(
							array( 'property' => 'color' ),
							array( 'property' => 'color_hover' ),
							array( 'property' => 'font_size' ),
							array( 'property' => 'font_weight' ),
							array( 'property' => 'font_style' ),
							array( 'property' => 'text_transform' ),
							array( 'property' => 'text_decoration' ),
							array( 'property' => 'line_height' ),
							array( 'property' => 'letter_spacing' ),
							array( 'property' => 'overflow' ),
							array( 'property' => 'word_break' ),
						),
					) );
				?>

			</div> <!-- end #styling -->

			<!-- extra-class -->
			<div class="whb-tab-panel whb-group-panel" data-id="#extra-class">

				<?php

					whb_textfield( array(
						'title'			=> esc_html__( 'Extra class', 'deep' ),
						'id'			=> 'extra_class',
					));

				?>

			</div> <!-- end #extra-class -->

		</div>
	</div> <!-- end whb-modal-contents-wrap -->

	<div class="whb-modal-footer">
		<input type="button" class="whb_close button" value="<?php esc_html_e( 'Close', 'deep' ); ?>">
		<input type="button" class="whb_save button button-primary" value="<?php esc_html_e( 'Save Changes', 'deep' ); ?>">
	</div>

</div> <!-- end whb-elements -->