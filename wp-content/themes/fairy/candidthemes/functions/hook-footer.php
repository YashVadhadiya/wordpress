<?php
if (!function_exists('fairy_construct_gototop')) {
    /**
     * Add Go to Top Button on Site.
     *
     * @since 1.0.0
     *
     * @param none
     * @return void
     *
     */
    function fairy_construct_gototop()
    {
        global $fairy_theme_options;
        if ($fairy_theme_options['fairy-go-to-top'] == true):
            ?>
            <a href="javascript:void(0);" class="footer-go-to-top go-to-top"><i class="fa fa-long-arrow-up"></i></a>
        <?php
        endif;

    }
}
add_action('fairy_gototop', 'fairy_construct_gototop', 10);

if (!function_exists('fairy_construct_footer_social')) {
    /**
     * Add social icon menu on footer
     *
     * @since 1.0.0
     */
    function fairy_construct_footer_social()
    {
        global $fairy_theme_options;
        if ($fairy_theme_options['fairy-footer-social-icons'] != true)
            return false;
        fairy_social_menu();
    }
}
add_action('fairy_footer_social', 'fairy_construct_footer_social', 10);

if (!function_exists('fairy_footer_copyright')) {
    /**
     * Add Footer copyright texts on footer
     *
     * @since 1.0.0
     */
    function fairy_footer_copyright()
    {
        global $fairy_theme_options;
        $copyright_text = $fairy_theme_options['fairy-footer-copyright'];
        if (!empty($copyright_text)) {
            ?>
            <div class="site-reserved text-center">
               <?php echo esc_html($copyright_text); ?>
            </div>
            <?php
        }
    }
}
add_action('fairy_footer_info_texts', 'fairy_footer_copyright', 10);

if (!function_exists('fairy_footer_theme_info')) {
    /**
     * Add Powered by texts on footer
     *
     * @since 1.0.0
     */
    function fairy_footer_theme_info()
    {
        ?>
        <div class="site-info text-center">
            <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'fairy' ) ); ?>">
                <?php
                /* translators: %s: CMS name, i.e. WordPress. */
                printf( esc_html__( 'Proudly powered by %s', 'fairy' ), 'WordPress' );
                ?>
            </a>
            <span class="sep"> | </span>
            <?php
            /* translators: 1: Theme name, 2: Theme author. */
            printf( esc_html__( 'Theme: %1$s by %2$s.', 'fairy' ), 'Fairy', '<a href="http://www.candidthemes.com/">Candid Themes</a>' );
            ?>
        </div><!-- .site-info -->
        <?php
    }
}
add_action('fairy_footer_info_texts', 'fairy_footer_theme_info', 20);

if (!function_exists('fairy_construct_newsletter')) {
    /**
     * Add Newsletter section on footer
     *
     * @since 1.0.0
     */
    function fairy_construct_newsletter()
    {
        global $fairy_theme_options;
        $mailchimp_id = $fairy_theme_options['fairy-footer-mailchimp-form-id'];
        if(($fairy_theme_options['fairy-footer-mailchimp-subscribe']) != 1 || (empty($mailchimp_id)) || (!function_exists('mc4wp_get_form') ) || ( get_post_status( $mailchimp_id ) == false) )
            return false;
        $newsletter_title =  $fairy_theme_options['fairy-footer-mailchimp-form-title'];
            $newsletter_description =  $fairy_theme_options['fairy-footer-mailchimp-form-subtitle'];
        ?>
        <section class="newsletter-section">
            <div class="container">
                <article class="newsletter-content">
                    <div class="row">
                        <div class="col-1-1 col-md-1-2">
                            <?php
                            if(!empty($newsletter_title )) {
                                ?>
                                <h2><?php echo esc_html($newsletter_title); ?></h2>
                                <?php
                            }
                                ?>
                            <?php
                            if(!empty($newsletter_description )) {
                                ?>
                                <p><?php echo esc_html($newsletter_description);; ?></p>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-1-1 col-md-1-2">
                            <?php echo mc4wp_get_form( absint($mailchimp_id )); ?>
                        </div>
                    </div>
                </article>
            </div>
        </section>
<?php
    }
}
add_action('fairy_newsletter', 'fairy_construct_newsletter', 10);