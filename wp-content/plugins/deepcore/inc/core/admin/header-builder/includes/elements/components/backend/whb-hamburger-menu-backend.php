<!-- modal menu edit -->
<div class="whb-modal-wrap whb-modal-edit" data-element-target="hamburger-menu">

	<div class="whb-modal-header">
		<h4><?php esc_html_e( 'Hamburger Menu Settings', 'deep' ); ?></h4>
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
					<a href="#elements">
						<span><?php esc_html_e( 'Elements', 'deep' ); ?></span>
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

					whb_menu( array(
						'title'			=> esc_html__( 'Select a Menu', 'deep' ),
						'id'			=> 'menu',
					));

					whb_select( array(
						'title'			=> esc_html__( 'Hamburger Type', 'deep' ),
						'id'			=> 'hamburger_type',
						'default'		=> 'toggle',
						'options'		=> array(
							'toggle'=> esc_html__( 'Toggle', 'deep' ),
							'full' 	=> esc_html__( 'Full', 'deep' ),
						),
						'dependency'	=> array(
							'toggle'  => array( 'toggle_from' ),
						),
					));

					whb_select( array(
						'title'			=> esc_html__( 'Hamburger Icon', 'deep' ),
						'id'			=> 'hamburger_icon',
						'default'		=> '3line',
						'options'		=> array(
							'3line'	=> esc_html__( '3 Lines', 'deep' ),
							'4line' => esc_html__( '4 Lines', 'deep' ),
						),
					));

					whb_select( array(
						'title'			=> esc_html__( 'Hamburger Menu Style', 'deep' ),
						'id'			=> 'hm_style',
						'default'		=> 'light',
						'options'		=> array(
							'light'	=> esc_html__( 'Light', 'deep' ),
							'dark' => esc_html__( 'Dark', 'deep' ),
						),
					));

					whb_select( array(
						'title'			=> esc_html__( 'Open Toggle From', 'deep' ),
						'id'			=> 'toggle_from',
						'default'		=> 'right',
						'options'		=> array(
							'right'	=> esc_html__( 'Right', 'deep' ),
							'left'  => esc_html__( 'Left', 'deep' ),
						),
					));

				?>

			</div> <!-- end general -->

			<!-- general -->
			<div class="whb-tab-panel whb-group-panel" data-id="#elements">
				<?php

					whb_image( array(
						'title'			=> esc_html__( 'Logo', 'deep' ),
						'id'			=> 'image_logo',
					));

					whb_switcher( array(
						'title'			=> esc_html__( 'Display Socials?', 'deep' ),
						'id'			=> 'socials',
						'default'		=> 'true',
					));

					whb_switcher( array(
						'title'			=> esc_html__( 'Display Search?', 'deep' ),
						'id'			=> 'search',
						'default'		=> 'true',
						'dependency'	=> array(
							'true'  => array( 'placeholder' ),
						),
					));

					whb_textfield( array(
						'title'			=> esc_html__( 'Search Placeholder', 'deep' ),
						'id'			=> 'placeholder',
						'default'		=> 'Search ...',
					));

					whb_switcher( array(
						'title'			=> esc_html__( 'Display Content?', 'deep' ),
						'id'			=> 'content',
						'default'		=> 'false',
						'dependency'	=> array(
							'true'  => array( 'text_content' ),
						),
					));

					whb_textarea( array(
						'title'			=> esc_html__( 'Content', 'deep' ),
						'id'			=> 'text_content',
					));


					whb_textfield( array(
						'title'			=> esc_html__( 'Copyright', 'deep' ),
						'id'			=> 'copyright',
						'default'		=> 'Copyright',
					));
				?>
			</div>

			<!-- styling -->
			<div class="whb-tab-panel whb-group-panel" data-id="#styling">
				
				<?php
					whb_styling_tab( array(
						'Hamburger Icon Color' => array(
							array( 'property' => 'background_color' ),
							array( 'property' => 'background_color_hover' ),
						),
						'Hamburger Icon Box' => array(
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
							array( 'property' => 'border_radius' ),
							array( 'property' => 'border' ),
						),
						'Hamburger Box' => array(
							array( 'property' => 'padding' ),
							array( 'property' => 'background_color' ),
							array( 'property' => 'background_color_hover' ),
							array( 'property' => 'background_image' ),
							array( 'property' => 'background_position' ),
							array( 'property' => 'background_repeat' ),
							array( 'property' => 'background_cover' ),
							array( 'property' => 'gradient' ),
						),
						'Logo Box' => array(
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
						'Menu Box' => array(
							array( 'property' => 'background_color' ),
							array( 'property' => 'background_color_hover' ),
							array( 'property' => 'margin' ),
							array( 'property' => 'padding' ),
							array( 'property' => 'border' ),
							array( 'property' => 'border_radius' ),
						),
						'Menu Item' => array(
							array( 'property' => 'color' ),
							array( 'property' => 'color_hover' ),
							array( 'property' => 'background_color' ),
							array( 'property' => 'background_color_hover' ),
							array( 'property' => 'font_size' ),
							array( 'property' => 'font_weight' ),
							array( 'property' => 'font_style' ),
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
						'Current Menu Item' => array(
							array( 'property' => 'color' ),
							array( 'property' => 'color_hover' ),
							array( 'property' => 'background_color' ),
							array( 'property' => 'background_color_hover' ),
							array( 'property' => 'font_size' ),
							array( 'property' => 'font_weight' ),
							array( 'property' => 'font_style' ),
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
						'Current Item Shape' => array(
							array( 'property' => 'width' ),
							array( 'property' => 'height' ),
							array( 'property' => 'background_color' ),
							array( 'property' => 'background_color_hover' ),
							array( 'property' => 'position' ),
							array( 'property' => 'border' ),
							array( 'property' => 'border_radius' ),
						),
						'Submenu Item' => array(
							array( 'property' => 'color' ),
							array( 'property' => 'color_hover' ),
							array( 'property' => 'background_color' ),
							array( 'property' => 'background_color_hover' ),
							array( 'property' => 'font_size' ),
							array( 'property' => 'font_weight' ),
							array( 'property' => 'font_style' ),
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
						'Search Input' => array(
							array( 'property' => 'font_size' ),
							array( 'property' => 'line_height' ),
							array( 'property' => 'width' ),
							array( 'property' => 'height' ),
							array( 'property' => 'color' ),							
							array( 'property' => 'background_color' ),							
							array( 'property' => 'border' ),
							array( 'property' => 'border_radius' ),
						),
						'Search Box' => array(
							array( 'property' => 'background_color' ),
							array( 'property' => 'background_color_hover' ),
							array( 'property' => 'margin' ),
							array( 'property' => 'padding' ),
							array( 'property' => 'border' ),
							array( 'property' => 'border_radius' ),
						),
						'Elements Box' => array(
							array( 'property' => 'width' ),
							array( 'property' => 'height' ),
							array( 'property' => 'text_align' ),
							array( 'property' => 'background_color' ),
							array( 'property' => 'background_color_hover' ),
							array( 'property' => 'margin' ),
							array( 'property' => 'padding' ),
							array( 'property' => 'border' ),
							array( 'property' => 'border_radius' ),
						),						
						'Socials' => array(
							array( 'property' => 'color' ),
							array( 'property' => 'color_hover' ),
							array( 'property' => 'background_color' ),
							array( 'property' => 'background_color_hover' ),
							array( 'property' => 'width' ),
							array( 'property' => 'height' ),						
							array( 'property' => 'font_size' ),							
							array( 'property' => 'line_height' ),
							array( 'property' => 'margin' ),
							array( 'property' => 'padding' ),
						),
						'Copyright' => array(
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
						'Search Placeholder' => array(
							array( 'property' => 'color' ),							
							array( 'property' => 'font_size' ),
							array( 'property' => 'font_weight' ),
							array( 'property' => 'font_style' ),							
							array( 'property' => 'text_transform' ),
							array( 'property' => 'text_decoration' ),
							array( 'property' => 'line_height' ),
							array( 'property' => 'letter_spacing' ),							
						),
						'Search Icon' => array(
							array( 'property' => 'color' ),	
							array( 'property' => 'color_hover' ),						
							array( 'property' => 'background_color' ),
							array( 'property' => 'background_color_hover' ),
							array( 'property' => 'font_size' ),						
							array( 'property' => 'line_height' ),	
							array( 'property' => 'width' ),
							array( 'property' => 'height' ),														
							array( 'property' => 'margin' ),
							array( 'property' => 'padding' ),
							array( 'property' => 'border' ),
							array( 'property' => 'border_radius' ),													
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