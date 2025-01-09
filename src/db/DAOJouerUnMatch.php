<?php

require_once '../db/Connexion.php';
require_once '../modele/JouerUnMatch.php';
require_once '../modele/MatchDeRugby.php';
require_once '../modele/Joueur.php';

class DAOJouerUnMatch {

    public static function create(JouerUnMatch $jouer): void {
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $requete = $connexion -> prepare(
                "INSERT INTO Participer (idMatch, idJoueur, estTitulaire, poste, note, archive) 
             VALUES (:idMatch, :idJoueur, :estTitulaire, :poste, :note, :archive)");


            $estTitulaire = $jouer -> isTitulaire();
            $poste = $jouer -> getPoste();
            $note = $jouer -> getNote();
            $idMatch = $jouer -> getIdMatch();
            $archive = $jouer->isArchive();

            $requete->bindParam(':estTitulaire', $estTitulaire);
            $requete->bindParam(':poste', $poste);
            $requete->bindParam(':note', $note);
            $requete->bindParam(':idMatch', $idMatch);
            $requete->bindParam(':archive', $archive);

            $requete -> execute();
            echo "Feuille de match créée avec succès !";
        } catch (PDOException $e) {
            echo "Erreur : " . $e -> getMessage();
        }
    }

    public static function existJoueur(JouerUnMatch $jouer): bool {
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $requete = $connexion->prepare(
                "SELECT * FROM Participer WHERE idMatch = :idMatch AND idJoueur = :idJoueur"
            );

            // Get the necessary values from the $jouer object
            $idMatch = $jouer->getIdMatch();
            $idJoueur = $jouer->getJoueur()->getIdJoueur();

            // Bind parameters
            $requete->bindParam(':idMatch', $idMatch, PDO::PARAM_INT);
            $requete->bindParam(':idJoueur', $idJoueur, PDO::PARAM_INT);

            // Execute query
            $requete->execute();

            // Fetch the result
            $row = $requete->fetch(PDO::FETCH_ASSOC);

            // Return true if a row exists, false otherwise
            return $row !== false;

        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false; // Default to false in case of an exception
        }
    }

    public static function readAll(): array {
        $listJouer = array();
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $requete = $connexion -> prepare("SELECT * FROM Participer");
            $requete -> execute();
            $rows = $requete -> fetchAll();

            foreach ($rows as $row) {
                $listJouer[] = new JouerUnMatch($row["idMatch"],Joueur::getById($row["idJoueur"]), $row["estTitulaire"], $row["poste"], $row["note"], $row["archive"]);
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e -> getMessage();
        }
        return $listJouer;
    }

    public static function update(JouerUnMatch $jouer): void {
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $requete = $connexion -> prepare(
                "UPDATE Participer SET estTitulaire = :estTitulaire, poste = :poste, note = :note 
             WHERE idMatch = :idMatch AND idJoueur = :idJoueur");

            $estTitulaire = $jouer -> isTitulaire();
            $poste = $jouer -> getPoste();
            $note = $jouer -> getNote();
            $idJoueur = $jouer -> getJoueur() -> getIdJoueur();
            $idMatch = $jouer -> getIdMatch();

            $requete->bindParam(':estTitulaire', $estTitulaire);
            $requete->bindParam(':poste', $poste);
            $requete->bindParam(':note', $note);
            $requete->bindParam(':idMatch', $idMatch);
            $requete->bindParam(':idJoueur', $idJoueur);

            $requete -> execute();
            echo "Feuille de match mise à jour avec succès !";
        } catch (PDOException $e) {
            echo "Erreur : " . $e -> getMessage();
        }
    }

    public static function delete(JouerUnMatch $jouer): void {
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $requete = $connexion -> prepare(
                "DELETE FROM Participer WHERE idMatch = :idMatch AND idJoueur = :idJoueur");

            $idJoueur = $jouer -> getJoueur()->getIdJoueur();
            $idMatch = $jouer -> getIdMatch();
            $requete -> bindParam(':idMatch', $idMatch);
            $requete -> bindParam(':idJoueur', $idJoueur);

            $requete -> execute();
            echo "Feuille de match supprimée avec succès !";
        } catch (PDOException $e) {
            echo "Erreur : " . $e -> getMessage();
        }
    }

    public static function readAllByMatch(int  $idMatch): array {
        $listJouer = array();
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $requete = $connexion -> prepare(
                "SELECT * FROM Participer WHERE idMatch = :idMatch");

            $requete -> bindParam(':idMatch', $idMatch);

            $requete -> execute();
            $rows = $requete -> fetchAll();

            foreach ($rows as $row) {
                $listJouer[] = new JouerUnMatch($idMatch,Joueur::getById($row["idJoueur"]), $row["estTitulaire"], $row["poste"], $row["note"], $row["archive"]);
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e -> getMessage();
        }
        return $listJouer;
    }

    public static function readAllByJoueur(Joueur $joueur): array {
        $listJouers = array();
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $requete = $connexion -> prepare(
                "SELECT * FROM Participer WHERE idJoueur = :idJoueur");

            $idJoueur = $joueur -> getIdJoueur();
            $requete -> bindParam(':idJoueur', $idJoueur);

            $requete -> execute();
            $rows = $requete -> fetchAll();

            foreach ($rows as $row) {
                $listJouers[] = new JouerUnMatch($row['idMatch'], $joueur,$row['estTitulaire'], $row['poste'], $row['note'], $row["archive"]);
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e -> getMessage();
        }
        return $listJouers;
    }

}