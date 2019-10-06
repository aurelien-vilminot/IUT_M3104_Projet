<?php
    require '../app/model/DB_Connection.php';

    class RegisterManager
    {
        private $DataBase;

        public function __construct()
        {
            $this->DataBase = init_database();
        }

        public function email_taken($email)
        {
            $tab = array('email' => $email);
            $sql = 'SELECT * FROM USER WHERE MAIL = :email';
            $req = $this->DataBase->prepare($sql);
            $req->execute($tab);
            $free = $req->rowCount($sql);

            return $free;
        }

        public function login_taken($login)
        {
            $tab = array('login' => $login);
            $sql = 'SELECT * FROM USER WHERE LOGIN = :login';
            $req = $this->DataBase->prepare($sql);
            $req->execute($tab);
            $free = $req->rowCount($sql);

            return $free;
        }

        public function register($login, $email, $password, $isAdmin)
        {
            $tab = array('login' => $login, 'email' => $email, 'password' => $password, 'isAdmin' => $isAdmin);
            $sql = 'INSERT INTO USER (LOGIN,MAIL,PASSWORD,ADMIN) VALUES(:login,:email,:password,:isAdmin)';
            $req = $this->DataBase->prepare($sql);
            $req->execute($tab);
        }
    }