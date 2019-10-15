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
        $myUser->create_message($messageContent, 1, $myDiscussion->getIdDiscussion());
    }

    $tabMessages = $myDiscussion->getAllMessages();


    require '../app/view/discussion.php';
