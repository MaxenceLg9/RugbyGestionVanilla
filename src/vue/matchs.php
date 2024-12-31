<!DOCTYPE html>
<html>
<head>
    <title>Matchs</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="../resources/style/style.css"/>
</head>
<body>

<?php include_once "../components/nav.php" ?>

<div class="main">
    <?php
    foreach($matchs as $match){
        echo "<section>";
        echo "<h2>Match du ".$match['dateHeure']."</h2>";
        echo "<p>Adversaire: ".$match['adversaire']."</p>";
        echo "<p>Lieu: ".$match['lieu']."</p>";
        echo "<p>Résultat: ".$match['resultat']."</p>";
        echo "</section>";
    }
    ?>
</div>
</body>