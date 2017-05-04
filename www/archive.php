<?php
	session_start();

	$title= 'Blog:Archive';

	include 'includes/db.php';

	include 'includes/functions.php';

	Utils::checkLogin();

	if(isset($_GET['pid'])){
		$pid =$_GET ['pid'];
	}

	Utils::insertArchive($con, $pid);
	Utils::redirect('view_post.php');



?>