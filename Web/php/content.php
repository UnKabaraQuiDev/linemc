<?php
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
		if(isset($_GET['name'])){
			$db->query("UPDATE players SET Current='".$_GET['name']."' WHERE id=" . $_GET['id']);
		}
	}
?>
<div class="center">
	<div class="menu">
		<img src="img/linemc.png">
		<ul class="menulist">
				<a href="#" class="btn btn-success" type="button">Home</a>
				<a href="index.php" class="btn btn-success" type="button">Refresh</a>
		</ul>
	</div>
	<div class="userlistdiv">
		<table class=userlist>
			<tr>
				<td class="border userlistcell1">ID</td>
				<td class="border userlistcell2">NAME</td>
				<td class="border userlistcell1">INFRACTIONS</td>
				<td class="border userlistcell2">CURRENT</td>
				<td class="border userlistcell1">DATE</td>
				<td class="border userlistcell2">RANK</td>
				<td class="border userlistcell1">MONEY</td>
			</tr>
		<?php
			while ($user = $users->fetch()) {
				if($user['Infractions'] == ";") {
					$infractions = "Aucun";
				}else {
					$infractions = $user['Infractions'];
				}
				if($user['Current'] == ";") {
					$current = "Aucun";
				}else {
					$current = $user['Current'];
				}
				echo '<tr class="border">';
				echo '<td class="userlistcell1">'.$user['id'].'</td>';
				echo '<td class="userlistcell2">'.$user['Name'].'</td>';
				echo '<td class="userlistcell1">'.$infractions.'</td>';
				echo '<td class="userlistcell2">'.$current.'</td>';
				echo '<td class="userlistcell1">'.$user['Date'].'</td>';
				echo '<td class="userlistcell2">'.$user['Rank'].'</td>';
				echo '<td class="userlistcell1">'.$user['Money'].'</td>';
				echo '</tr>';
			}
		?>
	</table>
	</div>
</div>