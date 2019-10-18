<?php
require_once '../app/model/database.php';

class home extends database
{
    public function getDiscussions($firstDiscussion, $nbDiscussionsByPages)
    {
        $sql = 'SELECT * FROM DISCUSSION ORDER BY ID LIMIT :second, :first';
        $req = $this->executeLIMITRequete($sql, $nbDiscussionsByPages, $firstDiscussion);
        $row = $req->fetchAll();

        return $row;
    }

    public function getNbDiscussions()
    {
        $sql = 'SELECT * FROM DISCUSSION';
        $req = $this->executeRequete($sql);
        return $req->rowCount();
    }

    public function createDiscussion($title)
    {
        $tab = array('title' => $title, 'state' => 1);
        $sql = 'INSERT INTO DISCUSSION(TITLE, STATE) VALUES (:title, :state)';
        $this->executeRequete($sql, $tab);
    }

    public function lastDiscussion()
    {
        return $this->lastInsertId('DISUCSSION');
    }
}

