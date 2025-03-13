<?php require "../components/nav.php" ?>

<div class="main div-column">
    <article class="article-list">
        <h1>Ajouter un match</h1>
        <section class="full">
            <h3>Entrez les informations du match à ajouter</h3>
            <form action="gerermatch.php" method="post">
                <div class="form-row">
                    <label for="datetime">Date du match</label>
                    <input type="datetime-local" id="datetime" name="datetime" required>
                </div>
                <div class="form-row">
                    <label for="lieu">Lieu du match</label>
                    <select id="lieu" name="lieu" required>
                        <?php foreach (Lieu::cases() as $lieu) { ?>
                            <option value="<?= $lieu->name ?>"><?= htmlspecialchars($lieu->name) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-row">
                    <label for="adversaire">Adversaire</label>
                    <input type="text" id="adversaire" name="adversaire" placeholder="Nom de l'adversaire" required>
                </div>

                <input type="hidden" name="idMatch" value="<?= 0 ?>">
                <input type="hidden" name="type" value="ajout">
                <input type="hidden" name="csrf_token" value="<?=htmlspecialchars(hash_hmac("sha256","0".$_SESSION['csrf_token']."ajout",$_SESSION['csrf_token']))?>">
                <button type="submit" class="ajout">Ajouter le match</button>
            </form>
        </section>
    </article>
</div>