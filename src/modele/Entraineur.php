<?php

    include '../db/DAOEntraineur.php';
    class Entraineur {
        private int $idEntraineur;
        private string $nom;
        private string $prenom;
        private string $numeroLogin;
        private string $motDePasse;

        public function  __construct(int $idEntraineur, string $nom, string $prenom, string $numeroLogin, string $motDePasse) {
            $this -> idEntraineur = $idEntraineur;
            $this -> nom = $nom;
            $this -> prenom = $prenom;
            $this -> numeroLogin = $numeroLogin;
            $this -> motDePasse = $motDePasse;
        }

        public function getIdEntraineur(): int {
            return $this -> idEntraineur;
        }

        public function getNom(): string {
            return $this -> nom;
        }

        public function getPrenom(): string {
            return $this -> prenom;
        }

        public function getNumeroLogin(): string {
            return $this -> numeroLogin;
        }

        public function getMotDePasse(): string {
            return $this -> motDePasse;
        }

        public function setMotDePasse(string $motDePasse): void {
            $this -> motDePasse = $motDePasse;
        }

        // partie DAO
        public function inscriptionEntraineur(): void {
            $daoEntraineur = new DAOEntraineur();
            $daoEntraineur -> create($this);
        }

        public function modifierMotDePasse(string $nouveauMotDePasse): void {
            $this -> setMotDePasse($nouveauMotDePasse);
            $daoEntraineur = new DAOEntraineur();
            $daoEntraineur -> update($this);
        }

    }
