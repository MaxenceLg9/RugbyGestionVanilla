<?php

require_once 'Connexion.php';
require_once '../modele/MatchDeRugby.php';
class DAOMatchDeRugby {

    public function create(MatchDeRugby $match): void {
        $connexion = Connexion::getInstance()->getConnection();
        $statement = $connexion->prepare(
            "INSERT INTO MatchDeRugby (dateHeure, adversaire, lieu, resultat) 
                   VALUES (:dateHeure, :adversaire, :lieu, :resultat)");

        $dateHeure = $match->getDateHeure();
        $adversaire = $match->getAdversaire();
        $lieu = $match->getLieu();
        $resultat = $match->getResultat();

        $statement->bindParam(':dateHeure', $dateHeure);
        $statement->bindParam(':adversaire', $adversaire);
        $statement->bindParam(':lieu', $lieu);
        $statement->bindParam(':resultat', $resultat);

        $statement->execute();
        echo "Match créé avec succès";
    }

    public function read(): array {
        $connexion = Connexion::getInstance()->getConnection();
        $statement = $connexion->prepare("SELECT * FROM MatchDeRugby");
        $statement->execute();
        $matches = [];
        while ($row = $statement->fetch()) {
            $matches[] = new MatchDeRugby($row['idMatchDeRugby'], $row['dateHeure'], $row['adversaire'],
                                    $row['lieu'], $row['resultat']);
        }
        return $matches;
    }

    public function readById(int $idMatchDeRugby): MatchDeRugby {
        $connexion = Connexion::getInstance()->getConnection();
        $statement = $connexion->prepare("SELECT * FROM MatchDeRugby WHERE idMatchDeRugby = :idMatchDeRugby");
        $statement->bindParam(':idMatchDeRugby', $idMatchDeRugby);
        $statement->execute();
        $row = $statement->fetch();
        return new MatchDeRugby($row['idMatchDeRugby'], $row['dateHeure'], $row['adversaire'],
                                $row['lieu'], $row['resultat']);
    }

    public function update(MatchDeRugby $match): void {
        $connexion = Connexion::getInstance()->getConnection();
        $statement = $connexion->prepare("UPDATE MatchDeRugby SET resultat = :resultat WHERE idMatchDeRugby = :idMatchDeRugby");

        $idMatchDeRugby = $match->getIdMatchDeRugby();
        $resultat = $match->getResultat();

        $statement->bindParam(':idMatchDeRugby', $idMatchDeRugby);
        $statement->bindParam(':resultat', $resultat);

        $statement->execute();
        echo "Match mis à jour avec succès";
    }

    public function delete(MatchDeRugby $matchDeRugby): void {
        $connexion = Connexion::getInstance()->getConnection();
        $statement = $connexion->prepare("DELETE FROM MatchDeRugby WHERE idMatchDeRugby = :idMatchDeRugby");
        $idMatchDeRugby = $matchDeRugby->getIdMatchDeRugby();
        $statement->bindParam(':idMatchDeRugby', $idMatchDeRugby);
        $statement->execute();
        echo "Match supprimé avec succès";
    }

}