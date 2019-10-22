<?php
    if(!isset($_SESSION['CurrentUser']))
        header("Location: index.php?page=login");
    else
    {
        $myUser = unserialize($_SESSION['CurrentUser']);
        if (!$myUser->isAdmin())
            header("Location: index.php");
    }

    if ($myUser->isAdmin() && isset($_GET['action']) && $_GET['action'] == 'resetDatabase')
    {
        $myReset = new setDatabase();
        $myReset->resetDB();

        for ($i = 0 ; $i < 6 ; ++$i)
        {
            $login = $myReset->ParseJSONFile('Users', $i,'Login');
            $mail = $myReset->ParseJSONFile('Users', $i,'Mail');
            $password = password_hash($myReset->ParseJSONFile('Users',$i,'Password'), PASSWORD_DEFAULT);
            $isAdmin = $myReset->ParseJSONFile('Users', $i,'Admin');
            $myReset->sendUser($login, $mail, $password, $isAdmin);
        }

        for ($i = 0 ; $i < 10 ; ++$i)
        {
            $title = $myReset->ParseJSONFile('Discussions', $i,'Title');
            $myReset->sendDiscussion($title);
        }

        for ($i = 0 ; $i < 10 ; ++$i)
        {
            $content = $myReset->ParseJSONFile('Messages', $i, 'Content');
            $myReset->sendMessage($content, 0, 1);

            if ($i == 3 || $i == 5 || $i == 6)
            {
                $myReset->setUserMessageDB('user1', $i+1);
                $myReset->setUserMessageDB('user2', $i+1);
                $myReset->setUserMessageDB('user3', $i+1);
            }
            elseif ($i == 8)
                $myReset->setUserMessageDB('user1', $i+1);
            elseif ($i == 9)
                $myReset->setUserMessageDB('user2', $i+1);
            else
            {
                $myReset->setUserMessageDB('user1', $i+1);
                $myReset->setUserMessageDB('user2', $i+1);
            }
        }

        $compt = 10;
        for ($i = 0 ; $i < 6 ; ++$i)
        {
            $content = $myReset->ParseJSONFile('Messages', $i, 'Content');
            $myReset->sendMessage($content, 0, 2);

            if ($i == 3 || $i == 5)
            {
                $myReset->setUserMessageDB('user1', $compt+1);
                $myReset->setUserMessageDB('user2', $compt+1);
                $myReset->setUserMessageDB('user3', $compt+1);
            }
            else
            {
                $myReset->setUserMessageDB('user1', $compt+1);
                $myReset->setUserMessageDB('user2', $compt+1);
            }
            ++$compt;
        }

        $compt = 16;
        for ($i = 0 ; $i < 6 ; ++$i)
        {
            $content = $myReset->ParseJSONFile('Messages', $i, 'Content');
            if ($i == 5)
                $myReset->sendMessage($content, 1, 3);
            else
                $myReset->sendMessage($content, 0, 3);

            if ($i == 3 || $i == 5)
            {
                $myReset->setUserMessageDB('user1', $compt+1);
                $myReset->setUserMessageDB('user2', $compt+1);
                $myReset->setUserMessageDB('user3', $compt+1);
            }
            else
            {
                $myReset->setUserMessageDB('user1', $compt+1);
                $myReset->setUserMessageDB('user2', $compt+1);
            }
            ++$compt;
        }

        $discussionsLiked = array();
        while (count($discussionsLiked) < 6)
        {
            $id_discussion = mt_rand(1,10);

            while (in_array($id_discussion, $discussionsLiked))
                $id_discussion = mt_rand(1,10);

            $discussionsLiked[] = $id_discussion;

            $myReset->sendLike('user1', $id_discussion);
        }

        $discussionsLiked = array();
        while (count($discussionsLiked) < 4)
        {
            $id_discussion = mt_rand(1,10);

            while (in_array($id_discussion, $discussionsLiked))
                $id_discussion = mt_rand(1,10);

            $discussionsLiked[] = $id_discussion;

            $myReset->sendLike('user2', $id_discussion);
        }

        $discussionsLiked = array();
        while (count($discussionsLiked) < 3)
        {
            $id_discussion = mt_rand(1,10);

            while (in_array($id_discussion, $discussionsLiked))
                $id_discussion = mt_rand(1,10);

            $discussionsLiked[] = $id_discussion;

            $myReset->sendLike('user3', $id_discussion);
        }

        $discussionsLiked = array();
        while (count($discussionsLiked) < 2)
        {
            $id_discussion = mt_rand(1,10);

            while (in_array($id_discussion, $discussionsLiked))
                $id_discussion = mt_rand(1,10);

            $discussionsLiked[] = $id_discussion;

            $myReset->sendLike('user4', $id_discussion);
        }

        header('Location: index.php?page=logout');
    }

    require '../app/view/setDatabase.php';