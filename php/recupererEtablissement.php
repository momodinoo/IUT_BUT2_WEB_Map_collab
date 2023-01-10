<?php
require_once "connexionBD.php";

function recupEtabParBdd($arrayValue) {
    return $arrayValue["id_etab"];
}

function recupEtab($user)
{
    try {
        $pdo = seConnecterBD();
        $sql = "SELECT * FROM `visite` WHERE user=:valUser";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":valUser", $user);
        $bool = $stmt->execute();
        $resultats = [];
        if ($bool) {
            $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $resultats = array_map("recupEtabParBdd", $resultats);

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