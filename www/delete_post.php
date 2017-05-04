<?php

		session_start();

		$title = "Blog:Delete Post";

		include 'includes/db.php';
		include 'includes/functions.php';

		if(isset($_GET('pid'))){
			$pid = $_GET['pid'];
		}


?>