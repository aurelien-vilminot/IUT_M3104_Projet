<form action="verifReg.php" method="POST">
    <label><b>Nom d'utilisateur</b></label>
    <input type="text" placeholder="Entrer un nom d\'utilisateur" name="Username" required>

    <label><b>E-mail</b></label>
    <input type="text" placeholder="Entrer un e-mail" name="mail" required>

    <label><b>Mot de passe</b></label>
    <input type="password" placeholder="Entrer un mot de passe" name="password" required>

    <label><b>Vérification du mot de passe</b></label>
    <input type="password" placeholder="Vérifier le mot de passe" name="check_password" required>

    <input type="submit" id="submit" name="action" value="Inscription">
</form>