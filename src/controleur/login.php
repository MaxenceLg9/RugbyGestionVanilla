<?php
require_once "../db/DAOEntraineur.php";
if(!DAOEntraineur::existEntraineur()) {
    header('Location: register');
    die();
}
if(!empty($_POST) && isset($_POST["email"])){
    $entraineur = Entraineur::getEntraineur($_POST["email"],$_POST["password"]);
    if($entraineur == null){
        echo "test";
        die();
        header('Location : login');
        setcookie("login_error","Les informations d'authentifications sont erronnées");
        die();
    }
    session_start();
    $_SESSION["email"] = $entraineur->getEmail();
    $_SESSION["nom"] = $entraineur->getNom();
    $_SESSION["id"] = $entraineur->getIdEntraineur();
    $_SESSION['csrf_token'] = bin2hex(openssl_random_pseudo_bytes(32));
    $_SESSION["equipe"] = $entraineur->getEquipe();
    header('Location: /');
}
$css = ["login.css"];
$page = "../vue/login.php";
include_once "../components/page.php";
