<?php

require_once '../db/Connexion.php';
require_once '../modele/Joueur.php';
require_once "../modele/Poste.php";

class DAOJoueur {

    public static function readActif():array
    {
        $joueurs = [];
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare("SELECT * FROM Joueur WHERE statut = 'ACTIF' ORDER BY postePrefere, nom");
            $statement->execute();
            while ($row = $statement->fetch()) {
                $joueurs[] = self::constructFromRow($row);
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la lecture des joueurs: " . $e->getMessage();
        }
        return $joueurs;
    }

    public static function getStatsJoueurs():array
    {
        try {
            $connexion = Connexion::getInstance()->getConnection();

            $query = "SELECT j.idJoueur, j.nom, j.postePrefere, COUNT(CASE WHEN p.numero < 16 THEN 1 END) AS titulaire,
                COUNT(CASE WHEN p.numero > 15 THEN 1 END) AS remplacant,
                AVG(p.note) AS moyenneNotes,
                SUM(CASE WHEN m.resultat = 'VICTOIRE' THEN 1 ELSE 0 END) / COUNT(*) * 100 AS pourcentageMatchsGagnes,
                MAX(CASE WHEN p.archive = 0 THEN 1 ELSE 0 END) AS selectionsConsecutives,
                j.statut as statut
                FROM Joueur j
                LEFT JOIN Participer p ON j.idJoueur = p.idJoueur
                LEFT JOIN MatchDeRugby m ON p.idMatch = m.idMatch
                WHERE p.note != -1 AND m.valider = 1
                GROUP BY j.idJoueur";

            $statement = $connexion->prepare($query);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $e){
            echo "Erreur lors de la récupération des statistiques des joueurs: " . $e->getMessage();
        }
        return [];
    }

    public function create(Joueur $joueur): void {
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare(
                "INSERT INTO Joueur (numeroLicence, nom, prenom, dateNaissance, taille, poids, statut, postePrefere, estPremiereLigne, commentaire) 
                   VALUES (:numeroLicence, :nom, :prenom, :dateNaissance, :taille, :poids, :statut, :postePrefere, :estPremiereLigne, :commentaire)");

            $this->bindParams($joueur, $statement);
            $statement->execute();
            echo "Joueur créé avec succès\n";
        } catch (PDOException $e) {
            echo "Erreur lors de la création du joueur" . $e->getMessage();
        }
    }

    public static function read(): array {
        $joueurs = [];
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare("SELECT * FROM Joueur ORDER BY postePrefere, nom");
            $statement->execute();
            while ($row = $statement->fetch()) {
                $joueurs[] = self::constructFromRow($row);
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la lecture des joueurs: " . $e->getMessage();
        }
        return $joueurs;
    }

    public function readByNumeroLicence(int $numeroLicence): ?Joueur {
        $joueur = null;
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare("SELECT * FROM Joueur WHERE numeroLicence = :numeroLicence");
            $statement->bindParam(':numeroLicence', $numeroLicence);
            $statement->execute();
            $row = $statement->fetch();
            if ($row) {
                $joueur = self::constructFromRow($row);
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la lecture du joueur: " . $e->getMessage();
        }
        return $joueur;
    }

    public static function readNonParticiperMatch(int $idMatch): array {
        try {
            $connection = Connexion::getInstance()->getConnection();
            $statement = $connection->prepare("SELECT * FROM Joueur WHERE idJoueur NOT IN (SELECT idJoueur FROM Participer WHERE idMatch = :idMatch)");
            $statement->bindParam(':idMatch', $idMatch);
            $statement->execute();
            $joueurs = [];
            while ($row = $statement->fetch()) {
                $joueurs[] = self::constructFromRow($row);
            }
        }
        catch (PDOException $e) {
            echo "Erreur lors de la lecture des joueurs participant au match: " . $e->getMessage();
        }
        return $joueurs;
    }

    public function update(Joueur $joueur): void {
        try {
            $connexion = Connexion::getInstance()->getConnection();
            $statement = $connexion->prepare(
                "UPDATE Joueur SET taille = :taille, poids = :poids, statut = :statut,
                    postePrefere = :postePrefere, estPremiereLigne = :estPremiereLigne,
                    numeroLicence = :numeroLicence, nom = :nom, prenom = :prenom, dateNaissance = :dateNaissance, commentaire= :commentaire
              WHERE idJoueur = :idJoueur"
            );
            self::bindParams($joueur, $statement);
            $id = $joueur->getIdJoueur();
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
            $statement = $connexion->prepare("DELETE FROM Participer WHERE idJoueur = :idJoueur");
            $idJoueur = $joueur->getIdJoueur();
            $statement->bindParam(':idJoueur', $idJoueur);
            $statement->execute();

            $statement = $connexion->prepare("DELETE FROM Joueur WHERE idJoueur = :idJoueur");
            $statement->bindParam(':idJoueur', $idJoueur);
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
                $joueur = self::constructFromRow($row);
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la lecture du joueur: " . $e->getMessage();
        }
        return $joueur;
    }

    private static function constructFromRow($row):Joueur{
        $joueur = new Joueur($row['idJoueur'], $row['nom'], $row['prenom'],
            new DateTime($row['dateNaissance']), $row['numeroLicence'], $row['taille'], $row['poids'],
            Statut::from($row['statut']), Poste::tryFromName($row['postePrefere']), $row['estPremiereLigne']);
        if(!is_null($row["commentaire"]))
            $joueur->setCommentaire($row["commentaire"]);
        if(!is_null($row["url"]))
            $joueur->setURL($row["url"]);
        return $joueur;
    }

    /**
     * @param Joueur $joueur
     * @param bool|PDOStatement $statement
     * @return array
     */
    public function bindParams(Joueur $joueur, bool|PDOStatement $statement): void
    {
        $numeroLicence = $joueur->getNumeroLicence();
        $nom = $joueur->getNom();
        $prenom = $joueur->getPrenom();
        $dateNaissance = $joueur->getDateNaissance()->format('Y-m-d');
        $taille = $joueur->getTaille();
        $poids = $joueur->getPoids();
        $statut = $joueur->getStatut()->name;
        $postePrefere = $joueur->getPostePrefere()->name;
        $estPremiereLigne = $joueur->isPremiereLigne();
        $commentaire = $joueur->getCommentaire();

        $statement->bindParam(':numeroLicence', $numeroLicence);
        $statement->bindParam(':nom', $nom);
        $statement->bindParam(':prenom', $prenom);
        $statement->bindParam(':dateNaissance', $dateNaissance);
        $statement->bindParam(':taille', $taille);
        $statement->bindParam(':poids', $poids);
        $statement->bindParam(':statut', $statut);
        $statement->bindParam(':postePrefere', $postePrefere);
        $statement->bindParam(':estPremiereLigne', $estPremiereLigne);
        $statement->bindParam(':commentaire', $commentaire);
    }
}