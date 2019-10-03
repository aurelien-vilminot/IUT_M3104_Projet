<form method="POST">
    <label>Nom d'utilisateur</label>
    <input type="text" placeholder="Entrer un nom d'utilisateur" name="login" required>

    <label>E-mail</label>
    <input type="text" placeholder="Entrer un e-mail" name="mail" required>

    <label>Mot de passe</label>
    <input type="password" placeholder="Entrer un mot de passe" name="password" required>

    <label>Vérification du mot de passe</label>
    <input type="password" placeholder="Vérifier le mot de passe" name="check_password" required>

    <p class="error"><?php echo (isset($error_login)) ? $error_login : ''; ?></p>
    <p class="error"><?php echo (isset($error_email)) ? $error_email : ''; ?></p>
    <p class="error"><?php echo (isset($error_password)) ? $error_password : ''; ?></p>

    <input type="submit" id="submit" name="register" value="Inscription">
</form>