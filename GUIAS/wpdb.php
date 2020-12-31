<?php 

	global $wpdb;
	
		echo "<h2>RESULTADOS PARA GET VAR</h2>";
		$email_user = $wpdb->get_var('SELECT user_email FROM books_users');
		echo "Este es el correo " . $email_user. "<br>";

		echo "<h2>RESULTADOS PARA GET ROW</h2>";
		$data_row = $wpdb->get_row('SELECT * FROM books_users WHERE ID = 1',ARRAY_A );
		echo "La fila es :" ;
		echo "<pre>";
			print_r($data_row);
		echo "</pre>";

		echo "<h2>RESULTADOS PARA GET COL</h2>";
		$get_col = $wpdb->get_col('SELECT post_title FROM books_posts');

		echo "<pre>";
			var_dump($get_col);
		echo "</pre>";
		
		echo "<h2>RESULTADOS PARA GET RESULTS</h2>";
		$get_results = $wpdb->get_results('SELECT ID, post_title FROM books_posts',ARRAY_A);
		echo "<pre>";
			var_dump($get_results);
		echo "</pre>";