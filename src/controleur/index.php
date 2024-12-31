<?php
session_start();
if(empty($_SESSION['email'])){
    header('Location: login');
    die();
}
$post['nom'] = $_SESSION['nom'];


$css = ["style.css"];
$page = '../vue/index.php';
include_once '../components/page.php';