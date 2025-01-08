<?php
session_start();
if(empty($_SESSION['email'])){
    header('Location: login');
    session_destroy();
    die();
}

require "../modele/Joueur.php";

$joueurs = Joueur::findAll();
$css = ["style.css","view.css"];
$page = "../vue/team.php";
include_once "../components/page.php";