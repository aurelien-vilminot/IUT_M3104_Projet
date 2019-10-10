<?php
    require '../app/model/database.php';

    class Discussion{
        private $DataBase;

        public function __construct()
        {
            $this->DataBase = init_database();
        }

        public function getAllDiscussion()
        {
            $tabDiscussions = array();
            $compt = 0;
            $sql = 'SELECT * FROM DISCUSSION';
            $req = $this->DataBase->query($sql);
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

