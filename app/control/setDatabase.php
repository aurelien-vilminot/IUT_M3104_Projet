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
    }

    require '../app/view/setDatabase.php';
