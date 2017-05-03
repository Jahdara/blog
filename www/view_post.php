<?php

	session_start();

	$title = "Blog:Register";

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
						<th>Post Id</th>
						<th>Date</th>
						<th>Post Title</th>
						<th>content</th>
						<th>firstname</th>
					</tr>
				</thead>
				<tbody>
				
						<?php

							$view =viewPost($con); echo $view; 

						?>			

          		</tbody>
			</table>
		</div>

		



<?php

		include 'includes/footer.php';
?>