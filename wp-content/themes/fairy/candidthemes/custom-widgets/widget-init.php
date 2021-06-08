<?php

if ( ! function_exists( 'fairy_load_widgets' ) ) :

    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function fairy_load_widgets() {

        // Author Widget.
        register_widget( 'Fairy_Author_Widget' );
		
		// Social Widget.
        register_widget( 'Fairy_Social_Widget' );

        // Recent Posts Widget.
        register_widget( 'Fairy_Recent_Post' );

    }

endif;
add_action( 'widgets_init', 'fairy_load_widgets' );