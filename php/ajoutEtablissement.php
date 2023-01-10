<?php
require_once "connexionBD.php";

function ajoutEtab($user,$idEtab) {
    try {
        $pdo = seConnecterBD();
        $sql="INSERT INTO visite VALUES (:valUser,:valIdEtab)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":valUser", $user);
        $stmt->bindParam(":valIdEtab", $idEtab);
        $bool = $stmt->execute();
        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
    }
    catch (PDOException $e) {
        // Erreur à l'exécution de la requête
        $erreur = $e->getMessage();
        echo utf8_encode("Erreur d'accès à la base de données : $erreur \n");
        return null;
    }
}


if(isset($_POST) && !empty($_POST)) {

    if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if(!isset($_SESSION) && !isset($_SESSION['compte'])) return;

    if(!isset($_POST['idEtab'])) return;

    ajoutEtab($_SESSION['compte']['user'], htmlentities($_POST['idEtab']));
    echo "Success";
}