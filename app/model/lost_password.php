<?php
    class lost_password extends database
    {
        private $login;
        private $mail;

        public function __construct($login)  //constructeur de la classe lost_password
        {
            $this->login = $login;
        }

        public function setLogin($login)
        {
            $this->login = $login;
        }

        public function isExist()   //vérifie si l'utilisateur existe 
        {
            $tab = array('login' => $this->login);
            $sql = 'SELECT LOGIN FROM USER WHERE LOGIN = :login';
            $requete = $this->executeRequete($sql, $tab);
            return $requete->rowCount();
        }

        private function getMail()  //trouve un mail dans la base de donnée
        {
            $tab = array('login' =>  $this->login);
            $sql = 'SELECT MAIL FROM USER WHERE LOGIN = :login';
            $req = $this->executeRequete($sql, $tab);
            $row = $req->fetchAll();
            $this->mail = $row[0][0];
        }

        public function verifMail($mail)  // vérifie si ce mail existe
        {
            $this->getMail();
            if ($this->mail == $mail)
                return 0;
            else
                return 1;
        }

        public function isTokenExist()
        {
            $tab = array('login' =>  $this->login);
            $sql = 'SELECT LOGIN FROM TOKEN_USER WHERE LOGIN = :login';
            $req = $this->executeRequete($sql, $tab);
            return $req->rowCount();
        }

        private function generateToken()
        {
            $token = substr(bin2hex(password_hash(microtime(), PASSWORD_DEFAULT)),  rand(0,20), 40);
            $date = date('Y-m-d');
            $tab = array('login' => $this->login, 'token' => $token, 'date' => $date);
            $sql = 'INSERT INTO TOKEN_USER (ID_USER, TOKEN, DATE) VALUES (:login, :token, :date)';
            $this->executeRequete($sql, $tab);
            return $token;
        }

        public function verifToken($token)
        {
            $tab = array('token' => $token);
            $sql = 'SELECT * FROM TOKEN_USER WHERE TOKEN = :token';
            $req = $this->executeRequete($sql, $tab);

            if ($req->rowCount() == 0)
                return 1;
            else
            {
                $row = $req->fetchAll();
                $dateToken = $row[0][2];

                $formatDateNow = explode('-',  date('Y-m-d'));
                $formatDateToken = explode('-', $dateToken);

                if ($formatDateNow[0] == $formatDateToken[0])
                    if ($formatDateNow[1] == $formatDateToken[1])
                        if (($formatDateNow[2] - $formatDateToken[2]) < 1)
                            return $row[0][0];
                        else
                            return 2;
                    else
                        return 2;
                else
                    return 2;
            }
        }

        public function destroyToken($token)
        {
            $tab = array('token' => $token);
            $sql = 'DELETE FROM TOKEN_USER WHERE TOKEN = :token';
            $this->executeRequete($sql, $tab);
        }

        public function sendMail()   //envoie d'un mail avec le nouveau mot de passe 
        {
            $message = 'Bonjour ' . $this->login . ', ' . "\n\n";
            $message .= 'Vous avez fait une demande de réinitialisation de votre mot de passe. Voici un lien qui vous permettra de réinitialiser votre mot de passe : ' . "\n\n";
            $message .= 'https://aurelien.alwaysdata.net/lost_password-' . $this->generateToken() . "\n\n";
            $message .= 'Ce lien est valide 24H. Si vous n\'êtes pas à l\'origine de cette demande, merci de ne pas tenir compte de ce mail' . "\n\n";
            $message .= 'L\'équipe FreeNote.';

            $header = 'From: FreeNote <reset.password@freenote.fr>' . "\n";
            $header .= 'Return-Path: <reset.password@freenote.fr>' . "\n";
            $header .= 'Content-Type: text/plain; charset=utf-8';

            mail($this->mail, 'Récupération de mot de passe', $message, $header);
        }
    }
