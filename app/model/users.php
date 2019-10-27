<?php
class users extends database
{
    public function getUsers($firstDiscussion, $nbDiscussionsByPages)       //Renvoie tout les utilisateurs
    {
        $sql = 'SELECT * FROM USER ORDER BY LOGIN LIMIT :second, :first';
        $req = $this->executeLIMITRequete($sql, $nbDiscussionsByPages, $firstDiscussion);
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
