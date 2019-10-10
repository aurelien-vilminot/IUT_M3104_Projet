<?php
    define('dbHost', 'mysql-aurelien.alwaysdata.net');
    define('dbName', 'aurelien_projet');
    define('dbUser', 'aurelien');
    define('dbPassword', 'M3104_ASTC');

    class DataBase {
        private $DataBase;

        public function __construct()
        {
            if (!isset($this->DataBase))
            {
                try {
                    $dsn = 'mysql:host=' . dbHost . '; dbname=' . dbName;
                    $DataBase = new PDO($dsn, dbUser, dbPassword, array(PDO::ATTR_PERSISTENT => true));
                    $DataBase->exec('SET CHARACTER SET utf8');
                    $DataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }
                catch (PDOException $e){
                    die ('Erreur : ' . $e->getMessage());
                }
                $this->DataBase = $DataBase;
            }
        }

        public function getDataBase()
        {
            return $this->DataBase;
        }
    }

