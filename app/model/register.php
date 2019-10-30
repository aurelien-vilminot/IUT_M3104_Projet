<?php
    class register extends database
    {
        public function email_taken($email)             // Vérifie si l'email est déjà utilisé
        {
            $tab = array('email' => $email);
            $sql = 'SELECT LOGIN FROM USER WHERE MAIL = :email';
            $req = $this->executeRequete($sql, $tab);
            return $req->rowCount();
        }

        public function login_taken($login)             // Vérifie si le login est déjà utilisé
        {
            $tab = array('login' => $login);
            $sql = 'SELECT LOGIN FROM USER WHERE LOGIN = :login';
            $req = $this->executeRequete($sql, $tab);
            return $req->rowCount();
        }

        public function registerUser($login, $email, $password, $isAdmin)   // Inscrit un utilisateur dans la BD
        {
            $tab = array('login' => $login, 'email' => $email, 'password' => $password, 'isAdmin' => $isAdmin);
            $sql = 'INSERT INTO USER (LOGIN,MAIL,PASSWORD,ADMIN) VALUES(:login,:email,:password,:isAdmin)';
            $this->executeRequete($sql, $tab);
        }
    }
