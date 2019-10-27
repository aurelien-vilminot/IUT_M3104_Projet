<?php
    abstract class database {

        private $bdd;

        protected function executeRequete($sql, $params = null)      // permet d'executer les requêtes sql
        {
            if ($params == null)
                $resultat = $this->getBdd()->query($sql);            // exécution directe
            else
            {
                try
                {
                    $this->getBdd()->beginTransaction();            // Début de transaction
                    $resultat = $this->getBdd()->prepare($sql);     // requête préparée
                    foreach ($params as $key => $value)
                    {
                        $myKey = ':' . $key;
                        if (is_int($value))
                            $resultat->bindValue($myKey, intval($value), PDO::PARAM_INT);
                        elseif (is_bool($value))
                            $resultat->bindValue($myKey, boolval($value), PDO::PARAM_BOOL);
                        elseif (is_string($value))
                            $resultat->bindValue($myKey, strval($value), PDO::PARAM_STR);
                    }
                    $resultat->execute();
                    $this->getBdd()->commit();
                }
                catch(Exception $e)
                {
                    $this->getBdd()->rollBack();                    // Annulation et remise à l’état initial en cas d’erreur.
                }
            }
            return $resultat;
        }

        protected function lastInsertId($table)  //dernier élément insérer
        {
            return $this->getBdd()->lastInsertId($table);
        }

        private function getBdd()     // renvoie la base de donnée
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

        public function clean($var)  // empêche les insertions de script et sql en "nettoyant" la variable passée en paramètre
        {
            return htmlspecialchars($var, ENT_QUOTES, 'UTF-8', false);
        }

        public function regExpMail($mail)  // permet de verifier si c'est un mail
        {
            return preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+((-|\.)[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/', $mail);
        }

        public function ParseJSONFile($category, $object, $param = null)   // parcour le fichier json et renvoie les valeur en fonction des paramètres
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

