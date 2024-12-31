<?php
session_start();
if(empty($_SESSION['email'])){
    header('Location: login');
    die();
}

require_once "../modele/MatchDeRugby.php";

$matchs = MatchDeRugby::getAllMatchDeRugby();
$css = ["style.css","matchs.css"];
$page = "../vue/matchs.php";
include_once "../components/page.php";
