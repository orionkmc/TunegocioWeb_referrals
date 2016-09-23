<?php
/**
* Plugin Name: TunegocioWeb referrals
* Plugin URI: https://localhost
* Description: CRM
* Version: 1.0.0
* Author: orionkmc
* Author URI: http://orionkmc.com
* License: GPL2
*/

//add_action('wpcf7_admin_after_additional_settings', 'add_ticket');

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

final class TunegocioWeb_referrals{
    public function __construct()
    {
        $this->define_constants();
        register_activation_hook( __FILE__, array($this,'installation') );
        $this->include_files();
    }

    function define_constants()
    {
        define( 'TNW_ADD_DIR', plugin_dir_path( __FILE__ ) );
        define( 'REFERRALS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
        define( 'TNW_VERSION_ADDON_REFERED', '0.0.1' );
    }

    private function include_files()
    {
        if (is_admin()) {
            //require_once( TNW_ADD_DIR . '/includes/admin/activate.php' );
            include_once( TNW_ADD_DIR .'includes/admin/admin.php' );
            /*include_once( TNW_PLUGIN_DIR.'includes/admin/ajax.php' );
            $ajax = new TunegocioWebAjax();
            add_action( 'wp_ajax_add', array( $ajax, 'add' ) );*/
            //include_once( TNW_PLUGIN_DIR.'class/contact.class.php' );
        }
        else{
            include_once( TNW_ADD_DIR.'includes/shortcode.php' );
        }
    }

    function installation(){
        include_once( TNW_ADD_DIR.'includes/admin/installation.php' );
    }
}
new TunegocioWeb_referrals();