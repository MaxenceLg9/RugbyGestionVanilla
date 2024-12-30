<?php
require_once "../db/DAOEntraineur.php";
if(!DAOEntraineur::existEntraineur()) {
    header('Location: http://rugbygestionplus.com/register');
//    die();
}
if(!empty($_POST) && isset($_POST["email"])){
    $entraineur = Entraineur::getEntraineur($_POST["email"],$_POST["password"]);
    if($entraineur == null){
        header('location : login');
        setcookie("error","invalid user");
        die();
    }
    session_start();
    $_SESSION["email"] = $entraineur->getEmail();
    $_SESSION["id"] = $entraineur->getIdEntraineur();
}
include "../vue/login.php";
