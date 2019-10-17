<?php
    if (!isset($_GET['id']))
        header('Location: index.php');

    require_once '../app/model/discussion.php';
    require_once '../app/model/user.php';

    $myDiscussion = new Discussion($_GET['id']);

    $nbMessagesMax = 10;

    if($myDiscussion->isExist() == 0)
        header('Location: index.php');


    if (isset($_POST['submit']) || isset($_POST['submit_close']))
    {
        $messageContent = $_POST['message'];
        //$myUser = new User($_SESSION['CurrentUser']);
        $myUser = unserialize($_SESSION['CurrentUser']);
        $nbWord = explode(' ', $messageContent);

        if ($myDiscussion->isEmpty() != 0)
        {
            if ($myDiscussion->isLastMessageClose() == '0')
            {
                if (count($nbWord) <= 2)
                {
                    if (isset($_POST['submit']))
                        $myUser->create_message($messageContent, 1, $myDiscussion->getIdDiscussion());
                    elseif (isset($_POST['submit_close']))
                        $myUser->create_message($messageContent, 0, $myDiscussion->getIdDiscussion());
                }
                else
                    $error_message = 'Vous ne pouvez entrer qu\'un ou deux mots';
            }
            else
            {
                if ($myUser->authorizedUpdateMessage($myDiscussion->getLastMessage()) == 0)
                {
                    if (count($nbWord) <= 2)
                    {
                        if (isset($_POST['submit']))
                            $myUser->update_message($myDiscussion->getLastMessage(),$messageContent);
                        elseif (isset($_POST['submit_close']))
                            $myUser->update_close_message($myDiscussion->getLastMessage(), $messageContent);
                    }
                    else
                        $error_message = 'Vous ne pouvez entrer qu\'un ou deux mots';
                }
                else
                    $error_user_message = 'Désolé, vous êtes déjà intervenus dans ce message';
            }
        }
        else
        {
            if (count($nbWord) <= 2)
            {
                if (isset($_POST['submit']))
                    $myUser->create_message($messageContent, 1, $myDiscussion->getIdDiscussion());
                elseif (isset($_POST['submit_close']))
                    $myUser->create_message($messageContent, 0, $myDiscussion->getIdDiscussion());
            }
            else
                $error_message = 'Vous ne pouvez entrer qu\'un ou deux mots';
        }
    }

    $tabMessages = $myDiscussion->getAllMessages();

//    foreach ($tabMessages as &$message)
//    {
//        $message['USERS'] = [$myDiscussion->getUsersMessage($message['ID'])[0][0]];
//        for ($i = 1 ; $i < count($myDiscussion->getUsersMessage($message['ID'])) ; ++$i)
//        {
//            $message['USERS'] += [$myDiscussion->getUsersMessage($message['ID'])[0][$i]];
//        }
//    }
//
//    print_r($tabMessages);

    if (count($tabMessages) == $nbMessagesMax)
        $myDiscussion->setState(0);

    $stateDiscussion = $myDiscussion->getState();

    require '../app/view/discussion.php';
