<?php
    class home extends database
    {
        public function getDiscussions($firstDiscussion, $nbDiscussionsByPages)  // retourne les discussions entre fonction du nombre de like
        {
            $sql = 'SELECT * FROM DISCUSSION ORDER BY NB_LIKE DESC, ID LIMIT :second, :first';
            $req = $this->executeLIMITRequete($sql, $nbDiscussionsByPages, $firstDiscussion);
            return $req->fetchAll();
        }

        public function getNbDiscussions()  // renvoie toutes les discussions
        {
            $sql = 'SELECT * FROM DISCUSSION';
            $req = $this->executeRequete($sql);
            return $req->rowCount();
        }

        public function createDiscussion($title)   //permet de créer une discussion
        {
            $tab = array('title' => $title, 'state' => 1, 'nbLike' => 0);
            $sql = 'INSERT INTO DISCUSSION(TITLE, STATE, NB_LIKE) VALUES (:title, :state, :nbLike)';
            $this->executeRequete($sql, $tab);
        }

        public function lastDiscussion() //dernier discussion ajoute à la base de donnée 
        {
            return $this->lastInsertId('DISCUSSION');
        }
    }

