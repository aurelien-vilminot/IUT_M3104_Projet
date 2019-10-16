<?php
    if (!isset($_GET['id']))
        header('Location: index.php');

    require_once '../app/model/discussion.php';
    require_once '../app/model/user.php';

    $myDiscussion = new Discussion($_GET['id']);

    if(isset($_POST['submit']))
    {
        $messageContent = $_POST['message'];
        $myUser = new User($_SESSION['CurrentUser']);
        $nbWord = explode(' ', $messageContent);
        if (count($nbWord) <= 2)
            $myUser->create_message($messageContent, 1, $myDiscussion->getIdDiscussion());
        else
            $error_message = 'Vous ne pouvez entrer qu\'un ou deux mots';
    }
    elseif (isset($_POST['submit_close']))
    {
        $messageContent = $_POST['message'];
        $myUser = new User($_SESSION['CurrentUser']);
        $nbWord = explode(' ', $messageContent);
        if (count($nbWord) <= 2)
            $myUser->create_message($messageContent, 0, $myDiscussion->getIdDiscussion());
        else
            $error_message = 'Vous ne pouvez entrer qu\'un ou deux mots';
    }

    $tabMessages = $myDiscussion->getAllMessages();

    require '../app/view/discussion.php';
