<?php

require 'Connexion.php';
class FeuilleDeMatch
{
    private DateTime $heure;
    private DateTime $date;

    function __construct(DateTime $date, DateTime $heure)
    {
        $this->date = $date;
        $this->heure = $heure;
    }
}