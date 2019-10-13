<?php
require '../app/model/database.php';

class Home extends DataBase
{
    public function getAllDiscussion()
    {
        $tabDiscussions = array();
        $compt = 0;
        $sql = 'SELECT * FROM DISCUSSION';
        $req = $this->executeRequete($sql);
        $compt = $req->rowCount();
        $row = $req->fetchAll();
        $i = 0;
        while($i <= $compt)
        {
            $tabDiscussions[$i] = array();
            $tabDiscussions[$i][$i] = $row[$i+1][$i+1];
            $tabDiscussions[$i][$i+1] = $row[$i+1][$i + 2];
            ++$i;
        }

        return $tabDiscussions;
    }
}

