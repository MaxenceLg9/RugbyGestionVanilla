<?php require "../components/nav.php" ?>

<div class="main div-column">
    <h1>Modifier un joueur</h1>
    <section class="full">
        <h3>Entrez les informations du joueur à modifier</h3>
        <h3>Joueur : <?= htmlspecialchars($joueur->getNom() . " " . $joueur->getPrenom()) ?></h3>
        <form action="gererjoueur.php" method="post">
            <!-- Nom -->
            <div class="form-row">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" required value="<?= htmlspecialchars($joueur->getNom()) ?>">
            </div>

            <!-- Prénom -->
            <div class="form-row">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" required value="<?= htmlspecialchars($joueur->getPrenom()) ?>">
            </div>

            <!-- Date de naissance -->
            <div class="form-row">
                <label for="dateNaissance">Date de naissance</label>
                <input type="date" id="dateNaissance" name="dateNaissance" required value="<?= htmlspecialchars($joueur->getDateNaissance()->format('Y-m-d')) ?>">
            </div>

            <!-- Numéro de licence -->
            <div class="form-row">
                <label for="numeroLicense">Numéro de licence</label>
                <input type="text" id="numeroLicense" name="numeroLicense" required value="<?= htmlspecialchars($joueur->getNumeroLicense()) ?>">
            </div>

            <!-- Taille -->
            <div class="form-row">
                <label for="taille">Taille (cm)</label>
                <input type="number" id="taille" name="taille" min="0" required value="<?= htmlspecialchars($joueur->getTaille()) ?>">
            </div>

            <!-- Poids -->
            <div class="form-row">
                <label for="poids">Poids (kg)</label>
                <input type="number" id="poids" name="poids" min="0" required value="<?= htmlspecialchars($joueur->getPoids()) ?>">
            </div>

            <!-- Statut -->
            <div class="form-row">
                <label for="statut">Statut</label>
                <select id="statut" name="statut" required>
                    <?php foreach (Statut::cases() as $statutOption) { ?>
                        <option value="<?= $statutOption->name ?>" <?= $joueur->getStatut() === $statutOption ? 'selected' : '' ?>>
                            <?= htmlspecialchars($statutOption->name) ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <!-- Poste préféré -->
            <div class="form-row">
                <label for="postePrefere">Poste préféré</label>
                <input type="text" id="postePrefere" name="postePrefere" required value="<?= htmlspecialchars($joueur->getPostePrefere()) ?>">
            </div>

            <!-- Est première ligne -->
            <div class="form-row">
                <label for="estPremiereLigne">Est première ligne</label>
                <select id="estPremiereLigne" name="estPremiereLigne" required>
                    <option value="1" <?= $joueur->getEstPremiereLigne() ? 'selected' : '' ?>>Oui</option>
                    <option value="0" <?= !$joueur->getEstPremiereLigne() ? 'selected' : '' ?>>Non</option>
                </select>
            </div>

            <!-- Hidden fields -->
            <input type="hidden" name="idJoueur" value="<?= htmlspecialchars($joueur->getIdJoueur()) ?>">
            <input type="hidden" name="type" value="modification">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(password_hash($joueur->getIdJoueur() . $_SESSION['csrf_token'] . "modification", PASSWORD_BCRYPT)) ?>">

            <!-- Submit button -->
            <button type="submit" class="ajout">Modifier le joueur</button>
        </form>
    </section>
</div>

