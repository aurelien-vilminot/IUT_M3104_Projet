<?php
require_once '../app/model/database.php';

class Home extends DataBase
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
        return $nbDiscussions = $req->rowCount();
    }
}

