<?php
    if(isset($_SESSION['user']) && $_SESSION['user'] == 1)
    {
        require_once '../app/model/user.php';
        //require_once '../app/model/discussions.php';

        $_SESSION['CurrentUser'] = new User($_SESSION['loginCurrentUser']);
        $myUser = $_SESSION['CurrentUser'];
        $id = $myUser->getLogin();
   }
//
//    $myDiscussions = new Discussion($myUser->getDataBase());
//    $tabDisc = $myDiscussions->getAllDiscussion();

    require '../app/view/home.php';

