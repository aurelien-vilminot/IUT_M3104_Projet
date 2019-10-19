<?php
    if(!isset($_SESSION['CurrentUser']))
        header("Location: index.php?page=login");
    else
    {
        $myUser = unserialize($_SESSION['CurrentUser']);
        if (!$myUser->isAdmin())
            header("Location: index.php");
    }

    $nbUsersByPage = 5;

    $myUsers = new users();
    $nbUsers = $myUsers->getNbUsers();

    $nbUsersPage = ceil($nbUsers/$nbUsersByPage);

    if(isset($_GET['users']) && !empty($_GET['users']) && preg_match('/^[0-9]*$/', $_GET['users']))
    {
        $page_users = $myUser->clean(trim($_GET['users']));

        if($page_users > $nbUsersPage)
            $page_users = $nbUsersPage;
    }
    else
        $page_users = 1;

    $firstUser = ($page_users - 1) * $nbUsersByPage;

    $tabUsers = $myUsers->getUsers($firstUser, $nbUsersByPage);

    require '../app/view/users.php';
