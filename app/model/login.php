<?php

    class LoginManager extends DataBase
    {

        public function verif_user($login, $password)
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
    }