<?php

    require '../modele/Resultat.php';
    require '../modele/Lieu.php';
    require '../modele/MatchDeRugby.php';
    require '../modele/Joueur.php';

    class FeuilleDeMatch {

        private MatchDeRugby $matchDeRugby;
        private Joueur $joueur;
        private bool $estTitulaire;
        private string $poste;
        private float $note;

        function __construct(MatchDeRugby $matchDeRugby, Joueur $joueur, bool $estTitulaire, string $poste, float $note) {
            $this -> matchDeRugby = $matchDeRugby;
            $this -> joueur = $joueur;
            $this -> estTitulaire = $estTitulaire;
            $this -> poste = $poste;
            $this -> note = $note;
        }

        public function getMatchDeRugby() : MatchDeRugby {
            return $this -> matchDeRugby;
        }

        public function getJoueur() : Joueur {
            return $this -> joueur;
        }

        public function estJoueurTitulaire() : bool {
            return $this -> estTitulaire;
        }

        public function getPoste() : string {
            return $this -> poste;
        }

        public function setPoste(string $poste): void
        {
            $this -> poste = $poste;
        }

        public function setEstTitulaire(bool $estTitulaire): void
        {
            $this -> estTitulaire = $estTitulaire;
        }

        public function getNote() : float {
            return $this -> note;
        }

        public function setNote(float $note): void
        {
            $this -> note = $note;
        }

    }
