<?php
session_start();

if (!isset($_SESSION) || !isset($_SESSION['compte'])) {
    header("Location: ./connexion.php");
    die();
};

include_once "php/recupererEtablissement.php";
include_once "php/ajoutEtablissement.php";

$etabList = recupEtab($_SESSION['compte']["user"]);


include_once "./views/details_carte.html";