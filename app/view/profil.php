<div class="profil">
    <p>Bonjour <?=$id?> !<br>
        Voici vos informations : <br><br>
        Mail : <?=$mail?></p>

    <div class="modif">
        <div>
            <?php
                if ($myUser->isAdmin())
                {
            ?>
            <h3>Modification de votre identifiant :<br></h3>
            <form method="post">
                <input type="text" placeholder="Entrez un nouvel identifiant" name="login" pattern=".{0,15}" required>
                <?php
                if (isset($error_login))
                    echo <<<EOT
<p class="error">$error_login</p>
EOT;
                ?>
                <input type="submit" class="littleSubmitBox" name="submit_login" value="Modifier">
            </form>
            <?php
                }
            ?>
            <h3>Modification de votre mail :<br></h3>
            <form method="post">
                <input type="email" placeholder="Entrez une nouvelle adresse mail" name="mail" required>
                <?php
                if (isset($error_email))
                    echo <<<EOT
<p class="error">$error_email</p>
EOT;
                ?>
                <input type="submit" class="littleSubmitBox" name="submit_mail" value="Modifier">
            </form>
        </div>
        <div>
            <h3>Modification de votre mot de passe :</h3>
            <form method="post">
                <input type="password" placeholder="Entrez votre mot de passe actuel" name="old_password" pattern=".{8,}" required>
                <input type="password" placeholder="Entrez un nouveau mot de passe" name="password" pattern=".{8,}" required>
                <input type="password" placeholder="Verifiez le nouveau mot de passe" name="check_password" pattern=".{8,}" required>
                <?php
                if (isset($error_password))
                    echo <<<EOT
<p class="error">$error_password</p>
EOT;
                ?>
                <input type="submit" class="littleSubmitBox" name="submit_password" value="Modifier">
            </form>
        </div>
    </div>

    <?php
    if (isset($validate))
        echo <<<EOT
<p class="validate">$validate</p>
EOT;
    ?>
</div>
