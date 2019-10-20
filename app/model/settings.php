<?php
    class settings extends database
    {
        public function setJSONFile($text)
        {
            $myfile = fopen('../app/files/config.json', "w");
            fwrite($myfile, $text);
            fclose($myfile);
        }

        public function JSONtoString()
        {
            return file_get_contents('../app/files/config.json');
        }
    }
