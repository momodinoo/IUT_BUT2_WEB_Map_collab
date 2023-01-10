<?php
require_once "connexionBD.php";
function ajouterAmi($user,$ami2) {
    try {
        $pdo = seConnecterBD();
        $sql="INSERT INTO `amis` VALUES (:valAmi1,:valAmi2);INSERT INTO `amis` VALUES (:valAmi2,:valAmi1)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":valAmi1", $user);
        $stmt->bindParam(":valAmi2", $ami2);
        $bool = $stmt->execute();
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

    if(!isset($_POST['ami'])) return;

    ajouterAmi($_SESSION['compte']['user'], htmlentities($_POST['ami']));
    echo "Success";

}