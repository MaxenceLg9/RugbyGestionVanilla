<?php include_once "../components/nav.php" ?>

<div class="main">
    <article>
        <h1>Informations sur le joueur</h1>

        <!-- Player Info Section -->

        <section class="player-identity">
            <?php
            $url = empty($joueur->getUrl()) ? "../resources/img/data/default.png" : $joueur->getUrl();
            ?>
            <h2>Identité du joueur</h2>

            <div class="identity-info">
                <div class="identity-details">
                    <p><strong>Nom :</strong> <?= htmlspecialchars($joueur->getNom()) ?></p>
                    <p><strong>Prénom :</strong> <?= htmlspecialchars($joueur->getPrenom()) ?></p>
                    <p><strong>Date de Naissance :</strong> <?= htmlspecialchars($joueur->getDateNaissance()->format('d-m-Y')) ?></p>
                </div>
                <div class="identity-image">
                    <img src="<?= htmlspecialchars($url) ?>" alt="Photo de <?= htmlspecialchars($joueur->getNom()) ?>" width="200" height="200">
                </div>
            </div>
        </section>
        <section class="player-info">
            <p><strong>Numéro de Licence :</strong> <?= htmlspecialchars($joueur->getNumeroLicense()) ?></p>
            <p><strong>Taille :</strong> <?= htmlspecialchars($joueur->getTaille()) ?> cm</p>
            <p><strong>Poids :</strong> <?= htmlspecialchars($joueur->getPoids()) ?> kg</p>
            <p><strong>Poste Préféré :</strong> <?= htmlspecialchars($joueur->getPostePrefere()->value) ?></p>
            <p><strong>Première Ligne :</strong> <?= $joueur->getEstPremiereLigne() ? 'Oui' : 'Non' ?></p>
            <p><strong>Statut :</strong> <?= htmlspecialchars($joueur->getStatut()->name) ?></p>
            <p><strong>Commentaire :</strong> <?= nl2br(htmlspecialchars($joueur->getCommentaire())) ?></p>
        </section>

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
                <?php foreach ($matches as $match){ ?>
                    <tr>
                        <td><?= htmlspecialchars(date('d-m-Y H:i', strtotime($match['dateHeure']))) ?></td>
                        <td><?= htmlspecialchars($match['adversaire']) ?></td>
                        <td><?= htmlspecialchars($match['lieu']) ?></td>
                        <td><?= htmlspecialchars($match['resultat']) ?></td>
                        <td><?= htmlspecialchars($match['poste']) ?></td>
                        <td><?= $match['estTitulaire'] ? 'Oui' : 'Non' ?></td>
                        <td><?= number_format($match['note'], 2) ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </section>
        <?php } ?>
    </article>
</div>