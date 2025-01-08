<?php

require_once '../modele/Resultat.php';
require_once '../modele/Lieu.php';
require_once '../modele/MatchDeRugby.php';
require_once '../modele/Joueur.php';
require_once '../db/DAOJouerUnMatch.php';

class FeuilleDeMatch {

    //TODO : to check the logic of everything
    private int $idMatch;
    private array $joueurs;

    function __construct(int $matchDeRugby) {
        $this -> $idMatch = $matchDeRugby;
        $this -> joueurs = DAOJouerUnMatch::readAllByMatch(MatchDeRugby::getFromId($idMatch));
    }

    public function getIdMatch() : int {
        return $this -> idMatch;
    }

    public function addJoueur(JouerUnMatch $joueur): void {
        $this -> joueurs[$joueur->getJoueur()->getIdJoueur()] = $joueur;
    }

    public function removeJoueur(JouerUnMatch $joueur): void {
        unset($this -> joueurs[$joueur->getJoueur()->getIdJoueur()]);
    }

    public function getJoueurs() : array {
        return $this -> joueurs;
    }

}
