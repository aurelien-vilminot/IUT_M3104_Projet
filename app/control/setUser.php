<?php
    if(!isset($_SESSION['CurrentUser']))            // Si l'utilisateur n'est pas connecté, redirection vers la page de connexion
        header('Location: login');
    else
    {
        $myUser = unserialize($_SESSION['CurrentUser']);
        if (!$myUser->isAdmin() || ($myUser->isAdmin() && $_GET['id'] == $myUser->getLogin()))          // Si l'utilisateur est admin et que ce n'est pas sa propre page de modification
            header('Location: home');
    }
    if ($myUser->isAdmin())
    {
        if (isset($_GET['id']) && !empty($_GET['id']))
        {
            $id = $myUser->clean(trim($_GET['id']));
            $mysetUser = new setUser($id);
            if ($mysetUser->isExist())      // Verifie que l'utilisateur a modifier existe bien
            {
                $updateUser = new user($id);

                if(isset($_POST['submit_mail']) && !empty(trim($_POST['mail'])))        // Modification d'adresse mail
                {
                    $newMail = $updateUser->clean(trim($_POST['mail']));

                    if (!$updateUser->regExpMail($newMail))
                        $error_email = 'Le format de l\'email n\'est pas valide';
                    else
                    {
                        if($updateUser->email_taken($newMail) == 1)
                            $error_email = 'L\'adresse email est déjà utilisée';
                        else
                        {
                            $updateUser->setMail($newMail);
                            $validate = 'Le nouvel e-mail a bien été enregistré !';
                        }
                    }
                }

                if (isset($_GET['action'], $_GET['value']) && $_GET['action'] == 'changeState' && preg_match('/^[0-1]$/', $_GET['value']))      // Modification du statut de l'utilisateur
                {
                    $updateUser->setAdmin($updateUser->clean(trim($_GET['value'])));
                    $validate = 'Le statut de l\'utilisateur a bien été modifié';
                }

                if (isset($_GET['action']) && $_GET['action'] == 'delete_user')     // Suppression de l'utilisateur
                {
                    $updateUser->delete();
                    header('Location: users-validation-suppr_user#validation');
                }

                // Récupération des informations sur l'utilisateur
                $login = $updateUser->getLogin();
                $mail = $updateUser->getMail();
                $admin = $updateUser->getAdmin();
            }
            else
                header('Location: users');
        }
        else
            header('Location: users');
    }

    require '../app/view/setUser.php';