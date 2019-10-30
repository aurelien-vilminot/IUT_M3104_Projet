<?php
    $myHome = new home();
    $nbDiscussions = $myHome->getNbDiscussions();           // Nombre de discussions
    $nbDiscussionsByPages = $myHome->ParseJSONFile('settings_website','nbDiscussionsByPage');           // Récupération du nombre de discussions par pages dans le .JSON
    $nbMaxDiscussions = $myHome->ParseJSONFile('settings_website','nbMaxDiscussions');                  // Récupération du nombre maximum discussions dans le .JSON

    if ($nbDiscussions != 0)        // Pagination
    {
        $nbDiscussionsPages = ceil($nbDiscussions/$nbDiscussionsByPages);       // Nombre de page pour afficher toutes les discussions

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
    else            // S'il n'y pas de discussion créée
    {
        $firstDiscussion = 0;
        $nbDiscussionsPages = 1;
        $page_disc = 1;
    }

    $tabDisc = $myHome->getDiscussions($firstDiscussion, $nbDiscussionsByPages);        // Récupération de toutes les discussions pour la page en question

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
                    $myHome->createDiscussion($title);      // Création d'une nouvelle discussion
                    $id = $myHome->lastDiscussion();
                    header('Location: discussion-' . $id);      // Redirige l'utilisateur directement sur cette nouvelle discussion
                }
                else
                    $error = 'Le titre doit être composé de 2 à 15 caractères, sans caractères spéciaux';
            }
        }
    }

    if (isset($_GET['action'], $_GET['object']) && $_GET['action'] == 'validation' && !empty($_GET['object']))          // Pour l'affichage de popup
    {
        $subject = 'Confirmation';

        if ($_GET['object'] == 'mail')
            $object = $myHome->ParseJSONFile('Confirmations', 'mail');                  // Récupération de la confirmation pour l'envoi d'un mail dans le .JSON
        elseif ($_GET['object'] == 'suppr_disc')
            $object = $myHome->ParseJSONFile('Confirmations', 'suppr_discussion');      // Récupération de la confirmation de suppression d'une discussion dans le .JSON
    }

    require '../app/view/home.php';

