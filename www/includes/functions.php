<?php
	class Utils 
	{
		public static function checkLogin() {
			if(!isset($_SESSION['admin_id'])) {
				static::redirect("admin_login.php", "");
			}
		}

		public static function displayError($key, $arr) {

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
	}