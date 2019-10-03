<?php
    define('dbHost', 'mysql-aurelien.alwaysdata.net');
    define('dbName', 'aurelien_projet');
    define('dbUser', 'aurelien');
    define('dbPassword', 'M3104_ASTC');

    try {
        $DataBase = new PDO('mysql:host=' . dbHost . '; dbname=' . dbName,dbUser,dbPassword);
    } catch (PDOException $Exept) {
        echo 'Connexion échouée : ' . $Exept->getMessage();
    }
?>