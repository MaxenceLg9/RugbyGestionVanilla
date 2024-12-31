<?php

    require '../modele/Resultat.php';
    require '../modele/Lieu.php';
    include '../db/DAOMatchDeRugby.php';

    class MatchDeRugby {

        private ?int $idMatchDeRugby;
        private DateTime $dateHeure;
        private string $adversaire;
        private Lieu $lieu;
        private ?Resultat $resultat;

        function __construct(int $idMatchDeRugby, DateTime $dateHeure, string $adversaire, Lieu $lieu) {
            $this -> idMatchDeRugby = $idMatchDeRugby;
            $this -> dateHeure = $dateHeure;
            $this -> adversaire = $adversaire;
            $this -> lieu = $lieu;
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

        public function setResultat(Resultat $resultat): void {
            $this -> resultat = $resultat;
        }

        // partie DAO : utilisation des méthodes de la classe DAOMatchDeRugby
        public function saveMatchDeRugby(): void {
            $daoMatchDeRugby = new DAOMatchDeRugby();
            if ($daoMatchDeRugby -> readByDateHeure($this -> dateHeure) === null) {
                $daoMatchDeRugby -> create($this);
            }
            $daoMatchDeRugby -> update($this);
        }

        public static function getAllMatchDeRugby(): array {
            return DAOMatchDeRugby::read();
        }

        public function getMatchDeRugbyByDateHeure(): MatchDeRugby {
            $daoMatchDeRugby = new DAOMatchDeRugby();
            return $daoMatchDeRugby -> readByDateHeure($this -> dateHeure);
        }

        public function deleteMatchDeRugby(): void {
            $daoMatchDeRugby = new DAOMatchDeRugby();
            $daoMatchDeRugby -> delete($this);
        }

    }
