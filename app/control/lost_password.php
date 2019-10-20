<?php
    if(!isset($_SESSION['lost_password']) && $_SESSION['lost_password'] != 1)
        header('Location: index.php');

    if(isset($_POST['submit']) && !empty(trim($_POST['mail'])))
    {
        $lost_password_user = new lost_password($_SESSION['login']);

        $mail = $lost_password_user->clean(trim($_POST['mail']));
        if ($lost_password_user->regExpMail($mail))
        {
            if($lost_password_user->isExist() == 1)
            {
                if ($lost_password_user->verifMail($mail) == 0)
                {
                    $lost_password_user->sendMail();
                    header('Location: index.php');
                }
                else
                    $error = 'Le mail ne correspond pas à l\'identifiant saisi';
            }
            else
            {
                $error = 'L\'utilisateur n\'existe pas !';
                unset($_SESSION['login']);
            }
        }
        else
            $error = 'Le format de l\'email n\'est pas valide';
    }
    require '../app/view/lost_password.php';