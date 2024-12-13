<?php

require '../modele/Statut.php';
include '../db/DAOJoueur.php';
    class Joueur {

        private int $idJoueur;
        private int $numeroLicense;
        private string $nom;
        private string $prenom;
        private DateTime $dateNaissance;
        private int $taille;
        private int $poids;
        private Statut $statut;
        private string $postePrefere;
        private bool $estPremiereLigne;

        public function  __construct(int $idJoueur, string $nom, string $prenom, 
                                     DateTime $dateNaissance, int $numeroLicense,
                                     int $taille, int $poids, Statut $statut, 
                                     string $postePrefere, bool $estPremiereLigne) { 
            $this -> idJoueur = $idJoueur;
            $this -> nom = $nom;
            $this -> prenom = $prenom;
            $this -> dateNaissance = $dateNaissance;
            $this -> numeroLicense = $numeroLicense;
            $this -> taille = $taille;
            $this -> poids = $poids;
            $this -> statut = $statut;
            $this -> postePrefere = $postePrefere;
            $this -> estPremiereLigne = $estPremiereLigne;
        }

        public function getIdJoueur(): int {
            return $this -> idJoueur;
        }

        public function getNom(): string {
            return $this -> nom;
        }

        public function setNom(string $nom): void {
            $this -> nom = $nom;
        }

        public function getPrenom(): string {
            return $this -> prenom;
        }

        public function setPrenom(string $prenom): void {
            $this -> prenom = $prenom;
        }

        public function getDateNaissance(): DateTime {
            return $this -> dateNaissance;
        }

        public function getNumeroLicense(): String {
            return $this -> numeroLicense;
        }

        public function getTaille(): int {
            return $this -> taille;
        }

        public function setTaille(int $taille): void {
            $this -> taille = $taille;
        }

        public function getPoids(): int {
            return $this -> poids;
        }

        public function setPoids(int $poids): void {
            $this -> poids = $poids;
        }

        public function getStatut(): Statut {
            return $this -> statut;
        }

        public function setStatut(Statut $statut): void {
            $this -> statut = $statut;
        }

        public function getPostePrefere(): string {
            return $this -> postePrefere;
        }

        public function setPostePrefere(string $postePrefere): void {
            $this -> postePrefere = $postePrefere;
        }

        public function getEstPremiereLigne(): bool {
            return $this -> estPremiereLigne;
        }

        public function setEstPremiereLigne(bool $estPremiereLigne): void {
            $this -> estPremiereLigne = $estPremiereLigne;
        }

        // partie DAO : utiliser les méthodes de DAOJoueur pour accéder à la base de données
        public function getJoueurByNumeroLicense(): Joueur {
            $daoJoueur = new DAOJoueur();
            return $daoJoueur -> readByNumeroLicense($this -> getNumeroLicense());
        }

        public static function getAllJoueurs(): array {
            $daoJoueur = new DAOJoueur();
            return $daoJoueur -> read();
        }

        public function saveJoueur(): void {
            $daoJoueur = new DAOJoueur();
            if ($daoJoueur -> readByNumeroLicense($this -> getNumeroLicense()) === null) {
                $daoJoueur -> create($this);
            }
            $daoJoueur->update($this);
        }

        public function deleteJoueur(): void {
            $daoJoueur = new DAOJoueur();
            $daoJoueur -> delete($this);
        }

    }
