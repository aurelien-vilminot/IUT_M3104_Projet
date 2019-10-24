<?php
class setUser extends database
{
    private $id;

    public function __construct($id)  //constructeur de la classe setUser
    {
        $this->id = $id;
    }

    public function isExist()       //Vérifie si le login existe déjà
    {
        $sql = 'SELECT LOGIN FROM USER WHERE LOGIN = \'' . $this->id . '\'';
        $req = $this->executeRequete($sql);
        return $req->rowCount();
    }
}
