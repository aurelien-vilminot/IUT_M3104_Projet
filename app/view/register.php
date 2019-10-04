<form method="POST">
    <label>Nom d'utilisateur</label>
    <input type="text" placeholder="Entrer un nom d'utilisateur" name="login" required>

    <label>E-mail</label>
    <input type="text" placeholder="Entrer un e-mail" name="mail" required>

    <label>Mot de passe</label>
    <input type="password" placeholder="Entrer un mot de passe" name="password" required>

    <label>Vérification du mot de passe</label>
    <input type="password" placeholder="Vérifier le mot de passe" name="check_password" required>

    <?php
        if (isset($error_login))
            echo <<<EOT
<p class="error">$error_login</p>
EOT;
        elseif (isset($error_email))
            echo <<<EOT
<p class="error">$error_email</p>
EOT;
        elseif (isset($error_password))
            echo <<<EOT
<p class="error">$error_password</p>
EOT;
    ?>

    <input type="submit" id="submit" name="submit" value="Inscription">
</form>