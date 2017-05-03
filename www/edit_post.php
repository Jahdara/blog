<?php

		session_start();

		$title = 'Blog:Edit Post';

		include 'includes/db.php';

		include 'includes/functions.php';

		include 'includes/header.php';


?>

 <div class="wrapper">
		<h1 id="register-label">Add Post</h1>
		<hr>
		<form id="register"  action ="" method ="POST">
			<div>
				<label>Title:</label>
				<input type="text" name="title" placeholder="POST TITLE" value="<?php echo $view['title']; ?>">
			</div>

			<div>
				<label>post:</label>
				<textarea name="post" placeholder="INPUT POST HERE" cols="50" rows="10" value="<?php echo $view['posts']; ?>">					
				</textarea>
				
			</div>
			
			<input type="submit" name="submit" value="ADD POST">
		</form>





<?php


	include 'includes/footer.php';

?>