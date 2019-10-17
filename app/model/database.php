<?php
    define('dbHost', 'mysql-aurelien.alwaysdata.net');
    define('dbName', 'aurelien_projet');
    define('dbUser', 'aurelien');
    define('dbPassword', 'M3104_ASTC');

    abstract class DataBase {

        private $bdd;

        protected function executeRequete($sql, $params = null)
        {
            if ($params == null) {
                $resultat = $this->getBdd()->query($sql);    // exécution directe
            }
            else {
                $resultat = $this->getBdd()->prepare($sql);  // requête préparée
                $resultat->execute($params);
            }
            return $resultat;
        }

        protected function executeLIMITRequete($sql, $first, $second)
        {
            $resulat = $this->getBdd()->prepare($sql);
            $resulat->bindValue(':first', intval($first), PDO::PARAM_INT);
            $resulat->bindValue(':second', intval($second), PDO::PARAM_INT);
            $resulat->execute();
            return $resulat;
        }

        protected function lastInsertId($table)
        {
            return $this->getBdd()->lastInsertId($table);
        }

        private function getBdd()
        {
            if ($this->bdd == null)
            {
                $dsn = 'mysql:host=' . dbHost . '; dbname=' . dbName;
                $DataBase = new PDO($dsn, dbUser, dbPassword);
                $DataBase->exec('SET CHARACTER SET utf8');
                $DataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $this->bdd = $DataBase;
            }
            return $this->bdd;
        }

        public function __sleep()
        {
            return array();
        }
    }

