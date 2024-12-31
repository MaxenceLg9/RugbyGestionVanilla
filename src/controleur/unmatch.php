<?php

require '../modele/MatchDeRugby.php';

if(isset($_POST)){
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('CSRF validation failed.');
    }
    if($_POST["type"] == "ajout") {
        $match = new MatchDeRugby(-1, $_POST['dateHeure'], $_POST['adversaire'], $_POST['lieu']);
        $match->saveMatchDeRugby();
    }
    elseif ($_POST["type"] == "suppression") {
        // Sanitize and validate the match ID
        if (!isset($_POST['idMatch']) || !is_numeric($_POST['idMatch'])) {
            die('Invalid match ID.');
        }
        $match = MatchDeRugby::getFromId($_POST['idMatch']);
        $match->deleteMatchDeRugby();
    }
}
include '../vue/nouveaumatch.php';