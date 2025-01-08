<?php

require_once 'Connexion.php';
require_once '../modele/Joueur.php';

class DAOJoueur {

    public function create(Joueur $joueur): void {
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare(
                "INSERT INTO Joueur (numeroLicense, nom, prenom, dateNaissance, taille, poids, statut, postePrefere, estPremiereLigne, commentaire) 
                   VALUES (:numeroLicense, :nom, :prenom, :dateNaissance, :taille, :poids, :statut, :postePrefere, :estPremiereLigne, :commentaire)");

            $numeroLicense = $joueur->getNumeroLicense();
            $nom = $joueur->getNom();
            $prenom = $joueur->getPrenom();
            $dateNaissance = $joueur->getDateNaissance()->format('Y-m-d');
            $taille = $joueur->getTaille();
            $poids = $joueur->getPoids();
            $statut = $joueur->getStatut()->name;
            $postePrefere = $joueur->getPostePrefere();
            $estPremiereLigne = $joueur->getEstPremiereLigne();
            $commentaire = $joueur->getCommentaire();

            $statement->bindParam(':numeroLicense', $numeroLicense);
            $statement->bindParam(':nom', $nom);
            $statement->bindParam(':prenom', $prenom);
            $statement->bindParam(':dateNaissance', $dateNaissance);
            $statement->bindParam(':taille', $taille);
            $statement->bindParam(':poids', $poids);
            $statement->bindParam(':statut', $statut);
            $statement->bindParam(':postePrefere', $postePrefere);
            $statement->bindParam(':estPremiereLigne', $estPremiereLigne);
            $statement->bindParam(':commentaire',$commentaire);
            $statement->execute();
            echo "Joueur créé avec succès\n";
        } catch (PDOException $e) {
            echo "Erreur lors de la création du joueur" . $e->getMessage();
            die();
        }
    }

    public static function read(): array {
        $joueurs = [];
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare("SELECT * FROM Joueur");
            $statement->execute();
            while ($row = $statement->fetch()) {
                $joueur = new Joueur($row['idJoueur'], $row['nom'], $row['prenom'],
                    new DateTime($row['dateNaissance']), $row['numeroLicense'], $row['taille'], $row['poids'],
                    Statut::from($row['statut']), $row['postePrefere'], $row['estPremiereLigne']);
                $joueur->setCommentaire($row["commentaire"]);
                $joueurs[] = $joueur;
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la lecture des joueurs: " . $e->getMessage();
        }
        return $joueurs;
    }

    public function readByNumeroLicense(int $numeroLicense): ?Joueur {
        $joueur = null;
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare("SELECT * FROM Joueur WHERE numeroLicense = :numeroLicense");
            $statement->bindParam(':numeroLicense', $numeroLicense);
            $statement->execute();
            $row = $statement->fetch();
            if ($row) {
                $joueur = new Joueur($row['idJoueur'], $row['nom'], $row['prenom'],
                    new DateTime($row['dateNaissance']), $row['numeroLicense'], $row['taille'], $row['poids'],
                    Statut::from($row['statut']), $row['postePrefere'], $row['estPremiereLigne']);
                $joueur->setCommentaire($row["commentaire"]);
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la lecture du joueur: " . $e->getMessage();
        }
        return $joueur;
    }

    public function update(Joueur $joueur): void {
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare(
                "UPDATE Joueur SET taille = :taille, poids = :poids, statut = :statut,
                    postePrefere = :postePrefere, estPremiereLigne = :estPremiereLigne,
                    numeroLicense = :numeroLicense, nom = :nom, prenom = :prenom, dateNaissance = :dateNaissance, commentaire= :commentaire
              WHERE idJoueur = :idJoueur"
            );
            $numeroLicense = $joueur->getNumeroLicense();
            $nom = $joueur->getNom();
            $prenom = $joueur->getPrenom();
            $dateNaissance = $joueur->getDateNaissance()->format('Y-m-d');
            $taille = $joueur->getTaille();
            $poids = $joueur->getPoids();
            $statut = $joueur->getStatut()->name;
            $postePrefere = $joueur->getPostePrefere();
            $estPremiereLigne = $joueur->getEstPremiereLigne();
            $commentaire = $joueur->getCommentaire();
            $id = $joueur->getIdJoueur();


            $statement->bindParam(':numeroLicense', $numeroLicense);
            $statement->bindParam(':nom', $nom);
            $statement->bindParam(':prenom', $prenom);
            $statement->bindParam(':dateNaissance', $dateNaissance);
            $statement->bindParam(':taille', $taille);
            $statement->bindParam(':poids', $poids);
            $statement->bindParam(':statut', $statut);
            $statement->bindParam(':postePrefere', $postePrefere);
            $statement->bindParam(':estPremiereLigne', $estPremiereLigne);
            $statement->bindParam(':commentaire',$commentaire);
            $statement->bindParam(':idJoueur', $id);

            $statement->execute();
            echo "Joueur mis à jour avec succès\n";
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour du joueur: " . $e->getMessage();
        }
    }

    public function delete(Joueur $joueur): void {
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare("DELETE FROM Joueur WHERE numeroLicense = :numeroLicense");
            $numeroLicense = $joueur->getNumeroLicense();
            $statement->bindParam(':numeroLicense', $numeroLicense);
            $statement->execute();
            echo "Joueur supprimé avec succès\n";
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression du joueur: " . $e->getMessage();
        }
    }

    public static function readById(int $idJoueur): ?Joueur {
        $joueur = null;
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare("SELECT * FROM Joueur WHERE idJoueur = :idJoueur");
            $statement->bindParam(':idJoueur', $idJoueur);
            $statement->execute();
            $row = $statement->fetch();
            if ($row) {
                $joueur = new Joueur($row['idJoueur'], $row['nom'], $row['prenom'],
                    new DateTime($row['dateNaissance']), $row['numeroLicense'], $row['taille'], $row['poids'],
                    Statut::from($row['statut']), $row['postePrefere'], $row['estPremiereLigne']);
                $joueur->setCommentaire($row["commentaire"]);
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la lecture du joueur: " . $e->getMessage();
        }
        return $joueur;
    }

}