<?php
    if(isset($_SESSION['user']) && $_SESSION['user'] == 1)
        header("Location: index.php");

    if(isset($_POST['submit']) && !empty(trim($_POST['login'])) && !empty(trim($_POST['mail'])) && !empty(trim($_POST['password'])) && !empty(trim($_POST['check_password'])))
    {

        // Ma clé privée
        $secret = "6Leaar4UAAAAAErXb3BGLfsGAw5kebr8X_tRPSqa";
        // Paramètre renvoyé par le recaptcha
        $response = $_POST['g-recaptcha-response'];
        // On récupère l'IP de l'utilisateur
        $remoteip = $_SERVER['REMOTE_ADDR'];

        $api_url = "https://www.google.com/recaptcha/api/siteverify?secret="
            . $secret
            . "&response=" . $response
            . "&remoteip=" . $remoteip ;

        $decode = json_decode(file_get_contents($api_url), true);

        if ($decode['success'] == true)
        {
            $userRegister = new register();

            $login = $userRegister->clean(trim($_POST['login']));
            $mail = $userRegister->clean(trim($_POST['mail']));
            $password = password_hash($userRegister->clean(trim($_POST['password'])), PASSWORD_DEFAULT);
            $check_password = $userRegister->clean(trim($_POST['check_password']));

            if (!$userRegister->regExpMail($mail))
                $error = 'Le format de l\'email n\'est pas valide';
            elseif (!preg_match('/^(.|\S){8,}$/', $userRegister->clean(trim($_POST['password']))))
                $error = 'Le mot de passe doit avoir un minimum de 8 caractères';
            elseif (!password_verify($check_password, $password))
                $error = 'Les mots de passe ne correspondent pas';
            elseif($userRegister->email_taken($mail) == 1)
                $error = 'L\'adresse email est déjà utilisée';
            elseif ($userRegister->login_taken($login) == 1)
                $error = 'Le login est déjà utilisé';
            else
            {
                $userRegister->registerUser($login, $mail, $password, 0);
                $_SESSION['CurrentUser'] = serialize(new user($login));
                header('Location: index.php');
            }
        }
        else
            $error = 'Oups vous êtes un robot...';
    }

    require '../app/view/register.php';
