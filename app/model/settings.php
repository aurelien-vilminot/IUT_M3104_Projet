<?php
    class settings extends database
    {
        public function setJSONFile($text)      // Réécrit le fichier config.JSON
        {
            $myfile = fopen('../app/files/config.json', "w");
            fwrite($myfile, $text);
            fclose($myfile);
        }

        public function JSONtoString()          // Traduit le fichier JSON en chaine de caractère
        {
            return file_get_contents('../app/files/config.json');
        }
    }
