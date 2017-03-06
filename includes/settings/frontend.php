<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if(!class_exists('Nbdesigner_Settings_Frontend')){
    class Nbdesigner_Settings_Frontend {
        public static function get_options() {
            return apply_filters('nbdesigner_design_tool_settings', array(
                'tool-text' => array(
                    array(
                        'title' => __( 'Enable tool Add Text', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_enable_text',
                        'default'	=> 'yes',
                        'type' 		=> 'radio',
                        'options'   => array(
                            'yes' => __('Yes', NBDESIGNER_TEXTDOMAIN),
                            'no' => __('No', NBDESIGNER_TEXTDOMAIN)
                        ) 
                    ),  
                    array(
                        'title' => __( 'Default text', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_default_text',
                        'default'	=> 'Text here',
                        'description' 		=> __( 'Default text when user add text', NBDESIGNER_TEXTDOMAIN ),
                        'type' 		=> 'text',
                        'class'         => 'regular-text',
                    ),  
                    array(
                        'title' => __( 'Default color', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_default_color',
                        'default'	=> '#cc324b',
                        'description' 		=> sprintf(__( 'Default color text when user add text. If you\'re using limited color palette, make sure <a href="%s">this color</a> has been defined', NBDESIGNER_TEXTDOMAIN ), esc_url(admin_url('admin.php?page=nbdesigner&tab=color'))),
                        'type' 		=> 'colorpicker'
                    ),                     
                    array(
                        'title' => __( 'Enable Curved Text', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_enable_curvedtext',
                        'default'	=> 'yes',
                        'type' 		=> 'radio',
                        'options'   => array(
                            'yes' => __('Yes', NBDESIGNER_TEXTDOMAIN),
                            'no' => __('No', NBDESIGNER_TEXTDOMAIN)
                        ) 
                    ),   
                    array(
                        'title' => __( 'Enable Text pattern', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_enable_textpattern',
                        'default'	=> 'yes',
                        'type' 		=> 'radio',
                        'options'   => array(
                            'yes' => __('Yes', NBDESIGNER_TEXTDOMAIN),
                            'no' => __('No', NBDESIGNER_TEXTDOMAIN)
                        ) 
                    ),  
                    array(
                        'title' => __( 'Show/hide features', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_option_text',
                        'default'	=> 'text',
                        'description' 	=> __( 'Show/hide features in frontend', NBDESIGNER_TEXTDOMAIN ),
                        'type' 		=> 'multicheckbox',
                        'class'         => 'regular-text',
                        'options'   => array(
                            'nbdesigner_text_change_font' => __('Change font', NBDESIGNER_TEXTDOMAIN),
                            'nbdesigner_text_italic' => __('Italic', NBDESIGNER_TEXTDOMAIN),
                            'nbdesigner_text_bold' => __('Bold', NBDESIGNER_TEXTDOMAIN),
                            'nbdesigner_text_underline' => __('Underline', NBDESIGNER_TEXTDOMAIN),
                            'nbdesigner_text_through' => __('Line-through', NBDESIGNER_TEXTDOMAIN),
                            'nbdesigner_text_overline' => __('Overline', NBDESIGNER_TEXTDOMAIN),
                            'nbdesigner_text_align_left' => __('Align left', NBDESIGNER_TEXTDOMAIN),
                            'nbdesigner_text_align_right' => __('Align right', NBDESIGNER_TEXTDOMAIN),
                            'nbdesigner_text_align_center' => __('Align center', NBDESIGNER_TEXTDOMAIN),
                            'nbdesigner_text_color' => __('Text color', NBDESIGNER_TEXTDOMAIN),
                            'nbdesigner_text_background' => __('Text background', NBDESIGNER_TEXTDOMAIN),
                            'nbdesigner_text_shadow' => __('Text shadow', NBDESIGNER_TEXTDOMAIN),
                            'nbdesigner_text_line_height' => __('Line height', NBDESIGNER_TEXTDOMAIN),
                            'nbdesigner_text_font_size' => __('Font size', NBDESIGNER_TEXTDOMAIN),
                            'nbdesigner_text_opacity' => __('Opacity', NBDESIGNER_TEXTDOMAIN),
                            'nbdesigner_text_outline' => __('Outline', NBDESIGNER_TEXTDOMAIN),
                            'nbdesigner_text_rotate' => __('Rotate', NBDESIGNER_TEXTDOMAIN)
                        ),
                        'css' => 'margin: 0 15px 10px 5px;'
                    )                      
                ),
                'tool-clipart' => array(
                    array(
                        'title' => __( 'Enable tool Add Clipart', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_enable_clipart',
                        'default'	=> 'yes',
                        'type' 		=> 'radio',
                        'options'   => array(
                            'yes' => __('Yes', NBDESIGNER_TEXTDOMAIN),
                            'no' => __('No', NBDESIGNER_TEXTDOMAIN)
                        ) 
                    ),  
                    array(
                        'title' => __( 'Show/hide features', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_option_clipart',
                        'default'	=> 'clipart',
                        'description' 	=> __( 'Show/hide features in frontend', NBDESIGNER_TEXTDOMAIN ),
                        'type' 		=> 'multicheckbox',
                        'class'         => 'regular-text',
                        'options'   => array(
                            'nbdesigner_clipart_change_path_color' => __( 'Change color path', NBDESIGNER_TEXTDOMAIN ),      
                            'nbdesigner_clipart_rotate' => __( 'Rotate', NBDESIGNER_TEXTDOMAIN ),      
                            'nbdesigner_clipart_opacity' => __( 'Opacity', NBDESIGNER_TEXTDOMAIN )
                        ),
                        'css' => 'margin: 0 15px 10px 5px;'
                    )                     
                ),
                'tool-image' => array(
                    array(
                        'title' => __( 'Enable tool Add Image', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_enable_image',
                        'default'	=> 'yes',
                        'type' 		=> 'radio',
                        'options'   => array(
                            'yes' => __('Yes', NBDESIGNER_TEXTDOMAIN),
                            'no' => __('No', NBDESIGNER_TEXTDOMAIN)
                        ) 
                    ), 
                    array(
                        'title' => __( 'Enable upload image', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_enable_upload_image',
                        'default'	=> 'yes',
                        'type' 		=> 'radio',
                        'options'   => array(
                            'yes' => __('Yes', NBDESIGNER_TEXTDOMAIN),
                            'no' => __('No', NBDESIGNER_TEXTDOMAIN)
                        ) 
                    ),           
                    array(
                        'title' => __('Login Required', NBDESIGNER_TEXTDOMAIN),
                        'description' => __('Users must create an account in your Wordpress site and need to be logged-in to upload images.', NBDESIGNER_TEXTDOMAIN),
                        'id' => 'nbdesigner_upload_designs_php_logged_in',
                        'default' => 'no',
                        'type' => 'checkbox'
                    ),                    
                    array(
                        'title' => __( 'Max size upload', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_maxsize_upload',
                        'css'         => 'width: 65px',
                        'default'	=> '5',
                        'subfix'        => ' MB',
                        'type' 		=> 'number'
                    ),    
                    array(
                        'title' => __( 'Min size upload', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_minsize_upload',
                        'css'         => 'width: 65px',
                        'default'	=> '0',
                        'subfix'        => ' MB',
                        'type' 		=> 'number'
                    ),
                    array(
                        'title' => __( 'Enable images from url', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_enable_image_url',
                        'default'	=> 'yes',
                        'type' 		=> 'radio',
                        'options'   => array(
                            'yes' => __('Yes', NBDESIGNER_TEXTDOMAIN),
                            'no' => __('No', NBDESIGNER_TEXTDOMAIN)
                        ) 
                    ), 
                    array(
                        'title' => __( 'Enable capture images by webcam', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_enable_image_webcam',
                        'default'	=> 'yes',
                        'type' 		=> 'radio',
                        'options'   => array(
                            'yes' => __('Yes', NBDESIGNER_TEXTDOMAIN),
                            'no' => __('No', NBDESIGNER_TEXTDOMAIN)
                        ) 
                    ),                    
                    array(
                        'title' => __( 'Enable Facebook photos', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_enable_facebook_photo',
                        'default'	=> 'yes',
                        'type' 		=> 'radio',
                        'options'   => array(
                            'yes' => __('Yes', NBDESIGNER_TEXTDOMAIN),
                            'no' => __('No', NBDESIGNER_TEXTDOMAIN)
                        ) 
                    ),    
                    array(
                        'title' => __('Show terms and conditions', NBDESIGNER_TEXTDOMAIN),
                        'description' => __('Show term and conditions upload image.', NBDESIGNER_TEXTDOMAIN),
                        'id' => 'nbdesigner_upload_show_term',
                        'default' => 'no',
                        'type' => 'radio',
                        'options'   => array(
                            'yes' => __('Yes', NBDESIGNER_TEXTDOMAIN),
                            'no' => __('No', NBDESIGNER_TEXTDOMAIN)
                        )                         
                    ),                    
                    array(
                        'title' => __( 'Terms and conditions upload image', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_upload_term',
                        'default'	=> 'example.com',
                        'type' 		=> 'textarea',
                        'description'      => __('HTML Tags Supported', NBDESIGNER_TEXTDOMAIN),
                        'css'         => 'width: 25em; height: 5em;'
                    ),  
                    array(
                        'title' => __( 'Show/hide features', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_option_image',
                        'default'	=> 'image',
                        'description' 	=> __( 'Show/hide features in frontend', NBDESIGNER_TEXTDOMAIN ),
                        'type' 		=> 'multicheckbox',
                        'class'         => 'regular-text',
                        'options'   => array(
                            'nbdesigner_image_unlock_proportion' => __( 'Unlock proportion', NBDESIGNER_TEXTDOMAIN ),        
                            'nbdesigner_image_shadow' => __( 'Shadow', NBDESIGNER_TEXTDOMAIN ),        
                            'nbdesigner_image_opacity' => __( 'Opacity', NBDESIGNER_TEXTDOMAIN ),          
                            'nbdesigner_image_grayscale' => __( 'Grayscale', NBDESIGNER_TEXTDOMAIN ),          
                            'nbdesigner_image_invert' => __( 'Invert', NBDESIGNER_TEXTDOMAIN ),         
                            'nbdesigner_image_sepia' => __( 'Sepia', NBDESIGNER_TEXTDOMAIN ),         
                            'nbdesigner_image_sepia2' => __( 'Sepia 2', NBDESIGNER_TEXTDOMAIN ),           
                            'nbdesigner_image_remove_white' => __( 'Remove white', NBDESIGNER_TEXTDOMAIN ),     
                            'nbdesigner_image_transparency' => __( 'Transparency', NBDESIGNER_TEXTDOMAIN ),           
                            'nbdesigner_image_tint' => __( 'Tint', NBDESIGNER_TEXTDOMAIN ),          
                            'nbdesigner_image_blend' => __( 'Blend mode', NBDESIGNER_TEXTDOMAIN ),           
                            'nbdesigner_image_brightness' => __( 'Brightness', NBDESIGNER_TEXTDOMAIN ),          
                            'nbdesigner_image_noise' => __( 'Noise', NBDESIGNER_TEXTDOMAIN ),         
                            'nbdesigner_image_pixelate' => __( 'Pixelate', NBDESIGNER_TEXTDOMAIN ),         
                            'nbdesigner_image_multiply' => __( 'Multiply', NBDESIGNER_TEXTDOMAIN ),     
                            'nbdesigner_image_blur' => __( 'Blur', NBDESIGNER_TEXTDOMAIN ),          
                            'nbdesigner_image_sharpen' => __( 'Sharpen', NBDESIGNER_TEXTDOMAIN ),         
                            'nbdesigner_image_emboss' => __( 'Emboss', NBDESIGNER_TEXTDOMAIN ),         
                            'nbdesigner_image_edge_enhance' => __( 'Edge enhance', NBDESIGNER_TEXTDOMAIN ),          
                            'nbdesigner_image_rotate' => __( 'Rotate', NBDESIGNER_TEXTDOMAIN ),         
                            'nbdesigner_image_crop' => __( 'Crop image', NBDESIGNER_TEXTDOMAIN ),         
                            'nbdesigner_image_shapecrop' => __( 'Shape crop', NBDESIGNER_TEXTDOMAIN ),  
                        ),
                        'css' => 'margin: 0 15px 10px 5px;'
                    )                    
                ),
                'tool-draw' => array(
                    array(
                        'title' => __( 'Enable Free Draw', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_enable_draw',
                        'default'	=> 'yes',
                        'type' 		=> 'radio',
                        'options'   => array(
                            'yes' => __('Yes', NBDESIGNER_TEXTDOMAIN),
                            'no' => __('No', NBDESIGNER_TEXTDOMAIN)
                        ) 
                    ),    
                    array(
                        'title' => __( 'Show/hide features', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_option_clipart',
                        'default'	=> 'clipart',
                        'description' 	=> __( 'Show/hide features in frontend', NBDESIGNER_TEXTDOMAIN ),
                        'type' 		=> 'multicheckbox',
                        'class'         => 'regular-text',
                        'options'   => array(
                            'nbdesigner_draw_brush' => __('Brush', NBDESIGNER_TEXTDOMAIN),         
                            'nbdesigner_draw_shape' => __('Geometrical shape', NBDESIGNER_TEXTDOMAIN)
                        ),
                        'css' => 'margin: 0 15px 10px 5px;'
                    )                       
                ),   
                'tool-qrcode' => array(
                    array(
                        'title' => __( 'Enable QRCode', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_enable_qrcode',
                        'default'	=> 'yes',
                        'type' 		=> 'radio',
                        'options'   => array(
                            'yes' => __('Yes', NBDESIGNER_TEXTDOMAIN),
                            'no' => __('No', NBDESIGNER_TEXTDOMAIN)
                        ) 
                    ),
                    array(
                        'title' => __( 'Default text', NBDESIGNER_TEXTDOMAIN ),
                        'id' 		=> 'nbdesigner_default_qrcode',
                        'default'	=> 'example.com',
                        'description' 	=> __( 'Default text for QRCode', NBDESIGNER_TEXTDOMAIN ),
                        'type' 		=> 'text',
                        'class'         => 'regular-text',
                    )                     
                ),                
            ));
        }
    }    
}