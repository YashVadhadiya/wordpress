<?php
/**
*	Author: Webnus
*	Author URI: http://webnus.net
*/

if ( !class_exists( 'Wn_Image_Class' ) ) {
	require_once 'class_webnus_image.php';
}

/**
* Class for maniuplating data
*/
class Wn_Img_Maniuplate {
	
	function __construct() {
		// // construct it
		// wp_get_current_user();

		// $upload_dir = wp_upload_dir();

		// $user_dirname = $upload_dir['basedir'] . '/webnus/images';

		// if(!file_exists($user_dirname)) wp_mkdir_p($user_dirname);

		// $folder = '/webnus/images';
		// !defined('WNSH_FOLDER' ) ? define( 'WNSH_FOLDER' , $folder ) : '';
		// !defined('WNSH_PATH'   ) ? define( 'WNSH_PATH'   , $upload_dir['basedir'] . $folder ) : '';
		// !defined('WNSH_URL'    ) ? define( 'WNSH_URL'    , $upload_dir['baseurl'] . $folder ) : '';
		// !defined('WNSH_BASEDIR') ? define( 'WNSH_BASEDIR', $upload_dir['basedir'] ) : '';
		// !defined('WNSH_BASEURL') ? define( 'WNSH_BASEURL', $upload_dir['baseurl'] ) : '';

	}

	public function m_image( $attach_id, $img , $width , $height ) {

		try {

			$name = basename( $img );

			$image = new \Wn_Image_Class( ); // Create a new webnus image object

			$out = $image->hresize( $attach_id, $img, $width, $height);// resize

// 			$out = $image->toFile( '', null , 100 , $name , $width , $height ); //to file

			return $out['url']; // return url 

		} catch( Exception $err ) {

		  echo '' . $err->getMessage(); // handle error

		}
	}

}