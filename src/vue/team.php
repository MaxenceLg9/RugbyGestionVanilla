<?php include_once "../components/nav.php" ?>
<div class="main">
    <header>
        <h1>Liste des joueurs</h1>
        <p>Vous cherchez à ajouter un joueur : </p>
        <form method="get" action="gererjoueur.php">
            <input type="hidden" name="type" value="ajout">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
            <button type="submit" class="add">Ajouter un joueur</button>
        </form>
    </header>
    <article>
        <?php
        $match = new Joueur(0,"Xavier","Dupont",new DateTime("1990-01-01"),"11000",165,85,Statut::ABSENT,"3ème ligne aile",true);
        foreach($joueurs as $joueur){?>
            <section>
                <div>
                    <h2><?php echo $joueur->getNom()." ".$joueur->getPrenom() ?></h2>
                    <p>Date de naissance: <?php echo $joueur->getDateNaissance()->format('d/m/Y')?></p>
                    <p>Numéro de licence: <?php echo $joueur->getNumeroLicense()?></p>
                    <p>Taille: <?php echo $joueur->getTaille()?></p>
                    <p>Poids: <?php echo $joueur->getPoids()?></p>
                    <p>Statut: <?php echo $joueur->getStatut()->name?></p>
                    <p>Poste préféré: <?php echo $joueur->getPostePrefere()?></p>
                    <p>Est première ligne: <?php echo $joueur->getEstPremiereLigne() ? "Oui" : "Non"?></p>
                </div>
                <div class="forms">
                    <form method="get" action="gerermatch.php" style="margin-top: 10px;">
                        <input type="hidden" name="type" value="modification">
                        <input type="hidden" name="idMatch" value="<?= htmlspecialchars($joueur->getIdJoueur()) ?>">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                        <button type="submit" class="modify">Modifier le match</button>
                    </form>
                    <form method="post" action="gerermatch.php" style="margin-top: 10px;">
                        <input type="hidden" name="type" value="suppression">
                        <input type="hidden" name="idMatch" value="<?= htmlspecialchars($joueur->getIdJoueur()) ?>">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                        <button type="submit" class="delete">Supprimer le match</button>
                    </form>
                </div>
            </section>
            <?php
        }
        ?>
    </article>
</div>
