<?php
session_start();
$errors = array();

if (isset($_SESSION['compte'])) {
    header("Location: ./details_carte.php");
}

if (isset($_POST) && count($_POST) > 0) {

    if (!isset($_POST['login']) || !isset($_POST['prenom']) || !isset($_POST['nom']) || !isset($_POST['mail']) || !isset($_POST['age']) || !isset($_POST['pays_origine']) || !isset($_POST['pw'])) {
        $errors['fields'] = "Veuillez remplir tous les champs";
    }

    $user = htmlentities($_POST['login']);
    $prenom = htmlentities($_POST['prenom']);
    $nom = htmlentities($_POST['nom']);
    $mail = htmlentities($_POST['mail']);
    $age = htmlentities($_POST['age']);
    $pays = htmlentities($_POST['pays_origine']);
    $pw = htmlentities($_POST['pw']);

    include_once("php/afficherAmis.php");

    if(!empty(recupInfos($user))) {
        $errors['sign-in'] = "Erreur lors de la création du compte. Le nom d'utilisateur ($user) existe déjà.";
    }

    include_once("php/ajouterCompteBD.php");

    $compte = ajouterCompte($user, $prenom, $nom, $mail, $age, $pays, $pw);

    if (empty($errors)) {
        $_SESSION['compte'] = $compte;
        header("Location: details_carte.php");
    }
}

include_once "./views/creation_compte.html";