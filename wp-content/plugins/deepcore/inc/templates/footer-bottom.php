<?php
$deep_options					= deep_options();
$w_fbl_type						= isset($deep_options['deep_footer_bottom_left']) ? $deep_options['deep_footer_bottom_left'] : '4' ;
$w_fbc_type						= isset($deep_options['deep_footer_bottom_center']) ? $deep_options['deep_footer_bottom_center'] : '1' ;
$w_fbr_type						= isset($deep_options['deep_footer_bottom_right']) ? $deep_options['deep_footer_bottom_right'] : '2' ;
$deep_footer_dynamic_copyright	= $deep_options['deep_footer_dynamic_copyright'] == '1' ? '<p class="copyright"> ' . date( 'Y' ) . ' ' . '<a href="' . home_url() . '">' . get_bloginfo( 'name') . '</a>' . esc_html__( ' - All Rights Reserved', 'deep-free' ) . '</p>' : '' ;
$deep_footer_custom_copyright	= $deep_options['deep_footer_dynamic_copyright'] == '0' && isset( $deep_options['deep_footer_custom_copyright'] ) ? wp_kses_post( $deep_options['deep_footer_custom_copyright'], deep_kses() ) : '' ;
$w_fb_menu = $w_fb_logo = '';

if( !empty( $deep_options['deep_footer_logo']['id'] ) ) {
	if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {		
		load_template( DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php' );
	}
	$image = new Wn_Img_Maniuplate;
	$w_fb_logo = $image->m_image( $deep_options['deep_footer_logo']['id'] , $deep_options['deep_footer_logo']['url'] , '30' , '30' ); // set required and get result
	$w_fb_logo = '<img src="' . esc_url( $w_fb_logo ) . '" alt="' . get_bloginfo( "name" ) . '">';
}
if ( isset ( $deep_options['deep_footer_botthom_menu'] ) && !empty( $deep_options['deep_footer_botthom_menu'] ) ) {
	$w_fb_menu = $deep_options['deep_footer_botthom_menu'] ;
	$menuParameters = array(
		'menu'			=> $w_fb_menu,
		'container'		=> false,
		'menu_id'		=> 'nav',
		'depth'			=> '1',
		'items_wrap'	=> '%3$s',
		'echo'			=> false,
	);
	$w_fb_menu = strip_tags(wp_nav_menu( $menuParameters ), '<a>' );
}

if ( $deep_footer_dynamic_copyright ) {
	$deep_footer_copyright = $deep_footer_dynamic_copyright;
} else {
	$deep_footer_copyright = $deep_footer_custom_copyright;
}

// setup column's
if( ( $w_fbl_type == 1 && $w_fbc_type == 1 ) || ( $w_fbl_type == 1 && $w_fbr_type == 1 ) || ( $w_fbc_type == 1 && $w_fbr_type == 1 ) ) {
	$fb_column = 'col-md-12';
} elseif ( $w_fbl_type == 1 || $w_fbc_type == 1 || $w_fbr_type == 1 ) {
	$fb_column = 'col-md-6';
} else {
	$fb_column = 'col-md-4';
} ?>

<section class="footbot">
	<div class="container">
	<?php if ( $w_fbl_type != 1 ) : ?>
		<div class="<?php echo esc_attr( $fb_column ); ?>">
			<div class="footer-navi">
				<?php switch ( $w_fbl_type ) {
					case 1: echo ' ';
					break;
					case 2: echo wp_kses_post( $w_fb_logo ) ;
					break;
					case 3:	echo wp_kses_post( $w_fb_menu ) ;
					break;
					case 4:	echo wp_kses_post( $deep_footer_copyright ) ;
					break;	
					case 5: get_template_part( 'inc/templates/social' );
					break;
				} ?>
			</div>
		</div>
	<?php endif; ?>

	<?php if ( $w_fbc_type != 1 ) : ?>
		<div class="<?php echo esc_attr( $fb_column ); ?>">
			<div class="footer-navi center">
				<?php switch ( $w_fbc_type ) {
					case 1: echo ' ';
					break;
					case 2: echo wp_kses_post( $w_fb_logo ) ;
					break;
					case 3:	echo wp_kses_post( $w_fb_menu ) ;
					break;
					case 4:	echo wp_kses_post( $deep_footer_copyright ) ;
					break;	
					case 5: get_template_part( 'inc/templates/social' );
					break;
				} ?>
			</div>
		</div>
	<?php endif; ?>

	<?php if ( $w_fbr_type != 1 ) : ?> 
		<div class="<?php echo esc_attr( $fb_column ); ?>">
			<div class="footer-navi floatright">
				<?php
				switch ( $w_fbr_type ) {
					case 1: echo ' ';
					break;
					case 2: echo wp_kses_post( $w_fb_logo ) ;
					break;
					case 3:	echo wp_kses_post( $w_fb_menu ) ;
					break;
					case 4:	echo wp_kses_post( $deep_footer_copyright ) ;
					break;	
					case 5: get_template_part( 'inc/templates/social' );
					break;
				} ?>
			</div>
		</div>
	<?php endif; ?>
	</div>
</section>