<?php
require '../db/Connexion.php';

class InsererDonnees {

    private static array $statements = [
        "INSERT INTO Joueur (numeroLicense, nom, prenom, dateNaissance, taille, poids, statut, postePrefere, estPremiereLigne) 
         VALUES (1234, 'Doe', 'John', '1990-01-01', 180, 80, 'Actif', 'Pilier', 1)",
        "INSERT INTO Joueur (numeroLicense, nom, prenom, dateNaissance, taille, poids, statut, postePrefere, estPremiereLigne) 
         VALUES (5678, 'Doe', 'Jane', '1995-01-01', 170, 60, 'Actif', 'Centre', 0)",
        "INSERT INTO Joueur (numeroLicense, nom, prenom, dateNaissance, taille, poids, statut, postePrefere, estPremiereLigne) 
         VALUES (9012, 'Doe', 'Alice', '2000-01-01', 160, 50, 'Actif', 'Ailier', 1)",
        "INSERT INTO Joueur (numeroLicense, nom, prenom, dateNaissance, taille, poids, statut, postePrefere, estPremiereLigne) 
         VALUES (3456, 'Doe', 'Bob', '2005-01-01', 150, 40, 'Actif', 'Troisieme ligne', 0)",
        "INSERT INTO MatchDeRugby (dateHeure, adversaire, lieu, resultat) 
         VALUES ('2021-01-01 12:00:00', 'Toulon', 'Domicile', 'Victoire')",
        "INSERT INTO MatchDeRugby (dateHeure, adversaire, lieu, resultat) 
         VALUES ('2021-01-08 12:00:00', 'Toulouse', 'Exterieur', 'Defaite')",
        "INSERT INTO MatchDeRugby (dateHeure, adversaire, lieu, resultat) 
         VALUES ('2021-01-15 12:00:00', 'Clermont', 'Domicile', 'Nul')",
        "INSERT INTO MatchDeRugby (dateHeure, adversaire, lieu, resultat) 
         VALUES ('2021-01-22 12:00:00', 'Montpellier', 'Exterieur', NULL)"
    ];

    public static function insererDonnees() {
        $connexion = Connexion::getInstance()->getConnection();
        foreach (self::$statements as $statement) {
            $connexion->prepare($statement)->execute();
        }
    }

}

InsererDonnees::insererDonnees();