<?php
    if(isset($_SESSION['CurrentUser']))         // Si l'utilisateur est déjà connecté, redirection vers la page d'accueil
        header('Location: home');

    $loginUser = new login();

    if(isset($_POST['submit']) && !empty(trim($_POST['login'])))
    {
        $login = $loginUser->clean(trim($_POST['login']));
        $password = $loginUser->clean(trim($_POST['password']));

        if($loginUser->verif_user($login, $password) == 0)          // Vérification du bon couple identifiant / mot de passe
        {
            if ($loginUser->isAdmin($login))                        // Test si l'utilisateur est un admin
                $_SESSION['admin'] = 1;

            $_SESSION['CurrentUser'] = serialize(new user($login));     // Création du nouvel utilisateur
            header('Location: home');
        }
        elseif ($loginUser->verif_user($login, $password) == 2)
            $error = 'L\'identifiant est incorrect';
        else
            $error = 'Le mot de passe est incorrect';
    }
    elseif(isset($_POST['lost_password']))          // Si l'utilisateur clique sur 'Mot de passe oublié'
    {
        $_SESSION['login'] = $loginUser->clean(trim($_POST['login']));
        $_SESSION['lost_password'] = 1;
        header('Location: lost_password');
    }

    require '../app/view/login.php';