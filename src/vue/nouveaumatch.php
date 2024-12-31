<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un match</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="../resources/style/style.css"/>
</head>
<body>

<?php require "../components/nav.php" ?>

<div class="main">
    <section>
        <form>
            <label for="date">Date du match</label>
            <input type="date" id="date" name="date" required>

            <label for="heure">Heure du match</label>
            <input type="time" id="heure" name="heure" required>

            <label for="lieu">Lieu du match</label>
            <input type="text" id="lieu" name="lieu" required>

            <label for="adversaire">Adversaire</label>
            <input type="text" id="adversaire" name="adversaire" required>

            <label for="score">Score</label>
            <input type="text" id="score" name="score" required>

            <input type="submit" value="Ajouter le match">
        </form>

    </section>
</div>
</body>