<?php include_once "../components/nav.php" ?>

<div class="main">
    <?php
    $match = new MatchDeRugby(1, new DateTime(), "Toulouse", Lieu::DOMICILE);
    foreach($matchs as $match){?>
        <section>
            <div>
                <h2>Match du <?php echo $match->getDateHeure()->format('d/m/Y-H:i')?></h2>
                <p>Adversaire: <?php echo $match->getAdversaire()?></p>
                <p>Lieu: <?php echo $match->getLieu()->name?></p>
            </div>
            <form method="POST" action="matchs.php" style="margin-top: 10px;">
                <input type="hidden" name="type" value="modifiy">
                <input type="hidden" name="idMatch" value="<?= htmlspecialchars($match->getIdMatchDeRugby()) ?>">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                <button type="submit" class="modify">Modifier le match</button>
            </form>
            <form method="POST" action="matchs.php" style="margin-top: 10px;">
                <input type="hidden" name="type" value="delete">
                <input type="hidden" name="idMatch" value="<?= htmlspecialchars($match->getIdMatchDeRugby()) ?>">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                <button type="submit" class="delete">Supprimer le match</button>
            </form>
        </section>
        <?php
    }
    ?>
</div>