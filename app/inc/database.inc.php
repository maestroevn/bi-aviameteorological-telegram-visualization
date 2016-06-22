<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'meteo');
define('DB_USER', 'root');
define('DB_PASSWORD', 'toxindzners');

try {
    $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
    echo $e->getMessage();
}