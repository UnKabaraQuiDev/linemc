<?php 
	session_start();
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

	<form method="post">
		<input type="email" name="Email" id="Email" required="">
		<input type="password" name="Pass" id="Pass" required="">
		<input type="checkbox" name="save" id="save">
		<input type="submit" name="submit" id="submit">
		<?php
			if(isset($_POST['submit'])){
				if(!empty($_POST['Email']) && !empty($_POST['Pass'])) {
					$q = $db->prepare("SELECT * FROM users WHERE email=:email AND Pass=:pass");
					$q->execute([
						'email'=>$_POST['Email'],
						'pass'=>$_POST['Pass']
					]);
					$result = $q->fetch();
					if($result == true){
						$_SESSION['userid'] = $result['pid'];
						if($_POST['save'] == true) {
							setcookie('userid', $result['pid'], time()+(60*60*24*30));
						}
						header('Location: index.php');
						echo "oui";
					}else {
						echo "no";
					}
				}
			}
		?>
	</form>

</body>
</html>
