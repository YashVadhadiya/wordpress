<?php
function deep_widget_sermon_categories( $attributes, $content = null ) {
	
	$args = array(
		'before_title'	=> '<div class="subtitle-wrap"><h4 class="subtitle">',
		'after_title'	=> '</h4></div>'
	);

	return get_the_widget( 'WebnusSermonCategoriesWidget', $args );
}

add_shortcode( 'widget-sermon-categories', 'deep_widget_sermon_categories' ); 
