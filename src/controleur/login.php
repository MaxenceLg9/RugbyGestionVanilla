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
    header('Location: /');
}
include "../vue/login.php";
