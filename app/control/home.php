<?php
    if(isset($_SESSION['user']) && $_SESSION['user'] == 1)
    {
        require_once '../app/model/user.php';

        $myUser = new User($_SESSION['loginCurrentUser']);

        $id = $myUser->getLogin();
    }

    require '../app/view/home.php';

