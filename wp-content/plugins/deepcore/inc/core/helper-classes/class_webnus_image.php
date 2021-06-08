<?php
/**
* Author: Webnus
* Author URI: http://webnus.net
*/


class Wn_Image_Class {

	const NOT_F = 1;
	const GDN_E = 4;
	const INV_IMG = 7;
	const WE_N_E = 10;

	private $image;
	private $mimeType;
	private $exif;

  // Creates a new WN object.
	public function __construct($image = null) {
    // Check for the required GD extension
		if(extension_loaded('gd')) {
      // Ignore JPEG warnings that cause imagecreatefromjpeg() to fail
			ini_set('gd.jpeg_ignore_warning', 1);
		} else {
			throw new \Exception('Required extension GD is not loaded.', self::GDN_E);
		}

    // Load an image through the constructor
		if(preg_match('/^data:(.*?);/', $image)) {
			$this->fromDataUri($image);
		} elseif($image) {
			$this->fromFile($image);
		}
	}

  // Destroys the image resource
	public function __destruct() {
		if($this->image !== null && get_resource_type($this->image) === 'gd') {
			imagedestroy($this->image);
		}
	}

  // Loads an image from a data URI.
	public function fromDataUri($uri) {
    // Basic formatting check
		preg_match('/^data:(.*?);/', $uri, $matches);
		if(!count($matches)) {
			throw new \Exception('Invalid data URI.', self::ERR_INVALID_DATA_URI);
		}

    // Determine mime type
		$this->mimeType = $matches[1];
		if(!preg_match('/^image\/(gif|jpeg|png)$/', $this->mimeType)) {
			throw new \Exception(
				'Unsupported format: ' . $this->mimeType,
				self::ERR_UNSUPPORTED_FORMAT
				);
		}

    // Get image data
		$uri = base64_decode(preg_replace('/^data:(.*?);base64,/', '', $uri));
		$this->image = imagecreatefromstring($uri);
		if(!$this->image) {
			throw new \Exception("Invalid image data.", self::INV_IMG);
		}

		return $this;
	}

	public function hresize( $attach_id = null, $img_url = null, $width = null, $height = null, $crop = true ) {
		// this is an attachment, so we have the ID
		$image_src = array();
		if ( $attach_id ) {
			$image_src = wp_get_attachment_image_src( $attach_id, 'full' );
			$actual_file_path = get_attached_file( $attach_id );
				// this is not an attachment, let's use the image url
		} elseif ( $img_url ) {
			$file_path = parse_url( $img_url );
			$actual_file_path = rtrim( ABSPATH, '/' ) . $file_path['path'];
			$orig_size = getimagesize( $actual_file_path );
			$image_src[0] = $img_url;
			$image_src[1] = $orig_size[0];
			$image_src[2] = $orig_size[1];
		}

		if ( ! empty( $actual_file_path ) ) {
			$file_info = pathinfo( $actual_file_path );
			$extension = '.' . $file_info['extension'];

				// the image path without the extension
			$no_ext_path = $file_info['dirname'] . '/' . $file_info['filename'];

			$cropped_img_path = $no_ext_path . '-' . $width . 'x' . $height . $extension;

				// checking if the file size is larger than the target size
				// if it is smaller or the same size, stop right here and return
			if ( $image_src[1] > $width || $image_src[2] > $height ) {

					// the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
				if ( file_exists( $cropped_img_path ) ) {
					$cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
					$vt_image = array(
						'url' => $cropped_img_url,
						'width' => $width,
						'height' => $height,
						);
					return $vt_image;
				}

				if ( false == $crop ) {
						// calculate the size proportionaly
					$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
					$resized_img_path = $no_ext_path . '-' . $proportional_size[0] . 'x' . $proportional_size[1] . $extension;

						// checking if the file already exists
					if ( file_exists( $resized_img_path ) ) {
						$resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );

						$vt_image = array(
							'url' => $resized_img_url,
							'width' => $proportional_size[0],
							'height' => $proportional_size[1],
							);

						return $vt_image;
					}
				}

					// no cache files - let's finally resize it
				$img_editor = wp_get_image_editor( $actual_file_path );

				if ( is_wp_error( $img_editor ) || is_wp_error( $img_editor->resize( $width, $height, $crop ) ) ) {
					return array(
						'url' => '',
						'width' => '',
						'height' => '',
						);
				}

				$new_img_path = $img_editor->generate_filename();

				if ( is_wp_error( $img_editor->save( $new_img_path ) ) ) {
					return array(
						'url' => '',
						'width' => '',
						'height' => '',
						);
				}
				if ( ! is_string( $new_img_path ) ) {
					return array(
						'url' => '',
						'width' => '',
						'height' => '',
						);
				}

				$new_img_size = getimagesize( $new_img_path );
				$new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );

					// resized output
				$vt_image = array(
					'url' => $new_img,
					'width' => $new_img_size[0],
					'height' => $new_img_size[1],
					);

				return $vt_image;
			}

