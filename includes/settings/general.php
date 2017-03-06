<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if( !class_exists('Nbdesigner_Settings_General') ) {
    class Nbdesigner_Settings_General {
        public static function get_options() {
            return apply_filters('nbdesigner_general_settings', array(
                'general-settings' => array(
                    array(
                        'title' => __( 'Label of button design', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_button_label',
                        'class'         => 'regular-text',
                        'default'	=> 'Start Design',
                        'type' 		=> 'text'
                    ),       
                    array(
                        'title' => __('Position of button design', NBDESIGNER_TEXTDOMAIN),
                        'id' => 'nbdesigner_position_button_product_detail',
                        'default' => '1',
                        'description' => __( 'The position of the product button designer in the product page', NBDESIGNER_TEXTDOMAIN ),
                        'type' => 'radio',
                        'options' => array(
                            '1' => __('Before add to cart button and after variantions option', NBDESIGNER_TEXTDOMAIN),
                            '2' => __('Before variantions option', NBDESIGNER_TEXTDOMAIN),
                            '3' => __('After add to cart button', NBDESIGNER_TEXTDOMAIN),
                            '4' => __('Custom Hook, <code>echo do_shortcode( \'[nbdesigner_button id="Product ID"]\' );</code>', NBDESIGNER_TEXTDOMAIN)
                        )
                    ),  
                    array(
                        'title' => __('Position of button in the catalog', NBDESIGNER_TEXTDOMAIN),
                        'id' => 'nbdesigner_position_button_in_catalog',
                        'default' => '1',
                        'description' => __( 'The position of the button in the catalog listing.', NBDESIGNER_TEXTDOMAIN ),
                        'type' => 'radio',
                        'options' => array(
                            '1' => __('Replace Add-to-Cart button', NBDESIGNER_TEXTDOMAIN),
                            '2' => __('End of catalog item', NBDESIGNER_TEXTDOMAIN),
                            '3' => __('Don\'t show', NBDESIGNER_TEXTDOMAIN)
                        )
                    ),                    
                    array(
                        'title' => __( 'Preview thumbnail width', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_thumbnail_width',
                        'css'         => 'width: 65px',
                        'default'	=> '100',
                        'subfix'        => ' px',
                        'type' 		=> 'number'
                    ),
                    array(
                        'title' => __( 'Preview thumbnail height', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_thumbnail_height',
                        'css'         => 'width: 65px',
                        'default'	=> '100',
                        'subfix'        => ' px',
                        'type' 		=> 'number'
                    ),                    
                    array(
                        'title' => __( 'Thumbnail quality', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_thumbnail_quality',
                        'description' 	=> __('Quality of the generated thumbnails between 0 - 100', NBDESIGNER_TEXTDOMAIN),
                        'css'         => 'width: 65px',
                        'default'	=> '60',
                        'subfix'        => ' %',
                        'type' 		=> 'number'
                    ),
                    array(
                        'title' => __( 'Default output DPI', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_default_dpi',
                        'css'         => 'width: 65px',
                        'default'	=> '150',
                        'type' 		=> 'number'
                    ),                    
                    array(
                        'title' => __( 'Show customer design in cart', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_show_in_cart',
                        'description' 	=> __('Show the thumbnail of the customized product in the cart.', NBDESIGNER_TEXTDOMAIN),
                        'default'	=> 'yes',
                        'type' 		=> 'radio',
                        'options'   => array(
                            'yes' => __('Yes', NBDESIGNER_TEXTDOMAIN),
                            'no' => __('No', NBDESIGNER_TEXTDOMAIN)
                        )                        
                    ),
                    array(
                        'title' => __( 'Show customer design in order', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_show_in_order',
                        'description' 	=> __('Show the thumbnail of the customized product in the order.', NBDESIGNER_TEXTDOMAIN),
                        'default'	=> 'yes',
                        'type' 		=> 'radio',
                        'options'   => array(
                            'yes' => __('Yes', NBDESIGNER_TEXTDOMAIN),
                            'no' => __('No', NBDESIGNER_TEXTDOMAIN)
                        )                        
                    ),
                    array(
                        'title' => __( 'Dimensions Unit', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_dimensions_unit',
                        'description' 	=> __('This conttols what unit you will define lengths in.', NBDESIGNER_TEXTDOMAIN),
                        'default'	=> 'cm',
                        'type' 		=> 'radio',
                        'options'   => array(
                            'cm' => __('cm', NBDESIGNER_TEXTDOMAIN),
                            'in' => __('inch', NBDESIGNER_TEXTDOMAIN),
                            'mm' => __('mm', NBDESIGNER_TEXTDOMAIN)
                        )                        
                    ),         
                    array(
                        'title' => __('Hide On Smartphones', NBDESIGNER_TEXTDOMAIN),
                        'description' => __('Hide product designer on smartphones and display an information instead.', NBDESIGNER_TEXTDOMAIN),
                        'id' => 'nbdesigner_disable_on_smartphones',
                        'default' => 'no',
                        'type' => 'radio',
                        'options' => array(
                            'yes' => __('Yes', NBDESIGNER_TEXTDOMAIN),
                            'no' => __('No', NBDESIGNER_TEXTDOMAIN),
                        )
                    )
                ),
                'admin-notifications' => array(
                    array(
                        'title' => __( 'Admin notifications', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_notifications',
                        'description' 	=> __('Send a message to the admin when customer design saved / changed.', NBDESIGNER_TEXTDOMAIN),
                        'default'	=> 'yes',
                        'type' 		=> 'radio',
                        'options'   => array(
                            'yes' => __('Yes', NBDESIGNER_TEXTDOMAIN),
                            'no' => __('No', NBDESIGNER_TEXTDOMAIN)
                        )                        
                    ),
                    array(
                        'title' => __( 'Recurrence', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_notifications_recurrence',
                        'description' 	=> __('Choose how many times you want to receive an e-mail.', NBDESIGNER_TEXTDOMAIN),
                        'default'	=> 'hourly',
                        'type' 		=> 'select',
                        'options'   => array(
                            'hourly' => __('Hourly', NBDESIGNER_TEXTDOMAIN),
                            'twicedaily' => __('Twice a day', NBDESIGNER_TEXTDOMAIN),
                            'daily' => __('Daily', NBDESIGNER_TEXTDOMAIN)
                        )
                    ),   
                    array(
                        'title' => __( 'Recipients', NBDESIGNER_TEXTDOMAIN ),
                        'description' 		=> __( 'Enter recipients (comma separated) for this email. Defaults to ', NBDESIGNER_TEXTDOMAIN ).'<code>'.get_option('admin_email').'</code>',
                        'id' 		=> 'nbdesigner_notifications_emails',
                        'class'         => 'regular-text',
                        'default'	=> '',
                        'type' 		=> 'text',
                        'placeholder'   => 'Enter your email'
                    ),                      
                ),
                'application'       => array(
                    array(
                        'title' => __( 'Facebook App-ID', NBDESIGNER_TEXTDOMAIN ),
                        'description' 		=> __( 'Enter a Facebook App-ID to allow customer use Facebook photos.', NBDESIGNER_TEXTDOMAIN ).' <a href="#" id="nbdesigner_show_helper">'.__("Where do I get this info?", NBDESIGNER_TEXTDOMAIN).'</a>',
                        'id' 		=> 'nbdesigner_facebook_app_id',
                        'class'         => 'regular-text',
                        'default'	=> '',
                        'type' 		=> 'text'
                    ), 
                )
            ));
        }
    }
}