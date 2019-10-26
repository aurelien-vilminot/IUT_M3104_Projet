<?php
    if(!isset($_SESSION['CurrentUser']))
        header('Location: login');
    else
    {
        $myUser = unserialize($_SESSION['CurrentUser']);
        if (!$myUser->isAdmin())
            header('Location: home');
    }

    $myUsers = new users();
    $nbUsers = $myUsers->getNbUsers();
    $nbUsersByPage = $myUsers->ParseJSONFile('settings_website', 'nbUsersByPage');

    $nbUsersPage = ceil($nbUsers/$nbUsersByPage);

    if(isset($_GET['pages']) && !empty($_GET['pages']) && preg_match('/^[1-9]+([0-9]+)*$/', $_GET['pages']))
    {
        $page_users = $myUser->clean(trim($_GET['pages']));

        if($page_users > $nbUsersPage)
            $page_users = $nbUsersPage;
    }
    else
        $page_users = 1;

    $firstUser = ($page_users - 1) * $nbUsersByPage;

    $tabUsers = $myUsers->getUsers($firstUser, $nbUsersByPage);

    require '../app/view/users.php';
