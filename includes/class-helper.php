<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if(!class_exists('Nbdesigner_Helper')){
    class Nbdesigner_Helper{
        public static function settings_helper(){
            $screen = get_current_screen();
            $screen->add_help_tab( array(
                'id'		=> 'backend',
                'title'		=> __('Backend', NBDESIGNER_TEXTDOMAIN),
                'content'	=>
                    '<h2>' . __('Backend setting', NBDESIGNER_TEXTDOMAIN) . '</h2>' .
                    '<iframe width="560" height="315" src="https://www.youtube.com/embed/zegY2it0w3k?rel=0" frameborder="0" allowfullscreen></iframe>'      
            ));
            $screen->add_help_tab( array(
                'id'		=> 'frontend',
                'title'		=> __('Frontend', NBDESIGNER_TEXTDOMAIN),
                'content'	=>
                    '<h2>' . __('Frontend setting', NBDESIGNER_TEXTDOMAIN) . '</h2>' .
                    '<iframe width="560" height="315" src="https://www.youtube.com/embed/FLv_kMV3jv0?rel=0" frameborder="0" allowfullscreen></iframe>'          
            ));       
            $screen->add_help_tab( array(
                'id'		=> 'facebook',
                'title'		=> __('Frontend', NBDESIGNER_TEXTDOMAIN),
                'content'	=>
                    'something'
            ));
            $screen->set_help_sidebar(
                '<p><strong>' . __('For more information', NBDESIGNER_TEXTDOMAIN) . ':</strong></p>' .
                '<p>' . __('<a href="https://cmsmart.net/support_ticket" target="_blank">Support ticket</a>') . '</p>' .
                '<p>' . __('<a href="https://cmsmart.net/forum/" target="_blank">Forum</a>') . '</p>' 
            );               
        }
    }
}