<?php
    if (!isset($_GET['id']))                // Vérification qu'un id de discussion existe
        header('Location: home');

    $myDiscussion = new discussion();

    $nbMaxMessages = $myDiscussion->ParseJSONFile('settings_website', 'nbMaxMessages');             // Récupération du nombre maximum de messages par discussion dans le .JSON

    if (isset($_GET['id']) && !empty($_GET['id']) && preg_match('/^[1-9]+([0-9]+)*$/', $_GET['id']))        // Vérification que l'id de la discussion est valide
    {
        $idPage = $myDiscussion->clean(trim($_GET['id']));
        $myDiscussion->setId($idPage);
        if(!$myDiscussion->isExist())           // Test d'existence de la discussion
            header('Location: home');
    }
    else
        header('Location: home');

    if (isset($_SESSION['CurrentUser']))        // Si l'utilisateur est connecté
    {
        $myUser = unserialize($_SESSION['CurrentUser']);

        if ((isset($_POST['submit']) || isset($_POST['submit_close'])) && !empty(trim($_POST['message'])))      // Si l'utilisateur a cliqué sur 'Envoyer' ou 'Envoyer et clore'
        {
            $messageContent = $myUser->clean($_POST['message']);
            $nbWord = explode(' ', $messageContent);           // On scinde son message en tableau en utilisant l'espace comme séparateur

            if ($myDiscussion->isEmpty() != 0)      // Test si la discussion n'est pas vide
            {
                if ($myDiscussion->isLastMessageClose() == '0')         // Test si le dernier message est clos
                {
                    if (count($nbWord) <= 2)        // Test si le message comporte maximum 2 mots
                    {
                        if (isset($_POST['submit']))
                            $myUser->create_message($messageContent, 1, $myDiscussion->getIdDiscussion());          // Création du message
                        elseif (isset($_POST['submit_close']))
                            $myUser->create_message($messageContent, 0, $myDiscussion->getIdDiscussion());          // Création du message puis fermeture de ce dernier
                    }
                    else
                        $error = 'Vous ne pouvez entrer qu\'un ou deux mots';
                }
                else            // Si le dernier message n'est pas clos
                {
                    if ($myUser->authorizedUpdateMessage($myDiscussion->getLastMessage()) == 0)         // Test si l'utilisateur n'est pas déjà intervenu dedans
                    {
                        if (count($nbWord) <= 2)            // Test si le message comporte maximum 2 mots
                        {
                            if (isset($_POST['submit']))
                                $myUser->update_message($myDiscussion->getLastMessage(),$messageContent);           // Mise à jour du message
                            elseif (isset($_POST['submit_close']))
                                $myUser->update_close_message($myDiscussion->getLastMessage(), $messageContent);    // Mise à jour du message et fermeture de ce dernier
                        }
                        else
                            $error = 'Vous ne pouvez entrer qu\'un ou deux mots';
                    }
                    else
                        $error = 'Désolé, vous êtes déjà intervenus dans ce message';
                }
            }
            else            // Si la discussion est vide
            {
                if (count($nbWord) <= 2)            // Test si le message comporte maximum 2 mots
                {
                    if (isset($_POST['submit']))
                        $myUser->create_message($messageContent, 1, $myDiscussion->getIdDiscussion());          // Création du message
                    elseif (isset($_POST['submit_close']))
                        $myUser->create_message($messageContent, 0, $myDiscussion->getIdDiscussion());          // Création du message puis fermeture de ce dernier
                }
                else
                    $error = 'Vous ne pouvez entrer qu\'un ou deux mots';
            }
        }

        if(isset($_GET['action']) && $_GET['action'] == 'changeLikeSate')           // Si l'utilisateur a appuyé sur le bouton de Like
        {
            if($myDiscussion->isLiked($myUser->getLogin()))         // Si la discussion est déjà likée par l'utilisateur
            {
                $myDiscussion->unlike($myUser->getLogin());         // Suppression du like
            }
            else
                $myDiscussion->like($myUser->getLogin());           // Sinon ajout d'un like
        }

        if ($myUser->isAdmin())         // Si l'utilisateur est administrateur
        {
            if (isset($_GET['action']) && $_GET['action'] == 'close_discussion')
                $myDiscussion->setState(0);                                     // Fermeture de la discussion

            if (isset($_GET['action']) && $_GET['action'] == 'open_discussion')
                $myDiscussion->setState(1);                                     // Ouvre la discussion de la discussion

            if (isset($_GET['action']) && $_GET['action'] == 'delete_discussion')
            {
                $myDiscussion->delete();                                            // Suppression de la discussion
                header('Location: home-validation-suppr_disc#validation');
            }

            if (isset($_GET['id_message']) && !empty(trim($_GET['id_message'])) && preg_match('/^[1-9]+([0-9]+)*$/', $_GET['id_message']))          // Vériication de la validité de l'id du message
            {
                $idMessage = $myUser->clean(trim($_GET['id_message']));

                if ($myUser->isMessageExist($idMessage) != 0)           // Vérification que le message existe bien
                {
                    if (isset($_POST['modify_message']) && !empty(trim($_POST['messageContent'])))
                    {
                        $messageContent = $myUser->clean(trim($_POST['messageContent']));
                        $myUser->modify_message($idMessage, $messageContent);                   // Modification complète de son contenu
                    }

                    if (isset($_GET['action']) && $_GET['action'] == 'delete_message')
                    {
                        $myUser->deleteMessage($idMessage);                                     // Suppression du message
                    }
                }
            }
        }

        $like = $myDiscussion->isLiked($myUser->getLogin());            // Récupère si l'utilisateur a dékà liké la discussion ou pas
    }

    $tabMessages = $myDiscussion->getAllMessages();         // Récupération de tous les messages de la discussion dans un tableau

    foreach ($tabMessages as $usersMessage)         // Récupération des expéditeurs pour chaque message
    {
        $tabUsersMessage[$usersMessage['ID']] =$myDiscussion->getUsersMessage($usersMessage['ID']);
    }

    if (!isset($_GET['action']) && count($tabMessages) >= $nbMaxMessages && $myDiscussion->isLastMessageClose() == 0)           // Si le nombre maximum de messages est atteint, fermeture de la discussion
        $myDiscussion->setState(0);

    $stateDiscussion = $myDiscussion->getState();           // On récupère le statut de le discussion

    require '../app/view/discussion.php';
