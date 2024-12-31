<?php include_once "../components/nav.php" ?>

<div class="main">
    <?php
    foreach($matchs as $match){?>
        <section>
            <h2>Match du <?php echo $match['dateHeure']?></h2>
            <p>Adversaire: <?php echo $match['adversaire']?></p>
            <p>Lieu: <?php echo $match['lieu']?>"</p>
            <p>Résultat: <?php echo $match['resultat']?></p>
            <form method="POST" action="matchs.php" style="margin-top: 10px;">
                <input type="hidden" name="idMatch" value="<?= htmlspecialchars($match['idMatch']) ?>">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                <button type="submit" style="background-color: red; color: white;">Delete</button>
            </form>
        </section>
        <?php
    }
    ?>
</div>