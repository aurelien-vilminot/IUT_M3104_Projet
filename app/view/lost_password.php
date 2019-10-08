<form action="" method="POST">
    <label>E-mail</label>
    <input type="text" placeholder="Entrer votre adresse email" name="mail" required>

    <?php
    if (isset($error_user_not_found))
        echo <<<EOT
<p class="error">$error_user_not_found</p>
EOT;
    elseif (isset($error_mail))
        echo <<<EOT
<p class="error">$error_mail</p>
EOT;
    ?>

    <input type="submit" name="submit" value="Envoyer un e-mail de récupération de mot de passe">
</form>
