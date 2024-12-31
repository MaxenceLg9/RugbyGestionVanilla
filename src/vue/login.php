<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Connexion</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="../resources/style/login.css"/>
</head>
<body>
<div class="login">
    <h1>Connexion</h1>
    <form method="post" action="login.php" class="login">
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
        </div>
        <input type="submit" value="Se connecter">
    </form>
</div>
</body>
</html>
