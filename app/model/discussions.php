<?php
    require '../app/model/database.php';

    class Discussion extends DataBase
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
                $tabDiscussions[$compt]['id'] = $row['ID'];
                $tabDiscussions[$compt]['title'] = $row['TITLE'];
                $tabDiscussions[$compt]['state'] = $row['STATE'];
                ++$compt;
            }
            $req->closeCursor();

            return $tabDiscussions;
        }
    }

