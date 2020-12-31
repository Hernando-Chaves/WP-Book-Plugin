<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              bogotawebcompany.com
 * @since             1.0.0
 * @package           Books_Admin_Tool
 *
 * @wordpress-plugin
 * Plugin Name:       Books Admin
 * Plugin URI:        bogotawebcompany.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Hernando J. Chaves
 * Author URI:        bogotawebcompany.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       books-admin-tool
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) 
{
	die;
}
global $wpdb,$table_prefix;
define("BWC_PLUGIN_DIR_URL",plugin_dir_url( __FILE__ ));
define("BWC_PLUGIN_DIR_PATH",plugin_dir_path( __FILE__ ));
define("OWN_TABLE","{$table_prefix}table_own");
define("SHELF_TABLE","{$table_prefix}table_shelf");

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'BOOKS_ADMIN_TOOL_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-books-admin-tool-activator.php
 */
function activate_books_admin_tool() 
{
	require_once BWC_PLUGIN_DIR_PATH . 'includes/class-books-admin-tool-activator.php';
	$activador = new Books_Admin_Tool_Activator();
	$activador->activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-books-admin-tool-deactivator.php
 */
function deactivate_books_admin_tool() 
{
	require_once BWC_PLUGIN_DIR_PATH . 'includes/class-books-admin-tool-deactivator.php';
	$deactivator = new Books_Admin_Tool_Deactivator();
	$deactivator->deactivate();
}

register_activation_hook( __FILE__, 'activate_books_admin_tool' );
register_deactivation_hook( __FILE__, 'deactivate_books_admin_tool' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require BWC_PLUGIN_DIR_PATH . 'includes/class-books-admin-tool.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_books_admin_tool() 
{

	$plugin = new Books_Admin_Tool();
	$plugin->run();

}
run_books_admin_tool();
