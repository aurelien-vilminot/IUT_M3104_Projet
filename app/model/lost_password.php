<?php
    class lost_password extends database
    {
        private $login;
        private $mail;

        public function __construct($login)  //constructeur de la classe lost_password
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

        public function setNewPassword()   // pour changer les mots de passe
        {
            $newPassword = uniqid();
            $newPasswordHash = password_hash($newPassword,PASSWORD_DEFAULT);
            $tab = array('password' => $newPasswordHash);
            $sql = 'UPDATE USER SET PASSWORD = :password  WHERE LOGIN = \'' . $this->login . '\'';
            $this->executeRequete($sql, $tab);
            return $newPassword;
        }

        public function sendMail()   //envoie d'un mail avec le nouveau mot de passe 
        {
            $message = 'Bonjour ' . $this->login . ', ' . "\n" . "\n";
            $message .= 'Vous avez fait une demande de réinitialisation de votre mot de passe. Voici vos identifiants temporaires : ' . "\n";
            $message .= 'Identifiant : ' . $this->login . "\n";
            $message .= 'Mot de passe : ' . $this->setNewPassword() . "\n" . "\n";
            $message .= 'Pour modifier votre mot de passe, allez sur votre profil puis saisissez votre nouveau mot de passe.' . "\n" . "\n";
            $message .= 'L\'équipe FreeNote.';

            $header = 'From: FreeNote <reset.password@freenote.fr>' . "\n";
            $header .= 'Return-Path: <reset.password@freenote.fr>' . "\n";
            $header .= 'Content-Type: text/plain; charset=utf-8';

            mail($this->mail, 'Récupération de mot de passe', $message, $header);
        }
    }
