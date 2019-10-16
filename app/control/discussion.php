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
        if ($myUser->authorizedUpdateMessage($myDiscussion->getLastMessage()) == 0)
        {
            if (count($nbWord) <= 2)
            {
                if ($myDiscussion->isLastMessageClose() == '0')
                    $myUser->create_message($messageContent, 1, $myDiscussion->getIdDiscussion());
                else
                    $myUser->update_message($myDiscussion->getLastMessage(), $messageContent);
            }
            else
                $error_message = 'Vous ne pouvez entrer qu\'un ou deux mots';
        }
        else
            $error_user_message = 'Désolé, vous êtes intervenus dans ce message';
    }
    elseif (isset($_POST['submit_close']))
    {
        $messageContent = $_POST['message'];
        $myUser = new User($_SESSION['CurrentUser']);
        $nbWord = explode(' ', $messageContent);
        if ($myUser->authorizedUpdateMessage($myDiscussion->getLastMessage()) == 0)
        {
            if (count($nbWord) <= 2)
                if ($myDiscussion->isLastMessageClose() == '0')
                    $myUser->create_message($messageContent, 0, $myDiscussion->getIdDiscussion());
                else
                    $myUser->update_close_message($myDiscussion->getLastMessage(), $messageContent);
            else
                $error_message = 'Vous ne pouvez entrer qu\'un ou deux mots';
        }
        else
            $error_user_message = 'Désolé, vous êtes intervenus dans ce message';
    }

    $tabMessages = $myDiscussion->getAllMessages();

    require '../app/view/discussion.php';
