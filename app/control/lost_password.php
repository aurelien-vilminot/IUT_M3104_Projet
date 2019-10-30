<?php
    if (isset($_SESSION['lost_password']) && $_SESSION['lost_password'] == 1)       // Si l'utilisateur a cliqué sur 'Mot de passe oublié' depuis la page login
    {
        $setNewPassword = 0;
        if(isset($_POST['submitMail']) && !empty(trim($_POST['mail'])))
        {
            $lostPasswordUser = new lost_password($_SESSION['login']);
            $mail = $lostPasswordUser->clean(trim($_POST['mail']));

            if ($lostPasswordUser->regExpMail($mail))       // Vérifie que le mail est au bon format
            {
                if($lostPasswordUser->isExist() == 1)       // Vérifie que l'utilisateur existe
                {
                    if ($lostPasswordUser->verifMail($mail) == 0)       // Vérifie que le mail correspond bien à l'utlisateur
                    {
                        if ($lostPasswordUser->isTokenExist() == 0)     // Vérifie que l'utlisateur n'a pas déjà fait une demande de mot de passe oublié
                        {
                            $lostPasswordUser->sendMail();
                            unset($_SESSION['lost_password']);
                            header('Location: home-validation-mail#validation');
                        }
                        else
                            $error = 'Un e-mail de récupération de mot de passe a déjà été envoyé à cette adresse';
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
                $error = 'Le format de l\'e-mail n\'est pas valide';
        }
    }
    elseif (isset($_GET['token']) && !empty($_GET['token']) && preg_match('/^[a-zA-Z0-9]{40}$/', $_GET['token']))       // Si un token est valide dans l'URL
    {
        $setNewPassword = 1;
        $lostPasswordUser = new lost_password(null);
        $token = $lostPasswordUser->clean(trim($_GET['token']));
        $login = $lostPasswordUser->verifToken($token);         // Vérifie que le token existe et qu'il n'est pas expiré et renvoie le login associé

        if ($login != 1)
        {
            if ($login != 2)
            {
                if (isset($_POST['submitNewPassword']) && !empty(trim($_POST['password'])) && !empty(trim($_POST['check_password'])))           // Mise en place du nouveau mot de passe
                {
                    $lostPasswordUser->setLogin($login);
                    $password = password_hash($lostPasswordUser->clean(trim($_POST['password'])), PASSWORD_DEFAULT);
                    $check_password = $lostPasswordUser->clean(trim($_POST['check_password']));

                    if (!preg_match('/^(\S){8,}$/', $lostPasswordUser->clean(trim($_POST['password']))))
                        $error = 'Le mot de passe doit avoir un minimum de 8 caractères';
                    elseif (!password_verify($check_password, $password))
                        $error = 'Les mots de passe ne correspondent pas';
                    else
                    {
                        $myUser = new user($login);
                        $myUser->setPassword($password);
                        $lostPasswordUser->destroyToken($token);        // Destruction du token
                        $_SESSION['CurrentUser'] = serialize($myUser);
                        $setNewPassword = 2;
                    }
                }
            }
            else
            {
                $lostPasswordUser->destroyToken($token);
                $error_token = 'Le token a expiré';
            }
        }
        else
            $error_token = 'Le token est invalide';
    }

    require '../app/view/lost_password.php';