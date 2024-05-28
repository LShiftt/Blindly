<?php
if (($_SERVER['REMOTE_ADDR'] == '127.0.0.1' or $_SERVER['REMOTE_ADDR'] == '::1')) {
    require 'config/config.local.php';
} else {
    require 'config/config.prod.php';
}

include 'helpers/debug.php';
include 'helpers/functions.php';

try {
    $dsn = 'mysql:host=' . APP_DB_HOST . ';dbname=' . APP_DB_NAME . ';charset=UTF8';
    $dbh = new PDO(
        $dsn,
        APP_DB_USER,
        APP_DB_PASSWORD,
        [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]
    );
} catch (PDOException $e) {
    var_dump($e);
}
