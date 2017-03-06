<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if( !class_exists('Nbdesigner_Settings_Colors') ) {    
    class Nbdesigner_Settings_Colors{
        public static function get_options() {
            return apply_filters('nbdesigner_colors_settings', array(
                'color-setting' => array(
                    array(
                        'title' => __( 'Show all color', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_show_all_color',
                        'description' 	=> __('Choose "Yes" that will show all color or "No" that will show color palette with list predefined colors.', NBDESIGNER_TEXTDOMAIN),
                        'default'	=> 'yes',
                        'type' 		=> 'radio',
                        'options'   => array(
                            'yes' => __('Yes', NBDESIGNER_TEXTDOMAIN),
                            'no' => __('No', NBDESIGNER_TEXTDOMAIN)
                        )                        
                    ),                    
                    array(
                        'title' => __('Hexadecimal Color Names', NBDESIGNER_TEXTDOMAIN),
                        'description' => __('Color palette, <a href="https://www.w3schools.com/colors/colors_names.asp" target="_blank">color name reference</a>.', NBDESIGNER_TEXTDOMAIN),
                        'id' => 'nbdesigner_hex_names',
                        'css' => 'width:500px;',
                        'default' => '',
                        'type' => 'values-group',
                        'options' => array(
                            'hex_key' => __('Hexadecimal Color', NBDESIGNER_TEXTDOMAIN),
                            'name' => __('Name', NBDESIGNER_TEXTDOMAIN)
                        ),
                        'prefixes' => array(
                                'hex_key' => '',
                                'name' => ''
                        ),                        
                        'regexs' => array(
                            'name' => '^[^, ]+$'
                        )
                    ),
                )
            ));
        }
    }
}