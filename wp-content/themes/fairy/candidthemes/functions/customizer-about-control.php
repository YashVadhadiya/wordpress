<?php 
// Doing this customizer thang!
if ( ! class_exists( 'Fairy_Customize_Static_Text_Control' ) ){
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;
class Fairy_Customize_Static_Text_Control extends WP_Customize_Control {
	/**
	 * Control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'static-text';

	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}

	protected function render_content() {
			?>
		<div class="description customize-control-description">
			
			<h2><?php esc_html_e('About Fairy', 'fairy')?></h2>
			<p><?php esc_html_e('Fairy is clean and minimal WordPress theme for blog website.', 'fairy')?> </p>
			<p>
				<a href="<?php echo esc_url('https://fairy.candidthemes.com/'); ?>" target="_blank"><?php esc_html_e( 'Fairy Demo', 'fairy' ); ?></a>
			</p>
			<h3><?php esc_html_e('Documentation', 'fairy')?></h3>
			<p><?php esc_html_e('Read documentation to learn more about theme.', 'fairy')?> </p>
			<p>
				<a href="<?php echo esc_url('http://docs.candidthemes.com/fairy/'); ?>" target="_blank"><?php esc_html_e( 'Fairy Documentation', 'fairy' ); ?></a>
			</p>
			
			<h3><?php esc_html_e('Support', 'fairy')?></h3>
			<p><?php esc_html_e('For support, Kindly contact us and we would be happy to assist!', 'fairy')?> </p>
			
			<p>
				<a href="<?php echo esc_url('https://www.candidthemes.com/supports/'); ?>" target="_blank"><?php esc_html_e( 'Fairy Support', 'fairy' ); ?></a>
			</p>
			<h3><?php esc_html_e( 'Rate This Theme', 'fairy' ); ?></h3>
			<p><?php esc_html_e('If you like fairy Kindly Rate this Theme', 'fairy')?> </p>
			<p>
				<a href="<?php echo esc_url('https://wordpress.org/support/theme/fairy/reviews/#new-post'); ?>" target="_blank"><?php esc_html_e( 'Add Your Review', 'fairy' ); ?></a>
			</p>
			</div>
			
		<?php
	}

}
}