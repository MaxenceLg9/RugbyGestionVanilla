<?php
require_once "../modele/Session.php";
checkSession();

require_once "../modele/MatchDeRugby.php";
require_once "../modele/Joueur.php";

$matchs = MatchDeRugby::getMatchDeRugbyWithResultat();

// Calcul des statistiques globales
$totalMatchs = count($matchs);
$gagnes = $perdus = $nuls = 0;

foreach ($matchs as $match) {
    switch ($match->getResultat()->name) {
        case 'VICTOIRE':
            $gagnes++;
            break;
        case 'DEFAITE':
            $perdus++;
            break;
        case 'NUL':
            $nuls++;
            break;
    }
}

$pourcentageGagnes = $totalMatchs ? ($gagnes / $totalMatchs * 100) : 0;
$pourcentagePerdus = $totalMatchs ? ($perdus / $totalMatchs * 100) : 0;
$pourcentageNuls = $totalMatchs ? ($nuls / $totalMatchs * 100) : 0;

$joueurs = Joueur::getAllJoueursWithStats();

$title = "Resultats & Statistiques";
$css = ["style.css","view.css"];
$page = "../vue/results.php";
include_once "../components/page.php";