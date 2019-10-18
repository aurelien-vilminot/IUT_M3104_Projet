<form action="" method="POST">
    <label>E-mail</label>
    <input type="text" placeholder="Entrez votre adresse email" name="mail" required>

    <?php
    if (isset($error))
        echo <<<EOT
<p class="error">$error</p>
EOT;
    ?>

    <input type="submit" name="submit" value="Envoyer un e-mail de récupération de mot de passe">
</form>
