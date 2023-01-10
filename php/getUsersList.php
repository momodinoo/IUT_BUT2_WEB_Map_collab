<?php
require_once "connexionBD.php";

function getUsersList(){
    try {
        $pdo = seConnecterBD();
        $sql = "SELECT user FROM utilisateur";
        $stmt = $pdo->prepare($sql);
        $bool = $stmt->execute();
        $resultats = [];
        if ($bool) {
            $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
        }
        return $resultats;

    } catch (PDOException $e) {
        // Erreur à l'exécution de la requête
        $erreur = $e->getMessage();
        echo utf8_encode("Erreur d'accès à la base de données : $erreur \n");
        return null;
    }
}