<div>
    <h3>Profil - <?=$login?></h3>
</div>

<div>
    <p>Mail : <?=$mail?></p>
</div>

<div class="modif">
    <div class="modifMail">
        <h3>Modification du mail de l'utilisateur :<br></h3>
        <form action="" method="post">
            <input type="text" placeholder="Entrez une nouvelle adresse mail" name="mail" required>
            <?php
            if (isset($error_email))
                echo <<<EOT
<p class="error">$error_email</p>
EOT;
            ?>
            <input type="submit" name="submit_mail" value="Modifier">
        </form>
    </div>
    <div>
        <h3>Modification du rôle de l'utilisateur :</h3>
        <div class="modifState">
            <div class="stateAdmin">
                <?php
                    if ($admin)
                        echo <<<EOT
<img src="media/admin.png" alt="Logo admin" style="width: 5vw">
<img src="media/close_message.png" alt="Votre rôle" style="width: 2vw">
EOT;
                    else
                        echo <<<EOT
<a href="index.php?page=setUser&id=$login&action=changeState&value=1"><img src="media/admin.png" alt="Logo admin" style="width: 5vw"></a>
EOT;
                ?>
            </div>
            <div class="stateUser">
                <?php
                    if (!$admin)
                        echo <<<EOT
<img src="media/user.png" alt="Logo utilisateur" style="width: 5vw">
<img src="media/close_message.png" alt="Votre rôle" style="width: 2vw">
EOT;
                    else
                        echo <<<EOT
<a href="index.php?page=setUser&id=$login&action=changeState&value=0"><img src="media/user.png" alt="Logo utilisateur" style="width: 5vw"></a>
EOT;
                ?>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($validate))
    echo <<<EOT
<p class="validate">$validate</p>
EOT;
?>
