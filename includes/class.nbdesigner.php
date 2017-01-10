<?php
if (!function_exists('add_action')) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

class Nbdesigner_Plugin {
    public $textdomain;
    public $plugin_id;
    public $plugin_path_data;
    public $author_site;
    public $nbdesigner_sku;
    public $activedomain;
    public $removedomain;
    public $default_option;
    public function __construct() {
        $this->textdomain = 'nbdesigner';
        $this->plugin_id = 'nbdesigner';
        $this->plugin_path_data = NBDESIGNER_DATA_DIR . '/';
        $this->author_site = 'https://cmsmart.net/';
        $this->nbdesigner_sku = 'WPP1074';
        $this->activedomain = 'activedomain/netbase/';
        $this->removedomain = 'removedomain/netbase/';
        $this->default_option = array(
            'btname' => 'Design It',
            'btn_position' => 1,
            'upload_max' => '5',
            'facebook_api_key' => '',
            'facebook_secret_key' => '',
            'instagram_api_key' => '',
            'instagram_secret_key' => '', 
            'owner_email' => '', 
            'owner_recurrence' => '', 
            'notifications_enable' => 1, 
            'show_design' => 1, 
            'show_design_order' => 1, 
            'thumbnail_quality' => '60',
            'thumbnail_width' => '60',
            'thumbnail_height' => '76',
            'iframe_securitykey' => 'QWERTYUIOPASDFGHJKL'
        );
        $this->nbdesigner_hook();
        $this->nbdesigner_schehule();
        $this->nbdesigner_lincense_notices();        
        add_action( 'nbdesigner_lincense_event', array($this, 'nbdesigner_lincense_event_action') ); 
        if (in_array('woocommerce/woocommerce.php',get_option('active_plugins')) || is_plugin_active_for_network( 'woocommerce/woocommerce.php' )) {
            $this->nbdesigner_woocommerce_hook();
        }
        if (is_admin()) {
            $this->nbdesigner_admin_hook();           
            $this->nbdesigner_ajax();           
            $this->nbdesigner_admin_enqueue_scripts();           
        } else {    
            $this->nbdesigner_frontend_hook();    
            $this->nbdesigner_frontend_enqueue_scripts();
        }      
    }
    public function nbdesigner_ajax(){
        // Nbdesigner_EVENT => nopriv
        $ajax_events = array(
            'nbdesigner_add_font_cat' => false,
            'nbdesigner_add_art_cat' => false,
            'nbdesigner_add_google_font' => false,
            'nbdesigner_delete_font_cat' => false,
            'nbdesigner_delete_art_cat' => false,
            'nbdesigner_delete_font' => false,
            'nbdesigner_delete_art' => false,
            'nbdesigner_get_product_info' => true,
            'nbdesigner_save_customer_design' => true,
            'nbdesigner_get_qrcode' => true,
            'nbdesigner_get_facebook_photo' => true,
            'nbdesigner_get_art' => true,
            'nbdesigner_design_approve' => false,
            'nbdesigner_design_order_email' => false,
            'nbdesigner_customer_upload' => true,
            'nbdesigner_get_font' => true,
            'nbdesigner_get_pattern' => true,
            'nbdesigner_get_info_license' => false,
            'nbdesigner_remove_license' => false,
            'nbdesigner_get_license_key' => false,
            'nbdesigner_get_security_key' => false,
            'nbdesigner_get_language' => true,
            'nbdesigner_save_language' => false,
            'nbdesigner_create_language' => false,
            'nbdesigner_make_primary_design' => false,
            'nbdesigner_load_admin_design' => true,
            'nbdesigner_save_webcam_image' => true,
            'nbdesigner_migrate_domain' => false,
            'nbdesigner_restore_data_migrate_domain' => false,
            'nbdesigner_theme_check' => false,
            'nbdesigner_custom_css' => false,
            'nbdesigner_copy_image_from_url' => true,
            'nbdesigner_get_suggest_design' => true
        );
	foreach ($ajax_events as $ajax_event => $nopriv) {
            add_action('wp_ajax_' . $ajax_event, array($this, $ajax_event));
            if ($nopriv) {
                // NBDesigner AJAX can be used for frontend ajax requests
                add_action('wp_ajax_nopriv_' . $ajax_event, array($this, $ajax_event));
            }
        }
    }
    public function nbdesigner_hook(){
        add_action('plugins_loaded', array($this, 'translation_load_textdomain'));
        add_action('init', array($this, 'nbdesigner_start_session'), 1);
        add_action('wp_logout', array($this, 'nbdesigner_end_session'));
        add_action('wp_login', array($this, 'nbdesigner_change_folder_design'), 10, 2);
        add_action( 'user_register', array($this,'nbdesigner_registration_save'), 10, 1 ); 
        add_filter( 'cron_schedules', array($this, 'nbdesigner_set_schedule'));      
        add_filter( 'query_vars', array($this, 'nbdesigner_add_query_vars_filter') );    
        add_shortcode( 'nbdesigner_redesign', array($this, 'nbdesigner_redesign_func') );
        add_shortcode( 'nbdesigner_admindesign', array($this, 'nbdesigner_admindesign_func') );
        add_shortcode( 'nbdesigner_gallery', array($this,'nbdesigner_gallery_func') );
        add_filter('the_content', array($this,'nbdesigner_add_shortcode_page_design'));
        add_action( 'template_redirect', array( $this, 'nbdesigner_editor_html' ) );    
        add_action('admin_head', array($this, 'nbdesigner_add_tinymce_editor'));
    }
    public function nbdesigner_admin_hook(){
        add_action('admin_menu', array($this, 'nbdesigner_menu'));
        add_action('add_meta_boxes', array($this, 'add_design_box'), 30);
        add_action('save_post', array($this, 'save_design'));
        add_filter('upload_mimes', array($this, 'upload_mimes'));
        add_filter('manage_product_posts_columns', array($this, 'nbdesigner_add_design_column'));
        add_action('manage_product_posts_custom_column', array($this, 'nbdesigner_display_posts_design'), 1, 2);
        add_filter('nbdesigner_notices', array($this, 'nbdesigner_notices'));        
    }
    public function nbdesigner_frontend_hook(){
       //TODO
    }
    public function nbdesigner_woocommerce_hook(){
        add_filter('woocommerce_cart_item_name', array($this, 'nbdesigner_render_cart'), 1, 3);
        add_action('woocommerce_add_to_cart', array($this, 'nbdesigner_add_custom_data_design'), 1, 2);
        add_action('woocommerce_add_order_item_meta', array($this, 'nbdesigner_add_order_design_data'), 1, 3);
        //add_action('woocommerce_order_status_changed', array($this, 'nbdesigner_change_foler_after_order'), 1, 1);
        add_action('woocommerce_checkout_order_processed', array($this, 'nbdesigner_change_foler_after_order'), 1, 1);
        add_filter('woocommerce_locate_template', array($this, 'nbdesigner_locate_plugin_template'), 20, 3 );
        add_filter( 'woocommerce_order_item_name', array($this, 'nbdesigner_order_item_name'), 1, 2);
        add_filter( 'woocommerce_order_item_quantity_html', array($this, 'nbdesigner_order_item_quantity_html'), 1, 2);
        add_filter( 'woocommerce_hidden_order_itemmeta', array($this, 'nbdesigner_hidden_custom_order_item_metada'));
        add_action( 'nbdesigner_admin_notifications_event', array($this, 'nbdesigner_admin_notifications_event_action') );
        add_action( 'woocommerce_cart_item_removed', array($this, 'nbdesigner_remove_cart_item_design'), 10, 2 );
        add_action( 'woocommerce_product_after_variable_attributes', array($this,'nbdesigner_variation_settings_fields'), 10, 3 );
        add_action( 'woocommerce_save_product_variation', array($this,'nbdesigner_save_variation_settings_fields'), 10, 2 );
        add_filter( 'woocommerce_add_cart_item_data', array($this, 'nbdesigner_force_individual_cart_items'), 10, 2 );      
        $opt_val = get_option('nbdesigner');
        if(is_array($opt_val)){
            extract($opt_val);
        }
        if(!isset($btn_position)) $btn_position = 1;
        if($btn_position == 1){
            add_action('woocommerce_before_add_to_cart_button', array($this, 'nbdesigner_button'), 30);
        }else if($btn_position == 2){
            add_action('woocommerce_before_add_to_cart_form', array($this, 'nbdesigner_button'), 30);
        }else{
            add_action('woocommerce_after_add_to_cart_form', array($this, 'nbdesigner_button'), 30);
        }         
    }    
    public function nbdesigner_admin_enqueue_scripts(){
        add_action('admin_enqueue_scripts', function($hook) {   
            if (($hook == 'post.php') || ($hook == 'post-new.php') || ($hook == 'toplevel_page_nbdesigner') ||
                    ($hook == 'nbdesigner_page_nbdesigner_manager_product' ) || ($hook == 'toplevel_page_nbdesigner_shoper') || ($hook == 'nbdesigner_page_nbdesigner_frontend_translate') ||
                    ($hook == 'nbdesigner_page_nbdesigner_manager_fonts') || ($hook == 'nbdesigner_page_nbdesigner_manager_arts') || ($hook == 'nbdesigner_page_nbdesigner_admin_template')
                     || ($hook == 'nbdesigner_page_nbdesigner_tools')) {
                wp_register_style('admin_nbdesigner', NBDESIGNER_CSS_URL . 'admin-nbdesigner.css');
                wp_register_script('admin_nbdesigner', NBDESIGNER_JS_URL . 'admin-nbdesigner.js', array('jquery', 'jquery-ui-resizable', 'jquery-ui-draggable', 'jquery-ui-autocomplete'));
                wp_localize_script('admin_nbdesigner', 'admin_nbds', array(
                    'url' => admin_url('admin-ajax.php'),
                    'nonce' => wp_create_nonce('nbdesigner_add_cat'),
                    'mes_success' => 'Success!',
                    'url_check' => $this->author_site,
                    'sku' => $this->nbdesigner_sku,       
                    'url_gif' => NBDESIGNER_PLUGIN_URL . 'assets/images/loading.gif',
                    'nbds_lang' => $this->nbdesigner_get_javascript_multilanguage() ));                  
                wp_enqueue_style(array('wp-pointer', 'wp-jquery-ui-dialog', 'admin_nbdesigner'));
                wp_enqueue_script(array('wp-pointer', 'wpdialogs', 'admin_nbdesigner'));                            
            }
            if($hook == 'admin_page_nbdesigner_detail_order'){
                wp_register_style('admin_nbdesigner_detail_order_slider', NBDESIGNER_CSS_URL . 'owl.carousel.css');
                wp_register_style('admin_nbdesigner_detail_order', NBDESIGNER_CSS_URL . 'detail_order.css');
                wp_enqueue_style(array('admin_nbdesigner_detail_order_slider', 'admin_nbdesigner_detail_order'));
                wp_register_script('admin_nbdesigner_detail_order_slider', NBDESIGNER_JS_URL . 'owl.carousel.min.js', array('jquery'));
                wp_enqueue_script('admin_nbdesigner_detail_order_slider');
            }
            if($hook == 'nbdesigner_page_nbdesigner_frontend_translate'){
                wp_register_script('admin_nbdesigner_jeditable', NBDESIGNER_JS_URL . 'jquery.jeditable.js', array('jquery'));
                wp_enqueue_script('admin_nbdesigner_jeditable');
            }
            if($hook == 'nbdesigner_page_nbdesigner_tools'){
                wp_enqueue_style('admin_nbdesigner_codemirror', NBDESIGNER_PLUGIN_URL . 'assets/codemirror/codemirror.css');
                wp_enqueue_script( 'nbdesigner_codemirror_js', NBDESIGNER_PLUGIN_URL . 'assets/codemirror/codemirror.js' , array());
                wp_enqueue_script( 'nbdesigner_codemirror_css_js', NBDESIGNER_PLUGIN_URL . 'assets/codemirror/css.js' , array());
            }
            if($hook == 'nbdesigner_page_nbdesigner_admin_template'){
                wp_enqueue_style('nbdesigner_sweetalert_css', NBDESIGNER_CSS_URL . 'sweetalert.css');
                wp_enqueue_script( 'nbdesigner_sweetalert_js', NBDESIGNER_JS_URL . 'sweetalert.min.js' , array('jquery'));
            }
        });
    }
    public function nbdesigner_frontend_enqueue_scripts(){
        add_action('wp_enqueue_scripts', function() {
            wp_register_style('nbdesigner', NBDESIGNER_CSS_URL . 'nbdesigner.css');
            wp_enqueue_style('nbdesigner');
            $opt_val = get_option('nbdesigner');
            if(is_array($opt_val)){
                extract($opt_val);
                $max_size = $upload_max;
                $api_key = $facebook_api_key;
            }else{
                $max_size = 5;
                $api_key = '';
            }                
            wp_register_script('nbdesigner', NBDESIGNER_JS_URL . 'nbdesigner.js', array('jquery'));
            wp_localize_script('nbdesigner', 'nbds_frontend', array(
                'url' => admin_url('admin-ajax.php'),
                'sid' => session_id(),
                'upload_max' => $opt_val['upload_max'],
                'nonce' => wp_create_nonce('save-design'),
                'nonce_get' => wp_create_nonce('nbdesigner-get-data'),
                'nbfbAppId' => $api_key,
                'max_size' => $max_size,
                'font_url' => NBDESIGNER_FONT_URL .'/',
                'url_style' => NBDESIGNER_PLUGIN_URL . 'assets/'));
            wp_enqueue_script('nbdesigner');
        });
    }
    public static function plugin_activation() {
        if (version_compare($GLOBALS['wp_version'], NBDESIGNER_MINIMUM_WP_VERSION, '<')) {
            $message = sprintf(__('<p>Plugin <strong>not compatible</strong> with WordPress %s. Requires WordPress %s to use this Plugin.</p>', 'nbdesigner'), $GLOBALS['wp_version'], NBDESIGNER_VERSION);
            die($message);
        }
        if (!is_plugin_active('woocommerce/woocommerce.php')) {
            $message = '<div class="error"><p>' . sprintf(__('WooCommerce is not active. Please activate WooCommerce before using %s.', 'nbdesigner'), '<b>Nbdesigner</b>') . '</p></div>';
            die($message);
        }
        if (!file_exists(NBDESIGNER_TEMP_DIR)) {
            wp_mkdir_p(NBDESIGNER_TEMP_DIR);
        } 
        if (!file_exists(NBDESIGNER_DOWNLOAD_DIR)) {
            wp_mkdir_p(NBDESIGNER_DOWNLOAD_DIR);
        }  
        if (!file_exists(NBDESIGNER_ADMINDESIGN_DIR)) {
            wp_mkdir_p(NBDESIGNER_ADMINDESIGN_DIR);
        }   
        if (!file_exists(NBDESIGNER_FONT_DIR)) {
            wp_mkdir_p(NBDESIGNER_FONT_DIR);
        }     
        $path_lang = NBDESIGNER_DATA_CONFIG_DIR . '/language';
        if (!file_exists($path_lang)) {
            wp_mkdir_p($path_lang);
        } 
        if (!file_exists(NBDESIGNER_SUGGEST_DESIGN_DIR)) {
            wp_mkdir_p(NBDESIGNER_SUGGEST_DESIGN_DIR);
        }  
        $check_version_150 = false;
        $version = get_option("nbdesigner_version_plugin");
        if (version_compare($version, "1.5.0", '<')) {    
            $check_version_150 = true;
        }         
        self::nbdesigner_add_redesign_page();
        self::nbdesigner_create_table_templates();
        $version = get_option("nbdesigner_version_plugin");
        if ($check_version_150) {    
            self::nbdesigner_update_data_150();
        }               
    }
    public function nbdesigner_set_schedule($schedules){   
        if(!isset($schedules['hourly'])){
            $schedules['hourly'] = array('interval' => 60*60, 'display' => __('Once Hour'));
        }
        //$schedules['every5min'] = array('interval' => 60*5, 'display' => __('Every 5 Minutes', $this->textdomain));
        //$schedules['every2min'] = array('interval' => 60*2, 'display' => __('Every 2 Minutes', $this->textdomain));
        return $schedules;
    }
    public function nbdesigner_schehule(){
        $timestamp = wp_next_scheduled( 'nbdesigner_lincense_event' );
        if( $timestamp == false ){
            wp_schedule_event( time(), 'daily', 'nbdesigner_lincense_event' );
        }   
        $timestamp2 = wp_next_scheduled( 'nbdesigner_admin_notifications_event' );
        $opt_val = get_option('nbdesigner');
        $recurrence = 'hourly';
        if(is_array($opt_val)) {
            extract($opt_val);   
            $recurrence = $owner_recurrence;
        }	        
        if( $timestamp2 == false ){
            wp_schedule_event( time(), $recurrence, 'nbdesigner_admin_notifications_event' );
        }         
    }
    public function nbdesigner_lincense_event_action(){
        $path = NBDESIGNER_PLUGIN_DIR . 'data/license.json';   
        $path_data = NBDESIGNER_DATA_CONFIG_DIR . '/license.json';
        if(file_exists($path) || file_exists($path_data)){
            $license = $this->nbdesigner_check_license();
            $now = strtotime("now");
            if(isset($license['type']) && $license['type'] != 'free' && isset($license['expiry']) && $license['expiry'] < $now ){
                $result = $this->nbdesiger_request_license($license['key'], $this->activedomain);
                if($result){
                    $data = (array) json_decode($result);               
                    $data['key'] = $license['key'];
                    if($data['type'] == 'free') $data['number_domain'] = "5";
                    $data['salt'] = md5($license['key'].$data['type']);                   
                    $this->nbdesigner_write_license(json_encode($data));  
                }   
            }
        }
        add_action( 'admin_notices', array( $this, 'nbdesigner_lincense_notices' ) );	
    }
    public function nbdesigner_admin_notifications_event_action(){  
        $opt_val = get_option('nbdesigner');       
        if(is_array($opt_val)){
            global $woocommerce;
            extract($opt_val);           
            if($notifications_enable == 1){
                
                if( version_compare( $woocommerce->version, "2.2", ">=" ) ){
                    $post_status = array( 'wc-processing', 'wc-completed', 'wc-on-hold', 'wc-pending' );
                }else{
                    $post_status = 'publish';
                }	               
                $args = array(
                    'post_type' => 'shop_order',
                    'meta_key' => '_nbdesigner_order_changed',
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'posts_per_page'=>-1,
                    'post_status' => $post_status,
                    'meta_query' => array(
                        array(
                            'key' => '_nbdesigner_order_changed',
                            'value' => 1,
                        )
                    )
        	); 
                $post_orders = get_posts($args);                  
                $orders = array();
                foreach ($post_orders AS $order) {
                    $the_order = new WC_Order($order->ID);
                    $orders[$order->ID] = $the_order->get_order_number();                    
                }
                if (count($orders)) {
                    foreach ($orders AS $order => $order_number) {
                        update_post_meta($order, '_nbdesigner_order_changed', 0);
                    }                    
                    $subject = __('New / Modified order(s)', $this->textdomain);
                    $mailer = $woocommerce->mailer();
                    ob_start();
                    wc_get_template('emails/nbdesigner-admin-notifications.php', array(
                        'plugin_id' => $this->textdomain,
                        'orders' => $orders,
                        'heading' => $subject
                    )); 
                    $emails = new WC_Emails();
                    $woo_recipient=$emails->emails['WC_Email_New_Order']->recipient;
                    if($owner_email == ''){
                        if(!empty($woo_recipient)) {
                            $user_email = esc_attr($woo_recipient);
                        } else {
                            $user_email = get_option( 'admin_email' );
                        }                        
                    }else{
                        $user_email = $owner_email;
                    }
                    $body = ob_get_clean();                  
                    if (!empty($user_email)) {                                            
                        $mailer->send($user_email, $subject, $body);
                    }                    
                }
            }
        }
    }
    public function nbdesigner_add_query_vars_filter($vars){
        $vars[] = "nbds-adid";
        $vars[] = "nbds-ref";
        return $vars;   
    }
    public function nbdesigner_lincense_notices(){            
        $license = $this->nbdesigner_check_license();
        if($license['status'] == 0){
            add_action( 'admin_notices', array( $this, 'nbdesigner_lincense_notices_content' ) );     
        } 
    }
    public function nbdesigner_lincense_notices_content(){     
        $mes = $this->nbdesigner_custom_notices('notices', 'You\'re using NBDesigner free version (full features and function but for max 5 products) or expired pro version. <a href="http://cmsmart.net/wordpress-plugins/woocommerce-online-product-designer-plugin" target="_blank">Please buy the Premium version here to use for all product </a>');
        printf($mes);
    }
    public function translation_load_textdomain() {	       
        load_plugin_textdomain($this->textdomain, false, 'nbdesigner/langs/');
    }
    public static function plugin_deactivation() {
        wp_clear_scheduled_hook( 'nbdesigner_lincense_event' );
        wp_clear_scheduled_hook( 'nbdesigner_admin_notifications_event' );
    }
    public function upload_mimes($mimes) {
        $mimes['svg'] = 'image/svg+xml';
        $mimes['woff'] = 'application/x-font-woff';
        $mimes['ttf'] = 'application/x-font-ttf';
        return $mimes;
    }
    public function nbdesigner_menu() {
        if (current_user_can('administrator')) {
            add_menu_page('Nbdesigner', 'NBDesigner', 'administrator', 'nbdesigner', array($this, 'nbdesigner_manager'), NBDESIGNER_PLUGIN_URL . 'assets/images/logo.png', 26);
            $nbdesigner_manage = add_submenu_page(
                    'nbdesigner', 'NBDesigner Setting', 'Setting', 'administrator', 'nbdesigner', array($this, 'nbdesigner_manager')
            );
            add_action('load-'.$nbdesigner_manage, array($this, 'nbdesigner_add_help_option'));
            add_submenu_page(
                    'nbdesigner', 'Manager Products', 'Products', 'administrator', 'nbdesigner_manager_product', array($this, 'nbdesigner_manager_product')
            );
            add_submenu_page(
                    '', 'Detail Design Order', 'Detail Design Order', 'administrator', 'nbdesigner_detail_order', array($this, 'nbdesigner_detail_order')
            );
            add_submenu_page(
                    'nbdesigner', 'Manager Cliparts', 'Cliparts', 'administrator', 'nbdesigner_manager_arts', array($this, 'nbdesigner_manager_arts')
            );
            add_submenu_page(
                    'nbdesigner', 'Manager Fonts', 'Fonts', 'administrator', 'nbdesigner_manager_fonts', array($this, 'nbdesigner_manager_fonts')
            );
            add_submenu_page(
                    'nbdesigner', 'Frontend Translate', 'Frontend Translate', 'administrator', 'nbdesigner_frontend_translate', array($this, 'nbdesigner_frontend_translate')
            );      
            add_submenu_page(
                    'nbdesigner', 'Admin Templates', 'Templates', 'administrator', 'nbdesigner_admin_template', array($this, 'nbdesigner_admin_template')
            );  
            add_submenu_page(
                    'nbdesigner', 'NBDesigner Tools', 'Tools', 'administrator', 'nbdesigner_tools', array($this, 'nbdesigner_tools')
            );  
            add_submenu_page(
                    'nbdesigner', 'NBDesigner Analytics', 'Analytics', 'administrator', 'nbdesigner_analytics', array($this, 'nbdesigner_analytics')
            );             
        }
        if (current_user_can('shop_manager')) {
            add_menu_page('NBdesigner', 'NBdesigner', 'shop_manager', 'nbdesigner_shoper', array($this, 'nbdesigner_manager_product'), NBDESIGNER_PLUGIN_URL . 'assets/images/logo.png', 26);
            add_submenu_page(
                    'nbdesigner_shoper', 'Manager Product', 'Manager Product', 'shop_manager', 'nbdesigner_shoper', array($this, 'nbdesigner_manager_product')
            );            
            add_submenu_page(
                    '', 'Detail Design Order', 'Detail Design Order', 'shop_manager', 'nbdesigner_detail_order', array($this, 'nbdesigner_detail_order')
            );
            add_submenu_page(
                    'nbdesigner_shoper', 'Manager Arts', 'Manager Arts', 'shop_manager', 'nbdesigner_manager_arts', array($this, 'nbdesigner_manager_arts')
            );
            add_submenu_page(
                    'nbdesigner_shoper', 'Manager Fonts', 'Manager Fonts', 'shop_manager', 'nbdesigner_manager_fonts', array($this, 'nbdesigner_manager_fonts')
            );
        }
    }
    public function nbdesigner_manager() {
        $defaults = $this->default_option;
        $hidden_field_name = 'nbdesigner_setting_hidden';
        $opt_name = 'nbdesigner';
        $opt_val = get_option('nbdesigner');
        $or_opt_val = $opt_val;
        if (isset($_POST[$this->plugin_id . '_hidden']) && wp_verify_nonce($_POST[$this->plugin_id . '_hidden'], $this->plugin_id) && current_user_can('administrator')) {
            $opt_val = $_POST['nbdesigner'];
            update_option($opt_name, $opt_val);
            $path_op = NBDESIGNER_PLUGIN_DIR . 'data/option.json';
            $api_opt = $opt_val;
            $api_opt['callback_url'] = NBDESIGNER_PLUGIN_URL . 'includes/instagram-callback.php';
            file_put_contents($path_op, json_encode($api_opt));
            if($opt_val['notifications_enable'] == 1){
                $recurrence = !empty($opt_val['owner_recurrence']) ? $opt_val['owner_recurrence'] : 'hourly'; 
                if($recurrence != $or_opt_val['owner_recurrence']){
                    wp_clear_scheduled_hook( 'nbdesigner_admin_notifications_event' );                  
                    wp_schedule_event(time(), $recurrence, 'nbdesigner_admin_notifications_event');
                }
                $timestamp = wp_next_scheduled( 'nbdesigner_admin_notifications_event' );	                
                if($timestamp == false){
                    wp_schedule_event(time(), $recurrence, 'nbdesigner_admin_notifications_event');
                }
            }else{
                wp_clear_scheduled_hook( 'nbdesigner_admin_notifications_event' );    
            }
        }
        $opt_val = wp_parse_args($opt_val, $defaults);
        $license = $this->nbdesigner_check_license();
        $site_title = get_bloginfo( 'name' );
        $site_url = base64_encode(network_site_url( '/' ));
        require(NBDESIGNER_PLUGIN_DIR . 'views/nbdesigner-setting.php');
    }
    public function nbdesigner_add_help_option(){
        $screen = get_current_screen();
        $screen->add_help_tab( array(
            'id'		=> 'backend',
            'title'		=> __('Backend'),
            'content'	=>
                    '<h2>' . __('Backend setting') . '</h2>' .
                    '<iframe width="560" height="315" src="https://www.youtube.com/embed/2ZK0jmW2RR0?rel=0" frameborder="0" allowfullscreen></iframe>'      
        ));
        $screen->add_help_tab( array(
            'id'		=> 'front',
            'title'		=> __('Frontend'),
            'content'	=>
                    '<h2>' . __('Front setting') . '</h2>' .
                    '<iframe width="560" height="315" src="https://www.youtube.com/embed/VmbaOt8jjd8?rel=0" frameborder="0" allowfullscreen></iframe>'          
        ));        
        $screen->set_help_sidebar(
                '<p><strong>' . __('For more information:') . '</strong></p>' .
                '<p>' . __('<a href="https://cmsmart.net/support_ticket" target="_blank">Support ticket</a>') . '</p>' .
                '<p>' . __('<a href="https://cmsmart.net/forum/" target="_blank">Forum</a>') . '</p>' .
                '<p>' . __('<a href="https://codex.wordpress.org/Editing_Files" target="_blank">Documentation</a>') . '</p>' 
        );
    }
    public function nbdesigner_get_license_key(){
        
        if (!wp_verify_nonce($_POST['nbdesigner_getkey_hidden'], 'nbdesigner-get-key') || !current_user_can('administrator')) {
            die('Security error');
        }
        if(isset($_POST['nbdesigner'])){
            $data =$_POST['nbdesigner'];
            $email = base64_encode($data['email']);
            $domain = $data['domain'];
            $title = ($data['name'] != '') ? $data['name'] : $data['title'];
            $ip = base64_encode($this->nbdesigner_get_ip());
            $url = $this->author_site.'subcrible/WPP1074/'.$email.'/'.$domain.'/'.$title .'/'.$ip;	 	            
            $result = file_get_contents($url);
            if(isset($result)) {
                echo $result;
            }else{
                echo 'Please try later!';
            }
            wp_die();
        }
    }
    public function nbdesigner_get_ip(){
        $ip = $_SERVER['REMOTE_ADDR'];
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        return $ip;        
    }
    public static function nbdesigner_add_action_links($links){	       
        $mylinks = array(
            'setting' => '<a href="' . admin_url('options-general.php?page=nbdesigner') . '">Settings</a>'
        );
        return array_merge($mylinks, $links);
    }
    public static function nbdesigner_plugin_row_meta( $links, $file ) {      
        if($file == NBDESIGNER_PLUGIN_BASENAME){           
            $row_meta = array(
                'upgrade' => '<a href="https://cmsmart.net/support_ticket" target="_blank">Support</a>'
            );
            return array_merge( $links, $row_meta );
        }
        return (array) $links;
    }
    public function nbdesigner_manager_product() {
        $args = array('post_type' => 'product', 'posts_per_page' => -1);
        $products = get_posts($args);
        $_pro = array();
        $number_pro = 0;
        $limit = 20;
        foreach ($products as $product) {
            $opt = get_post_meta($product->ID, '_nbdesigner_enable', true);
            if ($opt) {
                $_product = wc_get_product($product->ID);
                $_pro[] = array(
                    'url' => admin_url('post.php?post=' . absint($product->ID) . '&action=edit'),
                    'img' => $_product->get_image(),
                    'name' => $product->post_title
                );
                $number_pro++;
            }
        }
        $page = filter_input(INPUT_GET, "p", FILTER_VALIDATE_INT);
        if(isset($page)){
            $_tp = ceil($number_pro / $limit);
            if($page > $_tp) $page = $_tp;
            $pro = array_slice($_pro, ($page-1)*$limit, $limit);
        }else{
            $pro = $_pro;
            if($number_pro > $limit) $pro = array_slice($_pro, ($page-1)*$limit, $limit);	
        }
        $url = admin_url('admin.php?page=nbdesigner_manager_product');
        require_once NBDESIGNER_PLUGIN_DIR . 'includes/class.nbdesigner.pagination.php';
        $paging = new Nbdesigner_Pagination();
        $config = array(
            'current_page'  => isset($page) ? $page : 1, 
            'total_record'  => $number_pro,
            'limit'         => $limit,
            'link_full'     => $url.'&p={p}',
            'link_first'    => $url              
        );	        
        $paging->init($config);            
        include_once(NBDESIGNER_PLUGIN_DIR . 'views/nbdesigner-manager-product.php');
    }
    public function nbdesigner_add_font_cat() {
        if (!wp_verify_nonce($_POST['nonce'], 'nbdesigner_add_cat') || !current_user_can('administrator')) {
            die('Security error');
        }
        $path = $this->plugin_path_data . 'font_cat.json';
        $list = $this->nbdesigner_read_json_setting($path);
        $cat = array(
            'name' => $_POST['name'],
            'id' => $_POST['id']
        );
        $this->nbdesigner_update_json_setting($path, $cat, $cat['id']);
        echo 'success';
        wp_die();
    }
    public function nbdesigner_add_art_cat() {
        if (!wp_verify_nonce($_POST['nonce'], 'nbdesigner_add_cat') || !current_user_can('administrator')) {
            die('Security error');
        }
        $path = $this->plugin_path_data . 'art_cat.json';
        $list = $this->nbdesigner_read_json_setting($path);
        $cat = array(
            'name' => sanitize_text_field($_POST['name']),
            'id' => $_POST['id']
        );
        $this->nbdesigner_update_json_setting($path, $cat, $cat['id']);
        echo 'success';
        wp_die();
    }
    public function nbdesigner_delete_font_cat() {
        if (!wp_verify_nonce($_POST['nonce'], 'nbdesigner_add_cat') || !current_user_can('administrator')) {
            die('Security error');
        }
        $path = $this->plugin_path_data . 'font_cat.json';
        $id = $_POST['id'];
        $this->nbdesigner_delete_json_setting($path, $id, true);
        $font_path = $this->plugin_path_data . 'fonts.json';
        $this->nbdesigner_update_json_setting_depend($font_path, $id);
        echo 'success';
        wp_die();
    }
    public function nbdesigner_delete_art_cat() {
        if (!wp_verify_nonce($_POST['nonce'], 'nbdesigner_add_cat') || !current_user_can('administrator')) {
            die('Security error');
        }
        $path = $this->plugin_path_data . 'art_cat.json';
        $id = $_POST['id'];
        $this->nbdesigner_delete_json_setting($path, $id, true);
        $art_path = $this->plugin_path_data . 'arts.json';
        $this->nbdesigner_update_json_setting_depend($art_path, $id);
        echo 'success';
        wp_die();
    }
    public function nbdesigner_get_list_google_font() {
        $path = NBDESIGNER_PLUGIN_DIR . 'data/listgooglefonts.json';
        $data = (array) $this->nbdesigner_read_json_setting($path);
        return json_encode($data);
    }
    public function nbdesigner_add_google_font() {
        if (!wp_verify_nonce($_POST['nonce'], 'nbdesigner_add_cat') || !current_user_can('administrator')) {
            die('Security error');
        }
        $name = $_POST['name'];
        $id = $_POST['id'];
        $path_font = $this->plugin_path_data . 'googlefonts.json';
        $data = array("name" => $name, "id" => $id);
        $this->nbdesigner_update_json_setting($path_font, $data, $id);
        echo 'success';
        wp_die();
    }
    public function nbdesigner_manager_fonts() {
        $notice = '';
        $font_id = 0;
        $cats = array("0");
        $current_font_cat_id = 0;
        $update = false;
        $list = $this->nbdesigner_read_json_setting($this->plugin_path_data . 'fonts.json');	
        $cat = $this->nbdesigner_read_json_setting($this->plugin_path_data . 'font_cat.json');
        $data_font_google = $this->nbdesigner_read_json_setting($this->plugin_path_data . 'googlefonts.json');
        $list_all_google_font = $this->nbdesigner_get_list_google_font();
        $current_cat = filter_input(INPUT_GET, "cat_id", FILTER_VALIDATE_INT);
        if (is_array($cat))
            $current_font_cat_id = sizeof($cat);
        if (isset($_GET['id'])) {
            $font_id = $_GET['id'];
            $update = true;
            if (isset($list[$font_id])) {
                $font_data = $list[$font_id];
                $cats = $font_data->cat;
            }
        }
        if (isset($_POST[$this->plugin_id . '_hidden']) && wp_verify_nonce($_POST[$this->plugin_id . '_hidden'], $this->plugin_id) && current_user_can('administrator')) {
            $font = array();
            $font['name'] = esc_html($_POST['nbdesigner_font_name']);
            $font['alias'] = 'nbfont' . substr(md5(rand(0, 999999)), 0, 10);
            $font['id'] = $_POST['nbdesigner_font_id'];
            $font['cat'] = $cats;
            if (isset($_POST['nbdesigner_font_cat']))
                $font['cat'] = $_POST['nbdesigner_font_cat'];
            if (isset($_FILES['woff']) && ($_FILES['woff']['size'] > 0) && ($_POST['nbdesigner_font_name'] != '')) {
                $uploaded_file_name = basename($_FILES['woff']['name']);	               
                $allowed_file_types = array('woff', 'ttf');
                $font['type'] = $this->nbdesigner_get_extension($uploaded_file_name);              
                if ($this->checkFileType($uploaded_file_name, $allowed_file_types)) {
                    $upload_overrides = array('test_form' => false);
                    $uploaded_file = wp_handle_upload($_FILES['woff'], $upload_overrides);
                    if (isset($uploaded_file['url'])) {
                        $new_path_font = $this->plugin_path_data . 'fonts/' . $font['alias'] .'.'. $font['type'];
                        $font['file'] = $uploaded_file['file'];
                        $font['url'] = $uploaded_file['url'];
                        if (!copy($font['file'], $new_path_font)) {
                            $notice = apply_filters('nbdesigner_notices', $this->nbdesigner_custom_notices('error', __('Failed to copy.', $this->textdomain)));
                        }else{
                            $font['file'] = $this->plugin_path_data . 'fonts/' . $font['alias'] .'.'. $font['type'];
                            $font['url'] = content_url().'/uploads/nbdesigner/fonts/' . $font['alias'] .'.'. $font['type'];
                        }
                        if ($update) {
                            $this->nbdesigner_update_list_fonts($font, $font_id);
                        } else {
                            $this->nbdesigner_update_list_fonts($font);
                        }
                        $notice = apply_filters('nbdesigner_notices', $this->nbdesigner_custom_notices('success', __('Your font has been saved.', $this->textdomain)));
                    } else {
                        $notice = apply_filters('nbdesigner_notices', $this->nbdesigner_custom_notices('error', __('Error while upload font, please try again!', $this->textdomain)));
                    }
                } else {
                    $notice = apply_filters('nbdesigner_notices', $this->nbdesigner_custom_notices('error', __('Incorrect file extensions.', $this->textdomain)));
                }
            } else if ($update && ($_POST['nbdesigner_font_name'] != '')) {
                $font_data->name = $_POST['nbdesigner_font_name'];
                $font_data->cat = $font['cat'];
                $this->nbdesigner_update_list_fonts($font_data, $font_id);
                $notice = apply_filters('nbdesigner_notices', $this->nbdesigner_custom_notices('success', __('Your font has been saved.', $this->textdomain)));
            } else {
                $notice = apply_filters('nbdesigner_notices', $this->nbdesigner_custom_notices('warning', __('Please choose font file or font name.', $this->textdomain)));
            }
            $list = $this->nbdesigner_read_json_setting($this->plugin_path_data . 'fonts.json');
            $cats = $font['cat'];
        }        
        if(isset($current_cat)){
            $new_list = array();
            foreach($list as $art){    
                if(in_array((string)$current_cat, $art->cat)) $new_list[] = $art;
            }
            foreach($cat as $c){
                if($c->id == $current_cat){
                    $name_current_cat = $c->name;
                    break;
                } 
                $name_current_cat = 'uploaded';
            }
            $list = $new_list;             
        }else{
            $name_current_cat = 'uploaded';
        }
        $total = sizeof($list);
        include_once(NBDESIGNER_PLUGIN_DIR . 'views/nbdesigner-manager-fonts.php');
    }
    /**
     * Analytics and statistics customer used product design
     * @since 1.5
     * 
    */    
    public function nbdesigner_analytics() {
        //TODO something
        include_once(NBDESIGNER_PLUGIN_DIR . 'views/nbdesigner-analytics.php');
    }    
    public function nbdesigner_update_list_fonts($font, $id = null) {
        if (isset($id)) {
            $this->nbdesigner_update_font($font, $id);
            return;
        }
        $list_font = array();
        $path = $this->plugin_path_data . 'fonts.json';
        $list = $this->nbdesigner_read_json_setting($path);
        if (is_array($list)) {
            $list_font = $list;
            $id = sizeOf($list_font);
            $font['id'] = (string) $id;
        }
        $list_font[] = $font;
        $res = json_encode($list_font);
        file_put_contents($path, $res);
    }
    public function nbdesigner_update_list_arts($art, $id = null) {
        $path = $this->plugin_path_data . 'arts.json';
        if (isset($id)) {
            $this->nbdesigner_update_json_setting($path, $art, $id);
            return;
        }
        $list_art = array();
        $list = $this->nbdesigner_read_json_setting($path);
        if (is_array($list)) {
            $list_art = $list;
            $id = sizeOf($list_art);
            $art['id'] = (string) $id;
        }
        $list_art[] = $art;
        $res = json_encode($list_art);
        file_put_contents($path, $res);
    }
    public function nbdesigner_read_json_setting($fullname) {
        if (file_exists($fullname)) {
            $list = json_decode(file_get_contents($fullname));           
        } else {
            $list = '';
            file_put_contents($fullname, $list);
        }
        return $list;
    }
    public function nbdesigner_delete_json_setting($fullname, $id, $reindex = true) {
        $list = $this->nbdesigner_read_json_setting($fullname);
        if (is_array($list)) {
            array_splice($list, $id, 1);
            if ($reindex) {
                $key = 0;
                foreach ($list as $val) {
                    $val->id = (string) $key;
                    $key++;
                }
            }
        }
        $res = json_encode($list);
        file_put_contents($fullname, $res);
    }
    public function nbdesigner_update_json_setting($fullname, $data, $id) {
        $list = $this->nbdesigner_read_json_setting($fullname);
        if (is_array($list))
            $list[$id] = $data;
        else {
            $list = array();
            $list[] = $data;
        }
        $_list = array();
        foreach ($list as $val) {
            $_list[] = $val;
        }
        $res = json_encode($_list);
        file_put_contents($fullname, $res);
    }
    public function nbdesigner_update_json_setting_depend($fullname, $id) {
        $list = $this->nbdesigner_read_json_setting($fullname);
        if (!is_array($list)) return;
        foreach ($list as $val) {             
            if (!((sizeof($val) > 0))) continue;
            //if (!sizeof($val->cat)) break;           
            foreach ($val->cat as $k => $v) {
                if ($v == $id) {                   
                    array_splice($val->cat, $k, 1);
                    break;
                }
            }
            foreach ($val->cat as $k => $v) {
                if ($v > $id) {
                    $new_v = (string) --$v;
                    unset($val->cat[$k]);
                    array_splice($val->cat, $k, 0, $new_v);
                    //$val->cat[$k] = (string)--$v;										
                }
            }
        }
        $res = json_encode($list);
        file_put_contents($fullname, $res);
    }
    public function nbdesigner_delete_font() {
        if (!wp_verify_nonce($_POST['nonce'], 'nbdesigner_add_cat') || !current_user_can('administrator')) {
            die('Security error');
        }
        $id = $_POST['id'];
        $type = $_POST['type'];
        if ($type == 'custom') {
            $path = $this->plugin_path_data . 'fonts.json';
            $list = $this->nbdesigner_read_json_setting($path);
            $file_font = $list[$id]->file;
            unlink($file_font);
        } else
            $path = $this->plugin_path_data . 'googlefonts.json';
        $this->nbdesigner_delete_json_setting($path, $id);
        echo 'success';
        wp_die();
    }
    public function nbdesigner_delete_art() {
        if (!wp_verify_nonce($_POST['nonce'], 'nbdesigner_add_cat') || !current_user_can('administrator')) {
            die('Security error');
        }
        $id = $_POST['id'];
        $path = $this->plugin_path_data . 'arts.json';
        $list = $this->nbdesigner_read_json_setting($path);
        $file_art = $list[$id]->file;
        unlink($file_art);
        $this->nbdesigner_delete_json_setting($path, $id);
        echo 'success';
        wp_die();
    }
    public function nbdesigner_update_font($font, $id) {
        $path = $this->plugin_path_data . 'fonts.json';
        $this->nbdesigner_update_json_setting($path, $font, $id);
    }
    public function nbdesigner_notices($value = '') {
        return $value;
    }
    public function nbdesigner_custom_notices($command, $mes) {
        switch ($command) {
            case 'success':
                if (!isset($mes))
                    $mes = __('Your settings have been saved.', $this->textdomain);
                $notice = '<div class="updated notice notice-success is-dismissible">
                                <p>' . $mes . '</p>
                                <button type="button" class="notice-dismiss">
                                    <span class="screen-reader-text">Dismiss this notice.</span>
                                </button>				  
                            </div>';
                break;
            case 'error':
                if (!isset($mes))
                    $mes = __('Irks! An error has occurred.', $this->textdomain);
                $notice = '<div class="notice notice-error is-dismissible">
                                <p>' . $mes . '</p>
                                <button type="button" class="notice-dismiss">
                                    <span class="screen-reader-text">Dismiss this notice.</span>
                                </button>				  
                            </div>';
                break;
            case 'notices':
                if (!isset($mes))
                    $mes = __('Irks! An error has occurred.', $this->textdomain);
                $notice = '<div class="notice notice-warning">
                                <p>' . $mes . '</p>				  
                            </div>';
                break;             
            case 'warning':
                if (!isset($mes))
                    $mes = __('Warning.', $this->textdomain);
                $notice = '<div class="notice notice-warning is-dismissible">
                                <p>' . $mes . '</p>
                                <button type="button" class="notice-dismiss">
                                    <span class="screen-reader-text">Dismiss this notice.</span>
                                </button>				  
                            </div>';
                break;
            default:
                $notice = '';
        }
        return $notice;
    }
    public function nbdesigner_manager_arts() {
        $notice = '';
        $current_art_cat_id = 0;
        $art_id = 0;
        $update = false;
        $cats = array("0");
        $list = $this->nbdesigner_read_json_setting($this->plugin_path_data . 'arts.json');
        $cat = $this->nbdesigner_read_json_setting($this->plugin_path_data . 'art_cat.json');
        $total = sizeof($list);
        $limit = 40;
        if (is_array($cat))
            $current_art_cat_id = sizeof($cat);
        if (isset($_GET['id'])) {
            $art_id = $_GET['id'];
            $update = true;
            if (isset($list[$art_id])) {
                $art_data = $list[$art_id];
                $cats = $art_data->cat;
            }
        }
        $page = filter_input(INPUT_GET, "p", FILTER_VALIDATE_INT);
        $current_cat = filter_input(INPUT_GET, "cat_id", FILTER_VALIDATE_INT);

        if (isset($_POST[$this->plugin_id . '_hidden']) && wp_verify_nonce($_POST[$this->plugin_id . '_hidden'], $this->plugin_id) && current_user_can('administrator')) {
            $art = array();
            $art['name'] = esc_html($_POST['nbdesigner_art_name']);
            $art['id'] = $_POST['nbdesigner_art_id'];
            $art['cat'] = $cats;
            if (isset($_POST['nbdesigner_art_cat']))
                $art['cat'] = $_POST['nbdesigner_art_cat'];
            if (isset($_FILES['svg']) && ($_FILES['svg']['size'] > 0) && ($_POST['nbdesigner_art_name'] != '')) {
                $uploaded_file_name = basename($_FILES['svg']['name']);
                $allowed_file_types = array('svg');
                if ($this->checkFileType($uploaded_file_name, $allowed_file_types)) {
                    $upload_overrides = array('test_form' => false);
                    $uploaded_file = wp_handle_upload($_FILES['svg'], $upload_overrides);
                    if (isset($uploaded_file['url'])) {
                        $art['file'] = $uploaded_file['file'];
                        $art['url'] = $uploaded_file['url'];
                        if ($update) {
                            $this->nbdesigner_update_list_arts($art, $art_id);
                        } else {
                            $this->nbdesigner_update_list_arts($art);
                        }
                        $notice = apply_filters('nbdesigner_notices', $this->nbdesigner_custom_notices('success', __('Your art has been saved.', $this->textdomain)));
                    } else {
                        $notice = apply_filters('nbdesigner_notices', $this->nbdesigner_custom_notices('error', __('Error while upload art, please try again!', $this->textdomain)));
                    }
                } else {
                    $notice = apply_filters('nbdesigner_notices', $this->nbdesigner_custom_notices('error', __('Incorrect file extensions.', $this->textdomain)));
                }
            } else if ($update && ($_POST['nbdesigner_art_name'] != '')) {
                $art_data->name = $_POST['nbdesigner_art_name'];
                $art_data->cat = $art['cat'];
                $this->nbdesigner_update_list_arts($art_data, $art_id);
                $notice = apply_filters('nbdesigner_notices', $this->nbdesigner_custom_notices('success', __('Your art has been saved.', $this->textdomain)));
            } else {
                $notice = apply_filters('nbdesigner_notices', $this->nbdesigner_custom_notices('warning', __('Please choose art file or art name.', $this->textdomain)));
            }
            $list = $this->nbdesigner_read_json_setting($this->plugin_path_data . 'arts.json');
            $cats = $art['cat'];
            $total = sizeof($list);
            
        }
        $name_current_cat = 'uploaded';
        if($total){
            if(isset($current_cat)){
                $new_list = array();
                foreach($list as $art){  
                    if(in_array((string)$current_cat, $art->cat)) $new_list[] = $art;
                    if(($current_cat == 0) && sizeof($art->cat) == 0) $new_list[] = $art;
                }
                foreach($cat as $c){
                    if($c->id == $current_cat){
                        $name_current_cat = $c->name;
                        break;
                    } 
                    $name_current_cat = 'uploaded';
                }
                $list = $new_list;
                $total = sizeof($list);               
            }else{
                $name_current_cat = 'uploaded';
            }
            if(isset($page)){
                $_tp = ceil($total / $limit);
                if($page > $_tp) $page = $_tp;
                $_list = array_slice($list, ($page-1)*$limit, $limit);
            }else{
                $_list = $list;
                if($total > $limit) $_list = array_slice($list, 0, $limit);	
            }
        } else{
            $_list = array();
        }        
        if(isset($current_cat)){
            $url = add_query_arg(array('cat_id' => $current_cat), admin_url('admin.php?page=nbdesigner_manager_arts'));
        }else{
            $url = admin_url('admin.php?page=nbdesigner_manager_arts');   
        }
        require_once NBDESIGNER_PLUGIN_DIR . 'includes/class.nbdesigner.pagination.php';
        $paging = new Nbdesigner_Pagination();
        $config = array(
            'current_page'  => isset($page) ? $page : 1, 
            'total_record'  => $total,
            'limit'         => $limit,
            'link_full'     => $url.'&p={p}',
            'link_first'    => $url              
        );	        
        $paging->init($config);         
        include_once(NBDESIGNER_PLUGIN_DIR . 'views/nbdesigner-manager-arts.php');
    }
    public function admin_success() {
        if (isset($_POST[$this->plugin_id . '_hidden']) && wp_verify_nonce($_POST[$this->plugin_id . '_hidden'], $this->plugin_id)){
            echo '<div class="updated notice notice-success is-dismissible">
                        <p>' . __('Your settings have been saved.', $this->textdomain) . '</p>
                        <button type="button" class="notice-dismiss">
                            <span class="screen-reader-text">Dismiss this notice.</span>
                        </button>				  
                  </div>';
        }
    }
    public function add_design_box() {
        add_meta_box('nbdesigner_setting', __('Setting NBDesigner', 'nbdesigner'), array($this, 'setting_design'), 'product', 'normal', 'high');
        add_meta_box('nbdesigner_order', __('Customer Design', 'nbdesigner'), array($this, 'order_design'), 'shop_order', 'side', 'default');
    }
    public function nbdesigner_detail_order() {
        if(isset($_GET['order_id'])){
            $order_id = $_GET['order_id'];
            $order = new WC_Order($order_id);
            $user_id = $order->user_id;  
            if($user_id == ''){
                $iid = get_post_meta($order_id, '_nbdesigner_order_userid', true);
                if(!empty($iid))
                    $user_id = $iid;
            }            
            if(isset($_GET['download-all']) && ($_GET['download-all'] == 'true')){
                $zip_files = array();
                $_data_designs = unserialize(get_post_meta($order_id, '_nbdesigner_design_file', true));
                if(isset($_data_designs) && is_array($_data_designs))    $data_designs = $_data_designs;
                $products = $order->get_items();
                foreach($products AS $order_item_id => $product){
                    $has_design = wc_get_order_item_meta($order_item_id, '_nbdesigner_has_design');                  
                    if($has_design == 'has_design'){
                        $folder_design = wc_get_order_item_meta($order_item_id, '_nbdesigner_folder_design');
                        if($folder_design){
                            $path = $this->plugin_path_data . 'designs/' . $user_id . '/' . $order_id .'/' .$folder_design;
                        }else{
                            $path = $this->plugin_path_data . 'designs/' . $user_id . '/' . $order_id .'/' .$product["product_id"];
                        }                        
                        $list_images = $this->nbdesigner_list_thumb($path, 1);
                        if(count($list_images) > 0){
                            foreach($list_images as $key => $image){
                                $zip_files[] = $image;
                            }
                        }
                    }              
                }
                $pathZip = $this->plugin_path_data.'download/customer-design-'.$_GET['order_id'].'.zip';
                $nameZip = 'customer-design-'.$_GET['order_id'].'.zip';
                $this->zip_files_and_download($zip_files, $pathZip, $nameZip);
            }
            if(isset($_GET['product_id'])){
                $product_id = $_GET['product_id'];
                $path = $this->plugin_path_data . 'designs/' . $user_id . '/' . $order_id .'/' .$product_id;  
                if(isset($_GET['order_item_id'])){
                    $order_item_id = $_GET['order_item_id'];
                    $folder_design = wc_get_order_item_meta($order_item_id, '_nbdesigner_folder_design');     
                    $path = $this->plugin_path_data . 'designs/' . $user_id . '/' . $order_id .'/' .$folder_design;  
                }
                $datas = unserialize(get_post_meta($product_id, '_designer_setting', true)); 
                $list_design = array();
                $list_images = $this->nbdesigner_list_thumb($path, 1);
                $up = wp_upload_dir();
                $base_path = $up['baseurl'];
                if(isset($folder_design)){
                    $mid_path = 'nbdesigner/designs/' . $user_id . '/' . $order_id .'/' .$folder_design.'/';  
                }else{
                    $mid_path = 'nbdesigner/designs/' . $user_id . '/' . $order_id .'/' .$product_id.'/';  
                }
                foreach ($list_images as $img){
                    $name = basename($img);
                    $url = $base_path.'/'.$mid_path.$name;
                    $arr = explode('.', $name);
                    $_frame = explode('_', $arr[0]);
                    $frame = $_frame[1];
                    $list_design[$frame] = $url;
                }
            }
        }
        require_once NBDESIGNER_PLUGIN_DIR .'views/nbdesigner-detail-order.php';
    }
    public function setting_design() {
        global $wpdb;
        $current_screen = get_current_screen();
        $designer_setting = array(
            array(
                'orientation_name' => 'frame_1',
                'img_src' => NBDESIGNER_PLUGIN_URL . 'assets/images/default.png',
                'real_width' => '30',
                'real_height' => '30',
                'area_design_top' => '50',
                'area_design_left' => '50',
                'area_design_width' => '200',
                'area_design_height' => '200'
            )
        );
        $post_id = get_the_ID();
        $_designer_setting = unserialize(get_post_meta($post_id, '_designer_setting', true));
        $dpi = get_post_meta($post_id, '_nbdesigner_dpi', true);
        $enable = get_post_meta($post_id, '_nbdesigner_enable', true);
        $option = unserialize(get_post_meta($post_id, '_nbdesigner_option', true));
        $check = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name='nbdesigner-admindesign-product-x1095'"); 
        $priority = get_post_meta($post_id, '_nbdesigner_admintemplate_primary', true);
        if($check != ''){
            $link_admindesign = get_page_link($check).'?product_id='.$post_id;
        }else{
            $link_admindesign = '#';
        }        
        if($dpi == "") $dpi = 96;
        if (isset($_designer_setting[0])) $designer_setting = $_designer_setting;
        include_once(NBDESIGNER_PLUGIN_DIR . 'views/nbdesigner-box-design-setting.php');
    }
    public function order_design($post) {
        $order = new WC_Order($post->ID);
        $user_id = $order->user_id;       
        if($user_id == ''){
            $iid = get_post_meta($post->ID, '_nbdesigner_order_userid', true);
            if(!empty($iid))
                $user_id = $iid;
        }
        $order_id = $post->ID;
        $products = $order->get_items();
        $_data_designs = unserialize(get_post_meta($order_id, '_nbdesigner_design_file', true));
        if(isset($_data_designs) && is_array($_data_designs))    $data_designs = $_data_designs;
        $has_design = get_post_meta($order_id, '_nbdesigner_order_has_design', true);
        include_once(NBDESIGNER_PLUGIN_DIR . 'views/nbdesigner-box-order-metadata.php');
    }
    public function nbdesigner_approve_order_design($index){
        /*TODO*/
    }
    public function nbdesigner_allow_create_product($id){
        $check = $this->nbdesigner_check_license();
        $args = array(
            'post_type'  => 'product',
            'meta_key' => '_nbdesigner_enable',
            'meta_value' => 1
        );
        $query = new WP_Query($args);
        $pros = get_posts($args);
        $list = array();
        foreach ($pros as $pro){
            $list[] = $pro->ID;
        }        
        $count = $query->found_posts;
        $license = $this->nbdesigner_check_license();
        if(!isset($license['key'])) return false;
        if(in_array($id, $list)) return true;
        $salt = md5($license['key'].'pro'); 
        if(($salt != $license['salt']) && ($count > 500)) return false;
        return true;
    }
    public function nbdesigner_get_info_license(){
        if (!wp_verify_nonce($_POST['_nbdesigner_license_nonce'], 'nbdesigner-active-key') || !current_user_can('administrator')) {
            die('Security error');
        } 
        $result = array();
        if(isset($_POST['nbdesigner']['license'])) {
            $license = $_POST['nbdesigner']['license'];            
            $result_from_json = $this->nbdesiger_request_license($license, $this->activedomain);
            $data = (array)json_decode($result_from_json);            
            if(isset($data)) {
                switch ($data["code"]) {
                    case -1 :
                        $result['mes'] = __('Missing necessary information!', $this->textdomain);
                        $result['flag'] = 0;
                        break;
                    case 0 :
                        $result['mes'] = __('Incorrect information, check again license key', $this->textdomain);
                        $result['flag'] = 0;
                        break;     
                    case 1 :
                        $result['mes'] = __('Incorrect License key', $this->textdomain);
                        $result['flag'] = 0;
                        break;
                    case 2 :
                        $result['mes'] = __('License key is locked ', $this->textdomain);
                        $result['flag'] = 0;
                        break; 
                    case 3 :
                        $result['mes'] = __('License key have expired', $this->textdomain);
                        $result['flag'] = 0;
                        break;
                    case 4 :
                        $result['mes'] = __('Link your website incorrect', $this->textdomain);
                        $result['flag'] = 0;
                        break;     
                    case 5 :
                        $result['mes'] = __('License key can using', $this->textdomain);
                        $result['flag'] = 1;
                        break;
                    case 6 :
                        $result['mes'] = __('Domain has been added successfully', $this->textdomain);
                        $result['flag'] = 1;
                        break;     
                    case 7 :
                        $result['mes'] = __('Exceed your number of domain license', $this->textdomain);
                        $result['flag'] = 0;
                        break;
                    case 8 :
                        $result['mes'] = __('Unsuccessfully active license key', $this->textdomain);
                        $result['flag'] = 0;
                        break;                     
                }            
                $data['key'] = $license;
                $data['salt'] = md5($license.$data['type']);
                if($data['type'] == 'free') $data['number_domain'] = "5";
                if(($data["code"] == 5) || ($data["code"] == 6)){
                    $this->nbdesigner_write_license(json_encode($data));  
                }                      
            }else{
                $result['mes'] = __('Try again later!', $this->textdomain);
            }
        }else {
            $result['mes'] = __('Please fill your license!', $this->textdomain);
        }
        echo json_encode($result);
        wp_die();
    }
    public function nbdesigner_remove_license(){
        if (!wp_verify_nonce($_POST['_nbdesigner_license_nonce'], 'nbdesigner-active-key') || !current_user_can('administrator')) {
            die('Security error');
        } 	        
        $result = array();
        $result['flag'] = 0;
        $path = NBDESIGNER_PLUGIN_DIR . 'data/license.json';
        $path_data = $this->plugin_path_data . 'data/license.json';
        if(file_exists($path_data)) {
            $path = $path_data;
        }
        $license = $this->nbdesigner_check_license();
        if(!file_exists($path)){
            $result['mes'] = __('You haven\'t any license!', $this->textdomain);
        }else{
            $license = $this->nbdesigner_check_license();
            $key = (isset($license['key'])) ? $license['key'] : '';
            $_request = $this->nbdesiger_request_license($key, $this->removedomain);             
            if(isset($_request)){              
                $request = (array)json_decode($_request);                   
                switch ($request["code"]) {
                    case -1:
                        $result['mes'] = __('Missing necessary information', $this->textdomain);
                        break;
                    case 0:
                        $result['mes'] = __('Incorrect information', $this->textdomain);
                        break;
                    case 1:
                        $result['mes'] = __('Incorrect License key', $this->textdomain);
                        break;
                    case 2: 
                        if(!unlink($path)){
                            $result['mes'] = __('Error, try again later!', $this->textdomain);
                        }else{
                            $_path = NBDESIGNER_PLUGIN_DIR . 'data/license.json';
                            if(file_exists($_path)) unlink($_path);                        
                            $result['mes'] = __('Remove license key Successfully', $this->textdomain);
                            $result['flag'] = 1;
                        };                        
                        break;  
                    case 3:
                        $result['mes'] = __('Remove license key Unsuccessfully!', $this->textdomain);
                        break;                    
                }
            }
        }       
        echo json_encode($result);
        wp_die();        
    }
    private function nbdesiger_request_license($license, $task){
        $url_root = base64_encode(get_bloginfo('wpurl'));	
        if(ini_get('allow_url_fopen')){
            $result_from_json = file_get_contents($this->author_site.$task.$this->nbdesigner_sku.'/'.$license.'/'.$url_root);    
        }else{
            $url = $this->author_site.$task.$this->nbdesigner_sku.'/'.$license.'/'.$url_root;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSLVERSION, 3); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);                        
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result_from_json = curl_exec($ch);
            curl_close($ch);                          
        }
        return $result_from_json;
    }
    private function nbdesigner_write_license($license){
//        $path = NBDESIGNER_PLUGIN_DIR . 'data/license.json';
//        if($file_handle = @fopen($path, 'w')){
//            fwrite( $file_handle, $license );
//            fclose( $file_handle );            
//        }
        $path_data = $this->plugin_path_data . 'data/license.json';
        file_put_contents($path_data, $license);
    }
    private function nbdesigner_check_license(){
        $path_data = $this->plugin_path_data . 'data/license.json';
        $path = NBDESIGNER_PLUGIN_DIR . 'data/license.json';
        if(file_exists($path_data)) $path = $path_data;
        $result = array();
        $result['status'] = 1;
        if(!file_exists($path)){
            $result['status'] = 0;
        }else{
            $data = (array) json_decode(file_get_contents($path));
            $code = (isset($data["code"])) ? $data["code"] : 10;
            if(($code != 5) && ($code != 6)){
                $result['status'] = 0;	               
            }
            $now = strtotime("now");
            $expiry_date = (isset($data["expiry-date"])) ? $data["expiry-date"] : 0;
            $result['expiry'] = $expiry_date;
            if($expiry_date < $now){
                $result['status'] = 0;             
            }
            if(isset($data['key'])) $result['key'] = $data['key'];
            if(isset($data['type'])) {	                
                $result['type'] = $data['type'];
                $license = (isset($data['key'])) ? $data['key'] : 'somethingiswrong';
                $salt = (isset($data['salt'])) ? $data['salt'] : 'somethingiswrong';
                $new_salt = md5($license.'pro');	                
                if($salt == $new_salt){
                    $result['type'] = $data['type'];
                }else{
                    $result['type'] = 'free';
                    $result['status'] = 0;    
                } 
                $result['salt'] = $salt;
            }
        }
        return $result;
    }
    private function nbdesigner_get_site_url() {
        if (isset($_SERVER['HTTPS'])) {
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        } else {
            $protocol = 'http';
        }
        $base_url = $protocol . "://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER["REQUEST_URI"] . '?') . '/';
        return base64_encode($base_url);
    }
    public function save_design($post_id) {        
        if (!isset($_POST['nbdesigner_setting_box_nonce']) || !wp_verify_nonce($_POST['nbdesigner_setting_box_nonce'], 'nbdesigner_setting_box')
            || !(current_user_can('administrator') || current_user_can('shop_manager'))) {
            return $post_id;
        }
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } else {
            if (!current_user_can('edit_post', $post_id)) {
                return $post_id;
            }
        }
        $enable = $_POST['_nbdesigner_enable']; 
        $dpi = $_POST['_nbdesigner_dpi']; 
        $option = serialize($_POST['_nbdesigner_option']); 
        if(!is_numeric($dpi)) $dpi = 96;
        $dpi = abs($dpi);
        $setting = serialize($_POST['_designer_setting']);  
        if(!$enable){            
            $setting = '';
            update_post_meta($post_id, '_designer_setting', $setting);
            update_post_meta($post_id, '_nbdesigner_dpi', $dpi);
            update_post_meta($post_id, '_nbdesigner_option', $option);
            update_post_meta($post_id, '_nbdesigner_enable', $enable);
            return;
        }
        if(!$this->nbdesigner_allow_create_product($post_id)) return;
        update_post_meta($post_id, '_designer_setting', $setting);
        update_post_meta($post_id, '_nbdesigner_dpi', $dpi);
        update_post_meta($post_id, '_nbdesigner_option', $option);
        update_post_meta($post_id, '_nbdesigner_enable', $enable);
    }
    public function checkFileType($file_name, $arr_mime) {
        $check = false;
        $filetype = explode('.', $file_name);
        $file_exten = $filetype[count($filetype) - 1];
        if (in_array(strtolower($file_exten), $arr_mime)) $check = true;
        return $check;
    }
    public function nbdesigner_get_extension($file_name) {
        $filetype = explode('.', $file_name);
        $file_exten = $filetype[count($filetype) - 1];
        return $file_exten;
    }
    public function nbdesigner_button() {
        $temp = get_query_var( 'nbds-adid' ) ? get_query_var( 'nbds-adid' ) : 0;
        $ref = get_query_var( 'nbds-ref' ) ? get_query_var( 'nbds-ref' ) : 0;
        $is_nbdesign = get_post_meta(get_the_ID(), '_nbdesigner_enable', true);
        $uid = get_current_user_id();
        $sid = session_id();
        $pid = get_the_ID();
        $list_image = array();
        $order = 'nb_order';
        if ($is_nbdesign) {
            if ($uid > 0) {
                $iid = $uid;
                if (isset($_GET['orderid']))
                    $order = $_GET['orderid'];
            }else {
                $iid = $sid;
            };
            if(is_array(get_option('nbdesigner'))){
                $opt_val = get_option('nbdesigner');
            }else{
                $opt_val = $this->default_option;
            }
            $path = $this->plugin_path_data . 'designs/' . $iid . '/' . $order . '/' . $pid . '/thumbs';
            //$list_image = $this->nbdesigner_list_thumb($path);
            $div_image = '<div id="nbdesigner_frontend_area"></div>';
            $button = '<div class="nbdesigner_frontend_container">';
            $button .= '<a class="button nbdesign-button nbdesigner-disable" id="triggerDesign" >'.$opt_val['btname'].'</a><a class="button nbdesign-button-loading"><img class="nbdesigner-img-loading rotating" src="'.NBDESIGNER_PLUGIN_URL.'assets/images/loading.png'.'"/>'. __('Loading', $this->textdomain).'</a><br />' . $div_image;
            $button .= '</div><br />';
            //$src = NBDESIGNER_PLUGIN_URL . 'views/nbdesigner-frontend.php?product_id=' . get_the_ID();
            $src = add_query_arg(array('action' => 'nbdesigner_editor_html', 'product_id' => get_the_ID()), site_url());                    
            if(is_numeric($order)) $src .= '&orderid='.$order;
            if($temp) $src .= '&temp='.$temp;
            if($ref) $src .= '&ref='.$ref;
            $button .= '<div style="position: fixed; top: 0; left: 0; z-index: 999999; opacity: 0; width: 100%; height: 100%;" id="container-online-designer"><iframe id="onlinedesigner-designer"  width="100%" height="100%" scrolling="no" frameborder="0" noresize="noresize" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true" src="' . $src . '"></iframe><span id="closeFrameDesign"  class="nbdesigner_pp_close">&times;</span></div>';
            echo $button;
        }
    }
    public function nbdesigner_get_product_info() {
        if (!wp_verify_nonce($_POST['nonce'], 'save-design')) {
            die('Security error');
        }
        $id = $_POST['id'];  
        $iid = session_id();
        if(isset($_POST['variation'])) $variation = $_POST['variation'];
        if (is_numeric($id)) {
            $data['product'] = unserialize(get_post_meta($id, '_designer_setting', true));
            if(is_numeric($variation)){
                $variation_enable = get_post_meta($variation, '_nbdesigner_enable'.$variation, true);
                if($variation_enable){
                    $variation_product = unserialize(get_post_meta($variation, '_designer_setting'.$variation, true));
                    if(is_array($variation_product)) $data['product'] = $variation_product;
                }
            }
            $data['dpi'] = get_post_meta($id, '_nbdesigner_dpi', true);
            $option = unserialize(get_post_meta($id, '_nbdesigner_option', true));           
            if($data['dpi'] == "") $data['dpi'] = 96;
            $uid = get_current_user_id();
            if(isset($_POST['oid']) && ($_POST['oid'] != '')){                
                $oid = $_POST['oid'];
                $folder_design = $id;
                if(isset($_POST['folder']) && ($_POST['folder'] != '')){ 
                    $folder_design = $_POST['folder'];
                }
                if($uid > 0){
                    $iid = $uid;
                }
                $path = $this->plugin_path_data. 'designs/' .$iid. '/' .$oid. '/' .$folder_design. '/design.json';
                $path_config = $this->plugin_path_data. 'designs/' .$iid. '/' .$oid. '/' .$folder_design. '/config.json';
                $path_font = $this->plugin_path_data. 'designs/' .$iid. '/' .$oid. '/' .$folder_design. '/used_font.json';
                $data_design = $this->nbdesigner_read_json_setting($path);
                $data['design'] = $data_design;         
                if(file_exists($path_config)){					
                    $data['config'] = $this->nbdesigner_read_json_setting($path_config);					
                } else {
                    $data['config'] = '';
                }     
                if(file_exists($path_font)){					
                    $data['fonts'] = $this->nbdesigner_read_json_setting($path_font);	
                    $data['font_url'] = content_url().'/uploads/nbdesigner/fonts/';
                } else{
                    $data['fonts'] = '';
                }                                       
            }else if(isset($_POST['ref']) && ($_POST['ref'] != '')){
                $ref = absint($_POST['ref']);
                $iid = session_id();
                if ($uid > 0) $iid = $uid;
                $path = $this->plugin_path_data. 'designs/' .$iid. '/nb_order/' .$ref. '/design.json';
                $path_config = $this->plugin_path_data. 'designs/' .$iid. '/nb_order/' .$ref. '/config.json';
                $path_font = $this->plugin_path_data. 'designs/' .$iid. '/nb_order/' .$ref. '/used_font.json';
                $data['design'] = $this->nbdesigner_read_json_setting($path);
                $data['ref'] = unserialize(get_post_meta($ref, '_designer_setting', true));
                if(file_exists($path_config)){					
                    $data['config'] = $this->nbdesigner_read_json_setting($path_config);					
                }else {
                    $data['config'] = '';
                }     
                if(file_exists($path_font)){					
                    $data['fonts'] = $this->nbdesigner_read_json_setting($path_font);	
                    $data['font_url'] = content_url().'/uploads/nbdesigner/fonts/';
                } else{
                    $data['fonts'] = '';
                }                   
            }else if(isset($option['admindesign']) && $option['admindesign']){
                if(isset($_POST['did']) && $_POST['did'] != ''){
                    $folder = $_POST['did'];
                    $path = $this->plugin_path_data. 'admindesign/' .$id. '/'.$folder.'/design.json';	
                    $path_config = $this->plugin_path_data. 'admindesign/' .$id. '/' .$folder. '/config.json';  
                    $path_font = $this->plugin_path_data. 'admindesign/' .$id. '/' .$folder. '/used_font.json';
                }else{
                    $path = $this->plugin_path_data. 'admindesign/' .$id. '/primary/design.json';	
                    $path_config = $this->plugin_path_data. 'admindesign/' .$id. '/primary/config.json';
                    $path_font = $this->plugin_path_data. 'admindesign/' .$id. '/primary/used_font.json';
                }
                if(file_exists($path)){					
                    $data_design = $this->nbdesigner_read_json_setting($path);
                    $data['admindesign'] = $data_design;  					
                }else {
                    $data['admindesign'] = '';
                }
                if(file_exists($path_config)){					
                    $data_config = $this->nbdesigner_read_json_setting($path_config);
                    $data['config'] = $data_config;  					
                }else {
                    $data['config'] = '';
                }                
                if(file_exists($path_font)){
                    $data_fonts = $this->nbdesigner_read_json_setting($path_font);
                    $data['fonts'] = $data_fonts;   
                    $data['font_url'] = content_url().'/uploads/nbdesigner/fonts/';
                } else{
                    $data['fonts'] = '';
                }               
                $data['design'] = '';
            }else{
                $data['design'] = '';
            }	           
            echo json_encode($data);
        } else {
            echo 'Incorect product ID';
        }
        wp_die();
    }
    public function nbdesigner_save_customer_design() {
        if (!wp_verify_nonce($_POST['nonce'], 'save-design')) {
            die('Security error');
        }    
        $sid = esc_html($_POST['sid']);
        $pid = $_POST['product_id'];  
        $oid = $_POST['orderid'];	  
        $task = $_POST['task'];	 
        $folder_design = $_POST['folder'];	 
        $oiid = $_POST['oiid'];	 
        $config = str_replace('\"', '"', $_POST['config']);
        $fonts = str_replace('\"', '"', $_POST['fonts']);
        $iid = $sid;
        if(isset($_POST['image'])){
            $data = $_POST['image']['img'];
            $json = str_replace('\"', '"', $_POST['image']['json']);	
            $json = str_replace('\\\\', '\\', $json);	
        } else{
            die('Incorect data!');
        }     
        $uid = get_current_user_id();  
        if($uid > 0) $iid = $uid;
        if (!is_numeric($pid) || !isset($data) || !is_array($data)) die('Incorect data!');
        $result['flag'] = 'Fails to save design.';
        $result['redesign'] = '';
        $order = 'nb_order';
        $accept_save =  true;
        if(($oid != '')){
            $order_design_approve = unserialize(get_post_meta($oid, '_nbdesigner_design_file', true));
            $index = 'nbds_'.$oiid;    
            if((!isset($order_design_approve[$index])) || (isset($order_design_approve[$index]) && ($order_design_approve[$index] == 'accept')))
                $accept_save = false;
        }
        if ($uid > 0) {
            if($task == 'admindesign'){
                if($_POST['priority'] == 'primary'){
                    $ad_priority = 'primary';
                    $ad_folder = 'primary';
                    $priority = 1;
                }else if($_POST['priority'] == 'extra'){
                    $ad_folder = time();
                    if(isset($_POST['adid']) && $_POST['adid'] != '') $ad_folder = $_POST['adid'];
                    $ad_priority = 'extra';
                    $priority = 0;
                }                
                $data_after_save_image = $this->nbdesigner_save_design_to_image($data, $sid, $pid, array('priority' => $ad_priority, 'folder' => $ad_folder));
                $json_file = $this->plugin_path_data . 'admindesign/' . $pid . '/' . $ad_folder . '/design.json';    
                $json_used_font = $this->plugin_path_data . 'admindesign/' . $pid . '/' . $ad_folder .'/used_font.json'; 
                $json_config = $this->plugin_path_data . 'admindesign/' . $pid . '/' . $ad_folder . '/config.json';                 
                if (!count($data_after_save_image['mes'])) {                    
                    $ad_path = $this->plugin_path_data . 'admindesign/' . $pid . '/' . $ad_folder;
                    $this->nbdesigner_create_thumbnail_design($ad_path, $ad_path.'/preview', $pid, 300, 300);     
                    if($ad_priority == 'primary'){
                        update_post_meta($pid, '_nbdesigner_admintemplate_primary', 1);
                    }
                    if($_POST['save_status'] == "0"){
                        $this->nbdesigner_insert_table_templates($pid, $ad_folder, $priority, 1, 0);
                    }
                }             
            }else{
                $_folder = $pid;
                if($folder_design != '') $_folder = $folder_design;
                $json_file = $this->plugin_path_data . 'designs/' . $uid . '/' . $order . '/' . $_folder . '/design.json';
                $json_config = $this->plugin_path_data . 'designs/' . $uid . '/' . $order . '/' . $_folder . '/config.json';
                $json_used_font = $this->plugin_path_data . 'designs/' . $uid . '/' . $order . '/' . $_folder . '/used_font.json';
                if($accept_save) $data_after_save_image = $this->nbdesigner_save_design_to_image($data, $uid, $_folder, '');
            }    
        } else {         
            $iid = $sid;
            $_folder = $pid;
            if($folder_design != '') $_folder = $folder_design;            
            if($accept_save) $data_after_save_image = $this->nbdesigner_save_design_to_image($data, $sid, $_folder, '');
            $json_file = $this->plugin_path_data . 'designs/' . $sid . '/' . $order . '/' . $_folder . '/design.json';
            $json_config = $this->plugin_path_data . 'designs/' . $sid . '/' . $order . '/' . $_folder . '/config.json';
            $json_used_font = $this->plugin_path_data . 'designs/' . $sid . '/' . $order . '/' . $_folder . '/used_font.json';
        } 
        if($accept_save){
            file_put_contents($json_file, $json);
            file_put_contents($json_config, $config);
            file_put_contents($json_used_font, $fonts);
            if (!count($data_after_save_image['mes'])) {
                $result['image'] = $data_after_save_image['link'];
                $result['flag'] = 'success';
                $path = $this->plugin_path_data . 'designs/' . $iid . '/nb_order/' . $pid . '/thumbs';
                if(($oid == '') && ($task != 'admindesign')){
                    $_SESSION['nbdesigner']['nbdesigner_' . $pid] = json_encode($this->nbdesigner_list_thumb($path));
                }
            }
        }
        if(($oid != '')){           
            if(isset($order_design_approve[$index]) && ($order_design_approve[$index] == 'decline')){          
                $path_product = $this->plugin_path_data. 'designs/' .$iid. '/' .$oid. '/' .$folder_design;
                $path_old = $this->plugin_path_data. 'designs/' .$iid. '/' .$oid. '/' .$folder_design. '_old';
                $path_new = $this->plugin_path_data. 'designs/' .$iid. '/nb_order/' .$folder_design;
                if(file_exists($path_old)) $this->nbdesigner_delete_folder($path_old);
                rename($path_product, $path_old);
                if(wp_mkdir_p($path_product)){
                    $this->nbdesigner_copy_dir($path_new, $path_product);
                    $result['redesign'] = __("Your design has been saved success! Please wait response email!", $this->textdomain);
                    update_post_meta($oid, '_nbdesigner_order_changed', 1);                  
                }
            }else {
                $result['flag'] = 'pendding';
                $result['redesign'] = __("Your design has been approved or pendding to review!", $this->textdomain);
            }
        }
        echo json_encode($result);
        wp_die();
    }
    public function nbdesigner_start_session() {
        if (!session_id()){
            @session_start();
        }
    }
    /**
     * Create table manager template
     * @since 1.5.0
     */
    public static function nbdesigner_create_table_templates(){
        global $wpdb;
        $collate = '';
        if ( $wpdb->has_cap( 'collation' ) ) {
            $collate = $wpdb->get_charset_collate();
        } 
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        if (NBDESIGNER_VERSION != get_option("nbdesigner_version_plugin")) {
            //PRIMARY KEY must have 2 spaces before for dbDelta to work
            $tables =  "
CREATE TABLE {$wpdb->prefix}nbdesigner_templates ( 
 id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
 product_id BIGINT(20) UNSIGNED NOT NULL,
 folder varchar(255) NOT NULL,
 user_id BIGINT(20) NULL, 
 create_date DATETIME NOT NULL default '0000-00-00 00:00:00',
 publish TINYINT(1) NOT NULL default 1,
 private TINYINT(1) NOT NULL default 0,
 priority  TINYINT(1) NOT NULL default 0,
 PRIMARY KEY  (id) 
) $collate;
            ";
            @dbDelta($tables);
        }
        update_option('nbdesigner_version_plugin', NBDESIGNER_VERSION);
        return true;
    }
    /**
     * Insert table templates
     * @since 1.5.0
     * 
     * @global type $wpdb
     * @param int $product_id
     * @param varchar $folder
     * @param int $priority
     * @param int $publish
     * @param int $private
     */
    private function nbdesigner_insert_table_templates($product_id, $folder, $priority, $publish = 1, $private = 0){
        global $wpdb;
        $create_date = new DateTime();
        $user_id = wp_get_current_user()->ID;
        $table_name =  $wpdb->prefix . 'nbdesigner_templates';
        $wpdb->insert($table_name, array(
            'product_id' => $product_id,
            'folder' => $folder,
            'user_id' => $user_id,
            'create_date' => $create_date->format('Y-m-d H:i:s'),
            'publish' => $publish,
            'private' => $private,
            'priority' => $priority
        ));
        return true;
    }
    /**
     * Update table templates
     * @since 1.5.0
     * 
     * @global type $wpdb
     * @param int $product_id product id
     * @param char $folder folder name
     * @param int $priority priority ex: primary, extra
     * @param int $publish publish or unpublish
     * @param int $private private or publish
     * @return boolean
     */
    private function nbdesigner_update_table_templates($product_id, $folder, $priority = '', $publish = '', $private = ''){
        global $wpdb;
        $data = array();
        if($priority !== '') $data['priority'] = $priority;
        if($publish !== '') $data['publish'] = $publish;
        if($private !== '') $data['private'] = $private;
        $wpdb->update( $wpdb->prefix . 'nbdesigner_templates', $data, array( 'product_id' => $product_id, 'folder' => $folder ) );
        return true;
    }
    private function nbdesigner_delete_record_templates($product_id, $folder){
        global $wpdb;
        $wpdb->delete( $wpdb->prefix . 'nbdesigner_templates', array( 'product_id' => $product_id, 'folder' => $folder ) );
        return true;
    }
    private function nbdesigner_get_template_from_db($product_id, $status){
        global $wpdb;
        $table_name = $wpdb->prefix . 'nbdesigner_templates';
        if($status == 'unpublish'){
            $sql = "SELECT * FROM $table_name WHERE product_id = '$product_id' AND publish = 0 ORDER BY create_date DESC";
        }else if($status == 'publish'){
            $sql = "SELECT * FROM $table_name WHERE product_id = '$product_id' AND publish = 1 ORDER BY create_date DESC";
        }else {
            $sql = "SELECT * FROM $table_name WHERE product_id = '$product_id' AND private = 1 ORDER BY create_date DESC";
        }
        $results = $wpdb->get_results($sql);
        return $results;
    }
    public function nbdesigner_end_session() {
        if(isset($_SESSION['nbdesigner'])) unset($_SESSION['nbdesigner']);
    }
    public function nbdesigner_save_design_to_image($data, $sid, $pid, $task = '') {
        $links = array();
        $mes = array();
        $order = 'nb_order';
        if(is_array($task) && $task['priority'] != ''){
            $path = $this->plugin_path_data . 'admindesign/' . $pid . '/' .$task['folder'];
        }else{
            $path = $this->plugin_path_data . 'designs/' . $sid . '/' . $order . '/' . $pid;
        }
        $path_thumb = $path . '/thumbs';
        if(file_exists($path)){
            $this->nbdesigner_delete_folder($path);
        }
        if (!file_exists($path)) {
            if (wp_mkdir_p($path)) {
                if (!file_exists($path_thumb))
                    if (!wp_mkdir_p($path_thumb)) {
                        $mes[] = __('Your server not allow creat folder', $this->textdomain);
                    }
            } else {
                $mes[] = __('Your server not allow creat folder', $this->textdomain);
            }
        }
        foreach ($data as $key => $val) {
            $temp = explode(';base64,', $val);
            $buffer = base64_decode($temp[1]);
            $full_name = $path . '/' . $key . '.png';
            if ($this->nbdesigner_save_data_to_image($full_name, $buffer)) {
                $image = wp_get_image_editor($full_name);
                $opt_val = get_option('nbdesigner');  
                $_width = 60;
                $_height = 60;
                $_quality = 76;                
                if(is_array($opt_val)){
                    extract($opt_val);   
                    $_width = $thumbnail_width;
                    $_height = $thumbnail_height;
                    $_quality = $thumbnail_quality;
                }
                if (!is_wp_error($image)) {
                    $thumb_file = $path_thumb . '/' . $key . '.png';
                    $image->resize($_width, $_height, 1);
                    $image->set_quality($_quality);
                    if ($image->save($thumb_file, 'image/png'))
                        $links[$key] = $this->nbdesigner_create_secret_image_url($thumb_file);
                }
            } else {
                $mes[] = __('Your server not allow writable file', $this->textdomain);
            }
        }
        return array('link' => $links, 'mes' => $mes);
    }
    public function nbdesigner_save_webcam_image(){
        if (!wp_verify_nonce($_POST['nonce'], 'save-design')) {
            die('Security error');
        } 
        $result = array();
        $img = $_POST['image'];
        $data = base64_decode($img);
        $full_name = $this->plugin_path_data . 'temp/' . time() .'.png';
        $success = file_put_contents($full_name, $data);
        if($success){
            $result['flag'] = 'success';
            $up = wp_upload_dir();			
            $base_path = $up['baseurl'];
            $mid_path = 'nbdesigner/temp/';
            $name = basename($full_name);
            $url = $base_path.'/'.$mid_path.$name;            
            $result['url'] = $url;
        }else{
            $result['flag'] = $full_name;
        }
        echo json_encode($result);
        wp_die();        
    }
    private function nbdesigner_create_thumbnail_design($from_path, $to_path, $pid, $_width = 300, $_height = 300){
        $configs = unserialize(get_post_meta($pid, '_designer_setting', true));        
        $path_preview = $to_path;
        $width = $_width;
        $height = $_height;
        $list_images = $this->nbdesigner_list_thumb($from_path, $level = 1);
        if(!file_exists($path_preview)){
            wp_mkdir_p($path_preview);
        }
        foreach ($configs as $key => $val){
            $p_img = $from_path . '/frame_' . $key . '.png';
            if(file_exists($p_img)){
                //$width = $height = 300;
                $image_design = $this->nbdesigner_resize_imagepng($p_img, $val["area_design_width"], $val["area_design_height"]);
                $image_product_ext = pathinfo($val["img_src"]);
                if($image_product_ext['extension'] == "png"){
                    $image_product = $this->nbdesigner_resize_imagepng($val["img_src"], $val["img_src_width"], $val["img_src_height"]);
                }else{
                    $image_product = $this->nbdesigner_resize_imagejpg($val["img_src"], $val["img_src_width"], $val["img_src_height"]);
                }                
                $image = imagecreatetruecolor($width, $height);
                imagesavealpha($image, true);
                $color = imagecolorallocatealpha($image, 255, 255, 255, 127);
                imagefill($image, 0, 0, $color);
                imagecopy($image, $image_product, $val["img_src_left"], $val["img_src_top"], 0, 0, $val["img_src_width"], $val["img_src_height"]);
                imagecopy($image, $image_design, $val["area_design_left"], $val["area_design_top"], 0, 0, $val["area_design_width"], $val["area_design_height"]);
                imagepng($image, $path_preview. '/frame_' . $key . '.png');
                imagedestroy($image);
                imagedestroy($image_design);
            }
        }
    }
    private function nbdesigner_resize_imagepng($file, $w, $h){
        list($width, $height) = getimagesize($file);
        $src = imagecreatefrompng($file);
        $dst = imagecreatetruecolor($w, $h);
        imagesavealpha($dst, true);
        $color = imagecolorallocatealpha($dst, 255, 255, 255, 127);
        imagefill($dst, 0, 0, $color);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
        imagedestroy($src);
        return $dst;        
    }
    private function nbdesigner_resize_imagejpg($file, $w, $h) {
       list($width, $height) = getimagesize($file);
       $src = imagecreatefromjpeg($file);
       $dst = imagecreatetruecolor($w, $h);
       imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
       imagedestroy($src);
       return $dst;
    }    
    public function nbdesigner_save_data_to_image($path, $data) {
        if (!$fp = fopen($path, 'w')) {
            return FALSE;
        }
        flock($fp, LOCK_EX);
        fwrite($fp, $data);
        flock($fp, LOCK_UN);
        fclose($fp);
        return TRUE;
    }
    public function nbdesigner_create_secret_image_url($file_path) {
        $type = pathinfo($file_path, PATHINFO_EXTENSION);
        $data = file_get_contents($file_path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);   
        return $base64;
    }
    public function nbdesigner_registration_save($user_id){
        require_once ABSPATH . 'wp-admin/includes/file.php';
        global $wpdb;
        $uid = $user_id;
        $sid = session_id();
        $folder_path = $this->plugin_path_data . 'designs/' . $sid . '/nb_order';
        $user_path = $this->plugin_path_data . 'designs/' . $uid . '/nb_order';
        $user_path_old = $this->plugin_path_data . 'designs/' . $uid . '/nb_order_old';   
        if (file_exists($user_path_old)) {
            $this->nbdesigner_delete_folder($user_path_old);
        }else{
            if (file_exists($user_path)) {
                rename($user_path, $user_path_old);
            }            
        }
        if (!file_exists($user_path)) {
            wp_mkdir_p($user_path);
        }
        if (file_exists($folder_path)) {
            $this->nbdesigner_copy_dir($folder_path, $user_path);
            $this->nbdesigner_delete_folder($folder_path);
        }
        if (isset($_SESSION['nbdesigner'])) {
            foreach ($_SESSION['nbdesigner'] as $key => $designs) {
                $arr = json_decode($designs);
                $new_sess = array();
                foreach ($arr as $img) {
                    $old = '/' . $sid . '/';
                    $new = '/' . $uid . '/';
                    $img = str_replace($old, $new, $img);
                    $new_sess[] = $img;
                }
                $_SESSION['nbdesigner'][$key] = json_encode($new_sess);
            }
        }
    }
    public function nbdesigner_change_folder_design($user_login, $user) {
        require_once ABSPATH . 'wp-admin/includes/file.php';
        global $wpdb;
        $uid = $user->ID;
        $sid = session_id();
        $folder_path = $this->plugin_path_data . 'designs/' . $sid . '/nb_order';
        $user_path = $this->plugin_path_data . 'designs/' . $uid . '/nb_order';
        $user_path_old = $this->plugin_path_data . 'designs/' . $uid . '/nb_order_old';   
        if (file_exists($user_path_old)) {
            $this->nbdesigner_delete_folder($user_path_old);
        }else{
            if (file_exists($user_path)) {
                rename($user_path, $user_path_old);
            }            
        }
        if (!file_exists($user_path)) {
            wp_mkdir_p($user_path);
        }
        if (file_exists($folder_path)) {
            $this->nbdesigner_copy_dir($folder_path, $user_path);
            $this->nbdesigner_delete_folder($folder_path);
        }
        if (isset($_SESSION['nbdesigner'])) {
            foreach ($_SESSION['nbdesigner'] as $key => $designs) {
                $arr = json_decode($designs);
                $new_sess = array();
                foreach ($arr as $img) {
                    $old = '/' . $sid . '/';
                    $new = '/' . $uid . '/';
                    $img = str_replace($old, $new, $img);
                    $new_sess[] = $img;
                }
                $_SESSION['nbdesigner'][$key] = json_encode($new_sess);
            }
        }
    }
    public function nbdesigner_change_foler_after_order($order_id) {
        global $woocommerce;
        $items = $woocommerce->cart->get_cart();
        foreach($items as $item => $values){
            $data = WC()->session->get($item . '_nbdesigner');
            if($data == 'has_design'){
                WC()->session->__unset($item . '_nbdesigner'); 
            }
        }
        $this->nbdesigner_end_session();
        $uid = get_current_user_id();
        $sid = session_id();
        $iid = ($uid > 0 ) ? $uid : $sid;
        $path = $this->plugin_path_data . 'designs/' . $iid . '/nb_order';
        $new_path = $this->plugin_path_data . 'designs/' . $iid . '/' . $order_id;
        if (file_exists($path)){
            rename($path, $new_path);
        }     
        $order = new WC_Order($order_id);
        $products = $order->get_items();
        $order_has_design = false;
        foreach($products as $order_item_id => $product){
            $has_design = wc_get_order_item_meta($order_item_id, '_nbdesigner_has_design');
            if($has_design == 'has_design') {
                $order_has_design = true;
                wc_add_order_item_meta($order_item_id, '_nbdesign_order', $order_id);
                wc_add_order_item_meta($order_item_id, '_nbdesign_order_item_id', $order_item_id);
            }
        }
        if($order_has_design){
            update_post_meta($order_id, '_nbdesigner_order_has_design', 'has_design');
            update_post_meta($order_id, '_nbdesigner_version_design', NBDESIGNER_VERSION);
            update_post_meta($order_id, '_nbdesigner_order_userid', $iid);
            add_post_meta($order_id, '_nbdesigner_order_changed', 1);
        } 
    }
    public function nbdesigner_copy_dir($src, $dst) {
        if (file_exists($dst)) $this->nbdesigner_delete_folder($dst);
        if (is_dir($src)) {
            wp_mkdir_p($dst);
            $files = scandir($src);
            foreach ($files as $file){
                if ($file != "." && $file != "..") $this->nbdesigner_copy_dir("$src/$file", "$dst/$file");
            }
        } else if (file_exists($src)) copy($src, $dst);
    }
    public function nbdesigner_list_thumb($path, $level = 2) {
        $list = array();
        $_list = $this->nbdesigner_list_files($path, $level);
        $list = preg_grep('/\.(jpg|jpeg|png|gif)(?:[\?\#].*)?$/i', $_list);
        return $list;
    }
    public function nbdesigner_list_files($folder = '', $levels = 100) {
        if (empty($folder))
            return false;
        if (!$levels)
            return false;
        $files = array();
        if ($dir = @opendir($folder)) {
            while (($file = readdir($dir) ) !== false) {
                if (in_array($file, array('.', '..')))
                    continue;
                if (is_dir($folder . '/' . $file)) {
                    $files2 = $this->nbdesigner_list_files($folder . '/' . $file, $levels - 1);
                    if ($files2)
                        $files = array_merge($files, $files2);
                    else
                        $files[] = $folder . '/' . $file . '/';
                } else {
                    $files[] = $folder . '/' . $file;
                }
            }
        }
        @closedir($dir);
        return $files;
    }
    public function nbdesigner_delete_folder($path) {
        if (is_dir($path) === true) {
            $files = array_diff(scandir($path), array('.', '..'));
            foreach ($files as $file) {
                $this->nbdesigner_delete_folder(realpath($path) . '/' . $file);
            }
            return rmdir($path);
        } else if (is_file($path) === true) {
            return unlink($path);
        }
        return false;
    }
    public function nbdesigner_display_posts_design($column, $post_id) {
        if ($column == 'design') {
            $is_design = get_post_meta($post_id, '_nbdesigner_enable', true);
            echo '<input type="checkbox" disabled', ( $is_design ? ' checked' : ''), '/>';
        }
    }
    public function nbdesigner_add_design_column($columns) {
        return array_merge($columns, array('design' => __('Design', $this->textdomain)));
    }
    public function nbdesigner_render_cart($title = null, $cart_item = null, $cart_item_key = null) {
        if ($cart_item_key && is_cart()) {
            $data = WC()->session->get($cart_item_key . '_nbdesigner');
            $opt_val = get_option('nbdesigner');
            $_show_design = 1;
            if(is_array($opt_val)){
                extract($opt_val);  
                $_show_design = $show_design;
            }	            
            if ($data == 'has_design' && $_show_design == 1) {
                $product_id = $cart_item['product_id'];
                //@since 1.5.0 data design store in session with key $cart_item_key instead product id
                //$data_design = $_SESSION['nbdesigner']['nbdesigner_' . $product_id];
                $data_design = $_SESSION['nbdesigner'][$cart_item_key];
                $html = $title . '<br /><div>';
                $list = json_decode($data_design);
                foreach ($list as $img) {
                    $src = $this->nbdesigner_create_secret_image_url($img);
                    $html .= '<img width="60" height="60" style="border-radius: 3px; border: 1px solid #ddd; margin-top: 5px; margin-right: 5px; display: inline-block;" src="' . $src . '"/>';
                }
                $html .= '</div>';
                echo $html;
            } else {
                echo $title;
            }
        }else{
            echo $title;
        }
    }
    /**
     * Declare item cart has design
     * @since 1.0.0
     * 
     * @param text $cart_item_key 
     * @param int $product_id
     */
    public function nbdesigner_add_custom_data_design($cart_item_key, $product_id) {        
        $sid = session_id();
        $uid = get_current_user_id();
        $iid = ($uid > 0) ? $uid : $sid;
        if (isset($_SESSION['nbdesigner']) && isset($_SESSION['nbdesigner']['nbdesigner_' . $product_id])) {            
            $this->nbdesigner_change_folder_after_add_to_cart($cart_item_key, $product_id);
            WC()->session->set($cart_item_key . '_nbdesigner', 'has_design');
        }
    }
    /**
     * Copy folder design after add to cart.
     * Store new path image design into session.
     * Fix bug multi design for same product (or variantion)
     * @since 1.5.0
     * 
     * @param text $cart_item_key
     * @param int $product_id
     * @return boolean
     */
    private function nbdesigner_change_folder_after_add_to_cart($cart_item_key, $product_id){ 
        $uid = get_current_user_id();
        $sid = session_id();
        $iid = ($uid > 0) ? $uid : $sid;
        $old_path = $this->plugin_path_data . 'designs/' . $iid . '/nb_order/'.$product_id;
        $new_path = $this->plugin_path_data . 'designs/' . $iid . '/nb_order/'.$cart_item_key;
        $this->nbdesigner_copy_dir($old_path, $new_path);
        $path = $new_path . '/thumbs';
        $_SESSION['nbdesigner'][$cart_item_key] = json_encode($this->nbdesigner_list_thumb($path));
    }
    public function nbdesigner_remove_cart_item_design($removed_cart_item_key, $instance){
        $line_item = $instance->removed_cart_contents[ $removed_cart_item_key ];
        $product_id = $line_item[ 'product_id' ];      
        if(isset($_SESSION['nbdesigner']['nbdesigner_' . $product_id])){
            unset($_SESSION['nbdesigner']['nbdesigner_' . $product_id]);   
            WC()->session->__unset($removed_cart_item_key . '_nbdesigner');          
        }     
    }
    public function nbdesigner_add_order_design_data($item_id, $values, $cart_item_key) {
        if (WC()->session->__isset($cart_item_key . '_nbdesigner')) {
            wc_add_order_item_meta($item_id, "_nbdesigner_has_design", WC()->session->get($cart_item_key . '_nbdesigner'));
            wc_add_order_item_meta($item_id, "_nbdesigner_folder_design", $cart_item_key);
        }
    }
    public function nbdesigner_design_approve(){
        check_admin_referer('approve-designs', '_nbdesigner_approve_nonce');	
        $order_id = $_POST['nbdesigner_design_order_id'];
        if(isset($_POST['_nbdesigner_design_file']))
            $_design_file = $_POST['_nbdesigner_design_file'];       
        $_design_action = $_POST['nbdesigner_order_file_approve'];       
        $response['mes'] = '';       
        if (is_numeric($order_id) && isset($_design_file) && is_array($_design_file)) {
            $design_data = unserialize(get_post_meta($order_id, '_nbdesigner_design_file', true));                  
            if(is_array($design_data)){
                foreach($_design_file as $val){    
                    $check = false;
                    foreach($design_data as $key => $status){
                        //@since 1.5.0 store into order_item_id 
                        //$_key = str_replace('nbds_', '', trim($key));
                        $_key = str_replace('nbds_', '', trim($key));
                        if($_key == $val){
                            $design_data[$key] = $_design_action;  
                            $check = true;
                        }
                    }   
                    if(!$check) $design_data['nbds_'.$val] = $_design_action; 
                }
            }else{
                $design_data = array();
                foreach ($_design_file as $val){
                    $design_data['nbds_'.$val] = $_design_action;
                }
            }             
            $design_data = serialize($design_data);       
            if (update_post_meta($order_id, '_nbdesigner_design_file', $design_data)){
                update_post_meta($order_id, '_nbdesigner_order_changed', 0);
                $response['mes'] = 'success';
            }else{
                update_post_meta($order_id, '_nbdesigner_order_changed', 0);
                $response['mes'] = __('You don\'t change anything? Or an error occured saving the data, please refresh this page and check if changes took place.', $this->textdomain);
            }
        } else if(!isset($_design_file) || !is_array($_design_file)){
            $response['mes'] = __('You haven\'t chosen a item.', $this->textdomain);
        }
        echo json_encode($response);
        wp_die();
    }
    public function nbdesigner_design_order_email(){
        check_admin_referer('approve-design-email', '_nbdesigner_design_email_nonce');	
        $response['success'] = 0;
        if (empty($_POST['nbdesigner_design_email_order_content'])) {
            $response['error'] = __('The reason cannot be empty', $this->textdomain);        
        } elseif (!is_numeric($_POST['nbdesigner_design_email_order_id'])) {
            $response['error'] = __('Error while sending mail', $this->textdomain);
        } 
        if (empty($response['error'])) {
            $message = $_POST['nbdesigner_design_email_order_content'];
            $order = new WC_Order($_POST['nbdesigner_design_email_order_id']);  
            $reason = ($_POST['nbdesigner_design_email_reason'] == 'approved')?__('Your design accepted', $this->textdomain): 'Your design rejected';
            $send_email = $this->nbdesigner_send_email($order, $reason, $message);
            if ($send_email)
                $response['success'] = 1;
            else
                $response['error'] = __('Error while sending mail', $this->textdomain);            
        }
        echo json_encode($response);
        wp_die();        
    }
    public function nbdesigner_send_email($order, $reason, $message){
        global $woocommerce;
        $user_email = $order->billing_email;
        if (!empty($user_email)) {
            $mailer = $woocommerce->mailer();
            ob_start();
            wc_get_template('emails/nbdesigner-approve-order-design.php', array(
                'plugin_id' => $this->textdomain,
                'order' => $order,
                'reason' => $reason,
                'message' => $message,
                'my_order_url' => $order->get_view_order_url(),
            ));
            $body = ob_get_clean();
            $subject = $reason . ' - Order ' . $order->get_order_number();	            
            $mailer->send($user_email, $subject, $body);
            return true;
        } else {
            return false;
        }
    }
    public function nbdesigner_locate_plugin_template($template, $template_name, $template_path){
        global $woocommerce;
        $_template = $template;
        if ( ! $template_path ) $template_path = $woocommerce->template_url;
        $plugin_path  = NBDESIGNER_PLUGIN_DIR . 'templates/';
        $template = locate_template(array(
            $template_path . $template_name,
            $template_name
        ));
        if ( ! $template && file_exists( $plugin_path . $template_name ) )
            $template = $plugin_path . $template_name;
        if ( ! $template )
          $template = $_template;
        return $template;
    }
    public function nbdesigner_order_item_name($item_name, $item){       
        if(isset($item["item_meta"]["_nbdesign_order"])) $order_id =  $item["item_meta"]["_nbdesign_order"];
        if(isset($item["item_meta"]["_nbdesign_order_item_id"])) $_nbdesign_order_item_id =  $item["item_meta"]["_nbdesign_order_item_id"];
        $_product = wc_get_product($item["product_id"]);   
        $opt_val = get_option('nbdesigner');
        $_show_design_order = 1;
        if(is_array($opt_val)){
            extract($opt_val);  
            $_show_design_order = $show_design_order;
        }
        if(isset($order_id[0]) && ($_show_design_order == 1)){ 
            $notice = '';
            $html = '';
            $oiid = '';
            $design_data = unserialize(get_post_meta($order_id[0], '_nbdesigner_design_file', true));
            $index = 'nbds_'.$item["product_id"];
            if(isset($_nbdesign_order_item_id[0])) $index = 'nbds_'.$_nbdesign_order_item_id[0];
            $folder = false;
            if(isset($item["item_meta"]["_nbdesigner_folder_design"])){
                $folder = $item["item_meta"]["_nbdesigner_folder_design"];
                $oiid = $_nbdesign_order_item_id[0];
            }   
            global $wpdb;
            $check = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name='nbdesigner-redesign-product-x1095'");     
            if($check != ''){
                if(is_array($folder)){
                    $link_redesign = get_page_link($check).'?product_id='.$item["product_id"].'&orderid='.$order_id[0].'&folder='.$folder[0].'&oiid='.$oiid;
                }else{
                    $link_redesign = get_page_link($check).'?product_id='.$item["product_id"].'&orderid='.$order_id[0];
                }                
            }else{
                $link_redesign = '#';
            }
            if(isset($design_data[$index]) && ($design_data[$index] == 'decline')){
                $notice = "<small style='color:red;'>". __('(Rejected! Click ', $this->textdomain)."<a href='".$link_redesign."' target='_blank'>". __('here ', $this->textdomain). "</a>". __(' to design again', $this->textdomain)."!)</small>";
            }
            if(isset($design_data[$index]) && ($design_data[$index] == 'accept')){
                $notice = __('<small> (Approved!)</small>', $this->textdomain);
            }
            if(isset($item["item_meta"]["_nbdesigner_has_design"])) $has_design =  $item["item_meta"]["_nbdesigner_has_design"];
            if(isset($has_design)){               
                $uid = get_current_user_id();
                $sid = session_id();
                $iid = ($uid > 0) ? $uid : $sid;
                //@since 1.5.0 - fix bug multiple design same product
                $path = $this->plugin_path_data. 'designs/'. $iid . '/' .$order_id[0]. '/' . $item["product_id"] . '/thumbs';	
                if(is_array($folder)){
                    $path = $this->plugin_path_data. 'designs/'. $iid . '/' .$order_id[0]. '/' . $folder[0] . '/thumbs';
                }                
                if(file_exists($path)){                    
                    $images = $this->nbdesigner_list_thumb($path);                                     
                    if(is_array($images)){
                        $html = '<br />';                        
                        foreach ($images as $img){                           
                            $src = $this->nbdesigner_create_secret_image_url($img);                            
                            $html .= '<img style="width: 60px; border: 1px solid #ddd; border-radius: 3px; display: inline-block !important; margin-left: 5px; margin-bottom: 5px;" src="'.$src.'" />';
                        }
                    }
                }
            }
            $link = get_permalink( $item['product_id']);
            /* $link = add_query_arg(array('orderid' => $order_id[0]), $_link); */
            $item_name = sprintf( '<a href="%s">%s</a>&times;<strong class="product-quantity">%s</strong>%s<br />%s', $link, $item['name'], $item['qty'], $html, $notice );
        }else{
            if($_product->is_visible()){
                $item_name = sprintf( '<a href="%s">%s</a>', get_permalink( $item['product_id'] ), $item['name'] );
            }
            else {
                $item_name = $item['name'];
            }
        }      
        return $item_name;
    }
    public function nbdesigner_order_item_quantity_html($strong, $item){
        $_product = wc_get_product($item["product_id"]);   
        $opt_val = get_option('nbdesigner');
        $_show_design_order = 1;
        if(is_array($opt_val)){
            extract($opt_val);  
            $_show_design_order = $show_design_order;
        }
        if($_show_design_order == 1){
            if(isset($item["item_meta"]["_nbdesigner_has_design"])) $has_design =  $item["item_meta"]["_nbdesigner_has_design"];
            if(isset($has_design)){ 
                return '';
            }
        }
        return ' <strong class="product-quantity">' . sprintf( '&times; %s', $item['qty'] ) . '</strong>';
    }
    public function nbdesigner_hidden_custom_order_item_metada($order_items){
        $order_items[] = '_nbdesigner_has_design';
        $order_items[] = '_nbdesigner_folder_design';
        $order_items[] = '_nbdesigner_version_design';
        $order_items[] = '_nbdesign_order';
        $order_items[] = '_nbdesign_order_item_id';
        return $order_items;
    }
    public function nbdesigner_customer_upload(){       
        if (!wp_verify_nonce($_POST['nonce'], 'save-design')) {
            die('Security error');
        } 
        $allow_extension = array('jpg','jpeg','png','gif');
        $opt_val = get_option('nbdesigner');
        $allow_max_size = ((isset($opt_val['upload_max'])) ? $opt_val['upload_max'] : 10 )*1024*1024;
        $result =   true;
        $res = array();
        $size   =   $_FILES['file']["size"];
        $name   =   $_FILES['file']["name"];    
        $ext = $this->nbdesigner_get_extension($name);
        $new_name = strtotime("now").substr(md5(rand(1111,9999)),0,8).'.'.$ext;
        $path = $this->plugin_path_data. 'temp/';
        if(empty($name)) {
            $result = false;
            $res['mes'] = __('Error occurred with file upload!', $this->textdomain);            
        }
        if($size > $allow_max_size){
            $result = false;
            $res['mes'] = __('Too large file !', $this->textdomain);                
        }
        $check = $this->checkFileType($name, $allow_extension);
        if(!$check){
            $result = false;
            $res['mes'] = __('Invalid file format!', $this->textdomain);
        }          
        if(!file_exists($path)){
            if(!wp_mkdir_p($path)){
                $result = false;
                $res['mes'] = __('Have problem with server permission!', $this->textdomain);
            }
        }else{          
            if($result){
                if(move_uploaded_file($_FILES['file']["tmp_name"],$path.$new_name)){
                    $res['mes'] = __('Upload success !', $this->textdomain);       
                }else{
                    $result = false;
                    $res['mes'] = __('Error occurred with file upload!', $this->textdomain);            
                }                     
            }
        }
        if($result){
            $res['src'] = content_url().'/uploads/nbdesigner/temp/'.$new_name;
            $res['flag'] = 1;
        }else{
            $res['flag'] = 0;
        }
	        
        echo json_encode($res);
        wp_die();
    }
    public function nbdesigner_get_qrcode(){
        $result = array();
        $result['flag'] = 0;
        if (!wp_verify_nonce($_REQUEST['nonce'], 'save-design')) {
            die('Security error');
        } 
        if(isset($_REQUEST['data'])){
            $content = $_REQUEST['data'];
            include_once NBDESIGNER_PLUGIN_DIR.'includes/class.nbdesigner.qrcode.php';
            $qr = new Nbdesigner_Qrcode();
            $qr->setText($content);
            $image = $qr->getImage(500);
            $file_name = strtotime("now") . '.png';
            $full_name = $this->plugin_path_data .'temp/'. $file_name;
            if($this->nbdesigner_save_data_to_image($full_name, $image)){
                $result['flag'] = 1;
                $result['src'] =  content_url().'/uploads/nbdesigner/temp/'.$file_name;
            };          
        }
        echo json_encode($result);
        wp_die();
    }
    private function nbdesigner_getFacebook_API(){
        $opt = get_option('nbdesigner');
        return array('api_key' => $opt['facebook_api_key'], 'secret_key' => $opt['facebook_secret_key']);
    }
    public function nbdesigner_get_facebook_photo(){
        if (!wp_verify_nonce($_POST['nonce'], 'save-design')) {
            die('Security error');
        }        
        $result = array();
        $_accessToken = $_POST['accessToken'];
        require_once NBDESIGNER_PLUGIN_DIR.'includes/class.nbdesigner.facebook.php';
        echo json_encode($result);
        wp_die();
    }
    public function nbdesigner_get_art(){
        if (!wp_verify_nonce($_REQUEST['nonce'], 'nbdesigner-get-data')) {
            die('Security error');
        }   
        $result = array();
        $path_cat = $this->plugin_path_data. 'art_cat.json';
        $path_art = $this->plugin_path_data. 'arts.json';
        $result['flag'] = 1;
        $result['cat'] = $this->nbdesigner_read_json_setting($path_cat);
        $result['arts'] = $this->nbdesigner_read_json_setting($path_art);	        
        echo json_encode($result);
        wp_die();        
    }
    public function nbdesigner_get_font(){ 	        
        if (!wp_verify_nonce($_REQUEST['nonce'], 'nbdesigner-get-data')) {
            die('Security error');
        }   
        $result = array();
        $path_cat = $this->plugin_path_data. 'font_cat.json';
        $path_font = $this->plugin_path_data. 'fonts.json';
        $path_google_font = $this->plugin_path_data. 'googlefonts.json';
        $result['flag'] = 1;
        $result['cat'] = $this->nbdesigner_read_json_setting($path_cat);
        $result['fonts'] = $this->nbdesigner_read_json_setting($path_font);	        
        $result['google_font'] = $this->nbdesigner_read_json_setting($path_google_font);	        
        echo json_encode($result);
        wp_die();        
    }
    public function nbdesigner_get_pattern(){ 	        
        if (!wp_verify_nonce($_REQUEST['nonce'], 'nbdesigner-get-data')) {
            die('Security error');
        }   
        $result = array();
        $path = NBDESIGNER_PLUGIN_DIR. 'data/pattern.json';
        $result['flag'] = 1;
        $result['data'] = $this->nbdesigner_read_json_setting($path);	        
        echo json_encode($result);
        wp_die();        
    }    
    private function zip_files_and_download($file_names, $archive_file_name, $nameZip){
        if (class_exists('ZipArchive')) {
            $zip = new ZipArchive();
            if(file_exists($archive_file_name)){
                unlink($archive_file_name);
            }
            if ($zip->open($archive_file_name, ZIPARCHIVE::CREATE )!==TRUE) {
              exit("cannot open <$archive_file_name>\n");
            }
            foreach($file_names as $file)
            {
                $path_arr = explode('/', $file);
                $name = $path_arr[count($path_arr) - 2].'_'.$path_arr[count($path_arr) - 1];                
                $zip->addFile($file, $name);
            }
            $zip->close();
            header("Content-type: application/zip");
            header("Content-Disposition: attachment; filename=$nameZip");
            header("Pragma: no-cache");
            header("Expires: 0");
            readfile("$archive_file_name");
            exit;
        }
    }
    public static function nbdesigner_add_redesign_page(){
	global $wpdb;
	$check = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name='nbdesigner-redesign-product-x1095'");	        
        if ($check == ''){        
            $post = array(
                'post_name' => 'nbdesigner-redesign-product-x1095',
                'post_status' => 'publish',
                'post_title' => 'Customer redesign product',
                'post_type' => 'page',
                'post_date' => date('Y-m-d H:i:s')
            );      
            $page = wp_insert_post($post, false);	
        }
        $admindesign = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name='nbdesigner-admindesign-product-x1095'");
        if ($admindesign == ''){        
            $post = array(
                'post_name' => 'nbdesigner-admindesign-product-x1095',
                'post_status' => 'publish',
                'post_title' => 'Admin Design Template',
                'post_type' => 'page',
                'post_date' => date('Y-m-d H:i:s')
            );      
            $page = wp_insert_post($post, false);	
        }        
    }
    public function nbdesigner_add_shortcode_page_design($content){
        global $post;
        if($post->post_type === 'page' && $post->post_name === 'nbdesigner-redesign-product-x1095'){
            if ( has_shortcode($content, 'nbdesigner_redesign') ){           
                    return $content;
            }else{              
                $content = '[nbdesigner_redesign]';
                return $content;                
            }            
        }
        if($post->post_type === 'page' && $post->post_name === 'nbdesigner-admindesign-product-x1095'){
            if ( has_shortcode($content, 'nbdesigner_admindesign') ){
                    return $content;
            }else{
                $content = '[nbdesigner_admindesign]';
                return $content;                
            }            
        }        
        return $content;
    }
    public function nbdesigner_redesign_func(){       
        $html = '';
        $folder = '';
        $order_item_id = '';
        $uid = get_current_user_id();
        $list_image = array();
        $order = 'nb_order';        
        if(isset($_GET['product_id'])) $product_id = $_GET['product_id'];
        if(isset($_GET['orderid'])) $order_id = $_GET['orderid'];
        if(isset($_GET['folder'])) $folder = $_GET['folder'];
        if(isset($_GET['oiid'])) $order_item_id = $_GET['oiid'];
        //if(!($uid > 0) || !isset($product_id) || !isset($order_id)) return $html;
        if(!isset($product_id) || !isset($order_id)) return $html;
        //$src_iframe = NBDESIGNER_PLUGIN_URL . 'views/nbdesigner-frontend.php?task=redesign&product_id='.$product_id.'&orderid='.$order_id;
        $src_iframe = add_query_arg(array(
            'action' => 'nbdesigner_editor_html', 
            'product_id' => $product_id, 
            'orderid' => $order_id, 
            'task' => 'redesign',
            'folder' => $folder,
            'oiid' => $order_item_id ), site_url());
        $path = $this->plugin_path_data . 'designs/' . $uid . '/' . $order_id . '/' . $product_id . '/thumbs';
        $list_image = $this->nbdesigner_list_thumb($path);
        if (count($list_image) > 0) {
            $div_image = '<div id="nbdesigner_frontend_area"><h4>' . __('Preview your design', $this->textdomain) . '</h4>';
            foreach ($list_image as $img) {
                $src = $this->nbdesigner_create_secret_image_url($img);
                $div_image .= '<img style="width: 60px; height: 60px; display: inline-block;" src="' . $src . '" />';
            }  
            $div_image .= '</div>';
        } else {
            $div_image = '<div id="nbdesigner_frontend_area"></div>';
        }        
        $html .= '<div class="woocommerce_msrp">';
        $html .=      '<a class="button" id="triggerDesign" >'. __('Design again', $this->textdomain) .'</a><br />' . $div_image;
        $html .= '</div><br />';  
        $html .= '<div style="position: fixed; top: 0; left: 0; z-index: 999999; opacity: 0; width: 100%; height: 100%;" id="container-online-designer"><iframe id="onlinedesigner-designer"  width="100%" height="100%" scrolling="no" frameborder="0" noresize="noresize" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true" src="' . $src_iframe . '"></iframe><span id="closeFrameDesign"  class="nbdesigner_pp_close">&times;</span></div>';
        return $html;
    }
    public function nbdesigner_admindesign_func(){
        $html = '';
        $uid = get_current_user_id();
        $list_image = array();      
        if(isset($_GET['product_id'])) $product_id = $_GET['product_id'];
        if(isset($_GET['p'])) $priority = $_GET['p'];
        if(isset($_GET['adid'])) {
            $adid = $_GET['adid'];
        }else{
            $adid = '';
        }
        if(!($uid > 0) || !isset($product_id) || !(current_user_can('administrator') || current_user_can('shop_manager'))) return $html = 'Oops! you can\'t accsess this page!';
        $src_iframe = add_query_arg(
                array(
                    'action' => 'nbdesigner_editor_html', 
                    'product_id' => $product_id, 
                    'task' => 'admindesign', 
                    'priority' => $priority, 
                    'adid' => $adid), 
                site_url());
        $path = $this->plugin_path_data . 'admindesign/' . $product_id . '/primary/thumbs';
        if(file_exists($path))  $list_image = $this->nbdesigner_list_thumb($path);
        $div_image = '';
        if (count($list_image) > 0) {
            $div_image = '<div id="nbdesigner_frontend_area"><h4>' . __('Preview your design', $this->textdomain) . '</h4>';
            foreach ($list_image as $img) {
                $src = $this->nbdesigner_create_secret_image_url($img);
                $div_image .= '<img style="width: 60px; height: 60px; display: inline-block;" src="' . $src . '" />';
            }  
            $div_image .= '</div>';
        } else {
            $div_image = '<div id="nbdesigner_frontend_area"></div>';
        }        
        $html .= '<div class="woocommerce_msrp">';
        $html .=      '<a class="button" id="triggerDesign" >'. __('Start Design', $this->textdomain) .'</a><br />' . $div_image;
        $html .= '</div><br />';  
        $html .= '<div style="position: fixed; top: 0; left: 0; z-index: 999999; opacity: 0; width: 100%; height: 100%;" id="container-online-designer"><iframe id="onlinedesigner-designer"  width="100%" height="100%" scrolling="no" frameborder="0" noresize="noresize" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true" src="' . $src_iframe . '"></iframe><span id="closeFrameDesign"  class="nbdesigner_pp_close">&times;</span></div>';
        return $html;
    }    
    private function nbdesigner_generate_ramdom_key($length = 10){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-+';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function nbdesigner_get_security_key(){
        if (!wp_verify_nonce($_POST['nonce'], 'nbdesigner_add_cat') || !current_user_can('administrator')) {
            die('Security error');
        }        
        $result['key'] = $this->nbdesigner_generate_ramdom_key(24);
        $result['mes'] = 'success';
        echo json_encode($result);
        wp_die();
    }
    private function nbdesigner_check_iframe_key($ikey, $nonce){
        $result = true;
        $opt = get_option('nbdesigner');
        $defaults = $this->default_option;
        $opt_val = wp_parse_args($opt, $defaults);
        $iframe_key = $opt_val['iframe_securitykey'];
        if (!wp_verify_nonce($nonce, 'nbdesigner_iframe_sec_key')) {
            $result = false;
        } 
        $origin_key = md5($iframe_key.$nonce);
        if ($origin_key != $ikey) {
            $result = false;
        }         
        return $result;
    }
    public function nbdesigner_frontend_translate(){
        require_once ABSPATH . 'wp-admin/includes/translation-install.php';
        $languages = wp_get_available_translations();
        $path = NBDESIGNER_PLUGIN_DIR . 'data/language.json';  
        $path_data = $this->plugin_path_data . 'data/language.json';
        if(file_exists($path_data)) $path = $path_data;  
        $path_lang = NBDESIGNER_PLUGIN_DIR . 'data/language/en.json';
        $path_data_lang = $this->plugin_path_data . 'data/language/en.json';
        if(file_exists($path_data_lang)) $path_lang = $path_data_lang;  
        $list = json_decode(file_get_contents($path));     
        $lang = json_decode(file_get_contents($path_lang)); 
        if(is_array($lang)){
            $langs = (array)$lang[0];
        }
        require(NBDESIGNER_PLUGIN_DIR . 'views/nbdesigner-translate.php');
    }
    public function nbdesigner_save_language(){
        if (!wp_verify_nonce($_POST['nonce'], 'nbdesigner_add_cat') || !current_user_can('administrator')) {
            die('Security error');
        }        
        if(isset($_POST['langs'])){
            $langs = array();
            $langs[0] = $_POST['langs'];
        }
        if(isset($_POST['code'])){
            $code = $_POST['code'];
        } 
        if(isset($langs) && isset($code)){
            $path_lang = NBDESIGNER_PLUGIN_DIR . 'data/language/'.$code.'.json';
            $path_data = $this->plugin_path_data . 'data/language/'.$code.'.json';
            if(file_exists($path_data)) $path_lang = $path_data;
            $res = json_encode($langs);
            file_put_contents($path_lang, $res);   
            echo __('Update language success!', $this->textdomain);
        }else{
            echo 'Oops! Update language failed!';
        }
        wp_die();
    }
    public function nbdesigner_get_language($code){
        if (!(wp_verify_nonce($_POST['nonce'], 'nbdesigner_add_cat') || wp_verify_nonce($_POST['nonce'], 'save-design'))) {
            die('Security error');
        }         
        $data = array();
        $data['mes'] = 'success';
        if(!isset($code)){
            $code = "en";
        }else if(isset($_POST['code'])) {
            $code = $_POST['code'];          
        }
        $path = NBDESIGNER_PLUGIN_DIR . 'data/language.json';
        $path_data = $this->plugin_path_data . 'data/language.json';
        if(file_exists($path_data)) $path = $path_data;
        $list = json_decode(file_get_contents($path)); 
        $path_lang = NBDESIGNER_PLUGIN_DIR . 'data/language/'.$code.'.json';
        $path_data_lang = $this->plugin_path_data . 'data/language/'.$code.'.json';
        if(file_exists($path_data_lang)) $path_lang = $path_data_lang;
        $path_original_lang = NBDESIGNER_PLUGIN_DIR . 'data/language/en.json';
        if(!file_exists($path_lang)) $path_lang = $path_original_lang;
        $lang_original = json_decode(file_get_contents($path_original_lang)); 
        $lang = json_decode(file_get_contents($path_lang)); 
        if(is_array($lang)){
            $data_langs = (array)$lang[0];
            if(is_array($lang_original)){
                $data_langs_origin = (array)$lang_original[0];
                $data_langs = array_merge($data_langs_origin, $data_langs);
            }
            $data['langs'] = $data_langs;
            $data['code'] = $code;
        }else{
            $data['mes'] = 'error';
        }
        if(is_array($list)){
            $data['cat'] = $list;
        }else{
            $data['mes'] = 'error';
        }
        echo json_encode($data);
        wp_die();
    }    
    public function nbdesigner_create_language(){       
        if (!wp_verify_nonce($_POST['nbdesigner_newlang_hidden'], 'nbdesigner-new-lang') || !current_user_can('administrator')) {
            die('Security error');
        } 
        $data = array(); $data['mes'] = 'success';
        if(isset($_POST['nbdesigner_codelang']) && isset($_POST['nbdesigner_namelang'])){           
            $code = sanitize_text_field($_POST['nbdesigner_codelang']);
            $path_lang = $this->plugin_path_data . 'data/language/'.$code.'.json';
            $path_original_lang = NBDESIGNER_PLUGIN_DIR . 'data/language/en.json';
            $path_original_data_lang = $this->plugin_path_data . 'data/language/en.json';
            if(file_exists($path_original_data_lang)) $path_original_lang = $path_original_data_lang;
            $path_cat_lang = NBDESIGNER_PLUGIN_DIR . 'data/language.json';
            $path_data_cat_lang = $this->plugin_path_data . 'data/language.json';
            if(file_exists($path_data_cat_lang)) $path_cat_lang = $path_data_cat_lang;            
            $cats = json_decode(file_get_contents($path_cat_lang)); 
            $lang = json_decode(file_get_contents($path_original_lang)); 
            $_cat = array();
            $_cat['id'] = 1;
            if(is_array($cats)){                 
                foreach($cats as $cat){                  
                    if($cat->code == $code){
                        $code .=  rand(1,100);
                    }
                    $_cat['id'] = $cat->id;
                }
                $_cat['id'] += 1;
            }else{
                $data['mes'] = 'error';
                echo json_encode($data);
                wp_die();                
            } 
            if(is_array($lang)){
                $data['langs'] = (array)$lang[0];
                $data['code'] = $code;
                $_cat['code'] = $code; 
                $data['name'] = sanitize_text_field($_POST['nbdesigner_namelang']);
                $_cat['name'] = $data['name'];
                if (!copy($path_original_lang, $path_lang)) {
                    $data['mes'] = 'error';
                }else{
                    array_push($cats, $_cat);                  
                    file_put_contents($path_cat_lang, json_encode($cats));   
                    file_put_contents($path_data_cat_lang, json_encode($cats));   
                }
            }else{
                $data['mes'] = 'error';
            }            
        }  
        echo json_encode($data);
        wp_die();
    }
    public function nbdesigner_editor_html(){
        if ( ( ! defined('DOING_AJAX') || ! DOING_AJAX ) && ( ! isset( $_REQUEST['action'] ) || $_REQUEST['action'] != 'nbdesigner_editor_html' ) ) return;
        $path = NBDESIGNER_PLUGIN_DIR . 'views/nbdesigner-frontend-template.php';
        include($path);exit();
    }
    public function nbdesigner_admin_template(){   
        if (isset($_GET['id'])) {
            $pid = $_GET['id'];
            $pro = wc_get_product($pid);
            $list_design = array();
            $path = $this->plugin_path_data . 'admindesign/' . $pid;
            $up = wp_upload_dir();
            $base_path = $up['baseurl'];
            if ($dir = @opendir($path)) {
                while (($file = readdir($dir) ) !== false) {
                    if (in_array($file, array('.', '..')))
                        continue;
                    if (is_dir($path . '/' . $file)) {
                        $path_preview = $path . '/' . $file .'/preview';
                        $listThumb = $this->nbdesigner_list_thumb($path_preview);
                        $mid_path = 'nbdesigner/admindesign/' .$pid. '/' .$file. '/preview/'; 
                        if(count($listThumb)){
                            foreach ($listThumb as $img){
                                $name = basename($img);
                                $url = $base_path.'/'.$mid_path.$name;
                                $list_design[$file][] = $url;
                            }	                            
                        }   
                    }
                }
            }
            if(isset($_POST['nbdesigner_filter'])){
                $status = $_POST['nbdesigner_filter'];
                $result = $this->nbdesigner_get_template_from_db($pid, $status);
                ob_start();
                var_dump($result);
                error_log(ob_get_clean());
            }
            @closedir($dir);            
        } else {
            $args = array(
                'post_type' => 'product',
                'meta_key' => '_nbdesigner_admintemplate_primary',
                'orderby' => 'date',
                'order' => 'DESC',
                'posts_per_page'=>-1,
                'meta_query' => array(
                    array(
                        'key' => '_nbdesigner_admintemplate_primary',
                        'value' => 1,
                    )
                )
            ); 
            $posts = get_posts($args);  
            if(is_array($posts)){
                $list_product = array();
                foreach ($posts as $p){
                    $pro = wc_get_product($p->ID);
                    $list_product[] = array('id' => $p->ID, 'img' => $pro->get_image());
                }
            } 
        }
        include_once(NBDESIGNER_PLUGIN_DIR . 'views/nbdesigner-admin-template.php');
    }
    public function nbdesigner_make_primary_design(){
        if (!wp_verify_nonce($_POST['nonce'], 'nbdesigner_add_cat') || !current_user_can('administrator')) {
            die('Security error');
        }
        $result = array();
        if(isset($_POST['id']) && isset($_POST['folder']) && isset($_POST['task'])){
            $pid = $_POST['id'];
            $folder = $_POST['folder'];
            $task = $_POST['task'];
            $check = true;
            if($task == 'primary'){
                $path_primary = $this->plugin_path_data . 'admindesign/' . $pid . '/primary'; 
                $path_primary_old = $this->plugin_path_data . 'admindesign/' . $pid . '/primary_old'; 
                $path_primary_new = $this->plugin_path_data . 'admindesign/' . $pid . '/' .$folder; 
                if(!rename($path_primary, $path_primary_old)) $check = false; 
                if(!rename($path_primary_new, $path_primary)) $check = false; 
                if(!rename($path_primary_old, $path_primary_new)) $check = false;                 
            }
            if($task != 'primary' && $task != 'delete') {
                $publish = 0;
                $private = '';                
                if($task == 'private') {
                    $publish = 0;
                    $private = 1;
                }
                if($task == 'publish') {
                    $publish = 1;
                    $private = 0;
                }   
                if(! $this->nbdesigner_update_table_templates($pid, $folder, '', $publish, $private )) $check = false; 
                
            }
            if($task == 'delete'){
                if($folder == 'primary'){
                    $check = false;  
                }else{
                    $path = $this->plugin_path_data . 'admindesign/' . $pid . '/' .$folder;
                    if(! $this->nbdesigner_delete_folder($path)) $check = false; 
                    if(! $this->nbdesigner_delete_record_templates($pid, $folder)) $check = false;                     
                }
            }
            if( $check ) $result['mes'] = 'success'; else $result['mes'] = 'error';             
        }else{
            $result['mes'] = 'Invalid data';
        }  
        echo json_encode($result);
        wp_die();
    }
    public function nbdesigner_load_admin_design(){       
        if (!wp_verify_nonce($_POST['nonce'], 'save-design')) {
            die('Security error');
        }  
        $result = array();
        if(isset($_POST['id'])){
            $pid = $_POST['id'];
            $list_design = array();
            $path = $this->plugin_path_data . 'admindesign/' . $pid;
            $up = wp_upload_dir();
            $base_path = $up['baseurl'];
            if ($dir = @opendir($path)) {
                while (($file = readdir($dir) ) !== false) {
                    if (in_array($file, array('.', '..')))
                        continue;
                    if (is_dir($path . '/' . $file)) {
                        $path_preview = $path . '/' . $file .'/preview';
                        $listThumb = $this->nbdesigner_list_thumb($path_preview);
                        $mid_path = 'nbdesigner/admindesign/' .$pid. '/' .$file. '/preview/'; 
                        if(count($listThumb)){
                            foreach ($listThumb as $img){
                                $name = basename($img);
                                $url = $base_path.'/'.$mid_path.$name;
                                $list_design[$file][] = $url;
                            }	                            
                        }   
                    }
                }
            }
            $result['data'] = $list_design;
            $result['mes'] = 'success';
        }else{
            $result['mes'] = 'Invalid data';
        }
        echo json_encode($result);
        wp_die();        
    }
    public function nbdesigner_tools(){
        $custom_css = Nbdesigner_DebugTool::get_custom_css();
        include_once(NBDESIGNER_PLUGIN_DIR . 'views/nbdesigner-tools.php');
    }
    public function nbdesigner_variation_settings_fields($loop, $variation_data, $variation){
        $vid = $variation->ID;
        $enable = get_post_meta($vid, '_nbdesigner_enable'.$vid, true);
        $designer_setting = array(
            array(
                'orientation_name' => 'frame_1',
                'img_src' => NBDESIGNER_PLUGIN_URL . 'assets/images/default.png',
                'real_width' => '30',
                'real_height' => '30',
                'area_design_top' => '50',
                'area_design_left' => '50',
                'area_design_width' => '200',
                'area_design_height' => '200'
            )
        );
        $dpi = get_post_meta($vid, '_nbdesigner_dpi', true);
        if($dpi == "") $dpi = 96;
        $_designer_setting = unserialize(get_post_meta($vid, '_designer_setting'.$vid, true));
        if (isset($_designer_setting[0])) $designer_setting = $_designer_setting;
        include(NBDESIGNER_PLUGIN_DIR . 'views/nbdesigner-box-design-setting-variation.php');
    }
    public function nbdesigner_save_variation_settings_fields($post_id){
        if(!(current_user_can('administrator') || current_user_can('shop_manager')) || !isset($_POST['_nbdesigner_enable'.$post_id])){
            return $post_id;
        }
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }  
        if($_POST['_nbdesigner_variation_status'.$post_id] == "0" ){
            return $post_id;
        }
        $var = get_post($post_id);
        $enable = $_POST['_nbdesigner_enable'.$post_id]; 
        $setting = serialize($_POST['_designer_setting'.$post_id]);  
        if(!$this->nbdesigner_allow_create_product($var->post_parent)) return;
        update_post_meta($post_id, '_nbdesigner_enable'.$post_id, $enable);
        update_post_meta($post_id, '_designer_setting'.$post_id, $setting);
    }    
    public function nbdesigner_copy_image_from_url(){
        if (!wp_verify_nonce($_POST['nonce'], 'save-design')) {
            die('Security error');
        }  
        $url = $_POST['url'];
        $ext = $this->nbdesigner_get_extension($url);
        $allow_extension = array('jpg','jpeg','png','gif');
        if(!in_array(strtolower($ext), $allow_extension)) $ext = 'png';
        $new_name = strtotime("now").substr(md5(rand(1111,9999)),0,8).'.'.$ext;
        $path = $this->plugin_path_data. 'temp/'.$new_name;
        $res['src'] = content_url().'/uploads/nbdesigner/temp/'.$new_name;
        if(@copy($url, $path)){
            $res['flag'] = 1;
        } else {
            $res['flag'] = 0;
        }  
        echo json_encode($res);
        wp_die();
    }
    public function nbdesigner_gallery_func($atts, $content = null) {
        $page = get_query_var( 'paged', 1 );
        $atts = shortcode_atts(array(
            'row' => 5,
            'per_row' => 3,
            'pagination' => 'true',
            'des' => 'Gallery design templates',
            'page' => $page,
            'templates' => $this->nbdesigner_get_all_templates()
            ), $atts);
        return nbdesigner_get_template('gallery.php', $atts);
    }
    public function nbdesigner_get_all_templates(){
        $listTemplates = array();
        $args = array(
            'post_type' => 'product',
            'meta_key' => '_nbdesigner_admintemplate_primary',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page'=>-1,
            'meta_query' => array(
                array(
                    'key' => '_nbdesigner_admintemplate_primary',
                    'value' => 1,
                )
            )
        );   
        $posts = get_posts($args); 
        foreach ($posts as $p){
            $pro = wc_get_product($p->ID);
            $list_design = array();
            $path = $this->plugin_path_data . 'admindesign/' . $p->ID;
            $up = wp_upload_dir();
            $base_path = $up['baseurl'];
            if ($dir = @opendir($path)) {
                while (($file = readdir($dir) ) !== false) {
                    if (in_array($file, array('.', '..')))
                        continue;
                    if (is_dir($path . '/' . $file)) {
                        $path_preview = $path . '/' . $file .'/preview';
                        $listThumb = $this->nbdesigner_list_thumb($path_preview);
                        $mid_path = 'nbdesigner/admindesign/' .$p->ID. '/' .$file. '/preview/'; 
                        if(count($listThumb)){
                            foreach ($listThumb as $img){
                                $name = basename($img);
                                $url = $base_path.'/'.$mid_path.$name;
                                $list_design[$file][] = $url;
                            }	                            
                        }   
                    }
                }
            }
            @closedir($dir);   
            if(is_array($list_design)){
                foreach($list_design as $key => $design){
                    $listTemplates[] = array('id' => $p->ID, 'design' => $design, 'adid' => $key);
                }
            }           
        }        
        return $listTemplates;
    }
    protected static function nbdesigner_get_javascript_multilanguage(){
        $lang = array(
            'error' => __('Oops! Try again later!', 'nbdesigner'),
        );
        return $lang;
    }
    public function nbdesigner_add_tinymce_editor(){
        global $typenow;
        // check user permissions
        if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) return;
        $post_types = get_post_types();
        if (!is_array($post_types)) $post_types = array('post', 'page');
        // verify the post type
        if (!in_array($typenow, $post_types)) return;
        // check if WYSIWYG is enabled
        if (get_user_option('rich_editing') == 'true') {
            add_filter('mce_external_plugins', array($this, 'nbdesigner_add_tinymce_shortcode_editor_plugin'));
            add_filter('mce_buttons', array($this, 'nbdesigner_add_tinymce_shortcode_editor_button'));
        }
        add_action('in_admin_footer', array($this, 'nbdesigner_add_tiny_mce_shortcode_dialog'));
    }   
    public function nbdesigner_add_tinymce_shortcode_editor_plugin($plugin_array){
        $plugin_array['nbdesigner_button'] = NBDESIGNER_JS_URL . 'nbdesigner-tinymce-shortcode.js';		
        return $plugin_array;        
    }
    public function nbdesigner_add_tinymce_shortcode_editor_button($buttons){   
        array_push($buttons, "nbdesigner_button");		
        return $buttons;         
    }    
    public function nbdesigner_add_tiny_mce_shortcode_dialog(){
        include (NBDESIGNER_PLUGIN_DIR . 'views/nbdesigner-shortcode-dialog.php');
    }
    public function nbdesigner_get_suggest_design(){
        if (!wp_verify_nonce($_POST['nonce'], 'save-design')) {
            die('Security error');
        }          
        $result = array();
        $result['mes'] = 'success';
        $result['flag'] = 1;           
        if(isset($_POST['ref']) && isset($_POST['products']) && isset($_POST['sid'])){    
            $ref_pid = $_POST['ref'];
            $products = $_POST['products'];
            $sid = esc_html($_POST['sid']);
            $uid = get_current_user_id();
            $iid = $sid;
            if ($uid > 0) $iid = $uid;
            $up = wp_upload_dir();
            $base_path = $up['baseurl'];             
            $from_path = $this->plugin_path_data . 'designs/' . $iid . '/nb_order/' . $ref_pid;
            if(is_array($products)){
                foreach ($products as $pro){
                    $folder = substr(md5(rand(0, 999999)), 0, 10);
                    $path_suggest = $this->plugin_path_data . 'suggest_designs/' . $folder;
                    $this->nbdesigner_create_thumbnail_design($from_path, $path_suggest, $pro, 300, 300);
                    $list = $this->nbdesigner_list_thumb($path_suggest, $level = 1);
                    $mid_path = 'nbdesigner/suggest_designs/'.$folder.'/';
                    foreach ($list as $img){
                        $name = basename($img);
                        $url = $base_path.'/'.$mid_path.$name;
                        $result['images'][$pro][] = $url;
                    }	                    
                }
            }else{
                $result['mes'] = __('Missing product!', $this->textdomain);
                $result['flag'] = 0;                    
            }
        }else{
            $result['mes'] = __('Missing information!', $this->textdomain);
            $result['flag'] = 0;            
        }        
        echo json_encode($result);
        wp_die();
    }
    /**
     * Allow multi design.
     * Add Product To Cart Multiple Times But As Different items.
     * since 1.5.0
     * 
     */
    public function nbdesigner_force_individual_cart_items($cart_item_data, $product_id) {
        if (isset($_SESSION['nbdesigner']['nbdesigner_' . $product_id])) {
            $unique_cart_item_key = md5(microtime() . rand());
            $cart_item_data['unique_key'] = $unique_cart_item_key;
        }
        return $cart_item_data;
    }
    /**
     * Update data admin templates in older version (before 1.5.0)
     * @since 1.5.0
     * 
     */
    public static function nbdesigner_update_data_150(){
        global $wpdb;
        $origin_path = NBDESIGNER_ADMINDESIGN_DIR . '/';
        $listTemplates = array();
        $args = array(
            'post_type' => 'product',
            'meta_key' => '_nbdesigner_admintemplate_primary',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page'=>-1,
            'meta_query' => array(
                array(
                    'key' => '_nbdesigner_admintemplate_primary',
                    'value' => 1,
                )
            )
        );   
        $posts = get_posts($args); 
        foreach ($posts as $p){
            $pro = wc_get_product($p->ID);
            $list_folder = array();
            $path = $origin_path . $p->ID;
            if ($dir = @opendir($path)) {
                while (($file = readdir($dir) ) !== false) {
                    if (in_array($file, array('.', '..')))
                        continue;
                    if (is_dir($path . '/' . $file)) {
                        $list_folder[] =  $file;
                    }
                }
            }
            @closedir($dir);   
            if(is_array($list_folder)){
                foreach($list_folder as $folder){
                    $listTemplates[] = array('product_id' => $p->ID, 'folder' => $folder);
                }
            }           
        }   
        if(is_array($listTemplates)){
            foreach($listTemplates as $temp){
                $create_date = new DateTime();
                $user_id = wp_get_current_user()->ID;
                $table_name =  $wpdb->prefix . 'nbdesigner_templates';
                $priority = 0;
                if($temp['folder'] == 'primary') $priority = 1;
                $wpdb->insert($table_name, array(
                    'product_id' => $temp['product_id'],
                    'folder' => $temp['folder'],
                    'user_id' => $user_id,
                    'create_date' => $create_date->format('Y-m-d H:i:s'),
                    'publish' => 1,
                    'private' => 0,
                    'priority' => $priority
                ));  
            }                       
        }
    }
    public function nbdesigner_migrate_domain(){
        Nbdesigner_DebugTool::update_data_migrate_domain();
    }
    public function nbdesigner_restore_data_migrate_domain(){
        Nbdesigner_DebugTool::restore_data_migrate_domain();
    }
    public function nbdesigner_theme_check(){
        Nbdesigner_DebugTool::theme_check_hook();
    }
    public function nbdesigner_custom_css(){
        Nbdesigner_DebugTool::save_custom_css();
    }    
}   
/**
 * Locate template.
 *
 * Locate the called template.
 * Search Order:
 * 1. /themes/theme/web-to-print-online-designer/$template_name
 * 2. /themes/theme/$template_name
 * 3. /plugins/web-to-print-online-designer/templates/$template_name.
 *
 * @since 1.3.1
 *
 * @param 	string 	$template_name			Template to load.
 * @param 	string 	$string $template_path	        Path to templates.
 * @param 	string	$default_path			Default path to template files.
 * @return 	string 					Path to the template file.
 */    
