<?php
    class discussion extends database
    {
        private $id_discussion;
        private $state;

        public function getIdDiscussion(){return $this->id_discussion;}

        public function setId($id_discussion)
        {
            $this->id_discussion = $id_discussion;
        }

        public function getState()
        {
            $sql = 'SELECT STATE FROM DISCUSSION WHERE ID = \'' . $this->id_discussion . '\'';
            $req = $this->executeRequete($sql);
            $resultat = $req->fetchAll();
            $this->state = $resultat[0][0];
            return $this->state;
        }

        public function setState($state)
        {
            $tab = array('id' => $this->id_discussion, 'state' => $state);
            $sql = 'UPDATE DISCUSSION SET STATE = :state WHERE ID = :id';
            $this->executeRequete($sql, $tab);
        }

        public function isExist()
        {
            $sql = 'SELECT ID FROM DISCUSSION WHERE ID = \'' . $this->id_discussion . '\'';
            $req = $this->executeRequete($sql);
            return $req->rowCount();
        }

        public function getAllMessages()
        {
            $sql = 'SELECT * FROM MESSAGE WHERE ID_DISCUSSION = \'' . $this->id_discussion . '\'';
            $req = $this->executeRequete($sql);
            $row = $req->fetchAll();

            return $row;
        }

        public function getLastMessage()
        {
            $sql = 'SELECT MAX(ID) FROM MESSAGE WHERE ID_DISCUSSION = \'' . $this->id_discussion . '\'';
            $req = $this->executeRequete($sql);
            $resultat = $req->fetchAll();
            return $resultat[0][0];
        }

        public function isLastMessageClose()
        {
            $lastMessage = $this->getLastMessage();
            $sql = 'SELECT STATE FROM MESSAGE WHERE ID = \'' . $lastMessage . '\'';
            $req = $this->executeRequete($sql);
            $resultat = $req->fetchAll();
            return $resultat[0][0];
        }

        public function isEmpty()
        {
            $sql = 'SELECT * FROM MESSAGE WHERE ID_DISCUSSION = \'' . $this->id_discussion . '\'';
            $req = $this->executeRequete($sql);
            return $req->rowCount();
        }

        public function delete()
        {
            $tab = array('id' => $this->id_discussion);
            $sql = 'DELETE FROM USER_MESSAGE WHERE ID_MESSAGE IN (SELECT ID FROM MESSAGE WHERE ID_DISCUSSION = :id)';
            $this->executeRequete($sql, $tab);

            $sql2 = 'DELETE FROM MESSAGE WHERE ID_DISCUSSION = :id';
            $this->executeRequete($sql2, $tab);

            $sql3 = 'DELETE FROM DISCUSSION WHERE ID = :id';
            $this->executeRequete($sql3, $tab);
        }

        public function getUsersMessage($id)
        {
            $sql = 'SELECT * FROM USER_MESSAGE WHERE ID_MESSAGE = \'' . $id . '\'';
            $req = $this->executeRequete($sql);
            return $req->fetchAll();
        }

        public function getVote()
        {
          $sql = 'SELECT VOTE FROM DISCUSSION WHERE ID = \'' . $this->id_discussion . '\'';
          $req = $this->executeRequete($sql);
          $resultat = $req->fetchAll();
          return $resultat[0][0];
        }
    }

