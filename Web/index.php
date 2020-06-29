<?php
	$_SESSION['userid'] = "ppmonpp";
	$sess = $_SESSION['userid'];
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
	$db_table = $arrayName = array('p' => 'players', 'u' => 'users');
	$users = $db->query("SELECT * FROM players");
	if(isset($_GET['id'])){
		$db->query("UPDATE players SET Current='ALLLL' WHERE id=" . $_GET['id']);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>LINEMC - Players Management</title>
	<link rel="stylesheet" type="text/css" href="../../wampthemes/simple/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body class=body>
	<?php
		function affiche() {
			include 'php/content.php';
		}
	?>
	<?php
		if(isset($_SESSION['userid'])){
			$q = $db->prepare("SELECT * FROM ".$db_table['u']." WHERE pid=:pid");
			$q->execute([
				'pid' => $sess
			]);
			$ql = $q->fetch();
			if($ql == true) {
				$qll = $ql['Perm'];
				if(strpos($ql['Perm'], ';')){
					$qll = preg_split('/;/', $qll);
				}else {
					$qll = $ql['Perm'];
				}
				//PlM = PlayerManagement
				if(is_array($qll)) {
					if(in_array("PlM", $qll)){
						affiche();
					}
				}else {
					if(strpos($qll, "PlM") !== false) {
						affiche();
					}
				}
			}
		}else {
			header('Location: login.php');
		}
	?>
</body>
<footer>
	
</footer>
</html>