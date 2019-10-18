<?php
    if(!isset($_SESSION['lost_password']) && $_SESSION['lost_password'] != 1)
        header('Location: index.php');

    if(isset($_POST['submit']))
    {
        $lost_password_user = new lost_password($_SESSION['login']);

        $mail = trim($_POST['mail']);

        if($lost_password_user->isExist() == 1)
        {
            if ($lost_password_user->verifMail($mail) == 0)
            {
                $lost_password_user->sendMail();
                header('Location: index.php');
            }
            else
                $error_mail = 'Le mail ne correspond pas à l\'identifiant saisi';
        }
        else
        {
            $error_user_not_found = 'L\'utilisateur n\'existe pas !';
            unset($_SESSION['login']);
        }

    }
    require '../app/view/lost_password.php';