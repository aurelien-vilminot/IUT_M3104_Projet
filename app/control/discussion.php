<?php
    if (!isset($_GET['id']))
        header('Location: index.php');

    require_once '../app/model/discussion.php';

    $myDiscussion = new Discussion($_GET['id']);
    $tabMessages = $myDiscussion->getAllMessages();

    require '../app/view/discussion.php';
