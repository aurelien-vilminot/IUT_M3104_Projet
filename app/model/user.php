<?php
    class user extends database
    {
        private $login;
        private $mail;
        private $password;
        private $admin;

        public function __construct($login)             //Constructeur de la classe user
        {
            $sql = 'SELECT * FROM USER WHERE LOGIN = \'' . $login . '\'';
            $req = $this->executeRequete($sql);
            while($row = $req->fetch())
            {
                $this->login = $row['LOGIN'];
                $this->mail = $row['MAIL'];
                $this->password = $row['PASSWORD'];
                $this->admin = $row['ADMIN'];
            }
            $req->closeCursor();
        }

        public function getLogin(){return $this->login;}            //Renvoie le login

        public function getMail(){return $this->mail;}              //Renvoie le mail

        public function getPassword(){return $this->password;}      //Renvoie le mot de passe

        public function getAdmin(){return $this->admin;}            //Renvoie si l'utilisateur est admin

        public function setLogin($newLogin)                            //Permet de modifier le login
        {
            if ($this->login_taken($newLogin) == 1)
                return;

            $tab = array('newLogin' => $newLogin);
            $sql = 'UPDATE USER SET LOGIN = :newLogin  WHERE LOGIN = \'' . $this->login . '\'';
            $this->executeRequete($sql, $tab);
            $this->login = $newLogin;
        }

        public function setMail($mail)                              //Permet de modifier le mail
        {
            if ($this->email_taken($mail) == 1)
                return;

            $tab = array('mail' => $mail);
            $sql = 'UPDATE USER SET MAIL = :mail  WHERE LOGIN = \'' . $this->login . '\'';
            $this->executeRequete($sql, $tab);
            $this->mail = $mail;
        }

        public function setPassword($password)                      //Permet de modifier le mot de passe
        {
            $tab = array('password' => $password);
            $sql = 'UPDATE USER SET PASSWORD = :password  WHERE LOGIN = \'' . $this->login . '\'';
            $this->executeRequete($sql, $tab);
            $this->password = $password;
        }

        public function setAdmin($admin)                            //Permet de modifier si un utilisateur est admin
        {
            $tab = array('admin' => $admin);
            $sql = 'UPDATE USER SET ADMIN = :admin  WHERE LOGIN = \'' . $this->login . '\'';
            $this->executeRequete($sql, $tab);
            $this->admin = $admin;
        }

        public function email_taken($email)                         //Vérifie si l'email est déjà utilisé
    {
        $sql = 'SELECT * FROM USER WHERE MAIL = \'' . $email . '\'';
        $req = $this->executeRequete($sql);
        return $req->rowCount();
    }

        public function login_taken($login)                         //Vérifie si le login est déjà utilisé
        {
            $sql = 'SELECT * FROM USER WHERE LOGIN = \'' . $login . '\'';
            $req = $this->executeRequete($sql);
            return $req->rowCount();
        }

        public function create_message ($content, $state, $id_discussion)       //Créé une discussion
        {
            $tab = array('content' => $content, 'state' =>$state, 'id_discussion' => $id_discussion);
            $sql = 'INSERT INTO MESSAGE (CONTENT, STATE, ID_DISCUSSION) VALUES (:content, :state, :id_discussion)';
            $this->executeRequete($sql, $tab);

            $id_message = $this->lastInsertId('MESSAGE');

            $tab3 = array('login' => $this->login, 'id' => $id_message);
            $sql3 = 'INSERT INTO USER_MESSAGE (ID_USER, ID_MESSAGE) VALUES (:login, :id)';
            $this->executeRequete($sql3, $tab3);
        }

        public function modify_message($idMessage, $content)                    //Modifie le contenue du message
        {
            $tab = array('idMessage' => $idMessage, 'content' => $content);
            $sql = 'UPDATE MESSAGE SET CONTENT = :content WHERE ID = :idMessage';
            $this->executeRequete($sql, $tab);
        }

        public function update_message ($idMessage, $content)                   //Met à jour un message en cours d'écriture
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

        public function update_close_message($idMessage, $content)              //Met à jour et ferme un message en cours d'écriture
        {
            $this->update_message($idMessage, $content);
            $sql = 'UPDATE MESSAGE SET STATE = 0 WHERE ID = \'' . $idMessage . '\'';
            $this->executeRequete($sql);
        }

        public function authorizedUpdateMessage ($idMessage)                    //Vérifie si l'utilisateur a déjà envoyé un message dans le message courant
        {
            $sql = 'SELECT * FROM USER_MESSAGE WHERE ID_USER = \'' . $this->login . '\'  AND ID_MESSAGE = \'' . $idMessage . '\'';
            $req = $this->executeRequete($sql);
            return $req->rowCount();
        }

        public function deleteMessage($idMessage)                               //Supprime un message
        {
            $tab = array('id' => $idMessage);
            $sql = 'DELETE FROM USER_MESSAGE WHERE ID_MESSAGE = :id';
            $this->executeRequete($sql, $tab);

            $sql2 = 'DELETE FROM MESSAGE WHERE ID = :id';
            $this->executeRequete($sql2, $tab);
        }

        public function isMessageExist($idMessage)      //Vérifie si un message existe
        {
            $sql = 'SELECT * FROM MESSAGE WHERE ID = \'' . $idMessage . '\'';
            $req = $this->executeRequete($sql);
            return $req->rowCount();
        }

        public function isAdmin()               //Booléen permettant de savoir si un utilisateur est admin
        {
            if ($this->admin)
                return 1;
            else
                return 0;
        }

        public function delete()                //Supprime un utilisateur
        {
            $tab = array('login' => $this->login);
            $sql = 'DELETE FROM USER_MESSAGE WHERE ID_USER = :login';
            $this->executeRequete($sql, $tab);

            $sql2 = 'DELETE FROM LIKE_DISCUSSION WHERE ID_USER = :login';
            $this->executeRequete($sql2, $tab);

            $sql3 = 'DELETE FROM USER WHERE LOGIN = :login';
            $this->executeRequete($sql3, $tab);
        }

        public function __sleep()
        {
            return array('login', 'mail', 'password', 'admin');
        }
    }
