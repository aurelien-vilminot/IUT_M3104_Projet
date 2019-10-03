<?php

    define('dbHost', 'mysql-aurelien.alwaysdata.net');
    define('dbName', 'aurelien_projet');
    define('dbUser', 'aurelien');
    define('dbPassword', 'M3104_ASTC');

    try {
        $DataBase = new PDO('mysql:host=mysql-aurelien.alwaysdata.net; dbname=aurelien_projet','aurelien','M3104_ASTC');
    } catch (PDOException $Exept) {
        echo 'Connexion échoué : ' . $Exept->getMessage();
    }

?>