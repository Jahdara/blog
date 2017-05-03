<?php
	class Utils 
	{
		public static function checkLogin() {
			if(!isset($_SESSION['admin_id'])) {
				static::redirect("admin_login.php", "");
			}
		}

		public static function displayErrors($key, $arr) {

			if(isset($arr[$key])) {
				echo '<span class="err">'.$arr[$key]. '</span>';
			}

		}


		public static function doRegistration($dbcon, $input) {
			$stmt = $dbcon->prepare("INSERT INTO admin(firstname, lastname, email, hash) 
					VALUES(:fn, :ln, :e, :h)");

			$data = [
				":fn" => $input['fname'],
				":ln" => $input['lname'],
				":e" => $input['email'],
				":h" => $input['password']
			];

			$stmt->execute($data);
		} 


		public static function doesEmailExist($dbcon, $email) {
			$result = false;

			$stmt = $dbcon->prepare("SELECT * FROM admin WHERE email=:e");
			$stmt->bindParam(":e", $email); 

			$stmt->execute();

			# count result set
			$count = $stmt->rowCount();

			if($count > 0) { $result = true; }

			return $result;
		}


	public static function doAdminLogin($dbcon, $input) {
			$result = [];

			$stmt = $dbcon->prepare("SELECT *FROM admin WHERE email=:e");
			$stmt->bindParam(":e", $input['email']);

			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_BOTH);

			# if either the email or password is wrong, we return a false array
			if( ($stmt->rowCount() != 1) || !password_verify($input['password'], $row['hash']) ) {

			Utils::redirect("admin_login.php? +msg=", "either username or password is incorrect");
				exit();
			} else {
				# return true plus extra information...
				$result[] = true;
				$result[] = $row['admin_id'];
			}

			return $result;
		}


		public static function redirect($loc, $msg) {
			header("Location: ".$loc.$msg);
		}


		public static function addPost($dbcon, $input, $admin_id){
			$stmt=$dbcon->prepare("INSERT INTO post (post_id,date,post_title,content,admin_id) VALUES(NULL,NOW(),:pt,:c,:aid)");
			$data =[

			":pt"=>$input['postt'],
			":c"=>$input['cont'],
			":aid"=>$admin_id
			];
			$stmt->execute($data);
		}

		public static function curNav($page) {
			$curPage = basename($_SERVER['SCRIPT_FILENAME']);
			if($curPage == $page) {
				echo 'class="selected"';
			}
		}

		public static function viewPost($dbcon){
			$result = "";

			$stmt = $dbcon->prepare("SELECT *FROM post");
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_BOTH)){

				$result .= '<tr>
							<td>'.$row['date'] .'</td>;
							<td>'.$row['post_title'].'</td>;
							<td>'.$row['content'].'</td>;
							<td>'.$row['admin_id'].'</td>;
							<td><a href="edit_post.php?pid='.$row['post_id'].'">edit</a></td>;
						<td><a href="delete_post.php?pid='.$row['post_id'].'">delete</a></td>;
						</tr>';
			}

			return $result;
		}

	}