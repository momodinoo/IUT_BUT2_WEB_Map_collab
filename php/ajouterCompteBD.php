<?php
require_once "connexionBD.php";
function ajouterCompte($user, $prenom, $nom, $mail, $age, $pays, $pw) {
    try {
        $pdo = seConnecterBD();
        $sql="INSERT INTO `utilisateur` VALUES (:valUser,:valPrenom,:valNom,:valMail,:valAge,:valPays);INSERT INTO `login` VALUES (:valUser,:valMDP)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":valUser", $user);
        $stmt->bindParam(":valPrenom", $prenom);
        $stmt->bindParam(":valNom", $nom);
        $stmt->bindParam(":valMail", $mail);
        $stmt->bindParam(":valAge", $age);
        $stmt->bindParam(":valPays", $pays);
        $stmt->bindParam(":valMDP", $pw);
        $bool = $stmt->execute();
        include_once("php/rechercherCompteBD.php");
        $compte = rechercherCompte($user,$pw);
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