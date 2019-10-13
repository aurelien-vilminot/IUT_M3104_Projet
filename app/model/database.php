<?php
    define('dbHost', 'mysql-aurelien.alwaysdata.net');
    define('dbName', 'aurelien_projet');
    define('dbUser', 'aurelien');
    define('dbPassword', 'M3104_ASTC');

    abstract class DataBase {

        private $bdd;

        protected function executeRequete($sql, $params = null) {
            if ($params == null) {
                $resultat = $this->getBdd()->query($sql);    // exécution directe
            }
            else {
                $resultat = $this->getBdd()->prepare($sql);  // requête préparée
                $resultat->execute($params);
            }
            return $resultat;
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

    }

