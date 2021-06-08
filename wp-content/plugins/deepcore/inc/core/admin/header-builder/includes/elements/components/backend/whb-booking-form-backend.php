<!-- modal text edit -->
<div class="whb-modal-wrap whb-modal-edit" data-element-target="booking-form">

	<div class="whb-modal-header">
		<h4><?php esc_html_e( 'Booking form', 'deep' ); ?></h4>
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
				
					whb_select( array(
						'title'			=> esc_html__( 'Select type form', 'deep' ),
						'id'			=> 'wn_form_type',
						'default'		=> '1',
						'options'		=> array(
							'1'	=> esc_html__( 'Form Horizontal', 'deep' ),
							'2' => esc_html__( 'Form Vertical', 'deep' ),							
						),
					));
				
				?>

			</div> <!-- end general -->

			<!-- styling -->
			<div class="whb-tab-panel whb-group-panel" data-id="#styling">

				<?php
					whb_styling_tab( array(
						'Icon' => array(
							array( 'property' => 'color' ),
							array( 'property' => 'color_hover' ),
							array( 'property' => 'font_size' ),	
							array( 'property' => 'line_height' ),						
							array( 'property' => 'margin' ),
							array( 'property' => 'padding' ),
							array( 'property' => 'border' ),							
						),	
						'Box' => array(
							array( 'property' => 'width' ),
							array( 'property' => 'height' ),							
							array( 'property' => 'background_color' ),
							array( 'property' => 'background_color_hover' ),							
							array( 'property' => 'margin' ),
							array( 'property' => 'padding' ),
							array( 'property' => 'border' ),
							array( 'property' => 'border_radius' ),
						),								
						'Form Box' => array(
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