<div class="login">
    <h1>Inscription</h1>
    <form method="post" action="../controleur/register.php" class="login">
        <div>
            <label for="firstname">Prenom</label>
            <input type="text" id="firstname" name="firstname" required>

            <label for="name">Nom</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="equipe">Nom de l'equipe</label>
            <input type="text" id="equipe" name="equipe" required>

            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>

            <label for="confirmpassword">Confirmer le mot de passe</label>
            <input type="password" id="password" name="confirmpassword" required>
        </div>
        <?php if(isset($_COOKIE["register_error"])){ ?>
            <div class="error">
                <?php echo $_COOKIE["register_error"]; ?>
            </div>
        <?php } ?>
        <input type="submit" value="Se connecter">
    </form>
</div>