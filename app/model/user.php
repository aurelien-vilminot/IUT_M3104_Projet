<?php
    require_once '../app/model/database.php';

    class User extends DataBase
    {
        private $login;
        private $mail;
        private $password;
        private $admin;

        public function __construct($login)
        {
            $this->login = $login;

            $sql = 'SELECT * FROM USER WHERE LOGIN = \'' . $this->login . '\'';
            $req = $this->executeRequete($sql);
            while($row = $req->fetch())
            {
                $this->mail = $row['MAIL'];
                $this->password = $row['PASSWORD'];
                $this->admin = $row['ADMIN'];
            }
            $req->closeCursor();
        }

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
            $this->executeRequete($sql, $tab);
            $this->login = $login;
        }

        public function setMail($mail)
        {
            if ($this->email_taken($mail) == 1)
                return;

            $tab = array('mail' => $mail);
            $sql = 'UPDATE USER SET MAIL = :mail  WHERE LOGIN = \'' . $this->login . '\'';
            $this->executeRequete($sql, $tab);
            $this->mail = $mail;
        }

        public function setPassword($password)
        {
            $tab = array('password' => $password);
            $sql = 'UPDATE USER SET PASSWORD = :password  WHERE LOGIN = \'' . $this->login . '\'';
            $this->executeRequete($sql, $tab);
            $this->password = $password;
        }

        public function setAdmin($admin)
        {
            $tab = array('admin' => $admin);
            $sql = 'UPDATE USER SET ADMIN = :admin  WHERE LOGIN = \'' . $this->login . '\'';
            $this->executeRequete($sql, $tab);
            $this->admin = $admin;
        }

        public function email_taken($email)
    {
        $sql = 'SELECT * FROM USER WHERE MAIL = \'' . $email . '\'';
        $req = $this->executeRequete($sql);
        return $req->rowCount();
    }

        public function login_taken($login)
        {
            $sql = 'SELECT * FROM USER WHERE LOGIN = \'' . $login . '\'';
            $req = $this->executeRequete($sql);
            return $req->rowCount();
        }

        public function create_discussion ($discussion)
        {
            //a coder
        }

        public function create_message ($content, $state, $id_discussion)
        {
            $tab = array('content' => $content, 'state' =>$state, 'id_discussion' => $id_discussion);
            $sql = 'INSERT INTO MESSAGE (CONTENT, STATE, ID_DISCUSSION) VALUES (:content, :state, :id_discussion)';
            $this->executeRequete($sql, $tab);

            $id_message = $this->lastInsertId('MESSAGE');

            $tab3 = array('login' => $this->login, 'id' => $id_message);
            $sql3 = 'INSERT INTO USER_MESSAGE (ID_USER, ID_MESSAGE) VALUES (:login, :id)';
            $this->executeRequete($sql3, $tab3);
        }

        public function update_message ($idMessage, $content)
        {
            $sql = 'SELECT CONTENT FROM MESSAGE WHERE ID = \'' . $idMessage . '\'';
            $req = $this->executeRequete($sql);
            $resultat = $req->fetchAll();
            $lastContent = $resultat[0][0];
            $newContent = $lastContent . ' ' . $content;
            $tab = array('idMessage' => $idMessage, 'newContent' => $newContent);
            $sql2 = 'UPDATE MESSAGE SET CONTENT = :newContent WHERE ID = :idMessage';
            $this->executeRequete($sql2, $tab);

            $tab = array('login' => $this->login, 'id' => $idMessage);
            $sql3 = 'INSERT INTO USER_MESSAGE (ID_USER, ID_MESSAGE) VALUES (:login, :id)';
            $this->executeRequete($sql3, $tab);
        }

        public function update_close_message($idMessage, $content)
        {
            $this->update_message($idMessage, $content);
            $sql = 'UPDATE MESSAGE SET STATE = 0 WHERE ID = \'' . $idMessage . '\'';
            $this->executeRequete($sql);
        }

        public function authorizedUpdateMessage ($idMessage)
        {
            $sql = 'SELECT * FROM USER_MESSAGE WHERE ID_USER = \'' . $this->login . '\'  AND ID_MESSAGE = \'' . $idMessage . '\'';
            $req = $this->executeRequete($sql);
            return $req->rowCount();
        }

        public function __sleep()
        {
            return array('login', 'mail', 'password', 'admin');
        }
    }
