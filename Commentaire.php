<?php
    class Commentaire {

        private int $id;
        private string $commentaire;

        public function __construct(int $id, string $commentaire) {
            $this -> id = $id;
            $this -> commentaire = $commentaire;
        }

        public function getId(): int {
            return $this -> id;
        }

        public function getCommentaire(): string {
            return $this -> commentaire;
        }

        public function setCommentaire(string $commentaire): void {
            $this -> commentaire = $commentaire;
        }
        
    }
?>