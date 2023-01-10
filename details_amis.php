<?php
session_start();


if (!isset($_SESSION) || !isset($_SESSION['compte'])) {
    header("Location: ./connexion.php");
    die();
};

$compte = $_SESSION['compte'];

include_once 'php/afficherAmis.php';
include_once 'php/getUsersList.php';
include_once 'php/ajouterAmi.php';

$amis=recupAmis($_SESSION['compte']["user"]);
$liste_user=getUsersList();

$liste_user = array_map(function ($val) {
    return $val["user"];
}, $liste_user);

$amis = array_map(function ($val) {
    return $val["ami2"];
}, $amis);

$list_non_friend = array();

foreach ($liste_user as $value) {
    if(!in_array($value, $amis)) $list_non_friend[] = $value;
}

include_once './views/details_amis.html';