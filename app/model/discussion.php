<?php
    class discussion extends database
    {
        private $id_discussion;
        private $state;

        public function getIdDiscussion(){return $this->id_discussion;}    // renvoie l'identifiant de la discussion

        public function setId($id_discussion)  // affecte une valeur à l'identifiant de la discussion
        {
            $this->id_discussion = $id_discussion;
        }

        public function getState()  // renvoie l'état de la discussion si elle est ouverte ou close
        {
            $sql = 'SELECT STATE FROM DISCUSSION WHERE ID = \'' . $this->id_discussion . '\'';
            $req = $this->executeRequete($sql);
            $resultat = $req->fetchAll();
            $this->state = $resultat[0][0];
            return $this->state;
        }

        public function setState($state)   //change le statut de la discussion dans la base de donnée
        {
            $tab = array('id' => $this->id_discussion, 'state' => $state);
            $sql = 'UPDATE DISCUSSION SET STATE = :state WHERE ID = :id';
            $this->executeRequete($sql, $tab);
        }

        public function isExist()      // vérifie si la discussion existe
        {
            $sql = 'SELECT ID FROM DISCUSSION WHERE ID = \'' . $this->id_discussion . '\'';
            $req = $this->executeRequete($sql);
            return $req->rowCount();
        }

        public function getAllMessages()  //renvoie tous les messages
        {
            $sql = 'SELECT * FROM MESSAGE WHERE ID_DISCUSSION = \'' . $this->id_discussion . '\'';
            $req = $this->executeRequete($sql);
            return $req->fetchAll();
        }

        public function getLastMessage()      //renvoie le dernier message de la discussion 
        {
            $sql = 'SELECT MAX(ID) FROM MESSAGE WHERE ID_DISCUSSION = \'' . $this->id_discussion . '\'';
            $req = $this->executeRequete($sql);
            $resultat = $req->fetchAll();
            return $resultat[0][0];
        }

        public function getUsersMessage($idMessage)     //renvoie les personnes ayant ecrit dans ce message 
        {
            $sql = 'SELECT ID_USER FROM USER_MESSAGE WHERE ID_MESSAGE = \'' . $idMessage . '\'';
            $req = $this->executeRequete($sql);
            return $req->fetchAll();
        }

        public function isLastMessageClose()    // ferme le dernier message
        {
            $lastMessage = $this->getLastMessage();
            $sql = 'SELECT STATE FROM MESSAGE WHERE ID = \'' . $lastMessage . '\'';
            $req = $this->executeRequete($sql);
            $resultat = $req->fetchAll();
            return $resultat[0][0];
        }

        public function isEmpty()      // verifie si la discussion contient des messages
        {
            $sql = 'SELECT * FROM MESSAGE WHERE ID_DISCUSSION = \'' . $this->id_discussion . '\'';
            $req = $this->executeRequete($sql);
            return $req->rowCount();
        }

        public function delete()   // supprime la discussion
        {
            $tab = array('id' => $this->id_discussion);
            $sql = 'DELETE FROM USER_MESSAGE WHERE ID_MESSAGE IN (SELECT ID FROM MESSAGE WHERE ID_DISCUSSION = :id)';
            $this->executeRequete($sql, $tab);

            $sql2 = 'DELETE FROM MESSAGE WHERE ID_DISCUSSION = :id';
            $this->executeRequete($sql2, $tab);

            $sql3 = 'DELETE FROM LIKE_DISCUSSION WHERE ID_DISCuSSION = :id';
            $this->executeRequete($sql3, $tab);

            $sql4 = 'DELETE FROM DISCUSSION WHERE ID = :id';
            $this->executeRequete($sql4, $tab);
        }

        public function isLiked($login)     // retourne l'identifiant de l'utiliser et celui de la discussion en fonction de si ils ont aimé
        {
            $sql = 'SELECT * FROM LIKE_DISCUSSION WHERE ID_USER = \'' . $login . '\' AND ID_DISCUSSION = \'' . $this->id_discussion . '\'';
            $req = $this->executeRequete($sql);
            return $req->rowCount();
        }

        public function like($login)       // incrémente le nombre de like
        {
            $tab = array('login' => $login, 'id_discussion' => $this->id_discussion);
            $sql = 'INSERT INTO LIKE_DISCUSSION (ID_USER, ID_DISCUSSION) VALUES (:login, :id_discussion)';
            $this->executeRequete($sql, $tab);

            $sql2 = 'UPDATE DISCUSSION SET NB_LIKE = NB_LIKE + 1 WHERE ID = \'' . $this->id_discussion . '\'';
            $this->executeRequete($sql2);
        }

        public function unlike($login)     //décremente le nombre de like
        {
            $tab = array('login' => $login, 'id_discussion' => $this->id_discussion);
            $sql = 'DELETE FROM LIKE_DISCUSSION WHERE ID_DISCUSSION = :id_discussion AND ID_USER = :login';
            $this->executeRequete($sql, $tab);

            $sql2 = 'UPDATE DISCUSSION SET NB_LIKE = NB_LIKE - 1 WHERE ID = \'' . $this->id_discussion . '\'';
            $this->executeRequete($sql2);
        }

    }

