<?php
/**
 * @package Nbdesigner
 */
/*
Plugin Name: Nbdesigner
Plugin URI: https://cmsmart.net/wordpress-plugins/woocommerce-online-product-designer-plugin
Description: Allow customer design product before purchase.
Version: 1.4.0
Author: Netbaseteam
Author URI: http://netbaseteam.com/
License: GPLv2 or later
Text Domain: nbdesigner
Domain Path: /langs
*/

if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define('NBDESIGNER_VERSION', '1.4.0');
define('NBDESIGNER_MINIMUM_WP_VERSION', '4.1.1');
define('NBDESIGNER_PLUGIN_URL', plugin_dir_url(__FILE__));
define('NBDESIGNER_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('NBDESIGNER_PLUGIN_BASENAME', plugin_basename(__FILE__));
define('NBDESIGNER_MODE_DEBUG', 'dev');

require_once(NBDESIGNER_PLUGIN_DIR . 'includes/class.nbdesigner.debug.php');
require_once(NBDESIGNER_PLUGIN_DIR . 'includes/class.nbdesigner.php');

register_activation_hook( __FILE__, array( 'Nbdesigner_Plugin', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'Nbdesigner_Plugin', 'plugin_deactivation' ) );
$prefix = is_network_admin() ? 'network_admin_' : '';       
add_filter( $prefix.'plugin_action_links_' . NBDESIGNER_PLUGIN_BASENAME, array('Nbdesigner_Plugin', 'nbdesigner_add_action_links') );
add_filter( 'plugin_row_meta', array( 'Nbdesigner_Plugin', 'nbdesigner_plugin_row_meta' ), 10, 2 );
if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}
$nb_designer = new Nbdesigner_Plugin();
require_once(NBDESIGNER_PLUGIN_DIR . 'includes/class.nbdesigner.widget.php');