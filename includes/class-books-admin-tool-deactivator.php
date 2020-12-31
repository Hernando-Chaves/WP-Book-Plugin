<?php

/**
 * Fired during plugin deactivation
 *
 * @link       bogotawebcompany.com
 * @since      1.0.0
 *
 * @package    Books_Admin_Tool
 * @subpackage Books_Admin_Tool/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Books_Admin_Tool
 * @subpackage Books_Admin_Tool/includes
 * @author     Hernando J. Chaves <paginas1a@gmail.com>
 */
class Books_Admin_Tool_Deactivator 
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public function deactivate() 
	{
		global $wpdb,$table_prefix;
		/*BORRA LAS TABLAS CREADAS*/
		$wp_query   = $wpdb->prepare("DROP TABLE IF EXISTS ".OWN_TABLE);
		$wp_query_2 = $wpdb->prepare("DROP TABLE IF EXISTS ".SHELF_TABLE);

		$wpdb->query($wp_query);
		$wpdb->query($wp_query_2);

		/*BORRA LAS PÁGINAS CREDAS*/
		$get_data = $wpdb->get_row(
			$wpdb->prepare("SELECT ID FROM ".$table_prefix."posts WHERE post_name = %s", "book-tool")
		);
		// echo $wpdb->last_query;die();

		$page_id = $get_data->ID;

		if($get_data > 0)
		{
			wp_delete_post($page_id,true); 
		}
	}

}

