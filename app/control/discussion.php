<?php
    if (!isset($_GET['id']))
        header('Location: index.php');

    //require_once '../app/model/discussion.php';
    //require_once '../app/model/user.php';

    $nbMessagesMax = 10;

    $myDiscussion = new discussion($_GET['id']);

    if($myDiscussion->isExist() == 0)
        header('Location: index.php');

    if (isset($_SESSION['CurrentUser']))
    {
        $myUser = unserialize($_SESSION['CurrentUser']);

        if (isset($_POST['submit']) || isset($_POST['submit_close']))
        {
            $messageContent = $_POST['message'];
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

        if ($myUser->isAdmin())
        {
            if (isset($_GET['action']) && $_GET['action'] == 'close_discussion')
            {
                $myDiscussion->setState(0);
            }

            if (isset($_GET['action']) && $_GET['action'] == 'delete_discussion')
            {
                $myDiscussion->delete();
                header('Location: index.php');
            }

            if (isset($_GET['action']) && $_GET['action'] == 'delete_message' && isset($_GET['id_message']))
            {
                $myUser = unserialize($_SESSION['CurrentUser']);

                if ($myUser->isMessageExist($_GET['id_message']) != 0)
                {
                    $myUser->deleteMessage($_GET['id_message']);
                }
                else
                    header('Location : index.php');
            }
        }
    }

    $tabMessages = $myDiscussion->getAllMessages();

    if (!isset($_GET['action']) && count($tabMessages) == $nbMessagesMax)
        $myDiscussion->setState(0);
    elseif(isset($_GET['action']) && $_GET['action'] != 'close_discussion')
        $myDiscussion->setState(1);

    $stateDiscussion = $myDiscussion->getState();

    require '../app/view/discussion.php';
