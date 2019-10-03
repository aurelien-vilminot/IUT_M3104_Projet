<?php

include '../app/view/register.php';

//include '../model/register.php';

$Id = $_POST['login'];
$Mail = $_POST['mail'];
$Password = $_POST['password'];
$check_password = $_POST['check_password'];
$action = $_POST['action'];

if ($action == 'Inscription')
{
    $message = 'Voici vos identifiants d\'inscription:' .PHP_EOL;
    $message .= 'Email:' . register::getLogin() . PHP_EOL;
    $message .= 'Mot de passe:' . PHP_EOL . register::getPassword();
    $header = "From:". register::getMail();
    $header .= "Reply-to:".register::getMail();
    $header .= 'Content-type: text/html';
}
