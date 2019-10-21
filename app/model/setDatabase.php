<?php
    class setDatabase extends database
    {
        public function resetDB()
        {
            $sql = 'DROP TABLE USER_MESSAGE;'
                . 'DROP TABLE LIKE_DISCUSSION;'
                . 'DROP TABLE MESSAGE;'
                . 'DROP TABLE DISCUSSION;'
                . 'DROP VIEW DISCUSSION_SORTED;'
                . 'DROP TABLE USER;';
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
                    );'
                . 'CREATE VIEW DISCUSSION_SORTED AS
                        SELECT *
                        FROM DISCUSSION
                        ORDER BY NB_LIKE DESC;';
            $this->executeRequete($sql2);
        }

        public function sendUser($login, $email, $password, $isAdmin)
        {
            $tab = array('login' => $login, 'email' => $email, 'password' => $password, 'isAdmin' => $isAdmin);
            $sql = 'INSERT INTO USER (LOGIN,MAIL,PASSWORD,ADMIN) VALUES(:login,:email,:password,:isAdmin)';
            $this->executeRequete($sql, $tab);
        }

        public function sendDiscussion($title)
        {
            $tab = array('title' => $title, 'state' => 1, 'nbLike' => 0);
            $sql = 'INSERT INTO DISCUSSION(TITLE, STATE, NB_LIKE) VALUES (:title, :state, :nbLike)';
            $this->executeRequete($sql, $tab);
        }
    }
