<?php

require_once 'Connexion.php';
require_once '../modele/MatchDeRugby.php';
class DAOMatchDeRugby {

    public function create(MatchDeRugby $match): void {
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare(
                "INSERT INTO MatchDeRugby (dateHeure, adversaire, lieu) 
                   VALUES (:dateHeure, :adversaire, :lieu)");

            $dateHeure = $match->getDateHeure()->format('Y-m-d H:i:s');
            $adversaire = $match->getAdversaire();
            $lieu = $match->getLieu()->name;

            $statement->bindParam(':dateHeure', $dateHeure);
            $statement->bindParam(':adversaire', $adversaire);
            $statement->bindParam(':lieu', $lieu);

            $statement->execute();
            echo "Match créé avec succès\n";
        } catch (PDOException $e) {
            echo "Erreur lors de la création du match: " . $e->getMessage();
        }
    }

    public static function read(): array {
        $matches = [];
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare("SELECT * FROM MatchDeRugby");
            $statement->execute();
            while ($row = $statement->fetch()) {
                $matches[] = new MatchDeRugby($row['idMatchDeRugby'], new DateTime($row['dateHeure']), $row['adversaire'],
                    Lieu::from($row['lieu']));
            }
        } catch (Exception $e) {
            echo "Erreur lors de la lecture des matches: " . $e->getMessage();
        }
        return $matches;
    }

    public static function readById(int $idMatchDeRugby): ?MatchDeRugby {
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare("SELECT * FROM MatchDeRugby WHERE idMatchDeRugby = :idMatchDeRugby");
            $statement->bindParam(':idMatchDeRugby', $idMatchDeRugby);
            $statement->execute();
            $row = $statement->fetch();
            if ($row) {
                return new MatchDeRugby($row['idMatchDeRugby'], new DateTime($row['dateHeure']), $row['adversaire'],
                    Lieu::from((string) $row['lieu']));
            }
        } catch (Exception $e) {
            echo "Erreur lors de la lecture du match: " . $e->getMessage();
        }
        return null;
    }

    public function readByDateHeure(DateTime $dateHeure): ?MatchDeRugby {
        $match = null;
        $dateHeure = $dateHeure->format('Y-m-d H:i:s');
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare("SELECT * FROM MatchDeRugby WHERE dateHeure = :dateHeure");
            $statement->bindParam(':dateHeure', $dateHeure);
            $statement->execute();
            $row = $statement->fetch();
            if ($row) {
                $match = new MatchDeRugby($row['idMatchDeRugby'], new DateTime($row['dateHeure']), $row['adversaire'],
                    Lieu::from((string) $row['lieu']));
            }
        } catch (Exception $e) {
            echo "Erreur lors de la lecture du match: " . $e->getMessage();
        }
        return $match;
    }

    public function update(MatchDeRugby $match): void {
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare("UPDATE MatchDeRugby SET resultat = :resultat WHERE idMatchDeRugby = :idMatchDeRugby");

            $idMatchDeRugby = $match->getIdMatchDeRugby();
            $resultat = "0";
            if($match->getResultat() != null){
                $resultat = $match->getResultat()->name;
            }


            $statement->bindParam(':idMatchDeRugby', $idMatchDeRugby);
            $statement->bindParam(':resultat', $resultat);

            $statement->execute();
            echo "Match mis à jour avec succès\n";
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour du match: " . $e->getMessage();
        }
    }

    public function delete(MatchDeRugby $matchDeRugby): void {
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare("DELETE FROM MatchDeRugby WHERE dateHeure = :dateHeure");
            $dateHeure = $matchDeRugby->getDateHeure()->format('Y-m-d H:i:s');
            $statement->bindParam(':dateHeure', $dateHeure);
            $statement->execute();
            echo "Match supprimé avec succès\n";
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression du match: " . $e->getMessage();
        }
    }

}