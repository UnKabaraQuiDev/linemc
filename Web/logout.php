<?php 
	include 'php/database.php';
	global $HOST;
	global $DB_NAME;
	global $USER;
	global $PASS;
	try {
		$db = new PDO("mysql:host=".$HOST.";dbname=".$DB_NAME, $USER, $PASS);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo $e;
	}
	global $db;
	$db_table = $arrayName = array('p' => 'players', 'u' => 'users');
?>
<!DOCTYPE html>
<html>
<head>
	<title>LINEMC - Login</title>
</head>
<body>
	<?php
		try {
			session_unset();
			//session_destroy();
			setcookie('userid', "", time());
			echo "Successfully disconnect !";
			//header('Location: login.php');
		}catch(Exception $e) {
			echo "Unable to disconnect !";
		}
	?>
</body>
</html>
