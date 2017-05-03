<?php

	session_start();

	$title = "Blog:View Post";

	include 'includes/functions.php';

	include 'includes/db.php';

	include 'includes/header.php';

	Utils::checkLogin();

?>

<div class="wrapper">
	<div id="stream">
			<table id="tab">
				<thead>
					<tr>
						
						<th>Date</th>
						<th>firstname</th>
						<th>content</th>
						<th>Post Title</th>
						<th>edit</th>
						<th>delete</th>
						
						
					</tr>
				</thead>
				<tbody>
				
						<?php

						$view = Utils::viewPost($con); echo $view; 

						?>			

          		</tbody>
			</table>
		</div>

		



<?php

		include 'includes/footer.php';
?>