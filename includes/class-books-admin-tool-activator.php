<?php

/**
 * Fired during plugin activation
 *
 * @link       bogotawebcompany.com
 * @since      1.0.0
 *
 * @package    Books_Admin_Tool
 * @subpackage Books_Admin_Tool/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Books_Admin_Tool
 * @subpackage Books_Admin_Tool/includes
 * @author     Hernando J. Chaves <paginas1a@gmail.com>
 */
class Books_Admin_Tool_Activator 
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public function activate() 
	{
		global $table_prefix,$wpdb;

		$table_name    = "table_own";
		$wp_table_name = $table_prefix . $table_name;

/*		CREA LA TABLA  BASE DEL LOS LIBROS*/
		if($wpdb->get_var("SHOW TABLES LIKE '". $wp_table_name ."'") != $wp_table_name)
		{
			$book_table = "
				CREATE TABLE `". $wp_table_name ."` (
				 `id` int(11) NOT NULL AUTO_INCREMENT,
				 `name` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
				 `precio` int(11) DEFAULT NULL,
				 `description` text COLLATE utf8_spanish_ci DEFAULT NULL,
				 `book_image` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
				 `correo` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
				 `shelf_id` INT NULL,
				 `status` int(11) NOT NULL DEFAULT 1,
				 `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
				 PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci

			";

			require_once (ABSPATH. 'wp-admin/includes/upgrade.php');
			dbDelta( $book_table);	

			
		}
	/*CREA LA TABLA  BASE DEL LOS ESTANTES*/
		$shelf_table_name = $table_prefix . "table_shelf";

		if($wpdb->get_var("SHOW TABLES LIKE '". $shelf_table_name ."'") != $shelf_table_name)
		{
			$shelf_table = "
				CREATE TABLE `". $shelf_table_name ."` (
				 `id` int(11) NOT NULL AUTO_INCREMENT,
				 `shelf_name` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
				 `capacity` int(11) DEFAULT NULL,
				 `shelf_location` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
				 `status` int(11) DEFAULT 1,
				 `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
				 PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci
			";
			require_once (ABSPATH . "wp-admin/includes/upgrade.php");
			dbDelta( $shelf_table);

			/*INSERTA INFO EN LA BASE DE DATOS AL ACTIVAR EL PLUGIN*/
			$insert_query = $wpdb->prepare(
				"INSERT INTO ".$shelf_table_name." (`shelf_name`, `capacity`, `shelf_location`, `status`) VALUES 
						('shelf1', 200, 'Centro Derecha', 1),
						('shelf2', 200, 'Centro Arriba', 1),
						('shelf3', 250, 'Centro Izquierda', 1)
				");
			$wpdb->query($insert_query);

			/*CREA UNA PÁGINA AL ACTIVAR EL PLUGIN*/
			$get_data = $wpdb->get_row(
				$wpdb->prepare("SELECT * FROM ".$table_prefix."posts WHERE post_name = %s", "book-tool")
			);

			if(!empty($get_data))
			{

			} else {
				$post_arr_data =
				[
					'post_title'   => 'Publicacion automatica',
					'post_name'    => 'book-tool',
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_content' => 'Aquí va el contenido de la publicación',
					'post_type'    => 'page'
				];
				wp_insert_post($post_arr_data);
			}

		}


	}


}

