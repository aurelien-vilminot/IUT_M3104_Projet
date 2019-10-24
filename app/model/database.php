<?php
    abstract class database {

        private $bdd;

        protected function executeRequete($sql, $params = null)   // permet d'executer les requêtes sql
        {
            if ($params == null) {
                $resultat = $this->getBdd()->query($sql);         // exécution directe
            }
            else {
                $resultat = $this->getBdd()->prepare($sql);       // requête préparée
                $resultat->execute($params);
            }
            return $resultat;
        }

        protected function executeLIMITRequete($sql, $first, $second)   // Pour les requêtes sql contiennant order by et limit
        {
            $resulat = $this->getBdd()->prepare($sql);
            $resulat->bindValue(':first', intval($first), PDO::PARAM_INT);
            $resulat->bindValue(':second', intval($second), PDO::PARAM_INT);
            $resulat->execute();
            return $resulat;
        }

        protected function lastInsertId($table)  //dernier élément insérer
        {
            return $this->getBdd()->lastInsertId($table);
        }

        private function getBdd()
        {
            if ($this->bdd == null)
            {
                $dsn = 'mysql:host=' . $this->ParseJSONFile('Database','Host') . '; dbname=' . $this->ParseJSONFile('Database','Name');
                $DataBase = new PDO($dsn, $this->ParseJSONFile('Database','User'), $this->ParseJSONFile('Database','Password'));
                $DataBase->exec('SET CHARACTER SET utf8');
                $DataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $this->bdd = $DataBase;
            }
            return $this->bdd;
        }

        public function clean($var)  // permet de convertir les caractères spéciaux en entités html
        {
            return htmlspecialchars($var, ENT_QUOTES, 'UTF-8', false);
        }

        public function regExpMail($mail)  // permet de verifier si c'est un mail
        {
            return preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+((-|\.)[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/', $mail);
        }

        public function ParseJSONFile($category, $object, $param = null)  
        {
            $configFile = file_get_contents('../app/files/config.json');
            $parsed_json = json_decode($configFile);
            if ($param == null)
                return $parsed_json->{$category}->{$object};
            else
                return $parsed_json->{$category}->{$object}->{$param};
        }

        public function __sleep()
        {
            return array();
        }
    }

