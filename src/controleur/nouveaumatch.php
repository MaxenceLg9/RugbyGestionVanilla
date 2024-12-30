<?php

require '../modele/MatchDeRugby.php';

if(isset($_POST)){
    $match = new MatchDeRugby(-1, $_POST['dateHeure'], $_POST['adversaire'], $_POST['lieu'], Resultat::GAGNE);
    $match->saveMatchDeRugby();
}
include '../vue/nouveaumatch.php';