<?php
    if(!isset($_SESSION['user']) && $_SESSION['user'] != 1)
        header("Location: index.php?page=login");

    require_once '../app/model/user.php';

    $myUser =  new User($_SESSION['loginCurrentUser']);
    $id = $myUser->getLogin();
    $mail = $myUser->getMail();

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
        }
    }

    require '../app/view/profil.php';