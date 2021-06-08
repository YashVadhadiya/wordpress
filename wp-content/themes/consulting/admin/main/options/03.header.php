<?php
/**
 * Social media functions.
 *
 * @package ThinkUpThemes
 */

/* ----------------------------------------------------------------------------------
	PRE HEADER STYLE
---------------------------------------------------------------------------------- */
function consulting_thinkup_input_headerstylepre($classes) {

	$classes[] = 'pre-header-style2';

	return $classes;
}
add_action( 'body_class', 'consulting_thinkup_input_headerstylepre');


/* ----------------------------------------------------------------------------------
	HEADER STYLE
---------------------------------------------------------------------------------- */
function consulting_thinkup_input_headerstyle($classes) {

// Get theme options values.
$thinkup_header_float        = consulting_thinkup_var ( 'thinkup_header_float' );
$thinkup_header_logooverflow = consulting_thinkup_var ( 'thinkup_header_logooverflow' );

	$classes[] = 'header-style1';

	// Check whether floating header is enabled
	if ( $thinkup_header_float == '1' ) {
		$classes[] = 'header-float';
	}

	// Check whether header logo should overflow container
	if ( $thinkup_header_logooverflow == '1' ) {
		$classes[] = 'header-logooverflow';
	}

	return $classes;
}
add_action( 'body_class', 'consulting_thinkup_input_headerstyle');


/* ----------------------------------------------------------------------------------
	HEADER - STICK HEADER
---------------------------------------------------------------------------------- */

function consulting_thinkup_input_headersticky() {

// Get theme options values.
$thinkup_header_stickyswitch = consulting_thinkup_var ( 'thinkup_header_stickyswitch' );

	if ( $thinkup_header_stickyswitch == '1' ) {

		?>
		<div id="header-sticky">
		<div id="header-sticky-core">

			<div id="logo-sticky">
			<?php /* Custom Logo */ echo consulting_thinkup_custom_logo(); ?>
			</div>

			<div id="header-sticky-links" class="main-navigation">
			<div id="header-sticky-links-inner" class="header-links">

				<?php $walker = new consulting_thinkup_menudescription;
				wp_nav_menu(array( 'container' => false, 'theme_location'  => 'header_menu', 'walker' => new consulting_thinkup_menudescription() ) ); ?>
				
				<?php /* Header Search */ consulting_thinkup_input_headersearch(); ?>
			</div>
			</div><div class="clearboth"></div>
			<!-- #header-sticky-links .main-navigation -->

		</div>
		</div>
		<!-- #header-sticky -->
	<?php
	}
}


/* ----------------------------------------------------------------------------------
	STICKY HEADER
---------------------------------------------------------------------------------- */
function consulting_thinkup_input_headerstickyclass($classes) {

// Get theme options values.
$thinkup_header_stickyswitch = consulting_thinkup_var ( 'thinkup_header_stickyswitch' );

	if ( $thinkup_header_stickyswitch == '1' ) {
		$classes[] = 'header-sticky';
	}
	return $classes;
}
add_action( 'body_class', 'consulting_thinkup_input_headerstickyclass' );


/* ----------------------------------------------------------------------------------
	SEARCH - DISABLE SEARCH (HEADER)
---------------------------------------------------------------------------------- */
function consulting_thinkup_input_headersearch() {

// Get theme options values.
$thinkup_header_searchswitch = consulting_thinkup_var ( 'thinkup_header_searchswitch' );

	if ( $thinkup_header_searchswitch == '1' ) {
		echo '<div id="header-search">',
			 '<a><div class="fa fa-search"></div></a>',
		     get_search_form(),
		     '</div>';
	}
}

/* ----------------------------------------------------------------------------------
	SOCIAL MEDIA - DISPLAY MESSAGE
---------------------------------------------------------------------------------- */

