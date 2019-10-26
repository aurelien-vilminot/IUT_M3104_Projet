<?php
    $myHome = new home();
    $nbDiscussions = $myHome->getNbDiscussions();
    $nbDiscussionsByPages = $myHome->ParseJSONFile('settings_website','nbDiscussionsByPage');
    $nbMaxDiscussions = $myHome->ParseJSONFile('settings_website','nbMaxDiscussions');

    if ($nbDiscussions != 0)
    {
        $nbDiscussionsPages = ceil($nbDiscussions/$nbDiscussionsByPages);

        if(isset($_GET['pages']) && !empty($_GET['pages']) && preg_match('/^[1-9]+([0-9]+)*$/', $_GET['pages']))
        {
            $page_disc = $myHome->clean(trim($_GET['pages']));

            if($page_disc > $nbDiscussionsPages)
                $page_disc = $nbDiscussionsPages;
        }
        else
            $page_disc = 1;

        $firstDiscussion = ($page_disc - 1) * $nbDiscussionsByPages;
    }
    else
    {
        $firstDiscussion = 0;
        $nbDiscussionsPages = 1;
        $page_disc = 1;
    }

    $tabDisc = $myHome->getDiscussions($firstDiscussion, $nbDiscussionsByPages);


    if (isset($_SESSION['CurrentUser']))
    {
        $myUser = unserialize($_SESSION['CurrentUser']);
        $userLogin = $myUser->getLogin();

        if (isset($_POST['newDiscussion']) && !empty(trim($_POST['titleDiscussion'])))
        {
            $title = $myUser->clean($_POST['titleDiscussion']);

            if ($nbDiscussions + 1 > $nbMaxDiscussions)
                $error = 'Désolé, le nombre limite de discussions est atteint.';
            else
            {
                if (preg_match('/^[a-zA-Z0-9\s._-]{2,15}$/', $title))
                {
                    $myHome->createDiscussion($title);
                    $id = $myHome->lastDiscussion();
                    header('Location: discussion-' . $id);
                }
                else
                    $error = 'Le titre doit être composé de 2 à 15 caractères, sans caractères spéciaux';
            }
        }
    }

    if (isset($_GET['action'], $_GET['object']) && $_GET['action'] == 'validation' && !empty($_GET['object']))
    {
        $subject = 'Confirmation';

        if ($_GET['object'] == 'mail')
            $object = $myHome->ParseJSONFile('Confirmations', 'mail');
        elseif ($_GET['object'] == 'suppr_disc')
            $object = $myHome->ParseJSONFile('Confirmations', 'suppr_discussion');
    }

    require '../app/view/home.php';

