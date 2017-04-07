<?php
if ( ! defined( 'ABSPATH' ) ) exit;
class Nbdesigner_Studio {
    public function __construct() {
        //TODO
    }
    public function init(){
        $this->frontend_enqueue_scripts();
        $this->admin_enqueue_scripts();
        $this->hook();
    }
    public function hook(){
        add_shortcode( 'nbdesigner_stuido', array(&$this,'studio_func') );
    }
    public function admin_enqueue_scripts(){
        //TODO
    }
    public function frontend_enqueue_scripts(){
        add_action('wp_enqueue_scripts', function() {
            wp_register_script('angular', 'https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0-rc.2/angular.min.js', array(), '1.3.0');
            wp_register_script('nbd-studio', NBDESIGNER_JS_URL . 'nbd-studio.js', array('jquery', 'angular'), NBDESIGNER_VERSION);
        });
    }
    public function studio_func($atts, $content = null){
        return nbdesigner_get_template('gallery.php', $atts);
    }
}