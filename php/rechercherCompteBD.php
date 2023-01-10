<?php
require_once "connexionBD.php";
function rechercherCompte($user,$pw) {
	try {
		$pdo = seConnecterBD();
		$sql="SELECT * FROM `utilisateur` WHERE user=(select user from login where user=:valUser AND mdp=:valMDP)";

		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":valUser", $user);
		$stmt->bindParam(":valMDP", $pw);
		$bool = $stmt->execute();
		$resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$compte = null;
		if (count ($resultats) > 0)
			$compte = $resultats[0];
		$stmt->closeCursor();
		return $compte;
	}	
	catch (PDOException $e) {
		// Erreur à l'exécution de la requête 
		$erreur = $e->getMessage();
		echo utf8_encode("Erreur d'accès à la base de données : $erreur \n");		
		return null;
	}
}