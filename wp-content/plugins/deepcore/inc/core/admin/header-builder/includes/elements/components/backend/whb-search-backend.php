<!-- modal search edit -->
<div class="whb-modal-wrap whb-modal-edit" data-element-target="search">

	<div class="whb-modal-header">
		<h4><?php esc_html_e( 'Search Settings', 'deep' ); ?></h4>
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

					whb_select(
						array(
							'title'      => esc_html__( 'Select Type', 'deep' ),
							'id'         => 'type',
							'default'    => 'simple',
							'options'    => array(
								'simple' => esc_html__( 'Simple', 'deep' ),
								'toggle' => esc_html__( 'Toggle', 'deep' ),
								'slide'  => esc_html__( 'Slide (Vertical)', 'deep' ),
								'full'   => esc_html__( 'Full', 'deep' ),
							),
							'dependency' => array(
								'toggle' => array( 'text_beside_icon' ),
							),
						)
					);

					whb_select(
						array(
							'title'   => esc_html__( 'Search Icon', 'deep' ),
							'id'      => 'icon_type',
							'default' => 'ti',
							'options' => array(								
								'ti' => esc_html__( 'Themify', 'deep' ),
								'fa' => esc_html__( 'FontAwesome', 'deep' ),
								'sl' => esc_html__( 'Simple Line', 'deep' ),
							),
						)
					);

					// Placeholder Text
					whb_textfield(
						array(
							'title'   => esc_html__( 'Placeholder Text', 'deep' ),
							'id'      => 'placeholder_text',
							'default' => '',
						)
					);

					// Tooltip Text
					whb_switcher(
						array(
							'title'      => esc_html__( 'Show Tooltip Text?', 'deep' ),
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

					whb_switcher(
						array(
							'title'   => esc_html__( 'Hide top arrow in toggle?', 'deep' ),
							'id'      => 'top_arrow',
							'default' => 'false',
						)
					);

					whb_switcher(
						array(
							'title'   => esc_html__( 'Hide Search box icon?', 'deep' ),
							'id'      => 'searchbox_icon',
							'default' => 'false',
						)
					);

					whb_textfield(
						array(
							'title'   => esc_html__( 'Add custom text besides search icon', 'deep' ),
							'id'      => 'text_beside_icon',
							'default' => 'Search',
						)
					);
					?>

			</div> <!-- end general -->

			

			<!-- styling -->
			<div class="whb-tab-panel whb-group-panel" data-id="#styling">
				
				<?php
					whb_styling_tab(
						array(
							'Icon'              => array(
								array( 'property' => 'color' ),
								array( 'property' => 'color_hover' ),
								array( 'property' => 'font_size' ),
								array( 'property' => 'position' ),
							),
							'Custom Text'       => array(
								array( 'property' => 'color' ),
								array( 'property' => 'color_hover' ),
								array( 'property' => 'font_size' ),
								array( 'property' => 'float' ),
								array( 'property' => 'margin' ),
								array( 'property' => 'padding' ),
								array( 'property' => 'border' ),
							),
							'Placeholder'       => array(
								array( 'property' => 'color' ),								
								array( 'property' => 'font_size' ),																
								array( 'property' => 'padding' ),								
							),
							'Background'        => array(
								array( 'property' => 'background_color' ),
								array( 'property' => 'background_color_hover' ),
								array( 'property' => 'background_image' ),
								array( 'property' => 'background_position' ),
								array( 'property' => 'background_repeat' ),
								array( 'property' => 'background_cover' ),
							),
							'Box'               => array(
								array( 'property' => 'width' ),
								array( 'property' => 'height' ),
								array( 'property' => 'margin' ),
								array( 'property' => 'padding' ),
								array( 'property' => 'border' ),
								array( 'property' => 'border_radius' ),
							),
							'Search Form'       => array(
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
								array( 'property' => 'position' ),
								array( 'property' => 'box_shadow' ),
							),
							'Search Form Input' => array(
								array( 'property' => 'width' ),
								array( 'property' => 'height' ),
								array( 'property' => 'color' ),
								array( 'property' => 'background_color' ),								
								array( 'property' => 'background_image' ),
								array( 'property' => 'background_position' ),
								array( 'property' => 'background_repeat' ),
								array( 'property' => 'background_cover' ),
								array( 'property' => 'margin' ),
								array( 'property' => 'padding' ),
								array( 'property' => 'border' ),
								array( 'property' => 'border_radius' ),
								array( 'property' => 'min_height' ),
							),
							'Arrow'             => array(
								array( 'property' => 'background_color' ),
								array( 'property' => 'background_color_hover' ),
								array( 'property' => 'position' ),
							),
							'Full Page Search and Slide'  => array(
								array( 'property' => 'background_color' ),								
								array( 'property' => 'background_image' ),
								array( 'property' => 'background_position' ),
								array( 'property' => 'background_repeat' ),
								array( 'property' => 'background_cover' ),
							),
							'Search Box Icon'   => array(
								array( 'property' => 'color' ),
								array( 'property' => 'color_hover' ),
								array( 'property' => 'font_size' ),
								array( 'property' => 'width' ),
								array( 'property' => 'height' ),
								array( 'property' => 'background_color' ),
								array( 'property' => 'background_color_hover' ),
								array( 'property' => 'margin' ),
								array( 'property' => 'padding' ),
								array( 'property' => 'border' ),
								array( 'property' => 'border_radius' ),
								array( 'property' => 'position' ),
							),
							'Close Icon'   => array(
								array( 'property' => 'color' ),
								array( 'property' => 'color_hover' ),
								array( 'property' => 'font_size' ),
								array( 'property' => 'width' ),
								array( 'property' => 'height' ),
								array( 'property' => 'background_color' ),
								array( 'property' => 'background_color_hover' ),
								array( 'property' => 'margin' ),
								array( 'property' => 'padding' ),
								array( 'property' => 'border' ),
								array( 'property' => 'border_radius' ),
								array( 'property' => 'position' ),
							),
							'Tooltip'           => array(
								array( 'property' => 'color' ),
								array( 'property' => 'color_hover' ),
								array( 'property' => 'font_size' ),
								array( 'property' => 'font_weight' ),
								array( 'property' => 'font_style' ),
								array( 'property' => 'letter_spacing' ),
								array( 'property' => 'background_color' ),
								array( 'property' => 'background_color_hover' ),
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
