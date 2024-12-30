<!DOCTYPE html>
<html>
<head>
    <title>Page d'accueil</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="../resources/style/style.css"/>
</head>
<body>

<?php require "../components/nav.php" ?>

<div class="main">
    <section>
        <h1>
            Bienvenue <?php echo $post['nom'] ?>
        </h1>
        <p></p>
    </section>
    <section>
        <h1>
            Voir vos derniers résultats
        </h1>
    </section>
</div>
</body>