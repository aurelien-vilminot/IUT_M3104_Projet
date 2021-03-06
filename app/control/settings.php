<?php
    if(!isset($_SESSION['CurrentUser']))            // Si l'utilisateur n'est pas connecté, redirection vers la page de connexion
        header('Location: login');
    else
    {
        $myUser = unserialize($_SESSION['CurrentUser']);
        if (!$myUser->isAdmin())
            header('Location: home');
    }

    $mySettings = new settings();
    $strConfigFile = $mySettings->JSONtoString();       // Conversion du fichier .JSON en string

    if($myUser->isAdmin())
    {
        if(isset($_POST['submit_nbMaxDiscussions']) && !empty(trim($_POST['nbMaxDiscussions'])))        // Changement du nombre maximum de discussions
        {
            if (preg_match('/^[1-9]+([0-9]+)*$/', $_POST['nbMaxDiscussions']))
            {
                $nbMaxDiscussions = $mySettings->clean(trim($_POST['nbMaxDiscussions']));
                $changeJSON = str_replace('"nbMaxDiscussions": ' . $mySettings->ParseJSONFile('settings_website','nbMaxDiscussions'),
                    '"nbMaxDiscussions": ' . $nbMaxDiscussions, $strConfigFile);
                $mySettings->setJSONFile($changeJSON);
                $validate = 'La valeur a bien été changée';
            }
            else
                $error_nbMaxDiscussions = 'Merci de saisir une valeur correcte (minimum 1)';
        }

        if(isset($_POST['submit_nbMaxMessages']) && !empty(trim($_POST['nbMaxMessages'])))              // Changement du nombre maximum de messages par discussions
        {
            if(preg_match('/^[1-9]+([0-9]+)*$/', $_POST['nbMaxMessages']))
            {
                $newNbMaxMessages = $mySettings->clean(trim($_POST['nbMaxMessages']));
                $changeJSON = str_replace('"nbMaxMessages": ' . $mySettings->ParseJSONFile('settings_website','nbMaxMessages'),
                    '"nbMaxMessages": ' . $newNbMaxMessages, $strConfigFile);
                $mySettings->setJSONFile($changeJSON);
                $validate = 'La valeur a bien été changée';
            }
            else
                $error_nbMaxMessages = 'Merci de saisir une valeur correcte (minimum 1)';
        }

        if(isset($_POST['submit_nbUsersByPage']) && !empty(trim($_POST['nbUsersByPage'])))              // Changement du nombre d'utlisateurs par page
        {
            if(preg_match('/^[1-9]+([0-9]+)*$/', $_POST['nbUsersByPage']))
            {
                $newNbUsersByPage = $mySettings->clean(trim($_POST['nbUsersByPage']));
                $changeJSON = str_replace('"nbUsersByPage": ' . $mySettings->ParseJSONFile('settings_website','nbUsersByPage'),
                    '"nbUsersByPage": ' . $newNbUsersByPage, $strConfigFile);
                $mySettings->setJSONFile($changeJSON);
                $validate = 'La valeur a bien été changée';
            }
            else
                $error_nbUsersByPage = 'Merci de saisir une valeur correcte (minimum 1)';
        }

        if(isset($_POST['submit_nbDiscussionsByPage']) && !empty(trim($_POST['nbDiscussionsByPage'])))           // Changement du nombre de discussions par page
        {
            if(preg_match('/^[1-9]+([0-9]+)*$/', $_POST['nbDiscussionsByPage']))
            {
                $newNbDiscussionsByPage = $mySettings->clean(trim($_POST['nbDiscussionsByPage']));
                $changeJSON = str_replace('"nbDiscussionsByPage": ' . $mySettings->ParseJSONFile('settings_website','nbDiscussionsByPage'),
                    '"nbDiscussionsByPage": ' . $newNbDiscussionsByPage, $strConfigFile);
                $mySettings->setJSONFile($changeJSON);
                $validate = 'La valeur a bien été changée';
            }
            else
                $error_nbDiscussionsByPage = 'Merci de saisir une valeur correcte (minimum 1)';
        }
    }

    // Récupération des valeurs dans le fichier .JSON
    $nbMaxDiscussions = $mySettings->ParseJSONFile('settings_website','nbMaxDiscussions');
    $nbMaxMessages = $mySettings->ParseJSONFile('settings_website','nbMaxMessages');
    $nbUsersByPage = $mySettings->ParseJSONFile('settings_website','nbUsersByPage');
    $nbDiscussionsByPage = $mySettings->ParseJSONFile('settings_website','nbDiscussionsByPage');

    require '../app/view/settings.php';
