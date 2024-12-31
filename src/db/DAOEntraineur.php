<?php

require_once 'Connexion.php';
require_once '../modele/Entraineur.php';

class DAOEntraineur {

    public static function create(Entraineur $entraineur, string $motdepasse): void {
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare("INSERT INTO Entraineur (nom, prenom, email, motDePasse) 
                   VALUES (:nom, :prenom, :email, :motDePasse)");

            $nom = $entraineur->getNom();
            $prenom = $entraineur->getPrenom();
            $email = $entraineur->getEmail();

            $motdepasse = password_hash($motdepasse,PASSWORD_BCRYPT);

            $statement->bindParam(':nom', $nom);
            $statement->bindParam(':prenom', $prenom);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':motDePasse', $motdepasse);
            $statement->execute();
            echo "Entraineur créé avec succès";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function existEntraineur(): bool {
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare("SELECT COUNT(*) FROM Entraineur");
            $statement->execute();
            return $statement->fetchColumn() != 0;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public static function existEntraineurWithEmail(string $email): bool {
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare("SELECT COUNT(*) FROM Entraineur WHERE email = :email");
            $statement->bindParam(':email', $email);
            $statement->execute();
            return $statement->fetchColumn() != 0;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public static function update(Entraineur $entraineur, string $motdepasse): void {
        try {
            $connexion = Connexion::getInstance()->getConnection();

            $statement = $connexion->prepare("UPDATE Entraineur SET motDePasse = :motDePasse WHERE email = :email");

            $email = $entraineur->getEmail();
            $motdepasse = password_hash($motdepasse,PASSWORD_BCRYPT);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':motDePasse', $motdepasse);
            $statement->execute();
            echo "Entraineur modifié avec succès";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getEntraineur($email) : Entraineur{
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare("SELECT * FROM Entraineur WHERE email = :email");
            $statement->bindParam(':email', $email);
            $statement->execute();
            $row = $statement->fetchColumn();
            return new Entraineur($row['id'],$row['nom'],$row['prenom'],$row['email']);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function delete(Entraineur $entraineur): void {
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

    public static function compareMotDePasse(string $motdepasse, string $email): bool {
        $connexion = Connexion::getInstance()->getConnection();
        $statement = $connexion->prepare("SELECT motDePasse FROM Entraineur WHERE email=:email");
        $statement->bindParam(':email', $email);
        $statement->execute();
        $rows = $statement->fetchColumn();
        foreach ($rows as $row){
            return password_verify($motdepasse,$row['motDePasse']);
        }
        return false;
    }
}