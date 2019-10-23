# IUT Informatique - Projet M3104
 * Site Web PHP en MVC *

Récupérer données SQL :

        $sql = 'SELECT MAIL, ADMIN FROM USER WHERE LOGIN = \'' . $this->login . '\'';
        $req = $this->DataBase->query($sql);
        $row = $req->fetchAll();
        $this->mail = $row[0][0];
        $this->admin = $row[0][1];
        
        //OU
        
        $sql = 'SELECT MAIL, ADMIN FROM USER WHERE LOGIN = \'' . $this->login . '\'';
        $req = $this->DataBase->query($sql);        
        while($row = $req->fetch())
        {
            $this->mail = $row['MAIL'];
            $this->admin = $row['ADMIN'];
        }
        $req->closeCursor();
