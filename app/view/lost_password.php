<?php
    if (!isset($error_token))
    {
        if ($setNewPassword)
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

                <input type="submit" name="submit" value="Envoyer un e-mail de récupération de mot de passe">
            </form>
            <?php
        }
        else
        {
            ?>
            <form action="" method="POST">
                <label>E-mail</label>
                <input type="email" placeholder="Entrez votre adresse email" name="mail" required>

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
    }
    else
        echo <<<EOT
<p class="error">$error_token</p>
EOT;
        ?>