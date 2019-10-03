<?php

if($_SESSION['user'] == 1)
    header("Location:index.php");

if(isset($_POST['submit']))
{
    include '../model/register.php';

    $login = trim($_POST['login']);
    $mail = trim($_POST['mail']);
    $password = trim($_POST['password']);
    $check_password = trim($_POST['check_password']);

    if ($password != $check_password)
    {
        $error_password = 'Les mots de passe ne correspondent pas';
    }
    else if(email_taken($mail) == 1)
    {
        $error_email = 'L\'adresse email est déjà utilisée';
    }
    else if (login_taken($login) == 1)
    {
        $error_login = 'Le login est déjà utilisé';
    }
    else
    {
        register($login, $mail, $password, false);
        $_SESSION['user'] = 1;
        header('Location:index.php');
    }
}
include '../app/view/register.php';
?>