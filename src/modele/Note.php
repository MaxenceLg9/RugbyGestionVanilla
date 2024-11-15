<?php
    require '../modele/Statut.php';

    class Note {

        private Statut $statut;
        private string $commentaire;

        public function __construct(Statut $statut, string $commentaire) {
            $this -> statut = $statut;
            $this -> commentaire = $commentaire;
        }

        public function getStatut(): Statut {
            return $this -> statut;
        }

        public function getCommentaire(): string {
            return $this -> commentaire;
        }

        public function setStatut(Statut $statut): void {
            $this -> statut = $statut;
        }

        public function setCommentaire(string $commentaire): void {
            $this -> commentaire = $commentaire;
        }
        
    }
?>