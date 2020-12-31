<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       bogotawebcompany.com
 * @since      1.0.0
 *
 * @package    Books_Admin_Tool
 * @subpackage Books_Admin_Tool/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Books_Admin_Tool
 * @subpackage Books_Admin_Tool/public
 * @author     Hernando J. Chaves <paginas1a@gmail.com>
 */
class Books_Admin_Tool_Public 
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

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) 
	{

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() 
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Books_Admin_Tool_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Books_Admin_Tool_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, BWC_PLUGIN_DIR_URL . 'public/css/books-admin-tool-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() 
	{

		wp_enqueue_script( $this->plugin_name, BWC_PLUGIN_DIR_URL . 'public/js/books-admin-tool-public.js', array( 'jquery' ), $this->version, false );

		wp_localize_script( $this->plugin_name, "ajaxhch", [
				'url'=> admin_url('admin-ajax.php')
			] );

	}

	public function bwc_custom_page_template()
	{
		global $post;

		if($post->post_name = 'book-tool')
		{
			$page_template = BWC_PLUGIN_DIR_PATH . 'public/partials/book-tool-layout.php';

			return $page_template;
		}
	}

	public function load_book_tool_content()
	{
		ob_start();
		include_once BWC_PLUGIN_DIR_PATH . 'public/partials/book-tool-content.php';
		$template = ob_get_contents();
		ob_end_clean();

		echo $template;
	}

	public function handle_ajax_request_public()
	{
		$param = isset($_REQUEST['param']) ? $_REQUEST['param'] : '';

		if(!empty($param))
		{
			if($param == 'first_public_ajax')
			{
				echo json_encode([
					'status'  => 1,
					'mensaje' => 'Primera petición Publica ajax',
				]);
			}
		}

		wp_die();
	}

}
