<?php

class JouerUnMatch {

    private Joueur $joueur;

    private bool $titulaire;

    private string $poste;
    private float $note;
    function __construct(Joueur $joueur, bool $titulaire, string $poste, float $note) {
        $this->joueur = $joueur;
        $this->titulaire = $titulaire;
        $this->poste = $poste;
        $this->note = $note;
    }

    /**
     * @return Joueur
     */
    public function getJoueur(): Joueur
    {
        return $this->joueur;
    }

    /**
     * @param Joueur $joueur
     */
    public function setJoueur(Joueur $joueur): void
    {
        $this->joueur = $joueur;
    }

    /**
     * @return float
     */
    public function getNote(): float
    {
        return $this->note;
    }

    /**
     * @param float $note
     */
    public function setNote(float $note): void
    {
        $this->note = $note;
    }

    /**
     * @return string
     */
    public function getPoste(): string
    {
        return $this->poste;
    }

    /**
     * @param string $poste
     */
    public function setPoste(string $poste): void
    {
        $this->poste = $poste;
    }

    /**
     * @param bool $titulaire
     */
    public function setTitulaire(bool $titulaire): void
    {
        $this->titulaire = $titulaire;
    }

    /**
     * @return bool
     */
    public function isTitulaire(): bool
    {
        return $this->titulaire;
    }

    public function save(int $idMatch): void {
        $DAOJouer = new DAOJouerUnMatch();
        if ($DAOJouer -> read($idMatch, $this -> getJoueur()) != null) {
            $DAOJouer -> update($idMatch,$this);
        }
        $DAOJouer -> create($idMatch,$this);
    }

    public function delete(int $idMatch): void {
        $DAOJouerUnMatch = new DAOJouerUnMatch();
        if ($DAOJouerUnMatch -> read($idMatch, $this ->getJoueur()) != null) {
            $DAOJouerUnMatch->delete($idMatch,$this);
        }
    }

    public static function getJouerByMatch(int $idMatch): array {
        $DAOJouerUnMatch = new DAOJouerUnMatch();
        return $DAOJouerUnMatch -> readAllByMatch($idMatch);
    }

    public static function getJouerByJoueur(Joueur $joueur): array{
        $DAOJouerUnMatch = new DAOJouerUnMatch();
        return $DAOJouerUnMatch->readAllByJoueur($joueur);
    }
}