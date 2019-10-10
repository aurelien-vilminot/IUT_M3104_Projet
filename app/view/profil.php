<div class="profil">
    <p>Bonjour <?=$id?> !<br>
        Voici vos informations : <br><br>
        Mail : <?=$mail?><br<br><p>

    <div class="modif">
        <div class="modifMail">
            <h3>Modification de votre Mail :<br></h3>
            <form action="" method="post">
                <input type="text" placeholder="Entrez une nouvelle adresse mail" name="mail" required>
                <input type="submit" name="submit_mail" value="Modifier">
            </form>
        </div>
        <div class="modifPwd">
            <h3>Modification de votre mot de passe :</h3>
            <form action="" method="post">
                <input type="password" placeholder="Entrez un nouveau mot de passe" name="password" required>
                <input type="password" placeholder="Verifiez le nouveau mot de passe" name="check_password" required>
                <input type="submit" name="submit_password" value="Modifier">
            </form>
        </div>
    </div>

</div>
