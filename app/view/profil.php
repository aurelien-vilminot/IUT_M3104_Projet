<p>Bonjour <?=$id?> !<br>
Voici vos informations : <br><br>
Mail : <?=$mail?><br>

Modification de votre Mail :<br></p>
<form action="" method="post">
    <label>Nouveau Mail</label>
    <input type="text" placeholder="Entrez une nouvelle adresse mail" name="mail" required>
    <input type="submit" name="submit_mail" value="Modifier">
</form>

<p>Modification de votre mot de passe :</p>
<form action="" method="post">
    <label>Nouveau mot de passe</label>
    <input type="password" placeholder="Entrez un nouveau mot de passe" name="password" required>
    <input type="password" placeholder="Verifiez le nouveau mot de passe" name="check_password" required>
    <input type="submit" name="submit_password" value="Modifier">
</form>