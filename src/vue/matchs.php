<?php include_once "../components/nav.php" ?>

<div class="main div-column">
    <header>
        <h1>Liste des matchs</h1>
        <p>Vous cherchez à ajouter un match : </p>
        <form method="get" action="gerermatch.php">
            <input type="hidden" name="type" value="ajout">
            <input type="hidden" name="idMatch" value="<?= 0 ?>">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(password_hash("0".$_SESSION['csrf_token'],PASSWORD_BCRYPT)) ?>">
            <button type="submit" class="add">Ajouter un match</button>
        </form>
    </header>
    <article>
    <?php
    $match = new MatchDeRugby(1, new DateTime(), "Toulouse", Lieu::DOMICILE);
    foreach($matchs as $match){?>
        <section>
            <div>
                <h2>Match du <?php echo $match->getDateHeure()->format('d/m/Y-H:i')?></h2>
                <p>Adversaire: <?php echo $match->getAdversaire()?></p>
                <p>Lieu: <?php echo $match->getLieu()->name?></p>
            </div>
            <div class="forms">
                <form method="get" action="gerermatch.php" style="margin-top: 10px;">
                    <input type="hidden" name="type" value="modification">
                    <input type="hidden" name="idMatch" value="<?= htmlspecialchars($match->getIdMatchDeRugby()) ?>">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(password_hash($match->getIdMatchDeRugby().$_SESSION['csrf_token'],PASSWORD_BCRYPT)) ?>">
                    <button type="submit" class="modify">Modifier le match</button>
                </form>
                <form method="post" action="gerermatch.php" style="margin-top: 10px;">
                    <input type="hidden" name="type" value="suppression">
                    <input type="hidden" name="idMatch" value="<?= htmlspecialchars($match->getIdMatchDeRugby()) ?>">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(password_hash($match->getIdMatchDeRugby().$_SESSION['csrf_token'],PASSWORD_BCRYPT)) ?>">
                    <button type="submit" class="delete">Supprimer le match</button>
                </form>
            </div>
        </section>
        <?php
    }
    ?>
    </article>
</div>