<!-- modal language edit -->
<div class="whb-modal-wrap whb-modal-edit" data-element-target="language">

	<div class="whb-modal-header">
		<h4><?php esc_html_e( 'language Settings', 'deep' ); ?></h4>
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
						'title'			=> esc_html__( 'Select your installed plugin', 'deep' ),
						'id'			=> 'p_type',
						'default'		=> 'wpml',
						'options'		=> array(
							'wpml'			=> esc_html__( 'WPML', 'deep' ),
							'polylang' 		=> esc_html__( 'Polylang', 'deep' ),
						),
						'dependency'	=> array(
							'polylang'  => array( 'type' ),
						),
					));

					whb_select( array(
						'title'			=> esc_html__( 'Select Type', 'deep' ),
						'id'			=> 'type',
						'default'		=> 'dropdown',
						'options'		=> array(
							'dropdown'		=> esc_html__( 'Dropdown without flag', 'deep' ),
							'name_flag'		=> esc_html__( 'Inline with flag + name', 'deep' ),
							'flag' 			=> esc_html__( 'Inline just flag', 'deep' ),
						),
						
					));

				?>

			</div> <!-- end general -->

			<!-- styling -->
			<div class="whb-tab-panel whb-group-panel" data-id="#styling">
				
				<?php
					whb_styling_tab( array(
						'Typography' => array(
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
						),
						'Background' => array(
							array( 'property' => 'background_color' ),
							array( 'property' => 'background_color_hover' ),
							array( 'property' => 'background_image' ),
							array( 'property' => 'background_position' ),
							array( 'property' => 'background_repeat' ),
							array( 'property' => 'background_cover' ),
						),
						'Box' => array(
							array( 'property' => 'margin' ),
							array( 'property' => 'padding' ),
							array( 'property' => 'border_radius' ),
							array( 'property' => 'border' ),
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