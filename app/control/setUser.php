<?php
    if (!isset($_SESSION['CurrentUser']))
        header("Location: index.php?page=login");
    else {
        $myUser = unserialize($_SESSION['CurrentUser']);
        if (!$myUser->isAdmin())
            header("Location: index.php");
    }

    if (isset($_GET['id']) && !empty($_GET['id']))
    {
        $id = $myUser->clean(trim($_GET['id']));
        $mysetUser = new setUser($id);
        if ($mysetUser->isExist())
        {
            $updateUser = new user($id);

            if(isset($_POST['submit_mail']) && !empty(trim($_POST['mail'])))
            {
                $newMail = $updateUser->clean(trim($_POST['mail']));

                if (!$updateUser->regExpMail($newMail))
                    $error_email = 'Le format de l\'email n\'est pas valide';
                else
                {
                    if($updateUser->email_taken($newMail) == 1)
                        $error_email = 'L\'adresse email est déjà utilisée';
                    else
                    {
                        $updateUser->setMail($newMail);
                        $validate = 'Le nouvel e-mail a bien été enregistré !';
                    }
                }
            }

            if (isset($_GET['action']) && $_GET['action'] == 'changeState' && isset($_GET['value']) && preg_match('/^[0-1]$/', $_GET['value']))
            {
                $updateUser->setAdmin($updateUser->clean(trim($_GET['value'])));
            }

            $login = $updateUser->getLogin();
            $mail = $updateUser->getMail();
            $admin = $updateUser->getAdmin();
        }
        else
            header('Location: index.php?page=users');
    }
    else
        header('Location: index.php?page=users');

    require '../app/view/setUser.php';