<?php require_once "../modele/Urls.php" ?>
<nav>
    <ul>
        <li><a href="<?php echo $URL['accueil']?>">Accueil</a></li>
        <li><a href="<?php echo $URL['team']?>">Mon équipe</a></li>
        <li><a href="<?php echo $URL['matchs']?>">Matchs</a></li>
        <li><a href="<?php echo $URL['results']?>">Résultats</a></li>
        <li><a href="<?php echo $URL['me']?>">Mon profil</a></li>
    </ul>
    <ul>
        <li><a href="<?php echo $URL['logout']?>">Se déconnecter</a></li>
    </ul>
</nav>