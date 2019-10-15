<?php
    if(isset($_SESSION['user']) && $_SESSION['user'] == 1)
        header('Location: index.php');

    if(isset($_POST['submit']))
    {
        require_once '../app/model/login.php';

        $loginUser = new LoginManager();

        $login = trim($_POST['login']);
        $password = trim($_POST['password']);

        if($loginUser->verif_user($login, $password) == 0)
        {
            $_SESSION['user'] = 1;
            $_SESSION['CurrentUser'] = $login;
            header('Location: index.php?page=home');
        }
        elseif ($loginUser->verif_user($login, $password) == 2)
            $error_user_not_found = 'L\'identifiant est incorrect';
        else
            $error_password = 'Le mot de passe est incorrect';
    }
    elseif(isset($_POST['lost_password']))
    {
        $_SESSION['login'] = trim($_POST['login']);
        $_SESSION['lost_password'] = 1;
        header('Location: index.php?page=lost_password');
    }

    require '../app/view/login.php';