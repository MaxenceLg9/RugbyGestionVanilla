<?php

require_once "../modele/Session.php";
checkSession();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header("Location: gerermatch.php?type=vue&idMatch=".$_POST["idMatch"]."&csrf_token=".$_POST["csrf_token"]);
}
