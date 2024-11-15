<?php

    require '../modele/Note.php';

    class Joueur {

        private $id;
        private $nom;
        private $prenom;
        private $dateNaissance;
        private $numeroLicense;
        private $taille;
        private $poids;
        private Note $note;

        public function  __construct(int $id, string $nom, string $prenom, string $dateNaissance, int $numeroLicense, int $taille, int $poids, Note $note) {
            $this -> id = $id;
            $this -> nom = $nom;
            $this -> prenom = $prenom;
            $this -> dateNaissance = $dateNaissance;
            $this -> numeroLicense = $numeroLicense;
            $this -> taille = $taille;
            $this -> poids = $poids;
            $this -> note = $note;
        }

    }

?>