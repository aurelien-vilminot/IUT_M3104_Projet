<?php
    require '../app/model/db_connection.php';

    class Lost_Password_Manager
    {
        private $DataBase;
        private $login;
        private $mail;

        public function __construct($login)
        {
            $this->DataBase = init_database();
            $this->login = $login;
        }

        public function isExist()
        {
            $tab = array('login' => $this->login);
            $sql = 'SELECT * FROM USER WHERE LOGIN = :login';
            $requete = $this->DataBase->prepare($sql);
            $requete->execute($tab);

            $isExist = $requete->rowCount($sql);
            return $isExist;
        }

        private function setMail()
        {
            $sql = 'SELECT MAIL FROM USER WHERE LOGIN = \'' . $this->login . '\'';
            $req = $this->DataBase->query($sql);
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
            $tab = array('password' => $newPassword);
            $sql = 'UPDATE USER SET PASSWORD = :password  WHERE LOGIN = \'' . $this->login . '\'';
            $req = $this->DataBase->prepare($sql);
            if ($req->execute($tab))
                return $newPassword;
        }

        public function sendMail()
        {
            $message = 'Bonjour ' . $this->login . ', ' . "\n" . "\n";
            $message .= 'Vous avez fait une demande de réinitialisation de votre mot de passe. Voici donc vos identifiants tempraires : ' . "\n";
            $message .= 'Identifiant : ' . $this->login . "\n";
            $message .= 'Mot de passe : ' . $this->setNewPassword() . "\n" . "\n";
            $message .= 'Pour modifier votre mot de passe, aller sur votre profil puis saissez votre nouveau mot de passe.' . "\n" . "\n";
            $message .= 'L\'équipe FreeNote.';

            $header = 'From: FreeNote <reset.password@freenote.fr>' . "\n";
            $header .= 'Return-Path: <reset.password@freenote.fr>' . "\n";
            $header .= 'Content-Type: text/plain; charset=utf-8';

            mail($this->mail, 'Récupération de mot de passe', $message, $header);
        }
    }
