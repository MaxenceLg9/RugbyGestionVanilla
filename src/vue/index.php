<!DOCTYPE html>
<html>
<head>
    <title>Page d'accueil</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="../resources/style/style.css"/>
</head>
<body>
<nav>
    <ul>
        <li><a href="#">Mon équipe</a></li>
        <li><a href="#">Matchs</a></li>
        <li><a href="#">Résultats</a></li>
        <li><a href="#">Mon profil</a></li>
    </ul>
    <ul>
        <li><a href="#">Se déconnecter</a></li>
    </ul>
</nav>
<div class="main">
    <section>
        <h1>
            Bienvenue <?php echo $post['nom'] ?>
        </h1>
        <p></p>
    </section>
    <section>
        <p>Voir vos derniers résultats</p>
    </section>
</div>
</body>