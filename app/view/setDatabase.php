<p id="alertBD">Attention, cela va supprimer le contenu de la base de données dans son <strong>intégrité</strong> y compris les <strong>comptes</strong>. À la suite de cette suppression, un nouveau jeu de test sera inséré dans la base de données.<br><br>
    Vous allez être déconnecté de votre compte puis vous serez automatiquement redirigé vers la page de connexion.</p>
<?php
if (isset($_SESSION['CurrentUser']) && $myUser->isAdmin())
{
    echo '<a href="setDatabase-resetDatabase" class="warning">• Réinitialiser la base de données •</a>';
}
