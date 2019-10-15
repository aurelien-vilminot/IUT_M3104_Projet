<?php
    require_once '../app/model/database.php';

    class Lost_Password_Manager extends DataBase
    {
        private $login;
        private $mail;

        public function __construct($login)
        {
            $this->login = $login;
        }

        public function isExist()
        {
            $tab = array('login' => $this->login);
            $sql = 'SELECT * FROM USER WHERE LOGIN = :login';
            $requete = $this->executeRequete($sql, $tab);

            $isExist = $requete->rowCount($sql);
            return $isExist;
        }

        private function setMail()
        {
            $sql = 'SELECT MAIL FROM USER WHERE LOGIN = \'' . $this->login . '\'';
            $req = $this->executeRequete($sql);
            $row = $req->fetchAll();
            $this->mail = $row[0][0];
        }

        public function verifMail($mail)
        {
            $this->setMail();
            if ($this->mail == $mail)
                return 0;
            else
                return 1;
        }

        public function setNewPassword()
        {
            $newPassword = uniqid();
            $newPasswordHash = password_hash($newPassword,PASSWORD_DEFAULT);
            $tab = array('password' => $newPasswordHash);
            $sql = 'UPDATE USER SET PASSWORD = :password  WHERE LOGIN = \'' . $this->login . '\'';
            $this->executeRequete($sql, $tab);
            return $newPassword;
        }

        public function sendMail()
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
