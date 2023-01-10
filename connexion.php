<?php
session_start();
$errors = array();

if (isset($_SESSION['compte'])) {
    header("Location: details_carte.php");
}

if (isset($_POST) && count($_POST) > 0) {

    if (!isset($_POST['login']) || !isset($_POST['pw'])) {
        $errors['fields'] = "Veuillez remplir tous les champs";
    }

    $user = htmlentities($_POST['login']);
    $pw = htmlentities($_POST['pw']);

    include_once("./php/rechercherCompteBD.php");

    $compte = rechercherCompte($user, $pw);
    if ($compte === null) {
        $errors['login'] = "Erreur lors de l'identification. Login ($user) et/ou mot de passe incorrects.";
    }

    if (empty($errors)) {
        $_SESSION['compte'] = $compte;
        header("Location: details_carte.php");
    }
}

include_once "views/connexion.html";

