<?php require "../components/nav.php" ?>

<div class="main div-column">
    <h1>Modifier un match</h1>
    <section class="full">
        <h3>Entrez les informations du match à modifier</h3>
        <h3>Match du <?= $match->getDateHeure()->format('d/m/Y-H:i') ?> contre <?= $match->getAdversaire() ?>, Lieu : <?= $match->getLieu()->name ?></h3>
        <form action="gerermatch.php" method="post">
            <div class="form-row">
                <label for="datetime">Date du match</label>
                <input type="datetime-local" id="datetime" name="datetime" required value="<?= $match->getDateHeure()->format('Y-m-d\TH:i') ?>">
            </div>
            <div class="form-row">
                <label for="lieu">Lieu du match</label>
                <select id="lieu" name="lieu" required>
                    <?php if($match->getLieu()->name === 'EXTERIEUR') { ?>
                        <option value = "Exterieur" selected> Exterieur</option >
                        <option value = "Domicile" > Domicile</option >
                    <?php } else { ?>
                        <option value = "Exterieur" > Exterieur</option >
                        <option value = "Domicile" selected> Domicile</option >
                    <?php } ?>
                </select>
            </div>
            <div class="form-row">
                <label for="adversaire">Adversaire</label>
                <input type="text" id="adversaire" name="adversaire" placeholder="Nom de l'adversaire" required value="<?= $match->getAdversaire() ?>">
            </div>

            <input type="hidden" name="idMatch" value="<?= $match->getIdMatchDeRugby() ?>">
            <input type="hidden" name="type" value="ajout">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(password_hash($match->getIdMatchDeRugby() . $_SESSION['csrf_token'] . "ajout", PASSWORD_BCRYPT)) ?>">

            <button type="submit" class="ajout">Modifier le match</button>
        </form>
    </section>
</div>
