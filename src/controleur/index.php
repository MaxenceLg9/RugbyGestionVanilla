<?php
require_once "../modele/Session.php";
checkSession();


$post['nom'] = $_SESSION['nom'];


$css = ["style.css"];
$page = '../vue/index.php';
include_once '../components/page.php';