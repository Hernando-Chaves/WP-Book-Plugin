<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       bogotawebcompany.com
 * @since      1.0.0
 *
 * @package    Books_Admin_Tool
 * @subpackage Books_Admin_Tool/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Books_Admin_Tool
 * @subpackage Books_Admin_Tool/includes
 * @author     Hernando J. Chaves <paginas1a@gmail.com>
 */
class Books_Admin_Tool_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'books-admin-tool',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
