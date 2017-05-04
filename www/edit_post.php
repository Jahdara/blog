<?php

		session_start();

		$title = 'Blog:Edit Post';

		include 'includes/db.php';

		include 'includes/functions.php';

		include 'includes/header.php';

		Utils::checkLogin();

		
      if(isset($_GET['pid'])){
			$pid = $_GET['pid'];
		}

		$view = Utils::getPostById($con, $pid);

		if(array_key_exists('submit', $_POST)){

			if(empty($_POST ['title'])){
				$errors['title'] = "Enter Post Title";


			}

			if(empty($_POST['cont'])){
				$errors['cont'] = "Enter Content";
			}

				if(empty($errors)){
					$clean = array_map('trim',$_POST);
					$clean['cont'] = htmlspecialchars_decode($clean['cont']);

					Utils::updatePost($con, $clean, $pid);
					Utils::redirect('view_post.php');
				}
		}


?>

 <div class="wrapper">
		<h1 id="register-label">Add Post</h1>
		<hr>
		<form id="register"  action ="" method ="POST">
			<div>
				<label>Post Title:</label>
				<input type="text" name="title" placeholder="POST TITLE" value="<?php echo $view['post_title']; ?>">
			</div>

			<div>
				<label>Content:</label>
				<textarea name="cont" placeholder="INPUT POST HERE" cols="50" rows="10">
				<?php echo $view['content']; ?>					
				</textarea>
				
			</div>
			
			<input type="submit" name="submit" value="ADD POST">
		</form>





<?php


	include 'includes/footer.php';

?>