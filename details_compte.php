<?php
session_start();

if (!isset($_SESSION) || !isset($_SESSION['compte'])) {
    header("Location: ./connexion.php");
    die();
};

$compte = $_SESSION['compte'];

include_once './views/details_compte.html';

