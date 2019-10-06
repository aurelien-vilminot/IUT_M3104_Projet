<?php
    if(isset($_SESSION['user']) && $_SESSION['user'] == 1)
        header("Location: ../www/index.php");

    if(isset($_POST['submit']))
    {
        $login = trim($_POST['login']);
        $password = trim($_POST['password']);

        require_once '../app/model/login.php';
        $loginUser  = new LoginManager();

        if($loginUser->verif_user($login, $password) == 0)
        {
            $_SESSION['user'] = 1;
            header("Location:index.php");
        }
        elseif ($loginUser->verif_user($login, $password) == 2)
            $error_user_not_found = "L'identifiant est incorrect";
        else
            $error_password = "Le mot de passe est incorrect";
    }

    require '../app/view/login.php';