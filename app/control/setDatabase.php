<?php
    if(!isset($_SESSION['CurrentUser']))
        header("Location: index.php?page=login");
    else
    {
        $myUser = unserialize($_SESSION['CurrentUser']);
        if (!$myUser->isAdmin())
            header("Location: index.php");
    }

    if ($myUser->isAdmin() && isset($_GET['action']) && $_GET['action'] == 'resetDatabase')
    {
        $myReset = new setDatabase();
        $myReset->resetDB();

        for ($i = 0 ; $i < 6 ; ++$i)
        {
            $login = $myReset->ParseJSONFile('Users', $i,'Login');
            $mail = $myReset->ParseJSONFile('Users', $i,'Mail');
            $password = password_hash($myReset->ParseJSONFile('Users',$i,'Password'), PASSWORD_DEFAULT);
            $isAdmin = $myReset->ParseJSONFile('Users', $i,'Admin');
            $myReset->sendUser($login, $mail, $password, $isAdmin);
        }
        for ($i = 0 ; $i < 10 ; ++$i)
        {
            $title = $myReset->ParseJSONFile('Discussions', $i,'Title');
            $myReset->sendDiscussion($title);
        }
        header('Location: index.php?page=logout.php');
    }

    require '../app/view/setDatabase.php';
