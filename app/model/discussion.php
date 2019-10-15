<?php
require_once '../app/model/database.php';

class Discussion extends DataBase
{
    private $id_discussion;
    public function __construct($id)
    {
        $this->id_discussion = $id;
    }

    public function getIdDiscussion(){return $this->id_discussion;}

    public function getAllMessages()
    {
        $sql = 'SELECT * FROM MESSAGE WHERE ID_DISCUSSION = \'' . $this->id_discussion . '\'';
        $req = $this->executeRequete($sql);
        $row = $req->fetchAll();

        return $row;
    }
}

