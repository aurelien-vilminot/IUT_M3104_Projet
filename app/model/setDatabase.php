<?php
    class setDatabase extends database
    {
        public function resetDB()               //Réinitialise la base de données
        {
            $sql = 'DROP TABLE USER_MESSAGE;'
                . 'DROP TABLE LIKE_DISCUSSION;'
                . 'DROP TABLE MESSAGE;'
                . 'DROP TABLE DISCUSSION;'
                . 'DROP TABLE `USER`;';
            $this->executeRequete($sql);

            $sql2 = 'CREATE TABLE `USER`
                    (
                        LOGIN VARCHAR(15) PRIMARY KEY NOT NULL,
                        MAIL VARCHAR(50) NOT NULL,
                        PASSWORD VARCHAR(255) NOT NULL,
                        ADMIN BOOLEAN NOT NULL
                    );'
                . 'CREATE TABLE DISCUSSION
                    (
                        ID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
                        TITLE VARCHAR (50) NOT NULL,
                        STATE BOOLEAN NOT NULL,
                        NB_LIKE INT NOT NULL
                    );'
                . 'CREATE TABLE MESSAGE
                    (
                        ID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
                        CONTENT VARCHAR (100) NOT NULL,
                        STATE BOOLEAN NOT NULL,
                        ID_DISCUSSION INT NOT NULL,
                        CONSTRAINT C1 FOREIGN KEY (ID_DISCUSSION) REFERENCES DISCUSSION(ID)
                    );'
                . 'CREATE TABLE USER_MESSAGE
                    (
                        ID_USER VARCHAR(15) NOT NULL,
                        ID_MESSAGE INT NOT NULL,
                        CONSTRAINT C2 FOREIGN KEY (ID_USER) REFERENCES USER(LOGIN),
                        CONSTRAINT C3 FOREIGN KEY (ID_MESSAGE) REFERENCES MESSAGE(ID)
                    );'
                . 'CREATE TABLE LIKE_DISCUSSION
                    (
                        ID_USER VARCHAR(15) NOT NULL,
                        ID_DISCUSSION INT NOT NULL,
                        CONSTRAINT C4 FOREIGN KEY(ID_USER) REFERENCES USER(LOGIN),
                        CONSTRAINT C5 FOREIGN KEY(ID_DISCUSSION) REFERENCES DISCUSSION(ID)
                    );';
            $this->executeRequete($sql2);
        }

        public function sendUser($login, $email, $password, $isAdmin)       //Insère dans la BD un utilisateur
        {
            $tab = array('login' => $login, 'email' => $email, 'password' => $password, 'isAdmin' => $isAdmin);
            $sql = 'INSERT INTO USER (LOGIN,MAIL,PASSWORD,ADMIN) VALUES(:login,:email,:password,:isAdmin)';
            $this->executeRequete($sql, $tab);
        }

        public function sendDiscussion($title)                              //Insère dans la BD une discussion
        {
            $tab = array('title' => $title, 'state' => 1, 'nbLike' => 0);
            $sql = 'INSERT INTO DISCUSSION(TITLE, STATE, NB_LIKE) VALUES (:title, :state, :nbLike)';
            $this->executeRequete($sql, $tab);
        }

        public function sendMessage($content, $state, $id_discussion)       //Insère dans la BD un message
        {
            $tab = array('content' => $content, 'state' =>$state, 'id_discussion' => $id_discussion);
            $sql = 'INSERT INTO MESSAGE (CONTENT, STATE, ID_DISCUSSION) VALUES (:content, :state, :id_discussion)';
            $this->executeRequete($sql, $tab);
        }

        public function setUserMessageDB($login, $id_message)               //Insère dans la BD un message selon l'utilisateur
        {
            $tab = array('login' => $login, 'id' => $id_message);
            $sql = 'INSERT INTO USER_MESSAGE (ID_USER, ID_MESSAGE) VALUES (:login, :id)';
            $this->executeRequete($sql, $tab);
        }

        public function sendLike($login, $id_discussion)                    //Insère dans la BD un like dans une discussion
        {
            $tab = array('login' => $login, 'id_discussion' => $id_discussion);
            $sql = 'INSERT INTO LIKE_DISCUSSION (ID_USER, ID_DISCUSSION) VALUES (:login, :id_discussion)';
            $this->executeRequete($sql, $tab);

            $sql2 = 'UPDATE DISCUSSION SET NB_LIKE = NB_LIKE + 1 WHERE ID = \'' . $id_discussion . '\'';
            $this->executeRequete($sql2);
        }
    }
