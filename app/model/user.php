<?php
    require '../app/model/db_connection.php';

    class User
    {
        private $DataBase;
        private $login;
        private $mail;
        private $password;
        private $admin;

        public function __construct($login)
        {
            $this->DataBase = init_database();
            $this->login = $login;
        }

        public function getLogin()
        {
            return $this->login;
        }

        public function getMail()
        {
            $sql = 'SELECT MAIL FROM USER WHERE LOGIN = \'' . $this->login . '\'';
            $req = $this->DataBase->query($sql);
            $row = $req->fetchAll();
            $this->mail = $row[0][0];

            return $this->mail;
        }

        public function getPassword()
        {
            $sql = 'SELECT PASSWORD FROM USER WHERE LOGIN = \'' . $this->login . '\'';
            $req = $this->DataBase->query($sql);
            $row = $req->fetchAll();
            $this->password = $row[0][0];

            return $this->password;
        }

        public function getAdmin()
        {
            $sql = 'SELECT ADMIN FROM USER WHERE LOGIN = \'' . $this->login . '\'';
            $req = $this->DataBase->query($sql);
            $row = $req->fetchAll();
            $this->admin = $row[0][0];

            return $this->admin;
        }

        public function setLogin($login)
        {
            if ($this->login_taken($login) == 1)
                return;

            $tab = array('login' => $login);
            $sql = 'UPDATE USER SET LOGIN = :login  WHERE LOGIN = \'' . $this->login . '\'';
            $req = $this->DataBase->prepare($sql);
            if($req->execute($tab))
                $this->login = $login;
        }

        public function setMail($mail)
        {
            if ($this->email_taken($mail) == 1)
                return;

            $tab = array('mail' => $mail);
            $sql = 'UPDATE USER SET MAIL = :mail  WHERE LOGIN = \'' . $this->login . '\'';
            $req = $this->DataBase->prepare($sql);
            if ($req->execute($tab))
                $this->mail = $mail;
        }

        public function setPassword($password)
        {
            $tab = array('password' => $password);
            $sql = 'UPDATE USER SET PASSWORD = :password  WHERE LOGIN = \'' . $this->login . '\'';
            $req = $this->DataBase->prepare($sql);
            if ($req->execute($tab))
                $this->password = $password;
        }

        public function setAdmin($admin)
        {
            $tab = array('admin' => $admin);
            $sql = 'UPDATE USER SET ADMIN = :admin  WHERE LOGIN = \'' . $this->login . '\'';
            $req = $this->DataBase->prepare($sql);
            if ($req->execute($tab))
                $this->admin = $admin;
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