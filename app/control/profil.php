<?php
    if(!isset($_SESSION['CurrentUser']))
        header("Location: index.php?page=login");

    $myUser = unserialize($_SESSION['CurrentUser']);

    if (isset($_SESSION['CurrentUser']))
    {
        if(isset($_POST['submit_mail']))
        {
            $newMail = trim($_POST['mail']);

            if($myUser->email_taken($newMail) == 1)
            {
                $error_email = 'L\'adresse email est déjà utilisée';
            }
            else
            {
                $myUser->setMail($newMail);
                $_SESSION['CurrentUser'] = serialize(new user($myUser->getLogin()));
                $email_change = 'Votre nouvel e-mail a bien été enregistré !';
            }
        }

        if(isset($_POST['submit_password']))
        {
            $password = trim($_POST['old_password']);
            $newPassword = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
            $newCheckPassword = trim($_POST['check_password']);

            if (!password_verify($password, $myUser->getPassword()))
            {
                $error_login = 'L\' ancien mot de passe est erroné';
            }
            else if (!password_verify($newCheckPassword, $newPassword))
            {
                $error_password = 'Les mots de passe ne correspondent pas';
            }
            else
            {
                $myUser->setPassword($newPassword);
                $_SESSION['CurrentUser'] = serialize(new user($myUser->getLogin()));
                $password_change = 'Votre nouveau mot de passe a bien été enregistré !';
            }
        }
    }

    $id = $myUser->getLogin();
    $mail = $myUser->getMail();

    require '../app/view/profil.php';