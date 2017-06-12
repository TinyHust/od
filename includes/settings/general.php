<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if( !class_exists('Nbdesigner_Settings_General') ) {
    class Nbdesigner_Settings_General {
        public static function get_options() {
            return apply_filters('nbdesigner_general_settings', array(
                'general-settings' => array(      
                    array(
                        'title' => __('Position of button design', 'web-to-print-online-designer'),
                        'id' => 'nbdesigner_position_button_product_detail',
                        'default' => '1',
                        'description' => __( 'The position of the product button designer in the product page', 'web-to-print-online-designer'),
                        'type' => 'radio',
                        'options' => array(
                            '1' => __('Before add to cart button and after variantions option', 'web-to-print-online-designer'),
                            '2' => __('Before variantions option', 'web-to-print-online-designer'),
                            '3' => __('After add to cart button', 'web-to-print-online-designer'),
                            '4' => __('Custom Hook, <code>echo do_shortcode( \'[nbdesigner_button id="Product ID"]\' );</code>', 'web-to-print-online-designer')
                        )
                    ),  
                    array(
                        'title' => __('Position of button in the catalog', 'web-to-print-online-designer'),
                        'id' => 'nbdesigner_position_button_in_catalog',
                        'default' => '1',
                        'description' => __( 'The position of the button in the catalog listing.', 'web-to-print-online-designer'),
                        'type' => 'radio',
                        'options' => array(
                            '1' => __('Replace Add-to-Cart button', 'web-to-print-online-designer'),
                            '2' => __('End of catalog item', 'web-to-print-online-designer'),
                            '3' => __('Do not show', 'web-to-print-online-designer')
                        )
                    ),                    
                    array(
                        'title' => __( 'Preview thumbnail width', 'web-to-print-online-designer'),
                        'id' 		=> 'nbdesigner_thumbnail_width',
                        'css'         => 'width: 65px',
                        'default'	=> '100',
                        'subfix'        => ' px',
                        'type' 		=> 'number'
                    ),
                    array(
                        'title' => __( 'Preview thumbnail height', 'web-to-print-online-designer'),
                        'id' 		=> 'nbdesigner_thumbnail_height',
                        'css'         => 'width: 65px',
                        'default'	=> '100',
                        'subfix'        => ' px',
                        'type' 		=> 'number'
                    ),                    
                    array(
                        'title' => __( 'Thumbnail quality', 'web-to-print-online-designer'),
                        'id' 		=> 'nbdesigner_thumbnail_quality',
                        'description' 	=> __('Quality of the generated thumbnails between 0 - 100', 'web-to-print-online-designer'),
                        'css'         => 'width: 65px',
                        'default'	=> '60',
                        'subfix'        => ' %',
                        'type' 		=> 'number'
                    ),
                    array(
                        'title' => __( 'Default output DPI', 'web-to-print-online-designer'),
                        'id' 		=> 'nbdesigner_default_dpi',
                        'css'         => 'width: 65px',
                        'default'	=> '150',
                        'type' 		=> 'number'
                    ),                    
                    array(
                        'title' => __( 'Show customer design in cart', 'web-to-print-online-designer'),
                        'id' 		=> 'nbdesigner_show_in_cart',
                        'description' 	=> __('Show the thumbnail of the customized product in the cart.', 'web-to-print-online-designer'),
                        'default'	=> 'yes',
                        'type' 		=> 'radio',
                        'options'   => array(
                            'yes' => __('Yes', 'web-to-print-online-designer'),
                            'no' => __('No', 'web-to-print-online-designer')
                        )                        
                    ),
                    array(
                        'title' => __( 'Show customer design in order', 'web-to-print-online-designer'),
                        'id' 		=> 'nbdesigner_show_in_order',
                        'description' 	=> __('Show the thumbnail of the customized product in the order.', 'web-to-print-online-designer'),
                        'default'	=> 'yes',
                        'type' 		=> 'radio',
                        'options'   => array(
                            'yes' => __('Yes', 'web-to-print-online-designer'),
                            'no' => __('No', 'web-to-print-online-designer')
                        )                        
                    ),
                    array(
                        'title' => __( 'Dimensions Unit', 'web-to-print-online-designer'),
                        'id' 		=> 'nbdesigner_dimensions_unit',
                        'description' 	=> __('This controls what unit you will define lengths in.', 'web-to-print-online-designer'),
                        'default'	=> 'cm',
                        'type' 		=> 'radio',
                        'options'   => array(
                            'cm' => __('cm', 'web-to-print-online-designer'),
                            'in' => __('inch', 'web-to-print-online-designer'),
                            'mm' => __('mm', 'web-to-print-online-designer')
                        )                        
                    ),         
                    array(
                        'title' => __('Hide On Smartphones', 'web-to-print-online-designer'),
                        'description' => __('Hide product designer on smartphones and display an information instead.', 'web-to-print-online-designer'),
                        'id' => 'nbdesigner_disable_on_smartphones',
                        'default' => 'no',
                        'type' => 'radio',
                        'options' => array(
                            'yes' => __('Yes', 'web-to-print-online-designer'),
                            'no' => __('No', 'web-to-print-online-designer'),
                        )
                    ),
                    array(
                        'title' => __('Save latest design', 'web-to-print-online-designer'),
                        'description' => __('Save customer latest design. When they come back design product, they latest design will be loaded.', 'web-to-print-online-designer'),
                        'id' => 'nbdesigner_save_latest_design',
                        'default' => 'yes',
                        'type' => 'radio',
                        'options' => array(
                            'yes' => __('Yes', 'web-to-print-online-designer'),
                            'no' => __('No', 'web-to-print-online-designer'),
                        )
                    )                    
                ),
                'admin-notifications' => array(
                    array(
                        'title' => __( 'Admin notifications', 'web-to-print-online-designer'),
                        'id' 		=> 'nbdesigner_notifications',
                        'description' 	=> __('Send a message to the admin when customer design saved / changed.', 'web-to-print-online-designer'),
                        'default'	=> 'yes',
                        'type' 		=> 'radio',
                        'options'   => array(
                            'yes' => __('Yes', 'web-to-print-online-designer'),
                            'no' => __('No', 'web-to-print-online-designer')
                        )                        
                    ),
                    array(
                        'title' => __( 'Recurrence', 'web-to-print-online-designer'),
                        'id' 		=> 'nbdesigner_notifications_recurrence',
                        'description' 	=> __('Choose how many times you want to receive an e-mail.', 'web-to-print-online-designer'),
                        'default'	=> 'hourly',
                        'type' 		=> 'select',
                        'options'   => array(
                            'hourly' => __('Hourly', 'web-to-print-online-designer'),
                            'twicedaily' => __('Twice a day', 'web-to-print-online-designer'),
                            'daily' => __('Daily', 'web-to-print-online-designer')
                        )
                    ),   
                    array(
                        'title' => __( 'Recipients', 'web-to-print-online-designer'),
                        'description' 		=> __( 'Enter recipients (comma separated) for this email. Defaults to ', 'web-to-print-online-designer').'<code>'.get_option('admin_email').'</code>',
                        'id' 		=> 'nbdesigner_notifications_emails',
                        'class'         => 'regular-text',
                        'default'	=> '',
                        'type' 		=> 'text',
                        'placeholder'   => 'Enter your email'
                    ),                      
                ),
                'application'       => array(
                    array(
                        'title' => __( 'Facebook App-ID', 'web-to-print-online-designer'),
                        'description' 		=> __( 'Enter a Facebook App-ID to allow customer use Facebook photos.', 'web-to-print-online-designer').' <a href="#" id="nbdesigner_show_helper">'.__("Where do I get this info?", 'web-to-print-online-designer').'</a>',
                        'id' 		=> 'nbdesigner_facebook_app_id',
                        'class'         => 'regular-text',
                        'default'	=> '',
                        'type' 		=> 'text'
                    ), 
                    array(
                        'title' => __( 'Instagram App-ID', 'web-to-print-online-designer'),
                        'description' 		=> __( 'Enter a Instagram App-ID to allow customer use Instagram photos.', 'web-to-print-online-designer') . '<br /> <b>Redirect URI: '.NBDESIGNER_PLUGIN_URL.'includes/auth-instagram.php</b>',
                        'id' 		=> 'nbdesigner_instagram_app_id',
                        'class'         => 'regular-text',
                        'default'	=> '',
                        'type' 		=> 'text'
                    ), 
                    array(
                        'title' => __( 'Dropbox App-ID', 'web-to-print-online-designer'),
                        'description' 		=> __( 'Enter a Dropbox App-ID to allow customer use Dropbox photos.', 'web-to-print-online-designer') . '<br /> <b>Redirect URI: '.NBDESIGNER_PLUGIN_URL.'includes/auth-dropbox.php</b>',
                        'id' 		=> 'nbdesigner_dropbox_app_id',
                        'class'         => 'regular-text',
                        'default'	=> '',
                        'type' 		=> 'text'
                    ),                     
                    array(
                        'title' => __( 'Printful key', 'web-to-print-online-designer'),
                        'description' 		=> __( 'Enter a Printful key to sync with Printful service.', 'web-to-print-online-designer'),
                        'id' 		=> 'nbdesigner_printful_key',
                        'class'         => 'regular-text',
                        'default'	=> '',
                        'type' 		=> 'text'
                    )                    
                )
            ));
        }
    }
}