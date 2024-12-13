<?php

require_once 'Connexion.php';
require_once '../modele/Entraineur.php';

class DAOEntraineur {

    public function create(Entraineur $entraineur): void {
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare("INSERT INTO Entraineur (nom, prenom, email, motDePasse) 
                   VALUES (:nom, :prenom, :email, :motDePasse)");

            $nom = $entraineur->getNom();
            $prenom = $entraineur->getPrenom();
            $email = $entraineur->getEmail();
            $motDePasse = $entraineur->getMotDePasse();

            $statement->bindParam(':nom', $nom);
            $statement->bindParam(':prenom', $prenom);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':motDePasse', $motDePasse);
            $statement->execute();
            echo "Entraineur créé avec succès";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function read(): array {
        $entraineurs = [];
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare("SELECT * FROM Entraineur");
            $statement->execute();
            while ($row = $statement->fetch()) {
                $entraineurs[] = new Entraineur($row['idEntraineur'], $row['nom'],
                    $row['prenom'], $row['email'], $row['motDePasse']);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $entraineurs;
    }

    public function readByEmail(string $email): Entraineur {
        $entraineur = null;
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare("SELECT * FROM Entraineur WHERE email = :email");
            $statement->bindParam(':email', $email);
            $statement->execute();
            $row = $statement->fetch();
            $entraineur = new Entraineur($row['idEntraineur'], $row['nom'],
                $row['prenom'], $row['email'], $row['motDePasse']);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $entraineur;
    }

    public function update(Entraineur $entraineur): void {
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare("UPDATE Entraineur SET motDePasse = :motDePasse WHERE email = :email");

            $email = $entraineur->getEmail();
            $motDePasse = $entraineur->getMotDePasse();

            $statement->bindParam(':email', $email);
            $statement->bindParam(':motDePasse', $motDePasse);
            $statement->execute();
            echo "Entraineur modifié avec succès";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete(Entraineur $entraineur): void {
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare("DELETE FROM Entraineur WHERE email = :email");
            $email = $entraineur->getEmail();
            $statement->bindParam(':email', $email);
            $statement->execute();
            echo "Entraineur supprimé avec succès";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}