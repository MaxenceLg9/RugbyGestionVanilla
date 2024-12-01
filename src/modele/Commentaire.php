<?php

    require '../modele/Joueur.php';

    class Commentaire {

        private int $idCommentaire;
        private string $commentaires;
        private Joueur $joueur;

        public function  __construct(int $idCommentaire, string $commentaires, Joueur $joueur) { 
            $this -> idCommentaire = $idCommentaire;
            $this -> commentaires = $commentaires;
            $this -> joueur = $joueur;
        }

        public function getIdCommentaire(): int {
            return $this -> idCommentaire;
        }

        public function getCommentaires(): string {
            return $this -> commentaires;
        }

        public function setCommentaires(string $commentaires): void {
            $this -> commentaires = $commentaires;
        }

        public function getJoueur(): Joueur {
            return $this -> joueur;
        }

    }
