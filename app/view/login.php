<form action="" method="POST">
    <label>Nom d'utilisateur</label>
    <input type="text" placeholder="Entrer le nom d'utilisateur" name="login" required>

    <label>Mot de passe</label>
    <input type="password" placeholder="Entrer le mot de passe" name="password">

    <?php
        if (isset($error_user_not_found))
            echo <<<EOT
<p class="error">$error_user_not_found</p>
EOT;
        elseif (isset($error_password))
            echo <<<EOT
<p class="error">$error_password</p>
EOT;
    ?>

    <input type="submit" name="submit" value="S'identifier">
    <input type="submit" name="lost_password" value="Mot de passe oublié ?">
</form>