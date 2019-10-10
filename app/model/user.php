<?php
    require '../app/model/database.php';

    class User extends DataBase
    {
        private $DataBase;
        private $login;
        private $mail;
        private $password;
        private $admin;

        public function __construct($DataBase, $login)
        {
            $this->DataBase = $DataBase;
            $this->login = $login;

            $sql = 'SELECT * FROM USER WHERE LOGIN = \'' . $this->login . '\'';
            $req = $this->DataBase->query($sql);
            while($row = $req->fetch())
            {
                $this->mail = $row['MAIL'];
                $this->password = $row['PASSWORD'];
                $this->admin = $row['ADMIN'];
            }
            $req->closeCursor();
        }

        public function getDataBase(){return $this->DataBase;}

        public function getLogin(){return $this->login;}

        public function getMail(){return $this->mail;}

        public function getPassword(){return $this->password;}

        public function getAdmin(){return $this->admin;}

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

        public function create_discussion ($discussion)
        {
          new Discussion($discussion);                         #pas encore creer
        }

        public function create_message ($message)
        {
          new Message ($message);                              #classe pas encore creer
        }


        public function open_message($message)
        {
          require '../app/model/db_connection.php';
          $sql = 'UPDATE MESSAGE SET STATE = TRUE where ID = $message';
          $this->getDataBase()->query($sql);
        }

        public function close_message($message)
        {
          require '../app/model/db_connection.php';
          $sql = 'UPDATE MESSAGE SET STATE = FALSE where ID = $message';
          $this->getDataBase()->query($sql);
        }

        public function update_message ($message,$state)   #cette fn est ici car tout le mon de peut fermer un message
        {
          if($state)
          {
            $this->getMessage()->open_message($message);    #getMessage pas encore declarer
          }
          else {
            $this->getMessage()->close_message($message);    #getMessage pas encore declarer
          }
        }
    }
