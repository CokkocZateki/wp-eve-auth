<?php
/*
 * This file handles all the admin pages
 * 
 * Builds the admin menu
 * then loads the admin page files
 * 
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); // If file is called directly, die
/*
 * If user is admin
 */
if (is_admin()){    
    add_action('admin_menu', 'wp_eve_auth_admin_menu');
    function wp_eve_auth_admin_menu(){ // Create menu elements
        add_menu_page( 'EVE Auth','EVE Auth', 'administrator', 'eve_auth', 'eve_auth_admin_page');
        add_submenu_page('eve_auth', 'Summary', 'Summary', 'administrator', 'eve_auth_summary', 'eve_auth_summary_page');
        add_submenu_page('eve_auth', 'Set Corp Key', 'Set Corp Key', 'administrator', 'eve_auth_setkey', 'eve_auth_set_key');
    }
    /*
     * Displays an error 
     */
    function wp_eve_auth_error_notice($msg) {
	$class = "error";
	$message = $msg;
        echo"<div class=\"$class\"> <p>$msg</p></div>"; 
    }
    /*
     * Load the api object class
     */
    include_once('api/wp_eve_auth_api.php'); 
    /*
     * Create an instance
     */
    $api = new wp_eve_auth_api();
    /*
     * Include the code for the pages
     */
    include_once('admin-pages/wp-eve-auth-admin-page.php');     // The main admin page
    include_once('admin-pages/wp-eve-auth-summary-page.php');   // The summary page
    include_once('admin-pages/wp-eve-auth-set-key-page.php');   // The set key page
}

