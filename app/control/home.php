<?php
if(isset($_SESSION['user']) && $_SESSION['user'] == 1)
{
    require_once '../app/model/user.php';

    $_SESSION['CurrentUser'] = new User($_SESSION['loginCurrentUser']);
    echo $_SESSION['CurrentUser']->getLogin();
}
