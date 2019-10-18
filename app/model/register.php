<?php
    require_once '../app/model/database.php';

    class register extends DataBase
    {
        public function email_taken($email)
        {
            $sql = 'SELECT * FROM USER WHERE MAIL = \'' . $email . '\'';
            $req = $this->executeRequete($sql);
            return $req->rowCount($sql);
        }

        public function login_taken($login)
        {
            $sql = 'SELECT * FROM USER WHERE LOGIN = \'' . $login . '\'';
            $req = $this->executeRequete($sql);
            return $req->rowCount();
        }

        public function register($login, $email, $password, $isAdmin)
        {
            $tab = array('login' => $login, 'email' => $email, 'password' => $password, 'isAdmin' => $isAdmin);
            $sql = 'INSERT INTO USER (LOGIN,MAIL,PASSWORD,ADMIN) VALUES(:login,:email,:password,:isAdmin)';
            $this->executeRequete($sql, $tab);
        }
    }