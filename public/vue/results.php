<?php require "../components/nav.php" ?>

<div class="main div-column">
    <header class="header-section">
        <h1>Statistiques de l'équipe</h1>
    </header>
    <article class="article-list">
        <section class="stats-globales">
            <h2>Statistiques globales</h2>
            <p>Total de matchs avec résultat : <?= $totalMatchs ?></p>
            <p>Matchs gagnés : <?= $gagnes ?> (<?= number_format($pourcentageGagnes, 2) ?>%)</p>
            <p>Matchs perdus : <?= $perdus ?> (<?= number_format($pourcentagePerdus, 2) ?>%)</p>
            <p>Matchs nuls : <?= $nuls ?> (<?= number_format($pourcentageNuls, 2) ?>%)</p>
        </section>

        <section class="recap-matchs">
            <h2>Récapitulatif des matchs</h2>
            <table>
                <thead>
                <tr>
                    <th>Date et Heure</th>
                    <th>Adversaire</th>
                    <th>Lieu</th>
                    <th>Résultat</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($matchs as $match) { ?>
                    <tr>
                        <td><?= htmlspecialchars($match->getDateHeure()->format('d/m/Y-H:i')) ?></td>
                        <td><?= htmlspecialchars($match->getAdversaire()) ?></td>
                        <td><?= htmlspecialchars($match->getLieu()->name) ?></td>
                        <td><?= htmlspecialchars($match->getResultat()->name) ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </section>

        <section class="stats-joueurs">
            <h2>Statistiques des joueurs</h2>
            <table>
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Statut</th>
                    <th>Poste préféré</th>
                    <th>Sélections (Titulaire)</th>
                    <th>Sélections (Remplaçant)</th>
                    <th>Moyenne des notes</th>
                    <th>% de matchs gagnés</th>
                    <th>Sélections consécutives</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($joueurs as $joueur) { ?>
                    <tr>
                        <td><?= htmlspecialchars($joueur['nom']) ?></td>
                        <td><?= htmlspecialchars($joueur['statut']) ?></td>
                        <td><?= htmlspecialchars(Poste::tryFromName($joueur['postePrefere'])->value) ?></td>
                        <td><?= $joueur['titulaire'] ?></td>
                        <td><?= $joueur['remplacant'] ?></td>
                        <td><?= number_format($joueur['moyenneNotes'], 2) ?></td>
                        <td><?= number_format($joueur['pourcentageMatchsGagnes'], 2) ?>%</td>
                        <td><?= $joueur['selectionsConsecutives'] ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </section>
    </article>
</div>