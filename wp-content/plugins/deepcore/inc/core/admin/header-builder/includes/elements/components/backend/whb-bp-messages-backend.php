<?php
if ( is_plugin_active( 'buddypress/bp-loader.php' ) && function_exists( 'deep_bp_user_messages' ) ) { ?>

	<!-- modal text edit -->
	<div class="whb-modal-wrap whb-modal-edit" data-element-target="bp-messages">

		<div class="whb-modal-header">
			<h4><?php esc_html_e( 'BuddyPress Notification', 'deep' ); ?></h4>
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


						// Tooltip Text
						whb_switcher( array(
							'title'         => esc_html__( 'Show Tooltip Text ?', 'deep' ),
							'id'            => 'show_tooltip',
							'default'       => 'false',
							'dependency'	=> array(
								'true'  => array( 'tooltip_text', 'tooltip_position' ),
							),
						));

						whb_textfield( array(
							'title'			=> esc_html__( 'Tooltip Text', 'deep' ),
							'id'			=> 'tooltip_text',
							'default'		=> 'Tooltip Text',
						));

						whb_select( array(
							'title'			=> esc_html__( 'Select Tooltip Position', 'deep' ),
							'id'			=> 'tooltip_position',
							'default'		=> 'tooltip-on-bottom',
							'options'		=> array(
								'tooltip-on-top'	=> esc_html__( 'Top', 'deep' ),
								'tooltip-on-bottom' => esc_html__( 'Bottom', 'deep' ),
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
							),
							'Counter' => array(
								array( 'property' => 'color' ),
								array( 'property' => 'color_hover' ),
								array( 'property' => 'font_size' ),
								array( 'property' => 'font_weight' ),
								array( 'property' => 'font_style' ),
								array( 'property' => 'letter_spacing' ),
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
							'Tooltip' => array(
								array( 'property' => 'color' ),
								array( 'property' => 'color_hover' ),
								array( 'property' => 'font_size' ),
								array( 'property' => 'font_weight' ),
								array( 'property' => 'font_style' ),
								array( 'property' => 'letter_spacing' ),
								array( 'property' => 'background_color' ),
								array( 'property' => 'background_color_hover' ),
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
<?php
} else { ?>

	<!-- modal text edit -->
	<div class="whb-modal-wrap whb-modal-edit" data-element-target="bp-messages">

		<div class="whb-modal-header">
			<h4><?php esc_html_e( 'BuddyPress Notification', 'deep' ); ?></h4>
			<i class="ti-close"></i>
		</div>

		<div class="whb-modal-contents-wrap">
			<div class="whb-modal-contents w-row">
				<p class="whb-error">
					<i class="ti-alert"></i>
					<?php echo __( 'Please make sure BuddyPress is installed and activated', 'deep' ); ?>
				</p>
			</div>
		</div> <!-- end whb-modal-contents-wrap -->

		<div class="whb-modal-footer">
			<input type="button" class="whb_close button" value="<?php esc_html_e( 'Close', 'deep' ); ?>">
			<input type="button" class="whb_save button button-primary" value="<?php esc_html_e( 'Save Changes', 'deep' ); ?>">
		</div>

	</div> <!-- end whb-elements -->
<?php
}