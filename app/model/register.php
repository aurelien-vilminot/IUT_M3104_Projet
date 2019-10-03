<?php


    function email_taken($email){
        include '../app/model/DB_Connection.php';

        $tab = array('email' => $email);
        $sql = 'SELECT * FROM USER WHERE MAIL = :email';
        $req = $DataBase->prepare($sql);
        $req->execute($tab);
        $free = $req->rowCount($sql);

        return $free;
    }

    function login_taken($login){
        include '../app/model/DB_Connection.php';

        global $DataBase;
        $tab = array('login' => $login);
        $sql = 'SELECT * FROM USER WHERE LOGIN = :login';
        $req = $DataBase->prepare($sql);
        $req->execute($tab);
        $free = $req->rowCount($sql);

        return $free;
    }

    function register($login, $email, $password, $isAdmin){
        include '../app/model/DB_Connection.php';

        $tab = array('login'=>$login,'email'=>$email,'password'=>$password,'isAdmin'=>$isAdmin);
        $sql = 'INSERT INTO USER (LOGIN,MAIL,PASSWORD,ADMIN) VALUES(:login,:email,:password,:isAdmin)';
        $req = $DataBase->prepare($sql);
        $req->execute($tab);
    }