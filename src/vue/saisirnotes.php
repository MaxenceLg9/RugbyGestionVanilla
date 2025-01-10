<?php include_once "../components/nav.php" ?>

<div class="main div-column">
    <header class="header-section">
        <h1>Noter les joueurs</h1>
        <p>Attribuez une note à chaque joueur sur une échelle de 0 à 5.</p>
    </header>
    <article class="player-list">
        <?php
        if (empty($joueurs)) {
            echo "<p class=\"color-red\">Aucun joueur n'est disponible pour ce match.</p>";
        }else{?>
            <form method="post" action="saveNotes.php">
            <?php foreach ($joueurs as $fdm) {
                $joueur = $fdm->getJoueur();
                ?>

                    <section class="section-card">
                        <div class="card-info">
                            <div class="head">
                                <img src="<?= $joueur->getUrl() ?: '../resources/img/data/default.png' ?>" alt="Photo de <?= htmlspecialchars($joueur->getPrenom() . ' ' . $joueur->getNom()) ?>" class="profile-picture">
                                <h2><?= htmlspecialchars($joueur->getPrenom() . ' ' . $joueur->getNom()) ?></h2>
                                <p><strong>Position: </strong><?= htmlspecialchars($fdm->getNumero()) ?></p>
                            </div>
                        </div>

                        <input type="hidden" name="idMatch-" value="<?= htmlspecialchars($fdm->getIdMatch()) ?>">
                        <input type="hidden" name="idJoueur-" value="<?= htmlspecialchars($joueur->getIdJoueur()) ?>">
                        <div class="form-row">
                            <label for="note-<?= htmlspecialchars($joueur->getIdJoueur()) ?>">Note :</label>
                            <input type="number" id="note-<?= htmlspecialchars($joueur->getIdJoueur()) ?>" name="note" min="0" max="20" step="0.25" value="0" required>
                        </div>
                    </section>
            <?php } ?>
                <button type="submit" class="button save-note">Enregistrer la note</button>
             </form>
        <?php } ?>
    </article>
</div>
