<?php
namespace Elementor;
class Webnus_Element_Widgets_Sermons extends \Elementor\Widget_Base {

	/**
	 * Retrieve widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'sermons';

	}

	/**
	 * Retrieve widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return esc_html__( 'Webnus Sermons', 'deep' );

	}

	/**
	 * Retrieve widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-editor-quote'; // Temporary Icon

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
	 * enqueue css
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'deep-owl-carousel', 'deep-magnific-popup', 'wn-deep-sermons' ];

	}

	/**
	 * enqueue JS
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_script_depends() {

		return [ 'deep-owl-carousel', 'deep-magnific-popup', 'deep-content-toggle', 'sermon' ];

	}


	/**
	 * Register widget controls.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		if ( ! defined( 'SERMONS_DIR' ) ) {
			return;
		}

    // Content Tab
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'General', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		$this->add_control(
			'type',
			[
				'label' =>  esc_html__( 'Type', 'deep' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'description' =>  esc_html__( 'You can choose from these pre-designed types.', 'deep'),
				'options'			=> [
					"toggle"	=>	"Toggle",
					"toggle2"	=>	"Toggle 2",
					"minimal"	=>	"Minimal",
					"grid"		=>	"Grid",
					"clean"		=>	"Clean",
					"simple"	=>	"Simple",
				],
			]
		);

		$this->add_control(
			'featured', //param_name
			[
				'label' 		=>  esc_html__( 'Display featured image?', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::SWITCHER, //type
				'label_on' 		=>  esc_html__( 'Yes', 'deep' ),
				'label_off' 	=>  esc_html__( 'No', 'deep' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'no',
				'condition'		=>	[
					'type'	=>	[
						'grid'
					]
				],
			]
		);

		$this->add_control(
			'carousel', //param_name
			[
				'label' 		=>  esc_html__( 'Would you like change it to carousel style?', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::SWITCHER, //type
				'label_on' 		=>  esc_html__( 'Yes', 'deep' ),
				'label_off' 	=>  esc_html__( 'No', 'deep' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'no',
				'condition'		=>	[
					'type'	=>	[
						'grid'
					]
				],
			]
		);

		$this->add_control(
			'sermon_carousel_item', //param_name
			[
				'label' 		=>  esc_html__( 'Count in row', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXT, //type
				'condition'		=>	[
					'carousel'	=>	[
						'yes'
					]
				],
			]
		);

		$this->add_control(
			'sort',
			[
				'label' =>  esc_html__( 'Order by', 'deep' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'description' =>  esc_html__( 'Recent Or Popular?', 'deep'),
				'options'			=> [
					''		=>	'Most Recent',
					'view'	=>	'Most Popular',
				],
			]
		);

		$this->add_control(
			'count', //param_name
			[
				'label' 		=>  esc_html__( 'Post Count', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXT, //type
				'description' =>  esc_html__( 'Type nothing to default (6) and type 0 to show all.', 'deep'),
			]
		);

		$this->add_control(
			'page', //param_name
			[
				'label' 		=>  esc_html__( 'Page Navigation', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::SWITCHER, //type
				'label_on' 		=>  esc_html__( 'Enable', 'deep' ),
				'label_off' 	=>  esc_html__( 'Disable', 'deep' ),
				'return_value' 	=> 'yes',
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'deep' ),
				'type' => \Elementor\Controls_Manager::ICON,
				"description" =>  esc_html__( "Show an icon on the left side of the sermon title.", 'deep'),
				'condition'	=>	[
					'type'	=>	['minimal']
				]
			]
		);

    $this->end_controls_section();

		// Class & ID Tab
		$this->start_controls_section(
			'classid_section',
			[
				'label' => esc_html__( 'Class & ID', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
						]
		);

		$this->add_control(
			'shortcodeclass',
			[
				'label'	=>  esc_html__( 'Extra Class', 'deep' ),
				'type'	=> \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'shortcodeid',
			[
				'label'	=>  esc_html__( 'ID', 'deep' ),
				'type'	=> \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();

		// Custom css tab
		$this->start_controls_section(
			'custom_css_section',
			[
				'label' => __( 'Custom CSS', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
	 * Render Sermon Category widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();


		ob_start();

		$shortcodeclass 		= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
		$shortcodeid			= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';
		$type					= $settings['type'];
		$featured				= $settings['featured'];
		$carousel				= $settings['carousel'];
		$sermon_carousel_item	= $settings['sermon_carousel_item'];
		$sort					= $settings['sort'];
		$count					= $settings['count'];
		$page					= $settings['page'];
		$icon					= $settings['icon'];

		$view = ( $sort=='view' ) ? "'&orderby=meta_value_num&meta_key=webnus_views" : "";
		$paged = ( is_front_page() ) ? 'page' : 'paged' ;
		$pages = ($page == 'yes') ? '&paged='.get_query_var($paged) : '&paged=1';
		$query = new \WP_Query('post_type=sermon&posts_per_page='.$count.$pages.$view);

		if(empty($count)){
			$count=1;
		}

		$rcount= 1 ;

		// $sermon_carousel_item = '';
		if ( $carousel == 'yes' ) {
			$carousel				= 'sermon-carousel owl-carousel owl-theme';
			$sermon_carousel_item	= 'data-items="' . $sermon_carousel_item . '"';
		} ?>

		<div class="clearfix row sermons-<?php echo esc_attr($type) . ' ' . $carousel . ' ' . $shortcodeclass . '" ' . $sermon_carousel_item; ?> <?php echo $shortcodeid; ?>>
			<?php
			if ( $type == 'toggle' || $type == 'toggle2' ){
				echo '<div class="sermon-wrap-toggle">';
			}
			if ($type=='clean'){
				echo '<div class="elementor-row">';
			}
			while ($query -> have_posts()) : $query -> the_post();
			//terms
			$post_id = get_the_ID();
			$terms = get_the_terms( $post_id , 'sermon_speaker' );
			if(is_array($terms)){
				$sermon_speaker= array();
				foreach($terms as $term){
					$sermon_speaker[] = $term->slug;
				}
			}else $sermon_speaker=array();
			$terms = get_the_terms(get_the_id(), 'sermon_speaker' );
			$terms_slug_str = '';
			if ($terms && ! is_wp_error($terms)) :
				$term_slugs_arr = array();
			foreach ($terms as $term) {
				$term_slugs_arr[] = $term->name;
			}
			$terms_slug_str = implode( ", ", $term_slugs_arr);
			endif;

			//cats
			$cats = get_the_terms( $post_id , 'sermon_category' );
			if(is_array($cats)){
				$sermon_category = array();
				foreach($cats as $cat){
					$sermon_category[] = $cat->slug;
				}
			}else $sermon_category=array();
			$cats = get_the_terms(get_the_id(), 'sermon_category' );
			$cats_slug_str = '';
			if ($cats && ! is_wp_error($cats)) :
				$cat_slugs_arr = array();
			foreach ($cats as $cat) {
				$cat_slugs_arr[] = '<a href="'. get_term_link($cat, 'sermon_category') .'">' . $cat->name . '</a>';
			}
			$cats_slug_str = implode( ", ", $cat_slugs_arr);
			endif;

			$content ='<p>'. deep_excerpt(36) .'</p>';
			$category = ($cats_slug_str)? esc_html__('Category: ','deep') . $cats_slug_str:'';
			$date = get_the_time('F d, Y');
			$sep = ($cats_slug_str && $terms_slug_str )?' / ':'';
			$sep2 = ($date && $terms_slug_str )?' | ':'';
			$speaker = get_the_term_list( get_the_id() , 'sermon_speaker' ,  esc_html__('Speaker: ','deep') );
			$title = get_the_title();
			$permalink = get_the_permalink();
			$desc = $category.$sep.$speaker;
			$image = get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'sermons-grid','echo'=>false, ) );
			$thumbnail_id   = get_post_thumbnail_id();
			$thumbnail_url = get_the_post_thumbnail_url();
			if( !empty( $thumbnail_url ) ) {
				// if main class not exist get it
				if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
					require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
				}
				$image = new \Wn_Img_Maniuplate; // instance from settor class
				$thumbnail_url = $image->m_image(  $thumbnail_id , $thumbnail_url , '420' , '230' ); // set required and get result
			}
			global $sermon_meta;
			$sermon_video			= rwmb_meta( 'deep_sermon_video' );
			$sermon_audio			= rwmb_meta( 'deep_sermon_audio' );
			$sermon_attachment		= rwmb_meta( 'deep_sermon_attachment' );
			$download_file = !empty( $sermon_attachment ) ? '<a href="'.$sermon_attachment.'" class="button theme-skin larg " target="_self"><span><i class="pe-7s-cloud-download"></i>'. esc_html__('DOWNLOAD','deep').'</span></a>' : '';

			$sermons_meta =
			'<div class="media-links">';
			if ( !empty( $sermon_video ) ) {
				$sermons_meta .= '<a href="'.$sermon_video.'" class="video-popup button theme-skin larg" target="_self" data-effect="mfp-zoom-in"><span><i class="pe-7s-play"></i>'. esc_html__('WATCH','deep').'</span></a>';
			}
			if ( !empty( $sermon_audio ) ) {
				$sermons_meta .= '<a href="#w-audio-'.$post_id.'" class="audio-popup button theme-skin larg " target="_self" data-effect="mfp-zoom-in"><span><i class="pe-7s-headphones"></i>'. esc_html__('LISTEN','deep').'</span></a>
				<div class="white-popup mfp-with-anim mfp-hide">
					<div class="w-audio wn-audio-content" id="w-audio-'.$post_id.'">
						'.do_shortcode('[audio mp3="'.$sermon_audio.'"][/audio]').'
					</div>
				</div>';
			}
			$sermons_meta .= $download_file;
			$sermons_meta .= '<a href="' . get_the_permalink() . '" class="button theme-skin larg "><span><i class="pe-7s-notebook"></i>'. esc_html__('READ MORE','deep').'</span></a>';
		$sermons_meta .= '</div>';

		$sermon_read ='<a href="'.$permalink.'" target="_self"><i class="pe-7s-notebook"></i><span class="media_label">'. esc_html__('READ MORE','deep').'</a>';
		$download_file = !empty( $sermon_attachment ) ? '<a href="'.$sermon_attachment.'" class="button theme-skin larg " target="_self"><span><i class="pe-7s-cloud-download"></i>'. esc_html__('DOWNLOAD','deep').'</span></a>' : '';

		if ( $type=='toggle' ) {
			echo '
			<div class="js-contentToggle wn-sertg-item" data-default-state="close">
				<h2 class="wn-sertg-title js-contentToggle__trigger">' . $title . '<i class="ti-plus"></i></h2>
				<div class="js-contentToggle__content">
					<div class="wn-sertg-content">
						<div class="wn-sertg-meta">
							<p class="wn-sertg-category">'. $category .'</p>
							<p class="wn-sertg-speaker">'. $speaker .'</p>
							<p class="wn-sertg-date">'. get_the_date() .'</p>
						</div>
						' .$content. '
						'. $sermons_meta . '
					</div>
				</div>
			</div>';
		} if ( $type=='toggle2' ) {
			$download_file = !empty( $sermon_attachment ) ? '<a href="'.$sermon_attachment.'" target="_self"><i class="pe-7s-cloud-download"></i>'. esc_html__('DOWNLOAD','deep').'</a>' : '';
			$sermons_meta =
				'<div class="media-links">';
			if ( !empty( $sermon_video ) ) {
			$sermons_meta .= '<a href="'.$sermon_video.'" class="wn-sermon-media" target="_self" data-effect="mfp-zoom-in"><i class="pe-7s-play"></i>'. esc_html__('WATCH','deep').'</a>';
			}
			if ( !empty( $sermon_audio ) ) {
			$sermons_meta .= '<a href="#w-audio-'.$post_id.'" class="inlinelb" target="_self"><i class="pe-7s-headphones"></i>'. esc_html__('LISTEN','deep').'</a>
					<div style="display:none">
						<div class="w-audio w-audio-'.$post_id.'">
							'.do_shortcode('[audio mp3="'.$sermon_audio.'"][/audio]').'
						</div>
					</div>';
			}
			$sermons_meta .= $download_file;
			$sermons_meta .= '<a href="' . get_the_permalink() . '"><i class="pe-7s-notebook"></i>'. esc_html__('READ MORE','deep').'</a>';
			$sermons_meta .= '</div>';

			echo '
			<div class="js-contentToggle wn-sertg-item" data-default-state="close">
				<span class="title-toggle"></span><h2 class="wn-sertg-title js-contentToggle__trigger">' . $title . '</h2>
				<div class="js-contentToggle__content">
					<div class="wn-sertg-content">
						<div class="wn-sertg-meta">
							<p class="wn-sertg-category"><i class="ti-folder"></i>'. $category .'</p>
							<p class="wn-sertg-speaker"><i class="ti-comment"></i>'. $speaker .'</p>
							<p class="wn-sertg-date"><i class="ti-calendar"></i>'. get_the_date() .'</p>
						</div>
						' .$content. '
						'. $sermons_meta . '
					</div>
				</div>
			</div>';
		} else if ($type=='minimal') {

			$download_file = !empty( $sermon_attachment ) ? '<a href="'.$sermon_attachment.'" target="_self" class="wn-data-tooltip" data-name="' .  esc_html__( 'DOWNLOAD', 'deep' ) . '"><i class="pe-7s-cloud-download"></i><span class="wn-shape"></span></a>' : '';
			$sermons_meta_minimal  = '<div class="media-links">';
			if ( !empty( $sermon_video ) ) {
			$sermons_meta_minimal .= '<a href="'.$sermon_video.'" class="video-popup wn-data-tooltip" target="_self" data-name="' .  esc_html__( 'WATCH', 'deep' ) . '" data-effect="mfp-zoom-in"><i class="pe-7s-play"></i><span class="wn-shape"></span></a>';
			}
			if ( !empty( $sermon_audio ) ) {
			$sermons_meta_minimal .= '<a href="#w-audio-'.$post_id.'" class="audio-popup wn-data-tooltip" target="_self" data-name="' .  esc_html__( 'LISTEN', 'deep' ) . '" data-effect="mfp-zoom-in"><i class="pe-7s-headphones"></i><span class="wn-shape"></span></a>
			<div class="white-popup mfp-with-anim mfp-hide">
				<div class="w-audio wn-audio-content" id="w-audio-'.$post_id.'">
					'.do_shortcode('[audio mp3="'.$sermon_audio.'"][/audio]').'
				</div>
			</div>';
			}
			$sermons_meta_minimal .= $download_file;
			$sermons_meta_minimal .= '<a href="' . get_the_permalink() . '" class="wn-data-tooltip" target="_self" data-name="' .  esc_html__( 'READ MORE', 'deep' ) . '"><i class="pe-7s-notebook"></i><span class="wn-shape"></span><span class="media_label"></span></a>';
			$sermons_meta_minimal .= '</div>';

		$icon=($icon)?$icon:'wn-fa wn-fa-microphone';
		$sermon_icon=($icon!='none')?'<i class="sermon-icon '.$icon.'"></i>':'';
		echo '<article><a href="'.$permalink.'">'.$sermon_icon.'<h4>'.$title.'</h4></a><div class="sermon-detail">'. $desc.'</div><div class="media-links">'. $sermons_meta_minimal . '</div></article>';
	}  else if ( $type == 'grid') {

		$download_file = !empty( $sermon_attachment ) ? '<a href="'.$sermon_attachment.'" target="_self" class="wn-data-tooltip" data-name="' .  esc_html__( 'DOWNLOAD', 'deep' ) . '"><i class="pe-7s-cloud-download"></i></a>' : '';

		$sermons_meta_grid  = '<div class="media-links">';
		if ( !empty( $sermon_video ) ) {
		$sermons_meta_grid .= '<a href="'.$sermon_video.'" class="video-popup wn-data-tooltip" target="_self" data-name="' .  esc_html__( 'WATCH', 'deep' ) . '" data-effect="mfp-zoom-in"><i class="pe-7s-play"></i></a>';
		}
		if ( !empty( $sermon_audio ) ) {
		$sermons_meta_grid .= '<a href="#w-audio-'.$post_id.'" class="audio-popup wn-data-tooltip" target="_self" data-name="' .  esc_html__( 'LISTEN', 'deep' ) . '" data-effect="mfp-zoom-in"><i class="pe-7s-headphones"></i></a>
			<div class="white-popup mfp-with-anim mfp-hide">
				<div class="w-audio wn-audio-content" id="w-audio-'.$post_id.'">
					'.do_shortcode('[audio mp3="'.$sermon_audio.'"][/audio]').'
				</div>
			</div>';
		}
		$sermons_meta_grid .= $download_file;
		$sermons_meta_grid .= '<a href="' . get_the_permalink() . '" class="inlinelb wn-data-tooltip" target="_self" data-name="' .  esc_html__( 'READ MORE', 'deep' ) . '"><i class="pe-7s-notebook"></i><span class="media_label"></span></a>';
		$sermons_meta_grid .= '</div>';

	echo '
	<div class="sermon-'.$type.'-item col-md-3">
		<div class="sermons-grid-wrap">';
		if ( $thumbnail_url && $featured == 'yes' ){
		echo '<div class="sermon-grid-thumbnail">
				<a href="'.$permalink.'"><img src="'. $thumbnail_url .'" alt="'.$title.'"></a>
			</div>';
		}
		echo'
			<div class="sermon-grid-header">
				<h4><a href="'.$permalink.'">'.$title.'</a></h4>
				<div class="sermon-grid-cat">' .$cats_slug_str. '</div>
			</div>
			<div class="sermon-grid-content">
				' .$sermons_meta_grid. '
				<p>'. deep_excerpt(15) .'</p>
				<a class="sermon-readmore" href="' .$permalink. '">' . esc_html__( 'Sermon Details', 'deep' ). '</a>
			</div>
		</div>
	</div>';
	} else if ($type=='simple') {

		$col = ($count == '1')? '16': (100 - 100 % $count) / $count;
		$row = 12/$col;

		$image = get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'square','echo'=>false, ) );
		echo ($rcount == 1)?'<div class="elementor-row">':'';
		$image_media=($image)?'<figure class="sermon-img">'.$image.'</figure>':'';
		echo '<div class="elementor-column elementor-col-'.$col.'"><article>'
		.$image_media.
		'<h4><a href="'.$permalink.'">'.$title.'</a></h4>
	</article></div>';
	if($rcount == $row){
		echo '</div>';
		$rcount = 0;
	}

	$rcount++;

	} else if ($type=='clean'){

		$download_file = !empty( $sermon_attachment ) ? '<a href="'.$sermon_attachment.'" target="_self" class="wn-data-tooltip" data-name="' .  esc_html__( 'DOWNLOAD', 'deep' ) . '"><i class="pe-7s-cloud-download"></i><span class="wn-shape"></span></a>' : '';
		$sermons_meta_clean = '<div class="media-links">';
		if ( !empty( $sermon_video ) ) {
		$sermons_meta_clean .= '<a href="'.$sermon_video.'" class="video-popup wn-data-tooltip" target="_self" data-name="' .  esc_html__( 'WATCH', 'deep' ) . '" data-effect="mfp-zoom-in"><i class="pe-7s-play"></i><span class="wn-shape"></span></a>';
		}
		if ( !empty( $sermon_audio ) ) {
		$sermons_meta_clean .= '<a href="#w-audio-'.$post_id.'" class="audio-popup wn-data-tooltip" target="_self" data-name="' .  esc_html__( 'LISTEN', 'deep' ) . '" data-effect="mfp-zoom-in"><i class="pe-7s-headphones"></i><span class="wn-shape"></span></a>
		<div class="white-popup mfp-with-anim mfp-hide">
			<div class="w-audio wn-audio-content" id="w-audio-'.$post_id.'">
				'.do_shortcode('[audio mp3="'.$sermon_audio.'"][/audio]').'
			</div>
		</div>';
		}
		$sermons_meta_clean .= $download_file;
		$sermons_meta_clean .= '<a href="' . get_the_permalink() . '" class="wn-data-tooltip" target="_self" data-name="' .  esc_html__( 'READ MORE', 'deep' ) . '"><i class="pe-7s-notebook"></i><span class="wn-shape"></span><span class="media_label"></span></a>';
		$sermons_meta_clean .= '</div>';
		$sermons_meta_clean .= '<div class="clearn-view" data-name="' .  esc_html__( 'VIEWS', 'deep' ) . '"><i class="pe-7s-look"></i>'.deep_getViews(get_the_ID()).'</div>';

	$col = ($count == '1')? '30': intdiv(100, $count);
	$row = 12/$col;
	echo '
	<div class="elementor-column elementor-col-50">
		<div class="sermon-clean-item">
			<figure class="clean-image">';
				the_post_thumbnail('full');
				echo '
			</figure>
			<div class="clean-content">
				<h4><a href="'.$permalink.'">'.$title.'</a></h4>
				<div class="sermon-detail">'.$speaker.$sep2.$date.'</div>
				<div class="media-links">'. $sermons_meta_clean . '</div>
			</div>
		</div>
	</div>';

	$rcount++;
	}
	endwhile;
	echo '</div>';
	if ( $type == 'toggle' || $type == 'toggle2' ){
		echo '</div>';
	}
	if ($type=='clean') {
		echo '</div>';
	}

	if($page){ ?>
	<section class="container aligncenter">
		<?php
		if(function_exists('wp_pagenavi')) {
			wp_pagenavi( array( 'query' => $query ) );
		}
		?>
		<hr class="vertical-space2">
	</section>
	<?php }
	$out = ob_get_contents();
	ob_end_clean();
	wp_reset_postdata();
        $custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
		}
	echo $out;
	}
}
