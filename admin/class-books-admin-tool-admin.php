<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       bogotawebcompany.com
 * @since      1.0.0
 *
 * @package    Books_Admin_Tool
 * @subpackage Books_Admin_Tool/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Books_Admin_Tool
 * @subpackage Books_Admin_Tool/admin
 * @author     Hernando J. Chaves <paginas1a@gmail.com>
 */
class Books_Admin_Tool_Admin 
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	private $table_activator;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) 
	{

		$this->version     = $version;
		$this->plugin_name = $plugin_name;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() 
	{

		$rutas_activas = ['book-management-tool','books-list','books-create','create-shelf','shelf-list'];

		$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';

		if(in_array($page, $rutas_activas))
		{
			wp_enqueue_style( 'bwc-bootstrap', BWC_PLUGIN_DIR_URL . 'assets/css/bootstrap.min.css', [], $this->version, 'all' );

			wp_enqueue_style( 'bwc-datatables', BWC_PLUGIN_DIR_URL . 'assets/css/jquery.dataTables.min.css', [], $this->version, 'all' );


			wp_enqueue_style( 'bwc-datatables', BWC_PLUGIN_DIR_URL . 'assets/css/dataTables.bootstrap4.min.css', [], $this->version, 'all' );
			
			wp_enqueue_style( 'bwc-fontawesome', BWC_PLUGIN_DIR_URL . 'assets/css/all.min.css', [], $this->version, 'all' );

			wp_enqueue_style( $this->plugin_name, BWC_PLUGIN_DIR_URL . 'admin/css/books-admin-tool-admin.css', [], $this->version, 'all' );
		}
		
		

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() 
	{
		wp_enqueue_script("jquery");

		$rutas_activas = ['book-management-tool','books-list','books-create','create-shelf','shelf-list'];

		$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';

		if(in_array($page, $rutas_activas))
		{
			wp_enqueue_script( "bwc-bootstrap-js", BWC_PLUGIN_DIR_URL . 'assets/js/bootstrap.min.js', ['jquery'], $this->version, true );

			wp_enqueue_script( "bwc-popper-js", BWC_PLUGIN_DIR_URL . 'assets/js/popper.min.js', ['jquery'], $this->version, true );

			wp_enqueue_script( "bwc-validate-js", BWC_PLUGIN_DIR_URL . 'assets/js/jquery.validate.min.js', ['jquery'], $this->version, true );

			wp_enqueue_script( "bwc-datatable-js", BWC_PLUGIN_DIR_URL . 'assets/js/jquery.dataTables.min.js', ['jquery'], $this->version, true );
			
			wp_enqueue_script( "bwc-sweetalert-js", BWC_PLUGIN_DIR_URL . 'assets/js/sweetalert2.all.min.js', ['jquery'], $this->version, true );

			wp_enqueue_script( "bwc-fontawesome-js", BWC_PLUGIN_DIR_URL . 'assets/js/all.min.js', [], $this->version, true );

			wp_enqueue_script( $this->plugin_name, BWC_PLUGIN_DIR_URL . 'admin/js/books-admin-tool-admin.js', ['jquery'], $this->version, true );

			// wp_localize_script( $this->plugin_name, 'bwc_book',[
			// 	'name'   => 'h_chaves',
			// 	'ajaxurl'=> admin_url('admin-ajax.php')
			// ]);
			wp_localize_script( $this->plugin_name, "ajaxhch", [
				'url'=> admin_url('admin-ajax.php')
			] );
		}

	}
	/*/* Function for admin menu*/
	public function books_management_menu()
	{
		add_menu_page( 'Libros admin', 'Libros admin', 'manage_options', 'book-management-tool',[$this, 'book_management_dashboard'],'dashicons-book-alt',15 );

		add_submenu_page( 'book-management-tool', 'Dashboard', 'Dashboard', 'manage_options', 'book-management-tool', [$this,'book_management_dashboard'] );

		add_submenu_page( 'book-management-tool', 'Crear libro', 'Crear libro', 'manage_options', 'books-create', [$this,'book_submenu_create'] );

		add_submenu_page( 'book-management-tool', 'Lista de libros', 'Lista de libros', 'manage_options', 'books-list', [$this,'book_submenu_list'] );


		add_submenu_page( 'book-management-tool', 'Crear Shelf', 'Crear Shelf', 'manage_options', 'create-shelf', [$this,'book_submenu_create_shelf'] );
		
		add_submenu_page( 'book-management-tool', 'Lista de Shelf', 'Lista de Shelf', 'manage_options', 'shelf-list', [$this,'book_submenu_list_shelf'] );
	}
	/*Funcion Callback para el menu admin*/	
	public function book_management_dashboard()
	{
		global $wpdb;

		$title = $wpdb->get_row(
			$wpdb->prepare('SELECT * FROM books_posts WHERE ID = %d', 1)
		);

		echo " <pre>";
			var_dump($title);
		echo "</pre>";
	}
	/*Funcion para crear el sub menu*/
	public function book_submenu_dashboard()
	{
		echo "<h2>Submenu page</h2>";
	}
	public function book_submenu_list()
	{
		global $wpdb;
		$data_book = $wpdb->get_results(
			 $wpdb->prepare(
			 	"SELECT book.*, book_shelf.shelf_name 
			 	FROM " . OWN_TABLE . " as book 
			 	LEFT JOIN ". SHELF_TABLE ." as book_shelf 
			 	ON book.shelf_id = book_shelf.id ORDER BY id ASC")
		);
		ob_start();
		include_once( BWC_PLUGIN_DIR_PATH . 'admin/partials/bwc-books-list.php');
		$template = ob_get_contents();
		ob_end_clean();
		echo $template;
	}
	public function book_submenu_create()
	{
		global $wpdb;
		$data_shelf = $wpdb->get_results(
			$wpdb->prepare("SELECT id, shelf_name FROM " . SHELF_TABLE)
		);

		ob_start();
		include_once( BWC_PLUGIN_DIR_PATH . 'admin/partials/bwc-books-create.php');
		$template = ob_get_contents();
		ob_end_clean();
		echo $template;
	}
	public function book_submenu_list_shelf()
	{
		global $wpdb;
		$data_shelf = $wpdb->get_results(
			$wpdb->prepare("SELECT * FROM " . SHELF_TABLE)
		);

		ob_start();
		include_once ( BWC_PLUGIN_DIR_PATH . 'admin/partials/bwc-books-shelf-list.php');
		$template = ob_get_contents();
		ob_end_clean();
		echo $template;
	}
	public function book_submenu_create_shelf()
	{
		ob_start();
		include_once ( BWC_PLUGIN_DIR_PATH . 'admin/partials/bwc-books-shelf-create.php');
		$template = ob_get_contents();
		ob_end_clean();
		echo $template;
	}
	public function books_admin_ajax_function()
	{
		global $wpdb, $table_prefix;
		$param = isset($_REQUEST['param']) ? $_REQUEST['param'] : '';

		if(!empty($param))
		{
			if($param == "create_book_shelf")
			{
				$nombre    = isset($_REQUEST['txt_name_shelf']) ? $_REQUEST['txt_name_shelf'] : '';
				$capacidad = isset($_REQUEST['dd_capacidad']) ? $_REQUEST['dd_capacidad'] : '';
				$ubicacion = isset($_REQUEST['txt_ubicacion']) ? $_REQUEST['txt_ubicacion'] : '';
				$status    = isset($_REQUEST['dd_status_shelf']) ? $_REQUEST['dd_status_shelf'] : '';

				$wpdb->insert(SHELF_TABLE,[
					'shelf_name'     => $nombre,
					'capacity'       => $capacidad,
					'shelf_location' => $ubicacion,
					'status'         => $status
				]);

				if($wpdb->insert_id > 0)
				{
					echo json_encode([
						'status'  => 1,
						'mensaje' => 'El estante del libro fue creado correctamente',
					]);
				} else {
					echo json_encode([
						'status'  => 0,
						'mensaje' => 'Hubo un error al crear el estante del libro',
					]);
				}
			}elseif($param == "delete_book_shelf")
			{
				$shelf_id = isset($_REQUEST['shelf_id']) ? intval($_REQUEST['shelf_id']) : 0;

				if($shelf_id > 0)
				{
					$wpdb->delete(SHELF_TABLE, ['id'=> $shelf_id,]);
					echo json_encode([
						'status'   => 1,
						'mensaje'  => "El estante fue borrado correctamente"
					]);
				}else{
					echo json_encode([
						'status'   => 0,
						'mensaje'  => "El ID de estante no es valido"
					]);
				}
			} elseif($param == 'create_book')
			{
				$nombre      = isset($_REQUEST['txt_name']) ? $_REQUEST['txt_name'] : '';
				$correo      = isset($_REQUEST['txt_correo']) ? $_REQUEST['txt_correo'] : '';
				$estante     = isset($_REQUEST['txt_estante']) ? intval($_REQUEST['txt_estante']) : 0;
				$status      = isset($_REQUEST['dd_status']) ? $_REQUEST['dd_status'] : '';
				$precio      = isset($_REQUEST['dd_costo']) ? intval($_REQUEST['dd_costo']) : '';
				$img_book    = isset($_REQUEST['book_cover_image']) ? $_REQUEST['book_cover_image'] : '';
				$descripcion = isset($_REQUEST['txt_descripcion']) ? $_REQUEST['txt_descripcion'] : '';

				$wpdb->insert(OWN_TABLE,[
					'name'            => strtolower($nombre),
					'precio'          => $precio,
					'description'     => $descripcion,
					'correo'          => $correo,
					'shelf_id'        => $estante,
					'status'          => $status,
					'book_image'      => $img_book,
				]);

				if($wpdb->insert_id > 0)
				{
					echo json_encode([
						'status'   => 1,
						'mensaje'  => "El libro fue creado correctamente"
					]);
				}else{
					echo json_encode([
						'status'   => 0,
						'mensaje'  => "Hubo un error al crear el libro"
					]);
				}

			}elseif($param == 'delete_book')
			{
				$book_id = isset($_REQUEST['book_id']) ? intval($_REQUEST['book_id']) : 0;

				if($book_id > 0)
				{
					$wpdb->delete(OWN_TABLE,['id'=> $book_id]);
					echo json_encode([
						'status'  => 1,
						'mensaje' => 'El libro fue eliminado correctamente'
					]);
				}else {
					echo json_encode([
						'status'  => 0,
						'mensaje' => 'Error en el id del libro'
					]);
				}
			}
		}
		wp_die();
	}


}
