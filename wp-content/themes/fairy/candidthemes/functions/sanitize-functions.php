<?php
/**
 * Check empty or null
 *
 * @since  Fairy 1.0.0
 *
 * @param string $str, string
 * @return boolean
 *
 */
if( !function_exists('fairy_is_null_or_empty') ){
    function fairy_is_null_or_empty( $str ){
        return ( !isset($str) || trim($str)==='' );
    }
}

/**
 * Checkbox sanitization callback example.
 *
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function fairy_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Select sanitization callback example.
 *
 * - Sanitization: select
 * - Control: select, radio
 *
 * Sanitization callback for 'select' and 'radio' type controls. This callback sanitizes `$input`
 * as a slug, and then validates `$input` against the choices defined for the control.
 *
 * @see sanitize_key()               https://developer.wordpress.org/reference/functions/sanitize_key/
 * @see $wp_customize->get_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/get_control/
 *
 * @param string               $input   Slug to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
 */
function fairy_sanitize_select( $input, $setting ) {
	
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

}

/**
 * Adds sanitization callback function: Number
 *  @since 1.0.0
 */
if (!function_exists('fairy_sanitize_number')) :
    function fairy_sanitize_number($input)
    {
        if (isset($input) && is_numeric($input)) {
            return $input;
        }
    }
endif;

/**
 * Number Range sanitization callback example.
 *
 * - Sanitization: number_range
 * - Control: number, tel
 *
 * Sanitization callback for 'number' or 'tel' type text inputs. This callback sanitizes
 * `$number` as an absolute integer within a defined min-max range.
 *
 * @see absint() https://developer.wordpress.org/reference/functions/absint/
 *
 * @param int                  $number  Number to check within the numeric range defined by the setting.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return int|string The number, if it is zero or greater and falls within the defined range; otherwise,
 *                    the setting default.
 */
function fairy_sanitize_number_range( $number, $setting ) {
	
	// Ensure input is an absolute integer.
	$number = absint( $number );
	
	// Get the input attributes associated with the setting.
	$atts = $setting->manager->get_control( $setting->id )->input_attrs;
	
	// Get minimum number in the range.
	$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );
	
	// Get maximum number in the range.
	$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );
	
	// Get step.
	$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );
	
	// If the number is within the valid range, return it; otherwise, return the default
	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}

/**
 * Number Range sanitization callback example.
 *
 * - Sanitization: number_range
 * - Control: number, tel
 *
 * Sanitization callback for 'number' or 'tel' type text inputs. This callback sanitizes
 * `$number` as an absolute integer within a defined min-max range.
 *
 * @see absint() https://developer.wordpress.org/reference/functions/absint/
 *
 * @param int                  $number  Number to check within the numeric range defined by the setting.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return int|string The number, if it is zero or greater and falls within the defined range; otherwise,
 *                    the setting default.
 */
function fairy_sanitize_number_range_decimal( $number, $setting ) {
    $atts = $setting->manager->get_control( $setting->id )->input_attrs;
    $number = floor($number / $atts['step']) * $atts['step'];
    $min = ( isset( $atts['min'] ) ? $atts['min'] : $number );
    $max = ( isset( $atts['max'] ) ? $atts['max'] : $number );
    $step = ( isset( $atts['step'] ) ? $atts['step'] : 0.001 );
    return ( $min <= $number && $number <= $max ) ? $number : $setting->default;
}

/**
 * Sanitizing the image callback example
 *
 * @see wp_check_filetype() https://developer.wordpress.org/reference/functions/wp_check_filetype/
 *
 * @since 1.0.0
 *
 * @param string $image Image filename.
 * @param $setting Setting instance.
 * @return string the image filename if the extension is allowed; otherwise, the setting default.
 *
 */
if ( !function_exists('fairy_sanitize_image') ) :
	function fairy_sanitize_image( $image, $setting ) {
		/*
         * Array of valid image file types.
         *
         * The array includes image mime types that are included in wp_get_mime_types()
         */
		$mimes = array(
			'jpg|jpeg|jpe' => 'image/jpeg',
			'gif'          => 'image/gif',
			'png'          => 'image/png',
			'bmp'          => 'image/bmp',
			'tif|tiff'     => 'image/tiff',
			'ico'          => 'image/x-icon'
		);
		// Return an array with file extension and mime_type.
		$file = wp_check_filetype( $image, $mimes );
		// If $image has a valid mime_type, return it; otherwise, return the default.
		return ( $file['ext'] ? $image : $setting->default );
	}
endif;

/**
 * Sanitizing the script
 *
 *
 * @since 1.0.0
 *
 * @param string $image Image filename.
 * @param $setting Setting instance.
 * @return script.
 *
 */
if ( !function_exists('fairy_sanitize_script') ) :
    function fairy_sanitize_script( $input, $setting ) {
        $allowed_html = array(
            'a' => array(
                'href' => array(),
                'title' => array()
            ),
            'br' => array(),
            'em' => array(),
            'strong' => array(),
            'script' => array()
        );
        return (wp_kses($input, $allowed_html));
    }
endif;

/**
 * Sanitize Multiple Category
 * =====================================
 */
if ( !function_exists('fairy_sanitize_multiple_category') ) :
    function fairy_sanitize_multiple_category( $values ) {
        $multi_values = !is_array( $values ) ? explode( ',', $values ) : $values;
        return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
    }
endif;


/**
 * Sanitize colors.
 *
 * @since 1.0.0
 * @param string $value The color.
 * @return string
 */
if( !function_exists('fairy_alpha_color_sanitization_callback') ) {
    function fairy_alpha_color_sanitization_callback($value)
    {
        // This pattern will check and match 3/6/8-character hex, rgb, rgba, hsl, & hsla colors.
        $pattern = '/^(\#[\da-f]{3}|\#[\da-f]{6}|\#[\da-f]{8}|rgba\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)(,\s*(0\.\d+|1))\)|hsla\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)(,\s*(0\.\d+|1))\)|rgb\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)|hsl\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)\))$/';
        \preg_match($pattern, $value, $matches);
        // Return the 1st match found.
        if (isset($matches[0])) {
            if (is_string($matches[0])) {
                return $matches[0];
            }
            if (is_array($matches[0]) && isset($matches[0][0])) {
                return $matches[0][0];
            }
        }
        // If no match was found, return an empty string.
        return '';
    }
}