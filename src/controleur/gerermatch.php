<?php

require '../modele/MatchDeRugby.php';
session_start();
if(!empty($_GET)){
    if (!isset($_GET['csrf_token']) || $_GET['csrf_token'] !== $_SESSION['csrf_token']) {
        die('CSRF validation failed.');
    }
    if(!isset($_GET["type"])){
        die("Type de requête non défini");
    }
    if($_GET["type"] == "ajout") {
        $css = ["style.css"];
        $page = '../vue/nouveaumatch.php';
        include_once '../components/page.php';
    }
    elseif ($_GET["type"] == "suppression") {

    }
    elseif ($_GET["type"] == "modification") {
        $css = ["style.css"];
        $page = '../vue/modifmatch.php';
        include_once '../components/page.php';
    }
}
elseif(!empty($_POST)){
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('CSRF validation failed.');
    }
    if(!isset($_POST["type"])){
        die("Type de requête non défini");
    }

    if($_POST["type"] == "ajout") {
        $dateHeure = new DateTime($_POST['datetime']);
        $match = new MatchDeRugby(0, $dateHeure, $_POST['adversaire'],  Lieu::from($_POST['lieu']));
        $match->saveMatchDeRugby();
        header('Location: matchs');
        die();
    }
    if (!isset($_POST['idMatch']) || !is_numeric($_POST['idMatch'])) {
        die('Invalid match ID.');
    }
    if ($_POST["type"] == "modification"){
        // Sanitize and validate the match ID
        $match = MatchDeRugby::getFromId($_POST['idMatch']);
        $match->setResultat($_POST['resultat']);
        $match->saveMatchDeRugby();
        header('Location: matchs');
        die();
    }
    elseif ($_POST["type"] == "suppression"){
        // Sanitize and validate the match ID
        $match = MatchDeRugby::getFromId($_POST['idMatch']);
        $match->deleteMatchDeRugby();
        header('Location: matchs');
        die();
    }
}