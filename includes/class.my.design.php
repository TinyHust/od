<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly   ?>
<?php
class My_Design_Endpoint {

    /**
     * Custom endpoint name.
     *
     * @var string
     */
    public static $endpoint = 'my-designs';

    /**
     * Plugin actions.
     */
    public function __construct() {
        // Actions used to insert a new endpoint in the WordPress.
        add_action('init', array($this, 'add_endpoints'));
        add_filter('query_vars', array($this, 'add_query_vars'), 0);

        // Change the My Accout page title.
        add_filter('the_title', array($this, 'endpoint_title'));

        // Inserting your new tab/page into the My Account page.
        add_filter('woocommerce_account_menu_items', array($this, 'new_menu_items'));
        add_action('woocommerce_account_' . self::$endpoint . '_endpoint', array($this, 'endpoint_content'));
        
        //Inserting user info
        add_action( 'show_user_profile', array( $this, 'user_profile' ) );
        add_action( 'edit_user_profile', array( $this, 'user_profile' ) );  

        //Update user info
        add_action( 'personal_options_update', array( $this, 'process_user_option_update' ) );
        add_action( 'edit_user_profile_update', array( $this, 'process_user_option_update' ) );  
        
        //User update artist name
        add_action('wp_ajax_nbd_update_artist_name', array($this, 'update_artist_name'));
    }

    /**
     * Register new endpoint to use inside My Account page.
     *
     * @see https://developer.wordpress.org/reference/functions/add_rewrite_endpoint/
     */
    public function add_endpoints() {
        add_rewrite_endpoint(self::$endpoint, EP_ROOT | EP_PAGES);
    }

    /**
     * Add new query var.
     *
     * @param array $vars
     * @return array
     */
    public function add_query_vars($vars) {
        $vars[] = self::$endpoint;

        return $vars;
    }

    /**
     * Set endpoint title.
     *
     * @param string $title
     * @return string
     */
    public function endpoint_title($title) {
        global $wp_query;

        $is_endpoint = isset($wp_query->query_vars[self::$endpoint]);

        if ($is_endpoint && !is_admin() && is_main_query() && in_the_loop() && is_account_page()) {
            // New page title.
            $title = __('My designs', 'web-to-print-online-designer');

            remove_filter('the_title', array($this, 'endpoint_title'));
        }

        return $title;
    }

    /**
     * Insert the new endpoint into the My Account menu.
     *
     * @param array $items
     * @return array
     */
    public function new_menu_items($items) {
        // Remove the logout menu item.
        $logout = $items['customer-logout'];
        unset($items['customer-logout']);

        // Insert your custom endpoint.
        $items[self::$endpoint] = __('My designs', 'web-to-print-online-designer');

        // Insert back the logout item.
        $items['customer-logout'] = $logout;

        return $items;
    }

    /**
     * Endpoint HTML content.
     */
    public function endpoint_content($param) {
        $user = wp_get_current_user();
        $designs = $this->get_my_designs();
        ob_start();
        nbdesigner_get_template('my-designs.php', array('user' => $user, 'designs'  =>  $designs));
        $content = ob_get_clean();
        echo $content;
    }
    public function user_profile( $user ) {

            wp_nonce_field( 'nbd_user_profile_update', 'nbd_nonce' );

            require_once NBDESIGNER_PLUGIN_DIR . 'views/user-profile.php';
    }
    /**
     * Filter POST variables.
     *
     * @param string $var_name Name of the variable to filter.
     *
     * @return mixed
     */
    private function filter_input_post( $var_name ) {
        $val = filter_input( INPUT_POST, $var_name );
        if ( $val ) {
            return sanitize_text_field( $val );
        }
        return '';
    }    
    /**
     * Updates the user metas that (might) have been set on the user profile page.
     *
     * @param    int $user_id of the updated user.
     */
    public function process_user_option_update( $user_id ) {
        update_user_meta( $user_id, '_nbd_profile_updated', time() );

        $nonce_value = $this->filter_input_post( 'nbd_nonce' );

        if ( empty( $nonce_value ) ) { // Submit from alternate forms.
                return;
        }
        check_admin_referer( 'nbd_user_profile_update', 'nbd_nonce' );
        update_user_meta( $user_id, 'nbd_artist_name', $this->filter_input_post( 'nbd_artist_name' ) );
        update_user_meta( $user_id, 'nbd_sell_design', $this->filter_input_post( 'nbd_sell_design' ) );
    }    
    public function update_artist_name(){
        if (!wp_verify_nonce($_POST['nbd_nonce'], 'nbd_artist_update')) {
            die('Security error');
        }       
        $result = array('flag' => 0, 'name' => '');
        $user_id = wp_get_current_user()->ID;
        if( update_user_meta( $user_id, 'nbd_artist_name', $this->filter_input_post( 'nbd_artist_name' ) )){
            $result['name'] = $this->filter_input_post( 'nbd_artist_name' );
            $result['flag'] = 1;
        }
        echo json_encode($result); wp_die();
    }
    public static function insert_my_designs($folder){
        global $wpdb;
        $created_date = new DateTime();
        $user_id = wp_get_current_user()->ID;
        $table_name =  $wpdb->prefix . 'nbdesigner_mydesigns';
        $wpdb->insert($table_name, array(
            'price' => 0,
            'folder' => $folder,
            'user_id' => $user_id,
            'created_date' => $created_date->format('Y-m-d H:i:s')
        ));
        return true;
    } 
    public function get_my_designs(){
        global $wpdb;
        $designs = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}nbdesigner_mydesigns ORDER BY created_date LIMIT 10" );
        return $designs;
    }
    /**
     * Plugin install action.
     * Flush rewrite rules to make our custom endpoint available.
     */
    public static function install() {
        flush_rewrite_rules();
    }

}
