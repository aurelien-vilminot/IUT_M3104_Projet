<?php
if (isset($_SESSION['CurrentUser']) && $myUser->isAdmin())
{
    echo '<a href="index.php?page=setDatabase&action=resetDatabase" class="warning">• Réinitialiser la base de données •</a>';
}
