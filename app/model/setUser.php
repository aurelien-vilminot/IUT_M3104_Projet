<?php
class setUser extends database
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function isExist()
    {
        $sql = 'SELECT LOGIN FROM USER WHERE LOGIN = \'' . $this->id . '\'';
        $req = $this->executeRequete($sql);
        return $req->rowCount();
    }
}