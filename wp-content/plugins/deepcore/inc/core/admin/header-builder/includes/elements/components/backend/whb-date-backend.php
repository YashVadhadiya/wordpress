<!-- modal date edit -->
<div class="whb-modal-wrap whb-modal-edit" data-element-target="date">

	<div class="whb-modal-header">
		<h4><?php esc_html_e( 'Date Settings', 'deep' ); ?></h4>
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
					<a href="#classID">
						<span><?php esc_html_e( 'Class & ID', 'deep' ); ?></span>
					</a>
				</li>
			</ul> <!-- end .whb-tabs-list -->

			<!-- general -->
			<div class="whb-tab-panel whb-group-panel" data-id="#general">

				<?php

					whb_textfield( array(
						'title'			=> esc_html__( 'Text', 'deep' ),
						'id'			=> 'text',
						'default'		=> 'Today: ',
					));

					whb_textfield( array(
						'title'			=> esc_html__( 'Date Format (F j, Y)', 'deep' ),
						'id'			=> 'date_format',
						'default'		=> 'M. j, Y',
					));

					whb_help( array(
						'title'			=> esc_html__( 'Date Example', 'deep' ),
						'id'			=> 'date_example',
						'default'		=> '
							<font color="#000">F j, Y g:i a</font> - <small>November 6, 2010 12:50 am</small><br>
							<font color="#000">F j, Y</font> - <small>November 6, 2010</small><br>
							<font color="#000">F, Y</font> - <small>November, 2010</small><br>
							<font color="#000">g:i a</font> - <small>12:50 am</small><br>
							<font color="#000">g:i:s a</font> - <small>12:50:48 am</small><br>
							<font color="#000">l, F jS, Y</font> - <small>Saturday, November 6th, 2010</small><br>
							<font color="#000">M j, Y @ G:i</font> - <small>Nov 6, 2010 @ 0:50</small><br>
							<font color="#000">Y/m/d</font> - <small>2010/11/06</small><br>
							For more formats, please follow link: <a href="https://codex.wordpress.org/Formatting_Date_and_Time">Formatting Date and Time</a>
						',
					));

				?>

			</div> <!-- end general -->

			<!-- styling -->
			<div class="whb-tab-panel whb-group-panel" data-id="#styling">

				<?php
					whb_styling_tab( array(
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
							array( 'property' => 'margin' ),
							array( 'property' => 'padding' ),
							array( 'property' => 'border' ),
							array( 'property' => 'border_radius' ),
							array( 'property' => 'word_break' ),
						),
						'Date' => array(
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
							array( 'property' => 'margin' ),
							array( 'property' => 'padding' ),
							array( 'property' => 'border' ),
							array( 'property' => 'border_radius' ),
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
							array( 'property' => 'width' ),
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