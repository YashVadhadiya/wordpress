<?php
function deep_demo_plugins( $slug ) {
    $main_plugins = array(
        'elementor',
        'contact-form-7',
    );
    $plugins_array = array(
        // Agency2
        'agency2free' => array_merge( $main_plugins, array( 'wp-pagenavi' ) ),
        // Magazine
        'magazine-free' => array_merge( $main_plugins, array( 'post-ratings', 'wp-cloudy', 'wp-pagenavi' ) ),
        // personal-blog-free
        'personal-blog-free' => array_merge( $main_plugins, array( 'wp-pagenavi' ) ),
        // minimal-blog-free
        'minimal-blog-free'	=> array_merge( $main_plugins, array( 'wp-pagenavi' ) ),
        // modern-business
        'modern-business' => array_merge( $main_plugins, array( '' ) ),
        // conference-free
        'conference-free' => array_merge( $main_plugins, array( '' ) ),
        // SPA Free
        'spa-free' => array_merge( $main_plugins, array( '' ) ),
        // corporate-free
        'corporate-free' => array_merge( $main_plugins, array( '' ) ),
        // corporate2-free
        'corporate2-free' => array_merge( $main_plugins, array( '' ) ),
        // events-free
        'events-free' => array_merge( $main_plugins, array( 'modern-events-calendar-lite' ) ),
        // church-free
        'church-free' => array_merge( $main_plugins, array( 'modern-events-calendar-lite' ) ),
        // real-estate-free
        'real-estate-free' => array_merge( $main_plugins, array( '' ) ),
        // freelancer-free
        'freelancer-free' => array_merge( $main_plugins, array( '' ) ),
        // language-school-free
        'language-school-free' => array_merge( $main_plugins, array( 'modern-events-calendar-lite' ) ),
        // business-free
        'business-free'	=> array_merge( $main_plugins, array( '' ) ),
        // lawyer-free
        'lawyer-free' => array_merge( $main_plugins, array( '' ) ),
        // dentist-free
        'dentist-free' => array_merge( $main_plugins, array( '' ) ),
        // startup-free
        'startup-free' => array_merge( $main_plugins, array( '' ) ),
        // wedding-free
        'wedding-free' => array_merge( $main_plugins, array( '' ) ),
        // insurance-free
        'insurance-free' => array_merge( $main_plugins, array( '' ) ),
        // yoga-free
        'yoga-free'	=> array_merge( $main_plugins, array( '' ) ),
        // mechanic-free
        'mechanic-free'	=> array_merge( $main_plugins, array( '' ) ),
        // portfolio-free
        'portfolio-free' => array_merge( $main_plugins, array( '' ) ),
        // dietitian-free
        'dietitian-free' => array_merge( $main_plugins, array( '' ) ),
        // software-free
        'software-free'	=> array_merge( $main_plugins, array( '' ) ),
        // beauty-free
        'beauty-free' => array_merge( $main_plugins, array( '' ) ),
        // consulting-free
        'consulting-free' => array_merge( $main_plugins, array( '' ) ),
        // crypto-free
        'crypto-free' => array_merge( $main_plugins, array( '' ) ),
    );
    return $plugins_array[ $slug ];
}