				// default output - without resizing
				$vt_image = array(
					'url' => $image_src[0],
					'width' => $image_src[1],
					'height' => $image_src[2],
					);

				return $vt_image;
			}

			return false;
		}


  // Loads an image from a file.
	public function fromFile($file) {

		if( ini_get('allow_url_fopen') ) {
			$handle = @fopen($file, 'r');
			if($handle === false) {
				throw new \Exception("File not found: $file", self::NOT_F);
			}
			fclose($handle);
		} else {
			$curlObj = curl_init();
			$options = [
			CURLOPT_URL => $file,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_POST => 1,
			CURLOPT_FOLLOWLOCATION => 1,
			CURLOPT_AUTOREFERER => 1,
			CURLOPT_USERAGENT => 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)',
			CURLOPT_TIMEOUT => 2,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_0,
			CURLOPT_HTTPHEADER => ['Expect:'],
			CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
			];

			curl_setopt_array($curlObj, $options);
			$file = curl_exec($curlObj);
			if (curl_errno($curlObj)) {
        		//error message
				$returnData = curl_error($curlObj);
			}
			curl_close($curlObj);

		}

    // Get image info
		$info = getimagesize($file);
		if($info === false) {
			throw new \Exception("Invalid image file: $file", self::INV_IMG);
		}
		$this->mimeType = $info['mime'];

    // Create image object from file
		switch($this->mimeType) {
			case 'image/gif':
      // Load the gif
			$gif = imagecreatefromgif($file);
			if($gif) {
        // Copy the gif over to a true color image to preserve its transparency. This is a
        // workaround to prevent imagepalettetruecolor() from borking transparency.
				$width = imagesx($gif);
				$height = imagesy($gif);
				$this->image = imagecreatetruecolor($width, $height);
				$transparentColor = imagecolorallocatealpha($this->image, 0, 0, 0, 127);
				imagecolortransparent($this->image, $transparentColor);
				imagefill($this->image, 0, 0, $transparentColor);
				imagecopy($this->image, $gif, 0, 0, 0, 0, $width, $height);
				imagedestroy($gif);
			}
			break;
			case 'image/jpeg':
			$this->image = imagecreatefromjpeg($file);
			break;
			case 'image/png':
			$this->image = imagecreatefrompng($file);
			break;
			case 'image/webp':
			$this->image = imagecreatefromwebp($file);
			break;
		}
		if(!$this->image) {
			throw new \Exception("Unsupported image: $file", self::ERR_UNSUPPORTED_FORMAT);
		}

    // Convert pallete images to true color images

	if(!function_exists('imagepalettetotruecolor'))
	{
		function imagepalettetotruecolor(&$src)
		{
			if(imageistruecolor($src))
			{
				return(true);
			}

			$dst = imagecreatetruecolor(imagesx($src), imagesy($src));

			imagecopy($dst, $src, 0, 0, 0, 0, imagesx($src), imagesy($src));
			imagedestroy($src);

			$src = $dst;

			return(true);
		}
	}

	imagepalettetotruecolor($this->image);

    // Load exif data from JPEG images
		if($this->mimeType === 'image/jpeg' && function_exists('exif_read_data')) {
			$this->exif = @exif_read_data($file);
		}

		return $this;
	}

  // Generates an image.
	private function generate($mimeType = null, $quality = 100) {
    // Format defaults to the original mime type
		$mimeType = $mimeType ?: $this->mimeType;

    // Enforce quality range
		$quality = self::keepWithin($quality, 0, 100);

    // Capture output
		ob_start();

    // Generate the image
		switch($mimeType) {
			case 'image/gif':
			imagesavealpha($this->image, true);
			imagegif($this->image, null);
			break;
			case 'image/jpeg':
			imageinterlace($this->image, true);
			imagejpeg($this->image, null, $quality);
			break;
			case 'image/png':
			imagesavealpha($this->image, true);
			imagepng($this->image, null, round(9 * $quality / 100));
			break;
			case 'image/webp':
      // Not all versions of PHP will have webp support enabled
			if(!function_exists('imagewebp')) {
				throw new \Exception(
					'WEBP support is not enabled in your version of PHP.',
					self::WE_N_E
					);
			}
			imagesavealpha($this->image, true);
			imagewebp($this->image, null, $quality);
			break;
			default:
			throw new \Exception('Unsupported format: ' . $mimeType, self::ERR_UNSUPPORTED_FORMAT);
		}

    // Stop capturing
		$data = ob_get_contents();
		ob_end_clean();

		return [
		'data' => $data,
		'mimeType' => $mimeType
		];
	}


  // Generates a data URI.
	public function toDataUri($mimeType = null, $quality = 100) {
		$image = $this->generate($mimeType, $quality);

		return 'data:' . $image['mimeType'] . ';base64,' . base64_encode($image['data']);
	}

  // Writes the image to a file.
	public function toFile($file = null, $mimeType = null, $quality = 100 , $name = null, $width = null , $height = null) {

		$image = $this->generate( $mimeType, $quality );

		$file = sanitize_text_field( $name );
		$filename = $width . $height . $file;

		$up_dir = wp_upload_dir();

		$deprecated = null;

		$time = current_time('mysql');

		add_filter( 'upload_dir', array( &$this, 'wnsu_upload_dir' ) );

		$new_up_dir = wp_upload_dir();

		if ( !file_exists( $new_up_dir['path'] . '/' . $filename ) ) {

			$upload = wp_upload_bits( $filename, $deprecated, $image['data'], $time );
			$upload = $upload['url'];

		} elseif ( file_exists( $new_up_dir['path'] . '/' . $filename ) && getimagesize( $new_up_dir['url'] . '/' . $filename ) != $image['data'] ) {

			wp_delete_file( $new_up_dir['path'] . '/' . $filename );
			$upload = wp_upload_bits( $filename, $deprecated, $image['data'], $time );
			$upload = $upload['url'];

		} elseif ( file_exists( $new_up_dir['path'] . '/' . $filename ) ) {

			$upload = $new_up_dir['url'] . '/' . $filename ;

		}

		remove_filter('upload_dir', array( &$this , 'wnsu_upload_dir' ) );

		return $upload;
	}

	public function wnsu_upload_dir( $upload ) {

		$upload['path'] = WNSH_PATH;

		$upload['url'] = WNSH_URL;

		$upload['subdir'] = WNSH_FOLDER;

		$upload['basedir'] = WNSH_BASEDIR;

		$upload['baseurl'] = WNSH_BASEURL;

		return $upload;

	}

  // Ensures a numeric value is always within the min and max range.
	private static function keepWithin($value, $min, $max) {
		if($value < $min) return $min;
		if($value > $max) return $max;
		return $value;
	}

  // Gets the image's current aspect ratio.
	public function getAspectRatio() {
		return $this->getWidth() / $this->getHeight();
	}

  // Gets the image's exif data.
	public function getExif() {
		return isset($this->exif) ? $this->exif : null;
	}

  // Gets the image's current height.
	public function getHeight() {
		return (int) imagesy($this->image);
	}

  // Gets the image's current height.
	public function getitemHeight($input) {
		return (int) imagesy($input);
	}

  // Gets the mime type of the loaded image.
	public function getMimeType() {
		return $this->mimeType;
	}

  // Gets the image's current orientation.
	public function getOrientation() {
		$width = $this->getWidth();
		$height = $this->getHeight();

		if($width > $height) return 'landscape';
		if($width < $height) return 'portrait';
		return 'square';
	}

  // Gets the image's current width.
	public function getWidth() {
		return (int) imagesx($this->image);
	}

  // Gets the image's current width.
	public function getitemWidth($input) {
		return (int) imagesx($input);
	}

	// gdimage crop for php 5.4
	public function mycrop($src, array $rect)
	{
		$dest = imagecreatetruecolor($rect['width'], $rect['height']);
		imagecopy(
			$dest,
			$src,
			0,
			0,
			$rect['x'],
			$rect['y'],
			$rect['width'],
			$rect['height']
			);

		return $dest;
	}

  // Crop the image.
	public function crop($x1, $y1, $x2, $y2) {
    // Keep crop within image dimensions
		$x1 = self::keepWithin($x1, 0, $this->getWidth());
		$x2 = self::keepWithin($x2, 0, $this->getWidth());
		$y1 = self::keepWithin($y1, 0, $this->getHeight());
		$y2 = self::keepWithin($y2, 0, $this->getHeight());

    // Crop it
		$this->image = $this->mycrop($this->image, [
			'x' => min($x1, $x2),
			'y' => min($y1, $y2),
			'width' => abs($x2 - $x1),
			'height' => abs($y2 - $y1)
			]);

		return $this;
	}

  // Proportionally resize the image to a specific height.
	public function fitToHeight($height) {
		return $this->resize(null, $height);
	}


  // Proportionally resize the image to a specific width.
	public function fitToWidth($width) {
		return $this->resize($width, null);
	}

  // Resize an image to the specified dimensions. If only one dimension is specified, the image will
  // be resized proportionally.
	public function resize($width = null, $height = null) {
    // No dimentions specified
		if(!$width && !$height) {
			return $this;
		}

    // Resize to width
		if($width && !$height) {
			$height = $width / $this->getAspectRatio();
		}

    // Resize to height
		if(!$width && $height) {
			$width = $height * $this->getAspectRatio();
		}

    // If the dimensions are the same, there's no need to resize
		if($this->getWidth() === $width && $this->getHeight() === $height) {
			return $this;
		}

		$newImage = imagecreatetruecolor($width, $height);
		$transparentColor = imagecolorallocatealpha($newImage, 0, 0, 0, 127);
		imagecolortransparent($newImage, $transparentColor);
		imagefill($newImage, 0, 0, $transparentColor);
		imagecopyresampled(
			$newImage,
			$this->image,
			0, 0, 0, 0,
			$width,
			$height,
			$this->getWidth(),
			$this->getHeight()
			);

    // Swap out the new image
		$this->image = $newImage;

		return $this;
	}

  // Creates a thumbnail image. This function attempts to get the image as close to the provided
	public function thumbnail($width, $height, $anchor = 'center') {
    // Determine aspect ratios
		$currentRatio = $this->getHeight() / $this->getWidth();
		$targetRatio = $height / $width;

    // Fit to height/width
		if($targetRatio > $currentRatio) {
			$this->resize(null, $height);
		} else {
			$this->resize($width, null);
		}

		switch($anchor) {
			case 'top':
			$x1 = floor(($this->getWidth() / 2) - ($width / 2));
			$x2 = $width + $x1;
			$y1 = 0;
			$y2 = $height;
			break;
			case 'bottom':
			$x1 = floor(($this->getWidth() / 2) - ($width / 2));
			$x2 = $width + $x1;
			$y1 = $this->getHeight() - $height;
			$y2 = $this->getHeight();
			break;
			case 'left':
			$x1 = 0;
			$x2 = $width;
			$y1 = floor(($this->getHeight() / 2) - ($height / 2));
			$y2 = $height + $y1;
			break;
			case 'right':
			$x1 = $this->getWidth() - $width;
			$x2 = $this->getWidth();
			$y1 = floor(($this->getHeight() / 2) - ($height / 2));
			$y2 = $height + $y1;
			break;
			case 'top left':
			$x1 = 0;
			$x2 = $width;
			$y1 = 0;
			$y2 = $height;
			break;
			case 'top right':
			$x1 = $this->getWidth() - $width;
			$x2 = $this->getWidth();
			$y1 = 0;
			$y2 = $height;
			break;
			case 'bottom left':
			$x1 = 0;
			$x2 = $width;
			$y1 = $this->getHeight() - $height;
			$y2 = $this->getHeight();
			break;
			case 'bottom right':
			$x1 = $this->getWidth() - $width;
			$x2 = $this->getWidth();
			$y1 = $this->getHeight() - $height;
			$y2 = $this->getHeight();
			break;
			default:
			$x1 = floor(($this->getWidth() / 2) - ($width / 2));
			$x2 = $width + $x1;
			$y1 = floor(($this->getHeight() / 2) - ($height / 2));
			$y2 = $height + $y1;
			break;
		}

    // Return the cropped thumbnail image
		return $this->crop($x1, $y1, $x2, $y2);
	}

}