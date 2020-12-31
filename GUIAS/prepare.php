<?php 

global $wpdb;

		$title = $wpdb->get_row(
			$wpdb->prepare('SELECT * FROM books_posts WHERE ID = %d', 1)
		);

		$query = $wpdb->query(
			$wpdb->prepare('INSERT INTO books_users (col1,col2,col3) VALUES (%d,%s,$d),5,"cfa@gmail.com",2');
		);

		echo " <pre>";
			var_dump($title);
		echo "</pre>";