<div class="profil">
    <p>Bonjour <?=$id?> !<br>
        Voici vos informations : <br><br>
        Mail : <?=$mail?></p>

    <div class="modif">
        <div>
            <h3>Modification de votre mail :<br></h3>
            <form action="" method="post">
                <input type="email" placeholder="Entrez une nouvelle adresse mail" name="mail" required>
                <?php
                if (isset($error_email))
                    echo <<<EOT
<p class="error">$error_email</p>
EOT;
                ?>
                <input type="submit" id="littleSubmitBox" name="submit_mail" value="Modifier">
            </form>
        </div>
        <div>
            <h3>Modification de votre mot de passe :</h3>
            <form action="" method="post">
                <input type="password" placeholder="Entrez votre mot de passe actuel" name="old_password" required>
                <input type="password" placeholder="Entrez un nouveau mot de passe" name="password" required>
                <input type="password" placeholder="Verifiez le nouveau mot de passe" name="check_password" required>
                <?php
                if (isset($error_password))
                    echo <<<EOT
<p class="error">$error_password</p>
EOT;
                ?>
                <input type="submit" id="littleSubmitBox" name="submit_password" value="Modifier">
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
