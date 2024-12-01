<?php

require_once '../db/Connexion.php';
require '../modele/FeuilleDeMatch.php';
require '../modele/MatchDeRugby.php';
require '../modele/Joueur.php';

class DAOFeuilleDeMatch {

    public function create(FeuilleDeMatch $feuilleDeMatch): void {
        $connexion = Connexion::getInstance()->getConnection();
        $requete = $connexion -> prepare(
            "INSERT INTO FeuilleDeMatch (idMatchDeRugby, idJoueur, estTitulaire, poste, note) 
             VALUES (:idMatchDeRugby, :idJoueur, :estTitulaire, :poste, :note)");

        $this->setDonnees($feuilleDeMatch, $requete);

        $requete -> execute();
        echo "Feuille de match créée avec succès !";
    }

    public function read(MatchDeRugby $matchDeRugby, Joueur $joueur) : FeuilleDeMatch {
        $connexion = Connexion::getInstance()->getConnection();
        $requete = $connexion -> prepare(
            "SELECT * FROM FeuilleDeMatch WHERE idMatchDeRugby = :idMatchDeRugby AND idJoueur = :idJoueur");

        $idMatchDeRugby = $matchDeRugby -> getIdMatchDeRugby();
        $idJoueur = $joueur -> getIdJoueur();
        $requete -> bindParam(':idMatchDeRugby', $idMatchDeRugby);
        $requete -> bindParam(':idJoueur', $idJoueur);

        $requete -> execute();
        $resultat = $requete -> fetch();

        $estTitulaire = $resultat['estTitulaire'];
        $poste = $resultat['poste'];
        $note = $resultat['note'];

        return new FeuilleDeMatch($matchDeRugby, $joueur, $estTitulaire, $poste, $note);
    }

    public function update(FeuilleDeMatch $feuilleDeMatch): void {
        $connexion = Connexion::getInstance()->getConnection();
        $requete = $connexion -> prepare(
            "UPDATE FeuilleDeMatch SET estTitulaire = :estTitulaire, poste = :poste, note = :note 
             WHERE idMatchDeRugby = :idMatchDeRugby AND idJoueur = :idJoueur");

        $this->setDonnees($feuilleDeMatch, $requete);

        $requete -> execute();
        echo "Feuille de match mise à jour avec succès !";
    }

    public function delete(FeuilleDeMatch $feuilleDeMatch): void {
        $connexion = Connexion::getInstance()->getConnection();
        $requete = $connexion -> prepare(
            "DELETE FROM FeuilleDeMatch WHERE idMatchDeRugby = :idMatchDeRugby AND idJoueur = :idJoueur");

        $idMatchDeRugby = $feuilleDeMatch -> getMatchDeRugby() -> getIdMatchDeRugby();
        $idJoueur = $feuilleDeMatch -> getJoueur() -> getIdJoueur();
        $requete -> bindParam(':idMatchDeRugby', $idMatchDeRugby);
        $requete -> bindParam(':idJoueur', $idJoueur);

        $requete -> execute();
        echo "Feuille de match supprimée avec succès !";
    }

    private function setDonnees(FeuilleDeMatch $feuilleDeMatch, bool|PDOStatement $requete): void {
        $idMatchDeRugby = $feuilleDeMatch->getMatchDeRugby()->getIdMatchDeRugby();
        $idJoueur = $feuilleDeMatch->getJoueur()->getIdJoueur();
        $estTitulaire = $feuilleDeMatch->estJoueurTitulaire();
        $poste = $feuilleDeMatch->getPoste();
        $note = $feuilleDeMatch->getNote();

        $requete->bindParam(':idMatchDeRugby', $idMatchDeRugby);
        $requete->bindParam(':idJoueur', $idJoueur);
        $requete->bindParam(':estTitulaire', $estTitulaire);
        $requete->bindParam(':poste', $poste);
        $requete->bindParam(':note', $note);
    }

}