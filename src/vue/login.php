<div class="login">
    <h1>Connexion</h1>
    <form method="post" action="/login" class="login">
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
        </div>
        <?php if(isset($_COOKIE['login_error'])): ?>
            <p class="error"><?= $_COOKIE['login_error'] ?></p>
        <?php endif; ?>
        <input type="submit" value="Se connecter">
    </form>
</div>