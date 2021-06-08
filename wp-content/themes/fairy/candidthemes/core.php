<?php
/**
 * File to load the custom-sidebar folder
 * @package Fairy
 *
 * Load files
 */


/**
 * Load custom widgets
 */
require get_template_directory() . '/candidthemes/custom-widgets/widget-init.php';
require get_template_directory() . '/candidthemes/custom-widgets/candid-author-widget.php';
require get_template_directory() . '/candidthemes/custom-widgets/candid-social-widget.php';
require get_template_directory() . '/candidthemes/custom-widgets/candid-recent-posts-widget.php';

/*Load Sanitize Functions*/
require get_template_directory() . '/candidthemes/functions/sanitize-functions.php';

/*Load Category Selection Class*/
require get_template_directory() . '/candidthemes/functions/customizer-category-control.php';

/*Load about Class*/
require get_template_directory() . '/candidthemes/functions/customizer-about-control.php';

/**
 * Load Custom Function
 */
require get_template_directory() . '/candidthemes/functions/custom-functions.php';
/**
 * Load Dynamic CSS from Customizer
 */
require get_template_directory() . '/candidthemes/functions/dynamic-css.php';
/**
 * Load Hooks Files
 */
require get_template_directory() . '/candidthemes/functions/hook-header.php';
require get_template_directory() . '/candidthemes/functions/hook-footer.php';
require get_template_directory() . '/candidthemes/functions/hook-content.php';

require get_template_directory() . '/candidthemes/customizer-pro/class-customize.php';

/**
 * Load Metabox Sidebar
 */
require get_template_directory() . '/candidthemes/metabox/metabox-sidebar.php';