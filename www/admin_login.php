<?php

	session_start();

	include 'includes/header.php';

	include 'includes/db.php';

	include 'includes/functions.php';

	$errors=[];

	if(array_key_exists('login', $_POST)) {

		if(empty($_POST['email'])) {
			$errors['email'] = "please enter an email address";
		}

		if(empty($_POST['password'])) {
			$errors['password'] = "please enter a password";
		}

		# be sure there are no errors
		if(empty($errors)) {
			# attempt to log user in...
			$clean = array_map('trim', $_POST);

			$check = Utils::doAdminLogin($con, $clean);

			# set sessions
			$_SESSION['admin_id'] = $check[1];

			# redirect
			header("Location: add_post.php"); 
		}
	}

?>



<div class="wrapper">
		<h1 id="register-label">Admin Login</h1>
		<hr>
		<form id="register"  action ="admin_login.php" method ="POST">
		<?php
			if(isset($_GET['msg'])){ echo '<span class="err">'.$_GET['msg'].'</span>'; }
		?>
			<div>
				<?php Utils::displayErrors("email", $errors); ?>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>
			<div>
				<?php Utils::displayErrors("password", $errors); ?>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>

			<input type="submit" name="login" value="login">
		</form>

		<h4 class="jumpto">Don't have an account? <a href="admin_register.php">register</a></h4>
	</div>





<?php
	
	include 'includes/footer.php';

?>