/* Message Settings */
function consulting_thinkup_input_socialmessage(){

// Get theme options values.
$thinkup_header_socialmessage  = consulting_thinkup_var ( 'thinkup_header_socialmessage' );
$thinkup_header_facebookswitch = consulting_thinkup_var ( 'thinkup_header_facebookswitch' );
$thinkup_header_twitterswitch  = consulting_thinkup_var ( 'thinkup_header_twitterswitch' );
$thinkup_header_googleswitch   = consulting_thinkup_var ( 'thinkup_header_googleswitch' );
$thinkup_header_linkedinswitch = consulting_thinkup_var ( 'thinkup_header_linkedinswitch' );
$thinkup_header_flickrswitch   = consulting_thinkup_var ( 'thinkup_header_flickrswitch' );
$thinkup_header_youtubeswitch  = consulting_thinkup_var ( 'thinkup_header_youtubeswitch' );
$thinkup_header_rssswitch      = consulting_thinkup_var ( 'thinkup_header_rssswitch' );

	if ( empty( $thinkup_header_facebookswitch ) 
		and empty( $thinkup_header_twitterswitch ) 
		and empty( $thinkup_header_googleswitch ) 
		and empty( $thinkup_header_linkedinswitch ) 
		and empty( $thinkup_header_flickrswitch ) 
		and empty( $thinkup_header_lastfmswitch ) 
		and empty( $thinkup_header_youtubeswitch ) 
		and empty( $thinkup_header_rssswitch ) ) {	
		return '';
	} else if ( ! empty( $thinkup_header_socialmessage ) ) {	
		return esc_html( $thinkup_header_socialmessage );
	} else if ( empty( $thinkup_header_socialmessage ) ) {
		return '';
	}
}


/* ----------------------------------------------------------------------------------
	SOCIAL MEDIA - CUSTOM ICONS
---------------------------------------------------------------------------------- */

