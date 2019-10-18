<form method="POST">
    <label>Nom d'utilisateur</label>
    <input type="text" placeholder="Entrez un nom d'utilisateur" name="login" required>

    <label>E-mail</label>
    <input type="text" placeholder="Entrez un e-mail" name="mail" required>

    <label>Mot de passe</label>
    <input type="password" placeholder="Entrez un mot de passe" name="password" required>

    <label>Vérification du mot de passe</label>
    <input type="password" placeholder="Vérifiez le mot de passe" name="check_password" required>

    <?php
        if (isset($error))
            echo <<<EOT
<p class="error">$error</p>
EOT;
    ?>

    <input type="submit" id="submit" name="submit" value="Inscription">
</form>