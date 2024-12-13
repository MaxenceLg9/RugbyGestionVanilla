<?php

    require '../modele/Resultat.php';
    require '../modele/Lieu.php';
    require '../modele/MatchDeRugby.php';
    require '../modele/Joueur.php';
    include '../db/DAOFeuilleDeMatch.php';

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

        public function setNote(float $note): void {
            $this -> note = $note;
        }

        // partie DAO
        public function saveFeuilleDeMatch(): void {
            $daoFeuilleDeMatch = new DAOFeuilleDeMatch();
            if ($daoFeuilleDeMatch -> read($this -> matchDeRugby, $this -> joueur) != null) {
                $daoFeuilleDeMatch -> update($this);
            }
            $daoFeuilleDeMatch -> create($this);
        }

        public function deleteFeuilleDeMatch(): void {
            $daoFeuilleDeMatch = new DAOFeuilleDeMatch();
            if ($daoFeuilleDeMatch -> read($this -> matchDeRugby, $this -> joueur) != null) {
                $daoFeuilleDeMatch->delete($this);
            }
        }

        public function getAllFeuilleDeMatchByMatch(): array {
            $daoFeuilleDeMatch = new DAOFeuilleDeMatch();
            return $daoFeuilleDeMatch -> readAllByMatch($this->getMatchDeRugby());
        }

        public function getAllFeuilleDeMatchByJoueur(): array {
            $daoFeuilleDeMatch = new DAOFeuilleDeMatch();
            return $daoFeuilleDeMatch -> readAllByJoueur($this->getJoueur());
        }

        public static function getAllFeuilleDeMatch(): array {
            $daoFeuilleDeMatch = new DAOFeuilleDeMatch();
            return $daoFeuilleDeMatch -> readAll();
        }

    }
