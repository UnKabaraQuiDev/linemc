<?php
$HOST = '192.168.178.10';
$DB_NAME = 'linedb';
$USER = 'Line';
$PASS = 'l0sgCtipXoMRBdBq';

try {
	$db = new PDO("mysql:host=".$HOST.";dbname=".$DB_NAME, $USER, $PASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo $e;
}
?>