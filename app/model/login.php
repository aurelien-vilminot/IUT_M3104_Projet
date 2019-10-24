<?php
    class login extends database
    {
        public function verif_user($login, $password)   // verifie si l'utilisateur à rentrer le bon mot de passe
        {
            $sql = 'SELECT * FROM USER WHERE LOGIN = \'' . $login . '\'';
            $requete = $this->executeRequete($sql);

            $exist = $requete->rowCount($sql);

            $requete->setFetchMode(PDO::FETCH_OBJ);
            while ($result = $requete->fetch())
            {
                $BD_password =  $result->PASSWORD;
            }

            $result = 1;

            if ($exist != 1)
                $result = 2;
            elseif (password_verify($password,$BD_password))
                $result = 0;

            return $result;
        }

        public function isAdmin($login)  // vérifie si c'est c'est un administrateur
        {
            $sql = 'SELECT ADMIN FROM USER WHERE LOGIN = \'' . $login . '\'';
            $req = $this->executeRequete($sql);
            $resultat = $req->fetchAll();
            return $resultat[0][0];
        }
    }
