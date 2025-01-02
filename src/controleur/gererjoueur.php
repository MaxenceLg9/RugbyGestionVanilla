<?php

require '../modele/Joueur.php';
session_start();
if(!empty($_GET)){
    //TODO : faire le même hashage que pour les matchs
    if (!isset($_GET['csrf_token']) || !password_verify($_GET["idJoueur"].$_SESSION['csrf_token'].$_POST['type'],$_GET['csrf_token'])) {
        die('CSRF validation failed.');
    }
    if(!isset($_GET["type"])){
        die("Type de requête non défini");
    }
    $css = ["style.css","gererunjoueur.css"];
    if($_GET["type"] == "ajout") {
        $page =
        include_once
    }
    elseif ($_GET["type"] == "suppression") {

    }
    elseif ($_GET["type"] == "modification") {
        $page =
        include_once
    }
}
elseif(!empty($_POST)){
    //TODO : faire le même hashage que pour les matchs
    if (!isset($_POST['csrf_token']) || !password_verify($_POST["idJoueur"].$_SESSION['csrf_token'].$_POST['type'],$_POST['csrf_token'])) {
        die('CSRF validation failed.');
    }
    if(!isset($_POST["type"])){
        die("Type de requête non défini");
    }

    if($_POST["type"] == "ajout") {

        die();
    }
    if (!isset($_POST['idMatch']) || !is_numeric($_POST['idMatch'])) {
        die('Invalid match ID.');
    }
    if ($_POST["type"] == "modification"){

        header('Location: matchs');
        die();
    }
    elseif ($_POST["type"] == "suppression"){

        header('Location: matchs');
        die();
    }
}