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

    if (count($tabMessages) == $nbMessagesMax)
        $myDiscussion->setState(0);

    $stateDiscussion = $myDiscussion->getState();

    require '../app/view/discussion.php';

    <input type = 'submit' name = 'discussion_close' value = 'Fermer la discussion'>
    <input type = 'submit' name = 'discussion_open' value = 'Ouvrir la discussion'>
    <input type = 'submit' name = 'message_close' value = 'Clore le message'>
    <inout type = 'submit' name = 'message_open' value = 'Ouvrir le message'>
    }


    if (getAdmin())
    {
      if (isset[$_POST['message_open']])
      {
        ../model/message.php
        open_message($id_message);
      }
      if (isset[$_POST['message_close']])
      {
        ../model/message.php
        close_message($id_message);
      }
      if (isset[$_POST['discussion_close']])
      {
        close_discussion($id_discussion);
      }
      if (isset[$_POST['discussion_open']])
      {
        open_discussion($id_discussion)
      }
    }
