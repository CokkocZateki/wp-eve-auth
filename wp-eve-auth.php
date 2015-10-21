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
 * 
 * Used to setup the database
 */
function wp_eve_auth_activate(){
    /* Add custom options */
    // Corp API key
    add_option('corp_vcode', '', '', 'yes');
    add_option('corp_key_id', '', '', 'yes');
    // Corp data
    add_option('corp_name', '', '', 'yes');
    add_option('corp_id', '', '', 'yes');
    add_option('corp_ticker', '', '', 'yes');
    // Alliance data
    add_option('alliance_name', '', '', 'yes');
    add_option('alliance_id', '', '', 'yes');
    add_option('alliance_ticker', '', '', 'yes');
    /* Add custom columns to */
    add_col('vcode', 'users', '0'); // Add the vcode column in the users table
    add_col('key_id', 'users', '0');// Adds the key id column in the users table
}

/*
 * This function runs when the plugin is deactivated
 * 
 * Revert the changes to the database
 * Try to leave WordPress as we found it
 * 
 */
function wp_eve_auth_deactivate(){
   /*
    * Delete the extra options
    */
   delete_option('corp_vcode');
   delete_option('corp_key_id');
   delete_option('corp_name');
   delete_option('corp_id');
   delete_option('corp_ticker');
   delete_option('alliance_name');
   delete_option('alliance_id');
   delete_option('alliance_ticker');
   /*
    * Drop extra columns we've added
    */
   drop_col('vcode', 'users');
   drop_col('key_id', 'users');
}
/*
 * Will check a valid corp api key is set
 */
function corpSet(){
    return true;
}