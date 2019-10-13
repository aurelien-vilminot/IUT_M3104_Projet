<?php
require '../app/model/database.php';

class Home extends DataBase
{
    public function getDiscussions($firstDiscussion, $nbDiscussionsByPages)
    {
        $tab = array('first' => $nbDiscussionsByPages, 'second' => $firstDiscussion);
        $sql = 'SELECT * FROM DISCUSSION ORDER BY ID LIMIT :second, :first';
        $req = $this->executeLIMITRequete($sql, $nbDiscussionsByPages, $firstDiscussion);
        $compt = $req->rowCount();
        $row = $req->fetchAll();
        $tabDiscussions = array();
        $i = 0;
        while($i < $compt)
        {
            $tabDiscussions[$i] = array();
            $tabDiscussions[$i][0] = $row[$i][0];
            $tabDiscussions[$i][1] = $row[$i][1];
            $tabDiscussions[$i][2] = $row[$i][2];
            ++$i;
        }
        return $tabDiscussions;
    }

    public function getNbDiscussions()
    {
        $sql = 'SELECT * FROM DISCUSSION';
        $req = $this->executeRequete($sql);
        return $nbDiscussions = $req->rowCount();
    }
}

