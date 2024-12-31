<?php
session_start();
if(empty($_SESSION['email'])){
    header('Location: login');
    die();
}
$post['nom'] = $_SESSION['nom'];

require_once '../modele/Urls.php';

include_once '../vue/index.php';