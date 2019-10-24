<?php
    class register extends database
    {
        public function email_taken($email)             //Vérifie si l'email est déjà utilisé
        {
            $sql = 'SELECT * FROM USER WHERE MAIL = \'' . $email . '\'';
            $req = $this->executeRequete($sql);
            return $req->rowCount($sql);
        }

        public function login_taken($login)             //Vérifie si le login est déjà utilisé
        {
            $sql = 'SELECT * FROM USER WHERE LOGIN = \'' . $login . '\'';
            $req = $this->executeRequete($sql);
            return $req->rowCount();
        }

        public function registerUser($login, $email, $password, $isAdmin)   //Insère dans la BD l'utilisateur, le mot de passe, l'email d'un utilisateur venant de s'inscrire
        {
            $tab = array('login' => $login, 'email' => $email, 'password' => $password, 'isAdmin' => $isAdmin);
            $sql = 'INSERT INTO USER (LOGIN,MAIL,PASSWORD,ADMIN) VALUES(:login,:email,:password,:isAdmin)';
            $this->executeRequete($sql, $tab);
        }
    }
