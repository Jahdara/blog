<?php

	session_start();

	$title = "Blog:Add Post";

	$admin_id = $_SESSION['admin_id']; 

	include 'includes/db.php';

	include 'includes/functions.php';

	include 'includes/dashboard_header.php';

	Utils::checkLogin();

	

	$errors = [];

	if(array_key_exists('add',$_POST)){

		if(empty($_POST ['postt'])){
			$errors['postt']= "Please Enter your Post Title";
		}

		if(empty($_POST ['cont'])){
			$errors['cont']= "Please Enter your Content";
		}

		if(empty($errors)){
			$clean = array_map('trim', $_POST);
			$clean ['cont'] = htmlspecialchars($clean['cont']);
			Utils::addPost($con, $clean, $admin_id);
		}
	}



?>



<div class="wrapper">
		<div id="stream">

				<form id= "register" action= "add_post.php" method="POST">



				<h3>Post Title</h3>
				<input type="text" name="postt" placeholder="Enter Title"/>


				<?php

					Utils::displayErrors($errors,'post');
			
				?>

				<h3>Content:</h3>
				<textarea name="cont" placeholder="Enter Content"></textarea>

				<input type="submit" name="add" cols="50" rows="10" value="Add">
				</form>
				
				</div>
	</div>