<?php
/**
 * Deep Theme.
 *
 * Single Post Magazine template
 *
 * @since   3.2.3
 * @author  Webnus
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'full');
if ( $thumbnail_url ) {
	deep_save_dyn_styles('.postshow1-hd .postshow1{background-image: url(' . $thumbnail_url . ');}');
}
?>
<div class="postshow1">
	<div class="postshow-overlay"></div>
	<div class="container"><h1 class="post-title-ps1"><?php the_title(); ?></h1></div>
</div>