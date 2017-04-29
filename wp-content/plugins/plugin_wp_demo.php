<?php 
/*
 Plugin Name: Wordpress demo 
 Plugin URI: https://localhost
 Description: Basic Wordpress Plugin Header Comment 
 Version: 20160911
 Author: Lee Phuoc
 Author URI: https://localhost
 Text Domain: wordpress.org
 License: GPL2
 */

class Plugin_wordpress_demo {
	
	function __construct() {
	}	

	function demo() {
		$school = new School();
	}
} 

class School {
	
	/** Construct */
	function __construct() {
		add_action('admin_menu', array($this,'leephuoc_setup_menu'));		
	}
	
	/**
	  * Function to setup menu 
	  */
	function leephuoc_setup_menu() {
		add_menu_page('Page title', 'Top-level menu title', 'manage_options', 'my-top-level-handle', array($this, 'leephuoc_create_school'));
		add_submenu_page( 'my-top-level-handle', 'Page title', 'Sub-menu title', 'manage_options', 'my-submenu-handle', 'my_magic_function');
	}

	/**
	  * Function to show view create
	  */
	function leephuoc_create_school() {
		echo $wpdb->prefix; die;

		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			echo $_POST['name']; die;
		} else {
			include('create_school.php');	
		}

	}

	/**
	  * Function to show view create
	  */
	function leephuoc_update_school() {
		echo '<h1>Hello</h1>';

	}
}

function plugin_create_table() {
	global $wpdb;
	global $jal_db_version;

	$table_name = $wpdb->prefix . 'liveshoutbox';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		name tinytext NOT NULL,
		text text NOT NULL,
		url varchar(55) DEFAULT '' NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}

register_activation_hook(__FILE__, 'plugin_create_table');
//$school = new School();