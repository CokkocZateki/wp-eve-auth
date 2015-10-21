<?php
/*
Plugin Name: WP Eve Auth
Plugin URI: http://vooders.com/
Description: A corp authentication plugin for WordPress.
Version: 0.0.1
Author: Vooders
Author URI: http://vooders.com
License: GPL
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); // If file is called directly, die

/* Includes */
include('wp-eve-auth-options.php'); // The admin page code
include('wp-eve-auth-db.php'); // The db functions
include('wp-eve-auth-reg-form.php');// The registration form changes

/* Register Hooks */
register_activation_hook(__FILE__, 'wp_eve_auth_activate'); 
register_deactivation_hook(__FILE__, 'wp_eve_auth_deactivate');  

/*
 * This function runs when the plugin is activated.
 */
function wp_eve_auth_activate(){
    add_option('corp_vcode', '', '', 'yes');
    add_option('corp_key_id', '', '', 'yes');
    add_col('vcode', 'users', '0'); // Add the vcode column in the users table
    add_col('key_id', 'users', '0');// Adds the key id column in the users table
}

/*
 * This function runs when the plugin is deactivated
 * 
 * Try to leave WordPress as we found it
 */
function wp_eve_auth_deactivate(){
   delete_option('corp_vcode');
   delete_option('corp_key_id');
   drop_col('vcode', 'users');
   drop_col('key_id', 'users');
}
/*
 * Will check a valid corp api key is set
 */
function corpSet(){
    return true;
}