<?php
	$dbHostname = "localhost";
	$dbName = "mapcollab";
	$dbLogin = "root";	
	$dbPwd = "root";
	// URL de connexion à la base de données
	$dbURL = "mysql:server=$dbHostname;dbname=$dbName";

	// renvoie un objet Connexion ($pdo) à la base de données
	function seConnecterBD () {
		global $dbLogin,$dbPwd, $dbURL;
		$pdo = new PDO ($dbURL, $dbLogin, $dbPwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
		return $pdo;
	}
?>

