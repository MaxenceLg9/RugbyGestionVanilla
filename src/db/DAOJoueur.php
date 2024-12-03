<?php

require_once 'Connexion.php';
require_once '../modele/Joueur.php';

class DAOJoueur {

    public function create(Joueur $joueur): void
    {
        $connexion = Connexion::getInstance()->getConnection();
        $statement = $connexion->prepare(
            "INSERT INTO Joueur (numeroLicense, nom, prenom, dateNaissance, taille, poids, statut, postePrefere, estPremiereLigne) 
                   VALUES (:numeroLicense, :nom, :prenom, :dateNaissance, :taille, :poids, :statut, :postePrefere, :estPremiereLigne)");

        $numeroLicense = $joueur->getNumeroLicense();
        $nom = $joueur->getNom();
        $prenom = $joueur->getPrenom();
        $dateNaissance = $joueur->getDateNaissance();
        $taille = $joueur->getTaille();
        $poids = $joueur->getPoids();
        $statut = $joueur->getStatut();
        $postePrefere = $joueur->getPostePrefere();
        $estPremiereLigne = $joueur->getEstPremiereLigne();

        $statement->bindParam(':numeroLicense', $numeroLicense);
        $statement->bindParam(':nom', $nom);
        $statement->bindParam(':prenom', $prenom);
        $statement->bindParam(':dateNaissance', $dateNaissance);
        $statement->bindParam(':taille', $taille);
        $statement->bindParam(':poids', $poids);
        $statement->bindParam(':statut', $statut);
        $statement->bindParam(':postePrefere', $postePrefere);
        $statement->bindParam(':estPremiereLigne', $estPremiereLigne);
        $statement->execute();
        echo "Joueur créé avec succès";
    }

    public function read(): array {
        $connexion = Connexion::getInstance()->getConnection();
        $statement = $connexion->prepare("SELECT * FROM Joueur");
        $statement->execute();
        $joueurs = [];
        while ($row = $statement->fetch()) {
            $joueurs[] = new Joueur($row['idJoueur'], $row['numeroLicense'], $row['nom'], $row['prenom'],
                                    $row['dateNaissance'], $row['taille'], $row['poids'],
                                    $row['statut'], $row['postePrefere'], $row['estPremiereLigne']);
        }
        return $joueurs;
    }

    public function readByNumeroLicense(int $numeroLicense): Joueur {
        $connexion = Connexion::getInstance()->getConnection();
        $statement = $connexion->prepare("SELECT * FROM Joueur WHERE numeroLicense = :numeroLicense");
        $statement->bindParam(':numeroLicense', $numeroLicense);
        $statement->execute();
        $row = $statement->fetch();
        return new Joueur($row['idJoueur'], $row['numeroLicense'], $row['nom'], $row['prenom'],
                          $row['dateNaissance'], $row['taille'], $row['poids'], $row['statut'],
                          $row['postePrefere'], $row['estPremiereLigne']);
    }

    public function update(Joueur $joueur): void {
        $connexion = Connexion::getInstance()->getConnection();
        $statement = $connexion->prepare(
            "UPDATE Joueur SET taille = :taille, poids = :poids, statut = :statut,
                postePrefere = :postePrefere, estPremiereLigne = :estPremiereLigne WHERE numeroLicense = :numeroLicense"
        );

        $taille = $joueur->getTaille();
        $poids = $joueur->getPoids();
        $statut = $joueur->getStatut();
        $postePrefere = $joueur->getPostePrefere();
        $estPremiereLigne = $joueur->getEstPremiereLigne();
        $numeroLicense = $joueur->getNumeroLicense();

        $statement->bindParam(':taille', $taille);
        $statement->bindParam(':poids', $poids);
        $statement->bindParam(':statut', $statut);
        $statement->bindParam(':postePrefere', $postePrefere);
        $statement->bindParam(':estPremiereLigne', $estPremiereLigne);
        $statement->bindParam(':numeroLicense', $numeroLicense);

        $statement->execute();
        echo "Joueur mis à jour avec succès";
    }

    public function delete(Joueur $joueur): void {
        $connexion = Connexion::getInstance()->getConnection();
        $statement = $connexion->prepare("DELETE FROM Joueur WHERE numeroLicense = :numeroLicense");
        $numeroLicense = $joueur->getNumeroLicense();
        $statement->bindParam(':numeroLicense', $numeroLicense);
        $statement->execute();
        echo "Joueur supprimé avec succès";
    }

    public function readById(int $idJoueur): Joueur {
        $connexion = Connexion::getInstance()->getConnection();
        $statement = $connexion->prepare("SELECT * FROM Joueur WHERE idJoueur = :idJoueur");
        $statement->bindParam(':idJoueur', $idJoueur);
        $statement->execute();
        $row = $statement->fetch();
        return new Joueur($row['idJoueur'], $row['numeroLicense'], $row['nom'], $row['prenom'],
                          $row['dateNaissance'], $row['taille'], $row['poids'], $row['statut'],
                          $row['postePrefere'], $row['estPremiereLigne']);
    }

}