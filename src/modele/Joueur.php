<?php

    require 'Note.php';

    class Joueur {

        private $id;
        private $numeroLicense;
        private $nom;
        private $prenom;
        private $dateNaissance;
        private $taille;
        private $poids;
        private Statut $statut;

        public function  __construct(int $id, string $nom, string $prenom, string $dateNaissance, int $numeroLicense, int $taille, int $poids, Statut $statut) {
            $this -> id = $id;
            $this -> nom = $nom;
            $this -> prenom = $prenom;
            $this -> dateNaissance = $dateNaissance;
            $this -> numeroLicense = $numeroLicense;
            $this -> taille = $taille;
            $this -> poids = $poids;
            $this -> statut = $statut;
        }

        public function getId(): int {
            return $this -> id;
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

    }

?>