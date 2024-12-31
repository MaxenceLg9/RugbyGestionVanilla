<?php require "../components/nav.php" ?>

<div class="main">
    <section>
        <form action="gerermatch.php" method="post">
            <label for="datetime">Date du match</label>
            <input type="datetime-local" id="datetime" name="datetime" required>

            <label for="lieu">Lieu du match</label>
            <label>
                <select name="lieu">
                    <option value="Exterieur">Exterieur</option>
                    <option value="Domicile" selected>Domicile</option>
                </select>
            </label>

            <label for="adversaire">Adversaire</label>
            <input type="text" id="adversaire" name="adversaire" required>

            <input type="hidden" name="type" value="ajout">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
            <button type="submit" class="ajout">Ajouter le match</button>
        </form>
    </section>
</div>