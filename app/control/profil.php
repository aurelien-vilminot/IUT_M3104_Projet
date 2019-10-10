<?php
    if(!isset($_SESSION['user']) && $_SESSION['user'] != 1)
        header("Location: index.php?page=login");

    require_once '../app/model/user.php';

    $myUser =  $_SESSION['CurrentUser'];
    echo $myUser->getmail();
