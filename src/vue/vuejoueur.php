<?php include_once "../components/nav.php" ?>

<div class="main">
    <article>
        <h1>Informations sur le joueur</h1>

        <!-- Player Info Section -->

        <div class="first-section">
            <section class="player-identity">
                <?php
                $url = empty($joueur->getUrl()) ? "../resources/img/data/default.png" : $joueur->getUrl();
                ?>
                <h2>Identité du joueur</h2>

                <div class="identity-info">
                    <img src="<?= htmlspecialchars($url) ?>" alt="Photo de <?= htmlspecialchars($joueur->getNom()) ?>" width="200" height="200">
                    <div class="identity-details">
                        <p><strong>Nom :</strong> <?= htmlspecialchars($joueur->getNom()) ?></p>
                        <p><strong>Prénom :</strong> <?= htmlspecialchars($joueur->getPrenom()) ?></p>
                        <p><strong>Date de Naissance :</strong> <?= htmlspecialchars($joueur->getDateNaissance()->format('d-m-Y')) ?></p>
                    </div>
                </div>
            </section>
            <section class="player-info">
                <h2>Caractéristiques</h2>
                <p><strong>Numéro de Licence :</strong> <?= htmlspecialchars($joueur->getNumeroLicense()) ?></p>
                <p><strong>Taille :</strong> <?= htmlspecialchars($joueur->getTaille()) ?> cm</p>
                <p><strong>Poids :</strong> <?= htmlspecialchars($joueur->getPoids()) ?> kg</p>
                <p><strong>Poste Préféré :</strong> <?= htmlspecialchars($joueur->getPostePrefere()->value) ?></p>
                <p><strong>Première Ligne :</strong> <?= $joueur->isPremiereLigne() ? 'Oui' : 'Non' ?></p>
                <p><strong>Statut :</strong> <?= htmlspecialchars($joueur->getStatut()->name) ?></p>
                <p><strong>Commentaire :</strong> <?= nl2br(htmlspecialchars($joueur->getCommentaire())) ?></p>
            </section>
        </div>

        <!-- Player Statistics Section -->
        <section class="player-stats">
            <h2>Statistiques</h2>
            <p><strong>Total de Matchs :</strong> <?= $stats['totalMatches'] ?></p>
            <p><strong>Matchs Gagnés :</strong> <?= $stats['matchesWon'] ?></p>
            <p><strong>Pourcentage de Victoires :</strong> <?= $winPercentage ?>%</p>
            <p><strong>Note Moyenne :</strong> <?= number_format($stats['avgNote'], 2) ?></p>
        </section>

        <!-- Match Participation Section -->
        <section class="match-participation">
            <h2>Participation aux Matchs</h2>
            <?php if($stats["totalMatches"] == 0){
                echo "<p class=\"color-red\">Aucun match n'est enregistré pour ce joueur.</p>";
            }else{ ?>
            <table>
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Adversaire</th>
                    <th>Lieu</th>
                    <th>Résultat</th>
                    <th>Poste</th>
                    <th>Titulaire</th>
                    <th>Note</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($fdmJoueur as $fdm){
                    $match = MatchDeRugby::getFromId($fdm->getIdMatch());
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($match->getDateHeure()->format('d/m/Y-H:i')) ?></td>
                        <td><?= htmlspecialchars($match->getAdversaire()) ?></td>
                        <td><?= htmlspecialchars($match->getLieu()->value) ?></td>
                        <td><?= htmlspecialchars($match->getResultat()->value) ?></td>
                        <td><?= htmlspecialchars($fdm->getPoste()) ?></td>
                        <td><?= $fdm->isTitulaire() ? 'Oui' : 'Non' ?></td>
                        <td><?= number_format($fdm->getNote()) ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </section>
        <?php } ?>
    </article>
</div>