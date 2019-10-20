<?php
    if (!isset($_GET['id']))
        header('Location: index.php');

    $myDiscussion = new discussion();

    $nbMaxMessages = $myDiscussion->ParseJSONFile('settings_website', 'nbMaxMessages');

    if (isset($_GET['id']) && !empty($_GET['id']) && preg_match('/^[1-9]+([0-9]+)*/', $_GET['id']))
    {
        $idPage = $myDiscussion->clean(trim($_GET['id']));
        $myDiscussion->setId($idPage);
        if($myDiscussion->isExist() == 0)
            header('Location: index.php');
    }
    else
        header('Location: index.php');

    if (isset($_SESSION['CurrentUser']))
    {
        $myUser = unserialize($_SESSION['CurrentUser']);

        if (isset($_POST['submit']) || isset($_POST['submit_close']) && !empty(trim($_POST['message'])))
        {
            $messageContent = $myUser->clean($_POST['message']);
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
                        $error = 'Vous ne pouvez entrer qu\'un ou deux mots';
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
                            $error = 'Vous ne pouvez entrer qu\'un ou deux mots';
                    }
                    else
                        $error = 'Désolé, vous êtes déjà intervenus dans ce message';
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
                    $error = 'Vous ne pouvez entrer qu\'un ou deux mots';
            }
        }

        if(isset($_GET['action']) && $_GET['action'] == 'changeLikeSate')
        {
            if($myDiscussion->isLiked($myUser->getLogin()))
            {
                $myDiscussion->unlike($myUser->getLogin());
            }
            else
                $myDiscussion->like($myUser->getLogin());
        }

        if ($myUser->isAdmin())
        {
            if (isset($_GET['action']) && $_GET['action'] == 'close_discussion')
                $myDiscussion->setState(0);

            if (isset($_GET['action']) && $_GET['action'] == 'delete_discussion')
            {
                $myDiscussion->delete();
                header('Location: index.php');
            }

            if (isset($_GET['action']) && $_GET['action'] == 'delete_message' && isset($_GET['id_message']) && !empty(trim($_GET['id_message'])) && preg_match('/^[1-9]+([0-9]+)*$/', $_GET['disc']))
            {
                $idMessage = $myUser->clean(trim($_GET['id_message']));
                if ($myUser->isMessageExist($idMessage) != 0)
                    $myUser->deleteMessage($idMessage);
                else
                    header('Location : index.php');
            }
        }
    }

    $tabMessages = $myDiscussion->getAllMessages();

    if (!isset($_GET['action']) && count($tabMessages) == $nbMaxMessages)
        $myDiscussion->setState(0);
    elseif(isset($_GET['action']) && $_GET['action'] != 'close_discussion')
        $myDiscussion->setState(1);

    $stateDiscussion = $myDiscussion->getState();
    $like = $myDiscussion->isLiked($myUser->getLogin());

    require '../app/view/discussion.php';
