<?php require "../components/nav.php" ?>

<div class="main div-column">
    <article>
        <h1>Ajouter un joueur</h1>
        <section class="full">
            <h3>Entrez les informations du joueur à ajouter</h3>
            <form action="gererjoueur.php" method="post">
                <div class="form-row">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" placeholder="Nom du joueur" required>
                </div>
                <div class="form-row">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" placeholder="Prénom du joueur" required>
                </div>
                <div class="form-row">
                    <label for="dateNaissance">Date de naissance</label>
                    <input type="date" id="dateNaissance" name="dateNaissance" required>
                </div>
                <div class="form-row">
                    <label for="numeroLicense">Numéro de licence</label>
                    <input type="number" id="numeroLicense" name="numeroLicense" placeholder="Numéro de licence" required>
                </div>
                <div class="form-row">
                    <label for="taille">Taille (cm)</label>
                    <input type="number" id="taille" name="taille" placeholder="Taille en cm" required>
                </div>
                <div class="form-row">
                    <label for="poids">Poids (kg)</label>
                    <input type="number" id="poids" name="poids" placeholder="Poids en kg" required>
                </div>
                <div class="form-row">
                    <label for="statut">Statut</label>
                    <select id="statut" name="statut" required>
                        <?php foreach (Statut::cases() as $statut) { ?>
                            <option value="<?= $statut->name ?>"><?= htmlspecialchars($statut->name) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-row">
                    <label for="postePrefere">Poste préféré</label>
                    <select id="postePrefere" name="postePrefere" required>
                        <?php foreach (Poste::cases() as $poste) { ?>
                            <option value="<?= $poste->name?>"><?= htmlspecialchars($poste->value) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-row">
                    <label for="estPremiereLigne">Est première ligne</label>
                    <select id="estPremiereLigne" name="estPremiereLigne" required>
                        <option value="1">Oui</option>
                        <option value="0">Non</option>
                    </select>
                </div>
                <div class="form-row">
                    <label for="commentaire">Ajouter un commentaire sur le joueur (max 400carac.)</label>
                    <input type="text" class="textfield" name="commentaire" id="commentaire"/>
                </div>

                <input type="hidden" name="type" value="ajout">
                <input type="hidden" name="idJoueur" value="0">
                <input type="hidden" name="csrf_token"
                       value="<?=htmlspecialchars(password_hash("0".$_SESSION['csrf_token']."ajout",PASSWORD_BCRYPT))?>">

                <button type="submit" class="ajout">Ajouter le joueur</button>
            </form>
        </section>
    </article>
</div>
