<?php
    if(isset($_SESSION['user']) && $_SESSION['user'] == 1)
    {
        require_once '../app/model/user.php';
        require_once '../app/model/discussions.php';

        $myUser = new User($_SESSION['loginCurrentUser']);
        $id = $myUser->getLogin();

        $myDiscussions = new Discussion($myUser->getDataBase());
        $tabDisc = $myDiscussions->getAllDiscussion();
    }

    require '../app/view/home.php';

