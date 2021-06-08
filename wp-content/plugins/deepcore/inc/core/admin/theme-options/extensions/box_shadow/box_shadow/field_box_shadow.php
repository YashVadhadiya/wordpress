<?php
/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 * @author      Muhammad Ashfaq
 * @version     1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Don't duplicate me!
if (!class_exists('ReduxFramework_box_shadow')) {

    /**
     * Main ReduxFramework_box_shadow class
     *
     * @since       1.0.0
     */
    class ReduxFramework_box_shadow extends ReduxFramework_extension_box_shadow
    {

        /**
         * Field Constructor.
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function __construct($field = array(), $value = '', $parent = null){

            $this->parent = $parent;
            $this->field  = $field;
            $this->value  = $value;

            if (empty($this->extension_dir)) {
                $this->extension_dir = trailingslashit(str_replace('\\', '/', dirname(__FILE__)));
                $this->extension_url = site_url(str_replace(trailingslashit(str_replace('\\', '/', ABSPATH)), '', $this->extension_dir));
            }

            // Set default args for this field to avoid bad indexes. Change this to anything you use.
            $defaults = array(
                'options'          => array(),
                'stylesheet'       => '',
                'output'           => true,
                'enqueue'          => true,
                'enqueue_frontend' => true,
            );
            $this->field = wp_parse_args($this->field, $defaults);


        }




        /**
         * stripAlphas. Returns Numeric values only.
         */
        private function stripAlphas($s){
            return preg_replace("/[^0-9,.]/", "", $s);
        }




        /**
         * getRGBA.  Returns formatted color rgba.
         */
        private function getRGBA($color, $opacity = false){

            $default = 'rgb(0,0,0,0)';

            if (empty($color))
                return $default;

            if ($color[0] == '#')
                $color = substr($color, 1);

            if (strlen($color) == 6){
                $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
            }
            elseif (strlen($color) == 3){
                $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
            }
            else{
                return $default;
            }

            $rgb = array_map('hexdec', $hex);

            if ($opacity) {
                if (abs($opacity) > 1){
                    $opacity = 1.0;
                }
                $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
            }
            else {
                $output = 'rgb(' . implode(",", $rgb) . ')';
            }

            return $output;

        }

        /**
         * Field Render Function.
         * Takes the vars and outputs the HTML for the field in the settings
         */
        public function render()
        {
            $defaults = array(
                'units'          => true,
                'horizontal'     => true,
                'vertical'       => true,
                'blur'           => true,
                'spread'         => true,
                'shadow-color'   => true,
                'opacity'        => false,
                'rgba'           => false,
                'shadow-type'    => true,
                'units_extended' => false,
                'display_units'  => true,
                'preview'       => true,
            );
            $this->field = wp_parse_args($this->field, $defaults);



            // Set default values
            $defaults = array(
                'horizontal'   => '0px',
                'vertical'     => '0px',
                'blur'         => '0px',
                'spread'       => '0px',
                'shadow-color' => 'transparent',
                'opacity'      => '1',
                'rgba'         => '',
                'shadow-type'  => 'outside',
                'units'        => 'px',
            );
            $this->value = wp_parse_args($this->value, $defaults);



            $value = array(
                'horizontal'    => isset( $this->value['horizontal'] )      ? filter_var( $this->value['horizontal'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ) : filter_var( $this->value['horizontal'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ),
                'vertical'      => isset( $this->value['vertical'] )        ? filter_var( $this->value['vertical'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ) : filter_var( $this->value['vertical'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ),
                'blur'          => isset( $this->value['blur'] )            ? filter_var( $this->value['blur'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ) : filter_var( $this->value['blur'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ),
                'spread'        => isset( $this->value['spread'] )          ? filter_var( $this->value['spread'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ) : filter_var( $this->value['spread'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ),
                'shadow-color'         => isset( $this->value['shadow-color'] )    ? $this->value['shadow-color'] : $this->value['color'],
                'shadow-type'         => isset( $this->value['shadow-type'] )    ? $this->value['shadow-type'] : $this->value['type'],
                'opacity'      => isset($this->value['opacity']) ? $this->stripAlphas($this->value['opacity']) : $this->stripAlphas($this->value['opacity']),
                'rgba'         => $this->getRGBA(isset($this->value['shadow-color']) ? $this->value['shadow-color'] : $this->value['shadow-color'], isset($this->value['opacity']) ? $this->stripAlphas($this->value['opacity']) : $this->stripAlphas($this->value['opacity'])),
            );



            /*
             * Since units field could be an array, string value or bool (to hide the unit field)
             * we need to separate our functions to avoid those nasty PHP index notices!
             */
            // if field units has a value and IS an array, then evaluate as needed.
            if (isset($this->field['units']) && !is_array($this->field['units'])) {

                //if units fields has a value but units value does not then make units value the field value
                if (isset($this->field['units']) && !isset($this->value['units']) || $this->field['units'] == false) {
                    $this->value['units'] = $this->field['units'];

                    // If units field does NOT have a value and units value does NOT have a value, set both to blank (default?)
                } else if (!isset($this->field['units']) && !isset($this->value['units'])) {
                    $this->field['units'] = 'px';
                    $this->value['units'] = 'px';

                    // If units field has NO value but units value does, then set unit field to value field
                } else if (!isset($this->field['units']) && isset($this->value['units'])) {
                    $this->field['units'] = $this->value['units'];

                    // if unit value is set and unit value doesn't equal unit field (coz who knows why)
                    // then set unit value to unit field
                } elseif (isset($this->value['units']) && $this->value['units'] !== $this->field['units']) {
                    $this->value['units'] = $this->field['units'];
                }

                // do stuff based on unit field NOT set as an array
            } elseif (isset($this->field['units']) && is_array($this->field['units'])) {
                // nothing to do here, but I'm leaving the construct just in case I have to debug this again.
            }



            if (isset($this->field['units'])) {
                $value['units'] = $this->value['units'];
            }



            $this->value = $value;




            // HTML output goes here
            echo '<div id="box-shadow" class="redux-shadow-container" data-id="' . $this->field['id'] . '">';

            // select2 args
            if (isset($this->field['select2'])) {
                // if there are any let's pass them to js
                $select2_params = json_encode($this->field['select2']);
                $select2_params = htmlspecialchars($select2_params, ENT_QUOTES);

                echo '<input type="hidden" class="select2_params" value="' . $select2_params . '">';
            }
            echo '<input type="hidden" class="field-units" value="' . $this->value['units'] . '">';



            /**
             * Horizontal
             * */
            if ($this->field['horizontal'] === true) {
                if (!empty($this->value['horizontal']) && strpos($this->value['horizontal'], $this->value['units']) === false) {
                    $this->value['horizontal'] = filter_var($this->value['horizontal'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    if ($this->field['units'] !== false) {
                        $this->value['horizontal'] .= $this->value['units'];
                    }
                }

                echo '<div class="field-shadow-input input-prepend">';
                echo '<label>' . __('Offset X', 'redux-framework') . '</label>';
                echo '<span class="add-on"><i class="el el-resize-horizontal icon-large"></i></span>';
                echo '<input type="text" class="redux-shadow-input redux-shadow-horizontal mini ' . $this->field['class'] . '" placeholder="' . __('X', 'redux-framework') . '" rel="' . $this->field['id'] . '-horizontal" value="' . filter_var($this->value['horizontal'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) . '">';
                echo '<input class="redux-shadow-value shadow-offsetx-value" data-id="' . $this->field['id'] . '" type="hidden" id="' . $this->field['id'] . '-horizontal" name="' . $this->field['name'] . $this->field['name_suffix'] . '[horizontal]' . '" value="' . $this->value['horizontal'] . '"></div>';
            }



            /**
             * Vertical
             * */
            if ($this->field['vertical'] === true) {
                if (!empty($this->value['vertical']) && strpos($this->value['vertical'], $this->value['units']) === false) {
                    $this->value['vertical'] = filter_var($this->value['vertical'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    if ($this->field['units'] !== false) {
                        $this->value['vertical'] .= $this->value['units'];
                    }
                }

                echo '<div class="field-shadow-input input-prepend">';
                echo '<label>' . __('Offset Y', 'redux-framework') . '</label>';
                echo '<span class="add-on"><i class="el el-resize-vertical icon-large"></i></span>';
                echo '<input type="text" class="redux-shadow-input redux-shadow-vertical mini ' . $this->field['class'] . '" placeholder="' . __('Y', 'redux-framework') . '" rel="' . $this->field['id'] . '-vertical" value="' . filter_var($this->value['vertical'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) . '">';
                echo '<input class="redux-shadow-value shadow-offsety-value" data-id="' . $this->field['id'] . '" type="hidden" id="' . $this->field['id'] . '-vertical" name="' . $this->field['name'] . $this->field['name_suffix'] . '[vertical]' . '" value="' . $this->value['vertical'] . '"></div>';
            }



            /**
             * Blur
             * */
            if ($this->field['blur'] === true) {
                if (!empty($this->value['blur']) && strpos($this->value['blur'], $this->value['units']) === false) {
                    $this->value['blur'] = filter_var($this->value['blur'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    if ($this->field['units'] !== false) {
                        $this->value['blur'] = abs($this->value['blur']) . $this->value['units'];
                    }
                }

                echo '<div class="field-shadow-input input-prepend">';
                echo '<label>' . __('Blur Radius', 'redux-framework') . '</label>';
                echo '<span class="add-on"><i class="el el-adjust icon-large"></i></span>';
                echo '<input type="text" class="redux-shadow-input redux-shadow-blur mini ' . $this->field['class'] . '" placeholder="' . __('Blur', 'redux-framework') . '" rel="' . $this->field['id'] . '-blur" value="' . filter_var($this->value['blur'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) . '">';
                echo '<input class="redux-shadow-value shadow-blur-value" data-id="' . $this->field['id'] . '" type="hidden" id="' . $this->field['id'] . '-blur" name="' . $this->field['name'] . $this->field['name_suffix'] . '[blur]' . '" value="' . $this->value['blur'] . '"></div>';
            }



            /**
             * Spread
             * */
            if ($this->field['spread'] === true) {
                if (!empty($this->value['spread']) && strpos($this->value['spread'], $this->value['units']) === false) {
                    $this->value['spread'] = filter_var($this->value['spread'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    if ($this->field['units'] !== false) {
                        $this->value['spread'] .= $this->value['units'];
                    }
                }

                echo '<div class="field-shadow-input input-prepend">';
                echo '<label>' . __('Spread Radius', 'redux-framework') . '</label>';
                echo '<span class="add-on"><i class="el el-idea icon-large"></i></span>';
                echo '<input type="text" class="redux-shadow-input redux-shadow-spread mini ' . $this->field['class'] . '" placeholder="' . __('Spread', 'redux-framework') . '" rel="' . $this->field['id'] . '-spread" value="' . filter_var($this->value['spread'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) . '">';
                echo '<input class="redux-shadow-value shadow-spread-value" data-id="' . $this->field['id'] . '" type="hidden" id="' . $this->field['id'] . '-spread" name="' . $this->field['name'] . $this->field['name_suffix'] . '[spread]' . '" value="' . $this->value['spread'] . '"></div>';
            }



            /**
             * Opacity
             * */
            if ($this->field['opacity'] === true) {

                if (!empty($this->value['opacity'])) {
                    $this->value['opacity'] = abs ( $this->stripAlphas($this->value['opacity']) );
                    if ($this->value['opacity'] > 1) {
                        $this->value['opacity'] = '1';
                    }
                }

                echo '<div class="field-shadow-input input-prepend">';
                echo '<label>' . __('Opacity .1 - 1', 'redux-framework') . '</label>';
                echo '<span class="add-on"><i class="el el-idea icon-large"></i></span>';
                echo '<input type="text" class="redux-shadow-input redux-shadow-opacity mini ' . $this->field['class'] . '" placeholder="' . __('Opacity', 'redux-framework') . '" rel="' . $this->field['id'] . '-opacity" value="' . filter_var($this->value['opacity'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) . '">';
                echo '<input class="redux-shadow-value shadow-opacity-value" data-id="' . $this->field['id'] . '" type="hidden" id="' . $this->field['id'] . '-opacity" name="' . $this->field['name'] . $this->field['name_suffix'] . '[opacity]' . '" value="' . $this->value['opacity'] . '"></div>';
            }



            /**
             * Units
             * */
            // If units field is set and units field NOT false then
            // fill out the options object and show it, otherwise it's hidden
            // and the default units value will apply.
            if (isset($this->field['units']) && $this->field['units'] !== false) {
                echo '<div class="shadow-units" original-title="' . __('Units', 'redux-framework') . '">';
                echo '<label>' . __('Units', 'redux-framework') . '</label>';
                echo '<select data-id="' . $this->field['id'] . '" data-placeholder="' . __('Units', 'redux-framework') . '" class="redux-shadow redux-shadow-units select ' . $this->field['class'] . '" original-title="' . __('Units', 'redux-framework') . '" name="' . $this->field['name'] . $this->field['name_suffix'] . '[units]' . '">';

                //  Extended units, show 'em all
                if ($this->field['units_extended']) {
                    $testUnits = array('px', 'em', 'rem', '%', 'in', 'cm', 'mm', 'ex', 'pt', 'pc');
                } else {
                    $testUnits = array('px', 'em', 'rem', '%');
                }

                if (in_array($this->field['units'], $testUnits)) {
                    echo '<option value="' . $this->field['units'] . '" selected="selected">' . $this->field['units'] . '</option>';
                } else {
                    foreach ($testUnits as $aUnit) {
                        echo '<option value="' . $aUnit . '" ' . selected($this->value['units'], $aUnit, false) . '>' . $aUnit . '</option>';
                    }
                }
                echo '</select></div>';
            }



            /**
             * Color
             * */
            if ($this->field['shadow-color'] === true) {

                if (isset($this->value['shadow-color']) && empty($this->value['shadow-color'])) {
                    $this->value['shadow-color'] = $this->value['shadow-color'];
                }
                echo '<div class="shadow-color" original-title="' . __('Shadow Color', 'redux-framework') . '">';
                echo '<label>' . __('Shadow Color', 'redux-framework') . '</label>';
                echo '<input data-id="' . $this->field['id'] . '" name="' . $this->field['name'] . $this->field['name_suffix'] . '[shadow-color]" id="' . $this->field['id'] . '-color" class="redux-color redux-original-color redux-background-input redux-color-init ' . $this->field['class'] . '"  type="text" value="' . $this->value['shadow-color'] . '"  data-default-color="' . (isset($this->field['default']['shadow-color']) ? $this->field['default']['shadow-color'] : "") . '" />';
                echo '<input class="redux-shadow-value shadow-color-value" data-id="' . $this->field['id'] . '" type="hidden" id="' . $this->field['id'] . '-color" name="' . $this->field['name'] . $this->field['name_suffix'] . '[shadow-color]' . '" value="' . $this->value['shadow-color'] . '">';
                echo '</div>';

            }



            /**
             * Shadow Type
             * */
            if ($this->field['shadow-type'] === true) {
                $array = array(
                    'outside' => 'Outside',
                    'inset'   => 'Inset',
                );
                echo '<div class="shadow-type" original-title="' . __('Shadow Type', 'redux-framework') . '">';
                echo '<label>' . __('Shadow Type', 'redux-framework') . '</label>';
                echo '<select id="' . $this->field['id'] . '-shadow-type-select" data-placeholder="' . __('Shadow Type', 'redux-framework') . '" name="' . $this->field['name'] . $this->field['name_suffix'] . '[shadow-type]" class="redux-select-item redux-background-input redux-shadow-type ' . $this->field['class'] . '">';
                echo '<option></option>';

                foreach ($array as $k => $v) {
                    echo '<option value="' . $k . '"' . selected($this->value['shadow-type'], $k, false) . '>' . $v . '</option>';
                }
                echo '</select></div>';
            }



            /**
             * RGBA hidden output
             * */
            if (!empty($this->field['shadow-color']) && !empty($this->field['opacity'])) {
                $this->value['rgba'] = $this->getRGBA($this->value['shadow-color'], $this->value['opacity']);
            }
            echo '<input class="redux-rgba-value shadow-rgba-value" data-id="' . $this->field['id'] . '" type="hidden" id="' . $this->field['id'] . '-rgba" name="' . $this->field['name'] . $this->field['name_suffix'] . '[rgba]' . '" value="' . $this->value['rgba'] . '"></div>';




            /**
             * RGBA hidden output
             * */
            if ($this->field['preview'] === true) {

                echo '<div class="clearfix"></div><div class="shadow-previewer" original-title="' . __('Shadow Preview', 'redux-framework') . '">';


                echo '<div class="shadow-previewer-inner"></div>';






                echo '</div>';
            }



            echo "</div>";
        }

        /**
         * Enqueue Function.
         *
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         */
        public function enqueue()
        {

            $extension = ReduxFramework_extension_box_shadow::getInstance();

            wp_enqueue_script(
                'redux-field-icon-select-js',
                $this->extension_url . 'field_box_shadow.js',
                array('jquery'),
                time(),
                true
            );

            if (!wp_style_is('select2-css')) {
                wp_enqueue_style('select2-css');
            }

            wp_enqueue_style('redux-color-picker-css');
            wp_enqueue_style(
                'redux-field-icon-select-css',
                $this->extension_url . 'field_box_shadow.css',
                time(),
                true
            );

        }

        /**
         * Output Function.
         *
         * Used to enqueue to the front-end
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function output() {

            if ( ! empty ( $this->value ) ){

                $horizontal     = isset( $this->value['horizontal'] )       ? $this->value['horizontal']    : '0px';
                $vertical       = isset( $this->value['vertical'] )         ? $this->value['vertical']      : '0px';
                $blur           = isset( $this->value['blur'] )             ? $this->value['blur']          : '0px';
                $spread         = isset( $this->value['spread'] )           ? $this->value['spread']        : '0px';
                $shadow_color   = isset( $this->value['shadow-color'] )     ? $this->value['shadow-color']  : 'transparent';
                $opacity        = isset( $this->value['opacity'] )          ? $this->value['opacity']       : '1';
                $shadow_type    = isset( $this->value['shadow-type'] )      ? $this->value['shadow-type']   : '';



                //unset shadow type if it is not Inset
                if ( !empty ( $shadow_type ) && $shadow_type != 'inset' ){
                    $shadow_type = '';
                }


                //Get RGBA
                if ( !empty ( $shadow_color ) && $shadow_color != 'transparent' ){
                    $shadow_color = $this->getRGBA ( $shadow_color, $opacity );
                }


                //Build Style element
                $style  = '-moz-box-shadow:'    .$shadow_type.' '.$horizontal.' '.$vertical.' '.$blur.' '.$spread.' '.$shadow_color.';';
                $style .= '-webkit-box-shadow:' .$shadow_type.' '.$horizontal.' '.$vertical.' '.$blur.' '.$spread.' '.$shadow_color.';';
                $style .= '-ms-box-shadow:'     .$shadow_type.' '.$horizontal.' '.$vertical.' '.$blur.' '.$spread.' '.$shadow_color.';';
                $style .= '-o-box-shadow:'      .$shadow_type.' '.$horizontal.' '.$vertical.' '.$blur.' '.$spread.' '.$shadow_color.';';
                $style .= 'box-shadow:'         .$shadow_type.' '.$horizontal.' '.$vertical.' '.$blur.' '.$spread.' '.$shadow_color.';';

                if ( ! empty( $this->field['output'] ) && is_array( $this->field['output'] ) ) {
                    if (!empty($style)) {
                        $keys = implode( ",", $this->field['output'] );
                        $this->parent->outputCSS .= $keys . "{" . $style . '}';
                    }
                }

                if ( ! empty( $this->field['compiler'] ) && is_array( $this->field['compiler'] ) ) {
                    if (!empty($style)) {
                        $keys = implode( ",", $this->field['compiler'] );
                        $this->parent->compilerCSS .= $keys . "{" . $style . '}';
                    }
                }
            }

        }

    }
}