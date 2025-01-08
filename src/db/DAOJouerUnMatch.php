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
                "INSERT INTO Participer (idMatchDeRugby, idJoueur, estTitulaire, poste, note) 
             VALUES (:idMatchDeRugby, :idJoueur, :estTitulaire, :poste, :note)");


            $estTitulaire = $jouer -> isTitulaire();
            $poste = $jouer -> getPoste();
            $note = $jouer -> getNote();
            $idMatch = $jouer -> getIdMatch();

            $requete->bindParam(':estTitulaire', $estTitulaire);
            $requete->bindParam(':poste', $poste);
            $requete->bindParam(':note', $note);
            $requete->bindParam(':idMatchDeRugby', $idMatch);

            $requete -> execute();
            echo "Feuille de match créée avec succès !";
        } catch (PDOException $e) {
            echo "Erreur : " . $e -> getMessage();
        }
    }

    public static function read(int $idMatch, Joueur $joueur) : ?JouerUnMatch {
        $Participer = null;
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $requete = $connexion -> prepare(
                "SELECT * FROM Participer WHERE idMatchDeRugby = :idMatchDeRugby AND idJoueur = :idJoueur");

            $idJoueur = $joueur -> getIdJoueur();
            $requete -> bindParam(':idMatchDeRugby', $idMatch);
            $requete -> bindParam(':idJoueur', $idJoueur);

            $requete -> execute();
            $resultat = $requete -> fetch();

            $estTitulaire = $resultat['estTitulaire'];
            $poste = $resultat['poste'];
            $note = $resultat['note'];

            return new JouerUnMatch($idMatch,$joueur, $estTitulaire, $poste, $note);
        } catch (PDOException $e) {
            echo "Erreur : " . $e -> getMessage();
        }
        return null;
    }

    public static function readAll(): array {
        $listJouer = array();
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $requete = $connexion -> prepare("SELECT * FROM Participer");
            $requete -> execute();
            $rows = $requete -> fetchAll();

            foreach ($rows as $row) {
                $listJouer[] = new JouerUnMatch($row["idMatch"],Joueur::getById($row["idJoueur"]), $row["estTitulaire"], $row["poste"], $row["note"]);
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
             WHERE idMatchDeRugby = :idMatchDeRugby AND idJoueur = :idJoueur");

            $estTitulaire = $jouer -> isTitulaire();
            $poste = $jouer -> getPoste();
            $note = $jouer -> getNote();
            $idJoueur = $jouer -> getJoueur() -> getIdJoueur();
            $idMatch = $jouer -> getIdMatch();

            $requete->bindParam(':estTitulaire', $estTitulaire);
            $requete->bindParam(':poste', $poste);
            $requete->bindParam(':note', $note);
            $requete->bindParam(':idMatchDeRugby', $idMatch);
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
                "DELETE FROM Participer WHERE idMatchDeRugby = :idMatchDeRugby AND idJoueur = :idJoueur");

            $idJoueur = $jouer -> getJoueur()->getIdJoueur();
            $idMatch = $jouer -> getIdMatch();
            $requete -> bindParam(':idMatchDeRugby', $idMatch);
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
                "SELECT * FROM Participer WHERE idMatchDeRugby = :idMatchDeRugby");

            $requete -> bindParam(':idMatchDeRugby', $idMatch);

            $requete -> execute();
            $rows = $requete -> fetchAll();

            foreach ($rows as $row) {
                $listJouer[] = new JouerUnMatch($idMatch,Joueur::getById($row["idJoueur"]), $row["estTitulaire"], $row["poste"], $row["note"]);
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
                $listJouers[] = new JouerUnMatch($row['idMatch'], $row['estTitulaire'], $row['poste'], $row['note']);
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e -> getMessage();
        }
        return $listJouers;
    }

}