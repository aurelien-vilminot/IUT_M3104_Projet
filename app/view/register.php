<form action="verifReg.php" method="POST">
    <label><b>Nom d'utilisateur</b></label>
    <input type="text" placeholder="Entrer un nom d\'utilisateur" name="Username" required>

    <label><b>E-mail</b></label>
    <input type="text" placeholder="Entrer un e-mail" name="email" required>

    <label><b>Mot de passe</b></label>
    <input type="password" placeholder="Entrer un mot de passe" name="Password" required>

    <label><b>Vérification du mot de passe</b></label>
    <input type="password" placeholder="Vérifier le mot de passe" name="VerifPassword" required>

    <input type="submit" id="submit" value="LOGIN">
</form>