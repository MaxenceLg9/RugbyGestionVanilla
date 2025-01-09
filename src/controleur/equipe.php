<?php
session_start();
if(empty($_SESSION['email'])){
    header('Location: login');
    session_destroy();
    die();
}

require "../modele/Joueur.php";

$joueurs = Joueur::findAll();

$title = "Mon équipe";
$css = ["style.css","view.css"];
$page = "../vue/joueurs.php";
include_once "../components/page.php";