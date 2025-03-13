<?php

require_once '../modele/Joueur.php';
require_once '../modele/MatchDeRugby.php';

class InsererDonnees {

    private array $donneesJoueurs;
    private array $donneesMatchesDeRugby;

    private function __construct() {
        $this->donneesJoueurs = [
            new Joueur((int)null, 'Doe', 'John', new DateTime('1990-01-01'), 1234, 180, 80, Statut::ACTIF , 'Pilier', true),
            new Joueur((int)null, 'Doe', 'Jane', new DateTime('1995-01-01'), 5678, 170, 85, Statut::ACTIF, 'Centre', true),
            new Joueur((int)null, 'Doe', 'Alice', new DateTime('2000-01-01'), 9012, 160, 90, Statut::ACTIF, 'Ailier', false),
            new Joueur((int)null, 'Doe', 'Bob', new DateTime('2005-01-01'), 3456, 150, 75, Statut::ACTIF, 'Troisieme ligne', false)
        ];
        $this->donneesMatchesDeRugby = [
            new MatchDeRugby((int)null, new DateTime('2021-01-01 12:00:00'), 'Toulon', Lieu::DOMICILE, Resultat::GAGNE),
            new MatchDeRugby((int)null, new DateTime('2021-01-08 12:00:00'), 'Lyon', Lieu::EXTERIEUR, Resultat::PERDU),
            new MatchDeRugby((int)null, new DateTime('2021-01-15 12:00:00'), 'Clermont', Lieu::DOMICILE, Resultat::NUL),
            new MatchDeRugby((int)null, new DateTime('2021-01-22 12:00:00'), 'Montpellier', Lieu::EXTERIEUR, Resultat::NUL)
        ];
    }

    public static function insererDonnees(): void {
        $instance = new self();

        foreach ($instance->donneesJoueurs as $joueur) {
            $joueur->saveJoueur();
        }

        foreach ($instance->donneesMatchesDeRugby as $match) {
            $match->saveMatchDeRugby();
        }
    }

    public static function supprimerDonnees(): void {
        $instance = new self();

        foreach ($instance->donneesJoueurs as $joueur) {
            $joueur->deleteJoueur();
        }

        foreach ($instance->donneesMatchesDeRugby as $match) {
            $match->deleteMatchDeRugby();
        }
    }

}

InsererDonnees::supprimerDonnees();
InsererDonnees::insererDonnees();