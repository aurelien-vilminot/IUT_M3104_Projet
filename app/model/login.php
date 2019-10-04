<?php
    include '../app/model/DB_Connection.php';

    class CLogin
    {
        private $DataBase;

        public function __construct()
        {
            $this->DataBase = init_database();
        }

        public function verif_user($login, $password)
        {
            $tab = array(
                'login' => $login,
            );
            $sql = 'SELECT * FROM USER WHERE LOGIN = :login';
            $requete = $this->DataBase->prepare($sql);
            $requete->execute($tab);

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