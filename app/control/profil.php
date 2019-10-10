<?php
    if(!isset($_SESSION['user']) && $_SESSION['user'] != 1)
        header("Location: index.php?page=login");

    require_once '../app/model/user.php';

    $myUser =  new User($_SESSION['loginCurrentUser']);
    $id = $myUser->getLogin();
    $mail = $myUser->getMail();

    require '../app/view/profil.php';