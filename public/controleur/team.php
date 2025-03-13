<?php
session_start();
if(empty($_SESSION['email'])){
    header('Location: login');
    session_destroy();
    die();
}

$css = ["style.css"];
$page = "../vue/team.php";
include_once "../components/page.php";