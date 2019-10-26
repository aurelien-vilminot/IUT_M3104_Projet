<?php
    if(!isset($_SESSION['CurrentUser']))
        header('Location: login');

    $myUser = unserialize($_SESSION['CurrentUser']);

    if (isset($_SESSION['CurrentUser']))
    {
        if($myUser->isAdmin())
        {
            if(isset($_POST['submit_login']) && !empty(trim($_POST['login'])))
            {
                $newLogin = $myUser->clean(trim($_POST['login']));

                if (!preg_match('/^(.|\S){0,15}$/', $newLogin))
                    $error_login = 'L\'identifiant ne peut excéder 15 caractères';
                elseif ($myUser->login_taken($newLogin) == 1)
                    $error_login = 'L\'identifiant est déjà utilisé';
                else
                {
                    $myUser->setLogin($newLogin);
                    $_SESSION['CurrentUser'] = serialize(new user($myUser->getLogin()));
                    $validate = 'Votre nouvel indentifiant a bien été enregistré !';
                }
            }
        }

        if(isset($_POST['submit_mail']) && !empty(trim($_POST['mail'])))
        {
            $newMail = $myUser->clean(trim($_POST['mail']));

            if (!$myUser->regExpMail($newMail))
                $error_email = 'Le format de l\'email n\'est pas valide';
            else
            {
                if($myUser->email_taken($newMail) == 1)
                    $error_email = 'L\'adresse email est déjà utilisée';
                else
                {
                    $myUser->setMail($newMail);
                    $_SESSION['CurrentUser'] = serialize(new user($myUser->getLogin()));
                    $validate = 'Votre nouvel e-mail a bien été enregistré !';
                }
            }
        }

        if(isset($_POST['submit_password']) && !empty(trim($_POST['old_password'])) && !empty(trim($_POST['password'])) && !empty(trim($_POST['check_password'])))
        {
            $password = $myUser->clean(trim($_POST['old_password']));
            $newPassword = password_hash($myUser->clean(trim($_POST['password'])), PASSWORD_DEFAULT);
            $newCheckPassword = $myUser->clean(trim($_POST['check_password']));

            if (!password_verify($password, $myUser->getPassword()))
                $error_password = 'L\' ancien mot de passe est erroné';
            elseif (!preg_match('/^(\S){8,}$/', $myUser->clean(trim($_POST['password']))))
                $error_password = 'Le mot de passe doit avoir un minimum de 8 caractères';
            elseif (!password_verify($newCheckPassword, $newPassword))
                $error_password = 'Les mots de passe ne correspondent pas';
            else
            {
                $myUser->setPassword($newPassword);
                $_SESSION['CurrentUser'] = serialize(new user($myUser->getLogin()));
                $validate = 'Votre nouveau mot de passe a bien été enregistré !';
            }
        }
    }

    $id = $myUser->getLogin();
    $mail = $myUser->getMail();

    require '../app/view/profil.php';