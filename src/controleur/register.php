<?php
require_once "../db/DAOEntraineur.php";
if(DAOEntraineur::existEntraineur()) {
    header('Location: login');
    die();
}
if(isset($_POST["email"])){
    if($_POST["password"] != $_POST["confirmpassword"]){
        setcookie("register_error","passwords are not the same");
        header('Location: register');
        die();
    }
    $entraineur = new Entraineur(0,$_POST["name"],$_POST["firstname"],$_POST["email"]);
    $entraineur->inscriptionEntraineur($_POST["password"]);
    header('Location: login');
    die();
}else {
    include_once "../vue/register.php";
}