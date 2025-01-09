<?php include_once "../components/nav.php"; ?>

<div class="main div-column">
    <header class="header-section">
        <h1>Votre équipe : <?= $_SESSION["equipe"]?></h1>
        <div class="add">
            <p class="color-red">Vous cherchez à ajouter un joueur?</p>
            <a href="gererjoueur.php?type=ajout&idJoueur=0&csrf_token=<?= htmlspecialchars(password_hash("0" . $_SESSION['csrf_token'] . "ajout", PASSWORD_BCRYPT)) ?>" class="forms button add"><p>Ajouter un joueur</p></a>
        </div>
    </header>
    <article class="team-list">
        <?php
        require_once "../modele/Joueur.php";

        // Assuming $equipes is an array of Equipe objects passed to this page
        if(empty($joueurs)){
            echo "<p class=\"color-red\">Aucun joueur n'est enregistré pour le moment.</p>";
        }
        else{
            foreach ($joueurs as $joueur) {
                if ($joueur->getUrl() == "") {
                    $url = "../resources/img/data/default.png";
                } else {
                    $url = $joueur->getUrl();
                } ?>
                <section class="section-card">
                    <div class="card-info">
                        <div class="head">
                            <h2><?= htmlspecialchars($joueur->getNom() . " " . $joueur->getPrenom()) ?></h2>
                            <p>Date de naissance : <?= htmlspecialchars($joueur->getDateNaissance()->format('d/m/Y')) ?></p>
                            <p>Numéro de licence : <?= htmlspecialchars($joueur->getNumeroLicense()) ?></p>
                            <p>Taille : <?= htmlspecialchars($joueur->getTaille()) ?> cm</p>
                            <p>Poids : <?= htmlspecialchars($joueur->getPoids()) ?> kg</p>
                            <p>Statut : <?= htmlspecialchars($joueur->getStatut()->name) ?></p>
                            <p>Poste préféré : <?= htmlspecialchars($joueur->getPostePrefere()->value) ?></p>
                            <p>Est première ligne : <?= $joueur->getEstPremiereLigne() ? "Oui" : "Non" ?></p>
                        </div>
                        <img src="<?= $url?>" alt="Photo de profil de <?= htmlspecialchars($joueur->getNom() . " " . $joueur->getPrenom()) ?>" width="80" height="80">
                    </div>

                    <div class="forms">
                        <!-- Modification Form -->
                        <a href="gererjoueur.php?type=vue&idJoueur=<?= htmlspecialchars($joueur->getIdJoueur()) ?>&csrf_token=<?= htmlspecialchars(password_hash($joueur->getIdJoueur() . $_SESSION['csrf_token'] . "vue", PASSWORD_BCRYPT)) ?>" class="forms saisie button"><p>Consulter le joueur</p></a>
                        <a href="gererjoueur.php?type=modification&idJoueur=<?= htmlspecialchars($joueur->getIdJoueur()) ?>&csrf_token=<?= htmlspecialchars(password_hash($joueur->getIdJoueur() . $_SESSION['csrf_token'] . "modification", PASSWORD_BCRYPT)) ?>" class="forms modify button">
                            <p>Modifier le joueur</p>
                        </a>

                        <!-- Suppression Form -->
                        <form method="post" action="gererjoueur.php">
                            <input type="hidden" name="type" value="suppression">
                            <input type="hidden" name="idJoueur" value="<?= htmlspecialchars($joueur->getIdJoueur()) ?>">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(password_hash($joueur->getIdJoueur() . $_SESSION['csrf_token'] . "suppression", PASSWORD_BCRYPT)) ?>">
                            <button type="submit" class="delete">Supprimer</button>
                        </form>
                    </div>
                </section>
            <?php } ?>
        <?php } ?>
    </article>
</div>
