<?php

    require 'Resultat.php';
    require 'Lieu.php';

    class MatchDeRugby {

        private int $idMatchDeRugby;
        private DateTime $dateHeure;
        private string $adversaire;
        private Lieu $lieu;
        private Resultat $resultat;

        function __construct(DateTime $dateHeure, string $adversaire, Lieu $lieu, Resultat $resultat) {
            $this -> dateHeure = $dateHeure;
            $this -> adversaire = $adversaire;
            $this -> lieu = $lieu;
            $this -> resultat = $resultat;
        }

        public function getIdMatchDeRugby(): int {
            return $this -> idMatchDeRugby;
        }

        public function getDateHeure(): DateTime {
            return $this -> dateHeure;
        }

        public function getAdversaire(): string {
            return $this -> adversaire;
        }

        public function getLieu(): Lieu {
            return $this -> lieu;
        }

        public function getResultat(): Resultat {
            return $this -> resultat;
        }

    }

?>