/* Facebook - Custom Icon */
function consulting_thinkup_input_facebookicon(){

// Get theme options values.
$thinkup_header_facebookiconswitch = consulting_thinkup_var ( 'thinkup_header_facebookiconswitch' );
$thinkup_header_facebookcustomicon = consulting_thinkup_var ( 'thinkup_header_facebookcustomicon', 'url' );

	$output = NULL;

	if ( $thinkup_header_facebookiconswitch == '1' and ! empty( $thinkup_header_facebookcustomicon ) ) {
		
		// Output for header social media
		$output .= '#pre-header-social li.facebook a,';
		$output .= '#pre-header-social li.facebook a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_facebookcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#pre-header-social li.facebook i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.facebook a,';
		$output .= '#post-footer-social li.facebook a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_facebookcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.facebook i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* Twitter - Custom Icon */
function consulting_thinkup_input_twittericon(){

// Get theme options values.
$thinkup_header_twittericonswitch = consulting_thinkup_var ( 'thinkup_header_twittericonswitch' );
$thinkup_header_twittercustomicon = consulting_thinkup_var ( 'thinkup_header_twittercustomicon', 'url' );

	$output = NULL;

	if ( $thinkup_header_twittericonswitch == '1' and ! empty( $thinkup_header_twittercustomicon ) ) {

		// Output for header social media
		$output .= '#pre-header-social li.twitter a,';
		$output .= '#pre-header-social li.twitter a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_twittercustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#pre-header-social li.twitter i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.twitter a,';
		$output .= '#post-footer-social li.twitter a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_twittercustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.twitter i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* Google+ - Custom Icon */
function consulting_thinkup_input_googleicon(){

// Get theme options values.
$thinkup_header_googleiconswitch = consulting_thinkup_var ( 'thinkup_header_googleiconswitch' );
$thinkup_header_googlecustomicon = consulting_thinkup_var ( 'thinkup_header_googlecustomicon', 'url' );

	$output = NULL;

	if ( $thinkup_header_googleiconswitch == '1' and ! empty( $thinkup_header_googlecustomicon ) ) {

		// Output for header social media
		$output .= '#pre-header-social li.google-plus a,';
		$output .= '#pre-header-social li.google-plus a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_googlecustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#pre-header-social li.google-plus i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.google-plus a,';
		$output .= '#post-footer-social li.google-plus a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_googlecustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.google-plus i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* LinkedIn - Custom Icon */
function consulting_thinkup_input_linkedinicon(){

// Get theme options values.
$thinkup_header_linkediniconswitch = consulting_thinkup_var ( 'thinkup_header_linkediniconswitch' );
$thinkup_header_linkedincustomicon = consulting_thinkup_var ( 'thinkup_header_linkedincustomicon', 'url' );

	$output = NULL;

	if ( $thinkup_header_linkediniconswitch == '1' and ! empty( $thinkup_header_linkedincustomicon ) ) {

		// Output for header social media
		$output .= '#pre-header-social li.linkedin a,';
		$output .= '#pre-header-social li.linkedin a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_linkedincustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#pre-header-social li.linkedin i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.linkedin a,';
		$output .= '#post-footer-social li.linkedin a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_linkedincustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.linkedin i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* Flickr - Custom Icon */
function consulting_thinkup_input_flickricon(){

// Get theme options values.
$thinkup_header_flickriconswitch = consulting_thinkup_var ( 'thinkup_header_flickriconswitch' );
$thinkup_header_flickrcustomicon = consulting_thinkup_var ( 'thinkup_header_flickrcustomicon', 'url' );

	$output = NULL;

	if ( $thinkup_header_flickriconswitch == '1' and ! empty( $thinkup_header_flickrcustomicon ) ) {

		// Output for header social media
		$output .= '#pre-header-social li.flickr a,';
		$output .= '#pre-header-social li.flickr a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_flickrcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#pre-header-social li.flickr i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.flickr a,';
		$output .= '#post-footer-social li.flickr a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_flickrcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.flickr i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* YouTube - Custom Icon */
function consulting_thinkup_input_youtubeicon(){

// Get theme options values.
$thinkup_header_youtubeiconswitch = consulting_thinkup_var ( 'thinkup_header_youtubeiconswitch' );
$thinkup_header_youtubecustomicon = consulting_thinkup_var ( 'thinkup_header_youtubecustomicon', 'url' );

	$output = NULL;

	if ( $thinkup_header_youtubeiconswitch == '1' and ! empty( $thinkup_header_youtubecustomicon ) ) {

		// Output for header social media
		$output .= '#pre-header-social li.youtube a,';
		$output .= '#pre-header-social li.youtube a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_youtubecustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#pre-header-social li.youtube i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.youtube a,';
		$output .= '#post-footer-social li.youtube a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_youtubecustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.youtube i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* RSS - Custom Icon */
function consulting_thinkup_input_rssicon(){

// Get theme options values.
$thinkup_header_rssiconswitch = consulting_thinkup_var ( 'thinkup_header_rssiconswitch' );
$thinkup_header_rsscustomicon = consulting_thinkup_var ( 'thinkup_header_rsscustomicon', 'url' );

	$output = NULL;

	if ( $thinkup_header_rssiconswitch == '1' and ! empty( $thinkup_header_rsscustomicon ) ) {

		// Output for header social media
		$output .= '#pre-header-social li.rss a,';
		$output .= '#pre-header-social li.rss a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_rsscustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#pre-header-social li.rss i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.rss a,';
		$output .= '#post-footer-social li.rss a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_rsscustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.rss i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* Input Custom Social Media Icons */
function consulting_thinkup_input_socialicon(){

	$output = NULL;
	
	$output .= consulting_thinkup_input_facebookicon();
	$output .= consulting_thinkup_input_twittericon();
	$output .= consulting_thinkup_input_googleicon();
	$output .= consulting_thinkup_input_linkedinicon();
	$output .= consulting_thinkup_input_flickricon();
	$output .= consulting_thinkup_input_youtubeicon();
	$output .= consulting_thinkup_input_rssicon();

	if ( ! empty( $output ) ) {
		echo    '<style type="text/css">' . "\n" . $output . '</style>';
	}
}
add_action( 'wp_head', 'consulting_thinkup_input_socialicon', 13 );


/* ----------------------------------------------------------------------------------
	SOCIAL MEDIA - OUTPUT SOCIAL MEDIA SELECTIONS (PRE HEADER)
---------------------------------------------------------------------------------- */

function consulting_thinkup_input_socialmediaheaderpre() {

// Get theme options values.
$thinkup_header_socialswitchpre = consulting_thinkup_var ( 'thinkup_header_socialswitchpre' );
$thinkup_header_socialmessage   = consulting_thinkup_var ( 'thinkup_header_socialmessage' );
$thinkup_header_facebookswitch  = consulting_thinkup_var ( 'thinkup_header_facebookswitch' );
$thinkup_header_facebooklink    = consulting_thinkup_var ( 'thinkup_header_facebooklink' );
$thinkup_header_twitterswitch   = consulting_thinkup_var ( 'thinkup_header_twitterswitch' );
$thinkup_header_twitterlink     = consulting_thinkup_var ( 'thinkup_header_twitterlink' );
$thinkup_header_googleswitch    = consulting_thinkup_var ( 'thinkup_header_googleswitch' );
$thinkup_header_googlelink      = consulting_thinkup_var ( 'thinkup_header_googlelink' );
$thinkup_header_linkedinswitch  = consulting_thinkup_var ( 'thinkup_header_linkedinswitch' );
$thinkup_header_linkedinlink    = consulting_thinkup_var ( 'thinkup_header_linkedinlink' );
$thinkup_header_flickrswitch    = consulting_thinkup_var ( 'thinkup_header_flickrswitch' );
$thinkup_header_flickrlink      = consulting_thinkup_var ( 'thinkup_header_flickrlink' );
$thinkup_header_youtubeswitch   = consulting_thinkup_var ( 'thinkup_header_youtubeswitch' );
$thinkup_header_youtubelink     = consulting_thinkup_var ( 'thinkup_header_youtubelink' );
$thinkup_header_rssswitch       = consulting_thinkup_var ( 'thinkup_header_rssswitch' );
$thinkup_header_rsslink         = consulting_thinkup_var ( 'thinkup_header_rsslink' );

// Reset count values used in foreach loop
$i = 0;
$j = 0;

	if ( $thinkup_header_socialswitchpre == '1' ) {

		// Assign social media link to an array
		$social_links = array( 
			array( 'social' => __( 'Facebook', 'consulting' ),  'icon' => 'facebook',     'toggle' => $thinkup_header_facebookswitch,  'link' => $thinkup_header_facebooklink ),
			array( 'social' => __( 'Twitter', 'consulting' ),   'icon' => 'twitter',      'toggle' => $thinkup_header_twitterswitch,   'link' => $thinkup_header_twitterlink ),
			array( 'social' => __( 'Google+', 'consulting' ),   'icon' => 'google-plus',  'toggle' => $thinkup_header_googleswitch,    'link' => $thinkup_header_googlelink ),
			array( 'social' => __( 'LinkedIn', 'consulting' ),  'icon' => 'linkedin',     'toggle' => $thinkup_header_linkedinswitch,  'link' => $thinkup_header_linkedinlink ),
			array( 'social' => __( 'Flickr', 'consulting' ),    'icon' => 'flickr',       'toggle' => $thinkup_header_flickrswitch,    'link' => $thinkup_header_flickrlink ),
			array( 'social' => __( 'YouTube', 'consulting' ),   'icon' => 'youtube',      'toggle' => $thinkup_header_youtubeswitch,   'link' => $thinkup_header_youtubelink ),
			array( 'social' => __( 'RSS', 'consulting' ),       'icon' => 'rss',          'toggle' => $thinkup_header_rssswitch,       'link' => $thinkup_header_rsslink ),
		);


		// Output social media links if any link is set
		foreach( $social_links as $social ) {	
			if ( ! empty( $social['link'] ) and $j == 0 ) {
				echo '<div id="pre-header-social"><ul>'; $j = 1;

				if ( ! empty ( $thinkup_header_socialmessage ) ) {
					echo '<li class="social message">' . consulting_thinkup_input_socialmessage() . '</li>';
				}
			}

			if ( ! empty( $social['link'] ) and $social['toggle'] == '1' ) {

			echo '<li class="social ' . esc_attr( $social['icon'] ) . '">',
				 '<a href="' . esc_url( $social['link'] ) . '" data-tip="bottom" data-original-title="' . esc_attr( $social['social'] ) . '" target="_blank">',
				 '<i class="fa fa-' . esc_attr( $social['icon'] ) . '"></i>',
				 '</a>',
				 '</li>';
			}
		}

		// Close list output of social media links if any link is set
		if ( $j !== 0 ) echo '</ul></div>';
	}
}


?>