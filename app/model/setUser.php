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
        $tab = array('login' => $this->id);
        $sql = 'SELECT LOGIN FROM USER WHERE LOGIN = :login';
        $req = $this->executeRequete($sql, $tab);
        return $req->rowCount();
    }
}
