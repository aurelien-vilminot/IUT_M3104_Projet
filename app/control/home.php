<?php
    require_once '../app/model/home.php';
    require_once '../app/model/user.php';

    if (isset($_SESSION['user']) && $_SESSION['user'] == 1)
    {
        //$myUser = new User($_SESSION['CurrentUser']);
        $myUser = unserialize($_SESSION['CurrentUser']);
        $userLogin = $myUser->getLogin();
    }
    $nbDiscussionsByPages = 2;
    $nbMaxDiscussions = 10;

    $myHome = new Home();
    $nbDiscussions = $myHome->getNbDiscussions();

    $nbDiscussionsPages = ceil($nbDiscussions/$nbDiscussionsByPages);

    if(isset($_GET['disc']))
    {
        $page_disc = $_GET['disc'];

        if($page_disc > $nbDiscussionsPages)
        {
            $page_disc = $nbDiscussionsPages;
        }
    }
    else
        $page_disc = 1;

    $firstDiscussion = ($page_disc - 1) * $nbDiscussionsByPages;

    $tabDisc = $myHome->getDiscussions($firstDiscussion, $nbDiscussionsByPages);

    if (isset($_POST['newDiscussion']) && isset($_SESSION['user']) && $_SESSION['user'] == 1)
    {
        if ($nbDiscussions + 1 > $nbMaxDiscussions)
            $error_nb_discussions = 'Désolé, le nombre limite de discussions est atteint.';
        else
        {
            $myHome->createDiscussion($_POST['titleDiscussion']);
            $id = $myHome->lastDiscussion();
            header('Location: index.php?page=discussion&id=' . $id);
        }
    }

    require '../app/view/home.php';