function nbdesigner_locate_template($template_name, $template_path = '', $default_path = '') {
    // Set variable to search in web-to-print-online-designer folder of theme.
    if (!$template_path) :
        $template_path = 'web-to-print-online-designer/';
    endif;
    // Set default plugin templates path.
    if (!$default_path) :
        $default_path = NBDESIGNER_PLUGIN_DIR . 'templates/'; // Path to the template folder
    endif;
    // Search template file in theme folder.
    $template = locate_template(array(
        $template_path . $template_name,
        $template_name
    ));
    // Get plugins template file.
    if (!$template) :
        $template = $default_path . $template_name;
    endif;
    return apply_filters('nbdesigner_locate_template', $template, $template_name, $template_path, $default_path);
}
/**
 * Get template.
 *
 * Search for the template and include the file.
 *
 * @since 1.3.1
 *
 * @see wcpt_locate_template()
 *
 * @param string 	$template_name			Template to load.
 * @param array 	$args				Args passed for the template file.
 * @param string 	$string $template_path	        Path to templates.
 * @param string	$default_path			Default path to template files.
 */
function nbdesigner_get_template($template_name, $args = array(), $tempate_path = '', $default_path = '') {
    if (is_array($args) && isset($args)) :
        extract($args);
    endif;
    $template_file = nbdesigner_locate_template($template_name, $tempate_path, $default_path);
    if (!file_exists($template_file)) :
        _doing_it_wrong(__FUNCTION__, sprintf('<code>%s</code> does not exist.', $template_file), '1.3.1');
        return;
    endif;
    include $template_file;
}
