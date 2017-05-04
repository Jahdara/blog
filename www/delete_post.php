<?php

		session_start();

		$title = "Blog:Delete Post";

		include 'includes/db.php';
		include 'includes/functions.php';

		Utils::checkLogin();

		if(isset($_GET['pid'])){
			$pid = $_GET['pid'];
		}

		Utils::deletePost($con,$pid);
		Utils::redirect('view_post.php');

?>



