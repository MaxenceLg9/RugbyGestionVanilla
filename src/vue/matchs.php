<?php include_once "../components/nav.php" ?>

<div class="main div-column">
    <header class="header-section">
        <h1>Liste des matchs du <?= $_SESSION["equipe"]?></h1>
        <div class="add">
            <p>Vous cherchez à ajouter un match?</p>
            <a href="gerermatch.php?type=ajout&idMatch=0&csrf_token=<?= htmlspecialchars(password_hash("0" . $_SESSION['csrf_token'] . "ajout", PASSWORD_BCRYPT)) ?>" class="forms button add"><p>Ajouter un match</p></a>
        </div>
    </header>
    <article class="match-list">
        <?php
        if(empty($matchs)){
            echo "<p>Aucun match n'est enregistré pour le moment.</p>";
        }
        foreach ($matchs as $match) { ?>

            <section class="section-card">

                <div class="match-info">
                    <h2>Match du <?= $match->getDateHeure()->format('d/m/Y-H:i') ?></h2>
                    <p><strong>Adversaire:</strong> <?= $match->getAdversaire() ?></p>
                    <p><strong>Lieu:</strong> <?= $match->getLieu()->name ?></p>
                </div>

                <div class="statut">
                    <?php if ($match->getDateHeure() < new DateTime()) { ?>
                        <p class="result">Match passé</p>
                        <?php if(!is_null($match->getResultat())){ ?>
                            <p class="result">Match validé</p>
                            <p>Score : Match <?= $match->getResultat()?></p>
                        <?php }
                        else { ?>
                            <p>Aucun résultat</p>
                        <?php }
                    } else { ?>
                        <p class="result">Match à venir</p>
                    <?php } ?>
                </div>

                <div class="forms">
                    <a href="gerermatch.php?type=vue&idMatch=<?= htmlspecialchars($match->getIdMatchDeRugby()) ?>&csrf_token=<?= htmlspecialchars(password_hash($match->getIdMatchDeRugby() . $_SESSION['csrf_token'] . "vue", PASSWORD_BCRYPT)) ?>" class="forms saisie button"><p>Voir la feuille de match</p></a>
                    <a href="gerermatch.php?type=modification&idMatch=<?= htmlspecialchars($match->getIdMatchDeRugby()) ?>&csrf_token=<?= htmlspecialchars(password_hash($match->getIdMatchDeRugby() . $_SESSION['csrf_token'] . "modification", PASSWORD_BCRYPT)) ?>" class="forms modify button"><p>Modifier le match</p></a>
                    <form method="post" action="gerermatch.php">
                        <input type="hidden" name="type" value="suppression">
                        <input type="hidden" name="idMatch" value="<?= htmlspecialchars($match->getIdMatchDeRugby()) ?>">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(password_hash($match->getIdMatchDeRugby() . $_SESSION['csrf_token'] . "suppression", PASSWORD_BCRYPT)) ?>">
                        <button type="submit" class="delete">Supprimer</button>
                    </form>
                </div>
            </section>
        <?php } ?>
    </article>
</div>