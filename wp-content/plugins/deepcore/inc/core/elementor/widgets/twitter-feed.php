<?php
namespace Elementor;
class Webnus_Element_Widgets_Twitter_Feed extends \Elementor\Widget_Base {

	/**
	 * Retrieve Twitter Feed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'twitter_feed';
		
	}

	/**
	 * Retrieve Twitter Feed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Twitter Feed', 'deep' );

	}

	/**
	 * Retrieve Twitter Feed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'ti-twitter';

	}

	/**
	 * Set widget category.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget category.
	 */
	public function get_categories() {

		return [ 'webnus' ];

	}

	/**
	 * Register Twitter Feed widget controls.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

        // Content Tab
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Feed Settings', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		// Twitter Username
		$this->add_control(
			'username', //param_name
			[
				'label' 		=> esc_html__( 'Twitter Username', 'deep' ), //heading
				'type' 			=> Controls_Manager::TEXT, //type
				'placeholder' 	=> esc_html__( 'profile id/username', 'deep' ),
			]
		);

    	// Feed Count
        $this->add_control(
            'count',
            [
                'label'   => esc_html__( 'Feed Count', 'deep' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 3,
                'min'     => 1,
                'max'     => 32,
                'step'    => 1,
            ]
        );

		// Access Token
		$this->add_control(
			'access_token', //param_name
			[
				'label' 		=> esc_html__( 'Access Token', 'deep' ), //heading
				'type' 			=> Controls_Manager::TEXT, //type
				'placeholder' 	=> esc_html__( 'TOKEN...', 'deep' ),
			]
		);

		// Access Token Secret
		$this->add_control(
			'access_token_secret', //param_name
			[
				'label' 		=> esc_html__( 'Access Token Secret', 'deep' ), //heading
				'type' 			=> Controls_Manager::TEXT, //type
				'placeholder' 	=> esc_html__( 'TOKEN SECRET...', 'deep' ),
			]
		);

		// Consumer Key
		$this->add_control(
			'consumer_key', //param_name
			[
				'label' 		=> esc_html__( 'Consumer Key', 'deep' ), //heading
				'type' 			=> Controls_Manager::TEXT, //type
				'placeholder' 	=> esc_html__( 'Consumer...', 'deep' ),
			]
		);

		// Consumer Secret
		$this->add_control(
			'consumer_secret', //param_name
			[
				'label' 		=> esc_html__( 'Consumer Secret', 'deep' ), //heading
				'type' 			=> Controls_Manager::TEXT, //type
				'placeholder' 	=> esc_html__( 'Consumer Secret...', 'deep' ),
			]
		);

        $this->end_controls_section();
				
		// Class & ID Tab
		$this->start_controls_section(
			'classid_section',
			[
				'label' => __( 'Class & ID', 'deep' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'shortcodeclass',
			[
				'label'	=> esc_html__( 'Extra Class', 'deep' ),
				'type'	=> Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'shortcodeid',
			[
				'label'	=> esc_html__( 'ID', 'deep' ),
				'type'	=> Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();

		// Custom css tab
		$this->start_controls_section(
			'custom_css_section',
			[
				'label' => __( 'Custom CSS', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'custom_css',
			[
				'label' => __( 'Custom CSS', 'deep' ),
				'type' => \Elementor\Controls_Manager::CODE,
				'language' => 'css',
				'rows' => 20,
				'show_label' => true,
			]
		);

		$this->end_controls_section();

		
	}

	/**
	 * Render Twitter Feed widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		ob_start();

        $settings 				= $this->get_settings_for_display();
    
		$username				= $settings[ 'username' ];
		$count					= $settings[ 'count' ];
		$access_token			= $settings[ 'access_token' ];
		$access_token_secret	= $settings[ 'access_token_secret' ];
		$consumer_key			= $settings[ 'consumer_key' ];
		$consumer_secret		= $settings[ 'consumer_secret' ];

        // Class & ID 
        $shortcodeclass 	= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
        $shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';

	?>

		<section class="wn-wrap-tweets-carousel ' . $shortcodeclass . '"  ' . $shortcodeid . '>
			
			<div class="wn-tweets-carousel">
				<i class="wn-fab wn-fa-twitter colorf"></i>
				<?php require_once DEEP_CORE_DIR . 'helper-classes/twitter-api.php';

				/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
				$settings = array(
					'oauth_access_token'		=> $access_token,
					'oauth_access_token_secret'	=> $access_token_secret,
					'consumer_key'				=> $consumer_key,
					'consumer_secret'			=> $consumer_secret
				);

				$url			= "https://api.twitter.com/1.1/statuses/user_timeline.json";
				$requestMethod	= "GET";
				$getfield		= "?screen_name=$username&count=$count";
				$twitter		= new \TwitterAPIExchange($settings);
				$tweets			= json_decode($twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest(),$assoc = TRUE);

				if( isset( $tweets['errors'][0]['message'] ) && $tweets['errors'][0]['message'] != '' ) :
					echo '
						<h3>' . esc_html__( 'Sorry, there was a problem.', 'deep' ) . '</h3>
						<p>' . esc_html__( 'Twitter returned the following error message:', 'deep' ) . '</p>
						<p><em>' . $tweets['errors'][0]['message'] . '</em></p>';

				else :
					if ( $count > 1 ) {
						echo '<div class="tweets-owl-carousel owl-carousel owl-theme">';
					}
					if ( isset( $tweets ) ) {

						foreach( $tweets as $tweet ) :
							
							// Convert attags to twitter profiles in <a> links
							$tweet['text'] = preg_replace("/@([A-Za-z0-9\/\.]*)/", "<a href=\"http://www.twitter.com/$1\">@$1</a>", $tweet['text']);
							// Formatting Twitter’s Date/Time
							$tweet['created_at'] = date("l M j \- g:ia",strtotime($tweet['created_at']));
							
							echo '<p>' . $tweet['text'] . '</p>';
							
						endforeach;

					}

					if ( $count > 1 ) {
						echo '</div>';
					}
					get_template_part( 'inc/templates/social' );
				endif; ?>

			</div>

		</section>

		<?php
		$out = ob_get_contents();
		ob_end_clean();
		$out = str_replace('<p></p>','',$out);

        $custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
        }

		echo $out;

	}

}