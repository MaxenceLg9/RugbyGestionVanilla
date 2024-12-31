<?php
//session_start();
//if(empty($_SESSION['email'])){
//    header('Location: login.php');
//    die();
//}
$post['nom'] = 'Jean';

require '../modele/Urls.php';

include '../vue/index.php';