<?php
class users extends database
{
    public function getUsers($firstUser, $nbUsersByPages)       //Renvoie tout les utilisateurs
    {
        $tab = array('first' => $nbUsersByPages, 'second' => $firstUser);
        $sql = 'SELECT * FROM USER ORDER BY LOGIN LIMIT :second, :first';
        $req = $this->executeRequete($sql, $tab);
        $row = $req->fetchAll();
        return $row;
    }

    public function getNbUsers()        //Renvoie le nombre d'utilisateurs
    {
        $sql = 'SELECT LOGIN FROM USER';
        $req = $this->executeRequete($sql);
        return $req->rowCount();
    }
}
