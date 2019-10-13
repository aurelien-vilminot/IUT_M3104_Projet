<?php
    require_once '../app/model/home.php';

    $nbDiscussionsByPages = 2;

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

require '../app/view/home.php';

