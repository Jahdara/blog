<?php #define db connection constant...

	define('DBNAME','blog');
	define('DBUSER', 'root');
	define('DBPASS', 'native');


try{
	#prepare a pdo instance
	$con=new PDO('mysql:host=localhost;dbname='.DBNAME, DBUSER, DBPASS);

	#set a verbose error mode
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
} catch(PDOException $e) {
	echo $e->getMessage();
}

?>