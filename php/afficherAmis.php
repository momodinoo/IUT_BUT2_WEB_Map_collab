<?php
require_once "connexionBD.php";

function recupAmis($user){
    try {
        $pdo = seConnecterBD();
        $sql = "SELECT ami2 FROM `amis` WHERE ami1=:valUser";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":valUser", $user);
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

function recupInfos($user){
    try {
        $pdo = seConnecterBD();
        $sql = "SELECT prenom,nom,mail,pays FROM `utilisateur` WHERE user=:valUser";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":valUser", $user);
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
