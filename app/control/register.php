<?php
    if(isset($_SESSION['user']) && $_SESSION['user'] == 1)
        header("Location: index.php");

    if(isset($_POST['submit']))
    {
        $login = trim($_POST['login']);
        $mail = trim($_POST['mail']);
        $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
        $check_password = trim($_POST['check_password']);

        $userRegister = new register();

        if (!password_verify($check_password, $password))
        {
            $error_password = 'Les mots de passe ne correspondent pas';
        }
        else if($userRegister->email_taken($mail) == 1)
        {
            $error_email = 'L\'adresse email est déjà utilisée';
        }
        else if ($userRegister->login_taken($login) == 1)
        {
            $error_login = 'Le login est déjà utilisé';
        }
        else
        {
            $userRegister->registerUser($login, $mail, $password, 0);
            $_SESSION['CurrentUser'] = serialize(new user($login));
            header('Location: index.php');
        }
    }

    require '../app/view/register.php';
