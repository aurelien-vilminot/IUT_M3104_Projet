<?php
    if(!isset($_SESSION['CurrentUser']))            // Si l'utilisateur n'est pas connecté, redirection vers la page de connexion
        header('Location: login');
    else
    {
        $myUser = unserialize($_SESSION['CurrentUser']);
        if (!$myUser->isAdmin())                    // Si l'utilisateur n'est pas administrateur, redirection vers la page d'accueil
            header('Location: home');
    }

    $myUsers = new users();
    $nbUsers = $myUsers->getNbUsers();
    $nbUsersByPage = $myUsers->ParseJSONFile('settings_website', 'nbUsersByPage');          // Récupération du nombre d'utilisateurs par pages dans le .JSON

    $nbUsersPage = ceil($nbUsers/$nbUsersByPage);           // Nombre de page pour afficher tous les utilisateurs

    if(isset($_GET['pages']) && !empty($_GET['pages']) && preg_match('/^[1-9]+([0-9]+)*$/', $_GET['pages']))
    {
        $page_users = $myUser->clean(trim($_GET['pages']));

        if($page_users > $nbUsersPage)
            $page_users = $nbUsersPage;
    }
    else
        $page_users = 1;

    $firstUser = ($page_users - 1) * $nbUsersByPage;

    $tabUsers = $myUsers->getUsers($firstUser, $nbUsersByPage);

    if (isset($_GET['action'], $_GET['object']) && $_GET['action'] == 'validation' && !empty($_GET['object']))          // Pour l'affichage de popup
    {
        $subject = 'Confirmation';

        if ($_GET['object'] == 'suppr_user')
            $object = $myUsers->ParseJSONFile('Confirmations', 'suppr_user');            // Récupération de la confirmation de suppression d'un utilisateur dans le .JSON
    }

    require '../app/view/users.php';
