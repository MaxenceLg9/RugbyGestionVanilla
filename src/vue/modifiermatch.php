<?php require "../components/nav.php" ?>

<div class="main div-column">
    <article>
        <h1>Modifier un match</h1>
        <section class="full">
            <h3>Entrez les informations du match à modifier</h3>
            <h3>Match du <?= $fdm->getDateHeure()->format('d/m/Y-H:i') ?> contre <?= $fdm->getAdversaire() ?>, Lieu : <?= $fdm->getLieu()->name ?></h3>
            <form action="gerermatch.php" method="post">
                <div class="form-row">
                    <label for="datetime">Date du match</label>
                    <input type="datetime-local" id="datetime" name="datetime" required value="<?= $fdm->getDateHeure()->format('Y-m-d\TH:i') ?>">
                </div>
                <div class="form-row">
                    <label for="lieu">Lieu du match</label>
                    <select id="lieu" name="lieu" required>
                        <?php foreach (Lieu::cases() as $lieu) { ?>
                            <option value="<?= $lieu->name ?>" <?= $fdm->getLieu() === $lieu ? 'selected' : '' ?>>
                                <?= htmlspecialchars($lieu->name) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-row">
                    <label for="adversaire">Adversaire</label>
                    <input type="text" id="adversaire" name="adversaire" placeholder="Nom de l'adversaire" required value="<?= $fdm->getAdversaire() ?>">
                </div>

                <input type="hidden" name="idMatch" value="<?= $fdm->getIdMatch() ?>">
                <input type="hidden" name="type" value="modification">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(password_hash($fdm->getIdMatch() . $_SESSION['csrf_token'] . "modification", PASSWORD_BCRYPT)) ?>">

                <button type="submit" class="ajout">Modifier le match</button>
            </form>
        </section>
    </article>
</div>
