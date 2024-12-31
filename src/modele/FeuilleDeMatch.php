<?php

    require '../modele/Resultat.php';
    require '../modele/Lieu.php';
    require '../modele/MatchDeRugby.php';
    require '../modele/Joueur.php';
    include '../db/DAOFeuilleDeMatch.php';

    class FeuilleDeMatch {

        private int $idMatchDeRugby;
        private int $idJoueur;
        private bool $estTitulaire;
        private string $poste;
        private float $note;

        function __construct(int $matchDeRugby, int $joueur, bool $estTitulaire, string $poste, float $note) {
            $this -> idMatchDeRugby = $matchDeRugby;
            $this -> idJoueur = $joueur;
            $this -> estTitulaire = $estTitulaire;
            $this -> poste = $poste;
            $this -> note = $note;
        }

        public function getIdMatchDeRugby() : int {
            return $this -> idMatchDeRugby;
        }

        public function getIdJoueur() : int {
            return $this -> idJoueur;
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
            if ($daoFeuilleDeMatch -> read($this -> idMatchDeRugby, $this -> idJoueur) != null) {
                $daoFeuilleDeMatch -> update($this);
            }
            $daoFeuilleDeMatch -> create($this);
        }

        public function deleteFeuilleDeMatch(): void {
            $daoFeuilleDeMatch = new DAOFeuilleDeMatch();
            if ($daoFeuilleDeMatch -> read($this -> idMatchDeRugby, $this -> idJoueur) != null) {
                $daoFeuilleDeMatch->delete($this);
            }
        }

        public function getAllFeuilleDeMatchByMatch(): array {
            $daoFeuilleDeMatch = new DAOFeuilleDeMatch();
            return $daoFeuilleDeMatch -> readAllByMatch($this->getIdMatchDeRugby());
        }

        public function getAllFeuilleDeMatchByJoueur(): array {
            $daoFeuilleDeMatch = new DAOFeuilleDeMatch();
            return $daoFeuilleDeMatch -> readAllByJoueur($this->getIdJoueur());
        }

        public static function getAllFeuilleDeMatch(): array {
            $daoFeuilleDeMatch = new DAOFeuilleDeMatch();
            return $daoFeuilleDeMatch -> readAll();
        }

    }
