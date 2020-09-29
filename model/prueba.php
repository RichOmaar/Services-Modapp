<?php
echo 'hola';
require_once 'connection.php';

$db = new Connection();

$connection = $db -> get_connection();
$statement = $connection -> prepare("SELECT * from store");
$statement -> execute();

/*$store = $statement->fetchAll(PDO::FETCH_ASSOC)
var_dump($store);*/
