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
        while($row = $req->fetch())
        {
            $tabDiscussions[$compt] = array();
            $tabDiscussions[$compt][$compt] = $row['TITLE'];
            $tabDiscussions[$compt][++$compt] = $row['STATE'];
            ++$compt;
        }
        $req->closeCursor();

        return $tabDiscussions;
    }
}

