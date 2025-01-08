<?php
require_once "../modele/Session.php";
checkSession();

$css = ["style.css"];
$page = "../vue/results.php";
include_once "../components/page.php";