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
        } else { ?>
            <form method="post" action="gererfdm.php">
                <div class="form-notes">
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

                            <!-- Use unique names for inputs -->
                            <?php
                            $key = htmlspecialchars(openssl_encrypt($joueur->getIdJoueur(), 'aes-256-cbc', $csrf_token, 0, $iv));
                            $match = htmlspecialchars($fdm->getIdMatch());
                            $numero = htmlspecialchars(openssl_encrypt($fdm->getNumero(),'aes-256-cbc', $csrf_token, 0, $iv));
                            ?>
                            <input type="hidden" name="notes[<?= $key ?>][idMatch]" value="<?= $match ?>">
                            <input type="hidden" name="notes[<?= $key ?>][idJoueur]" value="<?= $numero ?>">
                            <div class="row">
                                <label for="note-<?= $key ?>">Note :</label>
                                <input type="number" id="note-<?= $key ?>" name="notes[<?= $key ?>][note]" min="0" max="20" step="0.25" value="<?= $fdm->getNote() == -1 ? 0 : $fdm->getNote()?>" required>
                            </div>
                        </section>
                    <?php } ?>
                </div>
                <input type="hidden" name="type" value="notes">
                <input type="hidden" name="fdm" value="2">
                <input type="hidden" name="idMatch" value="<?= htmlspecialchars($idMatch) ?>">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(hash_hmac("sha256", $idMatch . $csrf_token . "notes", $csrf_token)) ?>">
                <button type="submit" class="button save-note">Enregistrer les notes</button>
            </form>
        <?php } ?>
    </article>
</div>