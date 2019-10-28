<?php
    if (!isset($error_token))
    {
        if ($setNewPassword == 1)
        {
            ?>
            <form action="" method="POST">
                <label>Mot de passe</label>
                <input type="password" placeholder="Entrez un nouveau mot de passe" name="password" pattern=".{8,}"
                       required>

                <label>Vérification du mot de passe</label>
                <input type="password" placeholder="Vérifiez le nouveau mot de passe" name="check_password"
                       pattern=".{8,}" required>

                <?php
                if (isset($error))
                    echo <<<EOT
<p class="error">$error</p>
EOT;
                ?>

                <input type="submit" id="littleSubmitBox" name="submitNewPassword" value="Modifier">
            </form>
            <?php
        }
        elseif (!$setNewPassword)
        {
            ?>
            <form action="" method="POST">
                <label>E-mail</label>
                <input type="email" placeholder="Entrez votre adresse e-mail" name="mail" required>

                <?php
                if (isset($error))
                    echo <<<EOT
<p class="error">$error</p>
EOT;
                ?>

                <input type="submit" name="submitMail" value="Envoyer un e-mail de récupération de mot de passe">
            </form>
            <?php
        }
        else
            echo '<p>Votre motre de passe a bien été modifié. Allez sur la page d\'<a href="home">accueil</a> et vous serez automatiquement connecté.</p>';
    }
    else
        echo <<<EOT
<p class="error">$error_token</p>
EOT;
        ?>