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
            $tabDiscussions[$i][$i] = $row[$i][$i];
            $tabDiscussions[$i][$i+1] = $row[$i][$i + 1];
            ++$i;
        }

        return $tabDiscussions;
    }
}

