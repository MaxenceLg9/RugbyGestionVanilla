<?php
session_start();
if(empty($_SESSION['email'])){
    header('Location: login');
    die();
}

$css = ["style.css"];
$page = "../vue/results.php";
include_once "../components/page.php";