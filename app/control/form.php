<?php

include '../model/class_register.php';

$Id = $_POST['id'];
$Mail = $_POST['mail'];
$Password = $_POST['password'];
$check_password = $_POST['check_password'];
$action = $_POST['action'];

if ($action == 'Inscription')
{
    $message = 'Voici vos identifiants d\'inscription:' .PHP_EOL;
    $message .= 'Email:' . classRegister::getId() . PHP_EOL;
    $message .= 'Mot de passe:' . PHP_EOL . classRegister::getPassword();
    $header = "From:". classRegister::getMail();
    $header .= "Reply-to:".getMail();
    $header .= 'Content-type: text/html';
}