<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if( !class_exists('Nbdesigner_Settings_General') ) {
    class Nbdesigner_Settings_General {
        public static function get_options() {
            return apply_filters('nbdesigner_general_settings', array(
                'general-product-designer' => array(
                    array(
                            'title' => __( 'Facebook App-ID', 'radykal' ),
                            'description' 		=> __( 'Enter a Facebook App-ID to enable Facebook photos in the images module.', 'radykal' ),
                            'id' 		=> 'fpd_facebook_app_id',
                            'css' 		=> 'width:500px;',
                            'default'	=> '',
                            'type' 		=> 'text'
                    ),                    
                ),
                'custom-images' => array(
                    array(
                            'title' => __( 'Save On Server', 'radykal' ),
                            'id' 		=> 'fpd_type_of_uploader',
                            'default'	=> 'php',
                            'type' 		=> 'radio',
                            'description'	=>  __( 'If your customers can add multiple or large images, then save images on server, otherwise you may inspect some issues when adding the customized product to the cart. The images will be saved in wp-content/uploads/fancy_products_uploads/ directory.', 'radykal' ),
                            'options'	=> array(
                                    'filereader' => __( 'No', 'radykal' ),
                                    'php' => __( 'Yes', 'radykal' )
                            ),
                            'relations' => array(
                                    'filereader' => array(
                                            'fpd_upload_designs_php_logged_in' => false,
                                    ),
                                    'php' => array(
                                            'fpd_upload_designs_php_logged_in' => true,
                                    )
                            )
                    ),

                    array(
                            'title' 	=> __( 'Login Required', 'radykal' ),
                            'description'	 	=> __( 'Users must create an account in your Wordpress site and need to be logged-in to upload images.', 'radykal' ),
                            'id' 		=> 'fpd_upload_designs_php_logged_in',
                            'default'	=> 'no',
                            'type' 		=> 'checkbox'
                    ),                    
                )
            ));
        }
    }
}