<?php
    class Entraineur {
        private $idEntraineur;
        private $nom;
        private $prenom;
        private $email;
        private $motDePasse;

        public function  __construct(int $idEntraineur, string $nom, string $prenom, string $email, string $motDePasse) { 
            $this -> idEntraineur = $idEntraineur;
            $this -> nom = $nom;
            $this -> prenom = $prenom;
            $this -> email = $email;
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

        public function getEmail(): string {
            return $this -> email;
        }

        public function getMotDePasse(): string {
            return $this -> motDePasse;
        }
    }
?>