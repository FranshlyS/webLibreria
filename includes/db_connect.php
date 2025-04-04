<?php
$db_host = 'localhost'; 
$db_name = 'dblibreria'; 
$db_user = 'root';  
$db_pass = '';  
$db_charset = 'utf8mb4';

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
    PDO::ATTR_EMULATE_PREPARES   => false, 
];

$dsn = "mysql:host=$db_host;dbname=$db_name;charset=$db_charset";

try {
     $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

?>