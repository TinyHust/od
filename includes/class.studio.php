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
        if (is_admin()) {
            $this->ajax();
        }
    }
    public function ajax(){
        $ajax_events = array(
            'nbd_get_data'    =>  true
        );
	foreach ($ajax_events as $ajax_event => $nopriv) {
            add_action('wp_ajax_' . $ajax_event, array($this, $ajax_event));
            if ($nopriv) {
                add_action('wp_ajax_nopriv_' . $ajax_event, array($this, $ajax_event));
            }
        }        
    }
    public function nbd_get_data(){
        if (!wp_verify_nonce($_REQUEST['nonce'], 'nbd-get-data')) {
            die('Security error');
        }
        switch ($_REQUEST['type']) {
            case 'typography':
                $path = NBDESIGNER_PLUGIN_DIR . '/data/typography/typography.json';
                $data = file_get_contents($path);
                break;
            case 'illustrator':
                $pathCat = NBDESIGNER_PLUGIN_DIR . '/data/illustrator/illustrator-categories.json';
                $path = NBDESIGNER_PLUGIN_DIR . '/data/illustrator/illustrators.json';
                $_data = array();
                $_data['cat'] = file_get_contents($pathCat);
                $_data['illustrators'] = file_get_contents($path);
                $data = json_encode($_data);
                break;                
            default:
                break;
        }          
        echo $data;
        wp_die();
    }
    public function hook(){
        add_shortcode( 'nbdesigner_stuido', array(&$this,'studio_func') );
        add_filter( 'show_admin_bar', array(&$this,'hide_admin_bar_from_front_end') );
        add_action( 'template_redirect', array( $this, 'studio_html' ) );    
    }
    public function admin_enqueue_scripts(){
        //TODO
    }
    public function frontend_enqueue_scripts(){
        add_action('wp_enqueue_scripts', function() {           
            $js_libs = array(
                'angular' => array(
                    'cdn-link' => 'https://ajax.googleapis.com/ajax/libs/angularjs/1.6.3/angular.min.js',
                    'link'  => NBDESIGNER_ASSETS_URL.'libs/angular-1.6.3.js',
                    'version'   => '1.6.3',
                    'depends'  => array()
                ),
                'angular-cookies' => array(
                    'cdn-link' => 'http://ajax.googleapis.com/ajax/libs/angularjs/1.6.3/angular-cookies.min.js',
                    'link'  => NBDESIGNER_ASSETS_URL.'libs/angular-cookies-1.6.3.js',
                    'version'   => '1.6.3',
                    'depends'  =>  array('angular')
                ),     
                'angular-animate' => array(
                    'cdn-link' => 'https://ajax.googleapis.com/ajax/libs/angularjs/1.6.3/angular-animate.min.js',
                    'link'  => NBDESIGNER_ASSETS_URL.'libs/angular-animate-1.6.3.js',
                    'version'   => '1.6.3',
                    'depends'  =>  array('angular')
                ),
                'angular-aria' => array(
                    'cdn-link' => 'https://ajax.googleapis.com/ajax/libs/angularjs/1.6.3/angular-aria.min.js',
                    'link'  => NBDESIGNER_ASSETS_URL.'libs/angular-aria-1.6.3.js',
                    'version'   => '1.6.3',
                    'depends'  =>  array('angular')
                ),  
                'angular-route' => array(
                    'cdn-link' => 'https://ajax.googleapis.com/ajax/libs/angularjs/1.6.3/angular-route.min.js',
                    'link'  => NBDESIGNER_ASSETS_URL.'libs/angular-route-1.6.3.js',
                    'version'   => '1.6.3',
                    'depends'  =>  array('angular')
                ),                 
                'angular-material' => array(
                    'cdn-link' => 'https://cdn.gitcdn.link/cdn/angular/bower-material/v1.1.3/angular-material.min.js',
                    'link'  => NBDESIGNER_ASSETS_URL.'libs/angular-material-1.1.3.js',
                    'version'   => '1.1.3',
                    'depends'  =>  array('angular', 'angular-animate', 'angular-aria')
                )            
            );
            $css_libs = array(
                'angular-material' => array(
                    'cdn-link' => 'https://cdn.gitcdn.link/cdn/angular/bower-material/v1.1.3/angular-material.min.js',
                    'link'  => NBDESIGNER_ASSETS_URL.'libs/css/angular-material.css',
                    'version'   => '1.1.3',
                    'depends'  =>  array()
                ),
            );           
            foreach ($js_libs as $key => $js){
                $link = ( NBDESIGNER_MODE_DEV ) ? $js['link'] : $js['cdn-link'];
                wp_register_script($key, $link, $js['depends'], $js['version']);
            }            
            wp_register_script('nbd-studio-bundle', NBDESIGNER_JS_URL . 'nbd-studio-bundle.js', array('jquery', 'angular', 'angular-material'), NBDESIGNER_VERSION);
            wp_register_script('nbd-studio', NBDESIGNER_JS_URL . 'nbd-studio.js', array('jquery', 'angular', 'nbd-studio-bundle'), NBDESIGNER_VERSION);
            foreach ($css_libs as $key => $css){
                $link = ( NBDESIGNER_MODE_DEV ) ? $css['link'] : $css['cdn-link'];
                wp_register_style($key, $link, $css['depends'], $css['version']);
            }
            wp_register_style('nbd-studio-bundle', NBDESIGNER_CSS_URL . 'nbdstuido-bundle.css', array('angular-material', 'angular-cookies'), NBDESIGNER_VERSION);
            wp_register_style('nbd-studio', NBDESIGNER_CSS_URL . 'nbd-studio.css', array('angular-material', 'nbd-studio-bundle'), NBDESIGNER_VERSION);
            if(is_nbd_studio()){
//                wp_enqueue_script(array('angular','angular-animate','angular-aria', 'angular-material', 'angular-route', 'angular-cookies', 'nbd-studio-bundle', 'nbd-studio'));
//                wp_enqueue_style(array('angular-material','nbd-studio-bundle', 'nbd-studio'));              
            }      
        });
    }
    public function studio_func($atts, $content = null){
        ob_start();            
        include_once (NBDESIGNER_PLUGIN_DIR . 'views/studio/workbench.php');
        $content = ob_get_clean();            
        return $content;
    }
    public static function update_content_stuido_page(){
        $studio_page_id = absint(get_option( 'nbdesigner_studio_page_id' ));
        if($studio_page_id){
            $stuido_page = array(
                'ID'           => $studio_page_id,
                'post_title'   => 'Studio',
                'post_content' => '[nbdesigner_stuido]'
            );       
            return wp_update_post( $stuido_page );
        }        
        return 0;
    }
    public function hide_admin_bar_from_front_end() {
        if (is_blog_admin()) {
            return true;
        }
        return false;
    }
    public function studio_html(){
        if ( ! is_nbd_studio() ) return;
        $path = NBDESIGNER_PLUGIN_DIR . 'views/studio/studio-html.php';
        include($path);exit();        
    }
}