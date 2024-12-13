<?php

require_once 'Connexion.php';
require_once '../modele/Commentaire.php';
require_once '../modele/Joueur.php';

class DAOCommentaire {

    public function create(Commentaire $commentaire): void {
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare("INSERT INTO Commentaire (commentaires, idJoueur) 
                                                    VALUES (:commentaires, :idJoueur)");

            $commentaires = $commentaire->getCommentaires();
            $idJoueur = $commentaire->getJoueur()->getIdJoueur();

            $statement->bindParam(':commentaires', $commentaires);
            $statement->bindParam(':idJoueur', $idJoueur);

            $statement->execute();
            echo "Commentaire créé avec succès";
        } catch (PDOException $e) {
            echo "Erreur lors de la création du commentaire: " . $e->getMessage();
        }
    }

    public function readByJoueur(Joueur $joueur): Commentaire {
        $commentaire = null;
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare("SELECT * FROM Commentaire WHERE idJoueur = :idJoueur");
            $idJoueur = $joueur->getIdJoueur();
            $statement->bindParam(':idJoueur', $idJoueur);
            $statement->execute();
            $row = $statement->fetch();
            $commentaire = new Commentaire($row['idCommentaire'], $row['commentaires'], $row['idJoueur']);
        } catch (PDOException $e) {
            echo "Erreur lors de la lecture du commentaire: " . $e->getMessage();
        }
        return $commentaire;
    }

    public function update(Commentaire $commentaire): void {
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare("UPDATE Commentaire SET commentaires = :commentaires 
                                                    WHERE idJoueur = :idJoueur");

            $commentaires = $commentaire->getCommentaires();
            $idJoueur = $commentaire->getJoueur()->getIdJoueur();

            $statement->bindParam(':commentaires', $commentaires);
            $statement->bindParam(':idJoueur', $idJoueur);

            $statement->execute();
            echo "Commentaire mis à jour avec succès";
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour du commentaire: " . $e->getMessage();
        }
    }

    public function delete(Commentaire $commentaire): void {
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare("DELETE FROM Commentaire WHERE idJoueur = :idJoueur");

            $idJoueur = $commentaire->getJoueur()->getIdJoueur();

            $statement->bindParam(':idJoueur', $idJoueur);

            $statement->execute();
            echo "Commentaire supprimé avec succès";
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression du commentaire: " . $e->getMessage();
        }
    }

}