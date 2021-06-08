<!-- modal header area -->
<div class="whb-modal-wrap whb-modal-edit" data-element-target="sticky-area">

	<div class="whb-modal-header">
		<h4><?php esc_html_e( 'Header Area', 'deep' ); ?></h4>
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
					<a href="#sticky">
						<span><?php esc_html_e( 'Sticky', 'deep' ); ?></span>
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

					whb_number_unit( array(
						'title'			=> esc_html__( 'Height', 'deep' ),
						'id'			=> 'area_height',
						'options'		=> array(
							'px'	=> 'px',
							'em'	=> 'em',
							'%'		=> '%',
						),
						'default_unit'	=> 'px',
						'default'		=> '100',
					));

					whb_number_unit( array(
						'title'			=> esc_html__( 'Width', 'deep' ),
						'id'			=> 'area_width',
						'options'		=> array(
							'px'	=> 'px',
							'em'	=> 'em',
							'%'		=> '%',
						),
						'default_unit'	=> 'px',
						'default'		=> '',
					));

					whb_switcher( array(
						'title'			=> esc_html__( 'Full Container?', 'deep' ),
						'id'			=> 'full_container',
					));

					whb_switcher( array(
						'title'			=> esc_html__( 'Padding Container?', 'deep' ),
						'id'			=> 'container_padd',
						'default'		=> 'true', 
					));

					whb_switcher( array(
						'title'			=> esc_html__( 'Super Sticky (Fixed)', 'deep' ),
						'id'			=> 'super_sticky',
						'default'		=> 'false', 
					));

					whb_select( array(
						'title'			=> esc_html__( 'Content Position', 'deep' ),
						'id'			=> 'content_position',
						'default'		=> 'middle',
						'options'		=> array(
							'top'	 => esc_html__( 'Top', 'deep' ),
							'middle' => esc_html__( 'Middle', 'deep' ),
							'bottom' => esc_html__( 'Bottom', 'deep' ),
						),
					));

				?>

			</div> <!-- end general -->

			<!-- sticky -->
			<div class="whb-tab-panel whb-group-panel" data-id="#sticky">

				<?php

					whb_select( array(
						'title'			=> esc_html__( 'In what case Sticky Menu will appear?', 'deep' ),
						'id'			=> 'sticky_appear',
						'default'		=> 'both',
						'options'		=> array(
							'upscroll'	 => esc_html__( 'Upward Scrolling', 'deep' ),
							'downscroll' => esc_html__( 'Downward Scrolling', 'deep' ),
							'both' 		 => esc_html__( 'Both', 'deep' ),
						),
					));

					whb_switcher( array(
						'title'			=> esc_html__( 'Display Sticky in Tablets/Mobiles?', 'deep' ),
						'id'			=> 'mobile_sticky',
						'default'		=> 'false', 
					));

				?>

			</div> <!-- end sticky -->

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
							array( 'property' => 'border' ),
							array( 'property' => 'border_radius' ),
							array( 'property' => 'box_shadow' ),
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