<form action="" method="POST">
    <label>Nom d'utilisateur</label>
    <input type="text" placeholder="Entrez votre nom d'utilisateur" name="login" required>
    <label>Mot de passe</label>
    <input type="password" placeholder="Entrez votre mot de passe" name="password">
    <?php
        if (isset($error))
            echo <<<EOT
<p class="error">$error</p>
EOT;
    ?>
    <input type="submit" id="littleSubmitBox" name="submit" value="S'identifier">
    <input type="submit" name="lost_password" value="Mot de passe oublié ?">
</form>