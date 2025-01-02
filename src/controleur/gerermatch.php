<?php

require '../modele/MatchDeRugby.php';
session_start();
if(!empty($_GET)){
    if (!isset($_GET['csrf_token']) || !password_verify($_GET["idMatch"].$_SESSION['csrf_token'].$_GET['type'],$_GET['csrf_token'])) {
        header('Location: matchs.php');
        die('CSRF validation failed.');
    }
    if(!isset($_GET["type"])){
        die("Type de requête non défini");
    }
    $css = ["style.css","gererunmatch.css"];
    if($_GET["type"] == "ajout") {
        $page = '../vue/nouveaumatch.php';
        include_once '../components/page.php';
    }
    elseif ($_GET["type"] == "suppression") {

    }
    elseif ($_GET["type"] == "modification") {
        $page = '../vue/modifmatch.php';
        $match = MatchDeRugby::getFromId($_GET['idMatch']);
        include_once '../components/page.php';
    }
}
elseif(!empty($_POST)){
    echo $_POST["idMatch"];
    if (!isset($_POST['csrf_token']) || !password_verify($_POST["idMatch"].$_SESSION['csrf_token'].$_POST['type'],$_POST['csrf_token'])) {
        header('Location: matchs.php');
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