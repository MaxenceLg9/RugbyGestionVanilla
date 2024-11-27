<?php

    require '../modele/Statut.php';
    class Joueur {

        private $idJoueur;
        private $numeroLicense;
        private $nom;
        private $prenom;
        private $dateNaissance;
        private $taille;
        private $poids;
        private $statut;
        private $postePrefere;
        private $estPremiereLigne;

        public function  __construct(int $idJoueur, string $nom, string $prenom, 
                                     string $dateNaissance, int $numeroLicense, 
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

        public function getDateNaissance(): string {
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

    }
?>