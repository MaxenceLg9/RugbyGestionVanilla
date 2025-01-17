<?php include_once "../components/nav.php" ?>
<div class="main">
    <h1>RugbyGestionPlus</h1>
    <article>
        <!-- Welcome Section -->
        <section class="header-section section-index">
            <h1>
                Bienvenue <strong class="strong-bienvenue"><?php echo $_SESSION['prenom']." ".$_SESSION["nom"] ?></strong> !
            </h1>
            <p>
                RugbyGestionPlus vous permet de gérer efficacement votre équipe de rugby et d’améliorer vos performances.
                Accédez à vos matchs, analysez les résultats et préparez vos stratégies gagnantes !
            </p>
        </section>

        <!-- Recent Results Section -->
        <section class="section-index">
            <h1>Vos derniers résultats</h1>
            <?php
            require_once "../modele/MatchDeRugby.php";
            if ($matches) {
                echo '<ul>';
                foreach ($matches as $match) {
                    echo "<li><strong>" . htmlspecialchars($match->getDateHeure()->format('d/m/Y-H:i')) . "</strong> - 
                        <em>" . htmlspecialchars($match->getAdversaire()) . "</em> 
                        (" . htmlspecialchars($match->getLieu()->name) . ") : 
                        <span class='resultat'>" . htmlspecialchars($match->getResultat()->name) . "</span></li>";
                }
                echo '</ul>';
            } else {
                echo '<p>Aucun match récent trouvé.</p>';
            }
            ?>
        </section>

        <!-- Quick Actions Section -->
        <section class="section-index">
            <h1>Actions rapides</h1>
            <div class="actions">
                <a href="/gerermatch.php?type=ajout&idMatch=0&csrf_token=<?= htmlspecialchars(hash_hmac("sha256","0" . $_SESSION['csrf_token'] . "ajout", $_SESSION['csrf_token'])) ?>" class="forms button add"><p>Ajouter un match</p></a>
                <a href="/gererjoueur.php?type=ajout&idJoueur=0&csrf_token=<?= htmlspecialchars(hash_hmac("sha256","0" . $_SESSION['csrf_token'] . "ajout", $_SESSION['csrf_token'])) ?>" class="forms button add"><p>Ajouter un joueur</p></a>
            </div>
        </section>
    </article>
</div>
